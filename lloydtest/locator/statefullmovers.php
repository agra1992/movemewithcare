<? 
session_start();
error_reporting(0); 
require ('config.inc.php');
require_once("seo.php");

$or_state = (isset($_GET['or_state']) && $_GET['or_state'] != '')?$_GET['or_state']:1;
	   
$link = mysql_connect($db_host, $db_user, $db_password)
 or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

require "top_panel.php";
?>

<script>
function DisplayMoverInfo(sMemberID)
{
	window.open('GetMoverInfo.php?MemberID='+sMemberID,'MoverInfoWindow','width=460,height=270,scrollbars=yes');
}
</script>

<script language="javascript" src="cal.js"> </script>
<script language="javascript" src="overlib_mini.js"> </script>
<script language="JavaScript" src="../scripts/zxml.js"></script>
<script type="text/javascript">
<!-- //

function handleError() {
	return true;
}

window.onerror = handleError;
//-->
</script>

<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
#MoverNameSpan, #MoverDescriptionSpan {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color:#666666;
	text-align: justify;
}
#MoverNameSpan a {
	color: #0066ff;
	text-decoration: none;
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
}
#MoverNameSpan a:hover {
	color: #FF6600;
	text-decoration: underline;
}
-->
</style>

<link href="full_mov_list.css" rel="stylesheet" type="text/css">
<body>

<div id="MainBodyDiv" style="width:858px;position:relative;">

<div style="position:relative;float:left;height:650px;width:150px;border:2px dotted;text-align:center;font-size:11px;font-family:Verdana;color:gray;margin-top:25px;">
<div style="margin:5px 5px 5px 5px;text-align:left;background-color:#dceffe;line-height:12pt;">
<img src="../images/fullservice_movers.gif" style="margin:5px auto;margin-left:18px" alt="fullservice_movers"/>
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> also provides you with Full service movers, either local or Long distance, providing you with services including: Packing, Loading, transportation, unloading and unpacking all your furniture in your new house or storage. This service is used when the customer wants a service that covers all aspect of a move. Let our professional movers handle it and let us make your relocation cost effective, time efficient and also very pleasant.
<br /> <br />
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> conducts business with industry professionals, who are accredited, licensed and insured, and most of all who can commit to unmatched customer service. 
With just few minutes of your time, we'll help you make your relocation request a successful and enjoyable one!
</div>
</div>
<div style="position:relative;right:0px;width:600px;margin-top:25px;">
 
 <?php
 	$query = "SELECT * FROM states WHERE StateID='".$or_state."'";
	$result = mysql_query($query) or die("Cannot select state from DB");
	$obj_state = mysql_fetch_object($result);

 ?>
 
 <table cellpadding="0" cellspacing="4" border="0" width="500" align="">
 	<tr>
    <td height="30">
    <span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold">Moving Companies in <u><?=$obj_state->name?></u></span>
    </td>
    </tr>
    
    
    <?php
    	
    	$query = "SELECT * FROM tblmembers WHERE ZipCode like '". $obj_state->sh_name ."%' 
		AND Active = '1' AND (tblmembers.MC <> '' OR tblmembers.USDot <> '') AND InterstateLicense = '1'";
		$result = mysql_query($query) or die("Cannot select members from DB");
		while($obj_member = mysql_fetch_object($result))
		{
			//print "Member: ".$obj_member->MemberName." ;From ZipCode ".$obj_member->ZipCode."<br/>";
			$Logo = ( file_exists('../logos/'.$obj_member->Logo) && $obj_member->Logo != "" )?$obj_member->Logo:'NoLogo.gif';
			print "
			<tr>
    		<td>
			<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"500\" align=\"\">
			<tr valign=\"top\">
    				<td align=\"left\" style=\"border:1px solid #cccccc;border-right:1px dotted #cccccc;\">
    					<span id=\"MoverNameSpan\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;line-height:20px;\"><a href=\"javascript:DisplayMoverInfo('".$obj_member->MemberID."')\">".$obj_member->MemberName."</a></span>
    				<br/>
    				<span id=\"MoverDescriptionSpan\">".$obj_member->Description."<br/><br/><br/></span>
    				</td>
    				<td rowspan=\"2\" width=\"150\" align=\"center\" valign=\"middle\" style=\"border:1px solid #cccccc;border-left:0px solid #cccccc\">
    					<img src=\"../logos/".$Logo."\"></td>
    				</tr>
					</table>
					</td></tr>
					";
		}
		
	?>
    

    
 </table>
</div>

</div>

<?php require "bottom_panel.php"; ?>

<img src='buttons/tab_menu_r1_c1_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c2_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c3_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c4_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c5_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c6_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c7_f2.jpg' class="hiddenPic" />


<img src='buttons/tab_menu_r1_c1_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c2_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c3_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c4_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c5_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c6_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c7_f4.jpg' class="hiddenPic" />
</body>
</html>