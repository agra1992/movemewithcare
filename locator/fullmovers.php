<? 

session_start(); 

set_time_limit(60*60*60);

require ('../config.inc.php');

require_once("../seo.php");

require_once "../mailer.php";

include_once "../randchar_function.php";

require "../top_panel.php";

$cryptinstall="../crypt/cryptographp.fct.php";

include $cryptinstall; 



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





$salut = $_POST[salut];

	$fname = $_POST[fname];

	$lname = $_POST[lname];

	$address = $_POST[address];

	$zipcode = $_POST[zipcode];

	$ph1 = $_POST[ph1];

	$ph2 = $_POST[ph2];

	$ph3 = $_POST[ph3];

	$ph4 = $_POST[ph4];

	$ph5 = $_POST[ph5];

	$ph6 = $_POST[ph6];

	$email = $_POST[email];

	$st_date = $_POST[st_date];	



if (!chk_crypt($_POST['code']) && $from_this=="fullmovers" ) {

echo "<a><font color='#FF0000'>Sorry, That was the wrong captcha code</font></a>";

$from_this="";

$full="yes";

}





	$autofill = false;



$add=array(array());

$sql = 'Select Add_Number,Description, Image,Link From add_manager Where Add_Number>13 AND Add_Number<18';



$r = mysql_query($sql) or die("Query failed_LUPU $sql");

while($result = mysql_fetch_array($r, MYSQL_ASSOC))

{

    $add[$result[Add_Number]][0]=$result[Description];

    $add[$result[Add_Number]][1]=$result[Image];

    $add[$result[Add_Number]][2]=$result[Link];

}

//echo $top;







function send_sms($message)

{



    $sms_query= "SELECT Phone from sms_admins Where 1";

    $sms_r=mysql_query($sms_query);

    while($sms_result = mysql_fetch_assoc($sms_r))

    {

        $phone = $sms_result[Phone];

        send_mail ($phone, $phone, $phone, "new order", $message);

        $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$phone', '$phone', 'sms_new order', '$message')";

		 $result = mysql_query($sql) or die("Query failed5");

    }

}







function last_order_date($IP)

{

$date="";

$days_month = array(31,28,31,30,31,30,31,31,30,31,30,31);

    $sql="SELECT LastFull FROM tblcustomers WHERE IP='$IP'";

    $r=mysql_query($sql);

    while($result=mysql_fetch_row($r))

    {

        $date=$result[0];

    }



if($date!=""){

    $date=explode("-",$date);

    $current_date=date("z-Y");

    $current_date=explode("-",$current_date);

    if($current_date[1] == $date[1]){

        if($current_date[0]-$date[0] >4){

            return true;

        }else{

            return false; 

        }

    }

    else

    {

        if(365-$date[0]+$current_date[0]>4){

            return true;

        }else{

            return false;

        }

    }

}

else{ //if this is their first lupu order



    return true;

}



}



$IP = $_SERVER['REMOTE_ADDR'];



$work=false;

$work=last_order_date($IP);

if($work==true){

}else{ //end date test

    echo"Sorry, You have already put in an order in the past five days";

exit;}



//next are the contents in ajaxcontentarea!

?>

<style type="text/css">

    #main_frame{width:100px;}

</style>

<!--[if IE 6]>

<style type="text/css">

    #main_frame{width:100px;}

</style>

<![endif]-->



<!--[if IE 7]>

<style type="text/css">



</style>

<![endif]-->



<script language="javascript" src="../cal.js"> </script>
<script type="text/javascript" src="../datetimepicker_css.js"></script>
<script language="javascript" src="../../old_site/overlib_mini.js"> </script>

<script language="JavaScript" src="../../old_site/mov.js"></script>

<link rel="stylesheet" type="text/css" href="/tabs.css" />

<link rel="stylesheet" type="text/css" href="/result.css" />

<link rel="stylesheet" type="text/css" href="../../old/site/add_style.css" />



