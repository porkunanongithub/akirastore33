<?php
/**
 * Meta Tags
 *
 * @package Baltic
 */

/* translators: used between list items, there is a space after the comma */
$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'baltic' ) );
if ( $tags_list ) {
	/* translators: %1$s: Tags SVG icon, %3$s: Tagged screen reader text, %3$s: list of tags,  */
	printf( '<span class="tags-links">%s <span class="screen-reader-text">%s</span> %s</span>', // WPCS: XSS ok.
		Baltic_Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'tag' ) ),
		esc_html__( 'Tagged', 'baltic' ),
		$tags_list
	);
}
