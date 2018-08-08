<?php
/**
 * Post gallery
 *
 * @package Baltic
 */

$gallery = get_post_gallery( get_the_ID(), false );

if ( isset( $gallery['ids'] ) ) {
	$ids = explode( ",", $gallery['ids'] );
} else {
	return;
}

$ids = explode( ",", $gallery['ids'] );
echo '<div class="entry-media">';
	echo '<div id="gallery-'. absint( get_the_id() ) .'" class="entry-gallery">';
	foreach( $ids as $id ) {
		$image = wp_get_attachment_image( absint( $id ), 'post-thumbnail', array(
					'alt' => the_title_attribute( array(
						'echo' => false,
					) ),
				 ) );
		echo sprintf( '<div class="gallery__item">%s</div>', $image ); // WPCS: XSS ok.
	}
	echo '</div>';
echo '</div>';
