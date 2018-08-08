<?php
class Ostore_Post_Layout{
    public function __construct(){
        add_action( 'add_meta_boxes',array($this,'ostore_meta_box_add'));
        add_action( 'save_post', array($this,'ostore_meta_box_save') );
        
    }

    public function ostore_meta_box_add()
    {
        add_meta_box( 'ostore-meta-box-id', 'Display layout', array($this,'ostore_meta_box_cb'), array('post','page'), 'normal', 'high' );
    }

    public function ostore_meta_box_cb()
    {
        global $post;
         $layout = get_post_meta( $post->ID,'layout',true);
         //Default Value is Set
         if( empty($layout) ){
            $layout = esc_html__('right-sidebar','ostore');
         }
        
        // We'll use this nonce field later on when saving.
        wp_nonce_field( 'layout_nonce', 'meta_box_nonce' );
        ?>
        <p><?php echo esc_html__('Choose from following layout:','ostore'); ?><hr/>
            <input type="radio" name="layout" value="left-sidebar" <?php checked( $layout, 'left-sidebar' ); ?>><?php echo esc_html__('Left Sidebar','ostore'); ?>
            <input type="radio" name="layout" value="right-sidebar" <?php checked( $layout, 'right-sidebar' ); ?>><?php echo esc_html__('Right Sidebar','ostore'); ?>
            <input type="radio" name="layout" value="full-width" <?php checked( $layout, 'full-width' ); ?>><?php echo esc_html__('Full Width','ostore'); ?>
            <input type="radio" name="layout" value="both-sidebar" <?php checked( $layout, 'both-sidebar' ); ?>><?php echo esc_html__('Both Sidebar','ostore'); ?>
        </p>
        
    <?php    
    }
    public function ostore_meta_box_save($news_id)
    {
        // Bail if we're doing an auto save
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        
        // if our nonce isn't there, or we can't verify it, bail
        if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'layout_nonce' ) ) return;
        
        
        // now we can actually save the data
        $allowed = array(
            'a' => array( // on allow a tags
                'href' => array() // and those anchors can only have href attribute
            )
        );

        if( isset( $_POST['layout'] ) )
            update_post_meta( $news_id, 'layout',  esc_attr( $_POST['layout'] ));
    }



}
new Ostore_Post_Layout();



/*Ostore Layout Setting */
if ( ! function_exists( 'ostore_get_layout' ) ) {
function ostore_get_layout() {
        global $post;
        $layout = get_theme_mod( 'archive_page_layout_option', 'right-sidebar' );

        // Front page displays in Reading Settings
        $page_for_posts = get_option('page_for_posts');

        // Get Layout meta
        if($post) {
            $post_specific_layout = get_post_meta( $post->ID, 'layout', true );
        }
        // Home page if Posts page is assigned
        if( is_home() && !( is_front_page() ) ) {
            $queried_id  = get_option( 'page_for_posts' );
            if( !empty($post_specific_layout) && $post_specific_layout != 'default-layout' ) {
                $layout = get_post_meta( $post->ID, 'layout', true );
            }
        }

        //Page condtion Hear
        elseif( is_page() ) {
            $layout = get_theme_mod('ostore_page_layout_option','right-sidebar');
            if( !empty($post_specific_layout) && $post_specific_layout != 'default-layout' ) {
                $layout = get_post_meta( $post->ID, 'layout', true );
            
            }
        }

        //Single Page condtion
        elseif( is_single() ) {
            $layout = get_theme_mod('ostore_single_page_layout_option','right-sidebar');
            if( !empty($post_specific_layout) && $post_specific_layout != 'default-layout' ) {
                $layout = get_post_meta( $post->ID, 'layout', true );
            }
        }
        
    

        return $layout;
    }
}