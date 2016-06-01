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
//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

add_action('woocommerce_product_thumbnails', 'eshopper_add_carosuelon_product_page');

function eshopper_add_carosuelon_product_page(){
	global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();
		if($attachment_ids):
	
	?>
						<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
									<?php 
										$i = 0;
										foreach($attachment_ids as $attachment_id ):
										$image_link = wp_get_attachment_url( $attachment_id );
										?> <div class="item  <?php if( $i == 0 ){ echo 'active';} ?>">
										  <img src="<?php echo $image_link;  ?>" alt="">
										  
										</div>
										<?php $i++;  endforeach; ?>
										
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
	
	endif;
}

/**
				 * woocommerce_single_product_summary hook.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 do_action( 'woocommerce_single_product_summary' );
				 */
		function eshopper_get_sku_after_title(){
			global $product;
			$sku = $product->get_sku();
			$sku_num = ( $sku ? $sku : 'N/A' );
			?>
			<div class="custom-sku"> 
			<?php    _e('Web Id: ', 'eshopper');  echo $sku_num; ?>
			</div>
		<?php 
			
		}		

add_action('woocommerce_single_product_summary', 'eshopper_get_sku_after_title', 6 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
function eshopper_product_ava (){
	global $product;
	
	$isstock = ($product->is_in_stock( ) ? 'Yes': 'No');
	echo '<div class="eshopper-aval">';
	_e('Availability: ','eshopper' );  echo $isstock;
	echo '</div>';
}
add_action('woocommerce_single_product_summary', 'eshopper_product_ava', 39 );


function custom_socialshare(){
	?>
	<div class="shoiacl-product"> 
		<a class="btn btn-primary " href=""> <i class="fa fa-facebook"></i> Facebook </a>
		<a class="btn btn-primary " href=""> <i class="fa fa-google-plus"></i> Google Plus </a>
		
	
	</div>
	<?php 
}
add_action('woocommerce_single_product_summary', 'custom_socialshare', 50 );





