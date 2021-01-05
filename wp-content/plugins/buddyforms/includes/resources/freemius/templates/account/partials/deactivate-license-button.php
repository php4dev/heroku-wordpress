<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } $slug = $VARS['slug']; $fs = $VARS['freemius']; $blog_id = ! empty( $VARS['blog_id'] ) && is_numeric( $VARS['blog_id'] ) ? $VARS['blog_id'] : ''; $install_id = ! empty( $VARS['install_id'] ) && FS_Site::is_valid_id( $VARS['install_id'] ) ? $VARS['install_id'] : ''; $action = 'deactivate_license'; ?>
<form action="<?php echo $fs->_get_admin_page_url( 'account' ) ?>" method="POST">
    <input type="hidden" name="fs_action" value="<?php echo $action ?>">
    <?php wp_nonce_field( trim("{$action}:{$blog_id}:{$install_id}", ':') ) ?>
    <input type="hidden" name="install_id" value="<?php echo $install_id ?>">
    <input type="hidden" name="blog_id" value="<?php echo $blog_id ?>">
    <button type="button" class="fs-deactivate-license button<?php echo ! empty( $VARS['class'] ) ? ' ' . $VARS['class'] : '' ?>"><?php fs_echo_inline( 'Deactivate License', 'deactivate-license', $slug ) ?></button>
</form>