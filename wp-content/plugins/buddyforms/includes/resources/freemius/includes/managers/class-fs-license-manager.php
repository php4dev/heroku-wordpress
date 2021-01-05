<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } class FS_License_Manager { static function has_premium_license( $licenses ) { if ( is_array( $licenses ) ) { foreach ( $licenses as $license ) { if ( ! $license->is_utilized() && $license->is_features_enabled() ) { return true; } } } return false; } }