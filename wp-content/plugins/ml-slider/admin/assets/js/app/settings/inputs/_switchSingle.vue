<template>
<form @keydown.enter.prevent="" autocomplete="off" class="bg-white shadow relative" :class="[containerMargin]" action="#" method="POST">
<div class="px-4 py-5 sm:p-6">
	<h3 class="text-lg m-0 leading-6 font-medium text-gray-darkest" id="renew-headline">
		<slot name="header"/>
	</h3>
	<p v-if="this.$slots.subheader" class="m-0 mb-2 text-gray-darker text-xs whitespace-normal">
		<slot name="subheader"/>
	</p>
	<div class="mt-2 sm:flex sm:items-start sm:justify-between">
		<div class="max-w-xl text-sm leading-5 text-gray-dark overflow-hidden">
			<div id="renew-description" class="m-0 p-0">
				<slot name="description"/>
			</div>
		</div>
		<div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
			<span
				:class="{ 'bg-gray-light': !value, 'bg-orange': value }"
				:aria-checked="value.toString()"
				class="relative inline-block flex-no-shrink h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-50 focus:outline-none focus:shadow-outline"
				role="checkbox"
				tabindex="0"
				@click="toggle"
				@keydown.space.prevent="toggle">
				<span
					aria-hidden="true"
					:class="{ 'translate-x-5': value, 'translate-x-0': !value }"
					class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-150"/>
			</span>
		</div>
	</div>
</div>
<transition name="settings-fade" mode="in-out">
	<loading-element v-if="$parent.$attrs.loading"/>
</transition>
</form>
</template>

<script>
import { default as LoadingElement } from './shimmers/_switchShimmer'
export default {
	props: {
		value: {},
		containerMargin: {
			type: String,
			default: 'mb-4'
		}
	},
	components: {
		'loading-element' : LoadingElement
	},
	data() {
		return {}
	},
	created() {},
	mounted() {},
	methods: {
		toggle() {
			const value = !this.value
			this.$emit("input", value)
			this.$emit("change", value)
		}
	}
}
</script>
