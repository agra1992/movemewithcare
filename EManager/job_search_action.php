<? 
  
   include "Security.php";
   
   $SearchString = $_GET['SearchString'];
   $Mod = $_GET['Mod'];
   $OrderType = $_GET['OrderType'];
   
    @header("Location: jobs.php?SearchString=$SearchString&OrderType=$OrderType&Mod=$Mod");
	exit;
   
?>

	
  
         
	
	
	
   
   