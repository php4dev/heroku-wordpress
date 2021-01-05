<?php

if (!defined('ABSPATH')) die('No direct access.');

/**
 * Utility class to handle various image tasks
 */
class MetaSlider_Image {

	/**
	 * Theme instance
	 * 
	 * @var object
	 * @see get_instance()
	 */
	protected static $instance = null;

	/**
	 * Used to access the instance
	 */
	public static function instance() {
		if (null === self::$instance) self::$instance = new self();
		return self::$instance;
	}

	/**
	 * Method to import an image (or more than one). If nothing passed in it will load in a random one from 
	 * the theme directory. A theme can also be defined.
	 * 
	 * @param array  $images   - Images to upload, if any
	 * @param string $theme_id - The folder name of a theme
	 * @return WP_Error|array - The array of ids that were uploaded
	 */
	public function import($images, $theme_id = null) {
		/*
		If we are provided images, they should be formatted already
		It should look like this, possibly without the meta data
		$image[$url] = array(
			'source' => $tmp_name,
			'caption' => '',
			'title' => '',
			'description' => '',
			'alt' => ''
		);
		*/
		if (empty($images)) $images = $this->get_theme_images($theme_id);

		// Get an array or sucessful image ids
		return $this->upload_multiple($images);

	}

	/**
	 * Method to import images from a theme
	 *
	 * @param array $images - The full path to the local image or an array that includes the path
	 */
	public function upload_multiple($images) {

		$successful_uploads = array();
		foreach ($images as $filename => $image) {

			if ($image_id = $this->upload($filename, $image['source'], $image)) {
				array_push($successful_uploads, $image_id);
			}
		}

		return $successful_uploads;
	}

	/**
	 * Method to upload a single image, you should provide a local location on the server
	 *
	 * @param string $filename  - The preferred name of the file
	 * @param string $source    - The current location of the file without the file name
	 * @param array  $meta_data - Extra data like caption, description, etc
	 * @return int|boolean - returns the ID of the new image, or false
	 */
	public function upload($filename, $source, $meta_data = array()) {
		if (!function_exists('media_handle_upload')) {
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			require_once(ABSPATH . 'wp-admin/includes/file.php');
			require_once(ABSPATH . 'wp-admin/includes/media.php');
		}

		if (file_exists($source)) {
			$wp_upload_dir = wp_upload_dir();

			// Create a new filename if needed
			$filename = wp_unique_filename(trailingslashit($wp_upload_dir['path']), $filename);

			// Get the file path of the target destination
			$destination = trailingslashit($wp_upload_dir['path']) . $filename;

			// We want these both to return true
			if (copy($source, $destination)) {
				if ((bool) $image_id = $this->attach_image_to_media_library($destination, $meta_data)) {
					return $image_id;
				}
			}

			// TODO: we might want to provide a specific error message if an image 
			// fails to upload.
			return false;
		}

		// If we make it this far then the file doesn't exit
		return false;
	}

	/**
	 * Adds the type and image id to an array
	 *
	 * @param  int $image_id Image ID
	 * @return array
	 */
	public function make_layer_slide_data($image_id) {
		return array(
			'type' => 'layer',
			'id'   => absint($image_id)
		);
	}

	/**
	 * Method to import images from a theme
	 *
	 * @param array|null $theme_id - The name of a theme
	 * @param int		 $count	   - How many images? (4 for legacy reasons)
	 * @return array - a formatted image array
	 */
	public function get_theme_images($theme_id, $count = 4) {

		// To use local images, the folder must exist
		if (!file_exists($theme_image_directory = METASLIDER_THEMES_PATH . 'images/')) {
			return new WP_Error('images_not_found', __('We could not find any images to import.', 'ml-slider'), array('status' => 404));
		}

		// Check for the manifest, and load theme specific images for a theme (if a theme is set)
		if (!is_null($theme_id) && file_exists(METASLIDER_THEMES_PATH . 'manifest.php')) {
			$themes = (include METASLIDER_THEMES_PATH . 'manifest.php');

			// Check if the theme is available and has images set
			foreach ($themes as $theme) {
				if (!empty($theme['images']) && $theme_id === $theme['folder']) {
					$images = $theme['images'];
				}
			}
		}

        // Get list of images in the folder
		$all_images = array_filter(scandir($theme_image_directory), array($this, 'filter_images'));

        // If images are specified, make sure they exist and use them. if not, use 4 at random
		$images = !empty($images) ? $this->pluck_images($images, $all_images) : array_rand(array_flip($all_images), $count);

		$images_formatted = array();
		foreach ((array) $images as $filedata) {
			$data = array();

			// Only process strings or arrays
			if (!is_string($filedata) && !is_array($filedata)) continue;

			// If a string, convert it to an array with the string as the key (filename)
			if (is_string($filedata)) {
				$data[$filedata] = array();
				$filename = $filedata;
			}

			// If it was an array, the filename needs to become the key
			if (!empty($filedata['filename'])) {
				$filename = $filedata['filename'];
				unset($filedata['filename']);
				$data = $filedata;
			}

			// Set the local images dir as the source
			$data['source'] = trailingslashit($theme_image_directory) . $filename;
			
			/*
			It should look like this, possibly without the meta data
			$images_formatted[$filename] = array(
				'source' => $tmp_name,
				'caption' => '',
				'title' => '',
				'description' => '',
				'alt' => ''
			);
			*/
			$images_formatted[$filename] = $data;
		}

		return $images_formatted;
	}

