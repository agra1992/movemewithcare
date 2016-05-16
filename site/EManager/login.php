<?  
	//session_start(); 
	include_once "class.database.php";

	/*session_register('Admin_Id'); 
	session_register('Admin_Name');        
	session_register('Admin_Password');
	session_register('Admin_Email');
	session_register('Admin_Status');*/

	$strPassword = CheckString($_POST['wa_pwd']);
	$strLogin    = CheckString($_POST['wa_uid']);

	$DataBase    = new Database();
   
	//$IP = $_SERVER['REMOTE_ADDR'];
	

	$strQuery  = "SELECT admin_id,login,pass,admin_email,Name
				  FROM tbladmin 
	             WHERE login='$strLogin' AND pass='$strPassword'";
			   
	$DataBase->query($strQuery);
	$Row_Admin = $DataBase->fetch_row();

/*	$_SESSION['Admin_Id']         = $Row_Admin[0];
	$_SESSION['Admin_Name']       = $Row_Admin[1];
	$_SESSION['Admin_Password']   = $Row_Admin[2];
	$_SESSION['Admin_Email']      = $Row_Admin[3];
	$_SESSION['Admin_Status']      = $Row_Admin[4]; */
	
	$Admin_Id   = $Row_Admin[0];
	$Admin_Login = $Row_Admin[1];
	$Admin_Pass  = $Row_Admin[2];
	$Admin_Email     = $Row_Admin[3];
	$Admin_Name      = $Row_Admin[4];

    if( (strcmp($Admin_Login,$strLogin)==0)  && (strcmp($Admin_Pass,$strPassword)==0) )
	 {
/*	  setcookie("Admin_Id", $Admin_Id, time()+1440,COOKIES_PATH);
	  setcookie("Admin_Name", $Admin_Name, time()+1440,COOKIES_PATH);
	  setcookie("Admin_Password", $Admin_Password , time()+1440,COOKIES_PATH);
	  setcookie("Admin_Email", $Admin_Email , time()+1440,COOKIES_PATH);
	  setcookie("Admin_Status", $Admin_Status , time()+1440,COOKIES_PATH);*/
	
      setcookie("Admin_Id", $Admin_Id);
	  setcookie("Admin_Login", $Admin_Login);
	  setcookie("Admin_Password", $Admin_Pass);
	  setcookie("Admin_Email", $Admin_Email);
	  setcookie("Admin_Name", $Admin_Name);

	    $strHeader = "EManager.php";
	 
	 }	
    else
	 {  
        
		$strHeader = "index.php?nErr=1";
	 }	

    @header("Location: ".$strHeader);
	exit;
		
?>
