<?php
/*
 +=====================================================================+
 |      __        ______ _____                                         |
 |      \ \      / /  _ \_   _|__ _ __ _ __ ___                        |
 |       \ \ /\ / /| |_) || |/ _ \ '__| '_ ` _ \                       |
 |        \ V  V / |  __/ | |  __/ |  | | | | | |                      |
 |         \_/\_/  |_|    |_|\___|_|  |_| |_| |_|                      |
 |                                                                     |
 | (c) Jerome Bruandet ~ https://nintechnet.com/                       |
 +=====================================================================+
*/

if (! defined('WP_UNINSTALL_PLUGIN') ) {
	exit( "Not allowed" );
}

if ( is_multisite() ) {
	delete_site_option( 'wpterm_options' );
}
delete_option( 'wpterm_options' );
if ( isset( $_SESSION['wptermpwd'] ) ) {
	unset( $_SESSION['wptermpwd'] );
}

/* ================================================================== */
// EOF
