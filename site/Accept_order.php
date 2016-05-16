<?
session_start();
error_reporting(0);
include "Security.php"; 
include "mailer.php";
require_once('config.inc.php');

$day = $_GET['day'];
$month = $_GET['month'];
$year = $_GET['year'];
$OrderID = $_GET['OrderID'];
$Type = $_GET['Type'];
$location = $_GET['location'];
  
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");

$current_date = date('Y-m-d h:i:s');


/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////FUNCTIONS START////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Admin Emails////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

function admin_message_origin($customerName, $customerPhone, $customerPhone2, $customerZipCode, $movingDate, $labors, $or_info, $memberName, $memberState, $memberContactPerson, $memberEmail,$memberPhone, $customerMail, $OrderID)
{
    $message="";
    $sql = "SELECT Detail from tbl_templates WHERE TempID='18'";

	$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

		$message  = str_replace ("%JobInfo%", "LUPU <br>OrderID:$OrderID", $temp_message);
		$message  = str_replace ("%Cust%", $customerName, $message);
		$message  = str_replace ("%CustNoW%", $customerPhone, $message);
		$message  = str_replace ("%CustNoH%", $customerPhone2, $message);
		$message  = str_replace ("%Email%", $customerMail, $message);
		$message  = str_replace ("%ZC%", $customerZipCode, $message);
		$message  = str_replace ("%Mdate%", $movingDate, $message);
		$message  = str_replace ("%LNo%", $labors, $message);
		$message  = str_replace ("%Job%", $or_info, $message);
		$message  = str_replace ("%Mover%", $memberName, $message);
		$message  = str_replace ("%state%", $memberState, $message);
		$message  = str_replace ("%MoverContactPerson%", $memberContactPerson, $message);
		$moverContact = $memberPhone.'(Phone), '.$memberEmail.'(Email)';		
		$message  = str_replace ("%MoverContact%", $moverContact, $message);
		$message  = str_replace ("%Admin%", "MMWC", $message);		

return "$message";
}





function admin_message_destination($customerName, $customerPhone, $customerPhone2, $customerZipCode, $movingDate, $labors, $dest_info, $memberName, $memberState, $memberContactPerson, $memberEmail,$memberPhone, $customerMail, $OrderID)
{
$message="";

    	$sql = "SELECT Detail from tbl_templates WHERE TempID='19'";

	$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

		$message  = str_replace ("%JobInfo%", "LUPU<br>OrderID:$OrderID", $temp_message);
		$message  = str_replace ("%Cust%", $customerName, $message);
		$message  = str_replace ("%CustNoW%", $customerPhone, $message);
		$message  = str_replace ("%CustNoH%", $customerPhone2, $message);
		$message  = str_replace ("%Email%", $customerMail, $message);
		$message  = str_replace ("%ZC%", $customerZipCode, $message);
		$message  = str_replace ("%Mdate%", $movingDate, $message);
		$message  = str_replace ("%LNo%", $labors, $message);
		$message  = str_replace ("%Job%", $dest_info, $message);
		$message  = str_replace ("%Mover%", $memberName, $message);
		$message  = str_replace ("%state%", $memberState, $message);
		$message  = str_replace ("%MoverContactPerson%", $memberContactPerson, $message);
		$moverContact = $memberPhone.'(Phone), '.$memberEmail.'(Email)';		
		$message  = str_replace ("%MoverContact%", $moverContact, $message);
		$message  = str_replace ("%Admin%", "MMWC", $message);		

return "$message";
}







function admin_message_both($customerName, $customerPhone, $customerPhone2, $customerZipCode, $movingDate, $labors, $or_info, $dest_info, $memberName, $memberState, $memberContactPerson, $memberEmail,$memberPhone, $customerMail, $OrderID)
{
    $message="";
    $sql = "SELECT Detail from tbl_templates WHERE TempID='31'";

	$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

		$message  = str_replace ("%JobInfo%", "LUPU<br>OrderID:$OrderID", $temp_message);
		$message  = str_replace ("%Cust%", $customerName, $message);
		$message  = str_replace ("%CustNoW%", $customerPhone, $message);
		$message  = str_replace ("%CustNoH%", $customerPhone2, $message);
		$message  = str_replace ("%Email%", $customerMail, $message);
		$message  = str_replace ("%ZC%", $customerZipCode, $message);
		$message  = str_replace ("%Mdate%", $movingDate, $message);
		$message  = str_replace ("%LNo%", $labors, $message);
$both_service=$or_info.",".$dest_info;
		$message  = str_replace ("%Job%", $both_service, $message);
		$message  = str_replace ("%Mover%", $memberName, $message);
		$message  = str_replace ("%state%", $memberState, $message);
		$message  = str_replace ("%MoverContactPerson%", $memberContactPerson, $message);
		$moverContact = $memberPhone.'(Phone), '.$memberEmail.'(Email)';	
		$message  = str_replace ("%MoverContact%", $moverContact, $message);
		$message  = str_replace ("%Admin%", "MMWC", $message);		
return "$message";
}





