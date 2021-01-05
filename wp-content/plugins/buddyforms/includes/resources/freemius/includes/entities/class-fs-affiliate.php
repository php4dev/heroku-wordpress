<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } class FS_Affiliate extends FS_Scope_Entity { public $paypal_email; public $custom_affiliate_terms_id; public $is_using_custom_terms; public $status; public $domain; function is_active() { return ( 'active' === $this->status ); } function is_pending() { return ( 'pending' === $this->status ); } function is_suspended() { return ( 'suspended' === $this->status ); } function is_rejected() { return ( 'rejected' === $this->status ); } function is_blocked() { return ( 'blocked' === $this->status ); } }