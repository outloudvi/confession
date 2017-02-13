<!DOCTYPE HTML>
<?php require_once('func.php') ?>
<html>

<head>
<meta charset="utf-8" />
<title>Just one step... | Confess</title>
</head>

<body>
<h1> Submit your confession </h1> <br />
<a href="submit.php">&lt;&lt; Rewrite</a> <?php showLoginCred(); ?>
<hr />

<?php
    if (! isset($_SESSION['CookieID']) )
    {
        echo "You don't have a Cookie! Get one <a href=\"get_cookie.php\">here</a>.";
        exit();
    }
    echo "Hello, " . $_SESSION['CookieID'] . '<br />';
    echo "You want to say... <br />";
    echo "<blockquote>" . $_POST['content'] . "</blockquote>";
    echo "<br /> is it?";
?>
    <form method="post" action="do_submit.php">
    <input type="hidden" name="CookieID" value="<?php echo $_SESSION['CookieID']; ?>" />
    <input type="hidden" name="content" value="<?php echo $_POST['content']; ?>" />
    <input type="submit" name="submit" value="Yes, and submit it">
</form>


</body>

</html>