<template>
<div class="bg-white shadow">
	<div class="px-4 py-5 sm:p-6 flex justify-between items-start">
		<div>
            <h3 class="text-lg m-0 leading-6 font-medium text-gray-900">
                <slot name="header"/>
            </h3>
            <div v-if="this.$slots.description" class="mt-2 max-w-xl text-sm leading-5 text-gray-500">
                <p>
                    <slot name="description"/>
                </p>
            </div>
        </div>
		<div v-if="link" class="mt-0 text-sm leading-5">
			<a :href="link" :target="newTab ? '_blank' : '_self'" class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
				<slot name="link-text"/>
			</a>
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
