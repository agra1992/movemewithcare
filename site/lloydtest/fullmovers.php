<? 
session_start(); 
set_time_limit(60*60*60);
require ('../config.inc.php');
require_once("../seo.php");
require_once "../mailer.php";
include_once "../randchar_function.php";
require "../top_panel.php";
	   
$link = mysql_connect($db_host, $db_user, $db_password)
 or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

$ServiceSelector=$_POST[ServiceSelector];
$or_state=$_POST[or_state];
$or_city=$_POST[or_city];
$dor_state = $_POST[dor_state];
$dor_city = 0;//$_POST[dor_city];
$WeightLimit=$_POST[WeightLimit];
$full=$_POST[full];
$st_date=$_POST[st_date];
$from_this=$_POST[from_this];
$autofill=0;

//echo $top;

//next are the contents in ajaxcontentarea!
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
	if (MUWCForm.serv1.selectedIndex == -1){
		errorMsg += "\n\Type of Move \t\t- Please specify the type of Move: Local or Long Distance";
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
	if (MUWCForm.st_date.value == "") {
		errorMsg += "\n\Estimate Date of Move \t- Please specify the date of move.";
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
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<link href="../full_mov_list.css" rel="stylesheet" type="text/css">
<body>
<!--<script>
 <?//if($full=="yes") echo "setTimeout(\"get('or_state')\",2000)"; ?>
</script>
-->
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>  
   

<div style="float:left;width:150px;border:2px dotted;text-align:center;font-size:11px;font-family:Verdana;color:gray;margin-top:25px;">
<div style="margin:5px 5px 5px 5px;text-align:left;background-color:#dceffe;line-height:12pt;">
<img src="../images/fullservice_movers.gif" style="margin:5px auto;margin-left:18px" alt="fullservice_movers"/>
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> also provides you with Full service movers, either local or Long distance, providing you with services including: Packing, Loading, transportation, unloading and unpacking all your furniture in your new house or storage. This service is used when the customer wants a service that covers all aspect of a move. Let our professional movers handle it and let us make your relocation cost effective, time efficient and also very pleasant.
<br /> <br />
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> conducts business with industry professionals, who are accredited, licensed and insured, and most of all who can commit to unmatched customer service. 
With just few minutes of your time, we'll help you make your relocation request a successful and enjoyable one!
</div>
</div>

<br/>
<?
	if($from_this!="fullmovers")
		echo '<div align="left" style="width:600px;height:900px!important;height:2px;padding-left:150px!important;padding-left:0px;font-family:Verdana;font-size:12px;color:gray;font-size:12px;" >';	
?>

  <p>  
  
  <?
  
if($from_this=="fullmovers")
{

$user_domain = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$IP = $_SERVER['REMOTE_ADDR'];
$LeadId = randchar(7,"numeric");

$d = getdate(time());
$month = $d["mon"];
$year = $d["year"];
$day = $d["mday"];

if (strlen($month) == "1")
{
  $month = "0". $month;
}
if (strlen($day) == "1")
{
  $day = "0". $day;
}

$datevar = $year . "-" . $month . "-" . $day;

//allows one client to request only one moving at a time

/*$sql = "SELECT COUNT(*) as numorders from tbl_fs_orders WHERE IP = '$IP' AND OrderTime LIKE '$datevar%'";
	
	$result = mysql_query($sql) or die("Query failed2_IP");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($line[numorders]>2) 
	{
		$message = "<div align=\"center\"><font color=red><strong>We are sorry, but you are not allowed to post any more requests today.</strong></font></div>";
		echo $message;
		exit;
	} 
	
	*/
	
	$salut = $_POST[salut];
	$fname = $_POST[fname];
	$lname = $_POST[lname];
	$address = $_POST[address];
	$zipcode = $_POST[zipcode];
	$ph1 = $_POST[ph1];
	$ph2 = $_POST[ph2];
	$ph3 = $_POST[ph3];
	$phone1 = $ph1 . $ph2 . $ph3;	
	$ph4 = $_POST[ph4];
	$ph5 = $_POST[ph5];
	$ph6 = $_POST[ph6];
	$phone2 = $ph4 . $ph5 . $ph6;
	$email = $_POST[email];
	$serv1 = $_POST[serv1];
	$st_date = $_POST[st_date];		
	
$query = "INSERT INTO `tbl_fs_orders` (OrderID, Sal, FName, LName, Address, ZipCode, Phone, Phone2, EMail, Size, Or_State, Or_City, 
          Dest_State, Dest_City, IP, Domain , MoveType, MoveDate, OrderTime)
           VALUES ('$LeadId', '$salut', '$fname', '$lname', '$address', '$zipcode', '$phone1', 
					'$phone2', '$email', '$WeightLimit', '$or_state', '$or_city', '$dor_state', '$dor_city',
					'$IP', '$user_domain', '$serv1','$st_date', CURRENT_TIMESTAMP)";

$result = mysql_query($query) or die("Query failed: 111");

$CName =  $salut . " " . $fname . " " . $lname;


$sql = "SELECT COUNT(*) as numcustomers from tblcustomers WHERE email='$email'";
$result = mysql_query($sql) or die("Query failed2330");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
if (empty($line[numcustomers]))
{
   $sql = "INSERT INTO `tblcustomers` (Sal, FName, LName, Address, ZipCode, Phone, Phone2, email, DateAdded)
		     VALUES ('$salut', '$fname', '$lname', '$address', '$zipcode', $phone1, $phone2,
			   '$email', CURRENT_TIMESTAMP)"; 
   $result = mysql_query($sql) or die("Query failed309");
   
   $q="Select max(CustomerID) as CustID from tblcustomers;";
   $result = mysql_query($q) or die("Query failed: 2xx");
   $row = mysql_fetch_assoc($result);
   $newid=$row[CustID];	
} 


// -------------------------------- preparing email text

// find out name of origin city
$query = "SELECT `city` FROM `cities` WHERE `CityID`='$or_city' LIMIT 1";
$result = mysql_query($query) or die("Query failed: 2");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$or_cityd = $line[city];

// find out the full names of states
$query = "SELECT `name` FROM `states` WHERE `StateID`='$or_state' LIMIT 1";
$result = mysql_query($query) or die("Query failed: 4");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$or_stated = $line[name];

$query = "SELECT `name` FROM `states` WHERE `StateID`='$dor_state' LIMIT 1";
$result = mysql_query($query) or die("Query failed: 5");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$dest_stated = $line[name];



/*$query10 = "Select tblmembers.MemberID,tblmembers.MemberName,CONCAT(SUBSTR(tblmembers.Description,1,300),'...') as Description,
           tblmembers.Logo, tblmembers.TollFree, tblmembers.ContactEmail
             From tblmembers
                 Inner Join tblmember_servicecity ON tblmembers.MemberID = tblmember_servicecity.MSID
               Where tblmembers.Active = '1' AND tblmembers.InterstateLicense = '1' AND tblmembers.MemberType = 'full' AND
                          (tblmembers.MC <> '' OR tblmembers.USDot <> '') AND
                     tblmember_servicecity.StateID IN (999,$or_state)"; 
*/
		$query = "SELECT `sh_name` FROM `states` WHERE `StateID`='$or_state' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 4");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$or_shname = $line[sh_name];	
		
		$query = "SELECT `sh_name` FROM `states` WHERE `StateID`='$dor_state' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 4");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$dor_shname = $line[sh_name];
		

