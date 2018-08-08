<?php
/**
 * General settings.
 *
 * @package Baltic
 */

/**
 * Baltic general settings class.
 *
 * @since  1.0.0
 */
class Baltic_Settings_General {

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Settings_General
	 */
	private static $_instance;

	/**
	 * Holds settings defaults, populated in constructor.
	 *
	 * @access private
	 * @var array
	 */
	private $default;

	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Settings_General An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->default = Baltic_Options::defaults();

		add_filter( 'kirki_config', array( $this, 'config' ) );
		add_filter( 'kirki_dynamic_css_method', array( $this, 'use_css_file' ) );
		add_action( 'init', array( $this, 'add_config' ) );

		add_action( 'init', array( $this, 'preloader' ) );
		add_action( 'init', array( $this, 'layout' ) );
		add_action( 'init', array( $this, 'blog_post' ) );
		add_action( 'init', array( $this, 'footer' ) );

	}

	/**
	 * Kirki config
	 *
	 * @param  arrya $config kirki config
	 * @return array
	 */
	public function config( $config ) {

		return wp_parse_args( array(
			'disable_loader'	=> true
		), $config );

	}

	/**
	 * Use css file instead of print css.
	 *
	 * @return string file
	 */
	public function use_css_file() {
		return 'file';
	}

	/**
	 * [add_config description]
	 */
	public function add_config() {

		Kirki::add_config( 'baltic', array(
			'capability'  => 'edit_theme_options',
			'option_type' => 'theme_mod',
		) );

	}

	/**
	 * Preloader settings.
	 *
	 * @return [type] [description]
	 */
	public function preloader() {

		Kirki::add_section( 'baltic_preloader_section', array(
		    'title'         => esc_html__( 'Preloader', 'baltic' ),
		    'panel'         => 'baltic_setting_panel',
		) );

		Kirki::add_field( 'baltic', array(
			'type' 			=> 'switch',
			'settings'    	=> 'preloader',
			'label'       	=> esc_html__( 'Enable Preloader', 'baltic' ),
			'section'     	=> 'baltic_preloader_section',
			'default'     	=> '1',
			'priority'    	=> 10,
			'choices'     	=> array(
				'on'  => esc_html__( 'On', 'baltic' ),
				'off' => esc_html__( 'Off', 'baltic' ),
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'select',
			'settings'    => 'preloader_type',
			'label'       => esc_html__( 'Preloader Effect', 'baltic' ),
			'section'     => 'baltic_preloader_section',
			'default'     => $this->default['preloader_type'],
			'multiple'    => 1,
			'choices'     => array(
				"rotating-plane"	=> esc_html__( 'rotating-plane', 'baltic' ),
				"double-bounce"		=> esc_html__( 'double-bounce', 'baltic' ),
				"wave"				=> esc_html__( 'wave', 'baltic' ),
				"wandering-cubes"	=> esc_html__( 'wandering-cubes', 'baltic' ),
				"pulse"				=> esc_html__( 'pulse', 'baltic' ),
				"chasing-dots"		=> esc_html__( 'chasing-dots', 'baltic' ),
				"three-bounce"		=> esc_html__( 'three-bounce', 'baltic' ),
				"circle"			=> esc_html__( 'circle', 'baltic' ),
				"cube-grid"			=> esc_html__( 'cube-grid', 'baltic' ),
				"fading-circle"		=> esc_html__( 'fading-circle', 'baltic' ),
				"folding-cube"		=> esc_html__( 'folding-cube', 'baltic' ),
			),
			'active_callback'    => array(
				array(
					'setting'  => 'preloader',
					'operator' => '==',
					'value'    => true,
				),
			),
			'transport'			=> 'auto',
			'partial_refresh' 	=> array(
				'preloader_type' => array(
					'selector'        		=> '.spinner',
					'render_callback' 		=> array( 'Baltic_Components', 'get_preloader' ),
					'container_inclusive' 	=> true
				),
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'preloader_bg_color',
			'label'       	=> esc_html__( 'Preloader background color', 'baltic' ),
			'section'     	=> 'baltic_preloader_section',
			'default'     	=> $this->default['preloader_bg_color'],
			'priority'    	=> 10,
			'choices'     	=> array( 'alpha' => true ),
			'transport'		=> 'auto',
			'active_callback'    => array(
				array(
					'setting'  => 'preloader',
					'operator' => '==',
					'value'    => true,
				),
			),
			'output' => array(
				array(
					'element'  => '.site-preloader',
					'property' => 'background-color',
				),
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'preloader_color',
			'label'       	=> esc_html__( 'Preloader color', 'baltic' ),
			'section'     	=> 'baltic_preloader_section',
			'default'     	=> $this->default['preloader_color'],
			'priority'    	=> 10,
			'choices'     	=> array( 'alpha' => true ),
			'transport'		=> 'auto',
			'active_callback'    => array(
				array(
					'setting'  => 'preloader',
					'operator' => '==',
					'value'    => true,
				),
			),
			'output'   		=> array(
				array(
					'element'  => Baltic_CSS::preloader(),
					'property' => 'background-color',
				),
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'switch',
			'settings'    	=> 'show_preloader',
			'label'       	=> esc_html__( 'Preview Preloader', 'baltic' ),
			'section'     	=> 'baltic_preloader_section',
			'default'     	=> false,
			'transport'		=> 'postMessage',
			'active_callback'    => array(
				array(
					'setting'  => 'preloader',
					'operator' => '==',
					'value'    => true,
				),
			),
			'choices'     => array(
				'on'  => esc_html__( 'Show', 'baltic' ),
				'off' => esc_html__( 'Hide', 'baltic' ),
			),
		) );

	}

	/**
	 * Layout settings.
	 *
	 * @return void
	 */
	public function layout() {

		Kirki::add_section( 'baltic_layout_section', array(
		    'title'         => esc_html__( 'Layout', 'baltic' ),
		    'panel'         => 'baltic_setting_panel',
		    'priority' 		=> 99
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'select',
			'settings'    	=> 'layout_archive',
			'label'       	=> esc_html__( 'Archives Layout', 'baltic' ),
			'section'     	=> 'baltic_layout_section',
			'default'     	=> $this->default['layout_archive'],
			'transport'		=> 'postMessage',
			'choices' 		=> Baltic_Utility::get_main_layout(),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'select',
			'settings'    	=> 'layout_post',
			'label'       	=> esc_html__( 'Single Post Layout', 'baltic' ),
			'section'     	=> 'baltic_layout_section',
			'default'     	=> $this->default['layout_post'],
			'transport'		=> 'postMessage',
			'choices' 		=> Baltic_Utility::get_main_layout(),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'select',
			'settings'    	=> 'layout_page',
			'label'       	=> esc_html__( 'Single Page Layout', 'baltic' ),
			'section'     	=> 'baltic_layout_section',
			'default'     	=> $this->default['layout_page'],
			'transport'		=> 'postMessage',
			'choices' 		=> Baltic_Utility::get_main_layout(),
		) );

	}

	/**
	 * Blog settings.
	 *
	 * @return void
	 */
	public function blog_post() {

		Kirki::add_section( 'baltic_blog_section', array(
		    'title'         => esc_html__( 'Blog Post', 'baltic' ),
		    'panel'         => 'baltic_setting_panel',
		    'priority' 		=> 99
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'image',
			'settings'    => 'thumb_placeholder',
			'label'       => esc_html__( 'Post thumbnail placeholder', 'baltic' ),
			'section'     => 'baltic_blog_section',
			'default'     => '',
			'choices'     => array(
				'save_as' => 'id',
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'checkbox',
			'settings'    	=> 'meta_date',
			'label'       	=> esc_html__( 'Display Date?', 'baltic' ),
			'section'     	=> 'baltic_blog_section',
			'default'     	=> $this->default['meta_date'],
			'transport'		=> 'postMessage',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'checkbox',
			'settings'    	=> 'meta_author',
			'label'       	=> esc_html__( 'Display Author?', 'baltic' ),
			'section'     	=> 'baltic_blog_section',
			'default'     	=> $this->default['meta_author'],
			'transport'		=> 'postMessage',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'checkbox',
			'settings'    	=> 'meta_comment',
			'label'       	=> esc_html__( 'Display Comments?', 'baltic' ),
			'section'     	=> 'baltic_blog_section',
			'default'     	=> $this->default['meta_comment'],
			'transport'		=> 'postMessage',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'checkbox',
			'settings'    	=> 'meta_categories',
			'label'       	=> esc_html__( 'Display Categories?', 'baltic' ),
			'section'     	=> 'baltic_blog_section',
			'default'     	=> $this->default['meta_categories'],
			'transport'		=> 'postMessage',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'checkbox',
			'settings'    	=> 'meta_tags',
			'label'       	=> esc_html__( 'Display Tags?', 'baltic' ),
			'section'     	=> 'baltic_blog_section',
			'default'     	=> $this->default['meta_tags'],
			'transport'		=> 'postMessage',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'checkbox',
			'settings'    	=> 'author_profile',
			'label'       	=> esc_html__( 'Display Author Profile?', 'baltic' ),
			'section'     	=> 'baltic_blog_section',
			'default'     	=> $this->default['author_profile'],
			'transport'		=> 'postMessage',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'number',
			'settings'    	=> 'excerpt_length',
			'label'       	=> esc_html__( 'Excerpt Length', 'baltic' ),
			'section'     	=> 'baltic_blog_section',
			'default'     	=> $this->default['excerpt_length'],
			'choices'     	=> array(
				'min'  => 0,
				'max'  => 9999,
				'step' => 1,
			),
			'transport'		=> 'postMessage',
			'partial_refresh' => array(
				'excerpt_length' => array(
					'selector'        		=> '.content-area:not(.is-woocommerce) .site-main',
					'render_callback' 		=> array( 'Baltic_Components', 'loop_index' )
				),
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'text',
			'settings'    	=> 'more_link_text',
			'label'       	=> esc_html__( 'More Link Text', 'baltic' ),
			'section'     	=> 'baltic_blog_section',
			'default'     	=> $this->default['more_link_text'],
			'transport'		=> 'postMessage',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'select',
			'settings'    	=> 'nav_posts',
			'label'       	=> esc_html__( 'Posts Navigation Type', 'baltic' ),
			'section'     	=> 'baltic_blog_section',
			'default'     	=> $this->default['nav_posts'],
			'transport'		=> 'postMessage',
			'choices' 		=> array(
				'posts_navigation'  => esc_html__( 'Previous/Next', 'baltic' ),
				'posts_pagination' 	=> esc_html__( 'Pagination', 'baltic' ),
			),
			'partial_refresh' => array(
				'nav_posts' => array(
					'selector'        		=> '.content-area:not(.is-woocommerce) .navigation ',
					'render_callback' 		=> array( 'Baltic_Components', 'nav_posts' ),
					'container_inclusive' 	=> true
				),
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'text',
			'settings'    	=> 'nav_posts_prev',
			'label'       	=> esc_html__( 'Previous Post Text', 'baltic' ),
			'section'     	=> 'baltic_blog_section',
			'default'     	=> $this->default['nav_posts_prev'],
			'transport'		=> 'postMessage',
			'active_callback'    => array(
				array(
					'setting'  => 'nav_posts',
					'operator' => '===',
					'value'    => 'posts_navigation',
				),
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'text',
			'settings'    	=> 'nav_posts_next',
			'label'       	=> esc_html__( 'Next Post Text', 'baltic' ),
			'section'     	=> 'baltic_blog_section',
			'default'     	=> $this->default['nav_posts_next'],
			'transport'		=> 'postMessage',
			'active_callback'    => array(
				array(
					'setting'  => 'nav_posts',
					'operator' => '===',
					'value'    => 'posts_navigation',
				),
			),
		) );

	}

	/**
	 * Footer Settings.
	 *
	 * @return [type] [description]
	 */
	public function footer() {

		Kirki::add_section( 'baltic_footer_section', array(
		    'title'         => esc_html__( 'Footer', 'baltic' ),
		    'panel'         => 'baltic_setting_panel',
		    'priority' 		=> 99
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'number',
			'settings'    	=> 'footer_widgets_col',
			'label'       	=> esc_html__( 'Footer widgets columns', 'baltic' ),
			'section'     	=> 'baltic_footer_section',
			'default'     	=> $this->default['footer_widgets_col'],
			'choices'     	=> array(
				'min'  => 1,
				'max'  => 6,
				'step' => 1,
			),
			'transport'		=> 'postMessage',
			'partial_refresh' => array(
				'footer_widgets_col' => array(
					'selector'        		=> '#tertiary',
					'render_callback' 		=> array( 'Baltic_Components', 'sidebar_footer' ),
					'container_inclusive' 	=> true
				),
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'textarea',
			'settings'    => 'footer_text',
			'label'       => esc_html__( 'Footer Text', 'baltic' ),
			'section'     => 'baltic_footer_section',
			'default'     => $this->default['footer_text'],
			'partial_refresh' => array(
				'footer_text' => array(
					'selector'        		=> '.site-footer .site-info',
					'render_callback' 		=> array( 'Baltic_Components', 'footer_copyright' ),
					'container_inclusive' 	=> true
				),
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type' 			=> 'switch',
			'settings'    	=> 'footer_credits',
			'label'       	=> esc_html__( 'Display theme designer?', 'baltic' ),
			'section'     	=> 'baltic_footer_section',
			'default'     	=> $this->default['footer_credits'],
			'transport'		=> 'postMessage',
			'choices'     	=> array(
				'on'  => esc_html__( 'On', 'baltic' ),
				'off' => esc_html__( 'Off', 'baltic' ),
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'select',
			'settings'    	=> 'payment_icons',
			'label'       	=> esc_html__( 'Payment icons', 'baltic' ),
			'section'     	=> 'baltic_footer_section',
			'default'     	=> '',
			'multiple'    	=> 13,
			'choices'     	=> Baltic_Utility::get_payment_icons(),
			'transport' 	=> 'auto',
			'partial_refresh' => array(
				'payment_icons' => array(
					'selector'        		=> '.footer-payments-card',
					'render_callback' 		=> array( 'Baltic_Components', 'payment_icons' ),
					'container_inclusive' 	=> true
				),
			),
		) );

	}

}
