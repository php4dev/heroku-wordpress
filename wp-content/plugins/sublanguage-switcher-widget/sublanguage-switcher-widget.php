<?php
/*
Plugin Name: Sublanguage Switcher Widget
Plugin URI: https://www.kuerbis.org/sublanguage-switcher-widget/
Description: Widget plugin to display a more fancy language switcher widget when Sublanguage plugin is used
Author: Ralf Geschke
Author URI: https://www.geschke.net
Version: 1.0.1
Text Domain: sublanguagesw
Domain Path: /languages
License: GPL

Copyright 2018 Ralf Geschke <ralf@kuerbis.org>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 2.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'SUBLANGUAGE_SWITCHER_FILE', __FILE__ ); // this file
define( 'SUBLANGUAGE_SWITCHER_BASENAME', plugin_basename( SUBLANGUAGE_SWITCHER_FILE ) ); // plugin name as known by WP
define( 'SUBLANGUAGE_SWITCHER_DIR', dirname( SUBLANGUAGE_SWITCHER_FILE ) ); // our directory


// Register Sublanguage_Switcher_Widget widget
function register_sublanguage_switcher_widget() {
    register_widget( 'Sublanguage_Switcher_Widget' );
}
add_action( 'widgets_init', 'register_sublanguage_switcher_widget' );


class Sublanguage_Switcher_Widget extends WP_Widget {

    /**
     * Holds widget settings defaults, populated in constructor.
     *
     * @var array
     */
    protected $defaults;

    /**
     * List of predefined language descriptions
     */
    protected $languages;

