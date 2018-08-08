<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ganess-store
 */

/*
 * If the current post is protected by a password and
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php // You can start editing here -- including this comment! ?>
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'ganess-store' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'ganess-store'
					),
					esc_html(number_format_i18n( $comments_number )),
					get_the_title()
				);
			}
			?>
		</h2>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'ganess-store' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'ganess-store' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'ganess-store' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'ganess-store' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'ganess-store' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'ganess-store' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'ganess-store' ); ?></p>
<?php endif; ?>
<?php
	$args = array(
				'fields' => apply_filters(        
				'comment_form_default_fields', array(
				'author' =>'<label>'. esc_html__("Name", "ganess-store"). '<span>*</span></label>'. '<input  class="form-control"  name="author" type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />',

				'email7'  => '<label>'. esc_html__("Email", "ganess-store"). '<span>*</span></label>' . '<input  class="form-control"  name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" aria-required="true" />' ,
				)
			),

			'comment_field' => 
          	'<label>'. esc_html__("Your Message", "ganess-store"). '<span>*</span></label>' .
        	'<textarea  class="form-control" name="comment"   cols="50" rows="5" aria-required="true"></textarea>' ,
			'comment_notes_after' => '',
			'label_submit' =>esc_html__( 'ADD COMMENT', 'ganess-store' ),
			'comment_notes_before' => '',
		);
	comment_form($args); 
?>
</div><!-- #comments -->

<form>
