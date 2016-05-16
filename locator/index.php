<?php
require("../config.inc.php");
require("sanitize.php");
//print_r($HTTP_POST_VARS);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Online mover helper <?=$CN_SUFFIX ?></title>
<meta name="description" content="<? include("../description"); ?>">
<META NAME="keywords" CONTENT="<? include("../keywords"); ?>">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<link rel="stylesheet" href="style.css">
<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript">
</script>
</head>

<body onload="init()">
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="178">
<img src="PICS/logo.jpg" width="150" height="70" alt="All moving companies presented on this site are members of BBB and/or AMSA an not listed on movingscam.org"> 
</td>
    <td width="1" bgcolor="#0066FF"></td>
    <td width="568"><div align="right">
<img src="PICS/movingu.jpg" width="450" height="70" alt="Best nationwide moving company network - movinguwithcare.com">
</div>
</td>
  </tr>
  <tr height="1"> 
    <td height="1"  bgcolor="#0066FF"></td>
    <td height="1"  bgcolor="#0066FF"></td>
    <td height="1"></td>
  </tr>
  <tr> 
    <td rowspan="5" valign="top">
<?php
// In this case we need only table of contents from website database
// cause everything else is generated in this script
// so don't forget to switch databases and starting work

require("contents.php");

?>

<?
include("trustlogo.inc.php");
?>

</td>
    <td rowspan="5" bgcolor="#0066FF"></td>
    <td valign="top"><div align="center"><?php

$FirstArg = sanitize($argv[0],10,1);


if ($FirstArg=="fs") echo ("<a href=\"https://locator.movinguwithcare.com/?fs\"><img src=\"PICS/fs_h.gif\" width=\"157\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?lupu\"><img src=\"PICS/load_n.gif\" width=\"159\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?trans\"><img src=\"PICS/trans_n.gif\" width=\"185\" height=\"29\" border=0></a>");

if ($FirstArg=="lupu") echo ("<a href=\"https://locator.movinguwithcare.com/?fs\"><img src=\"PICS/fs_n.gif\" width=\"157\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?lupu\"><img src=\"PICS/load_h.gif\" width=\"159\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?trans\"><img src=\"PICS/trans_n.gif\" width=\"185\" height=\"29\" border=0></a>");

if ($FirstArg=="trans") echo ("<a href=\"https://locator.movinguwithcare.com/?fs\"><img src=\"PICS/fs_n.gif\" width=\"157\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?lupu\"><img src=\"PICS/load_n.gif\" width=\"159\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?trans\"><img src=\"PICS/trans_h.gif\" width=\"185\" height=\"29\" border=0></a>");

?></div></td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#0066FF" height="1"></td>
  </tr>
  <tr> 
    <td valign="top"><table width="95%" border="0" align="center">
        <tr> 
          <td><br>
<?php
//print_r ($HTTP_POST_VARS);

$or_city = sanitize($_POST[or_city],20,0);
$dest_city = sanitize($_POST[dest_city],20,0);
$dest_state = sanitize($_POST[dest_state],20,0);
$fname = sanitize($_POST[fname],20,0);
$next = sanitize($_POST[next],5,1);
$next2 = sanitize($_POST[next2],5,1);
$next3 = sanitize($_POST[next3],5,1);
$transport = sanitize($_POST[transport],5,1);
$samecity = sanitize($_POST[samecity],5,1);


if ($FirstArg=='fs') {

if (!($or_city) and !($dest_state) and !($fname) and !($next)) require ("inc/fs_1.php");
if (($or_city) and !($dest_state) and !($fname) and !($next)) require ("inc/fs_1.php");

if (($or_city) and !($dest_state) and !($fname) and ($next)) require ("inc/fs_2.php");
if (($or_city) and ($dest_state) and !($fname) and !($next)) require ("inc/fs_2.php");

if (($or_city) and ($dest_state) and !($fname) and ($next)) require ("inc/fs_3.php");

if (($or_city) and ($dest_state) and ($fname)) require ("inc/fs_4.php");
}

//////////////////////////////////////////////////////////////////////////////

if ($FirstArg=='lupu') {

if (!($or_city) and !($dest_city)) require ("inc/lupu_1.php"); 
if (($or_city) and !($next2) and !($dest_state)) require ("inc/lupu_1.php");

if (($or_city) and ($next2) and !($samecity) and !($transport) and !($fname)) require ("inc/lupu_2.php"); 
if (($dest_state) and !($next3) and !($next2) and !($transport) and !($fname)) require ("inc/lupu_2.php");

if (($or_city) and ($dest_city) and ($next3)) require ("inc/lupu_3.php");
if (($or_city) and ($dest_city) and ($next2)) require ("inc/lupu_3.php");

if (($or_city) and ($dest_city) and ($transport) and !($fname)) require ("inc/lupu_4.php");

if (($or_city) and ($dest_city) and ($transport) and ($fname)) require ("inc/lupu_5.php");

}
//////////////////////////////////////////////////////////////////////////////

if ($FirstArg=='trans') require ("inc/trans_1.php");

?>

            </td>
        </tr>
      </table>
      <div align="center" class="bottomtext"></div></td>
  </tr>
  <tr> 
    <td bgcolor="#0066FF" height="1"></td>
  </tr>
  <tr> 
    <td valign="top"><div align="center" class="bottomtext"><br>
<?php

include("../bottomtext");

?>
</div></td>
  </tr>
</table>
</body>
</html>
<!-- Default template by ProAqua. (C) Egor Emeliyanov, 2005 -->