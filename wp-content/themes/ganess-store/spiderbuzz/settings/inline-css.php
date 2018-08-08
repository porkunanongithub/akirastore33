<?php
function ganess_store_inline_css(){
	$custom_css = "";
    
        /** Cundition Control */
        $breadcrumb_bg_image = get_theme_mod('ganess_store_breadcrumbs_woocommerce_background_image');
        $ganess_store_breadcrumb_background_color = '#f1f1f1';

        if(empty($breadcrumb_bg_image)){
            $breadcrumb_color = 'background-color:'.$ganess_store_breadcrumb_background_color.';';
        }else{
            $breadcrumb_color = ' background:url('.esc_url($breadcrumb_bg_image) .') no-repeat center; background-size: cover; background-attachment:fixed;';
        }

        //Breadcrumb Secton Condtion
        $get_header_image = get_header_image();
        $custom_css = "
            #ganess-store-header{
                $breadcrumb_color !important;
            }

            #ganess-store-header-section{
                background:url( $get_header_image ) center no-repeat;
            }
        ";
	

	wp_add_inline_style( 'ganess-store-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ganess_store_inline_css' );
