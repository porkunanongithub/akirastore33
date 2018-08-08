<?php
/**
 * Meta format
 *
 * @package Baltic
 */
$placeholder = Baltic_Options::get_option( 'thumb_placeholder' );

switch ( get_post_format() ) {

	case 'audio':

		echo '<div class="entry-media">';
			Baltic_Components::media( array('type' => 'audio', 'split_media' => true ) );
		echo '</div>';

	break;

	case 'video':

		echo '<div class="entry-media">';
			Baltic_Components::media( array('type' => 'video', 'split_media' => true ) );
		echo '</div>';

	break;

	case 'gallery':

		get_template_part( 'components/entry/post', 'gallery' );

	default:

		echo '<div class="post-thumbnail">';
			echo '<a href="'. esc_url( get_permalink() ) .'" aria-hidden="true">';

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
				echo $image; /* WPCS: xss ok. */
			}

			echo '</a>';
		echo '</div>';

	break;
}

?>
