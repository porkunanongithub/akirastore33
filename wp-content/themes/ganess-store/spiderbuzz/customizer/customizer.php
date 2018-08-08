<?php
/**
    * ganess-store Theme Customizer
    *
    * @package ganess-store
    */
    class GanessStoreCustomizer{

        function __construct(){
            add_action( 'customize_register', array($this,'ganess_store_general_customize') );
            
            add_action( 'customize_register', array($this,'ganess_store_slider_customizer') );
            add_action( 'customize_register', array($this,'ganess_store_woocommerce_page_customizer') );
            add_action( 'customize_register', array($this,'ganess_store_page_layout_customizer') );
            add_action( 'customize_register', array($this,'ganess_store_breadcurmb_customizer') );
            add_action( 'customize_register', array($this,'ganess_store_customize_logo_slider') );
            
            add_action( 'customize_preview_init', array($this, 'ganess_store_customize_preview_js' ) );

        }
        function __destruct() {
            $vars = array_keys(get_defined_vars());
            for ($i = 0; $i < sizeOf($vars); $i++) {
                unset($vars[$i]);
            }
            unset($vars,$i);
        }
        public static function get_instance() {
            static $instance;
            $class = __CLASS__;
            if( ! $instance instanceof $class) {
                $instance = new $class;
            }
            return $instance;
        }

        /**
         * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
         */
        function ganess_store_customize_preview_js() {
            wp_enqueue_style( 'ganess-customizer', get_template_directory_uri() . '/spiderbuzz/customizer/js/customizer.css', array(), '20151215' );

            wp_enqueue_script( 'ganess-store-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
        
        }

        function ganess_store_general_customize( $wp_customize ) {
            $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
            $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
            $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

            if ( isset( $wp_customize->selective_refresh ) ) {
                $wp_customize->selective_refresh->add_partial( 'blogname', array(
                    'selector'        => '.site-title a',
                    'render_callback' => 'ganess_store_customize_partial_blogname',
                ) );
                $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
                    'selector'        => '.site-description',
                    'render_callback' => 'ganess_store_customize_partial_blogdescription',
                ) );
            }
            
            /**
            * General Settings Panel
            */
            $wp_customize->add_panel('ganess_store_general_settings', array(
                'priority' => 1,
                'title' => esc_html__('General Settings', 'ganess-store')
            ));

            $wp_customize->get_section('title_tagline')->panel = 'ganess_store_general_settings';
            $wp_customize->get_section('title_tagline' )->priority = 1;

            $wp_customize->get_section('header_image')->panel = 'ganess_store_general_settings';
            $wp_customize->get_section('header_image' )->priority = 2;

            $wp_customize->get_section('colors')->panel = 'ganess_store_general_settings';
            
            $wp_customize->get_section('background_image')->panel = 'ganess_store_general_settings';
            $wp_customize->get_section('header_image' )->priority = 3;


            /**********************************************************
             *                      Top Header
             ***********************************************************/
            //add the custom_info  section
            $wp_customize->add_section('ganess_store_top_header',array(
                'title'     =>esc_html__('GS: Top Header','ganess-store'),
                'description'=>esc_html__('Ganess Store Top Header.','ganess-store'),
                'priority'  =>4,
                'panel'     =>'ganess_store_general_settings',
            ));

            //Enable/Disable Top Header
            $wp_customize->add_setting('ganess_store_top_header_enable', array(
                'default' => true,
                'type' => 'theme_mod',
                'sanitize_callback' => 'ganess_store_sanitize_checkbox'
            ));  
            $wp_customize->add_control( 'ganess_store_top_header_enable', array(
                'label' => esc_html__('Enable Top Header', 'ganess-store'),
                'description'=>esc_html__('Top Header Section.','ganess-store'),
                'section' => 'ganess_store_top_header',
                'type'     =>'checkbox',
                'priority'=> 1
            ));

            //Layout
            $wp_customize->add_setting('ganess_store_top_header_layout', array(
                'default'           => 'top_header_layout_1',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' =>  'ganess_store_sanitize_radio'
            ));
            $wp_customize->add_control('ganess_store_top_header_layout', array(
                'label'      => esc_html__('Ganess Store Top Header Layout', 'ganess-store'),
                'description'=> esc_html__('Select The Top Header Layout.','ganess-store'),
                'section'    => 'ganess_store_top_header',
                'settings'   => 'ganess_store_top_header_layout',
                'type'       => 'radio',
                'priority'   => 2,
                'choices'    => array(
                                'top_header_layout_1' => esc_html__('Store Info And Social Links','ganess-store'),
                                'top_header_layout_2' => esc_html__('Store Info And Top Menu','ganess-store'),
                                ),
            ));

            //Personal Info
            //email
            $wp_customize->add_setting('ganess_store_contact_email', array(
                'default' => 'spidersbuzz@gmail.com',
                'type' => 'theme_mod',
                'sanitize_callback' => 'sanitize_email'
            ));  
            $wp_customize->add_control( 'ganess_store_contact_email', array(
                'label' => esc_html__('Email Address', 'ganess-store'),
                'description'=>esc_html__('Type your email','ganess-store'),
                'section' => 'ganess_store_top_header',
                'type'     =>'email',
                'priority'=> 3
            ));

            // phone number
            $wp_customize->add_setting('ganess_store_phone_no', array(
                'default' => '+977-1234567890',
                'type' => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field'
            ));  
            $wp_customize->add_control( 'ganess_store_phone_no', array(
                'label' => esc_html__('Phone No.', 'ganess-store'),
                'description'=>esc_html__('Type your Phone No.','ganess-store'),
                'section' => 'ganess_store_top_header',
                'type'     =>'text',
                'priority'=> 4
            ));

            // location Hear
            $wp_customize->add_setting('ganess_store_location', array(
                'default' => 'Kathamandu, Nepal',
                'type' => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field'
            ));  
            $wp_customize->add_control( 'ganess_store_location', array(
                'label' => esc_html__('Location', 'ganess-store'),
                'description'=>esc_html__('Store Location','ganess-store'),
                'section' => 'ganess_store_top_header',
                'type'     =>'text',
                'priority'=> 5
            ));

            /************************ Social LInks ******************************** */
            //Facebook URL
            $wp_customize->add_setting('facebook_url', array(
                'default' => 'www.facebook.com',
                'type' => 'theme_mod',
                'sanitize_callback' => 'esc_url_raw'
            ));  
            $wp_customize->add_control( 'facebook_url', array(
                'label' => esc_html__('Facebook URL', 'ganess-store'),
                'description'=>esc_html__('Facebook Page URL Links','ganess-store'),
                'section' => 'ganess_store_top_header',
                'type'     => 'url',
                'priority'=> 7
                    
            ));

            // Google-Plus URL
            $wp_customize->add_setting('google_plus', array(
                'default' => 'www.google.plus.com',
                'type' => 'theme_mod',
                'sanitize_callback' => 'esc_url_raw'
            ));  
            $wp_customize->add_control( 'google_plus', array(
                'label' => esc_html__('Google Plus URL', 'ganess-store'),
                'description'=>esc_html__('Google Plus URL Links','ganess-store'),
                'section' => 'ganess_store_top_header',
                'type'     => 'url',
                'priority'=> 8
            ));

            //Pinterest URL
            $wp_customize->add_setting('pinterest_url', array(
                'default' => 'www.pinterest.com',
                'type' => 'theme_mod',
                'sanitize_callback' => 'esc_url_raw'
            ));  
            $wp_customize->add_control( 'pinterest_url', array(
                'label' => esc_html__('Pinterest URL', 'ganess-store'),
                'description'=>esc_html__('Type the Pinterest Profile URL','ganess-store'),
                'section' => 'ganess_store_top_header',
                'type'     => 'url',
                'priority'=> 9
            ));

            //Twitter URL
            $wp_customize->add_setting('twitter_url', array(
                'default' => 'www.twitter.com',
                'type' => 'theme_mod',
                'sanitize_callback' => 'esc_url_raw'
            ));  
            $wp_customize->add_control( 'twitter_url', array(
                'label' => esc_html__('Twitter URL', 'ganess-store'),
                'description'=>esc_html__('Type Twitter URL','ganess-store'),
                'section' => 'ganess_store_top_header',
                'type'     => 'url',
                'priority'=> 10
            ));

            //Youtube URL
            $wp_customize->add_setting('youtube_url', array(
                'default' => 'www.youtube.com',
                'type' => 'theme_mod',
                'sanitize_callback' => 'esc_url_raw'
            ));  
            $wp_customize->add_control( 'youtube_url', array(
                'label' => esc_html__('Youtube URL', 'ganess-store'),
                'description'=>esc_html__('Type Youtube URL','ganess-store'),
                'section' => 'ganess_store_top_header',
                'type'     => 'url',
                'priority'=> 11
            ));

            //Linkedin URL
            $wp_customize->add_setting('linkedin_url', array(
                'default' => 'www.linkedin.com',
                'type' => 'theme_mod',
                'sanitize_callback' => 'esc_url_raw'
            ));  
            $wp_customize->add_control( 'linkedin_url', array(
                'label' => esc_html__('Linkedin URL', 'ganess-store'),
                'description'=>esc_html__('Type Youtube URL','ganess-store'),
                'section' => 'ganess_store_top_header',
                'type'     => 'url',
                'priority'=> 12
            ));


            /**********************************************************
             *                   Ganess store Searchbox
             ***********************************************************/
            //add the custom_info  section
            $wp_customize->add_section('ganess_store_header_search_box',array(
                'title'     =>esc_html__('GS: Search Box','ganess-store'),
                'description'=>esc_html__('Enable/Disabe search box section.','ganess-store'),
                'priority'  =>4,
                'panel'     =>'ganess_store_general_settings',
            ));

            //Enable/Disable Top Header
            $wp_customize->add_setting('ganess_store_header_search_box_enable', array(
                'default' => true,
                'type' => 'theme_mod',
                'sanitize_callback' => 'ganess_store_sanitize_checkbox'
            ));  
            $wp_customize->add_control( 'ganess_store_header_search_box_enable', array(
                'label' => esc_html__('Disable Header Search Box', 'ganess-store'),
                'description'=>esc_html__('Disable the search box section.','ganess-store'),
                'section' => 'ganess_store_header_search_box',
                'type'     =>'checkbox',
                'priority'=> 1
            ));


        }

        /**********************************************
         *  customizer  Slider
         *********************************************/
        function ganess_store_slider_customizer( $wp_customize ) {
            $wp_customize->add_section('ganess_store_slider',array(
                'title'     =>esc_html__('GS: Slider','ganess-store'),
                'description'=>esc_html__('Slider Section ','ganess-store'),
                'priority'  =>2,
            ));

            //Slider Section         
            $wp_customize->add_setting('ganess_store_slider_enable', array(
                'default' => true,
                'type' => 'theme_mod',
                'sanitize_callback' => 'ganess_store_sanitize_checkbox'
            ));  
            $wp_customize->add_control( 'ganess_store_slider_enable', array(
                'label' => esc_html__('Enable Slider', 'ganess-store'),
                'description'=>esc_html__('Slier Section','ganess-store'),
                'section' => 'ganess_store_slider',
                'type'     =>'checkbox',
                'priority'=> 1
            ));


            //Slider Post Count  
            $wp_customize->add_setting('slider_post_count', array(
                'default' => 3,
                'type' => 'theme_mod',
                'sanitize_callback' => 'absint'
            ));  
            $wp_customize->add_control( 'slider_post_count', array(
                'label' => esc_html__('Number of Post.', 'ganess-store'),
                'description'=>esc_html__('Display the number of post.','ganess-store'),
                'section' => 'ganess_store_slider',
                'type'     =>'number',
                'priority'=> 2,
            ));

            function get_categories_select() {
                $teh_cats = get_categories();
                $results;
                $count = count($teh_cats);
                    for ($i=0; $i < $count; $i++) {
                    if (isset($teh_cats[$i]))
                        $results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
                    else
                        $count++;
                    }
                return $results;
            }

            // Slider  Category
            $wp_customize->add_setting( 'ganess_store_slider_category', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'ganess_store_sanitize_select',
            ) );
            
            $wp_customize->add_control( 'ganess_store_slider_category', array(
                'type' => 'select',
                'section' => 'ganess_store_slider', // Add a default or your own section
                'label' => esc_html__( 'Custom Select Option','ganess-store' ),
                'description' => esc_html__( 'This is a custom select option.','ganess-store' ),
                'choices' => get_categories_select()
            ) );

        }

        /**
         * Ganess Store Breadcurmb Settings
         */
        function ganess_store_breadcurmb_customizer($wp_customize) {
            //Woo Commerce Breadcrumb
            $wp_customize->add_section('ganess_store_page_woocommerce_breadcrumb',array(
                'title'     =>esc_html__('GS: Breadcrumb','ganess-store'),
                'description'=>esc_html__('Breadcrumb  Section','ganess-store'),
                'priority'  =>3,
            ));

            //Breadcrumb Enable/Disable Checkbox            
            $wp_customize->add_setting('ganess_store_wocommerce_breadcrumb_enable', array(
                'default' => true,
                'type' => 'theme_mod',
                'sanitize_callback' => 'ganess_store_sanitize_checkbox'
            ));  
            $wp_customize->add_control( 'ganess_store_wocommerce_breadcrumb_enable', array(
                'label' => esc_html__('Enable', 'ganess-store'),
                'section' => 'ganess_store_page_woocommerce_breadcrumb',
                'type'     =>'checkbox',
                'priority'=> 1
            ));

            //Breadcrumb Menu Enable/Disable Checkbox            
            $wp_customize->add_setting('ganess_store_breadcrumb_menu_enable', array(
                'default' => false,
                'type' => 'theme_mod',
                'sanitize_callback' => 'ganess_store_sanitize_checkbox'
            ));  
            $wp_customize->add_control( 'ganess_store_breadcrumb_menu_enable', array(
                'label' => esc_html__('Breadcrumb Title Enable', 'ganess-store'),
                'description'=>esc_html__('Enable/Disable Ganess Store Breadcrumb Title','ganess-store'),
                'section' => 'ganess_store_page_woocommerce_breadcrumb',
                'type'     =>'checkbox',
                'priority'=> 2
            ));

            // Breadcrumb Background images
            $wp_customize->add_setting('ganess_store_breadcrumbs_woocommerce_background_image', array(
                'transport'         => 'refresh',
                'height'            => 2,
                'sanitize_callback' => 'esc_url_raw',
            ));
            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ganess_store_breadcrumbs_woocommerce_background_image', array(
                'label'             => esc_html__('Upload Background Image', 'ganess-store'),
                'section'           => 'ganess_store_page_woocommerce_breadcrumb',
                'settings'          => 'ganess_store_breadcrumbs_woocommerce_background_image',
                'priority'          => 3
            )));

        }

        /*******************************************
         * Ganesh Store Layout
         *******************************************/
        function ganess_store_page_layout_customizer( $wp_customize ) {
            $wp_customize->add_panel( ' ganess_store_layout', array(
                'priority' => 4,
                'capability' => 'edit_theme_options',
                'theme_supports' => '',
                'title' => esc_html__( 'GS: Layout Settings', 'ganess-store' ),
                'description' => esc_html__( 'Layout Settings ', 'ganess-store' ),
            ) );
            
            /******************************************
             * Page Layout
             ******************************************/
            $wp_customize->add_section('ganess_store_page_layout',array(
                'title'     =>esc_html__('Archive Page Layout','ganess-store'),
                'description'=>esc_html__('Choose Sideber Left/Right  Section','ganess-store'),
                'priority'  =>1,
                'panel'     => ' ganess_store_layout'       
            ));

            // Breadcrumb Archive Page Layout
            $wp_customize->add_setting( 'archive_page_layout_option', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'ganess_store_sanitize_select',
                'default' => 'right-sidebar',
            ) );
            
            $wp_customize->add_control( 'archive_page_layout_option', array(
                'type' => 'select',
                'section' => 'ganess_store_page_layout', // Add a default or your own section
                'label' => esc_html__( 'Custom Select Option','ganess-store' ),
                'description' => esc_html__( 'This is a custom select option.','ganess-store' ),
                'choices' => array(
                    'right-sidebar' => esc_html__( 'Right Sidebar', 'ganess-store' ),
                    'left-sidebar' => esc_html__( 'Left Sidebar', 'ganess-store' ),
                ),
                'priority' => 1,
            ) );

            /******************************************
             * Single Page Layout
             ******************************************/
            $wp_customize->add_section('ganess_store_single_page_layout',array(
                'title'     =>esc_html__('Single Page Layout','ganess-store'),
                'description'=>esc_html__('Choose Sideber Left/Right  Section','ganess-store'),
                'priority'  =>2,
                'panel'     => ' ganess_store_layout'       
            ));

            // Breadcrumb Archive Page Layout
            $wp_customize->add_setting( 'ganess_store_single_page_layout_option', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'ganess_store_sanitize_select',
                'default' => 'right-sidebar',
            ) );
            
            $wp_customize->add_control( 'ganess_store_single_page_layout_option', array(
                'type' => 'select',
                'section' => 'ganess_store_single_page_layout', // Add a default or your own section
                'label' => esc_html__( 'Single Page Layout','ganess-store' ),
                'description' => esc_html__( 'This is a custom select option.', 'ganess-store' ),
                'choices' => array(
                    'right-sidebar' => esc_html__( 'Right Sidebar', 'ganess-store' ),
                    'left-sidebar' => esc_html__( 'Left Sidebar', 'ganess-store' ),
                ),
                'priority' => 1,
            ) );

        }

        /**********************************************
         *  customizer Control Woocommerce Page
         *********************************************/
        function ganess_store_woocommerce_page_customizer( $wp_customize ) {
            $wp_customize->add_panel( 'ganess_store_woocommerce', array(
                'priority' => 5,
                'capability' => 'edit_theme_options',
                'title' => esc_html__( 'GS: Woocommerce Settings', 'ganess-store' ),
                'description' => esc_html__( 'Woocommerce Settings ', 'ganess-store' ),
            ) );

            /****************************************************
             *  Woocommerce UpSell , Latest product  Display
             ****************************************************/
            $wp_customize->add_section('ganess_store_woocommerce_upsell',array(
                'title'     =>esc_html__('Woocommerce Upsell','ganess-store'),
                'description'=>esc_html__('Choose Sideber Left/Right  Section','ganess-store'),
                'priority'  =>1,
                'panel'     => 'ganess_store_woocommerce'
            ));

            

            // Upsell , Onsell & Popular Products          
            $wp_customize->add_setting('ganess_store_enable_upsell', array(
                'default' => 2,
                'type' => 'theme_mod',
                'sanitize_callback' => 'ganess_store_sanitize_checkbox'
            ));  
            $wp_customize->add_control( 'ganess_store_enable_upsell', array(
                'label' => esc_html__('Upsell , Onsell & Popular', 'ganess-store'),
                'section' => 'ganess_store_woocommerce_upsell',
                'type'     =>'checkbox',
                'priority'=> 1
            ));

            /****************************************************
             *  Shop Page Settings
             ****************************************************/
            $wp_customize->add_section('ganess_store_woocommerce_shop_page',array(
                'title'     =>esc_html__('Woocommerce Settings','ganess-store'),
                'description'=>esc_html__('All Default Settings','ganess-store'),
                'priority'  =>2,
                'panel'     => 'ganess_store_woocommerce'
            ));

            
            //woocommerce Breadcrumb Enable          
            $wp_customize->add_setting('ganess_store_woocommerce_breadcrumb_menu_enable', array(
                'default' => true,
                'type' => 'theme_mod',
                'sanitize_callback' => 'ganess_store_sanitize_checkbox'
            ));  
            $wp_customize->add_control( 'ganess_store_woocommerce_breadcrumb_menu_enable', array(
                'label' => esc_html__('Breadcrumb Title Enable', 'ganess-store'),
                'description'=>esc_html__('Enable/Disable Ganess Store Woocomerce Page Breadcrumb Title','ganess-store'),
                'section' => 'ganess_store_woocommerce_shop_page',
                'type'     =>'checkbox',
                'priority'=> 1
            ));

            //Post Per Page Display
            $wp_customize->add_setting('ganess_store_woocommerce_products_per_page', array(
                'default' => 12,
                'type' => 'theme_mod',
                'sanitize_callback' => 'absint'
            ));  
            $wp_customize->add_control( 'ganess_store_woocommerce_products_per_page', array(
                'label' => esc_html__('Post Per Page Products', 'ganess-store'),
                'description'=>esc_html__('Number of Products Display.','ganess-store'),
                'section' => 'ganess_store_woocommerce_shop_page',
                'type'     =>'number',
                'priority'=> 1,
            ));


            //Product gallery thumnbail columns.
            $wp_customize->add_setting('ganess_store_woocommerce_thumbnail_columns', array(
                'default' => 3,
                'type' => 'theme_mod',
                'sanitize_callback' => 'absint'
            ));  
            $wp_customize->add_control( 'ganess_store_woocommerce_thumbnail_columns', array(
                'label' => esc_html__('Product gallery thumnbail', 'ganess-store'),
                'description'=>esc_html__('Product gallery thumnbail columns.','ganess-store'),
                'section' => 'ganess_store_woocommerce_shop_page',
                'type'     =>'number',
                'priority'=> 2,
            ));

            //Related Products Args.
            $wp_customize->add_setting('ganess_store_woocommerce_related_products_posts_per_page', array(
                'default' => 3,
                'type' => 'theme_mod',
                'sanitize_callback' => 'absint'
            ));  
            $wp_customize->add_control( 'ganess_store_woocommerce_related_products_posts_per_page', array(
                'label' => esc_html__('Related Products Per Page', 'ganess-store'),
                'description'=>esc_html__('Single Page Products Page.','ganess-store'),
                'section' => 'ganess_store_woocommerce_shop_page',
                'type'     =>'number',
                'priority'=> 3,
            ));

            //Related Products Column
            $wp_customize->add_setting('ganess_store_woocommerce_related_products_columns', array(
                'default' => 3,
                'type' => 'theme_mod',
                'sanitize_callback' => 'absint'
            ));  
            $wp_customize->add_control( 'ganess_store_woocommerce_related_products_columns', array(
                'label' => esc_html__('Related Products Columns', 'ganess-store'),
                'description'=>esc_html__('Single Related Products Page Columns.','ganess-store'),
                'section' => 'ganess_store_woocommerce_shop_page',
                'type'     =>'number',
                'priority'=> 4,
            ));
        }

        function ganess_store_customize_logo_slider( $wp_customize ) {
            
            //add the custom_info  section
            $wp_customize->add_section('logo_slider',array(
                'title'     =>esc_html__('GS: Logo Slider','ganess-store'),
                'description'=>esc_html__('Logo Slider Section Hear','ganess-store'),
                'priority'  =>6,       
            ));

            //Logo Slider On Checkbox            
            $wp_customize->add_setting('logo_slider_enable', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'ganess_store_sanitize_checkbox'
            ));  
            $wp_customize->add_control( 'logo_slider_enable', array(
                'label' => esc_html__('Enable', 'ganess-store'),
                'description'=>esc_html__('Enable and Disable Logo Slider','ganess-store'),
                'section' => 'logo_slider',
                'type'     =>'checkbox',
                'priority'=> 1
            ));

            //Add the tile
            $wp_customize->add_setting('logo_slider_title', array(
                'default' => '',
                'type' => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field'
                
            ));  
            $wp_customize->add_control( 'logo_slider_title', array(
                'label' => esc_html__('Clints Logo Title', 'ganess-store'),
                'description'=>esc_html__('Client Logo Title Hear','ganess-store'),
                'section' => 'logo_slider',
                'type'     =>'text',
                'priority'=>2
                    
            ));

            

            //Logo Side Add Image Multiple Image Slect
            $wp_customize->add_setting('logo_slide_add', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
            ));

            $wp_customize->add_control(new Ganess_Store_Multi_Image_Custom_Control(
                $wp_customize, 'logo_slide_add', array(
                    'label' => esc_html__('Logo Slider Image', 'ganess-store'),
                    'desciption'=>esc_html__('Add the Logo Slider Image','ganess-store'),
                    'section' => 'logo_slider',
                    'settings' => 'logo_slide_add',
                    'priority'=>3
                )
            ));

        }

        
    }
