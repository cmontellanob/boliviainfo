<?php // MyPlugin - Core Functionality



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

add_action('init', 'set_styles_scripts');
function set_styles_scripts() {
    wp_register_style( 'boliviainfo',  plugins_url('../public/css/boliviainfo.css',__FILE__ ) );
    wp_enqueue_style( 'boliviainfo' );
    wp_register_script( 'boliviainfo', plugins_url('../public/js/boliviainfo.js',__FILE__ ));
		wp_enqueue_script('boliviainfo');
}


// custom login logo url
function myplugin_custom_login_url( $url ) {

	$options = get_option( 'myplugin_options', myplugin_options_default() );

	if ( isset( $options['custom_url'] ) && ! empty( $options['custom_url'] ) ) {

		$url = esc_url( $options['custom_url'] );

	}

	return $url;

}
//add_filter( 'login_headerurl', 'myplugin_custom_login_url' );



// custom login logo title
function myplugin_custom_login_title( $title ) {

	$options = get_option( 'myplugin_options', myplugin_options_default() );

	if ( isset( $options['custom_title'] ) && ! empty( $options['custom_title'] ) ) {

		$title = esc_attr( $options['custom_title'] );

	}

	return $title;

}
//add_filter( 'login_headertitle', 'myplugin_custom_login_title' );



// custom login styles
function myplugin_custom_login_styles() {

	$styles = false;

	$options = get_option( 'myplugin_options', myplugin_options_default() );

	if ( isset( $options['custom_style'] ) && ! empty( $options['custom_style'] ) ) {

		$styles = sanitize_text_field( $options['custom_style'] );

	}

	if ( 'enable' === $styles ) {

		/*

		wp_enqueue_style(
			string           $handle,
			string           $src = '',
			array            $deps = array(),
			string|bool|null $ver = false,
			string           $media = 'all'
		)

		wp_enqueue_script(
			string           $handle,
			string           $src = '',
			array            $deps = array(),
			string|bool|null $ver = false,
			bool             $in_footer = false
		)

		*/

		wp_enqueue_style( 'myplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/myplugin-login.css', array(), null, 'screen' );

		wp_enqueue_script( 'myplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/myplugin-login.js', array(), null, true );

	}

}
//add_action( 'login_enqueue_scripts', 'myplugin_custom_login_styles' );



// custom login message
function myplugin_custom_login_message( $message ) {

	$options = get_option( 'myplugin_options', myplugin_options_default() );

	if ( isset( $options['custom_message'] ) && ! empty( $options['custom_message'] ) ) {

		$message = wp_kses_post( $options['custom_message'] ) . $message;

	}

	return $message;

}
//add_filter( 'login_message', 'myplugin_custom_login_message' );



// custom admin footer
function myplugin_custom_admin_footer( $message ) {

	$options = get_option( 'myplugin_options', myplugin_options_default() );

	if ( isset( $options['custom_footer'] ) && ! empty( $options['custom_footer'] ) ) {

		$message = sanitize_text_field( $options['custom_footer'] );

	}

	return $message;

}
//add_filter( 'admin_footer_text', 'myplugin_custom_admin_footer' );



// custom toolbar items
function myplugin_custom_admin_toolbar() {

	$toolbar = false;

	$options = get_option( 'myplugin_options', myplugin_options_default() );

	if ( isset( $options['custom_toolbar'] ) && ! empty( $options['custom_toolbar'] ) ) {

		$toolbar = (bool) $options['custom_toolbar'];

	}

	if ( $toolbar ) {

		global $wp_admin_bar;

		$wp_admin_bar->remove_menu( 'comments' );
		$wp_admin_bar->remove_menu( 'new-content' );

	}

}
//add_action( 'wp_before_admin_bar_render', 'myplugin_custom_admin_toolbar', 999 );



// custom admin color scheme
function myplugin_custom_admin_scheme( $user_id ) {

	$scheme = 'default';

	$options = get_option( 'myplugin_options', myplugin_options_default() );

	if ( isset( $options['custom_scheme'] ) && ! empty( $options['custom_scheme'] ) ) {

		$scheme = sanitize_text_field( $options['custom_scheme'] );

	}

	$args = array( 'ID' => $user_id, 'admin_color' => $scheme );

	wp_update_user( $args );

}
//add_action( 'user_register', 'myplugin_custom_admin_scheme' );
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
