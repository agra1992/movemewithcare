<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   
   $ID = $_POST['ID'];
   $nSearchCrit = $_POST['nSearchCrit'];
   $SearchString = $_POST['SearchString'];
   $offset = $_POST['offset'];
   $count = $_POST['count'];
   $Mod = $_POST['Mod'];
   $Type = $_POST['Type'];
   
   
   $Name = CheckString($_POST['Name']);
   $CP = CheckString($_POST['CP']);
   $CEmail = CheckString($_POST['CEmail']);
   $Phone = CheckString($_POST['Phone']);
   $Address = CheckString($_POST['Address']);
   $ZC = CheckString($_POST['ZC']);
   $TF = CheckString($_POST['TF']);
   $Fax = CheckString($_POST['Fax']);
   $Desc = CheckString($_POST['Desc']);
   
   // by tj 2007.10.18 00
   $MemberState = CheckString($_POST['MemberState']);
   $ServiceState = CheckString($_POST['ServiceState']);  
   $Country = CheckString($_POST['Country']);
  $strQuery = "update tblmembers set 
		          MemberName = '$Name',
            	  ContactPerson = '$CP',
				  ContactEmail = '$CEmail',
            	  Address = '$Address',
				  ZipCode = '$ZC',
            	  Phone = '$Phone',
				  TollFree = '$TF',
            	  Fax = '$Fax',
				  Description = '$Desc' 
			  where MemberID ='$ID'";
			  
    // by tj 2007.10.18 00   			  
    $strQuery = "update tblmembers set 
                        MemberName = '$Name',
                        ContactPerson = '$CP',
                        ContactEmail = '$CEmail',
                        Address = '$Address',
                        ZipCode = '$ZC',
                        Phone = '$Phone',
                        TollFree = '$TF',
                        Fax = '$Fax',
                        Description = '$Desc',
                        MemberState = '$MemberState',
                        State = '$ServiceState',
                        ServiceCountry = '$Country'
                where MemberID ='$ID'";        			  
			  
                        			  
   if ($DataBase->query($strQuery))
   {
     @header("Location: edit_Member.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID&Mod=$Mod&Type=$Type");
	 exit;
   }
?>