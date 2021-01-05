<?php if (!defined('ABSPATH')) die('No direct access.'); ?>

<?php // Handle captions
	$slide_caption = (esc_textarea($this->slide->post_excerpt));
	$image_caption = (esc_textarea($attachment->post_excerpt));
	$image_description = (esc_textarea($attachment->post_content));

	// Deprecate inherit_image_caption by deleting it and setting the source as the image 
	if (filter_var(get_post_meta($this->slide->ID, 'ml-slider_inherit_image_caption', true), FILTER_VALIDATE_BOOLEAN)) {
		update_post_meta($this->slide->ID, 'ml-slider_caption_source', 'image-caption');
		delete_post_meta($this->slide->ID, 'ml-slider_inherit_image_caption');
	}


	$caption_source = get_post_meta($this->slide->ID, 'ml-slider_caption_source', true); ?>
	<metaslider-caption
		image-caption='<?php echo $image_caption ?>'
		image-description='<?php echo $image_description ?>'
		override='<?php echo $slide_caption ?>'
		caption-source='<?php echo $caption_source ?>'></metaslider-caption>

<?php // Handle URL and target
	$url = esc_attr(get_post_meta($slide_id, 'ml-slider_url', true));
	$target = get_post_meta($slide_id, 'ml-slider_new_window', true) ? 'checked=checked' : ''; 
?>
<div class="row has-right-checkbox">
	<input class="url" data-lpignore="true" type="text" name="attachment[<?php echo $slide_id; ?>][url]" placeholder="<?php _e("URL", "ml-slider"); ?>" value="<?php echo $url; ?>" />
	<div class="input-label right new_window">
		<label><?php _e("Open in a new window", "ml-slider"); ?> <input autocomplete="off" tabindex="0" type="checkbox" name="attachment[<?php echo $slide_id; ?>][new_window]" <?php echo $target; ?> /></label>
	</div>
</div>
