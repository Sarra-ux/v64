( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['pro-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

jQuery(document).ready(function($) {
    
    // Scroll to Home section starts
    $('body').on('click', '#sub-accordion-panel-business_one_page_home_page_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });

    function scrollToSection( section_id ){
        var preview_section_id = "banner-section";

        var $contents = jQuery('#customize-preview iframe').contents();

        switch ( section_id ) {
            
            case 'accordion-section-business_one_page_about_section':
            preview_section_id = "about";
            break;

            case 'accordion-section-business_one_page_services_section':
            preview_section_id = "services";
            break;
            
            case 'accordion-section-business_one_page_cta1_section':
            preview_section_id = "cta1";
            break;

            case 'accordion-section-business_one_page_portfolio_section':
            preview_section_id = "portfolio";
            break;  

            case 'accordion-section-business_one_page_team_section':
            preview_section_id = "team";
            break; 

            case 'accordion-section-business_one_page_clients_section':
            preview_section_id = "clients";
            break;

            case 'accordion-section-business_one_page_blog_section':
            preview_section_id = "blog";
            break;

            case 'accordion-section-business_one_page_testimonial_section':
            preview_section_id = "testimonial";
            break;

            case 'accordion-section-business_one_page_cta2_section':
            preview_section_id = "cta2";
            break;

            case 'accordion-section-business_one_page_contact_section':
            preview_section_id = "contact";
            break;
        }

        if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
            $contents.find("html, body").animate({
            scrollTop: $contents.find( "#" + preview_section_id ).offset().top
            }, 1000);
        }
}
});
