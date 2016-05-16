<?php
set_time_limit(60*60*60);
require_once "class.phpmailer.php";
require_once "top_panel.php";
require("config.inc.php");
require("sanitize.php");


define("SMTP_SERVER","movinguwithcare.com");
define("SYSTEM_EMAIL_NAME","MovingUWithCare.Com SYSTEM");

?>
<?php

function send_mail($from_email,$to_email,$subject,$body)
       {
			$to_email=str_replace("''","'",$to_email);
		
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
		    $mail->Host = SMTP_SERVER; // SMTP server online 
			
	        $mail->From     = $from_email;
			$mail->FromName = SYSTEM_EMAIL_NAME;
            $mail->AddAddress( $to_email );
		    $mail->Subject= $subject;
            $mail->Body=$body;        // set the body
			$mail->WordWrap = 50;
			$mail->IsHTML(true);
          
				if(!$mail->Send())
				{
				   echo "Message was not sent";
				   echo "Mailer Error: " . $mail->ErrorInfo;
				}
				
				
 
       }  // End Of Function Send Mail

///////////////////////////////////////////////////////////////////////////////
// THIS PART WILL BE WORKING ONLY IF 'NAME' PARAM IS DEFINED !
///////////////////////////////////////////////////////////////////////////////
// saving variables to the database
/////////////////////////////////////////////////////////////////////
// Processing standard membership here ||||||||||||||||||||||||||||||
////////////////////////////////////////////////////////////////////


$name = sanitize($_POST[name],100,0);
$email = sanitize($_POST[email],100,0);
$person=$_POST[person];
$login = sanitize($_POST[login],20,0);
$phone = sanitize($_POST[phone],15,0);
$pass = sanitize($_POST[pass],10,0);
$assoc=$_POST[association];
$city = $_POST[city];
$country = $_POST[country];
if($assoc) $assocs=implode(",",$assoc);
if($country) $country=implode(",",$country);
$type = $_POST[type];
$state = sanitize($_POST[state],5,1);

