<?php
/**
 * VW Newspaper Theme Customizer
 *
 * @package VW Newspaper
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_newspaper_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_newspaper_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-newspaper' ),
	    'description' => __( 'Description of what this panel does.', 'vw-newspaper' ),
	) );

	$wp_customize->add_section( 'vw_newspaper_left_right', array(
    	'title'      => __( 'General Settings', 'vw-newspaper' ),
		'priority'   => 30,
		'panel' => 'vw_newspaper_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_newspaper_theme_options',array(
        'default' => __('Right Sidebar','vw-newspaper'),
        'sanitize_callback' => 'vw_newspaper_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_newspaper_theme_options',array(
        'type' => 'radio',
        'label' => __('Do you want this section','vw-newspaper'),
        'section' => 'vw_newspaper_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-newspaper'),
            'Right Sidebar' => __('Right Sidebar','vw-newspaper'),
            'One Column' => __('One Column','vw-newspaper'),
            'Three Columns' => __('Three Columns','vw-newspaper'),
            'Four Columns' => __('Four Columns','vw-newspaper'),
            'Grid Layout' => __('Grid Layout','vw-newspaper')
        ),
	)   );
    
	//Todays Headline
	$wp_customize->add_section('vw_newspaper_headline_section',array(
		'title'	=> __('Todays Headline','vw-newspaper'),
		'description'=> __('This section will appear below the slider.','vw-newspaper'),
		'panel' => 'vw_newspaper_panel_id',
	));	
	
	$wp_customize->add_setting('vw_newspaper_headline_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_newspaper_headline_title',array(
		'label'	=> __('Section Title','vw-newspaper'),
		'section'=> 'vw_newspaper_headline_section',
		'setting'=> 'vw_newspaper_headline_title',
		'type'=> 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_newspaper_headline_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_newspaper_sanitize_choices',
	));
	$wp_customize->add_control('vw_newspaper_headline_category',array(
		'type'    => 'select',
		'choices' => $cats,
		'label' => __('Select Category to display Latest Post','vw-newspaper'),
		'section' => 'vw_newspaper_headline_section',
	));

	//Our Blog Category section
  	$wp_customize->add_section('vw_newspaper_category_section',array(
	    'title' => __('Category Section','vw-newspaper'),
	    'description' => '',
	    'priority'  => null,
	    'panel' => 'vw_newspaper_panel_id',
	)); 

	$categories = get_categories();
	$cats = array();
	$i = 0;
  	foreach($categories as $category){
  	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_newspaper_category',array(
	    'default' => 'select',
	    'sanitize_callback' => 'vw_newspaper_sanitize_choices',
  	));

  	$wp_customize->add_control('vw_newspaper_category',array(
	    'type'    => 'select',
	    'choices' => $cats,
	    'label' => __('Select Category to display Latest Post','vw-newspaper'),
	    'section' => 'vw_newspaper_category_section',
	));

	//Footer Text
	$wp_customize->add_section('vw_newspaper_footer',array(
		'title'	=> __('Footer','vw-newspaper'),
		'description'=> __('This section will appear in the footer','vw-newspaper'),
		'panel' => 'vw_newspaper_panel_id',
	));	
	
	$wp_customize->add_setting('vw_newspaper_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_newspaper_footer_text',array(
		'label'	=> __('Copyright Text','vw-newspaper'),
		'section'=> 'vw_newspaper_footer',
		'setting'=> 'vw_newspaper_footer_text',
		'type'=> 'text'
	));	
}

add_action( 'customize_register', 'vw_newspaper_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Newspaper_Customize {

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
		$manager->register_section_type( 'VW_Newspaper_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new VW_Newspaper_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'VW Newspaper Pro', 'vw-newspaper' ),
					'pro_text' => esc_html__( 'Upgrade Pro', 'vw-newspaper' ),
					'pro_url'  => esc_url('https://www.vwthemes.com/themes/newspaper-wordpress-theme/'),
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

		wp_enqueue_script( 'vw-newspaper-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-newspaper-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Newspaper_Customize::get_instance();