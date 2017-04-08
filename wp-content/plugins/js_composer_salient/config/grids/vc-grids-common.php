<?php
require_once 'vc-grids-functions.php';
$post_types = get_post_types( array() );
$post_types_list = array();
$excluded_post_types = array( 'revision', 'nav_menu_item', 'vc_grid_item' );
if ( is_array( $post_types ) && ! empty( $post_types ) ) {
	foreach ( $post_types as $post_type ) {
		if ( ! in_array( $post_type, $excluded_post_types ) ) {
			$label = ucfirst( $post_type );
			$post_types_list[] = array(
				$post_type,
				$label,
			);
		}
	}
}
$post_types_list[] = array(
	'custom',
	__( 'Custom query', 'js_composer' ),
);
$post_types_list[] = array(
	'ids',
	__( 'List of IDs', 'js_composer' ),
);

$taxonomies_for_filter = array();

if ( 'vc_edit_form' === vc_post_param( 'action' ) ) {
	$vc_taxonomies_types = vc_taxonomies_types();
	if ( is_array( $vc_taxonomies_types ) && ! empty( $vc_taxonomies_types ) ) {
		foreach ( $vc_taxonomies_types as $t => $data ) {
			if ( 'post_format' !== $t && is_object( $data ) ) {
				$taxonomies_for_filter[ $data->labels->name ] = $t;
			}
		}
	}
}

$grid_cols_list = array(
	array(
		'label' => '6',
		'value' => 2,
	),
	array(
		'label' => '4',
		'value' => 3,
	),
	array(
		'label' => '3',
		'value' => 4,
	),
	array(
		'label' => '2',
		'value' => 6,
	),
	array(
		'label' => '1',
		'value' => 12,
	),
);