if (($name) and ($type=='standard')) {



$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

//check if all cities are within one state (fraud check)
/////////////////////////////////////////////////////////////////////////////
mysql_select_db($db_locator_name) or die("Could not select database");

foreach ($_POST[city] as $currentcity) {
$currentcity = sanitize($currentcity,5,1);
$cities .= ' \'' . $currentcity . '\',';
$numcities++;
}
// trim the last comma
$cities = substr($cities,0,strlen($cities)-1);

$sql = "SELECT COUNT(*) as `numcities` FROM `cities` WHERE `CityID` IN ($cities) AND `StateID`=$state "; 
//echo($sql);

$result = mysql_query($sql) or die("Query failed1");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

if ($line[numcities]!=$numcities) {
$message = "<font color=red>Invalid request. Common service members are allowed to serve cities only within one state.</font>";
} else {

	//////////////////////////////////////////////////////////////////////////////
	// check if login is avaible?
	///////////////////////////////////////////////////////////////////////////
	$sql = "SELECT COUNT(*) as nummembers from tblmembers WHERE Login='$login'"; 
	
	$result = mysql_query($sql) or die("Query failed2");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($line[nummembers]!=0) {
	$message = "<font color=red>We are sorry, but login \"$login\" is already taken.<br>Please return to the previous page and select another login</a>";
	} else {

		///////////////////////////////////////////////////////////
		// adding to service
		///////////////////////////////////////////////////////////
		/* $sql = "INSERT INTO `cs` (`name`, `email`, `contact_person`,`login`,`member_of` ,`password`, `phone`, `active`) 
		VALUES ('$name', '$email','$person', '$login','$assocs', MD5('$pass'), '$phone', '0') "; */
		$sql = "INSERT INTO `tblmembers` (`MemberName`, `MemberType`, `ContactEmail`, `ContactPerson`,`Login`,`Associations` ,`pass`, `Phone`,`ServiceCountry`) 
		VALUES ('$name','$type','$email','$person', '$login','$assocs', '$pass', '$phone', '$country') "; 
		$result = mysql_query($sql) or die("Query failed3");
		
		$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `login`='$login'";
		$result = mysql_query($sql) or die("Query failed4");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$newid = $line[MemberID]; 

		foreach ($_POST[city] as $currentcity) {
		$currentcity = sanitize($currentcity,5,1);		
		$servicecity .= " ($currentcity, $newid, $state),";
		}
		$servicecity = substr($servicecity,0,strlen($servicecity)-1);
        //print_r($servicecity);exit;

		$sql = "INSERT INTO `tblmember_servicecity` (`CityID`,`MID`, `StateID`) VALUES $servicecity";
		$result = mysql_query($sql) or die("Query failed5");
		
		$uploaddir = 'logos/';
        $uploadfile = $uploaddir . basename($HTTP_POST_FILES['Logo']['name']);
		$realname = basename($HTTP_POST_FILES['Logo']['name']);

        if (move_uploaded_file($HTTP_POST_FILES['Logo']['tmp_name'], $uploadfile)) 
		{
		  $strQuery = "update tblmembers set Logo = '$realname' where MemberID = $newid";
		  $result = mysql_query($strQuery) or die("Query failed90");  
         }
		 
		 $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed233");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed23");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail]; 
		 
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"logos/MUWC_Logo.gif\">" . $message . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MUWC - Registeration Confirmed";

		 //send_mail("$from","$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$newid', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed5");
                 send_mail($from, $from, $newid, $Subject, $message);		 
		 $message = "Your application has been accepted and will be considered within few days";
	}
  }
} else if (($name) and ($type=='full')) {
////////////////////////////////////////////////////////////////////////////
// PROCESSING FULL SERVICE MEMBERS HERE ||||||||||||||||||||||||||||||||||||
////////////////////////////////////////////////////////////////////////////

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

$longdist = sanitize($_POST[longdist],20,0);

if ($longdist=="yes") {$longdist="1";} else {$longdist="0";}

$fax = sanitize($_POST[fax],20,0);
$tollfree = sanitize($_POST[tollfree],20,0); 
$address = sanitize($_POST[address],150,0); 
$description = sanitize($_POST[description],1024,0); 
$license = sanitize($_POST[license],20,0); 
$email = sanitize($_POST[email],30,0); 
$license1 = sanitize($_POST[license1],20,0); 

//////////////////////////////////////////////////////////////////////////////

/*$query = "INSERT INTO `fullservice` (`password`,`login`,`contact_person`,`name`, `phone`, 
`fax`, `tollfree`, `address`, `description`, `longdist`, `license`, `license1`,
`email`,'member_of') VALUES ( '$pass','$login','$person','$name', '$phone', '$fax', '$tollfree', '$address', '$description',
'$longdist', '$license', `$license1`, '$email','$assocs')"; */

$sql = "SELECT COUNT(*) as nummembers from tblmembers WHERE Login='$login'"; 
$result = mysql_query($sql) or die("Query failed6");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($line[nummembers]!=0) {
	$message = "<font color=red>We are sorry, but login \"$login\" is already taken.<br>Please return to the previous page and select another login</a>";
	} else {
	
$query = "INSERT INTO `tblmembers` (`pass`,`Login`,`ContactPerson`,`MemberName`, `Phone`, 
`Fax`, `TollFree`, `Address`, `Description`, `InterstateLicense`, `USDot`, `MC`,
`ContactEmail`,`Associations`,`MemberType`, `ServiceCountry`) VALUES ( '$pass','$login','$person','$name', '$phone', '$fax', '$tollfree', '$address', '$description',
'$longdist', '$license', '$license1', '$email','$assocs','$type','$country')"; 

$result = mysql_query($query) or $message = "An internal error occured, please repeat your request. If problem persists, contact <a href=\"mailto:admin@movinguwithcare.com\">webmaster</a>.";

$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `login`='$login'";
$result = mysql_query($sql) or die("Query failed7");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$newid = $line[MemberID]; 

$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`) VALUES ('$newid','$state')";
$result = mysql_query($sql) or die("Query failed8");

$uploaddir = 'logos/';
$uploadfile = $uploaddir . basename($HTTP_POST_FILES['Logo']['name']);
$realname = basename($HTTP_POST_FILES['Logo']['name']);

if (move_uploaded_file($HTTP_POST_FILES['Logo']['tmp_name'], $uploadfile)) 
{
	  $strQuery = "update tblmembers set Logo = '$realname' where MemberID = $newid";
	  $result = mysql_query($strQuery) or die("Query failed90");  
}

         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed234");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed26");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail]; 
		 
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"logos/MUWC_Logo.gif\">" . $message . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MUWC - Registeration Confirmed";

		 //send_mail("$from","$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$newid', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed55");
		 send_mail($from, $from, $newid, $Subject, $message);
$message = "Your application has been accepted, you will be contacted shortly regarding billing information. ";

}
} 

else if (($name) and ($type=='transport')) {
////////////////////////////////////////////////////////////////////////////
// PROCESSING FULL SERVICE MEMBERS HERE ||||||||||||||||||||||||||||||||||||
////////////////////////////////////////////////////////////////////////////

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

$longdist = sanitize($_POST[longdist],20,0);

if ($longdist=="yes") {$longdist="1";} else {$longdist="0";}

$fax = sanitize($_POST[fax],20,0);
$tollfree = sanitize($_POST[tollfree],20,0); 
$address = sanitize($_POST[address],150,0); 
$description = sanitize($_POST[description],1024,0); 
$license = sanitize($_POST[license],20,0); 
$email = sanitize($_POST[email],30,0); 
$license1 = sanitize($_POST[license1],20,0); 

//////////////////////////////////////////////////////////////////////////////

/*$query = "INSERT INTO `fullservice` (`password`,`login`,`contact_person`,`name`, `phone`, 
`fax`, `tollfree`, `address`, `description`, `longdist`, `license`, `license1`,
`email`,'member_of') VALUES ( '$pass','$login','$person','$name', '$phone', '$fax', '$tollfree', '$address', '$description',
'$longdist', '$license', `$license1`, '$email','$assocs')"; */

$sql = "SELECT COUNT(*) as nummembers from tblmembers WHERE Login='$login'"; 
$result = mysql_query($sql) or die("Query failed6");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($line[nummembers]!=0) {
	$message = "<font color=red>We are sorry, but login \"$login\" is already taken.<br>Please return to the previous page and select another login</a>";
	} else {
	
$query = "INSERT INTO `tblmembers` (`pass`,`Login`,`ContactPerson`,`MemberName`, `Phone`, 
`Fax`, `TollFree`, `Address`, `Description`, `InterstateLicense`, `USDot`, `MC`,
`ContactEmail`,`Associations`,`MemberType`, `ServiceCountry`) VALUES ( '$pass','$login','$person','$name', '$phone', '$fax', '$tollfree', '$address', '$description',
'$longdist', '$license', '$license1', '$email','$assocs','$type','$country')"; 

$result = mysql_query($query) or $message = "An internal error occured, please repeat your request. If problem persists, contact <a href=\"mailto:admin@movinguwithcare.com\">webmaster</a>.";

$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `login`='$login'";
$result = mysql_query($sql) or die("Query failed7");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$newid = $line[MemberID]; 

$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`) VALUES ('$newid','$state')";
$result = mysql_query($sql) or die("Query failed8");

