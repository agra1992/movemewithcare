<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   
   $ID = $_GET['ID'];
   $nSearchCrit = $_GET['nSearchCrit'];
   $SearchString = $_GET['SearchString'];
   $count = $_GET['count'];
   $offset = $_GET['offset'];
   $Mod = $_GET['Mod'];
   $Type = $_GET['Type'];
   
   $strQuery = "Delete from tblmembers where MemberID ='$ID'";
   if ($DataBase->query($strQuery))
   {
      $strQuery = "Delete from tblmember_servicecity where MID='$ID'";
		 if ($DataBase->query($strQuery))
		 {
			  @header("Location: affiliates.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&offset=$offset&Mod=$Mod&Type=$Type");
			  exit;
	     }
	}
?>