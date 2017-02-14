<?php

define ("IMCFS",1);

include_once('config.php');

// ******** MySQL conn ********
function connect()
{
    global $cmysql,$conn;
    if( $conn ) exit();
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
    connect();
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

/**
 * showContent()
 * Used to show the confessions.
 *
 * @param $num: Number of items to return.
 * @param $offset: Offset value.
 *
 * @return Count of items.
 */

function showContent( $num=5, $offset=0 )
{
    // Prevent injection
    $num = intval($num);
    $offset = intval($offset);
    echo "<span id='loading' style='color:grey'>Loading Confession...</span>";connect();
    $result = mysql_query("SELECT * FROM content ORDER BY id DESC LIMIT $num OFFSET $offset");
    global $ctimezone;
    date_default_timezone_set($ctimezone);
    echo "<div id='confession'>";
    while($line = mysql_fetch_array($result))
    {
        $thetime = date("Y-m-d H:i:s",$line['time']);
        echo "<blockquote>";
        echo $line['content'];
        echo "</blockquote><br />";
        echo "<grey>Posted by " . "Anonymous" . " at " . $thetime .  "</grey><br />";
    }
    echo "</div>";
    echo "<script type='text/javascript'>loadFinished();</script>";
    $retn = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM content"));
    return $retn['COUNT(*)'];
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