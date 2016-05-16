<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   
   $ID = $_POST['ID'];
   $nSearchCrit = $_POST['nSearchCrit'];
   $SearchString = $_POST['SearchString'];
   $offset = $_POST['offset'];
   $count = $_POST['count'];
   $Mod = $_POST['Mod'];
   $Type = $_POST['Type'];
   
   $CA = CheckString($_POST['CA']);
   $CZC = CheckString($_POST['CZC']);
   $CPhone = CheckString($_POST['CPhone']);
   $CPhone2 = CheckString($_POST['CPhone2']);
   
  $strQuery = "update tblcustomers set 
		          Address = '$CA',
            	  ZipCode = '$CZC',
				  Phone = '$CPhone',
				  Phone2 = '$CPhone2'
			  where CustomerID ='$ID'";
			  
   if ($DataBase->query($strQuery))
   {
     @header("Location: edit_Customer.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID&Mod=$Mod&Type=$Type");
	 exit;
   }
?>

	
  
         
	
	
	
   
   