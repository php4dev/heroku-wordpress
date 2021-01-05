<?php if (!defined('ABSPATH')) die('No direct access.'); ?>

<div class="metaslider-start mt-16">
	<div class="welcome-panel metaslider-welcome">
		<div class="welcome-panel-content">
			<h2><?php _e('Thank you for installing MetaSlider, the #1 WordPress slideshow plugin', 'ml-slider'); ?></h2>
			<p class="about-description"><?php _e('To create your first slideshow, select one of the options below.', 'ml-slider'); ?></p>
			<hr>
			<div class="ms-panel-container">
				<div class="metaslider-news">
					<h3><?php _e('Gutenberg ready!', 'ml-slider'); ?></h3>
					<p><?php _e('MetaSlider is compatible with Gutenberg, allowing you to select and preview your slideshows direcly in the editor.', 'ml-slider'); ?> <a target="_blank" href="https://www.metaslider.com/metaslider-introduces-slider-blocks-for-gutenberg/"><?php _e('Learn more', 'ml-slider'); ?></a></p>
					<picture>
						<img style="max-width:100%;display:block;padding-right:5rem" src="<?php echo METASLIDER_ADMIN_URL ?>assets/images/gutenberg-ms.png" alt="Screenshot from the Gutenberg interface with MetaSlider">
					</picture>
				</div>
				<div class="">
					<div>
						<h3><?php _e('Quick start', 'ml-slider'); ?></h3>
						<p><?php _e('To get started right away, drag and drop your images below.', 'ml-slider'); ?></p>
					</div>
					<div>
						<metaslider-dragdrop-import></metaslider-dragdrop-import>
						<?php
						    $max_upload_size = wp_max_upload_size();
							if (!$max_upload_size) $max_upload_size = 0;
							printf(__('Maximum upload file size: %s.' ), esc_html(size_format($max_upload_size)));
							
							/*
							TODO: Maybe add a button to show the media library uploader
							<p><a class="button button-primary button-hero install-now" href="#">Open media library</a></p>
							<p><a href="#"><?php// _e('Learn more about this tool', 'ml-slider'); ?></a></p>
							*/ ?>
					</div>
				</div>
				<div class="">

					<div>
						<?php $blank_title = metaslider_pro_is_active() ? __('Using more than image slides?', 'ml-slider') : __('Not quite ready?', 'ml-slider'); ?>
						<h3><?php echo $blank_title; ?></h3>
						<p><?php _e('Feel free to create a slideshow with no images. If you are a premium member using the add-on pack, select this option to access video, layer, and external URL slides.', 'ml-slider'); ?></p>
					</div>

					<div class="try-gutenberg-action">
						<p><a class="button button-secondary button-hero install-now" href="<?php echo wp_nonce_url(admin_url("admin-post.php?action=metaslider_create_slider"), "metaslider_create_slider"); ?>" data-name="Classic Editor" data-slug="classic-editor"><?php _e('Create blank slideshow', 'ml-slider'); ?></a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php // TODO: I think after here maybe we can add images from their media library, or perhaps from an external image API
