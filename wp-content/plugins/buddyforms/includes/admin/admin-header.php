<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

//Leaven empty tag to let automation add the path disclosure line
?>
<style>
    .wrap .wp-heading-inline + .page-title-action {
        display: none;
    }

    @media screen and (max-width: 790px) {
        #buddyforms_version {
            display: none;
        }
    }
</style>

<h1 class="wp-heading-inline" style="line-height: 58px; margin-top: 20px; font-size: 30px; width: 100%;">
    <div id="buddyforms-adminhead-wizard" style="font-size: 52px; margin-top: -5px; float: left; margin-right: 15px;"
         class="tk-icon-buddyforms"></div>
    BuddyForms
    <a href="post-new.php?post_type=buddyforms" class="page-title-action"><?php _e( 'Add New', 'buddyforms' ); ?></a>
    <a class="page-title-action" id="btn-open" href="http://docs.buddyforms.com"
       target="_blank"><?php _e( 'Documentation', 'buddyforms' ); ?></a>
    <a href="edit.php?post_type=buddyforms&amp;page=buddyforms-contact" class="page-title-action"
       id="btn-open"><?php _e( 'Contact Us', 'buddyforms' ); ?></a>
    <small id="buddyforms_version"
           style="line-height: 1; margin-top: -10px; color: #888; font-size: 13px; padding-top: 30px; float:right;">
		<?php buddyforms_version_type() ?> Version <?php echo BUDDYFORMS_VERSION ?>
    </small>
</h1>
