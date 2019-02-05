<?php
function carolinaspa_setup() {
    add_image_size('blog_entry', 400, 257, true);
}
add_action('after_setup_theme', 'carolinaspa_setup');


// Add Stylesheets or Scripts
function carolinasp_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700,900|Lora:400,700');
}
add_action('wp_enqueue_scripts', 'carolinasp_scripts');


remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price');
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 35);

// function products_per_page($products) {
//     $products = 3;
//     return $products;
// }
// add_filter('loop_shop_per_page', 'products_per_page', 20);


// Remove the homepage content text and display the feature image

// function carolinaspa_homepage_content() {
//     remove_action('homepage', 'storefront_homepage_content');
//     add_action('homepage', 'carolinaspa_homepage_coupon', 10);
// }
// add_action('init', 'carolinaspa_homepage_content');
// 
// function carolinaspa_homepage_coupon() {
//     echo "<div class='main-content'>";
//     the_post_thumbnail();
//     echo "</div>";
// }

// Display Home Kits in the Homepage

function carolinaspa_homepage_homekits() { ?>
    <div class="homepage-home-kit-category">
        <div class="content">
            <div class="columns-3">
                    <?php $home_kit = get_term(17, 'product_cat', ARRAY_A); ?>
                    <h2 class="section-title"><?php echo $home_kit['name']; ?></h2>
                    <p><?php echo $home_kit['description']; ?></p>
                    <a href="<?php echo get_category_link($home_kit['term_id']); ?>">
                        All Products &raquo;
                    </a>
            </div>
            <?php echo do_shortcode('[product_category category="home-kits" per_page="3" orderby="price" order="asc" columns="9" ]'); ?>
        </div>
    </div>
    
<?php
}
add_action('homepage', 'carolinaspa_homepage_homekits', 25);

/** Banner with message**/
function carolinaspa_spoil_banner() { ?>
        <div class="banner-spoil">
            <div class="columns-4">
                <h3><?php the_field('banner_text'); ?></h3>
            </div>
            <div class="columns-8">
                <img src="<?php the_field('banner_image'); ?>">
            </div>
        </div>
    
<?php
}
add_action('homepage', 'carolinaspa_spoil_banner', 80);

/** Print Features with icons**/
function carolinaspa_display_features() { ?>
            </main>
        </div><!--#primary-->
    </div><!--.col-full-->
    <div class="home-features">
        <div class="col-full">
            <div class="columns-4">
                <?php the_field('feature_icon_1'); ?>
                <p><?php the_field('feature_content_1'); ?></p>
            </div>
            <div class="columns-4">
                <?php the_field('feature_icon_2'); ?>
                <p><?php the_field('feature_content_2'); ?></p>
            </div>
            <div class="columns-4">
                <?php the_field('feature_icon_3'); ?>
                <p><?php the_field('feature_content_3'); ?></p>
            </div>
        </div>
    </div>
    <div class="col-full">
        <div class="content-area">
            <div class="site-main">
<?php
}
add_action('homepage', 'carolinaspa_display_features', 15);

// Display 3 posts in the homepage

function carolinaspa_homepage_blog_entries() {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'orderby' => 'date', 
        'order'   => 'DESC'
    );
    $entries = new WP_Query($args);
    ?>
            
    <div class="homepage-blog-entries">
        <h2 class="section-title">Latest Blog Entries</h2>
        <ul>
            <?php while($entries->have_posts()): $entries->the_post(); ?>
                <li>
                    <?php the_post_thumbnail('blog_entry'); ?>
                    <h2 class="entry-title"><?php the_title(); ?></h2>
                    <div class="entry-content">
                        <header class="entry-header">
                            <p>By: <?php the_author(); ?> | <?php the_time(get_option('date_format')); ?>
                        </header>
                        <?php 
                            $content = wp_trim_words(get_the_content(), 20, '.');
                            echo "<p>" . $content . "</p>";
                        ?>
                        <a href="<?php the_permalink(); ?>" class="entry-link">Read more &raquo;</a>
                    </div>
                </li>
                
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>
        
    </div>
    
    <?php
}
add_action('homepage', 'carolinaspa_homepage_blog_entries', 90);

// Display Mailchimp in the homepage

