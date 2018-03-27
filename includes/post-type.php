<?php
class post_receta {
	public function __construct() {
      add_action( 'init',array($this,'boliviainfo_add_receta_post_type') );
  }
function boliviainfo_add_receta_post_type() {

	$labels = array(
		'name'                  => _x( 'Recipes', 'Post Type General Name', 'BoliviaInfo' ),
		'singular_name'         => _x( 'Recipe', 'Post Type Recipesular Name', 'BoliviaInfo' ),
		'menu_name'             => __( 'Recipes', 'BoliviaInfo' ),
		'name_admin_bar'        => __( 'Recipes', 'BoliviaInfo' ),
		'archives'              => __( 'Item Archives', 'BoliviaInfo' ),
		'attributes'            => __( 'Item Attributes', 'BoliviaInfo' ),
		'parent_item_colon'     => __( 'Parent Item:', 'BoliviaInfo' ),
		'all_items'             => __( 'All Items', 'BoliviaInfo' ),
		'add_new_item'          => __( 'Add New Item', 'BoliviaInfoo'),
		'add_new'               => __( 'Add New', 'BoliviaInfo' ),
		'new_item'              => __( 'New Item', 'BoliviaInfo' ),
		'edit_item'             => __( 'Edit Item', 'BoliviaInfo' ),
		'update_item'           => __( 'Update Item', 'BoliviaInfo' ),
		'view_item'             => __( 'View Item', 'BoliviaInfo' ),
		'view_items'            => __( 'View Items', 'BoliviaInfo' ),
		'search_items'          => __( 'Search Item', 'BoliviaInfo' ),
		'not_found'             => __( 'Not found', 'BoliviaInfo' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'BoliviaInfo' ),
		'featured_image'        => __( 'Featured Image', 'BoliviaInfo' ),
		'set_featured_image'    => __( 'Set featured image', 'BoliviaInfo' ),
		'remove_featured_image' => __( 'Remove featured image', 'BoliviaInfo' ),
		'use_featured_image'    => __( 'Use as featured image', 'BoliviaInfo' ),
		'insert_into_item'      => __( 'Insert into item', 'BoliviaInfo' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'BoliviaInfo' ),
		'items_list'            => __( 'Items list', 'BoliviaInfo' ),
		'items_list_navigation' => __( 'Items list navigation', 'BoliviaInfo' ),
		'filter_items_list'     => __( 'Filter items list', 'BoliviaInfo' ),
	);

	$args = array(
		'label'                 => __( 'Recipes', 'BoliviaInfo' ),
		'description'           => __( 'Recipes information pages.', 'BoliviaInfo' ),
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'recetas' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		);

	register_post_type( 'recetas', $args ); //este es el nombre importante para los meta-box

}
}
new post_receta;
