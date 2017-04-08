<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts array
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Basic_Grid
 */
$this->post_id = false;
$css = $el_class = '';
$posts = $filter_terms = array();
$this->buildAtts( $atts, $content );

$css = isset( $atts['css'] ) ? $atts['css'] : '';
$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';

$class_to_filter = 'vc_grid-container vc_clearfix wpb_content_element ' . $this->shortcode;
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

wp_enqueue_script( 'prettyphoto' );
wp_enqueue_style( 'prettyphoto' );

if ( 'true' === $this->atts['btn_add_icon'] ) {
	vc_icon_element_fonts_enqueue( $this->atts['btn_i_type'] );
}

$this->buildGridSettings();
if ( isset( $this->atts['style'] ) && 'pagination' === $this->atts['style'] ) {
	wp_enqueue_script( 'twbs-pagination' );
}
if ( ! empty( $atts['page_id'] ) ) {
	$this->grid_settings['page_id'] = (int) $atts['page_id'];
}
$this->enqueueScripts();
?><!-- vc_grid start -->
<div class="vc_grid-container-wrapper vc_clearfix">
	<div class="<?php echo esc_attr( $css_class ) ?>" data-vc-<?php echo esc_attr( $this->pagable_type ); ?>-settings="<?php echo esc_attr( json_encode( $this->grid_settings ) ); ?>" data-vc-request="<?php echo esc_attr( admin_url( 'admin-ajax.php', 'relative' ) ); ?>" data-vc-post-id="<?php echo esc_attr( get_the_ID() ); ?>" data-vc-public-nonce="<?php echo vc_generate_nonce( 'vc-public-nonce' ); ?>">
	</div>
</div><!-- vc_grid end -->
