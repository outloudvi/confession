<!DOCTYPE HTML>
<?php
require_once('func.php');
?>
<html>

<head>
<meta charset="utf-8" />
<title>Read | Confession</title>

</head>

<body>

<?php

    if( !isset($_GET['id']) )
    {
        echo "Bad request.";
        exit();
    }

    global $cvoteInterval;

    $conid = intval($_GET['id']);

    if( isset($_COOKIE['read_' . $conid]) )
    {
        echo "It seems that you have voted confession #" . $conid . " in 24 hours.<br />";
        echo "<a onclick='history.back(-1);' style='color:#0000FF; text-decoration:underline;'>Return</a>.";
        exit();
    }

    global $conn;
    connect();

    $query = mysql_query("UPDATE `content` SET content.read=content.read+1 WHERE content.id=" . $conid . ";");

    setcookie("read_" . $conid,"true", time()+$cvoteInterval);

    if( $query )
    {
        echo "Operation is done.<br />";
        echo "<a onclick='history.back(-1);' style='color:#0000FF; text-decoration:underline;'>Return</a>.";
        exit();
    }
    else
    {
        echo "<b>Operation failed.</b> Database connection failed OR article doesn't exist.<br />";
        echo "<a onclick='history.back(-1);' style='color:#0000FF; text-decoration:underline;'>Return</a>.";
        exit();

    }
    
?>

</body>

</html>