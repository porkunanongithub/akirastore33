<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Ganess_Store
 */

get_header(); 
do_action('ganess_store_after_header'); 
do_action('ganess-store-breadcrumb-normal');
?>
	<section id="addtl-pages">
        <div class="grid-container grid-x grid-padding-x">
            <div class="cell large-4 medium-4 grid-x">
              <div class="margin-con">
                <span class="err-404"><?php echo esc_html__('404','ganess-store'); ?></span>
              </div>
            </div>
            <div class="cell large-8 medium-8 grid-x">
              <div class="error-con">
                <h5><?php echo esc_html__('OOOOOPS! PAGE NOT FOUND','ganess-store'); ?></h5>
                <p><?php echo esc_html__('By creating an account with our store, you will be able to move through the checkout process faster, store multipleshipping addresses, view and track your orders in your account and more.','ganess-store') ?></p>
                <a href="<?php echo esc_url(get_home_url()); ?>" class="purple-btn"><?php echo esc_html__('Back to Homepage','ganess-store'); ?></a>
              </div>
            </div>
        </div>
      </section>
<?php
get_footer();