<SCRIPT LANGUAGE="JavaScript">

function new_add_window(add_path)

{

    add_window=window.open(add_path, "Add Images", "width=300, height=150,scrollbars=yes,resizable=yes ,toolbar=yes")

    add_window.focus();

}



</SCRIPT>





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

<link href="../../old_site/full_mov_list.css" rel="stylesheet" type="text/css">

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="180" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top"><div style="padding:5px;background-color:#E6F7EA" >
              <div > <img src="../images/fullservice_movers.gif" alt="fullservice_movers"/> <br>
                        <div align="justify"> <span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MoveMewithcare.com</span> also provides you with Full service movers, either local or Long distance, providing you with services including: Packing, Loading, transportation, unloading and unpacking all your furniture in your new house or storage. This service is used when the customer wants a service that covers all aspect of a move. Let our professional movers handle it and let us make your relocation cost effective, time efficient and also very pleasant. <br />
                            <br />
                            <span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MoveMewithcare.com</span> conducts business with industry professionals, who are accredited, licensed and insured, and most of all who can commit to unmatched customer service. 
                          With just few minutes of your time, we'll help you make your relocation request a successful and enjoyable one! </div>
              </div>
            </div></td>
          </tr>
        </table></td>
        <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="97%" align="left" valign="top"><?
if($from_this!="fullmovers")
{
?>
                    <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
              <?
}?>
                    <br>
                    <br>
                    <?
	if($from_this!="fullmovers")
		echo '<div align="left" style="width:400px" >';	
?>
                    <p>
                      <?

 
if($from_this=="fullmovers" )
{
$user_domain = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$IP = $_SERVER['REMOTE_ADDR'];
$LeadId = randchar(7,"numeric");




$d = getdate(time());
$month = $d["mon"];
$year = $d["year"];
$day = $d["mday"];
$full_service_comp=array(array());
$count=0;
if (strlen($month) == "1")
{
  $month = "0". $month;
}
if (strlen($day) == "1")
{
  $day = "0". $day;
}

$datevar = $year . "-" . $month . "-" . $day;


	
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
if($or_state==$dor_state){
    $serv1=0;}
else{
    $serv1=1;}
	$st_date = $_POST[st_date];		

    $c_date=date("z-Y");

    $sql="UPDATE tblcustomers SET LastFull='$c_date'";
    $r=mysql_query($sql);

$query = "INSERT INTO `tbl_fs_orders` (OrderID, Sal, FName, LName, Address, ZipCode, Phone, Phone2, EMail, Size, Or_State, Or_City, 
          Dest_State, Dest_City, IP, Domain , MoveType, MoveDate, OrderTime)
           VALUES ('$LeadId', '$salut', '$fname', '$lname', '$address', '$zipcode', '$phone1', 
					'$phone2', '$email', '$WeightLimit', '$or_state', '$or_city', '$dor_state', '$dor_city',
					'$IP', '$user_domain', '$serv1','$st_date', CURRENT_TIMESTAMP)";

$result = mysql_query($query) or die("Query failed: 111");

$CName =  $salut . " " . $fname . " " . $lname;


