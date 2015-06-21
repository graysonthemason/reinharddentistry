<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'reinharddentistry');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'X6BkXjY5AbF[3C)`jLi5I-&}!hL$01`G+|xTh8#*LVx+b[G?P jGq|Ibe|:Mx#}W');
define('SECURE_AUTH_KEY',  'S#fd-skdSadLkE><C3;D}x/w}sS1ru:MA-=-OncWu`UZ;||6RG|zL.>99-:y|G|`');
define('LOGGED_IN_KEY',    'Nal^#OCVp4,n8EGJ5lcBoqZ+r6,IE1<}`-3K.s{hZ$a<p-x&&^s9S-ilsR55T=|$');
define('NONCE_KEY',        'hvqKOp%|A68RIkJ _#QFGC8`$0Y/tN$2F[X8w.D:&]/,V/|(~l1@blk+V]p?o++d');
define('AUTH_SALT',        'O$/;)pLXk^}Vu4Mr]luraDXt,*dk!v#JH69mDkE{qGbmzC(V5p3<5%9{vT!`<0G;');
define('SECURE_AUTH_SALT', '/Jp-4C|1bwo&~dS?{0jn2zKSjC/LDHU2H;y}A0uB+y6f9-HHzovrfdeghExNH<h3');
define('LOGGED_IN_SALT',   'gh&cMgXHNkW9eaYHxNYqiiR_QH7/-A 56)Mb6|*i~)u<;`c ,GEvm=,B-`7;7ke4');
define('NONCE_SALT',       'hR%E!g$fgetv@UHaKG6,.3hb6amI-}ae4f6+HS$mS2co{f6 9zQMn/rb(+.(=tpr');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
