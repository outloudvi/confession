<?php

if ( !defined( 'IMCFS' ) ) {
	echo "This file is part of Confession and is not a valid entry point\n";
	die( 1 );
}

// MySQL configure via Travis-CI
$cmysql['host'] = '127.0.0.1';  // MySQL server host
$cmysql['port'] = '3306';  // MySQL server port (default 3306)
$cmysql['user'] = 'root';  // MySQL server username
$cmysql['pass'] = '';  // MySQL server password
$cmysql['dbname'] = 'testing';  // MySQL server database name

// General
$ctimezone = "Asia/Shanghai"; // Timezone
$ctitle = "Confession"; // Title

// Administration
$cadminPassword = "test"; // Password for administrator. The administration will NOT be useable if the password is empty.

// Vote
$cvoteInterval = 86400; // Vote interval for a certain confession. (calculated by second)

?>