<?php
session_start();

$customer_info=$_SESSION['customer_info'];
	
set_time_limit(60*60*60);
require ('../config.inc.php');
require ('../getfile.php');
require ('../seo.php');
require_once "../mailer.php";
include_once "../randchar_function.php";
require_once "../top_panel.php";
$cryptinstall="../crypt/cryptographp.fct.php";
include $cryptinstall; 
	$autofill = false;
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");

$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 6';
$result = mysql_query($sql) or die("Query failed_LUPU");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$add=array(array());
$sql = 'Select Add_Number,Description, Image,Link From add_manager Where Add_Number>6 AND Add_Number<11';

$r = mysql_query($sql) or die("Query failed_LUPU $sql");
while($result = mysql_fetch_array($r, MYSQL_ASSOC))
{
    $add[$result[Add_Number]][0]=$result[Description];
    $add[$result[Add_Number]][1]=$result[Image];
    $add[$result[Add_Number]][2]=$result[Link];
}

function ComboList ($nStart, $nStop, $customer_info)
	{
		$opt = "";
	    for ($nI=$nStart; $nI<=$nStop; $nI++)
	    {     
$sel="";

if($customer_info['Day']==$nI || $customer_info['Year'] ==$nI){
$sel="selected"; }
			$opt = $opt . "\n<option value='$nI' $sel>$nI";
		}
		return $opt;
	}

	function ComboList2 ($customer_info)
	{
		$opt = "";
		$stack = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October","November", "December");
		$nI = "1";
		foreach($stack as $val)
		{
$sel="";
if($customer_info['Month']==$nI){
$sel="selected";}
			$opt = $opt . "\n<option value='$nI' $sel>$val";
			$nI++;
		}
		return $opt;
	}	


?>
<link rel="stylesheet" type="text/css" href="../tabs.css" />
<link rel="stylesheet" type="text/css" href="../add_style.css" />
<script language="JavaScript" src="../mov.js"></script>
<script language="JavaScript" src="../cal.js"></script>
<script type="text/javascript" src="../overlib_mini.js"></script>
<SCRIPT LANGUAGE="JavaScript">
function new_add_window(add_path)
{
    add_window=window.open(add_path, "Add Widnow")
    add_window.focus();
}

</SCRIPT>
<script type="text/javascript">
<!-- //

function handleError() {
	return true;
}

window.onerror = handleError;
//-->
</script>

<? 
if(!empty($customer_info)){
echo "<a><font color='#FF0000'>Sorry, That was the wrong captcha code</font></a>";
$or_state=$customer_info['or_state'];
$or_city=$customer_info['or_city'];
$samecity=$customer_info['samecity'];
$or_pack=$customer_info['or_pack'];
$or_load=$customer_info['or_load'];
$or_none=$customer_info['or_none'];
$ServiceSelector=$customer_info['ServiceSelector'];
$dor_state=$customer_info['dor_state'];
$dor_city=$customer_info['dor_city'];
$dor_pack=$customer_info['dor_pack'];
$dor_load=$customer_info['dor_load'];
$dor_none=$customer_info['dor_none'];
$dor_pack1=$customer_info['dor_pack1'];
$dor_load1=$customer_info['dor_load1'];
$full=$customer_info['full'];
$transport=$customer_info['transport'];
}
else{
$or_state=$_POST[or_state];
$or_city=$_POST[or_city];
$samecity=$_POST[samecity];
$or_pack=$_POST[or_pack];
$or_load=$_POST[or_load];
$or_none=$_POST[or_none];
$ServiceSelector=$_POST[ServiceSelector];
$dor_state=$_POST[dor_state];
$dor_city=$_POST[dor_city];
$dor_pack=$_POST[dor_pack];
$dor_load=$_POST[dor_load];
$dor_none=$_POST[dor_none];
$dor_pack1=$_POST[dor_pack1];
$dor_load1=$_POST[dor_load1];
$full=$_POST[full];
$transport=$_POST[transport];
}
?>
<script language="javascript"> 
function switchlabors(number) {

switch(number)
{
case "1": number=225;break;
case "2": number=340;break;
case "3": number=400;break;
case "4": number=480;break;
case "5": number=640;break;
default: number=0;
}
a="<font color='130d57' size='-1' face='Arial, Verdana'> x 3 hours = $" + number  + "*" + "</font>";
switch(number)
{
case 225: number=55;break;
case 340: number=80;break;
case 400: number=90;break;
case 480: number=105;break;
case 640: number=120;break;
default: number=0;
}
b="$"+ number + " / hour"

z="<font color='130d57' size='-1' face='Arial, Verdana;'>Including MUWC Deposit: $" + number + "</font> ";
document.getElementById('total').innerHTML=a;
document.getElementById('additional').innerHTML=b;
document.getElementById('MUWC').innerHTML=z;

}

