<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Add the forms to the admin bar
 *
 * @package BuddyForms
 * @since 0.3 beta
 */
add_action(
    'wp_before_admin_bar_render',
    'buddyforms_wp_before_admin_bar_render',
    1,
    2
);
function buddyforms_wp_before_admin_bar_render()
{
    global  $wp_admin_bar, $buddyforms ;
    if ( !$buddyforms ) {
        return;
    }
    foreach ( $buddyforms as $key => $buddyform ) {
        if ( !isset( $buddyform['post_type'] ) || $buddyform['post_type'] == 'none' ) {
            continue;
        }
        if ( isset( $buddyform['admin_bar'][0] ) && $buddyform['post_type'] != 'none' && !empty($buddyform['attached_page']) ) {
            
            if ( current_user_can( 'buddyforms_' . $key . '_create' ) ) {
                $permalink = get_permalink( $buddyform['attached_page'] );
                $wp_admin_bar->add_menu( array(
                    'parent' => 'my-account',
                    'id'     => 'my-account-' . $buddyform['slug'],
                    'title'  => $buddyform['name'],
                    'href'   => $permalink,
                ) );
                $wp_admin_bar->add_menu( array(
                    'parent' => 'my-account-' . $buddyform['slug'],
                    'id'     => 'my-account-' . $buddyform['slug'] . '-view',
                    'title'  => __( 'View my ', 'buddyforms' ) . $buddyform['name'],
                    'href'   => $permalink . '/view/' . $buddyform['slug'] . '/',
                ) );
                $wp_admin_bar->add_menu( array(
                    'parent' => 'my-account-' . $buddyform['slug'],
                    'id'     => 'my-account-' . $buddyform['slug'] . '-new',
                    'title'  => __( 'New ', 'buddyforms' ) . $buddyform['singular_name'],
                    'href'   => $permalink . 'create/' . $buddyform['slug'] . '/',
                ) );
            }
        
        }
    }
}

/**
 * Create the buddyforms post status array.
 * Other Plugins use the filter buddyforms_get_post_status_array to add there post status to the options array
 *
 * @return array
 */
function buddyforms_get_post_status_array()
{
    $status_array = array(
        'publish' => __( 'Publish', 'buddyforms' ),
        'pending' => __( 'Pending Review', 'buddyforms' ),
        'draft'   => __( 'Draft', 'buddyforms' ),
        'future'  => __( 'Schedule', 'buddyforms' ),
        'private' => __( 'Privately Publish', 'buddyforms' ),
        'trash'   => __( 'Trash', 'buddyforms' ),
    );
    return apply_filters( 'buddyforms_get_post_status_array', $status_array );
}

/**
 * Restricting users to view only media library items they upload.
 *
 * @package BuddyForms
 * @since 0.5 beta
 */
add_action( 'pre_get_posts', 'buddyforms_restrict_media_library' );
/**
 * @param $wp_query_obj
 */
function buddyforms_restrict_media_library( $wp_query_obj )
{
    global  $current_user, $pagenow ;
    if ( is_super_admin( $current_user->ID ) ) {
        return;
    }
    if ( !is_a( $current_user, 'WP_User' ) ) {
        return;
    }
    if ( 'admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments' ) {
        return;
    }
    if ( !current_user_can( 'manage_media_library' ) ) {
        $wp_query_obj->set( 'author', $current_user->ID );
    }
    return;
}

/**
 * Check if a subscriber have the needed rights to upload images and add this capabilities if needed.
 *
 * @package BuddyForms
 * @since 0.5 beta
 */
add_action( 'init', 'buddyforms_allow_subscriber_uploads' );
function buddyforms_allow_subscriber_uploads()
{
    
    if ( current_user_can( 'subscriber' ) && !current_user_can( 'upload_files' ) ) {
        $role = get_role( 'subscriber' );
        if ( !empty($role) ) {
            $role->add_cap( 'upload_files' );
        }
    }

}

/**
 * Get the BuddyForms template directory.
 *
 * @return string
 * @since 0.1 beta
 *
 * @uses apply_filters()
 * @package BuddyForms
 */
function buddyforms_get_template_directory()
{
    return apply_filters( 'buddyforms_get_template_directory', constant( 'BUDDYFORMS_TEMPLATE_PATH' ) );
}

/**
 * Locate a template
 *
 * @param $slug
 *
 * @param $form_slug
 *
 * @package BuddyForms
 * @since 0.1 beta
 *
 * @since 2.3.1
 */
function buddyforms_locate_template( $slug, $form_slug = '' )
{
    global 
        $buddyforms,
        $bp,
        $the_lp_query,
        $current_user,
        $post_id
    ;
    //Backward compatibility @sinde 2.3.3.
    if ( empty($form_slug) ) {
        global  $form_slug ;
    }
    // Get the current user so its not needed in the templates
    $current_user = wp_get_current_user();
    // create the plugin template path
    $template_path = BUDDYFORMS_TEMPLATE_PATH . 'buddyforms/' . $slug . '.php';
    /**
     * Extend the template from 3rd party plugins
     *
     * @since 2.5.9
     */
    $template_path = apply_filters(
        'buddyforms_locate_template',
        $template_path,
        $slug,
        $form_slug
    );
    // Check if template exist in the child or parent theme and use this path if available
    if ( $template_file = locate_template( "buddyforms/{$slug}.php", false, false ) ) {
        $template_path = $template_file;
    }
    $empty_post_message = __( 'There were no posts found. Create your first post now! ', 'buddyforms' );
    if ( !empty($form_slug) ) {
        
        if ( !empty($buddyforms[$form_slug]['empty_submit_list_message_text']) ) {
            $empty_post_message = do_shortcode( $buddyforms[$form_slug]['empty_submit_list_message_text'] );
        } else {
            $empty_post_message = do_shortcode( buddyforms_default_message_on_empty_submission_list() );
        }
    
    }
    // Do the include
    include $template_path;
}

/**
 * Retrieves the post excerpt.
 *
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 *
 * @return string Post excerpt.
 * @since 2.5.17
 *
 */
function buddyforms_get_the_excerpt( $post = null )
{
    $post = get_post( $post );
    if ( empty($post) ) {
        return '';
    }
    if ( post_password_required( $post ) ) {
        return __( 'There is no excerpt because this is a protected post.' );
    }
    return apply_filters( 'buddyforms_get_the_excerpt', $post->post_excerpt, $post );
}

function buddyforms_granted_list_posts_style()
{
    return apply_filters( 'buddyforms_granted_list_post_style', array( 'list', 'table' ) );
}

// Display the WordPress Login Form
function buddyforms_wp_login_form( $hide = false, $form_slug = 'none' )
{
    // Get The Login Form
    echo  buddyforms_get_wp_login_form(
        $form_slug,
        '',
        array(
        'caller'       => 'template',
        'redirect_url' => esc_url_raw( $_SERVER['REQUEST_URI'] ),
    ),
        $hide
    ) ;
}

/**
 * Create the BuddyForms Login Form
 *
 * @param string $form_slug
 * @param string $title
 * @param array $args
 *
 * @param bool $hide
 *
 * @return string|boolean
 */
function buddyforms_get_wp_login_form(
    $form_slug = 'none',
    $title = '',
    $args = array(),
    $hide = false
)
{
    global  $buddyforms ;
    if ( is_admin() ) {
        return false;
    }
    $caller = $redirect_url = $label_username = $label_password = $label_remember = $label_log_in = '';
    extract( shortcode_atts( array(
        'caller'         => 'direct',
        'redirect_url'   => home_url(),
        'label_username' => __( 'Username or Email Address', 'buddyforms' ),
        'label_password' => __( 'Password', 'buddyforms' ),
        'label_remember' => __( 'Remember Me', 'buddyforms' ),
        'label_log_in'   => __( 'Log In', 'buddyforms' ),
    ), $args ) );
    if ( empty($title) ) {
        $title = __( 'You need to be logged in to view this page', 'buddyforms' );
    }
    $hide_style = ( $hide ? 'style="display:none"' : '' );
    $wp_login_form = '<div class="bf-show-login-form" ' . $hide_style . '>';
    //include own login basic style
    ob_start();
    require BUDDYFORMS_INCLUDES_PATH . '/resources/pfbc/Style/LoginStyle.php';
    $style = ob_get_clean();
    
    if ( !empty($style) ) {
        $style = buddyforms_minify_css( $style );
        $wp_login_form .= $style;
    }
    
    $wp_login_form .= '<h3>' . $title . '</h3>';
    $wp_login_form .= wp_login_form( array(
        'echo'           => false,
        'form_id'        => 'bf_loginform',
        'redirect'       => $redirect_url,
        'id_username'    => 'bf_user_name',
        'id_password'    => 'bf_user_pass',
        'label_username' => $label_username,
        'label_password' => $label_password,
        'label_remember' => $label_remember,
        'label_log_in'   => $label_log_in,
    ) );
    if ( $form_slug !== 'none' ) {
        $wp_login_form = str_replace( '</form>', '<input type="hidden" name="form_slug" value="' . esc_attr( $form_slug ) . '"></form>', $wp_login_form );
    }
    $wp_login_form = str_replace( '</form>', '<input type="hidden" name="caller" value="' . esc_attr( $caller ) . '"></form>', $wp_login_form );
    if ( $form_slug != 'none' ) {
        
        if ( $buddyforms[$form_slug]['public_submit'] == 'registration_form' && $buddyforms[$form_slug]['logged_in_only_reg_form'] != 'none' ) {
            $reg_form_slug = $buddyforms[$form_slug]['logged_in_only_reg_form'];
            set_query_var( 'bf_form_slug', $reg_form_slug );
            $wp_login_form = do_shortcode( '[bf form_slug="' . $reg_form_slug . '"]' );
        }
    
    }
    $wp_login_form .= '</div>';
    $wp_login_form = apply_filters( 'buddyforms_wp_login_form', $wp_login_form );
    return $wp_login_form;
}

