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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

define( 'WP_MEMORY_LIMIT', '256M' );

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_eurosystem' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'TO^c8%pqM ?1rFf=asicEeq$R0zYnrMq6T?.W]hxW{l6>dw_CWhR34mld3jHX1&:' );
define( 'SECURE_AUTH_KEY',   'EOtg@%,[Qj34)TF+q Y*3ZF>aslXpJBjsLSgHb]6Cri%L@Z*8A2i)n&Mn~$<&vEG' );
define( 'LOGGED_IN_KEY',     'F5DBE`$)e.I,u(e*#mu9.ICDv/W|wkEPY8<k;#/c8WF)B[Y_s$;LwpDv+IIr5S;H' );
define( 'NONCE_KEY',         '2AyjIMM9#S{{7x$>*H.s2oYHq`LscCX vC(BT%+[5u%5-+g},p|jwIq Qq3oiVE=' );
define( 'AUTH_SALT',         'f18$6}yV<|ZAM,oK9b|V$W~TZ=5<F9I|lJz3gx -AAiG>{sD6z`o=qE.0Q^VS3<Y' );
define( 'SECURE_AUTH_SALT',  'XZ]P.F*Af6zA*.6W~JX,Rg/f`=+B ]w:gRmh9B%fH#;>+;r5XK&nT*mP1oFDU>cs' );
define( 'LOGGED_IN_SALT',    '2+7vfnPp WS>GVq,=w+ZRr}cjQrPXE9!|.W[xiLl&7]q=5)!.xOc#IrAf6[q8WGx' );
define( 'NONCE_SALT',        '/`gEYk~Mo=O/@f(bJo`V?*$T?Qa=,eUR#?uWnFb Y,x?wc/3=>6}_)4QltYf(pB6' );
define( 'WP_CACHE_KEY_SALT', 'Ngh<:<7q7AuXvq}=_{F`}ad{>Q3<wrnCnO!LUGh@t%Y%(KHq5D*skWIU,.2.X8Gz' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_eurosystem';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
