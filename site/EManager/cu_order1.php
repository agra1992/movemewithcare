<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   require_once "mailer.php";
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
//die($temp_message);		

		 $sql = "SELECT EMail,Or_City,Or_State,Or_Load,Or_Pack,Transport,Dest_City,Dest_State,Dest_Unload,Dest_Unpack,MoveDate,Labor,  
		         Sal, FName, LName, Origin_MID, Dest_MID from 
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
		 $Origin_MID = $Record[15];
		 $Dest_MID = $Record[16];
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
	




///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////FUNCTIONS///////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

function customer_origin_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName)
{
    $message="";
		$sql = "SELECT Detail from tbl_templates WHERE TempID='1'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];


switch($labors)
        {
                              
		case 1:
               $temp_message  = str_replace ("%y%", "$170", $temp_message);
			   $temp_message  = str_replace ("%x%", "$55", $temp_message);
			   break;
		case 2:
               $temp_message  = str_replace ("%y%", "$260", $temp_message);
			   $temp_message  = str_replace ("%x%", "$80", $temp_message);
			   break;
	    case 3:
               $temp_message  = str_replace ("%y%", "$310", $temp_message);
			   $temp_message  = str_replace ("%x%", "90", $temp_message);
			   break;
		case 4:
               $temp_message  = str_replace ("%y%", "$375", $temp_message);
			   $temp_message  = str_replace ("%x%", "$105", $temp_message);
			   break;
		case 5:
               $temp_message  = str_replace ("%y%", "$520", $temp_message);
			   $temp_message  = str_replace ("%x%", "$120", $temp_message);
			   break;
	    }
		$message  = str_replace ("%JobInfo%", $OrderID, $temp_message);
		$message  = str_replace ("%Moveratorigin%", $memberName, $message);
		$message  = str_replace ("%MoverEmail%", $memberEmail, $message);
		$message  = str_replace ("%MoverContact%", $memberPhone, $message);
		$message  = str_replace ("%CN%", $customerName, $message);

return "$message";
}







function customer_destination_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName)
{
    $message="";
		$sql = "SELECT Detail from tbl_templates WHERE TempID='2'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];


switch($labors)
        {
                              
		case 1:
               $temp_message  = str_replace ("%y%", "$170", $temp_message);
			   $temp_message  = str_replace ("%x%", "$55", $temp_message);
			   break;
		case 2:
               $temp_message  = str_replace ("%y%", "$260", $temp_message);
			   $temp_message  = str_replace ("%x%", "$80", $temp_message);
			   break;
	    case 3:
               $temp_message  = str_replace ("%y%", "$310", $temp_message);
			   $temp_message  = str_replace ("%x%", "90", $temp_message);
			   break;
		case 4:
               $temp_message  = str_replace ("%y%", "$375", $temp_message);
			   $temp_message  = str_replace ("%x%", "$105", $temp_message);
			   break;
		case 5:
               $temp_message  = str_replace ("%y%", "$520", $temp_message);
			   $temp_message  = str_replace ("%x%", "$120", $temp_message);
			   break;
	    }
		$message  = str_replace ("%JobInfo%", $OrderID, $temp_message);
		$message  = str_replace ("%Moveratdestination%", $memberName, $message);
		$message  = str_replace ("%MoverEmail%", $memberEmail, $message);
		$message  = str_replace ("%MoverContact%", $memberPhone, $message);
		$message  = str_replace ("%CN%", $customerName, $message);

return "$message";
}






function customer_both_charged($labors, $OrderID, $memberName, $memberEmail, $memberPhone, $customerName)
{
    $message="";
		$sql = "SELECT Detail from tbl_templates WHERE TempID='39'";
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];


switch($labors)
        {
                              
		case 1:
               $temp_message  = str_replace ("%y%", "$170", $temp_message);
			   $temp_message  = str_replace ("%x%", "$55", $temp_message);
			   break;
		case 2:
               $temp_message  = str_replace ("%y%", "$260", $temp_message);
			   $temp_message  = str_replace ("%x%", "$80", $temp_message);
			   break;
	    case 3:
               $temp_message  = str_replace ("%y%", "$310", $temp_message);
			   $temp_message  = str_replace ("%x%", "90", $temp_message);
			   break;
		case 4:
               $temp_message  = str_replace ("%y%", "$375", $temp_message);
			   $temp_message  = str_replace ("%x%", "$105", $temp_message);
			   break;
		case 5:
               $temp_message  = str_replace ("%y%", "$520", $temp_message);
			   $temp_message  = str_replace ("%x%", "$120", $temp_message);
			   break;
	    }
		$message  = str_replace ("%JobInfo%", $OrderID, $temp_message);
		$message  = str_replace ("%Moveratdestination%", $memberName, $message);
		$message  = str_replace ("%MoverEmail%", $memberEmail, $message);
		$message  = str_replace ("%MoverContact%", $memberPhone, $message);
		$message  = str_replace ("%CN%", $customerName, $message);

return "$message";
}

