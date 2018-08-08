<?php
    /**
    * oStore Theme Customizer
    *
    * @package oStore
    */

    /**
    * Add postMessage support for site title and description for the Theme Customizer.
    *
    * @param WP_Customize_Manager $wp_customize Theme Customizer object.
    */

    class oStoreCustomizer{
        function __construct(){
            add_action( 'customize_register', array($this,'ostore_general_customize') );
            add_action( 'customize_register', array($this,'ostore_header_customizer') );
            add_action( 'customize_register', array($this,'ostore_slider_customizer') );
            add_action('customize_register',array($this,'ostore_footer_customizer'));
            add_action('customize_register',array($this,'ostore_theme_layout_customizer'));
            add_action('customize_register',array($this,'ostore_woocommerce_settings_customizer'));
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

        function ostore_general_customize( $wp_customize ) {
            $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
            $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
            $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

            if ( isset( $wp_customize->selective_refresh ) ) {
                $wp_customize->selective_refresh->add_partial( 'blogname', array(
                    'selector'        => '.site-title a',
                    'render_callback' => 'ostore_customize_partial_blogname',
                ) );
                $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
                    'selector'        => '.site-description',
                    'render_callback' => 'ostore_customize_partial_blogdescription',
                ) );
            }
            /**
            * General Settings Panel
            */
            $wp_customize->add_panel('ostore_general_settings', array(
                'priority' => 1,
                'title' => esc_html__('OS: General Settings', 'ostore')
            ));

            $wp_customize->get_section('title_tagline')->panel = 'top_header_panel';
            $wp_customize->get_section('title_tagline' )->priority = 1;

            $wp_customize->get_section('header_image')->panel = 'top_header_panel';
            $wp_customize->get_section('header_image' )->priority = 2;

            $wp_customize->get_section('colors')->panel = 'top_header_panel';
            $wp_customize->get_section('background_image')->panel = 'top_header_panel';
            $wp_customize->get_section('header_image' )->priority = 4;

           
        }
        function ostore_header_customizer( $wp_customize ) {
                
            $customizer = KCustomizer::get_instance($wp_customize);
            
            $default = array(
                'panel' => array(
                    'id'            => "top_header_panel",
                    'label'         => __("OS: General Settings", 'ostore'),
                    "desc"          => "",
                    "priority"      => 1
                ),
                "sections" => array(
                    array(
                        'section' => array(
                            'id'        => "top_header",
                            'label'     => __("Top Header", "ostore"),
                            'priority'  => 1
                        ),
                        'fields' => array(
                            array(
                                // for settigns
                                'default'   => true,
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "ostore_top_header_enable",
                                'type'  => 'checkbox',
                                'label' => __("Enabel", 'ostore')
                            ),
                            
                            array(
                                // for settigns
                                'default'   => "addemail@gmail.com",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "ostore_top_header_email",
                                'type'  => 'text',
                                'label' => __("Email", "ostore")
                            ),
                            array(
                                // for settigns
                                'default'   => "+977 1234567890",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "ostore_top_header_address",
                                'type'  => 'text',
                                'label' => __("Address", "ostore")
                            ),
                            array(
                                // for settigns
                                'default'   => "Kathamandu , Nepal",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "ostore_top_header_phone_no",
                                'type'  => 'text',
                                'label' => __("Phone No", "ostore")
                            ),
                            array(
                                // for settigns
                                'default'   => "24 Hr",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "ostore_top_header_time",
                                'type'  => 'text',
                                'label' => __("Opening Time", "ostore")
                            )
                        )
                    ),
                    array(
                        'section' => array(
                            'id'        => "breadcrumb",
                            'label'     => __("Breadcrumb", "ostore"),
                            'priority'  => 2
                        ),
                        'fields' => array(
                            array(
                                // for settigns
                                'default'   => true,
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "ostore_breadcrumb_enable",
                                'type'  => 'checkbox',
                                'label' => __("Breadcrumb Enabel", 'ostore')
                            )
                        )
                    )
                )
            );
            $customizer->prepare( $default );
        }
        

        function ostore_slider_customizer($wp_customize) {
            $customizer = KCustomizer::get_instance($wp_customize);
            $default = array(
                'section' => array(
                        'id'        => "ostore_slider",
                        'label'     => __("OS: Slider", 'ostore'),
                        'priority'  => 2
                    ),
                    'fields' => array(
                        array(
                            // for settigns
                            'default'   => true,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_slider_enable",
                            'type'  => 'checkbox',
                            'label' => __("Enabel", 'ostore')
                        ),
                        array(
                            // for settigns
                            'default'   => 3,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_number_of_slider",
                            'type'  => 'number',
                            'label' => __("Number of Slider", 'ostore')
                        ),
                        array(
                            // for settigns
                            'default'   => false,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_slider_category",
                            'type'  => 'category',
                            'label' => __("Slider Category", 'ostore')
                        ),
                        array(
                            // for settigns
                            'default'   => 'default',
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_slider_style",
                            'type'  => 'radio',
                            'label' => __("Slider Style", 'ostore'),
                            'choices'  => array(
                                'default'  => 'Default Slider',
                                'left' => __('Slider & Left Category', 'ostore'),
                                'right'=>  __('Slider & Right Category', 'ostore')
                            )
                        ),
                        array(
                            // for settigns
                            'default'   => '',
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_woo_category_1",
                            'type'  => 'woselect',
                            'label' => __("Select First Category", 'ostore'),
                            'description'  => __("Only works for woocommerce category", 'ostore')
                        ),
                        array(
                            // for settigns
                            'default'   => '',
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_woo_category_2",
                            'type'  => 'woselect',
                            'label' => __("Select Second Category", 'ostore'),
                            'description'  => __("Only works for woocommerce category", 'ostore')
                        ),
                    )
                
                );
            $customizer->prepare( $default );
        }

        function ostore_theme_layout_customizer($wp_customize) {
            $customizer = KCustomizer::get_instance($wp_customize);
            $default = array(
                'panel' => array(
                    'id'            => "ostore_layout",
                    'label'         => __("OS: Layout", 'ostore'),
                    "desc"          => "",
                    "priority"      => 3
                ),
                array(
                    // for settigns
                    'default'   => true,
                    'transport' => 'refresh',
                    'panel'     =>  'os_store_footer',
                    //for control
                    'id'    => "ostore_footer_enable",
                    'type'  => 'checkbox',
                    'label' => __("Enabel", 'ostore')
                ),
                "sections" => array(
                    array(
                        'section' => array(
                            'id'        => "ostore_theme_layout",
                            'label'     => "Theme Layout",
                            'priority'  => 5
                        ),
                        'fields' => array(
                            array(
                                // for settigns
                                'default'   => 'default',
                                'transport' => 'refresh',
                                //for control
                                'id'    => "ostore_layout_style",
                                'type'  => 'radio',
                                'label' => __("Theme Layout", 'ostore'),
                                'choices'  => array(
                                    'default'  => 'Defult Layout',
                                    'box-layout' => __('Box Layout', 'ostore'),
                                )
                            ),
                        )
                        
                    ),
                    array(
                        'section' => array(
                            'id'        => "ostore_sidebar_layout",
                            'label'     => "Sidebar Layout",
                            'priority'  => 6
                        ),
                        'fields' => array(
                            array(
                                // for settigns
                                'default'   => 'right-sidebar',
                                'descrition'=> 'Archive && Blog Page Sidebar Layout',
                                'transport' => 'refresh',
                                //for control
                                'id'    => "archive_page_layout_option",
                                'type'  => 'radio',
                                'label' => __("Archive Layout", 'ostore'),
                                'choices'  => array(
                                    'left-sidebar'  => 'Left Sidebar',
                                    'right-sidebar' => __('Right Sidebar', 'ostore'),
                                    'full-width' => __('Full Width', 'ostore'),
                                    'both-sidebar' => __('Both Sidebar', 'ostore'),
                                )
                            ),
                            array(
                                // for settigns
                                'default'   => 'right-sidebar',
                                'descrition'=> 'Single page layout',
                                'transport' => 'refresh',
                                //for control
                                'id'    => "ostore_single_page_layout_option",
                                'type'  => 'radio',
                                'label' => __("Single Page", 'ostore'),
                                'choices'  => array(
                                    'left-sidebar'  => 'Left Sidebar',
                                    'right-sidebar' => __('Right Sidebar', 'ostore'),
                                    'full-width' => __('Full Width', 'ostore'),
                                    'both-sidebar' => __('Both Sidebar', 'ostore'),
                                )
                            ),
                            array(
                                // for settigns
                                'default'   => 'right-sidebar',
                                'descrition'=> 'Page sidebar Layout',
                                'transport' => 'refresh',
                                //for control
                                'id'    => "ostore_page_layout_option",
                                'type'  => 'radio',
                                'label' => __("Page Sidebar", 'ostore'),
                                'choices'  => array(
                                    'left-sidebar'  => 'Left Sidebar',
                                    'right-sidebar' => __('Right Sidebar', 'ostore'),
                                    'full-width' => __('Full Width', 'ostore'),
                                    'both-sidebar' => __('Both Sidebar', 'ostore'),
                                )
                            ),
                            
                        )
                        
                    ),
                )
            );    
            $customizer->prepare( $default );
        }

        //Woocommerce Settings Page
        function ostore_woocommerce_settings_customizer($wp_customize) {
            $customizer = KCustomizer::get_instance($wp_customize);
            $default = array(
                'section' => array(
                        'id'        => "ostore_woocommerce_settings",
                        'label'     => __("OS: Woocommerce Settings", 'ostore'),
                        'priority'  => 5
                    ),
                    'fields' => array(
                        array(
                            // for settigns
                            'default'   => 12,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_number_of_products_shop",
                            'type'  => 'number',
                            'label' => __("Shop Page Number of Products", 'ostore')
                        ),
                        array(
                            // for settigns
                            'default'   => 3,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_woocommerce_loop_columns",
                            'type'  => 'select',
                            'label' => __("Shop Page Number of Columns", 'ostore'),
                            'choices'  => array(
                                '1'     => __('1 Column','ostore'),
                                '2'     => __('2 Columns', 'ostore'),
                                '3'     => __('3 Columns', 'ostore'),
                                '4'     => __('4 Columns', 'ostore'),
                                '5'     => __('5 Columns', 'ostore'),
                            )
                        ),
                        array(
                            // for settigns
                            'default'   => 4,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_woocommerce_thumbnail_columns",
                            'type'  => 'select',
                            'label' => __("Single page thumbnails gallery column", 'ostore'),
                            'choices'  => array(
                                '1'     => __('1 Column','ostore'),
                                '2'     => __('2 Columns', 'ostore'),
                                '3'     => __('3 Columns', 'ostore'),
                                '4'     => __('4 Columns', 'ostore'),
                                '5'     => __('5 Columns', 'ostore'),
                            )
                        ),
                        array(
                            // for settigns
                            'default'   => 3,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_woocommerce_related_products_posts_per_page",
                            'type'  => 'number',
                            'label' => __("Single Page Related Products Number", 'ostore'),
                        ),
                        array(
                            // for settigns
                            'default'   => 3,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_woocommerce_related_products_columns",
                            'type'  => 'select',
                            'label' => __("Single Page Related Products Column", 'ostore'),
                            'choices'  => array(
                                '1'     => __('1 Column','ostore'),
                                '2'     => __('2 Columns', 'ostore'),
                                '3'     => __('3 Columns', 'ostore'),
                                '4'     => __('4 Columns', 'ostore'),
                                '5'     => __('5 Columns', 'ostore'),
                            )
                        ),
                        array(
                            // for settigns
                            'default'   => 'right-sidebar',
                            'descrition'=> 'Page sidebar',
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_woocommerce_page_layout_option",
                            'type'  => 'radio',
                            'label' => __("Woocommerce Sidebar Options", 'ostore'),
                            'choices'  => array(
                                'left-sidebar'  => 'Left Sidebar',
                                'right-sidebar' => __('Right Sidebar', 'ostore'),
                                'full-width' => __('Full Width', 'ostore')
                            )
                        ),
                        
                        
                    )
                
                );
            $customizer->prepare( $default );
        }

        //Footer Customizer
        function ostore_footer_customizer($wp_customize) {
            $customizer = KCustomizer::get_instance($wp_customize);
            $default = array(
                'panel' => array(
                    'id'            => "os_store_footer",
                    'label'         => __("OS: Footer Settings", 'ostore'),
                    "desc"          => "",
                    "priority"      => 6
                ),
                array(
                    // for settigns
                    'default'   => true,
                    'transport' => 'refresh',
                    'panel'     =>  'os_store_footer',
                    //for control
                    'id'    => "ostore_footer_enable",
                    'type'  => 'checkbox',
                    'label' => __("Enabel", 'ostore')
                ),
                "sections" => array(
                    array(
                    'section' => array(
                            'id'        => "ostore_social_links",
                            'label'     => __("Social Links", 'ostore'),
                            'priority'  => 41,
                            'panel'     =>'os_store_footer'
                        ),
                        'fields' => array(
                            array(
                                // for settigns
                                'default'   => true,
                                'transport' => 'refresh',
                                //for control
                                'id'    => "ostore_social_links_enable",
                                'type'  => 'checkbox',
                                'label' => __("Enabel", 'ostore')
                            ),
                            array(
                                    // for settigns
                                    'default'   => "https://www.facebook.com/",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "facebook_url",
                                    'type'  => 'url',
                                    'label' => __("Facebook URL", 'ostore')
                                ),
                                array(
                                    // for settigns
                                    'default'   => "https://www.plus.google.com/",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "google_plus",
                                    'type'  => 'url',
                                    'label' => __("Google Plus", 'ostore')
                                ),
                                array(
                                    // for settigns
                                    'default'   => "https://www.twitter.com",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "twitter_url",
                                    'type'  => 'url',
                                    'label' => __("Twitter URL", 'ostore')
                                ),
                                array(
                                    // for settigns
                                    'default'   => "https://www.rss.com",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "rss_url",
                                    'type'  => 'url',
                                    'label' => __("RSS URL", 'ostore')
                                ),
                                array(
                                    // for settigns
                                    'default'   => "https://www.linkedin.com",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "linkedin_url",
                                    'type'  => 'url',
                                    'label' => __("Linkedin URL", 'ostore')
                                ),
                                array(
                                    // for settigns
                                    'default'   => "https://www.instagram.com",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "instagram_url",
                                    'type'  => 'url',
                                    'label' => __("Instagram URL", 'ostore')
                                ),
                                
                        ))
                        
                    )
                );
                

            $customizer->prepare( $default );
        }
        
        
    }
