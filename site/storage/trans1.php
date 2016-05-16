<?php
session_start(); 
require("config.inc.php");
require_once("seo.php");
require("sanitize.php");
require_once "top_panel.php";

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_locator_name) or die("Could not select database");

?>

<link rel="stylesheet" href="../locator/style.css" />

<body>
 
<div style="float:left;clear:none;display:block;width:150px;border:2px dotted;text-align:center;font-size:11px;font-family:Verdana;color:gray;margin-top:25px;">
<div style="margin:5px 5px 5px 5px;text-align:left;background-color:#dceffe;line-height:12pt;">

<img src="../images/storage_facilities.gif" style="margin:5px auto;margin-left:18px;" alt="storage_facilities"/>
<?
  $sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 9';
  $result = mysql_query($sql) or die("Query failed_Store");
  $line = mysql_fetch_array($result, MYSQL_ASSOC);
  echo nl2br($line[Detail]);
?>
</div>
</div>
<div align="left" style="padding-top:100px!important;padding-top:0px;width:600px;height:1200px!important;height:2px;font-family:'Verdana,Arial';color:#000">
<?
  if ($_SESSION['browser'] != "Mozilla")
  {
    echo "<br>";  
  }
?>
<?
    if($_GET['sm'] == "1")
	{
	
	 $sql = "SELECT Detail from tbl_templates WHERE TempID='13'"; 
     $result2 = mysql_query($sql) or die("Query failed230");
	 $line = mysql_fetch_array($result2, MYSQL_ASSOC);
     $temp_message = $line[Detail]; 
	 
	 $Name = $_SESSION['fname'] . " " . $_SESSION['lname'];
	 $message  = "<br>";
     $message  = str_replace("%CN%", $Name, $temp_message);
	 $message = nl2br($message);
	 
	 echo "<p align=\"center\">$message</p>";
	 
	 $query10 = "Select tblmembers.MemberID,tblmembers.MemberName,CONCAT(SUBSTR(tblmembers.Description,1,300),'...') as Description,
           tblmembers.Logo, tblmembers.TollFree, tblmembers.ContactEmail
             From tblmembers
                 Inner Join tblmember_servicecity ON tblmembers.MemberID = tblmember_servicecity.MSID
               Where tblmembers.Active = '1' AND tblmembers.MemberType = 'storage' AND
                     tblmember_servicecity.StateID IN (999,$o_state,$d_state)"; 
	 
	 $result10 = mysql_query($query10) or die("Query failed: 10");
	 
	 if (!(empty($result10)))
	 {
	
	echo "<p align=\"center\">The following are few among the vast number of accredited movers with whom your request has been placed.
	          </p>";
	echo "<p><table>";
	
	 while ($line = mysql_fetch_array($result10, MYSQL_ASSOC)) 
	 {
		if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";
		echo "<tr $style>";
		echo "<td>";
		echo "<span>".$line[MemberName]. " (Toll Free:" . $line[TollFree] . ")" . "</span><br />";
		echo "<font size=2>".$line[Description]."</font>";
		echo "</td>";
		echo "<td>";
		echo "<img src='../logos/$line[Logo]' height='100' width='200'/>";
		echo "</td>";
		echo "</tr>";
	 }
	 
	 echo "</table></p>";
	 
	 }
	
	}
	else
	{
	  $message = "<div align=\"center\"><font color=red><strong>We are sorry, but you are not allowed to post any more requests today.</strong></font></div>";
		echo $message;
	}
?>

</div><br><br><br>
<? include_once "bottom_panel.php"; ?>