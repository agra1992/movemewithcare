<?  

   if(!(isset($_COOKIE['Admin_Id'])))
   {
     @header("Location: index.php?nAuth_Failed=1");
	  exit;
   }
   
    include_once "class.database.php";

    $DataBase =  new Database();  // Creat Database Object
    $strQuery = "select pass from tbladmin where admin_id = " . $_COOKIE['Admin_Id'];
    $DataBase->query($strQuery);
    $nResult  = $DataBase->fetch_row();
    $strPass  = $nResult[0];

    if($strPass != $_COOKIE['Admin_Password'])
    {
	   //echo "123";exit;
       @header("Location: index.php?nAuth_Failed=1");
	   exit;
    }
    
	  
?>