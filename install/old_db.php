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
<h1> Delect the old database </h1> <br />
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

    $result = $pdo -> query ("DROP DATABASE `" . $cmysql['dbname'] ."`");

    if ($result !== false)
        echo "<b>Finished.</b> <a href='check.php'>Go back to installing Confession.</a>.";
    else
        die("<b>Something goes wrong.</b>");

?>

</body>

</html>