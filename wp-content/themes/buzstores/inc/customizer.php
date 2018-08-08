<?php
/**
 * buzstores Theme Customizer
 *
 * @package buzstores
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function buzstores_customize_register( $wp_customize ) {
    require get_template_directory() . '/inc/admin-panel/customizer/customizer-options.php';
    $wp_customize->get_section( 'title_tagline' )->panel = 'buzstores_header_panel';  
    $wp_customize->get_section( 'background_image' )->panel = 'buzstores_general_panel';
    $wp_customize->get_section( 'header_image' )->panel = 'buzstores_header_panel';  
    $wp_customize->get_section( 'colors' )->panel = 'buzstores_general_panel';
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'buzstores_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'buzstores_customize_partial_blogdescription',
		) );
	}
    
    /** Upgrade to buzstores Pro **/
	// Register custom section types.
	$wp_customize->register_section_type( 'buzstores_Pro_Link_Section' );

	// Register sections.
	$wp_customize->add_section(
	    new buzstores_Pro_Link_Section(
	        $wp_customize,
	        'buzstores-pro',
	        array(
	            'title'    => esc_html__( 'Upgrade To Buzstores Pro', 'buzstores' ),
	            'pro_text' => esc_html__( 'Go Pro','buzstores' ),
	            'pro_url'  => 'https://buzthemes.com/wordpress_themes/buzstore-pro/',
	            'priority' => 1,
	        )
	    )
	);
    
    /** Theme Info section **/
	$wp_customize->add_section(
        'buzstores_theme_info_section',
        array(
            'title'		=> esc_html__( 'Theme Info', 'buzstores' ),
            'priority'  => 1,
        )
    );
    // More Themes
    $wp_customize->add_setting(
        'buzstores_por_information', 
        array(
            'type'              => 'theme_info',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new buzstores_Theme_Info( 
        $wp_customize ,
        'buzstores_por_information',
            array(
              'label' => esc_html__( 'Buzstores Pro Theme' , 'buzstores' ),
              'section' => 'buzstores_theme_info_section',
            )
        )
    );
}
add_action( 'customize_register', 'buzstores_customize_register' );

/** Customizer Script **/
function buzstores_customize_backend_scripts() {
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'buzstores-customizer-style', get_template_directory_uri() . '/inc/admin-panel/customizer/css/customizer-style.css' );
	wp_enqueue_script( 'buzstores-customizer-scripts', get_template_directory_uri() . '/inc/admin-panel/customizer/js/customizer-script.js', array( 'jquery', 'customize-controls' ), '20160714', true );
}
add_action( 'customize_controls_enqueue_scripts', 'buzstores_customize_backend_scripts', 10 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function buzstores_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function buzstores_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function buzstores_customize_preview_js() {
	wp_enqueue_script( 'buzstores-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'buzstores_customize_preview_js' );
