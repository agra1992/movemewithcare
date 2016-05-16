<?
session_start();
session_destroy();
error_reporting(0);
require("../config.inc.php");
require_once "../top_panel.php";



$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");

$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 7';
$result = mysql_query($sql) or die("Query failed_FS");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

$add=array(array());
$sql = 'Select Add_Number,Description, Image,Link From add_manager Where Add_Number>10 AND Add_Number<14';

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
<TITLE>FULL service movers | Accredited full service moving companies for USA and Canada | Providing certified moving services for both residential moves and office moves | Licensed and insured accredited movers | Local and long distance moving providers | FREE estimates</title>
<META NAME="description" CONTENT="Local and long distance Accredited and certified full-service moving companies for USA and Canada, van line accredited movers, Movemewithcare.com Moving network of licensed and insured companies. All certified and accredited movers, proving full service moving as well as loading/unloading, transportation, storage and packing supplies. Save with Movemewithcare. When moving companies compete for your business, the customer always win">
<META NAME="keywords" CONTENT=" Alabama full service movers,Arizona ,moving companies,Arkansas relocators, California moving services, Colorado  ,Connecticut,Delaware relocation help,Florida,Georgia ,Hawaii,Idaho,Illinois,Indiana freight providers,Iowa,Kansas,Kentucky,Louisiana,Maine,Maryland accredited moving companies,MD moving providers, Massachusetts,Michigan accredited moving help,Minnesota,Mississippi,Missouri,Montana,Nebraska,Nevada,New Hampshire,New Jersey,New Mexico, New York certified relocation specialist,North Carolina,North Dakota, Ohio,Oklahoma,Oregon,Pennsylvania, Rhode Island, South Carolina,South Dakota, Tennessee, Texas licensed and insured moving providers,Utah,Vermont,Virginia shipping household forwarders,VA moving company,Washington,Washington DC bonded and insured moving providers,DC moving help, West Virginia,Wisconsin,Wyoming
Canadian Provinces, British Columbia, BC, Alberta, Manitoba, Saskatchewan, Ontario, Quebec, Newfoundland, Prince Edward Island, Yukon Territories.">
<META NAME="author" CONTENT="ProAce International, owner of Movemewithcare.com, the #1 Accredited and certified moving network for USA and Canada.">
<META NAME="Copyright" CONTENT="© 2006-2010 Movemewithcare.com. Nationwide accredited moving network. All Rights Reserved">
<META NAME="language" CONTENT="en-us">
<META NAME="classification" CONTENT="nationwide moving and relocation, transportation, loading and unloading, storage and warehousing, packing supplies providers..">
<META NAME="distribution" CONTENT=" nationwide">
<META NAME="revisit-after" CONTENT="30 days"> 
<META NAME="robots" CONTENT="ALL">

<link rel="stylesheet" type="text/css" href="../tabs.css" />
<link rel="stylesheet" type="text/css" href="../add_style.css" />
<script language="JavaScript" src="../mov.js"></script>
<script language="JavaScript" src="../cal.js"></script>
<script type="text/javascript" src="../overlib_mini.js"></script>
<script type="text/javascript">

function handleError() {
	return true;
}

window.onerror = handleError;

</script>
<SCRIPT LANGUAGE="JavaScript">
function new_add_window(add_path)
{
    add_window=window.open(add_path, "Add Images", "width=300, height=150,scrollbars=yes,resizable=yes ,toolbar=yes")
    add_window.focus();
}

</SCRIPT>
<table width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="172" align="center" valign="top"><div style="background-color:#E1F8E0" >
      <div > 
        <img src="../images/fullservice_movers.gif" alt="fullservice_movers"/> <br /><div align="justify" style="padding:5px;">
            <? echo nl2br($line[Detail]); ?>
          <!--<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>Movemewithcare.com</span> also provides you with Full service accredited movers, either local, Long distance or overseas moves, providing you with services including: Packing, Loading, transportation, unloading and unpacking all your furniture in your new house or storage. This service is used when the customer wants a service that covers all aspect of a move. Let our professional movers handle it and let us make your relocation cost effective, time efficient and also very pleasant.
