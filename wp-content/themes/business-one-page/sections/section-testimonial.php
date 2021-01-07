<?php
/**
 * Template part for displaying Testimonial Section
 *
 * @package Business_One_Page
 */

$testimonial_section_page = get_theme_mod( 'business_one_page_testimonial_section_page' );
$testimonial_section_cat  = get_theme_mod( 'business_one_page_testimonial_section_cat' ) ;

if( $testimonial_section_page ){
    
    $testimonial_qry = new WP_Query( array( 'page_id' => $testimonial_section_page ) );

    if( $testimonial_qry->have_posts() ){
        while( $testimonial_qry->have_posts() ){
            $testimonial_qry->the_post();
        ?>
            <header class="heading">
                <h2 class="section-title"><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </header>
        <?php            
        }
    }
    wp_reset_postdata();
}

if( $testimonial_section_cat ){ 
    echo '<div class="testimonial-slider"><ul class="slides testimonial-slide owl-carousel owl-theme">';
    
    $testimonial_query = new WP_Query( array( 'cat' => $testimonial_section_cat, 'posts_per_page' => -1, 'ignore_sticky_posts' => true ) );
    if( $testimonial_query->have_posts() ){
        while( $testimonial_query->have_posts() ){
            $testimonial_query->the_post();
            ?>
            <li>
                <div class="img-holder">
                    <?php 
                    if( has_post_thumbnail() ){ 
                        the_post_thumbnail( 'business-one-page-testimonial', array( 'itemprop' => 'image' ) ); 
                    }else{
                        business_one_page_get_fallback_svg( 'business-one-page-testimonial' );
                    } ?>
                </div>
                <?php the_content(); ?>
                <strong class="name"><?php the_title(); ?></strong>
            </li>
            <?php
        }
    }
    wp_reset_postdata();
    
    echo '</ul></div>';
}