$uploaddir = 'logos/';
$uploadfile = $uploaddir . basename($HTTP_POST_FILES['Logo']['name']);
$realname = basename($HTTP_POST_FILES['Logo']['name']);

if (move_uploaded_file($HTTP_POST_FILES['Logo']['tmp_name'], $uploadfile)) 
{
	  $strQuery = "update tblmembers set Logo = '$realname' where MemberID = $newid";
	  $result = mysql_query($strQuery) or die("Query failed90");  
}

         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed230");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed260");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail]; 
		 
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"logos/MUWC_Logo.gif\">" . $message . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MUWC - Registeration Confirmed";

		 //send_mail("$from","$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$newid', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed556");
	         send_mail($from, $from, $newid, $Subject, $message);	 
		
$message = "Your application has been accepted, Thank you.";

}
} 

else if (($name) and ($type=='storage')) {
////////////////////////////////////////////////////////////////////////////
// PROCESSING FULL SERVICE MEMBERS HERE ||||||||||||||||||||||||||||||||||||
////////////////////////////////////////////////////////////////////////////

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

$fax = sanitize($_POST[fax],20,0);
$tollfree = sanitize($_POST[tollfree],20,0); 
$address = sanitize($_POST[address],150,0); 
$description = sanitize($_POST[description],1024,0); 
$email = sanitize($_POST[email],30,0); 

//////////////////////////////////////////////////////////////////////////////

/*$query = "INSERT INTO `fullservice` (`password`,`login`,`contact_person`,`name`, `phone`, 
`fax`, `tollfree`, `address`, `description`, `longdist`, `license`, `license1`,
`email`,'member_of') VALUES ( '$pass','$login','$person','$name', '$phone', '$fax', '$tollfree', '$address', '$description',
'$longdist', '$license', `$license1`, '$email','$assocs')"; */

$sql = "SELECT COUNT(*) as nummembers from tblmembers WHERE Login='$login'"; 
$result = mysql_query($sql) or die("Query failed6");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($line[nummembers]!=0) {
	$message = "<font color=red>We are sorry, but login \"$login\" is already taken.<br>Please return to the previous page and select another login</a>";
	} else {
	
$query = "INSERT INTO `tblmembers` (`pass`,`Login`,`ContactPerson`,`MemberName`, `Phone`, 
`Fax`, `TollFree`, `Address`, `Description`, `ContactEmail`,`Associations`,`MemberType`, `ServiceCountry`) VALUES ( '$pass','$login','$person','$name', '$phone', '$fax', '$tollfree', '$address', '$description',
'$email','$assocs','$type','$country')"; 

$result = mysql_query($query) or $message = "An internal error occured, please repeat your request. If problem persists, contact <a href=\"mailto:admin@movinguwithcare.com\">webmaster</a>.";

$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `login`='$login'";
$result = mysql_query($sql) or die("Query failed7");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$newid = $line[MemberID]; 

$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`) VALUES ('$newid','$state')";
$result = mysql_query($sql) or die("Query failed8");

$uploaddir = 'logos/';
$uploadfile = $uploaddir . basename($HTTP_POST_FILES['Logo']['name']);
$realname = basename($HTTP_POST_FILES['Logo']['name']);

if (move_uploaded_file($HTTP_POST_FILES['Logo']['tmp_name'], $uploadfile)) 
{
	  $strQuery = "update tblmembers set Logo = '$realname' where MemberID = $newid";
	  $result = mysql_query($strQuery) or die("Query failed90");  
}

         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed237");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed267");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail]; 
		 
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"logos/MUWC_Logo.gif\">" . $message . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MUWC - Registeration Confirmed";

		 //send_mail("$from","$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$newid', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed557");
		 send_mail($from, $from, $newid, $Subject, $message);
$message = "Your application has been accepted, Thank you.";

}
} 

else if (($name) and ($type=='packing')) {
////////////////////////////////////////////////////////////////////////////
// PROCESSING FULL SERVICE MEMBERS HERE ||||||||||||||||||||||||||||||||||||
////////////////////////////////////////////////////////////////////////////

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

$fax = sanitize($_POST[fax],20,0);
$tollfree = sanitize($_POST[tollfree],20,0); 
$address = sanitize($_POST[address],150,0); 
$description = sanitize($_POST[description],1024,0); 
$email = sanitize($_POST[email],30,0); 

//////////////////////////////////////////////////////////////////////////////

/*$query = "INSERT INTO `fullservice` (`password`,`login`,`contact_person`,`name`, `phone`, 
`fax`, `tollfree`, `address`, `description`, `longdist`, `license`, `license1`,
`email`,'member_of') VALUES ( '$pass','$login','$person','$name', '$phone', '$fax', '$tollfree', '$address', '$description',
'$longdist', '$license', `$license1`, '$email','$assocs')"; */

$sql = "SELECT COUNT(*) as nummembers from tblmembers WHERE Login='$login'"; 
$result = mysql_query($sql) or die("Query failed6");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($line[nummembers]!=0) {
	$message = "<font color=red>We are sorry, but login \"$login\" is already taken.<br>Please return to the previous page and select another login</a>";
	} else {
	
$query = "INSERT INTO `tblmembers` (`pass`,`Login`,`ContactPerson`,`MemberName`, `Phone`, 
`Fax`, `TollFree`, `Address`, `Description`, `ContactEmail`,`Associations`,`MemberType`,`ServiceCountry`) VALUES ( '$pass','$login','$person','$name', '$phone', '$fax', '$tollfree', '$address', '$description',
'$email','$assocs','$type','$country')"; 

$result = mysql_query($query) or $message = "An internal error occured, please repeat your request. If problem persists, contact <a href=\"mailto:admin@movinguwithcare.com\">webmaster</a>.";

$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `login`='$login'";
$result = mysql_query($sql) or die("Query failed7");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$newid = $line[MemberID]; 

$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`) VALUES ('$newid','$state')";
$result = mysql_query($sql) or die("Query failed8");

