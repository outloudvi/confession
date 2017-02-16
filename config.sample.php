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

// Administration
$cadminPassword = ""; // Password for administrator. The administration will NOT be useable if the password is empty.

?>