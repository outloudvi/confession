<!DOCTYPE HTML>
<html>

<head>
<meta charset="utf-8" />
<title>Confession Installation</title>

<style>
grey {
    color: grey;
}
</style>
</head>

<body>
<h1> Check your database connection and install</h1> <br />
<span>Confession installation goes here.</span>
<hr />
<span>Checking...</span>
<br /><br />

<?php
    define("IMCFS",1);
    include_once("../config.php");
    
    global $cmysql,$connected,$pdo;
    if( $connected ) return;
    $cmysqlline = "";
    if ( !$cmysql['port'] )
        $cmysql['port'] = '3306';

    try {
    $pdo = new PDO("mysql:host=".$cmysql['host'].";port=".$cmysql['port'], $cmysql['user'],$cmysql['pass'],array(PDO::ATTR_PERSISTENT => true));
    } catch (PDOException $e)
    {
        die("<b>Database connection error:</b>".$e->getMessage());
    }
    $connected = true;
    $pdo -> query('set names utf8;');

    $x = $pdo -> query("SELECT * FROM `information_schema`.`tables` WHERE TABLE_SCHEMA='" . $cmysql['dbname'] . "';");
    $hasDb = false;
    foreach( $x as $p )
    {
        $hasDb = true;
        break;
    }
    if($hasDb)
    {
        echo "<b>The database seems to be exist...</b> It's usually not a good sign, except that it is the old database of Confession.<br />";
        echo "<b>If you are sure it's the old database of Confession</b>, delete the install.php and you can use Confession.<br />";
        die("Or click <a href='old_db.php'>here</a> if you REALLY want to DELETE THE CURRENT DATABASE and create a new for Confession.");
    } else {
        echo "<b>Great! The database doesn't exist(or is empty).</b><br />";
        $result = $pdo -> query ("DROP DATABASE `" . $cmysql['dbname'] ."`");
        $result = $pdo -> query("CREATE DATABASE " . $cmysql['dbname']);
        if ($result !== false)
            echo "<b>Database created.</b><br />";
        else
            die("<b>Something goes wrong.</b> Database creation failed.");

    }

    $result = $pdo -> query("CREATE TABLE IF NOT EXISTS `" . $cmysql['dbname'] . "`.`content` ( `id` int(11) NOT NULL AUTO_INCREMENT, `content` text NOT NULL, `cookieid` text, `time` text, `ip` text, `useragent` text, `read` int(11) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `id` (`id`) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;");

    if( $result !== false )
        $result = $pdo -> query("CREATE TABLE IF NOT EXISTS `" . $cmysql['dbname'] . "`.`user` ( `id` int(11) NOT NULL AUTO_INCREMENT, `cookieid` text NOT NULL, `ipaddress` text NOT NULL, `useragent` text NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");
    else
        die("<b>Something goes wrong.</b> Table creation 1 failed.");

    if ($result)
        echo "<b>Finished.</b> Delete install.php and you can <a href='../index.php'>use Confession now</a>.";
    else
        die("<b>Something goes wrong.</b> Table creation 2 failed.");

?>

</body>

</html>