$uploaddir = 'logos/';
$uploadfile = $uploaddir . basename($HTTP_POST_FILES['Logo']['name']);
$realname = basename($HTTP_POST_FILES['Logo']['name']);

if (move_uploaded_file($HTTP_POST_FILES['Logo']['tmp_name'], $uploadfile)) 
{
	  $strQuery = "update tblmembers set Logo = '$realname' where MemberID = $newid";
	  $result = mysql_query($strQuery) or die("Query failed90");  
}

         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed2343");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed262");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail]; 
		 
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"logos/MUWC_Logo.gif\">" . $message . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MUWC - Registeration Confirmed";

		 //send_mail("$from","$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$newid', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed5559");
	                send_mail($from, $from, $newid, $Subject, $message);	
$message = "Your application has been accepted, Thank you.";

}
} 

?>

<?php if ($name) { ?>
</td>
    <td rowspan="5" bgcolor="#0066FF"></td>
    <td valign="top"><div align="center">
&nbsp;
</div></td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#0066FF" height="1"></td>
  </tr>
  <tr> 
    <td valign="top"><table width="95%" border="0" align="center">
        <tr> 
          <td><br>
  <p align="center"><strong><font size="-1" face="Arial, Helvetica, sans-serif">
<? echo $message ?>
</font></strong></p><br>
<center>
<a href="index.php?home=1">
<font size="-1" face="Arial, Helvetica, sans-serif">Return</font></a></center>
</td>
        </tr>
      </table>
      <div align="center" class="bottomtext"></div></td>
  </tr>
  <tr> 
    <td bgcolor="#0066FF" height="1"></td>
  </tr>
  <tr> 
    <td valign="top"><br><strong><font size="-1" face="Arial, Helvetica, sans-serif">
<?php

include("bottomtext");

?>
</font></strong></td>
  </tr>
</table>
</body>
</html>

<?php } ?>

