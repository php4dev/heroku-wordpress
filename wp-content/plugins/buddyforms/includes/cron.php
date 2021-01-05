<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


function buddyforms_passive_feedback_attachment_delete( $attach_id ) {
	error_log( 'si entro' . $attach_id );
	wp_delete_attachment( $attach_id, true );
}

add_action( 'buddyforms_passive_feedback_attachment_delete', 'buddyforms_passive_feedback_attachment_delete', 10, 1 );
