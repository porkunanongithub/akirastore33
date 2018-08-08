<?php
/**
 * Meta categories
 *
 * @package Baltic
 */

/* translators: used between list items, there is a space after the comma */
$categories_list = get_the_category_list( esc_html__( ', ', 'baltic' ) );
if ( $categories_list ) {
	/* translators: %1$s: Category SVG icon, %3$s: Posted in screen reader text, %3$s: list of categories,  */
	printf( '<span class="cat-links">%1$s <span class="screen-reader-text">%2$s</span> %3$s</span>', // WPCS: XSS ok.
		Baltic_Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'folder-open' ) ),
		esc_html__( 'Posted in', 'baltic' ),
		$categories_list
	);
}
