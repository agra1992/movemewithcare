<?php
session_start();
//error_reporting(0);
require_once('../config.inc.php');
require_once ('../seo.php');
require_once ('../top_panel.php');
require_once ('../mailer.php');
	require("../sanitize.php");
$cryptinstall="../crypt/cryptographp.fct.php";
include $cryptinstall; 

include_once "../randchar_function.php";



?>
<html>
<head>

<?php
$service=$_POST[service];
$market_result=$_SESSION['market_result'];

$sent=$_POST[sent];
if($sent !="yes"){
$total=count($market_result);
for($i=0; $i<$total; $i++)
{

    if($service[$i] !="on")
    {
    unset($market_result[$i]);
    }
}


}



function send_sms($message)
{

    $sms_query= "SELECT Phone from sms_admins Where 1";
    $sms_r=mysql_query($sms_query);
    while($sms_result = mysql_fetch_assoc($sms_r))
    {
        $phone = $sms_result[Phone];
        send_mail ($phone, $phone, $phone, "new order", $message);
        $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$phone', '$phone', 'sms_new order, '$message')";
		 $result = mysql_query($sql) or die("Query failed5");
    }
}


function last_order_date($IP)
{
$date="";
$days_month = array(31,28,31,30,31,30,31,31,30,31,30,31);
    $sql="SELECT LastMarket,MarketOrders  FROM tblcustomers WHERE IP='$IP'";
    $r=mysql_query($sql);
    while($result=mysql_fetch_row($r))
    {
        $date=$result[0];
        $market_orders=$result[1];
    }
$market_order++;
$sql="Update tblcustomers Set MarketOrders='$market_order' WHERE IP='$IP'";
$r=mysql_query($sql);

$market_orders--;

if($date!=""){
    $date=explode("-",$date);
    $current_date=date("z-Y");
    $current_date=explode("-",$current_date);
    if($current_date[1] == $date[1]){
        if($current_date[0]-$date[0] >4 || $market_orders<10){
            return true;
        }else{

            return false; 
        }
    }
    else
    {
        if(365-$date[0]+$current_date[0]>4 || $market_orders<10){

            return true;
        }else{

            return false;
        }
    }
}

}


function refill_data(&$customer_info)
{


	$salut = sanitize($_POST[salut],5,0);
$customer_info['salut']=$salut;

	$lname = sanitize($_POST[lname],100,0);
$customer_info['lname']=$lname;

	$fname = sanitize($_POST[fname],100,0);
$customer_info['fname']=$fname;

	$address = sanitize($_POST[address],250,0);
$customer_info['address']=$address;


	$state = sanitize($_POST[state],100,0);
$customer_info['state']=$state;

	$city = sanitize($_POST[city],100,0);
$customer_info['city']=$city;

	$zipcode = sanitize($_POST[zipcode],6,0);
$customer_info['zipcode']=$zipcode;

	$ph1 = sanitize($_POST[ph1],3,0);
$customer_info['ph1']=$ph1;

	$ph2 = sanitize($_POST[ph2],3,0);
$customer_info['ph2']=$ph2;

	$ph3 = sanitize($_POST[ph3],4,0);
$customer_info['ph3']=$ph3;

	$ph4 = sanitize($_POST[ph4],3,0);
$customer_info['ph4']=$ph4;

	$ph5 = sanitize($_POST[ph5],3,0);
$customer_info['ph5']=$ph5;

	$ph6 = sanitize($_POST[ph6],4,0);
$customer_info['ph6']=$ph6;

	$email = sanitize($_POST[email],100,0);
$customer_info['email']=$email;

}