/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Customer Emails///////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

function customer_origin_uncharged($OrderID, $or_cityd, $or_stated, $movingDate, $or_info, $labors)
{
    $message="";
	$sql = "SELECT Detail from tbl_templates WHERE TempID='14'";
	$result = mysql_query($sql) or die("Query failed23");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$temp_message = $line[Detail];
		$message  = str_replace ("%oid%", $OrderID, $temp_message);
		$message  = str_replace ("%from%", $or_stated, $message);
		$message  = str_replace ("%city%", $or_cityd, $message);
		$message  = str_replace ("%mdate%", $movingDate, $message);
		$message  = str_replace ("%Job%", $or_info, $message);
		$message  = str_replace ("%LNo%", $labors, $message);

return "$message";
}







function customer_destination_uncharged($OrderID, $dor_cityd, $dor_stated, $movingDate, $dest_info, $labors)
{
    $message="";

	$sql = "SELECT Detail from tbl_templates WHERE TempID='15'";
	$result = mysql_query($sql) or die("Query failed23");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$temp_message = $line[Detail];
		$message  = str_replace ("%oid%", $OrderID, $temp_message);
		$message  = str_replace ("%to%", $dor_stated, $message);
		$message  = str_replace ("%city%", $dor_cityd, $message);
		$message  = str_replace ("%mdate%", $movingDate, $message);
		$message  = str_replace ("%Job%", $dest_info, $message);
		$message  = str_replace ("%LNo%", $labors, $message);

return "$message";
}






function customer_both_uncharged($OrderID, $or_cityd, $dor_cityd, $or_stated, $dor_stated, $movingDate,$or_info, $dest_info, $labors)
{
    $message="";
		$sql = "SELECT Detail from tbl_templates WHERE TempID='40'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

		$message  = str_replace ("%oid%", $OrderID, $temp_message);
		$message  = str_replace ("%from%", $or_stated, $message);
		$message  = str_replace ("%origin_city%", $or_cityd, $message);
		$message  = str_replace ("%to%", $dor_stated, $message);
		$message  = str_replace ("%dest_city%", $dor_cityd, $message);
		$message  = str_replace ("%mdate%", $movingDate, $message);
		$message  = str_replace ("%Job%", $or_info.",".$dest_info, $message);
		$message  = str_replace ("%LNo%", $labors, $message);
return "$message";
}




function customer_origin_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName)
{
    $message="";
		$sql = "SELECT Detail from tbl_templates WHERE TempID='1'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];


switch($labors)
        {
                              
		case 1:
               $temp_message  = str_replace ("%y%", "$170", $temp_message);
			   $temp_message  = str_replace ("%x%", "$55", $temp_message);
			   break;
		case 2:
               $temp_message  = str_replace ("%y%", "$260", $temp_message);
			   $temp_message  = str_replace ("%x%", "$80", $temp_message);
			   break;
	    case 3:
               $temp_message  = str_replace ("%y%", "$310", $temp_message);
			   $temp_message  = str_replace ("%x%", "90", $temp_message);
			   break;
		case 4:
               $temp_message  = str_replace ("%y%", "$375", $temp_message);
			   $temp_message  = str_replace ("%x%", "$105", $temp_message);
			   break;
		case 5:
               $temp_message  = str_replace ("%y%", "$520", $temp_message);
			   $temp_message  = str_replace ("%x%", "$120", $temp_message);
			   break;
	    }
		$message  = str_replace ("%JobInfo%", $OrderID, $temp_message);
		$message  = str_replace ("%Moveratorigin%", $memberName, $message);
		$message  = str_replace ("%MoverEmail%", $memberEmail, $message);
		$message  = str_replace ("%MoverContact%", $memberPhone, $message);
		$message  = str_replace ("%CN%", $customerName, $message);

return "$message";
}







