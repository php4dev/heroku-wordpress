<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/** @var $bfdesign array Form design option */
/** @var $form_slug string Form slug */
/** @var $is_registration_form bool Determinate if the current form is a registration form */
/** @var $need_registration_form bool Determinate if the current form need a registration form include */
$css_form_id    = 'buddyforms_form_' . $form_slug;
$css_form_class = 'buddyforms-' . $form_slug;
?>
<style type="text/css" <?php echo apply_filters( 'buddyforms_add_form_style_attributes', '', $css_form_id ); ?>>
	<?php
			// only output CSS for labels if the option to disable CSS is unchecked
	if( $bfdesign['labels_disable_css'] == '' ) { ?>
	/* Design Options - Labels */
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group label,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group label {
		margin-right: 10px;
	<?php
		// Font Size
		if( $bfdesign['label_font_size'] != '' ) {
			echo 'font-size: ' . $bfdesign['label_font_size'] . 'px;';
		}
		// Font Color
		if( $bfdesign['label_font_color']['style'] == 'color' ) {
			echo 'color: ' . $bfdesign['label_font_color']['color'] . ';';
		}
		// Font Weight
		if( $bfdesign['label_font_style'] == 'bolditalic' || $bfdesign['label_font_style'] == 'bold' ) {
			echo 'font-weight: bold;';
		} else {
			echo 'font-weight: normal;';
		}
		// Font Style
		if( $bfdesign['label_font_style'] == 'bolditalic' || $bfdesign['label_font_style'] == 'italic' ) 	{
			echo 'font-style: italic;';
		} else {
			echo 'font-style: normal;';
		} ?>;
	}

	<?php } ?>

	<?php
	// only output CSS for these form elements if the option to disable CSS is unchecked
	if( $bfdesign['other_elements_disable_css'] == '' ) { ?>
	/* Design Options - Form Elements */
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .radio,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .radio {
		display: <?php echo esc_attr( $bfdesign['radio_button_alignment']); ?>;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .checkbox,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .checkbox {
		display: <?php echo esc_attr( $bfdesign['checkbox_alignment']); ?>;
	}
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .checkbox label.settings-input span,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .checkbox label.settings-input span {
		margin-left: 5px;
	}

	<?php } ?>

	<?php
	// only output CSS for form elements if the option to disable CSS is unchecked
	if( empty($bfdesign['field_disable_css']) ) { ?>
	/* Design Options - Text Fields */
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input input[type="range"],
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input input[type="range"] {
		width: 100%;
		padding-left: 0;
		padding-right: 0;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input textarea,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .form-control,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input textarea,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .form-control {
		display: block;
		width: 100%;
		border: 1px solid #aaa;

	<?php
			// Padding
			if( !empty($bfdesign['field_padding']) ) {
				echo 'padding: ' . ($bfdesign['field_padding'] - 1) . 'px;';
			} else {
				echo 'padding: ' . 5 . 'px;';
			}
			// Background Color
			if( $bfdesign['field_background_color']['style'] == 'color' ) {
				echo 'background-color: ' . $bfdesign['field_background_color']['color'] . ';';
			} elseif( $bfdesign['field_background_color']['style'] == 'transparent' ) {
				echo 'background-color: transparent;';
			}
			// Border Color
			if( $bfdesign['field_border_color']['style'] == 'color' ) {
				echo 'border-color: ' . $bfdesign['field_border_color']['color'] . ';';
			} elseif( $bfdesign['field_border_color']['style'] == 'transparent' ) {
				echo 'border-color: transparent;';
			}
			// Border Width
			if( $bfdesign['field_border_width'] != '' ) {
				echo 'border-width: ' . $bfdesign['field_border_width'] . 'px; border-style: solid;';
			}
			// Border Radius
			if( $bfdesign['field_border_radius'] != '' ) {
				echo 'border-radius: ' . $bfdesign['field_border_radius'] . 'px;';
			}
			// Font Size
			if( $bfdesign['field_font_size'] != '' ) {
				echo 'font-size: ' . $bfdesign['field_font_size'] . 'px;';
			}
			// Font Color
			if( $bfdesign['field_font_color']['style'] == 'color' ) {
				echo 'color: ' . $bfdesign['field_font_color']['color'] . ';';
			} ?>
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input label.settings-input.form-control,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input label.settings-input.form-control,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input input[type="range"],
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input input[type="range"] {
		border: none;
	}

	/* Design Options - Text Fields Active */
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input textarea:focus,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .form-control:focus,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input textarea:focus,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .form-control:focus {
	<?php
			// Background Color
			if( $bfdesign['field_active_background_color']['style'] == 'color' ) {
				echo 'background-color: ' . $bfdesign['field_active_background_color']['color'] . ';';
			} elseif( $bfdesign['field_active_background_color']['style'] == 'transparent' ) {
				echo 'background-color: transparent;';
			}
			// Border Color
			if( $bfdesign['field_active_border_color']['style'] == 'color' ) {
				echo 'border-color: ' . $bfdesign['field_active_border_color']['color'] . ';';
			} elseif( $bfdesign['field_active_border_color']['style'] == 'transparent' ) {
				echo 'border-color: transparent;';
			}
			// Font Color
			if( $bfdesign['field_active_font_color']['style'] == 'color' ) {
				echo 'color: ' . $bfdesign['field_active_font_color']['color'] . ';';
			} ?>
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .form-control:disabled,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .form-control:disabled {
		background: rgba(255, 255, 255, 0.5);
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.04);
		color: rgba(51, 51, 51, 0.5);
		cursor: not-allowed;
	}

	<?php // Placeholder Font Color
	if( $bfdesign['field_placeholder_font_color']['style'] == 'color' ) {
		echo '/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form form#'.esc_attr($css_form_id).' .bf-input textarea::placeholder, /* Divi */ .et-db #et-boc .et-l .the_buddyforms_form form#'.esc_attr($css_form_id).' .bf-input .form-control::placeholder,';
		echo '.the_buddyforms_form form#'.esc_attr($css_form_id).' .bf-input textarea::placeholder, .the_buddyforms_form form#'.esc_attr($css_form_id).' .bf-input .form-control::placeholder {';
		echo 'color: ' . $bfdesign['field_placeholder_font_color']['color'] . '; }';
	} ?>

	<?php } ?>


	<?php
	// only output CSS for descriptions if the option to disable CSS is unchecked
	if( empty($bfdesign['desc_disable_css']) ) { ?>

	/* Design Options - Descriptions */
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> span.help-inline,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> span.help-block,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> span.help-inline,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> span.help-block {
		padding: 5px 0;
	<?php
			// Font Size
			if( $bfdesign['desc_font_size'] != '' ) {
				echo 'font-size: ' . $bfdesign['desc_font_size'] . 'px !important;';
			}
			// Font Color
			if( $bfdesign['desc_font_color']['style'] == 'color' ) {
				echo 'color: ' . $bfdesign['desc_font_color']['color'] . ';';
			}
			// Font Style
			if( $bfdesign['desc_font_style'] == 'italic' ) {
				echo 'font-style: italic;';
			} else {
				echo 'font-style: normal !important;';
			} ?>;
	}

	<?php } ?>


	<?php
	// only output CSS for buttons if the option to disable CSS is unchecked
	if( empty($bfdesign['button_disable_css']) ) { ?>
	/* Design Options - Buttons */
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-submit, .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-draft,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-submit, .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-draft {
		margin-bottom: 10px;
	<?php
			// Button Width
			if( $bfdesign['button_width'] != 'inline' ) {
				echo 'display: block; width: 100%;'; }
			else {
				echo 'display: inline; width: auto;';
			}
			// Button Size
			if( $bfdesign['button_size'] == 'large' ) {
				echo 'padding: 12px 25px; font-size: 17px;';
			}
			if( $bfdesign['button_size'] == 'xlarge' ) {
				echo 'padding: 15px 32px; font-size: 19px;';
			}
			// Background Color
			if( $bfdesign['button_background_color']['style'] == 'color' ) {
				echo 'background-color: ' . $bfdesign['button_background_color']['color'] . ';';
			} elseif( $bfdesign['button_background_color']['style'] == 'transparent' ) {
				echo 'background-color: transparent;';
			}
			// Font Color
			if( $bfdesign['button_font_color']['style'] == 'color' ) {
				echo 'color: ' . $bfdesign['button_font_color']['color'] . ';';
			}
			// Border Radius
			if( $bfdesign['button_border_radius'] != '' ) {
				echo 'border-radius: ' . $bfdesign['button_border_radius'] . 'px;';
			}
			// Border Width
			if( $bfdesign['button_border_width'] != '' ) {
				echo 'border-width: ' . $bfdesign['button_border_width'] . 'px; border-style: solid;';
			}
			// Border Color
			if( $bfdesign['button_border_color']['style'] == 'color' ) {
				echo 'border-color: ' . $bfdesign['button_border_color']['color'] . ';';
			} elseif( $bfdesign['button_border_color']['style'] == 'transparent' ) {
				echo 'border-color: transparent;';
			} ?>
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions {
		text-align: <?php echo esc_attr( $bfdesign['button_alignment']); ?>;
	}

	/*Button Width Behaviour -- if always on block*/
	<?php if( $bfdesign['button_width'] != 'block' ) : ?>
	@media (min-width: 768px) {
		/* Divi */ .et-db #et-boc .et-l .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-submit, .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-draft,
		.<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-submit, .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-draft {
			display: inline;
			width: auto !important;
		}
	}

	<?php endif; ?>

	/* Design Options - Buttons Hover State */
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-submit:hover,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-draft:hover,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-submit:focus,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-draft:focus,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-submit:hover,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-draft:hover,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-submit:focus,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .form-actions button.bf-draft:focus {
	<?php
		 // Background Color
		 if( $bfdesign['button_background_color_hover']['style'] == 'color' ) {
			 echo 'background-color: ' . $bfdesign['button_background_color_hover']['color'] . ';';
		 } elseif( $bfdesign['button_background_color_hover']['style'] == 'transparent' ) {
			 echo 'background-color: transparent;';
		 }
		 // Font Color
		 if( $bfdesign['button_font_color_hover']['style'] == 'color' ) {
			 echo 'color: ' . $bfdesign['button_font_color_hover']['color'] . ';';
		 }
		 // Border Color
		 if( $bfdesign['button_border_color_hover']['style'] == 'color' ) {
			 echo 'border-color: ' . $bfdesign['button_border_color_hover']['color'] . ';';
		 } elseif( $bfdesign['button_border_color_hover']['style'] == 'transparent' ) {
			 echo 'border-color: transparent;';
		 } ?>
	}

	<?php } ?>

	<?php echo esc_attr( $bfdesign['custom_css']); ?>
	/* The BuddyForms Form */

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?>,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> {
		margin-top: 20px;
		margin: 0 -15px;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> > fieldset,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> > fieldset {
		hyphens: manual;
		box-sizing: border-box;
		display: contents !important;
	}

	/* Divi */ .et-db #et-boc .et-l .bf_field_group,
	.bf_field_group {
		margin: 15px 0;
	}

	/* Divi */ .et-db #et-boc .et-l [class^="bf_field_group elem-gdpragreement"],
	[class^="bf_field_group elem-gdpragreement"] {
		margin-top: 0;
	}

	/* Divi */ .et-db #et-boc .et-l [class^="bf_field_group elem-gdpragreement"]:not(.elem-gdpragreement-1) label[for^="gdpragreement"],
	[class^="bf_field_group elem-gdpragreement"]:not(.elem-gdpragreement-1) label[for^="gdpragreement"] {
		display: none;
	}

	/* Divi */ .et-db #et-boc .et-l [class^="bf_field_group elem-gdpragreement"] .bf-input .checkbox label.settings-input,
	[class^="bf_field_group elem-gdpragreement"] .bf-input .checkbox label.settings-input {
		padding-left: 0;
		padding-right: 0;
		margin-bottom: 0;
	}

	/* Divi */ .et-db #et-boc .et-l [class^="bf_field_group elem-gdpragreement"]:not(.elem-gdpragreement-1) .bf-input .checkbox label.settings-input,
	[class^="bf_field_group elem-gdpragreement"]:not(.elem-gdpragreement-1) .bf-input .checkbox label.settings-input {
		padding-top: 0;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .bf_inputs,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .bf_inputs {
		margin: 0;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .bf_inputs .wp-editor-container table tr,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .bf_inputs .wp-editor-container table tr {
		background: transparent;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> label,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> label {
		display: block;
	}

	<?php if( empty($bfdesign['desc_disable_css']) ): ?>

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> span.help-inline,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> span.help-block,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> span.help-inline,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> span.help-block {
		display: block;
		font-style: italic;
		font-weight: normal;
	}

	<?php endif; ?>

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .revision,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .revision {
		overflow: auto;
		overflow-x: hidden;
		margin: 40px 0 20px 0;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> ul.post-revisions,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> ul.post-revisions {
		list-style: none outside none;
		margin: 10px 0;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> ul.post-revisions li,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> ul.post-revisions li {
		margin: 5px 0;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> ul.post-revisions li img,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> ul.post-revisions li img {
		margin-right: 10px;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .post-revisions li,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .post-revisions li {
		float: left;
		padding: 5px;
		width: 100%;
	}

	/* Divi */ .et-db #et-boc .et-l #loginform input.input,
	#loginform input.input {
		max-width: 300px;
	}

	/* Divi */ .et-db #et-boc .et-l #loginform input.input,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form textarea,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form input[type=url],
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form input[type=link],
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form input[type=text],
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form input[type=email],
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form input[type=password],
	#loginform input.input,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form textarea,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form input[type=url],
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form input[type=link],
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form input[type=text],
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form input[type=email],
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .standard-form input[type=password] {
		width: 100%;
		background: #fff;
		border: 1px solid #ccc;
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		color: inherit;
		font: inherit;
		font-size: 14px;
		padding: 6px;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-xs-12,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-xs-12 {
		position: relative;
		min-height: 1px;
		padding-left: 15px;
		padding-right: 15px;
		float: left;
		width: 100%;
		box-sizing: border-box;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-9,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-9 {
		position: relative;
		min-height: 1px;
		padding-left: 15px;
		padding-right: 15px;
		float: left;
		width: 100%;
		box-sizing: border-box;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-8,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-8 {
		position: relative;
		min-height: 1px;
		padding-left: 15px;
		padding-right: 15px;
		float: left;
		width: 100%;
		box-sizing: border-box;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-6,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-6 {
		position: relative;
		min-height: 1px;
		padding-left: 15px;
		padding-right: 15px;
		float: left;
		width: 100%;
		box-sizing: border-box;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-4,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-4 {
		position: relative;
		min-height: 1px;
		padding-left: 15px;
		padding-right: 15px;
		float: left;
		width: 100%;
		box-sizing: border-box;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-3,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-3 {
		position: relative;
		min-height: 1px;
		padding-left: 15px;
		padding-right: 15px;
		float: left;
		width: 100%;
		box-sizing: border-box;
	}

	@media (min-width: 992px) {
		/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-9,
		.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-9 {
			width: 75%;
		}

		/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-8,
		.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-8 {
			width: 66.66%;
		}

		/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-6,
		.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-6 {
			width: 50%;
		}

		/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-4,
		.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-4 {
			width: 33.33%;
		}

		/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-3,
		.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-3 {
			width: 25%;
		}

		/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-12.bf-start-row,
		/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-9.bf-start-row,
		/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-8.bf-start-row,
		/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-6.bf-start-row,
		/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-4.bf-start-row,
		/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-3.bf-start-row,
		.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-12.bf-start-row,
		.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-9.bf-start-row,
		.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-8.bf-start-row,
		.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-6.bf-start-row,
		.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-4.bf-start-row,
		.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-3.bf-start-row {
			clear: both;
		}
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> #insert-media-button,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> #insert-media-button {
		padding: 1px 7px 1px 5px;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> #wp-buddyforms_form_content-editor-tools .wp-switch-editor,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> #wp-buddyforms_form_content-editor-tools .wp-switch-editor {
		height: auto !important;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> #wp-buddyforms_form_content-editor-container.error,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> #wp-buddyforms_form_content-editor-container.error {
		border: 1px solid red !important;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> #wp-buddyforms_form_content-editor-container,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> #wp-buddyforms_form_content-editor-container {
		border: 1px solid rgba(0, 0, 0, 0.2) !important;

	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> #wp-buddyforms_form_content-editor-container iframe,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> #wp-buddyforms_form_content-editor-container iframe {
		width: 99% !important;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .dropzone .dz-message,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .dropzone .dz-message {
		text-align: left;
	}

	/* --- Form Errors --- */
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group input.error,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group select.error,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group button.error,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group textarea.error,
	html body .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group input.error,
	html body .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group select.error,
	html body .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group button.error,
	html body .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group textarea.error {
		border: 1px solid red !important;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group div.dropzone.dz-clickable.error,
	html body .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group div.dropzone.dz-clickable.error {
		border: 1px solid red !important;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group.a textarea.error,
	html body .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group.a textarea.error {
		border: 1px solid red !important;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group label.error,
	html body .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group label.error {
		color: red;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .checkbox label label.error,
	html body .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .checkbox label label.error {
		color: red;
		font-weight: bold;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group span.select2-selection.select2-selection--multiple.error,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group span.select2-selection.select2-selection--single.error,
	html body .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group span.select2-selection.select2-selection--multiple.error,
	html body .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group span.select2-selection.select2-selection--single.error {
		border: 1px solid red !important;
	}

	/* --- Form Errors --- */

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-12.bf-start-row,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-9.bf-start-row,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-8.bf-start-row,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-6.bf-start-row,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-4.bf-start-row,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-3.bf-start-row,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-12.bf-start-row,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-9.bf-start-row,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-8.bf-start-row,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-6.bf-start-row,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-4.bf-start-row,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> fieldset .col-md-3.bf-start-row {
		clear: both;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input textarea, .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input #comments.form-control,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input textarea, .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input #comments.form-control {
		display: block;
		width: 100%;
		min-height: 40px;
		font-size: 15px;
		float: unset;
	}

	/* Divi */ .et-db #et-boc .et-l #content .buddypress-wrap .the_buddyforms_form .standard-form input[type="search"],
	#content .buddypress-wrap .the_buddyforms_form .standard-form input[type="search"] {
		background: #fff;
		border: unset;
	}

	/* Divi */ .et-db #et-boc .et-l #content .buddypress-wrap .the_buddyforms_form .standard-form li.select2-selection__choice,
	#content .buddypress-wrap .the_buddyforms_form .standard-form li.select2-selection__choice {
		padding: 0 5px !important;
		list-style: none;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?>.bf-input .select2-selection,
	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?>.bf-input .select2-selection,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection {
		width: 100%;
		float: unset;
		height: auto;
		display: flex;
		font-size: 15px;
		appearance: none;
		min-height: unset;
		border: 1px solid #aaa;
		background-color: #fafafa !important;
		box-sizing: content-box !important;
		<?php
			if(!empty($bfdesign['field_padding'])) {
				echo 'padding: ' . ($bfdesign['field_padding'] - 1) . 'px;';
				echo 'min-height: calc(52px  - ' . (($bfdesign['field_padding'] * 2) + 5) . 'px);';
				echo 'width: calc(100% - ' . $bfdesign['field_padding'] * 2 . 'px) !important;';
			}
		?>
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection .select2-selection__arrow:before,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection .select2-selection__arrow:before {
		content: "" !important;
		width: 100% !important;
		display: block;
		height: 100%;
		line-height: 35px;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection--single .select2-selection__arrow,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 100%;
		top: 1px;
		right: 0;
		width: 20px;
		position: absolute;
		background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%2.5.21-beta11.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E');
		background-repeat: no-repeat, repeat;
		background-position: right .7em top 50%, 0 0;
		background-size: .65em auto, 100%;
		<?php
			if(!empty($bfdesign['field_padding'])) {
				echo 'right: ' . $bfdesign['field_padding'] . 'px;';
			}
		?>
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection--single .select2-selection__arrow b,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection--single .select2-selection__arrow b {
		display: none;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection--multiple .select2-selection__choice,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection--multiple .select2-selection__choice {
		background-color: #e4e4e4;
		border: 1px solid #aaa;
		border-radius: 4px;
		cursor: default;
		float: left;
		margin-right: 5px;
		margin-top: 5px;
		padding: 0 5px;
		height: 24px;
		line-height: 150%;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group.acf-field .select2-selection--multiple .select2-selection__rendered li,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group.acf-field .select2-selection--multiple .select2-selection__rendered li {
		line-height: 30px;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .select2-selection--multiple .select2-selection__rendered li,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .select2-selection--multiple .select2-selection__rendered li {
		height: auto;
		list-style: none;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .select2-selection--multiple .select2-selection__rendered li .select2-search__field,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .select2-selection--multiple .select2-selection__rendered li .select2-search__field {
		padding: 0;
		height: 100%;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection .select2-selection__clear,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection .select2-selection__clear {
		right: 0;
		top: 0;
		bottom: 0px;
		position: absolute;
		margin-left: 5px !important;
		font-size: 1rem;
		display: flex;
    align-items: center;
		<?php
			if(!empty($bfdesign['field_padding'])) {
				echo 'right: ' . ($bfdesign['field_padding'] + 35) . 'px;';
			}
		?>
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection.select2-selection--multiple .select2-selection__choice,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection.select2-selection--multiple .select2-selection__choice {
		color: #444;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection.select2-selection--multiple .select2-selection__choice__remove,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection.select2-selection--multiple .select2-selection__choice__remove {
		color: #666666;
		cursor: pointer;
		font-weight: bold;
		margin-right: 5px;
		display: inline-block;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection--multiple .select2-selection__clear,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection--multiple .select2-selection__clear {
		right: 10px;
		float: right;
		margin-top: -4;
		font-size: 1em;
		cursor: pointer;
		font-weight: bold;
		position: absolute;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection .select2-selection__placeholder,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection .select2-selection__placeholder {
		color: #666666;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection.select2-selection--multiple .select2-selection__rendered,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection.select2-selection--multiple .select2-selection__rendered {
		padding: 0;
		height: auto;
		margin: -5px 0;
		overflow: hidden;
		line-height: 35px;
		padding-right: 40px;
		box-sizing: content-box;
		width: calc(100% - 40px);
		position: relative;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection .select2-selection__rendered,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-selection .select2-selection__rendered {
		padding: 0;
		height: auto;
		position: static;
		line-height: 20px;
		<?php
			if(!empty($bfdesign['field_padding'])) {
				//echo 'right: ' . $bfdesign['field_padding'] . 'px;';
			}
		?>
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection li.select2-search--inline,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection li.select2-search--inline {
		margin: 0;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection .select2-search--inline .select2-search__field,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection .select2-search--inline .select2-search__field {
		top: 2px;
		margin: 0;
		color: #666666;
		line-height: 0;
    position: relative;
		background-color: #fafafa !important;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection .select2-search--inline .select2-search__field::-webkit-input-placeholder,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection .select2-search--inline .select2-search__field::-webkit-input-placeholder {
		/* Edge */
		color: #666666;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection .select2-search--inline .select2-search__field:-ms-input-placeholder,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection .select2-search--inline .select2-search__field:-ms-input-placeholder {
		/* Internet Explorer 10-11 */
		color: #666666;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection .select2-search--inline .select2-search__field::placeholder,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input .select2-container--default .select2-selection .select2-search--inline .select2-search__field::placeholder {
		color: #666666;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input select.form-control,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input select.form-control {
		display: block;
		margin: 0;
		width: 100%;
		padding: 5px;
		appearance: none;
		overflow: visible;
		line-height: revert;
		-moz-appearance: none;
		-webkit-appearance: none;
		background-color: #fafafa;
		background-size: .65em auto, 100%;
		box-sizing: border-box !important;
		background-repeat: no-repeat, repeat;
		background-position: right .7em top 50%, 0 0;
		background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%2.5.21-beta11.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E');
		<?php
			if (!empty($bfdesign['field_padding'])) {
				echo 'padding: ' . $bfdesign['field_padding'] . 'px !important;';
				//echo 'width: calc(100% - ' . ($bfdesign['field_padding'] * 2) . 'px) !important;';
				echo 'background-position: right ' . $bfdesign['field_padding'] . 'px top 50%, 0 0 !important;';
			}
		?>
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input select.form-control::-ms-expand,
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf-input select.form-control::-ms-expand {
		display: none;
	}

	/* Divi */ .et-db #et-boc .et-l .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .radio > label, .bf_field_group .radio > label > input[type='radio'],
	.the_buddyforms_form .<?php echo esc_attr($css_form_class) ?> .bf_field_group .radio > label, .bf_field_group .radio > label > input[type='radio'] {
		cursor: pointer;
	}

	/* Avoid red style over the elements comming from BuddyPress */
	/* Divi */ .et-db #et-boc .et-l .buddypress-wrap .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?>.standard-form input[required]:invalid,
	/* Divi */ .et-db #et-boc .et-l .buddypress-wrap .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?>.standard-form textarea[required]:invalid,
	.buddypress-wrap .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?>.standard-form input[required]:invalid,
	.buddypress-wrap .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?>.standard-form textarea[required]:invalid {
		border-color: #d6d6d6;
	}

	/* Fix to avoid BP override the width of the MCE editor on the text tab */
	/* Divi */ .et-db #et-boc .et-l .buddypress-wrap .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?>.standard-form .wp-editor-wrap input:not(.small),
	.buddypress-wrap .the_buddyforms_form .<?php echo esc_attr($css_form_class) ?>.standard-form .wp-editor-wrap input:not(.small) {
		width: initial;
	}

	/* Fix to avoid BP override the width of text inputs */
	/* Divi */ .et-db #et-boc .et-l #buddypress .the_buddyforms_form .standard-form input[type="text"],
	#buddypress .the_buddyforms_form .standard-form input[type="text"] {
		width: 100%;
	}

	/* Divi */ .et-db #et-boc .et-l #content .the_buddyforms_form form.<?php echo esc_attr($css_form_class) ?> fieldset,
	#content .the_buddyforms_form form.<?php echo esc_attr($css_form_class) ?> fieldset {
		border: 1px solid #d6d6d6;
		padding: 0;
		width: 100%;
		max-width: 100%;
		min-width: 100%;
		margin-top: 0.5em;
		margin-bottom: 0.5em;
	}

	/* Solution to avoid the select2 dropdown not left behind the popups */
	/* Divi */ .et-db #et-boc .et-l span.select2-dropdown.buddyforms-dropdown,
	span.select2-dropdown.buddyforms-dropdown {
		z-index: 200000;
	}
</style>
