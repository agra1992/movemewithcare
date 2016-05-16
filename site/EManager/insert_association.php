<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   $Name = CheckString($_POST['Name']);
   $Desc = CheckString($_POST['Desc']);
   
  $strQuery = "insert into associations
	     	(
			ass_shname,
			ass_fullname,
			DateAdded)
		values
		(
			'$Name',
			'$Desc',
			CURRENT_TIMESTAMP
		 )";
   if ($DataBase->query($strQuery))
   {
     @header("Location: associations.php");
	 exit;
   }
?>

	
  
         
	
	
	
   
   