<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Ecommerce Store
 */
?>
    <div class="copyright-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <?php dynamic_sidebar('footer-1');?>
                </div>
                <div class="col-md-3 col-sm-3">
                    <?php dynamic_sidebar('footer-2');?>
                </div>
                <div class="col-md-3 col-sm-3">
                    <?php dynamic_sidebar('footer-3');?>
                </div>
                <div class="col-md-3 col-sm-3">
                    <?php dynamic_sidebar('footer-4');?>
                </div>
            </div>
        </div>
    </div>
	<div class="inner">
        <div class="copyright">
           <p><?php echo esc_html(get_theme_mod('bb_ecommerce_store_footer_copy',__('Ecommerce Theme By ','bb-ecommerce-store'))); ?> <?php bb_ecommerce_store_credit(); ?></p>
        </div>
        <div class="clear"></div>
    </div>
    <?php wp_footer(); ?>

</body>
</html>