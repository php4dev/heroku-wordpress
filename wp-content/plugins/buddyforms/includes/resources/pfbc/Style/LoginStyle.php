<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

$css_form_id = 'buddyforms_form_' . $form_slug;
?>
<style data-target="global" type="text/css" <?php echo apply_filters( 'buddyforms_add_global_style_attributes', '', $css_form_id ); ?>>
    .bf-show-login-form {
        padding: 0.5em;
    }

    .bf-show-login-form h3 {
        margin-top: 0.5em;
    }

    .bf-show-login-form input[type="text"], .bf-show-login-form input[type="password"] {
        display: block;
    }

    #loginform input.input {
        width: 100%;
        background: #fff;
        border: 1px solid #ccc;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        color: inherit;
        font: inherit;
        padding: 15px;
        font-size: 15px;
        min-height: 40px;
    }
</style>