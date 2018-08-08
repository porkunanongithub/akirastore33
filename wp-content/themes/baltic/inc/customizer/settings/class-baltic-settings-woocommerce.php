<?php
/**
 * WooCommerce settings.
 *
 * @package Baltic
 */

/**
 * Baltic general settings class.
 *
 * @since  1.0.0
 */
class Baltic_Settings_WooCommerce {

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Settings_WooCommerce
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
	 * @return Baltic_Settings_WooCommerce An instance of the class.
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

		add_action( 'init', array( $this, 'colors' ) );
		add_action( 'init', array( $this, 'layout' ) );
		add_action( 'init', array( $this, 'catalog' ) );

	}

	/**
	 * Colors settings.
	 *
	 * @return [type] [description]
	 */
	public function colors() {

		/** Colors */
		Kirki::add_section( 'baltic_wc_color_section', array(
		    'title' 		=> esc_html__( 'Colors', 'baltic' ),
		    'panel' 		=> 'woocommerce',
		    'priority'		=> 100
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_price',
			'label'       	=> esc_html__( 'Price color', 'baltic' ),
			'section'     	=> 'baltic_wc_color_section',
			'default'     	=> $this->default['color_price'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.woocommerce-loop-product__link .price',
					'property' => 'color',
				)
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_sale_text',
			'label'       	=> esc_html__( 'Sale Badge Text Color', 'baltic' ),
			'section'     	=> 'baltic_wc_color_section',
			'default'     	=> $this->default['color_sale_text'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.onsale',
					'property' => 'color',
				)
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_sale',
			'label'       	=> esc_html__( 'Sale Badge Background Color', 'baltic' ),
			'section'     	=> 'baltic_wc_color_section',
			'default'     	=> $this->default['color_sale'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.onsale',
					'property' => 'background-color',
				)
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_stars',
			'label'       	=> esc_html__( 'Stars Rating Color', 'baltic' ),
			'section'     	=> 'baltic_wc_color_section',
			'default'     	=> $this->default['color_stars'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.star-rating span:before',
					'property' => 'color',
				)
			)
		) );

	}

	public function layout() {

		Kirki::add_section( 'baltic_wc_layout_section', array(
		    'title' 		=> esc_html__( 'Layout', 'baltic' ),
		    'panel' 		=> 'woocommerce',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'select',
			'settings'    	=> 'layout_products',
			'label'       	=> esc_html__( 'Product Archive Layout', 'baltic' ),
			'section'     	=> 'baltic_wc_layout_section',
			'default'     	=> $this->default['layout_products'],
			'transport'		=> 'postMessage',
			'choices' 		=> Baltic_Utility::get_main_layout(),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'select',
			'settings'    	=> 'layout_product',
			'label'       	=> esc_html__( 'Single Product Layout', 'baltic' ),
			'section'     	=> 'baltic_wc_layout_section',
			'default'     	=> $this->default['layout_product'],
			'transport'		=> 'postMessage',
			'choices' 		=> Baltic_Utility::get_main_layout(),
		) );

	}

	public function catalog() {

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'number',
			'settings'    	=> 'products_per_page',
			'label'       	=> esc_html__( 'Products per page', 'baltic' ),
			'section'     	=> 'woocommerce_product_catalog',
			'default'     	=> $this->default['products_per_page'],
			'choices'     	=> array(
				'min'  => 0,
				'max'  => 9999,
				'step' => 1,
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'number',
			'settings'    	=> 'products_columns',
			'label'       	=> esc_html__( 'Products Columns', 'baltic' ),
			'section'     	=> 'woocommerce_product_catalog',
			'default'     	=> $this->default['products_columns'],
			'choices'     	=> array(
				'min'  => 0,
				'max'  => 9999,
				'step' => 1,
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'select',
			'settings'    	=> 'products_nav',
			'label'       	=> esc_html__( 'Products Navigation Type', 'baltic' ),
			'section'     	=> 'woocommerce_product_catalog',
			'default'     	=> $this->default['products_nav'],
			'transport'		=> 'postMessage',
			'choices' 		=> array(
				'products_navigation' 	=> esc_html__( 'Previous/Next', 'baltic' ),
				'products_pagination'	=> esc_html__( 'Pagination', 'baltic' ),
			),
			'partial_refresh' => array(
				'products_nav' => array(
					'selector'        		=> '.is-woocommerce .navigation ',
					'render_callback' 		=> array( 'Baltic_Components', 'nav_products' ),
					'container_inclusive' 	=> true
				),
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'text',
			'settings'    	=> 'products_nav_prev',
			'label'       	=> esc_html__( 'Previous Product Text', 'baltic' ),
			'section'     	=> 'woocommerce_product_catalog',
			'default'     	=> $this->default['products_nav_prev'],
			'transport'		=> 'postMessage',
			'active_callback'    => array(
				array(
					'setting'  => 'products_nav',
					'operator' => '==',
					'value'    => 'products_navigation',
				),
			),
			'partial_refresh' => array(
				'products_nav_prev' => array(
					'selector'        		=> '.is-woocommerce .navigation ',
					'render_callback' 		=> array( 'Baltic_Components', 'nav_products' ),
					'container_inclusive' 	=> true
				),
			),
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'text',
			'settings'    	=> 'products_nav_next',
			'label'       	=> esc_html__( 'Next Product Text', 'baltic' ),
			'section'     	=> 'woocommerce_product_catalog',
			'default'     	=> $this->default['products_nav_next'],
			'transport'		=> 'postMessage',
			'active_callback'    => array(
				array(
					'setting'  => 'products_nav',
					'operator' => '==',
					'value'    => 'products_navigation',
				),
			),
			'partial_refresh' => array(
				'products_nav_next' => array(
					'selector'        		=> '.is-woocommerce .navigation ',
					'render_callback' 		=> array( 'Baltic_Components', 'nav_products' ),
					'container_inclusive' 	=> true
				),
			),
		) );

	}

}
