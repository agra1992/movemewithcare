<? 
   include "Security.php";
   
   $TempID = $_POST['TempID'];
   
   foreach($_POST as $sForm => $value)
   {
	$temp = CheckString($value);
   }
   
	 $temp = ereg_replace("<br />","", $temp);
    //echo TextString($temp);exit;
    
    $strQuery = "update tbl_templates set 
		          Detail = '$temp'
			  where TempID ='$TempID'";
			  
   if ($DataBase->query($strQuery))
   {
     @header("Location: templates.php");
	 exit;
   }
    
?>