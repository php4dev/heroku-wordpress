<template>
	<div class="max-w-4xl mb-6">
		<div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
			<div class="flex">
				<div class="flex-shrink-0">
					<svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
					<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
					</svg>
				</div>
			<div class="ml-3">
				<p class="text-sm p-0 m-0 leading-5 text-yellow-700">
					<slot name="description"/>
					<a v-if="link" :href="link" :target="newTab ? '_blank' : '_self'" class="font-medium underline text-yellow-700 hover:text-yellow-600 transition ease-in-out duration-150">
						<slot name="link-text"/>
					</a>
				</p>
			</div>
		</div>
	</div>
</div>
</template>

<script>
export default {
	props: {
		link: {
			type: String,
			default: ''
		},
		newTab: {
			type: Boolean,
			default: false
		},
	},
	components: {},
	data() {
		return {}
	},
	created() {},
	mounted() {},
	methods: {}
}
</script>
