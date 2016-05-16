<? 
   include "Security.php";
   
   $CID = $_POST['CID'];
   
   foreach($_POST as $sForm => $value)
   {
	$content = CheckString($value);
   }
   
	 $content = ereg_replace("<br />","", $content);
   
    
    $strQuery = "update tblcontent set 
		          Detail = '$content'
			  where CID ='$CID'";
			  
   if ($DataBase->query($strQuery))
   {
      $sql = "SELECT admin_email,Name from tbladmin";
	  $DataBase->query($sql);
	  $Record = $DataBase->fetch_row();
	  $AdminMail 	 = $Record[0];
	  $AdminName 	 = $Record[1];
	  
	  $today = date("F j, Y, g:i a");

	  $message = "Content # $CID has been changed on $today.";
     send_mail("AdminMail",$AdminMail,$AdminMail,"MovemeWithCare.Com - Content Changed","$message");
     @header("Location: content.php");
	 exit;
   }
    
?>