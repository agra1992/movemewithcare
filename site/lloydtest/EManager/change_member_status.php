<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
  require_once "./mailer.php"; 
   $ID = $_GET['ID'];
   $nSearchCrit = $_GET['nSearchCrit'];
   $SearchString = $_GET['SearchString'];
   $count = $_GET['count'];
   $offset = $_GET['offset'];
   $status = $_GET['status'];
   $Mod = $_GET['Mod'];
   $Type = $_GET['Type'];
  
   
   if ($status == "1")
   {
     $strQuery = "update tblmembers set Active = '0' where MemberID='$ID'";
	   if ($DataBase->query($strQuery))
	   {
	       $sql = "SELECT admin_email,Name from tbladmin";
		  $DataBase->query($sql);
		  $Record = $DataBase->fetch_row();
		  $AdminMail 	 = $Record[0];
		  $AdminName 	 = $Record[1];

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='7'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 $temp_message = $Record[0];
		 
		 $sql = "SELECT ContactEmail from tblmembers WHERE MemberID='$ID'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 $email = $Record[0];
		
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%xyz%","<b>$AdminName</b>", $temp_message);
		 $message  =  str_replace("%email%", $AdminMail, $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../parth/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MUWC - Registeration Deactivated";

	 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('3', '$from', '$email', '$Subject', '$message')";
		 $DataBase->query($sql);
		 send_mail($from, $from, $email, $Subject, $message);
@header("Location:members.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&Mod=$Mod&Type=$Type");
		 exit;		
	   }
   }
   elseif ($status == "0")
   {
     $strQuery = "update tblmembers set Active = '1' where MemberID='$ID'";
	   if ($DataBase->query($strQuery))
	   {
	      $sql = "SELECT admin_email from tbladmin";
		  $DataBase->query($sql);
		  $Record = $DataBase->fetch_row();
		  $AdminMail 	 = $Record[0];

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='6'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 $temp_message = $Record[0];
		 
		 $sql = "SELECT Login, pass, ContactEmail from tblmembers WHERE MemberID='$ID'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 $login = $Record[0];
		 $pass = $Record[1];
		 $email = $Record[2];		 
		 
		 //process		
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);		 
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../parth/logos/MUWC_Logo.gif\">" . $message . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MMWC - Registeration Confirmed";
		 
  	 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('2', '$from', '$email', '$Subject', '$message')";
		 $DataBase->query($sql);
                 send_mail($from, $from, $email, $Subject, $message);
		 @header("Location:members.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&Mod=$Mod&Type=$Type");
		 exit;
	   }
   }
   
   
?>
