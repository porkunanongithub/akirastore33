<?php
/**
 * Attributes class.
 *
 * @link https://github.com/justintadlock/hybrid-core/blob/master/inc/functions-attr.php
 * @package  Baltic
 */

/**
 * Baltic Markup class.
 *
 * @since  1.0.0
 */
class Baltic_Markup {

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Markup
	 */
	private static $_instance;

	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Markup An instance of the class.
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

		add_filter( 'baltic_attr_body', 				array( __class__, 'body' ), 5 );
		add_filter( 'baltic_attr_site', 				array( __class__, 'site' ), 5 );
		add_filter( 'baltic_attr_site-header', 			array( __class__, 'site_header' ), 5 );
		add_filter( 'baltic_attr_main-navigation', 		array( __class__, 'main_navigation' ), 5 );
		add_filter( 'baltic_attr_secondary-navigation', array( __class__, 'secondary_navigation' ), 5 );
		add_filter( 'baltic_attr_site-content', 		array( __class__, 'site_content' ), 5 );
		add_filter( 'baltic_attr_jumbotron-header', 	array( __class__, 'jumbotron_header' ), 5 );
		add_filter( 'baltic_attr_site-footer', 			array( __class__, 'site_footer' ), 5 );
		add_filter( 'baltic_attr_primary', 				array( __class__, 'primary' ), 5 );
		add_filter( 'baltic_attr_secondary', 			array( __class__, 'secondary' ), 5 );
		add_filter( 'baltic_attr_tertiary', 			array( __class__, 'tertiary' ), 5 );
		add_filter( 'baltic_attr_quaternary',			array( __class__, 'quaternary' ), 5 );
		add_filter( 'baltic_attr_site-main', 			array( __class__, 'site_main' ), 5 );
		add_filter( 'baltic_attr_post', 				array( __class__, 'post' ), 5 );
		add_filter( 'baltic_attr_comments-area', 		array( __class__, 'comments_area' ), 5 );
	}

	/**
	 * Outputs an HTML element's attributes.
	 *
	 * @param  string  $slug     The slug/ID of the element (e.g., 'sidebar').
	 * @param  string  $context  A specific context (e.g., 'primary').
	 * @param  array   $attr     Array of attributes to pass in (overwrites filters).
	 * @return void
	 */
	public static function attr( $slug, $context = '', $attr = array()  ) {

		echo self::get_attr( esc_attr( $slug ), esc_attr( $context ), $attr ); // WPCS: XSS ok.

	}

	/**
	 * Gets an HTML element's attributes.  This function is actually meant to be filtered by theme authors, plugins,
	 * or advanced child theme users.  The purpose is to allow folks to modify, remove, or add any attributes they
	 * want without having to edit every template file in the theme.  So, one could support microformats instead
	 * of microdata, if desired.
	 *
	 * @param  string  $slug     The slug/ID of the element (e.g., 'sidebar').
	 * @param  string  $context  A specific context (e.g., 'primary').
	 * @param  array   $attr     Array of attributes to pass in (overwrites filters).
	 * @return string
	 */
	public static function get_attr( $slug, $context = '', $attr = array() ) {

		$out    = '';
		$attr   = wp_parse_args( $attr, apply_filters( "baltic_attr_{$slug}", array(), $context ) );

		if ( empty( $attr ) )
			$attr['class'] = $slug;

		foreach ( $attr as $name => $value ){

			if ( 'class' === $name && has_filter( "baltic_attr_{$slug}_class" ) ) {

				$value = join( ' ', apply_filters( "baltic_attr_{$slug}_class", explode( ' ', $value ) ) );
			}

			$out .= $value ? sprintf( ' %s="%s"', esc_html( $name ), esc_attr( $value ) ) : esc_html( " {$name}" );
		}

		return trim( $out );

	}

	/**
	 * <body> element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function body( $attr ) {

		$attr['class'] = join( ' ', get_body_class() );
		$attr['dir']   = is_rtl() ? 'rtl' : 'ltr';

		return $attr;

	}

	/**
	 * <header> element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function site( $attr ) {

		$attr['id'] 	= 'page';
		$attr['class']  = 'site';

		return $attr;

	}

	/**
	 * <header> element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function site_header( $attr ) {

		$attr['id'] 	= 'masthead';
		$attr['class']  = 'site-header';

		return $attr;

	}

	/**
	 * <nav> main-navigation attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function main_navigation( $attr ) {

		$attr['id'] 	= 'site-navigation';
		$attr['class']  = 'main-navigation';

		return $attr;

	}

	/**
	 * <nav> main-navigation attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function secondary_navigation( $attr ) {

		$attr['id'] 	= 'secondary-navigation';
		$attr['class']  = 'secondary-navigation column-item';

		return $attr;

	}

	/**
	 * Content area element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function site_content( $attr ) {

		$attr['id'] 	= 'content';
		$attr['class']  = 'site-content';

		return $attr;

	}

	/**
	 * <div> element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function jumbotron_header( $attr ) {

		$attr['id'] 	= 'jumbotron-header';
		$attr['class']  = 'jumbotron-header';

		return $attr;

	}

	/**
	 * <footer> element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function site_footer( $attr ) {

		$attr['id'] 	= 'colophon';
		$attr['class']  = 'site-footer';

		return $attr;

	}

	/**
	 * <div> primary element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function primary( $attr ) {

		$attr['id'] 	= 'primary';
		$attr['class']  = 'content-area';

		return $attr;

	}

	/**
	 * <div> secondary element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function secondary( $attr ) {

		$attr['id'] 	= 'secondary';
		$attr['class']  = 'widget-area';

		return $attr;

	}

	/**
	 * <div> tertiary element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function tertiary( $attr ) {

		$attr['id'] 	= 'tertiary';
		$attr['class']  = 'sidebar-footer widget-area';

		return $attr;

	}

	/**
	 * <div> quaternary element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function quaternary( $attr ) {

		$attr['id'] 	= 'quaternary';
		$attr['class']  = 'sidebar-footer widget-area';

		return $attr;

	}

	/**
	 * <main> element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function site_main( $attr ) {

		$attr['id'] 	= 'main';
		$attr['class']  = 'site-main';

		if ( is_page_template( 'templates/homepage.php' ) ) {
			$attr['class']  = 'site-main baltic-homepage';
		}

		return $attr;

	}

	/**
	 * Post <article> element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function post( $attr ) {

		$post = get_post();

		$attr['id']    = ! empty( $post ) ? sprintf( 'post-%d', get_the_ID() ) : 'post-0';
		$attr['class'] = join( ' ', get_post_class() );

		return $attr;

	}

	/**
	 * comment area element attributes.
	 *
	 * @param  array   $attr
	 * @return array
	 */
	public static function comments_area( $attr ) {

		$attr['id'] 	= 'comments';
		$attr['class']  = 'comments-area';

		return $attr;

	}

}
