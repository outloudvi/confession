<?php 
require_once('func.php');
global $ctitle;
echo HTMLhead('Just one step... | ' . $ctitle);
?>

<body>
<h1> Submit your confession </h1>
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
    <form method="post" action="submit.php">
    <input type="hidden" name="CookieID" value="<?php echo $_SESSION['CookieID']; ?>" />
    <input type="hidden" name="content" value="<?php echo $_POST['content']; ?>" />
    <input type="submit" name="submit" value="Yes, and submit it">
</form>
<?php showVersion(); ?>

</body>

</html>