$btn3_params = vc_map_integrate_shortcode( 'vc_btn', 'btn_', __( 'Load More Button', 'js_composer' ), array(
	'exclude' => array(
		'link',
		'css',
		'el_class',
		'css_animation',
	),
), array(
	'element' => 'style',
	'value' => array( 'load-more' ),
) );
foreach ( $btn3_params as $key => $value ) {
	if ( 'btn_title' == $value['param_name'] ) {
		$btn3_params[ $key ]['value'] = __( 'Load more', 'js_composer' );
	} else if ( 'btn_color' == $value['param_name'] ) {
		$btn3_params[ $key ]['std'] = 'blue';
	} else if ( 'btn_style' == $value['param_name'] ) {
		$btn3_params[ $key ]['std'] = 'flat';
	}
}
$grid_params = array_merge( array(
	0 => array(
		'type' => 'dropdown',
		'heading' => __( 'Data source', 'js_composer' ),
		'param_name' => 'post_type',
		'value' => $post_types_list,
		'save_always' => true,
		'description' => __( 'Select content type for your grid.', 'js_composer' ),
	),
	1 => array(
		'type' => 'autocomplete',
		'heading' => __( 'Include only', 'js_composer' ),
		'param_name' => 'include',
		'description' => __( 'Add posts, pages, etc. by title.', 'js_composer' ),
		'settings' => array(
			'multiple' => true,
			'sortable' => true,
			'groups' => true,
		),
		'dependency' => array(
			'element' => 'post_type',
			'value' => array( 'ids' ),
		),
	),
	// Custom query tab
	2 => array(
		'type' => 'textarea_safe',
		'heading' => __( 'Custom query', 'js_composer' ),
		'param_name' => 'custom_query',
		'description' => __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'js_composer' ),
		'dependency' => array(
			'element' => 'post_type',
			'value' => array( 'custom' ),
		),
	),
	3 => array(
		'type' => 'autocomplete',
		'heading' => __( 'Narrow data source', 'js_composer' ),
		'param_name' => 'taxonomies',
		'settings' => array(
			'multiple' => true,
			'min_length' => 1,
			'groups' => true,
			// In UI show results grouped by groups, default false
			'unique_values' => true,
			// In UI show results except selected. NB! You should manually check values in backend, default false
			'display_inline' => true,
			// In UI show results inline view, default false (each value in own line)
			'delay' => 500,
			// delay for search. default 500
			'auto_focus' => true,
			// auto focus input, default true
		),
		'param_holder_class' => 'vc_not-for-custom',
		'description' => __( 'Enter categories, tags or custom taxonomies.', 'js_composer' ),
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array(
				'ids',
				'custom',
			),
		),
	),
	4 => array(
		'type' => 'textfield',
		'heading' => __( 'Total items', 'js_composer' ),
		'param_name' => 'max_items',
		'value' => 10,
		// default value
		'param_holder_class' => 'vc_not-for-custom',
		'description' => __( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'js_composer' ),
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array(
				'ids',
				'custom',
			),
		),
	),
	5 => array(
		'type' => 'dropdown',
		'heading' => __( 'Display Style', 'js_composer' ),
		'param_name' => 'style',
		'value' => array(
			__( 'Show all', 'js_composer' ) => 'all',
			__( 'Load more button', 'js_composer' ) => 'load-more',
			__( 'Lazy loading', 'js_composer' ) => 'lazy',
			__( 'Pagination', 'js_composer' ) => 'pagination',
		),
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'custom' ),
		),
		'edit_field_class' => 'vc_col-sm-6 vc_column',
		'description' => __( 'Select display style for grid.', 'js_composer' ),
	),
	6 => array(
		'type' => 'textfield',
		'heading' => __( 'Items per page', 'js_composer' ),
		'param_name' => 'items_per_page',
		'description' => __( 'Number of items to show per page.', 'js_composer' ),
		'value' => '10',
		'dependency' => array(
			'element' => 'style',
			'value' => array(
				'lazy',
				'load-more',
				'pagination',
			),
		),
		'edit_field_class' => 'vc_col-sm-6 vc_column',
	),
	7 => array(
		'type' => 'checkbox',
		'heading' => __( 'Show filter', 'js_composer' ),
		'param_name' => 'show_filter',
		'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		'description' => __( 'Append filter to grid.', 'js_composer' ),
	),
	8 => array(
		'type' => 'dropdown',
		'heading' => __( 'Grid elements per row', 'js_composer' ),
		'param_name' => 'element_width',
		'value' => $grid_cols_list,
		'std' => '4',
		'edit_field_class' => 'vc_col-sm-6 vc_column',
		'description' => __( 'Select number of single grid elements per row.', 'js_composer' ),
	),
	9 => array(
		'type' => 'dropdown',
		'heading' => __( 'Gap', 'js_composer' ),
		'param_name' => 'gap',
		'value' => array(
			'0px' => '0',
			'1px' => '1',
			'2px' => '2',
			'3px' => '3',
			'4px' => '4',
			'5px' => '5',
			'10px' => '10',
			'15px' => '15',
			'20px' => '20',
			'25px' => '25',
			'30px' => '30',
			'35px' => '35',
		),
		'std' => '30',
		'description' => __( 'Select gap between grid elements.', 'js_composer' ),
		'edit_field_class' => 'vc_col-sm-6 vc_column',
	),
	// Data settings
	10 => array(
		'type' => 'dropdown',
		'heading' => __( 'Order by', 'js_composer' ),
		'param_name' => 'orderby',
		'value' => array(
			__( 'Date', 'js_composer' ) => 'date',
			__( 'Order by post ID', 'js_composer' ) => 'ID',
			__( 'Author', 'js_composer' ) => 'author',
			__( 'Title', 'js_composer' ) => 'title',
			__( 'Last modified date', 'js_composer' ) => 'modified',
			__( 'Post/page parent ID', 'js_composer' ) => 'parent',
			__( 'Number of comments', 'js_composer' ) => 'comment_count',
			__( 'Menu order/Page Order', 'js_composer' ) => 'menu_order',
			__( 'Meta value', 'js_composer' ) => 'meta_value',
			__( 'Meta value number', 'js_composer' ) => 'meta_value_num',
			__( 'Random order', 'js_composer' ) => 'rand',
		),
		'description' => __( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'js_composer' ),
		'group' => __( 'Data Settings', 'js_composer' ),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array(
				'ids',
				'custom',
			),
		),
	),
	11 => array(
		'type' => 'dropdown',
		'heading' => __( 'Sort order', 'js_composer' ),
		'param_name' => 'order',
		'group' => __( 'Data Settings', 'js_composer' ),
		'value' => array(
			__( 'Descending', 'js_composer' ) => 'DESC',
			__( 'Ascending', 'js_composer' ) => 'ASC',
		),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'description' => __( 'Select sorting order.', 'js_composer' ),
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array(
				'ids',
				'custom',
			),
		),
	),
	12 => array(
		'type' => 'textfield',
		'heading' => __( 'Meta key', 'js_composer' ),
		'param_name' => 'meta_key',
		'description' => __( 'Input meta key for grid ordering.', 'js_composer' ),
		'group' => __( 'Data Settings', 'js_composer' ),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'dependency' => array(
			'element' => 'orderby',
			'value' => array(
				'meta_value',
				'meta_value_num',
			),
		),
	),
	13 => array(
		'type' => 'textfield',
		'heading' => __( 'Offset', 'js_composer' ),
		'param_name' => 'offset',
		'description' => __( 'Number of grid elements to displace or pass over.', 'js_composer' ),
		'group' => __( 'Data Settings', 'js_composer' ),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array(
				'ids',
				'custom',
			),
		),
	),
	14 => array(
		'type' => 'autocomplete',
		'heading' => __( 'Exclude', 'js_composer' ),
		'param_name' => 'exclude',
		'description' => __( 'Exclude posts, pages, etc. by title.', 'js_composer' ),
		'group' => __( 'Data Settings', 'js_composer' ),
		'settings' => array(
			'multiple' => true,
		),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array(
				'ids',
				'custom',
			),
			'callback' => 'vc_grid_exclude_dependency_callback',
		),
	),
	//Filter tab
	15 => array(
		'type' => 'dropdown',
		'heading' => __( 'Filter by', 'js_composer' ),
		'param_name' => 'filter_source',
		'value' => $taxonomies_for_filter,
		'group' => __( 'Filter', 'js_composer' ),
		'dependency' => array(
			'element' => 'show_filter',
			'value' => array( 'yes' ),
		),
		'save_always' => true,
		'description' => __( 'Select filter source.', 'js_composer' ),
	),
	16 => array(
		'type' => 'autocomplete',
		'heading' => __( 'Exclude from filter list', 'js_composer' ),
		'param_name' => 'exclude_filter',
		'settings' => array(
			'multiple' => true,
			// is multiple values allowed? default false
			'min_length' => 1,
			// min length to start search -> default 2
			'groups' => true,
			// In UI show results grouped by groups, default false
			'unique_values' => true,
			// In UI show results except selected. NB! You should manually check values in backend, default false
			'display_inline' => true,
			// In UI show results inline view, default false (each value in own line)
			'delay' => 500,
			// delay for search. default 500
			'auto_focus' => true,
			// auto focus input, default true
		),
		'description' => __( 'Enter categories, tags won\'t be shown in the filters list', 'js_composer' ),
		'dependency' => array(
			'element' => 'show_filter',
			'value' => array( 'yes' ),
			'callback' => 'vcGridFilterExcludeCallBack',
		),
		'group' => __( 'Filter', 'js_composer' ),
	),
	17 => array(
		'type' => 'dropdown',
		'heading' => __( 'Style', 'js_composer' ),
		'param_name' => 'filter_style',
		'value' => array(
			__( 'Rounded', 'js_composer' ) => 'default',
			__( 'Less Rounded', 'js_composer' ) => 'default-less-rounded',
			__( 'Border', 'js_composer' ) => 'bordered',
			__( 'Rounded Border', 'js_composer' ) => 'bordered-rounded',
			__( 'Less Rounded Border', 'js_composer' ) => 'bordered-rounded-less',
			__( 'Filled', 'js_composer' ) => 'filled',
			__( 'Rounded Filled', 'js_composer' ) => 'filled-rounded',
			__( 'Dropdown', 'js_composer' ) => 'dropdown',
		),
		'dependency' => array(
			'element' => 'show_filter',
			'value' => array( 'yes' ),
		),
		'group' => __( 'Filter', 'js_composer' ),
		'description' => __( 'Select filter display style.', 'js_composer' ),
	),
	18 => array(
		'type' => 'dropdown',
		'heading' => __( 'Alignment', 'js_composer' ),
		'param_name' => 'filter_align',
		'value' => array(
			__( 'Center', 'js_composer' ) => 'center',
			__( 'Left', 'js_composer' ) => 'left',
			__( 'Right', 'js_composer' ) => 'right',
		),
		'dependency' => array(
			'element' => 'show_filter',
			'value' => array( 'yes' ),
		),
		'group' => __( 'Filter', 'js_composer' ),
		'description' => __( 'Select filter alignment.', 'js_composer' ),
	),
	19 => array(
		'type' => 'dropdown',
		'heading' => __( 'Color', 'js_composer' ),
		'param_name' => 'filter_color',
		'value' => getVcShared( 'colors' ),
		'std' => 'grey',
		'param_holder_class' => 'vc_colored-dropdown',
		'dependency' => array(
			'element' => 'show_filter',
			'value' => array( 'yes' ),
		),
		'group' => __( 'Filter', 'js_composer' ),
		'description' => __( 'Select filter color.', 'js_composer' ),
	),
	20 => array(
		'type' => 'dropdown',
		'heading' => __( 'Filter size', 'js_composer' ),
		'param_name' => 'filter_size',
		'value' => getVcShared( 'sizes' ),
		'std' => 'md',
		'description' => __( 'Select filter size.', 'js_composer' ),
		'dependency' => array(
			'element' => 'show_filter',
			'value' => array( 'yes' ),
		),
		'group' => __( 'Filter', 'js_composer' ),
	),
	// moved to the end
	// Paging controls
	24 => array(
		'type' => 'dropdown',
		'heading' => __( 'Arrows design', 'js_composer' ),
		'param_name' => 'arrows_design',
		'value' => array(
			__( 'None', 'js_composer' ) => 'none',
			__( 'Simple', 'js_composer' ) => 'vc_arrow-icon-arrow_01_left',
			__( 'Simple Circle Border', 'js_composer' ) => 'vc_arrow-icon-arrow_02_left',
			__( 'Simple Circle', 'js_composer' ) => 'vc_arrow-icon-arrow_03_left',
			__( 'Simple Square', 'js_composer' ) => 'vc_arrow-icon-arrow_09_left',
			__( 'Simple Square Rounded', 'js_composer' ) => 'vc_arrow-icon-arrow_12_left',
			__( 'Simple Rounded', 'js_composer' ) => 'vc_arrow-icon-arrow_11_left',
			__( 'Rounded', 'js_composer' ) => 'vc_arrow-icon-arrow_04_left',
			__( 'Rounded Circle Border', 'js_composer' ) => 'vc_arrow-icon-arrow_05_left',
			__( 'Rounded Circle', 'js_composer' ) => 'vc_arrow-icon-arrow_06_left',
			__( 'Rounded Square', 'js_composer' ) => 'vc_arrow-icon-arrow_10_left',
			__( 'Simple Arrow', 'js_composer' ) => 'vc_arrow-icon-arrow_08_left',
			__( 'Simple Rounded Arrow', 'js_composer' ) => 'vc_arrow-icon-arrow_07_left',

		),
		'group' => __( 'Pagination', 'js_composer' ),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'pagination' ),
		),
		'description' => __( 'Select design for arrows.', 'js_composer' ),
	),
	25 => array(
		'type' => 'dropdown',
		'heading' => __( 'Arrows position', 'js_composer' ),
		'param_name' => 'arrows_position',
		'value' => array(
			__( 'Inside Wrapper', 'js_composer' ) => 'inside',
			__( 'Outside Wrapper', 'js_composer' ) => 'outside',
		),
		'group' => __( 'Pagination', 'js_composer' ),
		'dependency' => array(
			'element' => 'arrows_design',
			'value_not_equal_to' => array( 'none' ),
			// New dependency
		),
		'description' => __( 'Arrows will be displayed inside or outside grid.', 'js_composer' ),
	),
	26 => array(
		'type' => 'dropdown',
		'heading' => __( 'Arrows color', 'js_composer' ),
		'param_name' => 'arrows_color',
		'value' => getVcShared( 'colors' ),
		'param_holder_class' => 'vc_colored-dropdown',
		'group' => __( 'Pagination', 'js_composer' ),
		'dependency' => array(
			'element' => 'arrows_design',
			'value_not_equal_to' => array( 'none' ),
			// New dependency
		),
		'description' => __( 'Select color for arrows.', 'js_composer' ),
	),
	27 => array(
		'type' => 'dropdown',
		'heading' => __( 'Pagination style', 'js_composer' ),
		'param_name' => 'paging_design',
		'value' => array(
			__( 'None', 'js_composer' ) => 'none',
			__( 'Square Dots', 'js_composer' ) => 'square_dots',
			__( 'Radio Dots', 'js_composer' ) => 'radio_dots',
			__( 'Point Dots', 'js_composer' ) => 'point_dots',
			__( 'Fill Square Dots', 'js_composer' ) => 'fill_square_dots',
			__( 'Rounded Fill Square Dots', 'js_composer' ) => 'round_fill_square_dots',
			__( 'Pagination Default', 'js_composer' ) => 'pagination_default',
			__( 'Outline Default Dark', 'js_composer' ) => 'pagination_default_dark',
			__( 'Outline Default Light', 'js_composer' ) => 'pagination_default_light',
			__( 'Pagination Rounded', 'js_composer' ) => 'pagination_rounded',
			__( 'Outline Rounded Dark', 'js_composer' ) => 'pagination_rounded_dark',
			__( 'Outline Rounded Light', 'js_composer' ) => 'pagination_rounded_light',
			__( 'Pagination Square', 'js_composer' ) => 'pagination_square',
			__( 'Outline Square Dark', 'js_composer' ) => 'pagination_square_dark',
			__( 'Outline Square Light', 'js_composer' ) => 'pagination_square_light',
			__( 'Pagination Rounded Square', 'js_composer' ) => 'pagination_rounded_square',
			__( 'Outline Rounded Square Dark', 'js_composer' ) => 'pagination_rounded_square_dark',
			__( 'Outline Rounded Square Light', 'js_composer' ) => 'pagination_rounded_square_light',
			__( 'Stripes Dark', 'js_composer' ) => 'pagination_stripes_dark',
			__( 'Stripes Light', 'js_composer' ) => 'pagination_stripes_light',
		),
		'std' => 'radio_dots',
		'group' => __( 'Pagination', 'js_composer' ),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'pagination' ),
		),
		'description' => __( 'Select pagination style.', 'js_composer' ),
	),
	28 => array(
		'type' => 'dropdown',
		'heading' => __( 'Pagination color', 'js_composer' ),
		'param_name' => 'paging_color',
		'value' => getVcShared( 'colors' ),
		'std' => 'grey',
		'param_holder_class' => 'vc_colored-dropdown',
		'group' => __( 'Pagination', 'js_composer' ),
		'dependency' => array(
			'element' => 'paging_design',
			'value_not_equal_to' => array( 'none' ),
			// New dependency
		),
		'description' => __( 'Select pagination color.', 'js_composer' ),
	),
	29 => array(
		'type' => 'checkbox',
		'heading' => __( 'Loop pages?', 'js_composer' ),
		'param_name' => 'loop',
		'description' => __( 'Allow items to be repeated in infinite loop (carousel).', 'js_composer' ),
		'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		'group' => __( 'Pagination', 'js_composer' ),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'pagination' ),
		),
	),
	30 => array(
		'type' => 'textfield',
		'heading' => __( 'Autoplay delay', 'js_composer' ),
		'param_name' => 'autoplay',
		'value' => '-1',
		'description' => __( 'Enter value in seconds. Set -1 to disable autoplay.', 'js_composer' ),
		'group' => __( 'Pagination', 'js_composer' ),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'pagination' ),
		),
	),
	31 => array(
		'type' => 'animation_style',
		'heading' => __( 'Animation In', 'js_composer' ),
		'param_name' => 'paging_animation_in',
		'group' => __( 'Pagination', 'js_composer' ),
		'settings' => array(
			'type' => array(
				'in',
				'other',
			),
		),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'pagination' ),
		),
		'description' => __( 'Select "animation in" for page transition.', 'js_composer' ),
	),
	32 => array(
		'type' => 'animation_style',
		'heading' => __( 'Animation Out', 'js_composer' ),
		'param_name' => 'paging_animation_out',
		'group' => __( 'Pagination', 'js_composer' ),
		'settings' => array(
			'type' => array( 'out' ),
		),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'pagination' ),
		),
		'description' => __( 'Select "animation out" for page transition.', 'js_composer' ),
	),
	33 => array(
		'type' => 'vc_grid_item',
		'heading' => __( 'Grid element template', 'js_composer' ),
		'param_name' => 'item',
		'description' => sprintf( __( '%sCreate new%s template or %smodify selected%s. Predefined templates will be cloned.', 'js_composer' ), '<a href="' . esc_url( admin_url( 'post-new.php?post_type=vc_grid_item' ) ) . '" target="_blank">', '</a>', '<a href="#" target="_blank" data-vc-grid-item="edit_link">', '</a>' ),
		'group' => __( 'Item Design', 'js_composer' ),
		'value' => 'none',
	),
	34 => array(
		'type' => 'vc_grid_id',
		'param_name' => 'grid_id',
	),
	35 => array(
		'type' => 'textfield',
		'heading' => __( 'Extra class name', 'js_composer' ),
		'param_name' => 'el_class',
		'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
	),
	36 => array(
		'type' => 'css_editor',
		'heading' => __( 'CSS box', 'js_composer' ),
		'param_name' => 'css',
		'group' => __( 'Design Options', 'js_composer' ),
	),

	// Load more btn
	21 => array(
		'type' => 'hidden',
		'heading' => __( 'Button style', 'js_composer' ),
		'param_name' => 'button_style',
		'value' => '',
		'param_holder_class' => 'vc_colored-dropdown',
		'group' => __( 'Load More Button', 'js_composer' ),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'load-more' ),
		),
		'description' => __( 'Select button style.', 'js_composer' ),
	),
	22 => array(
		'type' => 'hidden',
		'heading' => __( 'Button color', 'js_composer' ),
		'param_name' => 'button_color',
		'value' => '',
		'param_holder_class' => 'vc_colored-dropdown',
		'group' => __( 'Load More Button', 'js_composer' ),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'load-more' ),
		),
		'description' => __( 'Select button color.', 'js_composer' ),
	),
	23 => array(
		'type' => 'hidden',
		'heading' => __( 'Button size', 'js_composer' ),
		'param_name' => 'button_size',
		'value' => '',
		'description' => __( 'Select button size.', 'js_composer' ),
		'group' => __( 'Load More Button', 'js_composer' ),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'load-more' ),
		),
	),
), $btn3_params );

