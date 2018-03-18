<?php

// register meta box
function boliviainfo_add_meta_box_recetas() {

	$post_types = array( 'Receta' );

	foreach ( $post_types as $post_type ) {

		add_meta_box(
			'boliviainfo_meta_box_recetas',         // Unique ID of meta box
			'boliviainfo Meta Box recetas',         // Title of meta box
			'boliviainfo_display_meta_box_recetas', // Callback function
			$post_type                   // Post type
		);

	}

}
add_action( 'add_meta_boxes', 'boliviainfo_add_meta_box_recetas' );



// display meta box
function boliviainfo_display_meta_box_recetas( $post ) {

	$value = get_post_meta( $post->ID, '_boliviainfo_meta_key', true );

	wp_nonce_field( basename( __FILE__ ), 'boliviainfo_meta_box_nonce' );

	?>

	<label for="boliviainfo-meta-box">Descripion de la opcion</label>
	<select id="boliviainfo-meta-box" name="boliviainfo-meta-box">
		<option value="">Select option...</option>
		<option value="option-1" <?php selected( $value, 'option-1' ); ?>>Option 1</option>
		<option value="option-2" <?php selected( $value, 'option-2' ); ?>>Option 2</option>
		<option value="option-3" <?php selected( $value, 'option-3' ); ?>>Option 3</option>
	</select>

<?php

}



// save meta box
function boliviainfo_save_meta_box( $post_id ) {

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );

	$is_valid_nonce = false;

	if ( isset( $_POST[ 'boliviainfo_meta_box_nonce' ] ) ) {

		if ( wp_verify_nonce( $_POST[ 'boliviainfo_meta_box_nonce' ], basename( __FILE__ ) ) ) {

			$is_valid_nonce = true;

		}

	}

	if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;

	if ( array_key_exists( 'boliviainfo-meta-box', $_POST ) ) {

		update_post_meta(
			$post_id,                                            // Post ID
			'_boliviainfo_meta_key',                                // Meta key
			sanitize_text_field( $_POST[ 'boliviainfo-meta-box' ] ) // Meta value
		);

	}

}
add_action( 'save_post', 'boliviainfo_save_meta_box' );
