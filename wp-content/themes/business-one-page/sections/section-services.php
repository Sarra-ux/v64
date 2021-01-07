<?php
/**
 * Template part for displaying Service Section
 *
 * @package Business_One_Page
 */

$services_section_page       = get_theme_mod( 'business_one_page_services_section_page' );
$services_section_post_one   = get_theme_mod( 'business_one_page_services_section_post_one' );
$services_section_post_two   = get_theme_mod( 'business_one_page_services_section_post_two' );
$services_section_post_three = get_theme_mod( 'business_one_page_services_section_post_three' );
$services_section_post_four  = get_theme_mod( 'business_one_page_services_section_post_four' );
$services_section_post_five  = get_theme_mod( 'business_one_page_services_section_post_five' );
$services_section_post_six   = get_theme_mod( 'business_one_page_services_section_post_six' );

if( $services_section_page ){
    
    $services_qry = new WP_Query( array( 'page_id' => $services_section_page ) );

    if( $services_qry->have_posts() ){
        while( $services_qry->have_posts() ){
            $services_qry->the_post();
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

if( $services_section_post_one || $services_section_post_two || $services_section_post_three || $services_section_post_four || $services_section_post_five || $services_section_post_six ){
?>
<div class="three-cols">
    <div class="row">
    
        <?php 
            $services_posts = array( $services_section_post_one, $services_section_post_two, $services_section_post_three, $services_section_post_four, $services_section_post_five, $services_section_post_six );
            $services_posts = array_diff( array_unique( $services_posts ), array('') );
            
            $services_post_qry = new WP_Query( array( 'post__in' => $services_posts, 'orderby' => 'post__in', 'posts_per_page' => -1, 'ignore_sticky_posts' => true ) ); 
            if( $services_post_qry->have_posts() ){
                while( $services_post_qry->have_posts() ){
                    $services_post_qry->the_post();
                    $services_post_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 
                ?>
                <div class="col">
                    <?php if( has_post_thumbnail() ){ ?>
                    <div class="icon-holder">
                        <img src="<?php echo esc_url( $services_post_image[0] ); ?>" height="44" width="28" alt="<?php the_title_attribute(); ?>" />
                    </div>
                    <?php }?>
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