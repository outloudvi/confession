<?php

// Copied from MediaWiki
if ( !defined( 'IMCFS' ) ) {
	echo "This file is part of Confession and is not a valid entry point\n";
	die( 1 );
}

// MySQL configure
$cmysql['host'] = 'localhost';  // MySQL server host
$cmysql['port'] = '3306';  // MySQL server port (default 3306)
$cmysql['user'] = 'root';  // MySQL server username
$cmysql['pass'] = 'root';  // MySQL server password
$cmysql['dbname'] = 'confe';  // MySQL server database name

$ctimezone = "Asia/Shanghai"; // Timezone

?>