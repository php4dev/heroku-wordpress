<?php

if (!defined('ABSPATH')) {
    die('No direct access.');
}

/**
 *  Class to handle slideshows
 */
class MetaSlider_Slideshows
{

    /**
     * Themes class
     *
     * @var object
     */
    private $themes;

    /**
     * Theme instance
     *
     * @var object
     * @see get_instance()
     */
    protected static $instance = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        if (!class_exists('MetaSlider_Themes')) {
            require_once plugin_dir_path(__FILE__) . 'Themes.php';
        }
        $this->themes = MetaSlider_Themes::get_instance();
        $this->plugin = MetaSliderPlugin::get_instance();
    }

    /**
     * Used to access the instance
     */
    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Method to add a slideshow
     *
     * @return int
     */
    public static function create()
    {

        // Duplicate settings from their recently modified slideshow, or use defaults.
        $last_modified =  self::get_last_modified();
        $last_modified_id = !empty($last_modified) ? $last_modified['id'] : null;
        // TODO: next branch, refactor to slideshow object and extract controller type methods.
        // TODO: I want to be able to do $last_modified->settings()
        $last_modified_settings = new MetaSlider_Slideshow_Settings($last_modified_id);
        $last_modified_settings = $last_modified_settings->get_settings();
        $default_settings = MetaSlider_Slideshow_Settings::defaults();

        $new_id = wp_insert_post(array(
            'post_title' => $default_settings['title'],
            'post_status' => 'publish',
            'post_type' => 'ml-slider'
        ));

        if (false !== strpos($default_settings['title'], '{id}')) {
            wp_update_post(array(
                'ID' => $new_id,
                'post_title' => str_replace('{id}', $new_id, $default_settings['title'])
            ));
        }

        if (is_wp_error($new_id)) {
            return $new_id;
        }

        $overrides = get_option('metaslider_default_settings');
        $last_modified_settings = is_array($overrides) ? array_merge($last_modified_settings, $overrides) : $last_modified_settings;
        add_post_meta($new_id, 'ml-slider_settings', $last_modified_settings, true);

        // TODO: next branch, refactor to slideshow object and extract controller type methods.
        // TODO: I want to be able to do $last_modified->theme()
        // Get the latest slideshow used
        $theme = get_post_meta($last_modified, 'metaslider_slideshow_theme', true);

        // Lets users set their own default theme
        if (apply_filters('metaslider_default_theme', '')) {
            $themes = MetaSlider_Themes::get_instance();
            $theme = $themes->get_theme_object(null, apply_filters('metaslider_default_theme', ''));
        }

        // Set the theme if we found something
        if (isset($theme['folder'])) {
            update_post_meta($new_id, 'metaslider_slideshow_theme', $theme);
        }

        // Needed for creating a relationship with slides
        wp_insert_term($new_id, 'ml-slider');

        return $new_id;
    }

    /**
     * Method to save a slideshow
     *
     * @param int|string $slideshow_id - The id of the slideshow
     * @param array		 $new_settings - The settings
     *
     * @return int - id of the slideshow
     */
    public function save($slideshow_id, $new_settings)
    {

        // TODO: This is old code copied over and should eventually be refactored to not require hard-coded values
        $old_settings = get_post_meta($slideshow_id, 'ml-slider_settings', true);

        // convert submitted checkbox values from 'on' or 'off' to boolean values
        $checkboxes = apply_filters("metaslider_checkbox_settings", array('noConflict', 'fullWidth', 'hoverPause', 'links', 'reverse', 'random', 'printCss', 'printJs', 'smoothHeight', 'center', 'carouselMode', 'autoPlay', 'firstSlideFadeIn', 'responsive_thumbs'));

        foreach ($checkboxes as $checkbox) {
            $new_settings[$checkbox] = (isset($new_settings[$checkbox]) && 'on' == $new_settings[$checkbox]) ? 'true' : 'false';
        }

        $settings = array_merge((array) $old_settings, $new_settings);

        update_post_meta($slideshow_id, 'ml-slider_settings', $settings);

        return $slideshow_id;
    }

    /**
     * Method to duplicate a slideshow
     *
     * @param int|string $slideshow_id - The id of the slideshow to duplicate
     *
     * @throws Exception - handled within method.
     * @return int|boolean - id of the new slideshow to show, or false
     */
    public function duplicate($slideshow_id)
    {
        $new_slideshow_id = 0;

        try {
            $new_slideshow_id = wp_insert_post(array(
                'post_title' => get_the_title($slideshow_id),
                'post_status' => 'publish',
                'post_type' => 'ml-slider'
            ), true);

            if (is_wp_error($new_slideshow_id)) {
                throw new Exception($new_slideshow_id->get_error_message());
            }

            foreach (get_post_meta($slideshow_id) as $key => $value) {
                update_post_meta($new_slideshow_id, $key, maybe_unserialize($value[0]));
            }

            // Not used at the moment, but indicates this is a copy
            update_post_meta($new_slideshow_id, 'metaslider_copy_of', $slideshow_id);

            // Slides are associated to a slideshow via post terms
            $term = wp_insert_term($new_slideshow_id, 'ml-slider');

            // Duplicate each slide
            foreach (self::active_slide_ids($slideshow_id) as $slide_id) {
                $type = get_post_meta($slide_id, 'ml-slider_type', true);
                $new_slide_id = wp_insert_post(array(
                    'post_title' => "Slider {$new_slideshow_id} - {$type}",
                    'post_status' => 'publish',
                    'post_type' => 'ml-slide',
                    'post_excerpt' => get_post_field('post_excerpt', $slide_id),
                    'menu_order' => get_post_field('menu_order', $slide_id)
                ), true);

                if (is_wp_error($new_slide_id)) {
                    throw new Exception($new_slideshow_id->get_error_message());
                }

                foreach (get_post_meta($slide_id) as $key => $value) {
                    add_post_meta($new_slide_id, $key, maybe_unserialize($value[0]));
                }

                wp_set_post_terms($new_slide_id, $term['term_id'], 'ml-slider', true);
            }
        } catch (Exception $e) {

            // If there was a failure somewhere, clean up
            wp_trash_post($new_slideshow_id);
            $this->delete_all_slides($new_slideshow_id);

            return new WP_Error('slide_duplication_failed', $e->getMessage());
        }

        // External modules manipulate data here
        do_action('metaslider_slideshow_duplicated', $slideshow_id, $new_slideshow_id);

        return $new_slideshow_id;
    }

    /**
     * Will return an array of information needed to import a slideshow
     *
     * @param array $slideshow_ids - The ids of the slideshow to export
     *
     * @return array
     */
    public function export($slideshow_ids)
    {
        $export = array();
        $args = array(
            'post_type' => 'ml-slider',
            'post_status' => array('inherit', 'publish'),
            'orderby' => 'modified',
            'suppress_filters' => 1, // wpml, ignore language filter
            'posts_per_page' => -1,
            'post__in' => $slideshow_ids
        );
        $slideshows = get_posts($args);

        foreach ($slideshows as $slideshow) {
            $slideshow_export = array(
                'title' => $slideshow->post_title,
                'original_id' => $slideshow->ID,
                'meta' =>  array(),
                'slides' => array()
            );

            foreach (get_post_meta($slideshow->ID) as $metakey => $value) {
                $slideshow_export['meta'][$metakey] = $value[0];
            }

            if (isset($slideshow_export['meta']['metaslider_extra_slideshow_css'])) {
                $slideshow_export['meta']['metaslider_extra_slideshow_css'] = str_replace(
                    'metaslider-id-' . $slideshow->ID,
                    'metaslider-id-{#ID#}', // To replace with correct ID during import
                    $slideshow_export['meta']['metaslider_extra_slideshow_css']
                );
            }

            // Unset unecessary meta
            unset($slideshow_export['meta']['metaslider_copy_of']);

            $slides = get_posts(array(
                'post_type' => array('ml-slide'),
                'post_status' => array('publish'),
                'lang' => '', // polylang, ingore language filter
                'suppress_filters' => 1, // wpml, ignore language filter
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'ml-slider',
                        'field' => 'slug',
                        'terms' => $slideshow->ID
                    )
                )
            ));

            $slides_export = array();
            foreach ($slides as $key => $slide) {
                $image = get_post(get_post_meta($slide->ID, '_thumbnail_id', true));
                $image_name = isset($image->post_name) ? $image->post_name : '';
                $image_alt_name = isset($image->post_title) ? $image->post_title : '';

                // Youtube and Vimeo prepend text to the file name, but not post_name
                $slide_type = get_post_meta($slide->ID, 'ml-slider_type', true);
                if ($image_name && in_array($slide_type, array('youtube', 'vimeo'))) {
                    $image_alt_name = $image_name;
                    $image_name = $slide_type . '_' . $image_name;
                }
                $slides_export[$key] = array(
                    'original_id' => $slide->ID,
                    'order' => $slide->menu_order,
                    'post_excerpt' => $this->stub_image_urls_from_string($slide->post_excerpt),
                    'image' => $image_name,
                    'image_alt' => $image_alt_name,
                    'meta' =>  array()
                );

                // Replace content url with placeholder for easier importing
                foreach (get_post_meta($slide->ID) as $metakey => $value) {
                    $slides_export[$key]['meta'][$metakey] = $this->stub_image_urls_from_string($value[0]);
                }

                // Unset unecessary meta
                unset($slides_export[$key]['meta']['_thumbnail_id']);
            }

            $slideshow_export['slides'] = $slides_export;
            $export[] = $slideshow_export;

            unset($slides_export);
            unset($slideshow_export);
        }
        $export['metadata'] = array(
            'version' => $this->plugin->version,
            'date' => date("Y/m/d")
        );
        return $export;
    }

    /**
     * Will import slideshows
     *
     * @param array $slideshows - The data generated by the export method
     *
     * @throws Exception - handled within method.
     * @return WP_Error|array - True on success, WP_Error on failure
     */
    public function import($slideshows)
    {
        $errors = array();
        foreach ($slideshows as $index => $slideshow) {
            $errors[$index] = array();
            $new_slideshow_id = 0;
            try {
                $new_slideshow_id = wp_insert_post(array(
                    'post_title' => $slideshow['title'],
                    'post_status' => 'publish',
                    'post_type' => 'ml-slider'
                ), true);

                if (is_wp_error($new_slideshow_id)) {
                    throw new Exception($new_slideshow_id->get_error_message());
                }

                if (isset($slideshow['meta']) && is_array($slideshow['meta'])) {
                    foreach ($slideshow['meta'] as $key => $value) {
                        update_post_meta(
                            $new_slideshow_id,
                            $key,
                            maybe_unserialize(str_replace('{#ID#}', $new_slideshow_id, $value))
                        );
                    }
                }

                // Slides are associated to a slideshow via post terms
                $term = wp_insert_term($new_slideshow_id, 'ml-slider');

                if (!isset($slideshow['slides']) || !$slideshow['slides']) {
                    continue;
                };
                foreach ($slideshow['slides'] as $slide) {
                    $new_slide_id = wp_insert_post(array(
                        'post_title' => "Slider {$new_slideshow_id} - {$slide['meta']['ml-slider_type']}",
                        'post_status' => 'publish',
                        'post_type' => 'ml-slide',
                        'post_excerpt' => $this->restore_image_urls_from_string($slide['post_excerpt']),
                        'menu_order' => $slide['order']
                    ), true);

                    if (is_wp_error($new_slide_id)) {
                        throw new Exception($new_slideshow_id->get_error_message());
                    }

                    // Update the thumbnail from the computed new image id
                    if (isset($slide['id'])) {
                        $slide['meta']['_thumbnail_id'] = $slide['id'];
                    }

                    foreach ($slide['meta'] as $key => $value) {
                        $value = $this->restore_image_urls_from_string($value);
                        add_post_meta($new_slide_id, $key, maybe_unserialize($value));
                    }

                    wp_set_post_terms($new_slide_id, $term['term_id'], 'ml-slider', true);

                    // This will crop the image so it's ready (and not already cropped)
                    $settings = maybe_unserialize($slideshow['meta']['ml-slider_settings']);
                    if (isset($settings['width']) && isset($settings['height'])) {
                        $image_cropper = new MetaSliderImageHelper(
                            $new_slide_id,
                            $settings['width'],
                            $settings['height'],
                            isset($settings['smartCrop']) ? $settings['smartCrop'] : 'false'
                        );
                        // This crops even though it doesn't sounds like it
                        $image_cropper->get_image_url();
                    }
                }
            } catch (Exception $e) {
                array_push($errors[$index], $e->getMessage());

                // If there was a failure somewhere, clean up
                wp_trash_post($new_slideshow_id);
                $this->delete_all_slides($new_slideshow_id);
            }

            // If no errors, remove the index
            if (!count($errors[$index])) {
                unset($errors[$index]);
            }

            // External modules manipulate data here
            do_action('metaslider_slideshow_imported', $new_slideshow_id);
        }

        $errors = reset($errors);
        return isset($errors[0]) ? new WP_Error('import_slideshow_error', $errors[0]) : $slideshows;
    }

    /**
     * Function to leve a marker for images that are found in content.
     * This can be any string, but it will most likely be HTML
     * * Idea: this could keep track of image names that JS can use to search
     *
     * @param string $string - A string that may contain an image to be replaced
     *
     * @return string - the filtered string
     */
    private function stub_image_urls_from_string($string)
    {
        // First, replace the media upload url. We only handle images inside there
        $dir = wp_upload_dir(null, false);
        $string = str_replace($dir['baseurl'], '{#CONTENTURL#}', $string);

        // Next, attampt to parse the image and find it's name/slug
        return preg_replace_callback('/[\'\"]({#CONTENTURL#}.*?)[\'\"]/', array($this, 'format_image_stub'), $string);
    }

    /**
     * Attempt to locate an image by the image filename, and if not found, just update the content url
     *
     * @param string $string - A string that may contain a {#CONTENTURL#} to be replaced
     *
     * @return string - the filtered string
     */
    private function restore_image_urls_from_string($string)
    {
        return preg_replace_callback('/[\'\"]({#CONTENTURL#}.*?)[\'\"]/', array($this, 'unformat_image_stub'), $string);
    }

    /**
     * Used by a callback to replace images with a stub containing the name and title
     * Makes it possibel to look up images later
     *
     * @see stub_image_urls_from_string()
     * @param array $matches - The image
     *
     * @return string - the filtered string
     */
    private function format_image_stub($matches)
    {
        global $wpdb;
        $dir = wp_upload_dir(null, false);
        $url = str_replace('{#CONTENTURL#}', $dir['baseurl'], $matches[1]);
        $content_urlname = str_replace('{#CONTENTURL#}', '', $matches[1]);
        $image = $wpdb->get_row($wpdb->prepare("SELECT post_name, post_title FROM $wpdb->posts WHERE guid = %s AND post_type = 'attachment' LIMIT 1", $url));
        return '"{#CONTENTURL#}{#URLname:'. $content_urlname .'#}{#filename:'. $image->post_name .'#}{#filetitle:'. $image->post_title .'#}"';
    }

    /**
     * This is the reverse of the above. IT will attempt to find the image locally
     * {#CONTENTURL#}{#URLname:/2020/04/imagename.jpg#}{#filename:imagename#}{#filetitle:imagename#}
     *
     * @see restore_image_urls_from_string()
     * @param array $image_data - The image
     *
     * @return string - the filtered string
     */
    private function unformat_image_stub($image_data)
    {
        $filename = preg_match('{#filename:(.*?)#}', $image_data[1], $matches);
        if ($image = MetaSlider_Image::get_image_ids_from_file_name(array($matches[1]))) {
            $image = reset($image);
            return '"' . $image['url'] . '"';
        }
        $filetitle = preg_match('{#filetitle:(.*?)#}', $image_data[1], $matches);
        if ($image = MetaSlider_Image::get_image_ids_from_file_name(array($matches[1]))) {
            $image = reset($image);
            return '"' . $image['url'] . '"';
        }

        // nothing found, so return the image relative to the new media directory
        $urlname = preg_match('{#URLname:(.*?)#}', $image_data[1], $matches);
        $dir = wp_upload_dir(null, false);
        return '"' . $dir['baseurl'] . $matches[1] . '"';
    }

    /**
     * Method to delete a slideshow
     *
     * @param int|string $slideshow_id - The id of the slideshow to delete
     *
     * @return int|boolean - id of the next slideshow to show, or false
     */
    public function delete($slideshow_id)
    {

        // Send the post to trash
        $id = wp_update_post(array(
            'ID' => $slideshow_id,
            'post_status' => 'trash'
        ));

        $this->delete_all_slides($slideshow_id);

        $last_modified = self::get_last_modified();
        return !empty($last_modified) ? $last_modified['id'] : false;
    }


    /**
     * Method to disassociate slides from a slideshow
     *
     * @param int $slideshow_id - the id of the slideshow
     *
     * @return int
     */
    public function delete_all_slides($slideshow_id)
    {
        $args = array(
            'force_no_custom_order' => true,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post_type' => array('ml-slide'),
            'post_status' => array('publish'),
            'lang' => '', // polylang, ingore language filter
            'suppress_filters' => 1, // wpml, ignore language filter
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'ml-slider',
                    'field' => 'slug',
                    'terms' => $slideshow_id
                )
            )
        );

        // I believe if this fails there's no real harm done
        // because slides don't really need to be linked to their parent slideshow
        $query = new WP_Query($args);
        while ($query->have_posts()) {
            $query->next_post();
            wp_trash_post($query->post->ID);
        }

        return $slideshow_id;
    }


    /**
     * Method to get the most recently modified slideshow
     *
     * @return array The id of the slideshow
     */
    public static function get_last_modified()
    {
        $args = array(
            'force_no_custom_order' => true,
            'post_type' => 'ml-slider',
            'num_posts' => 1,
            'post_status' => 'publish',
            'suppress_filters' => 1, // wpml, ignore language filter
            'orderby' => 'modified',
            'order' => 'DESC'
        );

        $slideshow = get_posts(apply_filters('metaslider_all_meta_sliders_args', $args));

        return isset($slideshow[0]) ? self::build_slideshow_object($slideshow[0]) : array();
    }

    /**
     * Method to get a single slideshow from the database
     *
     * @param int $id How many slideshows to return
     *
     * @return array
     */
    public function get_single($id)
    {
        $args = array(
            'post_type' => 'ml-slider',
            'post_status' => array('inherit', 'publish'),
            'orderby' => 'modified',
            'p' => $id,
            'suppress_filters' => 1, // wpml, ignore language filter,
        );

        $slideshow = new WP_Query(apply_filters('metaslider_get_single_slideshows_args', $args));
        if (is_wp_error($slideshow)) {
            return $slideshow;
        }

        return array_map('self::build_slideshow_object', $slideshow->posts);
    }

    /**
     * Method to get slideshows from the database
     *
     * @param int $posts_per_page How many slideshows to return
     * @param int $page 		  What page to return
     *
     * @return array
     */
    public function get($posts_per_page = 25, $page = 1)
    {
        if (!$posts_per_page || !$page) {
            return array();
        }

        $args = array(
            'post_type' => 'ml-slider',
            'post_status' => array('inherit', 'publish'),
            'orderby' => 'modified',
            'suppress_filters' => 1, // wpml, ignore language filter,
            'paged' => $page,
            'posts_per_page' => $posts_per_page
        );

        $slideshows = new WP_Query(apply_filters('metaslider_get_some_slideshows_args', $args));
        if (is_wp_error($slideshows)) {
            return $slideshows;
        }

        $slideshows_formatted = array_map('self::build_slideshow_object', $slideshows->posts);

        $remaining_pages = intval($slideshows->max_num_pages) - intval($page);
        if ($remaining_pages > 0) {
            $slideshows_formatted['page'] = $page;
            $slideshows_formatted['remaining_pages'] = $remaining_pages;
        }

        // Add the total count so we know there are more to fetch
        if (1 == $page) {
            $slideshows_formatted['totalSlideshows'] = $slideshows->found_posts;
        }

        return $slideshows_formatted;
    }

    /**
     * Method to get slideshows from the database by term
     *
     * @param int $term  The search term
     * @param int $count How many to return
     *
     * @return array
     */
    public function search($term, $count)
    {
        $args = array(
            'post_type' => 'ml-slider',
            'post_status' => array('inherit', 'publish'),
            'orderby' => $term ? 'relevance' : 'modified',
            's' => $term,
            'suppress_filters' => 1,
            'posts_per_page' => $count
        );

        $slideshows = new WP_Query(apply_filters('metaslider_get_some_slideshows_args', $args));
        if (is_wp_error($slideshows)) {
            return $slideshows;
        }

        return array_map('self::build_slideshow_object', $slideshows->posts);
    }

    /**
     * Method to get all slideshows from the database
     *
     * @return array
     */
    public function get_all_slideshows()
    {
        $args = array(
            'post_type' => 'ml-slider',
            'post_status' => array('inherit', 'publish'),
            'orderby' => 'modified',
            'suppress_filters' => 1, // wpml, ignore language filter
            'posts_per_page' => -1
        );

        $slideshows = get_posts(apply_filters('metaslider_all_meta_sliders_args', $args));

        return array_map(array($this, 'build_slideshow_object_simple'), $slideshows);
    }

    /**
     * Method to build out a simple slideshow object
     *
     * @param object $slideshow - The slideshow object
     * @return array
     */
    public function build_slideshow_object_simple($slideshow)
    {
        if (empty($slideshow)) {
            return array();
        }
        $slideshows = array(
            'id' => $slideshow->ID,
            'title' => $slideshow->post_title ? $slideshow->post_title : '# ' . $slideshow->ID,
        );
        return $slideshows;
    }

    /**
     * Method to build out the slideshow object
     *
     * @param object $slideshow - The slideshow object
     * @return array
     */
    public static function build_slideshow_object($slideshow)
    {
        if (empty($slideshow)) {
            return array();
        }

        $slideshows = array(
            'id' => $slideshow->ID,
            'title' => $slideshow->post_title ? $slideshow->post_title : '# ' . $slideshow->ID,
            'created_at' => $slideshow->post_date,
            'modified_at' => $slideshow->post_modified,
            'modified_at_gmt' => $slideshow->post_modified_gmt,
            'slides' => self::active_slide_ids($slideshow->ID)
        );

        foreach (get_post_meta($slideshow->ID) as $key => $value) {
            if (in_array($key, array('title', 'id', 'created_at', 'modified_at', 'modified_at_gmt', 'slides'))) {
                continue;
            }

            $key = str_replace('ml-slider_settings', 'settings', $key);
            $key = str_replace('metaslider_slideshow_theme', 'theme', $key);
            $slideshows[$key] = maybe_unserialize($value[0]);
        }

        return $slideshows;
    }

    /**
     * Method to get the slide ids
     *
     * @param int|string $id - The id of the slideshow
     * @return array - Returns an array of just the slide IDs
     */
    public static function active_slide_ids($id)
    {
        $slides = get_posts(array(
            'force_no_custom_order' => true,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post_type' => array('attachment', 'ml-slide'),
            'post_status' => array('inherit', 'publish'),
            'lang' => '',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'ml-slider',
                    'field' => 'slug',
                    'terms' => $id
                )
            )
        ));

        $slide_ids = array();
        foreach ($slides as $slide) {
            $type = get_post_meta($slide->ID, 'ml-slider_type', true);
            $type = $type ? $type : 'image'; // Default ot image

            // If this filter exists, that means the slide type is available (i.e. pro slides)
            if (has_filter("metaslider_get_{$type}_slide")) {
                array_push($slide_ids, $slide->ID);
            }
        }
        return $slide_ids;
    }

    /**
     * Method to get the latest slideshow
     */
    public function recently_modified()
    {
    }

    /**
     * Method to get a single slideshow from the database
     *
     * @param string $id - The id of a slideshow
     */
    public function single($id)
    {
    }

    /**
     * Returns the shortcode of the slideshow
     *
     * @param string|int  $id 		   - The id of a slideshow
     * @param string|int  $restrict_to - page to limit the slideshow to
     * @param string|null $theme_id    - load a theme, defaults to the current theme
     */
    public function shortcode($id = null, $restrict_to = null, $theme_id = null)
    {

        // if no id is given, try to find the first available slideshow
        if (is_null($id)) {
            $the_query = get_posts(array('orderby' => 'rand', 'posts_per_page' => '1'));
            $id = isset($the_query[0]) ? $the_query[0]->ID : $id;
        }

        return "[metaslider id='{$id}' restrict_to='{$restrict_to}' theme='{$theme_id}']";
    }

    /**
     * Return the preview
     *
     * @param int|string $slideshow_id The id of the current slideshow
     * @param string 	 $theme_id 	   The folder name of the theme
     *
     * @return string|WP_Error whether the file was included, or error class
     */
    public function preview($slideshow_id, $theme_id = null)
    {
        if (!class_exists('MetaSlider_Slideshow_Settings')) {
            require_once plugin_dir_path(__FILE__) . 'Settings.php';
        }
        $settings = new MetaSlider_Slideshow_Settings($slideshow_id);

        try {
            ob_start();

            // Remove the admin bar
            remove_action('wp_footer', 'wp_admin_bar_render', 1000);

            // Load in theme if set. Note that the shortcode below is set to 'none'
            $this->themes->load_theme($slideshow_id, $theme_id); ?>

<!DOCTYPE html>
<html>
	<head>
		<style type='text/css'>
			<?php ob_start(); ?>
			body, html {
				overflow: auto;
				height:100%;
				margin:0;
				padding:0;
				box-sizing: border-box;
				font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		        font-size: 14px;
			}
			body {
				padding: 60px 40px 40px;
			}
			#preview-container {
				min-height: 100%;
				max-width: <?php echo $settings->get_single('width'); ?>px;
				margin: 0 auto;
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				-webkit-box-align: center;
				   -ms-flex-align: center;
				      align-items: center;
				-webkit-box-pack: center;
				   -ms-flex-pack: center;
				 justify-content: center;
			}
			#preview-inner {
				width: 100%;
				height: 100%;
			}
			.metaslider {
				margin: 0 auto;
			}
			<?php echo apply_filters('metaslider_preview_styles', ob_get_clean()); ?>
		</style>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Expires" content="0">
	</head>
	<body>
		<div id="preview-container">
			<div id="preview-inner">
				<?php echo do_shortcode($this->shortcode(absint($slideshow_id), null, 'none')); ?>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
			<?php return preg_replace('/\s+/S', " ", ob_get_clean());
        } catch (Exception $e) {
            ob_clean();
            return new WP_Error('preview_failed', $e->getMessage());
        }
    }
}
