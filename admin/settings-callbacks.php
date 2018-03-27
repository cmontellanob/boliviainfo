<?php // infobolivia - Settings Callbacks



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// callback: admin section
function infobolivia_callback_section_admin() {

	echo '<p>'. esc_html__('These settings enable you to customize .', 'BoliviaInfo') .'</p>';

}



// callback: text field
function infobolivia_callback_field_text( $args ) {

	$options = get_option( 'infobolivia_options', infobolivia_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<input id="infobolivia_options_'. $id .'" name="infobolivia_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="infobolivia_options_'. $id .'">'. $label .'</label>';

}



// callback: radio field
function infobolivia_callback_field_radio( $args ) {

	$options = get_option( 'infobolivia_options', infobolivia_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	$radio_options = infobolivia_options_radio();

	foreach ( $radio_options as $value => $label ) {

		$checked = checked( $selected_option === $value, true, false );

		echo '<label><input name="infobolivia_options['. $id .']" type="radio" value="'. $value .'"'. $checked .'> ';
		echo '<span>'. $label .'</span></label><br />';

	}

}


// callback: checkbox field
function infobolivia_callback_field_checkbox( $args ) {

	$options = get_option( 'infobolivia_options', infobolivia_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';

	echo '<input id="infobolivia_options_'. $id .'" name="infobolivia_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
	echo '<label for="infobolivia_options_'. $id .'">'. $label .'</label>';

}
