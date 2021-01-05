<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

$css_form_id = 'buddyforms_form_' . $form_slug;
?>
<style data-target="global" type="text/css" <?php echo apply_filters( 'buddyforms_add_global_style_attributes', '', $css_form_id ); ?>>

    #bf_hweb{
        display: none;
    }

    /* Alerts */
    .bf-alert {
        display:block;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .bf-alert.error {
        background-color: #f2dede;
        color: #a94442;
        border-color: #ebccd1;
    }

    .bf-alert.success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }

    .bf-alert.warning {
        color: #8a6d3b;
        background-color: #fcf8e3;
        border-color: #faebcc;
    }

    .bf-alert.info {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1;
    }

    li.image.bf_image {
        list-style-type: none;
        float: left;
        padding-right: 10px;
    }

    ul.bf_files {
        padding: 0;
    }

    #poststuff {
        padding-top: 0;
        min-width: auto;
    }

    .bf_inputs li {
        list-style: none;
    }

    button.bf-draft:disabled,
    button.bf-submit:disabled {
        background-color: #c4c4c4;
    }

    .bf-draft {
        background: #f2f2f2;
        border: 1px solid rgba(0, 0, 0, 0.12);
        color: #444;
    }

    .bf-hidden {
        display: none !important;
    }

    #wp-admin-bar-buddyforms-admin-edit-form > a.ab-item:before {
        content: "\e000";
        font-family: 'icomoon';
        font-size: 27px;
        padding: 0;
        padding-right: 10px;
    }

    #bf_hweb {
        display: none !important;
	}

	.bf-clearfix::after {
		content: "";
		clear: both;
		display: table;
	}
</style>
