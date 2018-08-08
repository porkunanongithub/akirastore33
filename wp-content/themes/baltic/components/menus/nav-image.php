<?php
/**
 * Image Navigation
 *
 * @package Baltic
 */
?>
<nav class="navigation post-navigation" role="navigation">
	<div class="nav-links">
		<div class="nav-previous">
			<?php previous_image_link( false,  __( '&larr; previous image', 'baltic' ) ); ?>
		</div>
		<div class="nav-next">
			<?php next_image_link( false, __( 'next image &rarr;', 'baltic' ) ); ?>
		</div>
	</div>
</nav>
