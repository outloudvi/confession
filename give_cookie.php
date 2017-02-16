<!DOCTYPE HTML>
<?php require_once('func.php') ?>
<html>

<head>
<meta charset="utf-8" />
<title>Get Cookie | Confess</title>
</head>

<body>

<h1> Get Cookie </h1> <br />
<a href="index.php">&lt;&lt;Main page</a> | <a href="submit.php">Confess!</a> <?php showLoginCred(); ?>
<hr />

<!-- Gives cookie -->
<?php
    require_once("func.php");
    $ipaddress = getIPAddress();
    echo "Your IP is : " . $ipaddress . "<br />";
    $origcookie = getCookieFromIP($ipaddress);
    if( $origcookie != false )
    {
        echo "Cookie not created.<br />";
        echo "You have a Cookie which has the ID : " . $origcookie . "<br />";
        echo "You have been logined with that ID.<Br />";

        $_SESSION['CookieID'] = $origcookie;
        $_COOKIE['CookieID'] = $origcookie;

        echo "<a href='index.php'>Get back to the main page.</a>";
        exit();
    }

    while (1) {
        $yourid = random_str(8, 'abcdefghijklmnopqrstuvwxyz0123456789');
        echo "Try ID - " . $yourid . "<br />";
        $result = hasIDInDatabase($yourid);
        if ( $result != false )
        {
            echo "Unlucky! Retry.<br />";
            continue;
        }
        addUser( $yourid, $ipaddress, $_SERVER['HTTP_USER_AGENT'] );
        break;
    };
    $_SESSION['CookieID'] = $yourid;
    $_COOKIE['CookieID'] = $yourid;

    if( isset($_SESSION['CookieID']) )
        echo "Done! Your cookie is : " . $_SESSION['CookieID'];
?>

</body>

</html>