<?php
session_start(); 
	session_register('customer_info'); 
set_time_limit(60*60*60);
require ('../config.inc.php');
require ('../getfile.php');
require ('../seo.php');
require_once "../mailer.php";
include_once "../randchar_function.php";
require_once "../top_panel.php";
$cryptinstall="../crypt/cryptographp.fct.php";
include $cryptinstall; 






$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");

$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 6';
$result = mysql_query($sql) or die("Query failed_LUPU");
$line = mysql_fetch_array($result, MYSQL_ASSOC);


$add=array(array());

$sql = 'Select Add_Number,Description, Image,Link From add_manager Where Add_Number>33 AND Add_Number<=37';

$r = mysql_query($sql) or die("Query failed_LUPU $sql");
while($result = mysql_fetch_array($r, MYSQL_ASSOC))
{
    $add[$result[Add_Number]][0]=$result[Description];
    $add[$result[Add_Number]][1]=$result[Image];
    $add[$result[Add_Number]][2]=$result[Link];
}


////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////START FUNCTIONS//////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
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


function admin_message($LeadId, $CName, $address, $email, $zipcode, $phone1, $phone2, $origin, $dest, $labors, $transport, $or_service, $dor_service, $st_date, $IP, $user_domain, $card, $credit, $labors)
{

             $sql = "SELECT Detail from tbl_templates WHERE TempID='26'"; 
	     $result = mysql_query($sql) or die("Query failed23");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail];
         $message  = str_replace ("%oid%", "$LeadId", $temp_message);
         $message  = str_replace ("%CustName%", $CName, $message);
         $message  = str_replace ("%CustAddress%", $address, $message);
		 $message  = str_replace ("%email%", $email, $message);
		 $message  = str_replace ("%ZC%", $zipcode, $message);
		 $message  = str_replace ("%TelW%", $phone1, $message);
         $message  = str_replace ("%TelH%", $phone2, $message);
         $message  = str_replace ("%Origin%", $origin, $message);
		 $message  = str_replace ("%Dest%", $dest, $message);
		 $message  = str_replace ("%labor%", $labors, $message);
		 $message  = str_replace ("%Transportation%", $transport, $message);
         $message  = str_replace ("%OriginService%", $or_service, $message);
         $message  = str_replace ("%DestService%", $dor_service, $message);
		 $message  = str_replace ("%Mdate%", $st_date, $message);
		 $message  = str_replace ("%IPaddr%", $IP, $message);
		 $message  = str_replace ("%domain%", $user_domain, $message);
         $message  = str_replace ("%OrderDate%", date("Y-m-d H:i:s"), $message);
         $message  = str_replace ("%CardType%", $card, $message);
		 $message  = str_replace ("%CardNo%", $credit, $message);
		 
		switch($labors)
		{		                  
			case 1:
			   $message  = str_replace ("%x%", "$225", $message);
			   $message  = str_replace ("%y%", "$55", $message);
			   $message  = str_replace ("%z%", "$55", $message);
			   break;
			case 2:
			   $message  = str_replace ("%x%", "$340", $message);
			   $message  = str_replace ("%y%", "$80", $message);
			   $message  = str_replace ("%z%", "$80", $message);
			   break;
			case 3:
			   $message  = str_replace ("%x%", "$400", $message);
			   $message  = str_replace ("%y%", "90", $message);
			   $message  = str_replace ("%z%", "$90", $message);
			   break;
			case 4:
			   $message  = str_replace ("%x%", "$480", $message);
			   $message  = str_replace ("%y%", "$105", $message);
			   $message  = str_replace ("%z%", "$105", $message);
			   break;
			case 5:
			   $message  = str_replace ("%x%", "$640", $message);
			   $message  = str_replace ("%y%", "$120", $message);
			   $message  = str_replace ("%z%", "$120", $message);
			   break;
		}
		 	 
return "$message"; 
}



