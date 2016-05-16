<? 
session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   require_once "mailer.php";   
   $TO = $_POST['to'];
   $CC = $_POST['cc'];
   $Subject = $_POST['subject'];
   $to_mass = $_POST['service'];
   $To_Array = explode(",", $TO);
   $CC_Array = explode(",", $CC);
   $strError = "";
   $strMess = "";
   $state= $_POST['state'];
   $conflag = "0";
   $errflag = "0";
   $Message=$_POST['message'];
   $work=$_POST['work'];

$data= $_SESSION['data'];

$total = count($data);

//will be used to determine whether an or statment is needed
   $number_states = count($state);

$where_causes= "State like '$state[0]'";
if($number_states>1)
{
    foreach ($state as $a_state)
    {
         $where_causes=$where_causes." or State='$a_state'";
    }
}



          $sql = "SELECT admin_email from tbladmin";
		  $DataBase->query($sql);
		  $Record = $DataBase->fetch_row();
		  $AdminMail = $Record[0];
		  $from = "$AdminMail";

$strError = "<center>The system was unable to send email to the following:<br>";
//send to mass
if(!empty($to_mass[0]))
{

foreach($to_mass as $to_service)
{
   $strMess = "<center>Your message has been sent to the following: <br>";

	$q= "SELECT `ContactEmail`, `MemberID` FROM tblmembers WHERE MemberType like '$to_service' AND ($where_causes)";
        $r= mysql_query($q) ; 

        while(list($ContactEmail, $MemberID) = mysql_fetch_array($r, MYSQL_NUM))
        {	                                    
            if($work=="true")
           {
               for($i=0; $i<$total; $i++)
               {
                   if($data[$i][8]=="on")
                   {
                   $u="INSERT INTO dead_haul_log (OrderID, MID) values('".$data[$i][7]."', '$MemberID')";

                    $ur = mysql_query($u);
                     }
               }
           }
if(send_mail("$from","$from","$ContactEmail","$Subject","$Message"))
                 {

				   $conflag = "1";
				   
				   $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('6', '$from', '$ContactEmail', '$Subject','$Message')";
				   $DataBase->query($sql);
				   $strMess .= "$ContactEmail<br>";
				 }
				 else
				 {
				   $errflag = "1";
				   $strError .= "$ContactEmail<br>";
				 }
        }
}
}
//send to individuals
if(!empty($To_Array[0]))
{
		  foreach ($To_Array as $k => $v) 
		  {
				 if (send_mail("$from","$from","$v","$Subject","$Message"))
                 {
				   $conflag = "1";
				   
				   $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) 
									   VALUES ('6', '$from', '$v', '$Subject','$Message')";
				   $DataBase->query($sql);
				   $strMess .= "$v<br>";
//put in in logs
	$q= "SELECT `MemberID` FROM tblmembers WHERE ContactEmail='$v'";
        $rs= mysql_query($q) ; 

        while ($line = mysql_fetch_array($rs, MYSQL_ASSOC))
	{        
            if($work=="true")
           {
               for($i=0; $i<$total; $i++)
               {
                   if($data[$i][8]=="on")
                   {
                   $u="INSERT INTO dead_haul_log (OrderID, MID) values('".$data[$i][7]."', '$MemberID')";

                    $ur = mysql_query($u);
                     }
               }
           }
          }
				 }
				 else
				 {
				   //$errflag = "1";
				   $strError .= "$v<br>";
				 }
          }
}
if(!empty($CC_Array[0]))
{
		  foreach ($CC_Array as $k => $v) 
		  {
		        if (send_mail("$from","$from","$v","$Subject","$Message"))
                 {
				   $conflag = "1";
				   
				   $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `CC`, `Subject`, `Message`) 
									   VALUES ('6', '$from', '$v', '$Subject','$Message')";
				   $DataBase->query($sql);
				   $strMess .= "$v<br>";
				 }
				 else
				 {
				   $errflag = "1";
				   $strError .= "$v<br>";
				 }
          }
}
		  
		  if ($conflag == "1")
		  {
		    $strMess .= "</center><br>";

		  }
		   
		  if ($errflag == "1")
		  {
  		    $strError .= "Please verify that there is no spelling 
			               mistake and these email adresses actually exist.</center><br>";

			echo "<br>";
		  }

          echo "<center><input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='members_mails_send.php'\">";

include "footer.php";

?>