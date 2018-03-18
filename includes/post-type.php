<?php

function boliviainfo_add_receta_post_type() {

	$labels = array(
		'name'                  => _x( 'Recetas', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Receta', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Recetas', 'text_domain' ),
		'name_admin_bar'        => __( 'Recetas', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Receta Padre:', 'text_domain' ),
		'all_items'             => __( 'Toas las Recetas', 'text_domain' ),
		'add_new_item'          => __( 'Añadir Nueva  Receta', 'text_domain' ),
		'add_new'               => __( 'Nueva Receta', 'text_domain' ),
		'new_item'              => __( 'Nuevo Item', 'text_domain' ),
		'edit_item'             => __( 'Editar Receta Editar', 'text_domain' ),
		'update_item'           => __( 'Atualizar Receta', 'text_domain' ),
		'view_item'             => __( 'Ver Receta', 'text_domain' ),
		'view_items'            => __( 'Ver Recetas', 'text_domain' ),
		'search_items'          => __( 'Buscar Recetas', 'text_domain' ),
		'not_found'             => __( 'No se enconetraron recetas', 'text_domain' ),
		'not_found_in_trash'    => __( 'No se enconetraron found en el basurero', 'text_domain' ),
		'featured_image'        => __( 'Iamgen caracteristica', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);

	$args = array(
		'label'                 => __( 'receta', 'text_domain' ),
		'description'           => __( 'REcetas information pages.', 'text_domain' ),
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'receta' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt','custom-fields' ),
		);

	register_post_type( 'receta', $args );

}
add_action( 'init', 'boliviainfo_add_receta_post_type' );
