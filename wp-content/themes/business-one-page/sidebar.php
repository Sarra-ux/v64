<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_One_Page
 */



if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}
?>
<div class="sidebar">
    <aside id="secondary" class="widget-area" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
    	<?php dynamic_sidebar( 'right-sidebar' ); ?>
    </aside><!-- #secondary -->
</div><!-- .sidebar -->