$media_grid_params = array_merge( array(
	array(
		'type' => 'attach_images',
		'heading' => __( 'Images', 'js_composer' ),
		'param_name' => 'include',
		'description' => __( 'Select images from media library.', 'js_composer' ),
	),
	$grid_params[5],
	$grid_params[6],
	$grid_params[8],
	$grid_params[9],
	$grid_params[21],
	$grid_params[22],
	$grid_params[23],
	$grid_params[24],
	$grid_params[25],
	$grid_params[26],
	$grid_params[27],
	$grid_params[28],
	$grid_params[29],
	//$grid_params[30],
	$grid_params[31],
	array(
		'type' => 'vc_grid_item',
		'heading' => __( 'Grid element template', 'js_composer' ),
		'param_name' => 'item',
		'description' => sprintf( __( '%sCreate new%s template or %smodify selected%s. Predefined templates will be cloned.', 'js_composer' ), '<a href="' . esc_url( admin_url( 'post-new.php?post_type=vc_grid_item' ) ) . '" target="_blank">', '</a>', '<a href="#" target="_blank" data-vc-grid-item="edit_link">', '</a>' ),
		'group' => __( 'Item Design', 'js_composer' ),
		'value' => 'mediaGrid_Default',
	),
	array(
		'type' => 'vc_grid_id',
		'param_name' => 'grid_id',
	),
	array(
		'type' => 'css_editor',
		'heading' => __( 'CSS box', 'js_composer' ),
		'param_name' => 'css',
		'group' => __( 'Design Options', 'js_composer' ),
	),
), $btn3_params, array(
	// Load more btn bc
	array(
		'type' => 'hidden',
		'heading' => __( 'Button style', 'js_composer' ),
		'param_name' => 'button_style',
		'value' => '',
		'param_holder_class' => 'vc_colored-dropdown',
		'group' => __( 'Load More Button', 'js_composer' ),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'load-more' ),
		),
		'description' => __( 'Select button style.', 'js_composer' ),
	),
	array(
		'type' => 'hidden',
		'heading' => __( 'Button color', 'js_composer' ),
		'param_name' => 'button_color',
		'value' => '',
		'param_holder_class' => 'vc_colored-dropdown',
		'group' => __( 'Load More Button', 'js_composer' ),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'load-more' ),
		),
		'description' => __( 'Select button color.', 'js_composer' ),
	),
	array(
		'type' => 'hidden',
		'heading' => __( 'Button size', 'js_composer' ),
		'param_name' => 'button_size',
		'value' => '',
		'description' => __( 'Select button size.', 'js_composer' ),
		'group' => __( 'Load More Button', 'js_composer' ),
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'load-more' ),
		),
	),
) );
$media_grid_params[4]['std'] = '5';
