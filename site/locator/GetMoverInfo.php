<?php
session_start();
error_reporting(0);
require ('config.inc.php');

$MemberID = (isset($_GET['MemberID']) && $_GET['MemberID'] != '')?$_GET['MemberID']:0;
if($MemberID == 0) die('Bad Request...');

$link = mysql_connect($db_host, $db_user, $db_password) or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

$query = "SELECT * FROM tblmembers WHERE MemberID='".$MemberID."'";
$result = mysql_query($query) or die('cannot get the moving company information');
$CompanyInfo = mysql_fetch_object($result);

$CompanyInfo_ZipCode_State = explode(' ',$CompanyInfo->ZipCode);
$CompanyInfo_ZipCode = $CompanyInfo_ZipCode_State[1];
$CompanyInfo_State = $CompanyInfo_ZipCode_State[0];

$query = "SELECT * FROM states WHERE sh_name='".$CompanyInfo_State."'";
$result = mysql_query($query) or die('cannot get the state name from DB');
$StateInfo = mysql_fetch_object($result);

if($CompanyInfo->Associations != '')
{
$Associations = explode(',',$CompanyInfo->Associations);
$AssocString = '';
/*
foreach($Associations as $Key=>$Value)
{
	$Association .= $Value .' AND ';
}
$Association = substr($Association,0,strlen($Association)-strlen(' AND '));
*/

$query = "SELECT * FROM associations";
$result = mysql_query($query) or die('cannot get associations data from DB');
while( $AssociationInfo = mysql_fetch_object($result) )
{
	if( in_array($AssociationInfo->assid,$Associations) )
	{
		$AssocString .= $AssociationInfo->ass_shname.', ';
	}
}
$AssocString = substr($AssocString,0,strlen($AssocString)-strlen(', '));
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$CompanyInfo->MemberName;?></title>
<style type="text/css">
<!--
#MainBody {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body topmargin="5" leftmargin="5">
<div id="MainBody">
	<table border="0" cellpadding="4" cellspacing="1" width="500" height="270">
  <tr>
    <td colspan="2" height="20" style="background-color:#0066FF"><span style="font-size:14px;font-weight:bold;color:#FFF;line-height:20px"><?=$CompanyInfo->MemberName;?></span></td>
  </tr>
<!--
  <tr>
    <td height="20" style="font-weight:bold">License</td>
    <td>1290088</td>
  </tr>
//-->
  <tr>
    <td style="font-weight:bold">Address:</td>
    <td><?php print $CompanyInfo->Address.', '.$CompanyInfo_ZipCode.', '.$StateInfo->name;?></td>
  </tr>
  <tr>
    <td style="font-weight:bold">Toll free number:</td>
    <td><?=$CompanyInfo->TollFree;?></td>
  </tr>
  <tr>
    <td style="font-weight:bold">Other contact number:</td>
    <td><?php print 'Phone#: '.$CompanyInfo->Phone.', FAX#: '.$CompanyInfo->Fax;?></td>
  </tr>
    <tr>
    <td style="font-weight:bold">Interstate license number:</td>
    <td><?php print 'USDOT#: '.$CompanyInfo->USDot.', MCC#: '.$CompanyInfo->MC;?></td>
  </tr>
    <tr>
    <td width="170" style="font-weight:bold">Member of Association:</td>
    <td><?=$AssocString;?></td>
  </tr>
  <tr valign="top">
    <td height="170" style="font-weight:bold">Description:</td>
    <td style="text-align:justify"><?=$CompanyInfo->Description;?></td>
  </tr>
</table>

</div>
</body>
</html>
