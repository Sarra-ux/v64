<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Business_One_Page
 */

get_header(); ?>

    <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
            
            $exclude_categories = !empty( get_theme_mod( 'business_one_page_exclude_cat' ) ) ? get_theme_mod( 'business_one_page_exclude_cat' ) : '';

			the_post_navigation( array( 'excluded_terms'=> $exclude_categories ) );
            
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
            
<?php
get_sidebar(); 
get_footer();