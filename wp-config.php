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
define('DB_NAME', 'stationpro');

/** MySQL database username */
define('DB_USER', 'stationpro');

/** MySQL database password */
define('DB_PASSWORD', 'luacho07');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'RxK+*z-7+~$u%pX`d}vPKGa!V5ed!#7zCnmn=.H|e+,=z?dCsa(6[EF{xcF,.T<T');
define('SECURE_AUTH_KEY',  'smCXtP5G74yl,DTkIvu-/Q:WL1;)K6i^E71hB?I6wsIbw[;;cdfhO ,t6o5F9j3W');
define('LOGGED_IN_KEY',    'p/&7)JobFQ:y#TR35J]kyFm2Zal*d@8?uKA3FL? tpUOxL$txoBQ9@yStX%$pk8O');
define('NONCE_KEY',        'Sp4}r]9=O!+?hL]C:_gRH,spL={Hb$PLi%7o(K]y&}MW1VYO?SYBPM`{Y}$S]/9H');
define('AUTH_SALT',        '~I#g){gBOO-x eG*+<V6`dW|?[)d=<u>``-2xSB$tSMI25IF0Nx8KpLULExmk/8t');
define('SECURE_AUTH_SALT', '0:T*hSd{c3aKVIjGn!(BBSOEzS}z:xr|3!,A/1#4fm!=;3RxHM00p%FVsl#,GBCs');
define('LOGGED_IN_SALT',   'C{8Re~K$U[n3EwB?XV-dV2N,5OSy;zeDK/#:@i7u]>d?RUs&0{I@ Hu;mj[&?L#C');
define('NONCE_SALT',       '~5Kvzxhnf]?P8>Hcgr=Sxk##|TiP^-n#lTkg{]Rv/LrMZbTT.Rw.zW-7/5p#wc^(');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

define('WP_HOME','http://stationpro.marviorocha.com');
define('WP_SITEURL','http://stationpro.marviorocha.com');

define('WP_MEMORY_LIMIT', '3000M');

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

define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

