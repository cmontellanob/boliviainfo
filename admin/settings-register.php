<?php // infobolivia - Register Settings



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// register plugin settings
function infobolivia_register_settings() {



	register_setting(
		'infobolivia_options',
		'infobolivia_options',
		'infobolivia_callback_validate_options'

	);



	add_settings_section(
		'infobolivia_section_admin',
		esc_html__('Customize Area', 'Boliviainfo'),
		'infobolivia_callback_section_admin',
		'infobolivia'
	);


	add_settings_field(
		'copiar',
		esc_html__('Copy News', 'infobolivia'),
		'infobolivia_callback_field_text',
		'infobolivia',
		'infobolivia_section_admin',
		[ 'id' => 'copiar', 'label' => esc_html__('Copy News ', 'BoliviaInfo') ]
	);

	add_settings_field(
		'custom_footer',
		esc_html__('Custom Footer', 'infobolivia'),
		'infobolivia_callback_field_text',
		'infobolivia',
		'infobolivia_section_admin',
		[ 'id' => 'custom_footer', 'label' => esc_html__('Custom footer text', 'BoliviaInfo') ]
	);

	add_settings_field(
		'custom_toolbar',
		esc_html__('Custom Toolbar', 'infobolivia'),
		'infobolivia_callback_field_checkbox',
		'infobolivia',
		'infobolivia_section_admin',
		[ 'id' => 'custom_toolbar', 'label' => esc_html__('Remove new post and comment links from the Toolbar', 'BoliviaInfo') ]
	);



}
add_action( 'admin_init', 'infobolivia_register_settings' );