function member_both_locations($LeadId, $or_service, $dor_service, $origin, $dest, $st_date, $labors)
{

	$sql = "SELECT Detail from tbl_templates WHERE TempID='33'"; 
	$result = mysql_query($sql) or die("Query failed27");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$temp_message = $line[Detail];

     
                $service= $or_service. $dor_service;
                        $message = str_replace("%oid%", "$LeadId", $temp_message);
	                $message  = str_replace ("%from%", $origin , $message);
                        $message = str_replace("%oid%", "$LeadId", $temp_message);
			$message  = str_replace ("%from%", $origin , $message);
			$message  = str_replace ("%mdate%", $st_date, $message);
			$message  = str_replace ("%LNo%", $labors, $message);

	                $message  = str_replace ("%Job%", $service , $message);
	                $message  = str_replace ("%to%", $dest , $message);
return "$message"; 
}



function member_origin($LeadId, $or_service, $origin, $st_date, $labors)
{

	$sql = "SELECT Detail from tbl_templates WHERE TempID='28'"; 
	$result = mysql_query($sql) or die("Query failed23");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	    $temp_message = $line[Detail];
                $message = str_replace("%oid%", "$LeadId", $temp_message);
	        $message  = str_replace ("%Job%", $or_service, $message);
	        $message  = str_replace ("%from%", $origin , $message);
	        $message  = str_replace ("%mdate%", $st_date, $message);
	        $message  = str_replace ("%LNo%", $labors, $message);


return "$message"; 
}


function member_destination($LeadId, $dor_service, $dest, $st_date, $labors)
{

	$sql = "SELECT Detail from tbl_templates WHERE TempID='29'"; 
	$result = mysql_query($sql) or die("Query failed23");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];
			
			$message = str_replace("%oid%", "$LeadId", $temp_message);
			$message  = str_replace ("%Job%", $dor_service, $message);
			$message  = str_replace ("%to%", $dest , $message);
			$message  = str_replace ("%mdate%", $st_date, $message);
			$message  = str_replace ("%LNo%", $labors, $message);


return "$message"; 
}


function transport_message($CName, $origin, $samecity, $dest, $phone1, $phone2, $st_date, $email)
{

        $sql = "SELECT Detail from tbl_templates WHERE TempID='9'"; 
        $result = mysql_query($sql) or die("Query failed23");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

			$message = str_replace("%CustName%", " $CName ", $temp_message);
		       $message  = str_replace ("%from%", $origin , $message);
                       if($samecity=="yes"){
		           $message  = str_replace ("%TM%", "Local Move" , $message);
                        }
                       else{
		           $message  = str_replace ("%TM%", "Long Distance Move" , $message);
                       }
		       $message  = str_replace ("%to%", $dest , $message);
		       $message  = str_replace ("%size%", "N/A" , $message);
		      $message  = str_replace ("%TelW%", $phone1, $message);
                      $message  = str_replace ("%TelH%", $phone2, $message);
		     $message  = str_replace ("%mdate%", $st_date, $message);
	         $message  = str_replace ("%CustEmail%", $email, $message);


return "$message"; 
}


function customer_message($LeadId, $CName)
{
         $sql = "SELECT Detail from tbl_templates WHERE TempID='3'"; 
	     $result = mysql_query($sql) or die("Query failed23");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail];
	         $message  = str_replace ("%LeadId%", $LeadId, $temp_message);
		 $message  = str_replace ("%CN%", $CName, $message);	

return "$message"; 
}

function send_or_store($valid, $AdminMail, $memberEmail, $Subject, $message, $LeadId, $IP)
{

        //if the ip has been validated send an email otherwise store it for later		
	if($valid == "yes"){  
		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES ('29', '$AdminMail', '$memberEmail', '$Subject', '$message', '$LeadId')";
		$result = mysql_query($sql) or die("Query failed5 ");
                    send_mail($AdminMail, $AdminMail, $memberEmail, $Subject, $message);
         }
         else{ 
		$sql = "INSERT INTO `tbl_Unvalidated_Email` (`OrderId`, `MailType`, `From`, `To`, `Subject`, `Message` ,`IP`) VALUES ('$LeadId', '29', '$AdminMail', '$memberEmail', '$Subject', '$message','$IP')";
		$result = mysql_query($sql) or die("Query failed578");
          }

}


