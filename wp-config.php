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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

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
define( 'AUTH_KEY',          'TL=|hUZblnacz)a9CLZ8HW`Qi9EBdhTv.AO!X`RoM$TJ85_(U%)|~WrQ-3}N[x&T' );
define( 'SECURE_AUTH_KEY',   '9uf>WuF6dH 1  :NY])d`VuR)T$L^nIG0p|oFBKS1wFCof?#x1o*M;)1ZVpW*;|>' );
define( 'LOGGED_IN_KEY',     'y!g[t:=*Q*2^=+O0drq8*uH/u4!I3|}GhNPJn0d2 5W] /nUK>YvKa|h+!@}A=D`' );
define( 'NONCE_KEY',         'LeQ@(A^6yot(g>4)KnX%=1sYJbCi/J cj(q=Q$)M6l66C[s^TBN,_%_^5-&/]M)R' );
define( 'AUTH_SALT',         '!}M;^N((tlR&Ve:VgE vlLu7$~0[nD>^OcbWO}kW?uxs#f}+E%V)4DcV5GE@NUY`' );
define( 'SECURE_AUTH_SALT',  'QA:W0^ly&S~w/JkfIW}?/t 2;ZY[=[]aM=9L*k|ET6Q(LCq`@3ayiH@96r,f.tdI' );
define( 'LOGGED_IN_SALT',    'K@M(z;d61o,,8I.C#z}+_hF>C@s#hXr-h50D=XHLa^%=zd.HQ+<Uex!kh>({sZ(c' );
define( 'NONCE_SALT',        '.lV-,pF%`Yk0`4=5oiWnI*wb02;{ahoK[<zD#]ue[96M9y<P_[DKyXW)nDh40m-F' );
define( 'WP_CACHE_KEY_SALT', 'e~w(8lNPg1 ?>TeL-gQiUb|nFE%?:@ty}mX|N5TZ6RR:NTeq$Y,0$u}{u{_uIbY4' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


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

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