oStoreCustomizer::get_instance();




//add the customizer 
function customize_logo_slider( $wp_customize ) {

//add the custom_info  section
			$wp_customize->add_section('logo_slider',array(
				'title'		=>esc_html__('OS: Logo Slider','ostore'),
				'description'=>esc_html__('logo Slider Section Hear','ostore'),
				'priority'	=>4,		
			));

            //Logo Slider On Checkbox            
            $wp_customize->add_setting('logo_slider_on', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'ostore_sanitize_checkbox'
            ));  
	        $wp_customize->add_control( 'logo_slider_on', array(
                'label' => esc_html__('Enable', 'ostore'),
                'description'=>esc_html__('Enable and Disable Logo Slider','ostore'),
                'section' => 'logo_slider',
                'type'     =>'checkbox',
                'priority'=>36
	        ));

            //Add the tile
            $wp_customize->add_setting('logo_slider_title', array(
                'default' => '',
                'type' => 'theme_mod',
                'sanitize_callback' => 'ostore_text_sanitize'
                
                ));  
            $wp_customize->add_control( 'logo_slider_title', array(
                'label' => esc_html__('Clints Logo Title', 'ostore'),
                'description'=>esc_html__('Client Logo Title Hear','ostore'),
                'section' => 'logo_slider',
                'type'     =>'text',
                'priority'=>37
                    
            ));

            //Add the Short Description
            $wp_customize->add_setting('logo_slider_short_dec', array(
                'default' => '',
                'type' => 'theme_mod',
                'sanitize_callback' => 'ostore_text_sanitize'
                ));  
            $wp_customize->add_control( 'logo_slider_short_dec', array(
                'label' => esc_html__('Clints Logo Description Hear', 'ostore'),
                'description'=>esc_html__('Client Logo Description Hear Hear','ostore'),
                'section' => 'logo_slider',
                'type'     =>'textarea',
                'priority'=>38
                    
            ));

            //Logo Side Add Image Multiple Image Slect
            $wp_customize->add_setting('logo_slide_add', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
            ));

	        $wp_customize->add_control(new Multi_Image_Custom_Control(
	            $wp_customize, 'logo_slide_add', array(
	                'label' => esc_html__('Logo Slider Image', 'ostore'),
                    'desciption'=>esc_html__('Add the Logo Slider Image','ostore'),
	                'section' => 'logo_slider',
	                'settings' => 'logo_slide_add',
	                'priority'=>39
	            )
	        ));

            ################################################################
            //add the custom_info  section
			$wp_customize->add_section('payment_logo_slider',array(
				'title'		=>esc_html__('Payment Logo ','ostore'),
				'description'=>esc_html__('Payment logo  Section Hear','ostore'),
                'priority'	=>5,
                'panel'     => 'os_store_footer'		
			));

            $wp_customize->add_setting('payment_enable',array(
                'default'   =>  '',
                'type'      =>  'theme_mod',
                'sanitize_callback' => 'ostore_sanitize_checkbox'
            ));
            $wp_customize->add_control('payment_enable',array(
                'label'     =>  esc_html__( 'Payment Enable','ostore'),
                'description'=>'',
                'section'   => 'payment_logo_slider',
                'type'      =>  'checkbox'
            ));

            $wp_customize->add_setting('payment_logo_add', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
            ));

	        $wp_customize->add_control(new Multi_Image_Custom_Control(
	            $wp_customize, 'payment_logo_add', array(
	                'label' => esc_html__('Payment Logo Image', 'ostore'),
                    'desciption'=>esc_html__('Payment Logo Image','ostore'),
	                'section' => 'payment_logo_slider',
	                'settings' => 'payment_logo_add',
	                'priority'=>41
	            )
	        ));

		}
