<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sql12250053');

/** MySQL database username */
define('DB_USER', 'sql12250053');

/** MySQL database password */
define('DB_PASSWORD', 'FTYNM2Kzyp');

/** MySQL hostname */
define('DB_HOST', 'sql12.freemysqlhosting.net');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '0p|=s]I&cQ-YFz.I!Vx+:OKRYqEe/#$jpj2~9}JfnFEQ(PXX9:S)#x?[})<wuB%w');
define('SECURE_AUTH_KEY',  'eM3SNJAC~I%XSSq6nJLz--G1e=uS&f<YHK%Z6|Xk9GAko>`8qG0j^uB=18t*PP;d');
define('LOGGED_IN_KEY',    '{jEawZ16_Zi5JcYx4?+S:/@Bn~^y0V!C^pj5L&$tM[q[hgFFP4pMZnV,Xvvrs.2$');
define('NONCE_KEY',        'hoo]q4gj5JKiH.FjY7gY@5+ED{4IoZ^DST8 E+Bz;e3.m#ucq=Lw.Fh*bnj,nvKa');
define('AUTH_SALT',        '+Ff!?::J%M7I|1_&$?Hr&R;1H=h=O`kaZsh95Rfhc)]TB&A+@8X=j6bCsgF#?d-H');
define('SECURE_AUTH_SALT', ':7sG8y1rM3%vsKlluL@%Zd;fM?N,N|THtmGhstR[a]5@+5h+#u`: gwD{;bY2iy(');
define('LOGGED_IN_SALT',   'K#89mMk*y)k)2c*+tF6#D+fl2Gp`m)r -X_g@Vn pCK7QA`tV+2KiA4;0X8>~_R>');
define('NONCE_SALT',       'K{@%eSA_G)FFJdW~o93lXVljt(2kt+;jI W>u_uf#D4mSUo:tN%J-phoqx%l @sP');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
