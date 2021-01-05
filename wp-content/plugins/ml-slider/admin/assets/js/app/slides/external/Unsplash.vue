<template>
	<media-container>
		<!-- TODO: add loading -->

		<template slot="media-list">
			<li
				v-for="photo in photos"
				:aria-label="sprintf(__('Photo by %s', 'ml-slider'), photo.user.name)"
				:key="photo.id"
				:class="{
					selected: selected === photo,
					details: selected === photo
				}"
				class="attachment save-ready"
				tabindex="0"
				role="checkbox"
				aria-checked="false"
				@click="selected = selected === photo ? {} : photo">
				<div
					:class="photo.orientation"
					class="attachment-preview js--select-attachment type-image subtype-jpeg">
					<div class="thumbnail">
						<div class="centered">
							<img
								:alt="sprintf(__('Photo by %s', 'ml-slider'), photo.user.name)"
								:src="photo.urls.thumb"
								draggable="false">
						</div>
					</div>
				</div>
				<button
					type="button"
					class="check"
					tabindex="-1">
					<span class="media-modal-icon"/>
					<span class="screen-reader-text">{{ __('Deselect', 'ml-slider') }}</span>
				</button>
			</li>
		</template>

		<template slot="sidebar">
			<div v-if="selected.id">
				<div
					tabindex="0"
					class="attachment-details">
					<h2>{{ __('Attachment Details', 'ml-slider') }}</h2>
					<div class="attachment-info">
						<div class="thumbnail thumbnail-image">
							<img
								:src="selected.urls.small"
								:alt="fileName"
								draggable="false">
						</div>
						<div class="details">
							<div class="filename">{{ fileName }}</div>
							<div class="dimensions">
								{{ sprintf(
									_x('%s by %s pixels', '1000 by 1000 pixels', 'ml-slider'),
									selected.width,
									selected.height
								) }}
							</div>
							<a
								:href="selected.links.html"
								target="_blank">{{ __('view original', 'ml-slider') }}</a>
						</div>
					</div>
					<div class="ms-api-user">
						<img
							class="rtl:mr-0 rtl:ml-4"
							:src="selected.user.profile_image.medium">
						<div class="ms-profile-data">
							<div class="ms-profile-details">
								<h3>{{ selected.user.name }}</h3>
								<p
									class="ms-user-location"
									v-html="selected.user.location"/>
								<div
									v-if="selected.user.bio"
									class="ms-user-bio"
									v-html="selected.user.bio"/>
							</div>
							<ul class="ms-profile-meta">
								<li v-if="selected.user.username">
									<a
										:href="selected.user.links.html"
										:title="selected.user.links.html"
										target="_blank"
										class="ms-profile-username">{{ __('Profile', 'ml-slider') }}
									</a>
								</li>

								<li
									v-if="selected.user.portfolio_url"
									class="ms-user-portfolio-url">
									<a
										:href="selected.user.portfolio_url"
										:title="selected.user.portfolio_url"
										target="_blank">{{ __('Portfolio', 'ml-slider') }}
									</a>
								</li>
							</ul>
						</div>
					</div>
					<label class="setting">
						<span class="name">{{ __('Title', 'ml-slider') }}</span>
						<input
							v-model="upload.title"
							type="text">
					</label>
					<label class="setting">
						<span class="name">{{ __('Caption', 'ml-slider') }}</span>
						<textarea v-model="upload.caption"/>
					</label>
					<label class="setting">
						<span class="name">{{ __('Alt Text', 'ml-slider') }}</span>
						<input
							v-model="upload.alt"
							type="text">
					</label>
					<label class="setting">
						<span class="name">{{ __('Description', 'ml-slider') }}</span>
						<textarea v-model="upload.description"/>
					</label>
					<label class="quality setting">
						<span class="name">{{ __('Quality', 'ml-slider') }}</span>
						<select
							v-model="upload.quality"
							class="alignment">
							<option
								v-for="quality in qualityOptions"
								:key="quality"
								:value="quality">
								{{ quality.charAt(0).toUpperCase() + quality.slice(1) }}
							</option>
						</select>
					</label>
				</div>
			</div>
		</template>

		<template slot="copyright">
			<p>
				{{ __('All photos published on Unsplash can be used for free.', 'ml-slider') }} <a
					target="_blank"
					href="https://unsplash.com/license">{{ __('view license', 'ml-slider') }}</a>
			</p>
		</template>
	</media-container>
