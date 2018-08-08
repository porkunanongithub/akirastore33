<?php
/**
 * Baltic theme setup.
 *
 * @package Baltic
 */

/**
 * Main Baltic Setup class.
 *
 * @since  1.0.0
 */
class Baltic_Setup {

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
	 * @var Baltic_Setup
	 */
	private static $_instance;


	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Setup An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Theme constructor.
	 *
	 * Initializing Baltic theme.
	 *
	 * @access public
	 */
	public function __construct() {

		$this->suffix = Baltic_Utility::get_min_suffix();

		// Setup
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'template_redirect', array( $this, 'content_width' ), 0 );

		// Scipts
		add_action( 'wp_head', array( $this, 'javascript_detection' ), 0 );
		add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );

		// Widgets
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_filter( 'widget_tag_cloud_args', array( $this, 'widget_tag_cloud_args' ) );
		add_filter( 'woocommerce_product_tag_cloud_widget_args', array( $this, 'widget_tag_cloud_args' ) );

		// Classes
		add_filter( 'body_class', array( $this, 'body_classes' ) );
		add_filter( 'post_class', array( $this, 'post_classes' ) );

		// Pingback
		add_action( 'wp_head', array( $this, 'pingback_header' ) );

		// Setup Filters
		add_action( 'wp', array( $this, 'content_filters' ) );

		// TGMPA
		if ( is_admin() ) {
			$this->tgmpa_setup();
		}

	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @return  void
	 */
	public function setup(){

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'baltic' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 1620, 911, array( 'center', 'top' ) );

		// Set the default content width
		$GLOBALS['content_width'] = 810;

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'baltic' ),
			'menu-2' => esc_html__( 'Secondary', 'baltic' ),
			'menu-3' => esc_html__( 'Social Link', 'baltic' ),
		) );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'video',
			'gallery',
			'audio',
		) );

		// Enable support for custom logo
		add_theme_support( 'custom-logo', array(
			'width'       => 360,
			'height'      => 96,
			'flex-width'  => true,
			'flex-height' => false,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		// Custom Header
		add_theme_support( 'custom-header', apply_filters( 'baltic_custom_header_args', array(
			'width'       			=> 1600,
			'height'      			=> 1600,
			'default-image'         => '',
			'flex-width'            => true,
			'flex-height'           => true,
			'default-text-color'	=> '505050',
			'wp-head-callback'      => array( 'Baltic_Customizer', 'header_style' ),
		) ) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'baltic_custom_background_args', array(
			'default-color' 		=> 'eceff1',
			'default-repeat'        => 'no-repeat',
			'default-attachment'    => 'scroll'
		) ) );

		/**
		* Add support for Gutenberg.
		*
		* @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
		*/
		add_theme_support( 'gutenberg', array(

		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( "assets/css/editor-style{$this->suffix}.css" ) );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );

	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	public function content_width(){

		$content_width = $GLOBALS['content_width'];

		if ( Baltic_Layout::get_layout() == 'full-width' ) {
			$content_width = 1120;
		}

		$GLOBALS['content_width'] = apply_filters( 'baltic_content_width', $content_width );

	}

	/**
	 * Handles JavaScript detection.
	 *
	 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
	 */
	public function javascript_detection() {

		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @return  void
	 */
	public function assets() {

		// Main Style
		wp_enqueue_style( 'baltic-style', BALTIC_URI . "/style{$this->suffix}.css" );
		wp_style_add_data( 'baltic-style', 'rtl', 'replace' );

		// lt IE 9 script
		wp_enqueue_script( 'html5shiv',
			BALTIC_URI . "/assets/js/ie/html5shiv{$this->suffix}.js",
			array(),
			'3.7.3'
		);
		wp_enqueue_script( 'respond',
			BALTIC_URI . "/assets/js/ie/respond{$this->suffix}.js",
			array(),
			'1.4.2'
		);
		wp_enqueue_script( 'nwmatcher',
			BALTIC_URI . "/assets/js/ie/nwmatcher{$this->suffix}.js",
			array(),
			'1.4.2'
		);
		wp_enqueue_script( 'selectivizr',
			BALTIC_URI . "/assets/js/ie/selectivizr{$this->suffix}.js",
			array(),
			'1.0.2'
		);

		// lte IE 9 data
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
		wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
		wp_script_add_data( 'nwmatcher', 'conditional', 'lt IE 9' );
		wp_script_add_data( 'selectivizr', 'conditional', 'lt IE 9' );

		/** Vendor scripts */
		wp_enqueue_script( 'jquery-fitvids',
			BALTIC_URI . "/assets/js/fitvids/jquery.fitvids{$this->suffix}.js",
			array( 'jquery' ),
			'1.2.0',
			true
		);
		wp_enqueue_script( 'jquery-stickit',
			BALTIC_URI . "/assets/js/stickit/jquery.stickit{$this->suffix}.js",
			array( 'jquery' ),
			'0.2.13',
			true
		);
		wp_enqueue_script( 'jquery-match-height',
			BALTIC_URI . "/assets/js/match-height/jquery.matchHeight{$this->suffix}.js",
			array( 'jquery' ),
			'0.7.2',
			true
		);

		wp_enqueue_script( 'jquery-slick',
			BALTIC_URI . "/assets/js/slick/slick{$this->suffix}.js",
			array( 'jquery' ),
			'1.8.0',
			true
		);

		// Main script
		wp_enqueue_script( 'baltic-script',
			BALTIC_URI . "/assets/js/frontend{$this->suffix}.js",
			array( 'jquery' ),
			BALTIC_THEME_VERSION,
			true
		);

		$output = array(
			'sliderPrevBtn'	=> '<button type="button" data-role="none" class="baltic-slick-prev" aria-label="Previous" tabindex="0" role="button">'. Baltic_Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'chevron-left' ) ) .'</button>',
			'sliderNextBtn' => '<button type="button" data-role="none" class="baltic-slick-next" aria-label="Next" tabindex="0" role="button">'. Baltic_Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'chevron-right' ) ) .'</button>',
			'loader'		=> Baltic_Components::get_preloader()
		);
		wp_localize_script( 'baltic-script', 'Balticl10n', $output );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Deregister default contact form 7 style and use our own style.
		wp_dequeue_style( 'contact-form-7' );

	}

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public function widgets_init() {

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'baltic' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'baltic' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title h6">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Footer', 'baltic' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'baltic' ),
			'before_widget' => '<section id="%1$s" class="widget column-item %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title h6">',
			'after_title'   => '</h2>',
		) );
		if ( class_exists( 'WooCommerce' ) ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar Shop', 'baltic' ),
				'id'            => 'sidebar-3',
				'description'   => esc_html__( 'Add widgets here.', 'baltic' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title h6">',
				'after_title'   => '</h2>',
			) );
		}

	}

	/**
	 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
	 *
	 * @param array $args Arguments for tag cloud widget.
	 * @return array A new modified arguments.
	 */
	public function widget_tag_cloud_args( $args ) {

		$args['largest'] = 0.875;
		$args['smallest'] = 0.875;
		$args['unit'] = 'rem';
		return $args;

	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public static function body_classes( $classes ) {

		if ( Baltic_Options::get_option( 'preloader' )  === true ) {
			$classes[] = 'preloader-enabled';
		}

		$classes[]	= esc_attr( Baltic_Layout::get_layout() );

		return $classes;

	}

	/**
	 * Removes hentry class from the array of post classes.
	 * Currently, having the class on pages is not correct use of hentry.
	 * hentry requires more properties than pages typically have.
	 * Core is not likely to remove class because of backward compatibility.
	 * See: https://core.trac.wordpress.org/ticket/28482
	 *
	 * @param array $classes Classes for the post element.
	 * @return array
	 */
	public function post_classes( $classes ) {

		if ( 'page' === get_post_type() ) {
			$classes = array_diff( $classes, array( 'hentry' ) );
		}
		$classes[] = 'entry';

		return $classes;
	}

	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 *
	 * @return [type] [description]
	 */
	public function pingback_header() {

		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}

	}

	/**
	 * [setup_action description]
	 *
	 * @return [type] [description]
	 */
	public function content_filters() {

		if ( Baltic_Utility::is_blog() || Baltic_Utility::is_homepage_template() ) {
			add_filter( 'the_title', array( $this, 'untitled_post' ) );
			add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 999 );
			add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
			add_filter( 'the_content_more_link', array( $this, 'excerpt_more' ), 10, 2 );
		}

		if ( is_singular() ) {
			add_filter( 'the_title', array( $this, 'untitled_post' ) );
		}

	}

	/**
	 * Add (Untitled) for post who doesn't have title
	 *
	 * @param  string  $title
	 * @return string
	 */
	public function untitled_post( $title ) {

		// Translators: Used as a placeholder for untitled posts on non-singular views.
		if ( ! $title && ! is_singular() && in_the_loop() && ! is_admin() ){
			$title = esc_html__( '(Untitled)', 'baltic' );
		}

		return $title;

	}

	/**
	 * Filter the except length to 20 characters.
	 *
	 * @param int $length Excerpt length.
	 * @return int (Maybe) modified excerpt length.
	 */
	public function excerpt_length( $length ) {

		$length = Baltic_Options::get_option( 'excerpt_length' );
		if ( !empty( $length ) ) {
			return (int)$length;
		} else {
			return 20;
		}

	}

	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and * a 'Continue reading' link.
	 *
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 */
	public function excerpt_more() {

		$text = Baltic_options::get_option( 'more_link_text' );
		$more_link_text = ( ! empty( $text ) ) ? $text : '';

		$link = sprintf( '<div><a href="%1$s" class="more-link">%2$s %3$s</a></div>',
			esc_url( get_permalink( get_the_ID() ) ),
			sprintf( '%1$s<span class="screen-reader-text"> %s</span>', esc_attr( $more_link_text ), get_the_title( get_the_ID() ) ),
			Baltic_Icons::get_svg( array( 'class'=>'icon-stroke', 'icon' => 'arrow-right' ) )
		);
		return ' &hellip;' . $link;

	}

	/**
	 * Fix embed height
	 *
	 * @return [type] [description]
	 */
	public function default_embed_size() {

		return array( 'width' => 720, 'height' => 120 );

	}

	/**
	 * [mixcloud_oembed_parameter description]
	 *
	 * @param  [type] $html [description]
	 * @param  [type] $url  [description]
	 * @param  [type] $args [description]
	 * @return [type]       [description]
	 */
	public function mixcloud_oembed_parameter( $html, $url, $args ) {

		return str_replace( 'hide_cover=1', 'hide_cover=1&hide_tracklist=1&light=1', $html );

	}

	/**
	 * TGMPA setup.
	 *
	 * @return [type] [description]
	 */
	public function tgmpa_setup() {

		require_once BALTIC_INC . "/extras/class-tgm-plugin-activation.php";

		add_action( 'tgmpa_register', array( $this, 'required_plugins' ) );

	}

	/**
	 * TGMPA plugin requirement list.
	 *
	 * @return [type] [description]
	 */
	public function required_plugins() {

		$plugins = array(

			array(
				'name'      => esc_html__( 'Baltic Kit', 'baltic' ),
				'slug'      => 'baltic-kit',
				'required'  => false
			),

			array(
				'name'      => esc_html__( 'Kirki Toolkit', 'baltic' ),
				'slug'      => 'kirki',
				'required'  => false
			),

			array(
				'name'      => esc_html__( 'WP Term Images', 'baltic' ),
				'slug'      => 'wp-term-images',
				'required'  => false
			),

			array(
				'name'      => esc_html__( 'WooCommerce', 'baltic' ),
				'slug'      => 'woocommerce',
				'required'  => false
			),

			array(
				'name'      => esc_html__( 'Twitter Widget by Campaign Kit', 'baltic' ),
				'slug'      => 'campaign-kit-twitter-widget',
				'required'  => false,
			),

		);

		/*
		 * Array of configuration settings.
		 */
		$config = array(
			'id'           => 'baltic',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
		);

		tgmpa( $plugins, $config );

	}

}
