<?php
/**
 * Plugin Name: Tuxedo Big File Uploads
 * Plugin URI:  https://github.com/andtrev/Tuxedo-Big-File-Uploads
 * Description: Enables large file uploads in the built-in WordPress media uploader.
 * Version:     1.2
 * Author:      Trevor Anderson
 * Author URI:  https://github.com/andtrev
 * License:     GPLv2 or later
 * Domain Path: /languages
 * Text Domain: tuxedo-big-file-uploads
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * 
 * @package TuxedoBigFileUploads
 * @version 1.2.0
 */

/**
 * Tuxedo Big File Uploads manager class.
 *
 * Bootstraps the plugin by hooking into plupload defaults and
 * media settings.
 *
 * @since 1.0.0
 */
class TuxedoBigFileUploads {

	/**
	 * TuxedoBigFileUploads instance.
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var TuxedoBigFileUploads
	 */
	private static $instance = false;

	/**
	 * Get the instance.
	 * 
	 * Returns the current instance, creates one if it
	 * doesn't exist. Ensures only one instance of
	 * TuxedoBigFileUploads is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 *
	 * @return TuxedoBigFileUploads
	 */
	public static function get_instance() {

		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;

	}

	/**
	 * Constructor.
	 * 
	 * Initializes and adds functions to filter and action hooks.
	 * 
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_filter( 'plupload_init', array( $this, 'filter_plupload_settings' ) );
		add_filter( 'upload_post_params', array( $this, 'filter_plupload_params' ) );
		add_filter( 'plupload_default_settings', array( $this, 'filter_plupload_settings' ) );
		add_filter( 'plupload_default_params', array( $this, 'filter_plupload_params' ) );
		add_filter( 'upload_size_limit', array( $this, 'filter_upload_size_limit' ) );
		add_action( 'admin_init', array( $this, 'settings_api_init' ) );
		add_action( 'wp_ajax_tux_big_file_uploads', array( $this, 'ajax_chunk_receiver' ) );

	}

	/**
	 * Filter plupload params.
	 * 
	 * @since 1.2.0
	 */
	public function filter_plupload_params( $plupload_params ) {

		$plupload_params['action'] = 'tux_big_file_uploads';
		return $plupload_params;

	}

	/**
	 * Filter plupload settings.
	 * 
	 * @since 1.0.0
	 */
	public function filter_plupload_settings( $plupload_settings ) {

		$tuxbfu_chunk_size = intval( get_option( 'tuxbfu_chunk_size', 512 ) );
		if ( $tuxbfu_chunk_size < 1 ) {
			$tuxbfu_chunk_size = 512;
		}
		$tuxbfu_max_retries = intval( get_option( 'tuxbfu_max_retries', 5 ) );
		if ( $tuxbfu_max_retries < 1 ) {
			$tuxbfu_max_retries = 5;
		}
		$plupload_settings['url'] = admin_url( 'admin-ajax.php' );
		$plupload_settings['filters']['max_file_size'] = $this->filter_upload_size_limit('') . 'b';
		$plupload_settings['chunk_size'] = $tuxbfu_chunk_size . 'kb';
		$plupload_settings['max_retries'] = $tuxbfu_max_retries;
		return $plupload_settings;

	}

