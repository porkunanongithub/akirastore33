<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.8
 */

if ( ! defined( 'YITH_WCWL' ) ) {
    exit;
} // Exit if accessed directly

global $product;
?>

<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', absint( $product_id ) ) )?>" rel="nofollow" data-product-id="<?php echo absint( $product_id ) ?>" data-product-type="<?php echo esc_attr( $product_type )?>" class="<?php echo esc_attr( $link_classes ) ?>" >
    <?php echo wp_kses_post( $icon ) ?>
    <?php echo esc_attr( $label ) ?>
    <span class="baltic-wishlist-loader"></span>
</a>
