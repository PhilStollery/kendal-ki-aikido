<?php


// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'kendal-aikido');

/** MySQL database username */
define('DB_USER', 'aikido');

/** MySQL database password */
define('DB_PASSWORD', 'oUKjK7v76C9njAQxP}');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DEBUG',false);
define('DB_COLLATE', 'utf8mb4_0900_ai_ci');
define('AUTH_KEY',         'q7j6m[!d&nc/DNXKzyBLS[hkM6ka.9)x&w|0;V -qm,0<0 ntKHdP~`$1t@!de7:');
define('SECURE_AUTH_KEY',  '+l=-REoyuS2).:@@BfMe[7Za73y<|k*o`y*SV2;rfF9V3j=}nDtgQ]U;C=Msu %u');
define('LOGGED_IN_KEY',    ']k`K{HCj#N*9P_)oU5#`X:@9P;AU[Up#HmLO.D^gn,=ov+)74c77J]IwVs -p`jm');
define('NONCE_KEY',        'Sh&8EeF(6+P]UADARWN7cG6J+,-RX4aiYk(k7;RR>U{Y(ByGOxt6]qsGga3Y-SX*');
define('AUTH_SALT',        'W6NIVZj[^Z_)oJ-;$%oE.wB&ALW<#wg6/pM.-G<l-0m-2-6^U@@*A-Ea}el(h$cc');
define('SECURE_AUTH_SALT', 'K#F}4xEveYS/i:[j4O&<%Z+ [sJ6c-;N9jgDxw4h_:YCt4,D{S-cQZ`djQ>b:hF2');
define('LOGGED_IN_SALT',   '(lk]nG+))u@(aB%!Gr+y:k|?I(:zV|g&%^,:.z145YDyMNVNoO0zx&K!I#,9veHU');
define('NONCE_SALT',       'X*7&;Eo{(rywa)~lXt7029vj,)x[h]T[&m~&T>Ro@>-6+! vv||P|>E;jb,#3.eq');

define('TWO_FACTOR_DISABLE', true);

$table_prefix = 'wp_';

define('WP_MAX_MEMORY_LIMIT', '256M');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