function customer_destination_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName)
{
    $message="";
		$sql = "SELECT Detail from tbl_templates WHERE TempID='2'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];


switch($labors)
        {
                              
		case 1:
               $temp_message  = str_replace ("%y%", "$170", $temp_message);
			   $temp_message  = str_replace ("%x%", "$55", $temp_message);
			   break;
		case 2:
               $temp_message  = str_replace ("%y%", "$260", $temp_message);
			   $temp_message  = str_replace ("%x%", "$80", $temp_message);
			   break;
	    case 3:
               $temp_message  = str_replace ("%y%", "$310", $temp_message);
			   $temp_message  = str_replace ("%x%", "90", $temp_message);
			   break;
		case 4:
               $temp_message  = str_replace ("%y%", "$375", $temp_message);
			   $temp_message  = str_replace ("%x%", "$105", $temp_message);
			   break;
		case 5:
               $temp_message  = str_replace ("%y%", "$520", $temp_message);
			   $temp_message  = str_replace ("%x%", "$120", $temp_message);
			   break;
	    }
		$message  = str_replace ("%JobInfo%", $OrderID, $temp_message);
		$message  = str_replace ("%Moveratdestination%", $memberName, $message);
		$message  = str_replace ("%MoverEmail%", $memberEmail, $message);
		$message  = str_replace ("%MoverContact%", $memberPhone, $message);
		$message  = str_replace ("%CN%", $customerName, $message);

return "$message";
}






function customer_both_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName)
{
    $message="";
		$sql = "SELECT Detail from tbl_templates WHERE TempID='39'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];


switch($labors)
        {
                              
		case 1:
               $temp_message  = str_replace ("%y%", "$170", $temp_message);
			   $temp_message  = str_replace ("%x%", "$55", $temp_message);
			   break;
		case 2:
               $temp_message  = str_replace ("%y%", "$260", $temp_message);
			   $temp_message  = str_replace ("%x%", "$80", $temp_message);
			   break;
	    case 3:
               $temp_message  = str_replace ("%y%", "$310", $temp_message);
			   $temp_message  = str_replace ("%x%", "90", $temp_message);
			   break;
		case 4:
               $temp_message  = str_replace ("%y%", "$375", $temp_message);
			   $temp_message  = str_replace ("%x%", "$105", $temp_message);
			   break;
		case 5:
               $temp_message  = str_replace ("%y%", "$520", $temp_message);
			   $temp_message  = str_replace ("%x%", "$120", $temp_message);
			   break;
	    }
		$message  = str_replace ("%JobInfo%", $OrderID, $temp_message);
		$message  = str_replace ("%Moveratdestination%", $memberName, $message);
		$message  = str_replace ("%MoverEmail%", $memberEmail, $message);
		$message  = str_replace ("%MoverContact%", $memberPhone, $message);
		$message  = str_replace ("%CN%", $customerName, $message);

return "$message";
}




/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Member Emails///////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


function member_origin_uncharged($OrderID, $or_stated, $or_cityd, $movingDate, $or_info, $labors)
{
    $message="";
  $sql = "SELECT Detail from tbl_templates WHERE TempID='16'";
		    $Subject = "You have accepted an order at origin";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];
		
		$message  = str_replace ("%oid%", $OrderID, $temp_message);
		$message  = str_replace ("%from%", $or_stated, $message);
		$message  = str_replace ("%city%", $or_cityd, $message);
		$message  = str_replace ("%mdate%", $movingDate, $message);
		$message  = str_replace ("%Job%", $or_info, $message);
		$message  = str_replace ("%LNo%", $labors, $message);


return "$message";
}






