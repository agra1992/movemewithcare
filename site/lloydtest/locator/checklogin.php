<?php
require("../config.inc.php");

$login = sanitize($argv[0],10,1);

if ($login=="") {
	echo("<div align=center><font face=Arial size=-1 color=#130D57><strong>Empty login");
	echo("<br><br><br><a href=\"#\" onclick=\"window.close()\">Close window</a></div>");
	die;
	}


echo("<TITLE>Checking login $login</TITLE>");

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = "SELECT * FROM `cs` WHERE `login` = '$login'"; 
//echo($sql);
$result = mysql_query($sql) or die("Query failed1");
$num_rows = mysql_affected_rows();

if ($num_rows==0) { echo("<div align=center><font face=Arial size=-1 color=#130D57><strong>Desired login is avaible"); }
else { echo("<div align=center><font face=Arial size=-1 color=#130D57><strong>Login already exists"); }

?>
<br><br><br>
<a href="#" onclick="window.close()">Close window</a></div>
