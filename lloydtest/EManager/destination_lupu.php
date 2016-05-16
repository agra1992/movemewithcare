<?
include "Security.php";
//include "mailer.php";
function store_orders($dor_ret, $LeadId, $valid, $st_date, $labors, $dor_shname, $dor_service, $IP, $AdminMail)
{
    $Subject = "New Order from MMWC";

   
    $message="";
    $values="";
    foreach($dor_ret as $member)
    {
        $distance = $member[7];
        $memberEmail = $member[2];
        $message = member_destination($LeadId, $dor_service, $dor_shname, $st_date, $labors, $distance);

                        if($message!=""){
			$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
			$message = nl2br($message);
                        send_or_store($valid, $AdminMail, $memberEmail, $Subject, $message, $LeadId, $IP);}

        $values.="($LeadId , $member[0] , 'destination', '$valid'),";
    }
    $values = substr($values, 0 , -1);
    $sql="INSERT INTO orders_sent (order_id, member_id, location, valid) VALUES $values";
    $r = mysql_query($sql);


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



function member_destination($LeadId, $dor_service, $dest, $st_date, $labors, $distance)
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
			$message  = str_replace ("%distance%", $distance, $message);


return "$message"; 
}



$ID= $_POST[ID];
$IP= $_POST[IP];

$dor_state= $_POST[dor_state];
$LeadId = $_POST[OID];
$labors = $_POST[labor];
$st_date = $_POST[move_date];
$valid= $_POST[Valid];
$dest_zipcode = $_POST[dest_zipcode];
$dor_service = $_POST[services];
    $sql= "SELECT sh_name FROM states WHERE StateID='$dor_state'";
    $r=mysql_query($sql) or die('could not retrieve state info');
    list($dor_shname) = mysql_fetch_array($r);


    if($dor_state > 52){
        $dor_country="canada";
$dor_sql = "SELECT lon, lat FROM zip_canada WHERE zipcode='$dest_zipcode'";
    $r=mysql_query($dor_sql) or die('could not retrieve zipcode info');
    list($dor_long, $dor_lat) = mysql_fetch_array($r);
    $zip_database='zip_canada';
    }else{  
        $dor_country="USA";
$dor_sql = "SELECT lon, lat FROM zip_usa WHERE zipcode='$dest_zipcode'";
    $r=mysql_query($dor_sql) or die('could not retrieve zipcode info');
    list($dor_long, $dor_lat) = mysql_fetch_array($r);
    $zip_database='zip_usa';
    }

$dor_sql="Select 
	tblmembers.MemberID, 
	tblmembers.MemberName, 
	tblmembers.ContactEmail, 
	tblmembers.MemberType, 
	tblmembers.TollFree, 
	tblmembers.sms_service, 
	tblmembers.sms_address ,
IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($dor_lat))*SIN(RADIANS(lat))+COS(RADIANS($dor_lat))*COS(RADIANS(lat))*COS(RADIANS($dor_long-lon)))),2)* 69.09,0) AS distance
From 
	tblmembers LEFT JOIN  $zip_database ON  $zip_database.zipcode =tblmembers.ZipCode
				     
Where 
	(
		(
			tblmembers.MemberType = 'standard' OR 
			tblmembers.MemberType = 'full'
		) AND 
		tblmembers.Active = '1' AND
		(
			(
				tblmembers.State like '$dor_shname%' AND 
				(IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($dor_lat))*SIN(RADIANS(lat))+COS(RADIANS($dor_lat))*COS(RADIANS(lat))*COS(RADIANS($dor_long-lon)))),2)* 69.09,0) < tblmembers.distance)
			) OR 
			(
				tblmembers.State like 'NA%'AND 
				tblmembers.MemberState = '999' AND 
				tblmembers.ServiceCountry = '$dor_country'
			) OR (
				tblmembers.State like 'NA%' AND
				tblmembers.ServiceCountry = '$dor_country' AND 
				(IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($dor_lat))*SIN(RADIANS(lat))+COS(RADIANS($dor_lat))*COS(RADIANS(lat))*COS(RADIANS($dor_long-lon)))),2)* 69.09,0) < tblmembers.distance)
			)
		)
	) ";
        	$result = mysql_query($dor_sql) or die("Query failed2332 $dor_sql");
			$dor_ret= array();
			$num = mysql_num_rows($result);

			for($i=0;$i<$num;$i++)
			{
				array_push($dor_ret,mysql_fetch_row($result));
			}


        $sql= "UPDATE tbl_lupu_orders SET Dest_ZipCode = '$dest_zipcode' WHERE OrderID = '$LeadId'";
        $r = mysql_query($sql);


    $sql= "SELECT admin_email FROM tbladmin LIMIT 1";
    $r=mysql_query($sql) or die('could not retrieve admin email');
    list($AdminMail) = mysql_fetch_array($r);

	store_orders($dor_ret, $LeadId, $valid, $st_date, $labors, $dor_shname, $dor_service , $IP, $AdminMail);



header("location:http://lloydtest.movemewithcare.com/EManager/view_orders.php?ID=$ID")



 
?>
