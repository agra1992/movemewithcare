<? 
  
   include "Security.php";
   
   $SearchString = $_POST['SearchString'];
   $Mod = $_POST['Mod'];
   $OrderType = $_POST['OrderType'];
   
    @header("Location: orders.php?SearchString=$SearchString&OrderType=$OrderType&Mod=$Mod");
	exit;
   
?>

	
  
         
	
	
	
   
   