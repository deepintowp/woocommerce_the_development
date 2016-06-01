<?php 

add_action( 'widgets_init', 'eshoppere_widgets_init' );
function eshoppere_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Shop Page Sidebar', 'theme-slug' ),
        'id' => 'sidebar-shop',
        'description' => __( 'Widgets in this area will be shown on Shop and product Category page.', 'theme-slug' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}