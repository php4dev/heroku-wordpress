window.jQuery(function($) {

	const APP = window.metaslider.app ? window.metaslider.app.MetaSlider : null
	/**
	 * Event listening to media library edits
	 */
	var media_library_events = {
		loaded: false,
		/**
		 * Attaches listenTo event to the library collection
		 *
		 * @param modal object wp.media modal
		 */
		attach_event: function(modal) {
			var library = modal.state().get('library')
			modal.listenTo(library, 'change', function(model) {
				media_library_events.update_slide_metadata({
					id: model.get('id'),
					caption: model.get('caption'),
					description: model.get('description'),
					title: model.get('title'),
					alt: model.get('alt')
				})
			})
		},

		/**
		 * Updates slide caption and other metadata when a media is edited in a modal
		 *
		 * @param object metadata
		 */
		update_slide_metadata: function(metadata) {
			var $slides = $('.slide').filter(function(i) {
				return $(this).data('attachment-id') === metadata.id
			})

			var slideIds = $slides.map(function() {
				return this.id.replace('slide-', '')
			})

			// To be picked up by vue components
			$(document).trigger('metaslider/image-meta-updated', [slideIds.toArray(), metadata])

			metadata.title ? $('.title .default', $slides).html(metadata.title) : $('.title .default', $slides).html('&nbsp;')
			metadata.alt ? $('.alt .default', $slides).html(metadata.alt) : $('.alt .default', $slides).html('&nbsp;')
		}
	}
        
	/**
	 * UI for adding a slide. Managed through the WP media upload UI
	 * Event managed here.
	 */
	var create_slides = window.create_slides = wp.media.frames.file_frame = wp.media({
		multiple: 'add',
		frame: 'post',
		library: {type: 'image'},
	});

	// Remove unwanted image views
	var whiteList = ['insert', 'iframe'];
	var unwanted_media_menu_items = create_slides.states.models.filter(function(view) {
		var title = view.id;
		
		// Filter through the list and determine which elements to remove
		return !whiteList.filter(function(term) { return title.includes(term) }).length;
	})
	create_slides.states.remove(unwanted_media_menu_items);

	create_slides.on('insert', function() {
		
		var slide_ids = [];
		create_slides.state().get('selection').map(function(media) {
			slide_ids.push(media.toJSON().id);
		});

		if (APP) {
			const message = slide_ids.length == 1 ? APP.__('Preparing 1 slide...', 'ml-slider') : APP.__('Preparing %s slides...')
			APP.notifyInfo(
				'metaslider/creating-slides',
				APP.sprintf(message, slide_ids.length),
				true
			)
		}
		
		// Remove the events for image APIs
		remove_image_apis()

		var data = {
			action: 'create_image_slide',
			slider_id: window.parent.metaslider_slider_id,
			selection: slide_ids,
			_wpnonce: metaslider.create_slide_nonce
		};

		// TODO: Create micro feedback to the user. 
		// TODO: Adding lots of slides locks up the page due to 'resizeSlides' event
		$.ajax({
			url: metaslider.ajaxurl, 
			data: data,
			type: 'POST',
			error: function(error) {    
				APP && APP.notifyError('metaslider/slide-create-failed', error, true)
			},
			success: function(response) {

				// Mount and render each new slide
				response.data.forEach(function(slide) {
					// TODO: Eventually move the creation to the slideshow or slide vue component
					// TODO: Be careful about the handling of filters (ex. scheduling)
					var res = window.metaslider.app.Vue.compile(slide['html'])

					// Mount the slide to the end of the list
					$('#metaslider-slides-list > tbody').append(
						(new window.metaslider.app.Vue({
							render: res.render,
							staticRenderFns: res.staticRenderFns
						}).$mount()).$el
					)
				})

				// Add timeouts to give some breating room to the notice animations
				setTimeout(function() {
					if (APP) {
						const message = slide_ids.length == 1 ? APP.__('1 slide added successfully', 'ml-slider') : APP.__('%s slides added successfully')
						APP.notifySuccess(
							'metaslider/slides-created',
							APP.sprintf(message, slide_ids.length),
							true
						)
					}
					setTimeout(function() {
						APP && APP.triggerEvent('metaslider/save')
					}, 1000);
				}, 1000);

			}
		})
	})

	/**
	 * Starts to watch the media library for changes
	 */
	create_slides.on('attach', function() {
		if (!media_library_events.loaded) {
			media_library_events.attach_event(create_slides)
		}
	})

	/**
	 * Fire events when the modal is opened
	 * Available events: create_slides.on('all', function (e) { console.log(e) })
	 */
	// This is also a little "hack-ish" but necessary since we are accessing the UI indirectly
	create_slides.on('open activate uploader:ready', function() {
		// TODO: when converted to vue component make this work for other languages
		$('.media-menu a:contains("Media Library")').remove()
		add_image_apis()

		// Remove unwanted side menu items
		unwanted_media_menu_items.forEach(function (item) {
			$('#menu-item-' + item.id).remove();
		})
	})
	APP && create_slides.on('open', function() {
		APP.notifyInfo('metaslider/add-slide-opening-ui', APP.__('Opening add slide UI...', 'ml-slider'))
	})
	APP && create_slides.on('deactivate close', function() {
		APP.notifyInfo('metaslider/add-slide-closing-ui', APP.__('Closing add slide UI...', 'ml-slider'))
		remove_image_apis()
	})

	/**
	* Handles changing alt and title on SEO tab
	* TODO: refactor to remove this
	*/
	$('.metaslider').on('change', '.js-inherit-from-image', function(e) {
		var $this = $(this)
		var $parent = $this.parents('.can-inherit')
		var input = $parent.children('textarea,input[type=text]')
		var default_item = $parent.children('.default')
		if ($this.is(':checked')) {
			$parent.addClass('inherit-from-image')
		} else {
			$parent.removeClass('inherit-from-image')
			input.focus()
			if ('' === input.val()) {
				if (0 === default_item.find('.no-content').length) {
					input.val(default_item.html())
				}
			}
		}
	})

	/**
	 * For changing slide image. Managed through the WP media upload UI
	 * Initialized dynamically due to multiple slides.
	 */
	var update_slide_frame;

        /**
         * Handles changing an image when edited by the user.
         */
        $('.metaslider').on('click', '.update-image', function(event) {
            event.preventDefault();
            var $this = $(this);
            var current_id = $this.data('attachment-id');

            /**
             * Opens up a media window showing images
             */
			update_slide_frame = window.update_slide_frame = wp.media.frames.file_frame = wp.media({
                title: MetaSlider_Helpers.capitalize(metaslider.update_image),
                library: {type: 'image'},
                button: {
                    text: MetaSlider_Helpers.capitalize($this.attr('data-button-text'))
                }
            });

            /**
             * Selects current image
             */
            update_slide_frame.on('open', function() {
                if (current_id) {
                    var selection = update_slide_frame.state().get('selection');
					selection.reset([wp.media.attachment(current_id)]);

					// Add various image APIs
					add_image_apis($this.data('slideType'), $this.data('slideId'))
                }
            });

            /**
             * Starts to watch the media library for changes 
             */            
            update_slide_frame.on('attach', function() {
                if (!media_library_events.loaded) {
                    media_library_events.attach_event(update_slide_frame);
                }
            });
            
            /**
             * Open media modal
             */
            update_slide_frame.open();
            
            /**
             * Handles changing an image in DB and UI
             */
            update_slide_frame.on('select', function() {
                var selection = update_slide_frame.state().get('selection');
                selection.map(function(attachment) {
                    attachment = attachment.toJSON();
                    new_image_id = attachment.id;
                    selected_item = attachment;
				});

				APP && APP.notifyInfo('metaslider/updating-slide', APP.__('Updating slide...', 'ml-slider'), true)
				
				// Remove the events for image APIs
				remove_image_apis()

                /**
                 * Updates the meta information on the slide
                 */
                var data = { 
                    action: 'update_slide_image',
                    _wpnonce: metaslider.update_slide_image_nonce,
                    slide_id: $this.data('slideId'),
                    slider_id: window.parent.metaslider_slider_id,
                    image_id: new_image_id
                };
                
                $.ajax({
                    url: metaslider.ajaxurl, 
                    data: data,
                    type: 'POST',
                    error: function(error) {    
						APP && APP.notifyError('metaslider/slide-update-failed', error, true)
                    },
                    success: function(response) {
                       /**
                        * Updates the image on success
                        */
                        $('#slide-' + $this.data('slideId') + ' .thumb')
                            .css('background-image', 'url(' + response.data.thumbnail_url + ')');
                        // set new attachment ID
                        var $edited_slide_elms = $('#slide-' + $this.data('slideId') + ', #slide-' + $this.data('slideId') + ' .update-image');
                        $edited_slide_elms.data('attachment-id', selected_item.id);
                        
                        if (response.data.thumbnail_url) {
                            $('#slide-' + $this.data('slideId')).trigger('metaslider/attachment/updated', response.data);
                        }

						// Update metadata to new image
						media_library_events.update_slide_metadata({
							id: selected_item.id,
							caption: selected_item.caption,
							description: selected_item.description,
							title: selected_item.title,
							alt: selected_item.alt
						})

						APP && APP.notifySuccess('metaslider/slide-updated', APP.__('Slide updated successfully', 'ml-slider'), true)

						// TODO: run a function in SlideViewer.vue to replace this
                        $(".metaslider table#metaslider-slides-list").trigger('resizeSlides');
                    }
                });
			});

			update_slide_frame.on('close', function() {
				remove_image_apis()
			})
			create_slides.on('close', function() {
				remove_image_apis()
			})
		})

	/**
	 * Add all the image APIs. Add events everytime the modal is open
	 * TODO: refactor out hard-coded unsplash (can wait until we add a second service)
	 * TODO: right now this replaces the content pane. It might take some time but look for more native integration
	 * TODO: It gets a little bit buggy when someone triggers a download and clicks around. Maybe not important.
	 */
	var unsplash_api_events = function(event) {
		event.preventDefault()

		// Some things shouldn't happen when we're about to reload
		if (window.metaslider.about_to_reload) return

		// Set this tab as active
		$(this).addClass('active').siblings().removeClass('active')

		// If the image api container exists we don't want to create it again
		if ($('#image-api-container').length) return

		// Move the content and trigger vue to fetch the data
		// Add a container to house the content
		$(this).parents('.media-frame-router').siblings('.media-frame-content').append('<div id="image-api-container"></div>')

		// Add content to the container
		$('#image-api-container').append('<metaslider-external source="unsplash" :slideshow-id="' + window.parent.metaslider_slider_id + '" :slide-id="' + window.metaslider.slide_id + '" slide-type="' + (window.metaslider.slide_type || 'image') + '"></metaslider-external>')
		
		// Tell our app to render a new component
		$(window).trigger('metaslider/initialize_external_api', {
			'selector': '#image-api-container'
		})

		// Discard these
		delete window.metaslider.slide_id
		delete window.metaslider.slide_type
	}
	var add_image_apis = function (slide_type, slide_id) {

		// This is the pro layer screen (not currently used)
		if ($('.media-menu-item.active:contains("Layer")').length) {
			// If this is the layer slide screen and pro isnt installed, exit
			if (!window.metaslider.pro_supports_imports) return
			window.metaslider.slide_type = 'layer'
		}

		// If slide type is set then override the above because we're just updating an image
		if (slide_type) {
			window.metaslider.slide_type = slide_type
		}

		window.metaslider.slide_id = slide_id

		// Unsplash - First remove potentially leftover tabs in case the WP close event doesn't fire
		$('.unsplash-tab').remove()
		$('.media-frame-router .media-router').append('<a href="#" id="unsplash-tab" class="text-black hover:text-blue-dark unsplash-tab media-menu-item">Unsplash Library</a>')
		$('.toplevel_page_metaslider').on('click', '.unsplash-tab', unsplash_api_events)

		// Each API will fake the container, so if we click on a native WP container, we should delete the API container
		$('.media-frame-router .media-router .media-menu-item').on('click', function() {

			// Destroy the component (does clean up)
			$(window).trigger('metaslider/destroy_external_api')

			// Additionally set the active tab
			$(this).addClass('active').siblings().removeClass('active')
		})
	}
	
	/**
	 * Remove tab and events for api type images. Add this when a modal closes to avoid duplicate events
	 */
	var remove_image_apis = function() {

		// Some things shouldn't happen when we're about to reload
		if (window.metaslider.about_to_reload) return

		// Tell tell components they are about to be removed
		$(window).trigger('metaslider/destroy_external_api')

		$('.toplevel_page_metaslider').off('click', '.unsplash-tab', unsplash_api_events)
		$('.unsplash-tab').remove()

		// Since we will destroy the container each time we should add the active class to whatever is first
		$('.media-frame-router .media-router > a').first().trigger('click')
	}

        /**
         * delete a slide using ajax (avoid losing changes)
         */
        $(".metaslider").on('click', '.delete-slide', function(event) {
            event.preventDefault();
            var $this = $(this);
            var data = {
                action: 'delete_slide',
                _wpnonce: metaslider.delete_slide_nonce,
                slide_id: $this.data('slideId'),
                slider_id: window.parent.metaslider_slider_id
            };

            // Set the slider state to deleting
            $this.parents('#slide-' + $this.data('slideId'))
                 .removeClass('ms-restored')
                 .addClass('ms-deleting')
                 .append('<div class="ms-delete-overlay"><i style="height:24px;width:24px"><svg class="ms-spin" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader"><line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/><line x1="2" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="22" y2="12"/><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"/><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"/></svg></i></div>');
            $this.parents('#slide-' + $this.data('slideId'))
                 .find('.ms-delete-status')
                 .remove();
            
            $.ajax({
                url: metaslider.ajaxurl, 
                data: data,
                type: 'POST',
                error: function(response) {

                    // Delete failed. Remove delete state UI
                    alert(response.responseJSON.data.message);
                    $slide = $this.parents('#slide-' + $this.data('slideId'));
                    $slide.removeClass('ms-deleting');
                    $slide.find('.ms-delete-overlay').remove();
                },
                success: function(response) {
                    var count = 10;

                    // Remove deleting state and add a deleted state with restore option
                    setTimeout(function() {
                        $slide = $this.parents('#slide-' + $this.data('slideId'));
                        $slide.addClass('ms-deleted')
                             .removeClass('ms-deleting')
                             .find('.metaslider-ui-controls').append(
                                '<button class="undo-delete-slide" title="' + metaslider.restore_language + '" data-slide-id="' + $this.data('slideId') + '">' + metaslider.restore_language + '</button>'
                        );

                        // Grab the image from the slide
                        var img = $slide.find('.thumb').css('background-image')
                                        .replace(/^url\(["']?/, '')
                                        .replace(/["']?\)$/, '');

                        // If the image is the same as the URL then it's empty (external slide type)
                        img = (window.location.href === img) ? '' : img;
						
						// @codingStandardsIgnoreStart
						// Will be refactored in the the next branch
                        // Send a notice to the user
                        // var notice = new MS_Notification(metaslider.deleted_language, metaslider.click_to_undo_language, img);

                        // Fire the notice and set callback to undo
                        // notice.fire(10000, function() {
                        //     jQuery('#slide-' + $this.data('slideId'))
                        //         .addClass('hide-status')
                        //         .find('.undo-delete-slide').trigger('click');
						// });
						// @codingStandardsIgnoreEnd

                        // If the trash link isn't there, add it in (without counter)
                        if ('none' == $('.restore-slide-link').css('display')) {
                            $('.restore-slide-link').css('display', 'inline');
                        }
                    }, 1000);
                }
            });
        });

        /**
         * delete a slide using ajax (avoid losing changes)
         */
        $(".metaslider").on('click', '.undo-delete-slide, .trash-view-restore', function(event) {
            event.preventDefault();
            var $this = $(this);
            var data = {
                action: 'undelete_slide',
                _wpnonce: metaslider.undelete_slide_nonce,
                slide_id: $this.data('slideId'),
                slider_id: window.parent.metaslider_slider_id
            };

            // Remove undo button
            $('#slide-' + $this.data('slideId')).find('.undo-delete-slide').html('');

            // Set the slider state to deleting
            $this.parents('#slide-' + $this.data('slideId'))
                 .removeClass('ms-deleted')
                 .addClass('ms-deleting')
                 .css('padding-top', '31px')
                 .append('<div class="ms-delete-overlay"><i style="height:24px;width:24px"><svg class="ms-spin" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader"><line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/><line x1="2" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="22" y2="12"/><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"/><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"/></svg></i></div>');
            $this.parents('#slide-' + $this.data('slideId'))
                 .find('.ms-delete-status')
                 .remove();
            $this.parents('#slide-' + $this.data('slideId'))
                 .find('.delete-slide')
                 .focus();

            $.ajax({
                url: metaslider.ajaxurl, 
                data: data,
                type: 'POST',
                error: function(response) {
                    
                    // Undelete failed. Remove delete state UI
                    $slide = $this.parents('#slide-' + $this.data('slideId'));
                    $slide.removeClass('ms-restoring').addClass('ms-deleted');
                    $slide.find('.ms-delete-overlay').remove();

                    // If there was a WP error, this should be populated:
                    if (response.responseJSON) {
                        alert(response.responseJSON.data.message);
                    } else {
                        alert('There was an error with the server and the action could not be completed.');
                    }
                },
                success: function(response) {

                    // Restore to original state
                    $slide = $this.parents('#slide-' + $this.data('slideId'));
                    $slide.addClass('ms-restored')
                    $slide.removeClass('ms-deleting')
                          .find('.undo-delete-slide, .trash-view-restore').remove();
                    $slide.find('.ms-delete-overlay').remove();
                    $('#slide-' + $this.data('slideId') + ' h4').after('<span class="ms-delete-status is-success">' + metaslider.restored_language + '</span>');

                    // We can try to remove the buton actions too (trashed view)
                    $('#slide-' + $this.data('slideId')).find('.row-actions.trash-btns').html('');

                    // Grab the image from the slide
                    var img = $slide.find('.thumb').css('background-image')
                                    .replace(/^url\(["']?/, '')
                                    .replace(/["']?\)$/, '');

                    // If the image is the same as the URL then it's empty (external slide type)
                    img = (window.location.href === img) ? '' : img;

					// @codingStandardsIgnoreStart
					// Will be refactored in the the next branch
					// Send a success notification
					// TODO: fire notification
                    // var notice = new MS_Notification(metaslider.restored_language, '', img, 'is-success');
                    
                    // Fire the notice
					// notice.fire(5000);
					// @codingStandardsIgnoreEnd
                }
            });
        });
        

		// bind an event to the slides table to update the menu order of each slide
		// TODO: Remove this soon
        $(".metaslider").on('resizeSlides', 'table#metaslider-slides-list', function(event) {
            var slideshow_width = $("input.width").val();
            var slideshow_height = $("input.height").val();
    
            $("tr.slide input[name='resize_slide_id']", this).each(function() {
                $this = $(this);
    
                var thumb_width = $this.attr("data-width");
                var thumb_height = $this.attr("data-height");
                var slide_row = $(this).closest('tr');
                var crop_changed = slide_row.data('crop_changed');
    
                if (thumb_width != slideshow_width || thumb_height != slideshow_height || crop_changed) {
                    $this.attr("data-width", slideshow_width);
                    $this.attr("data-height", slideshow_height);
    
                    var data = {
                        action: "resize_image_slide",
                        slider_id: window.parent.metaslider_slider_id,
                        slide_id: $this.attr("data-slide_id"),
                        _wpnonce: metaslider.resize_nonce
                    };
    
                    $.ajax({
                        type: "POST",
                        data : data,
                        async: false,
                        cache: false,
                        url: metaslider.ajaxurl,
                        success: function(response) {
                            if (crop_changed) {
                                slide_row.data('crop_changed', false);
                            }
                            if (response.data.thumbnail_url) {
                                $this.closest('tr.slide').trigger('metaslider/attachment/updated', response.data);
                            }
                        }
                    });
                }
            });
        });
    
        // helptext tooltips
        $('.tipsy-tooltip').tipsy({className: 'msTipsy', live: false, delayIn: 500, html: true, gravity: 'e'})
		$('.tipsy-tooltip-top').tipsy({live: false, delayIn: 500, html: true, gravity: 's'})
		$('.tipsy-tooltip-bottom').tipsy({ live: false, delayIn: 500, html: true, gravity: 'n' })
		$('.tipsy-tooltip-bottom-toolbar').tipsy({ live: false, delayIn: 500, html: true, gravity: 'n', offset: 2 })
    

});

/**
 * Various helper functions to use throughout
 */
var MetaSlider_Helpers = {

    /**
     * Various helper functions to use throughout
     *
     * @param  string string A string to capitalise
     * @return string Returns capitalised string
     */
    capitalize: function(string) {
        return string.replace(/\b\w/g, function(l) { return l.toUpperCase(); });
    }
};
