<?php

define ("IMCFS",1);

include_once('config.php');

$conn = "";
$connected = false;
session_start();

/**
 * connect()
 * Connecting to MySQL server. You may need "global $conn;" before this.
 */
function connect()
{
    global $cmysql,$connected;
    if( $connected ) return;
    $cmysqlline = "";
    if ( $cmysql['port'] )
        $cmysqlline = $cmysql['host'] . ":" . $cmysql['port'];
    else
        $cmysqlline = $cmysql['host'];
    $conn = mysql_pconnect($cmysqlline, $cmysql['user'], $cmysql['pass']);
    if( !$conn )
    {
        die("<b>Database connection error.</b><br />");
    }
    mysql_select_db($cmysql['dbname'], $conn);
    $connected = true;
}

/**
 * add_confession()
 * Submit a confession to database.
 *
 * @param string $content     Confession content, default empty.
 * @param string $cookieid    CookieID of the submitter.
 * @param string $ip          IP address of the submitter.
 * @param string $useragent   User-agent of the submitter.
 *
 * @return 'true' for a success. (vise versa.)
 */
function add_confession($content="", $cookieid, $ip, $useragent)
{
    global $conn;
    connect();
    $time = time();
    $content = mysql_real_escape_string($content);
    $result = mysql_query (" INSERT INTO `content` (`id`, `content`, `cookieid`, `time`, `ip`, `useragent`, `read`) VALUES ('' , '$content', '$cookieid', '$time', '$ip', '$useragent', 0); ");
    if (!$result)
        return false;
    else
        return true;
}

/**
 * showLoginCred()
 * Show login creditals.
 * It does the output itself.
 */
function showLoginCred()
{
    if( !isset($_SESSION['CookieID']) )
    {
        echo "| Anonymous, get a Cookie <a href='get_cookie.php'>here</a>";
        return;
    } else {
        echo "| Welcome, <a href='manage.php'>" . $_SESSION['CookieID'] . '</a>';
        return;
    }
}

/**
 * getIPAddress()
 *
 * @return IP address of the user. 
 */
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
 * getCookieFromIP()
 * Get the CookieID (not cookie!) of the IP.
 * 
 * @param string $ipaddress IP to look up.
 * @return 'false' for a new user. For a registered user, the CookieIE will be returned.
 */
function getCookieFromIP( $ipaddress )
{
    global $conn;
    connect();
    $retn = mysql_query("SELECT * FROM user WHERE ipaddress='$ipaddress' ");
    if( !$retn )
    {
        die("Database connection error while looking up IP.");
        return true;
    }
    $line = mysql_fetch_array( $retn );
    if( !$line )
    {
        echo "You are newbies!<br />";
        return false;
    }
    return $line['cookieid'];
}

/**
 * hasIDInDatabase()
 * Used to against the generator collide.
 *
 * @param string $cookieid CookieID to look up.
 * @return 'true' for a existance, and 'false' for a unique CookieID.
 */
function hasIDInDatabase( $cookieid )
{
    global $conn;
    connect();
    $retn = mysql_query("SELECT * FROM user WHERE cookieid='$cookieid' ");
    if( !$retn )
    {
        die("Database connection error while looking up CookieID.");
        return true;
    }
    $line = mysql_fetch_array( $retn );
    if( $line )
        return true;
    return false;
}

/**
 * addUser()
 * Used to add a user (or connect CookieID to IP)
 *
 * @param string $cookieid    Generated CookieID.
 * @param string $ipaddress   IP of the user.
 * @param string $useragent   User-agent of the user.
 *
 * @return the status boolean.
 */
function addUser( $cookieid, $ipaddress, $useragent )
{
    global $conn;
    connect();
    $time = time();
    $result = mysql_query (" INSERT INTO `user` (`id`, `cookieid`, `ipaddress`, `useragent`) VALUES ('' , '$cookieid', '$ipaddress', '$useragent'); ");
    if (!$result)
    {
        echo "<b>Database connection error.</b><br />";
        return false;
    } else
        return true;
}

/**
 * delUser()
 * Delete CookieID records attached to a certain IP.
 *
 * @param string $ipaddress  The IP.
 * @return A status boolean.
 */
function delUser( $ipaddress )
{
    global $conn;
    connect();
    $result = mysql_query (" DELETE FROM `user` WHERE ipaddress = '$ipaddress' ");
    if (!$result)
    {
        die("<b>Database connection error.</b><br />");
        return false;
    }
    return true;
}

/**
 * showContent()
 * Used to show the confessions.
 *
 * @param int $num      Number of items to return.
 * @param int $offset   Offset value.
 *
 * @return Count of items.
 */
function showContent( $num=5, $offset=0 )
{
    // Prevent injection
    $num = intval($num);
    $offset = intval($offset);
    echo "<span id='loading' style='color:grey'>Loading Confession...</span>";connect();
    $retn = mysql_query("SELECT COUNT(*) FROM content");
    if ( !$retn )
    {
        echo "<br /><b>Database connection error.</b><br />";
        echo "<script type='text/javascript'>loadFinished();</script>";
        exit();
    }
    $retn = mysql_fetch_array( $retn );
    $count = $retn['COUNT(*)'];
    if( $count == 0 )
    {
        echo "<br /><b>No data now.</b><br />";
        echo "<script type='text/javascript'>loadFinished();</script>";
        return false;
    }
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
        if( isset($_COOKIE['read_' . $line['id']] ) )
            echo "<grey>Voted</grey>";
        else
            echo "<a href='read.php?id=" . $line['id'] . "'>Vote as readed</a>";
        echo " | " . $line['read'] ." click(s) | <grey>#" . $line['id'] . " Posted by " . "Anonymous" . " at " . $thetime .  "</grey><br />";
    }
    echo "</div>";
    echo "<script type='text/javascript'>loadFinished();</script>";

    return $count;
}

/**
 * random_str()
 * Code modified from the answer of Scott Arciszewski @ SOF.
 * 
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 */
function random_str($length, $keyspace)
{
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[rand(0, $max)];
    }
    return $str;
}

?>