function radio_button_checker(fr)
{
// set var radio_choice to false
var radio_choice = false;

// Loop from zero to the one minus the number of radio button selections
for (counter = 0; counter < fr.card.length; counter++)
{
// If a radio button has been selected it will return true
// (If not it will return false)
if (fr.card[counter].checked)
radio_choice = true; 
}

if (!radio_choice)
{
// If there were no selections made display an alert box 
document.getElementById("err").innerHTML = document.getElementById("err").innerHTML +
"<ul style='color:red;font-size:11px'><li> Select card type </li></ul>";
return (false);
}
return (true);
}

-->

</script>

<script type="text/javascript">


function validate_form(MUWCForm)
{
    var errorMsg = "";	
    
	if (MUWCForm.fname.value.trim()==""){
		errorMsg += "\n\First Name \t\t- Please provide your First Name.";
	}
	if (MUWCForm.lname.value.trim()==""){
		errorMsg += "\n\Last Name \t\t- Please provide your Last Name.";
	}
	if (MUWCForm.address.value.trim()==""){
		errorMsg += "\n\Address \t\t\t- Please provide your Address.";
	}	
	if (MUWCForm.or_state.selectedIndex == 0){
		errorMsg += "\n\Current State \t\t- Please specify the current state.";
	}		
	if (MUWCForm.or_city.selectedIndex == -1){
		errorMsg += "\n\Current City \t\t- Please specify the current city.";
	}
	if (MUWCForm.email.value.trim()==""){
		errorMsg += "\n\EMail Address \t\t- Please provide your EMail Address.";
	}
	else if (echeck(MUWCForm.email.value.trim())==false)
	{
		errorMsg += "\n\EMail Address \t\t\t- Incorrect EMail Address.";
	}
	if (MUWCForm.zipcode.value.trim()==""){
		errorMsg += "\n\Zip Code \t\t\t- Please provide your Zip Code.";
	}
	else if (validateZIP(MUWCForm.zipcode.value) == false){
			errorMsg += "\n\Zip Code \t\t\t- Invalid Zip Code.";
	}	
	
	// commented out by tj 2007.10.18 00.09
	/*if ((MUWCForm.serv1[0].checked == false) && (MUWCForm.serv1[1].checked == false)){
		errorMsg += "\n\Type of Move \t\t- Please specify the type of Move: Local or Long Distance";
	}*/
	
	if (MUWCForm.credit.value.trim()==""){
		errorMsg += "\n\Credit Card \t\t- Please provide your Credit Card Number.";
	}	
	else if (isInteger(MUWCForm.credit.value, 4) == false){
		errorMsg += "\n\Credit Card \t\t- Please provide last 4 digits of your Credit Card.";
	}	
	if ((MUWCForm.card[0].checked == false) && (MUWCForm.card[1].checked == false) && (MUWCForm.card[2].checked == false)){
		errorMsg += "\n\Type of Credit Card \t- Please specify the type of your Credit Card.";
	}
	if ((MUWCForm.ph1.value.trim()=="") || (MUWCForm.ph2.value.trim()=="") || (MUWCForm.ph3.value.trim()=="")){
		errorMsg += "\n\Phone number(Work) \t- Please provide your phone number at work.";
	}
	else if (isInteger(MUWCForm.ph1.value,3) == false || isInteger(MUWCForm.ph2.value,3) == false || isInteger(MUWCForm.ph3.value,4) == false){
		errorMsg += "\n\Phone number(Work) \t- Please provide 10 digits of your phone number at work";
	}
	if ((MUWCForm.ph4.value.trim()=="") || (MUWCForm.ph5.value.trim()=="") || (MUWCForm.ph6.value.trim()=="")){
		errorMsg += "\n\Phone number(Home) \t- Please provide your phone number at home.";
	}	
	else if (isInteger(MUWCForm.ph4.value,3) == false || isInteger(MUWCForm.ph5.value,3) == false || isInteger(MUWCForm.ph6.value,4) == false){
		errorMsg += "\n\Phone number(Home) \t- Please provide 10 digits of your phone number at home";
	}
	
	
	if (errorMsg != ""){
		msg = "____________________________________________________________________\n\n";
		msg += "There are problem(s) with the form.\n";
		msg += "Please correct the problem(s) and re-submit the form.\n";
		msg += "____________________________________________________________________\n\n";
		msg += "The following field(s) need to be corrected: -\n";
		
		errorMsg += alert(msg + errorMsg + "\n\n");
		return false;
	}
	
	return true; 
	
}