/**
 * since 2.5.13
 * author @gfirem
 *
 * @param $wp_register_url
 *
 * @return string
 */
function buddyforms_register_url( $wp_register_url )
{
    $buddyforms_registration_page = get_option( 'buddyforms_registration_page' );
    
    if ( $buddyforms_registration_page != 'none' ) {
        $new_url = get_permalink( $buddyforms_registration_page );
        if ( !empty($new_url) ) {
            return $new_url;
        }
    }
    
    return $wp_register_url;
}

add_filter( 'register_url', 'buddyforms_register_url' );
add_filter(
    'login_form_bottom',
    'buddyforms_register_link',
    10,
    2
);
function buddyforms_register_link( $wp_login_form, $args )
{
    if ( $args['form_id'] !== 'bf_loginform' ) {
        return $wp_login_form;
    }
    $buddyforms_registration_page = get_option( 'buddyforms_registration_page' );
    
    if ( $buddyforms_registration_page != 'none' ) {
        $permalink = get_permalink( $buddyforms_registration_page );
    } else {
        $permalink = site_url( '/wp-login.php?action=register&redirect_to=' . get_permalink() );
    }
    
    // new login page
    $wp_login_form .= '<span class="buddyforms-register"><a href="' . $permalink . '">' . __( 'Register', 'buddyforms' ) . '</a></span> &nbsp;';
    return $wp_login_form;
}

add_action(
    'login_form_bottom',
    'buddyforms_add_lost_password_link',
    10,
    2
);
function buddyforms_add_lost_password_link( $wp_login_form, $args )
{
    if ( $args['form_id'] !== 'bf_loginform' ) {
        return $wp_login_form;
    }
    $lost_password_url = apply_filters( 'buddyforms_lost_password_url', wp_lostpassword_url() );
    $wp_login_form .= '<a href="' . esc_url( $lost_password_url ) . '">' . __( 'Lost Password?', 'buddyforms' ) . '</a> ';
    return $wp_login_form;
}

// Helper Function to get the Get the REQUEST_URI Vars
/**
 * @param $name
 *
 * @return int
 */
function buddyforms_get_url_var( $name )
{
    $strURL = $_SERVER['REQUEST_URI'];
    $arrVals = explode( "/", $strURL );
    $found = 0;
    foreach ( $arrVals as $index => $value ) {
        if ( $value == $name ) {
            $found = $index;
        }
    }
    $place = $found + 1;
    return ( $found == 0 ? 1 : $arrVals[$place] );
}

/**
 * Queue some JavaScript code to be output in the footer.
 *
 * @param string $code
 */
function buddyforms_enqueue_js( $code )
{
    global  $wc_queued_js ;
    if ( empty($wc_queued_js) ) {
        $wc_queued_js = '';
    }
    $wc_queued_js .= "\n" . $code . "\n";
}

/**
 * Display edit post link for post.
 *
 * @param string $text Optional. Anchor text.
 * @param string $before Optional. Display before edit link.
 * @param string $after Optional. Display after edit link.
 * @param int $id Optional. Post ID.
 *
 * @param bool $echo
 *
 * @return string|void
 * @since 2.3.1
 *
 * @since 1.0.0
 *
 */
function buddyforms_edit_post_link(
    $text = null,
    $before = '',
    $after = '',
    $id = 0,
    $echo = true
)
{
    if ( !($post = get_post( $id )) ) {
        return;
    }
    if ( !($url = buddyforms_get_edit_post_link( $post->ID )) ) {
        return;
    }
    if ( null === $text ) {
        $text = __( 'Edit This' );
    }
    $link = '<a title="' . __( 'Edit', 'buddyforms' ) . '" class="post-edit-link" href="' . $url . '"><span aria-label="' . __( 'Edit', 'buddyforms' ) . '" class="dashicons dashicons-edit"> </span></a>';
    /**
     * Filter the post edit link anchor tag.
     *
     * @param string $link Anchor tag for the edit link.
     * @param int $post_id Post ID.
     * @param string $text Anchor text.
     *
     * @since 2.3.0
     *
     */
    $result = $before . apply_filters(
        'edit_post_link',
        $link,
        $post->ID,
        $text
    ) . $after;
    
    if ( $echo ) {
        echo  $result ;
    } else {
        return $result;
    }

}

/**
 * @param $form_slug
 */
function buddyforms_post_entry_actions( $form_slug )
{
    
    if ( !is_user_logged_in() ) {
        echo  '' ;
        return;
    }
    
    
    if ( empty($form_slug) ) {
        echo  '' ;
        return;
    }
    
    global  $buddyforms, $post ;
    
    if ( !isset( $buddyforms[$form_slug] ) || empty($buddyforms[$form_slug]['attached_page']) ) {
        echo  '' ;
        return;
    }
    
    $attached_page = ( !empty($buddyforms[$form_slug]['attached_page']) ? $buddyforms[$form_slug]['attached_page'] : 'none' );
    
    if ( $attached_page == 'none' ) {
        echo  '' ;
        return;
    }
    
    ?>
	<ul class="edit_links">
		<?php 
    $is_author = buddyforms_is_author( $post->ID );
    $user_can_all_submission = current_user_can( 'buddyforms_' . $form_slug . '_all' );
    
    if ( $is_author || $user_can_all_submission && isset( $buddyforms[$form_slug]['attached_page'] ) ) {
        $permalink = '';
        
        if ( !empty($buddyforms[$form_slug]['attached_page']) ) {
            $permalink = get_permalink( $buddyforms[$form_slug]['attached_page'] );
            $permalink = apply_filters( 'buddyforms_the_loop_edit_permalink', $permalink, $buddyforms[$form_slug]['attached_page'] );
        }
        
        if ( empty($permalink) ) {
            return;
        }
        if ( is_multisite() ) {
            if ( apply_filters( 'buddyforms_enable_multisite', false ) ) {
                
                if ( isset( $buddyforms[$form_slug]['blog_id'] ) ) {
                    $current_site = get_current_site();
                    $form_blog_id = $buddyforms[$form_slug]['blog_id'];
                    
                    if ( $current_site->blog_id != $form_blog_id ) {
                        $form_site = get_blog_details( $form_blog_id, array( 'blog_id', 'blogname' ) );
                        $permalink = str_replace( $form_site->path, $current_site->path, $permalink );
                    }
                
                }
            
            }
        }
        ob_start();
        $post_form_slug = get_post_meta( $post->ID, '_bf_form_slug', true );
        if ( $post_form_slug ) {
            $form_slug = $post_form_slug;
        }
        $current_user_can_edit = apply_filters(
            'buddyforms_user_can_edit',
            current_user_can( 'buddyforms_' . $form_slug . '_edit' ),
            $form_slug,
            $post->ID
        );
        $current_user_can_all = apply_filters(
            'buddyforms_user_can_all',
            current_user_can( 'buddyforms_' . $form_slug . '_all' ),
            $form_slug,
            $post->ID
        );
        $current_user_can_delete = apply_filters(
            'buddyforms_user_can_delete',
            current_user_can( 'buddyforms_' . $form_slug . '_delete' ),
            $form_slug,
            $post->ID
        );
        $current_user_can_create = apply_filters(
            'buddyforms_user_can_create',
            current_user_can( 'buddyforms_' . $form_slug . '_create' ),
            $form_slug,
            $post->ID
        );
        $current_user_can_draft = apply_filters(
            'buddyforms_user_can_draft',
            current_user_can( 'buddyforms_' . $form_slug . '_draft' ),
            $form_slug,
            $post->ID
        );
        $current_post_is_draft = $post->post_status == 'draft';
        $current_user_edit_draft = $current_user_can_create && !$current_user_can_edit && $current_post_is_draft && $current_user_can_draft;
        if ( isset( $buddyforms[$form_slug]['form_type'] ) && $buddyforms[$form_slug]['form_type'] != 'contact' ) {
            
            if ( $current_user_can_edit || $current_user_can_all || $current_user_edit_draft ) {
                echo  '<li>' ;
                
                if ( isset( $buddyforms[$form_slug]['edit_link'] ) && $buddyforms[$form_slug]['edit_link'] != 'none' ) {
                    echo  apply_filters(
                        'buddyforms_loop_edit_post_link',
                        '<a title="' . __( 'Edit', 'buddyforms' ) . '" id="' . get_the_ID() . '" class="bf_edit_post" href="' . $permalink . 'edit/' . $form_slug . '/' . get_the_ID() . '"><span aria-label="' . __( 'Edit', 'buddyforms' ) . '" class="dashicons dashicons-edit"> </span> ' . __( 'Edit', 'buddyforms' ) . '</a>',
                        get_the_ID(),
                        $form_slug
                    ) ;
                } else {
                    echo  apply_filters(
                        'buddyforms_loop_edit_post_link',
                        buddyforms_edit_post_link(
                        '<span aria-label="' . __( 'Edit', 'buddyforms' ) . '" class="dashicons dashicons-edit"> </span> ' . __( 'Edit', 'buddyforms' ),
                        '',
                        '',
                        0,
                        false
                    ),
                        get_the_ID(),
                        $form_slug
                    ) ;
                }
                
                echo  '</li>' ;
            }
        
        }
        
        if ( $current_user_can_delete || $current_user_can_all ) {
            echo  '<li>' ;
            echo  '<a title="' . __( 'Delete', 'buddyforms' ) . '"  id="' . get_the_ID() . '" class="bf_delete_post" href="#"><span aria-label="' . __( 'Delete', 'buddyforms' ) . '" title="' . __( 'Delete', 'buddyforms' ) . '" class="dashicons dashicons-trash"> </span> ' . __( 'Delete', 'buddyforms' ) . '</a></li>' ;
            echo  '</li>' ;
        }
        
        // Add custom actions to the entry
        do_action( 'buddyforms_the_loop_actions', get_the_ID() );
        $meta_tmp = ob_get_clean();
        // Display all actions
        echo  apply_filters( 'buddyforms_the_loop_meta_html', $meta_tmp ) ;
    }
    
    do_action( 'buddyforms_the_loop_actions_last', get_the_ID() );
    ?>
	</ul>
	<?php 
}

