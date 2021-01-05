<?php if (!defined('ABSPATH')) {
    die('No direct access.');
}
/**
 * Using inline-template as there's a flicker before it loads
 */
?>
<metaslider-toolbar inline-template>
	<div id="ms-toolbar"
		class="flex-col items-center bg-white h-16 shadow-sm lg:sticky z-999"
		:class="{'shadow-md':scrolling, 'flex': !isIE11}">
		<div class="container h-full px-6">
			<div class="flex items-center h-full -mx-4">
				<a href="<?php echo admin_url('admin.php?page=metaslider') ?>" class="flex items-center h-full py-2 px-4">
					<img style="height:2.3rem;width:2.3rem" width=40 height=40 class="mr-2 rtl:mr-0 rtl:ml-2" src="<?php echo METASLIDER_ADMIN_URL ?>images/metaslider_logo_large.png" alt="MetaSlider">
					<span class="text-2xl font-sans font-thin text-orange leading-none">
						<span class="font-normal">Meta</span>Slider
						<span class="block font-semibold text-sm font-mono text-gray tracking-tight">
							<?php echo metaslider_pro_is_active() ? metaslider_pro_version() . '<span class="ml-1">' . __('Premium', 'ml-slider') . '</span>' : $this->version; ?>
						</span>
					</span>
				</a>
				<?php if ($this->slider) : ?>
				<div class="flex-grow h-full px-4">
					<div class="-mx-4 items-center flex h-full">
						<div class="flex items-center flex-grow px-4 h-full">
							<?php $max_drawer = apply_filters('metaslider_max_slideshows_in_drawer', 25); ?>
							<metaslider-switcher max="<?php echo $max_drawer; ?>"></metaslider-switcher>
						</div>
						<div class="px-4 h-full">
							<div class="flex justify-end items-center h-full text-gray">

								<button @click.prevent="addSlide()" id="add-new-slide" class='ms-toolbar-button tipsy-tooltip-bottom-toolbar' title='<?php _e("Add a new slide", "ml-slider") ?>'>
                                    <svg class="w-6 p-0.5 text-gray-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
									<span class="text-sm text-gray-darkest"><?php _e("Add Slide", "ml-slider") ?></span>
								</button>

								<button
                                    @click.prevent="preview()"
                                    id="preview-slideshow"
                                    title="<?php echo htmlentities(__('Save & open preview', 'ml-slider')); ?><br><?php echo htmlentities(_x('(alt + p)', 'This is a keyboard shortcut.', 'ml-slider')); ?>" class="ms-toolbar-button"
                                    :disabled="locked"
                                    :class="{'disabled': locked}">
                                    <svg
                                        :class="{'text-gray-dark': !locked}"
                                        class="w-6 p-0.5"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
									<span class="text-sm"><?php _e('Preview', 'ml-slider'); ?></span>
								</button>

                                <?php /* Removed for now
                                <span class="border-l h-8 mx-2"></span>

                                <a class="ms-toolbar-button tipsy-tooltip-bottom-toolbar" title="<?php _e('Read the documentation', 'ml-slider'); ?>" href="https://www.metaslider.com/documentation/" target="_blank">
                                    <svg class="w-6 p-0.5 text-gray-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span class="text-sm text-gray-darkest"><?php _e('Docs', 'ml-slider'); ?></span>
                                </a>
                                */?>

								<span class="border-l h-8 mx-2"></span>

								<a class="ms-toolbar-button tipsy-tooltip-bottom-toolbar" title="<?php _e('Add a new slideshow', 'ml-slider'); ?>" href="<?php echo wp_nonce_url(admin_url("admin-post.php?action=metaslider_create_slider"), "metaslider_create_slider"); ?>">
                                <svg class="w-6 p-0.5 text-gray-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
									<span class="text-sm text-gray-darkest"><?php _e('New', 'ml-slider'); ?></span>
								</a>

								<button
                                    @click.prevent="duplicate()"
                                    title="<?php _e('Duplicate this slideshow', 'ml-slider'); ?>"
                                    class="ms-toolbar-button tipsy-tooltip-bottom-toolbar"
                                    :disabled="duplicating"
                                    :class="{'disabled transition-none': duplicating}">
                                <svg
                                    :class="{'text-gray-dark': !duplicating}"
                                    class="w-6 p-0.5"
                                    mlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
									<span
                                        :class="{'text-gray-darkest': !duplicating, 'transition-none': duplicating}"
                                        class="text-sm"><?php _e('Duplicate', 'ml-slider'); ?></span>
								</button>

								<!-- Pro only add css feature -->
								<?php ob_start(); ?>
								<button @click.prevent="showCSSManagerNotice()" title="<?php esc_attr_e('Add custom CSS', 'ml-slider'); ?><br> - <?php esc_attr_e('press to learn more', 'ml-slider'); ?> -" class="ms-toolbar-button tipsy-tooltip-bottom-toolbar" :class="{'disabled':true}">
                                <svg class="w-6 p-0.5 text-gray-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
									<span class="text-sm text-gray-darkest"><?php _e('Add CSS', 'ml-slider'); ?></span>
								</button>
								<?php echo apply_filters('metaslider_add_css_module', ob_get_clean()); ?>

								<span class="border-l h-8 mx-2"></span>

								<!-- TODO: Create a vue component -->
								<!-- TODO: check what triggers id="ms-save" -->
								<button
                                    @click.prevent="save()"
                                    title="<?php _e('Save slideshow', 'ml-slider'); ?>"
                                    id="ms-save"
                                    class="ms-toolbar-button"
                                    :disabled="locked"
                                    :class="{'disabled': locked}">
                                    <svg
                                        v-if="locked"
                                        :class="{'opacity-100': true}"
                                        class="opacity-0 w-6 p-0.5 ms-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <svg v-else class="w-6 p-0.5 text-gray-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                    </svg>
									<span :class="{'text-gray-darkest': !locked}" class="text-sm"><?php _e('Save', 'ml-slider'); ?></span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</metaslider-toolbar>
<?php
if ($this->slider) {
    $nav_opened = filter_var(get_user_option('metaslider_nav_drawer_opened'), FILTER_VALIDATE_BOOLEAN); ?>
	<metaslider-drawer :open="<?php echo $nav_opened ? 'true' : 'false' ?>"></metaslider-drawer>
<?php
}
