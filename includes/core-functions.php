<?php // infobolivia - Core Functionality



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}


// añadiendo estilos y js propios del plug in
add_action('init', 'set_styles_scripts');
function set_styles_scripts() {
    wp_register_style( 'boliviainfo',  plugins_url('../public/css/boliviainfo.css',__FILE__ ) );
    wp_enqueue_style( 'boliviainfo' );
    wp_register_script( 'boliviainfo', plugins_url('../public/js/boliviainfo.js',__FILE__ ));
		wp_enqueue_script('boliviainfo');
}

function get_cotizacion(&$compra,&$venta)
{
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
	curl_close ($ch);
}



// custom admin footer
function infobolivia_custom_admin_footer( $message ) {

	$options = get_option( 'infobolivia_options', infobolivia_options_default() );

	if ( isset( $options['custom_footer'] ) && ! empty( $options['custom_footer'] ) ) {

		$message = sanitize_text_field( $options['custom_footer'] );

	}

	return $message;

}
add_filter( 'admin_footer_text', 'infobolivia_custom_admin_footer' );



// custom toolbar items
function infobolivia_custom_admin_toolbar() {

	$toolbar = false;

	$options = get_option( 'infobolivia_options', infobolivia_options_default() );

	if ( isset( $options['custom_toolbar'] ) && ! empty( $options['custom_toolbar'] ) ) {

		$toolbar = (bool) $options['custom_toolbar'];

	}

	if ( $toolbar ) {

		global $wp_admin_bar;

		$wp_admin_bar->remove_menu( 'comments' );
		$wp_admin_bar->remove_menu( 'new-content' );

	}

}
add_action( 'wp_before_admin_bar_render', 'infobolivia_custom_admin_toolbar', 999 );


// añadir las categorias para BOlivia
function insert_categories() {
if(!term_exists('Chuquisaca')) {
    wp_insert_term(
        'Chuquisaca',
        'category',
        array(
          'description' => 'Departamento de Chuquisaca',
          'slug'        => 'chuquisaca'
        )
    );
  }
	if(!term_exists('La Paz')) {
	    wp_insert_term(
	        'La Paz',
	        'category',
	        array(
	          'description' => 'Departamento de La Paz',
	          'slug'        => 'lapaz'
	        )
	    );
	  }
		if(!term_exists('Cochabamba')) {
		    wp_insert_term(
		        'Cochabamba',
		        'category',
		        array(
		          'description' => 'Departamento de Cochabamba',
		          'slug'        => 'cochabamba'
		        )
		    );
		  }
			if(!term_exists('Oruro')) {
			    wp_insert_term(
			        'Oruro',
			        'category',
			        array(
			          'description' => 'Departamento de Oruro',
			          'slug'        => 'oruro'
			        )
			    );
			  }
				if(!term_exists('Potosi')) {
				    wp_insert_term(
				        'Potosi',
				        'category',
				        array(
				          'description' => 'Departamento de Potosi',
				          'slug'        => 'potosi'
				        )
				    );
				  }
					if(!term_exists('Tarija')) {
					    wp_insert_term(
					        'Tarija',
					        'category',
					        array(
					          'description' => 'Departamento de Tarija',
					          'slug'        => 'tarija'
					        )
					    );
					  }
						if(!term_exists('Santa Cruz')) {
						    wp_insert_term(
						        'Santa Cruz',
						        'category',
						        array(
						          'description' => 'Departamento de Santa Cruz',
						          'slug'        => 'santacruz'
						        )
						    );
						  }
							if(!term_exists('Beni')) {
							    wp_insert_term(
							        'Beni',
							        'category',
							        array(
							          'description' => 'Departamento de Beni',
							          'slug'        => 'beni'
							        )
							    );
							  }
								if(!term_exists('Pando')) {
								    wp_insert_term(
								        'Pando',
								        'category',
								        array(
								          'description' => 'Departamento de Pando',
								          'slug'        => 'pando'
								        )
								    );
								  }
 }
add_action( 'plugins_loaded', 'insert_categories' );

// Create post object
$my_post = array(
  'post_title'    => wp_strip_all_tags( $_POST['post_title'] ),
  'post_content'  => $_POST['post_content'],
  'post_status'   => 'publish',
  'post_author'   => 1,
  'post_category' => array( 8,39 )
);

// Insert the post into the database
wp_insert_post( $my_post );
