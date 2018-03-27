<?php

// example widget class
class Recipts_Widget extends WP_Widget {

	// set up widget
	public function __construct() {

		$options = array(
			'classname' => 'recipts_widget',
			'description' =>__('Add ling to recips  about the Bolivian country','BoliviaInfo'),
		);

		parent::__construct( 'recips-widget', __('Recipts','Boliviainfo'), $options );

	}

	// output widget content
	public function widget( $args, $instance ) {

		if (isset($instance['title']))
		   $title=$instance['title'];
			 else {
			 	$title=__("Recipts","BoliviaInfo");
			 }
			 echo '<section id="receipts-2" class="widget widget_categories"><h2 class="widget-title">'.$title.'</h2>		<ul>';




		 $loop = new WP_Query( array( 'post_type' => 'recetas', 'posts_per_page' => 10 ) );
     $i=2;
		 while ( $loop->have_posts() ) : $loop->the_post();
        $i++;
		     echo  '<li class="cat-item cat-item-'.$i.'"><a href="' . get_permalink() . '"  rel="bookmark">'.the_title_attribute( 'echo=0' ).'</a></li>' ;
		    ?>
		<?php
		endwhile;
		if ($i==2)
		   echo "No hay recetas";
		echo "	</ul></section>";




	}

	// output widget form fields
	public function form( $instance ) {

		// outputs the widget form fields in the Admin Area
		if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
	}
	else {
	$title = __( 'receips', 'wpb_widget_domain' );
	}
	?>
	<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'title:' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>


	<?php
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
function recips_register_widget() {

	register_widget( 'Recipts_Widget' );

}
add_action( 'widgets_init', 'recips_register_widget' );
