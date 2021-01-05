<?php
/**
 * WebP class: WebP
 *
 * @package Smush\Core\Modules
 * @since 3.8.0
 */

namespace Smush\Core\Modules;

use WP_Smush;
use Smush\Core\Helper;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class WebP extends Abstract_Module.
 */
class WebP extends Abstract_Module {

	/**
	 * If server is configured for webp
	 *
	 * @access private
	 * @var bool $is_configured
	 */
	private $is_configured;

	/**
	 * Get the unique name of this module.
	 *
	 * @return string
	 */
	public function get_mod_name() {
		return 'webp';
	}

	/**
	 * Initialize the module.
	 */
	public function init() {
		// Show success message after deleting all webp images.
		add_action( 'wp_smush_header_notices', array( $this, 'maybe_show_notices' ) );
	}

	/**
	 * Enables and disables the WebP module.
	 *
	 * @since 3.8.0
	 *
	 * @param boolean $enable Whether to enable or disable WebP.
	 */
	public function toggle_webp( $enable = true ) {
		$this->settings->set( 'webp_mod', $enable );

		global $wp_filesystem;
		if ( is_null( $wp_filesystem ) ) {
			WP_Filesystem();
		}

		$parsed_udir    = $this->get_upload_dir();
		$flag_file_path = $parsed_udir['webp_path'] . '/disable_smush_webp';

		// Handle the file used as a flag by the server rules.
		if ( $enable ) {
			$wp_filesystem->delete( $flag_file_path, true );
		} else {
			$wp_filesystem->put_contents( $flag_file_path, '' );
		}
	}

	/**
	 * Get status of server configuration for webp.
	 *
	 * @since 3.8.0
	 *
	 * @param bool $force force to recheck.
	 *
	 * @return bool
	 */
	public function is_configured( $force = false ) {
		if ( isset( $this->is_configured ) && ! $force ) {
			return $this->is_configured;
		}

		$this->is_configured = $this->check_server_config();

		return $this->is_configured;
	}

	/**
	 * Check if server is configured to serve webp image.
	 *
	 * @since 3.8.0
	 *
	 * @return bool
	 */
	private function check_server_config() {
		$this->create_test_files();
		$udir       = $this->get_upload_dir();
		$test_image = $udir['upload_url'] . '/smush-webp-test.png';
		$args       = array(
			'headers' => array(
				'Accept' => 'image/webp',
			),
		);

		$response     = wp_remote_get( $test_image, $args );
		$content_type = wp_remote_retrieve_header( $response, 'content-type' );

		return ( 'image/webp' === $content_type );
	}

	/**
	 * Code to use on Nginx servers.
	 *
	 * @param bool $marker whether to wrap code with marker comment lines.
	 * @return string
	 */
	public function get_nginx_code( $marker = true ) {
		$udir = $this->get_upload_dir();

		$base       = trailingslashit( dirname( $udir['upload_rel_path'] ) );
		$directory  = trailingslashit( basename( $udir['upload_rel_path'] ) );
		$regex_base = $base . '(' . $directory . ')';

		$code = 'location ~* "' . str_replace( '/', '\/', $regex_base ) . '(.*.(?:png|jpe?g))" {
  add_header Vary Accept;
  set $image_path $2;
  if (-f "' . $udir['webp_path'] . '/disable_smush_webp") {
    break;
  }
  if ($http_accept !~* "webp") {
    break;
  }
  try_files /' . trailingslashit( $udir['webp_rel_path'] ) . '$image_path.webp $uri =404;
}';

