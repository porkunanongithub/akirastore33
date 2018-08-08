<?php

/*Add theme menu page*/
 
add_action('admin_menu', 'sornacommerce_admin_menu');

function sornacommerce_admin_menu() {
	
	$sornacommerce_page_title = esc_html__("SornaCommerce Premium",'sornacommerce');
	
	$sornacommerce_menu_title = esc_html__("SornaCommerce Premium",'sornacommerce');
	
	add_theme_page($sornacommerce_page_title, $sornacommerce_menu_title, 'edit_theme_options', 'sornacommerce_pro', 'sornacommerce_pro_page');
	
}

/*
**
** Premium Theme Feature Page
**
*/

function sornacommerce_pro_page(){
	if ( is_admin() ) {
		get_template_part('/inc/premium-screen/index');
		
	} 
}

function sornacommerce_admin_script($sornacommerce_hook){
	
	if($sornacommerce_hook != 'appearance_page_sornacommerce_pro') {
		return;
	} 
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css' );
	wp_enqueue_style( 'sornacommerce-custom-css', get_template_directory_uri() .'/inc/premium-screen/pro-custom.css',array(),'1.0' );

}

add_action( 'admin_enqueue_scripts', 'sornacommerce_admin_script' );



if ( ! class_exists( 'sornacommerce_Admin' ) ) :

/**
 * sornacommerce_Admin Class.
 */
class sornacommerce_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $pagenow;

		wp_enqueue_style( 'sornacommerce-message', get_template_directory_uri() . '/inc/premium-screen/message.css', array(), '1.0' );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'sornacommerce_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'sornacommerce_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['sornacommerce-hide-notice'] ) && isset( $_GET['_sornacommerce_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( wp_unslash($_GET['_sornacommerce_notice_nonce']), 'sornacommerce_hide_notices_nonce' ) ) {
				/* translators: %s: plugin name. */
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'sornacommerce' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) 
			/* translators: %s: plugin name. */{
				wp_die( esc_html__( 'Cheatin&#8217; huh?', 'sornacommerce' ) );
			}

			$hide_notice = sanitize_text_field( wp_unslash( $_GET['sornacommerce-hide-notice'] ) );
			update_option( 'sornacommerce_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated cresta-message">
        
			<a class="cresta-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'sornacommerce-hide-notice', 'welcome' ) ), 'sornacommerce_hide_notices_nonce', '_sornacommerce_notice_nonce' ) ); ?>"><?php  /* translators: %s: plugin name. */ esc_html_e( 'Dismiss', 'sornacommerce' ); ?></a>
            
			<p><?php printf( /* translators: %s: plugin name. */  esc_html__( 'Welcome! Thank you for choosing SornaCommerce or Simu Store! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'sornacommerce' ), '<a href="' . esc_url( admin_url( 'themes.php?page=sornacommerce_pro' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=sornacommerce_pro' ) ); ?>"><?php esc_html_e( 'Get started with SornaCommerce or Simu Store', 'sornacommerce' ); ?></a>
			</p>
		</div>
		<?php
	}



	

	
}

endif;

return new sornacommerce_Admin();




