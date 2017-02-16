<!DOCTYPE HTML>
<?php
require_once('../func.php');
?>
<html>

<head>
<meta charset="utf-8" />
<title>Remove &gt;&gt; Confessions Manager | Confession</title>

</head>

<body>
<h1> Deletion </h1> <br />
<hr />

<?php

    if( !isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'logon' )
    {
        echo "<b>No permission.</b><br />";
        echo "<a href='./index.php'>Login</a> first.";
        exit();
    }

    if( !isset($_GET['id']) )
    {
        echo "Bad request.";
        exit();
    }

    global $conn;
    connect();
    
    $remid = intval($_GET['id']);
    $result = mysql_query("DELETE FROM content WHERE id='$remid'");

    if( $result )
    {
        echo "Deletion is done.<br />";
        echo "<a href='pages.php'>Return</a>.";
        exit();
    }
    else
    {
        echo "<b>Deletion failed.</b><br />";
        echo "<a href='pages.php'>Return</a>.";
        exit();

    }
    
?>

</body>

</html>