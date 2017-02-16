<!DOCTYPE HTML>
<?php require_once('../func.php') ?>
<html>

<head>
<meta charset="utf-8" />
<title>Revoke Cookie | Confess</title>
</head>

<body>

<?php
    unset($_SESSION['CookieID']);
    unset($_COOKIE['CookieID']);
    $ipaddress = getIPAddress();
    $result = delUser( $ipaddress );
    if( $result )
    {
        echo "<span style='color:grey'>Cookie(s) via IP $ipaddress has/have been removed.</span><br />"; 
    } else {
        die( "Cookie revocation error.<br />" );
    }
?>

<h1> Done. Your Cookie has been revoked. </h1> <br />
<a href='../get_cookie.php'>Get a new Cookie.</a>
</body>

</html>