<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   $ID = $_GET['ID'];
   $strQuery = "Delete from associations where assid='$ID'";
   if ($DataBase->query($strQuery))
   {
     @header("Location: associations.php");
	 exit;
   }
?>

	
  
         
	
	
	
   
   