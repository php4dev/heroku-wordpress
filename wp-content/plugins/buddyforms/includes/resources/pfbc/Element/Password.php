<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Password
 */
class Element_Password extends Element_Textbox {
	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "password" );

	public function render() {
		global $buddyforms;
		$is_required         = $this->isRequired();
		$required_string     = ! empty( $is_required ) ? 'required' : '';
		$form_slug           = $this->getAttribute( 'data-form' );
		$labels_layout       = isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) ? $buddyforms[ $form_slug ]['layout']['labels_layout'] : 'inline';
		$placeholder_label_1 = isset( $this->field_options['new_password_placeholder'] ) ? $this->field_options['new_password_placeholder'] : __( 'New Password', 'buddyforms' );
		$placeholder_label_2 = isset( $this->field_options['confirm_password_placeholder'] ) ? $this->field_options['confirm_password_placeholder'] :__( 'Password Confirm', 'buddyforms' );
		if ( $labels_layout === 'inline' && $is_required ) {
			$placeholder_label_1 .= ' ' . $this->getRequiredPlainSignal();
			$placeholder_label_2 .= ' ' . $this->getRequiredPlainSignal();
		}
		$classes = 'form-control ';
		$attr_error   = $this->getAttribute( 'error' );
		$opt_error    = $this->getOption( 'error' );
		if ( ! empty( $attr_error ) || ! empty( $opt_error ) ) {
			$classes .= 'error';
		}
		?>
        <fieldset>
            <div style="margin: 1em;">
                <input data-element-slug="user_pass" data-form="<?php echo $form_slug ?>" placeholder="<?php echo $placeholder_label_1 ?>" <?php echo $required_string ?> name="<?php echo $this->_attributes["name"]; ?>" id="<?php echo $this->_attributes["id"]; ?>" class="<?php echo $classes ?>" type="password"/>
            </div>
            <div style="margin: 1em;">
                <input data-element-slug="user_pass" data-form="<?php echo $form_slug ?>" placeholder="<?php echo $placeholder_label_2 ?>" <?php echo $required_string ?> name="<?php echo $this->_attributes["name"]; ?>_confirm" id="<?php echo $this->_attributes["id"]; ?>2" class="<?php echo $classes ?>" type="password"/>
            </div>
            <p>
            <div style="margin: 1em;">
		        <div id="password-strength"></div>
	        </div>
            </p>
        </fieldset>
		<?php
	}
}
