<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_One_Page
 */
    $enabled_sections = business_one_page_get_sections();
    if( is_home() || ! $enabled_sections ||  ! ( is_front_page()  || is_page_template( 'template-home.php' ) ) ){ ?>
                </div><!-- .row -->
            </div><!-- .container -->    
        </div><!-- #content -->
    <?php } ?>
    
	<footer id="colophon" class="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
		
        <div class="container">
			
            <?php if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ){?>
            <div class="footer-t">
				<div class="row">
					
                    <?php if( is_active_sidebar( 'footer-one' ) ){ ?>
                    <div class="columns-3">
						<?php dynamic_sidebar( 'footer-one' ); ?>
					</div>
					<?php } ?>
                    
                    <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                    <div class="columns-3">
						<?php dynamic_sidebar( 'footer-two' ); ?>
					</div>
                    <?php } ?>
					
                    <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                    <div class="columns-3">
						<?php dynamic_sidebar( 'footer-three' ); ?>
					</div>
                    <?php } ?>
                    
				</div><!-- .row -->
			</div><!-- .footer-t -->
            <?php } 
            
                do_action( 'business_one_page_footer' );
            ?>
            
		</div><!-- .container -->
        
		<a href="#page" class="scrollup"><?php esc_html_e( 'Scroll', 'business-one-page' ); ?></a>
        
	</footer><!-- #colophon -->
    <div class="overlay"></div>
    </div><!-- #acc-content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