//mail part
         $sql = "SELECT admin_email from tbladmin";
	     $result1 = mysql_query($sql) or die("Query failed233");
	     $line = mysql_fetch_array($result1, MYSQL_ASSOC);
         $AdminMail = $line[admin_email];         

		 $origin = $or_cityd . "," . $or_stated; 
		 $dest = $dest_stated;
		 
		 //sending mail to admin
		 $Subject = "New Lead from customer";		 
		 $sql = "SELECT Detail from tbl_templates WHERE TempID='27'"; 
	     $result = mysql_query($sql) or die("Query failed23");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail];
         		 
         $message  = str_replace ("%CustName%", $CName, $temp_message);         
		 $message  = str_replace ("%TelW%", $phone1, $message);		 	 
		 $message  = str_replace ("%TelH%", $phone2, $message);
		 $message  = str_replace ("%mdate%", $st_date, $message);		 
		 if ($serv1=='0')
		 	$TM = 'Local';
		 else
		 	$TM = 'Long Distance';		 
		 $message  = str_replace ("%TM%", $TM, $message);
		 $message  = str_replace ("%from%", $origin, $message);		 
		 $message  = str_replace ("%to%", $dest, $message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
		 $message = nl2br($message);
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES 
		 		('7', '$AdminMail', '$AdminMail', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed5");		              	 
                send_mail($AdminMail, $AdminMail, $AdminMail, $Subject, $message);		 
		 
		//sending mail to full members
		
		if ($or_state < 52 && $dor_state < 52)
		{
		 	if ($or_state != $dor_state)
			 	$query10 = "Select tblmembers.MemberID,tblmembers.MemberName,CONCAT(SUBSTR(tblmembers.Description,1,300),'...') as Description,
		           	tblmembers.Logo, tblmembers.TollFree, tblmembers.ContactEmail
		            From tblmembers Where tblmembers.MemberType = 'full' AND tblmembers.Active = '1' AND
						   (tblmembers.MemberState = '$or_state' AND tblmembers.ZipCode like 'NA%')";
		 	else
		 		$query10 = "Select tblmembers.MemberID,tblmembers.MemberName,CONCAT(SUBSTR(tblmembers.Description,1,300),'...') as Description,
	           	tblmembers.Logo, tblmembers.TollFree, tblmembers.ContactEmail
	            From tblmembers Where tblmembers.MemberType = 'full' AND tblmembers.Active = '1' AND
					   tblmembers.MemberState = '$or_state'";		 	
		}		 		 
		 
		 $result = mysql_query($query10) or die("Query failed233");
		 $ret= array();
		 $num = mysql_num_rows($result);
		 for($i=0;$i<$num;$i++)
		 {
		 	array_push($ret,mysql_fetch_row($result));
		 }		 
		 
		 $sql = "SELECT Detail from tbl_templates WHERE TempID='9'"; 
	     $result = mysql_query($sql) or die("Query failed23");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail];
         
         $Subject = "Full Service Leads";		 
         $message  = str_replace ("%CustName%", $CName, $temp_message);         
		 $message  = str_replace ("%TelW%", $phone1, $message);		 	 
		 $message  = str_replace ("%TelH%", $phone2, $message);
		 $message  = str_replace ("%mdate%", $st_date, $message);		 
		 if ($serv1=='0')
		 	$TM = 'Local';
		 else
		 	$TM = 'Long Distance';		 
		 $message  = str_replace ("%TM%", $TM, $message);
		 $message  = str_replace ("%from%", $origin, $message);		 
		 $message  = str_replace ("%to%", $dest, $message);
		 
		 if ($WeightLimit=="0_Partial Home 500-1000 lbs")
		 	$size = "Partial Home 500-1000 lbs";
		 else if ($WeightLimit=="0_Studio 1500 lbs")
		 	$size = "Studio 1500 lbs";
		 else if ($WeightLimit=="1_1 BR Small 3000 lbs")
		 	$size = "1 Small Bedroom";
		 else if ($WeightLimit=="1_1 BR Large 4000 lbs")
		 	$size = "1 Large Bedroom  4000 lbs";
		 else if ($WeightLimit=="1_2 BR Small 4500 lbs")
		 	$size = "2 Small Bedrooms 4500 lbs";
		 else if ($WeightLimit=="1_2 BR Large 6500 lbs")
		 	$size = "2 Large Bedrooms 6500 lbs";
		 else if ($WeightLimit=="1_3 BR Small 8000 lbs")
		 	$size = "3 Small Bedrooms 8000 lbs";
		 else if ($WeightLimit=="1_3 BR Large 9000 lbs")
		 	$size = "3 Large Bedrooms 9000 lbs";
		 else if ($WeightLimit=="1_4 BR Small 10000 lbs")
		 	$size = "4 Small Bedrooms 10000 lbs";
		 else if ($WeightLimit=="1_4 BR Large 12000 lbs")
		 	$size = "4 Large Bedrooms 12000 lbs";
		 else if ($WeightLimit=="1_Over 12000 lbs")
		 	$size = "Over 12000 lbs";
		 	
		 $message  = str_replace ("%size%", $size, $message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
		 $message = nl2br($message);
		 		 
		 foreach($ret as $val)
		 {
			$memberEmail = $val[5];		  
			$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES 
					('7', '$AdminMail', '$memberEmail', '$Subject', '$message')";
			$result = mysql_query($sql) or die("Query failed5");
                        send_mail($AdminMail, $AdminMail, $memberMail, $Subject, $message);
		 }

 		//sending mail to customer
         $sql = "SELECT Detail from tbl_templates WHERE TempID='8'"; 
	     $result = mysql_query($sql) or die("Query failed23");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail];
		 
         $Subject = "Your request has been accepted";
         $message  = str_replace ("%LeadId%", $LeadId, $temp_message);
		 $message  = str_replace ("%CN%", $CName, $message);		 
		 $message = "<font face=\"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font><br><br>";
		 $message = nl2br($message);
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('4', '$AdminMail', '$email', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed5");
                 send_mail($AdminMail, $email, $memberMail, $Subject, $message);
?>
	<br />  
	<div align="center">
    <font style="FONT: bold 17px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 2px;"> 
    <center>Dear
<? echo $CName ?>, Your Request has been accepted.
    <br />
</font>
<font style="text-align:left;FONT: bold 14px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 1px;">
        Your request has been successfully placed and you shall be contacted shortly.<br />
    <br />
</font>
<span class="style1">
	Your Request # is : <?=$LeadId?></span> <br />
  </center>
 <br />
 
 <? 
 $result10 = mysql_query($query10) or die("Query failed: 6");
 if (mysql_num_rows($result10) != 0)
 {
    ?>The following are few among the vast number of accredited movers with whom your request has been placed.
    <?
 }
 else
 {
 	echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
 }


echo "<table>";

while ($line = mysql_fetch_array($result10, MYSQL_ASSOC))
{
	if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";
	echo "<tr $style>";
	echo "<td>";
	echo "<span class=\"Cname\">".$line[MemberName]. " (Toll Free:" . $line[TollFree] . ")" . "</span><br />";
	echo "<font size=2>".$line[Description]."</font>";
	echo "</td>";
	echo "<td>";
	echo "<img src='../logos/$line[Logo]' height='100' width='200'/>";
	echo "</td>";
	echo "</tr>";

}
echo "</table><br/><br/>";
?>

    <?}

   else {?>
   
  <form name="form1" method="post" action="" onSubmit="return validate_form(this);">
 <table width="393" border="0" cellspacing="0" cellpadding="0" name="top" style="margin-left:60px;font-family:'Verdana,Arial';color:Gray">
				<tr>
 
				<td width="63" align=left valign=bottom><img src="../images/top_qq_left.gif" width="63" height="19"></td>
										<td width="100"><img src="../images/spacer.gif" width="50px" height="1px" /></td>
					<td height="19" width="100%" align=center valign=bottom colspan="2">
						<font style="FONT: bold 15px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 3px;">
	
	<? 
	if($full=="yes")
		echo "Full Movers Request Form";
	else if($from_this=="fullmovers")
		echo "from fullmovers";
	else 
		die("Unauthorized Attempt");
	?> 
</font>
					</td>
					<td width="100"><img src="../images/spacer.gif" width="50px" height="1px" /></td>
					<td width="63" align=right valign=bottom><img src="../images/top_qq_right.gif" width="63" height="19"></td>
				</tr>

			<table width="100%" border="0" cellspacing="0" cellpadding="8" >
	 <a name="top">		
   <tr>
   <td width="37%"> <div id="err" style="visibility:visible;float:right;" align="left"></div></td>
   <td >&nbsp;   </td>
   </tr>
	
    <tr> 
      <td width="37%"><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Salutation:</font></div></td>
      <td width="63%"><select name="salut" id="salut" class="formobject" >
          <? if($autofill) 
		  echo "<option value=$salute selected> $salute </option>";
		  else { ?>
		  <option value="Mr.">Mr.</option>
          <option value="Mrs.">Mrs.</option>
          <option value="Ms.">Ms.</option>
		  <? } ?>
        </select></td>
    </tr>
    <tr> 
      <td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">First 
          name:</font></div></td>
      <td><input name="fname" type="text" alt="First Name" class="formobject" id="fname" maxlength="100" <?if($autofill) echo "value='$fname'";?>></td>
    </tr>
    <tr> 
      <td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Last 
          name:</font></div></td>
      <td><input name="lname" type="text" alt="Last Name"class="formobject" id="lname" maxlength="100"<?if($autofill) echo "value='$lname'";?>></td>
    </tr>
    <tr> 
      <td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Current Street Address:</font></div></td>
      <td><input name="address" type="text" alt="Address" class="formobject" id="address" maxlength="250" <?if($autofill) echo "value='$address'";?>></td>
    </tr>
	<tr>
   <td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Current State/Province:</td>
 
<td>
 
      <select name="or_state" size="1" id="or_state" onChange="get(this);" style="width: 170px; ">
            <option value="">Select State/Province</option>
<?


$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=999'; 

$result = mysql_query($sql) or die("Query failed");

// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";
if ($line[StateID]!=52)
	echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
else
	echo ("<option value=\"$line[StateID]\" $style $sel>$line[name]</option>");  
}

?>  	
  </select>
<br>
</td>
    </tr>
	<tr> 
      <td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Current City:<br />         <div id="cityrec">
	  <i>
<?         if (session_is_registered('city') || $or_city)
echo "if this is not your city, please re-select appropriate state from above.";
else
echo "if your city is not listed, please select nearest location.";
?>
</i></div></p></td>
					<td valign="top"> <div align="left"> 
         
<?         if (session_is_registered('city')) {
			$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `CityID`='$or_city' "; 
	$result = mysql_query($sql) or die("Query failed");	
	
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$city_name=$line[city];
	}

?>
		 <select name="or_city" size="7" id="or_city" style="width: 170px;" onChange="AllowNext();">
		<option value="<?=$city ?>" selected><?=$city_name ?></option>
<? } else if ($or_city) {
			$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `CityID`='$or_city' "; 
	$result = mysql_query($sql) or die("Query failed");	
	
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$city_name=$line[city];
	}

	?>
		 <select name="or_city" size="7" id="or_city" style="width: 170px;" onChange="AllowNext();">
		<option value="<?=$or_city ?>" selected><?=$city_name ?></option>
