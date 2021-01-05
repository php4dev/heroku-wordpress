<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


//
// Add the Settings Page to the BuddyForms Menu
//
function buddyforms_settings_menu() {
	add_submenu_page( 'edit.php?post_type=buddyforms', __( 'BuddyForms Settings', 'buddyforms' ), __( 'Settings', 'buddyforms' ), 'manage_options', 'buddyforms_settings', 'buddyforms_settings_page' );
}

add_action( 'admin_menu', 'buddyforms_settings_menu' );

//
// Settings Page Content
//
function buddyforms_settings_page() { ?>

	<div id="post" class="wrap">

		<?php
		// Display the BuddyForms Header
		include( BUDDYFORMS_INCLUDES_PATH . '/admin/admin-header.php' );
		?>
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">

				<div id="postbox-container-1" class="postbox-container">
					<?php buddyforms_settings_page_sidebar(); ?>
				</div>
				<div id="postbox-container-2" class="postbox-container">
					<?php buddyforms_settings_page_tabs_content(); ?>
				</div>
			</div>
		</div>

	</div> <!-- .wrap -->
	<?php
}

/**
 * Settings Tabs Navigation
 *
 * @param string $current
 */
function buddyforms_admin_tabs( $current = 'homepage' ) {
	$tabs = array( 'general' => 'General Settings' );

	$tabs = apply_filters( 'buddyforms_admin_tabs', $tabs );
	//$tabs['layout'] = 'Form Layout';
	$tabs['import'] = __( 'Import Forms', 'buddyforms' );
	$tabs['gdpr']   = 'GDPR';

	echo '<h2 class="nav-tab-wrapper" style="padding-bottom: 0;">';
	foreach ( $tabs as $tab => $name ) {
		$class = ( $tab == $current ) ? ' nav-tab-active' : '';
		echo "<a class='nav-tab$class' href='edit.php?post_type=buddyforms&page=buddyforms_settings&tab=$tab'>$name</a>";
	}
	echo '</h2>';
}

//
// Register Settings Options
//
function buddyforms_register_option() {

	// General Settings
	register_setting( 'buddyforms_general', 'buddyforms_registration_page', 'buddyforms_default_sanitize' );
	register_setting( 'buddyforms_general', 'buddyforms_registration_form', 'buddyforms_default_sanitize' );
	register_setting( 'buddyforms_general', 'buddyforms_posttypes_default', 'buddyforms_default_sanitize' );
	register_setting( 'buddyforms_general', 'buddyforms_submissions_page', 'buddyforms_default_sanitize' );
	register_setting( 'buddyforms_gdpr', 'buddyforms_gdpr', 'buddyforms_default_sanitize' );


	// Layout Options
	register_setting( 'buddyforms_layout', 'buddyforms_layout_options', 'buddyforms_default_sanitize' );
}

add_action( 'admin_init', 'buddyforms_register_option' );

/**
 * @param $new
 *
 * @return mixed
 */
function buddyforms_default_sanitize( $new ) {
	return $new;
}

