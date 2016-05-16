<?php
error_reporting(0);
require_once "top_panel.php";
require("config.inc.php");
require_once ('seo.php');
require("sanitize.php");

?>
<style type="text/css">
<!--
.button
{
    BORDER-RIGHT: 1px solid;
    PADDING-RIGHT: 2px;
    BORDER-TOP: 1px solid;
    PADDING-LEFT: 4px;
    FONT-WEIGHT: bold;
    FONT-SIZE: 10px;
    PADDING-BOTTOM: 2px;
    BORDER-LEFT: 1px solid;
    COLOR: #ffffff;
    PADDING-TOP: 3px;
    BORDER-BOTTOM: 1px solid;
    FONT-FAMILY: Verdana, Arial, Helvetica;
    HEIGHT: 22px;
    BACKGROUND-COLOR: #0080C0
}
-->
</style>
<script language="JavaScript">
function handleError() {
	return true;
}
window.onerror = handleError;
</script>
<?
$website="MoveMeWithCare";
$website_s="MMWC";
        $sql = 'Select Detail From tblcontent Where tblcontent.CID = 13';
	         
       $result = mysql_query($sql) or die("Query failed_WAW");
       $line = mysql_fetch_array($result, MYSQL_ASSOC);
       $text=$line[Detail];
       $text = str_replace( "&n&website_s",$website_s, $text);
       $text = str_replace( "&n&website", $website, $text);
	   echo $text;

?>
<form action="mem2_final.php" method="post" name="form_affiliate">
  <input type="submit" id="Agree" name="Agree" value="Agree" class="button">
</form>

<br>

<? require_once "bottom_panel.php"; ?>










