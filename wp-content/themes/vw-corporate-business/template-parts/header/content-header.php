<div class="top-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-4">
            <?php if ( get_theme_mod('vw_corporate_business_location','') != "" ) {?>
              <i class="fas fa-map-marker-alt"></i><span><?php echo esc_html( get_theme_mod('vw_corporate_business_location',__('789 Dummy Street, USA 440213','vw-corporate-business')) ); ?></span>
            <?php }?>
          </div>
          <div class="col-md-3">
            <?php if ( get_theme_mod('vw_corporate_business_call','') != "" ) {?>
              <i class="fas fa-phone"></i><span><?php echo esc_html( get_theme_mod('vw_corporate_business_call',__('123-456-7890','vw-corporate-business')) ); ?></span>
            <?php }?>
          </div>
          <div class="col-md-5">
            <?php if ( get_theme_mod('vw_corporate_business_email','') != "" ) {?>
              <i class="fas fa-envelope"></i><span><?php echo esc_html( get_theme_mod('vw_corporate_business_email',__('support@example.com','vw-corporate-business')) ); ?></span>
            <?php }?>
          </div>         
        </div>
      </div>
      <div class="col-md-5">
        <?php dynamic_sidebar('social-icon'); ?>
      </div>
    </div>
  </div>
</div>