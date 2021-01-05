<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="fs-secure-notice">
	<i class="dashicons dashicons-lock"></i>
	<span><?php
 if ( ! empty( $VARS['message'] ) ) { echo esc_html( $VARS['message'] ); } else { $fs = freemius( $VARS['id'] ); echo esc_html( sprintf( $fs->get_text_inline( 'Secure HTTPS %s page, running from an external domain', 'secure-x-page-header' ), $VARS['page'] ) ) . ' - ' . sprintf( '<a class="fs-security-proof" href="%s" target="_blank" rel="noopener">%s</a>', 'https://www.mcafeesecure.com/verify?host=' . WP_FS__ROOT_DOMAIN_PRODUCTION, 'Freemius Inc. [US]' ); } ?></span>
</div>