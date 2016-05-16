<?
session_start();
error_reporting(0);
include "Security.php"; 
require_once('config.inc.php');
include "mailer.php";
$day = $_GET['day'];
$month = $_GET['month'];
$year = $_GET['year'];
$OrderID = $_GET['OrderID'];
$Type = $_GET['Type'];
$location = $_GET['location'];
  
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");

$sql = "select SameState 
                from    tbl_lupu_orders 
                where   tbl_lupu_orders.OrderID = '$OrderID'";  
$q = mysql_query($sql);
$r  = mysql_fetch_assoc($q);

$samestate= "no";
if($Type == "LUPU")
{
if($samestate == "no"){
	$sql = "UPDATE tbl_lupu_orders SET tbl_lupu_orders.Status_$location = 'U', tbl_lupu_orders.".$location."_MID='' WHERE tbl_lupu_orders.OrderID = '$OrderID'";
}
else{
	$sql = "UPDATE tbl_lupu_orders SET tbl_lupu_orders.Status_Origin = 'U',tbl_lupu_orders.Status_Dest = 'U', tbl_lupu_orders.Origin_MID='',tbl_lupu_orders.Dest_MID='' WHERE tbl_lupu_orders.OrderID = '$OrderID'";

}
$q=mysql_query($sql);
}
//put it in the revoked orders table
$sql = "INSERT INTO Revoked_Orders (`MID`, `OrderId`)Values('".$_SESSION['Member_Id']."', '$OrderID')";
$result = mysql_query($sql) or die("Query failed734");








/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////FUNCTIONS START/////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
function admin_message_origin($or_load, $or_pack, $memberName, $memberConatctPerson, $memberPhone, $memberEmail, $moverContact, $OrderID,$memberContactPerson)
{
$message="";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='21'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];
		
		if ($or_load == 1 && $or_pack != 1)
			$info = "Loading";
		else if ($or_load != 1 && $or_pack == 1)
			$info = "Packing";
		else if ($or_load == 1 && $or_pack == 1)
			$info = "Loading,Packing";


		$message  = str_replace ("%JobInfo%", "LUPU <br>Order ID:$OrderID", $temp_message);
		$message  = str_replace ("%Mover%", $memberName, $message);
		$message  = str_replace ("%MoverContactPerson%", $memberContactPerson, $message);
		$moverContact = $memberPhone.'(Phone), '.$memberEmail.'(Email)';
		$message  = str_replace ("%MoverContact%", $moverContact, $message);
		$message  = str_replace ("%Admin%", "MMWC", $message);
return $message;
}

function admin_message_destination($dor_load, $dor_pack, $memberName, $memberConatctPerson, $memberPhone, $memberEmail, $moverContact,$OrderID,$memberContactPerson)
{
$message="";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='41'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];
		
		if ($dor_load == 1 && $dor_pack != 1)
			$info = "Loading";
		else if ($dor_load != 1 && $dor_pack == 1)
			$info = "Packing";
		else if ($dor_load == 1 && $dor_pack == 1)
			$info = "Loading,Packing";


		$message  = str_replace ("%JobInfo%", "LUPU<br>Order ID:$OrderID", $temp_message);
		$message  = str_replace ("%Mover%", $memberName, $message);
		$message  = str_replace ("%MoverContactPerson%", $memberContactPerson, $message);
		$moverContact = $memberPhone.'(Phone), '.$memberEmail.'(Email)';
		$message  = str_replace ("%MoverContact%", $moverContact, $message);
		$message  = str_replace ("%Admin%", "MMWC", $message);
return $message;
}


function admin_message_both($or_load, $or_pack, $memberName, $memberConatctPerson, $memberPhone, $memberEmail, $moverContact,$OrderID,$memberContactPerson)
{
$message="";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='20'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];
		
		if ($or_load == 1 && $or_pack != 1)
			$info = "Loading";
		else if ($or_load != 1 && $or_pack == 1)
			$info = "Packing";
		else if ($or_load == 1 && $or_pack == 1)
			$info = "Loading,Packing";


		$message  = str_replace ("%JobInfo%", "LUPU<br>Order ID:$OrderID", $temp_message);
		$message  = str_replace ("%Mover%", $memberName, $message);
		$message  = str_replace ("%MoverContactPerson%", $memberContactPerson, $message);
		$moverContact = $memberPhone.'(Phone), '.$memberEmail.'(Email)';
		$message  = str_replace ("%MoverContact%", $moverContact, $message);
		$message  = str_replace ("%Admin%", "MMWC", $message);
