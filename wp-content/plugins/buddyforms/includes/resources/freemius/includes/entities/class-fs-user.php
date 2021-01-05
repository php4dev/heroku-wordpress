<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } class FS_User extends FS_Scope_Entity { public $email; public $first; public $last; public $is_verified; public $is_beta; public $customer_id; public $gross; function __construct( $user = false ) { parent::__construct( $user ); } function get_name() { return trim( ucfirst( trim( is_string( $this->first ) ? $this->first : '' ) ) . ' ' . ucfirst( trim( is_string( $this->last ) ? $this->last : '' ) ) ); } function is_verified() { return ( isset( $this->is_verified ) && true === $this->is_verified ); } function is_beta() { return ( isset( $this->is_beta ) && true === $this->is_beta ); } static function get_type() { return 'user'; } }