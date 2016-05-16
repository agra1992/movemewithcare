<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   
   $ID = $_GET['ID'];
   $nSearchCrit = $_GET['nSearchCrit'];
   $SearchString = $_GET['SearchString'];
   $offset = $_GET['offset'];
   $Mod=$_GET['Mod'];
   $Type = $_GET['Type'];
   
   $strQuery = "Delete from tblcustomers where CustomerID='$ID'";
   if ($DataBase->query($strQuery))
   {
      @header("Location: customers.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&offset=$offset&Mod=$Mod&Type=$Type");
	  exit;

	}
?>