return $message;
}




/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////CUSTOMER EMAILS//////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////



function customer_charged_message_both($or_info,$dor_info, $memberName, $memberPhone, $memberEmail, $customerName, $OrderID, $movingDate)
{
$message="";
$job_info="Order ID: $OrderID
                 Services: $or_info $dor_info <br>
                 Moving Date: $movingDate <br>";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='43'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

		$message  = str_replace ("%JobInfo%", "$job_info", $temp_message);
		$message  = str_replace ("%Mover%", "$memberName", $message);
		$message  = str_replace ("%MoverEmail%", "$memberEmail", $message);
		$message  = str_replace ("%MoverPhone%", "$memberPhone", $message);
		$message  = str_replace ("%Custname%", " $customerName", $message);
return $message;
}


function customer_charged_message_origin($or_info, $memberName, $memberPhone, $memberEmail, $customerName, $OrderID, $movingDate)
{
$message="";
$job_info="Order ID: $OrderID
                 Services: $or_info  <br>
                 Moving Date: $movingDate <br>";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='22'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

		$message  = str_replace ("%JobInfo%", "$job_info", $temp_message);
		$message  = str_replace ("%Mover%", "$memberName", $message);
		$message  = str_replace ("%MoverEmail%", "$memberEmail", $message);
		$message  = str_replace ("%MoverPhone%", "$memberPhone", $message);
		$message  = str_replace ("%Custname%", " $customerName", $message);
return $message;
}


function customer_charged_message_destination($dor_info, $memberName, $memberPhone, $memberEmail, $customerName, $OrderID, $movingDate)
{
$message="";
$job_info="Order ID: $OrderID
                 Services: $dor_info <br>
                 Moving Date: $movingDate <br>";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='23'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

		$message  = str_replace ("%JobInfo%", "$job_info", $temp_message);
		$message  = str_replace ("%Mover%", "$memberName", $message);
		$message  = str_replace ("%MoverEmail%", "$memberEmail", $message);
		$message  = str_replace ("%MoverPhone%", "$memberPhone", $message);
		$message  = str_replace ("%Custname%", " $customerName", $message);
return $message;
}

function customer_uncharged_message_both($or_info,$dor_info, $customerName, $OrderID, $movingDate)
{
$message="";
$job_info="Order ID: $OrderID
                 Services: $or_info $dor_info <br>
                 Moving Date: $movingDate <br>";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='46'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

		$message  = str_replace ("%JobInfo%", "$job_info", $temp_message);
		$message  = str_replace ("%Custname%", " $customerName", $message);
return $message;
}


function customer_uncharged_message_origin($or_info, $customerName, $OrderID, $movingDate)
{
$message="";
$job_info="Order ID: $OrderID
                 Services: $or_info  <br>
                 Moving Date: $movingDate <br>";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='44'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

		$message  = str_replace ("%JobInfo%", "$job_info", $temp_message);
		$message  = str_replace ("%Custname%", " $customerName", $message);
return $message;
}


function customer_uncharged_message_destination($dor_info, $customerName, $OrderID, $movingDate)
{
$message="";
$job_info="Order ID: $OrderID
                 Services: $dor_info <br>
                 Moving Date: $movingDate <br>";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='45'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

		$message  = str_replace ("%JobInfo%", "$job_info", $temp_message);
		$message  = str_replace ("%Custname%", " $customerName", $message);
return $message;
}

/////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////MEMBER EMAILS///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////



