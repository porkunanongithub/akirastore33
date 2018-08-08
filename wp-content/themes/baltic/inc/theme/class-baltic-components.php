<?php
/**
 * Baltic Component class.
 *
 * @package Baltic
 */

/**
 * Baltic Components class.
 *
 * @since  1.0.0
 */
class Baltic_Components {

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function blogdescription() {
		bloginfo( 'description' );
	}

	/**
	 * [do_breadcrumb description]
	 *
	 * @return [type] [description]
	 */
	public static function do_breadcrumb() {

		if ( function_exists( 'bcn_display' ) ) {
			echo '<div class="breadcrumb">';
			bcn_display();
			echo '</div>';
		}
		elseif ( function_exists( 'breadcrumbs' ) ) {
			breadcrumbs();
		}
		elseif ( function_exists( 'crumbs' ) ) {
			crumbs();
		}
		elseif ( class_exists( 'WPSEO_Breadcrumbs' ) ) {
			yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
		}
		elseif ( function_exists( 'yoast_breadcrumb' ) && ! class_exists( 'WPSEO_Breadcrumbs' ) ) {
			yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
		}
		else {
			echo self::get_breadcrumb(); // WPCS: XSS ok.
		}

	}

	/**
	 * [get_breadcrumb description]
	 *
	 * @param  array  $args [description]
	 * @return [type]       [description]
	 */
	public static function get_breadcrumb( $args = array() ) {

		$media = new Baltic_Breadcrumb;

		return $media->get_output( $args );

	}

	public static function media( $args = array() ) {
		echo self::get_media( $args ); // WPCS: XSS ok.
	}

	/**
	 * [get_media description]
	 *
	 * @param  array  $args [description]
	 * @return [type]       [description]
	 */
	public static function get_media( $args = array() ) {

		$media = new Baltic_Media( $args );

		return $media->get_media( $args );

	}

	/**
	 * Loop index
	 *
	 * @return void
	 */
	public static function loop_index() {
		get_template_part( 'components/loop', 'index' );
	}

	/**
	 * [meta_categories description]
	 *
	 * @return [type] [description]
	 */
	public static function meta_categories() {
		get_template_part( 'components/entry/meta', 'categories' );
	}

	/**
	 * [meta_comments description]
	 *
	 * @return [type] [description]
	 */
	public static function meta_comments() {
		get_template_part( 'components/entry/meta', 'comments' );
	}

	/**
	 * [meta_edit_link description]
	 *
	 * @return [type] [description]
	 */
	public static function meta_edit_link() {
		get_template_part( 'components/entry/meta', 'edit_link' );
	}

	/**
	 * [meta_posted_by description]
	 *
	 * @return [type] [description]
	 */
	public static function meta_posted_by() {
		get_template_part( 'components/entry/meta', 'posted_by' );
	}

	/**
	 * [meta_posted_on description]
	 *
	 * @return [type] [description]
	 */
	public static function meta_posted_on() {
		get_template_part( 'components/entry/meta', 'posted_on' );
	}

	/**
	 * [meta_tags description]
	 *
	 * @return [type] [description]
	 */
	public static function meta_tags() {
		get_template_part( 'components/entry/meta', 'tags' );
	}

	/**
	 * [post_thumbnail description]
	 *
	 * @return [type] [description]
	 */
	public static function post_thumbnail() {
		get_template_part( 'components/entry/post', 'thumbnail' );
	}

	/**
	 * [post_content description]
	 *
	 * @return [type] [description]
	 */
	public static function post_content() {
		get_template_part( 'components/entry/post', 'content' );
	}

	/**
	 * [post_content description]
	 *
	 * @return [type] [description]
	 */
	public static function nav_image() {
		get_template_part( 'components/menus/nav', 'image' );
	}

	/**
	 * [post_content description]
	 *
	 * @return [type] [description]
	 */
	public static function nav_post() {
		get_template_part( 'components/menus/nav', 'post' );
	}

	/**
	 * [post_content description]
	 *
	 * @return [type] [description]
	 */
	public static function nav_products() {
		get_template_part( 'components/menus/nav', 'products' );
	}

	/**
	 * [post_content description]
	 *
	 * @return [type] [description]
	 */
	public static function nav_posts() {
		get_template_part( 'components/menus/nav', 'posts' );
	}

	/**
	 * [sidebar_footer description]
	 *
	 * @return [type] [description]
	 */
	public static function sidebar_footer() {
		get_sidebar( 'footer' );
	}

	/**
	 * [footer_copyright description]
	 *
	 * @return [type] [description]
	 */
	public static function footer_copyright() {
		get_template_part( 'components/footer/footer', 'copyright' );
	}