function member_origin_charged($or_cityd, $or_stated, $dor_cityd, $dor_stated, $labors, $Transport, $movingDate, $or_info, $dest_info, $customerName, $customerPhone, $customerPhone2, $customerMail, $movingDate)
{
    $message="";
    	        $sql = "SELECT Detail from tbl_templates WHERE TempID='10'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

	        $JobInfo = "Origin Location: $or_cityd,$or_stated <br> Destination Location: $dor_cityd,$dor_stated <br> Labor Required:$labors
	              <br> Transportation: $Transport <br> MoveDate: $movingDate <br> Service at Origin: $or_info <br> Service at 
				   Destination: $dest_info";
	 
		 $message  = "<br>";
		 switch($labors)
        {
                              
		case 1:
               $temp_message  = str_replace ("%x%", "$170", $temp_message);
			   $temp_message  = str_replace ("%y%", "$55", $temp_message);
			   break;
		case 2:
               $temp_message  = str_replace ("%x%", "$260", $temp_message);
			   $temp_message  = str_replace ("%y%", "$80", $temp_message);
			   break;
	    case 3:
               $temp_message  = str_replace ("%x%", "$310", $temp_message);
			   $temp_message  = str_replace ("%y%", "90", $temp_message);
			   break;
		case 4:
               $temp_message  = str_replace ("%x%", "$375", $temp_message);
			   $temp_message  = str_replace ("%y%", "$105", $temp_message);
			   break;
		case 5:
               $temp_message  = str_replace ("%x%", "$520", $temp_message);
			   $temp_message  = str_replace ("%y%", "$120", $temp_message);
			   break;
	    }
		
		 $message  = str_replace ("%JobInfo%","$JobInfo", $temp_message);
		 $message  = str_replace ("%Cust%","$customerName", $message);
		 $message  = str_replace ("%CustNoW%","$customerPhone", $message);
		 $message  = str_replace ("%CustNoH%","$customerPhone2", $message);
		 $message  = str_replace ("%Email%","$customerMail", $message);
		 $message  = str_replace ("%Mdate%","$movingDate", $message);
		 $message  = str_replace ("%LNo%","$labors", $message);

return "$message";
}






function member_both_uncharged($OrderID, $or_stated, $or_cityd, $dor_stated, $dor_cityd, $movingDate, $or_info, $dest_info, $labors)
{
    $message="";
                    $sql = "SELECT Detail from tbl_templates WHERE TempID='32'";
		    $Subject = "You have accepted an order at origin and destination";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];
		
		$message  = str_replace ("%oid%", $OrderID, $temp_message);
		$message  = str_replace ("%from%", $or_stated, $message);
		$message  = str_replace ("%city1%", $or_cityd, $message);
		$message  = str_replace ("%to%", $dor_stated, $message);
		$message  = str_replace ("%city2%", $dor_cityd, $message);
		$message  = str_replace ("%mdate%", $movingDate, $message);
		$message  = str_replace ("%Job%", $or_info.",".$dest_info, $message);
		$message  = str_replace ("%LNo%", $labors, $message);

return "$message";
}






function member_both_charged($or_cityd, $or_stated, $dor_cityd, $dor_stated, $labors, $Transport, $movingDate, $or_info, $dest_info, $customerName, $customerPhone, $customerPhone2, $customerMail, $movingDate)
{
     $message="";
    	        $sql = "SELECT Detail from tbl_templates WHERE TempID='10'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

	        $JobInfo = "Origin Location: $or_cityd,$or_stated <br> Destination Location: $dor_cityd,$dor_stated <br> Labor Required:$labors
	              <br> Transportation: $Transport <br> MoveDate: $movingDate <br> Service at Origin: $or_info <br> Service at 
				   Destination: $dest_info";
	 
		 $message  = "<br>";
		 switch($labors)
        {
                              
		case 1:
               $temp_message  = str_replace ("%x%", "$170", $temp_message);
			   $temp_message  = str_replace ("%y%", "$55", $temp_message);
			   break;
		case 2:
               $temp_message  = str_replace ("%x%", "$260", $temp_message);
			   $temp_message  = str_replace ("%y%", "$80", $temp_message);
			   break;
	    case 3:
               $temp_message  = str_replace ("%x%", "$310", $temp_message);
			   $temp_message  = str_replace ("%y%", "90", $temp_message);
			   break;
		case 4:
               $temp_message  = str_replace ("%x%", "$375", $temp_message);
			   $temp_message  = str_replace ("%y%", "$105", $temp_message);
			   break;
		case 5:
               $temp_message  = str_replace ("%x%", "$520", $temp_message);
			   $temp_message  = str_replace ("%y%", "$120", $temp_message);
			   break;
	    }
		
		 $message  = str_replace ("%JobInfo%","$JobInfo", $temp_message);
		 $message  = str_replace ("%Cust%","$customerName", $message);
		 $message  = str_replace ("%CustNoW%","$customerPhone", $message);
		 $message  = str_replace ("%CustNoH%","$customerPhone2", $message);
		 $message  = str_replace ("%Email%","$customerMail", $message);
		 $message  = str_replace ("%Mdate%","$movingDate", $message);
		 $message  = str_replace ("%LNo%","$labors", $message);

return "$message";
}