</script>

<style type="text/css">
<!--
.style1 {font-family: Arial, Verdana;}
-->
</style>
<link href="full_mov_list.css" rel="stylesheet" type="text/css">

<div style="float:left;width:150px;border:2px dotted;text-align:center;font-family: Arial, Verdana; font-size: 12px; color:gray;margin-top:25px;margin:0px 0px 100px 0px">
<div style="margin:5px 5px 5px 5px;text-align:left;background-color:#dceffe;line-height:12pt;">
<img src="../images/loadingunloading.gif" style="margin:5px auto;margin-left:18px" alt="fullservice_movers"/>
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
for($i=7; $i<11; $i++)
{
     echo"<div id='add_cell'>
    <div id='add_number'>
     Advertisement $i<br></div>";
        if($add[$i][1] != ""){
             echo"<a href='http://".$add[$i][2]."'><img src='../adds/".$add[$i][1]."' width='150'></a><br>";
        }
    elseif($add[$i][2] != ""){
        echo"<a href='http://".$add[$i][2]."'>http://".$add[$i][2]."</a><br>";
        echo @nl2br($add[$i][0]); 
        echo" </br>";

    }
    else{
        echo"This Add Space is Available";}

echo"</div>";
}
?>
</div>

<div align="left" style="width:300px;height:1100px!important;height:1300px;padding-left:0px;padding-top:20px!important;padding-left:0px;font-family: Arial, Verdana; font-size: 12px; color:Gray;" >
  <form action="fulllupu_action.php" method="post" name="form1" onsubmit="return validate_form(this);">
 <table width="393" border="0" cellspacing="0" cellpadding="0" name="top" style="margin-left:60px;font-family:Arial, Verdana;color:Gray;position:absolute; left:170px;top:190px ">
				<tr>
 
				<td width="63" align=left valign=bottom><img src="../images/top_qq_left.gif" width="63" height="19"></td>
										<td width="100"><img src="../images/spacer.gif" width="50px" height="1px" /></td>
					<td height="19" width="100%" align=center valign=bottom colspan="2">
						<h2 >
	<? 
	echo "Loading/Unloading Service Provider Request Form";
	?>
</h2>
					</td>
					<td width="100"><img src="../images/spacer.gif" width="50px" height="1px" /></td>
					<td width="63" align=right valign=bottom><img src="../images/top_qq_right.gif" width="63" height="19"></td>
				</tr>
</table>
			<table width="60%" border="0" cellspacing="0" cellpadding="4" style="position:absolute; left:170px;top:250px">
	 <a name="top">		
   <tr>
   <td width="41%"> <div id="err" style="visibility:visible;float:right;" align="left"></div></td>
   <td >&nbsp;   </td>
   </tr>
	
    <tr> 
      <td width="41%"><div align="right">Salutation:</div></td>
      <td width="59%" align="left"><select name="salut" id="salut" class="formobject" >
          <? 
if($customer_info['salut'] != "")
                          {
                              echo"<option value='".$customer_info['salut']."' selected>".$customer_info['salut']."</option>";
                          }
                  if(($autofill) && ($salut))
		  echo "<option value=$salut selected> $salut </option>";
		  else { ?>
		  <option value="Mr.">Mr.</option>
          <option value="Mrs.">Mrs.</option>
          <option value="Ms.">Ms.</option>
		  <? } ?>
        </select></td>
    </tr>
    <tr> 
      <td><div align="right">First 
          name:</div></td>
      <td align="left"><input name="fname" type="text" alt="First Name" class="formobject" id="fname" maxlength="100" <?if($autofill) {echo "value='$fname'";}else if($customer_info['fname']){echo "value=".$customer_info['fname']."";}?>></td>
    </tr>
    <tr> 
      <td><div align="right">Last 
          name:</div></td>
      <td align="left"><input name="lname" type="text" alt="Last Name"class="formobject" id="lname" maxlength="100"<?if($autofill){ echo "value='$lname'";}else if($customer_info['lname']){echo "value=".$customer_info['lname']."";}?>></td>
    </tr>
    <tr> 
      <td><div align="right">Current Street Address:</div></td>
      <td align="left"><input name="address" type="text" alt="Address" class="formobject" id="address" maxlength="250" <?if($autofill) {echo "value='$address'";}else if($customer_info['address']){echo "value=".$customer_info['address']."";}?>></td>
    </tr>
    <!-- start by Tj -->
    <tr>
        <td colspan='2'>
                <span id="tab_bold_text">
                        If not correct city or state/province: <br>
                        Please go back to step ONE by clicking on 
                        <a href="javascript:history.go(-3)"
                                style='font:10pt arial bold'> here </a>.</span>
        </td>
    </tr>
    <!-- end -->
	<tr>
   <td><div align="right">Current State/Province:</td>
 
