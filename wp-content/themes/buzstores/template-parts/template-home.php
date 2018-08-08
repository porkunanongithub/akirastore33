<?php
/**
 * Template Name: Home Page
 */

get_header();
    
    if(is_active_sidebar('buzstores-banner-widget')):
        ?> <div class="bs-container banner-container"> <?php
                dynamic_sidebar('buzstores-banner-widget');
        ?> </div> <?php
    endif;
    
    if(is_active_sidebar('buzstores-mid-content')):
        dynamic_sidebar('buzstores-mid-content');
    endif;
    
    
    if(is_active_sidebar('buzstores-subscribe-widget')): ?> 
        <div class="subscribe-container">
            <div class="bs-container"> 
                <?php dynamic_sidebar('buzstores-subscribe-widget'); ?>
            </div>
        </div> <?php
    endif;
    
    if(is_active_sidebar('buzstores-terms-widget')): ?> 
        <div class="terms-container">
            <div class="bs-container"> 
                <?php dynamic_sidebar('buzstores-terms-widget'); ?>
            </div>
        </div> <?php
    endif;
    
get_footer();