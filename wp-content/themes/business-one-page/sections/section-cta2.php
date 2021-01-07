<?php
/**
 * Template part for displaying Promotional Block Section
 *
 * @package Business_One_Page
 */

$cta2_section_title      = get_theme_mod( 'business_one_page_cta2_section_title' );
$cta2_section_content    = get_theme_mod( 'business_one_page_cta2_section_content' );
$cta2_section_button     = get_theme_mod( 'business_one_page_cta2_section_button' );
$cta2_section_button_url = get_theme_mod( 'business_one_page_cta2_section_button_url' );

if( $cta2_section_title || $cta2_section_content ) {
    echo '<strong class="title">' . esc_html( $cta2_section_title ) . '</strong>';        
    echo wpautop( esc_html( $cta2_section_content ) );
    
    if( $cta2_section_button && $cta2_section_button_url )
    echo '<a href="' . esc_url( $cta2_section_button_url ) . '" class="btn-start">' . esc_html( $cta2_section_button ) . '</a>';
}