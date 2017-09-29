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
define('DB_NAME', 'cj');

/** MySQL database username */
define('DB_USER', 'developer');

/** MySQL database password */
define('DB_PASSWORD', 'hfphf,jnxbr');

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
define('AUTH_KEY',         'saQ$5c|RFel62hqo|NVa$ra+d^ND~AvjWeX`xRVs]NqD3r)i&x6]DEFKa bZA3to');
define('SECURE_AUTH_KEY',  ':`DXklrONsDZZ?(6Hug#)a~Da&C#x6GNx+,]?R^1,F{e^Os<:zLG}_x~6&1Dz @h');
define('LOGGED_IN_KEY',    'Ic>_O,pUXVBpe+:zWQjMP6^}W5c~GFsj+HJ+q{FjyX5eG/$4q7;E0k(_,SOtDg1J');
define('NONCE_KEY',        'C^`7+2p t$q,RcSv#%(<o~DCvnIJ~&c3U@l)NMQENMVT$YKuxu5^GQ>&](~cVuZ9');
define('AUTH_SALT',        '4iusU7`xWCx9J7To,J_+%*dP6AviPKmdCecWGs{0tgz)$GGx]JUiO:Y=zkF0mM#-');
define('SECURE_AUTH_SALT', '1Qt+LT+hh]*ZJoQuKclnbpw[T <HC`S6>fE!;53=K0|Sz,{]oKP7k{:):}u@y.p@');
define('LOGGED_IN_SALT',   'QxL)WlA,)K6>P2tpoBBe>(ZSFzC[8TXQzR*TcaYX#,JkE*,)}Gzi^;Du]CfQSXbV');
define('NONCE_SALT',       'i#X/r.?i/(-qc9nf)d@<AuZWrdOeQP!W-j1AV79+Y1}`&[spxc%L-EYi*2bzrR^~');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