function member_destination_uncharged($OrderID, $dor_stated, $dor_cityd, $movingDate, $dest_info, $labors)
{
    $message="";
  $sql = "SELECT Detail from tbl_templates WHERE TempID='17'";
		    $Subject = "You have accepted an order at origin";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];
		
		$message  = str_replace ("%oid%", $OrderID, $temp_message);
		$message  = str_replace ("%to%", $dor_stated, $message);
		$message  = str_replace ("%city%", $dor_cityd, $message);
		$message  = str_replace ("%mdate%", $movingDate, $message);
		$message  = str_replace ("%Job%", $dest_info, $message);
		$message  = str_replace ("%LNo%", $labors, $message);


return "$message";
}






function member_destination_charged($or_cityd, $or_stated, $dor_cityd, $dor_stated, $labors, $Transport, $movingDate, $or_info, $dest_info, $customerName, $customerPhone, $customerPhone2,  $customerMail, $movingDate)
{
    $message="";
    	        $sql = "SELECT Detail from tbl_templates WHERE TempID='10'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];

	        $JobInfo = "Origin Location: $or_cityd,$or_stated <br> Destination Location: $dor_cityd,$dor_stated <br> Labor Required:$labors
	              <br> Transportation: $Transport <br> MoveDate: $movingDate <br> Service at Origin: $or_info <br> Service at 
				   Destination: $dest_info";
	 
		 $message  = "<br>";
		 switch($labors)
        {
                              
		case 1:
               $temp_message  = str_replace ("%x%", "$170", $temp_message);
			   $temp_message  = str_replace ("%y%", "$55", $temp_message);
			   break;
		case 2:
               $temp_message  = str_replace ("%x%", "$260", $temp_message);
			   $temp_message  = str_replace ("%y%", "$80", $temp_message);
			   break;
	    case 3:
               $temp_message  = str_replace ("%x%", "$310", $temp_message);
			   $temp_message  = str_replace ("%y%", "90", $temp_message);
			   break;
		case 4:
               $temp_message  = str_replace ("%x%", "$375", $temp_message);
			   $temp_message  = str_replace ("%y%", "$105", $temp_message);
			   break;
		case 5:
               $temp_message  = str_replace ("%x%", "$520", $temp_message);
			   $temp_message  = str_replace ("%y%", "$120", $temp_message);
			   break;
	    }
		
		 $message  = str_replace ("%JobInfo%","$JobInfo", $temp_message);
		 $message  = str_replace ("%Cust%","$customerName", $message);
		 $message  = str_replace ("%CustNoW%","$customerPhone", $message);
		 $message  = str_replace ("%CustNoH%","$customerPhone2", $message);
		 $message  = str_replace ("%Email%","$customerMail", $message);
		 $message  = str_replace ("%Mdate%","$movingDate", $message);
		 $message  = str_replace ("%LNo%","$labors", $message);

return "$message";
}
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////END FUNCTIONS////////////////////////////////////
//////////////////////////////START VARIABLE SETTING////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

$jid="";
if($location == "Origin")
{
$jid=$OrderID."1";
}
else
{
$jid=$OrderID."2";
}



