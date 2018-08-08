<?php
/**
 * Ganess Store functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ganess_Store
 */
class Ganess_Store_Function{
	
	public function __construct(){

		/****************************************************
		*			Add Action
		****************************************************/
		add_action( 'widgets_init', array($this,'ganess_store_widgets_init'));//Add Action All Widget Register
		add_action( 'wp_enqueue_scripts',array($this,'ganess_store_scripts'));//Enqueue All Script and Class
		add_action( 'tgmpa_register',array($this,'ganess_store_register_required_plugins'));//Register Required Plugin function
		add_action( 'after_setup_theme',array($this,'ganess_store_content_width'), 0 );//Add After Setup Theme
		add_action( 'after_setup_theme',array($this,'ganess_store_setup'));//Add Theme Support 
		add_action('admin_enqueue_scripts',array($this,'ganess_store_load_scripts'));
	

		/***************************************************
		*			Filter Options
		***************************************************/
		add_filter( 'excerpt_length', array($this,'ganess_store_blog_excerpt_length'), 999 );

		
		/****************************************************
		*			Required All File 
		*****************************************************/
		// require get_template_directory() . '/inc/custom-header.php';//Implement the Custom Header feature.
		require get_template_directory() . '/inc/template-tags.php';//Custom template tags for this theme.
		require get_template_directory() . '/inc/template-functions.php';//Functions which enhance the theme by hooking into WordPress.
		require get_template_directory() . '/inc/class-tgm-plugin-activation.php';//Ganess Store TMG Plugin
		require get_template_directory() . '/spiderbuzz/init.php';//Load Init File

	}

	/*********************************************************************
	 * 						Widget Inline Style 
	 ********************************************************************/
	