GanessStoreCustomizer::get_instance();

/************************************************************************
 *                          Customizer Senitize
 *************************************************************************/
//Multiple Image Control
if (!class_exists('WP_Customize_Image_Control')) {
    return null;
}
class Ganess_Store_Multi_Image_Custom_Control extends WP_Customize_Control
{
    public function enqueue()
    {
        wp_enqueue_style('multi-image-style', get_template_directory_uri().'/spiderbuzz/customizer/css/custom.css');
        wp_enqueue_script('multi-image-script', get_template_directory_uri().'/spiderbuzz/customizer/js/custom.js', array( 'jquery' ), rand(), true);
    }

    public function render_content()
{ ?>
    <div class="payment_wraper">
        <label>
            <span class='customize-control-title'><?php echo esc_html__('Image','ganess-store'); ?></span>
        </label>
        <div>
            <ul class='images'></ul>
        </div>
        <div class='actions'>
            <a class="button-secondary upload"><?php echo esc_html__('Add','ganess-store'); ?></a>
        </div>

        <input class="wp-editor-area images-input" type="hidden" <?php esc_url($this->link()); ?>>
    </div>
        <?php
    }
}

/**
 * Text fields sanitization
*/
function ganess_store_array_sanitize($values){
    if(is_array($values)){
        return $values;
    }
    return array();
}

/**
 * Checkbox fields sanitization
*/
function ganess_store_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Select fields sanitization
*/
function ganess_store_sanitize_select( $input, $setting ) {
    $input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ganess_store_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ganess_store_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


//ganess store radio button senitize functions
function ganess_store_sanitize_radio( $input, $setting ){
    $input = sanitize_key($input);

    $choices = $setting->manager->get_control( $setting->id )->choices;
                     
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
     
}