function carolinaspa_display_mailchimp_form() { 
    
    if(is_page('welcome')):
    ?>
    <div class="mailchimp-form">
            <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
            <div id="mc_embed_signup">
                <form action="//easy-webdev.us11.list-manage.com/subscribe/post?u=b3bb37039b6fbf3db0c1a8331&amp;id=7e7988cfa9" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div id="mc_embed_signup_scroll" class="col-full">
                        <div class="columns-6">
                            <label for="mce-EMAIL">Subscribe to the newsletter <em>access to exclusive deals</em> </label>
                        </div>
                        <div class="columns-6 signup-form">
                                <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_b3bb37039b6fbf3db0c1a8331_7e7988cfa9" tabindex="-1" value=""></div>
                                <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                        </div>	
                    </div>
                </form>
            </div>
    </div>
    <?php
    endif;
}
add_action('storefront_before_footer', 'carolinaspa_display_mailchimp_form');

// Remove the Default WooCommerce Footer and create a new one!
function carolinaspa_footer() {
    remove_action('storefront_footer', 'storefront_credit', 20);
    add_action('storefront_after_footer', 'carolinaspa_new_footer_text', 20);
}
add_action('init', 'carolinaspa_footer');

function carolinaspa_new_footer_text() {
    echo "<div class='reserved'>";
    echo "<p>All Rights Reserved &copy; " . get_bloginfo('name') . " " . get_the_date('Y') . "</p>";
    echo "</div>";
}
// Display Currency in 3 code digits.
function carolinaspa_display_usd($symbol, $currency) {
        $symbol = $currency . " $";
        return $symbol;
}
add_filter('woocommerce_currency_symbol', 'carolinaspa_display_usd', 10, 2);

// Change the number of columns in Shop.
function carolinaspa_shop_columns($columns) {
    return 4;
}
add_filter('loop_shop_columns', 'carolinaspa_shop_columns', 20);

// Change the number of products per page
// function carolinaspa_products_per_page($products) {
//     $products = 4;
//     return $products;
// }
// add_filter('loop_shop_per_page', 'carolinaspa_products_per_page', 20);

// Change filter name

function carolinaspa_new_products_title_filter($orderby) {
    $orderby['date'] = __('New Products First');
    return $orderby;
}
add_filter('woocommerce_catalog_orderby', 'carolinaspa_new_products_title_filter', 40);

// Display a Placeholder image when no featured image is added
function carolinaspa_no_featured_image($image_url) {
    $image_url = get_stylesheet_directory_uri() . '/img/no-image.jpg';
    return $image_url;
}
add_filter('woocommerce_placeholder_img_src', 'carolinaspa_no_featured_image');

// Removes a tab in the single page product
// function carolinaspa_remove_description($tabs) {
//     unset($tabs['description']);
//     return $tabs;
// }
// add_filter('woocommerce_product_tabs', 'carolinaspa_remove_description', 20);
// Change the Title for the description tab
function carolinaspa_title_tab_description($tabs) {
    global $post;
    if($tabs['description']):
        $tabs['description']['title'] = $post->post_title;
    endif;  
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'carolinaspa_title_tab_description', 20);

function carolinaspa_title_tab_content_description($title) {
    global $post;
    $title = $post->post_title;
    return $title;
}
add_filter('woocommerce_product_description_heading','carolinaspa_title_tab_content_description' );

// Display a Subtitle in Single Products
function carolinaspa_display_subtitle_single_product() {
    global $post;
    $subtitle = get_field('subtitle', $post->ID);
    echo "<h3 class='subtitle'>" . $subtitle . "</h3>";
}
add_action('woocommerce_single_product_summary', 'carolinaspa_display_subtitle_single_product', 6);

// Add a new tab with a video
function carolinaspa_video_tab($tabs) {
    global $post;
    $video = get_field('video', $post->ID);
    if($video):
        $tabs['video'] = array(
            'title' => 'Video',
            'priority' => 5,
            'callback' => 'carolinaspa_display_video'
        );
    endif;
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'carolinaspa_video_tab', 11, 1);

function carolinaspa_display_video() {
    global $post;
    $video = get_field('video', $post->ID);
    if($video):
        echo '<video controls>';
        echo "<source src='". $video . "'>";
        echo "</video>";
    endif;
}
// Display savings as dollars
// function carolinaspa_saved_price_dollars($price, $product) {
//     if($product->get_sale_price() ): 
//         $saved = wc_price($product->get_regular_price() - $product->get_sale_price() ); 
//         return $price . sprintf( __('<br> <span class="save-amount"> Save: %s </span>', 'woocommerce' ), $saved );
//     endif;
//     
//     return $price;
// }
// add_filter('woocommerce_get_price_html', 'carolinaspa_saved_price_dollars', 10, 2);

