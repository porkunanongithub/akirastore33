<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package VW Corporate Business
 */
?>

<div class="title-box">
    <div class="container">
        <h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'vw-corporate-business' ); ?></h1>
    </div>
</div>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( esc_html__( 'Ready to publish your first post? Get started here.', 'vw-corporate-business' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	<?php elseif ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vw-corporate-business' ); ?></p><br />
		<?php get_search_form(); ?>
	<?php else : ?>
	<p><?php esc_html_e( 'Dont worry&hellip it happens to the best of us.', 'vw-corporate-business' ); ?></p><br />
	<div class="read-moresec">
		<a href="<?php echo esc_url(home_url() ); ?>" class="button hvr-sweep-to-right"><?php esc_html_e( 'Back to Home Page', 'vw-corporate-business' ); ?></a>
	</div>
<?php endif; ?>