<?php
/**
 * Business_One_Page Theme Customizer.
 * 
 * https://github.com/WPTRT/code-examples/blob/master/customizer/add-controls-core-basic.php
 * 
 * @package Business_One_Page
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_one_page_customize_register( $wp_customize ) {
	
    /* Option list of all categories */
    $args = array(
	   'type'         => 'post',
	   'orderby'      => 'name',
	   'order'        => 'ASC',
	   'hide_empty'   => 1,
	   'hierarchical' => 1,
	   'taxonomy'     => 'category'
    ); 
    $option_categories = array();
    $category_lists = get_categories( $args );
    $option_categories[''] = __( 'Choose Category', 'business-one-page' );
    foreach( $category_lists as $category ){
        $option_categories[$category->term_id] = $category->name;
    }
    
    $option_cat = array();
    foreach( $category_lists as $cat ){
        $option_cat[$cat->term_id] = $cat->name;
    }
        
    /* Option list of all post */	
    $options_posts = array();
    $options_posts_obj = get_posts('posts_per_page=-1');
    $options_posts[''] = __( 'Choose Post', 'business-one-page' );
    foreach ( $options_posts_obj as $posts ) {
    	$options_posts[$posts->ID] = $posts->post_title;
    }
    
    /* Option list of all pages */	
    $options_pages = array();
    $options_pages_obj = get_posts('posts_per_page=-1&post_type=page');
    $options_pages[''] = __( 'Choose Page', 'business-one-page' );
    foreach ( $options_pages_obj as $pages ) {
    	$options_pages[$pages->ID] = $pages->post_title;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority'      => 10,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => __( 'Default Settings', 'business-one-page' ),
            'description'   => __( 'Default section provided by WordPress customizer.', 'business-one-page' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel     = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel            = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel  = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel = 'wp_default_panel'; 
    
    
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
	/** Default Settings Ends */
    
    /** Section Menu Setting */
    $wp_customize->add_section(
        'business_one_page_section_menu_setting',
        array(
            'title'     => __( 'Section Menu Settings', 'business-one-page' ),
            'priority'  => 19,
            'capability'=> 'edit_theme_options',
        )
    );    
    
    /** Enable/Disable Home Link */
    $wp_customize->add_setting(
        'business_one_page_ed_home_link',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_home_link',
        array(
            'label' => __( 'Disable Home Link', 'business-one-page' ),
            'description' => __( 'Enable to disable Home Link', 'business-one-page' ),
            'section' => 'business_one_page_section_menu_setting',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Section Menu */
    $wp_customize->add_setting(
        'business_one_page_ed_secion_menu',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_secion_menu',
        array(
            'label' => __( 'Disable Section Menu', 'business-one-page' ),
            'description' => __( 'Enable to disable Section Menu', 'business-one-page' ),
            'section' => 'business_one_page_section_menu_setting',
            'type' => 'checkbox',
        )
    );
    
    /** Home Link Label */
    $wp_customize->add_setting(
        'business_one_page_home_link_label',
        array(
            'default' => __( 'Home', 'business-one-page' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'business_one_page_home_link_label',
        array(
            'label' => __( 'Home Link Label', 'business-one-page' ),
            'section' => 'business_one_page_section_menu_setting',
            'type' => 'text',
        )
    );
    /** Section Menu Setting Ends */
    
    /** Slider Settings */
    $wp_customize->add_section(
        'business_one_page_slider_settings',
        array(
            'title'     => __( 'Slider Settings', 'business-one-page' ),
            'priority'  => 20,
            'capability'=> 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Slider */
    $wp_customize->add_setting(
        'business_one_page_ed_slider',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_slider',
        array(
            'label' => __( 'Enable Home Page Slider', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Auto Transition */
    $wp_customize->add_setting(
        'business_one_page_slider_auto',
        array(
            'default' => '1',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_auto',
        array(
            'label' => __( 'Enable Slider Auto Transition', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Loop */
    $wp_customize->add_setting(
        'business_one_page_slider_loop',
        array(
            'default' => '1',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_loop',
        array(
            'label' => __( 'Enable Slider Loop', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Pager */
    $wp_customize->add_setting(
        'business_one_page_slider_pager',
        array(
            'default' => '1',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_pager',
        array(
            'label' => __( 'Enable Slider Pager', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Caption */
    $wp_customize->add_setting(
        'business_one_page_slider_caption',
        array(
            'default' => '1',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_caption',
        array(
            'label' => __( 'Enable Slider Caption', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'checkbox',
        )
    );
        
    /** Slider Animation */
    $wp_customize->add_setting(
        'business_one_page_slider_animation',
        array(
            'default' => 'slide',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_animation',
        array(
            'label' => __( 'Choose Slider Animation', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'select',
            'choices' => array(
                'fade' => __( 'Fade', 'business-one-page' ),
                'slide' => __( 'Slide', 'business-one-page' ),
            )
        )
    );
    
    /** Slider Speed */
    $wp_customize->add_setting(
        'business_one_page_slider_speeds',
        array(
            'default' => 400,
            'sanitize_callback' => 'business_one_page_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_speeds',
        array(
            'label' => __( 'Slider Speed', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'text',
        )
    );
    
    /** Slider Pause */
    $wp_customize->add_setting(
        'business_one_page_slider_pause',
        array(
            'default' => 6000,
            'sanitize_callback' => 'business_one_page_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_pause',
        array(
            'label' => __( 'Slider Pause', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'text',
        )
    );
    
    /** Slider Readmore */
    $wp_customize->add_setting(
        'business_one_page_slider_readmore',
        array(
            'default' => __( 'Learn More', 'business-one-page' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_readmore',
        array(
            'label' => __( 'Readmore Text', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'text',
        )
    );
    
    /** Select Post One */
    $wp_customize->add_setting(
        'business_one_page_slider_post_one',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_post_one',
        array(
            'label' => __( 'Select Post One', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Two */
    $wp_customize->add_setting(
        'business_one_page_slider_post_two',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_post_two',
        array(
            'label' => __( 'Select Post Two', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Three */
    $wp_customize->add_setting(
        'business_one_page_slider_post_three',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_post_three',
        array(
            'label' => __( 'Select Post Three', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Four */
    $wp_customize->add_setting(
        'business_one_page_slider_post_four',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_slider_post_four',
        array(
            'label' => __( 'Select Post Four', 'business-one-page' ),
            'section' => 'business_one_page_slider_settings',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    /** Slider Settings Ends */
    
    /** Home Page Settings */
    $wp_customize->add_panel( 
        'business_one_page_home_page_settings',
         array(
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'title' => __( 'Home Page Settings', 'business-one-page' ),
            'description' => __( 'Customize Home Page Settings', 'business-one-page' ),
        ) 
    );
    
    /** About Section */
    $wp_customize->add_section(
        'business_one_page_about_section',
        array(
            'title' => __( 'About Section', 'business-one-page' ),
            'priority' => 20,
            'panel' => 'business_one_page_home_page_settings',
        )
    );
    
    /** Enable/Disable About Section */
    $wp_customize->add_setting(
        'business_one_page_ed_about_section',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_about_section',
        array(
            'label' => __( 'Enable About Section', 'business-one-page' ),
            'section' => 'business_one_page_about_section',
            'type' => 'checkbox',
        )
    );
    
    /** About Section Menu Title */
    $wp_customize->add_setting(
        'business_one_page_about_section_menu_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_about_section_menu_title',
        array(
            'label' => __( 'About Section Menu Title', 'business-one-page' ),
            'section' => 'business_one_page_about_section',
            'type' => 'text',
        )
    );
    
    /** Select Page */
    $wp_customize->add_setting(
        'business_one_page_about_section_page',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_about_section_page',
        array(
            'label' => __( 'Select Page', 'business-one-page' ),
            'section' => 'business_one_page_about_section',
            'type' => 'select',
            'choices' => $options_pages,
        )
    );
    
    /** Select Post One */
    $wp_customize->add_setting(
        'business_one_page_about_section_post_one',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_about_section_post_one',
        array(
            'label' => __( 'Select Post One', 'business-one-page' ),
            'section' => 'business_one_page_about_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Two */
    $wp_customize->add_setting(
        'business_one_page_about_section_post_two',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_about_section_post_two',
        array(
            'label' => __( 'Select Post Two', 'business-one-page' ),
            'section' => 'business_one_page_about_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Three */
    $wp_customize->add_setting(
        'business_one_page_about_section_post_three',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_about_section_post_three',
        array(
            'label' => __( 'Select Post Three', 'business-one-page' ),
            'section' => 'business_one_page_about_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    /** About Section Ends */
    
    /** Service Section */
    $wp_customize->add_section(
        'business_one_page_services_section',
        array(
            'title' => __( 'Service Section', 'business-one-page' ),
            'priority' => 30,
            'panel' => 'business_one_page_home_page_settings',
        )
    );
    
    /** Enable/Disable Service Section */
    $wp_customize->add_setting(
        'business_one_page_ed_services_section',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_services_section',
        array(
            'label' => __( 'Enable Service Section', 'business-one-page' ),
            'section' => 'business_one_page_services_section',
            'type' => 'checkbox',
        )
    );
    
    /** Service Section Menu Title */
    $wp_customize->add_setting(
        'business_one_page_services_section_menu_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_services_section_menu_title',
        array(
            'label' => __( 'Service Section Menu Title', 'business-one-page' ),
            'section' => 'business_one_page_services_section',
            'type' => 'text',
        )
    );
    
    /** Select Page */
    $wp_customize->add_setting(
        'business_one_page_services_section_page',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_services_section_page',
        array(
            'label' => __( 'Select Page', 'business-one-page' ),
            'section' => 'business_one_page_services_section',
            'type' => 'select',
            'choices' => $options_pages,
        )
    );
    
    /** Select Post One */
    $wp_customize->add_setting(
        'business_one_page_services_section_post_one',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_services_section_post_one',
        array(
            'label' => __( 'Select Post One', 'business-one-page' ),
            'section' => 'business_one_page_services_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Two */
    $wp_customize->add_setting(
        'business_one_page_services_section_post_two',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_services_section_post_two',
        array(
            'label' => __( 'Select Post Two', 'business-one-page' ),
            'section' => 'business_one_page_services_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Three */
    $wp_customize->add_setting(
        'business_one_page_services_section_post_three',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_services_section_post_three',
        array(
            'label' => __( 'Select Post Three', 'business-one-page' ),
            'section' => 'business_one_page_services_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Four */
    $wp_customize->add_setting(
        'business_one_page_services_section_post_four',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_services_section_post_four',
        array(
            'label' => __( 'Select Post Four', 'business-one-page' ),
            'section' => 'business_one_page_services_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Five */
    $wp_customize->add_setting(
        'business_one_page_services_section_post_five',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_services_section_post_five',
        array(
            'label' => __( 'Select Post Five', 'business-one-page' ),
            'section' => 'business_one_page_services_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Six */
    $wp_customize->add_setting(
        'business_one_page_services_section_post_six',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_services_section_post_six',
        array(
            'label' => __( 'Select Post Six', 'business-one-page' ),
            'section' => 'business_one_page_services_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    /** Service Section Ends*/
    
    /** First Promotional Block */
    $wp_customize->add_section(
        'business_one_page_cta1_section',
        array(
            'title' => __( 'First Promotional Block Section', 'business-one-page' ),
            'priority' => 40,
            'panel' => 'business_one_page_home_page_settings',
        )
    );
    
    /** Enable/Disable First Promotional Block Section */
    $wp_customize->add_setting(
        'business_one_page_ed_cta1_section',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_cta1_section',
        array(
            'label' => __( 'Enable Promotional Block Section', 'business-one-page' ),
            'section' => 'business_one_page_cta1_section',
            'type' => 'checkbox',
        )
    );
    
    /** Promotional Block Section Title */
    $wp_customize->add_setting(
        'business_one_page_cta1_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_cta1_section_title',
        array(
            'label' => __( 'Promotional Block Section Title', 'business-one-page' ),
            'section' => 'business_one_page_cta1_section',
            'type' => 'text',
        )
    );
    
    /** Promotional Block Section Content */
    $wp_customize->add_setting(
        'business_one_page_cta1_section_content',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_cta1_section_content',
        array(
            'label' => __( 'Promotional Block Section Content', 'business-one-page' ),
            'section' => 'business_one_page_cta1_section',
            'type' => 'text',
        )
    );
    
    /** Promotional Block Section Button */
    $wp_customize->add_setting(
        'business_one_page_cta1_section_button',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_cta1_section_button',
        array(
            'label' => __( 'Promotional Block Section Button', 'business-one-page' ),
            'section' => 'business_one_page_cta1_section',
            'type' => 'text',
        )
    );
    
    /** Promotional Block Section Button Url */
    $wp_customize->add_setting(
        'business_one_page_cta1_section_button_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_cta1_section_button_url',
        array(
            'label' => __( 'Promotional Block Section Button Url', 'business-one-page' ),
            'section' => 'business_one_page_cta1_section',
            'type' => 'text',
        )
    );
    /** First Promotional Block Ends */
    
    /** Portfolio Section */
    $wp_customize->add_section(
        'business_one_page_portfolio_section',
        array(
            'title' => __( 'Portfolio Section', 'business-one-page' ),
            'priority' => 50,
            'panel' => 'business_one_page_home_page_settings',
        )
    );
    
    /** Enable/Disable Portfolio Section */
    $wp_customize->add_setting(
        'business_one_page_ed_portfolio_section',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_portfolio_section',
        array(
            'label' => __( 'Enable Portfolio Section', 'business-one-page' ),
            'section' => 'business_one_page_portfolio_section',
            'type' => 'checkbox',
        )
    );
    
    /** Portfolio Section Menu Title */
    $wp_customize->add_setting(
        'business_one_page_portfolio_section_menu_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_portfolio_section_menu_title',
        array(
            'label' => __( 'Portfolio Section Menu Title', 'business-one-page' ),
            'section' => 'business_one_page_portfolio_section',
            'type' => 'text',
        )
    );
    
    /** Select Page */
    $wp_customize->add_setting(
        'business_one_page_portfolio_section_page',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_portfolio_section_page',
        array(
            'label' => __( 'Select Page', 'business-one-page' ),
            'section' => 'business_one_page_portfolio_section',
            'type' => 'select',
            'choices' => $options_pages,
        )
    );
    
    /** Select Post One */
    $wp_customize->add_setting(
        'business_one_page_portfolio_section_post_one',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_portfolio_section_post_one',
        array(
            'label' => __( 'Select Post One', 'business-one-page' ),
            'section' => 'business_one_page_portfolio_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Two */
    $wp_customize->add_setting(
        'business_one_page_portfolio_section_post_two',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_portfolio_section_post_two',
        array(
            'label' => __( 'Select Post Two', 'business-one-page' ),
            'section' => 'business_one_page_portfolio_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Three */
    $wp_customize->add_setting(
        'business_one_page_portfolio_section_post_three',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_portfolio_section_post_three',
        array(
            'label' => __( 'Select Post Three', 'business-one-page' ),
            'section' => 'business_one_page_portfolio_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Four */
    $wp_customize->add_setting(
        'business_one_page_portfolio_section_post_four',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_portfolio_section_post_four',
        array(
            'label' => __( 'Select Post Four', 'business-one-page' ),
            'section' => 'business_one_page_portfolio_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    
    /** Select Post Five */
    $wp_customize->add_setting(
        'business_one_page_portfolio_section_post_five',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_portfolio_section_post_five',
        array(
            'label' => __( 'Select Post Five', 'business-one-page' ),
            'section' => 'business_one_page_portfolio_section',
            'type' => 'select',
            'choices' => $options_posts,
        )
    );
    /** Portfolio Section Ends */
    
    /** Team Section */
    $wp_customize->add_section(
        'business_one_page_team_section',
        array(
            'title' => __( 'Team Section', 'business-one-page' ),
            'priority' => 60,
            'panel' => 'business_one_page_home_page_settings',
        )
    );
    
    /** Enable/Disable Team Section */
    $wp_customize->add_setting(
        'business_one_page_ed_team_section',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_team_section',
        array(
            'label' => __( 'Enable Team Section', 'business-one-page' ),
            'section' => 'business_one_page_team_section',
            'type' => 'checkbox',
        )
    );
    
    /** Team Section Menu Title */
    $wp_customize->add_setting(
        'business_one_page_team_section_menu_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_team_section_menu_title',
        array(
            'label' => __( 'Team Section Menu Title', 'business-one-page' ),
            'section' => 'business_one_page_team_section',
            'type' => 'text',
        )
    );
    
    /** Select Page */
    $wp_customize->add_setting(
        'business_one_page_team_section_page',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_team_section_page',
        array(
            'label' => __( 'Select Page', 'business-one-page' ),
            'section' => 'business_one_page_team_section',
            'type' => 'select',
            'choices' => $options_pages,
        )
    );
    
    /** Select Category */
    $wp_customize->add_setting(
        'business_one_page_team_section_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_team_section_cat',
        array(
            'label' => __( 'Select Category', 'business-one-page' ),
            'section' => 'business_one_page_team_section',
            'type' => 'select',
            'choices' => $option_categories,
        )
    );
    /** Team Section Ends */
    
    /** Client Section */
    $wp_customize->add_section(
        'business_one_page_clients_section',
        array(
            'title' => __( 'Client Section', 'business-one-page' ),
            'priority' => 70,
            'panel' => 'business_one_page_home_page_settings',
        )
    );
    
    /** Enable/Disable Client Section */
    $wp_customize->add_setting(
        'business_one_page_ed_clients_section',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_clients_section',
        array(
            'label' => __( 'Enable Client Section', 'business-one-page' ),
            'section' => 'business_one_page_clients_section',
            'type' => 'checkbox',
        )
    );
    
    /** Client Section Menu Title */
    $wp_customize->add_setting(
        'business_one_page_clients_section_menu_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_clients_section_menu_title',
        array(
            'label' => __( 'Client Section Menu Title', 'business-one-page' ),
            'section' => 'business_one_page_clients_section',
            'type' => 'text',
        )
    );
    
    /** Select Page */
    $wp_customize->add_setting(
        'business_one_page_clients_section_page',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_clients_section_page',
        array(
            'label' => __( 'Select Page', 'business-one-page' ),
            'section' => 'business_one_page_clients_section',
            'type' => 'select',
            'choices' => $options_pages,
        )
    );
    
    /** Select Client Logos */
    $wp_customize->add_setting(
        'business_one_page_clients_section_logos',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        new Business_One_Page_Multi_Image_Customize_Control( $wp_customize, 'business_one_page_clients_section_logos', array(
		'label'       => __( 'Select Client Logos', 'business-one-page' ),
		'section'     => 'business_one_page_clients_section',
	   ) )
    );
    /** Client Section Ends */
    
    /** Blog Sections */
    $wp_customize->add_section(
        'business_one_page_blog_section',
        array(
            'title' => __( 'Blog Section', 'business-one-page' ),
            'priority' => 80,
            'panel' => 'business_one_page_home_page_settings',
        )
    );
    
    /** Enable/Disable Blog Section */
    $wp_customize->add_setting(
        'business_one_page_ed_blog_section',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_blog_section',
        array(
            'label' => __( 'Enable Blog Section', 'business-one-page' ),
            'section' => 'business_one_page_blog_section',
            'type' => 'checkbox',
        )
    );
    
    /** Blog Section Menu Title */
    $wp_customize->add_setting(
        'business_one_page_blog_section_menu_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_blog_section_menu_title',
        array(
            'label' => __( 'Blog Section Menu Title', 'business-one-page' ),
            'section' => 'business_one_page_blog_section',
            'type' => 'text',
        )
    );
    
    /** Blog Section Title */
    $wp_customize->add_setting(
        'business_one_page_blog_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_blog_section_title',
        array(
            'label' => __( 'Blog Section Title', 'business-one-page' ),
            'section' => 'business_one_page_blog_section',
            'type' => 'text'
        )
    );
    
    /** Blog Section Content */
    $wp_customize->add_setting(
        'business_one_page_blog_section_content',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_blog_section_content',
        array(
            'label' => __( 'Blog Section Content', 'business-one-page' ),
            'section' => 'business_one_page_blog_section',
            'type' => 'text'
        )
    );
    
    /** Blog View All Text */
    $wp_customize->add_setting(
        'business_one_page_blog_section_view_all',
        array(
            'default' => __( 'View All Blogs', 'business-one-page' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_blog_section_view_all',
        array(
            'label' => __( 'Blog View All Text', 'business-one-page' ),
            'section' => 'business_one_page_blog_section',
            'type' => 'text',
        )
    );
    /** Blog Sections Ends */
    
    /** Testimonial Section */
    $wp_customize->add_section(
        'business_one_page_testimonial_section',
        array(
            'title' => __( 'Testimonial Section', 'business-one-page' ),
            'priority' => 90,
            'panel' => 'business_one_page_home_page_settings',
        )
    );
    
    /** Enable/Disable Testimonial Section */
    $wp_customize->add_setting(
        'business_one_page_ed_testimonial_section',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_testimonial_section',
        array(
            'label' => __( 'Enable Testimonial Section', 'business-one-page' ),
            'section' => 'business_one_page_testimonial_section',
            'type' => 'checkbox',
        )
    );
    
    /** Testimonial Section Menu Title */
    $wp_customize->add_setting(
        'business_one_page_testimonial_section_menu_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_testimonial_section_menu_title',
        array(
            'label' => __( 'Testimonial Section Menu Title', 'business-one-page' ),
            'section' => 'business_one_page_testimonial_section',
            'type' => 'text',
        )
    );
    
    /** Select Page */
    $wp_customize->add_setting(
        'business_one_page_testimonial_section_page',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_testimonial_section_page',
        array(
            'label' => __( 'Select Page', 'business-one-page' ),
            'section' => 'business_one_page_testimonial_section',
            'type' => 'select',
            'choices' => $options_pages,
        )
    );
    
    /** Select Category */
    $wp_customize->add_setting(
        'business_one_page_testimonial_section_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_testimonial_section_cat',
        array(
            'label' => __( 'Select Category', 'business-one-page' ),
            'section' => 'business_one_page_testimonial_section',
            'type' => 'select',
            'choices' => $option_categories,
        )
    );
    /** Testimonial Section Ends */
    
    /** Second Promotional Block */
    $wp_customize->add_section(
        'business_one_page_cta2_section',
        array(
            'title' => __( 'Second Promotional Block Section', 'business-one-page' ),
            'priority' => 100,
            'panel' => 'business_one_page_home_page_settings',
        )
    );
    
    /** Enable/Disable Second Promotional Block Section */
    $wp_customize->add_setting(
        'business_one_page_ed_cta2_section',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_cta2_section',
        array(
            'label' => __( 'Enable Promotional Block Section', 'business-one-page' ),
            'section' => 'business_one_page_cta2_section',
            'type' => 'checkbox',
        )
    );
        
    /** Promotional Block Section Title */
    $wp_customize->add_setting(
        'business_one_page_cta2_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_cta2_section_title',
        array(
            'label' => __( 'Promotional Block Section Title', 'business-one-page' ),
            'section' => 'business_one_page_cta2_section',
            'type' => 'text',
        )
    );
    
    /** Promotional Block Section Content */
    $wp_customize->add_setting(
        'business_one_page_cta2_section_content',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_cta2_section_content',
        array(
            'label' => __( 'Promotional Block Section Content', 'business-one-page' ),
            'section' => 'business_one_page_cta2_section',
            'type' => 'text',
        )
    );
    
    /** Promotional Block Section Button */
    $wp_customize->add_setting(
        'business_one_page_cta2_section_button',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_cta2_section_button',
        array(
            'label' => __( 'Promotional Block Section Button', 'business-one-page' ),
            'section' => 'business_one_page_cta2_section',
            'type' => 'text',
        )
    );
    
    /** Promotional Block Section Button Url */
    $wp_customize->add_setting(
        'business_one_page_cta2_section_button_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_cta2_section_button_url',
        array(
            'label' => __( 'Promotional Block Section Button Url', 'business-one-page' ),
            'section' => 'business_one_page_cta2_section',
            'type' => 'text',
        )
    );
    /** First Promotional Block Ends */
    
    /** Contact Section */
    $wp_customize->add_section(
        'business_one_page_contact_section',
        array(
            'title' => __( 'Contact Section', 'business-one-page' ),
            'priority' => 110,
            'panel' => 'business_one_page_home_page_settings',
        )
    );
    
    /** Enable/Disable Contact Section */
    $wp_customize->add_setting(
        'business_one_page_ed_contact_section',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_ed_contact_section',
        array(
            'label' => __( 'Enable Contact Section', 'business-one-page' ),
            'section' => 'business_one_page_contact_section',
            'type' => 'checkbox',
        )
    );
    
    /** Contact Section Menu Title */
    $wp_customize->add_setting(
        'business_one_page_contact_section_menu_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_contact_section_menu_title',
        array(
            'label' => __( 'Contact Section Menu Title', 'business-one-page' ),
            'section' => 'business_one_page_contact_section',
            'type' => 'text',
        )
    );
    
    /** Select Page */
    $wp_customize->add_setting(
        'business_one_page_contact_section_page',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_contact_section_page',
        array(
            'label' => __( 'Select Page', 'business-one-page' ),
            'section' => 'business_one_page_contact_section',
            'type' => 'select',
            'choices' => $options_pages,
        )
    );
    
    /** Contact Section Contact Form */
    $wp_customize->add_setting(
        'business_one_page_contact_form_label',
        array(
            'default'           => __( 'Leave a message', 'business-one-page' ),
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_contact_form_label',
        array(
            'label'   => __( 'Contact Form Label', 'business-one-page' ),
            'section' => 'business_one_page_contact_section',
            'type'    => 'text',
        )
    );
    
    /** Contact Section Contact Form */
    $wp_customize->add_setting(
        'business_one_page_contact_section_form',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_contact_section_form',
        array(
            'label' => __( 'Contact Section Contact Form', 'business-one-page' ),
            'description' => __( 'Enter the Contact Form 7 Shortcode. Ex. [contact-form-7 id="186" title="Google contact"]', 'business-one-page' ),
            'section' => 'business_one_page_contact_section',
            'type' => 'text',
        )
    );
    
    /** Contact Info Title */
    $wp_customize->add_setting(
        'business_one_page_contact_section_info_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_contact_section_info_title',
        array(
            'label' => __( 'Contact Info Title', 'business-one-page' ),
            'section' => 'business_one_page_contact_section',
            'type' => 'text',
        )
    );
    
    /** Contact Info Content */
    $wp_customize->add_setting(
        'business_one_page_contact_section_info_content',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_contact_section_info_content',
        array(
            'label' => __( 'Contact Info Content', 'business-one-page' ),
            'section' => 'business_one_page_contact_section',
            'type' => 'textarea',
        )
    );
    
    /** Contact Address */
    $wp_customize->add_setting(
        'business_one_page_contact_section_address',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_contact_section_address',
        array(
            'label' => __( 'Contact Address', 'business-one-page' ),
            'section' => 'business_one_page_contact_section',
            'type' => 'text',
        )
    );
    
    /** Contact Phone */
    $wp_customize->add_setting(
        'business_one_page_contact_section_phone',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_contact_section_phone',
        array(
            'label' => __( 'Contact Phone', 'business-one-page' ),
            'section' => 'business_one_page_contact_section',
            'type' => 'text'
        )
    );
    
    /** Contact Fax */
    $wp_customize->add_setting(
        'business_one_page_contact_section_fax',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_contact_section_fax',
        array(
            'label' => __( 'Contact Fax', 'business-one-page' ),
            'section' => 'business_one_page_contact_section',
            'type' => 'text',
        )
    );
    
    /** Contact Email */
    $wp_customize->add_setting(
        'business_one_page_contact_section_email',
        array(
            'default' => '',
            'sanitize_callback' => 'business_one_page_sanitize_email',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_contact_section_email',
        array(
            'label' => __( 'Contact Email', 'business-one-page' ),
            'section' => 'business_one_page_contact_section',
            'type' => 'email',
        )
    );
    /** Contact Section Ends*/
    
    /** Home Page Settings Ends */
    
    /** Social Settings */
    $wp_customize->add_section(
        'business_one_page_social_settings',
        array(
            'title' => __( 'Social Settings', 'business-one-page' ),
            'description' => __( 'Leave blank if you do not want to show the social link.', 'business-one-page' ),
            'priority' => 40,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Facebook */
    $wp_customize->add_setting(
        'business_one_page_facebook',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_facebook',
        array(
            'label' => __( 'Facebook', 'business-one-page' ),
            'section' => 'business_one_page_social_settings',
            'type' => 'text',
        )
    );
    
    /** Twitter */
    $wp_customize->add_setting(
        'business_one_page_twitter',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_twitter',
        array(
            'label' => __( 'Twitter', 'business-one-page' ),
            'section' => 'business_one_page_social_settings',
            'type' => 'text',
        )
    );
    
    /** Pinterest */
    $wp_customize->add_setting(
        'business_one_page_pinterest',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_pinterest',
        array(
            'label' => __( 'Pinterest', 'business-one-page' ),
            'section' => 'business_one_page_social_settings',
            'type' => 'text',
        )
    );
    
    /** LinkedIn */
    $wp_customize->add_setting(
        'business_one_page_linkedin',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_linkedin',
        array(
            'label' => __( 'LinkedIn', 'business-one-page' ),
            'section' => 'business_one_page_social_settings',
            'type' => 'text',
        )
    );
    
    /** Google Plus */
    $wp_customize->add_setting(
        'business_one_page_google_plus',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_google_plus',
        array(
            'label' => __( 'Google Plus', 'business-one-page' ),
            'section' => 'business_one_page_social_settings',
            'type' => 'text',
        )
    );

    /** Instagram Plus */
    $wp_customize->add_setting(
        'business_one_page_instagram',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_instagram',
        array(
            'label' => __( 'Instagram', 'business-one-page' ),
            'section' => 'business_one_page_social_settings',
            'type' => 'text',
        )
    );

    /** Youtube Plus */
    $wp_customize->add_setting(
        'business_one_page_youtube',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_youtube',
        array(
            'label' => __( 'YouTube', 'business-one-page' ),
            'section' => 'business_one_page_social_settings',
            'type' => 'text',
        )
    );
    
    /** OK */
    $wp_customize->add_setting(
        'business_one_page_odnoklassniki',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_odnoklassniki',
        array(
            'label' => __( 'OK', 'business-one-page' ),
            'section' => 'business_one_page_social_settings',
            'type' => 'text',
        )
    );
    
    /** VK */
    $wp_customize->add_setting(
        'business_one_page_vk',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_vk',
        array(
            'label' => __( 'VK', 'business-one-page' ),
            'section' => 'business_one_page_social_settings',
            'type' => 'text',
        )
    );
    
    /** Xing */
    $wp_customize->add_setting(
        'business_one_page_xing',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_xing',
        array(
            'label' => __( 'Xing', 'business-one-page' ),
            'section' => 'business_one_page_social_settings',
            'type' => 'text',
        )
    );
    /** Social Settings Ends */
    
    /** Exclude Categories */
    $wp_customize->add_section(
        'business_one_page_exclude_cat_settings',
        array(
            'title' => __( 'Exclude Category Settings', 'business-one-page' ),
            'priority' => 49,
            'capability' => 'edit_theme_options',
        )
    );
    
    $wp_customize->add_setting(
        'business_one_page_exclude_cat',
        array(
            'default'           => '',
            'sanitize_callback' => 'business_one_page_sanitize_multiple_check'
        )
    );

    $wp_customize->add_control(
        new Business_One_Page_Customize_Control_Checkbox_Multiple(
            $wp_customize,
            'business_one_page_exclude_cat',
            array(
                'section'       => 'business_one_page_exclude_cat_settings',
                'label'         => __( 'Exclude Categories', 'business-one-page' ),
                'description'   => __( 'Check multiple categories to exclude from blog and archive page.', 'business-one-page' ),
                'choices'       => $option_cat
            )
        )
    );
    
    if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
        /** Custom CSS*/
        $wp_customize->add_section(
            'business_one_page_custom_settings',
            array(
                'title' => __( 'Custom CSS Settings', 'business-one-page' ),
                'priority' => 50,
                'capability' => 'edit_theme_options',
            )
        );
        
        $wp_customize->add_setting(
            'business_one_page_custom_css',
            array(
                'default' => '',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'business_one_page_sanitize_css'
                )
        );
        
        $wp_customize->add_control(
            'business_one_page_custom_css',
            array(
                'label' => __( 'Custom Css', 'business-one-page' ),
                'section' => 'business_one_page_custom_settings',
                'description' => __( 'Put your custom CSS', 'business-one-page' ),
                'type' => 'textarea',
            )
        );
        /** Custom CSS Ends */
    }

    /** Footer Section */
    $wp_customize->add_section(
        'business_one_page_footer_section',
        array(
            'title' => __( 'Footer Settings', 'business-one-page' ),
            'priority' => 70,
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'business_one_page_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'business_one_page_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'business-one-page' ),
            'section' => 'business_one_page_footer_section',
            'type' => 'textarea',
        )
    );
    
    /**
     * Sanitization Functions
     * 
     * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php 
    */    
    function business_one_page_sanitize_checkbox( $checked ){
        // Boolean check.
	   return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
    
    function business_one_page_sanitize_select( $input, $setting ) {
    	// Ensure input is a slug.
    	$input = sanitize_key( $input );
    	// Get list of choices from the control associated with the setting.
    	$choices = $setting->manager->get_control( $setting->id )->choices;
    	// If the input is a valid key, return it; otherwise, return the default.
    	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
    
    function business_one_page_sanitize_number_absint( $number, $setting ) {
    	// Ensure $business_one_page_number is an absolute integer (whole number, zero or greater).
    	$number = absint( $number );
    	// If the input is an absolute integer, return it; otherwise, return the default
    	return ( $number ? $number : $setting->default );
    }
    
    function business_one_page_sanitize_email( $email, $setting ) {
    	// Sanitize $input as a hex value without the hash prefix.
    	$email = sanitize_email( $email );    	
    	// If $email is a valid email, return it; otherwise, return the default.
    	return ( !empty( $email ) ? $email : $setting->default );
    }
    
    function business_one_page_sanitize_css( $css ){
    	return wp_strip_all_tags( $css );
    }   
    
    function business_one_page_sanitize_multiple_check( $values ) {    
        $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;    
        return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
    }
    
}
add_action( 'customize_register', 'business_one_page_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function business_one_page_customize_preview_js() {

    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'business_one_page_customizer', get_template_directory_uri() . '/js' . $build . '/customizer' . $suffix . '.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'business_one_page_customize_preview_js' );