	/**
	 * Callback function for components/footer/payment-icons.php template part
	 *
	 * @return void
	 */
	public static function payment_icons() {
		get_template_part( 'components/footer/payment', 'icons' );
	}

	/**
	 * Preloader.
	 *
	 * @return string
	 */
	public static function preloader() {
		echo self::get_preloader(); // WPCS: XSS ok.
	}

	/**
	 * [get_preloader description]
	 *
	 * @return [type] [description]
	 */
	public static function get_preloader() {

		$preloader = Baltic_Options::get_option( 'preloader_type' );

		$markup = '';

		switch( $preloader ){
			case 'rotating-plane':
				$markup .= '
					<div class="sk-rotating-plane"></div>
				';
			break;
			case 'double-bounce' :
				$markup .= '
					<div class="sk-double-bounce">
						<div class="sk-child sk-double-bounce1"></div>
						<div class="sk-child sk-double-bounce2"></div>
					</div>
				';
			break;
			case 'wave' :
				$markup .= '
					<div class="sk-wave">
						<div class="sk-rect sk-rect1"></div>
						<div class="sk-rect sk-rect2"></div>
						<div class="sk-rect sk-rect3"></div>
						<div class="sk-rect sk-rect4"></div>
						<div class="sk-rect sk-rect5"></div>
					</div>
				';
			break;
			case 'wandering-cubes' :
				$markup .= '
					<div class="sk-wandering-cubes">
						<div class="sk-cube sk-cube1"></div>
						<div class="sk-cube sk-cube2"></div>
					</div>
				';
			break;
			case 'pulse' :
				$markup .= '
					<div class="sk-spinner-pulse"></div>
				';
			break;
			case 'chasing-dots' :
				$markup .= '
					<div class="sk-chasing-dots">
						<div class="sk-child sk-dot1"></div>
						<div class="sk-child sk-dot2"></div>
					</div>
				';
			break;
			case 'three-bounce' :
				$markup .= '
					<div class="sk-three-bounce">
						<div class="sk-child sk-bounce1"></div>
						<div class="sk-child sk-bounce2"></div>
						<div class="sk-child sk-bounce3"></div>
					</div>
				';
			break;
			case 'circle' :
				$markup .= '
					<div class="sk-circle">
						<div class="sk-circle1 sk-child"></div>
						<div class="sk-circle2 sk-child"></div>
						<div class="sk-circle3 sk-child"></div>
						<div class="sk-circle4 sk-child"></div>
						<div class="sk-circle5 sk-child"></div>
						<div class="sk-circle6 sk-child"></div>
						<div class="sk-circle7 sk-child"></div>
						<div class="sk-circle8 sk-child"></div>
						<div class="sk-circle9 sk-child"></div>
						<div class="sk-circle10 sk-child"></div>
						<div class="sk-circle11 sk-child"></div>
						<div class="sk-circle12 sk-child"></div>
					</div>
				';
			break;
			case 'cube-grid' :
				$markup .= '
					<div class="sk-cube-grid">
						<div class="sk-cube sk-cube1"></div>
						<div class="sk-cube sk-cube2"></div>
						<div class="sk-cube sk-cube3"></div>
						<div class="sk-cube sk-cube4"></div>
						<div class="sk-cube sk-cube5"></div>
						<div class="sk-cube sk-cube6"></div>
						<div class="sk-cube sk-cube7"></div>
						<div class="sk-cube sk-cube8"></div>
						<div class="sk-cube sk-cube9"></div>
					</div>
				';
			break;
			case 'fading-circle' :
				$markup .= '
					<div class="sk-fading-circle">
						<div class="sk-circle1 sk-circle"></div>
						<div class="sk-circle2 sk-circle"></div>
						<div class="sk-circle3 sk-circle"></div>
						<div class="sk-circle4 sk-circle"></div>
						<div class="sk-circle5 sk-circle"></div>
						<div class="sk-circle6 sk-circle"></div>
						<div class="sk-circle7 sk-circle"></div>
						<div class="sk-circle8 sk-circle"></div>
						<div class="sk-circle9 sk-circle"></div>
						<div class="sk-circle10 sk-circle"></div>
						<div class="sk-circle11 sk-circle"></div>
						<div class="sk-circle12 sk-circle"></div>
					</div>
				';
			break;
			case 'folding-cube' :
				$markup .= '
					<div class="sk-folding-cube">
						<div class="sk-cube1 sk-cube"></div>
						<div class="sk-cube2 sk-cube"></div>
						<div class="sk-cube4 sk-cube"></div>
						<div class="sk-cube3 sk-cube"></div>
					</div>
				';
			break;

		}

		$markup = str_replace( array( "\n", "\t", "\r" ), '', $markup );

		return sprintf( '<div class="spinner">%s</div>', $markup );

	}

}