<td align="left">
 <span id="tab_bold_text">
      <!--select name="or_state" size="1" id="or_state" onChange="get(this);" style="width: 170px; ">
            <option value="">Select State/Province</option-->
<?


$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999 AND StateID!=68'; 

$result = mysql_query($sql) or die("Query failed1");

// showing all states
// comment out by tj
/*
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        if ($or_state==$line[StateID] || $customer_info['or_state']==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

        if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";


        if ($line[StateID]!=52)
	       echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
        else
	       echo ("<option value=\"$line[StateID]\" $style $sel>$line[name]</option>");    
}*/
// start by tj

        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                if ($or_state==$line[StateID] || $customer_info['or_state']==$line[StateID]) { 
                        echo "<b>" . $line['name'] . "</b>";
                        ?><input type='hidden' name="or_state" value='<?=$line['StateID'];?>'><?    
                        break;
                }
        }                                        

// end by tj

?>  	
  </select>
</span>
        </td>
<br>
    </tr>
	<tr> 
      <td align="left"><div align="right">Current City:<br />         <div id="cityrec">
	  <i>
<?         if (session_is_registered('or_city'))
                echo "if this is not your city, please re-select appropriate state from above.";
         else {
                // comment out by tj 2007.10.18 00.37
                //echo "if your city is not listed, please select nearest location.";
        }                
?>
</i></div></p></td>
					<td valign="top" align="left"> <div align="left"> 
         <span id="tab_bold_text">
<?
	$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `CityID`='$or_city' "; 
	$result = mysql_query($sql) or die("Query failed2");	

	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$city_name = $line[city];
?>
	 
	<!--<select name="or_city" size="7" id="or_city" style="width: 170px;" onChange="AllowNext();">
		<option value="<?=$or_city?>" selected><?=$city_name?></option></select>-->
        <b><?=$city_name;?></b>		
        <input type='hidden' name='or_city' value='<?=$or_city?>'>
</span>
</td>
    </tr>
    <tr> 
      <td><div align="right">ZipCode/Postal Code:</div></td>
      <td align="left"><input name="zipcode" type="text" alt="Zip" id="zipcode" size="7" maxlength="7" class="formobject" <?if($autofill) {echo "value='$zipcode'";}else if($customer_info['zipcode']){echo "value=".$customer_info['zipcode']."";}?>></td>
    </tr>
    <tr> 
      <td><div align="right">Phone number(work):</div></td>
      <td align="left"><font size="-1" face="Verdana,Arial, Helvetica, sans-serif">( 
        <input name="ph1" type="text" alt="Area Code" id="ph1" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph2",event,"ph1")'  <?if($autofill) {echo "value='$ph1'";}else if($customer_info['ph1']){echo "value=".$customer_info['ph1']."";}?>>
        ) 
        <input name="ph2" type="text" alt="Phone" id="ph2" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph3",event,"ph1")' <?if($autofill) {echo "value='$ph2'";}else if($customer_info['ph2']){echo "value=".$customer_info['ph2']."";}?>>
        - 
        <input name="ph3" type="text" id="ph3" size="4" maxlength="4" class="formobject" onKeyUp='Move(this,4,"ph3",event,"ph2")'    <?if($autofill) {echo "value='$ph3'";}else if($customer_info['ph3']){echo "value=".$customer_info['ph3']."";}?>></td>
    </tr>
	<tr> 
      <td><div align="right">Phone number(home):</div></td>
      <td align="left"><font size="-1" face="Verdana,Arial, Helvetica, sans-serif">( 
        <input name="ph4" type="text" alt="Area Code" id="ph4" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph5",event,"ph4")' <?if($autofill){ echo "value='$ph4'";}else if($customer_info['ph3']){echo "value=".$customer_info['ph3']."";}?>>
        ) 
        <input name="ph5" type="text" alt="Phone" id="ph5" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph6",event,"ph4")' <?if($autofill) {echo "value='$ph5'";}else if($customer_info['ph5']){echo "value=".$customer_info['ph5']."";}?>>
        - 
        <input name="ph6" type="text" id="ph6" size="4" maxlength="4" class="formobject" onKeyUp='Move(this,4,"ph6",event,"ph5")' <?if($autofill){ echo "value='$ph6'";}else if($customer_info['ph6']){echo "value=".$customer_info['ph6']."";}?>></td>
    </tr>
    <tr> 
      <td><div align="right">Email address:</div></td>
      <td align="left"><input name="email" type="text" alt="E-Mail Address" id="email" class="formobject" <?if($autofill) {echo "value='$email'";}else if($customer_info['email']){echo "value=".$customer_info['email']."";}?>></td>
    </tr>
		
