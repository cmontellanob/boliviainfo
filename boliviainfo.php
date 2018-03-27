<?php
/*
@link         https://github.com/cmontellanob/boliviainfo
@since        1.0.0
@package      Bolivia_info
Plugin Name:  BoliviaInfo
Description:  Plug ing to permites to show information of Bolivia, as the weather, type of change money bolivian , news more important
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

	load_plugin_textdomain( 'BoliviaInfo', false,basename( dirname( __FILE__ ) ) . '/languages' );

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
require_once plugin_dir_path( __FILE__ ) . 'includes/recipts-widget.php'; // incluir widget
require_once plugin_dir_path( __FILE__ ) . 'includes/mostrar-post.php'; // mostrar post
require_once plugin_dir_path( __FILE__ ) . 'includes/post-type.php'; // incluir widget
require_once plugin_dir_path( __FILE__ ) . 'includes/meta-box-recetas.php'; // incluir widget



// default plugin options
function infobolivia_options_default() {

	return array(
		'custom_footer'  => esc_html__('Special message for users', 'BoliviaInfo'),
		'custom_toolbar' => false,
		'custom_copy' => 5,
	);

}