function buddyforms_settings_page_tabs_content() {
	global $pagenow, $buddyforms; ?>
	<div id="poststuff">

		<?php

		// Display the Update Message
		if ( isset( $_GET['updated'] ) && 'true' == esc_attr( $_GET['updated'] ) ) {
			echo '<div class="updated" ><p>BuddyForms...</p></div>';
		}

		if ( isset ( $_GET['tab'] ) ) {
			buddyforms_admin_tabs( $_GET['tab'] );
		} else {
			buddyforms_admin_tabs( 'homepage' );
		}

		if ( $pagenow == 'edit.php' && $_GET['page'] == 'buddyforms_settings' ) {

			if ( isset ( $_GET['tab'] ) ) {
				$tab = $_GET['tab'];
			} else {
				$tab = 'general';
			}

			buddyforms_track( 'settings', array( 'tab' => $tab ) );

			switch ( $tab ) {
				case 'general' :
					$buddyforms_registration_page = get_option( 'buddyforms_registration_page' );
					$buddyforms_registration_form = get_option( 'buddyforms_registration_form' );
					$buddyforms_posttypes_default = get_option( 'buddyforms_posttypes_default' );
					$buddyforms_submissions_page = get_option( 'buddyforms_submissions_page' );

					$pages = buddyforms_get_all_pages( 'id', 'settings' );
					?>
					<div class="metabox-holder">
						<div class="postbox buddyforms-metabox">

							<div class="inside">


								<form method="post" action="options.php">

									<?php settings_fields( 'buddyforms_general' ); ?>

									<table class="form-table">
										<tbody>

										<!-- Registration Settings -->
										<tr>
											<th colspan="2">
												<h3><span><?php _e( 'Registration Settings', 'buddyforms' ); ?></span>
												</h3>
												<p><?php _e( 'Select the Registration Page and Form to overwrite the WordPress default Registration.', 'buddyforms' ); ?></p>
											</th>
										</tr>
										<tr valign="top">
											<th scope="row" valign="top">
												<?php _e( 'Registration Page', 'buddyforms' ); ?>
											</th>
											<td>
												<?php
												$pages_dropdown = buddyforms_get_all_pages_dropdown( 'buddyforms_registration_page', $buddyforms_registration_page );
												if ( ! empty( $pages_dropdown ) ) {
													echo $pages_dropdown;
												}
												?>
											</td>
										</tr>
										<tr valign="top">
											<th scope="row" valign="top">
												<?php _e( 'Registration Form', 'buddyforms' ); ?>
											</th>
											<td>
												<?php
												if ( isset( $buddyforms ) && is_array( $buddyforms ) ) {
													echo '<select name="buddyforms_registration_form" id="buddyforms_registration_form">';
													echo '<option value="none">' . __( 'WordPress Default', 'buddyforms' ) . '</option>';
													echo '<option ' . selected( $buddyforms_registration_form, 'page' ) . ' value="page">' . __( 'No Form', 'buddyforms' ) . '</option>';
													foreach ( $buddyforms as $form_slug => $form ) {
														if ( $form['form_type'] == 'registration' ) {
															echo '<option ' . selected( $buddyforms_registration_form, $form['slug'] ) . 'value="' . $form['slug'] . '">' . $form['name'] . '</option>';
														}
													}
													echo '</select>';
												}
												?>
											</td>
										</tr>
										<?php
										if ( isset( $buddyforms ) && is_array( $buddyforms ) ) {
											$post_types_forms = Array();
											foreach ( $buddyforms as $key => $buddyform ) {

												if ( isset( $buddyform['post_type'] ) && $buddyform['post_type'] != 'bf_submissions' && post_type_exists( $buddyform['post_type'] ) ) {
													$post_types_forms[ $buddyform['post_type'] ][ $key ] = $buddyform;
												}

											}
											?>

											<!-- POST TYPES Settings -->
											<tr>
												<th colspan="2">

													<h3>
														<span><?php _e( 'Posts - Pages and Custom Post Types', 'buddyforms' ); ?></span>
													</h3>

													<p><?php _e( 'Select a default form for every post type.', 'buddyforms' ); ?></p>
													<p><?php _e( 'This will make sure that posts created before BuddyForms will have a form associated. If you select none the post edit link will point to the admin for posts not create with BuddyForms', 'buddyforms' ); ?>
													</p>
												</th>
											</tr>
											<?php
											foreach ( $post_types_forms as $post_type => $post_types_form ) : ?>
												<tr valign="top">
													<th scope="row" valign="top">
														<?php
														$post_type_object = get_post_type_object( $post_type );
														echo $post_type_object->labels->name; ?>
													</th>
													<td>
														<select
															name="buddyforms_posttypes_default[<?php echo $post_type ?>]"
															class="regular-radio">
															<option value="none"><?php _e( 'None', 'buddyforms' ) ?></option>
															<?php foreach ( $post_types_form as $form_key => $form ) {

																$default = '';
																if ( isset( $buddyforms_posttypes_default[ $post_type ] ) ) {
																	$default = $buddyforms_posttypes_default[ $post_type ];
																}
																?>
																<option <?php echo selected( $default, $form_key, true ) ?>
																	value="<?php echo $form_key ?>"><?php echo $form['name'] ?></option>
															<?php } ?>
														</select>
													</td>
												</tr>
											<?php endforeach;
										} else {
											echo '<h3>' . __( 'You need to create at least one form to select a post type default.', 'buddyforms' ) . '</h3>';
										} ?>
										<tr>
											<th colspan="2">
												<h3>
													<span><?php _e( 'Frontend Submissions Management', 'buddyforms' ); ?></span>
												</h3>
												<p><?php _e( 'Select the Page to use for the frontend submissions management.', 'buddyforms' ); ?></p>
												<p><?php _e( ' The original page content does not get changed. You are free to use any kind of content on the page itself. Link to different form or list the users submissions.
                                                 For the submissions management new endpoints get create for you. You can combine forms under the same page', 'buddyforms' ); ?></p>

												<p><?php _e( 'Example:', 'buddyforms' ); ?></p>
												<p><?php _e( 'http://domain.com/PAGE/create/FORM_SLUG', 'buddyforms' ); ?></p>
												<p><?php _e( 'http://domain.com/PAGE/view/FORM_SLUG', 'buddyforms' ); ?></p>

												<p><?php _e( 'This settings can be overwritten on a form basis. Every form can have there individual page if needed. This url will alwaysw be redirected to the corect place. If you use BuddyPress or Ultimate Member as example this link will redirect to the user profile edit or create.', 'buddyforms' ); ?></p>


											</th>
										</tr>
										<tr valign="top">
											<th scope="row" valign="top">
												<?php _e( 'Default Page for your Submissions Management in the Frontend', 'buddyforms' ); ?>
											</th>
											<td>
												<?php
												if ( isset( $pages ) && is_array( $pages ) ) {
													echo '<select name="buddyforms_submissions_page" required="required" id="attached_page">';
													$pages['none'] = 'Select a Page';
													foreach ( $pages as $page_id => $page_name ) {
														echo '<option ' . selected( $buddyforms_submissions_page, $page_id ) . 'value="' . $page_id . '">' . $page_name . '</option>';
													}
													echo '</select>';
												}
												echo sprintf( '<p><a href="javascript:void(0);" onclick="createNewPageOpenModal()" id="bf_create_page_modal">%s </a></p> %s', __( 'Create a new Page', 'buddyforms' ), __( 'The page is used to create the endpoints for the create - list and edit submissions views. ', 'buddyforms' ) )
												?>

											</td>
										</tr>
										<tr valign="top">
											<th scope="row" valign="top">
												<?php _e( 'Reset all marketing permissions', 'buddyforms' ); ?>
											</th>
											<td>
												<input type="button" name="buddyforms_marketing_reset" id="buddyforms_marketing_reset" class="button button-secondary" value="<?php _e( 'Reset', 'buddyforms' ); ?>">
											</td>
										</tr>
										</tbody>
									</table>

									<?php submit_button(); ?>

								</form>
							</div><!-- .inside -->
						</div><!-- .postbox -->
					</div><!-- .metabox-holder -->
					<?php
					break;
				case 'import' : ?>
					<div class="metabox-holder">
						<div class="postbox buddyforms-metabox">
							<h3><span><?php _e( 'Import Forms', 'buddyforms' ); ?></span></h3>
							<div class="inside">
								<p><?php _e( 'Import the form from a .json file. This file can be obtained by exporting the form from the list view.' ); ?></p>
								<form method="post" enctype="multipart/form-data">
									<!--									<p>-->
									<!--										<b>Type:</b>-->
									<!--										<select name="import-type" class="regular-radio">-->
									<!--											--><?php //echo do_action('buddyforms_import_type_options'); ?>
									<!--											<option value="buddyforms">BuddyForms</option>-->
									<!--											<option value="custom">Custom</option>-->
									<!--										</select>-->
									<!--									</p>-->
									<p>
										<input type="file" name="import_file"/>
									</p>
									<p>
										<input type="hidden" name="buddyforms_action" value="import_settings"/>
										<?php wp_nonce_field( 'buddyforms_import_nonce', 'buddyforms_import_nonce' ); ?>
										<?php submit_button( __( 'Import' ), 'secondary', 'submit', false ); ?>
									</p>
								</form>
							</div><!-- .inside -->
						</div><!-- .postbox -->
					</div><!-- .metabox-holder -->
					<?php
					break;
				case 'layout' : ?>

					<div class="metabox-holder">
						<div class="postbox buddyforms-metabox">
							<h3><span><?php _e( 'Form Layout', 'buddyforms' ); ?></span></h3>
							<div class="inside">
								<p><?php _e( 'Define the form layout for all forms. The global form settings can be overwritten in the Form Builder Stetting ', 'buddyforms' ); ?></p>

								<form method="post" action="options.php">
									<?php settings_fields( 'buddyforms_layout' ); ?>
									<?php buddyforms_layout_screen( 'buddyforms_layout_options' ); ?>
									<?php submit_button( __( 'Save', 'buddyforms' ), 'secondary', 'submit', false ); ?>
								</form>

							</div><!-- .inside -->
						</div><!-- .postbox -->
					</div><!-- .metabox-holder -->
					<?php
					break;
				case 'gdpr' :
					$buddyforms_gdpr = get_option( 'buddyforms_gdpr' );
					$pages = buddyforms_get_all_pages( 'id', 'settings' );


					$registration_templat = __( "By signing up on our site you agree to our terms and conditions [link].  We'll create a new user account for you based on your submissions.  All data you submit will be stored on our servers.  After your registration we'll instantly send you an email with an activation link to verify your mail address.   ", 'buddyforms' );
					$post_template        = __( "By submitting this form you grant us the rights <br> • to store your submitted contents in our database  <br>• to generate a post on our site based on your data  <br>• to make this post publicly accessible  ", 'buddyforms' );
					$contact_templat      = __( "By submitting these data you agree that we store all the data from the form our server. We may answer you via mail.", 'buddyforms' );
					$terms_label          = '';
					?>
					<div class="metabox-holder">
						<div class="postbox buddyforms-metabox">

							<div class="inside">


								<form method="post" action="options.php">

									<?php settings_fields( 'buddyforms_gdpr' ); ?>

									<table class="form-table">
										<tbody>

										<!-- Registration Settings -->
										<tr>
											<th colspan="2">
												<h3>
													<span><?php _e( 'General Data Protection Regulation - Settings', 'buddyforms' ); ?></span>
												</h3>
											</th>
										</tr>
										<tr valign="top">
											<th scope="row" valign="top">
												<?php _e( 'GDPR Agreement Templates', 'buddyforms' ); ?>
												<p>
													<small><?php _e( 'These templates are available in our new „GDPR Agreement form element“.  
                                                To give it a start, we inserted some adequate default text.
                                                <br><br>
                                                !! Please note that you should buy into professional legal advice for to be safe regarding reliable legal texts. !! 
                                                <br><br>
                                                Please edit these texts according to your needs here.', 'buddyforms' ); ?></small>
												</p>
											</th>
											<td>
												<label for="buddyforms_gdpr_registration">
													<p><?php _e( 'Registration Form', 'buddyforms' ) ?></p></label>
												<textarea cols="70" rows="5" id="buddyforms_gdpr_registration"
												          name="buddyforms_gdpr[templates][registration]"><?php echo empty( $buddyforms_gdpr['templates']['registration'] ) ? $registration_templat : $buddyforms_gdpr['templates']['registration']; ?></textarea>
												<label for="buddyforms_gdpr_post">
													<p><?php _e( 'Post Submission', 'buddyforms' ) ?></p></label>
												<textarea cols="70" rows="5" id="buddyforms_gdpr_post"
												          name="buddyforms_gdpr[templates][post]"><?php echo empty( $buddyforms_gdpr['templates']['post'] ) ? $post_template : $buddyforms_gdpr['templates']['post']; ?></textarea>
												<label for="buddyforms_gdpr_contact">
													<p><?php _e( 'Contact Form', 'buddyforms' ) ?></p></label>
												<textarea cols="70" rows="5" id="buddyforms_gdpr_contact"
												          name="buddyforms_gdpr[templates][contact]"><?php echo empty( $buddyforms_gdpr['templates']['contact'] ) ? $contact_templat : $buddyforms_gdpr['templates']['contact']; ?></textarea>
												<label for="buddyforms_gdpr_other">
													<p><?php _e( 'Custom', 'buddyforms' ) ?></p></label>
												<textarea cols="70" rows="5" id="buddyforms_gdpr_other"
												          name="buddyforms_gdpr[templates][other]"><?php echo empty( $buddyforms_gdpr['templates']['other'] ) ? '' : $buddyforms_gdpr['templates']['other']; ?></textarea>
											</td>
										</tr>
										<tr valign="top">
											<th scope="row" valign="top">
												<?php _e( 'Form Footer Links', 'buddyforms' ); ?>
												<p>
													<small><?php _e( 'Please select your Terms and Conditions and and your Privacy Policy page. These will be displayed below the form and remain visible after pressing „submit“ - when the form disappears.', 'buddyforms' ); ?></small>
												</p>
											</th>
											<td>
												<label for="buddyforms_gdpr_terms_label">
													<p><?php _e( 'Terms Label ( Will be displayed under the form )', 'buddyforms' ) ?></p>
												</label>
												<textarea cols="70" rows="5" id="buddyforms_gdpr_terms_label"
												          name="buddyforms_gdpr[terms_label]"><?php echo empty( $buddyforms_gdpr['terms_label'] ) ? $terms_label : $buddyforms_gdpr['terms_label']; ?></textarea>

												<label for="buddyforms_gdpr_terms">
													<p><?php _e( 'Terms Page ( Will be displayed as link after the terms label)', 'buddyforms' ) ?></p>
												</label>
												<?php
												if ( isset( $pages ) && is_array( $pages ) ) {
													echo '<select name="buddyforms_gdpr[terms]" id="buddyforms_gdpr_terms">';
													$pages['none'] = 'No Terms';
													foreach ( $pages as $page_id => $page_name ) {
														echo '<option ' . selected( $buddyforms_gdpr['terms'], $page_id ) . 'value="' . $page_id . '">' . $page_name . '</option>';
													}
													echo '</select>';
												}
												?>
											</td>
										</tr>
										</tbody>
									</table>

									<?php submit_button(); ?>

								</form>
							</div><!-- .inside -->
						</div><!-- .postbox -->
					</div><!-- .metabox-holder -->
					<?php
					break;
				default:
					do_action( 'buddyforms_settings_page_tab', $tab );

					break;
			}
		}
		?>
	</div> <!-- #poststuff -->
	<?php
}

function buddyforms_settings_page_sidebar() {
	buddyforms_go_pro( __( 'Awesome Premium Features', 'buddyforms' ), '', array(
		__( 'Priority Support', 'buddyforms' ),
		__( 'More Post Types', 'buddyforms' ),
		__( 'More Form Elements', 'buddyforms' ),
		__( 'Admin Metabox Support', 'buddyforms' )
	) );
}

/**
 * Process a settings import from a json file
 */
function buddyforms_process_settings_import() {
	if ( empty( $_POST['buddyforms_action'] ) || 'import_settings' != $_POST['buddyforms_action'] ) {
		return false;
	}
	if ( ! wp_verify_nonce( $_POST['buddyforms_import_nonce'], 'buddyforms_import_nonce' ) ) {
		return false;
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		return false;
	}

	$name      = explode( '.', $_FILES['import_file']['name'] );
	$extension = end( $name );

	if ( $extension != 'json' ) {
		wp_die( __( 'Please upload a valid .json file', 'buddyforms' ) );
	}

	$import_file = $_FILES['import_file']['tmp_name'];
	if ( empty( $import_file ) ) {
		wp_die( __( 'Please upload a file to import', 'buddyforms' ) );
	}
	// Retrieve the settings from the file and convert the json object to an array.
	$settings = json_decode( file_get_contents( $import_file ), true );

	$form_id = buddyforms_create_form_from_json( $settings );

	wp_safe_redirect( admin_url( 'post.php?post=' . $form_id . '&action=edit' ) );
	exit;
}

add_action( 'admin_init', 'buddyforms_process_settings_import' );

/**
 * Create a form from importing functionality
 *
 * @param $json_array
 *
 * @return int|WP_Error
 */
function buddyforms_create_form_from_json( $json_array ) {

	$bf_forms_args = array(
		'post_title'  => $json_array['name'],
		'post_type'   => 'buddyforms',
		'post_status' => 'publish',
	);

	// Insert the new form
	$post_id  = wp_insert_post( $bf_forms_args, true );
	$the_post = get_post( $post_id );

	$json_array['slug'] = $the_post->post_name;

	update_post_meta( $post_id, '_buddyforms_options', $json_array );

	if ( $post_id ) {
		buddyforms_attached_page_rewrite_rules( true );
	}

	return $post_id;

}