// function carolinaspa_saved_price_percentage($price, $product) {
//     if($product->get_sale_price() ): 
//         $percentage = round( ( ($product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100);
//         return $price . sprintf( __('<br> <span class="save-amount"> Save: %s </span>', 'woocommerce' ), $percentage . "%" );
//     endif;
//     return $price;
// }
// add_filter('woocommerce_get_price_html', 'carolinaspa_saved_price_percentage', 10, 2);

function carolinaspa_display_savings($price, $product) {
    if($product->get_sale_price() ): 
        $regular_price = $product->get_regular_price();
        
        if($regular_price > 100) {
            $saved = wc_price($product->get_regular_price() - $product->get_sale_price() ); 
            return $price . sprintf( __('<br> <span class="save-amount"> Save: %s </span>', 'woocommerce' ), $saved );
        } else {
            $percentage = round( ( ($product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100);
            return $price . sprintf( __('<br> <span class="save-amount"> Save: %s </span>', 'woocommerce' ), $percentage . "%" );
        }
    endif;
    return $price;
}
add_filter('woocommerce_get_price_html', 'carolinaspa_display_savings', 10, 2);

/** Print Social Sharing Icons **/
function carolinaspa_display_sharing_buttons() { ?>
    <div class="addthis_inline_share_toolbox_8ctf"></div>
<?php
}
add_action('woocommerce_before_add_to_cart_form', 'carolinaspa_display_sharing_buttons');

function carolinaspa_include_addthis_scripts() { ?>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55c50cc67204ab8d"></script> 
<?php
}
add_action('wp_footer', 'carolinaspa_include_addthis_scripts');

/* Display banner in the cart page*/
function carolinaspa_display_banner_cart_page() {
    global $post;
    $image_url = get_field('banner', $post->ID);
    if($image_url): ?>
        <div class="coupon-cart">
            <img src="<?php echo $image_url ?>" alt="coupon">
        </div>
        
    <?php endif;
}
add_action('woocommerce_check_cart_items', 'carolinaspa_display_banner_cart_page');

// Display a button tu clear the cart

function carolinaspa_empty_cart_button() { ?>
    <a class="button" href="?empty-cart=true">Empty Cart</a>
<?php    
}
add_action('woocommerce_cart_actions', 'carolinaspa_empty_cart_button');

function carolinaspa_empty_cart() {
    if(isset($_GET['empty-cart'])):
        global $woocommerce;
        $woocommerce->cart->empty_cart();
    endif;
}
add_action('init', 'carolinaspa_empty_cart');

// Remove the Phone Field from Checkout
function carolinaspa_checkout_fields($fields) {
    unset($fields['billing']['billing_phone']);
    $fields['billing']['billing_email']['class'] = array('form-row-wide');
    
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'carolinaspa_checkout_fields', 20);

// Add extra fields to checkout

function carolinaspa_add_checkout_fields($fields) {

    $fields['billing']['itin'] = array(
        'css' => array('form-row-wide'),
        'label' => 'ITIN (Individual TaxPayer Identification Number)',
        'required' => true
    );
    $fields['order']['heard_about_us'] = array(
        'type' => 'select',
        'css' => array('form-row-wide'),
        'label' => 'How did you hear about us?',
        'options' => array(
            'default' => 'Choose...',
            'tv'    => 'Television',
            'radio' => 'Radio',
            'newspaper' => 'Newspaper',
            'internet'  => 'Internet',
            'facebook'  => 'Facebook'
        )
    );
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'carolinaspa_add_checkout_fields', 20);

/* Related Products in Blog*/
function carolinaspa_blog_related_products() {
    global $post;
    $related_products = get_field('related_products' ,$post->ID);
    
    if($related_products):
        $product_ids = join($related_products, ', '); ?>
        <div class="related-products">
            <h2 class="section-title">Related Products</h2>
            <?php echo do_shortcode('[products ids="'.$product_ids.'" columns="8"]') ?>
        </div>
    <?php endif;
}
add_action('storefront_post_content_after', 'carolinaspa_blog_related_products');









