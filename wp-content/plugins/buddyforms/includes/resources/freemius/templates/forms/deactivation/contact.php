<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } $fs = freemius( $VARS['id'] ); $slug = $fs->get_slug(); echo fs_text_inline( 'Sorry for the inconvenience and we are here to help if you give us a chance.', 'contact-support-before-deactivation', $slug ) . sprintf(" <a href='%s' class='button button-small button-primary'>%s</a>", $fs->contact_url( 'technical_support' ), fs_text_inline( 'Contact Support', 'contact-support', $slug ) ); 