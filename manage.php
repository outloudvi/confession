<!DOCTYPE HTML>
<?php require_once('func.php') ?>
<html>

<head>
<meta charset="utf-8" />
<title>Management | Confess</title>
</head>

<body>

<h1> Cookie Management </h1> <br />
<a href="index.php">&lt;&lt;Main page</a> | <a href="submit.php">Confess!</a> <?php showLoginCred(); ?>
<hr />

<?php
    if( !isset($_SESSION['CookieID']) )
    {
        echo "<a href='get_cookie.php'>Get a Cookie</a> first.";
        exit();
    }

    echo "Your Cookie ID is : " . $_SESSION['CookieID'] . "<br />";
    echo "<br />";
    echo "<a href='cookie/revoke.php'>Revoke current Cookie</a> | <a href='cookie/refresh.php'>Get a new Cookie</a>"
?>

</body>

</html>