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
$sql = 'Select Add_Number,Description, Image,Link From add_manager Where Add_Number>25 AND Add_Number<30';

$r = mysql_query($sql) or die("Query failed_LUPU $sql");
while($result = mysql_fetch_array($r, MYSQL_ASSOC))
{
    $add[$result[Add_Number]][0]=$result[Description];
    $add[$result[Add_Number]][1]=$result[Image];
    $add[$result[Add_Number]][2]=$result[Link];
}
if($_GET[error]==true)
{
echo"<font color='#FF0000'>Sorry, That was the wrong captcha code</font>You Put in The Wrong Captcha Code</font>";
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
	
	$autofill = false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<TITLE> Packing supplies available at affordable prices from Movemewithcare.com | Nationwide packing suppliers providers key quality supplies to help you move efficiently by protecting all your belongings </title>
<META NAME="description" CONTENT="Packing Services - Get free quotes on packing services and packing supplies from a network of accredited and certified packing providers for USA and Canada. Movemewithcare packing supplies network. Available shipping nationwide">
<META NAME="keywords" CONTENT="packing supplies, boxes, schrink wrap, tape, book boxes, large boxes, wardrobe boxes, marker, medium boxes, dishpack boxes, dishware, packing help, packing services, pack and load, loading packing supplies.">
<META NAME="author" CONTENT="ProAce International, owner of Movemewithcare.com, the #1 Accredited and certified moving network for USA and Canada.">
<META NAME="Copyright" CONTENT="� 2006-2010 Movemewithcare.com. Nationwide accredited moving network. All Rights Reserved">
<META NAME="language" CONTENT="en-us">
<META NAME="classification" CONTENT=" nationwide moving and relocation, transportation, loading and unloading, storage and warehousing, packing supplies providers.">
<META NAME="distribution" CONTENT="nationwide">
<META NAME="revisit-after" CONTENT="30 days"> 
<META NAME="robots" CONTENT="ALL">

<link href="../full_mov_list.css" rel="stylesheet" type="text/css">
<link href="../tabs.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../add_style.css" />
<script language="JavaScript" src="../mov.js"></script>
<script language="JavaScript" src="../cal.js"></script>
<SCRIPT LANGUAGE="JavaScript">
function new_add_window(add_path)
{
    add_window=window.open(add_path, "Add Images", "width=300, height=150,scrollbars=yes,resizable=yes ,toolbar=yes")
    add_window.focus();
}

</SCRIPT>

<script type="text/javascript" src="../overlib_mini.js"></script>
<?
echo"
<script type='text/javascript'>
document.images.cryptogram.src='".$_SESSION['cryptdir']."/cryptographp.php?cfg=".$cfg."&".SID."&'+Math.round(Math.random(0)*1000)+1
</script>
";?>
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
		if (MUWCForm.dor_state.selectedIndex == 0) {
			errorMsg += "\n\Destination State \t\t- Please specify the destination state.";
		}
		if (!MUWCForm.materials[0].selected && !MUWCForm.materials[1].selected && !MUWCForm.materials[2].selected) {
			errorMsg += "\n\Packing Materials \t\t- Please specify the materials.";
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

	<link href="../style.css" rel="stylesheet" type="text/css" />
<div >
  <form action="packing_action.php" method="post" name="form1" id="form1" onsubmit="return validate_form(this);">
    <table width="1000" border="0" cellspacing="0" cellpadding="0">
    <tr>
          <td width="140" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="104" bgcolor="#D9FBE7"><div  align="justify" style="padding:10px;">
                <div >
                  <div align="center"><img src="../images/packing_facilities.gif" alt="storage_facilities"/></div>
                </div>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#D9FBE7">
                <div align="justify" style="padding:10px;">
                  <?
		$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 10';
  		$result = mysql_query($sql) or die("Query failed_Trans");
  		$line = mysql_fetch_array($result, MYSQL_ASSOC);
  		echo nl2br($line[Detail]);
	?>                
                  <?
	  if ($_SESSION['browser'] != "Mozilla") {
	  	echo "<br>";  
	  }
	?>
                </div></td>
            </tr>
          </table></td>
        <td width="860" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" style="padding:3px;"><strong style="color:#FF0000">*Important:</strong> 
                <div align="center">Prior to submitting any request on this site, you confirm that you have read our TERMS OF SERVICE and accept them.All our network member provides quality packing and moving supplies to help you protect your belongings. Packing TIPS can be provided by our qualified moving associates at Movemewithcare.com for FREE.</span><br />
              </div>
                <h2 align="center" >
              Packing Materials Request Form</h2></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="center"><table width="85%" border="0" cellspacing="0" cellpadding="0" id="tab_gray_text2">
                <tr>
                  <td width="32%"><div align="right">Salutation:&nbsp; </div></td>
                  <td width="68%" align="left"><select name="salut" id="salut" class="formobject" >
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
                  <td><div align="right">First name:&nbsp; </div></td>
                  <td align="left"><input name="fname" type="text" alt="First Name" class="formobject" id="fname" maxlength="100" <?if($autofill) {echo "value='$autofill.' '.$fname'";}else if($customer_info['fname']){echo "value=".$customer_info['fname']."";}?> /></td>
                </tr>
                <tr>
                  <td><div align="right">Last name:&nbsp; </div></td>
                  <td align="left"><input name="lname" type="text" alt="Last Name"class="formobject" id="lname" maxlength="100" <?if($autofill){ echo "value='$lname'";}else if($customer_info['lname']){echo "value=".$customer_info['lname']."";}?> /></td>
                </tr>
                <tr>
                  <td><div align="right">Current Street Address:&nbsp; </div></td>
                  <td align="left"><input name="address" type="text" alt="Address" class="formobject" id="address" maxlength="250" <?if($autofill) {echo "value='$address'";}else if($customer_info['address']){echo "value=".$customer_info['address']."";}?> /></td>
                </tr>
                <tr>
                  <td><div align="right">Current State/Province:&nbsp; </div></td>
                  <td align="left"><select name="or_state" size="1" id="or_state" onchange="get(this);" style="width: 170px; ">
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
				<![endif]-->                  </td>
                </tr>
                <tr>
                  <td><div align="right">Current City: &nbsp;<br />
                          <i>If your city is not listed, select&nbsp; nearest location&nbsp; </i></div></td>
                  <td align="left"><?
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
                      </select>                  </td>
                </tr>
                <tr>
                  <td><div align="right">ZipCode/Postal Code:&nbsp; </div></td>
                  <td align="left"><input name="zipcode" type="text" alt="Zip" id="zipcode" size="7" maxlength="7" class="formobject" <?if($autofill){ echo "value='$zipcode'";}else if($customer_info['zipcode']){echo "value=".$customer_info['zipcode']."";}?> /></td>
                </tr>
                <tr>
                  <td><div align="right">Phone number (work):&nbsp; </div></td>
                  <td align="left"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif"> (
                    <input name="ph1" type="text" alt="Area Code" id="ph1" size="3" maxlength="3" class="formobject" onkeyup='Move(this,3,&quot;ph2&quot;,event,&quot;ph1&quot;)' <?if($autofill) {echo "value='$ph1'";}else if($customer_info['ph1']){echo "value=".$customer_info['ph1']."";}?> />
                    )
                    <input name="ph2" type="text" alt="Phone" id="ph2" size="3" maxlength="3" class="formobject" onkeyup='Move(this,3,&quot;ph3&quot;,event,&quot;ph1&quot;)' <?if($autofill) {echo "value='$ph2'";}else if($customer_info['ph2']){echo "value=".$customer_info['ph2']."";}?> />
                    -
                    <input name="ph3" type="text" id="ph3" size="4" maxlength="4" class="formobject" onkeyup='Move(this,4,&quot;ph3&quot;,event,&quot;ph2&quot;)' <?if($autofill){ echo "value='$ph3'";}else if($customer_info['ph3']){echo "value=".$customer_info['ph3']."";}?> />
                  </font></td>
                </tr>
                <tr>
                  <td><div align="right">Phone number (home):&nbsp; </div></td>
                  <td align="left"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif"> (
                    <input name="ph4" type="text" alt="Area Code"id="ph4" size="3" maxlength="3" class="formobject" onkeyup='Move(this,3,&quot;ph5&quot;,event,&quot;ph4&quot;)' <?if($autofill) {echo "value='$ph4'";}else if($customer_info['ph4']){echo "value=".$customer_info['ph4']."";}?> />
                    )
                    <input name="ph5" type="text" alt="Phone" id="ph5" size="3" maxlength="3" class="formobject" onkeyup='Move(this,3,&quot;ph6&quot;,event,&quot;ph4&quot;)' <?if($autofill) {echo "value='$ph5'";}else if($customer_info['ph5']){echo "value=".$customer_info['ph5']."";}?> />
                    -
                    <input name="ph6" type="text" id="ph6" size="4" maxlength="4" class="formobject" onkeyup='Move(this,4,&quot;ph6&quot;,event,&quot;ph5&quot;)' <?if($autofill) {echo "value='$ph6'";}else if($customer_info['ph6']){echo "value=".$customer_info['ph6']."";}?> />
                  </font></td>
                </tr>
                <tr>
                  <td><div align="right">Email address:&nbsp; </div></td>
                  <td align="left"><input name="email" type="text" alt="E-Mail Address" id="email" class="formobject" <?if($autofill) {echo "value='$email'";}else if($customer_info['email']){echo "value=".$customer_info['email']."";}?> /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right">Which state do you need your&nbsp; packing&nbsp; supplies shipped?:&nbsp; </div></td>
                  <td align="left"><select name="dor_state" alt="Destination State" size="1" id="dor_state" style="width:170px; ">
                      <option value="">Select State/Province</option>
                      <?
					$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999 AND StateID!=68'; 					
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
				<![endif]-->                  </td>
                </tr>
                <tr>
                  <td><div align="right">Estimate Date of Moving:
                          <!--<i>yyyy-mm-dd</i>-->
                  &nbsp;</div></td>
                  <td align="left"><select name="Day">
                      <?  echo ComboList(1,31, $customer_info)?>
                    </select>
                      <select name="Month">
                        <?  echo ComboList2($customer_info)?>
                      </select>
                      <select name="Year">
                        <?  echo ComboList(2008,date("Y")+8,$customer_info)?>
                      </select>                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right">Materials Required: &nbsp;<br />
                          <i>(Ctrl+Click to select multiple)&nbsp; </i></div></td>
                  <td align="left"><select name="materials[]" alt="Materials" size="4" id="materials" style="width:170px; " multiple="multiple">
                      <option value="1">Boxes</option>
                      <option value="2">Tape</option>
                      <option value="3">Moving Equipment</option>
                    </select>
                      <br /></td>
                </tr>
                <?php dsp_crypt(0,1); ?>
                <tr>
                  <td align="right">Enter the code:&nbsp; </td>
                  <td align="left"><input type="text" name="code" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr align="center">
                  <td colspan="2" align="center"><input type="submit" name="Submit" value="Request a packing supplies and materials provider" id="next" style="width:350px; font-size: small; font-family: Arial; color: #; background-color: #dceffe; border: 1 outset #;margin-right:50px;" /></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
      </tr>
      </table>
  </form>
	</div>
<? include_once "../bottom_panel.php"; ?>