</template>

<script>
import { Unsplash } from '../../api'
import MediaContainer from './MediaContainer.vue'

export default {
	components: {
		MediaContainer
	},
	props: {},
	data() {
		return {
			errorMessage: '',
			canLoadMore: false,
			loadingFresh: true,
			loadingMore: true,
			searchTerm: '',
			page: 1,
			photos: [],
			selected: { id: null },
			filters: {},
			mediaButton: {},
			qualityOptions: ['raw', 'full', 'regular'],
			upload: {
				title: '',
				caption: '',
				alt: '',
				description: '',
				quality: 'full' // TODO: maybe we persist this in file data?
			}
		}
	},
	computed: {
		fileName() {
			// Not sure if we can get the real file name without a second call on the photo id. likely not important
			return this.selected.id
				? this.selected.user.name.replace(' ', '-').toLowerCase() + '-' + this.selected.id + '-unsplash.jpg'
				: ''
		}
	},
	watch: {
		selected(photo) {
			this.upload.caption = photo.user ? this.sprintf(
				this._x('Photo by %s on %s', 'Photo by NAME on Unsplash', 'ml-slider'),
				'<a href=\'' + photo.user.links.html + '\'>' + photo.user.name + '</a>',
				'<a href=\'https://unsplash.com/\'>Unsplash</a>'
			) : ''
		}
	},
	mounted() {
		this.notifyInfo('metaslider/unsplash-tab-opened', this.__('Opening Unsplash tab...', 'ml-slider'))
		this.loadFreshImages()
	},
	destroyed() {
		this.notifyInfo('metaslider/unsplash-tab-closed', this.__('Unsplash tab closed', 'ml-slider'))
	},
	methods: {
		async getImages() {
			this.errorMessage = ''
			const { data } = await Unsplash.photos(this.page, this.searchTerm)

			// If no photos were found, let them know
			if (!data.data.length) throw this.__('No photots found.', 'ml-slider')

			// Use this to avoid errors when duplicate images are being sent back
			data.data.forEach(photo => {
				this.photos.some(existingPhoto => {
					return existingPhoto.id === photo.id
				}) || this.photos.push(photo)
			})
			// this.photos.push(...data.data)
		},
		loadFreshImages() {
			this.readyToLoad(false)
			this.page = 1
			this.photos = []
			this.selected = { id: null }
			this.getImages()
				.then(() => this.readyToLoad())
				.catch(error => {
					this.errorMessage = error
					this.loadingFresh = false
					this.throwError(error)
				})
		},
		async loadMore() {
			this.page++
			this.loadingMore = true

			// The UX feels clunky if the load is immediate
			await new Promise(resolve => setTimeout(resolve, 1000))
			this.getImages()
				.then(() => this.readyToLoad())
				.catch(() => {
					// Most likely there are no more images
					this.canLoadMore = false
				})
		},
		download() {
			return Unsplash.download(this.selected.urls[this.upload.quality], this.selected.id)
		},
		fetchFilters() {
			// TODO: Call to get available filters (pro override with more?)
			// Not sure how to do this. Maybe we can offer 10 common words?
			// or grab the user's categories?
			this.filters = {}
		},
		searchByTerm() {
			this.loadFreshImages()
		},
		readyToLoad(status = true) {
			this.canLoadMore = status
			this.loadingMore = !status
			this.loadingFresh = !status
		}
	}
}
</script>

<style lang="scss">
.ms-api-user {
	clear: both;
	border-bottom: 1px solid #ddd;
	display: flex;
	justify-content: flex-start;
	margin-bottom: 1rem;
	padding-bottom: 1rem;
	img {
		border-radius: 50%;
		width: 64px;
		height: 64px;
		min-width: 64px;
		margin-right: 1rem;
	}
	h3 {
		margin: 0;
		line-height: 1.1;
	}
	.ms-user-location {
		color: #aaa;
		font-size: 0.9em;
		margin: 0;
		line-height: 1.3;
	}
	.ms-user-bio {
		margin-top: 0.3em;
		line-height: 1.1;
		font-size: 1em;
		margin-bottom: 0.4rem;
	}
	.ms-profile-data {
		display: flex;
		flex-direction: column;
		justify-content: space-between;
	}
	.ms-profile-meta {
		display: flex;
		margin: 0;
		li {
			margin-right: 0.5em;
			margin-bottom: 0;
		}
	}
}
</style>
