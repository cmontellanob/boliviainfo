<?php // infobolivia - Validate Settings



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

// callback: validate options
function infobolivia_callback_validate_options( $input ) {


	// custom footer
	if ( isset( $input['custom_footer'] ) ) {

		$input['custom_footer'] = sanitize_text_field( $input['custom_footer'] );

	}

	// custom footer
	if ( isset( $input['copiar'] ) ) {

		$input['copiar'] = sanitize_text_field( $input['copiar'] );

	}


	// custom toolbar
	if ( ! isset( $input['custom_toolbar'] ) ) {

		$input['custom_toolbar'] = null;

	}

	$input['custom_toolbar'] = ($input['custom_toolbar'] == 1 ? 1 : 0);


	return $input;

}
