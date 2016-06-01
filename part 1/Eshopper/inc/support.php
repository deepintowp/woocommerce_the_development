<?php 


add_action( 'after_setup_theme', 'eshopper_woocommerce_support' );
function eshopper_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}