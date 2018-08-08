<?php
/**
 * Payment icons.
 *
 * @package Baltic
 */

$text 	= Baltic_Options::get_option( 'payment_text' );
$icons 	= Baltic_Options::get_option( 'payment_icons' );

if ( ! empty( $icons ) ) {
	echo '<div class="footer-payments-card">';
		echo '<div class="container">';

			echo '<ul class="baltic__payment-icons">';
			foreach ( $icons as $icon) {
				echo '<li>';
					Baltic_Icons::svg( array(
						'class'	=> 'icon icon-payment',
						'icon' 	=> esc_attr( $icon )
					) );
				echo '</li>';
			}
			echo '</ul>';

		echo '</div>';
	echo '</div>';
}
?>
