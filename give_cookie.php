<!DOCTYPE HTML>
<?php require_once('func.php') ?>
<html>

<head>
<meta charset="utf-8" />
<title>Get Cookie | Confess</title>
</head>

<body>

<!-- Gives cookie -->
<?php
    require_once("func.php");
    $yourid = random_str(8, 'abcdefghijklmnopqrstuvwxyz0123456789');
    $_SESSION['CookieID'] = $yourid;
    $_COOKIE['CookieID'] = $yourid;
?>

<h1> Get Cookie </h1> <br />
<a href="index.php">&lt;&lt;Main page</a> | <a href="submit.php">Confess!</a> <?php showLoginCred(); ?>
<hr />

<?php
    if( isset($_SESSION['CookieID']) )
        echo "Done! Your cookie is : " . $_SESSION['CookieID'];
?>

</body>

</html>