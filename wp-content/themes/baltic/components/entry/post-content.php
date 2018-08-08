<?php
/**
 * Post Content
 *
 * @package Baltic
 */

the_content( sprintf(
	wp_kses(
		/* translators: %s: Name of current post. Only visible to screen readers */
		__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'baltic' ),
		array(
			'span' => array(
				'class' => array(),
			),
		)
	),
	get_the_title()
) );

wp_link_pages( array(
	'before' 			=> '<div class="page-links"><span class="screen-reader-text">' . esc_html__( 'Pages:', 'baltic' ) . '</span>',
	'after'  			=> '</div>',
	'pagelink' 			=> '<span class="page-number">%</span>'
) );