function member_message_both($OrderID, $or_info, $dor_info, $or_state, $or_city, $dor_state, $dor_city,$movingDate, $labors )
{
$message="";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='47'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

		$message  = str_replace ("%oid%", "$OrderID", $temp_message);
		$message  = str_replace ("%to%", " $or_state", $message);
		$message  = str_replace ("%or_city%", " $or_city", $message);
		$message  = str_replace ("%from%", " $dor_state", $message);
		$message  = str_replace ("%dor_city%", " $dor_city", $message);
		$message  = str_replace ("%Job%", " $or_info.$dor_info", $message);
		$message  = str_replace ("%LNo%", " $labors", $message);
		$message  = str_replace ("%mdate%", " $movingDate", $message);

return $message;
}


function member_message_origin($OrderID, $or_info,  $or_state, $or_city, $movingDate, $labors )
{
$message="";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='25'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];


		$message  = str_replace ("%oid%", "$OrderID", $temp_message);
		$message  = str_replace ("%from%", " $or_state", $message);
		$message  = str_replace ("%city%", " $or_city", $message);
		$message  = str_replace ("%Job%", " $or_info", $message);
		$message  = str_replace ("%LNo%", " $labors", $message);
		$message  = str_replace ("%mdate%", " $movingDate", $message);

return $message;
}


function member_message_destination($OrderID,  $dor_info, $dor_state, $dor_city,$movingDate, $labors )
{
$message="";
    	$sql = "SELECT Detail from tbl_templates WHERE TempID='24'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];


		$message  = str_replace ("%oid%", "$OrderID", $temp_message);

		$message  = str_replace ("%to%", " $dor_state", $message);
		$message  = str_replace ("%city%", " $dor_city", $message);
		$message  = str_replace ("%Job%", " $or_info.$dor_info", $message);
		$message  = str_replace ("%LNo%", " $labors", $message);
		$message  = str_replace ("%mdate%", " $movingDate", $message);

return $message;
}



/////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////RESEND MEMBER EMAILS/////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

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


/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////FUNCTIONS END////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

//mail



//to admin
		$MemberID = $_SESSION['Member_Id'];
		
		$MID = $_SESSION['Member_Id'];
	    $sql = "SELECT MemberName, MemberType, ContactPerson, ContactEmail, ZipCode, Phone from tblmembers where MemberID='$MID'";
	    $result = mysql_query($sql) or die("Query failed2");
	    $line = mysql_fetch_array($result, MYSQL_ASSOC);
	    $memberName = $line[MemberName];
	    $memberType = $line[MemberType];
	    $memberContactPerson = $line[ContactPerson];
	    $memberZipCode = $line[ZipCode];
	    $memberEmail = $line[ContactEmail];
	    $memberPhone = $line[Phone];
	    
	    $sql = "SELECT FName, LName, Address, ZipCode, Phone, Phone2, EMail, Or_City, Or_State, Or_Load, Or_Pack, Transport, Dest_City, Dest_State, Dest_Unload, Dest_Unpack, MoveDate, Labor, Charged from tbl_lupu_orders where OrderID=$OrderID";    	
	    $result = mysql_query($sql) or die("Query failed4");
	    $line = mysql_fetch_array($result, MYSQL_ASSOC);    
	    
	    $customerName = $line[FName] . ' ' . $line[LName];
	 	$customerAddress = $line[Address];
	    $customerZipCode = $line[ZipCode];
	    $customerPhone = $line[Phone];
	    $customerPhone2 = $line[Phone2];
	    $customerMail = $line[EMail];
	    $or_city = $line[Or_City];
	    $or_state = $line[Or_State];
	    $or_load = $line[Or_Load];
	    $or_pack = $line[Or_Pack];
	    $transport = $line[Transport];
	    $dor_city = $line[Dest_City];
	    $dor_state = $line[Dest_State];
	    $dor_load = $line[Dest_Unload];
	    $dor_pack = $line[Dest_Unpack];
	    $movingDate = $line[MoveDate];
	    $labors = $line[Labor];
	    $charge = $line[Charged];
	    $or_none = '0';
    	$dor_none = '0';
    	$samestate="no";

    	if ($or_load == "" && $or_pack == "")
    		$or_none = '1';    	
    	if ($dor_load == "" && $dor_pack == "")
    		$dor_none = '1';	

		if ($or_load == 1 && $or_pack != 1)
			$or_info = "Loading";
		else if ($or_load != 1 && $or_pack == 1)
			$or_info = "Packing";
		else if ($or_load == 1 && $or_pack == 1)
			$or_info = "Loading,Packing";
		if ($dor_load == 1 && $dor_pack != 1)
			$dor_info = "Unloading";
		else if ($dor_load != 1 && $dor_pack == 1)
			$dor_info = "Unpacking";
		else if ($dor_load == 1 && $dor_pack == 1)
			$dor_info = "Unloading,Unpacking";
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
		$query = "SELECT `name` , `sh_name` FROM `states` WHERE `StateID`='$or_state' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 4");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$or_stated = $line[name];
		$or_shname = $line[sh_name];
	
		$query = "SELECT `name`,`sh_name`  FROM `states` WHERE `StateID`='$dor_state' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 5");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$dest_stated = $line[name];
		$dor_shname = $line[sh_name];
		$origin = $or_cityd . "," . $or_stated;
		$dest = $dest_cityd . "," . $dest_stated;

 		$sql = "SELECT admin_email from tbladmin";
	    $result = mysql_query($sql) or die("Query failed233");
	    $line = mysql_fetch_array($result, MYSQL_ASSOC);
        $AdminMail = $line[admin_email];        
   


    	//mail to admin
