<?php if (!defined('ABSPATH')) {
    die('No direct access.');
} ?>

<div
	id="metaslider-ui"
	class="metaslider metaslider-ui block min-w-0 p-0 bg-white relative"
	style="min-height:calc(100vh - 32px)">
<metaslider-toolbar inline-template>
<div id="ms-toolbar"
	class="flex-col bg-white h-16 shadow-sm sticky z-999">
	<div class="h-full px-6">
		<div class="flex items-center h-full -mx-4">
			<a href="<?php echo admin_url('admin.php?page=metaslider') ?>" class="flex items-center h-full py-2 px-4">
				<img style="height:2.3rem;width:2.3rem" width=40 height=40 class="mr-2 rtl:mr-0 rtl:ml-2" src="<?php echo METASLIDER_ADMIN_URL ?>images/metaslider_logo_large.png" alt="MetaSlider">
				<span class="text-2xl font-sans font-thin text-orange leading-none">
					<span class="font-normal">Meta</span>Slider
					<span class="block font-semibold text-sm font-mono text-gray tracking-tight">
						v<?php echo metaslider_pro_is_active() ?  metaslider_pro_version() . '<span class="ml-1">Premium</span>' : $this->version; ?>
					</span>
				</span>
			</a>
		</div>
	</div>
</div>
</metaslider-toolbar>
<div v-if="isIE11" class="justify-center bg-gray-lighter" :class="{'flex': isIE11, 'hidden': !isIE11}" style="display:none">
	<?php include METASLIDER_PATH."admin/views/pages/parts/ie-warning.php"; ?>
</div>
<div v-else>
<metaslider inline-template>
<metaslider-settings-page inline-template>
<div
	id="metaslider-settings-page"
	class="bg-gray-light border-b border-gray-light flex h-full inset-0 min-w-0 p-0 w-full"
    :class="{'absolute': !hasNotice}">
	<div class="flex md:flex-shrink-0">
		<div class="flex flex-col md:w-48 border-r border-gray-lightest pt-5 pb-4 bg-white">
			<div class="-mt-1 h-0 flex-1 flex flex-col overflow-y-auto">
				<nav class="flex-1 px-2 py-1 bg-white">
					<a
						href="#"
						@click.prevent="loadPage('settings')"
						@keydown.space.prevent="loadPage('settings')"
						@keyup.enter.prevent="loadPage('settings')"
						class="mt-1 group flex items-center justify-between px-2 py-2 text-sm leading-5 font-medium text-gray-darker rounded-md hover:text-gray-darkest hover:bg-gray-light focus:outline-none transition ease-in-out duration-150"
						:class="{'text-gray-darker bg-gray-light': 'settings' === component}">
						<span class="hidden md:flex"><?php _e('Settings', 'ml-slider'); ?></span>
                        <svg
                            class='opacity-0 md:mr-2 w-5 group-hover:text-gray-darkest group-focus:text-gray-darkest transition ease-in-out duration-150'
							:class="{'opacity-100': true, 'text-gray-darker': 'settings' === component, 'md:text-white': 'settings' !== component}"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
					</a>
                    <a
						href="#"
						@click.prevent="loadPage('helpcenter')"
						@keydown.space.prevent="loadPage('helpcenter')"
						@keyup.enter.prevent="loadPage('helpcenter')"
						class="mt-1 group flex items-center justify-between px-2 py-2 text-sm leading-5 font-medium text-gray-darker rounded-md hover:text-gray-darkest hover:bg-gray-light focus:outline-none transition ease-in-out duration-150"
						:class="{'text-gray-darker bg-gray-light': 'helpcenter' === component}">
						<span class="hidden md:flex"><?php _e('Help Center', 'ml-slider'); ?></span>
                        <svg
                            class='opacity-0 md:mr-2 w-5 group-hover:text-gray-darkest group-focus:text-gray-darkest transition ease-in-out duration-150'
							:class="{'opacity-100': true, 'text-gray-darker': 'helpcenter' === component, 'md:text-white': 'helpcenter' !== component}"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                        </svg>
					</a>
					<a
						href="#"
						@click.prevent="loadPage('import')"
						@keydown.space.prevent="loadPage('import')"
						@keyup.enter.prevent="loadPage('import')"
						class="mt-1 group flex items-center justify-between px-2 py-2 text-sm leading-5 font-medium text-gray-darker rounded-md hover:text-gray-darkest hover:bg-gray-light transition ease-in-out duration-150"
						:class="{'text-gray-darker bg-gray-light': 'import' === component}">
						<span class="hidden md:flex"><?php _e('Import', 'ml-slider'); ?></span>
                        <svg
                            class='opacity-0 md:mr-2 w-5 group-hover:text-gray-darkest group-focus:text-gray-darkest transition ease-in-out duration-150'
							:class="{'opacity-100': true, 'text-gray-darker': 'import' === component, 'md:text-white': 'import' !== component}"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
					</a>
					<a
						href="#"
						@click.prevent="loadPage('export')"
						@keydown.space.prevent="loadPage('export')"
						@keyup.enter.prevent="loadPage('export')"
						class="mt-1 group flex items-center justify-between px-2 py-2 text-sm leading-5 font-medium text-gray-darker rounded-md hover:text-gray-darkest hover:bg-gray-light transition ease-in-out duration-150"
						:class="{'text-gray-darker bg-gray-light': 'export' === component}">
						<span class="hidden md:flex"><?php _e('Export', 'ml-slider'); ?></span>
                        <svg
                            class='opacity-0 md:mr-2 w-5 group-hover:text-gray-darkest group-focus:text-gray-darkest transition ease-in-out duration-150'
							:class="{'opacity-100': true, 'text-gray-darker': 'export' === component, 'md:text-white': 'export' !== component}"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
					</a>
					<?php do_action('metaslider_settings_page_nav_items'); ?>
				</nav>
			</div>
		</div>
	</div>
	<div class="flex flex-col w-0 flex-1 overflow-hidden">
		<main class="flex-1 relative z-0 overflow-y-auto py-6 focus:outline-none" tabindex="0">
			<div class="max-w-7xl w-full px-4 md:px-6 md:px-8">
				<transition name="settings-fade" mode="out-in">
					<?php $slideshowCount = wp_count_posts('ml-slider'); ?>
					<component :needs-slideshows="<?php echo $slideshowCount->publish < 1 ? 'true' : 'false'; ?>" :is="$options.components[component]"></component>
				</transition>
			</div>
		</main>
	</div>
</div>
</metaslider-settings-page>
</metaslider>
</div>
</div>
