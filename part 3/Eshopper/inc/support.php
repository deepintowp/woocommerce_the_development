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

// remove archive product default sidebar

remove_action('woocommerce_sidebar','woocommerce_get_sidebar', 10);

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a> 
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

add_action('woocommerce_product_thumbnails', 'eshopper_add_carosuelon_product_page');

function eshopper_add_carosuelon_product_page(){
	?>
	<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item">
										  <a href=""><img src="<?php echo get_template_directory_uri () ;  ?>/images/product-details/similar1.jpg" alt=""></a>
										  
										</div>
										<div class="item active">
										  <a href=""><img src="<?php echo get_template_directory_uri () ;  ?>/images/product-details/similar1.jpg" alt=""></a>
										  
										</div>
										<div class="item">
										  <a href=""><img src="<?php echo get_template_directory_uri () ;  ?>/images/product-details/similar1.jpg" alt=""></a>
										  
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>
	<?php
}



