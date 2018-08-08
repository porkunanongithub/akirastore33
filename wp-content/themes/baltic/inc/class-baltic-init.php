<?php
/**
 * Baltic Init class.
 *
 * @package Baltic
 */

/**
 * Initialize Baltic theme.
 *
 * @since  1.0.0
 */
class Baltic_Init {

	/**
	 * Cached paths.
	 *
	 * @access private
	 * @var array
	 */
	private $cached_paths = array();

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 *
	 * @var Baltic_Init
	 */
	private static $_instance;


	/**
	 * Ensures only one instance of the theme class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 *
	 * @return Baltic_Init An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Constructor.
	 *
	 * @access private
	 */
	private function __construct() {

		/** Backward compatibilty */
		if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
			add_action( 'after_switch_theme', array( $this, 'back_compact' ) );
			return;
		}

		spl_autoload_register( array( $this, 'autoload' ) );

		// Theme
		Baltic_Setup::instance();
		Baltic_Icons::instance();
		Baltic_Markup::instance();
		Baltic_Markup::instance();
		Baltic_Customizer::instance();

		// Structure
		Baltic_Header::instance();
		Baltic_Sidebar::instance();
		Baltic_Footer::instance();

		// Integration
		Baltic_Connect_Jetpack::instance();
		Baltic_Connect_WooCommerce::instance();

	}

	/**
	 * Deactivated Baltic theme if not meet requirement.
	 *
	 * @access public
	 * @return void
	 */
	public function back_compact() {

		switch_theme( WP_DEFAULT_THEME );
		unset( $_GET['activated'] );
		add_action( 'admin_notices', array( $this, 'notice' ) );

	}

	/**
	 * Admin notice.
	 *
	 * @access public
	 * @return string
	 */
	public function notice() {

		// Translators: %1$s: Theme name, %2$s: Current WordPress version
		$message = sprintf( __( '%1$s theme requires at least WordPress version 4.7. You are running version %2$s. Please upgrade and try again.', 'baltic' ),
			BALTIC_THEME_NAME,
			$GLOBALS['wp_version']
		);
		printf( '<div class="error">%s</div>', wp_kses_post( wpautop( $message ) ) );

	}

	/**
	 * The Baltic class autoloader.
	 * Finds the path to a class that we're requiring and includes the file.
	 *
	 * @access protected
	 * @param string $class_name The name of the class we're trying to load.
	 */
	protected function autoload( $class_name ) {

		// Not a Baltic file, early exit.
		if ( 0 !== stripos( $class_name, 'Baltic' ) ) {
			return;
		}

		// Check if we've got it cached and ready.
		if ( isset( $this->cached_paths[ $class_name ] ) && file_exists( $this->cached_paths[ $class_name ] ) ) {
			require_once $this->cached_paths[ $class_name ];
			return;
		}

		$paths = $this->get_paths( $class_name );

		foreach ( $paths as $path ) {
			$path = wp_normalize_path( $path );
			if ( file_exists( $path ) ) {
				$this->cached_paths[ $class_name ] = $path;
				require_once $path;
				return;
			}
		}

	}

	/**
	 * Get an array of possible paths for the file.
	 *
	 * @access protected
	 * @param string $class_name The name of the class we're trying to load.
	 * @return array
	 */
	protected function get_paths( $class_name ) {

		$paths = array();
		// Build the filename.
		$filename = 'class-' . strtolower( str_replace( '_', '-', $class_name ) ) . '.php';

		// Break class-name into parts.
		$name_parts = explode( '_', str_replace( 'Baltic_', '', $class_name ) );

		if ( isset( $name_parts[0] ) && 'Connect' === $name_parts[0] ) {
			$path    = BALTIC_INC . '/connect/';
			$path   .= strtolower( str_replace( '_', '-', str_replace( 'Baltic_Connect_', '', $class_name ) ) ) . '/';
			$paths[] = $path . $filename;
		}

		if ( isset( $name_parts[0] ) && 'WooCommerce' === $name_parts[0] ) {
			$path    = BALTIC_INC . '/connect/woocommerce/';
			$paths[] = $path . $filename;
		}

		if ( isset( $name_parts[0] ) && 'Control' === $name_parts[0] ) {
			$path    = BALTIC_INC . '/customizer/controls/';
			$paths[] = $path . $filename;
		}

		if ( isset( $name_parts[0] ) && 'Settings' === $name_parts[0] ) {
			$path    = BALTIC_INC . '/customizer/settings/';
			$paths[] = $path . $filename;
		}

		$paths[] = BALTIC_INC . '/customizer/' . $filename;
		$paths[] = BALTIC_INC . '/extras/' . $filename;
		$paths[] = BALTIC_INC . '/structure/' . $filename;
		$paths[] = BALTIC_INC . '/theme/' . $filename;
		$paths[] = BALTIC_INC . '/widgets/' . $filename;

		$substr   = str_replace( 'Baltic_', '', $class_name );
		$exploded = explode( '_', $substr );
		$levels   = count( $exploded );

		$previous_path = '';
		for ( $i = 0; $i < $levels; $i++ ) {
			$paths[]        = BALTIC_INC . '/' . $previous_path . strtolower( $exploded[ $i ] ) . '/' . $filename;
			$previous_path .= strtolower( $exploded[ $i ] ) . '/';
		}
		return $paths;

	}

}

Baltic_Init::instance();
