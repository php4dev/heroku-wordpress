<template>
<form @keydown.enter.prevent="" autocomplete="off" class="bg-white shadow relative" :class="[containerMargin]" action="#" method="POST">
	<div class="px-4 py-5 sm:p-6">
		<h3 class="text-lg m-0 leading-6 font-medium text-gray-darkest">
		<slot name="header"/>
		</h3>
		<div class="mt-2 sm:flex sm:items-start sm:justify-between">
			<div class="max-w-xl text-sm leading-5 text-gray-500">
				<div class="m-0 p-0">
					<slot name="description"/>
				</div>
			</div>
			<div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
				<span class="inline-flex rounded-md shadow-sm">
					<label
						:for="name"
						class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md transition ease-in-out duration-150 md:w-auto md:text-sm md:leading-5"
						:class="{
							'bg-gray-darker text-gray-light': disabled,
							'bg-orange hover:bg-orange-darker active:bg-orange-darkest text-white': !disabled
						}"
						tabindex="0"
						:disabled="disabled">
						<slot name="button"/>
					</label>
					<input :id="name" :accept="accept" :disabled="disabled" type="file" class="hidden" @change="loadFile"/>
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
import { default as LoadingElement } from './shimmers/_actionButtonShimmer'
export default {
	props: {
		name: {
			type: String,
			default: ''
		},
		value: {
			type: Boolean,
			default: true
		},
		disabled: {
			type: Boolean,
			default: false
		},
		accept: {
			type: String,
			default: ''
		},
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
		loadFile(event) {
			if (this.disabled) return
			if (!event.target.files[0]) return
			const file = new FileReader()
			file.onload = e => this.$emit('loaded', e.target.result)
			file.readAsText(event.target.files[0])
			event.target.value = ''
		}
	}
}
</script>
