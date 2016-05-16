<?php 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   require_once "mailer.php";
   
		 
   $ID = $_POST['ID'];
   $nSearchCrit = $_POST['nSearchCrit'];
   $SearchString = $_POST['SearchString'];
   $offset = $_POST['offset'];
   $count = $_POST['count'];
   $OID = $_POST['OID'];
   $valid= $_POST['validate'];
   $IP = $_POST['IP'];
   $sql = "UPDATE tblcustomers SET Valid = '$valid' WHERE IP ='$IP'";
   $r= mysql_query($sql);
//if they are being validated send out all stored emails

         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed2333");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email];
$sql = "SELECT `email` from tblcustomers WHERE IP='$IP' ";
	     $result = mysql_query($sql) or die("Query failed2333");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $email = $line[email];

if($valid=="yes")
{
$sql="Select OrderID, Sal, FName, LName, Address,ZipCode, Phone, Phone2, EMail , MoveType, Or_City, Or_State,  Dest_State,   IP, Domain,  MoveDate, OrderTime From tbl_lupu_orders WHERE IP='$IP' AND Status_Order='G' AND Transport='yes'";

$r=mysql_query($sql);
while($result=mysql_fetch_array($r, MYSQL_ASSOC))
{
$serv1=$result[MoveType];
$LeadId=$result[OrderID];
$salut=$result[Sal];
$fname=$result[FName];
$lname=$result[LName];
$address=$result[Address];
$zipcode=$result[ZipCode];
$phone1=$result[Phone];
$phone2=$result[Phone2];
$email=$result[EMail];
$or_city=$result[Or_City];
$or_state=$result[Or_State];
$dor_state=$result[Dest_State];
$IP=$result[IP];
$user_domain=$result[Domain];
$st_date=$result[MoveDate];


$query = "INSERT INTO `tbl_transport_orders` (OrderID, Sal, FName, LName, Address,ZipCode, Phone, Phone2, EMail , MoveType, Or_City, Or_State,  Dest_State,   IP, Domain,  MoveDate, OrderTime)
		VALUES('$LeadId', '$salut', '$fname', '$lname', '$address', '$zipcode', $phone1, $phone2, '$email', '$serv1', '$or_city','$or_state', '$dor_state', '$IP', '$user_domain',  '$st_date', CURRENT_TIMESTAMP)";

$ri = mysql_query($query) or die("Query failed: 1 $query");

               
}





$sql = "SELECT  `From`,`To` ,`Subject` ,`Message`,`OrderId` FROM tbl_Unvalidated_Email
WHERE tbl_Unvalidated_Email.IP = '$IP'";
$r = mysql_query($sql) or die("query failed 897 $sql");
    while(list($From, $To, $Subject, $Message, $OrderId) = mysql_fetch_array($r, MYSQL_NUM))
    {
send_mail($AdminMail, $AdminMail, $To, $Subject, $Message);
			 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES ('10', '$AdminMail', '$To', '$Subject', '$Message','$OrderId')";
		 $er=mysql_query($sql); 

}
}

   @header("Location: view_orders.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID");
	 exit;


?>

	
  
         
	
	
	
   
   