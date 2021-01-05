<?php if (!defined('ABSPATH')) {
    die('No direct access.');
} ?>

<div id="metaslider-ui" class="flex p-6 mb-16">
    <div class="metaslider_col">
        <h2 class="font-light text-xl mb-2">MetaSlider <?php _e("Comparison Chart", 'ml-slider');?></h2>
        <table class="metaslider_feat_table shadow">
            <thead>
                <tr>
                    <th></th>
                    <th><img src="<?php echo METASLIDER_ADMIN_URL.'images/notices/metaslider_logo.png';?>" alt="<?php esc_attr_e('MetaSlider logo', 'ml-slider');?>" width="80" height="80">MetaSlider<br><span><?php _e('free', 'ml-slider');?></span></th>
                    <th><img src="<?php echo METASLIDER_ADMIN_URL.'images/notices/metaslider_logo.png';?>" alt="<?php esc_attr_e('MetaSlider logo', 'ml-slider');?>" width="80" height="80"><?php _e('Add-ons', 'ml-slider'); ?><br><span><?php _e('pro', 'ml-slider'); ?></span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td class="metaslider_installed_status"><?php _e('Installed', 'ml-slider');?></td>
                    <td class="metaslider_installed_status"><?php echo metaslider_optimize_url("https://www.metaslider.com/upgrade/", __('Upgrade now', 'ml-slider'));?></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><path d="M12.89 1.45l8 4A2 2 0 0 1 22 7.24v9.53a2 2 0 0 1-1.11 1.79l-8 4a2 2 0 0 1-1.79 0l-8-4a2 2 0 0 1-1.1-1.8V7.24a2 2 0 0 1 1.11-1.79l8-4a2 2 0 0 1 1.78 0z"/><polyline points="2.32 6.16 12 11 21.68 6.16"/><line x1="12" y1="22.76" x2="12" y2="11"/><line x1="7" y1="3.5" x2="17" y2="8.5"/></svg></i>
                        <h4><?php _e('Create unlimited slideshows', 'ml-slider');?></h4>
                        <p><?php _e('Create and manage as many slideshows as you need.', 'ml-slider');?></p></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></i>
                        <h4><?php _e('Multiple slideshow types', 'ml-slider');?></h4>
                        <p><?php _x('Including FlexSlider, Nivo Slider and we will soon be adding more.', '"FlexSlider" and "Nivo Slider" are plugin names.', 'ml-slider');?></p></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></i>
                        <h4><?php _e('Regular updates', 'ml-slider');?></h4>
                        <p><?php _ex('Our word to keep MetaSlider compatible with the latest versions of WordPress.', 'Keep the plugin name "MetaSlider" when possible', 'ml-slider');?></p></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-scissors"><circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><line x1="20" y1="4" x2="8.12" y2="15.88"/><line x1="14.47" y1="14.48" x2="20" y2="20"/><line x1="8.12" y1="8.12" x2="12" y2="12"/></svg></i>
                        <h4><?php _e('Intelligent image cropping', 'ml-slider'); ?></h4>
                        <p><?php _ex('Unique Smart Crop functionality ensures your slides are perfectly resized.', 'Keep the branding "Smart Crop" together when possible', 'ml-slider'); ?></p></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></i>
                        <h4><?php _e('Thumbnail navigation', 'ml-slider');?></h4>
                        <p><?php _e('Easily allow users to navigate your slideshows by thumbnails.', 'ml-slider');?></p></td>
                    <td><i class="dashicons dashicons-no-alt" aria-label="<?php esc_attr_e('No', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg></i>
                        <h4><?php _e('Add video slides', 'ml-slider');?></h4>
                        <p><?php _ex('Easily include responsive high definition YouTube and Vimeo videos.', '"YouTube" and "Vimeo" are brand names.', 'ml-slider');?></p></td>
                    <td><i class="dashicons dashicons-no-alt" aria-label="<?php esc_attr_e('No', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"/><path d="M16 12v1a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"/></svg></i>
                        <h4><?php _e('HTML overlay slides', 'ml-slider');?></h4>
                        <p><?php _e('Create completely customized HTML slides using the inline editor.', 'ml-slider');?></p></td>
                    <td><i class="dashicons dashicons-no-alt" aria-label="<?php esc_attr_e('No', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg></i>
                        <h4><?php _e('Add slide layers', 'ml-slider');?></h4>
                        <p><?php _e('Add layers to your slides with over 50 available transition effects.', 'ml-slider');?></p></td>
                    <td><i class="dashicons dashicons-no-alt" aria-label="<?php esc_attr_e('No', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3" y2="6"/><line x1="3" y1="12" x2="3" y2="12"/><line x1="3" y1="18" x2="3" y2="18"/></svg></i>
                        <h4><?php _e('Post feed slides', 'ml-slider');?></h4>
                        <p><?php _e('Easily build slides based on your WordPress posts.', 'ml-slider');?></p></td>
                    <td><i class="dashicons dashicons-no-alt" aria-label="<?php esc_attr_e('No', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" data-reactid="231"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></i>
                        <h4><?php _e('Schedule your slides', 'ml-slider');?></h4>
                        <p><?php _e('Add a start/end date to individual slides.', 'ml-slider');?></p></td>
                    <td><i class="dashicons dashicons-no-alt" aria-label="<?php esc_attr_e('No', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" data-reactid="501"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></i>
                        <h4><?php _e("Toggle your slide's visibility", 'ml-slider');?></h4>
                        <p><?php _e('Allows you to hide any slide, without having to delete them.', 'ml-slider');?></p></td>
                    <td><i class="dashicons dashicons-no-alt" aria-label="<?php esc_attr_e('No', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
                <tr>
                    <td><i class="metaslider-premium-image"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></i>
                        <h4><?php _e('Premium support', 'ml-slider');?></h4>
                        <p><?php _e('Have your specific queries addressed directly by our experts', 'ml-slider');?></p></td>
                    <td><i class="dashicons dashicons-no-alt" aria-label="<?php esc_attr_e('No', 'ml-slider');?>"></i></td>
                    <td><i class="dashicons dashicons-yes" aria-label="<?php esc_attr_e('Yes', 'ml-slider');?>"></i></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td class="metaslider_installed_status"><?php _e('Installed', 'ml-slider');?></td>
                    <td class="metaslider_installed_status"><?php echo metaslider_optimize_url("https://www.metaslider.com/upgrade/", __('Upgrade now', 'ml-slider'));?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
