<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
include 'vc-grids-common.php';
$masonry_grid_params = $grid_params;
unset( $masonry_grid_params[5]['value'][ __( 'Pagination', 'js_composer' ) ] );
$masonry_grid_params[30]['value'] = 'masonryGrid_Default';
return array(
	'name' => __( 'Post Masonry Grid', 'js_composer' ),
	'base' => 'vc_masonry_grid',
	'icon' => 'vc_icon-vc-masonry-grid',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Posts, pages or custom posts in masonry grid', 'js_composer' ),
	'params' => $masonry_grid_params,
);