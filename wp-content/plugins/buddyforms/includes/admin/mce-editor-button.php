<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Add a button to the content editor, next to the media button
 * This button will show a popup that contains inline content
 * @package BuddyForms
 * @since 0.3 beta
 *
 */
add_action( 'media_buttons', 'buddyforms_editor_button' );
/**
 * @param $context
 *
 * @return string
 */
function buddyforms_editor_button( $context ) {

	if ( ! is_admin() ) {
		return $context;
	}

// Path to my icon
// $img = plugins_url( 'admin/img/icon-buddyformsc-16.png' , __FILE__ );

// The ID of the container I want to show in the popup
	$container_id = 'buddyforms_popup_container';

// Our popup's title
	$title = __( 'BuddyForms Shortcode Generator!', 'buddyforms' );

// Append the icon <a href="#" class="button insert-media add_media" data-editor="content" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a>
	$context .= "<a class='button thickbox' data-editor='content'  title='{$title}' href='#TB_inline?width=400&inlineId={$container_id}'><span class='tk-icon-buddyforms'> </span> BuddyForms</a>";

	return $context;
}


/**
 * Add some content to the bottom of the page for the BuddyForms shortcodes
 * This will be shown in the thickbox of the post edit screen
 *
 * @package BuddyForms
 * @since 0.1 beta
 */
add_action( 'admin_footer', 'buddyforms_editor_button_inline_content' );
function buddyforms_editor_button_inline_content() {
	global $buddyforms, $post;


	if ( ! is_admin() OR empty( $buddyforms ) ) {
		return;
	}
	if ( ! isset( $post->post_type ) ) {
		return;
	}
	if ( $post->post_type == 'buddyforms' ) {
		return;
	} ?>

    <div id="buddyforms_popup_container" style="display:none;">
        <h2></h2>
		<?php
		//
		// Insert Form
		//
		$form = new Form( "buddyforms_add_form" );
		$form->configure( array(
			"prevent" => array( "bootstrap", "jQuery" ),
			"action"  => $_SERVER['REQUEST_URI'],
			"view"    => new View_Inline
		) );
		$the_forms['none'] = 'Select Form';

		foreach ( $buddyforms as $key => $buddyform ) {
			$the_forms[ $buddyform['slug'] ] = $buddyform['slug'];
		}

		$form->addElement( new Element_Select( "<h3>" . __( 'Insert Form', 'buddyforms' ) . "</h3><br>", "buddyforms_add_form", $the_forms, array( 'class' => 'buddyforms_add_form' ) ) );
		$form->addElement( new Element_HTML( '  <a href="#" class="buddyforms-button-insert-form button">' . __( 'Insert into Post', 'buddyforms' ) . '</a>' ) );
		$form->render();

		//
		// Insert Posts
		//
		$form = new Form( "buddyforms_view_posts" );
		$form->configure( array(
			"prevent" => array( "bootstrap", "jQuery" ),
			"action"  => $_SERVER['REQUEST_URI'],
			"view"    => new View_Inline
		) );

		$view_type['none']                = __( 'Filter Posts', 'buddyforms' );
		$view_type['buddyforms_list_all'] = __( 'All User', 'buddyforms' );
		$view_type['buddyforms_the_loop'] = __( 'Displayed User', 'buddyforms' );

		$form->addElement( new Element_Select( "<h3>" . __( 'List Posts', 'buddyforms' ) . "</h3><p>" . __( 'List post submissions here.', 'buddyforms' ) . "</p><br>", "buddyforms_view_posts", $view_type, array( 'class' => 'buddyforms_view_posts' ) ) );
		$form->addElement( new Element_Select( "", "buddyforms_select_form_posts", $the_forms, array( 'class' => 'buddyforms_select_form_posts' ) ) );
		$form->addElement( new Element_HTML( '  <a href="#" class="buddyforms-button-insert-posts button">' . __( 'Insert into Post', 'buddyforms' ) . '</a>' ) );
		$form->render();


		//
		// Insert Navigation
		//

		$form = new Form( "buddyforms_add_nav" );
		$form->configure( array(
			"prevent" => array( "bootstrap", "jQuery" ),
			"action"  => $_SERVER['REQUEST_URI'],
			"view"    => new View_Inline
		) );

		$button_type['none']                         = __( 'Insert Navigation', 'buddyforms' );
		$button_type['buddyforms_nav']               = __( 'View - Add New', 'buddyforms' );
		$button_type['buddyforms_button_view_posts'] = __( 'View Posts', 'buddyforms' );
		$button_type['buddyforms_button_add_new']    = __( 'Add New', 'buddyforms' );


		$form->addElement( new Element_Select( "<h3>" . __( 'Add Links', 'buddyforms' ) . "</h3><p>" . __( 'Add links to your form or form submissions.', 'buddyforms' ) . "</p><br>", "buddyforms_insert_nav", $button_type, array( 'class' => 'buddyforms_insert_nav' ) ) );
		$form->addElement( new Element_Select( "", "buddyforms_select_form", $the_forms, array( 'class' => 'buddyforms_select_form' ) ) );
		$form->addElement( new Element_HTML( '  <a href="#" class="buddyforms-button-insert-nav button">' . __( 'Insert into Post', 'buddyforms' ) . '</a>' ) );
		$form->render();

		?>

    </div>
	<?php
}

add_action( 'admin_footer', 'buddyforms_editor_button_mce_popup' );
function buddyforms_editor_button_mce_popup() { ?>
    <script>

        jQuery(document).ready(function () {
            jQuery('.buddyforms-button-insert-form').on('click', function (event) {
                var form_slug = jQuery('.buddyforms_add_form').val();
                if (form_slug == "none")
                    return;

                window.send_to_editor('[buddyforms_form form_slug="' + form_slug + '"]');
            });

            jQuery('.buddyforms-button-insert-nav').on('click', function (event) {

                var shortcode = jQuery('.buddyforms_insert_nav').val();
                var form_slug = jQuery('.buddyforms_select_form').val();

                if (shortcode == "none") {
                    alert('<?php _e( 'Please select a Button Type', 'buddyforms' ) ?>');
                    return
                }
                if (form_slug == "none") {
                    alert('<?php _e( 'Please select a Form', 'buddyforms' ) ?>');
                    return
                }

                window.send_to_editor('[' + shortcode + ' form_slug="' + form_slug + '"]');
            });

            jQuery('.buddyforms-button-insert-posts').on('click', function (event) {
                var shortcode = jQuery('.buddyforms_view_posts').val();
                var form_slug = jQuery('.buddyforms_select_form_posts').val();

                if (shortcode == "none") {
                    alert('<?php _e( 'Please select a List Type', 'buddyforms' ) ?>');
                    return
                }
                if (form_slug == "none") {
                    alert('<?php _e( 'Please select a Form', 'buddyforms' ) ?>');
                    return
                }


                window.send_to_editor('[' + shortcode + ' form_slug="' + form_slug + '"]');
            });
        });

    </script>
	<?php
}
