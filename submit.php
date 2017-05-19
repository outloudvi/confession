<?php 

if( isset($_POST['CookieID']) )
    include("includes/submit_3.php");
elseif( isset($_POST['content']) )
    include("includes/submit_2.php");
else
    include("includes/submit_1.php");

?>