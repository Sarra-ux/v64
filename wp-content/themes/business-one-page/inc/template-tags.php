<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Business_One_Page
 */

if ( ! function_exists( 'business_one_page_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function business_one_page_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'business_one_page_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function business_one_page_entry_footer() {
	
    // Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'business-one-page' ) );
		
        echo '<div class="tags-block">';
        if ( $categories_list && business_one_page_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="fa fa-folder-open"></span>' . esc_html__( 'Categories: %1$s', 'business-one-page' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'business-one-page' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><span class="fa fa-tags"></span>' . esc_html__( 'Tags: %1$s', 'business-one-page' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
        echo '</div>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'business-one-page' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if( ! function_exists( 'business_one_page_categories' ) ) :
/**
 * Function that list categories
*/
function business_one_page_categories( $blog = false ){
    if( $blog ){
        $separator = ' ';
    }else{
        $separator = __( ', ', 'business-one-page' );
    }
    
    $categories_list = get_the_category_list( esc_html( $separator ) ); 
    if ( $categories_list && business_one_page_categorized_blog() ) {
        echo '<span class="category">' . $categories_list . '</span>'; // WPCS: XSS OK.
    }
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function business_one_page_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'business_one_page_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'business_one_page_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so business_one_page_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so business_one_page_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in business_one_page_categorized_blog.
 */
function business_one_page_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'business_one_page_categories' );
}
add_action( 'edit_category', 'business_one_page_category_transient_flusher' );
add_action( 'save_post',     'business_one_page_category_transient_flusher' );