	/**
	 * Load Localisation files.
	 * 
	 * @since 1.0.0
	 */
	public function load_textdomain() {

		$domain = 'tuxedo-big-file-uploads';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

	/**
	 * Return max upload size.
	 * 
	 * Free space of temp directory.
	 * 
	 * @since 1.0.0
	 * 
	 * @return float $bytes Free disk space in bytes.
	 */
	public function filter_upload_size_limit( $unused ) {

		$tuxbfu_max_upload_size = intval( get_option( 'tuxbfu_max_upload_size', 0 ) ) * 1048576;
		if ( $tuxbfu_max_upload_size < 0 ) {
			$tuxbfu_max_upload_size = 0;
		}

		if ( $tuxbfu_max_upload_size > 0 ) {
			return $tuxbfu_max_upload_size;
		} 

		$bytes = disk_free_space( sys_get_temp_dir() );
		if ( $bytes === false ) {
			$bytes = 0;
		}
		return $bytes;

	}

	/**
	 * Initialize settings api.
	 * 
	 * Registers settings and setting fields.
	 * 
	 * @since 1.0.0
	 */
	public function settings_api_init() {

		add_settings_field(
			'tuxbfu_max_upload_size',
			__( 'Maximum Upload Size (MB) (0 for no limit)', 'tuxedo-big-file-uploads' ),
			array( $this, 'settings_max_upload_size_callback' ),
			'media',
			'uploads'
		);
		add_settings_field(
			'tuxbfu_chunk_size',
			__( 'Chunk Size (kb)', 'tuxedo-big-file-uploads' ),
			array( $this, 'settings_chunk_size_callback' ),
			'media',
			'uploads'
		);
		add_settings_field(
			'tuxbfu_max_retries',
			__( 'Max Retries', 'tuxedo-big-file-uploads' ),
			array( $this, 'settings_max_retries_callback' ),
			'media',
			'uploads'
		);
		register_setting( 'media', 'tuxbfu_max_upload_size', 'intval' );
		register_setting( 'media', 'tuxbfu_chunk_size', 'intval' );
		register_setting( 'media', 'tuxbfu_max_retries', 'intval' );

	}

	/**
	 * Output max upload size input control.
	 * 
	 * @since 1.2.0
	 */
	public function settings_max_upload_size_callback() {

		$tuxbfu_max_upload_size = intval( get_option( 'tuxbfu_max_upload_size', 0 ) );
		if ( $tuxbfu_max_upload_size < 0 ) {
			$tuxbfu_max_upload_size = 0;
		}
		$tuxbfu_max_upload_size = esc_attr( $tuxbfu_max_upload_size );
		echo "<input type='text' name='tuxbfu_max_upload_size' value='{$tuxbfu_max_upload_size}' />";

	}

	/**
	 * Output chunk size input control.
	 * 
	 * @since 1.0.0
	 */
	public function settings_chunk_size_callback() {

		$tuxbfu_chunk_size = intval( get_option( 'tuxbfu_chunk_size', 512 ) );
		if ( $tuxbfu_chunk_size < 1 ) {
			$tuxbfu_chunk_size = 512;
		}
		$tuxbfu_chunk_size = esc_attr( $tuxbfu_chunk_size );
		echo "<input type='text' name='tuxbfu_chunk_size' value='{$tuxbfu_chunk_size}' />";

	}

	/**
	 * Output max retries input control.
	 * 
	 * @since 1.0.0
	 */
	public function settings_max_retries_callback() {

		$tuxbfu_max_retries = intval( get_option( 'tuxbfu_max_retries', 5 ) );
		if ( $tuxbfu_max_retries < 1 ) {
			$tuxbfu_max_retries = 5;
		}
		$tuxbfu_max_retries = esc_attr( $tuxbfu_max_retries );
		echo "<input type='text' name='tuxbfu_max_retries' value='{$tuxbfu_max_retries}' />";

	}

	/**
	 * Return a file's mime type. 
	 * 
	 * @since 1.2.0
	 * 
	 * @param string $filename File name.
	 * @return var string $mimetype Mime type.
	 */
	public function get_mime_content_type( $filename ) {

		if ( function_exists( 'mime_content_type' ) ) {
			return mime_content_type( $filename );
		}

		if ( function_exists( 'finfo_open' ) ) {
			$finfo = finfo_open( FILEINFO_MIME );
			$mimetype = finfo_file( $finfo, $filename );
			finfo_close( $finfo );
			return $mimetype;
		} else {
			ob_start();
			system( 'file -i -b ' . $filename );
			$output = ob_get_clean();
			$output = explode( '; ', $output );
			if ( is_array( $output ) ) {
				$output = $output[0];
			}
			return $output;
		}

	}

	/**
	 * AJAX chunk receiver.
	 * Ajax callback for plupload to handle chunked uploads.
	 * Based on code by Davit Barbakadze
	 * https://gist.github.com/jayarjo/5846636
	 * 
	 * @since 1.2.0
	 */
	public function ajax_chunk_receiver() {

		/** Check that we have an upload and there are no errors. */
		if ( empty( $_FILES ) || $_FILES['async-upload']['error'] ) {
			/** Failed to move uploaded file. */
			die();
		}

		/** Authenticate user. */
		if ( ! is_user_logged_in() || ! current_user_can( 'upload_files' ) ) {
			die();
		}
		check_admin_referer( 'media-form' );

		/** Check and get file chunks. */
		$chunk = isset( $_REQUEST['chunk']) ? intval( $_REQUEST['chunk'] ) : 0;
		$chunks = isset( $_REQUEST['chunks']) ? intval( $_REQUEST['chunks'] ) : 0;

		/** Get file name and path + name. */
		$fileName = isset( $_REQUEST['name'] ) ? $_REQUEST['name'] : $_FILES['async-upload']['name'];
		$filePath = dirname( $_FILES['async-upload']['tmp_name'] ) . '/' . md5( $fileName );

		$tuxbfu_max_upload_size = intval( get_option( 'tuxbfu_max_upload_size', 0 ) * 1048576 );
		if ( $tuxbfu_max_upload_size < 0 ) {
			$tuxbfu_max_upload_size = 0;
		}

		if ( $tuxbfu_max_upload_size > 0 && file_exists( "{$filePath}.part" ) && filesize( "{$filePath}.part" ) + filesize( $_FILES['async-upload']['tmp_name'] ) > $tuxbfu_max_upload_size ) {

			if ( ! $chunks || $chunk == $chunks - 1 ) {
				@unlink( "{$filePath}.part" );

				if ( ! isset( $_REQUEST['short'] ) || ! isset( $_REQUEST['type'] ) ) {

					echo wp_json_encode( array(
						'success' => false,
						'data'    => array(
							'message'  => __( 'The file size has exceeded the maximum file size setting.', 'tuxed-big-file-uploads' ),
							'filename' => $_FILES['async-upload']['name'],
						)
					) );
					wp_die();

				} else {

					echo '<div class="error-div error">
					<a class="dismiss" href="#" onclick="jQuery(this).parents(\'div.media-item\').slideUp(200, function(){jQuery(this).remove();});">' . __( 'Dismiss' ) . '</a>
					<strong>' . sprintf( __( '&#8220;%s&#8221; has failed to upload.' ), esc_html( $_FILES['async-upload']['name'] ) ) . '<br />' . __( 'The file size has exceeded the maximum file size setting.', 'tuxed-big-file-uploads' ) . '</strong><br />' .
					esc_html( $id->get_error_message() ) . '</div>';

				}

			}

			die();

		}

		/** Open temp file. */
		$out = @fopen( "{$filePath}.part", $chunk == 0 ? 'wb' : 'ab' );
		if ( $out ) {

			/** Read binary input stream and append it to temp file. */
			$in = @fopen( $_FILES['async-upload']['tmp_name'], 'rb' );

			if ( $in ) {
				while ( $buff = fread( $in, 4096 ) ) {
					fwrite( $out, $buff );
				}
			} else {
				/** Failed to open input stream. */
				/** Attempt to clean up unfinished output. */
				@fclose( $out );
				@unlink( "{$filePath}.part" );
				die();
			}

			@fclose( $in );
			@fclose( $out );

			@unlink( $_FILES['async-upload']['tmp_name'] );

		} else {
			/** Failed to open output stream. */
			die();
		}

		/** Check if file has finished uploading all parts. */
		if ( ! $chunks || $chunk == $chunks - 1 ) {

			/** Recreate upload in $_FILES global and pass off to WordPress. */
			rename( "{$filePath}.part", $_FILES['async-upload']['tmp_name'] );
			$_FILES['async-upload']['name'] = $fileName;
			$_FILES['async-upload']['size'] = filesize( $_FILES['async-upload']['tmp_name'] );
			$_FILES['async-upload']['type'] = $this->get_mime_content_type( $_FILES['async-upload']['tmp_name'] );
			header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );

			if ( ! isset( $_REQUEST['short'] ) || ! isset( $_REQUEST['type'] ) ) {

				send_nosniff_header();
				nocache_headers();
				wp_ajax_upload_attachment();
				die( '0' );

			} else {

				$post_id = 0;
				if ( isset( $_REQUEST['post_id'] ) ) {
					$post_id = absint( $_REQUEST['post_id'] );
					if ( ! get_post( $post_id ) || ! current_user_can( 'edit_post', $post_id ) )
						$post_id = 0;
				}

				$id = media_handle_upload( 'async-upload', $post_id );
				if ( is_wp_error( $id ) ) {
					echo '<div class="error-div error">
					<a class="dismiss" href="#" onclick="jQuery(this).parents(\'div.media-item\').slideUp(200, function(){jQuery(this).remove();});">' . __( 'Dismiss' ) . '</a>
					<strong>' . sprintf( __( '&#8220;%s&#8221; has failed to upload.' ), esc_html( $_FILES['async-upload']['name'] ) ) . '</strong><br />' .
					esc_html( $id->get_error_message() ) . '</div>';
					exit;
				}

				if ( isset( $_REQUEST['short'] ) && $_REQUEST['short'] ) {
					// Short form response - attachment ID only.
					echo $id;
				} elseif ( isset( $_REQUEST['type'] ) ) {
					// Long form response - big chunk o html.
					$type = $_REQUEST['type'];

					/**
					 * Filter the returned ID of an uploaded attachment.
					 *
					 * The dynamic portion of the hook name, `$type`, refers to the attachment type,
					 * such as 'image', 'audio', 'video', 'file', etc.
					 *
					 * @since 1.2.0
					 *
					 * @param int $id Uploaded attachment ID.
					 */
					echo apply_filters( "async_upload_{$type}", $id );
				}

			}

		}

		die();

	}

}

/** Instantiate the plugin class. */
$tux_big_file_uploads = TuxedoBigFileUploads::get_instance();