<!---   start by tj 2007.10.18 00.13        	
	<tr><td><div align="right">Type of Move:<br>
	    </div></td>
	  <td align="left">
	  <? if($autofill)
		{
			if($typemove=="Local")
			$sel1 = "checked";
			else if($typemove=="Long")
			$sel2 = "checked";
			else{
			$sel1 = "";
			$sel2 = "";}
		}
		?>
	  
          	
	  <font face="Verdana,Arial, Helvetica, sans-serif" size="-1">
	  <input type="radio" value="0" name="serv1" id="serv1" alt="Type Of Move" <?=$sel1?>><label for="serv1">Local</label><br>
	  <input type="radio" value="1" name="serv1" id="serv2" alt="Type Of Move" <?=$sel2?>><label for="serv2">Long Distance</label>
	  </font>
	  
	  
	  </td>
    </tr>
end by tj --->    

	 

	<tr><td align="left"><div align="right">Destination State/Province :<br>
	    </div></td>

		<td align="left">
		<?
		$sql = "SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE stateID='".$dor_state."' "; 
		$result = mysql_query($sql) or die("Query failed3");

		// showing all states
		$line = mysql_fetch_array($result, MYSQL_ASSOC)
		/*<!--[if IE]>
		<a href="javascript:showmap('or_state');">Pick from map</a>
		<![endif]-->
		*/

		?>  	
		<input type="text" name="txt_destinationstate" id="txt_destinationstate" value="<?php echo $line['name']; ?>" disabled></input>
		<br>
		</td>	
	</tr>
	
	<tr><td align="left"><div align="right">
Destination City :<br>
	    
</div></td>

		<td align="left">
		<?		
		$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `CityID`='".$dor_city."' "; 
		$result = mysql_query($sql) or die("Query failed4");

		// showing all states
		$line = mysql_fetch_array($result, MYSQL_ASSOC)
		/*<!--[if IE]>
		<a href="javascript:showmap('or_state');">Pick from map</a>
		<![endif]-->
		*/

		?>  	
		<input type="text" name="txt_destinationcity" id="txt_destinationcity" value="<?php echo $line['city']; ?>" disabled></input>
		<br>
		</td>	</tr>

	<input type="hidden" name="from" value="fulllupu" id="from" />

<tr><td>
<div align="right">

Estimate Date of Moving: <br>
<!--<i>yyyy-mm-dd</i>-->
</font></div>
</td><td align="left">
         <select name="Day">
          <?  echo ComboList(1,31, $customer_info)?>
        </select> <select name="Month">
          <?  echo ComboList2($customer_info)?>
        </select> <select name="Year">
          <?  echo ComboList(2008,date("Y")+4,$customer_info)?>
        </select>
<!--<input name="st_date" type="text" style="margin-left:0px;" alt="Estimate Date of Moving" id="email" class="formobject" size="10" maxlength="10">-->
<!--<input name="st_date" type="text" style="margin-left:0px;" alt="Estimate Date of Moving" id="email" class="formobject" size="10" maxlength="10" readonly onMouseOver="overlib('Please click on the calendar link to the right and choose a date from pop-up calendar.');return true;" onMouseOut="window.status=''; nd(); return true;">
<a href="javascript:show_calendar('form1.st_date');" onMouseOver="window.status='Date Picker'; overlib('Click here to choose a date from pop-up calendar.'); return true;" onMouseOut="window.status=''; nd(); return true;">Pick from calendar</a> -->
</td></tr>
<tr><td>
<div align="right">

