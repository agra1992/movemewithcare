<?php
session_start();
require("../config.inc.php");
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");
	$state_type="";
    $state_value="";
	
	$or_state = $_POST['dor_state'];
	
	$state_value=$or_state;	
	$state_type="dor_city";
		
	$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `StateID`='$state_value' "; 
	$result = mysql_query($sql) or die("Query failed");	

	if (session_is_registered('city')) 
		$or_city=$city;
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		if ($or_state==$line[CityID])
			$sel = "true";
		else
			$sel = "false"; 
		echo ("addOption(\"$line[city]\",$line[CityID],$sel,'$state_type');");
	}
	

?>

