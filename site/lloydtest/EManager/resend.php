<? 
   include "Security.php";
require_once"mailer.php";
$Location=$_GET['Location'];
$OID=$_GET['OrderID'];
$resend_last_message="The order has been resent to:";
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////FUNCTIONS START/////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////RESEND MEMBER EMAILS/////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

function member_both_locations($LeadId, $or_service, $dor_service, $origin, $dest, $st_date, $labors)
{

	$sql = "SELECT Detail from tbl_templates WHERE TempID='33'"; 
	$result = mysql_query($sql) or die("Query failed27");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$temp_message = $line[Detail];

     
                $service= $or_service. $dor_service;
                        $message = str_replace("%oid%", "$LeadId", $temp_message);
	                $message  = str_replace ("%from%", $origin , $message);
                        $message = str_replace("%oid%", "$LeadId", $temp_message);
			$message  = str_replace ("%from%", $origin , $message);
			$message  = str_replace ("%mdate%", $st_date, $message);
			$message  = str_replace ("%LNo%", $labors, $message);

	                $message  = str_replace ("%Job%", $service , $message);
	                $message  = str_replace ("%to%", $dest , $message);
return "$message"; 
}



function member_origin($LeadId, $or_service, $origin, $st_date, $labors)
{

	$sql = "SELECT Detail from tbl_templates WHERE TempID='28'"; 
	$result = mysql_query($sql) or die("Query failed23");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	    $temp_message = $line[Detail];
                $message = str_replace("%oid%", "$LeadId", $temp_message);
	        $message  = str_replace ("%Job%", $or_service, $message);
	        $message  = str_replace ("%from%", $origin , $message);
	        $message  = str_replace ("%mdate%", $st_date, $message);
	        $message  = str_replace ("%LNo%", $labors, $message);


return "$message"; 
}


function member_destination($LeadId, $dor_service, $dest, $st_date, $labors)
{

	$sql = "SELECT Detail from tbl_templates WHERE TempID='29'"; 
	$result = mysql_query($sql) or die("Query failed23");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];
			
			$message = str_replace("%oid%", "$LeadId", $temp_message);
			$message  = str_replace ("%Job%", $dor_service, $message);
			$message  = str_replace ("%to%", $dest , $message);
			$message  = str_replace ("%mdate%", $st_date, $message);
			$message  = str_replace ("%LNo%", $labors, $message);


return "$message"; 
}


/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////FUNCTIONS END////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
$OrderID=$OID;
	    $sql = "SELECT FName, LName, Address, ZipCode, Phone, Phone2, EMail, Or_City, Or_State, Or_Load, Or_Pack, Transport, Dest_City, Dest_State, Dest_Unload, Dest_Unpack, MoveDate, Labor, Charged from tbl_lupu_orders where OrderID=$OrderID";    	
	    $result = mysql_query($sql) or die("Query failed4");
	    $line = mysql_fetch_array($result, MYSQL_ASSOC);    
	    
	    $customerName = $line[FName] . ' ' . $line[LName];
	 	$customerAddress = $line[Address];
	    $customerZipCode = $line[ZipCode];
	    $customerPhone = $line[Phone];
	    $customerPhone2 = $line[Phone2];
	    $customerMail = $line[EMail];
	    $or_city = $line[Or_City];
	    $or_state = $line[Or_State];
	    $or_load = $line[Or_Load];
	    $or_pack = $line[Or_Pack];
	    $transport = $line[Transport];
	    $dor_city = $line[Dest_City];
	    $dor_state = $line[Dest_State];
	    $dor_load = $line[Dest_Unload];
	    $dor_pack = $line[Dest_Unpack];
	    $movingDate = $line[MoveDate];
	    $labors = $line[Labor];
	    $charge = $line[Charged];
	    $or_none = '0';
    	$dor_none = '0';
    	$samestate="no";


       if($or_state==$dor_state){
            $samestate="yes";
        }
    	if ($or_load == "" && $or_pack == "")
    		$or_none = '1';    	
    	if ($dor_load == "" && $dor_pack == "")
    		$dor_none = '1';	

		if ($or_load == 1 && $or_pack != 1)
			$or_info = "Loading";
		else if ($or_load != 1 && $or_pack == 1)
			$or_info = "Packing";
		else if ($or_load == 1 && $or_pack == 1)
			$or_info = "Loading,Packing";
		if ($dor_load == 1 && $dor_pack != 1)
			$dor_info = "Unloading";
		else if ($dor_load != 1 && $dor_pack == 1)
			$dor_info = "Unpacking";
		else if ($dor_load == 1 && $dor_pack == 1)
			$dor_info = "Unloading,Unpacking";






		$query = "SELECT `city` FROM `cities` WHERE `CityID`='$or_city' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 2");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$or_cityd = $line[city];	
		
		// the same with destination city
		$query = "SELECT `city` FROM `cities` WHERE `CityID`='$dor_city' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 3");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$dest_cityd = $line[city];
		
		// find out the full names of states
		$query = "SELECT `name` , `sh_name` FROM `states` WHERE `StateID`='$or_state' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 4");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$or_stated = $line[name];
		$or_shname = $line[sh_name];
	
		$query = "SELECT `name`,`sh_name`  FROM `states` WHERE `StateID`='$dor_state' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 5");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$dest_stated = $line[name];
		$dor_shname = $line[sh_name];
		$origin = $or_cityd . "," . $or_stated;
		$dest = $dest_cityd . "," . $dest_stated;

 		$sql = "SELECT admin_email from tbladmin";
	    $result = mysql_query($sql) or die("Query failed233");
	    $line = mysql_fetch_array($result, MYSQL_ASSOC);
        $AdminMail = $line[admin_email];        




			$or_ret= array();
			$dor_ret= array();

