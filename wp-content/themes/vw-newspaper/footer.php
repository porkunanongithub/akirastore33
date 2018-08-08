<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package VW Newspaper
 */
?>
<div  id="footer" class="copyright-wrapper">
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

<div id="footer-2">
    <div class="container">
        <div class="row">
          	<div class="col-md-6 copyright">
                <p><?php echo esc_html(get_theme_mod('vw_newspaper_footer_text',__('Newspaper WordPress Theme By','vw-newspaper'))); ?> <?php vw_newspaper_credit(); ?></p>
          	</div>
            <div class="col-md-6">
                <?php dynamic_sidebar('social-icon'); ?>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>