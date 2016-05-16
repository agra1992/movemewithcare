<?php
session_start();
require("../../config.inc.php");
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");
	if($movers=="full")
 	$sql = "SELECT `name`,`id` FROM `fullservice` order by name"; 
	else
	$sql = "SELECT `name`,`id` FROM `cs` order by name"; 
	$result = mysql_query($sql) or die("Query failed");	
//if (session_is_registered('city')) 
//$or_city=$city;
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	if ($or_state==$line[id]) $sel = "true"; else $sel="false"; 
	echo ("addOption(\"$line[name]\",$line[id],$sel);");
	}
	

?>