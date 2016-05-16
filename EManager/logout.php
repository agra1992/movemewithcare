<?      
	//session_start();
	
	if (isset($_COOKIE['Admin_Id']))
	{
		setcookie("Admin_Id", "", time() - 3600);
	    setcookie("Admin_Name", "", time() - 3600);
	    setcookie("Admin_Password", "" , time() - 3600);
	    setcookie("Admin_Email", "" , time() - 3600);
	    setcookie("Admin_Status", "" , time() - 3600);
		setcookie("Admin_Login", "" , time() - 3600);
	}
	
	@header("Location: index.php");
	exit;
?>