/**
 * Determinate if the current user is the user of the given post
 *
 * @param $post_id
 *
 * @return bool
 */
function buddyforms_is_author( $post_id )
{
    $is_author = false;
    if ( get_post_field( 'post_author', $post_id ) == get_current_user_id() ) {
        $is_author = true;
    }
    $form_slug = get_post_field( '_bf_form_slug', $post_id );
    $is_author = apply_filters(
        'buddyforms_user_can_edit',
        $is_author,
        $form_slug,
        $post_id
    );
    return $is_author;
}

/**
 * @param $post_status
 */
function buddyforms_post_status_readable( $post_status )
{
    echo  buddyforms_get_post_status_readable( $post_status ) ;
}

/**
 * @param $post_status
 *
 * @return string
 */
function buddyforms_get_post_status_readable( $post_status )
{
    if ( $post_status == 'publish' ) {
        return __( 'Published', 'buddyforms' );
    }
    if ( $post_status == 'draft' ) {
        return __( 'Draft', 'buddyforms' );
    }
    if ( $post_status == 'pending' ) {
        return __( 'Pending Review', 'buddyforms' );
    }
    if ( $post_status == 'future' ) {
        return __( 'Scheduled', 'buddyforms' );
    }
    if ( $post_status == 'awaiting-review' ) {
        return __( 'Awaiting Review', 'buddyforms' );
    }
    if ( $post_status == 'edit-draft' ) {
        return __( 'Edit Draft', 'buddyforms' );
    }
    return apply_filters( 'buddyforms_get_post_status_readable', $post_status );
}

/**
 * @param $post_status
 * @param $form_slug
 */
function buddyforms_post_status_css_class( $post_status, $form_slug )
{
    echo  buddyforms_get_post_status_css_class( $post_status, $form_slug ) ;
}

/**
 * @param $post_status
 * @param $form_slug
 *
 * @return string
 */
function buddyforms_get_post_status_css_class( $post_status, $form_slug )
{
    $post_status_css = $post_status;
    if ( $post_status == 'pending' ) {
        $post_status_css = 'bf-pending';
    }
    return apply_filters( 'buddyforms_post_status_css', $post_status_css, $form_slug );
}

/**
 * Allow to remove method for an hook when, it's a class method used and class don't have global for instanciation !
 *
 * @param string $hook_name
 * @param string $method_name
 * @param int $priority
 *
 * @return bool
 */
function buddyforms_remove_filters_with_method_name( $hook_name = '', $method_name = '', $priority = 0 )
{
    global  $wp_filter ;
    // Take only filters on right hook name and priority
    if ( !isset( $wp_filter[$hook_name][$priority] ) || !is_array( $wp_filter[$hook_name][$priority] ) ) {
        return false;
    }
    // Loop on filters registered
    foreach ( (array) $wp_filter[$hook_name][$priority] as $unique_id => $filter_array ) {
        // Test if filter is an array ! (always for class/method)
        if ( isset( $filter_array['function'] ) && is_array( $filter_array['function'] ) ) {
            // Test if object is a class and method is equal to param !
            if ( is_object( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) && $filter_array['function'][1] == $method_name ) {
                unset( $wp_filter[$hook_name][$priority][$unique_id] );
            }
        }
    }
    return false;
}

/**
 * Allow to remove method for an hook when, it's a class method used and class don't have variable, but you know the class name :)
 *
 * @param string $hook_name
 * @param string $class_name
 * @param string $method_name
 * @param int $priority
 *
 * @return bool
 */
function buddyforms_remove_filters_for_anonymous_class(
    $hook_name = '',
    $class_name = '',
    $method_name = '',
    $priority = 0
)
{
    global  $wp_filter ;
    // Take only filters on right hook name and priority
    if ( !isset( $wp_filter[$hook_name][$priority] ) || !is_array( $wp_filter[$hook_name][$priority] ) ) {
        return false;
    }
    // Loop on filters registered
    foreach ( (array) $wp_filter[$hook_name][$priority] as $unique_id => $filter_array ) {
        // Test if filter is an array ! (always for class/method)
        if ( isset( $filter_array['function'] ) && is_array( $filter_array['function'] ) ) {
            // Test if object is a class, class and method is equal to param !
            if ( is_object( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) == $class_name && $filter_array['function'][1] == $method_name ) {
                unset( $wp_filter[$hook_name][$priority][$unique_id] );
            }
        }
    }
    return false;
}

/**
 * Get all taxonomies
 *
 * @param $post_type
 *
 * @return
 * @package BuddyForms
 * @since 0.1-beta
 *
 */
function buddyforms_taxonomies( $post_type )
{
    $taxonomies_array = get_object_taxonomies( $post_type, 'objects' );
    $taxonomies['none'] = 'Select a Taxonomy';
    foreach ( $taxonomies_array as $tax_slug => $tax ) {
        $taxonomies[$tax->name] = $tax->label;
    }
    return $taxonomies;
}