/**
 * Register widget with WordPress.
 */
    public function __construct() {

        require( plugin_dir_path( __FILE__ ) . 'languages.php');
        $this->languages = $languages;

        $this->defaults = array(
            'title'          => '',
            'display_name'	     => '0',
            'display_flags'           => '1',
            'hide_current'           => false,
            'hide_missing'    => false, // currently not used
            'positioning' => 'v', // vertical|horizontal 
            'display_type' => 'list' // types: list: vertical or horizontal list, select: selectbox
            
        );

        $widget_ops = array(
            'classname'   => 'sublanguage-switcher-widget',
            'description' => __( 'Display a configurable language switcher widget with optional flags and/or language.', 'sublanguagesw' ),
        );

        parent::__construct(
            'sublanguage_switcher_widget', // Base ID
            __( 'Sublanguage Switcher Widget', 'sublanguagesw' ), // Name
            array( 'description' => __( 'Language switch', 'sublanguagesw' ),
                   'customize_selective_refresh' => true,
             ) // Args
        );
        add_action( 'sublanguage_custom_switch', array( $this, 'displayLanguageSwitch' ),10, 2 );
    }


    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {


        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if (!is_plugin_active('sublanguage/sublanguage.php')) {
            echo "<b>";
            _e( 'To display the language switcher, please activate the sublanguage plugin.', 'sublanguagesw' );
            echo "</b>";
            return;
        }

        extract( $args );

        /** Merge with defaults */
        $this->instance = wp_parse_args( (array) $instance, $this->defaults );

        echo $before_widget;

        if ( ! empty( $this->instance['title'] ) )
            echo $before_title . apply_filters( 'widget_title', $this->instance['title'], $this->instance, $this->id_base ) . $after_title;
    

        if ($this->instance['display_type'] == 'list') {
            echo '<ul style="list-style: none; padding-left: 3px;">';
            do_action('sublanguage_print_language_switch');
            echo '</ul>';

        } elseif ($this->instance['display_type'] == 'select') { // selectbox
            echo '<select class="sublanguagesw-dropdown"  name="' .  $args['widget_id'] . '" id="select_' .  $args['widget_id'] . '">';
            echo '<option value="0">--</option>';
            do_action('sublanguage_print_language_switch');
            echo '</select>';
            $switchWidgetId = preg_replace( '/[^a-zA-Z0-9]/', '', $args['widget_id']);
            echo '<script type="text/javascript">
            //<![CDATA[
            var urls_' . $switchWidgetId . ' = ' . json_encode($this->languageUrls) . ';
            document.getElementById( "select_' . $args['widget_id'] . '" ).onchange = function() {
                location.href = urls_' . $switchWidgetId . '[this.value];
            }
            //]]>
        </script>';

        }
         
        echo $after_widget;
    }
    
    public function displayLanguageSwitch($languages, $sublanguage)
    {
       
        $langCount = 0;

        foreach ($languages as $language) { 
         
            
            $flagLanguage = '';
            if ($language->post_content) {
                $langFound = false;
                foreach ($this->languages as $lang => $langData) {
                  
                    if (isset($langData['locale']) && $langData['locale'] == $language->post_content) {
                     
                        $langFound = true;
                        break;
                    }
                }
                if ($langFound) {
                    // language was found in large language array				
                    if (isset($langData['flag'])) {
                        $flagLanguage = $langData['flag'];
                    } else {
                        $flagLanguage = $language->post_name;
                    }
                } else {
                    // use post_name language
                    $flagLanguage = $language->post_name;
                }

            } else {
                // fallback to language found in post_name
                $flagLanguage = $language->post_name;
            }
            
            if (!$flagLanguage) { 
                // fallback to generic flag
                $flagLanguage = 'united-nations';
            }

            if ($this->instance['display_type'] == 'list') {
                if (!$this->instance['hide_current'] or ($this->instance['hide_current'] && $sublanguage->current_language->post_name != $language->post_name)) {

                    if ($this->instance['positioning'] == 'h') {
                        echo '<span class="' . $language->post_name . '">';
                        if ($langCount > 0) {
                            echo ' ';
                        }
                    } else {
                        echo '<li class="' . $language->post_name . '">';
                    }
                    if ($this->instance['display_flags']) {
                        echo '<a href="' . $sublanguage->get_translation_link($language)  . '">';
                        echo '<img src="' .  plugins_url( 'flags/' . $flagLanguage . '.png', SUBLANGUAGE_SWITCHER_FILE) . '"/>';
                        echo '</a> ';

                    }
                    if ($this->instance['display_name']) {
                        echo '<a href="' . $sublanguage->get_translation_link($language)  . '">';
                        echo $language->post_title;
                        echo '</a>';
                    }

                    if ($this->instance['positioning'] == 'h') {
                        echo '</span>';
                    } else {
                        echo '</li>';
                    }
                }
            } else {
                if (!$this->instance['hide_current'] or ($this->instance['hide_current'] && $sublanguage->current_language->post_name != $language->post_name)) {

                    echo '<option value="' . $language->post_name . '" ';
                    if ($sublanguage->current_language->post_name == $language->post_name) {
                        echo ' selected="selected"';
                    }
                    echo '>' . $language->post_title . '</option>';
                    $this->languageUrls[$language->post_name] = $sublanguage->get_translation_link($language);
                }
            }

            $langCount++;
        }
    }

    public function form( $instance ) {

        /** Merge with defaults */
        $instance = wp_parse_args( (array) $instance, $this->defaults );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'sublanguagesw' ); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'display_type' ); ?>"><?php _e( 'Display as', 'sublanguagesw' ); ?>:</label>
            <select class="sublanguagesw_display_type" id="<?php echo $this->get_field_id( 'display_type' ); ?>" name="<?php echo $this->get_field_name( 'display_type' ); ?>">
                <option value="list" <?php selected( 'list', $instance['display_type'] ); ?>><?php _e( 'List (vertical or horizontal)', 'sublanguagesw' ); ?></option>
                <option value="select" <?php selected( 'select', $instance['display_type'] ); ?>><?php _e( 'Select Box', 'sublanguagesw' ); ?></option>
            </select>
        </p>
        <p class="option_display_list"  <?php echo ($instance['display_type'] == 'select' ? 'style="display: none;"' : ''); ?>>
            <label for="<?php echo $this->get_field_id( 'positioning' ); ?>"><?php _e( 'Positioning', 'sublanguagesw' ); ?>:</label>
            <select id="<?php echo $this->get_field_id( 'positioning' ); ?>" name="<?php echo $this->get_field_name( 'positioning' ); ?>">
                <option value="v" <?php selected( 'v', $instance['positioning'] ); ?>><?php _e( 'Vertically', 'sublanguagesw' ); ?></option>
                <option value="h" <?php selected( 'h', $instance['positioning'] ); ?>><?php _e( 'Horizontally', 'sublanguagesw' ); ?></option>
            </select>
        </p>

        <p class="option_display_list" <?php echo ($instance['display_type'] == 'select' ? 'style="display: none;"' : ''); ?>>
        <input class="checkbox sublanguagesw_option_display_name" type="checkbox" id="<?php echo $this->get_field_id( 'display_name' ); ?>" name="<?php echo $this->get_field_name( 'display_name' ); ?>" value="1" <?php checked('1',$instance['display_name']); ?>/>

            <label for="<?php echo $this->get_field_id( 'display_name' ); ?>"><?php _e( 'Display Language Names', 'sublanguagesw' ); ?>:</label>
        </p>

        <p class="option_display_list"  <?php echo ($instance['display_type'] == 'select' ? 'style="display: none;"' : ''); ?>>
        <input class="checkbox sublanguagesw_option_display_flags" type="checkbox" id="<?php echo $this->get_field_id( 'display_flags' ); ?>" name="<?php echo $this->get_field_name( 'display_flags' ); ?>" value="1" <?php checked('1',$instance['display_flags']); ?>/>

        <label for="<?php echo $this->get_field_id( 'display_flags' ); ?>"><?php _e( 'Display Flags', 'sublanguagesw' ); ?>:</label>
        </p>
       
        <p>
        <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_current' ); ?>" name="<?php echo $this->get_field_name( 'hide_current' ); ?>" value="1" <?php checked('1',$instance['hide_current']); ?>/>

        <label for="<?php echo $this->get_field_id( 'hide_current' ); ?>"><?php _e( 'Hide Current Language', 'sublanguagesw' ); ?>:</label>
        </p>
       

        
    <?php

	    // FIXME echoing script in form is not very clean
		// but it does not work if enqueued properly :
		// clicking save on a widget makes this code unreachable for the just saved widget ( ?! )
		$this->adminJavaScript();
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) 
    {

        $new_instance['title'] = strip_tags( $new_instance['title'] );

        $new_instance['positioning'] = strip_tags( $new_instance['positioning'] );
        $new_instance['display_name'] = strip_tags( $new_instance['display_name'] );
        $new_instance['display_flags'] = strip_tags( $new_instance['display_flags'] );
        $new_instance['display_type'] = strip_tags( $new_instance['display_type'] );
        $new_instance['hide_current'] = strip_tags( $new_instance['hide_current'] );

        return $new_instance;

    }

    /**
	 * Add javascript to control the switcher widget options
	 *
	 * @since 1.0
	 */
	public function adminJavaScript() {
		static $done = false;

		if ( $done ) {
			return;
		}

		$done = true;
		?>
		<script type='text/javascript'>
			//<![CDATA[
			jQuery( document ).ready( function( $ ) {
				
                function checkSwitchOn(check1,check2) {
                    if (check1.prop('checked') == false && check2.prop('checked') == false) {
                        check2.prop('checked',true);
                    }
                }

                $('.widgets-sortables,.control-section-sidebar').on('change','.sublanguagesw_display_type',function() {                   
                    var displayType = $(this).val();
                    if (displayType == 'select') {
                        $(this).parent().parent().find('.option_display_list').hide();
                    } else {
                        $(this).parent().parent().find('.option_display_list').show();
                    }
                });

                $('.widgets-sortables,.control-section-sidebar').on('change','.sublanguagesw_option_display_flags',function() {
                    checkSwitchOn($(this),$(this).parent().parent().find('.sublanguagesw_option_display_name'));
                });

                $('.widgets-sortables,.control-section-sidebar').on('change','.sublanguagesw_option_display_name',function() {
                    checkSwitchOn($(this),$(this).parent().parent().find('.sublanguagesw_option_display_flags'));
                });
                
			} );
			//]]>
		</script>
		<?php
	}


}