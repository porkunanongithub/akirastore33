<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


/**
 * After setup theme hook
 */
function blossom_pretty_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'blossom-pretty', get_stylesheet_directory() . '/languages' );

    add_image_size( 'blossom-pretty-slider', 500, 650, true );
}
add_action( 'after_setup_theme', 'blossom_pretty_theme_setup' );

if ( !function_exists( 'blossom_pretty_styles' ) ):
    function blossom_pretty_styles() {
    	$my_theme = wp_get_theme();
    	$version = $my_theme['Version'];
        
        wp_enqueue_style( 'blossom-feminine-style', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'animate' ) );
        
        wp_enqueue_style( 'blossom-pretty', get_stylesheet_directory_uri() . '/style.css', array( 'blossom-feminine-style' ), $version );
        
        wp_enqueue_script( 'blossom-pretty', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), $version, true );
        
        $array = array( 
            'rtl'       => is_rtl(),
        ); 
        wp_localize_script( 'blossom-pretty', 'blossom_pretty_data', $array );
    }
endif;
add_action( 'wp_enqueue_scripts', 'blossom_pretty_styles', 10 );

//Remove a function from the parent theme
function remove_parent_filters(){ //Have to do it after theme setup, because child theme functions are loaded first
    remove_action( 'customize_register', 'blossom_feminine_customizer_theme_info' );
}
add_action( 'init', 'remove_parent_filters' );

function blossom_feminine_body_classes( $classes ) {

    $blog_layout_option = get_theme_mod( 'blog_layout_option', 'home-two' );
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }
    
    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image custom-background';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color custom-background';
    }
    
    if( is_search() && ! is_post_type_archive( 'product' ) ){
        $classes[] = 'search-result-page';   
    }
    
    $classes[] = blossom_feminine_sidebar_layout();
    
    if( $blog_layout_option == 'home-two' ){
        $classes[] = 'blog-layout-two';
    }

    return $classes;
}

