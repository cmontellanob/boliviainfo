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

$title = apply_filters( 'widget_title', $instance['title'] );

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
    echo "<hr/>";
    $ciudad='Tarija';
		curl_setopt_array($ch, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://api.openweathermap.org/data/2.5/weather?q='.$ciudad.',bo&appid=d8b17900f6f22b07db5ee898d85257e5&units=metric',
		    CURLOPT_USERAGENT => 'cURL Request'
		));

		$informacion = json_decode(curl_exec ($ch));

		echo $informacion->name.": Temperatura: ";
		echo $informacion->main->temp."C";

		echo "<hr/>";
		echo '<h3 "widget-title">Noticias Abi</h3>';
		curl_setopt_array($ch, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://www1.abi.bo/abi/paleta.php?nocache=.65465465&i=0&j=0',
		    CURLOPT_USERAGENT => 'cURL Request'
		));
		$informacion = curl_exec ($ch);


		$buscar='onclick=noticias(1,';
		$p= strpos($informacion,$buscar);
	  $base=substr($informacion,$p+19);
    //echo $base;
    //echo wp_kses_post();
		$numeronoticias=4;
    $i=0;
		?><ol><?php
		while ($p>0 and $i<$numeronoticias)
		{

			$i++;
      $p2=strpos($base,');>');
			$basenoticia=substr($base,$p2+2);
			$noticia= substr($basenoticia,1,strpos($basenoticia,'</div>')-1);
			$idnoticia= substr($base,1,$p2-2);
			echo '<li class="cat-item cat-item-1"><a href ="http://www1.abi.bo/abi/noticias.php?nocache=0.638743808147475&i=1&j='.$idnoticia.'" target="_blank">';
			echo $noticia."</a></li>";
			$p= strpos($base,$buscar);
			$base=substr($base,$p+19);
		}

		curl_close ($ch);
		//print_r($informacion);

	}

	// output widget form fields
	public function form( $instance ) {

		// outputs the widget form fields in the Admin Area
		if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
		}
		else {
		$title = __( 'New title', 'wpb_widget_domain' );
		}
		// Widget admin form
	}

	// process widget options
	public function update( $new_instance, $old_instance ) {

		// processes the widget options
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}

}

// register widget
function infobolivia_register_widget() {

	register_widget( 'Informacion_Bolivia_Widget' );

}
add_action( 'widgets_init', 'infobolivia_register_widget' );