Quantity of labors you need:

</div>
</td><td align="left">
<select name="labors" id="labors" class="formobject" onChange="switchlabors(this.value)">
          <option value="1" <? if($customer_info['labors']==1)echo"selected";?>>1 labor</option>
          <option value="2" <? if($customer_info['labors']==2)echo"selected";?>>2 labors</option>
          <option value="3" <? if($customer_info['labors']==3)echo"selected";?>>3 labors</option>
          <option value="4" <? if($customer_info['labors']==4)echo"selected";?>>4 labors</option>
          <option value="5" <? if($customer_info['labors']==5)echo"selected";?>>5 labors</option>
        </select>
<span id="total">                                                                            

 x 3 hours = $340*
</span>
&nbsp;&nbsp;
<span id="MUWC">                                                                            

Including MUWC Deposit: $80
</span>

</td></tr><tr>
<td>&nbsp;</td>
<td>
<sup>*</sup>Includes 3 hours labor plus the one hour travel time. Additional hours after the three is <span id='additional'>$80 / hour </span><br><br>
<strong><span id="tab_bold_text">Note:</span></strong> If you request moving services(Packing, Loading and Unloading, Unpacking) in different states or different moving agent provides service for your move, then you will be requested to pay two separate deposits. Our customer sales representative will provide you with details.<br><br>Packing, Loading/Unloading, unpacking are considered one type of service if provided by one moving agent within the same state. Only ONE deposit is required in this case. 
</td>
</tr>
    <tr> 
      <td><div align="right">
Last 4 digits of your credit card number:<br>
You won`t be directly charged.<br /><a href="#" onclick="javascript:showpolicy();return false;"><!--Credit Card Privacy Terms-->Why we ask that?</a></div></td>
      <td align="left">
<input name="credit" type="password" id="credit" size="14" maxlength="4" class="formobject"><br>

<input type="radio" name="card" value="visa" id="visa"><label for="visa">Visa</label>
<input type="radio" name="card" value="mastercard" id="mastercard"><label for="mastercard">MasterCard</label>
<input type="radio" name="card" value="discover" id="discover"><label for="discover">Discover</label></td>
    </tr>  
<?php dsp_crypt(0,1); ?>
  <tr><td align="right">Enter the code:</td><td><input type="text" name="code"></td></tr>		
  <tr align="center"><td>&nbsp;</td><td align="left"><input type="submit" name="Submit" value="Request a Loading/UnLoading Service Provider" id="next" STYLE="width: 320px; font-size: x-small; font-family: Arial; color: #; background-color: #dceffe; border: 1 outset #;margin-right:50px;"></td></tr>
<tr> 
 <td width="41%" background="images/right_dot_line.gif"></td>
		</tr>



  </table>	

<input type="hidden" name="or_pack" value=<?=$or_pack ?>>
<input type="hidden" name="or_load" value=<?=$or_load ?>>
<input type="hidden" name="or_none" value=<?=$or_none ?>>
<input type="hidden" name="dor_none" value=<?=$dor_none ?>>
<input type="hidden" name="ServiceSelector" value=<?=$ServiceSelector ?>>
<input type="hidden" name="samecity" value=<?=$samecity?>>
<input type="hidden" name="transport" value=<?=$transport?>>
<input type="hidden" name="dor_pack" value=<?=$dor_pack ?>>
<input type="hidden" name="dor_load" value=<?=$dor_load ?>>
<input type="hidden" name="dor_state" value=<?=$dor_state ?>>
<input type="hidden" name="dor_city" value=<?=$dor_city ?>>
<input type="hidden" name="transport" value=<?=$transport ?>>
<input type="hidden" name="full" value=<?=$full ?>>

</form>
    <style type="text/css">
    #bottom_shift{position:absolute; top:1220px; right:0px;}
    </style>
<!--[if IE 6]>
    <style type="text/css">
    #bottom_shift{position:absolute; top:1420px; right:0px;}
    </style>
<![endif]-->
<!--[if IE 7]>
    <style type="text/css">
    #bottom_shift{position:absolute; top:1275px; right:0px;}
    </style>
<![endif]-->
<div id="bottom_shift">

<? include_once "../bottom_panel.php"; ?>

</div>