<br /> <br />
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>Movemewithcare.com</span> conducts business with moving industry professionals, who are accredited, licensed and insured, and most of all who can commit to unmatched customer service. 
With just few minutes of your time, we'll help you make your relocation request a successful and enjoyable one!Go ahead, searching is free and our movers compete for your business, so at the end, you always win -->
          </div>
      </div>
    </div></td>
    <td width="828" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><form action="fullmovers.php" method="post" name="form1"  onSubmit="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" name="quick_quote" id="tab_gray_text">

 
  <tr>
					<td width="393" align="center" valign="top">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" name="get_quick_quote" align="center">
		<tr> 
		  <td colspan="3" align="center">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" name="top" align="center">
				<tr>
					<td width="63" align=left valign=bottom></td>
					<td width="268" height="19" align=center valign=bottom>
						<h2>Full Service Move Quick Quote</h2>					</td>
					<td width="63" align=right valign=bottom></td>
				</tr>
			</table>		  </td>
		</tr>
		<tr> 
		  <td width="10" ></td>
								<td width="373" height="220" align="center" valign="middle"> 
			<table width="100%" border="0" cellspacing="0" cellpadding="8" >
				<tr>
					<td colspan=3>
					    <div align="center"><span id="tab_red_text">*Important: </span>
          <span id="tab_bold_text">Prior to submitting any request on this site, you confirm that you have read our TERMS OF SERVICE and accept them.</span></div><br>						
			  </div>
					</td>
				</tr>		  
	
				<tr>				</tr>
			  <tr> 
				<td valign="bottom" width="182"> 

				  <div align="right" class="Ver11">
					
					 				  
							Moving From<br>State/Province:				  </div>				</td>
					<td valign="top"><p align="left"><span id="tab_regular_text">First, select origin state/province</span>
        <div align="left">
      <select name="or_state" size="1" id="or_state" onChange="get(this);AllowNext('mov');" style="width:170px;">
            <option value="">Select State/Province</option>
<?
mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999'; 

$result = mysql_query($sql) or die("Query failed");
if (session_is_registered('o_state')) 
$or_state=$o_state;
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
<a href="javascript:showmap('or_state');" class="map">Pick from map</a>		
<![endif]-->
        </div></td>
			  </tr>

		    <tr> 
		    <td> <p align="right"><span id="tab_regular_text">Second, select origin city</span><br>
        <div id="cityrec">
	  <i>
<?         if (session_is_registered('city'))
echo "if this is not your city, please re-select appropriate state from above.";
else
echo "if your city is not listed, please select nearest location.";
?>
</i></div></p></td>
					<td valign="top"> 
         
<?         if (session_is_registered('city')) {
			$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `CityID`='$city' "; 
	$result = mysql_query($sql) or die("Query failed");	

	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$city_name=$line[city];
	}?>
		 <p align="left"><select name="or_city" size="7" id="or_city" style="width: 170px;" onChange="AllowNext('mov');">
		<option value="<?=$city?>" selected><?=$city_name?></option></p>
<?} else {?>
 <p align="left"><select name="or_city" size="7" id="or_city" style="width: 170px;" onChange="AllowNext('mov');"></p>
<?}?>

            </select>
            <tr>            </tr>

            <tr>			  
					<td width="182"> 
					  <div align="right" class="Ver11"><nobr>
					 						  
						Moving To<br>State/Province:					  </div>					</td>
					<td><div align="left"> 
							<select name="dor_state" id="dor_state" onChange="AllowNext('mov');" style="width:170px;">
								<option value="">Select State/Province</option>
<?
mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=999'; 

$result = mysql_query($sql) or die("Query failed");
if (session_is_registered('d_state')) 
$dor_state=$d_state;
// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";
if ($line[StateID]!=52)
	echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
else
	echo ("<option value=\"$line[StateID]\" $style $sel>$line[name]</option>");
}
?>
</select><br>
<!--[if IE]>
<a href="javascript:showmap2('dor_state');" class="map">Pick from map</a>		
<![endif]-->
</div></td>
			  </tr>


			  <tr> 
				<td width="182"> 
				  <div align="right" class="Ver11">					 					  
					Size of Move:				  </div>				</td>
				<td colspan="2"> 

				<p align="left">
				  <select name="WeightLimit" id="moveSize" label="Size of Move" onChange="AllowNext('mov');" >
 					<option value=""  selected >Select weight</option>
					<option value="0_Partial Home 500-1000 lbs">Partial Home 500-1000 lbs</option>
					<option value="0_Studio 1500 lbs">Studio 1500 lbs</option>
					<option value="1_1 BR Small 3000 lbs">1 Small Bedroom</option>
					<option value="1_1 BR Large 4000 lbs">1 Large Bedroom  4000 lbs</option>
					<option value="1_2 BR Small 4500 lbs">2 Small Bedrooms 4500 lbs</option>
					<option value="1_2 BR Large 6500 lbs">2 Large Bedrooms 6500 lbs</option>
					<option value="1_3 BR Small 8000 lbs">3 Small Bedrooms 8000 lbs</option>
					<option value="1_3 BR Large 9000 lbs">3 Large Bedrooms 9000 lbs</option>
					<option value="1_4 BR Small 10000 lbs">4 Small Bedrooms 10000 lbs</option>
					<option value="1_4 BR Large 12000 lbs">4 Large Bedrooms 12000 lbs</option>
					<option value="1_Over 12000 lbs">Over 12000 lbs</option>
				  </select></p>				</td>
			  </tr>	
		

 
			  <tr> 
				<td width="182"> 
				  <div align="right"></div>				</td>
				<td colspan="2"> 
				
				  <input type="submit" id="next" name="Submit" value="NEXT >>>" disabled class="button" STYLE="width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57">
				  
				  <input type="hidden" name="full" value="yes">
				  <input type="hidden" name="direction" id="direction" value="">				</td>
			  </tr>
			</table>
		  </td>
	  </table>
  </table>
</form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><? include_once "../bottom_panel.php"; ?></td>
  </tr>
</table>
