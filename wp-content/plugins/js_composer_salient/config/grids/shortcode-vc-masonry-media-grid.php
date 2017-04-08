<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
include 'vc-grids-common.php';

$masonry_media_grid_params = $media_grid_params;
$masonry_media_grid_params[15]['value'] = 'masonryMedia_Default';
unset( $masonry_media_grid_params[1]['value'][ __( 'Pagination', 'js_composer' ) ] );

return array(
	'name' => __( 'Masonry Media Grid', 'js_composer' ),
	'base' => 'vc_masonry_media_grid',
	'icon' => 'vc_icon-vc-masonry-media-grid',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Masonry media grid from Media Library', 'js_composer' ),
	'params' => $masonry_media_grid_params,
);
