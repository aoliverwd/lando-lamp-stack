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

 /** Load environment variables file */
function load_env_vars()
{
    //set location if .env file
    $env_file = dirname(__DIR__, 1) . '/.env';

    if (file_exists($env_file)) {
        //open env file
        $handle = fopen($env_file, "r");

        //read line by line
        while (($buffer = fgets($handle, 4096)) !== false) {
            if (strlen(trim($buffer)) > 0 && count($vals = explode('=', trim($buffer))) === 2) {
                //add to environment
                try {
                    putenv(trim(str_replace('"', '', $buffer)));
                } catch (Exception $e) {
                    error_log("$e", 0);
                }
            }
        }

    }
}

load_env_vars();

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv('DB_NAME'));

/** MySQL database username */
define('DB_USER', getenv('DB_USER'));

/** MySQL database password */
define('DB_PASSWORD', getenv('DB_PASSWORD'));

/** MySQL hostname */
define('DB_HOST', getenv('DB_HOST'));

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
define('AUTH_KEY',         'X`ru,ajeGPPO;JnrL.cR-uT+C^&om1.h98or{&El:CJ)(+N_&+l`R|57 `sRz&b ');
define('SECURE_AUTH_KEY',  '[ $7d[<Iaq(d!W=]YZnUk?4a-[@ttqi+GMIfiBT(xUPdfh(:3/2ePgToVgK#U=Si');
define('LOGGED_IN_KEY',    'ztn+hlS }RRqcE&aPR.hi%gGzMNp(o8Xw+s?C@6[qalK^k4O6!PynZ8-J;AT+n@E');
define('NONCE_KEY',        '#ZQUUC8wyFA(f|y)paaN Hjv+wRVc>bXT1RMAQ0b}|?]@jA^NWj6NL:**eq9j|Hc');
define('AUTH_SALT',        'YAxvqJrNu}u}tr6[cc }&Hcb[JGJi|[K|6-Q(_{Dj!+t@By}+dH+o[L6,EfB=*ay');
define('SECURE_AUTH_SALT', 'i_s`fpN9Y06RG[qUWApWq|:<etec.B[Zo+ia2r}:>|:><pb%tv9}/=+ubf^o7[/U');
define('LOGGED_IN_SALT',   '}yp<J3k9xDi#`5Ijm  ,(7j^(CNsUbzWt<Ps+2C%u]qv3m!a+<AX-NvT9V|t25F.');
define('NONCE_SALT',       'HU8sn:4<b^W3jIx+e&!jk?`aEcHo-$I3lr@bgrK5~&6j&&o>)su2b.|h668Xt/:N');

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
define('WP_DEBUG', true);

/** Disable file editing from WP admin area */
define('DISALLOW_FILE_EDIT', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
