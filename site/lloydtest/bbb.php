<?php 
//////////////////////////////////////////////////////////////////////// 
// Main module of ProAqua CMS engine 
// (C) Egor S. "Hashish" Emeliyanov, 2005 
// Version 0.5dev 
//////////////////////////////////////////////////////////////////////// 
error_reporting(0);
require "top_panel.php";
require ('config.inc.php'); 
require_once ('seo.php');
require ('sanitize.php'); 
 
//$topic = $argv[0]; // attempting to get article handle 
 
// sanitation of variables 
$argv[0] = "bbb";
 
 
//echo $topic; 
// switch to 'main' if handle is not specified 
  if (trim($argv[0])=='') { 
	$hdr = "Location: http://$CN_SERVER_NAME/?main"; 
	header($hdr); 
	die; 
		} 
 
// working with database: connecting and getting content 
$link = mysql_connect($db_host, $db_user, $db_password) 
        or die("Could not connect"); 
 
mysql_select_db($db_name) or die("Could not select database"); 
 
// 404 implementation 
/* 
$sql = "SELECT `longtitle` FROM `content` WHERE `handle`='$argv[0]'";  
$result = mysql_query($sql) or die("Query failed"); 
if (mysql_affected_rows==0) { 
	header("404 Not found"); 
	die; 
	} */ 
 
//$sql = 'SELECT `handle`, `title`, `longtitle` FROM `content` WHERE NOT (`hidden` = 1) LIMIT 0, 30 ';  
$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 3';
$result = mysql_query($sql) or die("Query failed_BBB");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
echo "<center><p>" . nl2br($line[Detail]) . "</center>";

/*$result = mysql_query($sql) or die("Query failed"); 
 
$contents = "<br><br>"; 
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { 
// getting $contents 
$contents .= "<a href=\"?$line[handle]\" title=\"$line[longtitle]\">$line[title]</a><br><br>"; 
 
} 
 
// getting $template 
$template = GetFileContents($CN_TEMPLATE); 
 
// getting $keywords 
$keywords = GetFileContents("keywords"); 
 
// getting $description 
$description = GetFileContents("description"); 
 
// setting apropriate bookmarks 
$bookmarks = "<a href=\"https://locator.movinguwithcare.com/?fs\"><img src=\"PICS/fs_n.gif\" width=\"157\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?lupu\"><img src=\"PICS/load_n.gif\" width=\"159\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?trans\"><img src=\"PICS/trans_n.gif\" width=\"185\" height=\"29\" border=0>"; 
 
// getting $text 
$sql = "SELECT `content` FROM `content` WHERE `handle`='$argv[0]'";  
 
$result = mysql_query($sql) or die("Query failed"); 
$line = mysql_fetch_array($result, MYSQL_ASSOC); 
$text .= $line[content]; 
 
// getting page title 
 
$sql = "SELECT `longtitle` FROM `content` WHERE `handle`='$argv[0]'";  
 
$result = mysql_query($sql) or die("Query failed"); 
$line = mysql_fetch_array($result, MYSQL_ASSOC); 
$title = $line[longtitle]; 
 
// getting page bottom text ($bottomtext) 

 
 
echo $text; */
require_once("bottom_panel.php");
?>
