<?php
/**
 * Smush integration with various plugins: Common class
 *
 * @package Smush\Core\Integrations
 * @since 2.8.0
 *
 * @author Anton Vanyukov <anton@incsub.com>
 *
 * @copyright (c) 2018, Incsub (http://incsub.com)
 */

namespace Smush\Core\Integrations;

use Smush\Core\Modules\Smush;
use WP_Smush;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Singleton class class Common
 *
 * @since 2.8.0
 */
class Common {

	/**
	 * Common constructor.
	 */
	public function __construct() {
		if ( is_admin() ) {
			// AJAX Thumbnail Rebuild integration.
			add_filter( 'wp_smush_media_image', array( $this, 'skip_images' ), 10, 2 );

			// Optimise WP retina 2x images.
			add_action( 'wr2x_retina_file_added', array( $this, 'smush_retina_image' ), 20, 3 );

			// WPML integration.
			add_action( 'wp_smush_image_optimised', array( $this, 'wpml_update_duplicate_meta' ), 10, 3 );

			// Remove any pre_get_posts_filters added by WP Media Folder plugin.
			add_action( 'wp_smush_remove_filters', array( $this, 'remove_filters' ) );
		}

		// ReCaptcha lazy load.
		add_filter( 'smush_skip_iframe_from_lazy_load', array( $this, 'exclude_recaptcha_iframe' ), 10, 2 );

		// Compatibility modules for lazy loading.
		add_filter( 'smush_skip_image_from_lazy_load', array( $this, 'lazy_load_compat' ), 10, 3 );

		// Soliloquy slider CDN support.
		add_filter( 'soliloquy_image_src', array( $this, 'soliloquy_image_src' ) );

		// Translate Press integration.
		add_filter( 'smush_skip_image_from_lazy_load', array( $this, 'trp_translation_editor' ) );

		// Jetpack CDN compatibility.
		add_filter( 'smush_cdn_skip_image', array( $this, 'jetpack_cdn_compat' ), 10, 2 );

		// WP Maintenance Plugin integration.
		add_action( 'template_redirect', array( $this, 'wp_maintenance_mode' ) );
	}

	/**
	 * Remove any pre_get_posts_filters added by WP Media Folder plugin.
	 */
	public function remove_filters() {
		// Remove any filters added b WP media Folder plugin to get the all attachments.
		if ( class_exists( 'Wp_Media_Folder' ) ) {
			global $wp_media_folder;
			if ( is_object( $wp_media_folder ) ) {
				remove_filter( 'pre_get_posts', array( $wp_media_folder, 'wpmf_pre_get_posts1' ) );
				remove_filter( 'pre_get_posts', array( $wp_media_folder, 'wpmf_pre_get_posts' ), 0, 1 );
			}
		}

		global $wpml_query_filter;

		// If WPML is not installed, return.
		if ( ! is_object( $wpml_query_filter ) ) {
			return;
		}

		// Remove language filter and let all the images be smushed at once.
		if ( has_filter( 'posts_join', array( $wpml_query_filter, 'posts_join_filter' ) ) ) {
			remove_filter( 'posts_join', array( $wpml_query_filter, 'posts_join_filter' ), 10, 2 );
			remove_filter( 'posts_where', array( $wpml_query_filter, 'posts_where_filter' ), 10, 2 );
		}
	}

	/**************************************
	 *
	 * AJAX Thumbnail Rebuild
	 *
	 * @since 2.8
	 */

	/**
	 * AJAX Thumbnail Rebuild integration.
	 *
	 * If this is a thumbnail regeneration - only continue for selected thumbs
	 * (no need to regenerate everything else).
	 *
	 * @since 2.8.0
	 *
	 * @param string $smush_image  Image size.
	 * @param string $size_key     Thumbnail size.
	 *
	 * @return bool
	 */
	public function skip_images( $smush_image, $size_key ) {
		if ( empty( $_POST['regen'] ) || ! is_array( $_POST['regen'] ) ) { // Input var ok.
			return $smush_image;
		}

		$smush_sizes = wp_unslash( $_POST['regen'] ); // Input var ok.

		if ( in_array( $size_key, $smush_sizes, true ) ) {
			return $smush_image;
		}

		// Do not regenerate other thumbnails for regenerate action.
		return false;
	}

	/**************************************
	 *
	 * WP Retina 2x
	 */

