<?php
include 'vc-grids-common.php';
return array(
	'name' => __( 'Media Grid', 'js_composer' ),
	'base' => 'vc_media_grid',
	'icon' => 'vc_icon-vc-media-grid',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Media grid from Media Library', 'js_composer' ),
	'params' => $media_grid_params,
);
