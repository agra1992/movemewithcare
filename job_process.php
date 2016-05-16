<?php
  session_start();
  include "Security.php"; 
  include_once "mailer.php";
  //error_reporting(0);
  set_time_limit(60*60*60);
  
  
  $CName = $_SESSION['Member_Name'];
  $CContact = $_SESSION['Member_Contact'];
  $CEmail = $_SESSION['Member_Email'];
  $CPhone = $_SESSION['Member_Phone'];
  
 
  $day = $_POST['day'];
  $month = $_POST['month'];
  $year = $_POST['year'];
  $JobID = $_POST['JobID'];
  $JLID = $_POST['JLID'];
  $MAID = $_POST['MAID'];
  $OrderID = $_POST['OrderID'];
  
  $str = "Select tbl_lupu_orders.Sal, tbl_lupu_orders.FName, tbl_lupu_orders.LName, tbl_lupu_orders.EMail, tbl_lupu_orders.Phone,
            tbl_lupu_orders.Or_City, tbl_lupu_orders.Or_State, tbl_lupu_orders.Or_Load, tbl_lupu_orders.Or_Pack, 
			tbl_lupu_orders.Transport,tbl_lupu_orders.Dest_City, tbl_lupu_orders.Dest_State, tbl_lupu_orders.Dest_Unload,
            tbl_lupu_orders.Dest_Unpack, tbl_lupu_orders.Labor, tbl_lupu_orders.MoveDate, tbl_lupu_orders.Phone2
          From
            tbl_lupu_orders
              Inner Join tblcustomers ON tbl_lupu_orders.EMail = tblcustomers.email
          Where
             tbl_lupu_orders.OrderID = $OrderID";

  $result_newQuery = mysql_query($str) or die("Query failed1");
  $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
  
  $Sal = $line[Sal];
  $FName = $line[FName];
  $LName = $line[LName];
  $Email = $line[EMail];
  $Phone = $line[Phone];
  $OCity = $line[Or_City];
  $OState = $line[Or_State];
  $OLoad = $line[Or_Load];
  $OPack = $line[Or_Pack];
  $Transport = $line[Transport];
  $DCity = $line[Dest_City];
  $DState = $line[Dest_State];
  $DUnload = $line[Dest_Unload];
  $DUnpack = $line[Dest_Unpack];
  $Labor = $line[Labor];
  $MoveDate = $line[MoveDate];
  $Phone2 = $line[Phone2];
  
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
		   
		   $servicearray= array();
		   array_push($servicearray,"Loading");
		   array_push($servicearray,"Packing");
		   array_push($servicearray,"UnLoading");
		   array_push($servicearray,"UnPacking");
		   
		   $info = "";
		   if (in_array($OLoad, $servicearray)) 
		   {
             $info = "Loading";
		   }
		   if (in_array($OPack, $servicearray)) 
		   {
		     if(empty($info))
			 {
			   $info = "Packing";
			 }
			 else
			 {
              $info = $info . ",Packing";
			 }
		   }
		   if (in_array($DUnload, $servicearray)) 
		   {
             if(empty($info))
			 {
			   $info = "UnLoading";
			 }
			 else
			 {
              $info = $info . ",UnLoading";
			 }
		   }
		   if (in_array($DUnpack, $servicearray)) 
		   {
		     if(empty($info))
			 {
			   $info = "UnPacking";
			 }
			 else
			 {
              $info = $info . ",UnPacking";
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
	

	
	$str = "Select states.name, states.sh_name From
            tblmember_servicecity Inner Join states ON tblmember_servicecity.StateID = states.StateID Where
            tblmember_servicecity.`MID` =" . $_SESSION['Member_Id'];
			
	$result = mysql_query($str) or die("Query failed");
	$ret= array();
	$num = mysql_num_rows($result);
	for($i=0;$i<$num;$i++)
	{
		array_push($ret,mysql_fetch_row($result));
	}
    
	$scity = "";
	foreach ($ret as $val)
	{
	  $scity = $scity . "(" . $val[1] . ")" . $val[0] . "<br>";
	}

	//   For Same State Orders 
	// **************************************************************************
	
	$message = "<center><img src=\"logos/MUWC_Logo.gif\"></center><br><font face=\"Verdana, Arial, Helvetica, sans-serif\">
                <table width=\"100%\" border=\"0\">
                <tr>
                 <td width=\"36%\">
				    <table width=\"100%\" border=\"0\">
                    <tr>
                       <td><strong>Customer Information</strong></td>
                    </tr>
					<tr>
					  <td>Name: $Sal $FName $LName </td>
					</tr>
					<tr>
					  <td>Phone Number (work): $Phone
                    </td>
					</tr>
					<tr>
					  <td>Phone Number (home): $Phone2
                    </td>
					</tr>
					<tr>
					  <td>Contact EMail: $Email</td>
					</tr>
					<tr>
					  <td>Origin City: $OriginCity</td>
					</tr>
					<tr>
					  <td>Origin State: $OriginState</td>
					</tr>
					<tr>
					  <td>Destination City: $DestCity</td>
					</tr>
					<tr>
					  <td>Destination State: $DestState</td>
					</tr>
					<tr>
					  <td>Transportation: $Transport</td>
					</tr>
					<tr>
					  <td>Type of Service Requested: $info</td>
					</tr>
					<tr>
					  <td>No. of Labor: $Labor</td>
					</tr>
					<tr>
					  <td>Date Of Move: $MoveDate</td>
					</tr>
                 </table>
			 </td>
            <td width=\"32%\" valign=\"top\">
			      <table width=\"100%\" border=\"0\">
                  <tr>
                      <td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">Origin Provider </font></strong></td>
				  </tr>
				  <tr>
						  <td>Name of Mover: $CName</td>
				  </tr>
				  <tr>
						  <td>Contact person: $CContact</td>
				  </tr>
				  <tr>
						  <td>Contact Number: $CPhone</td>
				  </tr>
				  <tr>
						  <td>Contact EMail: $CEmail</td>
				  </tr>
				  <tr>
						  <td>State Served: $scity</td>
				  </tr>
				  <tr>
						  <td>Type Of Service Offered: Loading/UnLoading Assistance</td>
				  </tr>
                 </table>
           </td>
         <td width=\"32%\" valign=\"top\">
		         <table width=\"100%\" border=\"0\">
                 <tr> 
                      <td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">Destination Provider </font></strong></td>
				  </tr>
				  <tr>
						  <td>Name of Mover: $CName</td>
				  </tr>
				  <tr>
						  <td>Contact person: $CContact</td>
				  </tr>
				  <tr>
						  <td>Contact Number: $CPhone</td>
				  </tr>
				  <tr>
						  <td>Contact EMail: $CEmail</td>
				  </tr>
				  <tr>
						  <td>State Served: $scity</td>
				  </tr>
				  <tr>
						  <td>Type Of Service Offered: Loading/UnLoading Assistance</td>
				  </tr>
				</table>
		 </td></tr>
		</table>
		</font>";
		
     //   End For Same State Orders 
	// **************************************************************************
	
	$sql = "SELECT admin_email from tbladmin";
    $result = mysql_query($sql) or die("Query failed7");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
    $AdminMail = $line[admin_email];
	
	$from = "$AdminMail";
	$Subject = "New Job Accepted";

    
	//   For Different State Orders 
	// **************************************************************************
	
  if($_POST[AJ3])
  {
      $service = "Origin";
  }
  
   if($_POST[AJ4])
  {
     $service = "Destination";
  }
  
  // ************* Different State (Origin) *********************************************
  
  if ($service == "Origin")
  {
	  $str = "Select tblmemberaction.`MID` From tblmemberaction
					Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
				 Where tbljobs_location.Destination = '1' AND tblmemberaction.JobID = $JobID";
	  $result_newQuery = mysql_query($str) or die("Query failed3");
	  $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
	  $Result_Mem_Dest = $line[MID];
	
	   if ($Result_Mem_Dest != NULL)
		{
			$str = "Select states.name, states.sh_name From
				tblmember_servicecity Inner Join states ON tblmember_servicecity.StateID = states.StateID Where
				tblmember_servicecity.`MID` = $Result_Mem_Dest";
				
			$result = mysql_query($str) or die("Query failed");
			$ret= array();
			$num = mysql_num_rows($result);
			for($i=0;$i<$num;$i++)
			{
				array_push($ret,mysql_fetch_row($result));
			}
			
			$SCity_Dest = "";
			foreach ($ret as $val)
			{
			  $SCity_Dest = $SCity_Dest . "(" . $val[1] . ")" . $val[0] . "<br>";
			}
			
			$str = "Select tblmembers.MemberName, tblmembers.ContactPerson, tblmembers.ContactEmail,
					  tblmembers.Phone From tblmembers Where
						 tblmembers.MemberID = $Result_Mem_Dest";
						 
			$result_newQuery = mysql_query($str) or die("Query failed*");
			$line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
			
			$MName = $line[MemberName];
			$MCPerson = $line[ContactPerson];
			$MCEmail = $line[ContactEmail];
			$MPhone = $line[Phone];
		}
		
		$message = "<center><img src=\"logos/MUWC_Logo.gif\"></center><br><font face=\"Verdana, Arial, Helvetica, sans-serif\">
                <table width=\"100%\" border=\"0\">
                <tr>
                 <td width=\"36%\">
				    <table width=\"100%\" border=\"0\">
                    <tr>
                       <td><strong>Customer Information</strong></td>
                    </tr>
					<tr>
					  <td>Name: $Sal $FName $LName </td>
					</tr>
					<tr>
					  <td>Phone Number (work): $Phone
                    </td>
					</tr>
					<tr>
					  <td>Phone Number (home): $Phone2
                    </td>
					</tr>
					</tr>
					<tr>
					  <td>Contact EMail: $Email</td>
					</tr>
					<tr>
					  <td>Origin City: $OriginCity</td>
					</tr>
					<tr>
					  <td>Origin State: $OriginState</td>
					</tr>
					<tr>
					  <td>Destination City: $DestCity</td>
					</tr>
					<tr>
					  <td>Destination State: $DestState</td>
					</tr>
					<tr>
					  <td>Transportation: $Transport</td>
					</tr>
					<tr>
					  <td>Type of Service Requested: $info</td>
					</tr>
					<tr>
					  <td>No. of Labor: $Labor</td>
					</tr>
					<tr>
					  <td>Date Of Move: $MoveDate</td>
					</tr>
                 </table>
			 </td>
            <td width=\"32%\" valign=\"top\">
			      <table width=\"100%\" border=\"0\">
                  <tr>
                      <td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">Origin Provider </font></strong></td>
				  </tr>
				  <tr>
						  <td>Name of Mover: $CName</td>
				  </tr>
				  <tr>
						  <td>Contact person: $CContact</td>
				  </tr>
				  <tr>
						  <td>Contact Number: $CPhone</td>
				  </tr>
				  <tr>
						  <td>Contact EMail: $CEmail</td>
				  </tr>
				  <tr>
						  <td>State Served: $scity</td>
				  </tr>
				  <tr>
						  <td>Type Of Service Offered: Loading/UnLoading Assistance</td>
				  </tr>
                 </table>
           </td>
         <td width=\"32%\" valign=\"top\">
		         <table width=\"100%\" border=\"0\">
                 <tr> 
                      <td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">Destination Provider </font></strong></td>
				  </tr>
				  <tr>
						  <td>Name of Mover: $MName</td>
				  </tr>
				  <tr>
						  <td>Contact person: $MCPerson</td>
				  </tr>
				  <tr>
						  <td>Contact Number: $MPhone</td>
				  </tr>
				  <tr>
						  <td>Contact EMail: $MCEmail</td>
				  </tr>
				  <tr>
						  <td>State Served: $SCity_Dest</td>
				  </tr>
				  <tr>
						  <td>Type Of Service Offered: Loading/UnLoading Assistance</td>
				  </tr>
				</table>
		 </td></tr>
		</table>
		</font>";
    }
 
  // ***************** End Different State (Origin) **************************************
  
  // ************* Different State (Destination) *********************************************
  
  if ($service == "Destination")
  {
	  $str = "Select tblmemberaction.`MID` From tblmemberaction
					Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
				 Where tbljobs_location.Origin = '1' AND tblmemberaction.JobID = $JobID";
	  $result_newQuery = mysql_query($str) or die("Query failed3");
	  $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
	  $Result_Mem_Dest = $line[MID];
	
	   if ($Result_Mem_Dest != NULL)
		{
			$str = "Select states.name, states.sh_name From
				tblmember_servicecity Inner Join states ON tblmember_servicecity.StateID = states.StateID Where
				tblmember_servicecity.`MID` = $Result_Mem_Dest";
				
			$result = mysql_query($str) or die("Query failed");
			$ret= array();
			$num = mysql_num_rows($result);
			for($i=0;$i<$num;$i++)
			{
				array_push($ret,mysql_fetch_row($result));
			}
			
			$SCity_Origin = "";
			foreach ($ret as $val)
			{
			  $SCity_Origin = $SCity_Origin . "(" . $val[1] . ")" . $val[0] . "<br>";
			}
			
			$str = "Select tblmembers.MemberName, tblmembers.ContactPerson, tblmembers.ContactEmail,
					  tblmembers.Phone From tblmembers Where
						 tblmembers.MemberID = $Result_Mem_Dest";
						 
			$result_newQuery = mysql_query($str) or die("Query failed*");
			$line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
			
			$MName = $line[MemberName];
			$MCPerson = $line[ContactPerson];
			$MCEmail = $line[ContactEmail];
			$MPhone = $line[Phone];
		}
		
		$CName = $Sal . " " . $FName . " " . $LName;
		
		$message = "<center><img src=\"logos/MUWC_Logo.gif\"></center><br><font face=\"Verdana, Arial, Helvetica, sans-serif\">
                <table width=\"100%\" border=\"0\">
                <tr>
                 <td width=\"36%\">
				    <table width=\"100%\" border=\"0\">
                    <tr>
                       <td><strong>Customer Information</strong></td>
                    </tr>
					<tr>
					  <td>Name: $Sal $FName $LName </td>
					</tr>
					<tr>
					  <td>Phone Number (work): $Phone
                    </td>
					</tr>
					<tr>
					  <td>Phone Number (home): $Phone2
                    </td>
					</tr>
					</tr>
					<tr>
					  <td>Contact EMail: $Email</td>
					</tr>
					<tr>
					  <td>Origin City: $OriginCity</td>
					</tr>
					<tr>
					  <td>Origin State: $OriginState</td>
					</tr>
					<tr>
					  <td>Destination City: $DestCity</td>
					</tr>
					<tr>
					  <td>Destination State: $DestState</td>
					</tr>
					<tr>
					  <td>Transportation: $Transport</td>
					</tr>
					<tr>
					  <td>Type of Service Requested: $info</td>
					</tr>
					<tr>
					  <td>No. of Labor: $Labor</td>
					</tr>
					<tr>
					  <td>Date Of Move: $MoveDate</td>
					</tr>
                 </table>
			 </td>
            <td width=\"32%\" valign=\"top\">
			      <table width=\"100%\" border=\"0\">
                  <tr>
                      <td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">Origin Provider </font></strong></td>
				  </tr>
				   <tr>
						  <td>Name of Mover: $MName</td>
				  </tr>
				  <tr>
						  <td>Contact person: $MCPerson</td>
				  </tr>
				  <tr>
						  <td>Contact Number: $MPhone</td>
				  </tr>
				  <tr>
						  <td>Contact EMail: $MCEmail</td>
				  </tr>
				  <tr>
						  <td>State Served: $SCity_Origin</td>
				  </tr>
				  <tr>
						  <td>Type Of Service Offered: Loading/UnLoading Assistance</td>
				  </tr>
                 </table>
           </td>
         <td width=\"32%\" valign=\"top\">
		         <table width=\"100%\" border=\"0\">
                 <tr> 
                      <td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">Destination Provider </font></strong></td>
				  </tr>
				  <tr>
						  <td>Name of Mover: $CName</td>
				  </tr>
				  <tr>
						  <td>Contact person: $CContact</td>
				  </tr>
				  <tr>
						  <td>Contact Number: $CPhone</td>
				  </tr>
				  <tr>
						  <td>Contact EMail: $CEmail</td>
				  </tr>
				  <tr>
						  <td>State Served: $scity</td>
				  </tr>
				  <tr>
						  <td>Type Of Service Offered: Loading/UnLoading Assistance</td>
				  </tr>
				</table>
		 </td></tr>
		</table>
		</font>";
    }
  
  // ***************** End Different State (Destination) **************************************
   
  // **************************************************************************
   // ********** SAME STATE PROCESSING ***************************
  
/*  if($_POST[AJ1])
  {
     $strQuery = "update tblmemberaction set Accept = '1',  Repost = '0', AcceptDate = CURRENT_TIMESTAMP where MAID = $MAID AND JobID = 
	              $JobID AND MID =" . $_SESSION['Member_Id'];
	 $result_newQuery = mysql_query($strQuery) or die("Query failedAJ1");
	 
	 $strQuery = "update tbljobs_location set Origin = '1', Destination = '1' where MAID = $MAID AND JLID = $JLID";
	 $result_newQuery = mysql_query($strQuery) or die("Query failed1AJ2");
	 
	 $strQuery = "INSERT INTO `tbl_joblogs` (`JLID`, `Action`) VALUES ($JLID, 'AJ')";
	 $result_newQuery = mysql_query($strQuery) or die("Query failed1AJ3");
	 
	 //send_mail("$from","$from","$Subject","$message");
	 /*$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('8', '$from', '$from', '$Subject', '$message')";
	$result = mysql_query($sql) or die("Query failed5");*/
// }
  
 /* if($_POST[RJ1])
  {
    $strQuery = "update tblmemberaction set Accept = '0', Repost = '1', RepostDate = CURRENT_TIMESTAMP where MAID = $MAID AND JobID = 
	              $JobID AND MID =" . $_SESSION['Member_Id'];
	 $result_newQuery = mysql_query($strQuery) or die("Query failedRJ1");
	 
	 $strQuery = "update tbljobs_location set Origin = '0', Destination = '0' where MAID = $MAID AND JLID = $JLID";
	 $result_newQuery = mysql_query($strQuery) or die("Query failedRJ2");
	 
	 $strQuery = "INSERT INTO `tbl_joblogs` (`JLID`, `Action`) VALUES ($JLID, 'RJ')";
	 $result_newQuery = mysql_query($strQuery) or die("Query failed1RJ3");
  }
  
  if($_POST[AJ2])
  {
     $strQuery = "update tblmemberaction set Accept = '1',  Repost = '0', AcceptDate = CURRENT_TIMESTAMP where MAID = $MAID AND JobID = 
	              $JobID AND MID =" . $_SESSION['Member_Id'];
	 $result_newQuery = mysql_query($strQuery) or die("Query failedAJ4");
	 
	 $strQuery = "update tbljobs_location set Origin = '1', Destination = '1' where MAID = $MAID AND JLID = $JLID";
	 $result_newQuery = mysql_query($strQuery) or die("Query failedAJ5*");
	 
	 $strQuery = "INSERT INTO `tbl_joblogs` (`JLID`, `Action`) VALUES ($JLID, 'AJ')";
	 $result_newQuery = mysql_query($strQuery) or die("Query failed1AJ6");
	 
	 //send_mail("$from","$from","$Subject","$message");
	 /*$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('8', '$from', '$from', '$Subject', '$message')";
	$result = mysql_query($sql) or die("Query failed5");*/
  //}
  
 /* if($_POST[RJ2])
  {
     $strQuery = "update tblmemberaction set Accept = '0', Repost = '1', RepostDate = CURRENT_TIMESTAMP where MAID = $MAID AND JobID = 
	              $JobID AND MID =" . $_SESSION['Member_Id'];
	 $result_newQuery = mysql_query($strQuery) or die("Query failedRJ4");
	 
	 $strQuery = "update tbljobs_location set Origin = '0', Destination = '0' where MAID = $MAID AND JLID = $JLID";
	 $result_newQuery = mysql_query($strQuery) or die("Query failedRJ5");
	 
	 $strQuery = "INSERT INTO `tbl_joblogs` (`JLID`, `Action`) VALUES ($JLID, 'RJ')";
	 $result_newQuery = mysql_query($strQuery) or die("Query failed1RJ6");
  }*/
  
  // ********** END SAME STATE PROCESSING ***************************
  
  // ********** DIFF STATE PROCESSING ***************************
  
  if($_POST[AJ3])
  {
     $strQuery = "update tblmemberaction set Accept = '1',  Repost = '0', AcceptDate = CURRENT_TIMESTAMP where MAID = $MAID AND JobID = 
	              $JobID AND MID =" . $_SESSION['Member_Id'];
	 $result_newQuery = mysql_query($strQuery) or die("Query failedAJ3");
	 
	 $strQuery = "update tbljobs_location set Origin = '1' where MAID = $MAID AND JLID = $JLID";
	 $result_newQuery = mysql_query($strQuery) or die("Query failedAJ4*");
	 
	 $strQuery = "INSERT INTO `tbl_joblogs` (`JLID`, `Action`) VALUES ($JLID, 'AJO')";
	 $result_newQuery = mysql_query($strQuery) or die("Query failed1AJ5");
	 
	 $sql = "SELECT Detail from tbl_templates WHERE TempID='2'"; 
	 $result = mysql_query($sql) or die("Query failed2300");
	 $line = mysql_fetch_array($result, MYSQL_ASSOC);
     $temp_message00 = $line[Detail]; 
	 
	 $Job_Info = "Origin Location: $OriginCity,$OriginState <br> Destination Location: $DestCity,$DestState <br> Labor Required:$Labor
	              <br> Transportation: $Transport <br> MoveDate: $MoveDate <br> Service Requested $info.";
				   
	 $message00  = "<br>";
     $message00  = str_replace ("%JobInfo%", $Job_Info, $temp_message00);
	 $message00  = str_replace ("%CN%", $CName, $message00);
	 $message00 = nl2br($message00);
	 $message00 = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"logos/MUWC_Logo.gif\"><br>" . $message00 . 
		              "</center></font>";
	
	  send_mail("$from",SYSTEM_EMAIL_NAME,"$Email","Provider Accepted Job","$message00");
	 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('11', '$from', '$Email', 'Provider Accepted Job', '$message00')";
	$result = mysql_query($sql) or die("Query failed50*");
	                 send_mail($from, $from, $Email, 'Provider Accepted Job', $message00);

	 send_mail("$from",SYSTEM_EMAIL_NAME,"$from","$Subject","$message");
	 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('8', '$from', '$from', '$Subject', '$message')";
	$result = mysql_query($sql) or die("Query failed5");
                send_mail($from, $from, $from, $Subject, $message);
	 
  }
  
  if($_POST[RJ3])
  {
     $strQuery = "update tblmemberaction set Accept = '0', Repost = '1', RepostDate = CURRENT_TIMESTAMP where MAID = $MAID AND JobID = 
	              $JobID AND MID =" . $_SESSION['Member_Id'];
	 $result_newQuery = mysql_query($strQuery) or die("Query failedRJ4");
	 
	 $strQuery = "update tbljobs_location set Origin = '0' where MAID = $MAID AND JLID = $JLID";
	 $result_newQuery = mysql_query($strQuery) or die("Query failedRJ5");
	 
	 $strQuery = "INSERT INTO `tbl_joblogs` (`JLID`, `Action`) VALUES ($JLID, 'RJO')";
	 $result_newQuery = mysql_query($strQuery) or die("Query failed1RJ6");
  }
  
  if($_POST[AJ4])
  {
     $strQuery = "update tblmemberaction set Accept = '1',  Repost = '0', AcceptDate = CURRENT_TIMESTAMP where MAID = $MAID AND JobID = 
	              $JobID AND MID =" . $_SESSION['Member_Id'];
	 $result_newQuery = mysql_query($strQuery) or die("Query failedAJ3");
	 
	 $strQuery = "update tbljobs_location set Destination = '1' where MAID = $MAID AND JLID = $JLID";
	 $result_newQuery = mysql_query($strQuery) or die("Query failedAJ4*");
	 
	 $strQuery = "INSERT INTO `tbl_joblogs` (`JLID`, `Action`) VALUES ($JLID, 'AJD')";
	 $result_newQuery = mysql_query($strQuery) or die("Query failed1AJ5");
	 
	  $sql = "SELECT Detail from tbl_templates WHERE TempID='2'"; 
	 $result = mysql_query($sql) or die("Query failed2300");
	 $line = mysql_fetch_array($result, MYSQL_ASSOC);
     $temp_message00 = $line[Detail]; 
	 
	 $Job_Info = "Origin Location: $OriginCity,$OriginState <br> Destination Location: $DestCity,$DestState <br> Labor Required:$Labor
	              <br> Transportation: $Transport <br> MoveDate: $MoveDate <br> Service Requested $info.";
				   
	 $message00  = "<br>";
     $message00  = str_replace ("%JobInfo%", $Job_Info, $temp_message00);
	 $message00  = str_replace ("%CN%", $CName, $message00);
	 $message00 = nl2br($message00);
	 $message00 = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"logos/MUWC_Logo.gif\"><br>" . $message00 . 
		              "</center></font>";
	
	 send_mail("$from",SYSTEM_EMAIL_NAME,"$Email","Provider Accepted Job","$message00");
	 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('11', '$from', '$Email', 'Provider Accepted Job', '$message00')";
	$result = mysql_query($sql) or die("Query failed50*");

	 send_mail("$from",SYSTEM_EMAIL_NAME,"$from","$Subject","$message");
	 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('8', '$from', '$from', '$Subject', '$message')";
	$result = mysql_query($sql) or die("Query failed5");
	                 send_mail($from, $from, $from, $Subject, $message);
  }
  
  if($_POST[RJ4])
  {
     $strQuery = "update tblmemberaction set Accept = '0', Repost = '1', RepostDate = CURRENT_TIMESTAMP where MAID = $MAID AND JobID = 
	              $JobID AND MID =" . $_SESSION['Member_Id'];
	 $result_newQuery = mysql_query($strQuery) or die("Query failedRJ4");
	 
	 $strQuery = "update tbljobs_location set Destination = '0' where MAID = $MAID AND JLID = $JLID";
	 $result_newQuery = mysql_query($strQuery) or die("Query failedRJ5");
	 
	 $strQuery = "INSERT INTO `tbl_joblogs` (`JLID`, `Action`) VALUES ($JLID, 'RJD')";
	 $result_newQuery = mysql_query($strQuery) or die("Query failed1RJ6");
  }
  
  // *********** END DIFF STATE PROCESSING *****************************
  
  @header("Location: job_details.php?JobID=$JobID&JLID=$JLID&MAID=$MAID&OrderID=$OrderID&day=$day&month=$month&year=$year");
  exit;
  
?>