	/**
	 * Smush Retina images for WP Retina 2x, Update Stats.
	 *
	 * @param int    $id           Attachment ID.
	 * @param string $retina_file  Retina image.
	 * @param string $image_size   Image size.
	 */
	public function smush_retina_image( $id, $retina_file, $image_size ) {
		$smush = WP_Smush::get_instance()->core()->mod->smush;

		// Initialize attachment id and media type.
		$smush->attachment_id = $id;
		$smush->media_type    = 'wp';

		/**
		 * Allows to Enable/Disable WP Retina 2x Integration
		 */
		$smush_retina_images = apply_filters( 'smush_retina_images', true );

		// Check if Smush retina images is enabled.
		if ( ! $smush_retina_images ) {
			return;
		}
		// Check for Empty fields.
		if ( empty( $id ) || empty( $retina_file ) || empty( $image_size ) ) {
			return;
		}

		// Do not smush if auto smush is turned off.
		if ( ! $smush->is_auto_smush_enabled() ) {
			return;
		}

		/**
		 * Allows to skip a image from smushing
		 *
		 * @param bool , Smush image or not
		 * @$size string, Size of image being smushed
		 */
		$smush_image = apply_filters( 'wp_smush_media_image', true, $image_size );
		if ( ! $smush_image ) {
			return;
		}

		$stats = $smush->do_smushit( $retina_file );
		// If we squeezed out something, Update stats.
		if ( ! is_wp_error( $stats ) && ! empty( $stats['data'] ) && isset( $stats['data'] ) && $stats['data']->bytes_saved > 0 ) {
			$image_size = $image_size . '@2x';

			$this->update_smush_stats_single( $id, $stats, $image_size );
		}
	}

	/**
	 * Updates the smush stats for a single image size.
	 *
	 * @param int    $id           Attachment ID.
	 * @param array  $smush_stats  Smush stats.
	 * @param string $image_size   Image size.
	 */
	private function update_smush_stats_single( $id, $smush_stats, $image_size = '' ) {
		// Return, if we don't have image id or stats for it.
		if ( empty( $id ) || empty( $smush_stats ) || empty( $image_size ) ) {
			return;
		}

		$smush = WP_Smush::get_instance()->core()->mod->smush;
		$data  = $smush_stats['data'];
		// Get existing Stats.
		$stats = get_post_meta( $id, Smush::$smushed_meta_key, true );

		// Update existing Stats.
		if ( ! empty( $stats ) ) {
			// Update stats for each size.
			if ( isset( $stats['sizes'] ) ) {
				// if stats for a particular size doesn't exists.
				if ( empty( $stats['sizes'][ $image_size ] ) ) {
					// Update size wise details.
					$stats['sizes'][ $image_size ] = (object) $smush->array_fill_placeholders( $smush->get_size_signature(), (array) $data );
				} else {
					// Update compression percent and bytes saved for each size.
					$stats['sizes'][ $image_size ]->bytes   = $stats['sizes'][ $image_size ]->bytes + $data->bytes_saved;
					$stats['sizes'][ $image_size ]->percent = $stats['sizes'][ $image_size ]->percent + $data->compression;
				}
			}
		} else {
			// Create new stats.
			$stats = array(
				'stats' => array_merge(
					$smush->get_size_signature(),
					array(
						'api_version' => - 1,
						'lossy'       => - 1,
					)
				),
				'sizes' => array(),
			);

			$stats['stats']['api_version'] = $data->api_version;
			$stats['stats']['lossy']       = $data->lossy;
			$stats['stats']['keep_exif']   = ! empty( $data->keep_exif ) ? $data->keep_exif : 0;

			// Update size wise details.
			$stats['sizes'][ $image_size ] = (object) $smush->array_fill_placeholders( $smush->get_size_signature(), (array) $data );
		}

		// Calculate the total compression.
		$stats = WP_Smush::get_instance()->core()->total_compression( $stats );

		update_post_meta( $id, Smush::$smushed_meta_key, $stats );
	}

	/**************************************
	 *
	 * WPML
	 *
	 * @since 3.0
	 */

