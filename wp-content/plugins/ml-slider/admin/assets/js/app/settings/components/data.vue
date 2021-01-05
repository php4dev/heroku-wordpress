<template>
<div class="bg-white shadow mb-4 relative">
	<div class="px-4 py-5 sm:p-6">
		<div class="flex items-start justify-between">
            <h3 class="text-lg m-0 leading-6 font-medium text-gray-900">
                <slot name="header"/>
            </h3>
            <button v-if="canCopy" :aria-label="__('Copy all', 'ml-slider')" :title="__('Copy all', 'ml-slider')" class="w-5 text-blue">
                <svg class="w-5 inline mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                </svg>
            </button>
        </div>
		<div v-if="this.$slots.description" class="mt-2 text-sm leading-5 text-gray-500">
			<p>
				<slot name="description"/>
			</p>
            <!-- Data will go here -->
            <slot name="data-extra"/>
		</div>
	</div>
    <transition name="settings-fade" mode="in-out">
        <loading-element v-if="$parent.$attrs.loading"/>
    </transition>
</div>
</template>

<script>
import { default as LoadingElement } from '../inputs/shimmers/_bigBoxShimmer'
export default {
    props: {
        data: {
			type: Object,
			default: {}
		},
        canCopy: {
			type: Boolean,
			default: true
		},
    },
    components: {
		'loading-element' : LoadingElement
	},
	data() {
		return {}
	},
	created() {},
	mounted() {},
	methods: {}
}
</script>
