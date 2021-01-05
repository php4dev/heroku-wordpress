<template>
	<div class="flex flex-col-reverse lg:flex-row">
		<div class="lg:w-2/3">
			<img
				:alt="__('CSS manager module', 'ml-silder')"
				:src="asset('images/css-manager.gif')"
				class="w-full block">
		</div>
		<div class="p-8 lg:w-1/3 lg:border-l-4 border-gray-lighter bg-gray-lightest">
			<h1 class="text-xl">{{ __('CSS Manager', 'ml-slider') }}</h1>
			<p>{{ __('Easily add custom CSS to your slideshows to customize and fit your theme perfectly.', 'ml-slider') }}</p>
			<ul>
				<li class="mb-1">
                    <svg class="inline text-orange w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Built-in text editor full of features.', 'ml-slider') }}
                </li>
				<li class="mb-1">
                    <svg class="inline text-orange w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Loads only on the front-end where needed.', 'ml-slider') }}
                </li>
				<li class="mb-1">
                    <svg class="inline text-orange w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Includes recipes to solve common scenarios.', 'ml-slider') }}
                </li>
			</ul>
			<a
				:href="hoplink"
				class="bg-blue-dark text-white no-underline my-4 inline-block rounded px-3 py-2"
				target="_blank">{{ __('Upgrade to pro now', 'ml-slider') }}</a>
			<p class="hidden lg:block">{{ __('Upgrading also includes:', 'ml-slider') }}</p>
			<ul class="hidden lg:block">
				<li class="mb-1">
                    <svg class="inline text-orange w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Layer, video and post type slides.', 'ml-slider') }}
                </li>
				<li class="mb-1">
                    <svg class="inline text-orange w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Slide scheduling - decide when slides appear.', 'ml-slider') }}
                </li>
				<li class="mb-1">
                    <svg class="inline text-orange w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Premium support - ask us anyting!', 'ml-slider') }}
                </li>
			</ul>
		</div>
	</div>
</template>

<script>
export default {
	filename: 'CSSManagerNotice',
	created() {
		this.$parent.classes = 'w-full max-w-6xl'
	},
	mounted() {
		// this.$parent.classes = '' - can add classes to the container as needed
		this.notifyInfo('metaslider/add-slide-css-manager-notice-opened', this.__('CSS Manager notice opened', 'ml-slider'))
	},
	beforeDestroy() {
		this.notifyInfo('metaslider/add-slide-css-manager-notice-closed', this.__('CSS Manager notice closed', 'ml-slider'))
	}
}
</script>