$message="";
$member_message="";
if($samestate=="no"){
    $message=admin_message_both($or_load, $or_pack, $memberName, $memberConatctPerson, $memberPhone, $memberEmail, $moverContact,$OrderID,$memberContactPerson);
}
else{
    if($location=='Origin'){
        $message=admin_message_origin($or_load, $or_pack, $memberName, $memberConatctPerson, $memberPhone, $memberEmail, $moverContact,$OrderID,$memberContactPerson);
    }
    else{
        $message=admin_message_destination($or_load, $or_pack, $memberName, $memberConatctPerson, $memberPhone, $memberEmail, $moverContact,$OrderID,$memberContactPerson);
    }
}
		$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font><br><br>";
		$message = nl2br($message);
		
		$Subject = "A Provider has Reposted service request";
		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$AdminMail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed7");
		send_mail($AdminMail, $AdminMail, $AdminMail, $Subject, $message);

//revoked at origin
    if ($location == 'Origin'){
        //mail to customer
        if($samestate=="no" || ($dor_load !=1 && dor_pack !=1)){//origin only
		$Subject = "Your Provider has Reposted service request at origin";
            $member_message= member_message_origin($OrderID, $or_info,  $or_stated, $or_cityd, $movingDate, $labors);
            if($charge==1){

                  $message=customer_charged_message_origin($or_info,$memberName, $memberPhone, $memberEmail, $customerName, $OrderID, $movingDate);


            }else{

                    $message=customer_uncharged_message_origin($or_info, $customerName, $OrderID, $movingDate);

            }
        }else{//both origin and destination
		$Subject = "Your Provider has Reposted service request at origin and destination";
            $member_message= member_message_both($OrderID, $or_info, $dor_info, $or_stated, $or_city, $dest_stated, $dest_cityd,$movingDate, $labors );
            if($charge==1){
                  $message=customer_charged_message_both($or_info,$dor_info, $memberName, $memberPhone, $memberEmail, $customerName, $OrderID, $movingDate);

            }else{
                    $message=customer_uncharged_message_both($or_info,$dor_info, $customerName, $OrderID, $movingDate);

            }
        }
    }
    if ($location == 'Dest'){
        //mail to customer
        if($samestate=="no" || ($or_load !=1 && or_pack !=1)){
		$Subject = "Your Provider has Reposted service request at destination";
            $member_message= member_message_destination($OrderID,  $dor_info, $dest_stated, $dest_cityd,$movingDate, $labors );         
            if($charge==1){
           $message=customer_charged_message_destination($dor_info,$memberName, $memberPhone, $memberEmail, $customerName, $OrderID, $movingDate);

            }else{
                    $message=customer_uncharged_message_destination($dor_info, $customerName, $OrderID, $movingDate);

            }
        }
          else{//both places
		$Subject = "Your Provider has Reposted service request at destination/origin";
            $member_message= member_message_both($OrderID,  $dor_info, $dest_stated, $dest_cityd,$movingDate, $labors );         
            if($charge==1){
           $message=customer_charged_message_both($dor_info,$memberName, $memberPhone, $memberEmail, $customerName, $OrderID, $movingDate);

            }else{
                    $message=customer_uncharged_message_both($dor_info, $customerName, $OrderID, $movingDate);

            }      

        }      
    }
 
		    $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font><br><br>";
		    $message = nl2br($message);
		

		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$customerMail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed7");
		send_mail($AdminMail, $AdminMail, $customerMail, $Subject, $message);




		$Subject = "Your have Reposted service request";
		    $member_message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $member_message . "</center></font><br><br>";
		    $member_message = nl2br($member_message);

		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$memberEmail', '$Subject', '$member_message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed7");
		send_mail($AdminMail, $AdminMail, $memberEmail, $Subject, $member_message);

	













