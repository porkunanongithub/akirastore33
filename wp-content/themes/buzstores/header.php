<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package buzstores
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
 
<body <?php body_class(); ?>>
<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'buzstores' ); ?></a>

	<header id="masthead" class="site-header">
    
            <?php
            /** Top Header **/
            do_action('buzstores_top_header_action');
            
            /** Mid Header **/
            do_action('buzstores_mid_header_action'); 
            
            /** Main Header Menu **/
            do_action('buzstores_main_header_action');
            ?>
            
	</header><!-- #masthead -->

	<div id="content" class="site-content">
    
        <?php if(is_home() || is_front_page()):
            $buzstores_slider_enable = get_theme_mod('buzstores_slider_enable');
            if($buzstores_slider_enable){
                do_action('buzstores_slider_callback_action');
            }
        endif;
        
        if(!is_home() || !is_front_page()):
            do_action('buzstores_header_banner');
        endif;
        ?>
