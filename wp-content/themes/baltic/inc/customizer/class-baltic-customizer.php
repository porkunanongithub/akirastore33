<?php
/**
 * Baltic Customizer.
 *
 * @package Baltic
 */

/**
 * Baltic Customizer class.
 *
 * @since  1.0.0
 */
class Baltic_Customizer {

	/**
	 * Holds settings defaults, populated in constructor.
	 *
	 * @access private
	 * @var array
	 */
	private $suffix;

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Customizer
	 */
	private static $_instance;


	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Customizer An instance of the class.
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

		$this->suffix = Baltic_Utility::get_min_suffix();

		add_action( 'customize_preview_init', array( $this, 'preview_js' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'controls_script' ), 15 );

		add_action( 'customize_register', array( $this, 'register' ) );

		$this->init_settings();

		add_action( 'wp_enqueue_scripts', array( $this, 'inline_style' ) );
		add_filter( 'tiny_mce_before_init', array( $this, 'editor_style' ) );

	}

	/**
	 * Initiate Baltic theme settings.
	 *
	 * @return void
	 */
	public function init_settings() {

		Baltic_Kirki::instance();

		if ( class_exists( 'Kirki' ) ) {
			Baltic_Settings_General::instance();
			Baltic_Settings_Color::instance();
			Baltic_Settings_Typography::instance();
			Baltic_Settings_WooCommerce::instance();
		}

	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	public function preview_js() {

		wp_enqueue_script( 'baltic-customizer',
			BALTIC_URI . "/assets/js/customizer{$this->suffix}.js",
			array( 'customize-preview', 'customize-selective-refresh' ),
			BALTIC_THEME_VERSION,
			true
		);

	}

	/**
	 * Additional customizer control scripts.
	 *
	 * @return void
	 */
	public function controls_script() {

		wp_enqueue_script( 'baltic-customizer-control',
			BALTIC_URI . "/assets/js/customizer-control{$this->suffix}.js",
			array(),
			BALTIC_THEME_VERSION,
			true
		);

	}

	/**
	 * Change default customizer panels, sections and transport.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @return void
	 */
	public function register( $wp_customize ) {

		$wp_customize->add_panel( 'baltic_setting_panel', array(
			'title' 		=> esc_html__( 'Theme Settings', 'baltic' ),
			'priority' 		=> 199,
		) );

		$wp_customize->add_panel( 'baltic_typograhy_panel', array(
			'title' 		=> esc_html__( 'Typography', 'baltic' ),
			'priority' 		=> 199,
		) );

		$wp_customize->add_panel( 'baltic_colors_panel', array(
			'title' 		=> esc_html__( 'Colors', 'baltic' ),
			'priority' 		=> 199,
		) );

		/** WP */
		$wp_customize->get_section( 'title_tagline' )->panel 		= 'baltic_setting_panel';
		$wp_customize->get_section( 'header_image' )->panel 		= 'baltic_setting_panel';
		$wp_customize->get_section( 'background_image' )->panel 	= 'baltic_setting_panel';
		$wp_customize->get_control( 'header_textcolor' )->section 	= 'baltic_header_color_section';
		$wp_customize->get_control( 'background_color' )->section 	= 'baltic_bg_color_section';

		$wp_settings = array(
			'blogname',
			'blogdescription',
			'header_textcolor',
			'header_image',
			'header_image_data',
		);
		foreach ( $wp_settings as $wp_setting ) {
			$wp_customize->get_setting( $wp_setting )->transport = 'postMessage';
		}

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector'        => '.site-title a',
				'render_callback' => array( 'Baltic_Components', 'blogname' ),
			) );
			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector'        => '.site-description',
				'render_callback' => array( 'Baltic_Components', 'blogdescription' ),
			) );
		}

	}

	/**
	 * Header style callback.
	 *
	 * @return string css
	 */
	public static function header_style() {

		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.

		$css = '';

		if ( ! display_header_text() ) {
			$css .= '
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			';
		}

		$css .= '
		.site-title a,
		.site-description,
		.site-header-extra a,
		.main-navigation ul.menu>.menu-item>a,
		.menu-toggle,
		.menu-toggle:focus,
		.menu-toggle:hover,
		.toggled .menu-toggle,
		.site-header-extra a,
		.header-menu-toggle {
			color: #'. esc_attr( $header_text_color ) .'!important;
		}
		';

	    $css = str_replace( array( "\n", "\t", "\r" ), '', $css );

		if ( ! empty( $css ) ) {
			return trim( $css );
		}

	}

	/**
	 * Inline style.
	 *
	 * @return string css
	 */
	public function inline_style() {

		$css= '';

		$css .= self::header_style();

	    $css = str_replace( array( "\n", "\t", "\r" ), '', $css );

		if ( ! empty( $css ) ) {
			wp_add_inline_style( 'baltic-style', apply_filters( 'baltic_inline_style', trim( $css ) ) );
		}

	}

	/**
	 * Print dynamic style for the editor.
	 *
	 * @return string css
	 */
	public function editor_style( $mceInit ) {

		$color_text_primary 	= Baltic_Options::get_option( 'color_text_primary' );
		$color_text_secondary 	= Baltic_Options::get_option( 'color_text_secondary' );
		$color_link_primary 	= Baltic_Options::get_option( 'color_link_primary' );
		$color_link_secondary 	= Baltic_Options::get_option( 'color_link_secondary' );
		$color_bg_highlight 	= Baltic_Options::get_option( 'color_bg_highlight' );
		$color_text_highlight 	= Baltic_Options::get_option( 'color_text_highlight' );

		$styles = '';
		$styles .= 'body.mce-content-body { color: ' . esc_attr( $color_text_primary ) . '; }';
		$styles .= 'body.mce-content-body a{ color: ' . esc_attr( $color_link_primary ) . '; }';
		$styles .= 'body.mce-content-body a:hover, .mce-content-body a:focus{ color: ' . esc_attr( $color_link_secondary ) . '; }';
		$styles .= 'body.mce-content-body ::selection{ background-color: ' . esc_attr( $color_bg_highlight ) . '; color: '. esc_attr( $color_text_highlight ) .' }';
		$styles .= 'body.mce-content-body ::-mozselection{ background-color: ' . esc_attr( $color_bg_highlight ) . '; color: '. esc_attr( $color_text_highlight ) .' }';

		$styles = str_replace( array( "\n", "\t", "\r" ), '', $styles );

		if ( ! isset( $mceInit['content_style'] ) ) {
			$mceInit['content_style'] = trim( $styles ) . ' ';
		} else {
			$mceInit['content_style'] .= ' ' . trim( $styles ) . ' ';
		}

		return $mceInit;

	}

}
