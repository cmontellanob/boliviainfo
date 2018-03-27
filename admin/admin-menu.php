<?php // infobolivia - Admin Menu



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

class Info_Bolivia_Admin
{

function __construct(){

	add_action( 'admin_menu', array( $this, 'infobolivia_add_toplevel_menu' ) );

}


// add top-level administrative menu
function infobolivia_add_toplevel_menu() {

	add_menu_page(
		esc_html__('InfoBolivia Settings', 'boliviainfo'),
		esc_html__('BoliviaInfo', 'boliviainfo'),
		'manage_options',
		'info-bolivia',
		'boliviainfo_settings_page',
		'dashicons-admin-generic',
		null
	);

}

}
 new Info_Bolivia_Admin;