if($Location=="Origin"){
        	$or_sql = "Select tblmembers.MemberID, tblmembers.MemberName, tblmembers.ContactEmail, tblmembers.MemberType, tblmembers.TollFree From tblmembers 
				     Where (tblmembers.MemberType = 'standard' OR tblmembers.MemberType = 'full' ) AND tblmembers.Active = '1' AND
				    (tblmembers.State like '$or_shname%'  OR tblmembers.State like 'NA%') ";

        	$result = mysql_query($or_sql) or die("Query failed2331 $or_sql");
			$num = mysql_num_rows($result);
			for($i=0;$i<$num;$i++)
			{
				array_push($or_ret,mysql_fetch_row($result));
			}

}else{
        	$dor_sql = "Select tblmembers.MemberID, tblmembers.MemberName, tblmembers.ContactEmail, tblmembers.MemberType From tblmembers 
				     Where (tblmembers.MemberType = 'standard' OR tblmembers.MemberType = 'full') AND tblmembers.Active = '1' AND
				    (tblmembers.State like '$dor_shname%'  OR tblmembers.State like 'NA%') ";

        	$result = mysql_query($dor_sql) or die("Query failed2331 $dor_sql");
			$num = mysql_num_rows($result);
			for($i=0;$i<$num;$i++)
			{
				array_push($dor_ret,mysql_fetch_row($result));
			}

}
		 
   

//sending mail to lupu members
		 $Subject = "New Order from MMWC";	
	 
		 if ($or_none != '1')
		 {

			foreach($or_ret as $val)
			{
		              $MID = $val[0]; 
			      $MName = $val[1]; 
			      $memberEmail = $val[2];
			      $memberType = $val[3];
			      $memberPhone = $val[4];		
	                      $message="";
	                 $resend_last_message=$resend_last_message." $memberEmail;";
                                 $Subject = "New Order from MMWC";
                                     if($samestate=='yes' && $dor_none !=1){
                                             $message=member_both_locations($OrderID, $or_info, $dor_info, $origin, $dest, $movingDate, $labors);
		                       }
                                      else{
                                             $message=member_origin($OrderID, $or_info, $origin, $movingDate, $labors);
                                      }
                                 
                                if($message!=""){
			$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
			$message = nl2br($message);

		send_mail($AdminMail, $AdminMail, $memberEmail, $Subject, $message);
		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$memberEmail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed7");
			        }
                       }	//end    for each loop
		 
                  }      //end     if(or_none!='1')






		 if ($dor_none != '1')
		 {
		foreach($dor_ret as $val)
			{
		              $MID = $val[0]; 
			      $MName = $val[1]; 
			      $memberEmail = $val[2];
			      $memberType = $val[3];
			      $memberPhone = $val[4];		
	                      $message="";    
	                 $resend_last_message=$resend_last_message." $memberEmail;";
                                        $Subject = "New Order from MMWC";             
                              if($samestate == "yes" && $or_none!=1){

                                             $message=member_both_locations($OrderID, $or_info, $dor_info, $origin, $dest, $movingDate, $labors);
                                }
                                      else{

                                             $message=member_destination($OrderID, $dor_info, $dest, $movingDate, $labors);
                                      }
                        if($message!=""){
			$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
			$message = nl2br($message);
			

		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES 
	 		('7', '$AdminMail', '$memberEmail', '$Subject', '$message','$OrderID')";
		$result = mysql_query($sql) or die("Query failed7");
		send_mail($AdminMail, $AdminMail, $memberEmail, $Subject, $message);

			       }

                       }	//end    for each loop
		 
                  }      //end     if(dor_none!='1')

    @header("Location: orders.php?resend_last_message=$resend_last_message");
?>