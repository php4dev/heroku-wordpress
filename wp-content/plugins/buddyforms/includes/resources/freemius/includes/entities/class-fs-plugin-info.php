<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } class FS_Plugin_Info extends FS_Entity { public $plugin_id; public $description; public $short_description; public $banner_url; public $card_banner_url; public $selling_point_0; public $selling_point_1; public $selling_point_2; public $screenshots; function __construct( $plugin_info = false ) { parent::__construct( $plugin_info ); } static function get_type() { return 'plugin'; } }