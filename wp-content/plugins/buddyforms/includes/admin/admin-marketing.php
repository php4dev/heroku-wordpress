<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }



function buddyforms_marketing_meet_condition() {
	$meet = false;


	return $meet;
}

add_action( 'admin_init', 'buddyforms_marketing_init' );

function buddyforms_marketing_init() {
//	add_action( 'admin_enqueue_scripts', 'buddyforms_marketing_assets' );
	add_action( 'admin_enqueue_scripts', 'buddyforms_marketing_offer_bundle', 10, 1 );
//	add_action( 'admin_enqueue_scripts', 'buddyforms_marketing_form_list_coupon_for_free', 10, 1 );

	add_action( 'admin_footer_text', 'passive_feedback_trigger', 1, 1 );

	add_action( 'admin_enqueue_scripts', 'user_satisfaction_trigger', 10, 1 );
}

function buddyforms_marketing_offer_bundle( $hook ) {
	if ( $hook !== 'buddyforms_page_buddyforms-addons' ) {
		return;
	}
	$user_id = get_current_user_id();
	if ( empty( $user_id ) || ! is_user_logged_in() ) {
		return;
	}
	if ( ! current_user_can( 'administrator' ) ) {
		return;
	}
	$base_content = "<p class=\"corner-head\">Buy ALL by once</p><p class=\"corner-text\">%content</p><div class=\"bf-marketing-action-container\"><a target='_blank' href=\"https://checkout.freemius.com/mode/dialog/bundle/2046/plan/4316?utm=buddyform-plugin\" class=\"bf-marketing-btn corner-btn-close\">%cta</a></div>";
	$content      = array( '%content' => 'Get the result that you expect to provide to your final customers earning all these Add-ons with the ThemeKraft Bundle.', '%cta' => 'Get the OFFER' );
	buddyforms_marketing_include_assets( $content, $base_content );
}

function buddyforms_marketing_form_list_coupon_for_free( $hook ) {
	if ( $hook !== 'edit.php' ) {
		return;
	}
	if ( ! current_user_can( 'administrator' ) ) {
		return;
	}
	$freeemius = buddyforms_core_fs();
	if ( empty( $freeemius ) ) {
		return;
	}
	$is_able_to_open_option = get_option( 'buddyforms_marketing_hide_for_ever_close' );
	$is_able_to_open        = ( ! empty( $is_able_to_open_option ) && ! empty( $is_able_to_open_option['buddyforms_marketing_form_list_coupon_for_free_close'] ) );
	$is_free                = $freeemius->is_free_plan();
	$is_trial               = $freeemius->is_trial();
	$current_screen         = get_current_screen();
	if ( ! empty( $current_screen ) && $current_screen->id === 'edit-buddyforms' && ( $is_free || $is_trial ) && empty( $is_able_to_open ) ) {
		$base_content = "<p class=\"corner-head\">30% off .:. 50% off</p><p class=\"corner-text\">%content</p><div class=\"bf-marketing-action-container\"><a target='_blank' href=\"https://themekraft.com/price-off-in-5-minutos?utm=buddyform-plugin\" class=\"bf-marketing-btn corner-btn-close\">%cta</a></div>";
		$content      = array( '%content' => 'UNLOCK the complete POWER of this tools to provide better solutions to your clients.', '%cta' => 'Let\'s do it' );
		buddyforms_marketing_include_assets( $content, $base_content, 'buddyforms_marketing_form_list_coupon_for_free_close' );
	}

}

