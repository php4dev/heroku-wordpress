<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }



/**
 * Class BuddyFormsAssets
 */
class BuddyFormsAssets {
	/**
	 * @var string
	 */
	public static $form_slug;

	/**
	 * @var string
	 */
	public static $content;

	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ), 102, 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_js' ), 102, 1 );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ), 1 );

		add_action( 'wp_enqueue_scripts', array( $this, 'front_js_loader' ), 9999, 1 );
	}

	/**
	 * Check if a buddyforms view is displayed and load the needed styles and scripts
	 *
	 * @package buddyforms
	 * @since 1.0
	 */
	function front_js_loader() {
		global $post, $wp_query, $buddyforms;

		$found     = false;
		$form_slug = '';

		$this->register_bf_thickbox();

		if ( ! empty( $post->post_content ) ) {
			$form_slug = buddyforms_get_form_slug_from_content( $post->post_content );
			// check the post content for the short code
			$found = ( ! empty( $form_slug ) );
		}

		if ( isset( $post->ID ) && empty( $form_slug ) ) {
			$form_slug = get_post_meta( $post->ID, '_bf_form_slug', true );
			// check the post content for the short code
			$found = ( ! empty( $form_slug ) );
		}

		if ( isset( $wp_query->query['bf_action'] ) ) {
			$found = true;
		}

		$buddyforms_preview_page = get_option( 'buddyforms_preview_page', true );

		if ( isset( $post->ID ) && $post->ID == $buddyforms_preview_page ) {
			$found = true;
		}

		$found = apply_filters( 'buddyforms_front_js_css_loader', $found );

		$post_content = ! empty( $post ) && ! empty( $post->post_content ) ? $post->post_content : '';

		if ( $found ) {
			self::front_js_css( $post_content, $form_slug );
			self::load_tk_font_icons();
		}

	}

	/**
	 * Register buddyforms thickbox this library is used from other buddyforms extension
	 */
	function register_bf_thickbox() {
		wp_register_style( 'buddyforms-thickbox', BUDDYFORMS_ASSETS . 'resources/bf-thickbox/bf-thickbox.css', array(), BUDDYFORMS_VERSION );
		wp_register_script( 'buddyforms-thickbox', BUDDYFORMS_ASSETS . 'resources/bf-thickbox/bf-thickbox.js', array( 'jquery' ), BUDDYFORMS_VERSION );
		wp_localize_script( 'buddyforms-thickbox', 'bf_thickboxL10n', array(
			'next'             => __( 'Next &gt;' ),
			'prev'             => __( '&lt; Prev' ),
			'image'            => __( 'Image' ),
			'of'               => __( 'of' ),
			'close'            => __( 'Close' ),
			'noiframes'        => __( 'This feature requires inline frames. You have iframes disabled or your browser does not support them.' ),
			'loadingAnimation' => includes_url( 'js/thickbox/loadingAnimation.gif' ),
		) );
	}

	/**
	 * @since 2.5.2 Load select2 assets
	 */
	public static function load_select2_assets() {
		// jQuery Select2 // https://select2.github.io/
		wp_enqueue_script( 'buddyforms-select2-js', BUDDYFORMS_ASSETS . 'resources/select2/dist/js/select2.full.min.js', array( 'jquery' ), '4.0.3' );
		wp_enqueue_style( 'buddyforms-select2-css', BUDDYFORMS_ASSETS . 'resources/select2/dist/css/select2.min.css' );
	}

	/**
	 * Enqueue the needed JS for the form in the frontend
	 *
	 * @param string $content This is the page content,
	 *
	 * @param string $form_slug
	 *
	 * @note Used in the filter buddyforms_front_js_css_after_enqueue as parameter to 3rd addons determinate if include or not the assets reading the content
	 * @return string
	 *
	 * @since 2.5.9 return the form slug
	 * @since 2.4.6 added the $form_slug as parameter
	 *
	 * @package buddyforms
	 * @since 1.0
	 *
	 */
	public static function front_js_css( $content = '', $form_slug = '' ) {
		global $wp_query, $buddyforms;

		/**
		 * @since 2.5.10 added the $content and $form_slug parameters
		 */
		do_action( 'buddyforms_front_js_css_enqueue', $content, $form_slug );

		if ( ! empty( $form_slug ) && $form_slug !== 'none' && empty( $wp_query->query_vars['bf_form_slug'] ) ) {
			$wp_query->query_vars['bf_form_slug'] = $form_slug;
		}

		//Scripts needed by the form core
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widgets' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'password-strength-meter' );
		wp_enqueue_script( 'mce-view' );
		// jQuery Validation http://jqueryvalidation.org/
		wp_enqueue_script( 'jquery-validation', BUDDYFORMS_ASSETS . 'resources/jquery.validate.min.js', array( 'jquery' ) );
		// jQuery Local storage http://garlicjs.org/
		wp_enqueue_script( 'jquery-garlicjs', BUDDYFORMS_ASSETS . 'resources/garlicjs/garlic.js', array( 'jquery' ) );
		wp_enqueue_media();

		$password_strength_settings = get_option( 'buddyforms_password_strength_settings' );

		BuddyForms::buddyforms_js_global_set_parameters( array(
			'pwsL10n' => array(
				'empty'             => ! empty( $password_strength_settings['hint_text'] ) && ! empty( $password_strength_settings['hint_text'] ) ? $password_strength_settings['hint_text'] : __( 'Strength indicator', 'buddyforms' ),
				'short'             => ! empty( $password_strength_settings['lavel_1'] ) && ! empty( $password_strength_settings['lavel_1'] ) ? $password_strength_settings['lavel_1'] : __( 'Short: Your password is too short.', 'buddyforms' ),
				'bad'               => ! empty( $password_strength_settings['lavel_2'] ) && ! empty( $password_strength_settings['lavel_2'] ) ? $password_strength_settings['lavel_2'] : __( 'Password Strength: Weak', 'buddyforms' ),
				'good'              => ! empty( $password_strength_settings['lavel_3'] ) && ! empty( $password_strength_settings['lavel_3'] ) ? $password_strength_settings['lavel_3'] : _x( 'Password Strength: OK', 'buddyforms' ),
				'strong'            => ! empty( $password_strength_settings['lavel_4'] ) && ! empty( $password_strength_settings['lavel_4'] ) ? $password_strength_settings['lavel_4'] : __( 'Password Strength: Strong', 'buddyforms' ),
				'mismatch'          => ! empty( $password_strength_settings['mismatch'] ) && ! empty( $password_strength_settings['mismatch'] ) ? $password_strength_settings['mismatch'] : __( 'Mismatch', 'buddyforms' ),
				'hint_text'         => ! empty( $password_strength_settings['hint_text'] ) && ! empty( $password_strength_settings['hint_text'] ) ? $password_strength_settings['hint_text'] : __( 'Hint: The password should be at least twelve characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! \" ? $ % ^ &amp; ).', 'buddyforms' ),
				'required_strength' => ! empty( $password_strength_settings ) && isset( $password_strength_settings['required_strength'] ) ? $password_strength_settings['required_strength'] : apply_filters( 'buddyforms_password_strength_default_strength', 3, $form_slug ),
			)
		) );

		//Loading shared assets
		self::shared_styles( '' );

		wp_enqueue_script( 'buddyforms-js', BUDDYFORMS_ASSETS . 'js/buddyforms.js', array(
			'jquery-ui-core',
			'jquery-ui-datepicker',
			'jquery-ui-slider'
		) );

		// load dashicons
		wp_enqueue_style( 'dashicons' );

		wp_enqueue_style( 'gdpr-agreement', BUDDYFORMS_ASSETS . 'css/gdpr.css', array() );

		$gpdr_translations = array(
			'gdpr_success' => __( 'Your enquiry have been submitted. Check your email to validate your data request.', 'buddyforms' ),
			'gdpr_errors'  => __( 'Some errors occurred:', 'buddyforms' ),
		);

		$front_js_arguments = array(
			'admin_url'                => admin_url( 'admin-ajax.php' ),
			'assets'                   => self::frontend_assets(),
			'ajaxnonce'                => wp_create_nonce( 'fac_drop' ),
			'buddyforms_gdpr_localize' => $gpdr_translations,
			'current_screen'           => '',//Keep for compatibility
			'is_admin'                 => is_admin(),
			'localize'                 => BuddyForms::localize_fields(),
			'delete_text'              => __( 'Delete Permanently', 'buddyforms' ),
			'tb_pathToImage'           => includes_url( 'js/thickbox/loadingAnimation.gif', 'relative' ),
		);
		if ( ! empty( $form_slug ) && ! empty( $buddyforms ) && isset( $buddyforms[ $form_slug ] ) ) {
			$options                          = buddyforms_filter_frontend_js_form_options( $buddyforms[ $form_slug ], $form_slug );
			$front_js_arguments[ $form_slug ] = $options;
		}
		BuddyForms::buddyforms_js_global_set_parameters( $front_js_arguments );

		//Global frontend vars
		$js_params = BuddyForms::buddyforms_js_global_get_parameters( $form_slug );
		wp_localize_script( "buddyforms-js", "buddyformsGlobal", apply_filters( 'buddyforms_global_localize_scripts', $js_params, $form_slug ) );

		/**
		 * @since 2.5.10 added the $form_slug parameter
		 */
		do_action( 'buddyforms_front_js_css_after_enqueue', $content, $form_slug );

		return $form_slug;
	}

	/**
	 * Shared assets between frontend and backend
	 *
	 * @param $hook_suffix
	 *
	 * @since 2.4.0
	 *
	 */
	public static function shared_styles( $hook_suffix ) {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );

		wp_enqueue_script( 'buddyforms-loadingoverlay', BUDDYFORMS_ASSETS . 'resources/loadingoverlay/loadingoverlay.min.js', array( 'jquery' ) );
	}

	/**
	 * Enqueue the needed CSS for the admin screen
	 *
	 * @param $hook_suffix
	 *
	 * @since 0.1-beta
	 *
	 * @package buddyforms
	 */
	public function admin_styles( $hook_suffix ) {
		global $post;

		if (
			( isset( $post ) && $post->post_type == 'buddyforms' && isset( $_GET['action'] ) && $_GET['action'] == 'edit'
			  || isset( $post ) && $post->post_type == 'buddyforms' && $hook_suffix == 'post-new.php' )
			|| $hook_suffix == 'buddyforms_page_buddyforms_submissions'
			|| $hook_suffix == 'buddyforms_page_buddyforms_settings'
		) {
			if ( is_rtl() ) {
				wp_enqueue_style( 'buddyforms-style-rtl', BUDDYFORMS_ASSETS . 'admin/css/admin-rtl.css' );
			}
			wp_enqueue_style( 'buddyforms-admin-css', BUDDYFORMS_ASSETS . 'admin/css/admin.css' );
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
			wp_enqueue_style( 'wp-color-picker' );
//			wp_enqueue_style( 'buddyforms', BUDDYFORMS_ASSETS . 'admin/css/buddyforms-admin.css', array() );
		} else {
			wp_enqueue_style( 'buddyforms-admin-post-metabox', BUDDYFORMS_ASSETS . 'admin/css/admin-post-metabox.css' );
		}
		// load the tk_icons everywhere in the admin
		self::load_tk_font_icons();
	}

	/**
	 * Load TK icons
	 */
	static function load_tk_font_icons() {
		wp_enqueue_style( 'buddyforms-tk-icons', BUDDYFORMS_ASSETS . 'resources/tk_icons/style.css' );
	}

	static public function frontend_assets() {
		return array(
			'select2_js'  => BUDDYFORMS_ASSETS . 'resources/select2/dist/js/select2.min.js',
			'select2_css' => BUDDYFORMS_ASSETS . 'resources/select2/dist/css/select2.min.css',
		);
	}

	/**
	 * Enqueue the needed JS for the admin screen
	 *
	 * @param $hook_suffix
	 *
	 * @since 0.1-beta
	 *
	 * @package buddyforms
	 */
	function admin_js( $hook_suffix ) {
		global $post, $wp_query, $buddyforms;
		//WP Backend global scripts
		wp_enqueue_script( 'buddyforms-admin-all-js', BUDDYFORMS_ASSETS . 'admin/js/admin-all.js', array( 'jquery' ), BUDDYFORMS_VERSION );
		if (
			( isset( $post ) && ( $post->post_type == 'buddyforms' || $post->post_type == 'post' ) && isset( $_GET['action'] ) && $_GET['action'] == 'edit'
			  || isset( $post ) && $post->post_type == 'buddyforms' && $hook_suffix == 'post-new.php' )
			|| $hook_suffix == 'buddyforms_page_buddyforms_submissions'
			|| $hook_suffix == 'buddyforms_page_buddyforms_settings'
		) {
			wp_register_script( 'buddyforms-admin-js', BUDDYFORMS_ASSETS . 'admin/js/admin.js', array(), BUDDYFORMS_VERSION );
			wp_register_script( 'buddyforms-admin-slugifies-js', BUDDYFORMS_ASSETS . 'admin/js/slugifies.js', array(), BUDDYFORMS_VERSION );
			wp_register_script( 'buddyforms-admin-deprecated-js', BUDDYFORMS_ASSETS . 'admin/js/deprecated.js', array(), BUDDYFORMS_VERSION );
			wp_register_script( 'buddyforms-admin-conditionals-js', BUDDYFORMS_ASSETS . 'admin/js/conditionals.js', array(), BUDDYFORMS_VERSION );
			wp_register_script( 'buddyforms-admin-formbuilder-js', BUDDYFORMS_ASSETS . 'admin/js/formbuilder.js', array(), BUDDYFORMS_VERSION );

			//Loading shared assets
			self::shared_styles( $hook_suffix );

			wp_enqueue_script( 'buddyforms-admin-js' );
			wp_enqueue_script( 'buddyforms-admin-slugifies-js' );
			wp_enqueue_script( 'buddyforms-admin-deprecated-js' );
			wp_enqueue_script( 'buddyforms-admin-formbuilder-js' );
			wp_enqueue_script( 'buddyforms-admin-conditionals-js' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-accordion' );
			wp_enqueue_script( 'jquery-ui-dialog' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'tinymce' );
			wp_enqueue_script( 'buddyforms-admin-all-js', BUDDYFORMS_ASSETS . 'admin/js/admin-all.js', array( 'jquery' ), BUDDYFORMS_VERSION );
			wp_enqueue_media();
			wp_enqueue_script( 'media-uploader-js', BUDDYFORMS_ASSETS . 'js/media-uploader.js', array( 'jquery' ) );

			// GDPR Localisation
			$buddyforms_gdpr = get_option( 'buddyforms_gdpr' );
			$templates       = isset( $buddyforms_gdpr['templates'] ) ? $buddyforms_gdpr['templates'] : array();

			$admin_text_array            = array();
			$admin_text_array['check']   = __( 'Check all', 'buddyforms' );
			$admin_text_array['uncheck'] = __( 'Uncheck all', 'buddyforms' );

			if(count($templates)==0){
				$registration_gdpr_template = __( "By signing up on our site you agree to our terms and conditions [link].  We'll create a new user account for you based on your submissions.  All data you submit will be stored on our servers.  After your registration we'll instantly send you an email with an activation link to verify your mail address.   ", 'buddyforms' );
				$post_gdpr_template        = __( "By submitting this form you grant us the rights <br> • to store your submitted contents in our database  <br>• to generate a post on our site based on your data  <br>• to make this post publicly accessible  ", 'buddyforms' );
				$contact_gdpr_template     = __( "By submitting these data you agree that we store all the data from the form our server. We may answer you via mail.", 'buddyforms' );
				$templates['registration'] = $registration_gdpr_template;
				$templates['post']		= $post_gdpr_template;
				$templates['contact']  = $contact_gdpr_template;

			}

			foreach ( $templates as $key => $template ) {
				$admin_text_array[ $key ] = $template;
			}

			$back_js_arguments = array(
				'admin_text'     => $admin_text_array,
				'admin_url'      => admin_url( 'admin-ajax.php' ),
				'assets'         => self::frontend_assets(),
				'ajaxnonce'      => wp_create_nonce( 'fac_drop' ),
				'post_type'      => get_post_type(),
				'current_screen' => get_current_screen(),
				'is_admin'       => is_admin(),
				'localize'       => BuddyForms::localize_fields()
			);

			$form_slug  = buddyforms_get_form_slug();
			$bf_post_id = $wp_query->get( 'bf_post_id' );
			if ( ! empty( $form_slug ) && ! empty( $buddyforms ) && isset( $buddyforms[ $form_slug ] ) ) {
				$options                         = buddyforms_filter_frontend_js_form_options( $buddyforms[ $form_slug ], $form_slug, $bf_post_id );
				$back_js_arguments[ $form_slug ] = $options;
			}
			BuddyForms::buddyforms_js_global_set_parameters( $back_js_arguments );

			//Global frontend vars
			wp_localize_script( "buddyforms-admin-js", "buddyformsGlobal", apply_filters( 'buddyforms_global_localize_scripts', BuddyForms::buddyforms_js_global_get_parameters( $form_slug ), $form_slug ) );

			do_action( 'buddyforms_admin_js_css_enqueue' );
		} else {
			wp_localize_script( "buddyforms-admin-all-js", "buddyformsGlobal",
				apply_filters( 'buddyforms_global_localize_scripts', array(
					'admin_url' => admin_url( 'admin-ajax.php' ),
					'ajaxnonce' => wp_create_nonce( 'fac_drop' ),
				), ''
				)
			);
			do_action( 'buddyforms_all_admin_js_css_enqueue' );
		}
	}

	/**
	 * Change the admin footer text on BuddyForms admin pages.
	 *
	 * @param string $footer_text
	 *
	 * @return string
	 * @since  1.6
	 *
	 */
	public function admin_footer_text( $footer_text ) {
		global $post;

		if ( ! current_user_can( 'manage_options' ) ) {
			return $footer_text;
		}

		$current_screen = get_current_screen();

		if ( ! isset( $current_screen->id ) ) {
			return $footer_text;
		}

		if ( $current_screen->id == 'edit-buddyforms'
		     || $current_screen->id == 'buddyforms'
		     || $current_screen->id == 'buddyforms_page_buddyforms_submissions'
		     || $current_screen->id == 'buddyforms_page_buddyforms_settings'
		     || $current_screen->id == 'buddyforms_page_bf_add_ons'
		) {

			// Change the footer text
			$footer_text = sprintf( __( 'If you like <strong>BuddyForms</strong> please leave us a %s&#9733;&#9733;&#9733;&#9733;&#9733;%s rating. A huge thank you from BuddyForms in advance!', 'buddyforms' ), '<a href="https://wordpress.org/support/view/plugin-reviews/buddyforms?filter=5#postform" target="_blank" class="wc-rating-link" data-rated="' . esc_attr__( 'Thanks :)', 'buddyforms' ) . '">', '</a>' );
		}

		return $footer_text;
	}
}