function blossom_pretty_customizer_register( $wp_customize ) {
    
    $wp_customize->get_control( 'slider_animation' )->active_callback   = 'blossom_pretty_slider_active_cb';

    $wp_customize->add_section( 'theme_info', array(
        'title'       => __( 'Demo & Documentation' , 'blossom-pretty' ),
        'priority'    => 6,
    ) );
    
    /** Important Links */
    $wp_customize->add_setting( 'theme_info_theme',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $theme_info = '<p>';
    $theme_info .= sprintf( __( 'Demo Link: %1$sClick here.%2$s', 'blossom-pretty' ),  '<a href="' . esc_url( 'https://demo.blossomthemes.com/blossom-pretty/' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p><p>';
    $theme_info .= sprintf( __( 'Documentation Link: %1$sClick here.%2$s', 'blossom-pretty' ),  '<a href="' . esc_url( 'https://blossomthemes.com/blossom-pretty-documentation/' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p>';

    $wp_customize->add_control( new Blossom_Feminine_Note_Control( $wp_customize,
        'theme_info_theme', 
            array(
                'section'     => 'theme_info',
                'description' => $theme_info
            )
        )
    );

    /** Layout Settings */
    $wp_customize->add_panel(
        'layout_settings',
        array(
            'title'    => __( 'Layout Settings', 'blossom-pretty' ),
            'priority' => 55,
        )
    );
    
    /** Slider Layout Settings */
    $wp_customize->add_section(
        'slider_layout_settings',
        array(
            'title'    => __( 'Slider Layout', 'blossom-pretty' ),
            'priority' => 10,
            'panel'    => 'layout_settings',
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'slider_layout', 
        array(
            'default'           => 'two',
            'sanitize_callback' => 'blossom_pretty_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Feminine_Radio_Image_Control(
            $wp_customize,
            'slider_layout',
            array(
                'section'     => 'slider_layout_settings',
                'label'       => __( 'Slider Layout', 'blossom-pretty' ),
                'description' => __( 'Choose the layout of the slider for your site.', 'blossom-pretty' ),
                'choices'     => array(
                    'one'   => get_stylesheet_directory_uri() . '/images/slider/one.jpg',
                    'two'   => get_stylesheet_directory_uri() . '/images/slider/two.jpg',
                )
            )
        )
    );
    
    /** Blog Layout */
    $wp_customize->add_section(
        'blog_layout',
        array(
            'title'    => __( 'Home Page Layout', 'blossom-pretty' ),
            'panel'    => 'layout_settings',
            'priority' => 15,
        )
    );
    
    /** Blog Page layout */
    $wp_customize->add_setting( 
        'blog_layout_option', 
        array(
            'default'           => 'home-two',
            'sanitize_callback' => 'blossom_pretty_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Feminine_Radio_Image_Control(
            $wp_customize,
            'blog_layout_option',
            array(
                'section'     => 'blog_layout',
                'label'       => __( 'Home Page Layout', 'blossom-pretty' ),
                'description' => __( 'This is the layout for blog index page.', 'blossom-pretty' ),
                'choices'     => array(                 
                    'home-one'   => get_stylesheet_directory_uri() . '/images/home/one-right.jpg',
                    'home-two'   => get_stylesheet_directory_uri() . '/images/home/two-right.jpg',
                )
            )
        )
    );
    
}
add_action( 'customize_register', 'blossom_pretty_customizer_register', 40 );

function blossom_feminine_banner(){
    
    $ed_slider = get_theme_mod( 'ed_slider', true );
    $slider_layout  = get_theme_mod( 'slider_layout', 'two' );

    if( ( is_front_page() || is_home() ) && $ed_slider ){ 
        $slider_type    = get_theme_mod( 'slider_type', 'latest_posts' );
        $slider_cat     = get_theme_mod( 'slider_cat' );
        $posts_per_page = get_theme_mod( 'no_of_slides', 3 );
    
        $args = array(
            'post_type'           => 'post',
            'post_status'         => 'publish',            
            'ignore_sticky_posts' => true
        );
        
        if( $slider_type === 'cat' && $slider_cat ){
            $args['cat']            = $slider_cat; 
            $args['posts_per_page'] = -1;  
        }else{
            $args['posts_per_page'] = $posts_per_page;
        }
        
        $text = ( $slider_layout == 'two' ) ? 'text-holder' : 'banner-text';
        
        $qry = new WP_Query( $args );
        
        if( $qry->have_posts() ){ ?>
            <div class="banner banner-layout-<?php echo esc_attr( $slider_layout ); ?>">
                <div id="banner-slider" class="owl-carousel slider-layout-<?php echo esc_attr( $slider_layout ); ?>">     
                    <?php while( $qry->have_posts() ){ $qry->the_post(); ?>             
                        <div class="item">
                        <?php 
                            if( $slider_layout == 'two' ){
                                $image_size = 'blossom-pretty-slider';
                            }else{
                                $image_size = 'blossom-feminine-slider';
                            }
                            
                            if( has_post_thumbnail() ){
                                the_post_thumbnail( $image_size );    
                            }else{ ?>
                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/' . $image_size . '.jpg' ) ?>" alt="<?php the_title_attribute(); ?>" />
                                <?php
                            }
                            ?> 
                            <div class="<?php echo esc_attr( $text ); ?>">
                                <?php
                                    blossom_feminine_categories();
                                    the_title( '<h1 class="title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h1>' );
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php
        wp_reset_postdata();
        }
    
    }
}

function blossom_feminine_footer_bottom(){ ?>
    <div class="site-info">
        <div class="container">
            <?php
                blossom_feminine_get_footer_copyright();
                
                echo '<a href="' . esc_url( 'https://blossomthemes.com/downloads/blossom-pretty-free-wordpress-theme' ) .'" rel="author" target="_blank">' . esc_html__( ' Blossom Pretty', 'blossom-pretty' ) . '</a>' . esc_html__( ' by Blossom Themes.', 'blossom-pretty' );
                
                printf( esc_html__( ' Powered by %s', 'blossom-pretty' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'blossom-pretty' ) ) .'" target="_blank">WordPress</a> .' );
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link();
                }
            ?>                    
        </div>
    </div>
    <?php
}

/**
 * Active Callback for banner section
*/
function blossom_pretty_slider_active_cb( $control ){
    
    $slider_layout  = get_theme_mod( 'slider_layout', 'two' );

    if( $slider_layout == 'one' ) return true;
    return false;
}

function blossom_pretty_sanitize_radio( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}