<?php
/**
 * Typography settings.
 *
 * @package Baltic
 */

/**
 * Baltic typography settings class.
 *
 * @since  1.0.0
 */
class Baltic_Settings_Typography {

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Settings_Typography
	 */
	private static $_instance;


	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Settings_Typography An instance of the class.
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

		add_action( 'init', array( $this, 'base' ) );
		add_action( 'init', array( $this, 'heading' ) );
		add_action( 'init', array( $this, 'blockquote' ) );
		add_action( 'init', array( $this, 'code' ) );

	}

	/**
	 * Base font settings.
	 *
	 * @return void
	 */
	public function base() {

		Kirki::add_section( 'baltic_body_font_section', array(
		    'title'          => esc_html__( 'Body', 'baltic' ),
		    'panel'          => 'baltic_typograhy_panel',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'typography',
			'settings'    => 'body_font',
			'label'       => esc_html__( 'Body Fonts', 'baltic' ),
			'section'     => 'baltic_body_font_section',
			'default'     => array(
				'font-family'    => 'Poppins',
				'variant'        => '400',
				'font-size'      => '1rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'subsets'        => '',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'priority'    => 10,
			'output' => array(
				array(
					'element'  => 'body'
				)
			),
		) );

	}

	/**
	 * Heading font settings.
	 *
	 * @return void
	 */
	public function heading() {

		Kirki::add_section( 'baltic_heading_font_section', array(
		    'title'          => esc_html__( 'Heading', 'baltic' ),
		    'panel'          => 'baltic_typograhy_panel',
		) );


		Kirki::add_field( 'baltic', array(
			'type'        => 'typography',
			'settings'    => 'heading_1',
			'label'       => esc_html__( 'H1', 'baltic' ),
			'section'     => 'baltic_heading_font_section',
			'default'     => array(
				'font-family'    => 'Poppins',
				'variant'        => '500',
				'letter-spacing' => '0',
				'subsets'        => '',
				'font-size'      => '2.5rem',
				'line-height'    => '1.2',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'priority'    => 10,
			'output' => array(
				array(
					'element'  => 'h1, .h1'
				)
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'typography',
			'settings'    => 'heading_2',
			'label'       => esc_html__( 'H2', 'baltic' ),
			'section'     => 'baltic_heading_font_section',
			'default'     => array(
				'font-family'    => 'Poppins',
				'variant'        => '500',
				'letter-spacing' => '0',
				'subsets'        => '',
				'font-size'      => '2rem',
				'line-height'    => '1.2',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'priority'    => 10,
			'output' => array(
				array(
					'element'  => 'h2, .h2'
				)
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'typography',
			'settings'    => 'heading_3',
			'label'       => esc_html__( 'H3', 'baltic' ),
			'section'     => 'baltic_heading_font_section',
			'default'     => array(
				'font-family'    => 'Poppins',
				'variant'        => '500',
				'letter-spacing' => '0',
				'subsets'        => '',
				'font-size'      => '1.75rem',
				'line-height'    => '1.2',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'priority'    => 10,
			'output' => array(
				array(
					'element'  => 'h3, .h3'
				)
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'typography',
			'settings'    => 'heading_4',
			'label'       => esc_html__( 'H4', 'baltic' ),
			'section'     => 'baltic_heading_font_section',
			'default'     => array(
				'font-family'    => 'Poppins',
				'variant'        => '500',
				'letter-spacing' => '0',
				'subsets'        => '',
				'font-size'      => '1.5rem',
				'line-height'    => '1.2',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'priority'    => 10,
			'output' => array(
				array(
					'element'  => 'h4, .h4'
				)
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'typography',
			'settings'    => 'heading_5',
			'label'       => esc_html__( 'H5', 'baltic' ),
			'section'     => 'baltic_heading_font_section',
			'default'     => array(
				'font-family'    => 'Poppins',
				'variant'        => '500',
				'letter-spacing' => '0',
				'subsets'        => '',
				'font-size'      => '1.25rem',
				'line-height'    => '1.2',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'priority'    => 10,
			'output' => array(
				array(
					'element'  => 'h5, .h5'
				)
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'typography',
			'settings'    => 'heading_6',
			'label'       => esc_html__( 'H6', 'baltic' ),
			'section'     => 'baltic_heading_font_section',
			'default'     => array(
				'font-family'    => 'Poppins',
				'variant'        => '500',
				'letter-spacing' => '0',
				'subsets'        => '',
				'font-size'      => '1rem',
				'line-height'    => '1.5',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'priority'    => 10,
			'output' => array(
				array(
					'element'  => 'h6, .h6'
				)
			),
		) );

	}

	/**
	 * Blockquote font settings.
	 *
	 * @return void
	 */
	public function blockquote() {

		Kirki::add_section( 'baltic_blockquote_font_section', array(
		    'title'          => esc_html__( 'Blockquote', 'baltic' ),
		    'panel'          => 'baltic_typograhy_panel',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'typography',
			'settings'    => 'blockquote_font',
			'label'       => esc_html__( 'Blockquote Fonts', 'baltic' ),
			'section'     => 'baltic_blockquote_font_section',
			'default'     => array(
				'font-family'    => 'sans-serif',
				'variant'        => '400',
				'font-size'      => '1rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'subsets'        => '',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'priority'    => 10,
			'output' => array(
				array(
					'element'  => 'blockquote'
				)
			),
		) );

	}

	/**
	 * Code font settings.
	 *
	 * @return void
	 */
	public function code() {

		Kirki::add_section( 'baltic_code_font_section', array(
		    'title'          => esc_html__( 'Code', 'baltic' ),
		    'panel'          => 'baltic_typograhy_panel',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'typography',
			'settings'    => 'code_font',
			'label'       => esc_html__( 'Code Fonts', 'baltic' ),
			'section'     => 'baltic_code_font_section',
			'default'     => array(
				'font-family'    => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',
				'variant'        => '',
				'font-size'      => '0.875rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'subsets'        => '',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'priority'    => 10,
			'output' => array(
				array(
					'element'  => 'pre, code'
				)
			),
		) );

	}

}