		if ( true === $marker ) {
			$code = $this->marker_line() . "\n" . $code;
			$code = $code . "\n" . $this->marker_line( true );
		}
		return $code;
	}

	/**
	 * Code to use on Apache servers.
	 *
	 * @param bool $marker whether to wrap code with marker comment lines.
	 * @return string
	 */
	public function get_apache_code( $marker = false ) {
		$udir = $this->get_upload_dir();

		$code = '<IfModule mod_rewrite.c>
 RewriteEngine On
 RewriteCond %{DOCUMENT_ROOT}/' . $udir['webp_rel_path'] . '/disable_smush_webp !-f
 RewriteCond %{HTTP_ACCEPT} image/webp
 RewriteCond %{REQUEST_FILENAME} -f
 RewriteCond %{DOCUMENT_ROOT}/' . $udir['webp_rel_path'] . '/$1.$2.webp -f
 RewriteRule ^/?(.+)\.(jpe?g|png)$ /' . $udir['webp_rel_path'] . '/$1.$2.webp [NC,T=image/webp,E=WEBP_image]
</IfModule>

<IfModule mod_headers.c>
 Header append Vary Accept env=WEBP_image
</IfModule>

<IfModule mod_mime.c>
 AddType image/webp .webp
</IfModule>';

		if ( true === $marker ) {
			$code = $this->marker_line() . "\n" . $code;
			$code = $code . "\n" . $this->marker_line( true );
		}
		return $code;
	}

	/**
	 * Retrieves uploads directory and WebP directory information.
	 * All paths and urls do not have trailing slash.
	 *
	 * @return array
	 */
	public function get_upload_dir() {
		static $upload_dir_info;
		if ( isset( $upload_dir_info ) ) {
			return $upload_dir_info;
		}

		if ( ! is_multisite() || is_main_site() ) {
			$upload = wp_upload_dir();
		} else {
			// Use the main site's upload directory for all subsite's webp converted images.
			// This makes it easier to have a single rule on the server configs for serving webp in mu.
			$blog_id = get_main_site_id();
			switch_to_blog( $blog_id );
			$upload = wp_upload_dir();
			restore_current_blog();
		}

		$uplood_rel_path = substr( $upload['basedir'], strlen( ABSPATH ) );
		$webp_rel_path   = substr( dirname( $upload['basedir'] ), strlen( ABSPATH ) ) . '/smush-webp';

		$upload_dir_info = array(
			'upload_path'     => $upload['basedir'],
			'upload_rel_path' => $uplood_rel_path,
			'upload_url'      => $upload['baseurl'],
			'webp_path'       => dirname( $upload['basedir'] ) . '/smush-webp',
			'webp_rel_path'   => $webp_rel_path,
			'webp_url'        => dirname( $upload['baseurl'] ) . '/smush-webp',
		);

		return $upload_dir_info;
	}

	/**
	 * Create test files and required directory.
	 */
	public function create_test_files() {
		$udir           = $this->get_upload_dir();
		$test_png_file  = $udir['upload_path'] . '/smush-webp-test.png';
		$test_webp_file = $udir['webp_path'] . '/smush-webp-test.png.webp';

		if ( ! file_exists( $test_png_file ) ) {
			copy( WP_SMUSH_DIR . 'app/assets/images/smush-webp-test.png', $test_png_file );
		}

		if ( ! file_exists( $test_webp_file ) ) {
			// Check and create webp_path.
			if ( ! is_dir( $udir['webp_path'] ) ) {
				wp_mkdir_p( $udir['webp_path'] );
			}
			copy( WP_SMUSH_DIR . 'app/assets/images/smush-webp-test.png.webp', $test_webp_file );
		}
	}

	/**
	 * Retrieves related webp image file path for a given non webp image file path.
	 * Also create required directories for webp image if not exists.
	 *
	 * @param string $file_path  Non webp image file path.
	 * @param bool   $make       Weather to create required directories.
	 *
	 * @return string
	 */
	public function get_webp_file_path( $file_path, $make = false ) {
		$udir = $this->get_upload_dir();

		$file_rel_path  = substr( $file_path, strlen( $udir['upload_path'] ) );
		$webp_file_path = $udir['webp_path'] . $file_rel_path . '.webp';

		if ( $make ) {
			$webp_file_dir = dirname( $webp_file_path );
			if ( ! is_dir( $webp_file_dir ) ) {
				wp_mkdir_p( $webp_file_dir );
			}
		}

		return $webp_file_path;
	}

	/**
	 * Check whether the given attachment id or mime type can be converted to WebP.
	 *
	 * @param string $id   Atachment ID.
	 * @param string $mime Mime type.
	 *
	 * @return bool
	 */
	private function can_be_converted( $id = '', $mime = '' ) {
		if ( empty( $id ) && empty( $mime ) ) {
			return false;
		}

		$mime = empty( $mime ) ? get_post_mime_type( $id ) : $mime;

		// This image can not be converted to webp.
		if ( ! ( 'image/jpeg' === $mime || 'image/png' === $mime ) ) {
			return false;
		}
		return true;
	}

	/**
	 * Checks whether an attachment should be converted to WebP.
	 * Returns false if WebP isn't configured, the attachment was already converted,
	 * or if the attachment can't be converted ( @see self::can_be_converted() ).
	 *
	 * @since 3.8.0
	 *
	 * @param string $id Attachment ID.
	 *
	 * @return bool
	 */
	public function should_be_converted( $id ) {
		// Avoid conversion when webp disabled, or when Smush is Free.
		if ( ! $this->settings->get( 'webp_mod' ) || ! WP_Smush::is_pro() ) {
			return false;
		}

		$meta      = get_post_meta( $id, Smush::$smushed_meta_key, true );
		$webp_udir = $this->get_upload_dir();

		// The image was already converted to WebP.
		if ( ! empty( $meta['webp_flag'] ) && file_exists( $webp_udir['webp_path'] . '/' . $meta['webp_flag'] ) ) {
			return false;
		}

		return $this->can_be_converted( $id );
	}

	/**
	 * Deletes all the webp files when an attachment is deleted
	 * Update Smush::$smushed_meta_key meta ( optional )
	 * Used in Smush::delete_images() and Backup::restore_image()
	 *
	 * @since 3.8.0
	 *
	 * @param int    $image_id  Attachment ID.
	 * @param bool   $update_meta Whether to update meta or not.
	 * @param string $main_file Main file to replace the one retrieved via the $id.
	 *                          Useful for deleting webp images after PNG to JPG conversion.
	 */
	public function delete_images( $image_id, $update_meta = true, $main_file = '' ) {
		$meta = wp_get_attachment_metadata( $image_id );

		// File path for original image.
		if ( empty( $main_file ) ) {
			$main_file = Helper::get_attached_file( $image_id );
		}

		// Not a supported image? Exit.
		if ( ! in_array( strtolower( pathinfo( $main_file, PATHINFO_EXTENSION ) ), array( 'gif', 'jpg', 'jpeg', 'png' ), true ) ) {
			return;
		}

		$main_file_webp = $this->get_webp_file_path( $main_file );

		$dir_path = dirname( $main_file_webp );

		if ( file_exists( $main_file_webp ) ) {
			unlink( $main_file_webp );
		}

		if ( ! empty( $meta['sizes'] ) ) {
			foreach ( $meta['sizes'] as $size_key => $size_data ) {
				$size_file = path_join( $dir_path, $size_data['file'] );
				if ( file_exists( $size_file . '.webp' ) ) {
					unlink( $size_file . '.webp' );
				}
			}
		}

		if ( $update_meta ) {
			$smushed_meta_key = Smush::$smushed_meta_key;
			$stats            = get_post_meta( $image_id, $smushed_meta_key, true );
			if ( ! empty( $stats ) && is_array( $stats ) ) {
				unset( $stats['webp_flag'] );
				update_post_meta( $image_id, $smushed_meta_key, $stats );
			}
		}
	}

	/**
	 * Deletes all webp images for the whole network or the current subsite.
	 * It deletes the whole smush-webp directory when it's a single install
	 * or a MU called from the network admin (and the current_user_can( manage_network )).
	 *
	 * @since 3.8.0
	 */
	public function delete_all() {
		global $wp_filesystem;
		if ( is_null( $wp_filesystem ) ) {
			WP_Filesystem();
		}

		$parsed_udir = $this->get_upload_dir();

		// Delete the whole webp directory only when on single install or network admin.
		$wp_filesystem->delete( $parsed_udir['webp_path'], true );
	}

	/**
	 * Renders the notice after deleting all webp images.
	 *
	 * @since 3.8.0
	 *
	 * @param string $tab  Smush tab name.
	 */
	public function maybe_show_notices( $tab ) {
		// Show only on WebP page.
		if ( ! isset( $tab ) || 'webp' !== $tab ) {
			return;
		}

		// Show only when there are images in the library, except on mu, where the count is always 0.
		if ( ! is_multisite() && 0 === WP_Smush::get_instance()->core()->total_count ) {
			return;
		}

		$show_message = filter_input( INPUT_GET, 'notice', FILTER_SANITIZE_STRING );
		// Success notice after deleting all WebP images.
		if ( 'webp-deleted' === $show_message ) {
			$message = __( 'WebP files were deleted successfully.', 'wp-smushit' );
			echo '<div role="alert" id="wp-smush-webp-delete-all-notice" data-message="' . esc_attr( $message ) . '" class="sui-notice" aria-live="assertive"></div>';
		}

		// Notice pointing Bulk Smush tool to convert images to webp.
		if ( $this->settings->get( 'webp_mod' ) && 'webp-toggled' === $show_message ) {
			$message = sprintf(
				/* translators: %1$s - opening link tag, %2$s - </a> */
				esc_html__( 'Use the %1$sBulk Smush%2$s tool to convert all the images in your media library to WebP format. ', 'wp-smushit' ),
				! is_multisite() ? '<a href="' . network_admin_url( 'admin.php?page=smush' ) . '">' : '',
				! is_multisite() ? '</a>' : ''
			);

			if ( ! is_multisite() ) {
				if ( ! $this->settings->get( 'auto' ) ) {
					$message .= sprintf(
						/* translators: %1$s - opening link tag, %2$s - </a> */
						esc_html__( 'You can also enable %3$sAutomatic Compression%2$s to convert newly uploaded image files automatically going forward.', 'wp-smushit' ),
						'<a href="' . network_admin_url( 'admin.php?page=smush' ) . '">',
						'</a>',
						'<a href="' . network_admin_url( 'admin.php?page=smush' ) . '#column-wp-smush-bulk">'
					);
				} else {
					$message .= __( 'Newly uploaded images will be automatically converted to WebP format.', 'wp-smushit' );
				}
			}

			echo '<div role="alert" id="wp-smush-webp-instructions-notice" data-message="' . esc_attr( $message ) . '" class="sui-notice" aria-live="assertive"></div>';
		}
	}

	/*
	 * Server related methods.
	 */

	/**
	 * Get the server code snippet
	 *
	 * @param string $server Server name (nginx,apache...).
	 * @param array  $args optional value to pass to the user function.
	 *
	 * @return string
	 */
	private function get_server_code_snippet( $server, $args = array() ) {
		$method = 'get_' . str_replace( array( '-', ' ' ), '', strtolower( $server ) ) . '_code';
		if ( ! method_exists( $this, $method ) ) {
			return '';
		}

		return call_user_func_array( array( $this, $method ), array( $args ) );
	}

	/**
	 * Return the server type (Apache, NGINX...)
	 *
	 * @return string Server type
	 */
	public static function get_server_type() {
		global $is_apache, $is_IIS, $is_iis7, $is_nginx;

		$type = '';

		if ( $is_apache ) {
			// It's a common configuration to use nginx in front of Apache.
			// Let's make sure that this server is Apache.
			$response = wp_remote_get( home_url() );

			if ( is_wp_error( $response ) ) {
				// Bad luck.
				$type = 'apache';
			} else {
				$server = strtolower( wp_remote_retrieve_header( $response, 'server' ) );
				// Could be LiteSpeed too.
				$type = strpos( $server, 'nginx' ) !== false ? 'nginx' : 'apache';
			}
		} elseif ( $is_nginx ) {
			$type = 'nginx';
		} elseif ( $is_IIS ) {
			$type = 'IIS';
		} elseif ( $is_iis7 ) {
			$type = 'IIS 7';
		}

		return $type;
	}

	/**
	 * Get a list of server types
	 *
	 * @return array
	 */
	public function get_servers() {
		return array(
			'apache'     => 'Apache / LiteSpeed',
			'nginx'      => 'NGINX',
			'iis'        => 'IIS',
			'cloudflare' => 'Cloudflare',
		);
	}

	/**
	 * Get code snippet for a module and server type
	 *
	 * @param string $server_type Server type (nginx, apache...).
	 * @param array  $args optional value.
	 *
	 * @return string Code snippet
	 */
	private function get_code_snippet( $server_type = '', $args = array() ) {
		$module_name = $this->get_mod_name();

		if ( ! $server_type ) {
			$server_type = $this->get_server_type();
		}
		$code_snippet = $this->get_server_code_snippet( $server_type, $args );
		return apply_filters( 'smush_code_snippet', $code_snippet, $server_type, $module_name );
	}


	/**
	 * Get path of .htaccess file located in site root directory.
	 *
	 * @return string;
	 */
	private function htaccess_file() {
		if ( ! function_exists( 'wp_upload_dir' ) ) {
			require_once ABSPATH . 'wp-includes/functions.php';
		}

		$uploads = wp_upload_dir();

		return $uploads['basedir'] . '/.htaccess';
	}

	/**
	 * Check if .htaccess is writable.
	 *
	 * @return bool
	 */
	private function is_htaccess_writable() {
		$file      = $this->htaccess_file();
		$home_path = get_home_path();
		return ( ! file_exists( $file ) && is_writable( $home_path ) ) || is_writable( $file );
	}

	/**
	 * Get unique string to use at marker comment line in .htaccess or nginx config file.
	 *
	 * @return string
	 */
	private function marker_suffix() {
		return 'SMUSH-' . strtoupper( $this->get_mod_name() );
	}

	/**
	 * Get unique string to use as marker comment line in .htaccess or nginx config file.
	 *
	 * @param bool $end whether to use marker after end of the config code.
	 * @return string
	 */
	private function marker_line( $end = false ) {
		if ( true === $end ) {
			return '# END ' . $this->marker_suffix();
		} else {
			return '# BEGIN ' . $this->marker_suffix();
		}
	}

	/**
	 * Check if .htaccess has rules for this module in place.
	 *
	 * @return bool
	 */
	public function is_htaccess_written() {
		$file = $this->htaccess_file();

		if ( ! function_exists( 'extract_from_markers' ) ) {
			require_once ABSPATH . 'wp-admin/includes/misc.php';
		}

		$existing_rules = array_filter( extract_from_markers( $file, $this->marker_suffix() ) );
		return ! empty( $existing_rules );
	}

	/**
	 * Add rules .htaccess file.
	 *
	 * @since 3.8.0
	 *
	 * @return bool|string True on success. String with the error message on failure.
	 */
	public function save_htaccess() {
		if ( $this->is_htaccess_written() ) {
			return esc_html__( 'The .htaccess file already contains the WebP rules from Smush.', 'wp-smushit' );
		}

		$cannot_write_message = sprintf(
			/* translators: 1. opening 'a' tag to premium support, 2. closing 'a' tag. */
			esc_html__( 'We tried to apply the .htaccess rules automatically but we were unable to complete this action. Make sure the file permissions on your .htaccess file are set to 644, or switch to manual mode and apply the rules yourself. If you need further assistance, you can %1$scontact support%2$s for help.', 'wp-smushit' ),
			'<a href="https://premium.wpmudev.org/hub/support/#get-support" target="_blank">',
			'</a>'
		);
		if ( ! $this->is_htaccess_writable() ) {
			return $cannot_write_message;
		}

		$code             = $this->get_code_snippet( 'apache' );
		$code             = explode( "\n", $code );
		$file             = $this->htaccess_file();
		$markers_inserted = insert_with_markers( $file, $this->marker_suffix(), $code );

		if ( ! $markers_inserted ) {
			return $cannot_write_message;
		}
		return true;
	}

	/**
	 * Remove rules from .htaccess file.
	 *
	 * @since 3.8.0
	 *
	 * @return bool|string True on success. String with the error message on failure.
	 */
	public function unsave_htaccess() {
		if ( ! $this->is_htaccess_written() ) {
			return esc_html__( "The .htaccess file doesn't contain the WebP rules from Smush.", 'wp-smushit' );
		}

		$cannot_write_message = esc_html__( 'We were unable to automatically remove the rules. We recommend trying to remove the rules manually. If you don’t have access to the .htaccess file to remove it manually, please consult with your hosting provider to change the configuration on the server.', 'wp-smushit' );
		if ( ! $this->is_htaccess_writable() ) {
			return $cannot_write_message;
		}

		$file             = $this->htaccess_file();
		$markers_inserted = insert_with_markers( $file, $this->marker_suffix(), '' );

		if ( ! $markers_inserted ) {
			return $cannot_write_message;
		}
		return true;
	}
}
