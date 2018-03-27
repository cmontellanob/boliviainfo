<?php
class Recetas_Info_Meta_Box {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
		add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

		add_meta_box(
			'receta_info',
			__( 'Recipe Information', 'BoliviaInfo' ),
			array( $this, 'render_metabox' ),
			'recetas',   //este debe coincidir con el post-type
			'advanced',
			'default'
		);

	}

	public function render_metabox( $post ) {

			// Recuperar valores de la base de datos
		$ingredientes = get_post_meta( $post->ID, 'ingredientes', true );
		$preparacion = get_post_meta( $post->ID, 'preparacion', true );
		$es_picante = get_post_meta( $post->ID, 'es_picante', true );
		$condimentos = get_post_meta( $post->ID, 'condimentos', true );
		$acompanantes = get_post_meta( $post->ID, 'acompanantes', true );

		// poner los valores por defecto
		if( empty( $ingredientes ) ) $ingredientes = '';
		if( empty( $preparacion ) ) $preparacion = '';
		if( empty( $es_picante ) ) $es_picante = '';
		if( empty( $condimentos ) ) $condimentos = '';
		if( empty( $acompanantes ) ) $acompanantes = '';

		// Form .
		echo '<table class="form-table">';
    echo '<div id="Ingredientes" class="tabcontent">';
		echo '	<tr>';
		echo '		<th><label for="ingredientes" class="ingredients_label">' . __( 'Ingredients', 'BoliviaInfo' ) . '</label></th>';
		echo '		<td>';
		echo '			<textarea rows="5" cols="80" id="ingredientes" name="ingredientes" class="ingredientes_field" placeholder="' . esc_attr__( '', 'BoliviaInfo' ) . '"  ">';
    echo esc_attr__( $ingredientes );
    echo '      </textarea>';
    echo '		</td>';
		echo '	</tr>';
		echo '</div>';
		echo '	<tr>';
		echo '		<th><label for="preparacion" class="preparacion_label">' . __( 'Preparation', 'BoliviaInfo' ) . '</label></th>';
		echo '		<td>';
		echo '			<textarea rows="5" cols="80" id="preparacion" name="preparacion" class="preparacion_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '">';
    echo esc_attr__( $preparacion );
    echo '      </textarea>';
    echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="es_picante" class="es_picante_label">' . __( 'It is spicy', 'BoliviaInfo' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="checkbox" id="es_picante" name="es_picante" class="es_picante_field" value="' . $es_picante . '" ' . checked( $es_picante, 'checked', false ) . '> ' . __( 'It is spicy', 'text_domain' );
		echo '			<span class="description">' . __( 'The recipe includes spicy.', 'BoliviaInfo' ) . '</span>';
		echo '		</td>';
		echo '	</tr>';

    echo'	<tr>';
		echo '		<th><label for="condimentos" class="condimentos_label">' . __( 'Condiments', 'BoliviaInfo' ) . '</label></th>';
		echo '		<td>';
		echo '			<textarea rows="5" cols="50" id="condimentos" name="condimentos" class="condimentos_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '"  >';
    echo esc_attr__( $condimentos );
    echo '      </textarea>';
    echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="acompanantes" class="acompanantes_label">' . __( 'Accompaniments', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<textarea rows="5" cols="50" id="acompanantes" name="acompanantes" class="acompanantes_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '"  >';
    echo esc_attr__( $acompanantes );
    echo '      </textarea>';
    echo '		</td>';
		echo '	</tr>';
    wp_nonce_field( 'boliviainfo_form_action', 'boliviainfo_meta_box_nonce', false );



	}

	public function save_metabox( $post_id, $post ) {

 /*  $is_autosave = wp_is_post_autosave( $post_id );
  	$is_revision = wp_is_post_revision( $post_id );

  	$is_valid_nonce = false;

  	if ( isset( $_POST[ 'boliviainfo_meta_box_nonce' ] ) ) {

  		if ( wp_verify_nonce( $_POST[ 'boliviainfo_meta_box_nonce' ], basename( __FILE__ ) ) ) {

  			$is_valid_nonce = true;

  		}

  	}

  	if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;
*/

    $ingredientes = get_post_meta( $post->ID, 'ingredientes', true );
    $preparacion = get_post_meta( $post->ID, 'preparacion', true );
    $es_picante = get_post_meta( $post->ID, 'es_picante', true );
    $condimentos = get_post_meta( $post->ID, 'condimentos', true );
    $acompanantes = get_post_meta( $post->ID, 'acompanantes', true );

		// Sanitize user input.
		$ingredientes = isset( $_POST[ 'ingredientes' ] ) ? sanitize_text_field( $_POST[ 'ingredientes' ] ) : '';
		$preparacion = isset( $_POST[ 'preparacion' ] ) ? sanitize_text_field( $_POST[ 'preparacion' ] ) : '';
		$es_picante = isset( $_POST[ 'es_picante' ] ) ? 'checked' : '';
    $condimentos = isset( $_POST[ 'condimentos' ] ) ? sanitize_text_field( $_POST[ 'condimentos' ] ) : '';
		$acompanantes = isset( $_POST[ 'acompanantes' ] ) ? sanitize_text_field( $_POST[ 'acompanantes' ] ) : '';
		// Update the meta field in the database.
		update_post_meta( $post_id, 'ingredientes', $ingredientes );
		update_post_meta( $post_id, 'preparacion', $preparacion );
		update_post_meta( $post_id, 'es_picante', $es_picante );
		update_post_meta( $post_id, 'condimentos', $condimentos );
		update_post_meta( $post_id, 'acompanantes', $acompanantes );

	}

}

new Recetas_Info_Meta_Box;
