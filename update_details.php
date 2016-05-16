<?php
  session_start();
  error_reporting(0);
  include "Security.php"; 
  require "top_panel_members.php";
  include_once "mem4js.php";
  include_once "mem4.js";
  error_reporting(0);
  
  $day = $_GET['day'];
  $month = $_GET['month'];
  $year = $_GET['year'];
  

function service_selector($service, $data)
{
    if($service==$data)
    {
        return "selected";
    }
    return;
}

  function displayAssociations($Associations_Array)
        {
                global $link;
				
                $strQuery = "SELECT assid, ass_shname, ass_fullname FROM associations";
				$result_newQuery = mysql_query($strQuery) or die("Query failed23");
				$ret_array= array();
				$num = mysql_num_rows($result_newQuery);
				for($i=0;$i<$num;$i++)
					{
						array_push($ret_array,mysql_fetch_row($result_newQuery));
					}

                foreach($ret_array as $Value)
                {
                        $AId   = $Value[0];
                        $AS_Name = $Value[1];
						$A_Name = $Value[2];
                        
                        if (in_array($AId, $Associations_Array))
                            echo "<option value=$AId selected>($AS_Name) $A_Name";
                        else
                            echo "<option value=$AId>($AS_Name) $A_Name";
                }// End OF Foreach Loop
        }// EnD OF function

  function displayStates($state_array)
        {
                global $memberType;
				
                if ($memberType=="full")
                {
                	$strQuery = "SELECT StateID, name, sh_name FROM states";	
                }
                else
                {
                	$strQuery = "SELECT StateID, name, sh_name FROM states where StateID !='999'";	
                }                
				$result_newQuery = mysql_query($strQuery) or die("Query failed23");
				$ret_array= array();
				$num = mysql_num_rows($result_newQuery);
				for($i=0;$i<$num;$i++)
					{
						array_push($ret_array,mysql_fetch_row($result_newQuery));
					}

                foreach($ret_array as $Value)
                {
                        $Id   = $Value[0];
                        $Name = $Value[1];                      	
                        $sh_name = $Value[2];
                        
                        if ($Id != 52)
                        {
                        	if ($Id==$state_array)
                            	echo "<option value='$Id' selected>$Name"." (".$sh_name.")</option>";
                        	else                        	
                            	echo "<option value='$Id'>$Name"." (".$sh_name.")</option>";
                        }
                        else
                        {
                        	if ($Id==$state_array)
                            	echo "<option value='$Id' selected>$Name</option>";
                        	else                        	
                            	echo "<option value='$Id'>$Name</option>";
                        }
                        
                        
                }// End OF Foreach Loop
        }// EnD OF function

