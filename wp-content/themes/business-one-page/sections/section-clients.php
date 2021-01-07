<?php
/**
 * Template part for displaying Clients Section
 *
 * @package Business_One_Page
 */
$cli = 0;
$clients_section_page  = get_theme_mod( 'business_one_page_clients_section_page' );
$clients_section_logos = get_theme_mod( 'business_one_page_clients_section_logos' );

if( $clients_section_page ){
    
    $clients_qry = new WP_Query( array( 'page_id' => $clients_section_page ) );

    if( $clients_qry->have_posts() ){
        while( $clients_qry->have_posts() ){
            $clients_qry->the_post();
        ?>
            <header class="heading">
                <h2 class="section-title"><?php the_title(); ?></h2>
            </header>
        <?php            
        }
    }
    wp_reset_postdata();
}

if( $clients_section_logos ){
    $image_srcs = explode( ',', $clients_section_logos );
    echo '<div class="clients-holder"><div class="row">';
    if( is_array( $image_srcs ) ){
        foreach( $image_srcs as $image_src ){
            $cli++;
            if( $cli <= 6 )                
            echo '<div class="columns-2"><img src="' . esc_url( $image_src ) . '" alt=""></div>';
        }
    }
    echo '</div></div>';
}				