function buddyforms_metabox_go_pro()
{
    buddyforms_go_pro(
        '<span> </span>',
        '',
        array( __( 'Priority Support', 'buddyforms' ), __( 'More Form Elements', 'buddyforms' ), __( 'More Options', 'buddyforms' ) ),
        false
    );
    buddyforms_go_pro(
        '<span> </span>',
        __( 'Full Control', 'buddyforms' ),
        array(
        __( 'Use your form in the backend admin edit screen like ACF', 'buddyforms' ),
        __( 'Control who can create, edit and delete content', 'buddyforms' ),
        __( 'Registration Options', 'buddyforms' ),
        __( 'Disable ajax form submission', 'buddyforms' ),
        __( 'Local Storage', 'buddyforms' ),
        __( 'More Notification Options', 'buddyforms' ),
        __( 'Import - Export Forms', 'buddyforms' )
    ),
        false
    );
    buddyforms_go_pro(
        '<span> </span>',
        __( 'Permissions Management', 'buddyforms' ),
        array( __( 'Manage User Roles', 'buddyforms' ), __( 'Manage Capabilities', 'buddyforms' ), __( 'More Validation Options', 'buddyforms' ) ),
        false
    );
    buddyforms_go_pro(
        '<span> </span>',
        __( 'More Post Options', 'buddyforms' ),
        array(
        __( 'All Post Types', 'buddyforms' ),
        __( 'Posts Revision', 'buddyforms' ),
        __( 'Comment Status', 'buddyforms' ),
        __( 'Enable Login on the form', 'buddyforms' ),
        __( 'Create an account during submission?', 'buddyforms' ),
        __( 'Featured Image Support', 'buddyforms' )
    ),
        false
    );
    buddyforms_go_pro( '<span> </span>', __( 'Know Your User', 'buddyforms' ) . '<p><small>' . __( 'Get deep Insights about your Submitter', 'buddyforms' ) . '</small></p>', array(
        __( 'IP Address', 'buddyforms' ),
        __( 'Referer', 'buddyforms' ),
        __( 'Browser', 'buddyforms' ),
        __( 'Platform', 'buddyforms' ),
        __( 'Reports', 'buddyforms' ),
        __( 'User Agent', 'buddyforms' )
    ) );
}

/**
 * Get field by slug
 *
 * @param $form_slug
 * @param $field_slug
 *
 * @return bool|array
 * @author Sven edited by gfirem
 *
 */
function buddyforms_get_form_field_by_slug( $form_slug, $field_slug )
{
    $result_field = wp_cache_get( 'buddyforms_get_field_' . $field_slug . '_in_form_' . $form_slug, 'buddyforms' );
    
    if ( $result_field === false ) {
        global  $buddyforms ;
        if ( isset( $buddyforms[$form_slug]['form_fields'] ) ) {
            foreach ( $buddyforms[$form_slug]['form_fields'] as $field_key => $field ) {
                
                if ( $field['slug'] == $field_slug ) {
                    $result_field = $field;
                    wp_cache_set( 'buddyforms_get_field_' . $field_slug . '_in_form_' . $form_slug, $result_field, 'buddyforms' );
                    return $result_field;
                }
            
            }
        }
    }
    
    return $result_field;
}

/**
 * Get field by slug
 *
 * @param $form_slug
 * @param $field_slug
 * @param string $by
 *
 * @return bool|array
 * @since 2.5.11 Added the $by parameter to specify the comparison parameter
 * @author Sven edited by gfirem
 */
function buddyforms_get_form_field_by( $form_slug, $field_slug, $by = 'slug' )
{
    $result_field = wp_cache_get( 'buddyforms_get_field_' . $field_slug . '_in_form_' . $form_slug, 'buddyforms' );
    
    if ( $result_field === false ) {
        global  $buddyforms ;
        if ( isset( $buddyforms[$form_slug]['form_fields'] ) ) {
            foreach ( $buddyforms[$form_slug]['form_fields'] as $field_key => $field ) {
                
                if ( $field[$by] == $field_slug ) {
                    $result_field = $field;
                    wp_cache_set( 'buddyforms_get_field_' . $field_slug . '_in_form_' . $form_slug, $result_field, 'buddyforms' );
                    return $result_field;
                }
            
            }
        }
    }
    
    return $result_field;
}

/**
 * Get field by ID
 *
 * @param $form_slug
 * @param $field_id
 *
 * @return bool|array
 * @since 2.4.6
 *
 */
function buddyforms_get_form_field_by_id( $form_slug, $field_id )
{
    $result_field = wp_cache_get( 'buddyforms_get_field_' . $field_id . '_in_form_' . $form_slug, 'buddyforms' );
    
    if ( $result_field === false ) {
        global  $buddyforms ;
        if ( isset( $buddyforms[$form_slug]['form_fields'] ) ) {
            
            if ( isset( $buddyforms[$form_slug]['form_fields'] ) && isset( $buddyforms[$form_slug]['form_fields'][$field_id] ) ) {
                $result_field = $buddyforms[$form_slug]['form_fields'][$field_id];
                wp_cache_set( 'buddyforms_get_field_' . $field_id . '_in_form_' . $form_slug, $result_field, 'buddyforms' );
                return $result_field;
            }
        
        }
    }
    
    return $result_field;
}

/**
 * Return teh array of field belong to the form.
 *
 * @param $form_slug
 *
 * @return bool|array
 */
function buddyforms_get_form_fields( $form_slug )
{
    $result_field = wp_cache_get( 'buddyforms_get_form_fields' . $form_slug, 'buddyforms' );
    
    if ( $result_field === false ) {
        global  $buddyforms ;
        if ( empty($form_slug) ) {
            return false;
        }
        
        if ( isset( $buddyforms[$form_slug]['form_fields'] ) ) {
            $result_fields = $buddyforms[$form_slug]['form_fields'];
            wp_cache_set( 'buddyforms_get_form_fields' . $form_slug, $result_fields, 'buddyforms' );
            return $result_fields;
        }
    
    }
    
    return $result_field;
}

/**
 * Check if field type exist in a form
 *
 * @param $form_slug
 * @param $field_type
 *
 * @param string $search_by
 *
 * @return bool
 * @since 2.5.15 added $search_by
 */
function buddyforms_exist_field_type_in_form( $form_slug, $field_type, $search_by = 'type' )
{
    $fields = buddyforms_get_form_fields( $form_slug );
    $exist = false;
    if ( empty($fields) ) {
        return $exist;
    }
    foreach ( $fields as $field ) {
        
        if ( $field[$search_by] == $field_type ) {
            $exist = true;
            break;
        }
    
    }
    return $exist;
}

//
// Add Placeholder support top the wp editor
//
add_filter( 'mce_external_plugins', 'buddyforms_add_mce_placeholder_plugin' );
function buddyforms_add_mce_placeholder_plugin( $plugins )
{
    if ( is_admin() ) {
        return $plugins;
    }
    $plugins['placeholder'] = BUDDYFORMS_PLUGIN_URL . 'assets/resources/wp-tinymce-placeholder/mce.placeholder.js';
    return $plugins;
}

/**
 * Add garlic support to the wp editor for local save the content of the textarea
 *
 * @param $initArray
 *
 * @return mixed
 */
function buddyforms_tinymce_setup_function( $initArray )
{
    $initArray['setup'] = 'function(editor) {
                editor.on("change keyup", function(e){
                    editor.save();
                    jQuery(editor.getElement()).trigger(\'change\');
                });
            }';
    return $initArray;
}

/**
 * Get a form by slug
 *
 * @param $form_slug
 *
 * @return bool|array
 */
function buddyforms_get_form_by_slug( $form_slug )
{
    $value = wp_cache_get( 'buddyforms_form_by_slug_' . $form_slug, 'buddyforms' );
    
    if ( $value === false ) {
        global  $buddyforms ;
        
        if ( isset( $buddyforms[$form_slug] ) ) {
            $value = $buddyforms[$form_slug];
            wp_cache_set( 'buddyforms_form_by_slug_' . $form_slug, $value, 'buddyforms' );
        }
    
    }
    
    return $value;
}

/**
 * Get form option
 *
 * @param $form_slug
 * @param string $option
 *
 * @return string|bool
 * @since 2.5.19
 */
function buddyforms_get_form_option( $form_slug, $option )
{
    $value = false;
    
    if ( !empty($form_slug) && !empty($option) ) {
        $cache_key = 'buddyforms_form_' . $form_slug . '_option_' . $option;
        $value = wp_cache_get( $cache_key, 'buddyforms' );
        
        if ( $value === false ) {
            $bf_form = buddyforms_get_form_by_slug( $form_slug );
            
            if ( !empty($bf_form) ) {
                $value = ( isset( $bf_form[$option] ) ? $bf_form[$option] : false );
                wp_cache_set( $cache_key, $value, 'buddyforms' );
            }
        
        }
    
    }
    
    return $value;
}

/**
 * Will return the form slug from post meta or the default. none if no form is attached
 *
 * @param $post_id
 *
 * @return mixed
 * @author Sven edited by gfirem
 *
 */
function buddyforms_get_form_slug_by_post_id( $post_id )
{
    $value = wp_cache_get( 'buddyform_form_slug_' . $post_id, 'buddyforms' );
    
    if ( $value === false ) {
        $value = get_post_meta( $post_id, '_bf_form_slug', true );
        
        if ( empty($value) || isset( $value ) && $value == 'none' ) {
            $buddyforms_posttypes_default = get_option( 'buddyforms_posttypes_default' );
            $post_type = get_post_type( $post_id );
            if ( isset( $buddyforms_posttypes_default[$post_type] ) ) {
                $value = $buddyforms_posttypes_default[$post_type];
            }
        }
        
        wp_cache_set( 'buddyform_form_slug_' . $post_id, $value, 'buddyforms' );
    }
    
    return $value;
}

