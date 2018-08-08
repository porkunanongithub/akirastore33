<div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','vw-corporate-business'); ?></a></div>  
<div id="header" class="menubar">
  <div class="container">
    <div class="row bg-home">
      <div class="logo col-lg-3 col-md-3">
        <?php if( has_custom_logo() ){ vw_corporate_business_the_custom_logo();
        }else{ ?>
          <h1 class="text-sm-center text-md-left"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <?php $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) : ?>
            <p class="site-description"><?php echo esc_html($description); ?></p>
        <?php endif; } ?>
      </div>
      <div class="col-lg-6 col-md-6 nav">
        <?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
      </div>
      <div class="search-box col-md-1 col-sm-1">
        <span><i class="fas fa-search"></i></span>
      </div>
      <div class="col-lg-2 col-md-2 get-started">
        <?php if ( get_theme_mod('vw_corporate_business_started_text','') != "" ) {?>
          <a href="<?php echo esc_url( get_theme_mod('vw_corporate_business_started_link',__('#','vw-corporate-business')) ); ?>"><?php echo esc_html( get_theme_mod('vw_corporate_business_started_text',__('GET STARTED','vw-corporate-business')) ); ?></a>
        <?php }?>
      </div>
    </div>
    <div class="serach_outer">
      <div class="closepop"><i class="far fa-window-close"></i></div>
      <div class="serach_inner">
        <?php get_search_form(); ?>
      </div>
    </div>
  </div>
</div>