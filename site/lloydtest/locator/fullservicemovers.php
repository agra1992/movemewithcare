<?
session_start();
session_destroy();
error_reporting(0);
require("../config.inc.php");
require_once ('../seo.php');
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

<div style="float:left;width:150px;border:2px dotted;text-align:center;font-size:11px;font-family:Verdana;color:gray;margin-top:25px;">
<div style="margin:5px 5px 5px 5px;text-align:left;background-color:#EDFBEB;line-height:12pt;">
<img src="../images/fullservice_movers.gif" style="margin:5px auto;margin-left:18px" alt="fullservice_movers"/>
<? echo nl2br($line[Detail]); ?>
<!--<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> also provides you with Full service movers, either local or Long distance, providing you with services including: Packing, Loading, transportation, unloading and unpacking all your furniture in your new house or storage. This service is used when the customer wants a service that covers all aspect of a move. Let our professional movers handle it and let us make your relocation cost effective, time efficient and also very pleasant.
<br /> <br />
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> conducts business with industry professionals, who are accredited, licensed and insured, and most of all who can commit to unmatched customer service. 
With just few minutes of your time, we'll help you make your relocation request a successful and enjoyable one! -->
</div>
</div>

<div id="main_side_add">
<b id='title'>Sponsored Links</b>
<?
for($i=11; $i<14; $i++)
{
     echo"<div id='add_cell'>
    <div id='add_number'>
     Advertisement $i<br></div>";
        if($add[$i][1] != ""){
             echo"<a href='http://".$add[$i][2]."'><img src='../adds/".$add[$i][1]."' width='150'></a><br>";
        } elseif($add[$i][2] != ""){
        echo "<a href='http://".$add[$i][2]."'>http://".$add[$i][2]."</a><br>";
        echo @nl2br($add[$i][0]); 
        echo" </br>";

    }
    else{
        echo"This Add Space is Available";}

echo"</div>";
}
?>
</div>


	<div align="left" style="width:400px;height:850px!important;height:2px;padding-left:0px;padding-top:20px!important;padding-left:0px;font-family:Verdana;font-size:12px;color:black;font-size:12px;" >
	
<br>

<form action="fullmovers.php" method="post" name="form1"  onSubmit="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" name="quick_quote" id="tab_gray_text">

 
  <tr>
					<td width="393" align="center" valign="top">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" name="get_quick_quote" align="center">
		<tr> 
		  <td colspan="3">
			<table width="393" border="0" cellspacing="0" cellpadding="0" name="top" align="center">
				<tr>
					<td width="63" align=left valign=bottom><img src="../images/top_qq_left.gif" width="63" height="19"></td>
					<td width="268" height="19" align=center valign=bottom>
						<h2>Full Service Move Quick Quote</h2>
					</td>
					<td width="63" align=right valign=bottom><img src="../images/top_qq_right.gif" width="63" height="19"></td>
				</tr>
			</table>
		  </td>
		</tr>
		<tr> 
		  <td width="10" background="../images/left_dot_line.gif"></td>
								<td width="373" height="220" align="center" valign="middle"> 
			<table width="380" border="0" cellspacing="0" cellpadding="8" >
				<tr>
					<td colspan=3>
					    <div align="center"><span id="tab_red_text">*Important: </span>
          <span id="tab_bold_text">Prior to submitting any request on this site, you confirm that you have read our TERMS OF SERVICE and accept them.</span></div><br>						
						</div>
					</td>
				</tr>		  
	
				<tr>
				
				</tr>
			  <tr> 
				<td valign="bottom" width="182"> 

				  <div align="right" class="Ver11">
					
					 				  
							Moving From<br>State/Province:
					
					
				  </div>
				</td>
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
				
            <tr>
            </tr>

            <tr>			  
					<td width="182"> 
					  <div align="right" class="Ver11"><nobr>
					 						  
						Moving To<br>State/Province:
						</div>
					</td>
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
					Size of Move:
				  </div>
				</td>
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
				  </select></p>
				</td>
			  </tr>	
		

 
			  <tr> 
				<td width="182"> 
				  <div align="right"></div>
				</td>
				<td colspan="2"> 
				
				  <input type="submit" id="next" name="Submit" value="NEXT >>>" disabled class="button" STYLE="width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57">
				  
				  <input type="hidden" name="full" value="yes">
				  <input type="hidden" name="direction" id="direction" value="">
				</td>
			  </tr>

			</table>
		  </td>



	  </table>
	 </table>
</form>
</div>
<? include_once "../bottom_panel.php"; ?>
