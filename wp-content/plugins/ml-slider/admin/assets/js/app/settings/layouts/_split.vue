<template>
<div class="mt-6 md:mt-0">
	<div class="md:grid md:grid-cols-3 md:gap-6">
		<div class="md:col-span-1">
			<div class="px-0">
				<h3 class="text-lg font-medium m-0 leading-6 text-gray-darkest">
					<slot name='header'/>
				</h3>
				<p class="m-0 mt-1 text-sm leading-5 text-gray-darker">
					<slot name='description'/>
				</p>
				<p v-if="this.$slots.description2" class="m-0 font-bold mt-2 text-sm leading-5 text-gray-darker">
					<slot name='description2'/>
				</p>
				<p v-if="this.$slots.description3" class="m-0 italic mt-2 text-sm leading-5 text-gray-darker">
					<slot name='description3'/>
				</p>
			</div>
		</div>
		<div class="mt-5 md:mt-0 md:col-span-2">
			<slot name="fields"/>
		</div>
	</div>
</div>
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
