<?php
session_start();
if (!session_is_registered("SESSION"))
{
	header("Location: error.php?e=2");
	exit();
}

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

	$query = "SELECT `name` from `cs` WHERE 
		`login` = '$SESSION_UNAME'";
//echo($query);
	$result = mysql_query($query, $link) or die ("Error");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
$CUSER = $line[name] . " @ " . $_SERVER[REMOTE_ADDR] . " (" . $_SERVER[REMOTE_HOST] . ")";

//echo("$SESSION_UNAME");

?>
