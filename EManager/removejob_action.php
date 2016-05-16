<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   
   $ID = $_GET['ID'];
   $SearchString = $_GET['SearchString'];
   $count = $_GET['count'];
   $offset = $_GET['offset'];
   $OrderType = $_GET['OrderType'];   
   $Mod  = $_GET['Mod'];
   $Type = $_GET['Type'];   
   
  
   $strQuery = "Delete from tbl_".$OrderType."_orders where OrderID ='$ID'";
   if ($DataBase->query($strQuery))
   {
      @header("Location: jobs.php?SearchString=$SearchString&count=$count&offset=$offset&ID=$ID&OrderType=$Type&Mod=$Mod");
		exit;
	  
	}
?>