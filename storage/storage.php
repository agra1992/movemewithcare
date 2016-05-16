<?php

session_start();
$customer_info=$_SESSION['customer_info'];
	error_reporting(0);
	require ('../config.inc.php');
	require ('../getfile.php');
	require_once "../mailer.php";
	include_once "../randchar_function.php";
	require_once "../top_panel.php";
$cryptinstall="../crypt/cryptographp.fct.php";
include $cryptinstall; 
	$link = mysql_connect($db_host, $db_user, $db_password) or die("Could not connect");
	mysql_select_db($db_name) or die("Could not select database");

$add=array(array());
$sql = 'Select Add_Number,Description, Image,Link From add_manager Where Add_Number>17 AND Add_Number<22';

$r = mysql_query($sql) or die("Query failed_LUPU $sql");
while($result = mysql_fetch_array($r, MYSQL_ASSOC))
{
    $add[$result[Add_Number]][0]=$result[Description];
    $add[$result[Add_Number]][1]=$result[Image];
    $add[$result[Add_Number]][2]=$result[Link];
}

	$autofill = false;


if($_GET[error]==true)
{

echo"<font color='#FF0000'>Sorry, That was the wrong captcha code</font></font>";
}
	
	function ComboList ($nStart, $nStop, $customer_info, $from)
	{

		$opt = "";
	    for ($nI=$nStart; $nI<=$nStop; $nI++)
	    {     
$sel="";
            if($from==1){
                    if($customer_info['Day']==$nI || $customer_info['Year'] ==$nI){
                        $sel="selected"; }
              }
             else{
                    if($customer_info['Day2']==$nI || $customer_info['Year2'] ==$nI){
                        $sel="selected"; }
              }

			$opt = $opt . "\n<option value='$nI' $sel>$nI";
		}
		return $opt;
	}

	function ComboList2 ($customer_info, $from)
	{
		$opt = "";
		$stack = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October","November", "December");
		$nI = "1";
		foreach($stack as $val)
		{
$sel="";
            if($from==1){
                if($customer_info['Month']==$nI ){
                    $sel="selected";}
              }
             else{
                if($customer_info['Month2']==$nI ){
                    $sel="selected";}
              }
			$opt = $opt . "\n<option value='$nI' $sel>$val";
			$nI++;
		}
		return $opt;
	}	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<TITLE>Storage PODS | Warehousing and storage services available nationwide by accredited and certified storage facilities | All storage units are monitored 24/7  | Movemewithcare.com is the storage network of your choice | FREE estimates at your convenience</title>
<META NAME="description" CONTENT="Storage has never been easier. MOVEMEWITHCARE is a network of over 900 storage facilities located all around the USA and Canada. It offers a convenient way to self store all your items with 24 hour monitoring at most locations. Some storage are available 24 hours/day. All sizes available. Serving all of USA and Canada">
<META NAME="keywords" CONTENT=" PODS storage, Door to Door, SAMS containers, 24 hours storage facility, crates, storage crates, storage facilities, accredited storage location, locating a storage facilities. Storage facilities located in Alabama,Arizona, Arkansas storage facility, California storage, Colorado  ,Connecticut, Delaware, Florida, Georgia ,Hawaii,Idaho,Illinois,Indiana,Iowa,Kansas,Kentucky,Louisiana,Maine,Maryland accredited storage facilities,Massachusetts,Michigan  storage locations,Minnesota,Mississippi,Missouri,Montana,Nebraska,Nevada,New Hampshire,New Jersey,New Mexico, New York warehouses,North Carolina shipping hub,North Dakota, Ohio,Oklahoma,Oregon,Pennsylvania self storage facilities, Rhode Island, South Carolina,South Dakota, Tennessee, Texas warehouse facilities,Utah,Vermont,Virginia shipping locations,Washington self storage units,Washington DC 24 hour monitored storage warehouses,West Virginia storage finders,Wisconsin self storage units reservations,Wyoming
Canadian Provinces, British Columbia, BC, Alberta, Manitoba, Saskatchewan, Ontario, Quebec, Newfoundland, Prince Edward Island, Yukon Territories.">
<META NAME="author" CONTENT="ProAce International, owner of Movemewithcare.com, the #1 Accredited and certified moving network for USA and Canada.">
<META NAME="Copyright" CONTENT="© 2006-2010 Movemewithcare.com. Nationwide accredited moving network. All Rights Reserved">
<META NAME="language" CONTENT="en-us">
<META NAME="classification" CONTENT=" nationwide moving and relocation, transportation, loading and unloading, storage and warehousing, packing supplies providers.">
<META NAME="distribution" CONTENT="nationwide">
<META NAME="revisit-after" CONTENT="30 days"> 
<META NAME="robots" CONTENT="ALL">

