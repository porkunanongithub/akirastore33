<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Baltic
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php do_action( 'baltic_meta' );?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'baltic_before' );?>
<div id="page" class="site">

	<?php do_action( 'baltic_header_before' );?>
	<header <?php Baltic_Markup::attr( 'site-header' );?>>

		<?php do_action( 'baltic_header' );?>

	</header><!-- #masthead -->
	<?php do_action( 'baltic_header_after' );?>

	<div <?php Baltic_Markup::attr( 'site-content' );?>>
		<?php do_action( 'baltic_site_inner_before' );?>
