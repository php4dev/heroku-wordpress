<template>
<form @keydown.enter.prevent="" autocomplete="off" class="bg-white shadow mb-4 relative" action="#" method="POST">
<div class="px-4 py-5 md:p-6">
	<h3 class="text-lg leading-6 m-0 font-medium text-gray-darkest">
		<slot name="header"/>
	</h3>
	<div class="mt-2 max-w-xl text-sm leading-5 text-gray-dark">
		<div class="m-0 pt-0">
			<slot name="description"/>
		</div>
	</div>
	<div class="mt-5 md:flex md:items-center">
	<div class="max-w-xs w-full">
		<label :for="name" class="sr-only">
			<slot name="input-label"/>
		</label>
		<div class="relative rounded-md shadow-sm">
			<input
				:id="name"
				class="form-input block w-full md:text-sm md:leading-5"
				v-on:input="$emit('input', $event.target.value)"
				:value="value"
				:placeholder="value" />
		</div>
	</div>
	<span class="mt-3 inline-flex rounded-md shadow-sm md:mt-0 md:ml-3 md:w-auto">
		<button @click="save" type="button" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-orange hover:bg-orange-darker active:bg-orange-darkest transition ease-in-out duration-150 md:w-auto md:text-sm md:leading-5">
		{{ __('Save', 'ml-slider') }}
		</button>
	</span>
	</div>
</div>
<transition name="settings-fade" mode="in-out">
	<loading-element v-if="$parent.$attrs.loading"/>
</transition>
</form>
</template>

<script>
import { default as LoadingElement } from './shimmers/_textSingleShimmer'
export default {
	props: ['value', 'name'],
	components: {
		'loading-element' : LoadingElement
	},
	data() {
		return {}
	},
	created() {},
	mounted() {},
	methods: {
		save() {
			this.$emit("click")
		}
	}
}
</script>
