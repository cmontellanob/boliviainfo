<?php // BoliviaInfo  - Settings Page



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// display the plugin settings page
function boliviainfo_settings_page() {

	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;

	?>

	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">

			<?php

			// output security fields
			settings_fields( 'infobolivia_options' );

			// output setting sections
			do_settings_sections( 'infobolivia' );

			// submit button
			submit_button();

			?>

		</form>
	</div>

	<?php

}



// display admin notices
function boliviainfo_admin_notices() {

	// get the current screen
	$screen = get_current_screen();

	// return if not infobolivia settings page
	if ( $screen->id !== 'toplevel_page_infobolivia' ) return;

	// check if settings updated
	if ( isset( $_GET[ 'settings-updated' ] ) ) {

		// if settings updated successfully
		if ( 'true' === $_GET[ 'settings-updated' ] ) :

		?>

			<div class="notice notice-success is-dismissible">
				<p><strong><?php _e( 'Congratulations, you are awesome!', 'BoliviaInfo' ); ?></strong></p>
			</div>

		<?php

		// if there is an error
		else :

		?>

			<div class="notice notice-error is-dismissible">
				<p><strong><?php _e( 'Houston, we have a problem.', 'BoliviaInfo' ); ?></strong></p>
			</div>

		<?php

		endif;

	}

}
add_action( 'admin_notices', 'boliviainfo_admin_notices' );
