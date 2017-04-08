<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "salient_redux";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

   

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $theme_menu_icon = null;
    if(floatval(get_bloginfo('version')) >= "3.8") {
        $current_color = get_user_option( 'admin_color' );
        if($current_color == 'light') {
            $theme_menu_icon = NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/icons/salient-grey.svg';
        } else {
            $theme_menu_icon = NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/icons/salient.svg';
        }
    } 


    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        'disable_tracking' => true,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Salient', 'redux-framework-demo' ),
        'page_title'           => __( 'Salient Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => 54,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => $theme_menu_icon,
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => '',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'     => ' ',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/ThemeNectar-488077244574702/?fref=ts',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = '';
    } else {
         $args['intro_text'] = '';
    }

    // Add content after the form.
    $args['footer_text'] = '';

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /* EXT LOADER */
    if(!function_exists('redux_register_custom_extension_loader')) :
    function redux_register_custom_extension_loader($ReduxFramework) {
        $path = dirname( __FILE__ ) . '/extensions/';
        $folders = scandir( $path, 1 );        
        foreach($folders as $folder) {
            if ($folder === '.' or $folder === '..' or !is_dir($path . $folder) ) {
                continue;   
            } 
            $extension_class = 'ReduxFramework_Extension_' . $folder;
            if( !class_exists( $extension_class ) ) {
                // In case you wanted override your override, hah.
                $class_file = $path . $folder . '/extension_' . $folder . '.php';
                $class_file = apply_filters( 'redux/extension/'.$ReduxFramework->args['opt_name'].'/'.$folder, $class_file );
                if( $class_file ) {
                    require_once( $class_file );
                    $extension = new $extension_class( $ReduxFramework );
                }
            }
        }
    }
    // Modify {$redux_opt_name} to match your opt_name
    add_action("redux/extensions/".$opt_name ."/before", 'redux_register_custom_extension_loader', 0);
    endif;


    //write dynamic css
    //$options = get_nectar_theme_options(); 
    //if(!empty($options['external-dynamic-css']) && $options['external-dynamic-css'] == 1) {
        add_action ('redux/options/salient_redux/saved', 'generate_options_css');
    //}


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

  

     Redux::setSection( $opt_name, array(
        'title'            => __( 'General Settings', NECTAR_THEME_NAME ),
        'id'               => 'general-settings',
        'customizer_width' => '450px',
        'desc'             => 'Welcome to the Salient options panel! You can switch between option groups by using the left-hand tabs.',
        'fields'           => array(

        )
    ) );
    
    $border_border_sizes = array();
    for($i = 1; $i<100; $i++) {
         $border_border_sizes[$i] = $i;
    }
     Redux::setSection( $opt_name, array(
        'title'            => __( 'Styling', 'redux-framework-demo' ),
        'id'               => 'general-settings-styling',
        'subsection'       => true,
        'fields'           => array(
           array(
                'id' => 'theme-skin', 
                'type' => 'select', 
                'title' => __('Theme Skin', NECTAR_THEME_NAME),
                'subtitle' => 'This will alter the overall styling of various theme elements',
                'options' => array(
                    "original" => "Original",
                    "ascend" => "Ascend"
                ),
                'default' => 'ascend'
            ),
            array(
                'id' => 'favicon',
                'type' => 'media',
                'title' => __('Favicon Upload', NECTAR_THEME_NAME), 
                'subtitle' => __('Upload a 16px x 16px .png or .gif image that will be your favicon.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
          
            
            
            array(
                'id' => 'button-styling', 
                'type' => 'select', 
                'title' => __('Button Styling', NECTAR_THEME_NAME),
                'subtitle' => 'This will effect the overall styling of buttons',
                'options' => array(
                    "default" => "Default",
                    "rounded" => "Rounded"
                ),
                'default' => 'default' 
            ),
            array(
                'id' => 'theme-icon-style', 
                'type' => 'select', 
                'title' => __('Theme Icon Style', NECTAR_THEME_NAME),
                'subtitle' => 'Select your theme icon style here - will be used for menu icons such as shopping cart, search and theme elements such as nectar love, portfolio single navigation etc.',
                'options' => array(
                    "inherit" => "Inherit from skin",
                    "minimal" => "Minimal"
                ),
                'default' => 'minimal'
            ),
            array(
                'id' => 'overall-bg-color',
                'type' => 'color',
                'title' => __('Overall Background Color', NECTAR_THEME_NAME), 
                'subtitle' => 'Default is #f8f8f8', 
                'transparent' => false,
                'desc' => '',
                'default' => ''
            ),

             array(
                'id' => 'overall-font-color',
                'type' => 'color',
                'title' => __('Overall Font Color', NECTAR_THEME_NAME), 
                'subtitle' => 'Default is #676767', 
                'transparent' => false,
                'desc' => '',
                'default' => ''
            ),
               array(
                'id' => 'body-border',
                'type' => 'switch',
                'title' => __('Body Border (Passepartout)', NECTAR_THEME_NAME), 
                'subtitle' => __('This will add a border around the edges of the screen', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
            array(
                'id' => 'body-border-color',
                'type' => 'color',
                'required' => array( 'body-border', '=', '1' ),
                'title' => __('Body Border Color', NECTAR_THEME_NAME), 
                'subtitle' => 'Default is #ffffff', 
                'transparent' => false,
                'desc' => '',
                'default' => '#ffffff'
            ),
            array(
                'id' => 'body-border-size', 
                'type' => 'select', 
                'required' => array( 'body-border', '=', '1' ),
                'title' => __('Body Border Size', NECTAR_THEME_NAME),
                'subtitle' => 'Please choose your desired size in px here. Default is 20px.',
                'options' => $border_border_sizes,
                'default' => '20px' 
            ),
        )
    ) );

     Redux::setSection( $opt_name, array(
        'title'            => __( 'Functionality', 'redux-framework-demo' ),
        'id'               => 'general-settings-functionality',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id' => 'back-to-top',
                'type' => 'switch',
                'title' => __('Back To Top Button', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle whether or not to enable a back to top button on your pages.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '1' 
            ),
            array(
                'id' => 'back-to-top-mobile',
                'type' => 'checkbox',
                'title' => __('Keep Back To Top Button On Mobile', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle whether or not to show or hide the back to top button when viewing on a mobile device.', NECTAR_THEME_NAME),
                'desc' => '',
                'required' => array( 'back-to-top', '=', '1' ),
                'default' => '0' 
            ),
            array(
                'id' => 'smooth-scrolling',
                'type' => 'switch',
                'title' => __('Styled Scrollbar', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle whether or not to enable the styled scrollbar - turning this on will lower scrolling performance', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
            
            array(
                'id' => 'one-page-scrolling',
                'type' => 'switch',
                'title' => __('One Page Scroll Support (Animated Anchor Links)', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle whether or not to enable one page scroll support', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '1' 
            ),
            array(
                'id' => 'responsive',
                'type' => 'switch',
                'title' => __('Enable Responsive Design', NECTAR_THEME_NAME), 
                'subtitle' => __('This adjusts the layout of your website depending on the screen size/device.', NECTAR_THEME_NAME),
                'desc' => '',
                'next_to_hide' => '1',
                'default' => '1' 
            ),
            array(
                'id' => 'ext_responsive',
                'type' => 'checkbox',
                'required' => array( 'responsive', '=', '1' ),
                'title' => __('Extended Responsive Design', NECTAR_THEME_NAME), 
                'subtitle' => __('This will enhance the way the theme responds when viewing on screens larger than 1000px & increase the max width.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '1' 
            ),
             array(
                'id' => 'lightbox_script', 
                'type' => 'select', 
                'title' => __('Theme Lightbox', NECTAR_THEME_NAME),
                'subtitle' => 'Please choose your desired lightbox script here',
                'options' => array(
                    "pretty_photo" => "Pretty Photo",
                    "magnific" => "Magnific",
                    "none" => "None"
                ),
                'default' => 'pretty_photo' 
            ),
            array(
                'id' => 'default-lightbox',
                'type' => 'checkbox',
                'title' => __('Auto Lightbox Image Links', NECTAR_THEME_NAME), 
                'subtitle' => __('This will allow all image links to open in a lightbox - including the images links within standard WordPress galleries.', NECTAR_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'default' => '0' 
            ),

             array(
                'id' => 'column_animation_easing', 
                'type' => 'select', 
                'title' => __('Column/Image Animation Easing', NECTAR_THEME_NAME),
                'subtitle' => 'This is the easing that will be used on all animated column/images you set',
                'options' => array(
                    'linear'=>'linear',
                    'swing'=>'swing',
                    'easeInQuad'=>'easeInQuad',
                    'easeOutQuad' => 'easeOutQuad',
                    'easeInOutQuad'=>'easeInOutQuad',
                    'easeInCubic'=>'easeInCubic',
                    'easeOutCubic'=>'easeOutCubic',
                    'easeInOutCubic'=>'easeInOutCubic',
                    'easeInQuart'=>'easeInQuart',
                    'easeOutQuart'=>'easeOutQuart',
                    'easeInOutQuart'=>'easeInOutQuart',
                    'easeInQuint'=>'easeInQuint',
                    'easeOutQuint'=>'easeOutQuint',
                    'easeInOutQuint'=>'easeInOutQuint',
                    'easeInExpo'=>'easeInExpo',
                    'easeOutExpo'=>'easeOutExpo',
                    'easeInOutExpo'=>'easeInOutExpo',
                    'easeInSine'=>'easeInSine',
                    'easeOutSine'=>'easeOutSine',
                    'easeInOutSine'=>'easeInOutSine',
                    'easeInCirc'=>'easeInCirc',
                    'easeOutCirc'=>'easeOutCirc',
                    'easeInOutCirc'=>'easeInOutCirc',
                    'easeInElastic'=>'easeInElastic',
                    'easeOutElastic'=>'easeOutElastic',
                    'easeInOutElastic'=>'easeInOutElastic',
                    'easeInBack'=>'easeInBack',
                    'easeOutBack'=>'easeOutBack',
                    'easeInOutBack'=>'easeInOutBack',
                    'easeInBounce'=>'easeInBounce',
                    'easeOutBounce'=>'easeOutBounce',
                    'easeInOutBounce'=>'easeInOutBounce'
                ),
                'default' => 'easeOutCubic' 
            ),
            array(
                'id' => 'column_animation_timing', 
                'type' => 'text', 
                'title' => __('Column/Image Animation Timing', NECTAR_THEME_NAME),
                'subtitle' => __('Enter the time in miliseconds e.g. "400" - default is "650"', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '650'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'CSS/Script Related', 'redux-framework-demo' ),
        'id'               => 'general-settings-extra',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id' => 'external-dynamic-css',
                'type' => 'checkbox',
                'title' => __('Move Dynamic/Custom CSS Into External Stylesheet?', NECTAR_THEME_NAME), 
                'subtitle' => __('This gives you the option move all the dynamic css that lives in the head by default into its own file for aesthetic & caching purposes. <b>Note:</b> your server will need the ability/permission to write to the static file (dynamic-combined.css) using file_put_contents', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
            array(
                'id' => 'google-analytics',
                'type' => 'textarea',
                'title' => __('Google Analytics', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter in your google analytics tracking code here. <br/> Remember to include the <strong>entire script from google</strong>, if you just enter your tracking ID it won\'t work.', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME)
            ),
            array(
                'id' => 'google-maps-api-key', 
                'type' => 'text', 
                'title' => __('Google Maps API Key', NECTAR_THEME_NAME),
                'subtitle' => __('In order to use Google maps you need to generate an API key and enter it here - please see the <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key">official documentation</a> for more information', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => ''
            ),
             array(
                'id'=>'custom-css',
                'type' => 'ace_editor',
                'title' => __('Custom CSS Code', NECTAR_THEME_NAME), 
                'subtitle' => __('If you have any custom CSS you would like added to the site, please enter it here.', NECTAR_THEME_NAME),
                'mode' => 'css',
                'theme' => 'monokai',
                'desc' => ''
            )
        )
    ) );


    

    Redux::setSection( $opt_name, array(
        'id'               => 'accent-color',
        'customizer_width' => '450px',
        'icon' => 'el el-brush',
        'title' => __('Accent Colors', NECTAR_THEME_NAME),
        'desc' => __('All accent color related options are listed here.', NECTAR_THEME_NAME),
        'fields'           => array(
              array(
                'id' => 'accent-color',
                'type' => 'color',
                 'transparent' => false,
                'title' => __('Accent Color', NECTAR_THEME_NAME), 
                'subtitle' => __('Change this color to alter the accent color globally for your site.', NECTAR_THEME_NAME), 
                'desc' => '',
                'default' => '#27CCC0'
            ),
            array(
                'id' => 'extra-color-1',
                'type' => 'color',
                 'transparent' => false,
                'title' => __('Extra Color #1', NECTAR_THEME_NAME), 
                'subtitle' => __('Applicable theme elements will have the option to choose this as a color <br/> (i.e. buttons, icons etc..)', NECTAR_THEME_NAME), 
                'desc' => '',
                'default' => '#f6653c'
            ),
            array(
                'id' => 'extra-color-2',
                'type' => 'color',
                 'transparent' => false,
                'title' => __('Extra Color #2', NECTAR_THEME_NAME), 
                'subtitle' => __('Applicable theme elements will have the option to choose this as a color <br/> (i.e. buttons, icons etc..)', NECTAR_THEME_NAME), 
                'desc' => '',
                'default' => '#2AC4EA'
            ),
            array(
                'id' => 'extra-color-3',
                'type' => 'color',
                 'transparent' => false,
                'title' => __('Extra Color #3', NECTAR_THEME_NAME), 
                'subtitle' => __('Applicable theme elements will have the option to choose this as a color <br/> (i.e. buttons, icons etc..)', NECTAR_THEME_NAME), 
                'desc' => '',
                'default' => '#333333'
            ),

            array(
                'id' => 'extra-color-gradient',
                'type' => 'color_gradient',
                'transparent' => false,
                'title' => __('Extra Color Gradient', NECTAR_THEME_NAME), 
                'subtitle' => __('Applicable theme elements will have the option to choose this as a color <br/> (i.e. buttons, icons etc..)', NECTAR_THEME_NAME), 
                'desc' => '',
                'default'  => array(
                    'from' => '#27CCC0',
                    'to'   => '#2ddcb5' 
                ),
            ),

             array(
                'id' => 'extra-color-gradient-2',
                'type' => 'color_gradient',
                'transparent' => false,
                'title' => __('Extra Color Gradient #2', NECTAR_THEME_NAME), 
                'subtitle' => __('Applicable theme elements will have the option to choose this as a color <br/> (i.e. buttons, icons etc..)', NECTAR_THEME_NAME), 
                'desc' => '',
                'default'  => array(
                    'from' => '#2AC4EA',
                    'to'   => '#32d6ff' 
                ),
            ),
            
        )
    ) );


    
     Redux::setSection( $opt_name, array(
        'id'               => 'boxed-layout',
        'customizer_width' => '450px',
        'icon' => 'el el-website',
        'title' => __('Boxed Layout', NECTAR_THEME_NAME),
        'desc' => __('All boxed layout related options are listed here.', NECTAR_THEME_NAME),
        'fields'           => array(
             array(
                'id' => 'boxed_layout',
                'type' => 'switch',
                'title' => __('Enable Boxed Layout?', NECTAR_THEME_NAME), 
                'subtitle' => __('', NECTAR_THEME_NAME),
                'desc' => '',
                'next_to_hide' => '6',
                'default' => '0' 
            ),
            array(
                'id' => 'background-color',
                'type' => 'color',
                'title' => __('Background Color', NECTAR_THEME_NAME), 
                'subtitle' => __('If you would rather simply use a solid color for your background, select one here.', NECTAR_THEME_NAME), 
                'desc' => '',
                'transparent' => false,
                'required' => array( 'boxed_layout', '=', '1' ),
                'default' => '#f1f1f1'
            ),    
            array(
                'id' => 'background_image',
                'type' => 'media',
                'title' => __('Background Image', NECTAR_THEME_NAME), 
                'subtitle' => __('Upload your background here', NECTAR_THEME_NAME),
                'required' => array( 'boxed_layout', '=', '1' ),
                'desc' => ''
            ),
            array(
                'id' => 'background-repeat', 
                'type' => 'select', 
                'title' => __('Background Repeat', NECTAR_THEME_NAME),
                'subtitle' => __('Do you want your background to repeat? (Turn on when using patterns)', NECTAR_THEME_NAME), 
                'required' => array( 'boxed_layout', '=', '1' ),
                'options' => array(
                    "no-repeat" => "No-Repeat",
                    "repeat" => "Repeat"
                )
            ),
            array(
                'id' => 'background-position', 
                'type' => 'select', 
                'title' => __('Background Position', NECTAR_THEME_NAME),
                'subtitle' => __('How would you like your background image to be aligned?', NECTAR_THEME_NAME),
                'required' => array( 'boxed_layout', '=', '1' ),
                'options' => array(
                    "left top" => "Left Top",
                     "left center" => "Left Center",
                     "left bottom" => "Left Bottom",
                     "center top" => "Center Top",
                     "center center" => "Center Center",
                     "center bottom" => "Center Bottom",
                     "right top" => "Right Top",
                     "right center" => "Right Center",
                     "right bottom" => "Right Bottom"
                )
            ),
            array(
                'id' => 'background-attachment', 
                'type' => 'select', 
                'title' => __('Background Attachment', NECTAR_THEME_NAME),
                'subtitle' => __('Would you prefer your background to scroll with your site or be fixed and not move', NECTAR_THEME_NAME),
                'required' => array( 'boxed_layout', '=', '1' ),
                'options' => array(
                    "scroll" => "Scroll",
                    "fixed" => "Fixed"
                )
            ),
            array(
                'id' => 'background-cover',
                'type' => 'checkbox',
                'title' => __('Auto resize background image to fit window?', NECTAR_THEME_NAME), 
                'subtitle' => __('This will ensure your background image always fits no matter what size screen the user has. (Don\'t use with patterns)', NECTAR_THEME_NAME),
                'required' => array( 'boxed_layout', '=', '1' ),
                'desc' => '',
                'default' => '0' 
            ),
            
        )
    ) );
    

     // -> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Typography', 'redux-framework-demo' ),
        'id'     => 'typography',
        'desc'   => __( 'All typography related options are listed here', 'redux-framework-demo' ),
        'icon'   => 'el el-font',
        'fields' => array(
           
        )
    ) );
    

    $nectar_std_fonts = array(
        'Arial, sans-serif'                                    => 'Arial',
        'Cambria, Georgia, serif'                              => 'Cambria',
        'Copse, sans-serif'                                    => 'Copse',
        "Courier, monospace"                                   => "Courier, monospace",
        "Garamond, serif"                                      => "Garamond",
        "Georgia, serif"                                       => "Georgia",
        "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
        'Helvetica, sans-serif'                                => 'Sans Serif',
        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
        "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
        "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
        "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
        "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
        "Tahoma,Geneva, sans-serif"                            => "Tahoma",
        "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
        "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
        'Lovelo, sans-serif' => 'Lovelo'
    );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Navigation & Page Header', 'redux-framework-demo' ),
        'id'               => 'typography-slider',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id' => 'extended-theme-font',
                'type' => 'checkbox',
                'title' => __('Load Ext. Characters in Default Font', NECTAR_THEME_NAME),
                'subtitle' => 'Check this option if you wish to use ext latin characters in the default theme font',
                'default' => '0' 
            ),

            array(
                'id'       => 'navigation_font_family',
                'type'     => 'typography',
                'title'    => __( 'Navigation Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Navigation font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),
            array(
                'id'       => 'navigation_dropdown_font_family',
                'type'     => 'typography',
                'title'    => __( 'Navigation Dropdown Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Navigation Dropdown font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'compiler' => true,
                'default'  => array()
            ),
            
        
            array(
                'id'       => 'page_heading_font_family',
                'type'     => 'typography',
                'title'    => __( 'Page Heading Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Page Heading font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),

             array(
                'id'       => 'page_heading_subtitle_font_family',
                'type'     => 'typography',
                'title'    => __( 'Page Heading Subtitle Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Page Heading Subtitle font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $nectar_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

             array(
                'id'       => 'off_canvas_nav_font_family',
                'type'     => 'typography',
                'title'    => __( 'Off Canvas Navigation', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Off Canvas Navigation properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $nectar_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

             array(
                'id'       => 'off_canvas_nav_subtext_font_family',
                'type'     => 'typography',
                'title'    => __( 'Off Canvas Navigation Sub Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Off Canvas Navigation Sub Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'General HTML elements', 'redux-framework-demo' ),
        'id'               => 'typography-general',
        'subsection'       => true,
        'fields'           => array(
             array(
                'id'       => 'body_font_family',
                'type'     => 'typography',
                'title'    => __( 'Body Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Body font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $nectar_std_fonts,
                'all_styles'  => false,
                'default'  => array()
               
            ),
             array(
                'id'       => 'h1_font_family',
                'type'     => 'typography',
                'title'    => __( 'Heading 1', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the H1 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),

             array(
                'id'       => 'h2_font_family',
                'type'     => 'typography',
                'title'    => __( 'Heading 2', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the H2 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $nectar_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

              array(
                'id'       => 'h3_font_family',
                'type'     => 'typography',
                'title'    => __( 'Heading 3', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the H3 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),

            array(
                'id'       => 'h4_font_family',
                'type'     => 'typography',
                'title'    => __( 'Heading 4', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the H4 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),

             array(
                'id'       => 'h5_font_family',
                'type'     => 'typography',
                'title'    => __( 'Heading 5', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the H5 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),

            array(
                'id'       => 'h6_font_family',
                'type'     => 'typography',
                'title'    => __( 'Heading 6', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the H6 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),

            array(
                'id'       => 'i_font_family',
                'type'     => 'typography',
                'title'    => __( 'Italic', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the italic Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),

             array(
                'id'       => 'label_font_family',
                'type'     => 'typography',
                'title'    => __( 'Form Labels', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Form Label properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),
        )
    ) );

 Redux::setSection( $opt_name, array(
        'title'            => __( 'Nectar Specific elements', 'redux-framework-demo' ),
        'id'               => 'typography-nectar',
        'subsection'       => true,
        'fields'           => array(
              
              array(
                'id'       => 'nectar_slider_heading_font_family',
                'type'     => 'typography',
                'title'    => __( 'Nectar/Home Slider Heading Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Nnectar Slider Heading font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),

            array(
                'id'       => 'home_slider_caption_font_family',
                'type'     => 'typography',
                'title'    => __( 'Nectar/Home Slider Caption Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Nectar Slider Caption font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $nectar_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),


              array(
                'id'       => 'testimonial_font_family',
                'type'     => 'typography',
                'title'    => __( 'Testimonial Slider/Blockquote Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Testimonial Slider/Blockquote font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $nectar_std_fonts,
                'default'  => array()
            ),

            array(
                'id'       => 'sidebar_footer_h_font_family',
                'type'     => 'typography',
                'title'    => __( 'Sidebar, Carousel, Nectar Button & Footer Headers Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Sidebar, Carousel, Nectar Button & Footer Headers font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $nectar_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

           

             array(
                'id'       => 'team_member_h_font_family',
                'type'     => 'typography',
                'title'    => __( 'Sub-headers & Team Member Names Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Sub-headers & Team Member Name properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $nectar_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

              array(
                'id'       => 'nectar_dropcap_font_family',
                'type'     => 'typography',
                'title'    => __( 'Dropcap', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the dropcap font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $nectar_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

             
        )
    ) );



    
     Redux::setSection( $opt_name, array(
        'title'  => __( 'Header Navigation', 'redux-framework-demo' ),
        'id'     => 'header-nav',
        'desc'   => __( 'All header navigation related options are listed here.', 'redux-framework-demo' ),
        'icon'   => 'el el-lines',
        'fields' => array(
           
        )
    ) );




Redux::setSection( $opt_name, array(
        'title'            => __( 'Logo & General Styling', 'redux-framework-demo' ),
        'id'               => 'header-nav-general',
        'subsection'       => true,
        'fields'           => array(
              
             array(
                'id' => 'use-logo',
                'type' => 'switch',
                'title' => __('Use Image for Logo?', NECTAR_THEME_NAME), 
                'subtitle' => __('If left unchecked, plain text will be used instead (generated from site name).', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'logo',
                'type' => 'media', 
                'title' => __('Logo Upload', NECTAR_THEME_NAME), 
                'subtitle' => __('Upload your logo here and enter the height of it below', NECTAR_THEME_NAME),
                'required' => array( 'use-logo', '=', '1' ),
                'desc' => '' 
            ),
            array(
                'id' => 'retina-logo',
                'type' => 'media', 
                'title' => __('Retina Logo Upload', NECTAR_THEME_NAME), 
                'subtitle' => __('Upload at exactly 2x the size of your standard logo. Supplying this will keep your logo crisp on screens with a higher pixel density.', NECTAR_THEME_NAME),
                'desc' => '' ,
                 'required' => array( 'use-logo', '=', '1' )
            ),
            array(
                'id' => 'logo-height', 
                'type' => 'text', 
                'title' => __('Logo Height', NECTAR_THEME_NAME),
                'subtitle' => __('Don\'t include "px" in the string. e.g. 30', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric',
                 'required' => array( 'use-logo', '=', '1' ),
            ),
            array(
                'id' => 'mobile-logo-height', 
                'type' => 'text', 
                'title' => __('Mobile Logo Height', NECTAR_THEME_NAME),
                'subtitle' => __('Don\'t include "px" in the string. e.g. 24', NECTAR_THEME_NAME),
                'desc' => '',
                 'required' => array( 'use-logo', '=', '1' ),
                'validate' => 'numeric'
            ),
            array(
                'id' => 'header-padding', 
                'type' => 'text', 
                'title' => __('Header Padding', NECTAR_THEME_NAME),
                'subtitle' => __('Don\'t include "px" in the string. e.g. 28', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            
           


             array(
                'id' => 'header-mobile-fixed',
                'type' => 'checkbox',
                'title' => __('Header Sticky On Mobile', NECTAR_THEME_NAME), 
                'subtitle' => __('Do you want the header to be sticky on mobile devices?', NECTAR_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'default' => '1' 
            ),
           
           
            
              array(
                'id' => 'header-bg-opacity',
                'type'      => 'slider',
                'title'     => __('Header BG Opacity', NECTAR_THEME_NAME),
                'subtitle'  => __('Please select your header BG opacity here', NECTAR_THEME_NAME),
                'desc'      => __('', NECTAR_THEME_NAME),
                "default"   => 100,
                "min"       => 1,
                "step"      => 1,
                "max"       => 100,
                'display_value' => 'label'
            ),

            
            array(
                'id' => 'header-color', 
                'type' => 'select', 
                'title' => __('Header Color Scheme', NECTAR_THEME_NAME),
                'subtitle' => __('Please select your header color scheme here.', NECTAR_THEME_NAME),
                'desc' => '',
                'options' => array(
                    'light' => __('Light', NECTAR_THEME_NAME), 
                    'dark' => __('Dark', NECTAR_THEME_NAME),
                    'custom' => __('Custom', NECTAR_THEME_NAME)
                ),
                'default' => 'light'
            ),
        

            array(
                'id' => 'header-background-color',
                'type' => 'color',
                'title' => '', 
                'subtitle' => __('Header Background', NECTAR_THEME_NAME),
                'desc' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'required' => array( 'header-color', '=', 'custom' ),
                'default' => '#ffffff'
            ),
            
            array(
                'id' => 'header-font-color',
                'type' => 'color',
                'title' => '', 
                'subtitle' => __('Header Font', NECTAR_THEME_NAME), 
                'class' => 'five-columns',
                'required' => array( 'header-color', '=', 'custom' ),
                'transparent' => false,
                'desc' => '',
                'default' => '#888888'
            ),
            
            array(
                'id' => 'header-font-hover-color',
                'type' => 'color',
                'title' => '', 
                'subtitle' => __('Header Font Hover', NECTAR_THEME_NAME),
                'required' => array( 'header-color', '=', 'custom' ),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#27CCC0'
            ),
            
            array(
                'id' => 'header-dropdown-background-color',
                'type' => 'color',
                'title' => '', 
                'class' => 'five-columns',
                'transparent' => false,
                'subtitle' => __('Dropdown Background', NECTAR_THEME_NAME), 
                'required' => array( 'header-color', '=', 'custom' ),
                'desc' => '',
                'default' => '#1F1F1F'
            ),
            
            array(
                'id' => 'header-dropdown-background-hover-color',
                'type' => 'color',
                'title' => '', 
                'subtitle' => __('Dropdown Background Hover', NECTAR_THEME_NAME), 
                'required' => array( 'header-color', '=', 'custom' ),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#313233'
            ),
            
            array(
                'id' => 'header-dropdown-font-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => __('Dropdown Font', NECTAR_THEME_NAME), 
                'required' => array( 'header-color', '=', 'custom' ),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#CCCCCC'
            ),
            
            array(
                'id' => 'header-dropdown-font-hover-color',
                'type' => 'color',
                'title' => '',
                'required' => array( 'header-color', '=', 'custom' ),
                'subtitle' => __('Dropdown Font Hover', NECTAR_THEME_NAME), 
                'desc' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'default' => '#27CCC0'
            ),
            
            array(
                'id' => 'secondary-header-background-color',
                'type' => 'color',
                'title' => '', 
                'required' => array( 'header-color', '=', 'custom' ),
                'subtitle' => __('2nd Header Background', NECTAR_THEME_NAME), 
                'desc' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'default' => '#F8F8F8'
            ),
            
            array(
                'id' => 'secondary-header-font-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => __('2nd Header Font', NECTAR_THEME_NAME), 
                'required' => array( 'header-color', '=', 'custom' ),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#666666'
            ),
            
            array(
                'id' => 'secondary-header-font-hover-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => __('2nd Header Font Hover', NECTAR_THEME_NAME), 
                'required' => array( 'header-color', '=', 'custom' ),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#222222'
            ),

             array(
                'id' => 'header-slide-out-widget-area-background-color',
                'type' => 'color',
                'title' => '', 
                'subtitle' => __('Slide Out Widget Background', NECTAR_THEME_NAME),
                'required' => array( 'header-color', '=', 'custom' ),
                'desc' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'default' => '#27CCC0'
            ),
            
             array(
                'id' => 'header-slide-out-widget-area-header-color',
                'type' => 'color',
                'title' => '', 
                'subtitle' => __('Slide Out Widget Headers', NECTAR_THEME_NAME), 
                'required' => array( 'header-color', '=', 'custom' ),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#ffffff'
            ),

            array(
                'id' => 'header-slide-out-widget-area-color',
                'type' => 'color',
                'title' => '', 
                'subtitle' => __('Slide Out Widget Text', NECTAR_THEME_NAME), 
                'required' => array( 'header-color', '=', 'custom' ),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#eefbfa'
            ),
            
            array(
                'id' => 'header-slide-out-widget-area-hover-color',
                'type' => 'color',
                'title' => '', 
                'subtitle' => __('Slide Out Widget Link Hover', NECTAR_THEME_NAME),
                'class' => 'five-columns',
                'required' => array( 'header-color', '=', 'custom' ),
                'transparent' => false,
                'desc' => '',
                'default' => '#ffffff'
            ),
            
                 
       
            

             
        )
    ) );





Redux::setSection( $opt_name, array(
        'title'            => __( 'Layout Related', 'redux-framework-demo' ),
        'id'               => 'header-nav-layout',
        'subsection'       => true,
        'fields'           => array(
              
             
            array(
                'id' => 'header_format',
                'type' => 'image_select',
                'title' => __('Header Layout', NECTAR_THEME_NAME), 
                'subtitle' => __('Please select the layout you desire', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'options' => array(
                                'default' => array('title' => 'Default Layout', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/default-header.png'),
                                'centered-menu' => array('title' => 'Centered Menu', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/centered-menu.png'),
                                'centered-menu-under-logo' => array('title' => 'Centered Menu Alt', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/centered-menu-under-logo.png'),
                                'centered-logo-between-menu' => array('title' => 'Centered Logo Between Menu', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/centered-logo-menu.png')
                            ),
                'default' => 'default'
            ),  
            array(
                'id' => 'header-fullwidth',
                'type' => 'checkbox',
                'title' => __('Full Width Header', NECTAR_THEME_NAME), 
                'subtitle' => __('Do you want the header to span the full width of the page?', NECTAR_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'default' => '0' 
            ),

            array(
                'id' => 'header-disable-search',
                'type' => 'checkbox',
                'title' => __('Remove Header search', NECTAR_THEME_NAME), 
                'subtitle' => __('Active to remove the search functionality from your header', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),

             array(
                'id' => 'header-disable-ajax-search',
                'type' => 'checkbox',
                'title' => __('Disable AJAX from search', NECTAR_THEME_NAME), 
                'subtitle' => __('This will turn off the autocomplete suggestions from appearing when typing in the search box.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),

             array(
                'id' => 'header_layout', 
                'type' => 'select', 
                'title' => __('Header Secondary Nav', NECTAR_THEME_NAME),
                'subtitle' => __('Please select your header layout here.', NECTAR_THEME_NAME),
                'desc' => '',
                'options' => array(
                    'standard' => __('Standard Header', NECTAR_THEME_NAME), 
                    'header_with_secondary' => __('Header With Secondary Navigation', NECTAR_THEME_NAME),
                ),
                'default' => 'standard'
            ),
            array(
                'id' => 'enable_social_in_header',
                'type' => 'switch',
                'title' => __('Enable Social Icons?', NECTAR_THEME_NAME), 
                'subtitle' => __('Do you want the secondary nav to display social icons?', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0'
            ),  
             array(
                'id' => 'use-facebook-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Facebook Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => '',
                'required' => array( 'enable_social_in_header', '=', '1' ),
            ),
            array(
                'id' => 'use-twitter-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Twitter Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => '',
                'required' => array( 'enable_social_in_header', '=', '1' ),
            ),
            array(
                'id' => 'use-google-plus-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Google+ Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => '',
                'required' => array( 'enable_social_in_header', '=', '1' ),
            ),
            array(
                'id' => 'use-vimeo-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Vimeo Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => '',
                'required' => array( 'enable_social_in_header', '=', '1' ),
            ),
            array(
                'id' => 'use-dribbble-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Dribbble Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'desc' => ''
            ),
            array(
                'id' => 'use-pinterest-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Pinterest Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-youtube-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Youtube Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-tumblr-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Tumblr Icon', NECTAR_THEME_NAME),
                'required' => array( 'enable_social_in_header', '=', '1' ), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-linkedin-icon-header',
                'type' => 'checkbox',
                'title' => __('Use LinkedIn Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-rss-icon-header',
                'type' => 'checkbox',
                'title' => __('Use RSS Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-behance-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Behance Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-instagram-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Instagram Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-flickr-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Flickr Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-spotify-icon-header',
                'type' => 'checkbox',
                'title' => __('Use Spotify Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-github-icon-header',
                'type' => 'checkbox',
                'title' => __('Use GitHub Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-stackexchange-icon-header',
                'type' => 'checkbox',
                'title' => __('Use StackExchange Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-soundcloud-icon-header',
                'type' => 'checkbox',
                'title' => __('Use SoundCloud Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
             array(
                'id' => 'use-vk-icon-header',
                'type' => 'checkbox',
                'title' => __('Use VK Icon', NECTAR_THEME_NAME), 
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-vine-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => __('Use Vine Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            )
            

             
        )
    ) );

            
            




     Redux::setSection( $opt_name, array(
        'title'            => __( 'Transparency', 'redux-framework-demo' ),
        'id'               => 'header-nav-transparency',
        'subsection'       => true,
        'fields'           => array(
              
             
            array(
                'id' => 'transparent-header',
                'type' => 'switch',
                'title' => __('Use Transparent Header When Applicable?', NECTAR_THEME_NAME), 
                'subtitle' => __('If activated this will cause your header to be completely transparent before the user scrolls. Valid instances where this will get used include using a Page Header or using a Full width/screen Nectar Slider at the top of a page.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0'
            ),
            
            array(
                'id' => 'header-starting-logo',
                'type' => 'media', 
                'title' => __('Header Starting Logo Upload', NECTAR_THEME_NAME), 
                'subtitle' => __('This will be used when the header is transparent before the user scrolls. (Will be swapped for the regualr logo upon scrolling)', NECTAR_THEME_NAME),
                'desc' => '' ,
                'required' => array( 'transparent-header', '=', '1' ),

            ),
            array(
                'id' => 'header-starting-retina-logo',
                'type' => 'media', 
                'title' => __('Header Starting Retina Logo Upload', NECTAR_THEME_NAME), 
                'subtitle' => __('Retina version of the header starting logo.', NECTAR_THEME_NAME),
                'required' => array( 'transparent-header', '=', '1' ),
                'desc' => ''  
            ),

            array(
                'id' => 'header-starting-logo-dark',
                'type' => 'media', 
                'title' => __('Header Starting Dark Logo Upload', NECTAR_THEME_NAME), 
                'subtitle' => __('This will be used when on a Nectar Slide set to use the dark text color and the header is transparent before the user scrolls. (If nothing is uploaded, the default logo will be used)', NECTAR_THEME_NAME),
                'desc' => '' ,
                'required' => array( 'transparent-header', '=', '1' ),
            ),
            array(
                'id' => 'header-starting-retina-logo-dark',
                'type' => 'media', 
                'title' => __('Header Starting Dark Retina Logo Upload', NECTAR_THEME_NAME), 
                'subtitle' => __('Retina version of the header starting dark logo.  (If nothing is uploaded, the default logo will be used)', NECTAR_THEME_NAME),
                'desc' => '',
                'required' => array( 'transparent-header', '=', '1' ), 
            ),
            
            array(
                'id' => 'header-starting-color',
                'type' => 'color',
                'title' => __('Header Starting Text Color', NECTAR_THEME_NAME),
                'subtitle' => __('Please select the color you desire for your header text before the user scrolls', NECTAR_THEME_NAME),
                'desc' => '',
                'transparent' => false,
                'required' => array( 'transparent-header', '=', '1' ),
                'default' => '#ffffff'
            ),
            array(
                'id' => 'header-transparent-dark-color',
                'type' => 'color',
                'title' => __('Header Dark Text Color', NECTAR_THEME_NAME),
                'subtitle' => __('Please select the color you desire for your header navigation links when the dark header is triggered. This occurs on dark Nectar Slides, dark rows when using permenant transparent etc.', NECTAR_THEME_NAME),
                'desc' => '',
                'transparent' => false,
                'required' => array( 'transparent-header', '=', '1' ),
                'default' => '#000000'
            ),
            array(
                'id' => 'header-permanent-transparent',
                'type' => 'checkbox',
                'switch' => true,
                'title' => __('Header Permanent Transparent', NECTAR_THEME_NAME), 
                'subtitle' => __('Turning this on will allow your header to remain transparent even after scroll down', NECTAR_THEME_NAME),
                'required' => array( 'transparent-header', '=', '1' ),
                'desc' => '',
                'default' => '0' 
            ),
            array(
                'id' => 'header-inherit-row-color',
                'type' => 'checkbox',
                'title' => __('Header Inherit Row Color', NECTAR_THEME_NAME), 
                'subtitle' => __('Turning this on will allow your header to take on the background & text colors of the row that it passes. (Ideal for one page sites) <br/> <br/>  See <a href="https://www.youtube.com/user/ThemeNectar">tutorial</a> for full example and details', NECTAR_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'required' => array( 'transparent-header', '=', '1' ),
                'default' => '0' 
            ),
            array(
                'id' => 'header-remove-border',
                'type' => 'checkbox',
                'title' => __('Remove Border On Transparent Header', NECTAR_THEME_NAME), 
                'subtitle' => __('Turning this on will remove the border that normally appears with the transparent header', NECTAR_THEME_NAME),
                'desc' => '',
                'required' => array( 'transparent-header', '=', '1' ),
                'default' => '0' 
            ),

             
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'Animation Effects', 'redux-framework-demo' ),
        'id'               => 'header-nav-animation-effects',
        'subsection'       => true,
        'fields'           => array(
              
             
            array(
                'id' => 'header-hover-effect', 
                'type' => 'select', 
                'title' => __('Header Link Hover/Active Effect', NECTAR_THEME_NAME),
                'subtitle' => __('Please select your header link hover/active effect here.', NECTAR_THEME_NAME),
                'desc' => '',
                'options' => array(
                    'default' => __('Color Change (default)', NECTAR_THEME_NAME), 
                    'animated_underline' => __('Animated Underline', NECTAR_THEME_NAME)
                ),
                'default' => 'default'
            ),
            array(
                'id' => 'header-hide-until-needed',
                'type' => 'checkbox',
                'title' => __('Header Hide Until Needed', NECTAR_THEME_NAME), 
                'subtitle' => __('Do you want the header to be hidden after scrolling until needed? i.e. the user scrolls back up towards the top', NECTAR_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'default' => '' 
            ),

             array(
                'id' => 'header-resize-on-scroll',
                'type' => 'switch',
                'title' => __('Header Resize On Scroll', NECTAR_THEME_NAME), 
                'subtitle' => __('Do you want the header to shrink a little when you scroll?', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '1' 
            ), 
            array(
                'id' => 'header-resize-on-scroll-shrink-num', 
                'type' => 'text', 
                'title' => __('Header Logo Shrink Number (in px)', NECTAR_THEME_NAME),
                'subtitle' => __('Don\'t include "px" in the string. e.g. 6', NECTAR_THEME_NAME),
                'desc' => '',
                 'required' => array( 'header-resize-on-scroll', '=', '1' ),
                'validate' => 'numeric'
            ),
            

             
        )
    ) );


Redux::setSection( $opt_name, array(
        'title'            => __( 'Off Canvas Navigation', 'redux-framework-demo' ),
        'id'               => 'header-nav-off-canvas-navigation',
        'subsection'       => true,
        'fields'           => array(
              
          array(
                'id' => 'header-slide-out-widget-area-style', 
                'type' => 'select', 
                'title' => __('Off Canvas Menu Style', NECTAR_THEME_NAME),
                'subtitle' => __('Please select your off canvas menu style here. <br/> The "Slide Out From Right Hover Triggered" style will force the "Full Width Header" option regardless of your selection.', NECTAR_THEME_NAME),
                'desc' => '',
                'options' => array(
                    'slide-out-from-right' => __('Slide Out From Right', NECTAR_THEME_NAME), 
                    'slide-out-from-right-hover' => __('Slide Out From Right Hover Triggered', NECTAR_THEME_NAME), 
                    'fullscreen' => __('Fullscreen Cover Slide + Blur BG', NECTAR_THEME_NAME),
                    'fullscreen-alt' => __('Fullscreen Cover Fade', NECTAR_THEME_NAME)
                ),
                'default' => 'slide-out-from-right',
            ),
          array(
                'id' => 'header-slide-out-widget-area',
                'type' => 'switch',
                'title' => __('Off Canvas Menu', NECTAR_THEME_NAME), 
                'subtitle' => __('This will add a header link that reveals an off canvas menu', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
            array(
                'id' => 'header-slide-out-widget-area-icon-animation', 
                'type' => 'select', 
                'title' => __('Off Canvas Menu Hamburger Animation', NECTAR_THEME_NAME),
                'subtitle' => __('Please select your off canvas menu hamburger icon animation here.', NECTAR_THEME_NAME),
                'desc' => '',
                'options' => array(
                    'spin-and-transform' => __('Spin & Transform', NECTAR_THEME_NAME), 
                    'simple-transform' => __('Simple Transform', NECTAR_THEME_NAME)
                ),
                'default' => 'simple-transform',
                'required' => array( 'header-slide-out-widget-area', '=', '1' ),
            ),
            array(
                'id' => 'header-slide-out-widget-area-social',
                'type' => 'checkbox',
                'title' => __('Off Canvas Menu Add Social', NECTAR_THEME_NAME), 
                'subtitle' => __('This will add the social links you have links set for in the "Social Media" tab to your off canvas menu', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' ,
                  'required' => array( 'header-slide-out-widget-area', '=', '1' ),
            ),
             array(
                'id' => 'header-slide-out-widget-area-bottom-text',
                'type' => 'text',
                'title' => __('Off Canvas Menu Bottom Text', NECTAR_THEME_NAME), 
                 'required' => array( 'header-slide-out-widget-area', '=', '1' ),
                'subtitle' => __('This will add some text fixed at the bottom of your off canvas menu - useful for copyright or quick contact info etc.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '' 
            ),
            array(
                'id' => 'header-slide-out-widget-area-overlay-opacity', 
                'type' => 'select', 
                'title' => __('Off Canvas Menu Overlay Strength', NECTAR_THEME_NAME),
                'subtitle' => __('Please select your Slide Out Widget Area overlay strength here.', NECTAR_THEME_NAME),
                'desc' => '',
                 'required' => array( 'header-slide-out-widget-area', '=', '1' ),
                'options' => array(
                    'solid' => __('Solid', NECTAR_THEME_NAME), 
                    'dark' => __('Dark', NECTAR_THEME_NAME), 
                    'medium' => __('Medium', NECTAR_THEME_NAME),
                    'light' => __('Light', NECTAR_THEME_NAME)
                ),
                'default' => 'dark'
            ),
            array(
                'id' => 'header-slide-out-widget-area-top-nav-in-mobile',
                'type' => 'checkbox',
                  'required' => array( 'header-slide-out-widget-area', '=', '1' ),
                'title' => __('Off Canvas Menu Mobile Nav Menu items', NECTAR_THEME_NAME), 
                'subtitle' => __('This will cause your off canvas menu to inherit any navigation items assigned in your "Top Navigation" menu location when viewing on a mobile device', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
            

             
        )
    ) );



    
     Redux::setSection( $opt_name, array(
        'title'  => __( 'Footer', 'redux-framework-demo' ),
        'id'     => 'footer',
        'desc'   => __( 'All footer related options are listed here.', 'redux-framework-demo' ),
        'icon'   => 'el el-file',
        'fields' => array(
             array(
                'id' => 'enable-main-footer-area',
                'type' => 'switch',
                'title' => __('Main Footer Area', NECTAR_THEME_NAME), 
                'subtitle' => __('Do you want use the main footer that contains all the widgets areas?', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '1' 
            ), 
            
            array(
                'id' => 'footer_columns',
                'type' => 'image_select',
                'required' => array( 'enable-main-footer-area', '=', '1' ),
                'title' => __('Footer Columns', NECTAR_THEME_NAME), 
                'subtitle' => __('Please select the number of columns you would like for your footer.', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'options' => array(
                                '2' => array('title' => '2 Columns', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/2col.png'),
                                '3' => array('title' => '3 Columns', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/3col.png'),
                                '4' => array('title' => '4 Columns', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/4col.png')
                            ),
                'default' => '4'
            ),  
            
            array(
                'id' => 'footer-custom-color',
                'type' => 'switch',
                'title' => __('Custom Footer Color Scheme', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
            
            array(
                'id' => 'footer-background-color',
                'type' => 'color',
                'title' => '', 
                'subtitle' => __('Footer Background Color', NECTAR_THEME_NAME),
                'desc' => '',
                'required' => array( 'footer-custom-color', '=', '1' ),
                'class' => 'five-columns always-visible',
                'default' => '#313233',
                'transparent' => false
            ),
            
            array(
                'id' => 'footer-font-color',
                'type' => 'color',
                'title' => '', 
                 'required' => array( 'footer-custom-color', '=', '1' ),
                'subtitle' => __('Footer Font Color', NECTAR_THEME_NAME), 
                'class' => 'five-columns always-visible',
                'desc' => '',
                'default' => '#CCCCCC',
                'transparent' => false
            ),
            
            array(
                'id' => 'footer-secondary-font-color',
                'type' => 'color',
                'title' => '', 
                 'required' => array( 'footer-custom-color', '=', '1' ),
                'subtitle' => __('2nd Footer Font Color', NECTAR_THEME_NAME),
                'class' => 'five-columns always-visible',
                'desc' => '',
                'default' => '#777777',
                'transparent' => false
            ),
            
            array(
                'id' => 'footer-copyright-background-color',
                'type' => 'color',
                'title' => '', 
                 'required' => array( 'footer-custom-color', '=', '1' ),
                'class' => 'five-columns always-visible',
                'subtitle' => __('Copyright Background Color', NECTAR_THEME_NAME), 
                'desc' => '',
                'default' => '#1F1F1F',
                'transparent' => false
            ),
            
            array(
                'id' => 'footer-copyright-font-color',
                'type' => 'color',
                 'required' => array( 'footer-custom-color', '=', '1' ),
                'title' => '', 
                'class' => 'five-columns always-visible',
                'subtitle' => __('Footer Copyright Font Color', NECTAR_THEME_NAME), 
                'desc' => '',
                'default' => '#777777',
                'transparent' => false
            ),
              array(
                'id' => 'footer-copyright-line', 
                'type' => 'checkbox', 
                'title' => __('Footer Add Line Above Copyright', NECTAR_THEME_NAME),
                'subtitle' => __('This will add a thin line to separate your footer widget area from the copyright section', NECTAR_THEME_NAME),
                'default' => '' 
            ),

             array(
                'id' => 'footer-reveal',
                'type' => 'switch',
                'title' => __('Footer Reveal Effect', NECTAR_THEME_NAME), 
                'subtitle' => __('This to cause the footer to appear as though it\'s being reveal by the main content area when scrolling down to it', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ), 

              array(
                'id' => 'footer-reveal-shadow', 
                'type' => 'select', 
                'required' => array( 'footer-reveal', '=', '1' ),
                'title' => __('Footer Reveal Shadow', NECTAR_THEME_NAME),
                'subtitle' => __('Please select the type of shadow you would like to appear on your footer', NECTAR_THEME_NAME),
                'options' => array(
                    "none" => "None",
                    "small" => "Small",
                    "large" => "Large",
                    "large_2" => "Large & same color as footer BG"
                ),
                'default' => 'none'
            ),

             array(
                'id' => 'disable-copyright-footer-area',
                'type' => 'checkbox',
                'title' => __('Disable Footer Copyright Area', NECTAR_THEME_NAME), 
                'subtitle' => __('This will hide the copyright bar in your footer', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '' 
            ),  

            array(
                'id' => 'footer-copyright-text',
                'type' => 'text',
                'title' => __('Footer Copyright Section Text', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the copyright section text. e.g. All Rights Reserved, Salient Inc.', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME)
            ),
            
             array(
                'id' => 'disable-auto-copyright',
                'type' => 'checkbox',
                'title' => __('Disable Automatic Copyright', NECTAR_THEME_NAME), 
                'subtitle' => __('By default, your copyright section will say "© {YEAR} {SITENAME}" before the additional text you add above in the Footer Copyright Section Text input - This option allows you to remove that.', NECTAR_THEME_NAME), 
                'desc' => ''
            ),
            
            
            array(
                'id' => 'use-facebook-icon',
                'type' => 'checkbox',
                'title' => __('Use Facebook Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-twitter-icon',
                'type' => 'checkbox',
                'title' => __('Use Twitter Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-google-plus-icon',
                'type' => 'checkbox',
                'title' => __('Use Google+ Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-vimeo-icon',
                'type' => 'checkbox',
                'title' => __('Use Vimeo Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-dribbble-icon',
                'type' => 'checkbox',
                'title' => __('Use Dribbble Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-pinterest-icon',
                'type' => 'checkbox',
                'title' => __('Use Pinterest Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-youtube-icon',
                'type' => 'checkbox',
                'title' => __('Use Youtube Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-tumblr-icon',
                'type' => 'checkbox',
                'title' => __('Use Tumblr Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-linkedin-icon',
                'type' => 'checkbox',
                'title' => __('Use LinkedIn Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-rss-icon',
                'type' => 'checkbox',
                'title' => __('Use RSS Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-behance-icon',
                'type' => 'checkbox',
                'title' => __('Use Behance Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-instagram-icon',
                'type' => 'checkbox',
                'title' => __('Use Instagram Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-flickr-icon',
                'type' => 'checkbox',
                'title' => __('Use Flickr Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-spotify-icon',
                'type' => 'checkbox',
                'title' => __('Use Spotify Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-github-icon',
                'type' => 'checkbox',
                'title' => __('Use GitHub Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-stackexchange-icon',
                'type' => 'checkbox',
                'title' => __('Use StackExchange Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-soundcloud-icon',
                'type' => 'checkbox',
                'title' => __('Use SoundCloud Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-vk-icon',
                'type' => 'checkbox',
                'title' => __('Use VK Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-vine-icon',
                'type' => 'checkbox',
                'title' => __('Use Vine Icon', NECTAR_THEME_NAME), 
                'subtitle' => '',
                'desc' => ''
            )
        )
    ) );

    



    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Transitions', 'redux-framework-demo' ),
        'id'               => 'page_transitions',
        'desc'             => __( 'All page transition options are listed here.', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'   => 'el el-refresh',
        'fields' => array(

              array(
                'id' => 'ajax-page-loading',
                'type' => 'switch',
                'title' => __('Animated Page Transitions', NECTAR_THEME_NAME), 
                'subtitle' => __('This will enable an animation between loading your pages.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '1' 
            ),

             array(
                'id' => 'transition-method', 
                'type' => 'select', 
                'title' => __('Animated Transition Method', NECTAR_THEME_NAME),
                'subtitle' => __('<strong> AJAX </strong> will result in a smoother seamless transition, but won\'t work by default for pages that use plugins which rely on Javascript. (only recommended for advanced users) <br/><br/>  <strong>Standard</strong> will simulate the effect of AJAX loading and allow for the use of any plugins to function regularly.', NECTAR_THEME_NAME),
                'options' => array(
                    "standard" => "Standard",
                    "ajax" => "AJAX"
                ),
                'default' => 'standard'
            ),

              array(
                'id' => 'disable-transition-fade-on-click',
                'type' => 'checkbox',
                'title' => __('Disable Fade Out On Click', NECTAR_THEME_NAME), 
                'subtitle' => __('This will disable the default functionality of your page fading out when clicking a link with the Standard transition method. Is useful if your page transitions are conflicting with third party plugins that take over certain anchors such as lighboxes.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),

            array(
                'id' => 'transition-effect', 
                'type' => 'select', 
                'title' => __('Transition Effect', NECTAR_THEME_NAME),
                'subtitle' => __('Please select your transition effect here', NECTAR_THEME_NAME),
                'options' => array(
                    "standard" => "Fade with loading icon",
                    "center_mask_reveal" => "Center mask reveal"
                ),
                'default' => 'standard'
            ),

            array(
                'id' => 'loading-icon', 
                'type' => 'select', 
                'required' => array( 'transition-effect', '=', 'standard' ),
                'title' => __('Loading Icon Style', NECTAR_THEME_NAME),
                'subtitle' => __('Select your loading icon style here', NECTAR_THEME_NAME),
                'options' => array(
                    "default" => "Default",
                    "material" => "Material Design"
                ),
                'default' => 'default'
            ),
            array(
                'id' => 'loading-icon-colors',
                'type' => 'color_gradient',
                'transparent' => false,
                'title' => __('Loading Icon Coloring', NECTAR_THEME_NAME), 
                'subtitle' => __('The icon will animate between the two colors - or just use the first if a second is not supplied.', NECTAR_THEME_NAME), 
                'desc' => '',
                'required' => array( 'loading-icon', '=', 'material' ),
                'default'  => array(
                    'from' => '#27CCC0',
                    'to'   => '#2ddcb5' 
                ),
            ),
             array(
                'id' => 'loading-image',
                'type' => 'media',
                'required' => array( 'transition-effect', '=', 'standard' ),
                'title' => __('Custom Loading Image', NECTAR_THEME_NAME), 
                'subtitle' => __('Upload a .png or .gif image that will be used in all applicable areas on your site as the loading image. ', NECTAR_THEME_NAME),
                'desc' => ''
            ),
             array(
                'id' => 'loading-image-animation', 
                'type' => 'select', 
                'required' => array( 'transition-effect', '=', 'standard' ),
                'title' => __('Loading Image CSS Animation', NECTAR_THEME_NAME),
                'subtitle' => __('This will add a css based animation onto your defined image', NECTAR_THEME_NAME),
                'options' => array(
                    "none" => "Default",
                    "spin" => "Smooth Spin"
                ),
                'default' => 'none'
            ),
             array(
                'id' => 'transition-bg-color',
                'type' => 'color',
                'title' => __('Page Transition BG Color', NECTAR_THEME_NAME), 
                'subtitle' =>  __('Use this to define the color of your page transition background.', NECTAR_THEME_NAME), 
                'desc' => '',
                'default' => '',
                'transparent' => false
            )
        

        )
    ) );


    

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Header', 'redux-framework-demo' ),
        'id'               => 'page_header',
        'desc'             => __( 'All global page header options are listed here. (there are also many options located in your page header metabox available on every edit page screen which are configured on a per-page basis', 'redux-framework-demo' ),
        'customizer_width' => '400px',
         'icon'   => 'el el-file',
        'fields' => array(

               array(
                'id' => 'header-animate-in-effect', 
                'type' => 'select', 
                'title' => __('Load In Animation', NECTAR_THEME_NAME),
                'subtitle' => __('Page headers refer to any page header set in the page header meta box. <br/> <br/> <strong>None:</strong> No animation will occur (default). <br/> <strong>Slide down:</strong> Will apply for all non full screen page headers. <br/> <strong>Slight zoom out:</strong> Will apply to all page headers that have an image/video set (bg color only won\'t show the effect). <br/>', NECTAR_THEME_NAME),
                'options' => array(
                    "none" => "None",
                    "slide-down" => "Slide Down",
                    "zoom-out" => "Slight Zoom Out"
                ),
                'default' => 'none'
            ),
        

        )
    ) );
    



    Redux::setSection( $opt_name, array(
        'title'            => __( 'Form Styling', 'redux-framework-demo' ),
        'id'               => 'form_styling',
        'desc'             => __( 'All form styling options are listed here.', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-edit',
        'fields' => array(

               array(
                'id' => 'form-style', 
                'type' => 'select', 
                'title' => __('Overall Form Style', NECTAR_THEME_NAME),
                'subtitle' => __('Sets the style of all form elements used.', NECTAR_THEME_NAME),
                'options' => array(
                    "default" => "Inherit from theme skin",
                    "minimal" => "Minimal"
                ),
                'default' => 'default'
            ),

              array(
                'id' => 'form-fancy-select',
                'type' => 'switch',
                'title' => __('Enable Fancy Select/Checkbox/Radio Styling', NECTAR_THEME_NAME), 
                'subtitle' => __('This will ensure the styling of your advanced form elements look consistent on all browsers and are more user friendly.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            )
        

        )
    ) );

    

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Call To Action', 'redux-framework-demo' ),
        'id'               => 'cta',
        'desc'             => __( 'All call to action options are listed here.', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-bell',
        'fields' => array(

                array(
                'id' => 'cta-text', 
                'type' => 'text', 
                'title' => __('Call to Action Text', NECTAR_THEME_NAME),
                'subtitle' => __('Add the text that you would like to appear in the global call to action section.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'cta-btn', 
                'type' => 'text', 
                'title' => __('Call to Action Button Text', NECTAR_THEME_NAME),
                'subtitle' => __('If you would like a button to be the link in the global call to action section, please enter the text for it here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'cta-btn-link',  
                'type' => 'text', 
                'title' => __('Call to Action Button Link URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter the URL for the call to action section here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'exclude_cta_pages',
                'title' => __('Pages to Exclude the Call to Action Section', NECTAR_THEME_NAME),
                'subtitle' => __('Select any pages you wish to exclude the Call to Action section from. You can select multiple pages.', NECTAR_THEME_NAME),
                'args' => array(
                    'sort_order' => 'ASC'
                ),
                'desc' => '',
                'type'     => 'select',
                'data'     => 'pages',
                'multi'    => true,
            ),
            
            array(
                'id' => 'cta-background-color',
                'type' => 'color',
                'title' => __('Call to Action Background Color', NECTAR_THEME_NAME), 
                'subtitle' => '', 
                'desc' => '',
                'default' => '#ECEBE9',
                'transparent' => false
            ),
            
            array(
                'id' => 'cta-text-color',
                'type' => 'color',
                'title' => __('Call to Action Font Color', NECTAR_THEME_NAME), 
                'subtitle' => '', 
                'desc' => '',
                'default' => '#4B4F52',
                'transparent' => false
            ),
            
            array(
                'id' => 'cta-btn-color', 
                'type' => 'select', 
                'title' => __('Call to Action Button Color', NECTAR_THEME_NAME),
                'subtitle' => '',
                'desc' => '',
                'options' => array(
                    'accent-color' => __('Accent Color', NECTAR_THEME_NAME), 
                    'extra-color-1' => __('Extra Color 1', NECTAR_THEME_NAME),
                    'extra-color-2' => __('Extra Color 2', NECTAR_THEME_NAME),
                    'extra-color-3' => __('Extra Color 3', NECTAR_THEME_NAME),
                    'see-through' => __('See Through', NECTAR_THEME_NAME)
                ),
                'default' => 'accent-color'
            )
        

        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'Portfolio', 'redux-framework-demo' ),
        'id'               => 'portfolio',
        'desc'             => __( 'All portfolio options are listed here.', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'   => 'el el-th',
        'fields' => array(

             
            

        )
    ) );


Redux::setSection( $opt_name, array(
        'title'            => __( 'Styling', 'redux-framework-demo' ),
        'id'               => 'portfolio-style',
        'subsection'       => true,
        'fields'           => array(
                array(
                'id' => 'main_portfolio_layout',
                'type' => 'image_select',
                'title' => __('Main Layout', NECTAR_THEME_NAME), 
                'subtitle' => __('Please select the number of columns you would like for your portfolio.', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'options' => array(
                                '3' => array('title' => '3 Columns', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/3col.png'),
                                '4' => array('title' => '4 Columns', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/4col.png'),
                                'fullwidth' => array('title' => 'Full Width', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/fullwidth.png')
                            ),
                'default' => '3'
            ),  
            array(
                'id' => 'main_portfolio_project_style',
                'type' => 'radio',
                'title' => __('Project Style', NECTAR_THEME_NAME), 
                'subtitle' => __('Please select the style you would like your projects to display in on your portfolio pages.', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'options' => array(
                                '1' => __('Meta below thumb w/ links on hover', NECTAR_THEME_NAME),
                                '2' => __('Meta on hover + entire thumb link', NECTAR_THEME_NAME),
                                '3' => __("Title overlaid w/ zoom effect on hover", NECTAR_THEME_NAME),
                                '5' => __("Title overlaid w/ zoom effect on hover alt", NECTAR_THEME_NAME),
                                '4' => __("Meta from bottom on hover + entire thumb link", NECTAR_THEME_NAME),
                                '6' => __("Meta + 3D Parallax on hover", NECTAR_THEME_NAME) 
                            ),
                'default' => '1'
            ),
            array(
                'id' => 'portfolio_use_masonry', 
                'type' => 'checkbox',
                'title' => __('Masonry Style?', NECTAR_THEME_NAME),
                'subtitle' => __('This will allow your portfolio items to display in a masonry layout as opposed to a fixed grid. You can define your masonry sizes in each project. <br/><br/> If using the full width layout, will only be active with the alternative project style.', NECTAR_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'default' => '0' 
            ),  
             array(
                'id' => 'portfolio_inline_filters',
                'type' => 'checkbox',
                'title' => __('Display Filters Horizontally?', NECTAR_THEME_NAME), 
                'subtitle' => __('This will allow your filters to display horizontally instead of in a dropdown.', NECTAR_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'default' => '0' 
            ),
              array(
                'id' => 'portfolio_single_nav',
                'type' => 'radio',
                'title' => __('Single Project Page Navigation', NECTAR_THEME_NAME), 
                'subtitle' => __('Please select the navigation you would like your projects to use.', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'options' => array(
                                'in_header' => __('In Project Header', NECTAR_THEME_NAME),
                                'after_project' => __('At Bottom Of Project', NECTAR_THEME_NAME)
                            ),
                'default' => 'after_project'
            ),  
             array(
                'id' => 'portfolio_loading_animation',
                'type' => 'select',
                'title' => __('Load In Animation', NECTAR_THEME_NAME), 
                'subtitle' => __('Please select the loading animation you would like', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'options' => array(
                                "none" => "None",
                                "fade_in" => "Fade In",
                                "fade_in_from_bottom" => "Fade In From Bottom"
                            ),
                'default' => 'fade_in_from_bottom'
            ),
        )
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Functionality', 'redux-framework-demo' ),
        'id'               => 'portfolio-functionality',
        'subsection'       => true,
        'fields'           => array(
                array(
                'id' => 'portfolio_sidebar_follow', 
                'type' => 'checkbox',
                'title' => __('Portfolio Sidebar Follow on Scroll', NECTAR_THEME_NAME),
                'subtitle' => __('When supplying extra content, a sidebar enabled page can get quite tall and feel empty on the right side. Enable this option to have your sidebar follow you down the page.', NECTAR_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'default' => '0' 
            ), 
            array(
                'id' => 'portfolio_social',
                'type' => 'switch',
                'title' => __('Social Media Sharing Buttons', NECTAR_THEME_NAME), 
                'subtitle' => __('Activate this to enable social sharing buttons on your portfolio items.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '1' 
            ),  
             array(
                'id' => 'portfolio-facebook-sharing',
                'type' => 'checkbox',
                'title' => __('Facebook', NECTAR_THEME_NAME), 
                'subtitle' => __('Share it.', NECTAR_THEME_NAME),
                'default' => '1',
                'required' => array( 'portfolio_social', '=', '1' ),
                'desc' => '',
            ),
            array(
                'id' => 'portfolio-twitter-sharing',
                'type' => 'checkbox',
                'title' => __('Twitter', NECTAR_THEME_NAME), 
                'subtitle' => __('Tweet it.', NECTAR_THEME_NAME),
                  'required' => array( 'portfolio_social', '=', '1' ),
                'default' => '1', 
                'desc' => '',
            ),
             array(
                'id' => 'portfolio-google-plus-sharing',
                'type' => 'checkbox',
                  'required' => array( 'portfolio_social', '=', '1' ),
                'title' => __('Google+', NECTAR_THEME_NAME), 
                'subtitle' => __('Share it.', NECTAR_THEME_NAME),
                'default' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'portfolio-pinterest-sharing',
                'type' => 'checkbox',
                  'required' => array( 'portfolio_social', '=', '1' ),
                'title' => __('Pinterest', NECTAR_THEME_NAME), 
                'subtitle' => __('Pin it.', NECTAR_THEME_NAME),
                'default' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'portfolio-linkedin-sharing',
                'type' => 'checkbox',
                  'required' => array( 'portfolio_social', '=', '1' ),
                'title' => __('LinkedIn', NECTAR_THEME_NAME), 
                'subtitle' => __('Share it.', NECTAR_THEME_NAME),
                'default' => '1',
                'desc' => '',
            ),
            
            array(
                'id' => 'portfolio_date',
                'type' => 'checkbox',
                'title' => __('Display Dates on Projects?', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle whether or not to show the date on your projects.', NECTAR_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'default' => '1' 
            ),                                                      
            array(
                'id' => 'portfolio_pagination', 
                'type' => 'switch',
                'title' => __('Portfolio Pagination', NECTAR_THEME_NAME),
                'subtitle' => __('Would you like your portfolio items to be paginated?', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0',
            ),
             array(
                'id' => 'portfolio_pagination_type',
                'type' => 'select', 
                'title' => __('Pagination Type', NECTAR_THEME_NAME),
                'subtitle' => __('Please select your pagination type here.', NECTAR_THEME_NAME),
                'desc' => '',
                  'required' => array( 'portfolio_pagination', '=', '1' ),
                'options' => array(
                    'default' => __('Default', NECTAR_THEME_NAME), 
                    'infinite_scroll' => __('Infinite Scroll', NECTAR_THEME_NAME)
                ),
                'default' => 'default'
            ),
            array(
                'id' => 'portfolio_extra_pagination',
                'type' => 'switch',
                 'required' => array( 'portfolio_pagination', '=', '1' ),
                'title' => __('Display Pagination Numbers', NECTAR_THEME_NAME), 
                'subtitle' => __('Do you want the page numbers to be visible in your portfolio pagination?', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
            array(
                'id' => 'portfolio_pagination_number', 
                'type' => 'text', 
                 'required' => array( 'portfolio_pagination', '=', '1' ),
                'title' => __('Items Per page', NECTAR_THEME_NAME),
                'subtitle' => __('How many of your portfolio items would you like to display per page?', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),  
             array(
                'id' => 'portfolio_rewrite_slug', 
                'type' => 'text', 
                'title' => __('Custom Slug', NECTAR_THEME_NAME),
                'subtitle' => __('If you want your portfolio post type to have a custom slug in the url, please enter it here. <br/><br/> <b>You will still have to refresh your permalinks after saving this!</b> <br/>This is done by going to Settings > Permalinks and clicking save.', NECTAR_THEME_NAME),
                'desc' => ''
            ), 
            array(
                'id' => 'carousel-title', 
                'type' => 'text', 
                'title' => __('Custom Recent Projects Title', NECTAR_THEME_NAME),
                'subtitle' => __('This is be used anywhere you place the recent work shortcode and on the "Recent Work" home layout. e.g. Recent Work', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'carousel-link', 
                'type' => 'text', 
                'title' => __('Custom Recent Projects Link Text', NECTAR_THEME_NAME),
                'subtitle' => __('This is be used anywhere you place the recent work shortcode and on the "Recent Work" home layout. e.g. View All Work', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'portfolio-sortable-text', 
                'type' => 'text', 
                'title' => __('Custom Portfolio Page Sortable Text', NECTAR_THEME_NAME),
                'subtitle' => __('e.g. Sort Portfolio', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'main-portfolio-link', 
                'type' => 'text', 
                'title' => __('Main Portfolio Page URL', NECTAR_THEME_NAME),
                'subtitle' => __('This will be used to link back to your main portfolio from the more details page and for the recent projects link. i.e. The portfolio page that you are displaying all project categories on.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
             array(
                'id' => 'portfolio_same_category_single_nav',
                'type' => 'checkbox',
                'title' => __('Single Project Nav Arrows Limited To Same Category', NECTAR_THEME_NAME), 
                'subtitle' => __('This will cause your single project page next/prev arrows to lead only to projects that exist in the same category as the current.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            )
        
        )
    ) );



 Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog', 'redux-framework-demo' ),
        'id'               => 'blog',
        'desc'             => __( 'All blog options are listed here.', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-list',
        'fields' => array(

             
            

        )
    ) );



 Redux::setSection( $opt_name, array(
        'title'            => __( 'Styling', 'redux-framework-demo' ),
        'id'               => 'Blog-style',
        'subsection'       => true,
        'fields'           => array(
             array(
                'id' => 'blog_type', 
                'type' => 'select', 
                'title' => __('Blog Type', NECTAR_THEME_NAME),
                'subtitle' => __('Please select your blog format here.', NECTAR_THEME_NAME),
                'desc' => '',
                'options' => array(
                    'std-blog-sidebar' => __('Standard Blog W/ Sidebar', NECTAR_THEME_NAME), 
                    'std-blog-fullwidth' => __('Standard Blog No Sidebar', NECTAR_THEME_NAME),
                    'masonry-blog-sidebar' => __('Masonry Blog W/ Sidebar', NECTAR_THEME_NAME),
                    'masonry-blog-fullwidth' => __('Masonry Blog No Sidebar', NECTAR_THEME_NAME),
                    'masonry-blog-full-screen-width' => __('Masonry Blog Fullwidth', NECTAR_THEME_NAME)
                ),
                'default' => 'std-blog-sidebar'
            ), 
            array(
                'id' => 'blog_masonry_type',
                'type' => 'radio',
                'title' => __('Masonry Style', NECTAR_THEME_NAME), 
                'subtitle' => __('Please select the style you would like your posts to use when the masonry layout is displayed', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'options' => array(
                                'classic' => __('Classic', NECTAR_THEME_NAME),
                                'classic_enhanced' => __('Classic Enhanced', NECTAR_THEME_NAME),
                                'meta_overlaid' => __('Meta Overlaid', NECTAR_THEME_NAME)
                            ),
                'default' => 'classic'
            ),
            array(
                'id' => 'blog_loading_animation',
                'type' => 'select',
                'title' => __('Load In Animation', NECTAR_THEME_NAME), 
                'subtitle' => __('Please select the loading animation you would like', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'options' => array(
                                "none" => "None",
                                "fade_in" => "Fade In",
                                "fade_in_from_bottom" => "Fade In From Bottom"
                            ),
                'default' => 'none'
            ),
           
            array(
                'id' => 'blog_header_type', 
                'type' => 'select', 
                'title' => __('Blog Header Type', NECTAR_THEME_NAME),
                'subtitle' => __('Please select your blog header format here.', NECTAR_THEME_NAME),
                'desc' => '',
                'options' => array(
                    'default' => __('Variable height & meta overlaid', NECTAR_THEME_NAME), 
                    'default_minimal' => __('Variable height minimal', NECTAR_THEME_NAME), 
                    'fullscreen' => __('Fullscreen with meta under', NECTAR_THEME_NAME)
                ),
                'default' => 'default'
            ), 
             array(
                'id' => 'blog_hide_sidebar',
                'type' => 'checkbox',
                'title' => __('Hide Sidebar on Single Post', NECTAR_THEME_NAME), 
                'subtitle' => __('Using this will remove the sidebar from appearing on your single post page.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),  
            array(
                'id' => 'blog_hide_featured_image',
                'type' => 'checkbox',
                'title' => __('Hide Featured Image on Single Post', NECTAR_THEME_NAME), 
                'subtitle' => __('Using this will remove the featured image from appearing in the top of your single post page.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),  
             array(
                'id' => 'blog_archive_bg_image',
                'type' => 'media',
                'title' => __('Archive Header Background Image', NECTAR_THEME_NAME), 
                'subtitle' => __('Upload an optional background that will be used on all blog archive pages.', NECTAR_THEME_NAME),
                'desc' => ''
            )
            
        )
    ) );



Redux::setSection( $opt_name, array(
        'title'            => __( 'Functionality', 'redux-framework-demo' ),
        'id'               => 'blog-functionality',
        'subsection'       => true,
        'fields'           => array(
        
             array( 
                'id' => 'author_bio',
                'type' => 'checkbox',
                'title' => __('Author\'s Bio', NECTAR_THEME_NAME), 
                'subtitle' => __('Display the author\'s bio at the bottom of posts?', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'default' => '0' 
            ),
            array(
                'id' => 'blog_auto_excerpt',
                'type' => 'checkbox',
                'title' => __('Automatic Post Excerpts', NECTAR_THEME_NAME), 
                'subtitle' => __('Using this will create automatic excerpts for your posts, placing a read more button after.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),  
             array(
                'id' => 'blog_excerpt_length', 
                'type' => 'text', 
                'required' => array( 'blog_auto_excerpt', '=', '1' ),
                'title' => __('Excerpt Length', NECTAR_THEME_NAME),
                'subtitle' => __('How many words would you like to display for your post excerpts? The default is 30.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
           array(
                'id' => 'blog_next_post_link',
                'type' => 'checkbox',
                'title' => __('Next Post Link On Single Post Page', NECTAR_THEME_NAME), 
                'subtitle' => __('Using this will add a link at the bottom of every post page that leads to the next post.', NECTAR_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'default' => '0' 
            ), 

           array(
                'id' => 'blog_social',
                'type' => 'switch',
                'title' => __('Social Media Sharing Buttons', NECTAR_THEME_NAME), 
                'subtitle' => __('Activate this to enable social sharing buttons on your blog posts.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '1' 
            ),  
             array(
                'id' => 'blog-facebook-sharing',
                'type' => 'checkbox',
                'required' => array( 'blog_social', '=', '1' ),
                'title' => __('Facebook', NECTAR_THEME_NAME), 
                'subtitle' =>  __('Share it.', NECTAR_THEME_NAME),
                'default' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'blog-twitter-sharing',
                'type' => 'checkbox',
                'required' => array( 'blog_social', '=', '1' ),
                'title' => __('Twitter', NECTAR_THEME_NAME), 
                'subtitle' =>  __('Tweet it.', NECTAR_THEME_NAME),
                'default' => '1', 
                'desc' => '',
            ),
            array(
                'id' => 'blog-google-plus-sharing',
                'type' => 'checkbox',
                'required' => array( 'blog_social', '=', '1' ),
                'title' => __('Google+', NECTAR_THEME_NAME), 
                'subtitle' =>  __('Share it.', NECTAR_THEME_NAME),
                'default' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'blog-pinterest-sharing',
                'type' => 'checkbox',
                'required' => array( 'blog_social', '=', '1' ),
                'title' => __('Pinterest', NECTAR_THEME_NAME), 
                'subtitle' =>  __('Pin it.', NECTAR_THEME_NAME),
                'default' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'blog-linkedin-sharing',
                'type' => 'checkbox',
                'required' => array( 'blog_social', '=', '1' ),
                'title' => __('LinkedIn', NECTAR_THEME_NAME), 
                'subtitle' =>  __('Share it.', NECTAR_THEME_NAME),
                'default' => '1',
                'desc' => '',
            ),
            
            array(
                'id' => 'display_tags',
                'type' => 'checkbox',
                'title' => __('Display Tags', NECTAR_THEME_NAME), 
                'subtitle' => __('Display tags at the bottom of posts?', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'switch' => true,
                'default' => '0' 
            ),
            
            array(
                'id' => 'display_full_date',
                'type' => 'switch',
                'title' => __('Display Full Date', NECTAR_THEME_NAME), 
                'subtitle' => __('This will add the year to the date post meta on all blog pages.', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'default' => '0' 
            ),
            array(
                'id' => 'blog_pagination_type',
                'type' => 'select', 
                'title' => __('Pagination Type', NECTAR_THEME_NAME),
                'subtitle' => __('Please select your pagination type here.', NECTAR_THEME_NAME),
                'desc' => '',
                'options' => array(
                    'default' => __('Default', NECTAR_THEME_NAME), 
                    'infinite_scroll' => __('Infinite Scroll', NECTAR_THEME_NAME)
                ),
                'default' => 'default'
            ),
            array(
                'id' => 'extra_pagination',
                'type' => 'checkbox',
                'title' => __('Display Pagination Numbers', NECTAR_THEME_NAME), 
                'subtitle' => __('Do you want the page numbers to be visible in your pagination? (will only activate if using default pagination type)', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'switch' => true,
                'default' => '0' 
            ),
            array(
                'id' => 'recent-posts-title', 
                'type' => 'text', 
                'title' => __('Custom Recent Posts Title', NECTAR_THEME_NAME),
                'subtitle' => __('This is be used anywhere you place the recent posts shortcode and on the "Recent Posts" home layout. e.g. Recent Posts', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'recent-posts-link', 
                'type' => 'text', 
                'title' => __('Custom Recent Posts Link Text', NECTAR_THEME_NAME),
                'subtitle' => __('This is be used anywhere you place the recent posts shortcode and on the "Recent Posts" home layout. e.g. View All Posts', NECTAR_THEME_NAME),
                'desc' => ''
            ),

        )
    ) );
    

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Contact', 'redux-framework-demo' ),
        'id'               => 'contact',
        'desc'             => __( 'To convert an address into latitude & longitude please use <a href="http://www.latlong.net/convert-address-to-lat-long.html">this converter.</a>', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-phone',
        'fields' => array(

             
             array(
                'id' => 'zoom-level',
                'type' => 'text',
                'title' => __('Default Map Zoom Level', NECTAR_THEME_NAME), 
                'subtitle' => __('Value should be between 1-18, 1 being the entire earth and 18 being right at street level.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'enable-map-zoom',
                'type' => 'checkbox',
                'title' => __('Enable Map Zoom In/Out', NECTAR_THEME_NAME), 
                'subtitle' => __('Do you want users to be able to zoom in/out on the map?', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
            array(
                'id' => 'center-lat',
                'type' => 'text',
                'title' => __('Map Center Latitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the latitude for the maps center point.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'center-lng',
                'type' => 'text',
                'title' => __('Map Center Longitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the longitude for the maps center point.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'use-marker-img',
                'type' => 'switch',
                'title' => __('Use Image for Markers', NECTAR_THEME_NAME), 
                'subtitle' => __('Do you want a custom image to be used for the map markers?', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'default' => '0' 
            ),
            array(
                'id' => 'marker-img',
                'type' => 'media',
                'required' => array( 'use-marker-img', '=', '1' ),
                'title' => __('Marker Icon Upload', NECTAR_THEME_NAME), 
                'subtitle' => __('Please upload an image that will be used for all the markers on your map.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'enable-map-animation',
                'type' => 'checkbox',
                'title' => __('Enable Marker Animation', NECTAR_THEME_NAME), 
                'subtitle' => __('This will cause your markers to do a quick bounce as they load in.', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '1' 
            ),
            array(
                'id' => 'map-point-1',
               'type' => 'switch',
                'title' => __('Location #1', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle location #1', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
             array(
                'id' => 'latitude1',
                'type' => 'text',
                'required' => array( 'map-point-1', '=', '1' ),
                'title' => __('Latitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the latitude for your first location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
             array(
                'id' => 'longitude1',
                'type' => 'text',
                'required' => array( 'map-point-1', '=', '1' ),
                'title' => __('Longitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the longitude for your first location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'map-info1',
                'type' => 'textarea',
                'required' => array( 'map-point-1', '=', '1' ),
                'title' => __('Map Infowindow Text', NECTAR_THEME_NAME), 
                'subtitle' => __('If you would like to display any text in an info window for your first location, please enter it here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            
            
            array(
                'id' => 'map-point-2',
               'type' => 'switch',
                'title' => __('Location #2', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle location #2', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
             array(
                'id' => 'latitude2',
                'type' => 'text',
                'required' => array( 'map-point-2', '=', '1' ),
                'title' => __('Latitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the latitude for your second location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
             array(
                'id' => 'longitude2',
                'required' => array( 'map-point-2', '=', '1' ),
                'type' => 'text',
                'title' => __('Longitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the longitude for your second location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'map-info2',
                'type' => 'textarea',
                'required' => array( 'map-point-2', '=', '1' ),
                'title' => __('Map Infowindow Text', NECTAR_THEME_NAME), 
                'subtitle' => __('If you would like to display any text in an info window for your second location, please enter it here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            
            
            array(
                'id' => 'map-point-3',
               'type' => 'switch',
                'title' => __('Location #3', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle location #3', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
             array(
                'id' => 'latitude3',
                'type' => 'text',
                'required' => array( 'map-point-3', '=', '1' ),
                'title' => __('Latitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the latitude for your third location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
             array(
                'id' => 'longitude3',
                'required' => array( 'map-point-3', '=', '1' ),
                'type' => 'text',
                'title' => __('Longitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the longitude for your third location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'map-info3',
                'type' => 'textarea',
                'required' => array( 'map-point-3', '=', '1' ),
                'title' => __('Map Infowindow Text', NECTAR_THEME_NAME), 
                'subtitle' => __('If you would like to display any text in an info window for your third location, please enter it here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            
            
            array(
                'id' => 'map-point-4',
                'type' => 'switch',
                'title' => __('Location #4', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle location #4', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
             array(
                'id' => 'latitude4',
                'type' => 'text',
                'required' => array( 'map-point-4', '=', '1' ),
                'title' => __('Latitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the latitude for your fourth location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
             array(
                'id' => 'longitude4',
                'type' => 'text',
                'required' => array( 'map-point-4', '=', '1' ),
                'title' => __('Longitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the longitude for your fourth location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'map-info4',
                'required' => array( 'map-point-4', '=', '1' ),
                'type' => 'textarea',
                'title' => __('Map Infowindow Text', NECTAR_THEME_NAME), 
                'subtitle' => __('If you would like to display any text in an info window for your fourth location, please enter it here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            
            
            
            array(
                'id' => 'map-point-5',
                'type' => 'switch',
                'title' => __('Location #5', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle location #5', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
             array(
                'id' => 'latitude5',
                'type' => 'text',
                'required' => array( 'map-point-5', '=', '1' ),
                'title' => __('Latitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the latitude for your fifth location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
             array(
                'id' => 'longitude5',
                'type' => 'text',
                'required' => array( 'map-point-5', '=', '1' ),
                'title' => __('Longitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the longitude for your fifth location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'map-info5',
                'required' => array( 'map-point-5', '=', '1' ),
                'type' => 'textarea',
                'title' => __('Map Infowindow Text', NECTAR_THEME_NAME), 
                'subtitle' => __('If you would like to display any text in an info window for your fifth location, please enter it here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            
            
            array(
                'id' => 'map-point-6',
                'type' => 'switch',
                'title' => __('Location #6', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle location #6', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
             array(
                'id' => 'latitude6',
                'type' => 'text',
                'required' => array( 'map-point-6', '=', '1' ),
                'title' => __('Latitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the latitude for your sixth location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
             array(
                'id' => 'longitude6',
                'required' => array( 'map-point-6', '=', '1' ),
                'type' => 'text',
                'title' => __('Longitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the longitude for your sixth location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'map-info6',
                'required' => array( 'map-point-6', '=', '1' ),
                'type' => 'textarea',
                'title' => __('Map Infowindow Text', NECTAR_THEME_NAME), 
                'subtitle' => __('If you would like to display any text in an info window for your sixth location, please enter it here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            
            
            
            array(
                'id' => 'map-point-7',
                'type' => 'switch',
                'title' => __('Location #7', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle location #7', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
             array(
                'id' => 'latitude7',
                'required' => array( 'map-point-7', '=', '1' ),
                'type' => 'text',
                'title' => __('Latitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the latitude for your seventh location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
             array(
                'id' => 'longitude7',
                'type' => 'text',
                'required' => array( 'map-point-7', '=', '1' ),
                'title' => __('Longitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the longitude for your seventh location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'map-info7',
                'type' => 'textarea',
                 'required' => array( 'map-point-7', '=', '1' ),
                'title' => __('Map Infowindow Text', NECTAR_THEME_NAME), 
                'subtitle' => __('If you would like to display any text in an info window for your seventh location, please enter it here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            
            
            
            array(
                'id' => 'map-point-8',
                'type' => 'switch',
                'title' => __('Location #8', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle location #8', NECTAR_THEME_NAME),
                'desc' => '',
                'next_to_hide' => '3',
                'switch' => true,
                'default' => '0' 
            ),
             array(
                'id' => 'latitude8',
                 'required' => array( 'map-point-8', '=', '1' ),
                'type' => 'text',
                'title' => __('Latitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the latitude for your eighth location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
             array(
                'id' => 'longitude8',
                'type' => 'text',
                 'required' => array( 'map-point-8', '=', '1' ),
                'title' => __('Longitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the longitude for your eighth location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'map-info8',
                'type' => 'textarea',
                'required' => array( 'map-point-8', '=', '1' ),
                'title' => __('Map Infowindow Text', NECTAR_THEME_NAME), 
                'subtitle' => __('If you would like to display any text in an info window for your eighth location, please enter it here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            
            
            
            array(
                'id' => 'map-point-9',
               'type' => 'switch',
                'title' => __('Location #9', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle location #9', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
             array(
                'id' => 'latitude9',
                'type' => 'text',
                'required' => array( 'map-point-9', '=', '1' ),
                'title' => __('Latitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the latitude for your ninth location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
             array(
                'id' => 'longitude9',
                'type' => 'text',
                'required' => array( 'map-point-9', '=', '1' ),
                'title' => __('Longitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the longitude for your ninth location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'map-info9',
                'type' => 'textarea',
                'required' => array( 'map-point-9', '=', '1' ),
                'title' => __('Map Infowindow Text', NECTAR_THEME_NAME), 
                'subtitle' => __('If you would like to display any text in an info window for your ninth location, please enter it here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            
            
            array(
                'id' => 'map-point-10',
                'type' => 'switch',
                'title' => __('Location #10', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle location #10', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
             array(
                'id' => 'latitude10',
                'type' => 'text',
                'title' => __('Latitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the latitude for your tenth location.', NECTAR_THEME_NAME),
                'desc' => '',
                 'required' => array( 'map-point-10', '=', '1' ),
                'validate' => 'numeric'
            ),
             array(
                'id' => 'longitude10',
                'type' => 'text',
                'required' => array( 'map-point-10', '=', '1' ),
                'title' => __('Longitude', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter the longitude for your tenth location.', NECTAR_THEME_NAME),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'map-info10',
                'required' => array( 'map-point-10', '=', '1' ),
                'type' => 'textarea',
                'title' => __('Map Infowindow Text', NECTAR_THEME_NAME), 
                'subtitle' => __('If you would like to display any text in an info window for your tenth location, please enter it here.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            
            
            array(
                'id' => 'add-remove-locations',
                'type' => 'add_remove',
                'title' => __('Show More or Less Locations', NECTAR_THEME_NAME), 
                'desc' => '',
                'grouping' => 'map-point'
            ),
            
            array(
                'id' => 'map-greyscale',
                'type' => 'switch',
                'title' => __('Greyscale Color', NECTAR_THEME_NAME), 
                'subtitle' => __('Toggle a greyscale color scheme (will also unlock a custom color option)', NECTAR_THEME_NAME),
                'desc' => '',
                'default' => '0' 
            ),
            array(
                'id' => 'map-color',
                'type' => 'color',
                'required' => array( 'map-greyscale', '=', '1' ),
                'transparent' => false,
                'title' => __('Map Extra Color', NECTAR_THEME_NAME), 
                'subtitle' =>  __('Use this to define a main color that will be used in combination with the greyscale option for your map', NECTAR_THEME_NAME), 
                'desc' => '',
                'default' => ''
            ),
            array(
                'id' => 'map-ultra-flat',
                'type' => 'checkbox',
                'required' => array( 'map-greyscale', '=', '1' ),
                'title' => __('Ultra Flat Map', NECTAR_THEME_NAME), 
                'subtitle' =>  __('This removes street/landmark text & some extra details for a clean look', NECTAR_THEME_NAME), 
                'desc' => '',
                'default' => ''
            ),
            array(
                'id' => 'map-dark-color-scheme',
                'type' => 'checkbox',
                'required' => array( 'map-greyscale', '=', '1' ),
                'title' => __('Dark Color Scheme', NECTAR_THEME_NAME), 
                'subtitle' =>  __('Enable this option for a dark colored map (This will override the extra color choice) ', NECTAR_THEME_NAME), 
                'desc' => '',
                'default' => ''
            )
            

        )
    ) );




 Redux::setSection( $opt_name, array(
        'title'            => __( 'Home Slider', 'redux-framework-demo' ),
        'id'               => 'home_slider',
        'desc'             => __( 'All home page related options are listed here.', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields' => array(

             
             array(
                'id' => 'slider-caption-animation',
                'type' => 'switch',
                'title' => __('Slider Caption Animations', NECTAR_THEME_NAME), 
                'subtitle' => __('This will add transition animations to your captions.', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'default' => '1' 
            ),
            array(
                'id' => 'slider-background-cover',
                'type' => 'checkbox',
                'title' => __('Slider Image Resize', NECTAR_THEME_NAME), 
                'subtitle' => __('This will automatically resize your slide images to fit the users screen size by using the background-size cover css property.', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'switch' => true,
                'default' => '1' 
            ),
            array(
                'id' => 'slider-autoplay',
                'type' => 'checkbox',
                'title' => __('Autoplay Slider?', NECTAR_THEME_NAME), 
                'subtitle' => __('This will cause the automatic advance of slides until the user begins interaction.', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'switch' => true,
                'default' => '1' 
            ),
            array(
                'id' => 'slider-advance-speed', 
                'type' => 'text', 
                'title' => __('Slider Advance Speed', NECTAR_THEME_NAME),
                'subtitle' => __('This is how long it takes before automatically switching to the next slide.', NECTAR_THEME_NAME),
                'desc' => __('enter in milliseconds (default is 5500)', NECTAR_THEME_NAME), 
                'validate' => 'numeric'
            ),
             array(
                'id' => 'slider-animation-speed', 
                'type' => 'text', 
                'title' => __('Slider Animation Speed', NECTAR_THEME_NAME),
                'subtitle' => __('This is how long it takes to animate when switching between slides.', NECTAR_THEME_NAME),
                'desc' => __('enter in milliseconds (default is 800)', NECTAR_THEME_NAME), 
                'validate' => 'numeric'
            ),
            array(
                'id' => 'slider-height',
                'type' => 'text', 
                'title' => __('Slider Height', NECTAR_THEME_NAME), 
                'subtitle' => __('Please enter your desired height for the home slider. <br/> The safe minimum height is 400. <br/> The theme demo uses 650.', NECTAR_THEME_NAME),
                'desc' => __('Don\'t include "px" in the string. e.g. 650', NECTAR_THEME_NAME), 
                'validate' => 'numeric'
            ),
             array(
                'id' => 'slider-bg-color',
                'type' => 'color',
                'title' => __('Slider Background Color', NECTAR_THEME_NAME), 
                'subtitle' => __('This color will only be seen if your slides aren\'t wide enough to accomidate large resolutions. ', NECTAR_THEME_NAME), 
                'desc' => '',
                'transparent' => false,
                'default' => '#000000'
            ),      
            

        )
    ) );



Redux::setSection( $opt_name, array(
        'title'            => __( 'Social Media', 'redux-framework-demo' ),
        'id'               => 'social_media',
        'desc'             => __( 'Enter in your social media locations here and then activate which ones you would like to display in your footer options & header options tabs. <br/><br/> <strong>Remember to include the "http://" in all URLs!</strong>', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-share',
        'fields' => array(

             
            array(
                'id' => 'sharing_btn_accent_color',
                'type' => 'switch',
                'title' => __('Sharing Button Accent Color?', NECTAR_THEME_NAME), 
                'subtitle' => __('This will allow your sharing buttons (the ones in posts/projects & social shortcode) to use the accent color rather than the actual branding color.', NECTAR_THEME_NAME),
                'desc' => __('', NECTAR_THEME_NAME),
                'default' => '1' 
            ),
            array(
                'id' => 'facebook-url', 
                'type' => 'text', 
                'title' => __('Facebook URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Facebook URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'twitter-url', 
                'type' => 'text', 
                'title' => __('Twitter URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Twitter URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'google-plus-url', 
                'type' => 'text', 
                'title' => __('Google+ URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Google+ URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'vimeo-url', 
                'type' => 'text', 
                'title' => __('Vimeo URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Vimeo URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'dribbble-url', 
                'type' => 'text', 
                'title' => __('Dribbble URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Dribbble URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'pinterest-url', 
                'type' => 'text', 
                'title' => __('Pinterest URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Pinterest URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'youtube-url', 
                'type' => 'text', 
                'title' => __('Youtube URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Youtube URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'tumblr-url', 
                'type' => 'text', 
                'title' => __('Tumblr URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Tumblr URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'linkedin-url', 
                'type' => 'text', 
                'title' => __('LinkedIn URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your LinkedIn URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'rss-url', 
                'type' => 'text', 
                'title' => __('RSS URL', NECTAR_THEME_NAME),
                'subtitle' => __('If you have an external RSS feed such as Feedburner, please enter it here. Will use built in Wordpress feed if left blank.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'behance-url', 
                'type' => 'text', 
                'title' => __('Behance URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Behance URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'flickr-url', 
                'type' => 'text', 
                'title' => __('Flickr URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Flickr URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'spotify-url', 
                'type' => 'text', 
                'title' => __('Spotify URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Spotify URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'instagram-url', 
                'type' => 'text', 
                'title' => __('Instagram URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Instagram URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'github-url', 
                'type' => 'text', 
                'title' => __('GitHub URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your GitHub URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'stackexchange-url', 
                'type' => 'text', 
                'title' => __('StackExchange URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your StackExchange URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'soundcloud-url', 
                'type' => 'text', 
                'title' => __('SoundCloud URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your SoundCloud URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'vk-url', 
                'type' => 'text', 
                'title' => __('VK URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your VK URL.', NECTAR_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'vine-url', 
                'type' => 'text', 
                'title' => __('Vine URL', NECTAR_THEME_NAME),
                'subtitle' => __('Please enter in your Vine URL.', NECTAR_THEME_NAME),
                'desc' => ''
            )
            

        )
    ) );




    global $woocommerce; 
    if ($woocommerce) {
            
         Redux::setSection( $opt_name, array(
        'title'            => __( 'WooCommerce', 'redux-framework-demo' ),
        'id'               => 'woocommerce',
        'desc'             => __( 'All WooCommerce related options are listed here', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-shopping-cart',
        'fields' => array(

                    array(
                        'id' => 'enable-cart',
                        'type' => 'switch',
                        'title' => __('Enable WooCommerce Cart In Nav', NECTAR_THEME_NAME), 
                        'sub_desc' => __('This will add a cart item to your main navigation.', NECTAR_THEME_NAME),
                        'desc' => '',
                        'default' => '1' 
                    ),
                    array(
                        'id' => 'main_shop_layout',
                        'type' => 'image_select',
                        'title' => __('Main Shop Layout', NECTAR_THEME_NAME), 
                        'sub_desc' => __('Please select layout you would like to use on your main shop page.', NECTAR_THEME_NAME),
                        'desc' => __('', NECTAR_THEME_NAME),
                        'options' => array(
                                        'fullwidth' => array('title' => 'Fullwidth', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/no-sidebar.png'),
                                        'no-sidebar' => array('title' => 'No Sidebar', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/no-sidebar.png'),
                                        'right-sidebar' => array('title' => 'Right Sidebar', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/right-sidebar.png'),
                                        'left-sidebar' => array('title' => 'Left Sidebar', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/left-sidebar.png')
                                    ),
                        'default' => 'no-sidebar'
                    ),  
                    array(
                        'id' => 'single_product_layout',
                        'type' => 'image_select',
                        'title' => __('Single Product Layout', NECTAR_THEME_NAME), 
                        'sub_desc' => __('Please select layout you would like to use on your single product page.', NECTAR_THEME_NAME),
                        'desc' => __('', NECTAR_THEME_NAME),
                        'options' => array(
                                        'no-sidebar' => array('title' => 'No Sidebar', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/no-sidebar.png'),
                                        'right-sidebar' => array('title' => 'Right Sidebar', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/right-sidebar.png'),
                                        'left-sidebar' => array('title' => 'Left Sidebar', 'img' => NECTAR_FRAMEWORK_DIRECTORY.'options/img/left-sidebar.png')
                                    ),
                        'default' => 'no-sidebar'
                    ),    
                    array(
                        'id' => 'product_style',
                        'type' => 'radio',
                        'title' => __('Product Style', NECTAR_THEME_NAME), 
                        'sub_desc' => __('Please select the style you would like your products to display in (single product page styling will also vary with each)', NECTAR_THEME_NAME),
                        'desc' => __('', NECTAR_THEME_NAME),
                        'options' => array(
                                        'classic' => __('Add to cart Icon on Hover (Classic)', NECTAR_THEME_NAME),
                                        'text_on_hover' => __('Add to cart text on hover', NECTAR_THEME_NAME)
                                    ),
                        'default' => 'classic'
                    ),
                     array(
                        'id' => 'single_product_gallery_type',
                        'type' => 'radio',
                        'title' => __('Single Product Gallery Type', NECTAR_THEME_NAME), 
                        'sub_desc' => __('Please select what gallery type you would like on your single product page', NECTAR_THEME_NAME),
                        'desc' => __('', NECTAR_THEME_NAME),
                        'options' => array(
                                        'default' => __('Default lightbox functionality', NECTAR_THEME_NAME),
                                        'ios_slider' => __('Gallery slider with zoom on Hover', NECTAR_THEME_NAME)
                                    ),
                        'default' => 'default'
                    ),
                     array(
                        'id' => 'product_tab_position',
                        'type' => 'radio',
                        'title' => __('Product Tab Position', NECTAR_THEME_NAME), 
                        'sub_desc' => __('Please select what area you would like your tabs to display in on the single product page', NECTAR_THEME_NAME),
                        'desc' => __('', NECTAR_THEME_NAME),
                        'options' => array(
                                        'in_sidebar' => __('In Side Area', NECTAR_THEME_NAME),
                                        'fullwidth' => __('Fullwidth Under Images', NECTAR_THEME_NAME)
                                    ),
                        'default' => 'in_sidebar'
                    ),
                    array(
                        'id' => 'woo_social',
                        'type' => 'switch',
                        'title' => __('Social Media Sharing Buttons', NECTAR_THEME_NAME), 
                        'sub_desc' => __('Activate this to enable social sharing buttons on your product page.', NECTAR_THEME_NAME),
                        'desc' => '',
                        'default' => '1' 
                    ),
                    array(
                        'id' => 'woo-facebook-sharing',
                        'type' => 'checkbox',
                        'title' => __('Facebook', NECTAR_THEME_NAME), 
                        'sub_desc' =>  __('Share it.', NECTAR_THEME_NAME),
                        'default' => '1',
                        'required' => array( 'woo_social', '=', '1' ),
                        'desc' => '',
                    ),
                    array(
                        'id' => 'woo-twitter-sharing',
                        'type' => 'checkbox',
                        'title' => __('Twitter', NECTAR_THEME_NAME), 
                        'sub_desc' =>  __('Tweet it.', NECTAR_THEME_NAME),
                        'default' => '1', 
                        'required' => array( 'woo_social', '=', '1' ),
                        'desc' => '',
                    ),
                     array(
                        'id' => 'woo-google-plus-sharing',
                        'type' => 'checkbox',
                        'title' => __('Google+', NECTAR_THEME_NAME), 
                        'sub_desc' =>  __('Share it.', NECTAR_THEME_NAME),
                        'default' => '1',
                        'required' => array( 'woo_social', '=', '1' ),
                        'desc' => '',
                    ),
                    array(
                        'id' => 'woo-pinterest-sharing',
                        'type' => 'checkbox',
                        'title' => __('Pinterest', NECTAR_THEME_NAME), 
                        'sub_desc' =>  __('Pin it.', NECTAR_THEME_NAME),
                        'default' => '1',
                        'required' => array( 'woo_social', '=', '1' ),
                        'desc' => '',
                    ),
                    array(
                        'id' => 'woo-linkedin-sharing',
                        'type' => 'checkbox',
                        'title' => __('LinkedIn', NECTAR_THEME_NAME), 
                        'sub_desc' =>  __('Share it.', NECTAR_THEME_NAME),
                        'default' => '0',
                        'required' => array( 'woo_social', '=', '1' ),
                        'desc' => '',
                    )               
               
        )
    ) );
}


    

   

    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

