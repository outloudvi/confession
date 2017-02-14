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
    global $cmysql,$conn;
    if( $conn ) exit();
    $cmysqlline = "";
    if ( $cmysql['port'] )
        $cmysqlline = $cmysql['host'] . ":" . $cmysql['port'];
    else
        $cmysqlline = $cmysql['host'];
    $conn = mysql_pconnect($cmysqlline, $cmysql['user'], $cmysql['pass']);
    if(!$conn)
        die("<b>Cannot connect to database.</b> Maybe a wrong password or server down?");
    echo "<b>Server connected.</b><br />";
    
    $result = mysql_select_db($cmysql['dbname'], $conn);

    $dbExists = false;

    if($result)
    {
        echo "<b>The database seems to be exist...</b> It's usually not a good sign, except that it is the old database of Confession.<br />";
        $dbExists = true;
        echo "<b>If you are sure it's the old database of Confession</b>, delete the install.php and you can use Confession.<br />";
        die("Or click <a href='old_db.php'>here</a> if you want to DELETE THE CURRENT DATABASE and create a new for Confession.");
    } else {
        echo "<b>Great! The database doesn't exist.</b><br />";
        $result = mysql_query("CREATE DATABASE " . $cmysql['dbname']);
        if ($result)
            echo "<b>Database created.</b><br />";
        else
            die("<b>Something goes wrong.</b> Database creation failed.");

    }

    mysql_select_db($cmysql['dbname'], $conn);

    $result = mysql_query("CREATE TABLE IF NOT EXISTS `content` ( `id` int(11) NOT NULL AUTO_INCREMENT, `content` text NOT NULL, `cookieid` text, `time` text, `ip` text, `useragent` text, `read` int(11) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `id` (`id`) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;");

    if ($result)
        echo "<b>Finished.</b> Delete install.php and you can <a href='../index.php'>use Confession now</a>.";
    else
        die("<b>Something goes wrong.</b> Table creation failed.");

?>

</body>

</html>