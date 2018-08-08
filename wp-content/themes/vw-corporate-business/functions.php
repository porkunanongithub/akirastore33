<?php
/**
 * VW Corporate Business functions and definitions
 *
 * @package VW Corporate Business
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

/* Theme Setup */
if ( ! function_exists( 'vw_corporate_business_setup' ) ) :
 
function vw_corporate_business_setup() {

	$GLOBALS['content_width'] = apply_filters( 'vw_corporate_business_content_width', 640 );
	
	load_theme_textdomain( 'vw-corporate-business', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('vw-corporate-business-homepage-thumb',240,145,true);
	
       register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'vw-corporate-business' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', vw_corporate_business_font_url() ) );
}
endif;

// Theme Activation Notice
	global $pagenow;

	if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
	add_action( 'admin_notices', 'vw_corporate_business_activation_notice' );
	}


	add_action( 'after_setup_theme', 'vw_corporate_business_setup' );

	// Notice after Theme Activation
	function vw_corporate_business_activation_notice() {
	echo '<div class="notice notice-success is-dismissible welcome-notice">';
	echo '<h3>'. esc_html__( 'Warm Greetings to you!!', 'vw-corporate-business' ) .'</h3>';
	echo '<p>'. esc_html__( 'Thank you for choosing VW Corporate Business Theme. Would like to have you on our Welcome page so that you can reap all the benefits of our VW Corporate Business Theme.', 'vw-corporate-business' ) .'</p>';
	echo '<p><a href="'. esc_url( admin_url( 'themes.php?page=vw_corporate_business_guide' ) ) .'" class="button button-primary">'. esc_html__( 'GET STARTED', 'vw-corporate-business' ) .'</a></p>';
	echo '</div>';

}

/* Theme Widgets Setup */
function vw_corporate_business_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'vw-corporate-business' ),
		'description'   => __( 'Appears on blog page sidebar', 'vw-corporate-business' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'vw-corporate-business' ),
		'description'   => __( 'Appears on page sidebar', 'vw-corporate-business' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'vw-corporate-business' ),
		'description'   => __( 'Appears on page sidebar', 'vw-corporate-business' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 1', 'vw-corporate-business' ),
		'description'   => __( 'Appears on footer 1', 'vw-corporate-business' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 2', 'vw-corporate-business' ),
		'description'   => __( 'Appears on footer 2', 'vw-corporate-business' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 3', 'vw-corporate-business' ),
		'description'   => __( 'Appears on footer 3', 'vw-corporate-business' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 4', 'vw-corporate-business' ),
		'description'   => __( 'Appears on footer 4', 'vw-corporate-business' ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Social Icon', 'vw-corporate-business' ),
		'description'   => __( 'Appears on top bar', 'vw-corporate-business' ),
		'id'            => 'social-icon',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'vw_corporate_business_widgets_init' );

/* Theme Font URL */
function vw_corporate_business_font_url() {
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800';

	$query_args = array(
		'family'	=> urlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

/* Theme enqueue scripts */
function vw_corporate_business_scripts() {
	wp_enqueue_style( 'vw-corporate-business-font', vw_corporate_business_font_url(), array() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css' );
	wp_enqueue_style( 'vw-corporate-business-basic-style', get_stylesheet_uri() );	
	wp_enqueue_style( 'vw-corporate-business-effect', get_template_directory_uri().'/css/effect.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/fontawesome-all.css' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery') ,'',true);
	wp_enqueue_script( 'vw-corporate-business-custom-scripts-jquery', get_template_directory_uri() . '/js/custom.js', array('jquery') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/* Enqueue the Dashicons script */
	wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'vw_corporate_business_scripts' );

function vw_corporate_business_ie_stylesheet(){
	wp_enqueue_style('vw-corporate-business-ie', get_template_directory_uri().'/css/ie.css');
	wp_style_add_data( 'vw-corporate-business-ie', 'conditional', 'IE' );
}
add_action('wp_enqueue_scripts','vw_corporate_business_ie_stylesheet');

function vw_corporate_business_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/*radio button sanitization*/

function vw_corporate_business_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/* Excerpt Limit Begin */
function vw_corporate_business_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

define('VW_CORPORATE_BUSINESS_FREE_THEME_DOC','https://vwthemes.com/docs/free-vw-corporate-business/','vw-corporate-business');
define('VW_CORPORATE_BUSINESS_SUPPORT','https://wordpress.org/support/theme/vw-corporate-business/','vw-corporate-business');
define('VW_CORPORATE_BUSINESS_REVIEW','https://www.vwthemes.com/topic/reviews-and-testimonials/','vw-corporate-business');
define('VW_CORPORATE_BUSINESS_BUY_NOW','https://www.vwthemes.com/themes/wordpress-themes-for-business/','vw-corporate-business');
define('VW_CORPORATE_BUSINESS_LIVE_DEMO','https://www.vwthemes.net/vw-business-pro/','vw-corporate-business');
define('VW_CORPORATE_BUSINESS_PRO_DOC','https://vwthemes.com/docs/vw-business-pro/','vw-corporate-business');
define('VW_CORPORATE_BUSINESS_FAQ','https://www.vwthemes.com/faqs/','vw-corporate-business');
define('VW_CORPORATE_BUSINESS_CHILD_THEME','https://developer.wordpress.org/themes/advanced-topics/child-themes/','vw-corporate-business');
define('VW_CORPORATE_BUSINESS_CONTACT','https://wordpress.org/support/theme/vw-corporate-business/','vw-corporate-business');
define('VW_CORPORATE_BUSINESS_DEMO_DATA','www.vwthemes.net/docs/corporate-business-demo.xml.zip','vw-corporate-business');

define('VW_CORPORATE_BUSINESS_CREDIT','https://www.vwthemes.com','vw-corporate-business');

if ( ! function_exists( 'vw_corporate_business_credit' ) ) {
	function vw_corporate_business_credit(){
		echo "<a href=".esc_url(VW_CORPORATE_BUSINESS_CREDIT)." target='_blank'>".esc_html__('VWThemes','vw-corporate-business')."</a>";
	}
}

/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/* Customizer additions. */
require get_template_directory() . '/inc/customizer.php';

/* Social Custom Widgets */
require get_template_directory() . '/inc/custom-widgets/social-profile.php';

/* Implement the About theme page */
require get_template_directory() . '/inc/getstart/getstart.php';