<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package oStore
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class('cms-index-index cms-home-page home'); ?>>
<div id="page" class="site">
	<div>
	<!-- Header -->
	<div class="top_header_style_2">
		<?php do_action('ostore_top_header'); ?>
	</div>
	<div id="header-wrap " class="header-wrap-2" >
		<div class="container" style="background:url(<?php echo esc_url(get_header_image())?>) center no-repeat;">
		<!-- Header Logo -->
		<div class="middle-section">
			<div class="row">
				<div class="hidden-sm hidden-lg hidden-md col-xs-3">
					<button type="button" class="navbar-toggle pull-left header-two-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only"><?php echo esc_html__('Toggle navigation','ostore'); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="col-lg-3 col-sm-3 col-xs-6">
					
					<!-- Site Logo -->
					<div class="site-branding">
						<?php
							the_custom_logo();
							 ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
							<?php
							endif; 
						?>
					</div><!-- .site-branding -->
					<!-- .site-branding -->
				</div>
				<div class="col-lg-6 col-xs-6 hidden-xs">
					<?php  do_action('header_search_form');#search form ?>
						
				</div>
				<div class="col-lg-3 col-sm-3 col-xs-3 pull-right">
					<?php if( ostore_is_woocommerce_activated() ): ?>
					<div class="pull-right">
						<?php 
							esc_html(ostore_top_wishlist()); 
							esc_html(ostore_top_cart()); 
						?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>	
		</div>
		<nav id="primary-menu" class="primary-menu style-4 navbar navbar-default header-two" role="navigation"  >
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<div class="container">
					<div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
						<?php wp_nav_menu( 
							array( 'theme_location' => 'menu-1',
									'container' => 'ul',
									'menu_class'=> 'nav dropdown navbar-nav nav-dark'
								) 
							); 
						?>
					
						
					</div><!-- /.navbar-collapse -->
				</div><!--/.container -->
			</div>
		</nav>
	
	<div id="content" class="">