<?php  

function eshopper_style_nscripts(){
	wp_enqueue_style('bootstrap-css', get_template_directory_uri() .'/css/bootstrap.min.css', array(), '1.0', 'all' );
	wp_enqueue_style('font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css', array(), '1.0', 'all' );
	wp_enqueue_style('prettyPhoto-css', get_template_directory_uri() .'/css/prettyPhoto.css', array(), '1.0', 'all' );
	wp_enqueue_style('price-range-css', get_template_directory_uri() .'/css/price-range.css', array(), '1.0', 'all' );
	wp_enqueue_style('main-css', get_template_directory_uri() .'/css/main.css', array(), '1.0', 'all' );
	
	wp_enqueue_script('bootstrap-js', get_template_directory_uri() .'/js/bootstrap.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script('jquery-scrollUp', get_template_directory_uri() .'/js/jquery.scrollUp.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script('price-range-js', get_template_directory_uri() .'/js/price-range.js', array('jquery'), '1.0', true );
	wp_enqueue_script('prettyPhoto-js', get_template_directory_uri() .'/js/jquery.prettyPhoto.js', array('jquery'), '1.0', true );
	wp_enqueue_script('main-js', get_template_directory_uri() .'/js/main.js', array('jquery'), '1.0', true );
}
add_action('wp_enqueue_scripts', 'eshopper_style_nscripts');










