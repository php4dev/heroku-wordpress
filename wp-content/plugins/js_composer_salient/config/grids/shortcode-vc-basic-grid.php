<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
include 'vc-grids-common.php';
return array(
	'name' => __( 'Post Grid', 'js_composer' ),
	'base' => 'vc_basic_grid',
	'icon' => 'icon-wpb-application-icon-large',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Posts, pages or custom posts in grid', 'js_composer' ),
	'params' => $grid_params,
);
