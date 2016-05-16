<?php
session_start();
//error_reporting(0);
require_once('../config.inc.php');
require_once ('../top_panel.php');

// include "../prerequisites.php";
//$browser = CheckBrowser();
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");

$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 6';
$result = mysql_query($sql) or die("Query failed_LUPU");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$add=array(array());
$sql = 'Select Add_Number,Description, Image,Link From add_manager Where Add_Number<5';

$r = mysql_query($sql) or die("Query failed_LUPU $sql");
while($result = mysql_fetch_array($r, MYSQL_ASSOC))
{
    $add[$result[Add_Number]][0]=$result[Description];
    $add[$result[Add_Number]][1]=$result[Image];
    $add[$result[Add_Number]][2]=$result[Link];

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Movers Loading-Unloading | Accredited, certified | Affordable Moving Help | Load and Unload Moving Services | Loading and Unloading Help | Accredited Loading and Unloading Moving Services | Canadian Loading and Unloading Help | FREE Estimates </title>
<meta name="description" content="Rental Truck, PODS, Container, trailers, Cross Country, cross boarder to Canada, International, overseas moving help services, household goods loaded and unloaded, door to door, SAMS, Uhaul, Ryder, Budget, City to City, ABF, Freight handlers">
<meta name="keywords" content="Help, helpers, movers, move,  moving, labor services, moving help services, accredited movers, accredited loading and unloading services, PODS, Uhaul, budget, Ryder, Crate, Certified moving labor, licensed moving company, trailers, loading trailer, unloading trailers, containers, load containers, unload containers, nationwide relocation, affordable moving help, box boxes, loading and packing boxes, Moving supplies, affordable moving supplies, office moving, household moving, apartment moving, load and unload truck rental
Alabama,Arizona,Arkanas,California,Colorado,Connecticut,Delaware,Florida,Georgia,Hawaii,Idaho,Illinois,Indiana,Iowa,Kansas,Kentucky,Louisiana,Maine,Maryland,Massachusetts,Michigan,Minnesota,Mississippi,Missouri,Montana,Nebraska,Nevada,New Hampshire,New Jersey,New Mexico, New York,North Carolina,North Dakota, Ohio,Oklahoma,Oregon,Pennsylvania, Rhode Island, South Carolina,South Dakota, Tennessee, Texas,Utah,Vermont,Virginia,Washington,Washington DC,West Virginia,Wisconsin,Wyoming
Canadian Provinces, British Columbia, BC, Alberta, Manitoba, Saskatchewan, Ontario, Quebec, Newfoundland, Prince Edward Island, Yukon Territories.">
<meta name="author" content="ProAce International, owner of Movemewithcare.com, the #1 Accredited and certified moving network for USA and Canada.">
<meta name="Copyright" content="© 2006-2010 Movemewithcare.com.All Rights Reserved">
<meta name="language" content="en-us">
<meta name="classification" content=" nationwide moving and relocation, transportation, loading and unloading, storage and warehousing, packing supplies providers.">
<meta name="distribution" content=" nationwide ">
<meta name="revisit-after" content="30 days"> 
<meta name="robots" content="ALL">

<link rel="stylesheet" type="text/css" href="../tabs.css" />
<link rel="stylesheet" type="text/css" href="../add_style.css" />
    <style type="text/css">
    #main_table{width:400px;}    
    </style>

<!--[if IE 5]>
    <style type="text/css">
        #main_table{width:300px;}    
    </style>
<![endif]-->


<script language="JavaScript" src="../mov.js"></script>
<script language="JavaScript" src="../lupu.js"></script>
<script language="JavaScript" src="../cal.js"></script>
<script type="text/javascript" src="../overlib_mini.js"></script>
<script type="text/javascript">
<!-- //

function handleError() {
	return true;
}

window.onerror = handleError;
//-->
</script>


<SCRIPT LANGUAGE="JavaScript">
function new_add_window(add_path)
{
    add_window=window.open(add_path, "Add Images", "width=300, height=150,scrollbars=yes,resizable=yes ,toolbar=yes")
    add_window.focus();
}

</SCRIPT>

</head>



	

<table width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="199" align="left" valign="top"><table bgcolor="#CCECEE" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td ><div align="justify" style="padding:5px;">
          <div align="center"><img src="../images/loadingunloading.gif" alt="fullservice_movers"/></div><br /> 
              <? echo @nl2br($line[Detail]); ?> 
        </div></td>
        </tr>
    </table></td>
    <td width="15" align="center" valign="top">&nbsp;</td>
    <td width="786" align="center" valign="top"><form name="loadin" action="fulllupu.php" method="post">
<table width="97%" border="0" cellspacing="0" cellpadding="0" name="quick_quote" id="tab_gray_text">
<tr> 
	<td colspan="2" align="left" style="text-align:center"><div align="center" ><h2>Welcome to Moving help wizard</h2></div>
	  <div align="justify"><br />
	    <span id="tab_bold_text">Looking for qualified and accredited loading and unloading moving service providers? With our moving help wizard, posting a loading and unloading moving request should be as easy as 1-2-3. Yes, that's it - in just three easy steps, you'll locate your accredited moving company to serve you. Actually, it is the moving company that will find YOU. No more stress when it comes to MOVING. Our network of accredited movers will make your moving experience as fun and easy as possible. </span>
	    <br />
	        <br />
	    </div>
	  <div align="center" id="tab_bold_text">
	    <div align="left"><span id="tab_red_text">*Important: </span>Prior to submitting any request on this site, you confirm that you have read our TERMS OF SERVICE and accept them.</div>
	  </div>	</td>
</tr>
<tr><tr><td><br /></td></tr>
<tr><tr><td align="left"><br />
  <span id="tab_red_text">First Step:</span></td>
</tr>
<tr> 
    <td colspan="2"><div align="center" id="tab_bold_text">
      <div align="left"><br />Origin location</strong></div>
    </div></td>
</tr>
<tr> 
    <td colspan="2" valign="top"><p align="left" id="tab_regular_text">Select Origin State/Province (We also serve Canada) <!--(We also serve Canadians)--></p>
     
	  <div align="left">
	    <input type=hidden name ="ServiceSelector" value = "lupu" >
	      <select name="or_state" size="1" id="or_state" onChange="naNext();get(this);" style="width:170px; ">
	        <option value="">Select State/Province</option>
	        <?
			mysql_select_db($db_locator_name) or die("Could not select database");
			$sql = "SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999 AND StateID!=68"; 
			$result = mysql_query($sql) or die("Query failed");
			
			// showing all states
			while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";
				if ($line[StateID]!=52)
					echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
				else
					echo ("<option value=\"$line[StateID]\" $style $sel>$line[name]</option>");
			}
		?>  	
	          </select>
	    <br>
	    
	    <!--[if IE]>
		<a href="javascript:showmap('or_state');" class="map">Pick from map</a>		
		<![endif]-->
	      </div></td>