	/**
	 * Update meta for the duplicated image.
	 *
	 * If WPML is duplicating images, we need to update the meta for the duplicate image as well,
	 * otherwise it will not be found during compression or on the WordPress back/front-ends.
	 *
	 * @since 3.0
	 *
	 * @param int   $id    Attachment ID.
	 * @param array $stats Smushed stats.
	 * @param array $meta  New meta data.
	 */
	public function wpml_update_duplicate_meta( $id, $stats, $meta ) {
		// Continue only if duplication is enabled.
		if ( ! $this->is_wpml_duplicating_images() ) {
			return;
		}

		global $wpdb;

		// Get translated attachments.
		$image_ids = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT element_id FROM {$wpdb->prefix}icl_translations
						WHERE trid IN (
							SELECT trid FROM {$wpdb->prefix}icl_translations WHERE element_id=%d
						) AND element_id!=%d AND element_type='post_attachment'",
				array( $id, $id )
			)
		); // Db call ok; no-cache ok.

		// If images found.
		if ( ! empty( $image_ids ) ) {
			// Get the resize savings.
			$resize = get_post_meta( $id, WP_SMUSH_PREFIX . 'resize_savings' );
			// Update each translations.
			foreach ( $image_ids as $attchment_id ) {
				// Smushed stats.
				update_post_meta( $attchment_id, Smush::$smushed_meta_key, $stats );
				// Resize savings.
				if ( ! empty( $resize ) ) {
					update_post_meta( $attchment_id, WP_SMUSH_PREFIX . 'resize_savings', $resize );
				}
				// Attachment meta data.
				update_post_meta( $attchment_id, '_wp_attachment_metadata', $meta );
			}
		}
	}

	/**
	 * Check if WPML is active and is duplicating images.
	 *
	 * @since 3.0
	 *
	 * @return bool
	 */
	private function is_wpml_duplicating_images() {
		if ( ! class_exists( '\SitePress' ) ) {
			return false;
		}

		$media_settings = get_site_option( '_wpml_media' );

		// Check if WPML media translations are active.
		if ( ! $media_settings || ! isset( $media_settings['new_content_settings']['duplicate_media'] ) ) {
			return false;
		}

		// WPML duplicate existing media for translated content?
		if ( ! $media_settings['new_content_settings']['duplicate_media'] ) {
			return false;
		}

		return true;
	}

	/**
	 * Skip ReCaptcha iframes from lazy loading.
	 *
	 * @since 3.4.2
	 *
	 * @param bool   $skip  Should skip? Default: false.
	 * @param string $src   Iframe url.
	 *
	 * @return bool
	 */
	public function exclude_recaptcha_iframe( $skip, $src ) {
		return false !== strpos( $src, 'recaptcha/api' );
	}

	/**************************************
	 *
	 * Soliloquy slider
	 *
	 * @since 3.6.2
	 */

	/**
	 * Replace slider image links with CDN links.
	 *
	 * @param string $src  Image source.
	 *
	 * @return string
	 */
	public function soliloquy_image_src( $src ) {
		$cdn = WP_Smush::get_instance()->core()->mod->cdn;

		if ( ! $cdn->get_status() || empty( $src ) ) {
			return $src;
		}

		if ( $cdn->is_supported_path( $src ) ) {
			return $cdn->generate_cdn_url( $src );
		}

		return $src;
	}

	/**************************************
	 *
	 * Translate Press
	 *
	 * @since 3.6.3
	 */

	/**
	 * Disables "Lazy Load" on Translate Press translate editor
	 *
	 * @param bool $skip  Should skip? Default: false.
	 *
	 * @return bool
	 */
	public function trp_translation_editor( $skip ) {
		if ( ! class_exists( '\TRP_Translate_Press' ) || ! isset( $_GET['trp-edit-translation'] ) ) {
			return $skip;
		}

		return true;
	}

	/**************************************
	 *
	 * Jetpack
	 *
	 * @since 3.7.1
	 */

	/**
	 * Skips the url from the srcset from our CDN when it's already served by Jetpack's CDN.
	 *
	 * @since 3.7.1
	 *
	 * @param bool   $skip  Should skip? Default: false.
	 * @param string $url Source.
	 *
	 * @return bool
	 */
	public function jetpack_cdn_compat( $skip, $url ) {
		if ( ! class_exists( '\Jetpack' ) ) {
			return $skip;
		}

		if ( method_exists( '\Jetpack', 'is_module_active' ) && ! \Jetpack::is_module_active( 'photon' ) ) {
			return $skip;
		}

		$parsed_url = wp_parse_url( $url );

		// The image already comes from Jetpack's CDN.
		if ( preg_match( '#^i[\d]{1}.wp.com$#i', $parsed_url['host'] ) ) {
			return true;
		}
		return $skip;
	}


	/**************************************
	 *
	 * WP Maintenance Plugin
	 *
	 * @since 3.8.0
	 */

	/**
	 * Disable page parsing when "Maintenance" is enabled
	 *
	 * @since 3.8.0
	 */
	public function wp_maintenance_mode() {
		if ( ! class_exists( '\MTNC' ) ) {
			return;
		}

		global $mt_options;

		if ( ! is_user_logged_in() && ! empty( $mt_options['state'] ) ) {
			add_filter( 'wp_smush_should_skip_parse', '__return_true' );
		}
	}

	/**************************************
	 *
	 * Various modules
	 *
	 * @since 3.5
	 */

	/**
	 * Lazy loading compatibility checks.
	 *
	 * @since 3.5.0
	 *
	 * @param bool   $skip   Should skip? Default: false.
	 * @param string $src    Image url.
	 * @param string $image  Image.
	 *
	 * @return bool
	 */
	public function lazy_load_compat( $skip, $src, $image ) {
		// Avoid conflicts if attributes are set (another plugin, for example).
		if ( false !== strpos( $image, 'data-src' ) ) {
			return true;
		}

		// Compatibility with Essential Grid lazy loading.
		if ( false !== strpos( $image, 'data-lazysrc' ) ) {
			return true;
		}

		// Compatibility with JetPack lazy loading.
		if ( false !== strpos( $image, 'jetpack-lazy-image' ) ) {
			return true;
		}

		return $skip;
	}

}