<? } else { ?>
 <select name="or_city" size="7" id="or_city" style="width: 170px;" onChange="AllowNext();">
<? } ?>
            </select>	</td>
    </tr>
    <tr> 
      <td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">ZipCode/Postal Code:</font></div></td>
      <td><input name="zipcode" type="text" alt="Zip" id="zipcode" size="7" maxlength="7" class="formobject" <?if($autofill) echo "value='$zip'";?>></td>
    </tr>
    <tr> 
  		<td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Phone number (work):</font></div></td>
  		<td><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">
  			( <input name="ph1" type="text" alt="Area Code" id="ph1" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph2",event,"ph1")' <?if($autofill) echo "value='$ph1'";?>> ) 
	        <input name="ph2" type="text" alt="Phone" id="ph2" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph3",event,"ph1")' <?if($autofill) echo "value='$ph2'";?>>
	        - <input name="ph3" type="text" id="ph3" size="4" maxlength="4" class="formobject" onKeyUp='Move(this,4,"ph3",event,"ph2")' <?if($autofill) echo "value='$ph3'";?>></font></td>
    </tr>
 	<tr> 
  		<td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Phone number (home):</font></div></td>
  		<td><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">
  		( <input name="ph4" type="text" alt="Area Code"id="ph4" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph5",event,"ph4")' <?if($autofill) echo "value='$ph4'";?>> ) 
        <input name="ph5" type="text" alt="Phone" id="ph5" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph6",event,"ph4")' <?if($autofill) echo "value='$ph5'";?>>
        - <input name="ph6" type="text" id="ph6" size="4" maxlength="4" class="formobject" onKeyUp='Move(this,4,"ph6",event,"ph5")' <?if($autofill) echo "value='$ph6'";?>></font></td>
	</tr>
    <tr> 
  		<td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Email address:</font></div></td>
  		<td><input name="email" type="text" alt="E-Mail Address" id="email" class="formobject" <?if($autofill) echo "value='$email'";?>></td>
    </tr>	
	<tr>
		<td><div align="right"></div></td>
		<td>&nbsp;</td>
	</tr>
	
	<tr><td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Type of Move:<br>
	    </font></div></td>
	<td><select name="serv1" alt="Type Of Move" id="serv1" size=2 style="width:154px">
		<? if($autofill)
		{
			if($typemove=="Local")
			$sel1 = "selected";
			else if($typemove=="Long")
			$sel2 = "selected";
			else{
			$sel1 = "";
			$sel2 = "";}
		}
		?>
		<option value="0" <?=$sel1 ?>>Local</option>
        <option value="1" <?=$sel2 ?> style="background : #dceffe" >Long Distance</option></select></td></tr>        
        <input type="hidden" name="from_this" value="fullmovers" id="from" />
		<input type="hidden" name="dor_state" value=<?=$dor_state ?>>
		<input type="hidden" name="or_city" value=<?=$or_city ?>>	
		<input type="hidden" name="WeightLimit" value='<?=$WeightLimit; ?>'>
<tr><td>
<div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">
Estimate Date of Moving: <br>
<i>yyyy-mm-dd</i>
</font></div>
</td><td>
<input name="st_date" type="text" style="margin-left:0px;" alt="Estimate Date of Moving" id="st_date" class="formobject" size="10" maxlength="10" readonly onMouseOver="overlib('Please click on the calendar link to the right and choose a date from pop-up calendar.');return true;" onMouseOut="window.status=''; nd(); return true;">
<a href="javascript:show_calendar('form1.st_date');" onMouseOver="window.status='Date Picker'; overlib('Click here to choose a date from pop-up calendar.'); return true;" onMouseOut="window.status=''; nd(); return true;">Pick from calendar</a>
</td></tr>

  <tr align="center"><td>&nbsp;</td><td align="left"><input type="submit" name="Submit" value="Request a Full Mover" id="next" STYLE="width: 320px; font-size: x-small; font-family: Arial; color: #; background-color: #dceffe; border: 1 outset #;margin-right:50px;"></td></tr>
<tr>
 <td width="10" background="/images/right_dot_line.gif"></td>
		</tr>
		<tr> 
		  <td colspan="3"><img src="../images/bottom_qq.gif" width="393" height="9" style="padding-left:60px;"></td>
		</tr>
  </table>
</form>	
<? } // if form is not submitted

	
?> 	

			
			</div>
	   	</div>
<? 
		include "../bottom_panel.php"; 
?>
</html>



