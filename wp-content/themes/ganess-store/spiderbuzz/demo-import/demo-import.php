<?php
/**
 * Ganess Store Demo Import Options 
 * Demo Import File 
 */
function ganess_store_import_files() {
    return array(
      array(
        'import_file_name'           => 'Default',
        'categories'                 => array( 'Ecommerce','Fruits'),
        'import_file_url'            => 'http://demo.spiderbuzz.com/deom-data/ganess-store/default/all-content.xml',
        'import_widget_file_url'     => 'http://demo.spiderbuzz.com/deom-data/ganess-store/default/widget.wie',
        'import_customizer_file_url' => 'http://demo.spiderbuzz.com/deom-data/ganess-store/default/customizer.dat',
        
        'import_preview_image_url'   => 'https://spiderbuzz.com/wp-content/uploads/2018/03/ganesh-preview-banner.jpg',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'ganess-store' ),
        'preview_url'                => 'http://demo.spiderbuzz.com/ganess-store/',
      ),
      array(
        'import_file_name'           => 'Default',
        'categories'                 => array( 'Fruits'),
        'import_file_url'            => 'http://demo.spiderbuzz.com/deom-data/ganess-store/default/all-content.xml',
        'import_widget_file_url'     => 'http://demo.spiderbuzz.com/deom-data/ganess-store/default/widget.wie',
        'import_customizer_file_url' => 'http://demo.spiderbuzz.com/deom-data/ganess-store/default/customizer.dat',
        
        'import_preview_image_url'   => 'https://spiderbuzz.com/wp-content/uploads/2018/03/ganesh-preview-banner.jpg',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'ganess-store' ),
        'preview_url'                => 'http://demo.spiderbuzz.com/ganess-store/',
      ),
      
    );
  }
  add_filter( 'pt-ocdi/import_files', 'ganess_store_import_files' );


  
/*****************************************************************
*         After Demo Import Functions
*************************************************************/
function ganess_store_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'main Menu', 'nav_menu' );

  set_theme_mod( 'nav_menu_locations', array(
    'menu-1' => $main_menu->term_id,
    )
  );

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Home' );
  $blog_page_id  = get_page_by_title( 'Blog' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'ganess_store_after_import_setup' );