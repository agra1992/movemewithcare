<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   
   $ID = $_GET['ID'];
   $SearchString = $_GET['SearchString'];
   $count = $_GET['count'];
   $offset = $_GET['offset'];
   $OrderType = $_GET['OrderType'];
   $day = $_GET['day'];
   $month = $_GET['month'];
   $year = $_GET['year'];
   $Cal = $_GET['Cal'];
   $mod_fs = $_GET['mod_fs'];
   
   if ($OrderType == "LUPU")
   {
       $strQuery = "Delete from tbl_lupu_orders where OrderID='$ID'";
	   $DataBase->query($strQuery);

		
	  @header("Location: orders.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID&OrderType=$OrderType&day=$day&month=$month&year=$year&Cal=$Cal&mod_fs=$mod_fs");
	  exit;
   }
   
    if ($OrderType == "FS")
   {
     $strQuery = "Delete from tbl_fs_orders where OrderID='$ID'";
	  if ($DataBase->query($strQuery))
	   {
		 
			  @header("Location: orders.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID&OrderType=$OrderType&day=$day&month=$month&year=$year&Cal=$Cal&mod_fs=$mod_fs");
	  exit;
	         
		   
	   }
   }
?>