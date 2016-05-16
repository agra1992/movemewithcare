<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   
   $TO = $_POST['to'];
   $CC = $_POST['cc'];
   $Subject = $_POST['subject'];
   $To_Array = explode(",", $TO);
   $CC_Array = explode(",", $CC);
   $strError = "";
   $strMess = "";
   
   $conflag = "0";
   $errflag = "0";
   
   $strMess = "<center>Your message has been sent to the following: <br>";
   $strError = "<center>The system was unable to send email to the following:<br>";
   
   foreach($_POST as $sForm => $value)
   {
	$Message = htmlspecialchars(stripslashes($value)) ;
   }


          $sql = "SELECT admin_email from tbladmin";
		  $DataBase->query($sql);
		  $Record = $DataBase->fetch_row();
		  $AdminMail = $Record[0];
          
		  $from = "$AdminMail";
		  
		  foreach ($To_Array as $v) 
		  {
echo" v is currently $v next";
		         if (send_mail("$from",SYSTEM_EMAIL_NAME,"$v","$Subject","$Message"))
                 {
				   $conflag = "1";
				   $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) 
									   VALUES ('5', '$from', '$v', '$Subject','$Message')";
				   $DataBase->query($sql);
				   $strMess .= "$v<br>";
				 }
				 else
				 {
				   $errflag = "1";
				   $strError .= "$v<br>";
				 }
          }
		  
		  foreach ($CC_Array as $k => $v) 
		  {
		        if (send_mail("$from",SYSTEM_EMAIL_NAME,"$v","$Subject","$Message"))
                 {
					$conflag = "1";
				   
					 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `CC`, `Subject`, `Message`) 
									   VALUES ('5', '$from', '$v', '$Subject','$Message')";
					 $DataBase->query($sql);
					 $strMess .= "$v<br>";
				   }
				   else
				   {
					$errflag = "1";;
					$strError .= "$v<br>";
				   }
			 
            }
		  
		  if ($conflag == "1")
		  {
		    $strMess .= "</center><br>";
		    echo $strMess;
		  }
		   
		  if ($errflag == "1")
		  {
  		    $strError .= "Please verify that there is no spelling 
			               mistake and these email adresses actually exist.</center><br>";
			echo $strError;
			echo "<br>";
		  }

          echo "<center><input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='customers_mails_send.php'\">";

include "footer.php";

?>