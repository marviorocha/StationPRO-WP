<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'admin');

/** MySQL database password */
define('DB_PASSWORD', 'admin123');

/** MySQL hostname */
define('DB_HOST', 'mysql');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'In6ueLLE;q7x,0gE7b`#o.-8KqVNgssE;`%)we~m!X%&&w1pR0fvP%~lO>hDh7ot');
define('SECURE_AUTH_KEY',  '{W.T.w15NY8vHEK,,X?i^4i?_8f1:dAGjbVIKw6H8$wCD*9?0c3s^u%wV^>#sL$X');
define('LOGGED_IN_KEY',    '*2bHb7k-&ExVT`?$,l @1cETN*|_O3b1T<J(hMu,pSNgO$a4684W4|WDg7Ir>u3+');
define('NONCE_KEY',        'w`a CbGx$hRgT!<[Up!UAZk)0wRB8|E_JmEJVj. `kP(sM#O?Ze75~8u*r0Evy>P');
define('AUTH_SALT',        '&+(PXEq#X_hE<K.2/8a7>y2`=s+d(_EL;qa227r#X0W^}PA?pq#VTGvnLW}Y3bpG');
define('SECURE_AUTH_SALT', '{nGp]o1HGTE^{dx&$}^jDj0uFtj5kLSYzVi,Raz{T8s8R^a:Csu-QU.j+qk#]in?');
define('LOGGED_IN_SALT',   '7Im*~9rETs9D}Vi^`o_# W.i/Ku!d{r=$1K5J5*HJ[+WP1r<2*EwN pRPo+#MX||');
define('NONCE_SALT',       './w}f]Fvf>]Lw>fo@5t]w*)3up<!$ye/+q{^bO-)7Pzhhq4,:A%MU!i`f}$cW;e_');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/** Direct Upload Wordpress **/

define('FS_METHOD', 'direct');

define('WP_FS__DEV_MODE', true);
define('WP_FS__SKIP_EMAIL_ACTIVATION', true);
define('WP_FS__station-pro_SECRET_KEY', 'sk_mG+^^?E>y(B#jB)}vBH6dxi[LvWY7');

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
