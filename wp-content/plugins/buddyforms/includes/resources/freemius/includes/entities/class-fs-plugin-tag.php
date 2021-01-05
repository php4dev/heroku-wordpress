<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } class FS_Plugin_Tag extends FS_Entity { public $version; public $url; public $requires_platform_version; public $tested_up_to_version; public $has_free; public $has_premium; public $release_mode; function __construct( $tag = false ) { parent::__construct( $tag ); } static function get_type() { return 'tag'; } function is_beta() { return ( 'beta' === $this->release_mode ); } }