<?php
if ($name) die;
///////////////////////////////////////////////////////////////////////////////
include "mem2js.php";

?>


 <p align="center"><strong><font size="-1" face="Arial, Helvetica, sans-serif">Become a 
    MovingUWithCare.com member</font></strong></p>
<form name ="form1" id="form1" method="post" action="<?=$SCRIPT_NAME?>" enctype="multipart/form-data">
  <table width="90%" border="0" align="center" style="font-family:Verdana;font-size:12px">
    <tr>
      <td><p>What kind of services you want to offer:<br /> <i>Please click on corresponding service.If you do offer more then one, please re-register for the other services</i></td>
      <td align="left"><input name="type" type="radio" onClick="setdata()" value="standard">
        Loading/Unloading Assistance<br />
        <input type="radio" name="type" value="full" onClick="setdata()">        
	Full service (Includes Packing, Loading, Transportation, Unloading, Unpacking and Warehousing)
<!--(<strong><s>$250</s> $100/month special price</strong>)--> <br />
	<input type="radio" name="type" value="transport" onClick="setdata()">        
	Transportation Services (Includes Local truck rental, long distance truck rental, truck with drivers, portable storage system)
<br />
     <input type="radio" name="type" value="storage" onClick="setdata()">        
	 Storage Facility (Provide storage locally and nationally, corporate storage facility providers, franchises, etc..)
<br />
	 <input type="radio" name="type" value="packing" onClick="setdata()">        
   Packing Supplies (All packing supplies providers able to ship locally and nationwide)
<br />
	


</td>
    </tr>
  </table>
<style>
#Agreement{
  background-image: url(semi.gif);
  width: 100%;
  height: 100%;
  top: 160px;
  left: 50px;
  height: 300px;
  width: 800px;
  z-index: 1000;
  visibility: hidden;
  position:absolute;
  text-align:center;
 
}
</style>

<div id="Agreement">
<script src="scripts/includethis.js">

</script>
<script src="scripts/prototype.js" type="text/javascript"></script>
  <script src="scripts/scriptaculous.js" type="text/javascript"></script>
<script>
ajaxinclude("affagreement.html");
var agreed=false;
</script>

<br />
<input type="button" class="button" onclick="Effect.Puff('Agreement');agreed=true;" value="Agree"/>
<input type="button" class="button" onclick="window.location='http://www.movinguwithcare.com';" value="Disagree"/>
</div>
<span id="newmember">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</span>
</div>
</form>
</td>
        </tr>
      </table>

			</div>
	   	</div>



<div id="bottom" class="white_links">
<div align="center"><a href="index.php?home=1">HOME</a> | <a href="index.php?lupu=1">LOADING/UNLOADING ASSISTANCE</a> | <a href="index.php?full=1">FULL SERVICE MOVERS</a> | <a href="index.php?tp=1">TRANSPORTATION PROVIDERS</a> | <a href="index.php?sf=1">STORAGE FACILITIES</a> | <a href="index.php?psm=1">PACKING SUPPLIES</a></div>
<br />
<div align="center" class="white_links"><span class="style13"><a href="index.php"><img src="images/icon_flag_usa.gif" border="0" /> </a> | <a href="index.php"><img src="images/icon_flag_canada.gif" border="0" /></a></span></div>
</div>
<div id="copy" align="center" class="style1"><b>&copy; MovingUWithCare Registered, 2006. All Rights Reserved. </b></div>
</div>
<div id="loaderContainer">
</div>
<script type="text/javascript">
//Start Ajax tabs script for UL with id="maintab" Separate multiple ids each with a comma.
//startajaxtabs("nav","top","mem1","faq1","bbb1")
startajaxtabs("nav","topamenu","faq1")
</script>
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