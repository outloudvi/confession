<?php

/**
 * This is the configure file of Confession.
 * 
 * Before using Confession. You shall fill it out and rename it to "config.php".
 */

// DO NOT CHANGE IT due to security reasons.
if ( !defined( 'IMCFS' ) ) {
	echo "This file is part of Confession and is not a valid entry point\n";
	die( 1 );
}

// MySQL configure
$cmysql['host'] = '';  // MySQL server host
$cmysql['port'] = '';  // MySQL server port (default 3306)
$cmysql['user'] = '';  // MySQL server username
$cmysql['pass'] = '';  // MySQL server password
$cmysql['dbname'] = '';  // MySQL server database name

// General
$ctimezone = "Asia/Shanghai"; // Timezone
$cusecss = 'plain'; // CSS Ussge:
// Decide the CSS for the page.
// plain   : No CSS.
// (others): Use a certain theme.
// Built-in theme:
//    easy - an easy theme.
// Use your own by creating a CSS file in css/.

// Administration
$cadminPassword = ""; // Password for administrator. The administration will NOT be useable if the password is empty.

// Vote
$cvoteInterval = 86400; // Vote interval for a certain confession. (calculated by second)

?>