$sql = "SELECT COUNT(*) as numcustomers from tblcustomers WHERE IP='$IP'";
$result = mysql_query($sql) or die("Query failed2330");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
if (empty($line[numcustomers]))
{
   $sql = "INSERT INTO `tblcustomers` (Sal, FName, LName, Address, ZipCode, Phone, Phone2, email, DateAdded , IP)
		     VALUES ('$salut', '$fname', '$lname', '$address', '$zipcode', $phone1, $phone2,
			   '$email', CURRENT_TIMESTAMP, '$IP')"; 
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
	     $result1 = mysql_query($sql) or die("Query failed233 $sql");
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
		 $message  = str_replace ("%CustEmail%", $email, $message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
		 $message = nl2br($message);
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES 
		 		('7', '$AdminMail', '$AdminMail', '$Subject', '$message','$LeadId')";
		 $result = mysql_query($sql) or die("Query failed5");		              	 
		 send_mail($AdminMail, $AdminMail, $AdminMail, $Subject, $message);
	         send_sms("New Full service order");
		//sending mail to full members
		
$proace="";
$country="";
if($or_state<52){
$proace="OR tblmembers.MemberID='915'";
$country="USA";
}else{
$country="canada";
}
		 	if ($or_state != $dor_state)
			 	$query10 = "Select tblmembers.MemberID,tblmembers.MemberName,tblmembers.Associations,CONCAT(SUBSTR(tblmembers.Description,1,300),'...') as Description,
		           	tblmembers.Logo, tblmembers.TollFree, tblmembers.ContactEmail,  tblmembers.USDot, tblmembers.MC, tblmembers.sms_service, tblmembers.sms_address
		            From tblmembers Where tblmembers.MemberType = 'full' AND tblmembers.Active = '1' AND tblmembers.InterstateLicense = '1' AND
						   ((tblmembers.State like 'NA'  && tblmembers.MemberState='$or_state') || (tblmembers.MemberState='999' && tblmembers.ServiceCountry='$country'))". $proace ."  Order by RAND()";
		 	else
		 		$query10 = "Select tblmembers.MemberID,tblmembers.MemberName,tblmembers.Associations,CONCAT(SUBSTR(tblmembers.Description,1,300),'...') as Description,
	           	tblmembers.Logo, tblmembers.TollFree, tblmembers.ContactEmail,  tblmembers.USDot, tblmembers.MC, tblmembers.sms_service, tblmembers.sms_address
	            From tblmembers Where tblmembers.MemberType = 'full' AND tblmembers.Active = '1' AND
					   (tblmembers.State = '$or_shname' OR (tblmembers.State like 'NA' && tblmembers.MemberState='$or_state') OR (tblmembers.MemberState='999' && tblmembers.ServiceCountry='$country')) Order by RAND()";		 	
			
		 $result = mysql_query($query10) or die("Query failed234 $query10");
		 $ret= array();
		 $num = mysql_num_rows($result);
		 for($i=0;$i<$num;$i++)
		 {
		 	array_push($ret,mysql_fetch_assoc($result));
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
		 $message  = str_replace ("%CustEmail%", $email, $message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
		 $message = nl2br($message);
	 
		 foreach($ret as $val)
		 {

			$memberEmail = $val[ContactEmail];		
$full_service_comp[$count][0]=$val[MemberName];		
$full_service_comp[$count][1]=$val[TollFree];		
$full_service_comp[$count][2]=$memberEmail;		
$count++;  
			$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES 
					('7', '$AdminMail', '$memberEmail', '$Subject', '$message','$LeadId')";
			$result = mysql_query($sql) or die("Query failed5");
                 send_mail($AdminMail, $AdminMail, $memberEmail, $Subject, $message);

                 if($val[sms_service]=="yes" && $val[sms_address]!="")
                 {

                 send_mail($AdminMail, $AdminMail, $val[sms_address], "New Lead", "CName:$CName 
 CP#:$phone1
DOM:$st_date
From:$or_shname To:$dor_shname
SOM:$size
");
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES ('4', '$AdminMail', '$val[sms_address]', 'New Lead', 'A new Lead been posted to your member panel. 
Please log in to your panel for more details.
 Thank you ','$LeadId')";
		 $result = mysql_query($sql) or die("Query failed5");
                 }
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
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES ('4', '$AdminMail', '$email', '$Subject', '$message','$LeadId')";
		 $result = mysql_query($sql) or die("Query failed5");
                 send_mail($AdminMail, $AdminMail, $email, $Subject, $message);
?>
                    <div align="center"> <font style="FONT: bold 17px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 2px;">
                        <center>
                          Dear <? echo $CName ?>, Your Request has been accepted. <br />
                          </font> <font style="text-align:left;FONT: bold 14px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 1px;"> Your request has been successfully placed and you shall be contacted shortly.<br />
                            <br />
                            </font> <span class="style1"> Your Request # is :
                              <?=$LeadId?>
                              </span> <br />
                        </center>
                      <br />
                        <? 
 $result10 = mysql_query($query10) or die("Query failed: 6");
 if (mysql_num_rows($result10) != 0)
 {
//send companies to customer
if($count>0)
{
    $list="Dear $CName, \n
    Here is a list of the moving companies in your area that may help you.\n";


    for($i=0; $i<$count; $i++)
    { 
        $list.="Mover Information: \n";
        $list.="Name:  ".$full_service_comp[$i][0]."\n"; 
        $list.="TollFree:  ".$full_service_comp[$i][1]."\n";
        $list.="Email:  ".$full_service_comp[$i][2]."\n\n\n";
    }
			$list = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $list ."</center></font><br><br>";
			$list = nl2br($list);
send_mail($AdminMail, $AdminMail, $email, "Full Service list", $list);
}

    ?>
                      The following are few among the vast number of accredited movers with whom your request has been placed.
                      <?
 }
 else
 {
 	echo "We appreciate you taking the time to fill the information needed to find accredited movers. However, no certified and accredited movers are available to service your area. We are constantly searching for top of the line movers across our great nation to service every of our customers. We greatly apologize for this inconvenience but we assure you that we are still researching for these movers as we speak. Thanks for your undestanding.<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
 }


echo "<table>";
$which_color=1;

while ($line = mysql_fetch_array($result10, MYSQL_ASSOC))
{
switch ($line[Associations]) {
case 1:
$assoc="ACD";
    break;
case 2:
$assoc="AMSA";
    break;
case 3:
$assoc="BBB";
    break;
case 4:
$assoc="CAD";
    break;
case 5:
$assoc="HHGFAA";
    break;
}

if($which_color%2==0){
$color='#FBF7EB';}
else{
$color='#EDFBEB';}
$which_color++;

echo"
<table bgcolor='$color' width='70%' align='center'>
<tr >
      <td colspan='3' class=result_name > ".$line[MemberName]."</td>    
</tr>
<tr >     
      <td ><img src='../logos/".$line['Logo']."' height='60' width='120'></td>

      <td width='400' class=regular_result_text>&bull;Toll Free: ". $line[TollFree] ."<br>
       &bull; Association: $assoc <br>
       &bull; Description: ".$line[Description]."</td>
      <td class=license_info>
      &bull;MC: ".$line[MC]."<br>
      &bull;USDot: ".$line[USDot]."
        </td>

</tr>
</table>
";    
   

}
echo "</table><br/><br/>";
?>
                      <?}

   else {?>
                      <form name="form1" method="post" action="" onSubmit="return validate_form(this);">
                        <table  border="0" cellspacing="0" cellpadding="0" name="top" id="tab_gray_text" id="main_frame">
                      </form>
                    </div></td>
          </tr>
          <tr>
            <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="8" ><tr><td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="8" >
              <tr>
                <td colspan="2" align="center" valign="top"><h2 >
                    <? 
	if($full=="yes")
		echo "Full Movers Request Form";
	else if($from_this=="fullmovers")
		echo "from fullmovers";
	else 
		die("Unauthorized Attempt");
	?>
                </h2></td>
              </tr>
              <tr>
                <td width="44%"><div align="right">Salutation:</div></td>
                <td width="56%"><select name="salut" id="salut" class="formobject" >
                    <? 
                          if($salut=="Mr." ||  $salut=="Mrs."|| $salut=="Ms."){
                              echo"<option value='$salut' selected>$salut</option>";
                           }

                if($autofill) 
		  echo "<option value=$salute selected> $salute </option>";
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
                <td><input name="fname" type="text" alt="First Name" class="formobject" id="fname" maxlength="100" <?if($autofill) {echo "value='$fname'";}else if($fname){echo"value='$fname'";}?> /></td>
              </tr>
              <tr>
                <td><div align="right">Last 
                  name:</div></td>
                <td><input name="lname" type="text" alt="Last Name"class="formobject" id="lname" maxlength="100"<?if($autofill) {echo "value='$lname'";}else if($lname){echo"value='$lname'";}?> /></td>
              </tr>
              <tr>
                <td><div align="right">Current Street Address:</div></td>
                <td><input name="address" type="text" alt="Address" class="formobject" id="address" maxlength="250" <?if($autofill){ echo "value='$address'";}else if($address){echo"value='$address'";}?> /></td>
              </tr>
              <tr>
                <td><div align="right"> Current State/Province:</div></td>
                <td><select name="or_state" size="1" id="or_state" onChange="get(this);" style="width: 170px; ">
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
                    <br />                </td>
              </tr>
              <tr>
                <td><div align="right"> Current City:<br />
                        <div id="cityrec"> <i>
                          <?         if (session_is_registered('city') || $or_city)
echo "if this is not your city, please re-select appropriate state from above.";
else
echo "if your city is not listed, please select nearest location.";
?>
                        </i></div>
                  <p></p>
                </div></td>
                <td valign="top"><div align="left">
                    <?         if (session_is_registered('city')) {
			$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `CityID`='$or_city' "; 
	$result = mysql_query($sql) or die("Query failed");	
	
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$city_name=$line[city];
	}

?>
                    <select name="or_city" size="1" id="or_city" style="width: 170px;" onChange="AllowNext();">
                      <option value="<?=$city ?>" selected="selected">
                      <?=$city_name ?>
                      </option>
                      <? } else if ($or_city) {
			$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `CityID`='$or_city' "; 
	$result = mysql_query($sql) or die("Query failed");	
	
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$city_name=$line[city];
	}

	?>
                      <select name="or_city" size="1" id="or_city" style="width: 170px;" onChange="AllowNext();">
                      <option value="<?=$or_city ?>" selected="selected">
                      <?=$city_name ?>
                      </option>
                      <? } else { ?>
                      <select name="or_city" size="7" id="or_city" style="width: 170px;" onChange="AllowNext();">
                      <? } ?>
                    </select>
                </div></td>
              </tr>
              <tr>
                <td><div align="right">ZipCode/Postal Code:</div></td>
                <td><input name="zipcode" type="text" alt="Zip" id="zipcode" size="7" maxlength="7" class="formobject" <?if($autofill) {echo "value='$zip'";}else if($zipcode){echo"value='$zipcode'";}?> /></td>
              </tr>
              <tr>
                <td><div align="right"> Destination State/Province:</div></td>
                <td><select name="dor_state" size="1" id="dor_state" style="width: 170px; ">
                    <option value="">Select State/Province</option>
                    <?


$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=999'; 

$result = mysql_query($sql) or die("Query failed");

// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

if ($dor_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";
if ($line[StateID]!=52)
	echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
else
	echo ("<option value=\"$line[StateID]\" $style $sel>$line[name]</option>");  
}

?>
                  </select>
                    <br />                </td>
              </tr>
              <tr>
                <td><div align="right">Phone number (work):</div></td>
                <td><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif"> (
                  <input name="ph1" type="text" alt="Area Code" id="ph1" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,&quot;ph2&quot;,event,&quot;ph1&quot;)' <?if($autofill) {echo "value='$ph1'";}else if($ph1){echo"value='$ph1'";}?> />
                  )
                  <input name="ph2" type="text" alt="Phone" id="ph2" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,&quot;ph3&quot;,event,&quot;ph1&quot;)' <?if($autofill) {echo "value='$ph2'";}else if($ph2){echo"value='$ph2'";}?> />
                  -
                  <input name="ph3" type="text" id="ph3" size="4" maxlength="4" class="formobject" onKeyUp='Move(this,4,&quot;ph3&quot;,event,&quot;ph2&quot;)' <?if($autofill) {echo "value='$ph3'";}else if($ph3){echo"value='$ph3'";}?> />
                </font></td>
              </tr>
              <tr>
                <td><div align="right">Phone number (home):</div></td>
                <td><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif"> (
                  <input name="ph4" type="text" alt="Area Code"id="ph4" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,&quot;ph5&quot;,event,&quot;ph4&quot;)' <?if($autofill) {echo "value='$ph4'";}else if($ph4){echo"value='$ph4'";}?> />
                  )
                  <input name="ph5" type="text" alt="Phone" id="ph5" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,&quot;ph6&quot;,event,&quot;ph4&quot;)' <?if($autofill){ echo "value='$ph5'";}else if($ph5){echo"value='$ph5'";}?> />
                  -
                  <input name="ph6" type="text" id="ph6" size="4" maxlength="4" class="formobject" onKeyUp='Move(this,4,&quot;ph6&quot;,event,&quot;ph5&quot;)' <?if($autofill) {echo "value='$ph6'";}else if($ph6){echo"value='$ph6'";}?> />
                </font></td>
              </tr>
              <tr>
                <td><div align="right">Email address:</div></td>
                <td><input name="email" type="text" alt="E-Mail Address" id="email" class="formobject" <?if($autofill){ echo "value='$email'";}else if($email){echo"value='$email'";}?> /></td>
              </tr>
              <tr>
                <td><div align="right"></div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <? if($or_state==$dor_state){
                     $serv1=0;
		}
                else{
                    $serv1=1;
                }
		?>
              <input type='hidden' value='<? echo"$serv1";?>' name='serv1' />
              <input type="hidden" name="from_this" value="fullmovers" id="from" />
              <input type="hidden" name="WeightLimit" value='<?=$WeightLimit; ?>' />
              <tr>
                <td><div align="right"> Estimate Date of Moving: <br />
                        <i>yyyy-mm-dd</i> </div></td>
                <td><input name="st_date" type="text" style="margin-left:0px;" alt="Estimate Date of Moving" id="st_date" class="formobject" size="10" maxlength="10" readonly="readonly"   value="<? if($st_date){echo"$st_date";}?>" />
                  <!--<a href="javascript:show_calendar()" >Pick from calendar</a>--> 
                  <a href="javascript:NewCssCal('st_date','yyyymmdd')" onMouseOver="window.status='Date Picker'; overlib('Click here to choose a date from pop-up calendar.'); return true;" onMouseOut="window.status=''; nd(); return true;">Pick from calendar</a> 
                  </td>
              </tr>
              <?php dsp_crypt(0,1); ?>
              <tr>
                <td align="right">Enter the code:</td>
                <td><input type="text" name="code" /></td>
              </tr>
              <tr align="center">
                <td colspan="2"><input type="submit" name="Submit" value="Request a Full Mover" id="next" style="width: 220px; font-size: x-small; font-family: Arial; color: #; background-color: #dceffe; border: 1 outset #;margin-right:50px;" /></td>
              </tr>
              <tr>
                <td width="44%" background="/images/right_dot_line.gif"></td>
              </tr>
            </table></td>
              </tr>
            </table></td>
          </tr>
        </table>
          <!--<script>
 <?//if($full=="yes") echo "setTimeout(\"get('or_state')\",2000)"; ?>
</script>
--></td>
      </tr>
      
    </table>
        <? } // if form is not submitted

	
?>
    </td>
  </tr>
</table>
<div style="float:bottom;>
<!--[if !IE 6]>
<div style="position:relative; top:40px;">
  <? 
		include "../bottom_panel.php"; 
?>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table width="1000" border="0" cellspacing="0" cellpadding="0">
    </table></td>
  </tr>
</table>
</html>