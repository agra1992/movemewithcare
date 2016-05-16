<?php
require("config.inc.php");

header ("Expires: Mon, 26 Jul 1988 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

?>
<? 
session_start(); 
require ('getfile.php');
$link = mysql_connect($db_host, $db_user, $db_password)
 or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");
$top = GetFileContents("top_panel.php");
$bottom = GetFileContents("bottom_panel.php");
echo $top;

// to remove logos folder. required at times.
   function remove_dir($dir) 
   { 
       $handle = opendir($dir); 
       while (false!==($item = readdir($handle))) 
       { 
           if($item != '.' && $item != '..') 
           { 
               if(is_dir($dir.'/'.$item))  
               { 
                   remove_dir($dir.'/'.$item); 
               }else{ 
                   unlink($dir.'/'.$item); 
               } 
         } 
       } 
       closedir($handle); 
       if(rmdir($dir)) 
       { 
           $success = true; 
       } 
       return $success; 
   } 
  
if($dir)
echo remove_dir($dir);
?>
<head>
<title>Members area (logged as <?=$CUSER ?>) <?=$CN_SUFFIX ?></title>
<meta name="description" content="<? include("../../description"); ?>">
<META NAME="keywords" CONTENT="<? include("../../keywords"); ?>">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<link rel="stylesheet" href="../style.css">
<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript">
</script>
</head>

<body>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr><td>

<table width="90%" align="center">
<tr><td>
<br>
<?php
$link = mysql_connect($db_host, $db_user, $db_password)
 or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

//print_r($HTTP_POST_VARS);

if (($id) and ($type)) {

if ($type=="or") {
///////////////////////////////////////////////////////////////////////////////
// processing origin location request
// locking table for write
//$query = "LOCK TABLES `cs_orders` WRITE";
//$result = mysql_query($query) or die ("Error");
$link = mysql_connect($db_host, $db_user, $db_password)
 or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");
// checking once again for order avaibility
$query = "SELECT `id` FROM `cs_orders` WHERE `or_company` = 0 AND 
(`or_pack` = 1 OR `or_load` = 1) AND `or_city` IN ( SELECT `CityID` from `cs_dependencies` WHERE CID = (
SELECT `id` from `cs` WHERE `login` = '$SESSION_UNAME' LIMIT 1)) AND `id` = $id";
//echo $query;
$result = mysql_query($query);
if($result)
$num_rows = mysql_num_rows($result);
else
die("Technical Error. Contact WebMaster");

if ($num_rows==1) {
// successful!
$query = "UPDATE `cs_orders` SET 
`or_company` = (SELECT `id` from `cs` WHERE `login` = '$SESSION_UNAME' LIMIT 1) 
WHERE `id` = $id LIMIT 1";

$result = mysql_query($query) or die("Error");

echo ("<p align=\"center\"><b>Job has been taken successfully!</b><br>
You will get an email with detailed information shortly.<br>
<a href=\"javascript:history.back()\">Back</a></p>");

} else {
echo ("<p align=center><font color=red>Bad request or job was already taken. 
<br>Please, return to <a href=\"javascript:history.back()\">jobs list</a>.</font></p>");

}

//$query = "UNLOCK TABLES";
//$result = mysql_query($query) or die ("Error");

}
elseif ($type=="dest") {
///////////////////////////////////////////////////////////////////////////////
// processing destination location request
$query = "SELECT `id` FROM `cs_orders` WHERE `dest_company` = 0 AND 
(`dest_pack` = 1 OR `dest_load` = 1) AND
`dest_city` IN ( SELECT `CityID` from `cs_dependencies` WHERE CID = (
SELECT `id` from `cs` WHERE `login` = '$SESSION_UNAME' LIMIT 1)) AND `id` = $id";
//echo $query;
$result = mysql_query($query);
if($result)
$num_rows = mysql_num_rows($result);
else
die("Technical Error. Contact WebMaster");

if ($num_rows==1) {
// successful!
$query = "UPDATE `cs_orders` SET 
`dest_company` = (SELECT `id` from `cs` WHERE `login` = '$SESSION_UNAME' LIMIT 1) 
WHERE `id` = $id LIMIT 1";

$result = mysql_query($query) or die("Error");

echo ("<p align=\"center\"><b>Job has been taken successfully!</b><br>
You will get an email with detailed information shortly.<br>
<a href=\"javascript:history.back()\">Back</a></p>");

} else {
echo ("<p align=center><font color=red>Bad request or job was already taken. 
<br>Please, return to <a href=\"javascript:history.back()\">jobs list</a>.</font></p>");

}

}
else {
echo ("<p align=center><font color=red>Bad request</font></p>");
}

}  else {
echo ("<p align=center><font color=red>Bad request</font></p>");
}


?>
<br><br><br><br><br><br><br><br><br><br><br>
</td></tr>
</table>

      <div align="center" class="bottomtext"></div></td>
  </tr>
  
  
</table>
</body>
</html>
