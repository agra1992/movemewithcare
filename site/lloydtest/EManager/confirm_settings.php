<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   
   $Pass2 = CheckString($_POST['Pass2']);
   $Email1 = CheckString($_POST['Email1']);
   
   if(!(empty($Pass2)))
   {   
  		$strQuery = "update tbladmin set 
		pass = '$Pass2' where admin_id=" . $_COOKIE['Admin_Id'];
		$DataBase->query($strQuery);
   }
   if(!(empty($Email1)))
   {   
  		$strQuery = "update tbladmin set 
		admin_email = '$Email1' where admin_id=" . $_COOKIE['Admin_Id'];
		$DataBase->query($strQuery);
   }
   
    setcookie("Admin_Id", "", time() - 3600);
	setcookie("Admin_Name", "", time() - 3600);
	setcookie("Admin_Password", "" , time() - 3600);
	setcookie("Admin_Email", "" , time() - 3600);
	setcookie("Admin_Status", "" , time() - 3600);
    @header("Location: index.php");
	exit;
   
?>

	
  
         
	
	
	
   
   