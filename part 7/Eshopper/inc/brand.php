<?php
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_brand_taxonomy', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_brand_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Brands', 'taxonomy general name' ),
		'singular_name'     => _x( 'Brand', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Brands' ),
		'all_items'         => __( 'All Brands' ),
		'parent_item'       => __( 'Parent Brand' ),
		'parent_item_colon' => __( 'Parent Brand:' ),
		'edit_item'         => __( 'Edit Brand' ),
		'update_item'       => __( 'Update Brand' ),
		'add_new_item'      => __( 'Add New Brand' ),
		'new_item_name'     => __( 'New Brand Name' ),
		'menu_name'         => __( 'Brand' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'brand' ),
	);

	


	register_taxonomy( 'brand', 'product', $args );
}


function cat_term_meta_scripts_n_style($hook){
	
	//var_dump($hook); //edit-tags.php term.php post
	
	if($typenow == 'product' && ($hook == 'edit-tags.php' ||  $hook == 'term.php' ) ){
		wp_enqueue_media();
		wp_enqueue_script('cat-term-img-js',  get_template_directory_uri() . '/js/cat_tmg.js', array('jquery') );
		
	}
	
	
}
add_action('admin_enqueue_scripts','cat_term_meta_scripts_n_style');
// form field add
function cat_img_term_meta(){
	wp_nonce_field(basename(__FILE__),'cat_img_nonce');
	?>
	<div class="form-field ">
		<label for="cat_term_img">Image</label>
		<input name="cat_term_img" id="cat_term_img" type="text" value="" size="40" aria-required="true">
		<div class="cat-img-con"></div>
		<input type="button" id="add_cat_img" class="button button-primary cat__img" value="Add Image" />
		<p>Add category Image</p>
	</div>
	<?php
}
add_action('brand_add_form_fields','cat_img_term_meta');
//edit function
function edit_cai_trm_img($term){
	wp_nonce_field(basename(__FILE__),'cat_img_nonce');
	
	
	if(get_term_meta($term->term_id, 'cat_term_img', true )):
	?>
	
	<tr class="form-field ">
			<th scope="row"><label for="cat_term_img">Name</label></th>
			<td><input name="cat_term_img" id="cat_term_img" type="text" value="<?php echo get_term_meta($term->term_id, 'cat_term_img', true ); ?>" size="40" aria-required="true">
			<div class="cat-img-con"> <img src="<?php echo get_term_meta($term->term_id, 'cat_term_img', true ); ?>" style="width:40%;" alt="" /></div>
			<input type="button" id="add_cat_img" class="button button-primary cat__img" value="Replae Image" />
			<input type="button" id="remove_cat_img" class="button button-primary " value="Remove Image" />
			<p>Add or remove category Image</p></td>
	</tr>
	<?php
	else: ?>
	<tr class="form-field ">
			<th scope="row"><label for="cat_term_img">Name</label></th>
			<td><input name="cat_term_img" id="cat_term_img" type="text" value="" size="40" aria-required="true">
			<div class="cat-img-con"> </div>
			<input type="button" id="add_cat_img" class="button button-primary cat__img" value="Add Image" />
			
			<p>Add category Image</p></td>
	</tr>
	<?php
	endif;
}
add_action('brand_edit_form_fields','edit_cai_trm_img');
//save function
function cat_img_save_meta($term_id){
	if(!isset($_POST['cat_img_nonce'])){
		return;
	}
	if(!wp_verify_nonce($_POST['cat_img_nonce'], basename(__FILE__) )){
		return;
	}
	if(isset($_POST['cat_term_img'])){
		update_term_meta($term_id, 'cat_term_img', esc_url_raw($_POST['cat_term_img']) );
	}
	
	
}
add_action('create_brand','cat_img_save_meta');
add_action('edit_brand','cat_img_save_meta');