function mail_sender($market_result, $OrderId, $newid)
{
    $name= $_POST[salut].$_POST[fname]." ".$_POST[lname];
    $email=$_POST[email];
    $address=$_POST[address];
    $Phone=$_POST[ph1].$_POST[ph2].$_POST[ph3];
    $Phone2=$_POST[ph4].$_POST[ph5].$_POST[ph6];
    $ZipCode=$_POST[address];  
    $user_domain = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $IP = $_SERVER['REMOTE_ADDR'];
    $ZC=$_POST[zipcode];


//mail to members

    $Subject="New Market Order";
    $sql="SELECT Detail FROM tbl_templates WHERE TempID='38'";
    $r=mysql_query("$sql");
    $line=mysql_fetch_row($r);
    $temp_message=$line[0]; 
    $message=str_replace('%CustName%', "$name", $temp_message);
    $message=str_replace('%oid%', "$OrderId", $message);
    $message=str_replace('%TelW%', "$Phone", $message);
    $message=str_replace('%TelH%', "$Phone2", $message);
    $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
		 $message = nl2br($message);	

foreach($market_result as $member){
$memberEmail=$member[6];
$type =$member[4];
    $message=str_replace('%TM%', "$type", $message);
send_mail($AdminMail, $AdminMail, $memberEmail, $Subject, $message);

                 if($member[8]=="yes" && $member[9]!="")
                 {
                 send_mail($AdminMail, $AdminMail, $member[9], "New Order", "A new order been posted to your member panel. 
Please log in to your panel for more details.
 Thank you");
                 }


		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES 
		 		('38', '$AdminMail', '$memberEmail', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed6");

}



//send email to admin
     $sql = "SELECT admin_email from tbladmin";
     $result = mysql_query($sql) or die("Query failed2333");
     $line = mysql_fetch_array($result, MYSQL_ASSOC);
     $AdminMail = $line[admin_email];
     $Subject="New Market Order";
    $sql="SELECT Detail FROM tbl_templates WHERE TempID='37'";
    $r=mysql_query("$sql");
    $line=mysql_fetch_row($r);
    $temp_message=$line[0]; 
    $message=str_replace('%CustName%', "$name", $temp_message);
    $message=str_replace('%oid%', "$OrderId", $message);
    $message=str_replace('%type%', "$type", $message);
    $message=str_replace('%CustAddress%', "$address", $message);
    $message=str_replace('%email%', "$email", $message);
    $message=str_replace('%ZC%', "$ZC", $message);
    $message=str_replace('%TelW%', "$Phone", $message);
    $message=str_replace('%TelH%', "$Phone2", $message);
    $message=str_replace('%IPaddr%', "$IP", $message);
    $message=str_replace('%domain%', "$user_domain", $message);
    $message=str_replace('%OrderDate%', date("Y-m-d H:i:s"), $message);
    $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
		 $message = nl2br($message);		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES 
		 		('37', '$AdminMail', '$AdminMail', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed7");
		 send_mail($AdminMail, $AdminMail, $AdminMail, $Subject, $message);
		send_sms("New market order");



//send email to customer
    $sql="SELECT Detail FROM tbl_templates WHERE TempID='36'";
    $r=mysql_query("$sql");
    $line=mysql_fetch_row($r);
    $temp_message=$line[0];
    $message=str_replace('%CN%', "$name", $temp_message);
    $message=str_replace('%OrderId%', "$OrderId", $message);
    $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
		 $message = nl2br($message);		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES 
		 		('36', '$AdminMail', '$email', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed8");
		 send_mail($AdminMail, $AdminMail, $email, $Subject, $message);



}
?>
<script language="javascript" src="../cal.js"> </script>
<script language="javascript" src="../overlib_mini.js"> </script>
<script language="JavaScript" src="../mov.js"></script>
<script language="JavaScript">

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
	if (MUWCForm.state.selectedIndex == 0){
		errorMsg += "\n\Current State \t\t- Please specify the current state.";
	}
	if (MUWCForm.city.selectedIndex == -1){
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
</head>
<?php
if($sent != "yes" || !chk_crypt($_POST['code'])) 
{
    if(!chk_crypt($_POST['code']) && $sent=="yes"){
$customer_info=array();
refill_data($customer_info);
echo "<a><font color='#FF0000'>Sorry, That was the wrong captcha code</font></a>" ;}
?>

<form action='' onSubmit="return validate_form(this);" method='post'>
<table align='center'>
    <tr>
        <td align='center' colspan='2'><h2 style="FONT: bold 15px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #F79A30; LETTER-SPACING: 3px;">Marketplace Specialty Request Form</h2></td>
    </tr>
	    <tr> 
	    	<td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Salutation:</font></div></td>
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
			  	<? } ?></select></td>
	    </tr>
	    <tr> 
	      	<td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">First name:</font></div></td>
	      	<td><input name="fname" type="text" alt="First Name" class="formobject" id="fname" maxlength="100" <?if($autofill) {echo "value='$autofill.' '.$fname'";}else if($customer_info['fname']){echo "value=".$customer_info['fname']."";}?>></td>
	    </tr>
	    <tr> 
	      	<td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Last name:</font></div></td>
	      	<td><input name="lname" type="text" alt="Last Name"class="formobject" id="lname" maxlength="100" <?if($autofill){ echo "value='$lname'";}else if($customer_info['lname']){echo "value=".$customer_info['lname']."";}?>></td>
	    </tr>
	    <tr> 
			<td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Current Street Address:</font></div></td>
      		<td><input name="address" type="text" alt="Address" class="formobject" id="address" maxlength="250" <?if($autofill) {echo "value='$address'";}else if($customer_info['address']){echo "value=".$customer_info['address']."";}?>></td>
    	</tr>
<tr>
    <td align='right'>State</td>

    <td align='left'>
<select name="state" size="1" id="or_state" onChange="get(this);" style="width:170px; ">
		<option value="">Select State/Province</option>
		<?
			mysql_select_db($db_locator_name) or die("Could not select database");
			$sql = "SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999 AND StateID!=68"; 
			$result = mysql_query($sql) or die("Query failed");
			
			// showing all states
			while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
			{
$sel="";	
                                                if($line[StateID] == $customer_info['state']){
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

    </td>
</tr>
<tr>
    <td valign='top' align='right'>City</td>
    <td align='left'>
	          	<?
                        if($customer_info['or_city']){
                                               
						$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `CityID`='".$customer_info['or_city']."' "; 
						$result = mysql_query($sql) or die("Query failed");	
						while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {	

							$city_name=$line[city];
                                                        $city=$line[CityID];
					}?>
			 		<select name="or_city" size="7" id="or_city" style="width: 170px;">
					<option value="<?=$city?>" selected><?=$city_name?></option></select>
				<? } else { ?>
	 				<select name="city" size="7" id="or_city" style="width: 170px;">
				<? } ?> 	
	</select>
    </td>
</tr>
<tr> 
      		<td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Phone number (work):</font></div></td>
      		<td><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">
      			( <input name="ph1" type="text" alt="Area Code" id="ph1" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph2",event,"ph1")' <?if($autofill) {echo "value='$ph1'";}else if($customer_info['ph1']){echo "value=".$customer_info['ph1']."";}?>> ) 
		        <input name="ph2" type="text" alt="Phone" id="ph2" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph3",event,"ph1")' <?if($autofill) {echo "value='$ph2'";}else if($customer_info['ph2']){echo "value=".$customer_info['ph2']."";}?>>
		        - <input name="ph3" type="text" id="ph3" size="4" maxlength="4" class="formobject" onKeyUp='Move(this,4,"ph3",event,"ph2")' <?if($autofill){ echo "value='$ph3'";}else if($customer_info['ph3']){echo "value=".$customer_info['ph3']."";}?>></font></td>
	    </tr>
	 	<tr> 
      		<td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Phone number (home):</font></div></td>
      		<td><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">
      		( <input name="ph4" type="text" alt="Area Code"id="ph4" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph5",event,"ph4")' <?if($autofill) {echo "value='$ph4'";}else if($customer_info['ph4']){echo "value=".$customer_info['ph4']."";}?>> ) 
	        <input name="ph5" type="text" alt="Phone" id="ph5" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph6",event,"ph4")' <?if($autofill) {echo "value='$ph5'";}else if($customer_info['ph5']){echo "value=".$customer_info['ph5']."";}?>>
	        - <input name="ph6" type="text" id="ph6" size="4" maxlength="4" class="formobject" onKeyUp='Move(this,4,"ph6",event,"ph5")' <?if($autofill) {echo "value='$ph6'";}else if($customer_info['ph6']){echo "value=".$customer_info['ph6']."";}?>></font></td>
    	</tr>
    	<tr> 
      		<td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Email address:</font></div></td>
      		<td><input name="email" type="text" alt="E-Mail Address" id="email" class="formobject" <?if($autofill) {echo "value='$email'";}else if($customer_info['email']){echo "value=".$customer_info['email']."";}?>></td>
	    </tr>	


<?php dsp_crypt(0,1); ?>
  <tr><td align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Enter the code:</font></td><td align='left'><input type="text" name="code"></td></tr>	
    <tr>
    <td align='right'><input type='submit' value='submit' onclick='validate(market_form)'></td></tr>
    <td><input type='hidden' value='<?php echo"$market_result";?>'>
        <input type="hidden" name="sent" value="yes" id="from" />

</table>
</form>
<?}
//if the form was sent and the captcha was right
else if($sent == "yes"  && chk_crypt($_POST['code']))
{
$user_domain = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$IP = $_SERVER['REMOTE_ADDR'];
$OrderId = randchar(7,"numeric");
$sql = "SELECT COUNT(*) as numcustomers from tblcustomers WHERE IP='$IP'";
$result = mysql_query($sql) or die("Query failed2330");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
if (empty($line[numcustomers]))
{

    $current_date=date("z-Y");


   $sql = "INSERT INTO `tblcustomers` (Sal, FName, LName, Address, ZipCode, Phone, Phone2, email, DateAdded , IP, LastMarket, MarketOrders)
		     VALUES ('".$_POST[salut]."','".$_POST[fname]."',' ".$_POST[lname]."',
'".$_POST[address]."','".$_POST[zipcode]."','".$_POST[ph1].$_POST[ph2].$_POST[ph3]."',
'".$_POST[ph4].$_POST[ph5].$POST[ph6]."','".$_POST[email]."', CURRENT_TIMESTAMP, '$IP','$current_date','0' )"; 
   $result = mysql_query($sql) or die("Query failed309 $sql");
   


    $sql_l="UPDATE tblcustomers SET LastMarket='$current_date'";
    $r_l=mysql_query($sql_l);



   $q="Select max(CustomerID) as CustID from tblcustomers;";
   $result = mysql_query($q) or die("Query failed: 2xx");
   $row = mysql_fetch_assoc($result);
   $newid=$row[CustID];	
} 
else{
$last_order=true;
    $last_order=last_order_date($IP);

   if($last_order!=true)
    {
        die("You have already put in 10 orders in the past 5 days");
    }
    $sql = "SELECT CustomerID  from tblcustomers WHERE IP='$IP'";
    $result = mysql_query($sql) or die("Query failed2354");
    $line = mysql_fetch_array($result, MYSQL_ASSOC);
    $newid=$line[CustomerID];
}
$sql= "Insert into tbl_market_orders (OrderID, Sal, FName, LName, Address, Zipcode, Phone, Phone2, Email, City, State, Type) values('$OrderId', '".$_POST[salut]."','".$_POST[fname]."',' ".$_POST[lname]."',
'".$_POST[address]."','".$_POST[zipcode]."','".$_POST[ph1].$_POST[ph2].$_POST[ph3]."',
'".$_POST[ph4].$_POST[ph5].$POST[ph6]."','".$_POST[email]."','".$_POST[city]."',
'".$_POST[state]."','market')";
$r=mysql_query($sql) or die("query failed:634");
echo"your order has been sent </br>";
echo" <a href='marketplace.php'>return</a>";
foreach($market_result as $member){
    $sql="Insert into market_orders_sent_list (OrderID, MID, CID) values('$OrderId', '".$member[5]."', '$newid')";
    $r=mysql_query($sql) or die('query failed:4543');
}
mail_sender($market_result, $OrderId, $newid);

}
//if the form was submmited but the capthca was wrong

?>
<? 
		include "../bottom_panel.php"; 
?>
</html>