// this is the new code
if($Type == "LUPU")
{
        // select and lock the order for update
        // and see if it is take or not
$work= true;
        $sql = "select * 
                from    tbl_lupu_orders 
                where   tbl_lupu_orders.OrderID = '$OrderID'";
                
        if (!$q = mysql_query($sql)) {
$work=false;
                echo mysql_error(), "at line ", __LINE__;
		exit;
        }
        
        if (!mysql_num_rows($q)) {
$work=false;
                echo "Failed to retrieve order with order id $OrderID at line ", __LINE__;
		exit;
        }                
        

        $r  = mysql_fetch_assoc($q);  
$charge=$r["Charged"];
$samestate= $r["SameState"];
        if ($r["Status_$location"] == 'A') {
$work=false;
                        echo "Order with $OrderID for $location is already taken at line ", __LINE__;
        		exit;
                }
$both=false;
if($work==true)
{
if($samestate=="no"){
$sql= "UPDATE tbl_lupu_orders SET Status_$location = 'A', ".$location."_MID='".$_SESSION['Member_Id']."' WHERE OrderID = '$OrderID'";

}
else{
$sql= "UPDATE tbl_lupu_orders SET Status_origin = 'A', Status_Dest = 'A', Origin_MID='".$_SESSION['Member_Id']."', Dest_MID='".$_SESSION['Member_Id']."' WHERE OrderID = '$OrderID'";
$both=true;
}
$q= mysql_query($sql);
}
                       

}


$sql = "SELECT admin_email from tbladmin";
    $result = mysql_query($sql) or die("Query failed1");
    $line = mysql_fetch_array($result, MYSQL_ASSOC);
    $AdminMail = $line[admin_email];
    	
    $MID = $_SESSION['Member_Id'];
    $sql = "SELECT MemberName, MemberType, ContactPerson, ContactEmail, ZipCode, Phone, State from tblmembers where MemberID='$MID'";
    $result = mysql_query($sql) or die("Query failed2");
    $line = mysql_fetch_array($result, MYSQL_ASSOC);
    $memberName = $line[MemberName];
    $memberType = $line[MemberType];
    $memberContactPerson = $line[ContactPerson];
    $memberZipCode = $line[ZipCode];
    $memberEmail = $line[ContactEmail];
    $memberPhone = $line[Phone];
    $memberState = $line[State];
    $sql = "SELECT name from states where sh_name = '$memberState'";
    $result = mysql_query($sql) or die("Query failed");
    $line = mysql_fetch_array($result, MYSQL_ASSOC);
    $memberState = $line[name];
    
    
    $sql = "SELECT FName, LName, Address, ZipCode, Phone, Phone2, EMail, Or_City, Or_State, Or_Load, Or_Pack, Dest_City, Dest_State, Dest_Unload, Dest_Unpack, MoveDate, Labor, Transport from tbl_lupu_orders where OrderID=$OrderID";    	
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
    $dor_city = $line[Dest_City];
    $dor_state = $line[Dest_State];
    $dor_load = $line[Dest_Unload];
    $dor_pack = $line[Dest_Unpack];
    $movingDate = $line[MoveDate];
    $labors = $line[Labor];
    $Transport= $line[Transport];
    
        //set the info message
		if ($or_load == 1 && $or_pack != 1)
			$or_info = "Loading";
		else if ($or_load != 1 && $or_pack == 1)
			$or_info = "Packing";
		else if ($or_load == 1 && $or_pack == 1)
			$or_info = "Loading,Packing";
		if ($dor_load == 1 && $dor_pack != 1)
			$dest_info = "Unloading";
		else if ($dor_load != 1 && $dor_pack == 1)
			$dest_info = "Unpacking";
		else if ($dor_load == 1 && $dor_pack == 1)
			$dest_info = "Unloading,Unpacking";   
    // find out name of origin city
	$query = "SELECT `city` FROM `cities` WHERE `CityID`='$or_city' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 2");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$or_cityd = $line[city];	
	
	// the same with destination city
	$query = "SELECT `city` FROM `cities` WHERE `CityID`='$dor_city' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 3");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$dor_cityd = $line[city];
	
	// find out the full names of states
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$or_state' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 4");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$or_stated = $line[name];
	
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$dor_state' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 5");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$dor_stated = $line[name];
    
    $origin = $or_cityd . "," . $or_stated;
	if ($Type=="LUPU")
		$dest = $dor_cityd . "," . $dest_stated;
	else
	    $dest = $dor_stated;
    
    

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////END VARIABLE SETTING///////////////////////////
//////////////////////////////START ACTUAL CODE//////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