add_action( 'customize_register', 'customize_logo_slider' );


if (!class_exists('WP_Customize_Image_Control')) {
    return null;
}
class Multi_Image_Custom_Control extends WP_Customize_Control
{
    public function enqueue()
    {
        wp_enqueue_style('multi-image-style', get_template_directory_uri().'/themerelic/customizer/custom.css');
        wp_enqueue_script('multi-image-script', get_template_directory_uri().'/themerelic/customizer/custom.js', array( 'jquery' ), rand(), true);
    }

    public function render_content()
{ ?>
    <div class="payment_wraper">
        <label>
        <span class='customize-control-title'><?php echo esc_html__('Image','ostore'); ?></span>
        </label>
        <div>
        <ul class='images'></ul>
        </div>
        <div class='actions'>
        <a class="button-secondary upload"><?php echo esc_html__('Add','ostore'); ?></a>
        </div>

        <input class="wp-editor-area images-input" type="hidden" <?php esc_url($this->link()); ?>>
    </div>
    <?php
    }
}

/**
 * Ostore Text Info Control
 */
class Ostore_Info_Text extends WP_Customize_Control{
    public function render_content(){  ?>
        <span class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
        </span>
        <?php if($this->description){ ?>
            <span class="description customize-control-description">
            <?php echo wp_kses_post($this->description); ?>
            </span>
        <?php }
    }
}

    /**
     * Text fields sanitization
    */
    function ostore_text_sanitize( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }

	function ostore_array_sanitize($values){
		if(is_array($values)){
			return $values;
		}
		return array();
	}

	function ostore_sanitize_checkbox( $checked ) {
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
    
