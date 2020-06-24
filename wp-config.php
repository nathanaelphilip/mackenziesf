<?php
define('WP_CACHE', true); // Added by Cache Enabler

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


// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'mackenziesf' );


/** MySQL database username */

define( 'DB_USER', 'root' );


/** MySQL database password */

define( 'DB_PASSWORD', '' );


/** MySQL hostname */

define( 'DB_HOST', 'localhost' );


/** Database Charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define( 'AUTH_KEY',         'ybiS84Ot_2O*#qC#b<ARsOB.n}(z{bJRB/kD2>IxL+BUD!LRz~nA7j1xX 4ShmV7' );

define( 'SECURE_AUTH_KEY',  'J6 $>;}sI)ucR]u#C_Q!ORb1yCj0~J](Li=EckzCsyWv.1:bP(p6B.`;BSpWDmSc' );

define( 'LOGGED_IN_KEY',    'M=WWFt0z&-@5!(#4[w6bdGIz frN>S29e1=f]{|$1b6yJJ ,0g:N(Fk?N<$&2Bi' );

define( 'NONCE_KEY',        'wZdtw0il,:w&UYhU:)BA?hE {k~f7GiXRoN9rwSk}4-b/3r/S4pFVTN~L*aSDQrA' );

define( 'AUTH_SALT',        ']Uiw3;:7sQiUU>qr>Rn`_Eyi;46:nk oIK^J(tioIT[h;vmvjCZpSK4HdsJaHT-]' );

define( 'SECURE_AUTH_SALT', 'eBxdsFR#hTz?XR*UU3@<WT16Kg:?Y7mTg_Tcnkw04jS(=y-L6)!{w]ZFMw%CDuO#' );

define( 'LOGGED_IN_SALT',   'vVOK%q`G@$3c^d<$P<~tS6AW[1&SdlAN_11/oU;pgzVT)Q`FieE&k# wVt+^4/b?' );

define( 'NONCE_SALT',       '1z:^jPKi=k3oE}2.G_-6YSg,qG$0KfI+X>d{EVAkX+$MC!xW*`@0&8>5g@rHA&A(' );


/**#@-*/


/**

 * WordPress Database Table prefix.

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


/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

