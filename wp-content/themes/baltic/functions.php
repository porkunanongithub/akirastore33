<?php
/**
 * Baltic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Baltic
 */

$_baltic = wp_get_theme();
define( 'BALTIC_THEME_NAME', 				$_baltic->get( 'Name' ) );
define( 'BALTIC_THEME_URL', 				$_baltic->get( 'ThemeURI' ) );
define( 'BALTIC_THEME_DEVELOPER_AUTHOR', 	$_baltic->get( 'Author' ) );
define( 'BALTIC_THEME_DEVELOPER_URI', 		$_baltic->get( 'AuthorURI' ) );
define( 'BALTIC_THEME_VERSION', 			$_baltic->get( 'Version' ) );
define( 'BALTIC_THEME_DOMAIN', 				$_baltic->get( 'TextDomain' ) );

define( 'BALTIC_DIR', wp_normalize_path( get_template_directory() ) );
define( 'BALTIC_INC', BALTIC_DIR . '/inc' );
define( 'BALTIC_URI', get_template_directory_uri() );

/** Include Baltic theme core */
require_once ( BALTIC_DIR . "/inc/class-baltic-init.php" );
