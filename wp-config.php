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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'malasek' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'mysql' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'Bh0KYL-%pJ%x|P7*g8HOP(|kZu|s8@ZVSJ>,#J{|dt`o^;vp})$],]sOV6xY)yoJ' );
define( 'SECURE_AUTH_KEY',  ':1G;jXQ/ZN96J#wON%rPXwe%5lcE]|DU5Kt}x:DNb ReW9}hV4sB<%uA-m$``g}l' );
define( 'LOGGED_IN_KEY',    '9/F2h,-b| f-*nxfVw3bwf4blJez=gw;RkCK;2+o(X.#Rs+z0j.G3#KIu4N9gnst' );
define( 'NONCE_KEY',        '(i[F*OJ@ZM!5d!M|xOwmZW&o<:f,jvXYSx q!44Us!e-T vuQ<gbPkLf74 T@C_~' );
define( 'AUTH_SALT',        'uv~vkm}EI)S6S@X7A[@{grnkQT8d.%=D~G7QU+NLFGvKUK9#Na9PI{f5mU>_OEU/' );
define( 'SECURE_AUTH_SALT', '[R%X)W7:jm)*?i]B[q:[--J8XPLJp7|wdPR$9(5TWrfHS@bE7nNMm`SxAzxlvEOX' );
define( 'LOGGED_IN_SALT',   'qx+AuAt4FPY!bV4!GBBr+5ujY.FV 53^^<NVS2L&<1t@Xkkg}~9%E&1m{$o. Q4w' );
define( 'NONCE_SALT',       '.qy1B:+!L7OKqt{oa<jq:!L?qX(COGz=7W}}+kYjCo,oM,K+ljG(oQJ~>[eTXfkL' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