//if accepted at origin
 if ($location == 'Origin')
{    	//mail to admin

    if($both==false){
         $message=admin_message_origin($customerName, $customerPhone, $customerPhone2, $customerZipCode, $movingDate, $labors, $or_info, $memberName, $memberState, $memberContactPerson, $memberEmail,$memberPhone, $customerMail, $OrderID);
		$Subject = "A Provider has accepted service request at origin";
    }
    else{
         $message=admin_message_both($customerName, $customerPhone, $customerPhone2, $customerZipCode, $movingDate, $labors, $or_info, $dest_info, $memberName, $memberState, $memberContactPerson, $memberEmail,$memberPhone, $customerMail, $OrderID);
		$Subject = "A Provider has accepted service request at origin/destination";
    }
	
        $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font><br><br>";
	$message = nl2br($message);

	$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$AdminMail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed71");
		send_mail($AdminMail, $AdminMail, $AdminMail, $Subject, $message);
		
      //end of admin mail sending

	//mail to customer

$message="";
$stored_message="";

    if($charge == 1){
        if($both==false){ 
             $message=customer_origin_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName);

		$Subject = "MoveMewithcare.com- Your credit card been approved: Please contact your service provider";
        }
        else{
             $message=customer_both_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName);

		$Subject = "MoveMewithcare.com- Your credit card been approved: Please contact your service provider";

        }
    }
    else{ //if the custromer hasn't been charged
        if($both==false){
             $message=customer_origin_uncharged($OrderID, $or_cityd, $or_stated, $movingDate, $or_info, $labors);
             $stored_message=customer_origin_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName);

		$Subject = "MoveMewithcare.com- Your Order Has Been Accepted at Origin";
        }
        else{
             $message=customer_both_uncharged($OrderID, $or_cityd, $dor_cityd, $or_stated, $dor_stated, $movingDate,$or_info, $dest_info, $labors);
             $stored_message=customer_both_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName);

		$Subject = "MoveMewithcare.com- Your Order Has Been Accepted at Origin and Destination";
        }
    }


		$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font><br><br>";		
		$message = nl2br($message);

		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES 
	 		('7', '$AdminMail', '$customerMail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed72");
                send_mail($AdminMail, $AdminMail, $customerMail, $Subject, $message);
    

		$Subject = "MoveMewithcare.com- Your credit card been approved: Please contact your service provider";
    if($stored_message!="")
    {
		$stored_message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $stored_message . "</center></font><br><br>";		
		$stored_message = nl2br($stored_message);

		$sql = "INSERT INTO `uncharged_email` (`OrderId`, `MailType`, `From`, `To`, `Subject`, `Message`) VALUES 
	 		('$OrderID', '7', '$AdminMail', '$customerMail', '$Subject', '$stored_message')";
		$result = mysql_query($sql) or die("Query failed73 $sql");
    }







		//mail to member
//if the customer has been charged send move the full information

    $message="";

    if($charge == 1){
        if($both==false){ 
             $message=member_origin_charged($or_cityd, $or_stated, $dor_cityd, $dor_stated, $labors, $Transport, $movingDate, $or_info, $dest_info, $customerName, $customerPhone, $customerPhone2, $customerMail, $movingDate);
		    $Subject = "You have accepted an order at origin";
        }
        else{
             $message=member_both_charged($or_cityd, $or_stated, $dor_cityd, $dor_stated, $labors, $Transport, $movingDate, $or_info, $dest_info, $customerName, $customerPhone, $customerPhone2,$customerMail, $movingDate);
		    $Subject = "You have accepted an order at origin and destination";

        }
    }
    else{ //if the custromer hasn't been charged
        if($both==false){
             $message=member_origin_uncharged($OrderID, $or_stated, $or_cityd, $movingDate, $or_info, $labors);
		    $Subject = "You have accepted an order at origin";
        }
        else{
             $message=member_both_uncharged($OrderID, $or_stated, $or_cityd, $dor_stated, $dor_cityd, $movingDate, $or_info, $dest_info, $labors);
		    $Subject = "You have accepted an order at origin and destination";
        }
    }

	
		$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font><br><br>";		
		$message = nl2br($message);

		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$memberEmail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed76 $sql");
                send_mail($AdminMail, $AdminMail, $memberEmail, $Subject, $message);
            
	
    }
    
    //if ($dor_load == 1 || $dor_pack == 1) //request at destination
