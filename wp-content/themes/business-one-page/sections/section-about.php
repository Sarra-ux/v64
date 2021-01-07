<?php
/**
 * Template part for displaying About Section
 *
 * @package Business_One_Page
 */

$about_section_page       = get_theme_mod( 'business_one_page_about_section_page' );
$about_section_post_one   = get_theme_mod( 'business_one_page_about_section_post_one' );
$about_section_post_two   = get_theme_mod( 'business_one_page_about_section_post_two' );
$about_section_post_three = get_theme_mod( 'business_one_page_about_section_post_three' );

if( $about_section_page ){
    
    $about_qry = new WP_Query( array( 'page_id' => $about_section_page ) );

    if( $about_qry->have_posts() ){
        while( $about_qry->have_posts() ){
            $about_qry->the_post();
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

if( $about_section_post_one || $about_section_post_two || $about_section_post_three ){
?>
<div class="three-cols">
    <div class="row">    		
        <?php 
            $about_posts    = array( $about_section_post_one, $about_section_post_two, $about_section_post_three );
            $about_posts    = array_diff( array_unique( $about_posts ), array('') );
            $about_post_qry = new WP_Query( array( 'post__in' => $about_posts, 'orderby' => 'post__in', 'posts_per_page' => -1, 'ignore_sticky_posts' => true ) ); 
            if( $about_post_qry->have_posts() ){
                while( $about_post_qry->have_posts() ){
                    $about_post_qry->the_post();
                    $about_post_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 
                ?>
                <div class="col">
                    <div class="icon-holder">
                    <?php 
                    if( has_post_thumbnail() ){
                        the_post_thumbnail( 'business-one-page-testimonial' );
                    }else{
                        business_one_page_get_fallback_svg( 'business-one-page-testimonial' );
                    } ?>
                    </div>
                    <div class="text-holder">
                        <h2 class="title"><?php the_title(); ?></h2>
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php
                }
            }
            wp_reset_postdata();
        ?>
    </div>
</div>
<?php
}