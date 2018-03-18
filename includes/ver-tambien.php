<?php

 function ver_tambien($content)
    {
        if(!is_singular('post'))
        {
            return $content;
        }else
        {
            $departamentos=array('Chuquisaca','La Paz','Cochabamba','Oruro','Potosi','Santa Cruz','Beni','Pando');

            foreach ($departamentos as $departamento)
            {

               $content=str_replace ($departamento ,'tendria que ser enlace',$content    );

            }


// buscar post relacionados que pertenecen ala misma categoria
            $categorias=get_the_terms(get_the_ID(),"category");


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

// añadir
add_filter("the_content","ver_tambien");
