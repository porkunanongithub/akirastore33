<?php
/**
 * Baltic Icons.
 *
 * @package Baltic
 */

/**
 * Baltic Icons class.
 *
 * @since  1.0.0
 */
class Baltic_Icons {

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Icons
	 */
	private static $_instance;

	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Icons An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	public function __construct() {

		/** Icons */
		add_action( 'wp_footer', array( $this, 'include_svg_icons' ), 9999 );
		add_filter( 'walker_nav_menu_start_el', array( $this, 'social_menu_icons' ), 10, 4 );
		add_filter( 'nav_menu_link_attributes', array( $this, 'social_link' ), 10, 3 );
		add_filter( 'nav_menu_item_title', array( $this, 'dropdown_menu_icons' ), 10, 4 );

	}

	/**
	 * [include_svg_icons description]
	 * @return [type] [description]
	 */
	public function include_svg_icons() {
		// Define SVG sprite file.
		$svg_icons = BALTIC_DIR . "/assets/images/svg-icons.svg";

		// If it exists, include it.
		if ( file_exists( $svg_icons ) ) {
			require $svg_icons;
		}
	}

	/**
	 * Add dropdown icon if menu item has children.
	 *
	 * @param  string $title The menu item's title.
	 * @param  object $item  The current menu item.
	 * @param  array  $args  An array of wp_nav_menu() arguments.
	 * @param  int    $depth Depth of menu item. Used for padding.
	 * @return string $title The menu item's title with dropdown icon.
	 */
	public function dropdown_menu_icons( $title, $item, $args, $depth ) {

		$dropdown_menu = self::get_svg( array( 'class' => 'icon-stroke icon-dropdown', 'icon' => 'chevron-bottom' ) );
		$toggle_menu = sprintf( '<button class="sub-menu-toggle" role="button" aria-expanded="false">%s%s</button>',
			self::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'chevron-top' ) ),
			self::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'chevron-bottom' ) )
		);

		if ( 'menu-1' === $args->theme_location ) {
			foreach ( $item->classes as $value ) {
				if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
					$title = $title . $dropdown_menu . $toggle_menu;
				}
			}
		}

		return $title;

	}

	/**
	 * Display SVG icons in social links menu.
	 *
	 * @param  string  $item_output The menu item output.
	 * @param  WP_Post $item        Menu item object.
	 * @param  int     $depth       Depth of the menu.
	 * @param  array   $args        wp_nav_menu() arguments.
	 * @return string  $item_output The menu item output with social icon.
	 */
	public function social_menu_icons( $item_output, $item, $depth, $args ) {
		// Get supported social icons.
		$social_icons = $this->social_icons();

		// Change SVG icon inside social links menu if there is supported URL.
		if ( 'menu-3' === $args->theme_location ) {
			foreach ( $social_icons as $attr => $value ) {
				if ( false !== strpos( $item_output, $attr ) ) {
					$item_output = str_replace( $args->link_after, '</span>' . self::get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
				}
			}
		}

		return $item_output;
	}

	/**
	 * Add itemprop "sameAs" at anchor link.
	 *
	 * @param  array   $atts   	Menu attributes.
	 * @param  WP_Post $item 	Menu item object.
	 * @param  array   $args 	wp_nav_menu() arguments.
	 * @return string  $atts 	The menu item output with social icon.
	 */
	public function social_link( $atts, $item, $args ) {

		if ( 'menu-3' === $args->theme_location ) {
		    $atts['itemprop'] = 'sameAs';
		    return $atts;
		}
		return $atts;

	}

	/**
	 * Social icons.
	 *
	 * @return array
	 */
	public function social_icons() {

		/** @var array [Supported social links icons.] */
		$social_links_icons = array(
			'amazon.com'		=> 'amazon',
			'behance.net'     	=> 'behance',
			'bitbucket.org'		=> 'bitbucket',
			'blogger.com'		=> 'blogger',
			'buysellads.com'	=> 'buysellads',
			'codepen.io'      	=> 'codepen',
			'del.icio.us'		=> 'delicious',
			'deviantart.com'  	=> 'deviantart',
			'digg.com'        	=> 'digg',
			'digitalocean.com'	=> 'digitalocean',
			'dribbble.com'    	=> 'dribbble',
			'dropbox.com'     	=> 'dropbox',
			'facebook.com'    	=> 'facebook',
			'flickr.com'      	=> 'flickr',
			'foursquare.com'  	=> 'foursquare',
			'getpocket.com'		=> 'getpocket',
			'github.com'      	=> 'github',
			'gitlab.com'		=> 'gitlab',
			'gitter.im'			=> 'gitter',
			'plus.google.com' 	=> 'google-plus',
			'wallet.google.com' => 'google-wallet',
			'hubspot.com'		=> 'hubspot',
			'instagram.com'   	=> 'instagram',
			'jsfiddle.net'		=> 'jsfiddle',
			'kickstarter.com'	=> 'kickstarter',
			'last.fm'			=> 'lastfm',
			'leanpub.com'		=> 'leanpub',
			'linkedin.com'    	=> 'linkedin',
			'medium.com'		=> 'medium',
			'mailto:'			=> 'envelope',
			'openid.net'		=> 'openid.net',
			'patreon.com'		=> 'patreon',
			'paypal.com'		=> 'paypal',
			'paypal.me'			=> 'paypal',
			'pinterest.com'		=> 'pinterest',
			'quora.com'			=> 'quora',
			'reddit.com'		=> 'reddit',
			'renren'			=> 'renren',
			'skype.com'       	=> 'skype',
			'skype:'			=> 'skype',
			'slack.com'			=> 'slack',
			'slideshare.com'	=> 'slideshare',
			'snapchat.com'		=> 'snapchat',
			'soundcloud.com'	=> 'soundcloud',
			'spotify.com'		=> 'spotify',
			'stackexchange.com'	=> 'stackexchange',
			'stackoverflow.com'	=> 'stackoverflow',
			'steam.com'			=> 'steam',
			'stumbleupon.com'	=> 'stumbleupon',
			'telegram.org'		=> 'telegram',
			'telegram.me'		=> 'telegram',
			'trello.com'		=> 'trello',
			'tripadvisor.com'	=> 'tripadvisor',
			'tumblr.com'		=> 'tumblr',
			'twitch.com'		=> 'twitch',
			'twitter.com'		=> 'twitter',
			'vimeo.com'			=> 'vimeo',
			'vk.com'			=> 'vk',
			'whatsapp.com'		=> 'whatsapp',
			'api.whatsapp.com'	=> 'whatsapp',
			'wikipedia.org'		=> 'wikipedia',
			'wordpress.com'		=> 'wordpress',
			'wordpress.org'		=> 'wordpress',
			'xing.com'			=> 'xing',
			'yahoo.com'			=> 'yahoo',
			'yandex.com'		=> 'yandex',
			'yelp.com'			=> 'yelp',
			'youtube.com'		=> 'youtube'
		);

		/**
		 * Filter Baltic social links icons.
		 *
		 * @since Baltic 1.0.0
		 *
		 * @param array $social_links_icons Array of social links icons.
		 */
		return apply_filters( 'baltic_social_links_icons', $social_links_icons );

	}

	/**
	 * Echo SVG Markup.
	 *
	 * @param array $args {
	 *     Parameters needed to display an SVG.
	 *
	 *     @type string $class Optional SVG class.
	 *     @type string $icon  Required SVG icon filename.
	 *     @type string $title Optional SVG title.
	 *     @type string $desc  Optional SVG description.
	 * }
	 * @return string SVG markup.
	 */
	public static function svg( $args = array() ) {
		echo self::get_svg( $args ); // WPCS: XSS ok.
	}

	/**
	 * Return SVG markup.
	 *
	 * @param array $args {
	 *     Parameters needed to display an SVG.
	 *
	 *     @type string $class Optional SVG class.
	 *     @type string $icon  Required SVG icon filename.
	 *     @type string $title Optional SVG title.
	 *     @type string $desc  Optional SVG description.
	 * }
	 * @return string SVG markup.
	 */
	public static function get_svg( $args = array() ) {

		// Make sure $args are an array.
		if ( empty( $args ) ) {
			return __( 'Please define default parameters in the form of an array.', 'baltic' );
		}

		// Define an icon.
		if ( false === array_key_exists( 'icon', $args ) ) {
			return __( 'Please define an SVG icon filename.', 'baltic' );
		}

		// Set defaults.
		$defaults = array(
			'class' 	=> 'icon',
			'icon' 		=> '',
			'title' 	=> '',
			'desc' 		=> '',
			'fallback' 	=> false,
		);

		// Parse args.
		$args = wp_parse_args( $args, $defaults );

		// Set aria hidden.
		$aria_hidden = ' aria-hidden="true"';

		// Set ARIA.
		$aria_labelledby = '';

		/*
		 * Baltic doesn't use the SVG title or description attributes; non-decorative icons are described with .screen-reader-text.
		 *
		 * However, child themes can use the title and description to add information to non-decorative SVG icons to improve accessibility.
		 *
		 * Example 1 with title: <?php echo Baltic_Icons::get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ) ) ); ?>
		 *
		 * Example 2 with title and description: <?php echo Baltic_Icons::get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ), 'desc' => __( 'This is the description', 'textdomain' ) ) ); ?>
		 *
		 * See https://www.paciellogroup.com/blog/2013/12/using-aria-enhance-svg-accessibility/.
		 */
		if ( $args['title'] ) {
			$aria_hidden     = '';
			$unique_id       = uniqid();
			$aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

			if ( $args['desc'] ) {
				$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
			}
		}

		// Begin SVG markup.
		$svg = '<svg class="' . esc_attr( $args['class'] ) . ' icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

		// Display the title.
		if ( $args['title'] ) {
			$svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

			// Display the desc only if the title is already set.
			if ( $args['desc'] ) {
				$svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
			}
		}

		/*
		 * Display the icon.
		 *
		 * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
		 *
		 * See https://core.trac.wordpress.org/ticket/38387.
		 */
		$svg .= ' <use href="#icon-' . esc_html( $args['icon'] ) . '" xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use> ';

		// Add some markup to use as a fallback for browsers that do not support SVGs.
		if ( $args['fallback'] ) {
			$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
		}

		$svg .= '</svg>';

		return $svg;

	}

}
