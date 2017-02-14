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

    if(!$result)
    {
        die("<b>Great! The database doesn't exist.</b><a href='check.php'>Go back to installing Confession.</a>.<br />");
    }

    $result = mysql_query("DROP DATABASE " . $cmysql['dbname']);

    if ($result)
        echo "<b>Finished.</b> <a href='check.php'>Go back to installing Confession.</a>.";
    else
        die("<b>Something goes wrong.</b>");

?>

</body>

</html>