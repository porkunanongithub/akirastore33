<?php
/**
 * Color settings.
 *
 * @package Baltic
 */

/**
 * Baltic color settings class.
 *
 * @since  1.0.0
 */
class Baltic_Settings_Color {

	/**
	 * Holds settings defaults, populated in constructor.
	 *
	 * @access private
	 * @var array
	 */
	private $default;

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Settings_Color
	 */
	private static $_instance;


	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Settings_Color An instance of the class.
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

		add_action( 'init', array( $this, 'header' ) );
		add_action( 'init', array( $this, 'selection' ) );
		add_action( 'init', array( $this, 'text' ) );
		add_action( 'init', array( $this, 'textfield' ) );
		add_action( 'init', array( $this, 'link' ) );
		add_action( 'init', array( $this, 'buttons' ) );
		add_action( 'init', array( $this, 'borders' ) );

	}

	/**
	 * Header settings.
	 *
	 * @return void
	 */
	public function header() {

		/** Header */
		Kirki::add_section( 'baltic_header_color_section', array(
		    'title'          => esc_html__( 'Header', 'baltic' ),
		    'panel'          => 'baltic_colors_panel',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_bg_header',
			'label'       	=> esc_html__( 'Header Background Color', 'baltic' ),
			'section'     	=> 'baltic_header_color_section',
			'default'     	=> $this->default['color_bg_header'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.site-header, .menu-toggle, .menu-toggle:hover, .menu-toggle:focus, .toggled .menu-toggle',
					'property' => 'background-color',
				)
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_header_input',
			'label'       	=> esc_html__( 'Header search background color', 'baltic' ),
			'section'     	=> 'baltic_header_color_section',
			'default'     	=> $this->default['color_header_input'],
			'choices'     	=> array( 'alpha' => true ),
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.header-search-area input[type=search], .header-search-area select',
					'property' => 'background-color',
				),
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_header_input_focus',
			'label'       	=> esc_html__( 'Header search background color focus', 'baltic' ),
			'section'     	=> 'baltic_header_color_section',
			'default'     	=> $this->default['color_header_input_focus'],
			'choices'     	=> array( 'alpha' => true ),
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.header-search-area input[type=search]:focus',
					'property' => 'background-color',
				),
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_header_textfield',
			'label'       	=> esc_html__( 'Header search text color', 'baltic' ),
			'section'     	=> 'baltic_header_color_section',
			'default'     	=> $this->default['color_header_textfield'],
			'choices'     	=> array( 'alpha' => true ),
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.header-search-area input[type=search]',
					'property' => 'color',
				),
				array(
					'element'  => '.header-search-area select',
					'property' => 'color',
				),
				array(
					'element'	=> '.header-search-area input[type=search]::-webkit-input-placeholder',
					'property'	=> 'color'
				),
				array(
					'element'	=> '.header-search-area input[type=search]::-moz-placeholder',
					'property'	=> 'color'
				),
				array(
					'element'	=> '.header-search-area input[type=search]:-ms-input-placeholder',
					'property'	=> 'color'
				),
				array(
					'element'	=> '.header-search-area input[type=search]:-moz-placeholder',
					'property'	=> 'color'
				),
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_header_textfield_focus',
			'label'       	=> esc_html__( 'Header search text color focus', 'baltic' ),
			'section'     	=> 'baltic_header_color_section',
			'default'     	=> $this->default['color_header_textfield_focus'],
			'choices'     	=> array( 'alpha' => true ),
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.header-search-area input[type=search]:focus',
					'property' => 'color',
				),
				array(
					'element'  => '.header-search-area select:focus',
					'property' => 'color',
				),
				array(
					'element'	=> '.header-search-area input[type=search]:focus::-webkit-input-placeholder',
					'property'	=> 'color'
				),
				array(
					'element'	=> '.header-search-area input[type=search]:focus::-moz-placeholder',
					'property'	=> 'color'
				),
				array(
					'element'	=> '.header-search-area input[type=search]:focus:-ms-input-placeholder',
					'property'	=> 'color'
				),
				array(
					'element'	=> '.header-search-area input[type=search]:focus:-moz-placeholder',
					'property'	=> 'color'
				),
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_header_btn',
			'label'       	=> esc_html__( 'Header search button color', 'baltic' ),
			'section'     	=> 'baltic_header_color_section',
			'default'     	=> $this->default['color_header_btn'],
			'choices'     	=> array( 'alpha' => true ),
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.header-search-area .search-submit',
					'property' => 'background-color',
				)
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_header_btn_hover',
			'label'       	=> esc_html__( 'Header search button color hover', 'baltic' ),
			'section'     	=> 'baltic_header_color_section',
			'default'     	=> $this->default['color_header_btn_hover'],
			'choices'     	=> array( 'alpha' => true ),
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.header-search-area .search-submit:hover, .header-search-area .search-submit:focus',
					'property' => 'background-color',
				),
				array(
					'element'  => '.header-search-area .search-submit:hover, .header-search-area .search-submit:focus',
					'property' => 'border-color',
				)
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_header_btn_icon',
			'label'       	=> esc_html__( 'Header search icon color', 'baltic' ),
			'section'     	=> 'baltic_header_color_section',
			'default'     	=> $this->default['color_header_btn_icon'],
			'choices'     	=> array( 'alpha' => true ),
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.header-search-area .search-submit .icon-stroke',
					'property' => 'stroke',
				)
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_header_btn_icon_hover',
			'label'       	=> esc_html__( 'Header search icon color hover', 'baltic' ),
			'section'     	=> 'baltic_header_color_section',
			'default'     	=> $this->default['color_header_btn_icon_hover'],
			'choices'     	=> array( 'alpha' => true ),
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '.header-search-area .search-submit:hover .icon-stroke, .header-search-area .search-submit:focus .icon-stroke',
					'property' => 'stroke',
				)
			)
		) );

	}

	/**
	 * Selection colors settings.
	 *
	 * @return void
	 */
	public function selection() {

		Kirki::add_section( 'baltic_selection_color_section', array(
		    'title'          => esc_html__( 'Selection', 'baltic' ),
		    'panel'          => 'baltic_colors_panel',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'color',
			'settings'    => 'color_bg_highlight',
			'label'       => esc_html__( 'Color Background Highlight', 'baltic' ),
			'section'     => 'baltic_selection_color_section',
			'default'     => $this->default['color_bg_highlight'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '::selection',
					'property' => 'background-color',
				),
				array(
					'element'  => '::-moz-selection',
					'property' => 'background-color',
				),
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        => 'color',
			'settings'    => 'color_text_highlight',
			'label'       => esc_html__( 'Color Text Highlight', 'baltic' ),
			'section'     => 'baltic_selection_color_section',
			'default'     => $this->default['color_text_highlight'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => '::selection',
					'property' => 'color',
				),
				array(
					'element'  => '::-moz-selection',
					'property' => 'color',
				),
			)
		) );

	}

	/**
	 * Text colors settings.
	 *
	 * @return void
	 */
	public function text() {

		Kirki::add_section( 'baltic_text_color_section', array(
		    'title'          => esc_html__( 'Text', 'baltic' ),
		    'panel'          => 'baltic_colors_panel',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_text_primary',
			'label'       	=> esc_html__( 'Primary Text Color', 'baltic' ),
			'section'     	=> 'baltic_text_color_section',
			'default'     	=> $this->default['color_text_primary'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => Baltic_CSS::text_primary(),
					'property' => 'color',
				),
				array(
					'element'	=> 'ul.cart_list a.remove, .product-remove a, .widget-title:after, #ship-to-different-address label span:before, #ship-to-different-address label input[type=checkbox]:checked+span:before, .wc_payment_methods input.input-radio[name=payment_method]:checked+label:before',
					'property'	=> 'background-color'
				),
				array(
					'element'	=> '.return-to-top, #ship-to-different-address label span:before, #ship-to-different-address label input[type=checkbox]:checked+span:before',
					'property'	=> 'border-color'
				),
				array(
					'element'	=> '.wc_payment_methods input.input-radio[name=payment_method]+label:before',
					'property'	=> 'box-shadow',
					'value_pattern'	=> '0 0 0 2px $'
				)
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_text_secondary',
			'label'       	=> esc_html__( 'Secondary Text Color', 'baltic' ),
			'section'     	=> 'baltic_text_color_section',
			'default'     	=> $this->default['color_text_secondary'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => Baltic_CSS::text_secondary(),
					'property' => 'color',
				),
				array(
					'element'	=> 'ul.products li.product .button',
					'property'	=> 'border-color'
				)
			)
		) );

	}


	/**
	 * Textfield colors settings.
	 *
	 * @return void
	 */
	public function textfield() {

		Kirki::add_section( 'baltic_textfield_color_section', array(
		    'title'          => esc_html__( 'TextField', 'baltic' ),
		    'panel'          => 'baltic_colors_panel',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_text_field',
			'label'       	=> esc_html__( 'Text Field Color', 'baltic' ),
			'section'     	=> 'baltic_textfield_color_section',
			'default'     	=> $this->default['color_text_field'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => Baltic_CSS::textfield(),
					'property' => 'color',
				),
				array(
					'element'	=> '::-webkit-input-placeholder',
					'property'	=> 'color'
				),
				array(
					'element'	=> ':-moz-placeholder',
					'property'	=> 'color'
				),
				array(
					'element'	=> '::-moz-placeholder',
					'property'	=> 'color'
				),
				array(
					'element'	=> ':-ms-input-placeholder',
					'property'	=> 'color'
				)
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_text_field_focus',
			'label'       	=> esc_html__( 'Text Field Focus Color', 'baltic' ),
			'section'     	=> 'baltic_textfield_color_section',
			'default'     	=> $this->default['color_text_field_focus'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => Baltic_CSS::textfield_focus(),
					'property' => 'color',
				)
			)
		) );

	}

	/**
	 * Link colors settings.
	 *
	 * @return void
	 */
	public function link() {

		Kirki::add_section( 'baltic_link_color_section', array(
		    'title'          => esc_html__( 'Link', 'baltic' ),
		    'panel'          => 'baltic_colors_panel',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_link_primary',
			'label'       	=> esc_html__( 'Color Link', 'baltic' ),
			'section'     	=> 'baltic_link_color_section',
			'default'     	=> $this->default['color_link_primary'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  	=> Baltic_CSS::link_primary(),
					'property' 	=> 'color',
				),
				array(
					'element' 	=> '.screen-reader-text:focus, .widget_layered_nav_filters ul li.chosen:before, .woocommerce-widget-layered-nav-list li.chosen:before, .site-header__extra .total, .comment-body>.reply a:focus, .comment-body>.reply a:hover',
					'property'	=> 'background-color'
				),
				array(
					'element'	=> '.widget_layered_nav_filters ul li:before, .woocommerce-widget-layered-nav-list li:before, .widget_layered_nav_filters ul li.chosen:before, .woocommerce-widget-layered-nav-list li.chosen:before, .woocommerce-tabs ul.tabs li.active, .comment-body>.reply a:focus, .comment-body>.reply a:hover',
					'property'	=> 'border-color'
				),
				array(
					'element'	=> '.woocommerce .blockUI.blockOverlay::before, .woocommerce .loader::before',
					'property'	=> 'border-top-color'
				),
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_link_secondary',
			'label'       	=> esc_html__( 'Color Link Hover', 'baltic' ),
			'section'     	=> 'baltic_link_color_section',
			'default'     	=> $this->default['color_link_secondary'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  	=> Baltic_CSS::link_secondary(),
					'property' 	=> 'color',
				),
				array(
					'element'	=> 'ul.cart_list a.remove:focus, ul.cart_list a.remove:hover, .product-remove a:hover, .product-remove a:focus',
					'property'	=> 'background-color'
				),
			)
		) );

	}

	/**
	 * Buttons colors settings.
	 *
	 * @return void
	 */
	public function buttons() {

		Kirki::add_section( 'baltic_button_color_section', array(
		    'title'          => esc_html__( 'Button', 'baltic' ),
		    'panel'          => 'baltic_colors_panel',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_text_button',
			'label'       	=> esc_html__( 'Color Text Button', 'baltic' ),
			'section'     	=> 'baltic_button_color_section',
			'default'     	=> $this->default['color_text_button'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => Baltic_CSS::button(),
					'property' => 'color',
				)
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_button',
			'label'       	=> esc_html__( 'Color Background Button', 'baltic' ),
			'section'     	=> 'baltic_button_color_section',
			'default'     	=> $this->default['color_button'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => Baltic_CSS::button(),
					'property' => 'background-color',
				),
				array(
					'element'  => Baltic_CSS::button(),
					'property' => 'border-color',
				)
			)
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_button_hover',
			'label'       	=> esc_html__( 'Color Button Hover', 'baltic' ),
			'section'     	=> 'baltic_button_color_section',
			'default'     	=> $this->default['color_button_hover'],
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  => Baltic_CSS::button_hover(),
					'property' => 'background-color',
				),
				array(
					'element'  => Baltic_CSS::button_hover(),
					'property' => 'border-color',
				)
			)
		) );

	}

	/**
	 * Border colors settings.
	 *
	 * @return void
	 */
	public function borders() {

		Kirki::add_section( 'baltic_border_color_section', array(
		    'title'          => esc_html__( 'Border', 'baltic' ),
		    'panel'          => 'baltic_colors_panel',
		) );

		Kirki::add_field( 'baltic', array(
			'type'        	=> 'color',
			'settings'    	=> 'color_border',
			'label'       	=> esc_html__( 'Color Border', 'baltic' ),
			'section'     	=> 'baltic_border_color_section',
			'default'     	=> $this->default['color_border'],
			'choices'     	=> array( 'alpha' => true ),
			'transport'		=> 'auto',
			'output'		=> array(
				array(
					'element'  		=> 'table, .wc_payment_methods',
					'property' 		=> 'box-shadow',
					'value_pattern'	=> '0 0 0 1px $, 0 4px 12px rgba(0,0,0,.1)'
				),
				array(
					'element'		=> '.comment-notes, .woocommerce-error, .woocommerce-info, .woocommerce-message, .woocommerce-noreviews, p.no-comments',
					'property'		=> 'box-shadow',
					'value_pattern'	=> 'inset 0 0 0 1px $'
				),
				array(
					'element'		=> 'input[type=color], input[type=date], input[type=datetime-local], input[type=datetime], input[type=email], input[type=month], input[type=number], input[type=password], input[type=range], input[type=search], input[type=tel], input[type=text], input[type=time], input[type=url], input[type=week], textarea, select',
					'property'		=> 'border',
					'value_pattern'	=> '1px solid $'
				),
				array(
					'element'		=> '.header-search-area .search-submit, .select2-container--default .select2-selection--single, .select2-dropdown, .select2-container--default .select2-search--dropdown .select2-search__field, .wc_payment_methods li, .wc_payment_methods .payment_box',
					'property'		=> 'border-color',
				)
			)
		) );

	}

}