function displayCities($StateID, $city_array)
        {
                global $link;
				
                $strQuery = "SELECT CityID, city FROM cities where StateID=$StateID";
				$result_newQuery = mysql_query($strQuery) or die("Query failed23");
				$ret_array= array();
				$num = mysql_num_rows($result_newQuery);
				for($i=0;$i<$num;$i++)
					{
						array_push($ret_array,mysql_fetch_row($result_newQuery));
					}

                foreach($ret_array as $Value)
                {
                        $CityID   = $Value[0];
                        $Name = $Value[1];
                        
                        if (in_array($CityID, $city_array))
                            echo "<option value='$CityID' selected>$Name";
                        else
                            echo "<option value='$CityID'>$Name";
                            
                }
        }
        
  function displaySCountries($SCountry_Array)
        {
                global $link;
				
                $strQuery = "SELECT id, country_name, country_code FROM operatingcountries";
				$result_newQuery = mysql_query($strQuery) or die("Query failed23");
				$ret_array= array();
				$num = mysql_num_rows($result_newQuery);
				for($i=0;$i<$num;$i++)
					{
						array_push($ret_array,mysql_fetch_row($result_newQuery));
					}

                foreach($ret_array as $Value)
                {
                        $CId   = $Value[0];
                        $C_Name = $Value[1];
						$C_Code = $Value[2];
                        
                        if (in_array($CId, $SCountry_Array))
                            echo "<option value=$CId selected>($C_Code) $C_Name";
                        else
                            echo "<option value=$CId>($C_Code) $C_Name";
                }// End OF Foreach Loop
        }// EnD OF function
 
  


  $strQuery = "Select tblmembers.pass, tblmembers.Associations, tblmembers.Logo, tblmembers.ServiceCountry, tblmembers.ZipCode, tblmembers.MemberType, tblmembers.sms_service, tblmembers.sms_address, tblmembers.State
                   From tblmembers
					   Where tblmembers.MemberID =" . $_SESSION['Member_Id'];
  $result_newQuery = mysql_query($strQuery) or die("Query failed23*3");
  $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
			  
  $Pass = $line[pass];
  $Ass = $line[Associations];
  $Logo = $line[Logo];
  $SC = $line[ServiceCountry];
  $zipcode = $line[ZipCode];
  $memberType = $line[MemberType];
  $sms_service=$line[sms_service];
  $sms_address=$line[sms_address];
  $_SESSION['Member_Type'] = $memberType; 
  $sh_name = $line[State];
  
  $strQuery = "Select StateID from states where sh_name='$sh_name'";
  $result = mysql_query($strQuery) or die("Query failed2s3");
  $line = mysql_fetch_array($result, MYSQL_ASSOC);
  $state_array= $line[StateID];
  
  $strQuery = "Select CityID from tblmember_servicecity where StateID='$state_array' AND MID='$_SESSION[Member_Id]'";  
  $result = mysql_query($strQuery) or die("Query failed2s3");
  $city_array = array();  
  while ($line = mysql_fetch_array($result))
  {
	array_push($city_array, $line[CityID]);
  }
  
  $Associations_Array = explode(",", $Ass);
  $SCountry_Array = explode(",", $SC);  
   
  
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
function enable_sms()
{
	form1.sms_company.disabled = false;
	form1.sms_phone.disabled = false;
}

function disable_sms()
{	
	form1.sms_company.disabled = true;
	form1.sms_phone.disabled = true;
	form1.sms_company.value = "";
	form1.sms_phone.value = "";
	form1.sms_company.options[0].selected = true;

}
</script>
<script language="JavaScript" src="mov.js"></script>
<script type="text/javascript" src="cal.js"></script>
<script LANGUAGE = "Javascript">

function showServiceCountries()
{
	var form = document.forms[0];
	if(form.Associations.options[4].selected == true)
	{
		form.SCountries.disabled = false;
	}
	else
	{
		var i;
		for (i=0; i<form.SCountries.length; i++)
		{
			form.SCountries.options[i].selected = false;
		}
		form.SCountries.disabled = true;
	}	
}

