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
define( 'DB_NAME', 'treadly_reviews' );

/** MySQL database username */
define( 'DB_USER', '_root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'o~5AYJ+|KWVF)^.3q5VKV3+Zf&Oq;PW)j{g |T4?T,,_B3D7(.2*~SNsw-,EMV?)' );
define( 'SECURE_AUTH_KEY',  'fA $Baf%Tn|I-kbZXWebo8(zU9C3g*us6*?jl`+GG6FlFQXZ._-n6*,|dMQ[(j5:' );
define( 'LOGGED_IN_KEY',    'Q3-Zto#{S,G](sR;}8QZ;L}.~@0k:5uLdSUTFa9FC&X652W(erwHsXy/~CE$,jIv' );
define( 'NONCE_KEY',        'h8<.RlsOJ.Mv5%{7`iyh&+NKthd6.?+F!y^wbhh^Ea6#U-L^OPNNUsT0[8U)a)[m' );
define( 'AUTH_SALT',        'wi7g=>m1T7Kz/fmJ6]xm^(g)]@k3@3%h2n6V4KGl%!Nj06`N7ujyb;x/g[? j#wI' );
define( 'SECURE_AUTH_SALT', '#W_z`Z):%*c}EBx]?<hYv88pS<Yb# <&_<Mh]iE`nU=4%2eqr`R9 d~*:?t#!y+}' );
define( 'LOGGED_IN_SALT',   'R>5D96<hYlVV*w,xF0/n5&8/_Hygr5]jH;#FdE](Bp1`b0.7R).$#HU0~W }KUmq' );
define( 'NONCE_SALT',       ',H!dNr0,),8O<p]6+Cp++W+6%l#,zsjYzcR^0#q}I8hL.mv+g#}s+L2%cLIliJ/L' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'reviews_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
