<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      3.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 * @author     Your Name <email@example.com>
 */
class Disqus_Public {

	/**
	 * Returns the Disqus identifier for a given post.
	 *
	 * @since     3.0
	 * @param     WP_Post $post    The WordPress post to create the title for.
	 * @return    string           The formatted identifier to be passed to Disqus.
	 */
	public static function dsq_identifier_for_post( $post ) {
		return $post->ID . ' ' . $post->guid;
	}

	/**
	 * Returns the Disqus title for a given post.
	 *
	 * @since     3.0
	 * @param     WP_Post $post    The WordPress post to create the title for.
	 * @return    string           The cleaned title to be passed to Disqus.
	 */
	public static function dsq_title_for_post( $post ) {
		$title = get_the_title( $post );
    	$title = strip_tags( $title, '<b><u><i><h1><h2><h3><code><blockquote><br><hr>' );
    	return $title;
	}

	/**
	 * Returns the signed payload to authenticate an SSO user in Disqus.
	 *
	 * @since     3.0
	 * @param     WP_User $user          The WordPress user to authenticate.
	 * @param     string  $secret_key    The Disqus API Secret Key.
	 * @return    array                  The signed payload to authenticate a user with Single Sign-On.
	 */
	public static function remote_auth_s3_for_user( $user, $secret_key ) {
		$payload_user = array();
		if ( $user->ID ) {
			$payload_user['id'] = $user->ID;
			$payload_user['username'] = $user->display_name;
			$payload_user['avatar'] = get_avatar_url( $user->ID, 92 );
			$payload_user['email'] = $user->user_email;
			$payload_user['url'] = $user->user_url;
		}
		$payload_user = base64_encode( json_encode( $payload_user ) );
		$time = time();
		$hmac = hash_hmac( 'sha1', $payload_user . ' ' . $time, $secret_key );

		return $payload_user . ' ' . $hmac . ' ' . $time;
	}

	/**
	 * Returns the Disqus comments embed configuration.
	 *
	 * @since     3.0
	 * @access    private
	 * @param     WP_Post $post    The WordPress post to create the configuration for.
	 * @return    array            The embed configuration to localize the comments embed script with.
	 */
	public static function embed_vars_for_post( $post ) {
		global $DISQUSVERSION;

		$embed_vars = array(
			'disqusConfig' => array(
				'integration' => 'wordpress ' . $DISQUSVERSION,
			),
			'disqusIdentifier' => Disqus_Public::dsq_identifier_for_post( $post ),
			'disqusShortname' => get_option( 'disqus_forum_url' ),
			'disqusTitle' => Disqus_Public::dsq_title_for_post( $post ),
			'disqusUrl' => get_permalink( $post ),
			'postId' => $post->ID,
		);

		$public_key = get_option( 'disqus_public_key' );
		$secret_key = get_option( 'disqus_secret_key' );
		$can_enable_sso = $public_key && $secret_key && get_option( 'disqus_sso_enabled' );
		if ( $can_enable_sso ) {
			$user = wp_get_current_user();
			$login_redirect = get_admin_url( null, 'profile.php?opener=dsq-sso-login' );
			$embed_vars['disqusConfig']['sso'] = array(
				'name' => esc_js( get_bloginfo( 'name' ) ),
				'button' => esc_js( get_option( 'disqus_sso_button' ) ),
				'url' => wp_login_url( $login_redirect ),
				'logout' => wp_logout_url(),
				'width' => '800',
				'height' => '700',
			);
			$embed_vars['disqusConfig']['api_key'] = $public_key;
			$embed_vars['disqusConfig']['remote_auth_s3'] = Disqus_Public::remote_auth_s3_for_user( $user, $secret_key );
		}

		return $embed_vars;
	}

	/**
	 * The ID of this plugin.
	 *
	 * @since    3.0
	 * @access   private
	 * @var      string $disqus    The ID of this plugin.
	 */
	private $disqus;

	/**
	 * The version of this plugin.
	 *
	 * @since    3.0
	 * @access   private
	 * @var      string $version    The current version of this plugin.
	 */
	private $version;

	/**
     * The unique Disqus forum shortname.
     *
     * @since    3.0
     * @access   private
     * @var      string $shortname    The unique Disqus forum shortname.
     */
    private $shortname;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0
	 * @param    string $disqus       The name of the plugin.
	 * @param    string $version      The version of this plugin.
	 * @param    string $shortname    The configured Disqus shortname.
	 */
	public function __construct( $disqus, $version, $shortname ) {
		$this->disqus = $disqus;
		$this->version = $version;
		$this->shortname = $shortname;
	}