function buddyforms_marketing_include_assets( $content, $base_content, $key = '' ) {
	wp_enqueue_style( 'buddyforms-marketing-popup', BUDDYFORMS_ASSETS . 'resources/corner-popup/css/corner-popup.min.css', array(), BUDDYFORMS_VERSION );
	wp_enqueue_script( 'buddyforms-marketing-popup', BUDDYFORMS_ASSETS . 'resources/corner-popup/js/corner-popup.min.js', array( 'jquery' ), BUDDYFORMS_VERSION );
	wp_enqueue_script( 'buddyforms-marketing-popup-handler', BUDDYFORMS_ASSETS . 'admin/js/admin-marketing.js', array( 'jquery' ), BUDDYFORMS_VERSION );
	wp_localize_script( 'buddyforms-marketing-popup-handler', 'buddyformsMarketingHandler', array(
		'content' => str_replace( array_keys( $content ), array_values( $content ), $base_content ),
		'key'     => $key,
	) );
}

function passive_feedback_trigger( $return ) {
	$current_screen = get_current_screen();

	if ( ! empty( $current_screen->id ) && strpos( $current_screen->id, 'buddyforms' ) !== false ) {
		wp_enqueue_style( 'buddyforms-passive-feedback-style', BUDDYFORMS_ASSETS . 'admin/css/passive-feedback.css', array(), BUDDYFORMS_VERSION );
		wp_enqueue_script( 'buddyforms-html2canvas-script', BUDDYFORMS_ASSETS . 'admin/js/html2canvas.min.js', array(), BUDDYFORMS_VERSION );
		wp_enqueue_script( 'buddyforms-passive-feedback-script', BUDDYFORMS_ASSETS . 'admin/js/passive-feedback.js', array(), BUDDYFORMS_VERSION );

		include_once BUDDYFORMS_ADMIN_VIEW . 'passive-feedback.php';
	}

	return $return;
}

function user_satisfaction_trigger() {
	global $buddyforms;

	try {
		$user_id = get_current_user_id();
		if ( empty( $user_id ) || ! is_user_logged_in() ) {
			return;
		}
		if ( ! current_user_can( 'administrator' ) ) {
			return;
		}

		if ( ! isset( $buddyforms ) || ! is_array( $buddyforms ) ) {
			return;
		}

		$is_able_to_open_option = get_option( 'buddyforms_marketing_hide_for_ever_close' );
		$is_able_to_open        = ( ! empty( $is_able_to_open_option ) && ! empty( $is_able_to_open_option['buddyforms_marketing_user_satisfaction_close'] ) );
		$is_already_sent        = get_option( 'buddyforms_user_satisfaction_sent' );

		$current_screen = get_current_screen();
		if ( ! empty( $current_screen ) && $current_screen->id === 'edit-buddyforms' && count( $buddyforms ) > 0 && empty( $is_able_to_open ) && empty( $is_already_sent ) ) {
			buddyforms_track( '$experiment_started', array( 'Experiment name' => 'User Satisfaction', 'Variant name' => 'v1', 'action' => 'satisfaction-show' ) );

			ob_start();
			include_once BUDDYFORMS_ADMIN_VIEW . 'user-satisfaction.php';
			$base_content = ob_get_clean();
			wp_enqueue_style( 'buddyforms-satisfaction-style', BUDDYFORMS_ASSETS . 'admin/css/user-satisfaction.css', array(), BUDDYFORMS_VERSION );
			wp_enqueue_style( 'buddyforms-marketing-popup', BUDDYFORMS_ASSETS . 'resources/corner-popup/css/corner-popup.min.css', array(), BUDDYFORMS_VERSION );
			wp_enqueue_script( 'buddyforms-marketing-popup', BUDDYFORMS_ASSETS . 'resources/corner-popup/js/corner-popup.min.js', array( 'jquery' ), BUDDYFORMS_VERSION );
			wp_enqueue_script( 'buddyforms-marketing-popup-handler', BUDDYFORMS_ASSETS . 'admin/js/admin-marketing.js', array( 'jquery' ), BUDDYFORMS_VERSION );
			wp_localize_script( 'buddyforms-marketing-popup-handler', 'buddyformsMarketingHandler', array(
				'content' => $base_content,
				'key'     => 'buddyforms_marketing_user_satisfaction_close',
			) );
		}
	} catch ( Exception $ex ) {

	}
}


