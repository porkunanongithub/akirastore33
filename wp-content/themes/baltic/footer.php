<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Baltic
 */

?>
		<?php do_action( 'baltic_site_inner_after' );?>
	</div><!-- #content -->

	<?php do_action( 'baltic_footer_before' );?>

	<footer <?php Baltic_Markup::attr( 'site-footer' );?>>
		<div class="container">
			<div class="columns columns-2">

				<?php do_action( 'baltic_footer' );?>

			</div><!-- .columns -->
		</div><!-- .container -->
	</footer><!-- #colophon -->

	<?php do_action( 'baltic_footer_after' );?>
</div><!-- #page -->

<?php do_action( 'baltic_after' );?>
<?php wp_footer(); ?>

</body>
</html>
