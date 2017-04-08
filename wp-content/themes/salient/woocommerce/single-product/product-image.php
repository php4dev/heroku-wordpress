<?php

/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $post, $product, $woocommerce, $options;

wp_enqueue_script('iosSlider');

if(!empty($options['single_product_gallery_type']) && $options['single_product_gallery_type'] == 'ios_slider') {

	$product_attach_ids = $product->get_gallery_attachment_ids(); ?>


    <div class="images">

    	<div class="iosSlider product-slider">

			<div class="slider">

				<?php if (has_post_thumbnail()) { 

					$img_link = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					
				?>
             
                <div class="slide">
                	<div class="easyzoom">
	                	<a href="<?php echo $img_link; ?>">
	                		<?php echo wp_get_attachment_image( get_post_thumbnail_id($post->ID), 'shop_single'); ?>
	                	</a>
	                </div>
                </div>
				
				<?php } else { 
					echo '<div class="slide">'.apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID ) .'</div>';
				}

				if ( $product_attach_ids ) {

					foreach ($product_attach_ids as $product_attach_id) {

						$img_link = wp_get_attachment_url( $product_attach_id );
			
						if (!$img_link)
							continue;

						printf( '<div class="slide"><div class="easyzoom"><a href="%s" title="%s"> %s </a></div></div>', wp_get_attachment_url($product_attach_id),get_post($product_attach_id)->post_title, wp_get_attachment_image($product_attach_id, 'shop_single'));
				
					}
				}
			?>
			
			</div>
         	
    		<div class="slider_controls">
				 <div class="nav_wrap">
		       		 <a href="#" class="prev_slide" onclick="return false;"><span class="icon-angle-left"></span></a>
		       		 <a href="#" class="next_slide" onclick="return false;"><span class="icon-angle-right"></span></a>
		        </div>
       		</div>
		</div>
		
	</div>

        		
	<?php if ( $product_attach_ids ) { 

		$img_size = get_option('shop_thumbnail_image_size'); ?>
        
        <div class="iosSlider product-thumbs" style="min-height:<?php echo ($img_size['height']).'px'; ?>!important">
			<div class ="slider">
                        <?php 	
                        
						$img_height = ($img_size['height']); 

                        if ( has_post_thumbnail() ) { ?>
                      	  <div class="thumb active" style="height:<?php echo $img_height . 'px'; ?>"><div class="thumb-inner"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ) ?></div></div>
                        <?php } 
						
						foreach ( $product_attach_ids as $product_attach_id) {

							$img_link = wp_get_attachment_url($product_attach_id);
				
							if ( !$img_link )
								continue;
							
							$img_size = wp_get_attachment_image($product_attach_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'));
							$classes = array();
							$image_class = esc_attr( implode(' ', $classes));
						
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="thumb"  style="height:'.$img_height.'px"><div class="thumb-inner">%s</div></div>', $img_size ), $product_attach_id, $post->ID, $image_class );
							
					
						} ?>
			</div>

        	 <div class="slider_controls">
				  <div class="nav_wrap">
		       		 <a href="#" onclick="return false;" class="prev_slide"><span class="icon-angle-left"></span></a>
		       		 <a href="#" onclick="return false;" class="next_slide"><span class="icon-angle-right"></span></a>
		        </div>
       		</div>
		</div>

    <?php } 



} 
//default lightbox functionality
else { ?>


	<div class="images">

	<?php
		if ( has_post_thumbnail() ) {
			$attachment_count = count( $product->get_gallery_attachment_ids() );
			$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	 => $props['title'],
				'alt'    => $props['alt'],
			) );
			echo apply_filters(
				'woocommerce_single_product_image_html',
				sprintf(
					'<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a>',
					esc_url( $props['url'] ),
					esc_attr( $props['caption'] ),
					$gallery,
					$image
				),
				$post->ID
			);
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>



<?php } ?>
 
