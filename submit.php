<!DOCTYPE HTML>
<?php require_once("func.php"); ?>
<html>

<head>
<meta charset="utf-8" />
<title>Submit | Confess</title>
</head>

<body>
<h1> Submit your confession </h1> <br />
<a href="index.php">&lt;&lt;Back to main page</a> <?php showLoginCred(); ?>
<hr />

<?php
if (! isset($_SESSION['CookieID']) )
    {
        echo "You don't have a Cookie! Get one <a href=\"get_cookie.php\">here</a>.";
        exit();
    }
?>

<form method="post" action="submit_process.php">
    <input type="hidden" value="<?php echo $_SESSION['CookieID']; ?>" />
    Content:
    <br />
    <textarea name="content" rows="5" cols="40"></textarea>
    <br />
    <input type="submit" name="submit" value="Submit">
</form>

</body>

</html>