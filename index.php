<?php 
require_once('func.php');
global $ctitle;
echo HTMLhead($ctitle, true);
?>

<style>
grey {
    color: grey;
}
</style>

<script>
function loadFinished()
{
    document.getElementById('loading').style = "display:none" ;
}
</script>
</head>

<body>
<h1> Confession </h1> <br />
<a href="submit.php">Confess!</a> <?php showLoginCred(); ?>
<hr />
<span> The latest 5 confessions. </span>
<?php
    showContent(5);
?>
<hr />
<a href="show.php">More...</a>

</body>

</html>