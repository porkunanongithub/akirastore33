<div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','vw-newspaper'); ?></a></div>
<div id="header" class="menubar">
  <div class="container">
    <div class="row">
      <div class="col-lg-11 col-md-11 nav">
        <?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
      </div>
      <div class="search-box col-md-1 col-sm-1">
        <span><i class="fas fa-search"></i></span>
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