function buddyforms_marketing_assets() {
	try {
		$user_id = get_current_user_id();
		if ( empty( $user_id ) || ! is_user_logged_in() ) {
			return;
		}
		if ( ! current_user_can( 'administrator' ) ) {
			return;
		}

		$base_content = "<p class=\"corner-head\">This is only for you</p><p class=\"corner-text\">%content</p><div class=\"bf-marketing-action-container\"><a href=\"#\" class=\"bf-marketing-btn corner-btn-close\">%no</a><a href=\"#\" class=\"bf-marketing-btn corner-btn-close\">%yes</a></div>";
		$content      = buddyforms_marketing_content_interest();
		$is_free      = false;
		$is_pro       = false;
		$is_trial     = false;

		$first_question = get_user_meta( $user_id, '_buddyforms_marketing_question1', true );
		$start_date     = get_user_meta( $user_id, '_buddyforms_marketing_start_date', true );

		$freeemius = buddyforms_core_fs();
		if ( empty( $freeemius ) ) {
			return;
		}

		$is_free     = $freeemius->is_free_plan();
		$is_pro      = $freeemius->is_premium();
		$is_trial    = $freeemius->is_trial();
		$upgrade_url = $freeemius->get_upgrade_url();
		$plugin      = $freeemius->get_plugin();

		if ( $freeemius->has_active_valid_license() ) {
			$license = $freeemius->_get_license();
			if ( ! empty( $license ) ) {
				$created_date = new DateTime( $license->created );
				//Add an interval to define when to show the modal
				//Create something generic to handle this generic process like condition meet and then do X
				//Like a class system where we can override generic behavior using heritage
			}
		}

		if ( $is_free ) {
			$content = buddyforms_marketing_content_pro_coupon();
		} elseif ( $is_trial ) {
			$content = buddyforms_marketing_content_pro_coupon();
		} elseif ( $is_pro ) {

		}

		wp_enqueue_style( 'buddyforms-marketing-popup', BUDDYFORMS_ASSETS . 'resources/corner-popup/css/corner-popup.min.css', array(), BUDDYFORMS_VERSION );
		wp_enqueue_script( 'buddyforms-marketing-popup', BUDDYFORMS_ASSETS . 'resources/corner-popup/js/corner-popup.min.js', array( 'jquery' ), BUDDYFORMS_VERSION );
		wp_enqueue_script( 'buddyforms-marketing-popup-handler', BUDDYFORMS_ASSETS . 'admin/js/admin-marketing.js', array( 'jquery' ), BUDDYFORMS_VERSION );
		wp_localize_script( 'buddyforms-marketing-popup-handler', 'buddyformsMarketingHandler', array(
			'content' => str_replace( array_keys( $content ), array_values( $content ), $base_content ),
		) );
	} catch ( Exception $ex ) {

	}
}

/**
 * Popup content asking to receive the offer
 */
function buddyforms_marketing_content_interest() {
	return array( '%content' => 'Are you interest in get a personal offer', '%no' => 'No Thanks', '%yes' => 'Yes' );
}

/**
 * Popup content to offer a discount coupon
 */
function buddyforms_marketing_content_pro_coupon() {
	return array( '%content' => 'Get your discount coupon', '%no' => 'No thanks', '%yes' => 'Yes please' );
}

/**
 * Popup content to upgrade from month to yearly
 */
function buddyforms_marketing_content_yearly_coupon() {
	return array( '%content' => 'Upgrade to yearly with a special copuon', '%no' => 'No thanks', '%yes' => 'Go for it' );
}

/**
 * Popup content to increase site quote
 */
function buddyforms_marketing_content_site_quote() {
	return array( '%content' => 'Be ready to install this amazing tool in more sites', '%no' => 'No thanks', '%yes' => 'Yes please' );
}
