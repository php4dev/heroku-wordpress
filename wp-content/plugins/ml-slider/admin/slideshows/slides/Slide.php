<?php

if (!defined('ABSPATH')) die('No direct access.');

/** 
 * Class to handle individual slides
 */
class MetaSlider_Slide {
	
	/**
	 * The id of the current slide
	 * 
	 * @var string|int
	 */
    public $slide_id;
	
	/**
	 * The id of the slideshow 
	 * 
	 * @var string|int
	 */
    public $slideshow_id;
	
	/**
	 * The data used to update the slide
	 * 
	 * @var array
	 */
    public $slide_data = array();

	/**
	 * Slide instance
	 * 
	 * @var object
	 * @see get_instance()
	 */
	protected static $instance = null;

	/**
	 * The slide type
	 * 
	 * @var string
	 */
	public static $slide_type = 'image';

	/**
	 * Since WP doesn't throw exceptions
	 * 
	 * @see __call
	 * @var WP_Error
	 */
	public $error;

	/**
	 * Constructor
	 * 
	 * @param mixed $slideshow_id - ID of the slideshow
	 * @param mixed $slide_id 	  - An id of a slide or 
	 */
	public function __construct($slideshow_id = null, $slide_id = null) {

		// This requires a slideshow id
		if ('ml-slider' !== get_post_type($slideshow_id)) {
			$this->error = new WP_Error('slide_init_failed', 'Creating a slide requires a slideshow ID');
			wp_die($this->error);
		}

		$this->slideshow_id = $slideshow_id;
		$this->slide_id = $slide_id;
	}

    /**
	 * Used to update the modified date of the slideshow parent post type
	 * 
	 * @return null
	 */
	public function __destruct() {
		if ($this->slideshow_id) {
			wp_update_post(array('ID' => $this->slideshow_id));
		}
	}

    /**
	 * Used to access the instance
	 * 
	 * @param mixed $slideshow_id - ID of the slideshow
	 * @return MetaSlider_Slide
	 */
	public static function get_instance($slideshow_id = null) {
		if (null === self::$instance) self::$instance = new self($slideshow_id);
		return self::$instance;
	}

	/**
	 * Exit if there's a WP_Error
	 * 
	 * @param string $name 		- The name of the method being called
	 * @param array  $arguments - An enumerated array containing the parameters passed to the $name'ed method
	 */
	public function __call($name, $arguments) {
		if (is_wp_error($this->error)) {
			wp_die($this->error);
		}
	}

	/**
	 * Method to create a single slide. This isn't currently being used.
	 * 
	 * @return self
	 */
	public function create_empty_slide() {
		// TODO: Refactor everywhere to have a better post_title
		$return = wp_insert_post(
			array(
				'post_title' => "Slider {$this->slideshow_id} - {$this->type}",
				'post_status' => 'publish',
				'post_type' => 'ml-slide'
			)
		);

		if (is_wp_error($return)) {
			$this->error = $return;
			return $this;
		}

		$this->slide_id = $return->ID;
		
		// Set some defaults for the image slide
		update_post_meta($this->slide_id, 'ml-slider_type', $this->type);
		update_post_meta($this->slide_id, 'ml-slider_inherit_image_title', true);
		update_post_meta($this->slide_id, 'ml-slider_inherit_image_alt', true);
		
        return $this;
	}

	/**
	 * Method to create a single slide
	 * 
	 * @param array $data - Optional data that builds the slide
	 * @return self
	 */
	public function create_slide($data = null) {
		if (is_null($this->slide_data)) {
            $this->error = new WP_Error('slide_create_failed', 'Creating a slide requires image data to be set');
			return $this;
		}

		if (!class_exists('MetaImageSlide')) {
			require_once(METASLIDER_PATH . 'inc/slide/metaslide.image.class.php');
		}

		// TODO: Uses the previously existing class to create the slide (refactor this)
		$slide = new MetaImageSlide();
		$slide_data = $slide->add_slide(
			$this->slideshow_id, $this->slide_data
		);

		if (is_wp_error($slide_data)) {
			$this->error = $slide_data;
			return $this;
		}

		$this->slide_id = $slide_data['slide_id'];

		// If there were errors creating the slide, we can still attempt to crop
		$slide->resize_slide($this->slide_id, $this->slideshow_id);

		return $this;
	}

