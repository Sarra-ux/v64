<?php
/**
 * Template part for displaying Portfolio Section
 *
 * @package Business_One_Page
 */

$portfolio_section_page       = get_theme_mod( 'business_one_page_portfolio_section_page' );
$portfolio_section_post_one   = get_theme_mod( 'business_one_page_portfolio_section_post_one' );
$portfolio_section_post_two   = get_theme_mod( 'business_one_page_portfolio_section_post_two' );
$portfolio_section_post_three = get_theme_mod( 'business_one_page_portfolio_section_post_three' );
$portfolio_section_post_four  = get_theme_mod( 'business_one_page_portfolio_section_post_four' );
$portfolio_section_post_five  = get_theme_mod( 'business_one_page_portfolio_section_post_five' );

$portfolio_posts = array( $portfolio_section_post_one, $portfolio_section_post_two, $portfolio_section_post_three, $portfolio_section_post_four, $portfolio_section_post_five );
$portfolio_posts = array_diff( array_unique( $portfolio_posts ), array('') );

if( $portfolio_section_page ){
    
    $portfolio_qry = new WP_Query( array( 'page_id' => $portfolio_section_page ) );

    if( $portfolio_qry->have_posts() ){
        while( $portfolio_qry->have_posts() ){
            $portfolio_qry->the_post();
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

if( $portfolio_posts ){
    $i = 1;
    ?>
    <div class="portfolio-holder">
        <div class="row js-masonry">
        <?php
        $portfolio_query = new WP_Query( array( 'post__in' => $portfolio_posts, 'orderby' => 'post__in', 'posts_per_page' => -1, 'ignore_sticky_posts' => true ) );
        if( $portfolio_query->have_posts() ){                
            while( $portfolio_query->have_posts() ){
                $portfolio_query->the_post();
                if( has_post_thumbnail() ){                        
                    $img_size = 'business-one-page-360x380';
                    if( $i == 1 ) $img_size = 'business-one-page-360x340';
                    if( $i == 2 ) $img_size = 'business-one-page-with-sidebar';
                    if( $i == 3 ) $img_size = 'business-one-page-360x500';
            ?>
                <div class="portfolio-col">
                    <div class="img-holder">
                        <?php the_post_thumbnail( $img_size, array( 'itemprop' => 'image' ) );?>
                        <div class="text">
                            <div class="box">
                                <div class="holder">
                                    <div class="frame">
                                        <strong class="title"><?php the_title(); ?></strong>
                                        <?php business_one_page_categories(); ?>
                                        <?php 
                                            remove_filter( 'excerpt_length', 'business_one_page_excerpt_length' );
                                            add_filter( 'excerpt_length', 'business_one_page_excerpt_length_alt' );
                                            the_excerpt(); 
                                        ?>
                                        <a href="<?php the_permalink(); ?>" class="btn-more"><?php esc_html_e( 'Learn More', 'business-one-page' ); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            $i++; 
            }
            wp_reset_postdata();
        }
        ?>
        </div>
    </div>
    <?php
    remove_filter( 'excerpt_length', 'business_one_page_excerpt_length_alt' );
    add_filter( 'excerpt_length', 'business_one_page_excerpt_length' );
}