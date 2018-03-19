<?php

 function ver_tambien($content)
    {
        if(!is_singular('post'))
        {
            return $content;
        }else
        {
          // obtener elpost actual
          $current_post_id = get_the_ID();

          //opbetenrla categoria del post  Get the current post's category (first one if there's more than one).
          $current_post_cats = get_the_category();
          $current_post_first_cat_id = $current_post_cats[ 0 ]->term_id;

          $args = array(

            'cat' => $current_post_first_cat_id,

            'post__not_in' => array( $current_post_id )
          );
        //   print_r($args);

// Instantiate new query instance.
$taxonomy = 'category';

// Get the term IDs assigned to post.
$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

// Separator between links.
$separator = ', ';

if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {

    $term_ids = implode( ',' , $post_terms );

    $terms = wp_list_categories( array(
        'title_li' => '',
        'style'    => 'none',
        'echo'     => false,
        'taxonomy' => $taxonomy,
        'include'  => $term_ids
    ) );

    $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );

    // Display post categories.
   // echo  $terms;
    ///
$my_query = new WP_Query( $args );

//               $content=str_replace ($departamento ,'tendria que ser enlace',$content    );




// buscar post relacionados que pertenecen ala misma categoria
            $categorias=get_the_terms(get_the_ID(),"category");
          //  print_r($categorias);

            foreach($categorias as $categoria)
            {
                $arreglo[]=$categoria->term_id;
            }

            $loop=new WP_Query
            (
                array
                (
                    "category_in"=>$arreglo,
                    "posts_per_page"=>3,
                    'post_not_in'=>array(get_the_ID()),
                    'orderby'=>'rand'
                )
            );
            if($loop->have_posts())
            {
                $content.="Vea tambien ";
                $content.="<hr />";
                $content.="<ul>";
                    while($loop->have_posts())
                    {
                        $loop->the_post();
                        $content.= "<li>";
                        $content.='<a href="'.get_permalink().'">'.get_the_title().'</a>';
                        $content.= "</li>";
                    }
                $content.="</ul>";
            }
            wp_reset_query();
            return $content;
        }
    }
  }

// añadir
add_filter("the_content","ver_tambien");
