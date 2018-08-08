<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package buzstores
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <?php if(is_active_sidebar('buzstores-footer-1') || is_active_sidebar('buzstores-footer-2') || is_active_sidebar('buzstores-footer-3' || is_active_sidebar('buzstores-footer-4'))){ ?>
            <div class="bottom-footer wow fadeInUp">
                <div class="bs-container">
                    <div class="bottom-footer-wrapper clearfix">
                        <?php if(is_active_sidebar('buzstores-footer-1')){
                            ?>
                                <div class="footer-1">
                                    <?php dynamic_sidebar('buzstores-footer-1'); ?>
                                </div>
                            <?php
                        } ?>
                        <?php if(is_active_sidebar('buzstores-footer-2')){
                            ?>
                                <div class="footer-2">
                                    <?php dynamic_sidebar('buzstores-footer-2'); ?>
                                </div>
                            <?php
                        } ?>
                        <?php if(is_active_sidebar('buzstores-footer-3')){
                            ?>
                                <div class="footer-3">
                                    <?php dynamic_sidebar('buzstores-footer-3'); ?>
                                </div>
                            <?php
                        } ?>
                        <?php if(is_active_sidebar('buzstores-footer-4')){
                            ?>
                                <div class="footer-3">
                                    <?php dynamic_sidebar('buzstores-footer-4'); ?>
                                </div>
                            <?php
                        } ?>                    
                    </div>
                </div>
            </div>
        <?php } ?>
        
		<div class="site-info">
            <div class="footer-copyright">
                <span class="copyright-text"><?php echo wp_kses_post( get_theme_mod( 'buzstores_copyright_text'));?></span>
    			<span class="sep"> | </span>
    			<?php 
    				printf( esc_html__( 'Buzstores by %1$s.', 'buzstores' ), '<a href="'.esc_url( 'https://buzthemes.com' ).'" rel="designer">'.esc_html__('Buzthemes', 'buzstores').'</a>' ); 
                ?>
	       </div><!-- .site-info -->
          <div class="payment-image">
            <?php if(is_active_sidebar('buzstores-payment-image')){
                dynamic_sidebar('buzstores-payment-image');
            }?>
          </div>
        </div>
	</footer><!-- #colophon -->
    
    <!-- Test the scroll -->
    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