if($location=="Origin"){
        	$or_sql = "Select tblmembers.MemberID, tblmembers.MemberName, tblmembers.ContactEmail, tblmembers.MemberType, tblmembers.TollFree From tblmembers 
				     Where (tblmembers.MemberType = 'standard' OR tblmembers.MemberType = 'full' ) AND tblmembers.Active = '1' AND
				    (tblmembers.State like '$or_shname%'  OR tblmembers.State like 'NA%') ";

        	$result = mysql_query($or_sql) or die("Query failed2331 $or_sql");
			$or_ret= array();
			$num = mysql_num_rows($result);
			for($i=0;$i<$num;$i++)
			{
				array_push($or_ret,mysql_fetch_row($result));
			}

}else{
        	$dor_sql = "Select tblmembers.MemberID, tblmembers.MemberName, tblmembers.ContactEmail, tblmembers.MemberType From tblmembers 
				     Where (tblmembers.MemberType = 'standard' OR tblmembers.MemberType = 'full') AND tblmembers.Active = '1' AND
				    (tblmembers.State like '$dor_shname%'  OR tblmembers.State like 'NA%') ";

        	$result = mysql_query($dor_sql) or die("Query failed2331 $dor_sql");
			$dor_ret= array();
			$num = mysql_num_rows($result);
			for($i=0;$i<$num;$i++)
			{
				array_push($dor_ret,mysql_fetch_row($result));
			}

}
		 
   

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
	                      $message="";
	                 
                                 $Subject = "New Order from MMWC";
                                     if($samestate=='yes' && $dor_none !=1){
                                             $message=member_both_locations($OrderID, $or_info, $dor_info, $origin, $dest, $movingDate, $labors);
		                       }
                                      else{
                                             $message=member_origin($OrderID, $or_info, $origin, $movingDate, $labors);
                                      }
                                 
                                if($message!=""){
			$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
			$message = nl2br($message);

		send_mail($AdminMail, $AdminMail, $memberEmail, $Subject, $message);
		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$memberEmail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed7");
			        }
                       }	//end    for each loop
		 
                  }      //end     if(or_none!='1')






		 if ($dor_none != '1')
		 {
		foreach($dor_ret as $val)
			{
		              $MID = $val[0]; 
			      $MName = $val[1]; 
			      $memberEmail = $val[2];
			      $memberType = $val[3];
			      $memberPhone = $val[4];		
	                      $message="";    
                                        $Subject = "New Order from MMWC";             
                              if($samestate == "yes" || $or_none!=1){
                                             $message=member_both_locations($OrderID, $or_info, $dor_info, $origin, $dest, $movingDate, $labors);
                                }
                                      else{
                                             $message=member_destination($OrderID, $dor_info, $dest, $movingDate, $labors);
                                      }
                        if($message!=""){
			$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
			$message = nl2br($message);
			

		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$memberEmail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed7");
		send_mail($AdminMail, $AdminMail, $memberEmail, $Subject, $message);

			       }

                       }	//end    for each loop
		 
                  }      //end     if(dor_none!='1')



@header("Location:basa.php?day=$day&month=$month&year=$year");
exit;
?>
