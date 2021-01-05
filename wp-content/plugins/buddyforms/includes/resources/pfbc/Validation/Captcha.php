<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Validation_Captcha
 */
class Validation_Captcha extends Validation {
	/**
	 * @var string
	 */
	protected $message = "Error: The reCATPCHA response provided was incorrect.  Please try again.";
	/**
	 * @var string Represent the Secret from reCaptcha
	 */
	protected $privateKey;

	/**
	 * Validation_Captcha constructor.
	 *
	 * @param string $privateKey
	 * @param string $message
	 * @param $field_options
	 */
	public function __construct( $privateKey, $message = "", $field_options = array() ) {
		$this->privateKey = $privateKey;
		if ( ! empty( $message ) ) {
			$this->message = $message;
		} else {
			$this->message = __( "Error: The reCATPCHA response provided was incorrect.  Please try again.", 'buddyforms' );
		}
		parent::__construct( $message, $field_options );
	}

	/**
	 * @param $value
	 *
	 * @return bool
	 */
	public function isValid( $value, $element ) {
		$version = $this->getOption( 'version' );
		if ( empty( $version ) ) {
			$version = 'v2';
		}
		if ( $version === 'v2' ) {
			$captcha = sanitize_text_field( $_POST["g-recaptcha-response"] );
			$resp    = $this->validate_google_captcha( $captcha, $this->privateKey );
			$result  = ! empty( $resp['success'] ) && boolval( $resp['success'] ) === true;
		} else {
			$score  = $this->getOption( 'captcha_v3_score' );
			$action = $this->getOption( 'captcha_v3_action' );
			if ( empty( $score ) ) {
				$score = 0.5;
			}
			if ( empty( $action ) ) {
				$action = 'form';
			}
			$action = preg_replace( "/[^a-zA-Z0-9]+/", '', $action );
			$captcha    = sanitize_text_field( $_POST["bf-cpchtk"] );
			$recaptcha  = new \tk\ReCaptcha\ReCaptcha( $this->privateKey );
			$resp       = $recaptcha->setExpectedHostname( $_SERVER['HTTP_HOST'] )
			                        ->setExpectedAction( $action )
			                        ->setScoreThreshold( floatval( $score ) )
			                        ->verify( $captcha, $_SERVER['REMOTE_ADDR'] );
			$is_success = $resp->isSuccess();
			if ( ! $is_success ) {
				$errors = $resp->getErrorCodes();//Todo write to the logs
				if ( ! empty( $errors ) ) {
					BuddyForms::error_log( join( ', ', $errors ) );
				}
			}
			$result = ! empty( $is_success ) && boolval( $is_success ) === true;
		}


		return apply_filters( 'buddyforms_element_captcha_validation', $result, $element );
	}

	public function validate_google_captcha( $captcha, $secret ) {
		return json_decode( file_get_contents( "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR'] ), true );
	}
}