/**
 * Get the post types for teh created forms
 *
 * @return array
 */
function buddyforms_get_post_types_from_forms()
{
    global  $buddyforms ;
    $result = array();
    
    if ( !empty($buddyforms) ) {
        foreach ( $buddyforms as $form ) {
            $result[] = $form['post_type'];
        }
        $result = array_unique( $result );
    }
    
    return $result;
}

function buddyforms_get_post_types()
{
    $post_types = array();
    // Generate the Post Type Array 'none' == Contact Form
    $post_types['bf_submissions'] = __( 'none', 'buddyforms' );
    $post_types['post'] = __( 'Post', 'buddyforms' );
    $post_types['page'] = __( 'Page', 'buddyforms' );
    return $post_types;
}

/**
 * This function return the dropdown populated with the pages of the site including the childs
 *
 * @param $name
 * @param $selected
 * @param string $id
 * @param string $default_option_string
 * @param string $default_option_value
 * @param string $view
 *
 * @return string
 * @author gfirem
 *
 * @since 2.5.10
 */
function buddyforms_get_all_pages_dropdown(
    $name,
    $selected,
    $id = '',
    $default_option_string = 'WordPress Default',
    $default_option_value = 'none',
    $view = "form_builder"
)
{
    if ( $default_option_string === 'WordPress Default' ) {
        $default_option_string = __( 'WordPress Default', 'buddyforms' );
    }
    $exclude = array();
    $page_on_front = get_option( 'page_on_front' );
    if ( !empty($page_on_front) && $page_on_front !== 'none' && is_numeric( $page_on_front ) && $page_on_front != $selected ) {
        $exclude[] = intval( $page_on_front );
    }
    
    if ( $view == 'form_builder' ) {
        $buddyforms_registration_page = get_option( 'buddyforms_registration_page' );
        if ( !empty($buddyforms_registration_page) && $buddyforms_registration_page !== 'none' && is_numeric( $buddyforms_registration_page ) && $buddyforms_registration_page != $selected ) {
            $exclude[] = intval( $buddyforms_registration_page );
        }
    }
    
    $args = array(
        'depth'             => 0,
        'post_type'         => 'page',
        'exclude_tree'      => $exclude,
        'selected'          => $selected,
        'name'              => $name,
        'id'                => ( !empty($id) ? $id : $name ),
        'show_option_none'  => $default_option_string,
        'option_none_value' => $default_option_value,
        'sort_column'       => 'post_title',
        'echo'              => 0,
    );
    $output = wp_dropdown_pages( $args );
    return $output;
}

function buddyforms_get_all_pages(
    $type = 'id',
    $view = "form_builder",
    $exclude_global_submission_endpoint = false,
    $extra_exclude_ids = array(),
    $default_string = ''
)
{
    $exclude = array();
    if ( empty($default_string) ) {
        $default_string = __( 'Select a Page', 'buddyforms' );
    }
    // get the page_on_front and exclude it from the query. This page should not get used for the endpoints
    $page_on_front = get_option( 'page_on_front' );
    if ( !empty($page_on_front) ) {
        $exclude[] = $page_on_front;
    }
    
    if ( $view == 'form_builder' ) {
        $buddyforms_registration_page = get_option( 'buddyforms_registration_page' );
        if ( !empty($buddyforms_registration_page) ) {
            $exclude[] = $buddyforms_registration_page;
        }
    }
    
    
    if ( !empty($exclude_global_submission_endpoint) ) {
        $buddyforms_submissions_page = get_option( 'buddyforms_submissions_page' );
        if ( !empty($buddyforms_submissions_page) ) {
            $exclude[] = $buddyforms_submissions_page;
        }
    }
    
    if ( !empty($extra_exclude_ids) ) {
        $exclude = array_merge( $extra_exclude_ids, $exclude );
    }
    $args = array(
        'sort_order'  => 'asc',
        'sort_column' => 'post_title',
        'parent'      => -1,
        'post_type'   => 'page',
        'post_status' => 'publish',
    );
    if ( !empty($exclude) ) {
        $args['exclude'] = $exclude;
    }
    $pages = get_pages( $args );
    $all_pages = array();
    $all_pages['none'] = $default_string;
    if ( $type == 'id' ) {
        // Generate the pages array by id
        foreach ( $pages as $page ) {
            $all_pages[$page->ID] = $page->post_title;
        }
    }
    if ( $type == 'name' ) {
        foreach ( $pages as $page ) {
            $all_pages[$page->post_name] = $page->post_title;
        }
    }
    return $all_pages;
}

add_action( 'admin_bar_menu', 'buddyform_admin_bar_shortcut', 60 );
/**
 * Add a short-code to the admin toolbar to edit the form in the current screen
 *
 * @param WP_Admin_Bar $wp_admin_bar
 */
function buddyform_admin_bar_shortcut( $wp_admin_bar )
{
    if ( is_admin() && is_user_logged_in() ) {
        return;
    }
    global  $post, $buddyforms ;
    if ( empty($post->ID) ) {
        return;
    }
    $form_slug = '';
    global  $wp_query ;
    
    if ( !empty($wp_query->query_vars['bf_form_slug']) ) {
        $form_slug = sanitize_title( $wp_query->query_vars['bf_form_slug'] );
    } elseif ( !empty($post->post_name) ) {
        $form_slug = $post->post_name;
    }
    
    if ( empty($form_slug) && is_array( $buddyforms ) && !array_key_exists( $form_slug, $buddyforms ) ) {
        return;
    }
    if ( !current_user_can( 'buddyforms_' . $form_slug . '_create' ) ) {
        return;
    }
    $form = get_page_by_path( $form_slug, 'OBJECT', 'buddyforms' );
    if ( empty($form) ) {
        return;
    }
    $post_url = sprintf( 'post.php?post=%s&action=edit', $form->ID );
    $args = array(
        'id'    => 'buddyforms-admin-edit-form',
        'title' => __( 'Edit BuddyForm', 'buddyforms' ),
        'href'  => admin_url( $post_url ),
        'meta'  => array(
        'data-post_id' => 33,
        'class'        => 'admin-bar dashicons-before dashicons-buddyforms',
    ),
    );
    $wp_admin_bar->add_node( $args );
}

add_action( 'buddyforms_form_hero_last', 'buddyforms_form_footer_terms' );
function buddyforms_form_footer_terms( $html )
{
    $buddyforms_gdpr = get_option( 'buddyforms_gdpr' );
    $html .= ' <div class="terms"><p>';
    if ( !empty($buddyforms_gdpr['terms_label']) ) {
        $html .= '<span id="" class="buddyforms_terms_label">' . $buddyforms_gdpr['terms_label'] . '</span> ';
    }
    if ( isset( $buddyforms_gdpr['terms'] ) && $buddyforms_gdpr['terms'] != 'none' ) {
        $html .= '<a id="" class="" href="' . get_permalink( $buddyforms_gdpr['terms'] ) . '">' . get_the_title( $buddyforms_gdpr['terms'] ) . '</a>';
    }
    $html .= '</p></div>';
    return $html;
}

/**
 * This function is an internal implementation to generate the nonce base on specific user.
 * We create this to generate nonce for user not logged in
 *
 * @readmore wp-includes/pluggable.php:2147
 *
 * @param int $action
 * @param int $user_id
 * @param string $token
 *
 * @return bool|string
 * @since 2.5.10 Added the token parameter to emulate loggout user nonce
 */
function buddyforms_create_nonce( $action = -1, $user_id = 0, $token = '' )
{
    
    if ( $user_id === 0 ) {
        $user = wp_get_current_user();
        $uid = (int) $user->ID;
        if ( !$uid ) {
            /** This filter is documented in wp-includes/pluggable.php */
            $uid = apply_filters( 'nonce_user_logged_out', $uid, $action );
        }
        $token = wp_get_session_token();
    } else {
        $uid = $user_id;
    }
    
    $i = wp_nonce_tick();
    return substr( wp_hash( $i . '|' . $action . '|' . $uid . '|' . $token, 'nonce' ), -12, 10 );
}

