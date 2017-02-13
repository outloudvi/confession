<!DOCTYPE HTML>
<?php require_once('func.php') ?>
<html>

<head>
<meta charset="utf-8" />
<title>Confess</title>
</head>

<body>
<h1> Confession </h1> <br />
<a href="submit.php">Confess!</a> | <a href="search.php">Search Confession</a> <?php showLoginCred(); ?>
<hr />

<?php
echo "<span style='color:grey'>Loading Confession...</span>";
?>

</body>

</html>