function transport_list_message($CName, $count, $transport_comp)
{

    $list="Dear $CName,
    Here is a list of the moving companies that you can contact.\n";

    for($i=0; $i<$count; $i++)
    { 
        $list.="Name: ".$transport_comp[$i][0]."\n"; 
        $list.="TollFree: ".$transport_comp[$i][1]."\n";
        $list.="Email: ".$transport_comp[$i][2]."\n\n\n\n";
    }
   return $list;
}






function last_order_date($IP)
{
$date="";
$days_month = array(31,28,31,30,31,30,31,31,30,31,30,31);
    $sql="SELECT LastLupu FROM tblcustomers WHERE IP='$IP'";
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
    $date=date("z-Y");

    $sql="UPDATE tblcustomers SET LastLupu='$date'";
    $r=mysql_query($sql);
    return true;
}

}

////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////END FUNCTIONS/////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////


?>

<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<link href="../full_mov_list.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../add_style.css" />


<SCRIPT LANGUAGE="JavaScript">
function new_add_window(add_path)
{
    add_window=window.open(add_path, "Add Images", "width=300, height=150,scrollbars=yes,resizable=yes ,toolbar=yes")
    add_window.focus();
}

</SCRIPT>


<div id="main_left_side_add">
<b id='title'>Sponsored Links</b>
<?
for($i=34; $i<=37; $i++)
{

     echo"<div id='add_cell'>
    <div id='add_number'>
     Advertisement $i<br></div>";
        if($add[$i][1] != ""){
             echo"<a href='http://".$add[$i][2]."'><img src='../adds/".$add[$i][1]."' width='150'></a><br>";
        }
    elseif($add[$i][2] != ""){

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

<br />
<div align="center" style="width:650px;height:750px!important;height:2px;padding-left:0px!important;padding-left:0px;font-family:Verdana;font-size:12px;color:gray;font-size:12px;" >
<comment><br /><br /><br /><br /></comment>

<?
 require("../sanitize.php");
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////SANITIZE DATA/////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////


$transport_comp=array(array());
$customer_info=array();

	$salut = sanitize($_POST[salut],5,0);
$customer_info['salut']=$salut;

	$lname = sanitize($_POST[lname],100,0);
$customer_info['lname']=$lname;

	$fname = sanitize($_POST[fname],100,0);
$customer_info['fname']=$fname;

	$address = sanitize($_POST[address],250,0);
$customer_info['address']=$address;


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




	$Day=$_POST[Day];
$customer_info['Day']=$Day;

	$Month=$_POST[Month];
$customer_info['Month']=$Month;

	$Year=$_POST[Year];
$customer_info['Year']=$Year;

$transport = $_POST[transport];

$card = sanitize($_POST[card],20,0); 
$customer_info['card']=$card;
$credit = sanitize($_POST[credit],10,0); 
$customer_info['credit']=$credit;

if(strlen($Month) == "1")
{
  $Month = "0" . $Month;
}

if(strlen($Day) == "1")
{
  $Day = "0" . $Day;
}
	$st_date = $Year . "-" . $Month . "-" . $Day;
	

$valid="no";


$count=0;
$labors=$_POST[labors];
$customer_info['labors']=$labors;

$or_state=$_POST[or_state];
$customer_info['or_state']=$or_state;

$or_city=$_POST[or_city];
$customer_info['or_city']=$or_city;

$samecity=$_POST[samecity];
$customer_info['samecity']=$samecity;

$or_pack=$_POST[or_pack];
$customer_info['or_pack']=$or_pack;

$or_load=$_POST[or_load];
$customer_info['or_load']=$or_load;

$or_none=$_POST[or_none];
$customer_info['or_none']=$or_none;

$ServiceSelector=$_POST[ServiceSelector];
$customer_info['ServiceSelector']=$ServiceSelector;

$dor_state=$_POST[dor_state];
$customer_info['dor_state']=$dor_state;

$dor_city=$_POST[dor_city];
$customer_info['dor_city']=$dor_city;

$dor_pack=$_POST[dor_pack];
$customer_info['dor_pack']=$dor_pack;

$dor_load=$_POST[dor_load];
$customer_info['dor_load']=$dor_load;

$dor_none=$_POST[dor_none];
$customer_info['dor_none']=$dor_none;

$dor_pack1=$_POST[dor_pack1];
$customer_info['dor_pack1']=$dor_pack1;

$dor_load1=$_POST[dor_load1];
$customer_info['dor_load1']=$dor_load1;

$full=$_POST[full];
$customer_info['full']=$full;

$transport=$_POST[transport];
$customer_info['transport']=$transport;

		$serv1 = 1;
if($dor_state==$or_state)
{
		$serv1 = 0;
}

$_SESSION['customer_info']=$customer_info;

////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////END SANITIZE DATA////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////START ACTUAL CODE///////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////

//check if they put in the right captcha code
  if (chk_crypt($_POST['code'])) {

// ------------------ storing order credentials in database
$LeadId = randchar(7,"numeric");

$sms_message="OID:$LeadId
A new order been posted to your member panel. 
Please log in to your panel for more details.
 Thank you";

$user_domain = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$IP = $_SERVER['REMOTE_ADDR'];

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


//if they didn't click on moving within same state, but are moving with in the same state	
if(($or_state == $dor_state))
{
   $samecity = "yes";
}
else
{
$samecity = "no";
}

//combine the phone numbers boxes
$phone1 = $ph1 . $ph2 . $ph3;
$phone2 = $ph4 . $ph5 . $ph6;



//if it's a new customer add him to the tblcustomers
$CName = $salut . " " . $fname . " " . $lname;

$sql = "SELECT COUNT(*) as numcustomers from tblcustomers WHERE IP='$IP'";
$result = mysql_query($sql) or die("Query failed2330");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
if (empty($line[numcustomers]))
{
    $sql = "INSERT INTO `tblcustomers` (Sal, FName, LName, Address, ZipCode, Phone, Phone2, email, DateAdded, IP)
		     VALUES ('$salut', '$fname', '$lname', '$address', '$zipcode', $phone1, $phone2, '$email',CURRENT_TIMESTAMP, '$IP')"; 
    $result = mysql_query($sql) or die("Query failed309");
   
    $q="Select max(CustomerID) as CustID from tblcustomers;";
    $result = mysql_query($q) or die("Query failed: 2xx");
    $row = mysql_fetch_assoc($result);
    $newid=$row[CustID];	
} 
else
{
    $q= "SELECT Valid, LastLupu from tblcustomers WHERE IP='$IP'";
    $r= mysql_query($q); 
    while($Valid = mysql_fetch_array($r, MYSQL_NUM))
    {

        $valid=$Valid[0];
        $last=$Valid[1];
    }
}
if($valid != "never")
{
$work="false";
$work=last_order_date($IP);
if($work=="true"){
$query = "INSERT INTO `tbl_lupu_orders` (OrderID, Sal, FName, LName, Address,ZipCode, Phone, Phone2, EMail, Transport, SameState, Or_City, Or_State, Or_Pack, Or_Load, Dest_State, Dest_City, Dest_Unpack, Dest_Unload, Charged, Labor, CardType, CardNo, IP, Domain, MoveType, MoveDate, OrderTime)
		VALUES('$LeadId', '$salut', '$fname', '$lname', '$address', '$zipcode', $phone1, $phone2, '$email', '$transport', '$samecity', '$or_city','$or_state', '$or_pack', '$or_load', '$dor_state', '$dor_city', '$dor_pack', '$dor_load', '0', $labors, '$card','$credit', '$IP', '$user_domain', '$serv1', '$st_date', CURRENT_TIMESTAMP)";
	
$result = mysql_query($query) or die("Query failed: 1");



//if they are valid add them the transport_orders
if($valid =="yes"){

$query = "INSERT INTO `tbl_transport_orders` (OrderID, Sal, FName, LName, Address,ZipCode, Phone, Phone2, EMail , MoveType, Or_City, Or_State,  Dest_State,   IP, Domain,  MoveDate, OrderTime)
		VALUES('$LeadId', '$salut', '$fname', '$lname', '$address', '$zipcode', $phone1, $phone2, '$email', '$serv1', '$or_city','$or_state', '$dor_state', '$IP', '$user_domain',  '$st_date', CURRENT_TIMESTAMP)";
	
$result = mysql_query($query) or die("Query failed: 1");

}



// find out name of origin city
$query = "SELECT `city` FROM `cities` WHERE `CityID`='$or_city' LIMIT 1";
$result = mysql_query($query) or die("Query failed: 2");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$or_cityd = $line[city];

// the same with destination city
$query = "SELECT `city` FROM `cities` WHERE `CityID`='$dor_city' LIMIT 1";
$result = mysql_query($query) or die("Query failed: 3");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$dest_cityd = $line[city];

// find out the full names of states
$query = "SELECT `name` FROM `states` WHERE `StateID`='$or_state' LIMIT 1";
$result = mysql_query($query) or die("Query failed: 4");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$or_stated = $line[name];

$query = "SELECT `name` FROM `states` WHERE `StateID`='$dor_state' LIMIT 1";
$result = mysql_query($query) or die("Query failed: 5");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$dest_stated = $line[name];

//find out the short names of the origin state
		$query = "SELECT `sh_name` FROM `states` WHERE `StateID`='$or_state' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 4");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$or_shname = $line[sh_name];
//find out the short names of the destination state	
		$query = "SELECT `sh_name` FROM `states` WHERE `StateID`='$dor_state' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 4");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$dor_shname = $line[sh_name];

//if transportation is need, added to the search
		if ($transport == "yes")
		{
                        if($serv1=="0")
                       { 
			$queryTrans = " OR (tblmembers.MemberType = 'transport' AND tblmembers.Active = '1' AND State='$or_shname' AND InterstateLicense !='0' )";
                        }
                        else{
			$queryTrans = " OR (tblmembers.MemberType = 'transport'  AND tblmembers.Active = '1' AND InterstateLicense='1')";
                        }

		}
		else
		{
			$queryTrans = "";
		}		
if($or_state <52){$country = "USA";}else{$country = "canada";}
//if something is required at the origin get customers info
        if ($or_none!='1')
        {

        	$or_sql = "Select tblmembers.MemberID, tblmembers.MemberName, tblmembers.ContactEmail, tblmembers.MemberType, tblmembers.TollFree,tblmembers.sms_service, tblmembers.sms_address  From tblmembers 
				     Where (tblmembers.MemberType = 'standard' OR tblmembers.MemberType = 'full' ) AND tblmembers.Active = '1' AND
				    (tblmembers.State like '$or_shname%'  OR  (tblmembers.State like 'NA%' AND tblmembers.MemberState = '999' AND tblmembers.ServiceCountry = '$country') OR (tblmembers.State like 'NA%' AND
tblmembers.MemberState = '$or_state')) ".$queryTrans."";
        	$result = mysql_query($or_sql) or die("Query failed2331");
			$or_ret= array();
			$num = mysql_num_rows($result);
			for($i=0;$i<$num;$i++)
			{
				array_push($or_ret,mysql_fetch_row($result));
			}

        }

//if something is required at the destination get customers info
        if ($dor_none!='1')
        {
        	$dor_sql = "Select tblmembers.MemberID, tblmembers.MemberName, tblmembers.ContactEmail, tblmembers.MemberType, tblmembers.TollFree, tblmembers.sms_service, tblmembers.sms_address From tblmembers 
				     Where (tblmembers.MemberType = 'standard' OR tblmembers.MemberType = 'full') AND tblmembers.Active = '1' AND
				    (tblmembers.State like '$dor_shname%'  OR (tblmembers.State like 'NA%'AND tblmembers.MemberState = '999' AND tblmembers.ServiceCountry = '$country') OR (tblmembers.State like 'NA%' AND
tblmembers.MemberState = '$dor_state')) ".$queryTrans."";
        	$result = mysql_query($dor_sql) or die("Query failed2332");
			$dor_ret= array();
			$num = mysql_num_rows($result);

			for($i=0;$i<$num;$i++)
			{
				array_push($dor_ret,mysql_fetch_row($result));
			}
        }		
 
		 $or_service="";
                 $dor_service="";
		   if ($or_load == "1")
		   {
		     $or_service = "Loading; ";
		   }
		   if ($or_pack == "1")
		   {
		     $or_service = $or_service."Packing; ";
		   }
		   if ($dor_load == "1")
		   {
		     $dor_service = "UnLoading; ";
		   }
		   if ($dor_pack == "1")
		   {
		     $dor_service = $dor_service."UnPacking; ";
		   }
                   if($or_pack =="0" && $or_load == "0")
                   {
                     $or_service= "no services required at origin state; ";
                     $or_none=1;
                   }
                   if($dor_pack =="0" && $dor_load == "0")
                   {
                     $dor_service= "no services required at destination state; ";
                     $dor_none=1;
                   }         
		 $origin = $or_cityd . "," . $or_stated;
		 $dest = $dest_cityd . "," . $dest_stated;
		 
         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed2333");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email];
	

	 
 //sending mail to admin		

$Subject = 'New Order from customer';

//prepare the message
$message=admin_message($LeadId, $CName, $address, $email, $zipcode, $phone1, $phone2, $origin, $dest, $labors, $transport, $or_service, $dor_service, $st_date, $IP, $user_domain, $card, $credit, $labors);

//add image and line breakers
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
		 $message = nl2br($message);	

//insert into database
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES 
		 		('26', '$AdminMail', '$AdminMail', '$Subject', '$message', '$LeadId')";
		 $result = mysql_query($sql) or die("Query failed5");
		 send_mail($AdminMail, $AdminMail, $AdminMail, $Subject, $message);
		send_sms("New LUPU order");
 //sending mail to customer	 
         $Subject = "Your request has been accepted";
         $message=customer_message($LeadId, $CName);
		 $message = "<font face=\"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font><br><br>";
		 $message = nl2br($message);
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES ('3', '$AdminMail', '$email', '$Subject', '$message', '$LeadId')";
		 $result = mysql_query($sql) or die("Query failed5 ");
                 send_mail($AdminMail, $AdminMail, $email, $Subject, $message);



//sending mail to lupu members
		 $Subject = "New Order from MMWC";	
	 
		 if ($or_none != '1')
		 {

			foreach($or_ret as $val)
			{
		              $MID = $val[0]; 
			      $MName = $val[1]; 
			      $memberEmail = $val[2];
			      $memberType = $val[3];
			      $memberPhone = $val[4];		
			      $sms_service = $val[5];		
			      $sms_address = $val[6];		
	                      $message="";
	                      if ($memberType=='transport'){ 

                                  $Subject = "Transportation Leads";
			          $message= transport_message($CName, $origin, $samecity, $dest, $phone1, $phone2, $st_date, $email);

                                    //add them to the list of transports for the customer
                                   $transport_comp[$count][0]=$MName;
                                   $transport_comp[$count][1]=$memberPhone;
                                   $transport_comp[$count][2]=$memberEmail;
                                   $count++;

                                }
		                else { //if the member is not transport
                                 $Subject = "New Order from MMWC";
                                     if($samecity=='yes' && $dor_none !=1) {
                                             $message=member_both_locations($LeadId, $or_service, $dor_service, $origin, $dest, $st_date, $labors);
		                       }
                                      else{
                                             $message=member_origin($LeadId, $or_service, $origin, $st_date, $labors);
                                      }
                                 }


                                if($message!=""){
			$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
			$message = nl2br($message);

                        send_or_store($valid, $AdminMail, $memberEmail, $Subject, $message, $LeadId, $IP);


                        if($sms_service=="yes" && $sms_address !="")
                        {
                        send_or_store($valid, $AdminMail, $sms_address, "New Order", $sms_message, $LeadId, $IP);                          
                        }




			        }
                       }	//end    for each loop
		 
                  }      //end     if(or_none!='1')





//if it's in the same city the origin mover already recieved an email
		 if ($dor_none != '1')
		 {

		foreach($dor_ret as $val)
			{
		              $MID = $val[0]; 
			      $MName = $val[1]; 
			      $memberEmail = $val[2];
			      $memberType = $val[3];
			      $memberPhone = $val[4];	
			      $sms_service = $val[5];		
			      $sms_address = $val[6];			
	                      $message="";
	                      if ($memberType=='transport' && $or_none=='1'){ 
                                  $Subject = "Transportation Leads";
			          $message= transport_message($CName, $origin, $samecity, $dest, $phone1, $phone2, $st_date, $email);

                                    //add them to the list of transports for the customer
                                   $transport_comp[$count][0]=$MName;
                                   $transport_comp[$count][1]=$memberPhone;
                                   $transport_comp[$count][2]=$memberEmail;
                                   $count++;

                                }
                                else if(($samecity != "yes" || $or_none==1) && $memberType !='transport'){
                                        $Subject = "New Order from MMWC";
                                        $message=member_destination($LeadId, $dor_service, $dest, $st_date, $labors);
                                }

                        if($message!=""){
			$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
			$message = nl2br($message);
			

                        send_or_store($valid, $AdminMail, $memberEmail, $Subject, $message, $LeadId, $IP);


                        if(($sms_service=="yes" && $sms_address !="") &&($samecity != "yes" || $or_none==1))
                        {
                        send_or_store($valid, $AdminMail, $sms_address, "New Order", $sms_message, $LeadId, $IP);                          
                        }


			       }

                       }	//end    for each loop
		 
                  }      //end     if(dor_none!='1')

//send the transport companies	 
if($count>0 && $transport == "yes")
{
        $Subject="Transportation providers list: Please contact them at your convenience";
        $list=transport_list_message($CName, $count, $transport_comp);
			$list = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $list ."</center></font><br><br>";
			$list = nl2br($list);

                        send_or_store($valid, $AdminMail,  $email, $Subject, $list, $LeadId, $IP);

}

 $massage="
<font style='font: bold 17px Verdana, Arial, Helvetica, sans-serif; color: #374993; LETTER-SPACING: 2px;'>
 <center>Dear $CName, Your Request has been accepted.
	</center> </font>  <br /><br /><br />
	Your Order # is : $LeadId <br />
    Please note it down for future correspondence. Your move request has been submitted and posted to our network. 
    A customer service representative will be contacting you shortly. For additional details regarding your specific needs. <br />
    Once your request has been accepted by the moving company, you will receive a confirmation e-mail with the information of <br />
    your service provider. <br /><br />
    Thank you for choosing MoveMewithcare.com, where all your moving needs are met by professional and accredited Moving companies.
	";

}//end date test
else{
    echo"Sorry, You have already put in an order in the past five days";}
}//end of valid test
else{
    echo"You have been marked as fake";
}

}//end if captcha was right
else {
    echo"<script language='Javascript'>
window.location='http://movemewithcare.com/loadingunloading/fulllupu2.php';
</script>";}

?>

    
  <table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr valign="top" align="center">
    <td valign="top" align="center"><?=$massage;?></td>
   </tr>
   </table>
    <br />
    </span>
 

  </div>
  
<? include_once "../bottom_panel.php"; ?>