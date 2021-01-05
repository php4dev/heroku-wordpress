<template>
	<div class="row caption">
		<div class="flex justify-between">
			<label class="mr-2">{{ __("Caption", "ml-slider") }}</label>
			<div
				:aria-labelledby="'caption_source_' + $parent.id"
				role="radiogroup"
				class="flex mb-1 -mx-1">
				<div
					v-for="(caption, source) in sources"
					:key="source"
					class="whitespace-no-wrap px-1">
					<input
						:id="source + '-' + $parent.id"
						:value="source"
						:name="'attachment[' + $parent.id + '][caption_source]'"
						v-model="selectedSource"
						class="m-0"
						type="radio"
						@click="maybeFocusTextarea">
					<label
						:for="source + '-' + $parent.id"
						:title="language[source]"
						style="max-width:150px"
						class="m-0 truncate">
						{{ language[source] }}
					</label>
				</div>
			</div>
		</div>
		<div
			v-if="selectedSource !== 'override'"
			:title="__('Automatically updates directly from the WP Media Library', 'ml-slider')"
			class="default tipsy-tooltip-top">
			<span
				v-if="!sources[selectedSource].length"
				class="no-content">{{ __('No default was found', 'ml-slider') }}</span>
			<span
				v-else
				v-text="sources[selectedSource]"/>
		</div>
		<textarea
			v-if="selectedSource === 'override'"
			v-model="sources['override']"
			:title="__('You may use HTML here', 'ml-slider')"
			:id="'caption_override_' + $parent.id"
			:name="'attachment[' + $parent.id + '][post_excerpt]'"
			class="tipsy-tooltip-top"
			style="margin:0"/>
	</div>
</template>

<script>
import { EventManager } from '../../utils'
export default {
	props: {
		imageCaption: {
			type: [String],
			default: ''
		},
		imageDescription: {
			type: [String],
			default: ''
		},
		override: {
			type: [String],
			default: ''
		},
		captionSource: {
			type: [String],
			default: 'image-caption'
		}
	},
	data() {
		return {
			sources: {
				'image-caption': this.imageCaption,
				'image-description': this.imageDescription,
				'override': this.override
			},
			language: {},
			selectedSource: ''
		}
	},
	created() {
		this.selectedSource = this.captionSource ? this.captionSource : 'image-caption'
	},
	mounted() {
		// When an image is updated, check that the data is fresh (via Vue or jQuery)
		EventManager.$on('metaslider/image-meta-updated', (slides, metadata) => this.updateMetadata(slides, metadata))
		window.jQuery(window).on('metaslider/image-meta-updated', (event, slides, metadata) => this.updateMetadata(slides, metadata))

		// Set specific wording for the options
		this.language = {
			'image-caption': this.__('Media library caption', 'ml-slider'),
			'image-description': this.__('Media library description', 'ml-slider'),
			'override': this.__('Enter manually', 'ml-slider')
		}
	},
	methods: {
		maybeFocusTextarea(event) {
			// Happens on click only
			'override' === event.target.defaultValue &&
				setTimeout(() => document.getElementById('caption_override_' + this.$parent.id).focus(), 300)
		},
		updateMetadata(slides, metadata) {
			console.log(slides)
			if (slides.includes(this.$parent.id)) {
				this.sources['image-caption'] = metadata.caption
				this.sources['image-description'] = metadata.description
			}
		}
	}
}
</script>
