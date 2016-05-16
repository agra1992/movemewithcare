<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   $ID = $_GET['link_number'];
   $strQuery = "Delete from links where LinkID='$ID'";
   if ($DataBase->query($strQuery))
   {
     @header("Location: links.php");
	 exit;
   }
?>

	
  
         
	
	
