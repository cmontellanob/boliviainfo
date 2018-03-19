<?php // MyPlugin - Admin Menu



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

class Info_Bolivia_Admin
{

function __construct(){
	add_action( 'admin_menu', array( $this, 'infobolivia_add_sublevel_menu' ) );
	add_action( 'admin_menu', array( $this, 'infobolivia_add_toplevel_menu' ) );

}
// add sub-level administrative menu
function infobolivia_add_sublevel_menu() {

	add_submenu_page(
		'options-general.php',
		esc_html__('infobolivia Opciones', 'infobolivia'),
		esc_html__('MyPlugin', 'myplugin'),
		'manage_options',
		'infobolivia',
		'myplugin_display_settings_page'
	);

}


// add top-level administrative menu
function infobolivia_add_toplevel_menu() {

	add_menu_page(
		esc_html__('InfoBolivia Settings', 'BoliviaInfo'),
		esc_html__('BoliviaInfo', 'boliviainfo'),
		'manage_options',
		'info-bolivia',
		'myplugin_display_settings_page',
		'dashicons-admin-generic',
		null
	);

}

}
 new Info_Bolivia_Admin;