function check_array(frm)
 { 
	var ListAss = "";	
	var ListSC = "";	

	for(aloop=0;aloop<frm.Associations.length;aloop++)
	{
		if(frm.Associations.options[aloop].selected)
		{
			if (ListAss=="")
			{				
				ListAss = frm.Associations.options[aloop].value;
			}
			else
			{
				ListAss = ListAss + "," + frm.Associations.options[aloop].value;			
			}
		}
	}
		
	frm.List_Ass.value = ListAss;
		
	for(aloop=0;aloop<frm.SCountries.length;aloop++)
	{
		if(frm.SCountries.options[aloop].selected)
		{
			if (ListSC=="")
			{
				ListSC = frm.SCountries.options[aloop].value;
			}
			else
			{
				ListSC = ListSC + "," + frm.SCountries.options[aloop].value;
			}
		}
	}
		
	frm.List_SC.value = ListSC;	
 }
 
 function validate_form(MUWCForm)
 { 	
 	
 	var errorMsg = "";
    
	if (MUWCForm.CP.value.trim() == ""){
		errorMsg += "\n\Contact Person \t\t- Please provide your Contact Person.";
	}
	if (MUWCForm.CE.value.trim()== ""){
		errorMsg += "\n\Email Address \t\t- Please provide your Email Address.";
	}
	else if(echeck(MUWCForm.CE.value.trim()) == false)
	{
		errorMsg += "\n\Email Address \t\t- Invalid Email Address.";
	}
	if (MUWCForm.Cphone_one.value.trim() == "" ||MUWCForm.Cphone_two.value.trim() == "" || MUWCForm.Cphone_three.value.trim() == ""){
		errorMsg += "\n\Phone Number \t\t- Please provide your Phone Number.";
	}	
	else if (isInteger(MUWCForm.Cphone_one.value, 3) == false || isInteger(MUWCForm.Cphone_two.value, 3) == false || isInteger(MUWCForm.Cphone_three.value, 4) == false){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Phone Number.";
	}
	else if (MUWCForm.Cphone_four.value.trim() != "" && isInteger(MUWCForm.Cphone_four.value, 2) != true && isInteger(MUWCForm.Cphone_four.value, 3) != true && isInteger(MUWCForm.Cphone_four.value, 4) != true && isInteger(MUWCForm.Cphone_four.value, 5) != true ){
		errorMsg += "\n\Phone Number \t\t- Phone extension must be 0 or 2-5 numbers.";
	}
	if (MUWCForm.CPass.value.trim() == ""){
		errorMsg += "\n\Password \t\t- Please provide your Password.";
	}	
	if (MUWCForm.or_state.selectedIndex == 0 || MUWCForm.or_state.selectedIndex == -1)
	{
		errorMsg += "\n\State \t\t\t- Please select your state.";
	}
	if (MUWCForm.memberType.value == "standard")
	{
		if (MUWCForm.or_city.selectedIndex == -1)
		{
			errorMsg += "\n\City \t\t\t- Please select your city.";
		}
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
	
	check_array(MUWCForm);	
	//return confirm('After your Registeration Details are updated, you will be logged out to ensure security, and you will need to log in again. Thanks for your co-operation.');
	return confirm('After your Registration Details are updated, you will be logged out to ensure security, and you will need to log in again. Thanks for your co-operation.');
 }
 
function handleError() {
	return true;
}

window.onerror = handleError;
	
</script>


 
  <!--font style="FONT: bold 15px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 3px;">Update Registeration Details</font><br><br-->
  <font style="FONT: bold 15px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 3px;">Update Registration Details</font><br><br>

<table border="0" cellspacing="0" cellpadding="5" align="center" >
  
  <form action="update_details2.php" name="form1" method="post">
  <input type="hidden" name="day" value="<?=$day?>">
  <input type="hidden" name="month" value="<?=$month?>">
  <input type="hidden" name="year" value="<?=$year?>">
  <input type="hidden" name="memberType" value="<?=$memberType?>">
  <input type = "hidden" name="List_Ass" value="">
   <input type = "hidden" name="List_SC" value="">

   
  
  <tr>
		<td align="right"><b><font face="Verdana" size="2">Contact Person:</font></b></td>
		<td align="left"><input type="text" name="CP" SIZE="40" maxlength="32" value="<?=$_SESSION['Member_Contact']?>"></td>
	</tr>
  <tr>
		<td align="right"><b><font face="Verdana" size="2">Contact email:</font></b></td>
		<td align="left"><input type="text" name="CE" SIZE="40" maxlength="32" value="<?=$_SESSION['Member_Email']?>"></td>
	</tr>
<?php
//fix the phone so that it's seperated by area code, first three numbers, second three numbers, the last four numbers, and then extension
$temp_phone=$_SESSION['Member_Phone'];
$temp_phone = preg_split("/[\s,\.]+/", $temp_phone);
$temp= array();
$temp[0]=substr($temp_phone[0], 0, 3);
$temp[1]=substr($temp_phone[0], 3, 3);
$temp[2]=substr($temp_phone[0], 6, 4);
$temp[3]=$temp_phone[2];


echo"
  <tr>
		<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Phone:</font></b></td>
		<td align=\"left\"><input type=\"text\" name=\"Cphone_one\" maxlength=\"3\" class=\"formobject\"  size=\"3\" value=$temp[0]>-<input type=\"text\" name=\"Cphone_two\" maxlength=\"3\" class=\"formobject\"  size=\"3\" value=$temp[1]>-<input type=\"text\" name=\"Cphone_three\" maxlength=\"4\" class=\"formobject\" size=\"4\" value=$temp[2]> ext. <input type=\"text\" name=\"Cphone_four\" maxlength=\"5\" class=\"formobject\" size=\"5\" value=$temp[3]></td>
	</tr>
  <tr>
";
?>
		<td align="right"><b><font face="Verdana" size="2">Password:</font></b></td>
		<td align="left"><!--input type="text" name="CPass" SIZE="40" maxlength="32" value="<?=$Pass?>"-->
		      <input type="password" name="CPass" SIZE="40" maxlength="32" value="<?=$Pass?>">
                </td>
	</tr>
	<tr>
		<td align="right"><font face="Verdana" size="2"><b>Service Area:</b>
		</td>
		<td align="left">
		<select name="or_state" id="or_state" onChange="get(this);">
		<option value="0">Select service state/province</option>		 
          <? displayStates($state_array);?>
        </select>
    </tr>    
    <? if ($memberType == "standard")
    {
    	echo '<tr><td align="right"><font face="Verdana" size="2"><b>Select City</b>
		            <br><i>(Ctrl+Click to select multiple)</i></font>
    	</td>
    	<td align="left">
        <select name="or_city[]" size="7" id="or_city" multiple style="width: 200px;">';
		echo displayCities($state_array, $city_array);
        echo '</select></td></tr>';
    }
    ?>
 


<?
//sms hadnler
$sms_address=explode('@',$sms_address);
$sms_comp=$sms_address[1];
$sms_phone=$sms_address[0];
$sms_yes="";
$sms_no="";
    if($sms_service=="yes")
    {
        $sms_yes="checked";
    }
    else{
        $sms_no="checked";
    }


?>
<tr>
    <td align='right'>Would you like to be notified about new orders through text-messaging?</td>
    <td align='left'> 
        <input type='radio' name='sms_service' value='yes' checked onclick='return enable_sms()' id='sms_service1' <?echo"$sms_yes";?>>yes  
        <input type='radio' name='sms_service' value='no' onclick='return disable_sms()' id='sms_service2' <?echo"$sms_no";?>>no</td>
</tr>
<tr>
    <td align='right'>Phone number you would like to receive text message on:</td>
    <td align='left'>
        <input type='text' name='sms_phone' maxlength='10' value='<?echo"$sms_phone";?>'></td>
</tr>
<tr>
    <td valign='top' align='right'>Cellphone Providers:</td>
    <td align='left'>
        <select name='sms_company' size='9'>
            <option value='' >Select A Provider</option>
            <option value='mmode.com' <?echo service_selector("mmode.com", "$sms_comp");?>>AT&T</option>
            <option value='mobile.mycingular.com' <?echo service_selector("mobile.mycingular.com", "$sms_comp");?>>Cingular</option>
            <option value='page.metrocall.com' <?echo service_selector("page.metrocall.com", "$sms_comp");?>>Metrocall</option>
            <option value='messaging.nextel.com' <?echo service_selector("messaging.nextel.com", "$sms_comp");?>>Nextel</option>
            <option value='messaging.sprintpcs.com' <?echo service_selector("messaging.sprintpcs.com", "$sms_comp");?>>Sprint PCS</option>
            <option value='tmomail.net' <?echo service_selector("tmomail.net", "$sms_comp");?>>T-Mobile</option>
            <option value='vtext.com' <?echo service_selector("vtext.com", "$sms_comp");?>>Verizon Wireless</option>
            <option value='vmobl.com' <?echo service_selector("vmobl.com", "$sms_comp");?>>Virgin Mobile USA</option>
            <option value='txt.bellmobility.ca' <?echo service_selector("txt.bellmobility.ca", "$sms_comp");?>>Bell</option>
            <option value='msg.telus.com' <?echo service_selector("msg.telus.com", "$sms_comp");?>>Telus</option><option value='pcs.rogers.com'>Rogers</option>
             <option value='fido.ca' <?echo service_selector("fido.ca", "$sms_comp");?>>Fido</option>

        </select>
    </td>
</tr>



  
	
   <tr>
		<td align="right"><b><font face="Verdana" size="2">Registered with associations:</font></b></td>
		<td align="left">
		<select name = "Associations" multiple size="5" onchange="showServiceCountries();">
          <? echo displayAssociations($Associations_Array); ?>
        </select></td>
	</tr>
<? 
 if ($SCountry_Array)
 {
 	
  echo "
  <tr>
		<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Service Countries (for HHGFAA):</b>
		            <br><i>(Ctrl+Click to select multiple)</i></font></td>
		<td align=\"left\"><select name = \"SCountries\" multiple size=\"10\"";
  		if ($SCountry_Array[0] == '' && in_array(5, $Associations_Array)==false) 
  			echo " disabled>";
  		else 
  			echo ">";
        displaySCountries($SCountry_Array); 
        "</select></td>
	</tr>";
 }
 
?>
<? 
   echo "
  <tr>
		<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Logo:</font></b></td>
		<td align=\"left\">";
		      if($Logo && file_exists("logos/$Logo")) 
		       {
			     $size = getimagesize("logos/$Logo");
				 if ($size[0] > "200" || $size[1] > "100")
				 {
		           echo "<a href=\"update_logo.php?LOGO=$Logo\" 
	onClick=\"return confirm('Are you sure you want to delete current logo and upload another?');\">Click here to update logo</a>&nbsp;
				          <img src=\"logos/$Logo\" height=\"100\" width=\"200\">";
				 }
				 else
				 {
				   echo "<a href=\"update_logo.php?LOGO=$Logo\" 
	onClick=\"return confirm('Are you sure you want to delete current logo and upload another?');\">Click here to update logo</a>&nbsp;
				            <img src=\"logos/$Logo\">";
				 }
				}
				if((empty($Logo) || !file_exists("logos/$Logo")) && ($_SESSION['Member_Type'] == "standard"))
				{
				  echo "<img src=\"logos/NoLogo.gif\"><br>
				        <b><font face=\"Verdana\" size=\"2\">
						Become a PREMIUM MEMBER in order to have logo in our system</font></b>";
				}
				if((empty($Logo) || !file_exists("logos/$Logo")) && ($_SESSION['Member_Type'] == "full"))
				{
					echo "<a href=\"update_logo.php?LOGO=$Logo\" 
						onClick=\"return confirm('Are you sure you want to delete current logo and upload another?');\">Click here to update logo</a>&nbsp;";
					echo "<img src=\"logos/NoLogo.gif\">";
				}
			
		echo "</td>
	</tr>";
?>



  <tr>
		<td></td>
		<td align="left">
        <!--input type="submit" value="Update Registeration" class="button" onClick="return validate_form(document.forms[0]);"-->
        <input type="submit" value="Update Registration" class="button" onClick="return validate_form(document.forms[0]);">
        <input type="reset" value="Reset" class="button">
		<? echo "<input type=button value=\"Go Back\" class=\"button\" onclick=\"window.location='basa.php?day=$day&month=$month&year=$year'\">"; ?>
		</td></tr>
	</form>
</table>
</div>
	   	</div>



<div id="bottom" class="white_links">
<div align="center"></div> 
<br />
<div align="center" class="white_links"><span class="style13"><a href="index.php"><img src="images/icon_flag_usa.gif" border="0" /> </a> | <a href="index.php"><img src="images/icon_flag_canada.gif" border="0" /></a></span></div>
</div>
<div id="copy" align="center" class="style1">&copy; MovingUWithCare Registered, 2006. All Rights Reserved - Relocators you can trust. </div>
</div>

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
