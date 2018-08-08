<?php
/**
 * Ecommerce Store Theme Customizer
 *
 * @package Ecommerce Store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bb_ecommerce_store_customize_register( $wp_customize ) {	

	//add home page setting pannel
	$wp_customize->add_panel( 'bb_ecommerce_store_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'bb-ecommerce-store' ),
	    'description' => __( 'Description of what this panel does.', 'bb-ecommerce-store' ),
	) );
	
	//Layouts
	$wp_customize->add_section( 'bb_ecommerce_store_left_right', array(
    	'title'      => __( 'Layout Settings', 'bb-ecommerce-store' ),
		'priority'   => 30,
		'panel' => 'bb_ecommerce_store_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('bb_ecommerce_store_theme_options',array(
        'default' => '',
        'sanitize_callback' => 'bb_ecommerce_store_sanitize_choices'	        
	) );

	$wp_customize->add_control('bb_ecommerce_store_theme_options',
	    array(
	        'type' => 'radio',
	        'label' => __('Change Layouts','bb-ecommerce-store'),
	        'section' => 'bb_ecommerce_store_left_right',
	        'choices' => array(
	            'Left Sidebar' => __('Left Sidebar','bb-ecommerce-store'),
	            'Right Sidebar' => __('Right Sidebar','bb-ecommerce-store'),
	            'One Column' => __('One Column','bb-ecommerce-store'),
	            'Three Columns' => __('Three Columns','bb-ecommerce-store'),
	            'Four Columns' => __('Four Columns','bb-ecommerce-store'),
	            'Grid Layout' => __('Grid Layout','bb-ecommerce-store')
	        ),
	) );

	$font_array = array(
        '' => __( 'No Fonts', 'bb-ecommerce-store' ),
        'Abril Fatface' => __( 'Abril Fatface', 'bb-ecommerce-store' ),
        'Acme' => __( 'Acme', 'bb-ecommerce-store' ),
        'Anton' => __( 'Anton', 'bb-ecommerce-store' ),
        'Architects Daughter' => __( 'Architects Daughter', 'bb-ecommerce-store' ),
        'Arimo' => __( 'Arimo', 'bb-ecommerce-store' ),
        'Arsenal' => __( 'Arsenal', 'bb-ecommerce-store' ),
        'Arvo' => __( 'Arvo', 'bb-ecommerce-store' ),
        'Alegreya' => __( 'Alegreya', 'bb-ecommerce-store' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'bb-ecommerce-store' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'bb-ecommerce-store' ),
        'Bangers' => __( 'Bangers', 'bb-ecommerce-store' ),
        'Boogaloo' => __( 'Boogaloo', 'bb-ecommerce-store' ),
        'Bad Script' => __( 'Bad Script', 'bb-ecommerce-store' ),
        'Bitter' => __( 'Bitter', 'bb-ecommerce-store' ),
        'Bree Serif' => __( 'Bree Serif', 'bb-ecommerce-store' ),
        'BenchNine' => __( 'BenchNine', 'bb-ecommerce-store' ),
        'Cabin' => __( 'Cabin', 'bb-ecommerce-store' ),
        'Cardo' => __( 'Cardo', 'bb-ecommerce-store' ),
        'Courgette' => __( 'Courgette', 'bb-ecommerce-store' ),
        'Cherry Swash' => __( 'Cherry Swash', 'bb-ecommerce-store' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'bb-ecommerce-store' ),
        'Crimson Text' => __( 'Crimson Text', 'bb-ecommerce-store' ),
        'Cuprum' => __( 'Cuprum', 'bb-ecommerce-store' ),
        'Cookie' => __( 'Cookie', 'bb-ecommerce-store' ),
        'Chewy' => __( 'Chewy', 'bb-ecommerce-store' ),
        'Days One' => __( 'Days One', 'bb-ecommerce-store' ),
        'Dosis' => __( 'Dosis', 'bb-ecommerce-store' ),
        'Droid Sans' => __( 'Droid Sans', 'bb-ecommerce-store' ),
        'Economica' => __( 'Economica', 'bb-ecommerce-store' ),
        'Fredoka One' => __( 'Fredoka One', 'bb-ecommerce-store' ),
        'Fjalla One' => __( 'Fjalla One', 'bb-ecommerce-store' ),
        'Francois One' => __( 'Francois One', 'bb-ecommerce-store' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'bb-ecommerce-store' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'bb-ecommerce-store' ),
        'Great Vibes' => __( 'Great Vibes', 'bb-ecommerce-store' ),
        'Handlee' => __( 'Handlee', 'bb-ecommerce-store' ),
        'Hammersmith One' => __( 'Hammersmith One', 'bb-ecommerce-store' ),
        'Inconsolata' => __( 'Inconsolata', 'bb-ecommerce-store' ),
        'Indie Flower' => __( 'Indie Flower', 'bb-ecommerce-store' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'bb-ecommerce-store' ),
        'Julius Sans One' => __( 'Julius Sans One', 'bb-ecommerce-store' ),
        'Josefin Slab' => __( 'Josefin Slab', 'bb-ecommerce-store' ),
        'Josefin Sans' => __( 'Josefin Sans', 'bb-ecommerce-store' ),
        'Kanit' => __( 'Kanit', 'bb-ecommerce-store' ),
        'Lobster' => __( 'Lobster', 'bb-ecommerce-store' ),
        'Lato' => __( 'Lato', 'bb-ecommerce-store' ),
        'Lora' => __( 'Lora', 'bb-ecommerce-store' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'bb-ecommerce-store' ),
        'Lobster Two' => __( 'Lobster Two', 'bb-ecommerce-store' ),
        'Merriweather' => __( 'Merriweather', 'bb-ecommerce-store' ),
        'Monda' => __( 'Monda', 'bb-ecommerce-store' ),
        'Montserrat' => __( 'Montserrat', 'bb-ecommerce-store' ),
        'Muli' => __( 'Muli', 'bb-ecommerce-store' ),
        'Marck Script' => __( 'Marck Script', 'bb-ecommerce-store' ),
        'Noto Serif' => __( 'Noto Serif', 'bb-ecommerce-store' ),
        'Open Sans' => __( 'Open Sans', 'bb-ecommerce-store' ),
        'Overpass' => __( 'Overpass', 'bb-ecommerce-store' ),
        'Overpass Mono' => __( 'Overpass Mono', 'bb-ecommerce-store' ),
        'Oxygen' => __( 'Oxygen', 'bb-ecommerce-store' ),
        'Orbitron' => __( 'Orbitron', 'bb-ecommerce-store' ),
        'Patua One' => __( 'Patua One', 'bb-ecommerce-store' ),
        'Pacifico' => __( 'Pacifico', 'bb-ecommerce-store' ),
        'Padauk' => __( 'Padauk', 'bb-ecommerce-store' ),
        'Playball' => __( 'Playball', 'bb-ecommerce-store' ),
        'Playfair Display' => __( 'Playfair Display', 'bb-ecommerce-store' ),
        'PT Sans' => __( 'PT Sans', 'bb-ecommerce-store' ),
        'Philosopher' => __( 'Philosopher', 'bb-ecommerce-store' ),
        'Permanent Marker' => __( 'Permanent Marker', 'bb-ecommerce-store' ),
        'Poiret One' => __( 'Poiret One', 'bb-ecommerce-store' ),
        'Quicksand' => __( 'Quicksand', 'bb-ecommerce-store' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'bb-ecommerce-store' ),
        'Raleway' => __( 'Raleway', 'bb-ecommerce-store' ),
        'Rubik' => __( 'Rubik', 'bb-ecommerce-store' ),
        'Rokkitt' => __( 'Rokkitt', 'bb-ecommerce-store' ),
        'Russo One' => __( 'Russo One', 'bb-ecommerce-store' ),
        'Righteous' => __( 'Righteous', 'bb-ecommerce-store' ),
        'Slabo' => __( 'Slabo', 'bb-ecommerce-store' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'bb-ecommerce-store' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'bb-ecommerce-store'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'bb-ecommerce-store' ),
        'Sacramento' => __( 'Sacramento', 'bb-ecommerce-store' ),
        'Shrikhand' => __( 'Shrikhand', 'bb-ecommerce-store' ),
        'Tangerine' => __( 'Tangerine', 'bb-ecommerce-store' ),
        'Ubuntu' => __( 'Ubuntu', 'bb-ecommerce-store' ),
        'VT323' => __( 'VT323', 'bb-ecommerce-store' ),
        'Varela Round' => __( 'Varela Round', 'bb-ecommerce-store' ),
        'Vampiro One' => __( 'Vampiro One', 'bb-ecommerce-store' ),
        'Vollkorn' => __( 'Vollkorn', 'bb-ecommerce-store' ),
        'Volkhov' => __( 'Volkhov', 'bb-ecommerce-store' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'bb-ecommerce-store' )
    );

	//Typography
	$wp_customize->add_section( 'bb_ecommerce_store_typography', array(
    	'title'      => __( 'Typography', 'bb-ecommerce-store' ),
		'priority'   => 30,
		'panel' => 'bb_ecommerce_store_panel_id'
	) );
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'bb_ecommerce_store_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bb_ecommerce_store_paragraph_color', array(
		'label' => __('Paragraph Color', 'bb-ecommerce-store'),
		'section' => 'bb_ecommerce_store_typography',
		'settings' => 'bb_ecommerce_store_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('bb_ecommerce_store_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'bb_ecommerce_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'bb_ecommerce_store_paragraph_font_family', array(
	    'section'  => 'bb_ecommerce_store_typography',
	    'label'    => __( 'Paragraph Fonts','bb-ecommerce-store'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	$wp_customize->add_setting('bb_ecommerce_store_paragraph_font_size',array(
		'default'	=> '12px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('bb_ecommerce_store_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_typography',
		'setting'	=> 'bb_ecommerce_store_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'bb_ecommerce_store_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bb_ecommerce_store_atag_color', array(
		'label' => __('"a" Tag Color', 'bb-ecommerce-store'),
		'section' => 'bb_ecommerce_store_typography',
		'settings' => 'bb_ecommerce_store_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('bb_ecommerce_store_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'bb_ecommerce_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'bb_ecommerce_store_atag_font_family', array(
	    'section'  => 'bb_ecommerce_store_typography',
	    'label'    => __( '"a" Tag Fonts','bb-ecommerce-store'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'bb_ecommerce_store_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bb_ecommerce_store_li_color', array(
		'label' => __('"li" Tag Color', 'bb-ecommerce-store'),
		'section' => 'bb_ecommerce_store_typography',
		'settings' => 'bb_ecommerce_store_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('bb_ecommerce_store_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'bb_ecommerce_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'bb_ecommerce_store_li_font_family', array(
	    'section'  => 'bb_ecommerce_store_typography',
	    'label'    => __( '"li" Tag Fonts','bb-ecommerce-store'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'bb_ecommerce_store_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bb_ecommerce_store_h1_color', array(
		'label' => __('H1 Color', 'bb-ecommerce-store'),
		'section' => 'bb_ecommerce_store_typography',
		'settings' => 'bb_ecommerce_store_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('bb_ecommerce_store_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'bb_ecommerce_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'bb_ecommerce_store_h1_font_family', array(
	    'section'  => 'bb_ecommerce_store_typography',
	    'label'    => __( 'H1 Fonts','bb-ecommerce-store'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('bb_ecommerce_store_h1_font_size',array(
		'default'	=> '50px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('bb_ecommerce_store_h1_font_size',array(
		'label'	=> __('H1 Font Size','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_typography',
		'setting'	=> 'bb_ecommerce_store_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'bb_ecommerce_store_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bb_ecommerce_store_h2_color', array(
		'label' => __('h2 Color', 'bb-ecommerce-store'),
		'section' => 'bb_ecommerce_store_typography',
		'settings' => 'bb_ecommerce_store_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('bb_ecommerce_store_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'bb_ecommerce_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'bb_ecommerce_store_h2_font_family', array(
	    'section'  => 'bb_ecommerce_store_typography',
	    'label'    => __( 'h2 Fonts','bb-ecommerce-store'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('bb_ecommerce_store_h2_font_size',array(
		'default'	=> '45px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('bb_ecommerce_store_h2_font_size',array(
		'label'	=> __('h2 Font Size','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_typography',
		'setting'	=> 'bb_ecommerce_store_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'bb_ecommerce_store_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bb_ecommerce_store_h3_color', array(
		'label' => __('h3 Color', 'bb-ecommerce-store'),
		'section' => 'bb_ecommerce_store_typography',
		'settings' => 'bb_ecommerce_store_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('bb_ecommerce_store_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'bb_ecommerce_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'bb_ecommerce_store_h3_font_family', array(
	    'section'  => 'bb_ecommerce_store_typography',
	    'label'    => __( 'h3 Fonts','bb-ecommerce-store'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('bb_ecommerce_store_h3_font_size',array(
		'default'	=> '36px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('bb_ecommerce_store_h3_font_size',array(
		'label'	=> __('h3 Font Size','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_typography',
		'setting'	=> 'bb_ecommerce_store_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'bb_ecommerce_store_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bb_ecommerce_store_h4_color', array(
		'label' => __('h4 Color', 'bb-ecommerce-store'),
		'section' => 'bb_ecommerce_store_typography',
		'settings' => 'bb_ecommerce_store_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('bb_ecommerce_store_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'bb_ecommerce_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'bb_ecommerce_store_h4_font_family', array(
	    'section'  => 'bb_ecommerce_store_typography',
	    'label'    => __( 'h4 Fonts','bb-ecommerce-store'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('bb_ecommerce_store_h4_font_size',array(
		'default'	=> '30px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('bb_ecommerce_store_h4_font_size',array(
		'label'	=> __('h4 Font Size','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_typography',
		'setting'	=> 'bb_ecommerce_store_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'bb_ecommerce_store_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bb_ecommerce_store_h5_color', array(
		'label' => __('h5 Color', 'bb-ecommerce-store'),
		'section' => 'bb_ecommerce_store_typography',
		'settings' => 'bb_ecommerce_store_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('bb_ecommerce_store_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'bb_ecommerce_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'bb_ecommerce_store_h5_font_family', array(
	    'section'  => 'bb_ecommerce_store_typography',
	    'label'    => __( 'h5 Fonts','bb-ecommerce-store'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('bb_ecommerce_store_h5_font_size',array(
		'default'	=> '25px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('bb_ecommerce_store_h5_font_size',array(
		'label'	=> __('h5 Font Size','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_typography',
		'setting'	=> 'bb_ecommerce_store_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'bb_ecommerce_store_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bb_ecommerce_store_h6_color', array(
		'label' => __('h6 Color', 'bb-ecommerce-store'),
		'section' => 'bb_ecommerce_store_typography',
		'settings' => 'bb_ecommerce_store_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('bb_ecommerce_store_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'bb_ecommerce_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'bb_ecommerce_store_h6_font_family', array(
	    'section'  => 'bb_ecommerce_store_typography',
	    'label'    => __( 'h6 Fonts','bb-ecommerce-store'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('bb_ecommerce_store_h6_font_size',array(
		'default'	=> '18px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('bb_ecommerce_store_h6_font_size',array(
		'label'	=> __('h6 Font Size','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_typography',
		'setting'	=> 'bb_ecommerce_store_h6_font_size',
		'type'	=> 'text'
	));

    //Topbar section
	$wp_customize->add_section('bb_ecommerce_store_topbar',array(
		'title'	=> __('Topbar Section','bb-ecommerce-store'),
		'description'	=> __('Add Header Content here','bb-ecommerce-store'),
		'priority'	=> null,
		'panel' => 'bb_ecommerce_store_panel_id',
	));

	$wp_customize->add_setting('bb_ecommerce_store_contact',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('bb_ecommerce_store_contact',array(
		'label'	=> __('Add Phone Number','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_topbar',
		'setting'	=> 'bb_ecommerce_store_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('bb_ecommerce_store_email',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('bb_ecommerce_store_email',array(
		'label'	=> __('Add Email','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_topbar',
		'setting'	=> 'bb_ecommerce_store_email',
		'type'		=> 'text'
	));

	//Social Icons(topbar)
	$wp_customize->add_section('bb_ecommerce_store_social',array(
		'title'	=> __('Social Icon Section','bb-ecommerce-store'),
		'description'	=> __('Add Header Content here','bb-ecommerce-store'),
		'priority'	=> null,
		'panel' => 'bb_ecommerce_store_panel_id',
	));

	$wp_customize->add_setting('bb_ecommerce_store_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	) );
	
	$wp_customize->add_control('bb_ecommerce_store_youtube_url',array(
		'label'	=> __('Add Youtube link','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_social',
		'setting'	=> 'bb_ecommerce_store_youtube_url',
		'type'		=> 'url'
	) );

	$wp_customize->add_setting('bb_ecommerce_store_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	) );
	
	$wp_customize->add_control('bb_ecommerce_store_facebook_url',array(
		'label'	=> __('Add Facebook link','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_social',
		'setting'	=> 'bb_ecommerce_store_facebook_url',
		'type'	=> 'url'
	) );

	$wp_customize->add_setting('bb_ecommerce_store_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	) );
	
	$wp_customize->add_control('bb_ecommerce_store_twitter_url',array(
		'label'	=> __('Add Twitter link','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_social',
		'setting'	=> 'bb_ecommerce_store_twitter_url',
		'type'	=> 'url'
	) );

	$wp_customize->add_setting('bb_ecommerce_store_rss_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	) );
	
	$wp_customize->add_control('bb_ecommerce_store_rss_url',array(
		'label'	=> __('Add RSS link','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_social',
		'setting'	=> 'bb_ecommerce_store_rss_url',
		'type'	=> 'url'
	) );

    //home page slider
	$wp_customize->add_section( 'bb_ecommerce_store_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'bb-ecommerce-store' ),
		'priority'   => 30,
		'panel' => 'bb_ecommerce_store_panel_id'
	) );

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'bb_ecommerce_store_slidersettings-page-' . $count, array(
				'default'           => '',
				'sanitize_callback' => 'bb_ecommerce_store_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'bb_ecommerce_store_slidersettings-page-' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'bb-ecommerce-store' ),
			'section'  => 'bb_ecommerce_store_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//OUR services
	$wp_customize->add_section('bb_ecommerce_store_product',array(
		'title'	=> __('Products','bb-ecommerce-store'),
		'description'=> __('This section will appear below the slider.','bb-ecommerce-store'),
		'panel' => 'bb_ecommerce_store_panel_id',
	));
	
	
	$wp_customize->add_setting('bb_ecommerce_store_sec1_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('bb_ecommerce_store_sec1_title',array(
		'label'	=> __('Section Title','bb-ecommerce-store'),
		'section'=> 'bb_ecommerce_store_product',
		'setting'=> 'bb_ecommerce_store_sec1_title',
		'type'=> 'text'
	));	

	for ( $count = 0; $count <= 0; $count++ ) {

		$wp_customize->add_setting( 'bb_ecommerce_store_servicesettings-page-' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'bb_ecommerce_store_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'bb_ecommerce_store_servicesettings-page-' . $count, array(
			'label'    => __( 'Select Page', 'bb-ecommerce-store' ),
			'section'  => 'bb_ecommerce_store_product',
			'type'     => 'dropdown-pages'
		));
	}

	//footer
	$wp_customize->add_section('bb_ecommerce_store_footer_section',array(
		'title'	=> __('Footer Text','bb-ecommerce-store'),
		'description'	=> __('Add some text for footer like copyright etc.','bb-ecommerce-store'),
		'priority'	=> null,
		'panel' => 'bb_ecommerce_store_panel_id',
	));
	
	$wp_customize->add_setting('bb_ecommerce_store_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('bb_ecommerce_store_footer_copy',array(
		'label'	=> __('Copyright Text','bb-ecommerce-store'),
		'section'	=> 'bb_ecommerce_store_footer_section',
		'type'		=> 'text'
	));
	
	
}
add_action( 'customize_register', 'bb_ecommerce_store_customize_register' );	


/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class BB_Ecommerce_Store_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'BB_Ecommerce_Store_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new BB_Ecommerce_Store_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'BB Ecommerce Pro', 'bb-ecommerce-store' ),
					'pro_text' => esc_html__( 'Go Pro',         'bb-ecommerce-store' ),
					'pro_url'  => esc_url('https://www.themeshopy.com/premium/ecommerce-store-wordpress-theme/')
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'bb-ecommerce-store-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'bb-ecommerce-store-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
BB_Ecommerce_Store_Customize::get_instance();