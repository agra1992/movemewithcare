<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   $ID = $_POST['ID'];
   $Name = CheckString($_POST['Name']);
   $Desc = CheckString($_POST['Desc']);
   
  $strQuery = "update associations set 
		ass_shname = '$Name',
		ass_fullname = '$Desc' where assid='$ID'";
   if ($DataBase->query($strQuery))
   {
     @header("Location: associations.php");
	 exit;
   }
?>

	
  
         
	
	
	
   
   