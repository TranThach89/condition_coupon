<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'condition_coupon');

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
define('AUTH_KEY',         'Hn0*`LPI{M-vJj`Y=x/.PMr 0}($GnuzfuPE<+<4ZN^+,i`x^%$i+iTr{,|Y7I7<');
define('SECURE_AUTH_KEY',  'F0C!d5.qXhu+J|3t0iAO`j?vDTCHD+G<+Mk6)YutTq}#E b]UMBqxWEw]-S0/sYQ');
define('LOGGED_IN_KEY',    'eeDxzMz ?gT&E;E<oDbWd=a*lK1(qi!C %Nx9hY{8;~MR^~+!2/u}> qhSAfOA05');
define('NONCE_KEY',        'M#Ri$G{BjHrfIegoUR;Cf+|h^j,?Sc4y .>~RVkJN(?KogVVp~@WgZNA{/~[}c1P');
define('AUTH_SALT',        'JF &#+ap<aLYq.Mp(UUT2/>E4p6,CV2SY[v-sULHNfCa|xLtejbV>BY2BfT-LO+u');
define('SECURE_AUTH_SALT', '39nIs^uzj0/IkN11(7MU)jc[s<yv)HXep~BjJ]$G4VlcIx]plksKWvNGYV idokp');
define('LOGGED_IN_SALT',   'dq<7jOtFO^Et*K`S|d42~,O/d$d]%:/P&+ED}3/L.#u+ ML30dS+BXY+1<%~$`6M');
define('NONCE_SALT',       'Cicjtm=Dtw8]iLIuS?Dxfb7PCX=K.cf(Ew]jilMUF1+.?T}km$/av7*_#/Y~`3+e');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ht_';

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
