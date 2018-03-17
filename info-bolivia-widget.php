<?php
/*
Plugin Name: Informacion Bolivia
Description:  widget para contener los datos de bolivia.
Plugin URI:   https://something.com
Author:       Carlos David Montellano Barriga
Version:      1.0
*/



// example widget class
class Informacion_Bolivia_Widget extends WP_Widget {

	// set up widget
	public function __construct() {

		$options = array(
			'classname' => 'informacion_bolivia_widget',
			'description' => 'Añadeinformacion del plug in info bolivia referente a Bolivia  ',
		);

		parent::__construct( 'informacion-bolivia-widget', ' Informacion Bolivia', $options );

	}

	// output widget content
	public function widget( $args, $instance ) {

		// outputs the content of the widget
		Echo "Informacion de Bolivia"."<br/>";
		echo date("Y-m-d")."<br/>";
		$ch = curl_init();
		curl_setopt_array($ch, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'https://www.bcb.gob.bo/librerias/indicadores/dolar/bolsin.php',
		    CURLOPT_USERAGENT => 'cURL Request'
		));

		$informacion = curl_exec ($ch);
		$buscar= 'vigente desde el';
    $p= strpos($informacion,$buscar);
		$tabla=substr($informacion,$p+17);
		$buscar= '<strong>Bs</strong>';
		$p= strpos($tabla,$buscar);

		$tabla=substr($tabla,$p+18);



		$compra= substr($tabla,1,strpos($tabla,' por')-2);
    $p= strpos($tabla,$buscar);
		$tabla=substr($tabla,$p+17);

		$venta= substr($tabla,2,strpos($tabla,' por')-2);
		echo "compra:".$compra." x 1 U$<br/>";

		echo "venta:".$venta." x  1U$";

    //echo wp_kses_post();
		curl_close ($ch);
		//print_r($informacion);
		
	}

	// output widget form fields
	public function form( $instance ) {

		// outputs the widget form fields in the Admin Area

	}

	// process widget options
	public function update( $new_instance, $old_instance ) {

		// processes the widget options

	}

}

// register widget
function infobolivia_register_widget() {

	register_widget( 'Informacion_Bolivia_Widget' );

}
add_action( 'widgets_init', 'infobolivia_register_widget' );