	/**
	 * Method to update a single slide, right now just the image.
	 * 
	 * @param array $data - The data for the slide including the image id
	 * @return self
	 */
	public function update($data = null) {
		if (is_null($data) && is_null($this->slide_data)) {
			wp_die(new WP_Error('slide_create_failed', 'Creating a slide requires data to update'));
		}

        // If data wasn't passed in then use the imported image
        $image = is_null($data) ? $this->slide_data : $data;

		set_post_thumbnail($this->slide_id, $image['id']);

		if (!class_exists('MetaImageSlide')) {
			require_once(METASLIDER_PATH . 'inc/slide/metaslide.image.class.php');
		}

		// TODO: Uses the previously existing class to create the slide (refactor this but not critical)
		$slide = new MetaImageSlide();
		$return = $slide->update_slide($this->slide_id, $image['id'], $this->slideshow_id);
		if (is_wp_error($return)) {
            $this->error = $return;
            return $this;
        }

		// This performs the cropping of the image
		$slide->resize_slide($this->slide_id, $this->slideshow_id);

		return $this;
	}

	/**
	 * Method to import an image. If nothing passed in it will load in a random one from 
	 * the theme directory. A theme can also be defined. Currently not used by this plugin.
	 * 
	 * @param array  $image    - Images to upload, if any
	 * @param string $theme_id - The folder name of a theme
	 * @return self
	 */
	public function import_image($image, $theme_id = null) {
		$image_id = Metaslider_Image::instance()->import($image, $theme_id);
        if (is_wp_error($image_id)) {
            $this->error = $image_id;
            return $this;
        }
        
		$this->slide_data = $this->make_image_slide_data($image_id);
		
        return $this;
	}

	/**
	 * Adds the type and image id to an array
	 *
	 * @param  int $image_id - Image ID
	 * @return array
	 */
	public function add_image($image_id) {
		$this->slide_data = $this->make_image_slide_data($image_id);
		return $this;
	}

	/**
	 * Adds the type and image id to an array
	 * Public for legacy reasons, otherwise should be private. i.e. don't use it outside this class.
	 *
	 * @param  int $image_id - Image ID
	 * @return array
	 */
	public function make_image_slide_data($image_id) {
		return array(
			'type' => 'image',
			'id'   => absint($image_id)
		);
	}

	/**
	 * Method to import image slides from an image or a theme (using default images)
	 * 
	 * @deprecated
	 * @param string $slideshow_id - The id of the slideshow
	 * @param string $theme_id 	   - The folder name of a theme
	 * @param array  $images 	   - Images to upload, if any
	 * @return WP_Error|array - The array of ids that were uploaded
	 */
	public function import($slideshow_id, $theme_id = null, $images = array()) {
		$images = !empty($images) ? $images : Metaslider_Image::instance()->get_theme_images($theme_id);
		if (is_wp_error($images)) return $images;

		$image_ids = array();
		foreach ($images as $image) {
			$image_ids[] = $this->upload_image($image, $theme_id);
		}
		return $this->create($slideshow_id, array_map(array($this, "make_image_slide_data"), $image_ids));
	}

	/**
	 * Method to create slides, single or multiple. Better to create slides by one instead
	 * 
	 * @deprecated
	 * @param string|int $slideshow_id - The id of the slideshow
	 * @param array      $data		   - The data for the slide
	 * @return array - The array of ids that were uploaded
	 */
	public function create($slideshow_id, $data) {
		$this->slideshow = $slideshow_id;
		$slide_ids = array();
		foreach ($data as $slide_data) {
			$slide_ids[] = $this->create_slide($slide_data);
		}
		return $slide_ids;
	}

	/**
     * Method to disassociate slides from a slideshow and mark them as trashed
	 * 
	 * @deprecated
     * @param int $slideshow_id - the id of the slideshow
	 * @return int
     */
	public function delete_from_slideshow($slideshow_id) {
        if (!class_exists('MetaSlider_Slideshows')) {
            require_once METASLIDER_PATH . 'Slideshows.php';
        }
		$slideshow = MetaSlider_Themes::get_instance();
		return $slideshow->delete_all_slides($this->slideshow_id);
	}
}
