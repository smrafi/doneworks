<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'drycleans');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '5jJZ8Wt.EKg~rO^;O=8hVY1|Q,c+gpG_o]#1+zbfu@X).T(ec9cuYfE$uC;)7$,H');
define('SECURE_AUTH_KEY',  'D-=}ETW/L@lO&2~`W|5etUUS)ap}I|>*XDDc+<v*/{u2(E+|QD_1J $Z}&t9AEYy');
define('LOGGED_IN_KEY',    '&e_IBbqn*&wA?>|_j9 #n!h[&@CT3]ZmM}bp@=k{wS{,MZucTKDP tG-Z6fc^[,W');
define('NONCE_KEY',        'e?(b,sEQ|E.YXSIQh--Z@aFCmzF]BL*?Ol<1{6cUBE.m@|LydP}>hptE>rE3uo0l');
define('AUTH_SALT',        'O&db~NO2MsXJqLt>0ernl`-L!Z|_JMt~si}#0v/#:@`u-F-jq.2#x1;Lr~YkXj P');
define('SECURE_AUTH_SALT', '03J9Kc:$C *ckA+r(SVGEq[1D*<B0v[UH>(b8l&|lFi-TkYrSYrxpm(OS7>AD1n+');
define('LOGGED_IN_SALT',   '+pm&Xtff|t5|+TDIo*Y~XkGna%0_Jh-G+/_5joPjFltNB;vo#U;6_M45~^U&f-b>');
define('NONCE_SALT',       '}YY}8tq>00+v+.HRlhk|GJ[-D,#Le&I.-m5_H|C}A7|D-wDD#gh;c/[QCU#Wr[6l');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