function buddyforms_form_display_message( $form_slug, $post_id, $source = 'after_submit_message_text' )
{
    global  $buddyforms ;
    $display_message = buddyforms_default_message_on_create();
    
    if ( !empty($buddyforms[$form_slug][$source]) ) {
        $display_message = $buddyforms[$form_slug][$source];
    } else {
        if ( $source !== 'after_submit_message_text' ) {
            $display_message = buddyforms_default_message_on_update();
        }
    }
    
    $display_message = apply_filters(
        'buddyforms_form_display_message',
        $display_message,
        $form_slug,
        $post_id,
        $source
    );
    
    if ( !empty($buddyforms[$form_slug]['attached_page']) ) {
        $permalink = get_permalink( $buddyforms[$form_slug]['attached_page'] );
        $display_message = str_ireplace( '[edit_link]', '<a title="' . __( 'Edit Post', 'buddyforms' ) . '" href="' . $permalink . 'edit/' . $form_slug . '/' . $post_id . '">' . __( 'Continue Editing', 'buddyforms' ) . '</a>', $display_message );
    }
    
    $display_message = str_ireplace( '[form_singular_name]', $buddyforms[$form_slug]['singular_name'], $display_message );
    $display_message = str_ireplace( '[post_title]', get_the_title( $post_id ), $display_message );
    $display_message = str_ireplace( '[post_link]', '<a title="' . __( 'Display Post', 'buddyforms' ) . '" href="' . get_permalink( $post_id ) . '">' . __( 'Display Post', 'buddyforms' ) . '</a>', $display_message );
    return do_shortcode( $display_message );
}

function buddyforms_user_fields_array()
{
    return array(
        'user_login',
        'user_email',
        'user_first',
        'user_last',
        'user_pass',
        'user_website',
        'display_name',
        'user_bio',
        'country',
        'state'
    );
}

function buddyforms_default_message_on_update()
{
    return __( 'Form Updated Successfully.', 'buddyforms' );
}

function buddyforms_default_message_on_empty_submission_list()
{
    return __( 'There were no posts found. Create your first post [bf_new_submission_link name="Now"]!', 'buddyforms' );
}

function buddyforms_default_message_on_create()
{
    return __( 'Form Submitted Successfully.', 'buddyforms' );
}

add_action( 'wp_ajax_nopriv_handle_dropped_media', 'buddyforms_upload_handle_dropped_media' );
add_action( 'wp_ajax_handle_dropped_media', 'buddyforms_upload_handle_dropped_media' );
function buddyforms_upload_handle_dropped_media()
{
    check_ajax_referer( 'fac_drop', 'nonce' );
    status_header( 200 );
    $newupload = 0;
    
    if ( !empty($_FILES) ) {
        $files = $_FILES;
        foreach ( $files as $file_id => $file ) {
            $newupload = media_handle_upload( $file_id, 0 );
        }
    }
    
    
    if ( is_wp_error( $newupload ) ) {
        status_header( '500' );
        echo  $newupload->get_error_message() ;
    } else {
        status_header( '200' );
        echo  $newupload ;
    }
    
    die;
}

add_action( 'wp_ajax_nopriv_handle_deleted_media', 'buddyforms_upload_handle_delete_media' );
add_action( 'wp_ajax_handle_deleted_media', 'buddyforms_upload_handle_delete_media' );
function buddyforms_upload_handle_delete_media()
{
    check_ajax_referer( 'fac_drop', 'nonce' );
    
    if ( isset( $_REQUEST['media_id'] ) ) {
        $post_id = absint( $_REQUEST['media_id'] );
        $status = wp_delete_attachment( $post_id, true );
        
        if ( $status ) {
            echo  wp_json_encode( array(
                'status' => 'OK',
            ) ) ;
        } else {
            echo  wp_json_encode( array(
                'status' => 'FAILED',
            ) ) ;
        }
    
    }
    
    die;
}

add_action( 'wp_ajax_nopriv_upload_image_from_url', 'buddyforms_upload_image_from_url' );
add_action( 'wp_ajax_upload_image_from_url', 'buddyforms_upload_image_from_url' );
function buddyforms_upload_image_from_url()
{
    $url = ( isset( $_REQUEST['url'] ) ? $_REQUEST['url'] : '' );
    $file_id = ( isset( $_REQUEST['id'] ) ? $_REQUEST['id'] : '' );
    
    if ( !empty($url) && !empty($file_id) ) {
        $upload_dir = wp_upload_dir();
        $image_url = urldecode( $url );
        $image_data = file_get_contents( $image_url );
        // Get image data
        $image_data_information = getimagesize( $image_url );
        
        if ( $image_data && $image_data_information ) {
            $file_name = $file_id . ".png";
            $full_path = wp_normalize_path( $upload_dir['path'] . DIRECTORY_SEPARATOR . $file_name );
            $upload_file = wp_upload_bits( $file_name, null, $image_data );
            
            if ( !$upload_file['error'] ) {
                $wp_filetype = wp_check_filetype( $file_name, null );
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title'     => preg_replace( '/\\.[^.]+$/', '', $file_name ),
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                );
                $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );
                $url = wp_get_attachment_thumb_url( $attachment_id );
                echo  wp_json_encode( array(
                    'status'        => 'OK',
                    'response'      => $url,
                    'attachment_id' => $attachment_id,
                ) ) ;
                die;
            } else {
                echo  wp_json_encode( array(
                    'status'   => 'FAILED',
                    'response' => 'Error uploading image.',
                ) ) ;
                die;
            }
        
        } else {
            echo  wp_json_encode( array(
                'status'   => 'FAILED',
                'response' => 'The Url provided is not an image.',
            ) ) ;
            die;
        }
    
    } else {
        echo  wp_json_encode( array(
            'status'   => 'FAILED',
            'response' => 'Wrong Format or Empty Url.',
        ) ) ;
        die;
    }

}

/**
 * Check if a file was include into the global php queue
 *
 * @param $file_name
 *
 * @return bool
 * @since 2.2.8
 *
 * @author gfirem
 *
 */
function buddyforms_check_loaded_file( $file_name )
{
    $includes_files = get_included_files();
    return in_array( $file_name, $includes_files );
}

function buddyform_get_role_names()
{
    global  $wp_roles ;
    if ( !isset( $wp_roles ) ) {
        $wp_roles = new WP_Roles();
    }
    return $wp_roles->get_names();
}

/**
 * Get a tag inside a shortcode from a given content.
 *
 * @param array $shortcodes
 * @param array $targets_tags
 * @param string $content
 *
 * @return string
 * @since 2.3.1
 *
 */
function buddyforms_get_shortcode_tag( $shortcodes, $targets_tags, $content )
{
    if ( !is_array( $shortcodes ) || !is_array( $targets_tags ) ) {
        return '';
    }
    foreach ( $shortcodes as $shortcode ) {
        $regrex = sprintf( '(\\[%s)(.*?)form_slug=\\"(.*?)\\"', $shortcode );
        preg_match_all( "/{$regrex}/m", $content, $match );
        if ( !empty($match) && !empty($match[1][0]) && $match[1][0] === '[' . $shortcode && !empty($match[3][0]) ) {
            return $match[3][0];
        }
    }
    $pattern = get_shortcode_regex();
    $result = '';
    preg_replace_callback( "/{$pattern}/m", function ( $tag ) use( $shortcodes, $targets_tags, &$result ) {
        foreach ( $shortcodes as $shortcode_item ) {
            
            if ( $shortcode_item === $tag[2] ) {
                $attributes = shortcode_parse_atts( $tag[3] );
                if ( !empty($attributes) ) {
                    foreach ( $targets_tags as $target_item ) {
                        
                        if ( array_key_exists( $target_item, $attributes ) ) {
                            $result = $attributes[$target_item];
                            return $tag[0];
                        }
                    
                    }
                }
            }
        
        }
        return $tag[0];
    }, $content );
    return $result;
}

/**
 * Extract the form slug from a html inside the given content reading the inout hidden with the Id `form_slug`
 *
 * @param $content
 *
 * @return string
 */
function buddyforms_get_form_slug_from_html( $content )
{
    if ( !empty($content) ) {
        try {
            libxml_use_internal_errors( true );
            $dom = new DOMDocument();
            $dom->validateOnParse = false;
            $content = mb_convert_encoding( $content, 'HTML-ENTITIES', "UTF-8" );
            $dom->loadHTML( $content );
            $form_input_node = $dom->getElementById( 'form_slug' );
            libxml_use_internal_errors( false );
            if ( !empty($form_input_node) && $form_input_node instanceof DOMElement ) {
                return $form_input_node->getAttribute( 'value' );
            }
        } catch ( Exception $e ) {
        }
    }
    return '';
}

/**
 * Extract the form slug from a shortcode inside the given content
 *
 * @param $content
 * @param array $shortcodes
 *
 * @return string
 */
function buddyforms_get_form_slug_from_shortcode( $content, $shortcodes = array( 'bf', 'buddyforms_form' ) )
{
    $form_slug = buddyforms_get_shortcode_tag( $shortcodes, array( 'form_slug', 'id' ), $content );
    
    if ( is_numeric( $form_slug ) ) {
        $form_post = get_post( $form_slug );
        $form_slug = $form_post->post_name;
    }
    
    return $form_slug;
}

