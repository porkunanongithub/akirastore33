<?php
/**
 * OStore Demo Import Options 
 * Demo Import File 
 */
function ostore_import_files() {
    return array(
      array(
        'import_file_name'           => 'Default',
        'categories'                 => array( 'Ecommerce','Fashion'),
        'import_file_url'            => 'http://demo.themerelic.com/demo-import/ostore/default/all-content.xml',
        'import_widget_file_url'     => 'http://demo.themerelic.com/demo-import/ostore/default/widget.wie',
        'import_customizer_file_url' => 'http://demo.themerelic.com/demo-import/ostore/default/customizer.dat',
        
        'import_preview_image_url'   => 'https://themerelic.com/wp-content/uploads/2017/09/schreenshort.png',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'ostore' ),
        'preview_url'                => 'http://demo.themerelic.com/ostore/',
      ),
      array(
        'import_file_name'           => 'Default',
        'categories'                 => array( 'Ecommerce','Fashion'),
        'import_file_url'            => 'http://demo.themerelic.com/demo-import/ostore/default/all-content.xml',
        'import_widget_file_url'     => 'http://demo.themerelic.com/demo-import/ostore/default/widget.wie',
        'import_customizer_file_url' => 'http://demo.themerelic.com/demo-import/ostore/default/customizer.dat',
        
        'import_preview_image_url'   => 'https://themerelic.com/wp-content/uploads/2017/09/schreenshort.png',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'ostore' ),
        'preview_url'                => 'http://demo.themerelic.com/ostore/',
      ),
    );
  }
  add_filter( 'pt-ocdi/import_files', 'ostore_import_files' );


  
/*****************************************************************
*         After Demo Import Functions
*************************************************************/
function ostore_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

  set_theme_mod( 'nav_menu_locations', array(
    'menu-1' => $main_menu->term_id,
    )
  );

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Sample Page ' );
  $blog_page_id  = get_page_by_title( 'Blog' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'ostore_after_import_setup' );


