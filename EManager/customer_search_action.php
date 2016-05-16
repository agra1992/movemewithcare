<? 
  
   include "Security.php";
   
   $SearchString = $_POST['SearchString'];
   $Mod = $_POST['Mod'];
   $Type=$_POST['Type'];
   
    @header("Location: customers.php?SearchString=$SearchString&nSearchCrit=0&Mod=$Mod&Type=$Type");
	exit;
   
?>

	
  
         
	
	
	
   
   