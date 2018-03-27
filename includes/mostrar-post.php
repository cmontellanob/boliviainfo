<?php
class Mostrar_Post
{
  public function __construct() {
      add_filter("the_content",array( $this,"mostrar"));
  }
function ver_tambien($content)
{
  // obtener elpost actual
echo plugin_dir_path( __FILE__ ) . 'languages/';
  $current_post_id = get_the_ID();
  $categories = get_the_category();

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
$post_terms = wp_get_object_terms( $current_post_id, $taxonomy, array( 'fields' => 'ids' ) );
 //print_r($post_terms);
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
        $content.=__("View also","BoliviaInfo");
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

}
   echo  $content;

}

function mostrar_galeria($content)
{
  $cadena=substr($content,strpos($content,'"')+1);

  $cadena=substr($cadena,0,strlen($cadena)-3);

  $idsimgen=explode(",",$cadena);
  echo '<div class="row">';
  $i=0;

  foreach ($idsimgen as $id)
  {
    $i++;
   $image = wp_get_attachment_image_src($id,'thumbnail',true);
   echo '<div class="column">';
   echo '<img src="'.$image[0].'" onclick="openModal();currentSlide('.$i.')" class="hover-shadow">';
   echo '</div>';
  }
  echo '</div>';
$j=$i;

  ?>
<!-- The Modal/Lightbox -->
<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">
    <?php $i=0;
  foreach ($idsimgen as $id)
  { $i++;
    $image = wp_get_attachment_image_src($id,'medium',true); ?>
    <div class="mySlides">
      <div class="numbertext"><?php echo $i. '/'.$j; ?></div>
      <img src="<?php echo $image[0] ?>" style="width:100%">
    </div>
<?php } ?>
         <!-- Next/previous controls -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <!-- Caption text -->
    <div class="caption-container">
      <p id="caption"></p>
    </div>

    <!-- Thumbnail image controls -->
    <?php  $i=0;
   foreach ($idsimgen as $id)
   {$i++;
     $image = wp_get_attachment_image_src($id,'thumbnail',true); ?>
    <div class="column">
      <img class="demo" src="<?php echo $image[0] ?>" onclick="currentSlide(<?php echo $i;?>)" alt="Nature">
    </div>
 <?php } ?>

  </div>
</div>
<?php
}

function mostrar($content)
 {
 if(!is_singular('post'))
   {
    return $content;
   }else
   {
    $pos = strpos($content,'gallery ids');
    if ($pos>0)
       $this->mostrar_galeria($content);
    else
       $this->ver_tambien($content);
   }
  }
}
new  Mostrar_Post;
