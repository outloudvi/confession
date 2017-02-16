<!DOCTYPE HTML>
<?php
require_once('../func.php');
?>
<html>

<head>
<meta charset="utf-8" />
<title>Admin | Confession</title>

</head>

<body>
<h1> Admin management </h1> <br />
<hr />

<?php
    if( isset($_GET['action']) )
    {
        if( $_GET['action'] == 'logout' )
        {
            if ( isset($_SESSION['admin-status']) && $_SESSION['admin-status'] == 'logon' )
            {
                unset($_SESSION['admin-status']);
                echo "You have successfully logouted.<br />";
                echo "<a href='../index.php'>Get back to mainpage.</a>";
                exit();
            }
        }
        echo "Invaild action.";
        exit();
    }
    elseif( isset($_POST['pwd']) )
    {
        $pPassword = $_POST['pwd'];
        global $cadminPassword;
        if( $pPassword == $cadminPassword )
        {
            $_SESSION['admin-status'] = 'logon';
            echo "You have successfully logined.<br />";
            echo "<a href='pages.php'>Confessions Manager</a> | <a href='users.php'>Users Manager</a> | <a href='index.php?action=logout'>Log out</a>";
            exit();
        }
        else
        {
            echo "Wrong password.<br />";
            echo "<a href='./index.php'>Try again.</a>";
            exit();
        }
    }
    elseif( !isset($_SESSION['admin-status']) )
    {
        echo "Please login.<br />";
        echo <<<EOT

<form method="post" action="./index.php">
Password: <input type="password" name="pwd">
<br />
<input type="submit" name="submit" value="Login">
</form>

EOT;
        exit();
    }
?>

</body>

</html>