<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'G:\xampp\htdocs\verify.dolil.com\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'dolil_verify' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

/** Database hostname */
define( 'DB_HOST', 'localhost:1876' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define('AUTH_KEY',         ';+7bllU4^Z_K7k+:E+!*L,=+GoXk)Tg&oL v|#k~eE*5IozFOadtq1&b7Es>Vb-2');
define('SECURE_AUTH_KEY',  'VO~,{a]f-zyzQwhbWVD:D/,87dT&x1lPltI.ZR~NA-J=YZt0XYK+/7@l5$;o?pLy');
define('LOGGED_IN_KEY',    's)0U4d!|E/.m|jvk?tTs0+b#|&QRkH/!y7[ED!}!&d&,T+#&x:@*[WZm)Za&<cep');
define('NONCE_KEY',        'Cky+)4Lx!TTq{QD0J:4FTALa,e.wr2?-s@J5CWs~W90mR.R?VU&c4,VE}GFFdW9?');
define('AUTH_SALT',        ';:_+t@-`~OeGZ85>/0bBx>FgFk/1X4@Q]%Dfx?-vdi1rVxv!4&%uIF]|j`v+P1DF');
define('SECURE_AUTH_SALT', 'gYzx<q(_C,z-=+{Xj&WR7r7 $Za!&i<G+a-%5CryOyD0v$uIR/sGPCwF)tzzrWf|');
define('LOGGED_IN_SALT',   '0 lk+JlD-@}W-.ZR3+BrE~wT1R#_)S&|(_`mBM#4*c&y0&-(mKmc1&mFR|]+w!/!');
define('NONCE_SALT',       'w)$6Yw,6,R3@v28_4-_%W+FcDT?`ZFc}ZCp.--xUfMMzbij[#[znk`}T|:vmB;-z');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'vd_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

