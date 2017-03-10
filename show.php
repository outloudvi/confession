<!DOCTYPE HTML>
<?php
require_once('func.php');
global $page;
$page = 1;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

require_once('func.php');
global $ctitle;
echo HTMLhead("Page $page [List] | " . $ctitle, true);
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
<h1> Confession List </h1> <br />
<a href="submit.php">Confess!</a> | <a href="search.php">Search Confession</a> <?php showLoginCred(); ?>
<hr />

<?php
    global $page;
    $totalItem = showContent( 10, ($page-1)*10 );
    echo "<hr />";
    echo "$totalItem confessions in total.<br />";
    $lastPage = $page - 1;
    $nextPage = $page + 1;
    $hasNextPage = false;
    if ( $page * 10 < $totalItem )
        $hasNextPage = true;

    if( $page > 1)
        echo "<a href='show.php?page=" . $lastPage . "'>Page " . $lastPage . "</a>";
    if( $page > 1 && $hasNextPage)
        echo " | ";
    if( $hasNextPage )
        echo "<a href='show.php?page=" . $nextPage . "'>Page " . $nextPage . "</a>";
?>

</body>

</html>