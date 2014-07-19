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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         '7b-<8v3k(/v2T~QUfN]`KXfE+@{N%h4LH5PCTI2#jClB#Q[by^K?d{.dKqdur;i=');
define('SECURE_AUTH_KEY',  '7#lWfpkWfsR--?N5Shi[@5Rs=SO-a#.q$zk-+xo43Nz/H0^]NmWgZJ61<`>Vjhq0');
define('LOGGED_IN_KEY',    '!CEM{Mb3*15=bN+f.bxgI=Z822DwHjT@3XT+>%kYo2YZsHRaL]tB|!vW`KsuIi@R');
define('NONCE_KEY',        'k3(j&a)AHjQZhVd/y:+xJ{1.kqqM+bNp=9*3HM+K^A3|TJ=@EUOHN?3u:N>u[+Tu');
define('AUTH_SALT',        '>$u2Kb6:%lN*`|fVd5KzG+pCoKD^ZJ&io$eE,5-W{1:C&|eb+<cM|~Qr-4Q|4;b}');
define('SECURE_AUTH_SALT', '|.{9_0[*re+x[q?>|~;8+dRr7!n5RXe[+p8}>]D #U?1)*L4Sf8~I>1C|Z4|S!ib');
define('LOGGED_IN_SALT',   ']wS+=$FP4<Ylj|e^p<b$Lbtxh:sQHVcNLPHWd$el0|wM+t1ICbC<GkHK|F,g|;Nd');
define('NONCE_SALT',       '~dCv<zDdq{|[X!!6oW~,8+xGNgab8+T+UiC1`-/>+1`K75/l}N6T^lnVRG/,BpXX');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
