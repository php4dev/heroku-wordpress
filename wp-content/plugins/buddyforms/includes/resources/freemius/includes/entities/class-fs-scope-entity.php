<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } class FS_Scope_Entity extends FS_Entity { public $public_key; public $secret_key; function __construct( $scope_entity = false ) { parent::__construct( $scope_entity ); } }