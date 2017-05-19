<?php 
require_once('func.php');
global $ctitle;
echo HTMLhead('Submit | ' . $ctitle);
?>

<body>
<h1> Submit your confession </h1>
<a href="index.php">&lt;&lt;Back to main page</a> <?php showLoginCred(); ?>
<hr />

<?php
if (! isset($_SESSION['CookieID']) )
    {
        echo "You don't have a Cookie! Get one <a href=\"get_cookie.php\">here</a>.";
        exit();
    }
?>

<form method="post" action="submit.php">
    <input type="hidden" value="<?php echo $_SESSION['CookieID']; ?>" />
    Content:
    <br />
    <textarea name="content" rows="5" cols="40"></textarea>
    <br />
    <input type="submit" name="submit" value="Submit">
</form>

<p style='font-size: 70%'>By clicking 'Submit', you agree that your IP and User-Agent data will be collected and saved with your confession.</p>
<?php showVersion(); ?>
</body>

</html>