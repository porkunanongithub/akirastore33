<?php
/**
 * Posted By meta
 *
 * @package Baltic
 */

$byline = sprintf( '%s <span class="screen-reader-text">%s</span> %s',
	Baltic_Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'user' ) ),
	esc_html__( 'by', 'baltic' ),
	'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
);

echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS ok.
