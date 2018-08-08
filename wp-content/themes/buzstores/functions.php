<?php
/**
 * buzstores functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package buzstores
 */

if ( ! function_exists( 'buzstores_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function buzstores_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on buzstores, use a find and replace
		 * to change 'buzstores' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'buzstores', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
        add_theme_support( 'woocommerce' );
    	add_theme_support( 'wc-product-gallery-zoom' );
    	add_theme_support( 'wc-product-gallery-lightbox' );
    	add_theme_support( 'wc-product-gallery-slider' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
        add_image_size('buzstores-slider-image',773,500,true);
        add_image_size('buzstores-slider-image-2',1920,500,true);
        add_image_size('buzstores-single-page',1170,600,true);
        add_image_size('buzstores-testimonial-image',220,220,true);
        add_image_size('buzstores-blog-image',375,295,true);
        add_image_size('buzstores-woo-cat-image',405,300,true);
        add_image_size('buzstores-product-image',150,150,true);
        
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'buzstores-menu-1' => esc_html__( 'Primary', 'buzstores' ),
            'buzstores-top-menu' => esc_html__( 'Top Menu', 'buzstores' ),
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
		add_theme_support( 'custom-background', apply_filters( 'buzstores_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}
endif;
add_action( 'after_setup_theme', 'buzstores_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function buzstores_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'buzstores_content_width', 640 );
}
add_action( 'after_setup_theme', 'buzstores_content_width', 0 );

/** Register widget area. **/
function buzstores_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Right', 'buzstores' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'buzstores' ),
		'id'            => 'buzstores-sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Header Cart', 'buzstores' ),
		'id'            => 'buzstores-header-cart',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Banner Section', 'buzstores' ),
		'id'            => 'buzstores-banner-widget',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Home Mid Content', 'buzstores' ),
		'id'            => 'buzstores-mid-content',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Subscribe Form', 'buzstores' ),
		'id'            => 'buzstores-subscribe-widget',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Terms & Condition', 'buzstores' ),
		'id'            => 'buzstores-terms-widget',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'buzstores' ),
		'id'            => 'buzstores-footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'buzstores' ),
		'id'            => 'buzstores-footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'buzstores' ),
		'id'            => 'buzstores-footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'buzstores' ),
		'id'            => 'buzstores-footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Payment Image', 'buzstores' ),
		'id'            => 'buzstores-payment-image',
		'description'   => esc_html__( 'Add widgets here.', 'buzstores' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'buzstores_widgets_init' );

/** Enqueue scripts and styles. **/
function buzstores_scripts() {
    
    $buzstores_font_query_args = array('family' => 'Open+Sans:300,300i,400,400i,700,700i,800,800i|Montserrat:100,200,300,400,500,600,700,800,900|Poppins:400,500');
    wp_enqueue_style('buzstores-google-fonts', add_query_arg($buzstores_font_query_args, "//fonts.googleapis.com/css"));
    wp_enqueue_style('font-awesome',get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('owl-carousel',get_template_directory_uri().'/js/owl-carousel/owl.carousel.css');
    wp_enqueue_style('buzstores-woocommerce-style',get_template_directory_uri(). '/woocommerce/woocommerce-style.css');
    wp_enqueue_style('buzstores-animation',get_template_directory_uri(). '/js/wow-animation/animate.css');
	wp_enqueue_style('buzstores-style', get_stylesheet_uri() );
    wp_enqueue_style('buzstores-responsive',get_template_directory_uri(). '/responsive.css');
    
    wp_enqueue_script('theia-sticky-sidebar',get_template_directory_uri().'/js/theia-sticky-sidebar/theia-sticky-sidebar.js',array('jquery'));
    wp_enqueue_script('owl-carousel',get_template_directory_uri().'/js/owl-carousel/owl.carousel.js',array('jquery'));
    wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow-animation/wow.min.js', array('jquery'));
	wp_enqueue_script('buzstores-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script('buzstores-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    wp_enqueue_script('buzstores-custom-script', get_template_directory_uri().'/js/custom-script.js',array('jquery'));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'buzstores_scripts' );

/** Admin Script */
function buzstores_admin_enqueue() {
    $currentscreen = get_current_screen();
    if($currentscreen->id == 'widgets'){
        wp_enqueue_media();
        wp_enqueue_script('buzstores-admin-script', get_template_directory_uri().'/inc/admin-panel/js/admin-script.js',array('jquery'));
    
        wp_localize_script('buzstores-admin-script', 'buzstores_admin_text', array(
            'upload' => esc_html__('Upload Image', 'buzstores'),
            'remove' => esc_html__('Remove', 'buzstores')
        ));
    }
}
add_action( 'admin_enqueue_scripts', 'buzstores_admin_enqueue' );

/** Implement the Custom Header feature. **/
require get_template_directory() . '/inc/custom-header.php';

/** Custom template tags for this theme. **/
require get_template_directory() . '/inc/template-tags.php';

/** Functions which enhance the theme by hooking into WordPress. **/
require get_template_directory() . '/inc/template-functions.php';

/** Customizer additions. **/
require get_template_directory() . '/inc/customizer.php';

/** Metabox **/
require get_template_directory() . '/inc/admin-panel/metabox.php';

/** Buzstores Function **/
require get_template_directory() . '/inc/buzstores-function.php';

if(buzstores_is_woocommerce_activated()){
    /** Buzstores Function **/
    require get_template_directory() . '/woocommerce/woocommerce-function.php';
}
/** Widgets **/
require get_template_directory() . '/inc/admin-panel/widgets/widgets-field.php';

/** Customizer Custom Classes **/
require get_template_directory() . '/inc/admin-panel/customizer/customizer-classes.php';

/** Sanitize Function **/
require get_template_directory() . '/inc/admin-panel/customizer/customizer-sanitize.php';

/** Category Banner **/
require get_template_directory() . '/inc/admin-panel/widgets/widget-banner.php';

/** Testimonial Widget **/
require get_template_directory() . '/inc/admin-panel/widgets/widget-blog.php';

/** Testimonial Widget **/
require get_template_directory() . '/inc/admin-panel/widgets/widget-testimonial.php';

/** Team Widget **/
require get_template_directory() . '/inc/admin-panel/widgets/widget-terms.php';

/** Recent Post Widget **/
require get_template_directory() . '/inc/admin-panel/widgets/widget-recent-post.php';

/** TMG Activation **/
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

function buzstores_tmg_plugin_activation() {

$plugins = array(
    array(
        'name'      => esc_html__('Newsletter','buzstores'),
        'slug'      => 'newsletter',
        'required'  => false,
    ),
    array(
        'name'      => esc_html__('Woocommerce','buzstores'),
        'slug'      => 'woocommerce',
        'required'  => false,
    ),
    array(
        'name'=> esc_html__('YITH WooCommerce Quick View','buzstores'),
        'slug'=>'yith-woocommerce-quick-view',
        'required'=>false,
    ),
    array(
        'name'=> esc_html__('YITH WooCommerce Compare','buzstores'),
        'slug' => 'yith-woocommerce-compare',
        'required'=>false,
    ),
    array(
        'name'=> esc_html__('YITH WooCommerce Wishlist','buzstores'),
        'slug' => 'yith-woocommerce-wishlist',
        'required'=>false,
    ),
    array(
        'name'=> esc_html__('Woo Product Images Slider','buzstores'),
        'slug' => 'woo-product-images-slider',
        'required'=>false,
    ),
);

$config = array(
    'id'           => 'buzstores',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to pre-packaged plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => true,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
    'strings'      => array(
        'page_title'                      => esc_html__( 'Install Required Plugins', 'buzstores' ),
        'menu_title'                      => esc_html__( 'Install Plugins', 'buzstores' ),
        'installing'                      => esc_html__( 'Installing Plugin: %s', 'buzstores' ), // %s = plugin name.
        'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'buzstores' ),
        'notice_can_install_required'     => _n_noop(
            'This theme requires the following plugin: %1$s.',
            'This theme requires the following plugins: %1$s.',
            'buzstores'
        ), // %1$s = plugin name(s).
        'notice_can_install_recommended'  => _n_noop(
            'This theme recommends the following plugin: %1$s.',
            'This theme recommends the following plugins: %1$s.',
            'buzstores'
        ), // %1$s = plugin name(s).
        'notice_cannot_install'           => _n_noop(
            'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
            'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
            'buzstores'
        ), // %1$s = plugin name(s).
        'notice_ask_to_update'            => _n_noop(
            'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
            'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
            'buzstores'
        ), // %1$s = plugin name(s).
        'notice_ask_to_update_maybe'      => _n_noop(
            'There is an update available for: %1$s.',
            'There are updates available for the following plugins: %1$s.',
            'buzstores'
        ), // %1$s = plugin name(s).
        'notice_cannot_update'            => _n_noop(
            'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
            'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
            'buzstores'
        ), // %1$s = plugin name(s).
        'notice_can_activate_required'    => _n_noop(
            'The following required plugin is currently inactive: %1$s.',
            'The following required plugins are currently inactive: %1$s.',
            'buzstores'
        ), // %1$s = plugin name(s).
        'notice_can_activate_recommended' => _n_noop(
            'The following recommended plugin is currently inactive: %1$s.',
            'The following recommended plugins are currently inactive: %1$s.',
            'buzstores'
        ), // %1$s = plugin name(s).
        'notice_cannot_activate'          => _n_noop(
            'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
            'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
            'buzstores'
        ), // %1$s = plugin name(s).
        'install_link'                    => _n_noop(
            'Begin installing plugin',
            'Begin installing plugins',
            'buzstores'
        ),
        'update_link'                     => _n_noop(
            'Begin updating plugin',
            'Begin updating plugins',
            'buzstores'
        ),
        'activate_link'                   => _n_noop(
            'Begin activating plugin',
            'Begin activating plugins',
            'buzstores'
        ),
        'return'                          => esc_html__( 'Return to Required Plugins Installer', 'buzstores' ),
        'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'buzstores' ),
        'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'buzstores' ),
        'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'buzstores' ),  // %1$s = plugin name(s).
        'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'buzstores' ),  // %1$s = plugin name(s).
        'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'buzstores' ), // %s = dashboard link.
        'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'buzstores' ),

        'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
    )
);

tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'buzstores_tmg_plugin_activation' );