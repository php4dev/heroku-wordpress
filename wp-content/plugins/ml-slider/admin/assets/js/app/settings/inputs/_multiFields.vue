<template>
<form @keydown.enter.prevent="" autocomplete="off" class="bg-white shadow md:rounded-lg mb-4" action="#" method="POST">
	<div class="shadow overflow-hidden md:rounded-md">
		<div class="px-4 py-5 bg-white md:p-6">
			<div class="grid grid-cols-6 gap-6">
				<slot name="inputfields"/>
			</div>
		</div>
		<div class="px-4 py-3 bg-gray-lighter border-t border-gray-light text-right md:px-6">
			<button class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-orange hover:bg-orange-darker active:bg-orange-darkest transition ease-in-out duration-150 md:w-auto md:text-sm md:leading-5">
				{{ __('Save', 'ml-slider') }}
			</button>
		</div>
	</div>
</form>
</template>

<script>
export default {
	props: {},
	data() {
		return {}
	},
	created() {},
	mounted() {},
	methods: {}
}
</script>
