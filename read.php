<?php 
require_once('func.php');
global $ctitle;
echo HTMLhead('Read | ' . $ctitle, true);
?>
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

    global $pdo;
    connect();

    $query = $pdo -> query("UPDATE `content` SET content.read=content.read+1 WHERE content.id=" . $conid . ";");

    setcookie("read_" . $conid,"true", time()+$cvoteInterval);

    if( $query !== false )
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
<?php showVersion(); ?>

</body>

</html>