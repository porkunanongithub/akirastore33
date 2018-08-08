<?php
$buzstores_cat_list = buzstores_Category_list();

/** Customizers Panels **/
 $wp_customize->add_panel(
    'buzstores_general_panel',array(
        'title' => esc_html__('General Setting','buzstores'),
        'priority' => 1,
    )
 );
 $wp_customize->add_panel(
    'buzstores_design_panel',array(
        'title' => esc_html__('Design Setting','buzstores'),
        'priority' => 4,
    )
 );
 $wp_customize->add_panel(
    'buzstores_header_panel',array(
        'title' => esc_html__('Header Setting','buzstores'),
        'description' => esc_html__('All The Header Setting Available Here','buzstores'),
        'priority' => 8,
    )
 );
 $wp_customize->add_panel(
    'buzstores_home_panel',
    array(
        'title' => esc_html__('Home Setting','buzstores'),
        'description' => esc_html__('All The Setting For Home Sections','buzstores'),
        'priority' => 12
    )
 );
 $wp_customize->add_panel(
    'buzstores_footer_panel',array(
        'title' => esc_html__('Footer Setting','buzstores'),
        'description' => esc_html__('All The Header Setting Available Here','buzstores'),
        'priority' => 16,
    )
 ); 
 
 /** ==================== Design Panel Sections And Options ====================**/
 /** Design Section **/
 $wp_customize->add_section(
    'buzstores_design_section',
    array(
        'title' => esc_html__('Design Section','buzstores'),
        'priority' => 5,
        'panel' => 'buzstores_design_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_setting( 
  'buzstores_breadcrumb_image', 
      array( 
              'default' => '', 
              'sanitize_callback' => 'esc_url_raw'
          )
      );
  $wp_customize->add_control( new WP_Customize_Image_Control(
  $wp_customize,
  'buzstores_breadcrumb_image',
    array(
        'label' => esc_html__('Breadcrumb Image', 'buzstores'),
        'section' => 'buzstores_design_section',
        'description' => esc_html__('Recommend Image Size 1920  500','buzstores'),
        'settings' => 'buzstores_breadcrumb_image',
        'priority' => 4,
    )
  ));
  
  $wp_customize->add_setting(
    'buzstores_boxed_layout_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'buzstores_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'buzstores_boxed_layout_enable',
    array(
        'label' => esc_html__('Enable Web Boxed Layout','buzstores'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'buzstores_design_section'
    )
 );
 /** ==================== Header Panel Sections And Options ====================**/
 /** Mid Header Section **/
 $wp_customize->add_section(
    'buzstores_mid_header_section',
    array(
        'title' => esc_html__('Mid Header','buzstores'),
        'priority' => 5,
        'panel' => 'buzstores_header_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_product_search_enable',
    array(
        'default' => 'show',
        'sanitize_callback' => 'buzstores_sanitize_hide_show',
        )
 );
 $wp_customize->add_control( new buzstores_Customize_Switch_Control(
    $wp_customize, 
        'buzstores_product_search_enable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Hide / Show Product Search', 'buzstores' ),
            'description' 	=> esc_html__( 'Show Advance Product Search Field', 'buzstores' ),
            'section' 	=> 'buzstores_mid_header_section',
            'choices'   => array(
                'show' 	=> esc_html__( 'Show', 'buzstores' ),
                'hide' 	=> esc_html__( 'Hide', 'buzstores' )
                ),
            'priority'  => 3,
        )
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_header_info_enable',
    array(
        'default' => 'show',
        'sanitize_callback' => 'buzstores_sanitize_hide_show',
        )
 );
 $wp_customize->add_control( new buzstores_Customize_Switch_Control(
    $wp_customize, 
        'buzstores_header_info_enable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Hide / Show Info Section', 'buzstores' ),
            'description' 	=> esc_html__( 'Phone Number And Email Field', 'buzstores' ),
            'section' 	=> 'buzstores_mid_header_section',
            'choices'   => array(
                'show' 	=> esc_html__( 'Show', 'buzstores' ),
                'hide' 	=> esc_html__( 'Hide', 'buzstores' )
                ),
            'priority'  => 3,
        )
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_header_phone',
    array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'buzstores_header_phone',
    array(
        'label' => esc_html__('Header Phone','buzstores'),
        'priority' => 4,
        'type' => 'text',
        'section' => 'buzstores_mid_header_section'
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_header_email',
    array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'buzstores_header_email',
    array(
        'label' => esc_html__('Header Email','buzstores'),
        'priority' => 6,
        'type' => 'text',
        'section' => 'buzstores_mid_header_section'
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_header_cart_enable',
    array(
        'default' => 'show',
        'sanitize_callback' => 'buzstores_sanitize_hide_show',
        )
 );
 $wp_customize->add_control( new buzstores_Customize_Switch_Control(
    $wp_customize, 
        'buzstores_header_cart_enable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Hide / Show Cart List', 'buzstores' ),
            'description' 	=> esc_html__( 'Show Cart Count And Cart List', 'buzstores' ),
            'section' 	=> 'buzstores_mid_header_section',
            'choices'   => array(
                'show' 	=> esc_html__( 'Show', 'buzstores' ),
                'hide' 	=> esc_html__( 'Hide', 'buzstores' )
                ),
            'priority'  => 8,
        )
    )
 );

 /** Top Header Section **/
 $wp_customize->add_section(
    'buzstores_top_header_section',
    array(
        'title' => esc_html__('Top Header','buzstores'),
        'priority' => 4,
        'panel' => 'buzstores_header_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_top_header_enable',
    array(
        'default' => 'hide',
        'sanitize_callback' => 'buzstores_sanitize_hide_show',
        )
 );
 $wp_customize->add_control( new buzstores_Customize_Switch_Control(
    $wp_customize, 
        'buzstores_top_header_enable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable Top Header', 'buzstores' ),
            'section' 	=> 'buzstores_top_header_section',
            'choices'   => array(
                'show' 	=> esc_html__( 'Enabale', 'buzstores' ),
                'hide' 	=> esc_html__( 'Disable', 'buzstores' )
                ),
            'priority'  => 3,
        )
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_facebook_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'buzstores_facebook_link',
    array(
        'label' => esc_html__('Facebook Link','buzstores'),
        'priority' => 5,
        'type' => 'link',
        'section' => 'buzstores_top_header_section'
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_twitter_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'buzstores_twitter_link',
    array(
        'label' => esc_html__('Twitter Link','buzstores'),
        'priority' => 5,
        'type' => 'link',
        'section' => 'buzstores_top_header_section'
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_youtube_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'buzstores_youtube_link',
    array(
        'label' => esc_html__('Youtube Link','buzstores'),
        'priority' => 5,
        'type' => 'link',
        'section' => 'buzstores_top_header_section'
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_google_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'buzstores_google_link',
    array(
        'label' => esc_html__('Google Link','buzstores'),
        'priority' => 5,
        'type' => 'link',
        'section' => 'buzstores_top_header_section'
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_linkedin_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'buzstores_linkedin_link',
    array(
        'label' => esc_html__('LinkedIn Link','buzstores'),
        'priority' => 5,
        'type' => 'link',
        'section' => 'buzstores_top_header_section'
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_pinterest_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'buzstores_pinterest_link',
    array(
        'label' => esc_html__('Pinterest Link','buzstores'),
        'priority' => 5,
        'type' => 'link',
        'section' => 'buzstores_top_header_section'
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_top_menu_enable',
    array(
        'default' => 'show',
        'sanitize_callback' => 'buzstores_sanitize_hide_show',
        )
 );
 $wp_customize->add_control( new buzstores_Customize_Switch_Control(
    $wp_customize, 
        'buzstores_top_menu_enable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Hide / Show Top Header Menu', 'buzstores' ),
            'section' 	=> 'buzstores_top_header_section',
            'choices'   => array(
                'show' 	=> esc_html__( 'Show', 'buzstores' ),
                'hide' 	=> esc_html__( 'Hide', 'buzstores' )
                ),
            'priority'  => 6,
        )
    )
 );
 
 /** ==================== Home Panel Sections And Options ====================**/
 /** Slider Section **/
 $wp_customize->add_section(
    'buzstores_slider_section',
    array(
        'title' => esc_html__('Slider Section','buzstores'),
        'description' => esc_html__('All The Settings For Slider','buzstores'),
        'priority' => 5,
        'panel' => 'buzstores_home_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_slider_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'buzstores_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'buzstores_slider_enable',
    array(
        'label' => esc_html__('Check Enable Slider','buzstores'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'buzstores_slider_section'
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_slider_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'buzstores_sanitize_post_cat_list',
    )
 );
 $wp_customize->add_control(
    'buzstores_slider_cat',
    array(
        'label' => esc_html__('Slider Category','buzstores'),
        'priority' => 3,
        'type' => 'select',
        'choices' => $buzstores_cat_list,
        'section' => 'buzstores_slider_section'
    )
 );
 
 $wp_customize->add_setting( 
  'buzstores_slider_image_1', 
      array( 
              'default' => '', 
              'sanitize_callback' => 'esc_url_raw'
          )
      );
  $wp_customize->add_control( new WP_Customize_Image_Control(
  $wp_customize,
  'buzstores_slider_image_1',
    array(
        'label' => esc_html__('Slider Image One', 'buzstores'),
        'section' => 'buzstores_slider_section',
        'description' => esc_html__('Recommend Image Size 374  250','buzstores'),
        'settings' => 'buzstores_slider_image_1',
        'priority' => 4,
    )
  ));
  
  $wp_customize->add_setting(
    'buzstores_image_1_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    )
 );
 $wp_customize->add_control(
    'buzstores_image_1_link',
    array(
        'label' => esc_html__('Image One Link','buzstores'),
        'priority' => 5,
        'type' => 'text',
        'section' => 'buzstores_slider_section'
    )
 );
 
 $wp_customize->add_setting( 
  'buzstores_slider_image_2', 
      array( 
              'default' => '', 
              'sanitize_callback' => 'esc_url_raw'
          )
      );
  $wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
  'buzstores_slider_image_2',
    array(
        'label' => esc_html__('Slider Image Two', 'buzstores'),
        'section' => 'buzstores_slider_section',
        'description' => esc_html__('Recommend Image Size 340  250','buzstores'),
        'settings' => 'buzstores_slider_image_2',
        'priority' => 6,
    )
  ));
  
  $wp_customize->add_setting(
    'buzstores_image_2_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    )
 );
 $wp_customize->add_control(
    'buzstores_image_2_link',
    array(
        'label' => esc_html__('Image Two Link','buzstores'),
        'priority' => 7,
        'type' => 'text',
        'section' => 'buzstores_slider_section'
    )
 );
 
 /** ==================== Footer Panel Sections And Options ====================**/
 /** Footer Section **/
 $wp_customize->add_section(
    'buzstores_bottom_footer_section',
    array(
        'title' => esc_html__('Bottom Footer','buzstores'),
        'priority' => 5,
        'panel' => 'buzstores_footer_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 
 $wp_customize->add_setting(
    'buzstores_copyright_text',
    array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    )
 );
 $wp_customize->add_control(
    'buzstores_copyright_text',
    array(
        'label' => esc_html__('Copyright Text','buzstores'),
        'priority' => 1,
        'type' => 'text',
        'section' => 'buzstores_bottom_footer_section'
    )
 );