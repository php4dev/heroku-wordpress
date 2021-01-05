<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } function _fs_text( $text ) { $fn = 'translate'; return $fn( $text, 'freemius' ); } function _fs_x( $text, $context ) { $fn = 'translate_with_gettext_context'; return $fn( $text, $context, 'freemius' ); } 