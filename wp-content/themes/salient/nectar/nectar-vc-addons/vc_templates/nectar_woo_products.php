<?php 


global $woocommerce_loop;

extract( shortcode_atts( array(
	'product_type' => 'all',
	'per_page' 	=> '12',
	'columns' 	=> '4',
	'carousel' 	=> 'false',
	'category' 	=> 'all',
	'controls_on_hover' => 'false'
), $atts ) );

//incase only all was selected
if($category == 'all') {
	$category = null;
}


if($product_type == 'all') {
	$meta_query = WC()->query->get_meta_query();

	$args = array(
		'post_type'				=> 'product',
		'post_status'			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' 		=> $per_page,
		'product_cat'           => $category,
		'meta_query' 			=> $meta_query
	);

} else if($product_type == 'sale') {

	$product_ids_on_sale = wc_get_product_ids_on_sale();

	$meta_query   = array();
	$meta_query[] = WC()->query->visibility_meta_query();
	$meta_query[] = WC()->query->stock_status_meta_query();
	$meta_query   = array_filter( $meta_query );

	$args = array(
		'posts_per_page'	=> $per_page,
		'post_status' 		=> 'publish',
		'post_type' 		=> 'product',
		'product_cat'       => $category,
		'meta_query' 		=> $meta_query,
		'post__in'			=> array_merge( array( 0 ), $product_ids_on_sale )
	);

} else if($product_type == 'featured') {

	$args = array(
			'post_type'				=> 'product',
			'post_status' 			=> 'publish',
			'product_cat'           => $category,
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $per_page,
			'meta_query'			=> array(
				array(
					'key' 		=> '_visibility',
					'value' 	=> array('catalog', 'visible'),
					'compare'	=> 'IN'
				),
				array(
					'key' 		=> '_featured',
					'value' 	=> 'yes'
				)
			)
		);

} else if($product_type == 'best_selling') {

	$args = array(
				'post_type' 			=> 'product',
				'post_status' 			=> 'publish',
				'ignore_sticky_posts'   => 1,
				'product_cat'           => $category,
				'posts_per_page'		=> $per_page,
				'meta_key' 		 		=> 'total_sales',
				'orderby' 		 		=> 'meta_value_num',
				'meta_query' 			=> array(
					array(
						'key' 		=> '_visibility',
						'value' 	=> array( 'catalog', 'visible' ),
						'compare' 	=> 'IN'
					)
				)
			);

}






ob_start();

$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>
	
	<?php if($carousel == '1') { ?> <div class="carousel-wrap products-carousel" data-controls="<?php echo $controls_on_hover ?>"> <?php } ?>

	<?php wc_get_template( 'loop/loop-start.php' ); ?>

		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

			<?php wc_get_template_part( 'content', 'product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php  wc_get_template( 'loop/loop-end.php' ); ?>

	<?php if($carousel == '1') { ?> </div> <?php } ?>

<?php endif;

wp_reset_postdata();

echo '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
	

?>