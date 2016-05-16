<? 
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
   $Cal = $_POST['Cal'];
   $day = $_POST['day'];
   $month = $_POST['month'];
   $year = $_POST['year'];
   $mod_fs = $_POST['mod_fs'];
   $OrderType = $_POST['OrderType'];
   $Charged= $_POST['Charged'];
//cancel the order

$sql="Update tbl_lupu_orders SET Status_Order='B' WHERE OrderID='$OID'";
$r=mysql_query($sql);

//get all the data
$sql="Select Sal, FName, LName, Phone, Phone2, Address, MoveDate, Labor, Or_State, Or_City, Dest_State, Origin_MID, Dest_MID, Or_Load, Or_Pack, Dest_Unpack, Dest_Unload, Transport , Dest_City, EMail FROM tbl_lupu_orders WHERE OrderID='$OID'";
$r=mysql_query($sql);
while($result=mysql_fetch_row($r))
{
$Name= $result[0].$result[1]." ".$result[2];
$Phone=$result[3];
$Phone2=$result[4];
$Address=$result[5];
$Date=$result[6];
$Labor=$result[7];
$Or_State=$result[8];
$Or_City=$result[9];
$Dest_State=$result[10];
$Origin_MID=$result[11];
$Dest_MID=$result[12];
$Or_Load=$result[13];
$Or_Pack=$result[14];
$Dor_Pack=$result[15];
$Dor_Load=$result[16];
$Transport=$result[17];
$Dest_City=$result[18];
$email=$result[19];
}
//get appropriate email emplate
if($Charged==1){
$email_type=35;
$sql="SELECT Detail FROM tbl_templates WHERE TempID='35'";
}
else{
$email_type==11;
$sql="SELECT Detail FROM tbl_templates WHERE TempID='11'";
}

$r=mysql_query($sql);
while($result=mysql_fetch_row($r))
{
$temp_message= $result[0];
}

//format the email
$or_info="";
$dest_info="";
if($Or_Load==1){
$or_info="Load;";
}
if($Or_Pack==1){
$or_info.="Pack;";
}
if($Dor_Load==1){
$dest_info="Unload;";
}
if($Dor_Pack==1){
$dest_info.="Unpack;";
}

$sql="Select name FROM states WHERE StateID='$Or_State'";
$r=mysql_query($sql);
while($result=mysql_fetch_row($r))
{
$Or_State=$result[0];
}
$sql="Select name FROM states WHERE StateID='$Dest_State'";
$r=mysql_query($sql);
while($result=mysql_fetch_row($r))
{
$Dest_State=$result[0];
}
$sql="Select city FROM cities WHERE CityID='$Or_City'";
$r=mysql_query($sql);
while($result=mysql_fetch_row($r))
{
$Or_City=$result[0];
}

$sql="Select city FROM cities WHERE CityID='$Dest_City'";
$r=mysql_query($sql);
while($result=mysql_fetch_row($r))
{
$Dest_City=$result[0];
}

$JobInfo="</br>Origin Location:$Or_State, $Or_City </br>
Destination Location:$Dest_State, $Dest_City</br>
Origin Service: $or_info</br>
Destination Service: $dest_info</br>";

$temp_message = str_replace("%JobInfo%","$JobInfo", $temp_message);
$temp_message = str_replace("%NLabors%","$Labor", $temp_message);
$temp_message = str_replace("%OrderID%","$OID", $temp_message);
$temp_message = str_replace("%CName%","$Name", $temp_message);
$temp_message = str_replace("%CContactW%","$Phone", $temp_message);
$temp_message = str_replace("%CContactH%","$Phone2", $temp_message);
$temp_message = str_replace("%Email%","$email", $temp_message);
$temp_message = str_replace("%MD%","$Date<", $temp_message);
 $temp_message = nl2br($temp_message);
		 $temp_message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../parth/logos/MUWC_Logo.gif\"><br>" . $temp_message . "</center></font>";

//send the email
$sql="Select admin_email FROM tbladmin";
$r=mysql_query($sql);
while($result=mysql_fetch_row($r))
{
$AdminMail=$result[0];
}

$sql="Select ContactEmail, MemberID FROM tblmembers WHERE MemberID='$Origin_MID' OR MemberID='$Dest_MID'";
$r=mysql_query($sql);
while($result=mysql_fetch_row($r))
{
$Mail = $result[0];
$MID= $result[1];


 $s = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES ('$email_type', '$AdminMail', '$Mail', 'MovingUWithCare.Com - Order Canceled', '$message', '$OID')";
		 $e=mysql_query($s);
    send_mail($AdminMail, $AdminMail, "$Mail","MovingUWithCare.Com - Order Canceled", "$temp_message");

}
     @header("Location: order_details1.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID&OrderType=$OrderType&day=$day&month=$month&year=$year&Cal=$Cal&mod_fs=$mod_fs");
	 exit;
?>
  
	