///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////END FUNCTIONS///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////



















	$JobInfo = "Origin Location: $OriginCity,$OriginState <br> Destination Location: $DestCity,$DestState <br> Labor Required:$Labor
	              <br> Transportation: $Transport <br> MoveDate: $MoveDate <br> Service at Origin: $info_origin <br> Service at 
				   Destination: $info_destination";
		 

		 $message  = "<br>";
		 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='10'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 $temp_message1 = $Record[0];
		 
		  $sql = "Select tbl_lupu_orders.Sal, tbl_lupu_orders.FName, tbl_lupu_orders.LName, tbl_lupu_orders.Phone, 
                 tbl_lupu_orders.EMail, tbl_lupu_orders.Phone From tbl_lupu_orders Where
                    tbl_lupu_orders.OrderID = '$OID'"; 
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_row();
		 
		 $Sal = $Record[0];
		 $FName = $Record[1];
		 $LName = $Record[2];
		 $Phone = $Record[3];
		 $CustEmail = $Record[4];
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
		 $message1  = str_replace ("%Email%","$CustEmail", $message1);
		 $message1  = str_replace ("%Mdate%","$MoveDate", $message1);
		 $message1  = str_replace ("%LNo%","$Labor", $message1);
		 $message1 = nl2br($message1);
		 $message1 = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../logos/MUWC_Logo.gif\"><br>" . $message1 . "</center></font>";
		 
		 //echo $message1;exit;
		 $sql = "Select tblmembers.MemberID, tblmembers.ContactEmail From tblmembers
                  
                     Where
                         tblmembers.MemberID = '$Origin_MID' or
                         tblmembers.MemberID = '$Dest_MID'"; 	 
		
		 $DataBase->query($sql);
		 $Record = $DataBase->fetch_all();
		 
		  if(!empty($Record))
		 {
		      foreach($Record as $val)
			  {
			    $MID = $val[0];
			    $CEMail = $val[1];
			
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES ('10', '$AdminMail', '$CEMail', 'MoveMeWithCare.Com - Customer Credit Card Approved: Please contact your customer', '$message1','$OID')";
		 $DataBase->query($sql);
                 send_mail($AdminMail, $AdminMail, "$CEMail", 'MoveMeWithCare.com- Customer Credit Card Approved: Please contact your customer', $message1);

			  }
		  }

$message="";

		 $sql = "Select tblmembers.MemberName, tblmembers.ContactEmail,tblmembers.Phone From tblmembers
                     Where
                         tblmembers.MemberID = '$Origin_MID'"; 	 
		$r=mysql_query($sql);
                while($result_con = mysql_fetch_row($r)){
                     $member_origin_name=$result_con[0];
                     $member_origin_email=$result_con[1];
                     $member_origin_phone=$result_con[2];
                 }


                $sql = "Select tblmembers.MemberName, tblmembers.ContactEmail,tblmembers.Phone From tblmembers
                     Where  tblmembers.MemberID = '$Dest_MID'"; 	
		$r=mysql_query($sql);
                while($result_con = mysql_fetch_row($r)){
                     $member_destination_name=$result_con[0];
                     $member_destination_email=$result_con[1];
                     $member_destination_phone=$result_con[2];
                 }

if($Origin_MID != "" && $Origin_MID !=$Dest_MID){
    $message=customer_origin_charged($Labor, $OID, $member_origin_name, $member_origin_email, $member_origin_phone, $CName);
}
else if($Origin_MID != "" && $Origin_MID ==$Dest_MID){
    $message=customer_both_charged($Labor, $OID, $member_origin_name, $member_origin_email, $member_origin_phone, $CName);
}
if($message !=""){
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../logos/MUWC_Logo.gif\"><br>" . $message . "</center></font>";
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES ('10', '$AdminMail', '$Mail', 'MoveMeWithCare.Com - Your Credit Card Approved: Please contact your mover at your convenience', '$message','$OID')";
		 $DataBase->query($sql);
                 send_mail($AdminMail, $AdminMail, "$Mail", 'MoveMeWithCare.Com - Your Credit Card Approved: Please contact your mover at your convenience', $message);
}
$message="";
if($Dest_MID != "" && $Origin_MID !=$Dest_MID){
    $message=customer_destination_charged($Labor, $OID, $member_destination_name, $member_destination_email, $member_destination_phone, $CName);
}
if($message !=""){
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../logos/MUWC_Logo.gif\"><br>" . $message . "</center></font>";
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES ('10', '$AdminMail', '$Mail', 'MoveMeWithCare.Com - Your Credit Card Approved: Please contact your mover at your convenience', '$message','$OID')";
		 $DataBase->query($sql);
                 send_mail($AdminMail, $AdminMail, "$Mail", 'MoveMeWithCare.Com - Your Credit Card Approved: Please contact your mover at your convenience', $message);
}


		  @header("Location: order_details1.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID&OrderType=$OrderType&day=$day&month=$month&year=$year&Cal=$Cal&mod_fs=$mod_fs");
	 exit;
   }
   
   }
   



//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////UNCHARGE CUSTOMER/////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
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
                  tbl_lupu_orders.MoveDate, tbl_lupu_orders.Labor, tbl_lupu_orders.Phone, tbl_lupu_orders.Phone2, Origin_MID, Dest_MID
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
		 $Origin_MID = $Record[8];
		 $Dest_MID = $Record[9];		 
		 $Name = $Sal . " " . $FName . " " . $LName;
		 
		 		 $sql = "Select tblmembers.MemberID,  tblmembers.ContactEmail From tblmembers
               
   
                     Where
                         tblmembers.MemberID = '$Origin_MID' or
                         tblmembers.MemberID = '$Dest_MID'"; 
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
		        $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../logos/MUWC_Logo.gif\"><br>" . $message . "</center></font>";
				//echo $message;

		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES ('12', '$AdminMail', '$CEmail', 'MoveMeWithCare.Com - Job Cancelled', '$message','$OID')";
		 $DataBase->query($sql);
                 send_mail($AdminMail, $AdminMail, "$CEMail", 'MoveMeWithCare.com - Job Cancelled', $message);

			  }
		  }
		  
     @header("Location: order_details1.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID&OrderType=$OrderType&day=$day&month=$month&year=$year&Cal=$Cal&mod_fs=$mod_fs");
	 exit;
    }
   }

?>
  
	