	function ganess_store_load_scripts($hook) {
			
			if( $hook != 'widgets.php' ) 
				return;

			$custom_css = "
			#widget-list [id*='_ganess_store_'] .widget-top, #widget-list [id*='_ganess_store_'] h3 {
				background: #0074a2;
				color: #fff;
			}    
			";
			wp_add_inline_style( 'admin-bar', $custom_css );
		
	}


	/********************************************************************
	* 					Register widget area.
	********************************************************************/
	public function ganess_store_widgets_init() {

		register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'ganess-store' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ganess-store' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Left Sidebar', 'ganess-store' ),
			'id'            => 'left-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'ganess-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'WooCommerce Sidebar', 'ganess-store' ),
			'id'            => 'woocommerce',
			'description'   => esc_html__( 'Add widgets here.', 'ganess-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Home Page', 'ganess-store' ),
			'id'            => 'home_page',
			'description'   => esc_html__( 'Add widgets here.', 'ganess-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer First Widget', 'ganess-store' ),
			'id'            => 'first-footer-widget',
			'description'   => esc_html__( 'Add widgets here.', 'ganess-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Second Widget', 'ganess-store' ),
			'id'            => 'footer-second-widget',
			'description'   => esc_html__( 'Add widgets here.', 'ganess-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Third Widget', 'ganess-store' ),
			'id'            => 'footer-third-widget',
			'description'   => esc_html__( 'Add widgets here.', 'ganess-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Four Widget', 'ganess-store' ),
			'id'            => 'footer-four-widget',
			'description'   => esc_html__( 'Add widgets here.', 'ganess-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Fifth Widget', 'ganess-store' ),
			'id'            => 'footer-fifth-widget',
			'description'   => esc_html__( 'Add widgets here.', 'ganess-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

	}

	/******************************************************************
	* 					Enqueue scripts and styles.
	*******************************************************************/
	public function ganess_store_scripts() {
		$GanessStore = wp_get_theme();
		$theme_version = $GanessStore->get( 'Version' );

		$Ganess_theme = wp_get_theme();
		$theme_version = $Ganess_theme->get( 'Version' );

		//Google Fonts
		$ganess_store_font_args = array(
			'family' => 'Lato:300,400,600,700,800|Raleway:300,400,500,600,700',
		);
		wp_enqueue_style('google-fonts', add_query_arg( $ganess_store_font_args, "//fonts.googleapis.com/css" ) );


		// css
		wp_enqueue_style( 'foundation', get_template_directory_uri() . '/assets/css/foundation.css', array(), esc_attr( $theme_version ) );
		wp_enqueue_style( 'ganess-store-main', get_template_directory_uri() . '/assets/css/app.css', array(), esc_attr( $theme_version ) );
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.css', array(), esc_attr( $theme_version ) );	
		wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/slick/slick.css', array(), esc_attr( $theme_version ) );
		wp_enqueue_style( 'ganess-store-style', get_stylesheet_uri() );

		//Script
		wp_enqueue_script( 'what-input', get_template_directory_uri() . '/assets/js/vendor/what-input.js', array(), esc_attr( $theme_version), true );
		wp_enqueue_script( 'foundation', get_template_directory_uri() . '/assets/js/vendor/foundation.js', array(), esc_attr( $theme_version), true );
		wp_enqueue_script( 'jquery-fittext', get_template_directory_uri() . '/assets/js/jquery.fittext.js', array(), esc_attr( $theme_version), true );
		wp_enqueue_script( 'ganess-store-app-js', get_template_directory_uri() . '/assets/js/app.js', array(), esc_attr( $theme_version), true );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/slick/slick.min.js', array(), esc_attr( $theme_version), true );
		wp_enqueue_script( 'ganess-store-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), esc_attr( $theme_version), false );
		wp_enqueue_script( 'countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.js', array('jquery'), esc_attr( $theme_version ), true );
		
		//Ganess Store 
		wp_register_script('ganess-store-main', get_template_directory_uri() . '/assets/js/ganess-store.js', array(), esc_attr( $theme_version), true );
			$localize = array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			);
		wp_localize_script('ganess-store-main', 'GANESS', $localize);

		wp_enqueue_script('ganess-store-main');

		wp_enqueue_script( 'ganess-store-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array('jquery'), esc_attr( $theme_version), false );
		

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	

	/******************************************************************
	 * 			Register the required plugins for this theme.
	 ******************************************************************/
	public function ganess_store_register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 */
		$plugins = array(

	        array(
	            'name' => esc_attr__( "WooCommerce", "ganess-store"),
	            'slug' => 'woocommerce',
	            'required' => false,
	        ),
	        array(
	            'name' => esc_attr__( 'YITH WooCommerce Quick View', "ganess-store"),
	            'slug' => 'yith-woocommerce-quick-view',
	            'required' => false,
	        ),
	        array(
	            'name' => esc_attr__( 'YITH WooCommerce Compare', "ganess-store"),
	            'slug' => 'yith-woocommerce-compare',
	            'required' => false,
	        ),
	        array(
	            'name' => esc_attr__( 'YITH WooCommerce Wishlist', "ganess-store"),
	            'slug' => 'yith-woocommerce-wishlist',
	            'required' => false,
	        ),
	        array(
	            'name' => esc_attr__( 'Easy Google Fonts', "ganess-store"),
	            'slug' => 'easy-google-fonts',
	            'required' => false,
	        ),
			array(
				'name' => esc_attr__( 'MailChimp for WordPress', 'ganess-store'),
				'slug' => 'mailchimp-for-wp',
				'required' => false,
			),
			array(
	            'name' => esc_attr__( 'Grid/List View for WooCommerce', "ganess-store"),
	            'slug' => 'grid/list-view-for-woocommerce',
	            'required' => false,
			),
			array(
				'name' => esc_attr__( 'One Click Demo Import', "ganess-store"),
				'slug' => 'one-click-demo-import',
				'required' => false,
			),

	    );

		/*
		 * Array of configuration settings. Amend each line as needed.
		*/
		$config = array(
			'id'           => 'ganess-store',                 
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

	/****************************************************************************
	* Set the content width in pixels, based on the theme's design and stylesheet.
	****************************************************************************/
	public function ganess_store_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'ganess_store_content_width', 640 );
	}

	/****************************************************************************
	 * 					Filter the except length to 20 words.
	 ****************************************************************************/
	public function ganess_store_blog_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}
	    return 20;
	}


	/******************************************************************************
	* 						Ganess Store SEtup file
	*******************************************************************************/
	public function ganess_store_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Ganess Store, use a find and replace
		 * to change 'ganess-store' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ganess-store', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		//Custom Header
		$defaults = array(
			'default-image'          => '',
			'width'                  => 1200,
			'height'                 => 400,
			'flex-height'            => false,
			'flex-width'             => false,
			'uploads'                => true,
			'random-default'         => false,
			'header-text'            => true,
			'default-text-color'     => '',
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-header', $defaults );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		* Editor style.
		*/
		add_editor_style( 'assets/css/admin-editer-style.css' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ganess-store' ),
			'top-header-menu' => esc_html__( 'Top Header', 'ganess-store' ),
		) );

		/*
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ganess_store_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		*Add Image Size
		*
		*/
		add_image_size('ganess-store-blog',370,220);
		add_image_size('ganess-store-product-list',70,70,true);
		add_image_size('ganess-store-banner-image',1920,668,true);
		add_image_size('ganess-store-main-products',243,243,true);
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 60,
			'width'       => 200,
			'flex-width'  => true,
			'flex-height' => true,
		));
	}



}/*Ganess Store Class Close */
$Ganess_Store_Function = new Ganess_Store_Function();


function ganess_store_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

