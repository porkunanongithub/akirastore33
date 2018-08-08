<?php
/**
 * Post Navigation
 *
 * @package Baltic
 */

the_post_navigation( array(
    'prev_text'                  => __( '<span>&larr; previous post</span> %title', 'baltic' ),
    'next_text'                  => __( '<span>next post &rarr;</span> %title', 'baltic' ),
    'screen_reader_text'		 => __( 'Continue Reading', 'baltic' ),
) );
