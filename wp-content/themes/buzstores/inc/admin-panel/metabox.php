<?php
/**
 * Create a metabox to added some custom filed in posts.
 *
 * @package buzstores
 */

 add_action( 'add_meta_boxes', 'buzstores_post_meta_options' );
 
 if( ! function_exists( 'buzstores_post_meta_options' ) ):
 function  buzstores_post_meta_options() {
    add_meta_box(
                'buzstores_post_meta',
                esc_html__( 'Post Options', 'buzstores' ),
                'buzstores_post_meta_callback',
                'post', 
                'normal', 
                'high'
            );
            add_meta_box(
                'buzstores_page_meta',
                esc_html__( 'Sidebar', 'buzstores' ),
                'buzstores_post_meta_callback',
                'page',
                'normal', 
                'high'
            ); 
 }
 endif;

 $buzstores_post_sidebar_options = array(
        'left-sidebar' => array(
                        'id'		=> 'post-right-sidebar',
                        'value'     => 'left-sidebar',
                        'label'     => esc_html__( 'Left sidebar', 'buzstores' ),
                        'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'
                    ), 
        'right-sidebar' => array(
                        'id'		=> 'post-left-sidebar',
                        'value' => 'right-sidebar',
                        'label' => esc_html__( 'Right sidebar', 'buzstores' ),
                        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'
                    ),
        'no-sidebar' => array(
                        'id'		=> 'post-no-sidebar',
                        'value'     => 'no-sidebar',
                        'label'     => esc_html__( 'No sidebar', 'buzstores' ),
                        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png'
                    ),        
        'both-sidebar' => array(
                        'id'		=> 'both-sidebar',
                        'value'     => 'both-sidebar',
                        'label'     => esc_html__( 'Both sidebar', 'buzstores' ),
                        'thumbnail' => get_template_directory_uri() . '/images/both-sidebar.png'
                    )
    );

/**
 * Callback function for post option
 */
if( ! function_exists( 'buzstores_post_meta_callback' ) ):
	function buzstores_post_meta_callback() {
		global $post, $buzstores_post_sidebar_options;
		wp_nonce_field( basename( __FILE__ ), 'buzstores_post_meta_nonce' );
?>
		<table class="form-table">
        
            <tr>
                <td colspan="4"><em class="f13"><?php esc_html_e('Choose Sidebar Template','buzstores'); ?></em></td>
            </tr>
            
            <tr>
                <td>
                <?php  
                   foreach ($buzstores_post_sidebar_options as $buzstores_post_sidebar_option) {
                    
                        $buzstores_post_sidebar = get_post_meta( $post->ID, 'buzstores_post_sidebar_layout', true ); ?>
            
                        <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                            <label class="description">
                                <span><img src="<?php echo esc_url( $buzstores_post_sidebar_option['thumbnail'] ); ?>" alt="" /></span></br>
                                <input type="radio" name="buzstores_post_sidebar_layout" value="<?php echo esc_attr($buzstores_post_sidebar_option['value']); ?>" <?php checked( $buzstores_post_sidebar_option['value'], $buzstores_post_sidebar ); if(empty($buzstores_post_sidebar) && $buzstores_post_sidebar_option['value']=='right-sidebar'){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html($buzstores_post_sidebar_option['label']); ?>
                            </label>
                        </div>
                        
                    <?php } // end foreach 
                                ?>
                    <div class="clear"></div>
                    
                </td>
            </tr>
        </table>
<?php		
	}
endif;

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Function for save value of meta opitons
 *
 * @since 1.0.0
 */
add_action( 'save_post', 'buzstores_save_post_meta' );

if( ! function_exists( 'buzstores_save_post_meta' ) ):

function buzstores_save_post_meta( $post_id ) {

    global $post, $buzstores_post_sidebar_options;

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'buzstores_post_meta_nonce' ] ) || !wp_verify_nonce( wp_unslash($_POST['buzstores_post_meta_nonce'] ), basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }

    /*Page sidebar*/
    foreach ( $buzstores_post_sidebar_options as $field ) {  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'buzstores_post_sidebar_layout', true ); 
        $new = sanitize_text_field( wp_unslash( $_POST['buzstores_post_sidebar_layout'] ));
        if ( $new && $new != $old ) {  
            update_post_meta ( $post_id, 'buzstores_post_sidebar_layout', $new );  
        } elseif ( '' == $new && $old ) {  
            delete_post_meta( $post_id,'buzstores_post_sidebar_layout', $old );  
        }
    } // end foreach
}
endif;  