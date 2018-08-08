<?php
/**
 * Comment meta
 *
 * @package Baltic
 */

if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
echo '<span class="comments-link">';
Baltic_Icons::svg( array( 'class' => 'icon-stroke', 'icon' => 'msg' ) );
comments_popup_link(
	sprintf(
		wp_kses(
			/* translators: %s: post title */
			__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'baltic' ),
			array(
				'span' => array(
					'class' => array(),
				),
			)
		),
		get_the_title()
	)
);
echo '</span>';
endif;
