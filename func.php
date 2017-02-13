<?php

define ("IMCFS",1);

include_once('config.php');

// ******** MySQL conn ********
function connect()
{
    global $cmysql;
    $cmysqlline = "";
    if ( $cmysql['port'] )
        $cmysqlline = $cmysql['host'] . ":" . $cmysql['port'];
    else
        $cmysqlline = $cmysql['host'];
    $conn = mysql_pconnect($cmysqlline, $cmysql['user'], $cmysql['pass']);
    mysql_select_db($cmysql['dbname'], $conn);
}
function add_confession($content="", $cookieid, $ip, $useragent)
{
    global $conn;
    if( !$conn ) connect();
    $time = time();
    $content = mysql_real_escape_string($content);
    $result = mysql_query (" INSERT INTO `content` (`id`, `content`, `cookieid`, `time`, `ip`, `useragent`) VALUES ('' , '$content', '$cookieid', '$time', '$ip', '$useragent'); ");
    if (!$result)
        return false;
    else
        return true;
}

// ******** MySQL conn END ********

session_start();

function clear_all()
{
    session_destroy();
}

function gid()
{
    if( isset($_SESSION['CookieID']) )
        return $_SESSION['CookieID'];
    else
        return 0;
}

function showLoginCred()
{
    if( !gid() )
    {
        echo "| <a href='login.php'>Login</a>";
        return;
    } else {
        echo "| Welcome, <a href='manage.php'>" . $_SESSION['CookieID'] . '</a>';
        return;
    }
}


function getIPAddress()
{
    $ip = "unknown";
    if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
         $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
         $ip = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
         $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
    }


// Copied from Quora - -
/**
 * Generate a random string, using a cryptographically secure 
 * pseudorandom number generator (random_int)
 * 
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 * 
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 */
function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[rand(0, $max)];
    }
    return $str;
}

/*
Usage:

$a = random_str(32);
$b = random_str(8, 'abcdefghijklmnopqrstuvwxyz');
*/
?>