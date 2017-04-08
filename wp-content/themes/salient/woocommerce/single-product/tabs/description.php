<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $options;

$tab_pos = (!empty($options['product_tab_position']) && $options['product_tab_position'] == 'fullwidth') ? 'fullwidth': 'default';

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'woocommerce' ) ) );
?>

<?php if ( $heading && $tab_pos != 'fullwidth'): ?>
  <h2><?php echo $heading; ?></h2>
<?php endif; ?>

<?php the_content(); ?>
