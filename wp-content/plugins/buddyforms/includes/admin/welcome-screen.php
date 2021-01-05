<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

//
// Add the Settings Page to the BuddyForms Menu
//
function buddyforms_welcome_screen_menu() {
	add_submenu_page( 'edit.php?post_type=buddyforms', __( 'Info', 'buddyforms' ), __( 'Info', 'buddyforms' ), 'manage_options', 'buddyforms_welcome_screen', 'buddyforms_welcome_screen_content' );
}

add_action( 'admin_menu', 'buddyforms_welcome_screen_menu', 9999 );

function buddyforms_welcome_screen_content() {
	?>
    <div id="bf_admin_wrap" class="wrap">

		<?php // include( 'admin-header.php' ); ?>

        <style>
            /* Welcome Page CSS */

            .about-wrap.buddyforms-welcome {
                margin-top: 40px;
            }

            .about-wrap.buddyforms-welcome .lead {
                max-width: none;
                margin: 20px 0;
            }

            .about-wrap.buddyforms-welcome .feature-section h1 {
                max-width: none;
                margin: 40px 0 20px;
                font-weight: 300;
            }

            .about-wrap.buddyforms-welcome h2 {
                max-width: none;
                margin: 40px 0 20px;
                text-align: left;
            }

            .about-wrap.buddyforms-welcome .about-text {
                min-height: 40px;
                margin-top: 20px;
                font-size: 23px;
                color: #32373c;
                margin-bottom: 30px;
                font-weight: 300;
            }

            .bfw-section {
                margin: 70px 0;
                overflow: auto;
            }

            .bfw-row {
                overflow: auto;
                clear: both;
            }

            .bfwell {
                margin: 40px 0 0 0;
                background: #e5e5e5;
                overflow: auto;
                border: 1px solid #ccc;
                padding: 20px 10px;
            }

            .bfw-col {
                display: block;
                float: left;
                width: 100%;
                overflow: auto;
                padding: 10px;
                box-sizing: border-box;
            }

            .bfw-col-40 {
                width: 40%;
            }

            .bfw-col-50 {
                width: 50%;
            }

            .bfw-col-60 {
                width: 60%;
            }

            .bfw-well {
                padding: 20px;
                background: #fafafa;
                border: 1px solid rgba(0, 0, 0, 0.1);
            }

            .about-wrap.buddyforms-welcome .bfw-title {
                margin-top: 0;
                font-weight: 300;
            }
        </style>


        <div class="wrap about-wrap buddyforms-welcome">

            <h1><?php _e( 'Welcome to BuddyForms', 'buddyforms' ) ?> <?php echo BUDDYFORMS_VERSION ?></h1>

            <p class="about-text"><?php _e( 'Enjoy Groundbreaking New Features and Add-ons!', 'buddyforms' ) ?></p>

            <h2 class="nav-tab-wrapper wp-clearfix">
                <a href="about.php" class="nav-tab nav-tab-active"><?php _e( 'What’s New', 'buddyforms' ) ?></a>
                <a href="edit.php?post_type=buddyforms&page=buddyforms-addons" target="_new"
                   title="<?php _e( 'Gutenberg Support', 'buddyforms' ) ?>"
                   class="nav-tab"><?php _e( 'Add Ons', 'buddyforms' ) ?></a>
            </h2>

            <div class="feature-section two-col" style="margin: 30px 0; overflow: auto;">

                <div class="xcol col-big">
                    <h2><?php _e( 'Gutenberg Support', 'buddyforms' ) ?></h2>
                    <p class="lead">
	                    <?php _e( 'BuddyForms support now Gutenberg out of the box and comes with 5 different Gutenberg Blocks ', 'buddyforms' ) ?>
                    </p>
                </div>

                <div class="xcol col-small">
                    <div class="imgframe">
                        <img class="nopad"
                             style="margin: 10px 0; padding: 5px; background: #fff; border: 1px solid #ddd;"
                             src="<?php echo BUDDYFORMS_PLUGIN_URL . '/assets/admin/img/welcome-screen/gutenberg-overview.png' ?>"
                             alt="<?php _e( 'Gutenberg', 'buddyforms' ) ?>">
                    </div>
                </div>

            </div>

            <hr>

            <div class="feature-section two-col" style="margin: 30px 0; overflow: auto;">

                <div class="xcol col-big">
                    <h2><?php _e( 'Embed Forms', 'buddyforms' ) ?></h2>
                    <p class="lead">
				        <?php _e( 'Embed any BuddyForms Form as Gutenberg Block. Just select the form you like to embed in the block sidebar', 'buddyforms' ) ?>
                    </p>
                </div>

                <div class="xcol col-small">
                    <div class="imgframe">
                        <img class="nopad"
                             style="width: 800px; height: auto; max-width: 100%; margin: 10px 0; padding: 5px; background: #fff; border: 1px solid #ddd;"
                             src="<?php echo BUDDYFORMS_PLUGIN_URL . '/assets/admin/img/welcome-screen/gutenberg-form.gif' ?>"
                             alt="<?php _e( 'Embed Forms', 'buddyforms' ) ?>">
                    </div>
                </div>

            </div>
            <hr>

            <div class="feature-section two-col" style="margin: 30px 0; overflow: auto;">

                <div class="xcol col-big">
                    <h2><?php _e( 'List Submissions', 'buddyforms' ) ?></h2>
                    <p class="lead">
				        <?php _e( 'You can list form submissions form any form and post type. Filter post lists by author or only display posts from the logged in user. Use the options in the Block sidebar.', 'buddyforms' ) ?>
                    </p>
                </div>

                <div class="xcol col-small">
                    <div class="imgframe">
                        <img class="nopad"
                             style="width: 800px; height: auto; max-width: 100%; margin: 10px 0; padding: 5px; background: #fff; border: 1px solid #ddd;"
                             src="<?php echo BUDDYFORMS_PLUGIN_URL . '/assets/admin/img/welcome-screen/gutenberg-list-submissions.gif' ?>"
                             alt="<?php _e( 'Embed Forms', 'buddyforms' ) ?>">
                    </div>
                </div>

            </div>
            <hr>

            <div class="feature-section two-col" style="margin: 30px 0; overflow: auto;">

                <div class="xcol col-big">
                    <h2><?php _e( 'Embed Navigation', 'buddyforms' ) ?></h2>
                    <p class="lead">
				        <?php _e( 'Link to form endpoints or user posts lists for every post form with an attached page to create and edit submissions. You can select the attached page under the "Edit Submissions" tab in the Form Builder', 'buddyforms' ) ?>
                    </p>
                </div>

                <div class="xcol col-small">
                    <div class="imgframe">
                        <img class="nopad"
                             style="width: 800px; height: auto; max-width: 100%; margin: 10px 0; padding: 5px; background: #fff; border: 1px solid #ddd;"
                             src="<?php echo BUDDYFORMS_PLUGIN_URL . '/assets/admin/img/welcome-screen/gutenberg-add-navigation.gif' ?>"
                             alt="<?php _e( 'Embed Forms', 'buddyforms' ) ?>">
                    </div>
                </div>

            </div>
            <hr>

            <div class="feature-section two-col" style="margin: 30px 0; overflow: auto;">

                <div class="xcol col-big">
                    <h2><?php _e( 'Login/ Logout Form', 'buddyforms' ) ?></h2>
                    <p class="lead">
				        <?php _e( 'Display a login form or a logout button if the user is logged in.', 'buddyforms' ) ?>
                    </p>
                </div>

                <div class="xcol col-small">
                    <div class="imgframe">
                        <img class="nopad"
                             style="width: 800px; height: auto; max-width: 100%; margin: 10px 0; padding: 5px; background: #fff; border: 1px solid #ddd;"
                             src="<?php echo BUDDYFORMS_PLUGIN_URL . '/assets/admin/img/welcome-screen/gutenberg-login-form.gif' ?>"
                             alt="<?php _e( 'Embed Forms', 'buddyforms' ) ?>">
                    </div>
                </div>

            </div>
            <hr>

            <div class="feature-section two-col" style="margin: 30px 0; overflow: auto;">

                <div class="xcol col-big">
                    <h2><?php _e( ' Password Reset', 'buddyforms' ) ?></h2>
                    <p class="lead">
				        <?php _e( 'Display a password reset form. This can be helpful if you want to create a registration form and ask the user to create a password first after he clicks on the activation link. Select the page with the password reset block as a redirect link in the registration form settings if you like to create this kind of funnel.', 'buddyforms' ) ?>
                    </p>
                </div>

                <div class="xcol col-small">
                    <div class="imgframe">
                        <img class="nopad"
                             style="width: 800px; height: auto; max-width: 100%; margin: 10px 0; padding: 5px; background: #fff; border: 1px solid #ddd;"
                             src="<?php echo BUDDYFORMS_PLUGIN_URL . '/assets/admin/img/welcome-screen/gutenberg-password-reset.gif' ?>"
                             alt="<?php _e( 'Embed Forms', 'buddyforms' ) ?>">
                    </div>
                </div>

            </div>

            <!-- Blogpost & Changelog -->
            <div class="bfw-section bfw-news" style="margin-top: 30px;">
                <div class="bfw-col bfw-col-50">
                    <h2 class="bfw-title"><?php _e( 'Latest Blogpost', 'buddyforms' ) ?></h2>
                    <p class="lead"><?php _e( 'Read all about this new BuddyForms version Tips and Tricks:', 'buddyforms' ) ?></p>
                    <a href="https://themekraft.com/buddyforms-news/" target="_new" class="button button-primary"><?php _e( 'Read Blogpost', 'buddyforms' ) ?></a>
                </div>
                <div class="bfw-col bfw-col-50">
                    <h2 class="bfw-title"><?php _e( 'Changelog', 'buddyforms' ) ?></h2>
                    <p class="lead"><?php echo __( 'Check out the changelog for the version', 'buddyforms' ). ' ' .BUDDYFORMS_VERSION ?></p>
                    <a href="https://wordpress.org/plugins/buddyforms/changelog/" target="_new" class="button button-primary"><?php _e( 'View Changelog', 'buddyforms' ) ?></a></p>
                </div>
            </div>

            <hr style="margin: 70px 0;">

            <!-- Getting Started -->
            <div class="bfw-section bfw-getting-started">
                <div class="bfw-col bfw-col-50">
                    <div class="well">
                        <h3 class="bfw-title"><?php _e( 'First Time Here?', 'buddyforms' ) ?></h3>
                        <a class="button xbutton-primary" href="http://docs.buddyforms.com/category/122-form-creation" title="" target="new"><?php _e( 'Getting Started', 'buddyforms' ) ?></a>
                    </div>
                </div>
                <div class="bfw-col bfw-col-50">
                    <div class="well">
                        <h3 class="bfw-title"><?php _e( 'How To Create New Forms', 'buddyforms' ) ?></h3>
                        <a class="button xbutton-primary"
                           href="http://docs.buddyforms.com/article/383-creating-a-contact-form-with-the-form-wizard"
                           title="" target="new"><?php _e( 'Contact Form', 'buddyforms' ) ?></a>
                        <a class="button xbutton-primary"
                           href="http://docs.buddyforms.com/article/385-creating-a-registration-form-with-the-form-wizard"
                           title="" target="new"><?php _e( 'Registration Form', 'buddyforms' ) ?></a>
                        <a class="button xbutton-primary"
                           href="http://docs.buddyforms.com/article/384-creating-a-post-form-with-the-form-wizard"
                           title="" target="new"><?php _e( 'Post Form', 'buddyforms' ) ?></a>
                    </div>
                </div>
            </div>

        </div>

    </div>
	<?php
}
