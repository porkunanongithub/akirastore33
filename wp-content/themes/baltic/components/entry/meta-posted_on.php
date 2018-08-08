<?php
/**
 * Posted on meta
 *
 * @package Baltic
 */

$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
}

$time_string = sprintf( $time_string,
	esc_attr( get_the_date( 'c' ) ),
	esc_html( get_the_date() ),
	esc_attr( get_the_modified_date( 'c' ) ),
	esc_html( get_the_modified_date() )
);

$posted_on = sprintf( '%s <span class="screen-reader-text">%s</span> %s',
	Baltic_Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'calendar' ) ),
	esc_html__( 'Posted on', 'baltic' ),
	'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
);

echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS ok.
