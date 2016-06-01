<?php 

// Add woocommerce support
add_action( 'after_setup_theme', 'eshopper_woocommerce_support' );
function eshopper_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// remove breadcrumb

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// remove result count

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
//remove product archive ordering
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
//remove product archive rating
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action('woocommerce_after_shop_loop_item', 'eshopper_add_to_cart_button' );
function eshopper_add_to_cart_button(){
	?>
	<a rel="nofollow" href="/wc/shop/?add-to-cart=<?php get_the_ID(); ?>" data-quantity="1" data-product_id="<?php get_the_ID(); ?>" data-product_sku="" class="button product_type_simple add_to_cart_button ajax_add_to_cart">
		<i class="fa fa-shopping-cart"></i>
		Add to cart
	</a>
	<?php
}
// remove archive product default sidebar

remove_action('woocommerce_sidebar','woocommerce_get_sidebar', 10);