if ($location == 'Dest')
{
//mail admin
    if($both==false){
         $message=admin_message_destination($customerName, $customerPhone, $customerPhone2, $customerZipCode, $movingDate, $labors, $dest_info, $memberName, $memberState, $memberContactPerson, $memberEmail,$memberPhone, $customerMail, $OrderID);
		$Subject = "A Provider has accepted service request at destination";
    }
    else{
         $message=admin_message_both($customerName, $customerPhone, $customerPhone2, $customerZipCode, $movingDate, $labors, $or_info, $dest_info, $memberName, $memberState, $memberContactPerson, $memberEmail,$memberPhone, $customerMail, $OrderID);
		$Subject = "A Provider has accepted service request at origin/destination";
    }


		$message  = str_replace ("%Admin%", "MMWC", $message);		
		$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font><br><br>";
		$message = nl2br($message);
//if they have been charged send an email otherwise, store it to a database for later

		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$AdminMail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed77");
		send_mail($AdminMail, $AdminMail, $AdminMail, $Subject, $message);
		//mail to customer

$message="";
$stored_message="";

//mail customer
    if($charge == 1){
        if($both==false){ 
             $message=customer_destination_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName);

		$Subject = "MoveMewithcare.com- Your credit card been approved: Please contact your service provider";
        }
        else{
             $message=customer_both_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName);

		$Subject = "MoveMewithcare.com- Your credit card been approved: Please contact your service provider";
        }
    }
    else{ //if the custromer hasn't been charged
        if($both==false){
             $message=customer_destination_uncharged($OrderID, $dor_cityd, $dor_stated, $movingDate, $dest_info, $labors);
             $stored_message=customer_destination_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName);
		$Subject = "MoveMewithcare.com- Your Order Has Been Accepted at  Destination";
        }
        else{
             $message=customer_both_uncharged($OrderID, $or_cityd, $dor_cityd, $or_stated, $dor_stated, $movingDate,$or_info, $dest_info, $labors);
             $stored_message=customer_both_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName);
		$Subject = "MoveMewithcare.com- Your Order Has Been Accepted at Origin and Destination";
        }
    }

		$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font><br><br>";		
		$message = nl2br($message);

		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$customerMail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed72");
                send_mail($AdminMail, $AdminMail, $customerMail, $Subject, $message);
    


		$Subject = "MoveMewithcare.com- Your credit card been approved: Please contact your service provider";

    if($stored_message!="")
    {
		$stored_message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $stored_message . "</center></font><br><br>";		
		$stored_message = nl2br($stored_message);

		$sql = "INSERT INTO `uncharged_email` (`OrderId`, `MailType`, `From`, `To`, `Subject`, `Message`) VALUES 
	 		('$OrderID', '7', '$AdminMail', '$customerMail', '$Subject', '$stored_message')";
		$result = mysql_query($sql) or die("Query failed73 $sql");
    }







		//mail to member
//if the customer has been charged send move the full information

    $message="";

    if($charge == 1){
        if($both==false){ 
             $message=member_destination_charged($or_cityd, $or_stated, $dor_cityd, $dor_stated, $labors, $Transport, $movingDate, $or_info, $dest_info, $customerName, $customerPhone, $customerPhone2, $customerMail, $movingDate);
		    $Subject = "You have accepted an order at destination";
        }
        else{
             $message=member_both_charged($or_cityd, $or_stated, $dor_cityd, $dor_stated, $labors, $Transport, $movingDate, $or_info, $dest_info, $customerName, $customerPhone, $customerPhone2, $customerMail, $movingDate);
		    $Subject = "You have accepted an order at origin and destination";

        }
    }
    else{ //if the custromer hasn't been charged
        if($both==false){
             $message=member_destination_uncharged($OrderID, $dor_stated, $dor_cityd, $movingDate, $dest_info, $labors);
		    $Subject = "You have accepted an order at destination";
        }
        else{
             $message=member_both_uncharged($OrderID, $or_stated, $or_cityd, $dor_stated, $dor_cityd, $movingDate, $or_info, $dest_info, $labors);
		    $Subject = "You have accepted an order at origin and destination";
        }
    }

	
		$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font><br><br>";		
		$message = nl2br($message);

		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$memberEmail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed76 $sql");
                send_mail($AdminMail, $AdminMail, $memberEmail, $Subject, $message);
            
    }
    
	@header("Location:basa.php?day=$day&month=$month&year=$year");
	exit;

?>


