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
   
   if($_POST['Charge'])
   {
     $strQuery = "update tbl_lupu_orders set 
		          Charged = '1'
			  where OrderID ='$OID'";
			  
	if ($DataBase->query($strQuery))
    {
          $sql = "SELECT admin_email,Name from tbladmin";
		  $DataBase->query($sql);
		  $Record = $DataBase->fetch_row();
		  $AdminMail 	 = $Record[0];
		  $AdminName 	 = $Record[1];

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='1'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 $temp_message = $Record[0];
		 
		 $sql = "SELECT EMail,Or_City,Or_State,Or_Load,Or_Pack,Transport,Dest_City,Dest_State,Dest_Unload,Dest_Unpack,MoveDate,Labor,
		          Sal, FName, LName from 
		                tbl_lupu_orders WHERE OrderID='$OID'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 $Mail = $Record[0];
		 $OCity = $Record[1];
		 $OState = $Record[2];
		 $OLoad = $Record[3];
		 $OPack = $Record[4];
		 $Transport = $Record[5];
		 $DCity = $Record[6];
		 $DState = $Record[7];
		 $DUnload = $Record[8];
		 $DUnpack = $Record[9];
		 $MoveDate = $Record[10];
		 $Labor = $Record[11];
		 $Sal = $Record[12];
		 $FName = $Record[13];
		 $LName = $Record[14];
		 
		 $CName = $Sal . " " . $FName . " " . $LName;
		 
		 if ($OLoad == "1")
		   {
		     $OLoad = "Loading";
		   }
		   if ($OPack == "1")
		   {
		     $OPack = "Packing";
		   }
		   if ($DUnload == "1")
		   {
		     $DUnload = "UnLoading";
		   }
		   if ($DUnpack == "1")
		   {
		     $DUnpack = "UnPacking";
		   }
		   
		   $servicearray1= array();
		   $servicearray2= array();
		   array_push($servicearray1,"Loading");
		   array_push($servicearray1,"Packing");
		   array_push($servicearray2,"UnLoading");
		   array_push($servicearray2,"UnPacking");
		   
		   $info_origin = "";
		   $info_destination = "";
		   if (in_array($OLoad, $servicearray1)) 
		   {
             $info_origin = "Loading";
		   }
		   if (in_array($OPack, $servicearray1)) 
		   {
		     if(empty($info_origin))
			 {
			   $info_origin = "Packing";
			 }
			 else
			 {
              $info_origin = $info_origin . ",Packing";
			 }
		   }
		   if (in_array($DUnload, $servicearray2)) 
		   {
             if(empty($info_destination))
			 {
			   $info_destination = "UnLoading";
			 }
			 else
			 {
              $info_destination = $info_destination . ",UnLoading";
			 }
		   }
		   if (in_array($DUnpack, $servicearray2)) 
		   {
		     if(empty($info_destination))
			 {
			   $info_destination = "UnPacking";
			 }
			 else
			 {
              $info_destination = $info_destination . ",UnPacking";
			 }
           }
  
  if($Transport == "yes")
  {
    $Transport = "Required";
  }
  else
  {
    $Transport = "Not Required";
  }
         
    $query = "SELECT `city` FROM `cities` WHERE `CityID`='$OCity' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 2");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$OriginCity = $line[city];
	
	$query = "SELECT `city` FROM `cities` WHERE `CityID`='$DCity' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 3");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$DestCity = $line[city];
	
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$OState' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 4");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$OriginState = $line[name];
	
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$DState' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 5");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$DestState = $line[name];
	
	$JobInfo = "Origin Location: $OriginCity,$OriginState <br> Destination Location: $DestCity,$DestState <br> Labor Required:$Labor
	              <br> Transportation: $Transport <br> MoveDate: $MoveDate <br> Service at Origin: $info_origin <br> Service at 
				   Destination: $info_destination";
		 
		 $message  = "<br>";
		 
		 switch($Labor)
        {
                              
		case 1:
               $temp_message  = str_replace ("%x%", "$225", $temp_message);
			   $temp_message  = str_replace ("%y%", "$225", $temp_message);
			   $temp_message  = str_replace ("%z%", "$55", $temp_message);
			   break;
		case 2:
               $temp_message  = str_replace ("%x%", "$340", $temp_message);
			   $temp_message  = str_replace ("%y%", "$340", $temp_message);
			   $temp_message  = str_replace ("%z%", "$80", $temp_message);
			   break;
	    case 3:
               $temp_message  = str_replace ("%x%", "$400", $temp_message);
			   $temp_message  = str_replace ("%y%", "400", $temp_message);
			   $temp_message  = str_replace ("%z%", "$90", $temp_message);
			   break;
		case 4:
               $temp_message  = str_replace ("%x%", "$480", $temp_message);
			   $temp_message  = str_replace ("%y%", "$480", $temp_message);
			   $temp_message  = str_replace ("%z%", "$105", $temp_message);
			   break;
		case 5:
               $temp_message  = str_replace ("%x%", "$640", $temp_message);
			   $temp_message  = str_replace ("%y%", "$640", $temp_message);
			   $temp_message  = str_replace ("%z%", "$120", $temp_message);
			   break;
	    }
		
		 $sql = "Select tblmembers.MemberID, tblmembers.MemberName, tblmembers.ContactPerson, tblmembers.ContactEmail From tblorders_jobs
                   Inner Join tblmemberaction ON tblorders_jobs.JobID = tblmemberaction.JobID
                   Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
                   Inner Join tblmembers ON tblmemberaction.`MID` = tblmembers.MemberID
                     Where
                         tblorders_jobs.OrderType = 'LUPU' AND
                         tblorders_jobs.JobID = '$OID' AND
                            tblmemberaction.Accept = '1'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_all();
		 
		 if(!empty($Record))
		 {
		      foreach($Record as $val)
			  {
			    $MID = $val[0];
			    $MName = $val[1];
			    $CPerson = $val[2];
			    $CEMail = $val[3];
			
				$message  = str_replace ("%Mover%","$MName", $temp_message);
				$message  = str_replace ("%MoverContactPerson%","$CPerson", $message);
				$message  = str_replace ("%MoverContact%","$CEMail", $message);
			  }
		  }
			
         $message  = str_replace ("%JobInfo%","$JobInfo", $message);
		 $message  = str_replace ("%CN%","$CName", $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../parth/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font>";
		 
		 send_mail("AdminMail",SYSTEM_EMAIL_NAME,"$Mail","MovingUWithCare.Com - Credit Card Approved","$message");
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('9', '$AdminMail', '$Mail', 'MovingUWithCare.Com - Credit Card Approved', '$message')";
		 $DataBase->query($sql);
		 send_mail($AdminMail, $AdminMail, $Mail, 'MovingUwithCare.com-Credit Card Approved', $message);
		 $sql = "SELECT Detail from tbl_templates WHERE TempID='10'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 $temp_message1 = $Record[0];
		 
		 $sql = "Select tbl_lupu_orders.Sal, tbl_lupu_orders.FName, tbl_lupu_orders.LName, tbl_lupu_orders.Phone, 
                 tbl_lupu_orders.ZipCode, tbl_lupu_orders.Phone From tbl_lupu_orders Where
                    tbl_lupu_orders.OrderID = '$OID'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 
		 $Sal = $Record[0];
		 $FName = $Record[1];
		 $LName = $Record[2];
		 $Phone = $Record[3];
		 $ZC = $Record[4];
		 $Phone2 = $Record[5];
		 
		 $CustName = $Sal . " " . $FName . " " . $LName;
		 
		 $message1  = "<br>";
		 switch($Labor)
        {
                              
		case 1:
               $temp_message1  = str_replace ("%x%", "$170", $temp_message1);
			   $temp_message1  = str_replace ("%y%", "$55", $temp_message1);
			   break;
		case 2:
               $temp_message1  = str_replace ("%x%", "$260", $temp_message1);
			   $temp_message1  = str_replace ("%y%", "$80", $temp_message1);
			   break;
	    case 3:
               $temp_message1  = str_replace ("%x%", "$310", $temp_message1);
			   $temp_message1  = str_replace ("%y%", "90", $temp_message1);
			   break;
		case 4:
               $temp_message1  = str_replace ("%x%", "$375", $temp_message1);
			   $temp_message1  = str_replace ("%y%", "$105", $temp_message1);
			   break;
		case 5:
               $temp_message1  = str_replace ("%x%", "$520", $temp_message1);
			   $temp_message1  = str_replace ("%y%", "$120", $temp_message1);
			   break;
	    }
		
		 $message1  = str_replace ("%JobInfo%","$JobInfo", $temp_message1);
		 $message1  = str_replace ("%Cust%","$CustName", $message1);
		 $message1  = str_replace ("%CustNoW%","$Phone", $message1);
		 $message1  = str_replace ("%CustNoH%","$Phone2", $message1);
		 $message1  = str_replace ("%ZC%","$ZC", $message1);
		 $message1  = str_replace ("%Mdate%","$MoveDate", $message1);
		 $message1  = str_replace ("%LNo%","$Labor", $message1);
		 $message1 = nl2br($message1);
		 $message1 = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../parth/logos/MUWC_Logo.gif\"><br>" . $message1 . "</center></font>";
		 
		 //echo $message1;exit;
		 
		 $sql = "Select tblmembers.MemberID, tblmembers.ContactEmail From tblorders_jobs, tblmembers
               Inner Join tbljobs_members ON tbljobs_members.`MID` = tblmembers.MemberID AND tblorders_jobs.JobID = tbljobs_members.JID
                Where tblorders_jobs.OrderType = 'LUPU' AND
                    tblorders_jobs.JobID = '$OID'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_all();
		 
		  if(!empty($Record))
		 {
		      foreach($Record as $val)
			  {
			    $MID = $val[0];
			    $CEMail = $val[1];
			
				send_mail("AdminMail",SYSTEM_EMAIL_NAME,"$CEMail","MovingUWithCare.Com - Credit Card Approved","$message1");
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('10', '$AdminMail', '$MID', 'MovingUWithCare.Com - Credit Card Approved', '$message1')";
		 $DataBase->query($sql);
                 send_mail($AdminMail, $AdminMail, $MID, 'MovingUWithCare.com- Credit Card Approved', $message1);
			  }
		  }
		 
	     @header("Location: view_orders.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID");
	     exit;	 
		 
    }
   }
   
   if($_POST['UnCharge'])
   {
     $strQuery = "update tbl_lupu_orders set 
		          Charged = '0'
			  where OrderID ='$OID'";
	 if ($DataBase->query($strQuery))
    {
	
	      $sql = "SELECT admin_email,Name from tbladmin";
		  $DataBase->query($sql);
		  $Record = $DataBase->fetch_row();
		  $AdminMail 	 = $Record[0];
		  $AdminName 	 = $Record[1];

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='11'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 $temp_message = $Record[0];
		 
		 $sql = "Select tbl_lupu_orders.Sal, tbl_lupu_orders.FName, tbl_lupu_orders.LName, tbl_lupu_orders.Address,
                  tbl_lupu_orders.MoveDate, tbl_lupu_orders.Labor, tbl_lupu_orders.Phone, tbl_lupu_orders.Phone2
                  From tbl_lupu_orders Where tbl_lupu_orders.OrderID = '$OID'"; 
				  
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 $Sal = $Record[0];
		 $FName = $Record[1];
		 $LName = $Record[2];
		 $Address = $Record[3];
		 $MDate = $Record[4];
		 $Labor = $Record[5];
		 $Phone = $Record[6];
		 $Phone2 = $Record[7];
		 
		 $Name = $Sal . " " . $FName . " " . $LName;
		 
		 $sql = "Select tblmembers.MemberID, tblmembers.ContactEmail From tblorders_jobs
                   Inner Join tblmemberaction ON tblorders_jobs.JobID = tblmemberaction.JobID
                   Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
                   Inner Join tblmembers ON tblmemberaction.`MID` = tblmembers.MemberID
                     Where
                         tblorders_jobs.OrderType = 'LUPU' AND
                         tblorders_jobs.JobID = '$OID' AND
                            tblmemberaction.Accept = '1'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_all();
		 
		 if(!empty($Record))
		 {
		      foreach($Record as $val)
			  {
			    $MID = $val[0];
			    $CEMail = $val[1];
				
				$message  = "<br>";
				$message  = str_replace ("%CName%","$Name", $temp_message);
				$message  = str_replace ("%CContactW%","$Phone", $message);
				$message  = str_replace ("%CContactH%","$Phone2", $message);
				$message  = str_replace ("%Address%","$Address", $message);
				$message  = str_replace ("%MD%","$MDate", $message);
				$message  = str_replace ("%NLabors%","$Labor", $message);
				$message = nl2br($message);
		        $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../parth/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font>";
				//echo $message;
				send_mail("$AdminMail",SYSTEM_EMAIL_NAME,"$CEMail","MovingUWithCare.Com - Job Cancelled","$message");
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('12', '$AdminMail', '$MID', 'MovingUWithCare.Com - Job Cancelled', '$message')";
		 $DataBase->query($sql);
                send_mail($AdminMail, $AdminMail, $MID, 'MovingUWithCare.com- Job Cancelled', $message);
			  }
		  }
		  
     @header("Location: view_orders.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID");
	 exit;
    }
   }

?>

	
  
         
	
	
	
   
   