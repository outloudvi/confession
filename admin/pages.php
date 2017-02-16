<!DOCTYPE HTML>
<?php
require_once('../func.php');
?>
<html>

<head>
<meta charset="utf-8" />
<title>Confessions Manager | Confession</title>

<script>
function loadFinished()
{
    document.getElementById('loading').style = "display:none" ;
}
</script>

</head>

<body>
<h1> Confessions Manager </h1> <br />
<hr />

<?php

    if( !isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'logon' )
    {
        echo "<b>No permission.</b><br />";
        echo "<a href='./index.php'>Login</a> first.";
        exit();
    }

    global $conn;
    connect();
    global $page;
    $num = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
    $offset = isset($_GET['page']) ? intval($_GET['page'])*$num-$num : 0;
    echo "<span id='loading' style='color:grey'>Loading Confessions...</span>";
    $retn = mysql_query("SELECT COUNT(*) FROM content");
    if ( !$retn )
    {
        echo "<br /><b>Database connection error.</b><br />";
        echo "<script type='text/javascript'>loadFinished();</script>";
        exit();
    }
    $retn = mysql_fetch_array( $retn );
    $count = $retn['COUNT(*)'];
    if( $count == 0 )
    {
        echo "<br /><b>No data now.</b><br />";
        echo "<script type='text/javascript'>loadFinished();</script>";
    }
    $result = mysql_query("SELECT * FROM content ORDER BY id DESC LIMIT $num OFFSET $offset");
    global $ctimezone;
    date_default_timezone_set($ctimezone);
    echo "<div id='confession'>";
    echo $count . " confessions now.";
    while($line = mysql_fetch_array($result))
    {
        $thetime = date("Y-m-d H:i:s",$line['time']);
        echo "<blockquote>";
        echo $line['content'];
        echo "</blockquote><br />";
        echo "<grey>#" . $line['id'] . ", posted by " . "Anonymous" . " at " . $thetime .  "</grey> | <a href='remove_pages.php?id=" . $line['id'] ."'>Remove</a>";
    }
    echo "</div>";
    echo "<script type='text/javascript'>loadFinished();</script>";

    $page = $offset / $num + 1;
    $lastPage = $page - 1;
    $nextPage = $page + 1;

    if( $page > 1)
        echo "<a href='pages.php?page=" . $lastPage . "'>Page " . $lastPage . "</a>";
    if( $page > 1 && $page * 10 < $count)
        echo " | ";
    if ( $page * 10 < $count )
        echo "<a href='pages.php?page=" . $nextPage . "'>Page " . $nextPage . "</a>";
?>

</body>

</html>