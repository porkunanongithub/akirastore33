<?php
/**
 * Post thumbnail
 *
 * @package Baltic
 */

$placeholder = Baltic_Options::get_option( 'thumb_placeholder' );

if ( post_password_required() || is_attachment() ) {
	return;
}

?>
<div class="post-thumbnail">
	<a href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
		} elseif( ! empty( $placeholder) ) {
			$image = $placeholder;
			$image = wp_get_attachment_image( absint( $placeholder ), 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			echo $image; // WPCS: XSS ok.
		}

		?>
	</a>
</div>