	/**
	 * Determines if Disqus is configured and can load on a given page.
	 *
	 * @since     3.0
	 * @param     string $comment_text    The default comment text.
	 * @return    string                  The new comment text.
	 */
	public function dsq_comments_link_template( $comment_text ) {
		global $post;

		if ( $this->dsq_can_load( 'count' ) ) {
			$disqus_identifier = esc_attr( $this->dsq_identifier_for_post( $post ) );
			return '<span class="dsq-postid" data-dsqidentifier="' . $disqus_identifier . '">'
						. $comment_text .
				   '</span>';
		} else {
			return $comment_text;
		}
	}

	/**
	 * Returns the Disqus embed comments template
	 *
	 * @since     3.0
	 * @return    string    The new comment text.
	 */
	public function dsq_comments_template() {
		global $post;

		if ( $this->dsq_embed_can_load_for_post( $post ) ) {

			do_action( 'dsq_before_comments' );
			do_action( 'dsq_enqueue_comments_script' );

			return plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/disqus-public-display.php';
		}
	}

	/**
	 * Renders a script which checks to see if the window was opened
	 * by the Disqus embed for Single Sign-on purposes, and closes
	 * itself.
	 *
	 * @since    3.0
	 */
	public function dsq_close_window_template() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/disqus-public-sso-login-profile.php';
	}

	/**
	 * Enqueues javascript files for displaying comment counts.
	 *
	 * @since    3.0
	 */
	public function enqueue_comment_count() {
		if ( $this->dsq_can_load( 'count' ) ) {

			$count_vars = array(
				'disqusShortname' => $this->shortname,
			);

			wp_enqueue_script( $this->disqus . '_count', plugin_dir_url( __FILE__ ) . 'js/comment_count.js', array(), $this->version, true );
			wp_localize_script( $this->disqus . '_count', 'countVars', $count_vars );
		}
	}

	/**
	 * Enqueues javascript files for displaying the comment embed.
	 *
	 * @since    3.0
	 */
	public function enqueue_comment_embed() {
		global $post;

		if ( $this->dsq_embed_can_load_for_post( $post ) && ! get_option( 'disqus_render_js' ) ) {

			$embed_vars = Disqus_Public::embed_vars_for_post( $post );

			wp_enqueue_script( $this->disqus . '_embed', plugin_dir_url( __FILE__ ) . 'js/comment_embed.js', array(), $this->version, true );
			wp_localize_script( $this->disqus . '_embed', 'embedVars', $embed_vars );
		}
	}

	/**
	 * Determines if Disqus is configured and can load on a given page.
	 *
	 * @since     3.0
	 * @access    private
	 * @param     string $script_name    The name of the script Disqus intends to load.
	 * @return    boolean                Whether Disqus is configured properly and can load on the current page.
	 */
	private function dsq_can_load( $script_name ) {
		// Don't load any Disqus scripts if there's no shortname.
		if ( ! $this->shortname ) {
			return false;
		}

		// Don't load any Disqus scripts on feed pages.
		if ( is_feed() ) {
			return false;
        }

        $site_allows_load = apply_filters( 'dsq_can_load', $script_name );
		if ( is_bool( $site_allows_load ) ) {
			return $site_allows_load;
		}

		return true;
	}

	/**
	 * Determines if Disqus is configured and can the comments embed on a given page.
	 *
	 * @since     3.0
	 * @access    private
	 * @param     WP_Post $post    The WordPress post used to determine if Disqus can be loaded.
	 * @return    boolean          Whether Disqus is configured properly and can load on the current page.
	 */
	private function dsq_embed_can_load_for_post( $post ) {
		// Checks if the plugin is configured properly
		// and is a valid page.
		if ( ! $this->dsq_can_load( 'embed' ) ) {
			return false;
		}

		// Make sure we have a $post object.
		if ( ! isset( $post ) ) {
			return false;
		}

		// Don't load embed for certain types of non-public posts because these post types typically still have the
		// ID-based URL structure, rather than a friendly permalink URL.
		$illegal_post_statuses = array(
			'draft',
			'auto-draft',
			'pending',
			'future',
			'trash',
		);
		if ( in_array( $post->post_status, $illegal_post_statuses ) ) {
			return false;
		}

		// Don't load embed when comments are closed on a post.
		if ( 'open' != $post->comment_status ) {
			return false;
		}

		// Don't load embed when comments are closed on a post. These lines can solve a conflict with plugin Public Post Preview.
		if ( ! comments_open() ) {
			return false;
		}

		// Don't load embed if it's not a single post page.
		if ( ! is_singular() ) {
			return false;
		}

		return true;
	}
}