/**
 * Extract the form slug from a shortcode inside the given content, if exist the shortcode or reading the hidden input form_slug from the html
 *
 * @param $content
 * @param array $shortcodes
 *
 * @return string
 */
function buddyforms_get_form_slug_from_content( $content, $shortcodes = array(
    'bf-list-submissions',
    'buddyforms_form',
    'buddyforms_list_all',
    'buddyforms_the_loop',
    'bf',
    'buddyforms_reset_password'
) )
{
    //Extract from the a shortcode inside the content
    $form_slug = buddyforms_get_shortcode_tag( $shortcodes, array( 'form_slug', 'id' ), $content );
    //Extract form the html inside the content, reading the hidden input form_slug
    
    if ( empty($form_slug) ) {
        //use regex to extract
        $regex = array();
        preg_match( '/<input type="hidden" name="form_slug" value="(.*?)" id="form_slug"/m', $content, $regex );
        if ( !empty($regex) && isset( $regex[1] ) ) {
            
            if ( is_array( $regex[1] ) ) {
                $form_slug = $regex[1][0];
            } else {
                $form_slug = $regex[1];
            }
        
        }
        
        if ( empty($form_slug) ) {
            $regex = array();
            preg_match( '/"bf_form_slug":"(.+?)"(?=.")/m', $content, $regex );
            //gutenberg block
            if ( !empty($regex) && isset( $regex[1] ) ) {
                $form_slug = $regex[1];
            }
        }
        
        
        if ( empty($form_slug) ) {
            $regex = array();
            preg_match( '/"bf_form_slug":"(.*)"/m', $content, $regex );
            //gutenberg block
            if ( !empty($regex) && isset( $regex[1] ) ) {
                $form_slug = $regex[1];
            }
        }
    
    }
    
    
    if ( is_numeric( $form_slug ) ) {
        $form_post = get_post( $form_slug );
        $form_slug = $form_post->post_name;
    }
    
    return $form_slug;
}

/**
 * Detext if is gutenberg
 *
 *
 * @return boolean
 */
function buddyforms_is_gutenberg_page()
{
    if ( function_exists( 'is_gutenberg_page' ) && is_gutenberg_page() ) {
        // The Gutenberg plugin is on.
        return true;
    }
    require_once ABSPATH . 'wp-admin/includes/screen.php';
    require_once ABSPATH . 'wp-admin/includes/admin.php';
    $current_screen = get_current_screen();
    if ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) {
        // Gutenberg page on 5+.
        return true;
    }
    return false;
}

/**
 * This function secure the array of options to use in the buddyformsGlobal
 *
 * @param $options
 * @param $form_slug
 * @param $bf_post_id
 *
 * @return mixed
 * @since 2.4.0
 *
 */
function buddyforms_filter_frontend_js_form_options( $options, $form_slug, $bf_post_id = 0 )
{
    /**
     * Let the user change the user granted options to use in the frontend global variable buddyformsGlobal
     *
     * @param array granted keys from the options
     * @param string The form slug from the global wp_query
     * @param number The current post id form the wp_query. This can be empty when the form is creating an entry.
     *
     * @since 2.4.0
     */
    $granted = apply_filters(
        'buddyforms_frontend_granted_forms_option',
        array(
        'status',
        'form_fields',
        'draft_action',
        'js_validation'
    ),
        $form_slug,
        $bf_post_id
    );
    foreach ( $granted as $item ) {
        if ( isset( $options[$item] ) ) {
            $result[$item] = $options[$item];
        }
    }
    //Filter the field options
    $remove_field_options = apply_filters(
        'buddyforms_remove_frontend_forms_fields_option',
        array( 'captcha_private_key' ),
        $form_slug,
        $bf_post_id
    );
    if ( !empty($result['form_fields']) ) {
        foreach ( $remove_field_options as $remove_field ) {
            foreach ( $result['form_fields'] as $field_id => $field ) {
                if ( isset( $field[$remove_field] ) ) {
                    unset( $result['form_fields'][$field_id][$remove_field] );
                }
            }
        }
    }
    return $result;
}

/**
 * Retrieve the form slug from different sources
 *
 * @return string
 * @since 2.4.0
 *
 */
function buddyforms_get_form_slug()
{
    $form_slug = '';
    global  $wp_query, $post ;
    
    if ( !empty($wp_query->query_vars['bf_form_slug']) ) {
        $form_slug = sanitize_title( $wp_query->query_vars['bf_form_slug'] );
    } elseif ( !empty($_GET['form_slug']) ) {
        $form_slug = sanitize_title( $_GET['form_slug'] );
    } elseif ( !empty($wp_query->query_vars['form_slug']) ) {
        $form_slug = sanitize_title( $wp_query->query_vars['form_slug'] );
    } elseif ( !empty($post) ) {
        $post_content = ( !empty($content) ? $content : $post->post_content );
        
        if ( !empty($post->post_name) && $post->post_type === 'buddyforms' ) {
            $form_slug = $post->post_name;
        } elseif ( !empty($post_content) ) {
            //Extract the shortcode inside the content
            $form_slug = buddyforms_get_form_slug_from_content( $post_content );
            if ( empty($form_slug) ) {
                $form_slug = buddyforms_get_form_slug_by_post_id( $post->ID );
            }
        }
    
    } elseif ( function_exists( 'bp_current_component' ) && function_exists( 'bp_current_action' ) && function_exists( 'buddyforms_members_get_form_by_member_type' ) ) {
        global  $buddyforms_member_tabs ;
        $bp_action = bp_current_action();
        $bp_component = bp_current_component();
        
        if ( !empty($buddyforms_member_tabs) && 'xprofile' !== $bp_component ) {
            $form_slug = ( !empty($buddyforms_member_tabs[bp_current_component()][bp_current_action()]) ? $buddyforms_member_tabs[bp_current_component()][bp_current_action()] : '' );
            
            if ( $form_slug . '-create' !== $bp_action && $form_slug . '-edit' !== $bp_action && $form_slug . '-revision' !== $bp_action ) {
                $member_type = bp_get_member_type( get_current_user_id() );
                $form_slug = buddyforms_members_get_form_by_member_type( $member_type );
                if ( !$form_slug ) {
                    $form_slug = buddyforms_members_get_form_by_member_type( 'none' );
                }
            }
        
        }
    
    }
    
    return $form_slug;
}

/**
 * Check if the draft is enabled for the given form slug
 *
 * @param $form_slug
 * @param string $permission
 *
 * @return bool
 * @since 2.5.14
 * @author gfirem
 */
function buddyforms_is_permission_enabled( $form_slug, $permission = 'draft' )
{
    $result = wp_cache_get( 'buddyforms_user_capability_for_' . $form_slug . '_draft', 'buddyforms' );
    
    if ( !empty($form_slug) && $result === false ) {
        /** @var WP_User $current_user */
        $current_user = wp_get_current_user();
        
        if ( empty($current_user) ) {
            $result = false;
        } else {
            $result = bf_user_can(
                $current_user->ID,
                'buddyforms_' . $form_slug . '_' . $permission,
                array(),
                $form_slug
            );
        }
        
        wp_cache_set( 'buddyforms_user_capability_for_' . $form_slug . '_draft', $result, 'buddyforms' );
    }
    
    return $result;
}

/**
 * Get the form actions. This function is used to handle the form actions if the form have a form_action element or if not
 *
 * @param $form Form
 * @param $form_slug
 * @param $post_id
 * @param $field_options
 *
 * @return Form
 * @since 2.4.0
 *
 */
