<?php 
require_once('func.php');
global $ctitle;
echo HTMLhead('Get new cookie / login | ' . $ctitle, true);
?>

<body>
<h1> Get Cookie </h1>
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
<?php showVersion(); ?>
</body>

</html>