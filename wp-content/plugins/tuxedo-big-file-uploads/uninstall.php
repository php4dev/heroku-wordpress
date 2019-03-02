<?php
/**
 * TuxedoBigFileUploads Uninstall
 *
 * Uninstalling TuxedoBigFileUploads deletes all options.
 *
 * @package TuxedoBigFileUploads
 * @since 1.0.0
 */

/** Check if we are uninstalling. */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/** Delete options. */
delete_option( 'tuxbfu_max_upload_size' );
delete_option( 'tuxbfu_chunk_size' );
delete_option( 'tuxbfu_max_retries' );