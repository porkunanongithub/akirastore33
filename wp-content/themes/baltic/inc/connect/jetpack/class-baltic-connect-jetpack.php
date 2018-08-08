<?php
/**
 * Baltic Jetpack compatibility
 *
 * @package Baltic
 */

/**
 * Main Baltic Jetpack class
 *
 * @since  1.0.0
 */
class Baltic_Connect_Jetpack {

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Connect_Jetpack
	 */
	private static $_instance;


	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Connect_Jetpack An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Constructor
	 */
	public function __construct() {

		if ( ! class_exists( 'Jetpack' ) ) {
			return;
		}

		add_action( 'after_setup_theme', array( $this, 'support' ) );
		add_action( 'wp_print_styles', array( $this, 'deregister_style' ) );

	}

	/**
	 * Jetpack support
	 *
	 * @return [type] [description]
	 */
	public function support() {

		add_theme_support( 'infinite-scroll', array(
			'type'      		=> 'click',
			'container' 		=> 'main',
			'render'    		=> array( $this, 'infinite_scroll_render' ),
			'footer_widgets'	=> array( 'sidebar-2' ),
		) );

	}

	/**
	 * Infinte scroll render.
	 *
	 * @return [type] [description]
	 */
	public function infinite_scroll_render() {

		while ( have_posts() ) {
			the_post();
			if ( is_search() ) :
				get_template_part( 'components/content', 'search' );
			else :
				get_template_part( 'components/content', get_post_format() );
			endif;
		}

	}

	/**
	 * Deregister style and use our default theme style.
	 *
	 * @return [type] [description]
	 */
	public function deregister_style() {

		wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll

	}

}
