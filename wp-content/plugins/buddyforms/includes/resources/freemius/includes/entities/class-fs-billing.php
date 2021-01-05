<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } class FS_Billing extends FS_Entity { public $entity_id; public $entity_type; public $business_name; public $first; public $last; public $email; public $phone; public $website; public $tax_id; public $address_street; public $address_apt; public $address_city; public $address_country; public $address_country_code; public $address_state; public $address_zip; function __construct( $event = false ) { parent::__construct( $event ); } static function get_type() { return 'billing'; } }