<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<link href="../tabs.css" rel="stylesheet" type="text/css">
<link href="../full_mov_list.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../add_style.css" />
<script language="JavaScript" src="../mov.js"></script>
<script language="JavaScript" src="../cal.js"></script>
<script type="text/javascript" src="../overlib_mini.js"></script>
<SCRIPT LANGUAGE="JavaScript">
function new_add_window(add_path)
{
    add_window=window.open(add_path, "Add Images", "width=300, height=150,scrollbars=yes,resizable=yes ,toolbar=yes")
    add_window.focus();
}

</SCRIPT>

<script type="text/javascript">

	function handleError()
	{
		return true;
	}	
	window.onerror = handleError;

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
		if (MUWCForm.or_state.selectedIndex == 0){
			errorMsg += "\n\Current State \t\t- Please specify the current state.";
		}		
		if (MUWCForm.or_city.selectedIndex == -1){
			errorMsg += "\n\Current City \t\t- Please specify the current city.";
		}
		if (MUWCForm.st_size.selectedIndex == 0){
			errorMsg += "\n\Storage Size \t\t- Please specify the storage size.";
		}		
		if (MUWCForm.dor_state.selectedIndex == 0) {
			errorMsg += "\n\Destination State \t\t- Please specify the destination state.";
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

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20%" valign="top" bgcolor="#EBFAED">
            <div align="center" style="padding:5px;" > <img src="../images/storage_facilities.gif" style="margin:5px auto;margin-left:18px" alt="storage_facilities"/></div><div style="padding:5px;" >
                <?
		$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 9';
  		$result = mysql_query($sql) or die("Query failed_Trans");
  		$line = mysql_fetch_array($result, MYSQL_ASSOC);
  		echo nl2br($line[Detail]);
	?>
            
        
            <?
	  if ($_SESSION['browser'] != "Mozilla") {
	  	echo "<br>";  
	  }
	?></div></td>
        <td width="2%">&nbsp;</td>
  <td width="78%"><div align="left" style="width:600px;height:950px!important;height:2px;padding-left:0px;padding-top:20px!important;padding-left:0px;font-family:Verdana;font-size:12px;color:black;font-size:12px;" >
            <form action="storage_action.php" method="post" name="form1" id="form1" onsubmit="return validate_form(this);">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" name="top" id="tab_gray_text">
                <tr>
                  <td width="63" align="left" valign="bottom">&nbsp;</td>
                  <td width="100">&nbsp;</td>
                <td height="19" width="100%" align="center" valign="bottom" colspan="2"><span id="tab_red_text">*Important: </span> <span id="tab_bold_text">Prior to submitting any request on this site, you confirm that you have read our TERMS OF SERVICE and accept them. Most of the storage facilities in our network are monitore 24/7 to provide secure location for your goods. Either climate on non-climate control units, our network can cater to every needs. Let our accredited network be aware of your storage needs.</span><br />
                      <h2 > <br />
                        Storage Facility Request Form</h2></td>
                  <td width="100">&nbsp;</td>
                  <td width="63" align="right" valign="bottom">&nbsp;</td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="6" id="tab_gray_text">
                <tr>
                  <td width="40%"><div id="err" style="visibility:visible;float:right;" align="left"></div></td>
                  <td width="60%">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right">Salutation:</div></td>
                  <td><select name="salut" id="salut" class="formobject" >
                      <? 
                          if($customer_info[salut] != "")
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
                  <td><div align="right">First name:</div></td>
                  <td><input name="fname" type="text" alt="First Name" class="formobject" id="fname" maxlength="100" <?if($autofill) {echo "value='$autofill.' '.$fname'";}else if($customer_info['fname']){echo "value=".$customer_info['fname']."";}?> /></td>
                </tr>
                <tr>
                  <td><div align="right">Last name:</div></td>
                  <td><input name="lname" type="text" alt="Last Name"class="formobject" id="lname" maxlength="100" <?if($autofill){ echo "value='$lname'";}else if($customer_info['lname']){echo "value=".$customer_info['lname']."";}?> /></td>
                </tr>
                <tr>
                  <td><div align="right">Current Street Address:</div></td>
                  <td><input name="address" type="text" alt="Address" class="formobject" id="address" maxlength="250" <?if($autofill) {echo "value='$address'";}else if($customer_info['address']){echo "value=".$customer_info['address']."";}?> /></td>
                </tr>
                <tr>
                  <td><div align="right">Current State/Province:</div></td>
                  <td><select name="or_state" size="1" id="or_state" onchange="get(this);" style="width: 170px; ">
                      <option value="">Select State/Province</option>
                      <?				
					$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999'; 				
					$result = mysql_query($sql) or die("Query failed_states");
					// showing all states
					while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {		
$sel="";	
                                                if($line[StateID] == $customer_info['or_state']){
                                                $sel="selected";
                                                }			
						if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";
						if ($line[StateID]!=52)
							echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
						else
							echo ("<option value=\"$line[StateID]\" $style $sel>$line[name]</option>");
					}					
				?>
                    </select>
                      <br />
                      <!--[if IE]>
				<a href="javascript:showmap('or_state');" class="map">Pick from map</a>		
				<![endif]-->
                  </td>
                </tr>
                <tr>
                  <td><div align="right">Current City:<br />
                          <i>If your city is not listed, select nearest location</i></div></td>
                  <td><?
                        if($customer_info['or_city']){
                                               
						$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `CityID`='".$customer_info['or_city']."' "; 
						$result = mysql_query($sql) or die("Query failed");	
						while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {	

							$city_name=$line[city];
                                                        $city=$line[CityID];
					}?>
                      <select name="or_city" size="7" id="or_city" style="width: 170px;">
                        <option value="<?=$city?>" selected="selected">
                        <?=$city_name?>
                        </option>
                      </select>
                      <? } else { ?>
                      <select name="or_city" size="7" id="or_city" style="width: 170px;">
                        <? } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><div align="right">ZipCode/Postal Code:</div></td>
                  <td><input name="zipcode" type="text" alt="Zip" id="zipcode" size="7" maxlength="7" class="formobject" <?if($autofill){ echo "value='$zipcode'";}else if($customer_info['zipcode']){echo "value=".$customer_info['zipcode']."";}?> /></td>
                </tr>
                <tr>
                  <td><div align="right">Phone number (work):</div></td>
                  <td><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif"> (
                    <input name="ph1" type="text" alt="Area Code" id="ph1" size="3" maxlength="3" class="formobject" onkeyup='Move(this,3,&quot;ph2&quot;,event,&quot;ph1&quot;)' <?if($autofill) {echo "value='$ph1'";}else if($customer_info['ph1']){echo "value=".$customer_info['ph1']."";}?> />
                    )
                    <input name="ph2" type="text" alt="Phone" id="ph2" size="3" maxlength="3" class="formobject" onkeyup='Move(this,3,&quot;ph3&quot;,event,&quot;ph1&quot;)' <?if($autofill) {echo "value='$ph2'";}else if($customer_info['ph2']){echo "value=".$customer_info['ph2']."";}?> />
                    -
                    <input name="ph3" type="text" id="ph3" size="4" maxlength="4" class="formobject" onkeyup='Move(this,4,&quot;ph3&quot;,event,&quot;ph2&quot;)' <?if($autofill){ echo "value='$ph3'";}else if($customer_info['ph3']){echo "value=".$customer_info['ph3']."";}?> />
                  </font></td>
                </tr>
                <tr>
                  <td><div align="right">Phone number (home):</div></td>
                  <td><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif"> (
                    <input name="ph4" type="text" alt="Area Code"id="ph4" size="3" maxlength="3" class="formobject" onkeyup='Move(this,3,&quot;ph5&quot;,event,&quot;ph4&quot;)' <?if($autofill) {echo "value='$ph4'";}else if($customer_info['ph4']){echo "value=".$customer_info['ph4']."";}?> />
                    )
                    <input name="ph5" type="text" alt="Phone" id="ph5" size="3" maxlength="3" class="formobject" onkeyup='Move(this,3,&quot;ph6&quot;,event,&quot;ph4&quot;)' <?if($autofill) {echo "value='$ph5'";}else if($customer_info['ph5']){echo "value=".$customer_info['ph5']."";}?> />
                    -
                    <input name="ph6" type="text" id="ph6" size="4" maxlength="4" class="formobject" onkeyup='Move(this,4,&quot;ph6&quot;,event,&quot;ph5&quot;)' <?if($autofill) {echo "value='$ph6'";}else if($customer_info['ph6']){echo "value=".$customer_info['ph6']."";}?> />
                  </font></td>
                </tr>
                <tr>
                  <td><div align="right">Email address:</div></td>
                  <td><input name="email" type="text" alt="E-Mail Address" id="email" class="formobject" <?if($autofill) {echo "value='$email'";}else if($customer_info['email']){echo "value=".$customer_info['email']."";}?> /></td>
                </tr>
                <tr>
                  <td><div align="right">Which state/province do you need storage?:</div></td>
                  <td><select name="dor_state" alt="Destination State" size="1" id="dor_state" style="width:170px; ">
                      <option value="">Select State/Province</option>
                      <?
					$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999 AND StateID != 68'; 					
					$result = mysql_query($sql) or die("Query failed");					
					// showing all states
					while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {					
$sel="";	

                                                if($line[StateID] == $customer_info['dor_state']){
                                                $sel="selected";
                                                }					
						if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";
						if ($line[StateID]!=52)
							echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
						else
							echo ("<option value=\"$line[StateID]\" $style $sel>$line[name]</option>");
					}
				?>
                    </select>
                      <br />
                      <!--[if IE]>
				<a href="javascript:showmap2('dor_state');" class="map">Pick from map</a>
				<![endif]-->
                  </td>
                </tr>
                <tr>
                  <td><div align="right">Start Date at Storage:<br />
                          <!--<i>yyyy-mm-dd</i>-->
                  </div></td>
                  <td><select name="Day">
                      <?  echo ComboList(1,31, $customer_info,1)?>
                    </select>
                      <select name="Month">
                        <?  echo ComboList2($customer_info,1)?>
                      </select>
                      <select name="Year">
                        <?  echo ComboList(2008,date("Y")+8, $customer_info,1)?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><div align="right">Finish Date at Storage: <br />
                          <!--<i>yyyy-mm-dd</i>-->
                  </div></td>
                  <td><select name="Day2">
                      <?  echo ComboList(1,31, $customer_info,2)?>
                    </select>
                      <select name="Month2">
                        <?  echo ComboList2($customer_info,2)?>
                      </select>
                      <select name="Year2">
                        <?  echo ComboList(2008,date("Y")+8, $customer_info,2)?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><div align="right">Storage Size:</div></td>
                  <td><select name="st_size" alt="Storage Size" size="1" id="st_size" style="width:170px; ">
                      <option value="0">Select size</option>
                      <option value="1" <? if($customer_info['st_size']==1) echo"selected";?>>A Studio</option>
                      <option value="2"<? if($customer_info['st_size']==22) echo"selected";?>>1 Bedroom</option>
                      <option value="3"<? if($customer_info['st_size']==3) echo"selected";?>>2 Bedroom</option>
                      <option value="4"<? if($customer_info['st_size']==4) echo"selected";?>>3 Bedroom</option>
                      <option value="5"<? if($customer_info['st_size']==5) echo"selected";?>>4 Bedroom</option>
                      <option value="6"<? if($customer_info['st_size']==6) echo"selected";?>>Larger than 4 Bedroom</option>
                    </select>
                      <br />
                    <a href="#" onclick="javascript:showsize1();return false;">Confused? We might help you understand your requirement , Click here.</a></td>
                </tr>
                <?php dsp_crypt(0,1); ?>
                <tr>
                  <td align="right">Enter the code:</td>
                  <td><input type="text" name="code" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr align="center">
                  <td colspan="2" align="center"><input type="submit" name="Submit" value="Request a storage provider" id="next" style="width:300px; font-size: small; font-family: Arial; color: #; background-color: #dceffe; border: 1 outset #;margin-right:50px;" /></td>
                </tr>
                <tr>
                  <td  colspan="2" width="10" background="../images/right_dot_line.gif"></td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
              </table>
            </form>
        </div></td>
      </tr>
    </table>
	<? include_once "../bottom_panel.php"; ?>
	