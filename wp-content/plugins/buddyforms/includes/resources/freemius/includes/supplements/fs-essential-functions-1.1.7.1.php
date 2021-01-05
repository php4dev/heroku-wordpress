<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } function fs_find_direct_caller_plugin_file( $file ) { $all_plugins = fs_get_plugins( true ); $file_real_path = fs_normalize_path( realpath( $file ) ); foreach ( $all_plugins as $relative_path => $data ) { if ( 0 === strpos( $file_real_path, fs_normalize_path( dirname( realpath( WP_PLUGIN_DIR . '/' . $relative_path ) ) . '/' ) ) ) { if ( '.' !== dirname( trailingslashit( $relative_path ) ) ) { return $relative_path; } } } return null; } 