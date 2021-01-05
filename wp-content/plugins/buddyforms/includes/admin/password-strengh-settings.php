<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


add_filter( 'buddyforms_admin_tabs', 'buddyforms_password_strength_admin_tab', 10, 1 );
function buddyforms_password_strength_admin_tab( $tabs ) {

	$tabs['password_strength'] = 'Password Strength';

	return $tabs;
}

add_action( 'buddyforms_settings_page_tab', 'buddyforms_password_strength_settings_page_tab' );
function buddyforms_password_strength_settings_page_tab( $tab ) {

	if ( $tab != 'password_strength' ) {
		return $tab;
	}

	$password_strength_settings = get_option( 'buddyforms_password_strength_settings' );
	$required_strength          = apply_filters('buddyforms_password_strength_default_strength_option', 3);
	if ( isset( $password_strength_settings ) && isset( $password_strength_settings["required_strength"] ) ) {
		$required_strength = $password_strength_settings["required_strength"];
	}
	?>

	<div class="metabox-holder">
		<div class="postbox buddyforms-metabox">
			<div class="inside">
				<form method="post" action="options.php">

					<?php settings_fields( 'buddyforms_password_strength_settings' ); ?>

					<table class="form-table">

						<tbody>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="buddyforms_password_strength"><?php _e( 'Strength Requirement', 'buddyforms' ) ?></label>
								<span class="buddyforms-help-tip"> </span>
							</th>
							<td class="forminp forminp-select">
								<select name="buddyforms_password_strength_settings[required_strength]" id="buddyforms_password_strength" style="min-width:350px;" class="enhanced" tabindex="-1" aria-hidden="true">
									<option <?php selected( $required_strength, "0" ) ?> value="0"><?php _e( 'Level 0 - Anything', 'buddyforms' ) ?></option>
									<option <?php selected( $required_strength, "1" ) ?> value="1"><?php _e( 'Level 1 - Weakest', 'buddyforms' ) ?></option>
									<option <?php selected( $required_strength, "2" ) ?> value="2"><?php _e( 'Level 2 - Weak', 'buddyforms' ) ?></option>
									<option <?php selected( $required_strength, "3" ) ?> value="3"><?php _e( 'Level 3 - Medium (Default)', 'buddyforms' ) ?></option>
									<option <?php selected( $required_strength, "4" ) ?> value="4"><?php _e( 'Level 4 - Strong', 'buddyforms' ) ?></option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="buddyforms_password_strength_lavel_1"><?php _e( 'Level 1 Message', 'buddyforms' ) ?></label>
								<span class="buddyforms-help-tip"> </span>
							</th>
							<td class="forminp forminp-text">
								<input name="buddyforms_password_strength_settings[lavel_1]" id="buddyforms_password_strength_lavel_1" type="text" style="min-width:350px;" value="<?php echo isset( $password_strength_settings['lavel_1'] ) && ! empty( $password_strength_settings['lavel_1'] ) ? $password_strength_settings['lavel_1'] : __( "Short: Your password is too short.", 'buddyforms' ); ?>" class="" placeholder="<?php _e( "Short: Your password is too short.", 'buddyforms' ); ?>">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="buddyforms_password_strength_lavel_2"><?php _e( 'Level 2 Message', 'buddyforms' ) ?></label>
								<span class="buddyforms-help-tip"> </span>
							</th>
							<td class="forminp forminp-text">
								<input name="buddyforms_password_strength_settings[lavel_2]" id="buddyforms_password_strength_lavel_2" type="text" style="min-width:350px;" value="<?php echo isset( $password_strength_settings['lavel_2'] ) && ! empty( $password_strength_settings['lavel_2'] ) ? $password_strength_settings['lavel_2'] : __( "Password Strength: Weak", 'buddyforms' ); ?>" class="" placeholder="<?php __( "Password Strength: Weak", 'buddyforms' ); ?>">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="buddyforms_password_strength_lavel_3"><?php _e( 'Level 3 Message', 'buddyforms' ) ?></label>
								<span class="buddyforms-help-tip"> </span>
							</th>
							<td class="forminp forminp-text">
								<input name="buddyforms_password_strength_settings[lavel_3]" id="buddyforms_password_strength_lavel_3" type="text" style="min-width:350px;" value="<?php echo isset( $password_strength_settings['lavel_3'] ) && ! empty( $password_strength_settings['lavel_3'] ) ? $password_strength_settings['lavel_3'] : __( "Password Strength: OK", 'buddyforms' ); ?>" class="" placeholder="<?php __( "Password Strength: OK", 'buddyforms' ); ?>">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="buddyforms_password_strength_lavel_4"><?php _e( 'Level 4 Message', 'buddyforms' ) ?></label>
								<span class="buddyforms-help-tip"> </span>
							</th>
							<td class="forminp forminp-text">
								<input name="buddyforms_password_strength_settings[lavel_4]" id="buddyforms_password_strength_lavel_4" type="text" style="min-width:350px;" value="<?php echo isset( $password_strength_settings['lavel_4'] ) && ! empty( $password_strength_settings['lavel_4'] ) ? $password_strength_settings['lavel_4'] : __( "Password Strength: Strong", 'buddyforms' ); ?>" class="" placeholder="<?php __( "Password Strength: Strong", 'buddyforms' ); ?>">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="buddyforms_password_strength_error"><?php _e( 'Mismatch', 'buddyforms' ) ?></label>
								<span class="buddyforms-password-strength-help-tip"> </span></th>
							<td class="forminp forminp-text">
								<input name="buddyforms_password_strength_settings[mismatch]" id="buddyforms_password_error" type="text" style="min-width:350px;" value="<?php echo isset( $password_strength_settings['mismatch'] ) && ! empty( $password_strength_settings['mismatch'] ) ? $password_strength_settings['mismatch'] : __( "Mismatch", 'buddyforms' ); ?>" class="" placeholder="<?php __( "Mismatch", 'buddyforms' ); ?>">
							</td>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="buddyforms_hint_text"><?php _e( 'Password Hint Text', 'buddyforms' ) ?></label>
								<span class="buddyforms-help-tip"> </span></th>
							<td class="forminp forminp-text">
								<input name="buddyforms_password_strength_settings[hint_text]" id="buddyforms_hint_text" type="text" style="min-width:350px;" value="<?php echo isset( $password_strength_settings['hint_text'] ) && ! empty( $password_strength_settings['hint_text'] ) ? $password_strength_settings['hint_text'] : __( "Hint: The password should be at least twelve characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like !  ? $ % ^ &amp; ).", 'buddyforms' ); ?>">
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
}

add_action( 'admin_init', 'buddyforms_password_strength_register_option' );
function buddyforms_password_strength_register_option() {
	// creates our settings in the options table
	register_setting( 'buddyforms_password_strength_settings', 'buddyforms_password_strength_settings', 'buddyforms_password_strength_settings_default_sanitize' );
}

// Sanitize the Settings
function buddyforms_password_strength_settings_default_sanitize( $new ) {
	return $new;
}
