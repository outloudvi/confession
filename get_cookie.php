<!DOCTYPE HTML>
<?php require_once('func.php') ?>
<html>

<head>
<meta charset="utf-8" />
<title>Get new Cookie / Login | Confess</title>
</head>

<body>
<h1> Get Cookie </h1> <br />
<a href="index.php">&lt;&lt;Main page</a> | <a href="submit.php">Confess!</a>
<hr />

<?php
    if ( isset($_SESSION['CookieID']) )
    {
        echo "You have got a Cookie with the ID : " . $_SESSION['CookieID'];
        echo "<br />";
        echo "<a href='clear.php'>Revoke your ID</a> before getting a new one.";
        exit();
    }
?>
<form method="post" action="give_cookie.php">
    <input type="submit" name="submit" value="Get your cookie OR Login">
</form>

</body>

</html>