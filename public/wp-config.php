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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'admin123' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/** Direct Upload Wordpress **/

 define('FS_METHOD','direct');

 define( 'WP_FS__DEV_MODE', true );
 define( 'WP_FS__SKIP_EMAIL_ACTIVATION', true );
 define( 'WP_FS__station-pro_SECRET_KEY', 'sk_mG+^^?E>y(B#jB)}vBH6dxi[LvWY7' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'o|9uNPvnHzQKU0IcME9+BfMT`awPTaDo,vN~AO ^.&@m/k-V,: bCj58W^!DNv|,' );
define( 'SECURE_AUTH_KEY',  '~B<S4a#B7.>Tf*D6W5LOK9hOXs9=0.E.lfx_8zVd~Tw^_Dzh3tt8E-Y9ooKcMsh0' );
define( 'LOGGED_IN_KEY',    ',)Ko(G%U9)a8Hsyu5^_e8kBkgQSu@q={`gbdAb<ce7n_U|iKi;x!jk3rSfVgv}+$' );
define( 'NONCE_KEY',        '[h=Dw:#l$QBn:dj0#5b-aMoFuy1KsZ8=fpnlrZ^le#S8o`_P^^7H),W|p+O?xV@8' );
define( 'AUTH_SALT',        'm*xvlu=L<u;tH5!rWi#4Adw,h+_cdSk`%tt68@XM3!|+zmFnWs%]}PT+;:|ldrr>' );
define( 'SECURE_AUTH_SALT', 'c6MAP.Zb6[@3T z/Q:#qC_Ei@,p53:G6$F%`-j^@62$2=.wcHzA< __fR,%>Z4Yc' );
define( 'LOGGED_IN_SALT',   'K7*dvFULy+qy6/k<&:~p1wr3q pQ,qxJlZxKIb 5BN)]De5/Crw5cg2>tCuBAcR)' );
define( 'NONCE_SALT',       'R0?XL4oDT3_n;&9N-v U!{~!M$[c8n1 Z{-+S:5h>d-9y:~M=z|vQb*d%bvk.5w{' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

