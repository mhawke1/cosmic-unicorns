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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
set_time_limit(300);
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'cosmicu_wp391' );

/** MySQL database username */
define( 'DB_USER', 'cosmicu_wp391' );

/** MySQL database password */
define( 'DB_PASSWORD', 'H!](.]97S1YizpA4' );

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
define( 'AUTH_KEY',         'rsx8yuatmlbeddpfyfynjcuyzypbb7gygevdrsxjuotrcqqgb62ekofhxffrayth' );
define( 'SECURE_AUTH_KEY',  'auxkfny2ui48spmczdppvwvlswuakdu6sfmot6chyuxginosxpulccyzmtk5rbeq' );
define( 'LOGGED_IN_KEY',    'vbi1x4kbcgwpd2hvotyryxceyqd91asjrpwiw2nyz7qt9akoyqfdutzj3okkobfy' );
define( 'NONCE_KEY',        'g311udqdyvjb4fkd9uapqpflomgnqkdcuu0askqilsyzhx5i66svesomtg4g9qgs' );
define( 'AUTH_SALT',        'tzxklecpkh3yorsp03ckg53i8yqurzd4mfckmviocdsqspz9f3rachyqmrfszasq' );
define( 'SECURE_AUTH_SALT', '71cwzxutap7kpttdolfak76kdrxecs1ouagekgxxw4oxrjkmtfqtwlno8ddkrxxn' );
define( 'LOGGED_IN_SALT',   'edzenhlomee1ycx7gc0ttedtezw4ua9ftu6yc5s1brajrtmmdi55mofdnww3ggkc' );
define( 'NONCE_SALT',       'bptctqek9pikg3mxhf5qnqpm3jfn9tq2hymm7mo9twvd3t3ycdr9qjwur9w8tpuu' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp8o_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
