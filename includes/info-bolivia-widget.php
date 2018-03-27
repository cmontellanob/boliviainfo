<?php

// example widget class
class Informacion_Bolivia_Widget extends WP_Widget {

	// set up widget
	public function __construct() {

		$options = array(
			'classname' => 'informacion_bolivia_widget',
			'description' =>__('Add information about the Bolivian country','BoliviaInfo'),
		);

		parent::__construct( 'informacion-bolivia-widget', __('Bolivian information','Boliviainfo'), $options );

	}

	// output widget content
	public function widget( $args, $instance ) {

if (isset($instance['ciudad']))
   $ciudad=$instance['ciudad'];
	 else {
	 	$ciudad="Sucre";
	 }
	 if (isset($instance['nronoticias']))
	    $nronoticias=$instance['nronoticias'];
	 	 else {
	 	 	$nronoticias=5;
	 	 }
if ( isset( $instance['mostrarmaxmin'] ) )
		 $mostrarmaxmin = $instance['mostrarmaxmin'];
   else {
   	$mostrarmaxmin ="no";
   }
		echo esc_html__("Bolivia Information","BoliviaInfo")."<br/>";
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
		echo esc_html__("buy:","BoliviaInfo").$compra." x 1 U$<br/>";

		echo esc_html__("sell:","BoliviaInfo").$venta." x  1U$";
    echo "<hr/>";
   // $ciudad='Tarija';
		curl_setopt_array($ch, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://api.openweathermap.org/data/2.5/weather?q='.$ciudad.',bo&appid=d8b17900f6f22b07db5ee898d85257e5&units=metric',
		    CURLOPT_USERAGENT => 'cURL Request'
		));

		$informacion = json_decode(curl_exec ($ch));

		echo $informacion->name.esc_html__(": Temperature: ","BoliviaInfo");
		echo $informacion->main->temp."C";
    if ($mostrarmaxmin=='si')
		{
			echo "<br/>Max:". $informacion->main->temp_min."C Min:". $informacion->main->temp_max."C";
		}



		echo "<hr/>";
		echo '<h3 "widget-title">'.esc_html__('Abi News','BoliviaInfo').'</h3>';
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
		//$numeronoticias=4;
    $i=0;
		?><ol><?php
		while ($p>0 and $i<$nronoticias)
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
		if ( isset( $instance[ 'ciudad' ] ) ) {
	$ciudad = $instance[ 'ciudad' ];
	}
	else {
	$ciudad = __( 'Sucre', 'wpb_widget_domain' );
	}
	if ( isset( $instance[ 'nronoticias' ] ) ) {
$nronoticias = $instance[ 'nronoticias' ];
}
else {
$nronoticias = __( '4', 'wpb_widget_domain' );
}
if ( isset( $instance[ 'mostrarmaxmin' ] ) ) {
$mostrarmaxmin = $instance[ 'mostrarmaxmin' ];
}
else {
$mostrarmaxmin = 'no';
}


	// Widget admin form
  $ciudades=array('Sucre','La Paz','Cochabamba','Oruro','Potosi','Tarija','Santa Cruz de la Sierra','Trinidad','Cobija');
	?>
	<p>
	<label for="<?php echo $this->get_field_id( 'ciudad' ); ?>"><?php _e( 'Ciudad:' ); ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id( 'ciudad' ); ?>" name="<?php echo $this->get_field_name( 'ciudad' ); ?>"  />
 <?php foreach ($ciudades as $localidad)
 {?>
	<option <?php if ($localidad==$ciudad) echo 'selected="selected"'; ?>  ><?php echo $localidad  ?></option>
<?php } ?>
	</select>

	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'nronoticias' ); ?>"><?php _e( 'Nro noticias visualizar:' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'nronoticias' ); ?>" name="<?php echo $this->get_field_name( 'nronoticias' ); ?>" type="text" value="<?php echo esc_attr( $nronoticias ); ?>" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'mostrarmaxmin' ); ?>"><?php _e( 'Mostrar Temperaturas Max Min' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'mostrarmaxmin' ); ?>" name="<?php echo $this->get_field_name( 'mostrarmaxmin' ); ?>" type="checkbox" <?php if ($mostrarmaxmin=='si') echo "checked"; ?>" value="si"  />
	</p>


	<?php
	}

	// process widget options
	public function update( $new_instance, $old_instance ) {

		// processes the widget options
		$instance = array();
		$instance['ciudad'] = ( ! empty( $new_instance['ciudad'] ) ) ? strip_tags( $new_instance['ciudad'] ) : '';
		$instance['nronoticias'] = ( ! empty( $new_instance['nronoticias'] ) ) ? strip_tags( $new_instance['nronoticias'] ) : '';
		$instance['mostrarmaxmin'] = ( ! empty( $new_instance['mostrarmaxmin'] ) ) ? strip_tags( $new_instance['mostrarmaxmin'] ) : '';

		return $instance;
	}

}

// register widget
function infobolivia_register_widget() {

	register_widget( 'Informacion_Bolivia_Widget' );

}
add_action( 'widgets_init', 'infobolivia_register_widget' );
