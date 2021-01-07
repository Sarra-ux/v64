<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_One_Page
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php 
        if( is_single() ){ 
            if ( has_post_thumbnail() ) {
                echo '<div class="post-thumbnail">';
                    is_active_sidebar( 'right-sidebar' ) ? the_post_thumbnail( 'business-one-page-with-sidebar', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'business-one-page-full', array( 'itemprop' => 'image' ) ) ;
                echo ' </div>';
            }
        }else{ ?>
            <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                <?php 
                if ( has_post_thumbnail() ) {
                    is_active_sidebar( 'right-sidebar' ) ? the_post_thumbnail( 'business-one-page-cat-blog', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'business-one-page-full', array( 'itemprop' => 'image' ) ) ;
                }else{
                    is_active_sidebar( 'right-sidebar' ) ? business_one_page_get_fallback_svg( 'business-one-page-cat-blog', array( 'itemprop' => 'image' ) ) : business_one_page_get_fallback_svg( 'business-one-page-full', array( 'itemprop' => 'image' ) ) ;
                } ?>
            </a>
        <?php 
    } ?>
    
    <div class="text-holder">
        <header class="entry-header">
    		<?php
    		if ( 'post' === get_post_type() ) : ?>
    		<div class="entry-meta">
    			<?php business_one_page_posted_on(); ?>
    		</div><!-- .entry-meta -->
    		<?php
    		endif; 
            
            if ( is_single() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
            ?>
    	</header><!-- .entry-header -->
    
    	<div class="entry-content" itemprop="text">
    		<?php
    		if( is_single() ){	
                the_content( sprintf(
    				/* translators: %s: Name of current post. */
    				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'business-one-page' ), array( 'span' => array( 'class' => array() ) ) ),
    				the_title( '<span class="screen-reader-text">"', '"</span>', false )
    			) );
            }else{
                $format = get_post_format();
                if( false === $format ){
                    the_excerpt();
                ?>
                <a href="<?php the_permalink(); ?>" class="btn-readmore"><?php esc_html_e( 'Read More', 'business-one-page' ); ?></a>
                <?php 
                }else{
                    the_content();                    
                }
            }
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-one-page' ),
    				'after'  => '</div>',
    			) );
    		?>
    	</div><!-- .entry-content -->
        
        <?php if( is_single() ){ ?>
    	<footer class="entry-footer">
    		<?php business_one_page_entry_footer(); ?>
    	</footer><!-- .entry-footer -->
        
        <div class="author-block">
			<h2 class="author-title"><?php esc_html_e( 'About the Author', 'business-one-page' ); ?></h2>
			<div class="author-holder">
				<div class="img-holder">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 130 ); ?>               
                </div>
				<div class="text-holder">
					<h3 class="author-name"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></h3>
					<?php echo wpautop( esc_html( get_the_author_meta( 'description' ) ) ); ?>
				</div>
			</div>
		</div>
        
        <?php }?>
    </div><!-- .text-holder -->
    
</article><!-- #post-## -->
