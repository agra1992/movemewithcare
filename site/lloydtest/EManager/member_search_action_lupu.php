<? 
  
   include "Security.php";
   
   $SearchString = $_POST['SearchString'];
   $Mod = $_POST['Mod'];
      
    @header("Location: members_lupu.php?SearchString=$SearchString&nSearchCrit=0&Mod=$Mod");
	exit;
   
?>

	
  
         
	
	
	
   
   