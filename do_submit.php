<?php 
require_once('func.php');
global $ctitle;
echo HTMLhead('Submitting... | ' . $ctitle, false);
?>

<body>
<h1> Submitting... </h1> <br />
<a href="submit.php">&lt;&lt; Rewrite</a> <?php showLoginCred(); ?>
<hr />

<?php
    if( !isset($_SESSION['CookieID']) )
    {
        echo "Unauthorized.";
        exit();
    }
    
    if( $_SESSION['CookieID'] != $_POST['CookieID'] )
    {
        echo "Unauthorized.";
        exit();
    }
    echo "<blockquote>" . $_POST['content'] . "</blockquote>";

    $ip = getIPAddress();
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    $status = add_confession($_POST['content'], $_POST['CookieID'], $ip, $useragent);
    if ( $status )
    {
        echo "Done!";
        echo "<a href='index.php'>Return to mainpage</a>.";
    }
    else
    {
        echo "Something goes wrong :(<br />";
        echo "<a href='submit.php'>Retry</a>.";
    }
?>

<?php showVersion(); ?>

</body>

</html>