	/**
     * Method to use filter out non-images
	 * TODO: possible extract this into static method on a utility class
     *
     * @param string $string - a filename scanned from the images dir
	 * @return boolean
     */
	private function filter_images($string) {

		// TODO: allow all image types (this is currently used in the themes folder only)
		return preg_match('/jpg$/i', $string);
	}

	/**
     * Method to use filter out images that might not exist
	 * TODO: possible extract this into static method on a utility class
     *
     * @param array $images_to_use - Images defined in the manifest
     * @param array $images 	   - Images from the images folder
	 * @return array
     */
	private function pluck_images($images_to_use, $images) {

		// For the filename/caption scenario
		if (!empty($images_to_use[0]) && is_array($images_to_use[0])) {

			// Just return the multi-dimentional array and handle the filecheck later
			return $images_to_use;
		}

		// Return the images specified by the filename or four random
		$images_that_exist = array_intersect($images_to_use, $images);
		return (!empty($images_that_exist)) ? $images_that_exist : array_rand(array_flip($images), 4);
	}

	/**
     * Method to add a file to the media library
	 * TODO: possible extract this into static method on a utility class
     *
     * @param string $filename   - The full path to the image dir in the media library
     * @param array  $image_data - Optional data to attach / override to the image
	 * @return int
     */
	private function attach_image_to_media_library($filename, $image_data = array()) {

		$filetype = wp_check_filetype(basename($filename), null);
		$wp_upload_dir = wp_upload_dir();

		$attachment = array(
			'guid'           => $wp_upload_dir['url'] . '/' . basename($filename),
			'post_mime_type' => $filetype['type'],
			'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),
			'post_content'   => '',
			'post_excerpt'   => '',
			'post_status'    => 'publish'
		);

		// Add the caption, title and description if set. This used human-friendly words
		// instead of WP specific to make it more simple for theme developers
		if (!empty($image_data['caption'])) {
			$image_data['post_excerpt'] = $image_data['caption'];
			unset($image_data['caption']);
		}
		if (!empty($image_data['title'])) {
			$image_data['post_title'] = $image_data['title'];
			unset($image_data['title']);
		}
		if (!empty($image_data['description'])) {
			$image_data['post_content'] = $image_data['description'];
			unset($image_data['description']);
		}

		// Merge the theme data with the defaults
		$data = array_merge($attachment, $image_data);

		// Insert the attachment
		$attach_id = wp_insert_attachment($data, $filename);

		// Double check it was an image, delete if not.
		if (!wp_attachment_is_image($attach_id)) {
			wp_delete_post($attach_id, true);
			return false;
		}

		// Generate the metadata for the attachment, and update the database record
		$attach_data = wp_generate_attachment_metadata($attach_id, $filename);
		wp_update_attachment_metadata($attach_id, $attach_data);

		// The theme can set the alt tag too if needed
		if ($attach_id && !empty($image_data['alt'])) {
			update_post_meta($attach_id, '_wp_attachment_image_alt', $image_data['alt']);
		}

		return $attach_id;
	}

	/**
     * Method to get image id from the filename
     *
     * @param array $filenames - It should be the the post_name
	 * @return array
     */
	public static function get_image_ids_from_file_name($filenames) {
		$images = array();
		foreach ($filenames as $filename) {
			$image = get_posts(array(
				'post_type' => 'attachment',
				'name' => $filename,
				'posts_per_page' => 1,
				'post_status' => 'inherit',
			));
			$image = $image ? array_pop($image) : null;

			if (is_null($image)) {
				$images[$filename] = null;
				continue;
			}

			$images[$filename] = array(
				'url' => wp_get_attachment_url($image->ID),
				'thumbnail' => wp_get_attachment_thumb_url($image->ID),
				'id' => $image->ID
			);
		}
		return $images;
	}

}