function buddyforms_form_action_buttons(
    $form,
    $form_slug,
    $post_id,
    $field_options
)
{
    global  $buddyforms ;
    $exist_field_status = buddyforms_exist_field_type_in_form( $form_slug, 'status' );
    $is_draft_permission_enabled = buddyforms_is_permission_enabled( $form_slug );
    $is_form_element_action = !empty($field_options);
    
    if ( $is_form_element_action ) {
        $is_field_publish_enabled = empty($field_options['disabled_publish']);
        $is_edit_permission_enabled = buddyforms_is_permission_enabled( $form_slug, 'edit' );
        $is_create_permission_enabled = buddyforms_is_permission_enabled( $form_slug, 'create' );
        $is_draft_enabled = $is_draft_permission_enabled || $is_create_permission_enabled && !$is_edit_permission_enabled && $is_draft_permission_enabled;
    } else {
        $is_draft_enabled = $is_draft_permission_enabled;
        $is_field_publish_enabled = true;
    }
    
    $bfdesign = ( isset( $buddyforms[$form_slug]['layout'] ) ? $buddyforms[$form_slug]['layout'] : array() );
    $form_type = ( isset( $buddyforms[$form_slug]['form_type'] ) ? $buddyforms[$form_slug]['form_type'] : '' );
    $form_status = ( isset( $buddyforms[$form_slug]['status'] ) ? $buddyforms[$form_slug]['status'] : 'publish' );
    $button_class = ( !empty($bfdesign['button_class']) ? $bfdesign['button_class'] : '' );
    $include_form_draft_button = apply_filters(
        'buddyforms_include_form_draft_button',
        true,
        $form_slug,
        $form,
        $post_id
    );
    if ( $is_draft_enabled && $include_form_draft_button ) {
        
        if ( !$exist_field_status && $form_type === 'post' && is_user_logged_in() ) {
            $bf_draft_button_text = ( !empty($bfdesign['draft_text']) ? $bfdesign['draft_text'] : __( 'Save as draft', 'buddyforms' ) );
            $bf_draft_button_classes = 'bf-draft ' . $button_class;
            $bf_draft_button = new Element_Button( $bf_draft_button_text, 'submit', array(
                'id'             => $form_slug . '-draft',
                'class'          => $bf_draft_button_classes,
                'name'           => 'draft',
                'formnovalidate' => 'formnovalidate',
                'data-target'    => $form_slug,
                'data-status'    => 'draft',
            ) );
            if ( $bf_draft_button ) {
                $form->addElement( $bf_draft_button );
            }
        }
    
    }
    $include_form_submit_button = apply_filters(
        'buddyforms_include_form_submit_button',
        true,
        $form_slug,
        $form,
        $post_id
    );
    
    if ( $is_field_publish_enabled && $include_form_submit_button ) {
        $bf_publish_button_classes = 'bf-submit ' . $button_class;
        
        if ( !empty($form_type) && $form_type === 'post' && !$exist_field_status ) {
            $bf_button_text = ( !empty($bfdesign['submit_text']) ? $bfdesign['submit_text'] : __( 'Publish', 'buddyforms' ) );
        } else {
            $bf_button_text = ( !empty($bfdesign['submit_text']) ? $bfdesign['submit_text'] : __( 'Submit', 'buddyforms' ) );
        }
        
        $bf_submit_button = new Element_Button( $bf_button_text, 'submit', array(
            'id'          => $form_slug,
            'class'       => $bf_publish_button_classes,
            'name'        => 'submitted',
            'data-target' => $form_slug,
            'data-status' => $form_status,
        ) );
        $form->addElement( $bf_submit_button );
    }
    
    $form = apply_filters(
        'buddyforms_create_edit_form_button',
        $form,
        $form_slug,
        $post_id
    );
    return $form;
}

if ( !function_exists( 'buddyforms_show_error_messages' ) ) {
    // displays error messages from form submissions
    function buddyforms_show_error_messages()
    {
        $global_error = ErrorHandler::get_instance();
        $global_bf_error = $global_error->get_global_error();
        if ( !empty($global_bf_error) ) {
            
            if ( $global_bf_error->has_errors() ) {
                echo  '<div class="bf-alert error">' ;
                /**
                 * @var string|int $code
                 * @var  BuddyForms_Error|WP_Error $error
                 */
                foreach ( $global_error->get_global_error()->errors as $code => $error ) {
                    $message = $global_error->get_global_error()->get_error_message( $code );
                    if ( is_array( $message ) ) {
                        $message = $message[0];
                    }
                    echo  '<span class="buddyforms_error" data-error-code="' . $code . '"><strong>' . __( 'Error', 'buddyforms' ) . '</strong>: ' . $message . '</span><br/>' ;
                }
                echo  '</div>' ;
            }
        
        }
    }

}
if ( !function_exists( 'buddyforms_reset_password_errors' ) ) {
    // used for tracking error messages
    function buddyforms_reset_password_errors()
    {
        $global_error = ErrorHandler::get_instance();
        return $global_error->get_global_error();
    }

}
/**
 * Check whether the specified user has a given capability on a given site.
 *
 * @param int $user_id
 * @param string $capability Capability or role name.
 * @param string $form_slug
 * @param array|int $args {
 *     Array of extra arguments applicable to the capability check.
 *
 * @return bool True if the user has the cap for the given parameters.
 * @since 2.5.0
 *
 */
function bf_user_can(
    $user_id,
    $capability,
    $args = array(),
    $form_slug = ''
)
{
    if ( !empty($form_slug) ) {
        $switched = buddyforms_switch_to_form_blog( $form_slug );
    }
    $user = get_user_by( 'ID', $user_id );
    if ( !$user || !$user->exists() ) {
        return false;
    }
    $result = $user->has_cap( $capability );
    if ( !empty($switched) ) {
        restore_current_blog();
    }
    return $result;
}

/**
 * Array of fields slug to exclude from the submission columns and email table
 *
 * since 2.5.0
 * @return mixed|void
 */
function buddyforms_get_exclude_field_slugs()
{
    return apply_filters( 'buddyforms_submission_exclude_columns', array( 'user_pass', 'captcha', 'html' ) );
}

/**
 * Sanitizes a slug for an element, replacing whitespace and a few other characters with dashes.
 *
 * @param string $slug The title to be sanitized.
 * @param string $context Optional. The operation for which the string is sanitized.
 *
 * @return string The sanitized title.
 * @since 2.5.6
 *
 * @see sanitize_title_with_dashes
 */
function buddyforms_sanitize_slug( $slug, $context = 'save' )
{
    $slug = strip_tags( $slug );
    // Preserve escaped octets.
    $slug = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $slug );
    // Remove percent signs that are not part of an octet.
    $slug = str_replace( '%', '', $slug );
    // Restore octets.
    $slug = preg_replace( '|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $slug );
    if ( seems_utf8( $slug ) ) {
        $slug = utf8_uri_encode( $slug, 200 );
    }
    
    if ( 'save' == $context ) {
        // Convert nbsp, ndash and mdash to hyphens
        $slug = str_replace( array( '%c2%a0', '%e2%80%93', '%e2%80%94' ), '-', $slug );
        // Convert nbsp, ndash and mdash HTML entities to hyphens
        $slug = str_replace( array(
            '&nbsp;',
            '&#160;',
            '&ndash;',
            '&#8211;',
            '&mdash;',
            '&#8212;'
        ), '-', $slug );
        // Convert forward slash to hyphen
        $slug = str_replace( '/', '-', $slug );
        // Strip these characters entirely
        $slug = str_replace( array(
            // soft hyphens
            '%c2%ad',
            // iexcl and iquest
            '%c2%a1',
            '%c2%bf',
            // angle quotes
            '%c2%ab',
            '%c2%bb',
            '%e2%80%b9',
            '%e2%80%ba',
            // curly quotes
            '%e2%80%98',
            '%e2%80%99',
            '%e2%80%9c',
            '%e2%80%9d',
            '%e2%80%9a',
            '%e2%80%9b',
            '%e2%80%9e',
            '%e2%80%9f',
            // copy, reg, deg, hellip and trade
            '%c2%a9',
            '%c2%ae',
            '%c2%b0',
            '%e2%80%a6',
            '%e2%84%a2',
            // acute accents
            '%c2%b4',
            '%cb%8a',
            '%cc%81',
            '%cd%81',
            // grave accent, macron, caron
            '%cc%80',
            '%cc%84',
            '%cc%8c',
        ), '', $slug );
        // Convert times to x
        $slug = str_replace( '%c3%97', 'x', $slug );
    }
    
    $slug = preg_replace( '/&.+?;/', '', $slug );
    // kill entities
    $slug = str_replace( '.', '-', $slug );
    $slug = preg_replace( '/[^%a-zA-Z0-9 _-]/', '', $slug );
    $slug = preg_replace( '/\\s+/', '-', $slug );
    $slug = preg_replace( '|-+|', '-', $slug );
    $slug = trim( $slug, '-' );
    return $slug;
}

/**
 * Override the form_slug from the loop to get the correct base on the current post
 *
 * @param $form_slug
 * @param $post_id
 *
 * @return string
 *
 * @since 2.5.17
 */
function buddyforms_contact_author_loop_form_slug( $form_slug, $post_id )
{
    if ( !empty($post_id) && function_exists( 'buddyforms_get_form_slug_by_post_id' ) ) {
        $form_slug = buddyforms_get_form_slug_by_post_id( $post_id );
    }
    return $form_slug;
}

add_filter(
    'buddyforms_loop_form_slug',
    'buddyforms_contact_author_loop_form_slug',
    10,
    2
);
/**
 * Enqueue buddyforms thickbox wrapper
 * @since 2.5.19
 */
function buddyforms_add_bf_thickbox()
{
    wp_enqueue_script( 'buddyforms-thickbox' );
    wp_enqueue_style( 'buddyforms-thickbox' );
}
