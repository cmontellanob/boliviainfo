<?php
/*
Plugin Name:  BoliviaInfo
Description:  Plug ing que permite mostrar informacion de Bolivia, como el clima, tipo de cambio, noticas mas importante
Plugin URI:   https://boliviainfo.com
Author:       Carlos David Montellano Barriga
Version:      1.0
Text Domain:  BoliviaInfo
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// load text domain
function boliviainfo_load_textdomain() {

	load_plugin_textdomain( 'myplugin', false, plugin_dir_path( __FILE__ ) . 'languages/' );

}
add_action( 'plugins_loaded', 'boliviainfo_load_textdomain' );



// include plugin dependencies: admin only
if ( is_admin() ) {

	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';

}



// include plugin dependencies: admin and public
require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/info-bolivia-widget.php'; // incluir widget



// default plugin options
function myplugin_options_default() {

	return array(
		'custom_url'     => 'https://boliviainfo.org/',
		'custom_title'   => esc_html__('Informacion Turisticade Bolivia', 'boliviainfo'),
		'custom_style'   => 'disable',
		'custom_message' => '<p class="custom-message">'. esc_html__('My custom message', 'myplugin') .'</p>',
		'custom_footer'  => esc_html__('Special message for users', 'myplugin'),
		'custom_toolbar' => false,
		'custom_scheme'  => 'default',
	);

}
