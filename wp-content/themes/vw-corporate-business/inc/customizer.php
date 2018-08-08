<?php
/**
 * VW Corporate Business Theme Customizer
 *
 * @package VW Corporate Business
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_corporate_business_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_corporate_business_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-corporate-business' ),
	    'description' => __( 'Description of what this panel does.', 'vw-corporate-business' ),
	) );

	$wp_customize->add_section( 'vw_corporate_business_left_right', array(
    	'title'      => __( 'General Settings', 'vw-corporate-business' ),
		'priority'   => 30,
		'panel' => 'vw_corporate_business_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_corporate_business_theme_options',array(
        'default' => __('Right Sidebar','vw-corporate-business'),
        'sanitize_callback' => 'vw_corporate_business_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_corporate_business_theme_options',array(
        'type' => 'radio',
        'label' => __('Do you want this section','vw-corporate-business'),
        'section' => 'vw_corporate_business_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-corporate-business'),
            'Right Sidebar' => __('Right Sidebar','vw-corporate-business'),
            'One Column' => __('One Column','vw-corporate-business'),
            'Three Columns' => __('Three Columns','vw-corporate-business'),
            'Four Columns' => __('Four Columns','vw-corporate-business'),
            'Grid Layout' => __('Grid Layout','vw-corporate-business')
        ),
	)   );
    
	//Topbar section
	$wp_customize->add_section('vw_corporate_business_topbar',array(
		'title'	=> __('Topbar Section','vw-corporate-business'),
		'description'	=> __('Add TopBar Content here','vw-corporate-business'),
		'priority'	=> null,
		'panel' => 'vw_corporate_business_panel_id',
	));

	$wp_customize->add_setting('vw_corporate_business_location',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_corporate_business_location',array(
		'label'	=> __('Add Location Address','vw-corporate-business'),
		'section'	=> 'vw_corporate_business_topbar',
		'setting'	=> 'vw_corporate_business_location',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_corporate_business_call',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_corporate_business_call',array(
		'label'	=> __('Add Call Number','vw-corporate-business'),
		'section'	=> 'vw_corporate_business_topbar',
		'setting'	=> 'vw_corporate_business_call',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_corporate_business_email',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_corporate_business_email',array(
		'label'	=> __('Add Email Address','vw-corporate-business'),
		'section'	=> 'vw_corporate_business_topbar',
		'setting'	=> 'vw_corporate_business_email',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_corporate_business_started_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_corporate_business_started_text',array(
		'label'	=> __('Add Get Started Text','vw-corporate-business'),
		'section'	=> 'vw_corporate_business_topbar',
		'setting'	=> 'vw_corporate_business_started_text',
		'type'		=> 'text'
	));	

	$wp_customize->add_setting('vw_corporate_business_started_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_corporate_business_started_link',array(
		'label'	=> __('Add Get Started Link','vw-corporate-business'),
		'section'	=> 'vw_corporate_business_topbar',
		'setting'	=> 'vw_corporate_business_started_link',
		'type'		=> 'text'
	));	

	//Slider
	$wp_customize->add_section( 'vw_corporate_business_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-corporate-business' ),
		'priority'   => null,
		'panel' => 'vw_corporate_business_panel_id'
	) );

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_corporate_business_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_corporate_business_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_corporate_business_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'vw-corporate-business' ),
			'section'  => 'vw_corporate_business_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	// About Us
	$wp_customize->add_section('vw_corporate_business_about_section',array(
		'title'	=> __('About Section','vw-corporate-business'),
		'description'	=> __('Add About sections below.','vw-corporate-business'),
		'panel' => 'vw_corporate_business_panel_id',
	));

	$post_list = get_posts();
	$i = 0;
	foreach($post_list as $post){
		$posts[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('vw_corporate_business_about_post',array(
		'sanitize_callback' => 'vw_corporate_business_sanitize_choices',
	));
	$wp_customize->add_control('vw_corporate_business_about_post',array(
		'type'    => 'select',
		'choices' => $posts,
		'label' => __('Select post','vw-corporate-business'),
		'section' => 'vw_corporate_business_about_section',
	));

	//Footer Text
	$wp_customize->add_section('vw_corporate_business_footer',array(
		'title'	=> __('Footer','vw-corporate-business'),
		'description'=> __('This section will appear in the footer','vw-corporate-business'),
		'panel' => 'vw_corporate_business_panel_id',
	));	
	
	$wp_customize->add_setting('vw_corporate_business_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_corporate_business_footer_text',array(
		'label'	=> __('Copyright Text','vw-corporate-business'),
		'section'=> 'vw_corporate_business_footer',
		'setting'=> 'vw_corporate_business_footer_text',
		'type'=> 'text'
	));	
}

add_action( 'customize_register', 'vw_corporate_business_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Corporate_Business_Customize {

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
		$manager->register_section_type( 'VW_Corporate_Business_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new VW_Corporate_Business_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Business Pro Theme', 'vw-corporate-business' ),
					'pro_text' => esc_html__( 'Upgrade Pro', 'vw-corporate-business' ),
					'pro_url'  => esc_url('https://www.vwthemes.com/themes/wordpress-themes-for-business/'),
				)
			)
		);

		$manager->add_section(
			new VW_Corporate_Business_Customize_Section_Pro(
				$manager,
				'example_2',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Documentation', 'vw-corporate-business' ),
					'pro_text' => esc_html__( 'Docs', 'vw-corporate-business' ),
					'pro_url'  => admin_url('themes.php?page=vw_corporate_business_guide'),
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

		wp_enqueue_script( 'vw-corporate-business-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-corporate-business-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Corporate_Business_Customize::get_instance();