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
	     $line = mysql_fetch_assoc($result);
         $email = $line[email];

if($valid=="yes")
{
$sql="Select tbl_lupu_orders.OrderID, tbl_lupu_orders.Sal, tbl_lupu_orders.FName, tbl_lupu_orders.LName, tbl_lupu_orders.Address,tbl_lupu_orders.ZipCode, tbl_lupu_orders.Phone, tbl_lupu_orders.Phone2, tbl_lupu_orders.EMail , tbl_lupu_orders.MoveType, tbl_lupu_orders.Or_City, tbl_lupu_orders.Or_State,  tbl_lupu_orders.Dest_State,   tbl_lupu_orders.IP, tbl_lupu_orders.Domain,  tbl_lupu_orders.MoveDate, tbl_lupu_orders.OrderTime From tbl_lupu_orders LEFT JOIN tblcustomers ON tbl_lupu_orders.CustomerID = tblcustomers.CustomerID WHERE tbl_lupu_orders.CustomerID='$ID' AND Status_Order='G' AND Transport='yes'";

$r=mysql_query($sql);

while($result=mysql_fetch_assoc($r))
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




    $sql="UPDATE orders_sent JOIN tbl_lupu_orders ON tbl_lupu_orders.OrderID= orders_sent.order_id SET orders_sent.valid='yes' WHERE tbl_lupu_orders.CustomerID= '$ID' ";
    $r_s = mysql_query($sql);

$sql = "SELECT  `From`,`To` ,`Subject` ,`Message`,`OrderId` FROM tbl_Unvalidated_Email
WHERE tbl_Unvalidated_Email.IP = '$IP'";
$r = mysql_query($sql) or die("query failed 897 $sql");
    while(list($From, $To, $Subject, $Message, $OrderId) = mysql_fetch_array($r))
    {
send_mail($AdminMail, $AdminMail, $To, $Subject, $Message);
			 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES ('10', '$AdminMail', '$To', '$Subject', '$Message','$OrderId')";
		 $er=mysql_query($sql); 

}

   

}

   @header("Location: view_orders.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID");
	 exit;


?>

	
  
         
	
	
	
   
   