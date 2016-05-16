<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";

   $ID = $_POST['ID'];
   $nSearchCrit = $_POST['nSearchCrit'];
   $SearchString = $_POST['SearchString'];
   $offset = $_POST['offset'];
   $count = $_POST['count'];
   $OID = $_POST['OID'];
   $Cal = $_POST['Cal'];
   $day = $_POST['day'];
   $month = $_POST['month'];
   $year = $_POST['year'];
   $mod_fs = $_POST['mod_fs'];
   $OrderType = $_POST['OrderType'];
   if($_POST['Complete']){
//cancel the order

$sql="Update tbl_lupu_orders SET Status_Order='C' WHERE OrderID='$OID'";
$r=mysql_query($sql);

}
    @header("Location: order_details1.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID&OrderType=$OrderType&day=$day&month=$month&year=$year&Cal=$Cal&mod_fs=$mod_fs");
	 exit;
?>
  
	