</tr>

<tr> 
	<td width="40%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="left"><br />Select origin city<br />
        </div>
          <div id="cityrec2">
            <div align="left">if your city is not listed, please select  
              nearest location.</div>
          </div>
          <div align="left"><br />
            <select name="or_city" size="7" id="or_city" style="width: 170px; " onchange="AllowNext('lupu');">
            </select>
            <br />
          </div></td>
      </tr>
      <tr>
        <td align="left"><input type="hidden" name="samecity" value="yes" id="samecity" onclick="gorod();" />
          <font  size="-3">Note: If moving within the same state, go to step 2 and choose same state and choose destination city as well.</font>
          <input type="hidden" name="next2" />
          <input type="hidden" name="dest_city" />
          <input type="hidden" name="dest_state" /></td>
      </tr>
    </table></td>
    
	<td width="60%" align="left" valign="center" id="tab_regular_text">Please, specify services required at origin location:<br>

		<table border="0" align="left" valign="top" width="98%" id="tab_gray_text">
		<tr>
			<td valign="top" style="width: 20px;"><input type="checkbox" name="or_pack" value="1" id="or_pack" onclick="ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">Packing</td>
		</tr>
		<tr>
	    	<td valign="top"><input type="checkbox" name="or_load" value="1" id="or_load" onclick="ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">Loading</td>
		</tr>
		<tr>    
			<td valign="top"><input type="checkbox" name="or_none" value="1" id="or_none" onclick="or_nosvc('o');ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">No services required at origin location</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">
			<input type="hidden" name="dest_none">			</td>
		</tr>
		</table>	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr><tr><td align="left"><br />
  <b><span id="tab_red_text">Second Step:</span></b></td>
</tr>
 
<tr>
	<td colspan="2"><div align="left"><span id="tab_bold_text"><br />Destination location</span></div></td>
</tr>
<tr> 
   <td colspan="2" valign="center"><p align="left" id="tab_regular_text">Select destination state/province</p>
    
          
		
	 <div align="left">
	   <select name="dor_state" size="1" id="dor_state" onChange="naNext();get2('dor_state');" style="width:170px; ">
	     <option value="">Select State/Province</option>
	     <?
		mysql_select_db($db_locator_name) or die("Could not select database");

		$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999 AND StateID!=68';
		$result = mysql_query($sql) or die("Query failed");
		
		// showing all states
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";

		if ($line[StateID]!=52)
			echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
		else
			echo ("<option value=\"$line[StateID]\" $style $sel>$line[name]</option>");
		}
		?>  	
	     </select>
	   <br>
	   <!--[if IE]>
		<a href="javascript:showmap2('dor_state');" class="map">Pick from map</a>		
		<![endif]-->
	   </div></td>
</tr>
<tr> 
	<td width="40%" valign="top"> <div align="left"><br />Select destination city<br>
	  </div>
	  <div id="cityrec">
	    <div align="left"><i>if your city is not listed, please select <br /> 
	      nearest location.</i></div>
	    </div>
	  <div align="left"><br>
	        <select name="dor_city" size="7" id="dor_city" style="width: 170px;" onChange="AllowNext('lupu');">
	              </select>
	    </div></td>
		
	<td width="60%" align="left" valign="center"><span id="tab_regular_text">Please, specify services required at destination location:</span><br>

		<table border="0" align="left" id="tab_gray_text">
		<tr>
			<td valign="top" style="width: 20px;"><input type="checkbox" name="dor_pack" value="1" id="dor_pack" onclick="ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">UnPacking</td>
		</tr>
		<tr>
	    	<td valign="top"><input type="checkbox" name="dor_load" value="1" id="dor_load" onclick="ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">UnLoading</td>
		</tr>
		<tr>    
			<td valign="top"><input type="checkbox" name="dor_none" value="1" id="dor_none" onclick="or_nosvc('d');ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">No services required at destination location</td>
		</tr>
		</table>	</td>
</tr> 
<tr> 
	<td colspan="2"> <div align="center"><input type="hidden" name="servty" value="" />
	  <input id="next" class="button" type="button" name="Submit" value="Next ->" onclick="Proceed()" disabled STYLE="width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57"><br /><br />
	</div></td>
</tr>
</table>

<input type="hidden" value="<?=$trans?>" name="transfer" />

</form></td>
  </tr>
</table>
<!--[if IE 5]>
<div style="position:relative; bottom:50px;">
<![endif]-->
<!--[if IE 6]>
<div style="position:relative; bottom:50px;">
<![endif]-->
<? include_once "../bottom_panel.php"; ?>