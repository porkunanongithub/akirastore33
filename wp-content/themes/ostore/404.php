<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package oStore
 */

get_header(); 
ostore_breadcrumb();
?>
<!--Container -->
<div class="error-page">
    <div class="container">
		
		<div class="ostore_error_pagenotfound col-xs-12 col-md-12"> 
			<strong><?php esc_html_e('4','ostore'); ?><span id="ostore-animate-arrow"><?php esc_html_e('0','ostore'); ?></span><?php esc_html_e('4','ostore'); ?> </strong> <br />
			<h1 class="page-title"><?php  echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'ostore' ); ?></h1>
			<p><?php  echo esc_html__('Try using the button below to go to main page of the site', 'ostore'); ?></p>
			<br />
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button-back"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; <?php echo esc_html__('Go to Back', 'ostore'); ?></a>
		</div>
    <!-- end error page notfound --> 
		
	</div>
</div>

<?php
get_footer();
