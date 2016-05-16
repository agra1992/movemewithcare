<?
session_start();
require("../config.inc.php");
require_once ('seo.php');
require_once "top_panel.php";
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");

$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 7';
$result = mysql_query($sql) or die("Query failed_FS");
$line = mysql_fetch_array($result, MYSQL_ASSOC);



?>
<div style="float:left;width:150px;border:2px dotted;text-align:center;font-size:11px;font-family:Verdana;color:gray;margin-top:25px;">
<div style="margin:5px 5px 5px 5px;text-align:left;background-color:#dceffe;line-height:12pt;">
<img src="../images/fullservice_movers.gif" style="margin:5px auto;margin-left:18px" alt="fullservice_movers"/>
<? echo nl2br($line[Detail]); ?>
<!--<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> also provides you with Full service movers, either local or Long distance, providing you with services including: Packing, Loading, transportation, unloading and unpacking all your furniture in your new house or storage. This service is used when the customer wants a service that covers all aspect of a move. Let our professional movers handle it and let us make your relocation cost effective, time efficient and also very pleasant.
<br /> <br />
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> conducts business with industry professionals, who are accredited, licensed and insured, and most of all who can commit to unmatched customer service. 
With just few minutes of your time, we'll help you make your relocation request a successful and enjoyable one! -->
</div>
</div>
  <br>
<form action="fullmovers.php" method="post" name=form2  onSubmit="">
<table width="65%" border="0" cellspacing="0" cellpadding="0" align="right" name="quick_quote">

 
  <tr>
					<td width="393" align="center" valign="top">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" name="get_quick_quote" align="right">
		<tr> 
		  <td colspan="3">
			<table width="393" border="0" cellspacing="0" cellpadding="0" name="top" align="center">
				<tr>
					<td width="63" align=left valign=bottom><img src="../images/top_qq_left.gif" width="63" height="19"></td>
					<td width="268" height="19" align=center valign=bottom>
						<h2 style="FONT: bold 17px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 3px;">Full Service Move Quick Quote</h2>
					</td>
					<td width="63" align=right valign=bottom><img src="../images/top_qq_left.gif" width="63" height="19"></td>
				</tr>
			</table>
		  </td>
		</tr>
		<tr> 
		  <td width="10" background="/images/left_dot_line.gif"></td>
								<td width="373" height="220" align="center" valign="middle"> 
			<table width="339" border="0" cellspacing="0" cellpadding="8" style="font-family:Verdana;font-size:12px;">
				<tr>
					<td colspan=3>
					    <div align="center"><font color="red" size="-1" ><strong>*Important: </strong></font>
          <font color="black" size="-1" ><strong>Prior to submitting any request on this site, you confirm that you have read our TERMS OF SERVICE and accept them.</strong></font></div><br>
						<div align="center" class="Ver11">
							<b>
								
									Please choose any of the services below to get a quick 
									quote for your upcoming relocation.
							
							</b>
						</div>
					</td>
				</tr>		  
			  
				<tr>			  
					<td width="182"> 
					  <div align="right" class="Ver11"><nobr>
						Service Needed:</nobr>
						</div>
					</td>
					<td colspan="2" class="Ver11"> 
						<SELECT  class="color" name="ServiceSelector"  onchange='submit1(this.value);'>
<!--							<OPTION Value="">Select Service</OPTION>		-->
							<OPTION Value="1"  selected >Full Service Movers</OPTION> 
							<OPTION Value="2" >Loading/Unloading Assistance</OPTION>
							<OPTION Value="3" >Transportation Providers	</OPTION>
							<OPTION Value="4" >Storage Facilities</OPTION>
							<OPTION Value="5" >Packing Supplies &amp; Materials</OPTION>
						</SELECT>
					</td>
			  </tr>


<!--<form action="default.asp" method="post" name=form2  onSubmit="return ValidateForm(this);">-->
		  

			  <tr> 
				<td width="182"> 

				  <div align="right" class="Ver11">
					
					 				  
							Moving From<br>State:
					
					
				  </div>
				</td>
					<td valign="top"><p align="center">First, select origin state
        <div align="center">
      <select name="or_state" size="1" id="or_state" onChange="get(this);naNext();" style="width:170px;">
            <option value="">Select State</option>
<?
mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE 1 LIMIT 0, 100 '; 

$result = mysql_query($sql) or die("Query failed");
if (session_is_registered('o_state')) 
$or_state=$o_state;
// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";


echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
    
}

?>   
          </select>
<br>
<a href="javascript:showmap('or_state')" class="map">Pick from map</a> 
        </div>
				</tr>

		    <tr> 
		    <td> <p align="right">Second, select origin city<br>
        <div id="cityrec">
	  <i>
<?         if (session_is_registered('city'))
echo "if this is not your city, please re-select appropriate state from above.";
else
echo "if your city is not listed, please select nearest location.";
?>

</i></div></p></td>
					<td valign="top"> <div align="right"> 
         
<?         if (session_is_registered('city')) {
			$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `CityID`='$city' "; 
	$result = mysql_query($sql) or die("Query failed");	

	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$city_name=$line[city];
	}?>
		 <select name="or_city" size="7" id="or_city" style="width: 170px;" onChange="AllowNext('mov');">
		<option value="<?=$city?>" selected><?=$city_name?></option>
<?} else {?>
 <select name="or_city" size="7" id="or_city" style="width: 170px;" onChange="AllowNext('mov');">
<?}?>

            </select>
				<tr>			  
					<td width="182"> 
					  <div align="right" class="Ver11"><nobr>
					 						  
						Moving To:</nobr>
						</div>
					</td>
					<td colspan="2" class="Ver11"> 
							<select name="stateTo" id="to_state" label="State" onChange="AllowNext('mov');">
								<option value="">Select State</option>
<?
mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE 1 LIMIT 0, 100 '; 

$result = mysql_query($sql) or die("Query failed");
if (session_is_registered('d_state')) 
$or_state=$d_state;
// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";


echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
    
}

?>   

							</select>
					</td>
			  </tr>
			  

			  <tr> 
				<td width="182"> 
				  <div align="right" class="Ver11"><nobr>
					 					  
					Size of Move:</nobr>
				  </div>
				</td>
				<td colspan="2"> 

				  
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
				  </select>
				</td>
			  </tr>	
		

 
			  <tr> 
				<td width="182"> 
				  <div align="right"></div>
				</td>
				<td colspan="2"> 
				
				  <input type="submit" id="next" name="Submit" value="NEXT >>>" disabled class="button" STYLE="width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57">
				  
				  <input type="hidden" name="full" value="yes">
				</td>
			  </tr>
			</table>
		  </td>
		  <td width="10" background="/images/right_dot_line.gif"></td>
		</tr>
		<tr> 
		  <td colspan="3"><img src="/images/bottom_qq.gif" width="393" height="9"></td>
		</tr>

	  </table>
	 </table>
</form>
</div>
<? include_once "bottom_panel.php"; ?>
