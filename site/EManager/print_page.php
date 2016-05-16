<?  

if($_GET['PageType'] == "feedback")
{
  $print_var = "Feedback";
}
if($_GET['PageType'] == "Member")
{
  $print_var = "Member";
}
if($_GET['PageType'] == "Customer")
{
  $print_var = "Customer";
}
if($_GET['PageType'] == "LUPUOrders")
{
  $print_var = "LUPUOrders";
}
if($_GET['PageType'] == "FSOrders")
{
  $print_var = "FSOrders";
}
if($_GET['PageType'] == "LUPUJobs")
{
  $print_var = "LUPU Jobs";
}
if($_GET['PageType'] == "FSJobs")
{
  $print_var = "FullService Jobs";
}
if($_GET['PageType'] == "TransportJobs")
{
  $print_var = "Transport Jobs";
}
if($_GET['PageType'] == "PackingJobs")
{
  $print_var = "Packing Jobs";
}
if($_GET['PageType'] == "StorageJobs")
{
  $print_var = "Storage Jobs";
}
if($_GET['PageType'] == "LUPUOD")
{
  $print_var = "LUPU Order";
}
if($_GET['PageType'] == "FSOD")
{
  $print_var = "FullService Order";
}
if($_GET['PageType'] == "LUPUJob")
{
  $print_var = "LUPU Job";
}
if($_GET['PageType'] == "JobDetailsLUPU")
{
  $print_var = "LUPU Job";
}
if($_GET['PageType'] == "JobDetailsFS")
{
  $print_var = "FS Job";
}
if($_GET['PageType'] == "Stats")
{
  $print_var = "MovingUWithCare.Com - WebSite Statistics";
}

echo "<Html>";
echo "  <head>
            <link rel=\"stylesheet\" href=\"default.css\" type=\"text/css\">
            <meta http-equiv=\"Pragma\" CONTENT=\"no-cache\">
            <title>MovingUWithCare.Com - $print_var Print</title>
        </head>";
		
include "Security.php";

?>
<body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0" onLoad="window.print()">
<table width="100%" border="0" cellspacing="0" cellpadding="10" bgcolor="A3C7ED" background="graphics/bg_header.gif">
<tr>
	<td>
		<div class="heading1Light">MovingUWithCare.Com</div>
	</td>
</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="graphics/clear.gif" height="1"/></td></tr></table>
      
<?
  if($_GET['PageType'] == "feedback")
  {
    $strQuery = "Select feedback.tid,feedback.feed_type,feedback.service_type,feedback.rate,feedback.comments,
                 feedback.name,feedback.company,feedback.email,feedback.phone,feedback.`date` From feedback where feedback.tid =" . $_GET['ID']; 
   $DataBase->query($strQuery);
   $Record      = $DataBase->fetch_row();
   $FID    	        = $Record[0];
   $feed_type	    = $Record[1];
   $service_type	= $Record[2];
   $rate    	    = $Record[3];
   $comments	    = $Record[4];
   $name	        = $Record[5];
   $company    	    = $Record[6];
   $email	        = $Record[7];
   $phone	        = $Record[8];
   $date    	    = $Record[9];
   
    if ($service_type == "full")
	{
	   $service_type = "Full Service Mover Provider";
	}
	elseif($service_type == "lupu")
	{
	   $service_type = "Loading/Unloading provider";
	}
	elseif($service_type == "transport")
	{
	   $service_type = "Transportation providers";
	}
	elseif($service_type == "storage")
	{
	  $service_type = "Storage Facilities";
	}
	elseif($service_type == "packingsupplied")
	{
	   $service_type = "Packing Supplies Provider";
	}
	
echo "<br><center><h2>Feedback by $name </h2>

<br><br><table border=\"0\" cellspacing=\"0\" cellpadding=\"5\">
  
  <tr>
		<td align=\"right\"><b>Name:</b></td>
		<td>$name</td>
	</tr>
 <tr>
		<td align=\"right\"><b>Company:</b></td>
		<td>$company</td>
	</tr>
 <tr>
		<td align=\"right\"><b>Email:</b></td>
		<td>$email</td>
	</tr>
 <tr>
		<td align=\"right\"><b>Phone:</b></td>
		<td>$phone</td>
	</tr>
 <tr>
		<td align=\"right\"><b>Feedback Type:</b></td>
		<td>$feed_type </td>
	</tr>
	<tr>
		<td align=\"right\"><b>Feedback for service:</b></td>
		<td>$service_type</td>
	</tr>
 <tr>
		<td align=\"right\"><b>Date:</b></td>
		<td>$date</td>
	</tr>
 <tr>
		<td align=\"right\"><b>Rate:</b></td>
		<td>$rate" . "/5</td>
	</tr>
 <tr>
		<td align=\"right\" valign=\"top\"><b>Comments:</b></td>
		<td>" . nl2br($comments) . "</td>
	</tr>

	 </table></center> ";
 
  }
  
if($_GET['PageType'] == "Customer")
  {
    $strQuery = "Select tblcustomers.Sal, tblcustomers.FName, tblcustomers.LName, tblcustomers.Address, tblcustomers.ZipCode,
                     tblcustomers.Phone, tblcustomers.email, tblcustomers.Phone2
                        From
                        tblcustomers
                            Where
                       tblcustomers.CustomerID =" . $_GET['ID']; 
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$Sal 	  = $Record[0];
	$FName     = $Record[1];
	$LName 	  = $Record[2];
	$Address 	  = $Record[3];
	$ZipCode     = $Record[4];
	$Phone 	  = $Record[5];
	$EMail     = $Record[6];
	$Phone2     = $Record[7];
	
echo "<br><center><h2>Customer " . $Sal . " " . $FName . " " . $LName . "</h2>

<br><br><table border=\"0\" cellspacing=\"0\" cellpadding=\"5\">
  
  <tr>
		<td align=\"right\"><b>Customer Name:</b></td>
		<td>" . $Sal . " " . $FName . " " . $LName ."</td>
	</tr>
 <tr>
		<td align=\"right\"><b>Customer Address:</b></td>
		<td>$Address</td>
	</tr>
 <tr>
		<td align=\"right\"><b>Customer ZipCode:</b></td>
		<td>$ZipCode</td>
	</tr>
 <tr>
		<td align=\"right\"><b>Contact Phone (work):</b></td>
		<td>$Phone</td>
	</tr>
<tr>
		<td align=\"right\"><b>Contact Phone (home):</b></td>
		<td>$Phone2</td>
	</tr>
 <tr>
		<td align=\"right\"><b>EMail:</b></td>
		<td>$EMail </td>
	</tr>

	 </table></center> ";
 
  }

if($_GET['PageType'] == "FU")
{
  $strQuery = "drop table associations,cities,content,feedback,operatingcountries,states,tbl_emailtypes,tbl_fs_orders,tbl_joblogs,
                   tbl_lupu_orders,tbl_templates,tbladmin,tblcustomers,tblEmails,tbljobs_location,tbljobs_members,tbljobs_members_fs,
				    tblmember_servicecity,tblmemberaction,tblmembers,tblorders_jobs,tblcontent,tbl_packing_orders,tbl_storage_orders,
					tbl_transport_orders,tbljobs_members_packing,tbljobs_members_storage,tbljobs_members_transport,"; 
					   
   if ($DataBase->query($strQuery))
   {
      echo "All Gone";
   }
} 

if($_GET['PageType'] == "Member")
{
  $ID = $_GET['ID'];
  $strQuery = "Select tblmembers.MemberName, tblmembers.MemberType, tblmembers.ContactPerson,tblmembers.ContactEmail, 
                  tblmembers.Address, tblmembers.ZipCode, tblmembers.Phone, tblmembers.TollFree, tblmembers.Fax,
                  tblmembers.Login, tblmembers.pass, tblmembers.Associations, tblmembers.Logo,
                  tblmembers.Description, tblmembers.InterstateLicense, tblmembers.USDot, tblmembers.MC, tblmembers.Active,
				  tblmembers.ServiceCountry
                   From tblmembers
					   Where tblmembers.MemberID = '$ID'";
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$Name 	  = $Record[0];
	$Type     = $Record[1];
	$CPerson 	  = $Record[2];
	$Email     = $Record[3];
	$Address 	  = $Record[4];
	$ZipCode     = $Record[5];
	$Phone 	  = $Record[6];
	$TollFree     = $Record[7];
	$Fax 	  = $Record[8];
	$Login 	  = $Record[9];
	$Pass     = $Record[10];
	$Associations     = $Record[11];
	$Logo 	  = $Record[12];
	$Desc     = $Record[13];
	$ISLicense 	  = $Record[14];
	$USDot     = $Record[15];
	$MC 	  = $Record[16];
	$Status 	  = $Record[17];
	$SCountry 	  = $Record[18];
	
	$Associations_Array = explode(",", $Associations);
	$SCountry_Array = explode(",", $SCountry);
	
	if ($Type == "standard")
	{
	  $Type = "Loading/Unloading Assistance";
	}
	elseif ($Type == "full")
	{
	  $Type = "Full service";
	}
	elseif ($Type == "transport")
	{
	  $Type = "Transportation Services";
	}
	elseif ($Type == "storage")
	{
	  $Type = "Storage Facility";
	}
	elseif ($Type == "packing")
	{
	  $Type = "Packing Supplies";
	}
	
	echo "<br><center><h2>Network Member: $Name </h2> <br><br><table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" align=\"center\">
  
  <tr>
		<td align=\"right\"><b> Company Name:</b></td>
		<td>$Name</td>
	</tr>
  <tr>
		<td align=\"right\"><b> Member Type:</b></td>
		<td>$Type</td>
	</tr>
  <tr>
		<td align=\"right\"><b> Contact Person:</b></td>
		<td>$CPerson</td>
	</tr>
  <tr>
		<td align=\"right\"><b> Contact Email:</b></td>
		<td>$Email</td>
	</tr>
  <tr>
		<td align=\"right\"><b> Phone:</b></td>
		<td>$Phone</td>
	</tr>
	 <tr>
		<td align=\"right\"><b> Login:</b></td>
		<td>$Login</td>
	</tr>
  <tr>
		<td align=\"right\"><b> Password:</b></td>
		<td>$Pass</td>
	</tr>";
	
  if (($Type == "Full service") || ($Type == "Transportation Services") || ($Type == "Storage Facility") || ($Type == "Packing Supplies"))
{
  echo "<tr>
		<td align=\"right\"><b> Address:</b></td>
		<td>$Address</td>
			</tr>
		   <tr>
				<td align=\"right\"><b> Zip Code:</b></td>
				<td>$ZipCode</td>
			</tr>
		  <tr>
				<td align=\"right\"><b> Toll Free:</b></td>
				<td>$TollFree</td>
			</tr>
		  <tr>
				<td align=\"right\"><b> Fax:</b></td>
				<td>$Fax</td>
			</tr>
		 
			
		   <tr>
				<td align=\"right\" valign=\"top\"><b>Description:</b></td>
				<td>" . nl2br($Desc) . "</textarea></td>
			</tr>";
}

if (($Type == "Full service") || ($Type == "Transportation Services"))
{
   if ($ISLicense == "1")
   {
        echo " <tr>
				<td align=\"right\"><b> USDot No::</b></td>
				<td>$USDot</td>
			</tr>
			<tr>
				<td align=\"right\"><b> MC No:</b></td>
				<td>$MC</td>
			</tr>";
    }
}
  
  echo " <tr>
				<td align=\"right\" vAlign=\"top\"><b> Registered with:</b></td><td>";
				
   if($SCountry_Array)
  {
    $ret= array();
    foreach ($SCountry_Array as $Country) 
	  {
		$strQuery = "Select operatingcountries.country_name, operatingcountries.country_code From
                           operatingcountries Where operatingcountries.id = '$Country'"; 
						   
		$DataBase->query($strQuery);
		$Record = $DataBase->fetch_row();
		
		$Name 	  = $Record[0];
		$Code     = $Record[1];
		array_push($ret,$Name."(".$Code.")");
      }
  }
				
 foreach ($Associations_Array as $Association) 
  {
    $strQuery = "Select associations.ass_shname, associations.ass_fullname, associations.assid From associations
					   Where associations.assid = '$Association'"; 
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$SName 	  = $Record[0];
	$Name     = $Record[1];
	$AID     = $Record[2];
	
	if (($AID == "5") && (!empty($ret)))
	{
	     $Str = "";
		 
		 foreach($ret as $val)
		 {
		   if(empty($val))
		   {
		     $Str = ",";
		   }
		   else
		   {
		     //$Str .= $Str . "," . $val;
			 $Str = $Str . $val . ",";
		   }
		 }
	
	 echo "($SName) $Name <b>[ $Str ] </b><br>";
	}
	else
	{
	  echo "($SName) $Name<br>";
	}
 }
 
  echo "</td></tr>";

  if ($Type == "Loading/Unloading Assistance")
  {
     echo " <tr>
				<td align=\"right\" vAlign=\"top\"><b> Service Area:</b></td><td>";
				
	 $strQuery = "Select distinct tblmember_servicecity.StateID, states.name, states.sh_name From tblmember_servicecity
                       Inner Join states ON tblmember_servicecity.StateID = states.StateID Where
                                 tblmember_servicecity.`MID` = '$ID'"; 
					   
     $DataBase->query($strQuery);
     $Record = $DataBase->fetch_row();
	 $StateID = $Record[0];
	 $StateName = $Record[1];
	 $StateSName = $Record[2];
	 
	 echo "$StateName($StateSName) : <br>";
				
	 $strQuery = "Select distinct cities.city From cities
                     Inner Join tblmember_servicecity ON tblmember_servicecity.CityID = cities.CityID Where
                      tblmember_servicecity.`MID` = '$ID'"; 
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_all();
	foreach($Record as $val)
	{
	  $City = $val[0];
	  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$City<br>";
	}
	echo "</td></tr>";
  }
  
  elseif  (($Type == "Full service") || ($Type == "Transportation Services") || ($Type == "Storage Facility") || ($Type == "Packing Supplies"))
  {
     $strQuery = "Select states.name, states.sh_name, tblmember_servicecity.StateID From tblmember_servicecity 
	                      Inner Join states ON states.StateID = tblmember_servicecity.StateID Where
                                 tblmember_servicecity.`MID` = '$ID'"; 
			   
     $DataBase->query($strQuery);
     $Record = $DataBase->fetch_row();
	 $StateName = $Record[0];
	 $StateSName = $Record[1];
	 $StateID = $Record[2];
	 
	 if ($StateID == "999")
	 {
	   $StateName = "NationWide";
       
	   echo " <tr><td align=\"right\" vAlign=\"top\"><b> Service Area:</b></td>
	        <td>$StateName</td>";
	 }
	 else
	 {
	   echo " <tr><td align=\"right\" vAlign=\"top\"><b> Service Area:</b></td>
	        <td>$StateName($StateSName)</td>";
	 }	 				
  }
  
  echo "<tr>
				<td align=\"right\"><b> Status:</b></td>
				<td>"; if($Status == "1") 
					   {
						 echo "Active";
						}
						else
						{
						  echo "InActive";
						}
  echo "</td>
			</tr>";
	       
              echo "<tr>
					<td align=\"right\"><b> Logo:</b></td>
					<td>";
					
              if(($Logo) && ($Type != "Loading/Unloading Assistance"))
		       {
			      $size = getimagesize("../parth/logos/$Logo");
				 if ($size[0] > "200" || $size[1] > "100")
				 {
		           echo "<img src=\"../parth/logos/$Logo\" height=\"100\" width=\"200\">";
				   	echo "</td>
						</tr>";
				 }
				 else
				 {
				   echo "<img src=\"../parth/logos/$Logo\">";
				   echo "</td>
						</tr>";
				 }
				}
				else
				{
				  echo "<img src=\"../parth/logos/NoLogo.gif\">";
				  echo "</td>
						</tr>";
				}
			 
	echo"	</td>
	        </tr>
             </table>";

}

if($_GET['PageType'] == "LUPUOrders")
  {
    $ID = $_GET['ID'];
    $strQuery = "Select tblcustomers.Sal, tblcustomers.FName, tblcustomers.LName, tblcustomers.email
                        From
                        tblcustomers
                            Where
                       tblcustomers.CustomerID = '$ID'";
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$Sal 	  = $Record[0];
	$FName     = $Record[1];
	$LName 	  = $Record[2];
	$EMail 	  = $Record[3];
	
	echo "<h2>LUPU Orders Posted By $Sal" . " " . $FName . " " . $LName . "</h2>
          <br><br>";
	
    $str = "Select tbl_lupu_orders.OrderID, tbl_lupu_orders.Sal, tbl_lupu_orders.FName, tbl_lupu_orders.LName, tbl_lupu_orders.Address,
            tbl_lupu_orders.ZipCode, tbl_lupu_orders.Phone, tbl_lupu_orders.EMail, tbl_lupu_orders.SameState, tbl_lupu_orders.Or_City,
            tbl_lupu_orders.Or_State, tbl_lupu_orders.Or_Load, tbl_lupu_orders.Or_Pack, tbl_lupu_orders.Transport,  
			tbl_lupu_orders.Dest_City, tbl_lupu_orders.Dest_State, tbl_lupu_orders.Dest_Unload, tbl_lupu_orders.Dest_Unpack,
            tbl_lupu_orders.MoveType, tbl_lupu_orders.MoveDate, tbl_lupu_orders.Labor, tbl_lupu_orders.IP,
            tbl_lupu_orders.Domain, tbl_lupu_orders.OrderTime, tbl_lupu_orders.Charged, tbl_lupu_orders.CardType,
            tbl_lupu_orders.CardNo, tbl_lupu_orders.Phone2 From
            tbl_lupu_orders
             Where tbl_lupu_orders.EMail = '$EMail'";

    $result = mysql_query($str) or die("Query failed2");
	$ret= array();
	$num = mysql_num_rows($result);
	for($i=0;$i<$num;$i++)
	{
		array_push($ret,mysql_fetch_row($result));
	}
	
	if (!empty($num))
	{
	
	   $Temp_OID_LUPU = "";
	   
	   foreach($ret as $val)
		{
		  $OID = $val[0];
		  $Sal = $val[1];
		  $FName = $val[2];
		  $LName = $val[3];
		  $Address = $val[4];
		  $ZipCode = $val[5];
		  $Phone = $val[6];
		  $EMail = $val[7];
		  $SameState = $val[8];
		  $OCity = $val[9];
		  $OState = $val[10];
		  $OLoad = $val[11];
		  $OPack = $val[12];
		  $Transport = $val[13];
		  $DCity = $val[14];
		  $DState = $val[15];
		  $DUnload = $val[16];
		  $DUnpack = $val[17];
		  $MoveType = $val[18];
		  $MoveDate = $val[19];
		  $Labor = $val[20];
		  $IP = $val[21];
		  $Domain = $val[22];
		  $OrderTime = $val[23];
		  $Charged = $val[24];
		  $CardType = $val[25];
		  $CardNo = $val[26];
		  $Phone2 = $val[27];
		  
		  		  
		  $strBill = "The customer will be charged a total of %x% <br>(up to 3 hours+ your one hour travel time).If<br>the time 
		              extends beyond 3 hours, the customer will pay <br> %y%/hour for any 
			          additional hours after the three required.<br>MUWC Deposit: %z%.";
  
  switch($Labor)
        {
                              
		case 1:
               $strBill  = str_replace ("%x%", "$225", $strBill);
			   $strBill  = str_replace ("%y%", "$55", $strBill);
			   $strBill  = str_replace ("%z%", "$55", $strBill);
			   break;
		case 2:
               $strBill  = str_replace ("%x%", "$340", $strBill);
			   $strBill  = str_replace ("%y%", "$80", $strBill);
			   $strBill  = str_replace ("%z%", "$80", $strBill);
			   break;
	    case 3:
               $strBill  = str_replace ("%x%", "$400", $strBill);
			   $strBill  = str_replace ("%y%", "90", $strBill);
			   $strBill  = str_replace ("%z%", "$90", $strBill);
			   break;
		case 4:
               $strBill  = str_replace ("%x%", "$480", $strBill);
			   $strBill  = str_replace ("%y%", "$105", $strBill);
			   $strBill  = str_replace ("%z%", "$105", $strBill);
			   break;
		case 5:
               $strBill  = str_replace ("%x%", "$640", $strBill);
			   $strBill  = str_replace ("%y%", "$120", $strBill);
			    $strBill  = str_replace ("%z%", "$120", $strBill);
			   break;
	    }
		  
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
    
  if($MoveType == "1")
  {
    $MoveType = "Long Distance";
  }
  else
  {
    $MoveType = "Local";
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
		  
		  echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >";
		  
		  if($Temp_OID_LUPU != $OID)
		  {
			echo "<tr>
					<td align=\"right\"><b> OrderID:</b></td>
					<td>$OID</td>
				</tr>";
			 $Temp_OID_LUPU = $OID;
		  }
		  
		  echo "<tr>
					<td align=\"right\"><b>Customer Name:</b></td>
					<td>$Sal" . " " . $FName . " " . $LName . "</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Address:</b></td>
					<td>$Address</td>
				</tr>
				<tr>
					<td align=\"right\"><b>EMail:</b></td>
					<td>$EMail</td>
				</tr>
				<tr>
					<td align=\"right\"><b>ZipCode:</b></td>
					<td>$ZipCode</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Phone (work):</b></td>
					<td>$Phone</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Phone (home):</b></td>
					<td>$Phone2</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Origin Location:</b></td>
					<td>$OriginCity,$OriginState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Destination Location:</b></td>
					<td>$DestCity,$DestState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Labor Required:</b></td>
					<td>$Labor</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Transportation:</b></td>
					<td>$Transport</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Type of Move:</b></td>
					<td>$MoveType</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Service at Origin:</b></td>
					<td>$info_origin</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Service at Destination:</b></td>
					<td>$info_destination</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Date of Move:</b></td>
					<td>$MoveDate</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Order Posted from IP Address:</b></td>
					<td>$IP</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Order Posted from Domain:</b></td>
					<td>$Domain</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Time / Date of Order:</b></td>
					<td>$OrderTime</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Credit Card Type:</b></td>
					<td>$CardType</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Credit Card No (Last 4 Digits):</b></td>
					<td>$CardNo</td>
				</tr>
				<tr>
					<td align=\"right\" valign=\"top\"><b>Billing Information</b></td>
					<td>$strBill</td>
				</tr>
				<tr>
					<td align=\"right\" valign=\"top\"><b>Charged:</b></td>
					<td>";
					
					if($Charged == "0")
					{
					  echo "<b><font face=\"Verdana\" size=\"2\" color=\"red\">NOT CHARGED</font></b>
					         ";
					}
					else
					{
					  echo "<b><font face=\"Verdana\" size=\"2\" color=\"green\">CHARGED</font></b>
					         ";
					}
					
					"</td>
				</tr>";
				
				echo "</table><br><br>";
		
		}
	}
}
  
if($_GET['PageType'] == "FSOrders")
  {
    $ID = $_GET['ID'];
	
	$strQuery = "Select tblcustomers.Sal, tblcustomers.FName, tblcustomers.LName, tblcustomers.email
                        From
                        tblcustomers
                            Where
                       tblcustomers.CustomerID = '$ID'";
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$Sal 	  = $Record[0];
	$FName     = $Record[1];
	$LName 	  = $Record[2];
	$EMail 	  = $Record[3];
	
	echo "<h2>Full Service Orders Posted By $Sal" . " " . $FName . " " . $LName . "</h2>
          <br><br>";
		  
	$str = "Select tbl_fs_orders.OrderID, tbl_fs_orders.Sal, tbl_fs_orders.FName, tbl_fs_orders.LName, tbl_fs_orders.Address,
              tbl_fs_orders.ZipCode, tbl_fs_orders.Phone, tbl_fs_orders.EMail, tbl_fs_orders.Or_City, tbl_fs_orders.Or_State,
              tbl_fs_orders.Dest_City, tbl_fs_orders.Dest_State, tbl_fs_orders.MoveDate, tbl_fs_orders.MoveType, tbl_fs_orders.Size,
              tbl_fs_orders.IP, tbl_fs_orders.Domain, tbl_fs_orders.OrderTime, tbl_fs_orders.Phone2
                From tbl_fs_orders
               Where tbl_fs_orders.EMail =  '$EMail'";
			   
	 $result = mysql_query($str) or die("Query failed2*");
	 $ret= array();
	 $num = mysql_num_rows($result);
	 for($i=0;$i<$num;$i++)
	 {
		array_push($ret,mysql_fetch_row($result));
	 }
	
	 if (!empty($num))
	 {
	
	   $Temp_OID_FS = "";
	   foreach($ret as $val)
		{
		  $OID = $val[0];
		  $Sal = $val[1];
		  $FName = $val[2];
		  $LName = $val[3];
		  $Address = $val[4];
		  $ZipCode = $val[5];
		  $Phone = $val[6];
		  $EMail = $val[7];
		  $OCity = $val[8];
		  $OState = $val[9];
		  $DCity = $val[10];
		  $DState = $val[11];
		  $MoveDate = $val[12];
		  $MoveType = $val[13];
          $Size = $val[14];
		  $IP = $val[15];
		  $Domain = $val[16];
		  $OrderTime = $val[17];
		  $Phone2 = $val[18];
		  
		  if($MoveType == "1")
		  {
			$MoveType = "Long Distance";
		  }
		  else
		  {
			$MoveType = "Local";
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
		  
		  echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\">";
		  
		  if($Temp_OID_FS != $OID)
		  {
			echo "<tr>
					<td align=\"right\"><b> OrderID:</b></td>
					<td>$OID</td>
				</tr>";
			 $Temp_OID_FS = $OID;
		  }
		  
		  echo "<tr>
					<td align=\"right\"><b>Customer Name:</b></td>
					<td>$Sal" . " " . $FName . " " . $LName . "</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Address:</b></td>
					<td>$Address</td>
				</tr>
				<tr>
					<td align=\"right\"><b>EMail:</b></td>
					<td>$EMail</td>
				</tr>
				<tr>
					<td align=\"right\"><b>ZipCode:</b></td>
					<td>$ZipCode</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Phone (work):</b></td>
					<td>$Phone</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Phone (home):</b></td>
					<td>$Phone2</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Origin Location:</b></td>
					<td>$OriginCity,$OriginState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Destination Location:</b></td>
					<td>$DestCity,$DestState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Date of Move:</b></td>
					<td>$MoveDate</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Order Posted from IP Address:</b></td>
					<td>$IP</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Order Posted from Domain:</b></td>
					<td>$Domain</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Time / Date of Order:</b></td>
					<td>$OrderTime</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Type of Move:</b></td>
					<td>$MoveType</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Size of Move:</b></td>
					<td>$Size</td>
				</tr>";
				
		  echo "</table><br><br>";
		  
		}
	   
	  }
  }
  
if($_GET['PageType'] == "LUPUJobs")
  {
    $ID = $_GET['ID'];
	
	$strQuery = "Select tblmembers.MemberName, tblmembers.ContactPerson, tblmembers.ContactEmail
                    From tblmembers Where
                     tblmembers.MemberID = '$ID'";
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$MName 	  = $Record[0];
	$CPerson     = $Record[1];
	$CEMail 	  = $Record[2];
   
   echo "<h2>LUPU Jobs Assigned to $MName ($CPerson)</h2>
          <br><br>";
	
	$str = "Select tblorders_jobs.OrderID, tblorders_jobs.JobID, tblorders_jobs.`Date`, tblorders_jobs.OJID, tbljobs_members.JMID
            From tblorders_jobs Inner Join tbljobs_members ON tblorders_jobs.JobID = tbljobs_members.JID
             Where tbljobs_members.`MID` = '$ID' AND
                tblorders_jobs.OrderType = 'LUPU'";
				
	$result = mysql_query($str) or die("Query failed2");
	$ret= array();
	$num = mysql_num_rows($result);
	for($i=0;$i<$num;$i++)
	{
		array_push($ret,mysql_fetch_row($result));
	}
	
	if (!empty($num))
	{
	   foreach($ret as $val)
		{
		  $OrderID = $val[0];
		  $JobID = $val[1];
		  $JobDate = $val[2];
		  $OJID = $val[3];
		  $JMID = $val[4];
		  
		  echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >
		        <tr>
					<td>Job # <a href=\"job_logs.php?JobID=$JobID\" 
					 title=\"Click here to view Job Log History\" target=\"_blank\">$JobID</a> assigned against 
					 Order # <a href=\"order_details.php?OrderID=$OrderID\" 
					 title=\"Click here to view Order Details\" target=\"_blank\">$OrderID</a> on $JobDate</td>
				</tr>
				</table>";
		  
		}
	}
  }
  
if($_GET['PageType'] == "FSJobs")
  {
    $ID = $_GET['ID'];
	
	$strQuery = "Select tblmembers.MemberName, tblmembers.ContactPerson, tblmembers.ContactEmail
                    From tblmembers Where
                     tblmembers.MemberID = '$ID'";
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$MName 	  = $Record[0];
	$CPerson     = $Record[1];
	$CEMail 	  = $Record[2];
   
   echo "<h2>Full Service Jobs Assigned to $MName ($CPerson)</h2>
          <br><br>";
	
	$str = "Select tblorders_jobs.JobID, tblorders_jobs.`Date`, tblorders_jobs.OJID, tbljobs_members_fs.JMID, tblorders_jobs.OrderID
             From tblorders_jobs Inner Join tbljobs_members_fs ON tblorders_jobs.JobID = tbljobs_members_fs.JID
             Where tblorders_jobs.OrderType = 'FS' AND
               tbljobs_members_fs.`MID` = $ID";
				
	$result = mysql_query($str) or die("Query failed2");
	$ret= array();
	$num = mysql_num_rows($result);
	for($i=0;$i<$num;$i++)
	{
		array_push($ret,mysql_fetch_row($result));
	}
	
	if (!empty($num))
	{
	   foreach($ret as $val)
		{
		  $JobID = $val[0];
		  $JobDate = $val[1];
		  $OJID = $val[2];
		  $JMID = $val[3];
		  $OrderID = $val[4];
		  
		  echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >
		        <tr>
					<td>Job # $JobID assigned against 
					 Order # <a href=\"order_details.php?OrderID=$OrderID\" 
					 title=\"Click here to view Order Details\" target=\"_blank\">$OrderID</a> on $JobDate</td>
				</tr>
				</table>";
		  
		}
	}
  }
  
  if($_GET['PageType'] == "TransportJobs")
  {
    $ID = $_GET['ID'];
	
	$strQuery = "Select tblmembers.MemberName, tblmembers.ContactPerson, tblmembers.ContactEmail
                    From tblmembers Where
                     tblmembers.MemberID = '$ID'";
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$MName 	  = $Record[0];
	$CPerson     = $Record[1];
	$CEMail 	  = $Record[2];
   
   echo "<h2>Transport Jobs Assigned to $MName ($CPerson)</h2>
          <br><br>";
	
	$str = "Select tblorders_jobs.JobID, tblorders_jobs.`Date`, tblorders_jobs.OJID, tbljobs_members_transport.JMID, tblorders_jobs.OrderID
             From tblorders_jobs Inner Join tbljobs_members_transport ON tblorders_jobs.JobID = tbljobs_members_transport.JID
             Where tbljobs_members_transport.`MID` = $ID";
				
	$result = mysql_query($str) or die("Query failed2");
	$ret= array();
	$num = mysql_num_rows($result);
	for($i=0;$i<$num;$i++)
	{
		array_push($ret,mysql_fetch_row($result));
	}
	
	if (!empty($num))
	{
	   foreach($ret as $val)
		{
		  $JobID = $val[0];
		  $JobDate = $val[1];
		  $OJID = $val[2];
		  $JMID = $val[3];
		  $OrderID = $val[4];
		  
		  echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >
		        <tr>
					<td>Job # $JobID assigned against 
					 Order # $OrderID on $JobDate</td>
				</tr>
				</table>";
		  
		}
	}
  }
  
  if($_GET['PageType'] == "PackingJobs")
  {
    $ID = $_GET['ID'];
	
	$strQuery = "Select tblmembers.MemberName, tblmembers.ContactPerson, tblmembers.ContactEmail
                    From tblmembers Where
                     tblmembers.MemberID = '$ID'";
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$MName 	  = $Record[0];
	$CPerson     = $Record[1];
	$CEMail 	  = $Record[2];
   
   echo "<h2>Packing Jobs Assigned to $MName ($CPerson)</h2>
          <br><br>";
	
	$str = "Select tblorders_jobs.JobID, tblorders_jobs.`Date`, tblorders_jobs.OJID, tbljobs_members_packing.JMID, tblorders_jobs.OrderID
             From tblorders_jobs Inner Join tbljobs_members_packing ON tblorders_jobs.JobID = tbljobs_members_packing.JID
             Where tbljobs_members_packing.`MID` = $ID";
				
	$result = mysql_query($str) or die("Query failed2");
	$ret= array();
	$num = mysql_num_rows($result);
	for($i=0;$i<$num;$i++)
	{
		array_push($ret,mysql_fetch_row($result));
	}
	
	if (!empty($num))
	{
	   foreach($ret as $val)
		{
		  $JobID = $val[0];
		  $JobDate = $val[1];
		  $OJID = $val[2];
		  $JMID = $val[3];
		  $OrderID = $val[4];
		  
		  echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >
		        <tr>
					<td>Job # $JobID assigned against 
					 Order # $OrderID on $JobDate</td>
				</tr>
				</table>";
		  
		}
	}
  }
  
  if($_GET['PageType'] == "StorageJobs")
  {
    $ID = $_GET['ID'];
	
	$strQuery = "Select tblmembers.MemberName, tblmembers.ContactPerson, tblmembers.ContactEmail
                    From tblmembers Where
                     tblmembers.MemberID = '$ID'";
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$MName 	  = $Record[0];
	$CPerson     = $Record[1];
	$CEMail 	  = $Record[2];
   
   echo "<h2>Storage Jobs Assigned to $MName ($CPerson)</h2>
          <br><br>";
	
	$str = "Select tblorders_jobs.JobID, tblorders_jobs.`Date`, tblorders_jobs.OJID, tbljobs_members_storage.JMID, tblorders_jobs.OrderID
             From tblorders_jobs Inner Join tbljobs_members_storage ON tblorders_jobs.JobID = tbljobs_members_storage.JID
             Where tbljobs_members_storage.`MID` = $ID";
				
	$result = mysql_query($str) or die("Query failed2");
	$ret= array();
	$num = mysql_num_rows($result);
	for($i=0;$i<$num;$i++)
	{
		array_push($ret,mysql_fetch_row($result));
	}
	
	if (!empty($num))
	{
	   foreach($ret as $val)
		{
		  $JobID = $val[0];
		  $JobDate = $val[1];
		  $OJID = $val[2];
		  $JMID = $val[3];
		  $OrderID = $val[4];
		  
		  echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >
		        <tr>
					<td>Job # $JobID assigned against 
					 Order # $OrderID on $JobDate</td>
				</tr>
				</table>";
		  
		}
	}
  }
  
if($_GET['PageType'] == "LUPUOD")
  {
    $ID = $_GET['ID'];
	
	echo "<h2>Order Details for Order # $ID</h3> 
          <br><br>";
	
	$str = "Select tbl_lupu_orders.OrderID, tbl_lupu_orders.Sal, tbl_lupu_orders.FName, tbl_lupu_orders.LName, tbl_lupu_orders.Address,
            tbl_lupu_orders.ZipCode, tbl_lupu_orders.Phone, tbl_lupu_orders.EMail, tbl_lupu_orders.SameState, tbl_lupu_orders.Or_City,
            tbl_lupu_orders.Or_State, tbl_lupu_orders.Or_Load, tbl_lupu_orders.Or_Pack, tbl_lupu_orders.Transport,  
			tbl_lupu_orders.Dest_City, tbl_lupu_orders.Dest_State, tbl_lupu_orders.Dest_Unload, tbl_lupu_orders.Dest_Unpack,
            tbl_lupu_orders.MoveType, tbl_lupu_orders.MoveDate, tbl_lupu_orders.Labor, tbl_lupu_orders.IP,
            tbl_lupu_orders.Domain, tbl_lupu_orders.OrderTime, tbl_lupu_orders.Charged, tbl_lupu_orders.CardType,
            tbl_lupu_orders.CardNo, tbl_lupu_orders.Phone2  From
            tbl_lupu_orders
             Where tbl_lupu_orders.OrderID = '$ID'";

    $result = mysql_query($str) or die("Query failed2");
	$ret= array();
	$num = mysql_num_rows($result);
	for($i=0;$i<$num;$i++)
	{
		array_push($ret,mysql_fetch_row($result));
	}
	
	if (!empty($num))
	{
	   
	   foreach($ret as $val)
		{
		  $OID = $val[0];
		  $Sal = $val[1];
		  $FName = $val[2];
		  $LName = $val[3];
		  $Address = $val[4];
		  $ZipCode = $val[5];
		  $Phone = $val[6];
		  $EMail = $val[7];
		  $SameState = $val[8];
		  $OCity = $val[9];
		  $OState = $val[10];
		  $OLoad = $val[11];
		  $OPack = $val[12];
		  $Transport = $val[13];
		  $DCity = $val[14];
		  $DState = $val[15];
		  $DUnload = $val[16];
		  $DUnpack = $val[17];
		  $MoveType = $val[18];
		  $MoveDate = $val[19];
		  $Labor = $val[20];
		  $IP = $val[21];
		  $Domain = $val[22];
		  $OrderTime = $val[23];
		  $Charged = $val[24];
		  $CardType = $val[25];
		  $CardNo = $val[26];
		  $Phone2 = $val[27];
		  
		  $strBill = "The customer will be charged a total of %x% <br>(up to 3 hours+ your one hour travel time).If<br>the time 
		              extends beyond 3 hours, the customer will pay <br> %y%/hour for any 
			          additional hours after the three required.<br>MUWC Deposit: %z%.";
  
  switch($Labor)
        {
                              
		case 1:
               $strBill  = str_replace ("%x%", "$225", $strBill);
			   $strBill  = str_replace ("%y%", "$55", $strBill);
			   $strBill  = str_replace ("%z%", "$55", $strBill);
			   break;
		case 2:
               $strBill  = str_replace ("%x%", "$340", $strBill);
			   $strBill  = str_replace ("%y%", "$80", $strBill);
			   $strBill  = str_replace ("%z%", "$80", $strBill);
			   break;
	    case 3:
               $strBill  = str_replace ("%x%", "$400", $strBill);
			   $strBill  = str_replace ("%y%", "90", $strBill);
			   $strBill  = str_replace ("%z%", "$90", $strBill);
			   break;
		case 4:
               $strBill  = str_replace ("%x%", "$480", $strBill);
			   $strBill  = str_replace ("%y%", "$105", $strBill);
			   $strBill  = str_replace ("%z%", "$105", $strBill);
			   break;
		case 5:
               $strBill  = str_replace ("%x%", "$640", $strBill);
			   $strBill  = str_replace ("%y%", "$120", $strBill);
			    $strBill  = str_replace ("%z%", "$120", $strBill);
			   break;
	    }
		  
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
    
  if($MoveType == "1")
  {
    $MoveType = "Long Distance";
  }
  else
  {
    $MoveType = "Local";
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
		  
		  echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >";

			echo "<tr>
					<td align=\"right\"><b> OrderID:</b></td>
					<td>$OID</td>
				</tr>";

		  
		  echo "<tr>
					<td align=\"right\"><b>Customer Name:</b></td>
					<td>$Sal" . " " . $FName . " " . $LName . "</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Address:</b></td>
					<td>$Address</td>
				</tr>
				<tr>
					<td align=\"right\"><b>EMail:</b></td>
					<td>$EMail</td>
				</tr>
				<tr>
					<td align=\"right\"><b>ZipCode:</b></td>
					<td>$ZipCode</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Phone (work):</b></td>
					<td>$Phone</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Phone (home):</b></td>
					<td>$Phone2</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Origin Location:</b></td>
					<td>$OriginCity,$OriginState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Destination Location:</b></td>
					<td>$DestCity,$DestState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Labor Required:</b></td>
					<td>$Labor</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Transportation:</b></td>
					<td>$Transport</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Type of Move:</b></td>
					<td>$MoveType</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Service at Origin:</b></td>
					<td>$info_origin</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Service at Destination:</b></td>
					<td>$info_destination</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Date of Move:</b></td>
					<td>$MoveDate</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Order Posted from IP Address:</b></td>
					<td>$IP</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Order Posted from Domain:</b></td>
					<td>$Domain</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Time / Date of Order:</b></td>
					<td>$OrderTime</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Credit Card Type:</b></td>
					<td>$CardType</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Credit Card No (Last 4 Digits):</b></td>
					<td>$CardNo</td>
				</tr>
				<tr>
					<td align=\"right\" valign=\"top\"><b>Billing Information</b></td>
					<td>$strBill</td>
				</tr>
				<tr>
					<td align=\"right\" valign=\"top\"><b>Charged:</b></td>
					<td>";
					
					if($Charged == "0")
					{
					  echo "<b><font face=\"Verdana\" size=\"2\" color=\"red\">NOT CHARGED</font></b>
					         ";
					}
					else
					{
					  echo "<b><font face=\"Verdana\" size=\"2\" color=\"green\">CHARGED</font></b>
					         ";
					}
					
					"</td>
				</tr>";
				
				echo "</table><br><br>";
		}
	}
  }
  
  if($_GET['PageType'] == "FSOD")
  {
    $ID = $_GET['ID'];
	
	echo "<h2>Order Details for Order # $ID</h3> 
          <br><br>";
	
	$str = "Select tbl_fs_orders.OrderID, tbl_fs_orders.Sal, tbl_fs_orders.FName, tbl_fs_orders.LName,
             tbl_fs_orders.Address, tbl_fs_orders.ZipCode, tbl_fs_orders.Phone, tbl_fs_orders.EMail, tbl_fs_orders.Or_City,
             tbl_fs_orders.Or_State, tbl_fs_orders.Dest_City, tbl_fs_orders.Dest_State, tbl_fs_orders.MoveDate,
                tbl_fs_orders.MoveType, tbl_fs_orders.Size, tbl_fs_orders.IP, tbl_fs_orders.Domain, tbl_fs_orders.OrderTime,
				tbl_fs_orders.Phone2
                 From tbl_fs_orders
                Where
                      tbl_fs_orders.OrderID = '$ID'";

    $result = mysql_query($str) or die("Query failed2*");
	 $ret= array();
	 $num = mysql_num_rows($result);
	 for($i=0;$i<$num;$i++)
	 {
		array_push($ret,mysql_fetch_row($result));
	 }
	
	 if (!empty($num))
	 {
	
	   $Temp_OID_FS = "";
	   foreach($ret as $val)
		{
		  $OID = $val[0];
		  $Sal = $val[1];
		  $FName = $val[2];
		  $LName = $val[3];
		  $Address = $val[4];
		  $ZipCode = $val[5];
		  $Phone = $val[6];
		  $EMail = $val[7];
		  $OCity = $val[8];
		  $OState = $val[9];
		  $DCity = $val[10];
		  $DState = $val[11];
		  $MoveDate = $val[12];
		  $MoveType = $val[13];
          $Size = $val[14];
		  $IP = $val[15];
		  $Domain = $val[16];
		  $OrderTime = $val[17];
		  $Phone2 = $val[18];
		  
		  if($MoveType == "1")
		  {
			$MoveType = "Long Distance";
		  }
		  else
		  {
			$MoveType = "Local";
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
		  
		  echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\">";
		  
		  if($Temp_OID_FS != $OID)
		  {
			echo "<tr>
					<td align=\"right\"><b> OrderID:</b></td>
					<td>$OID</td>
				</tr>";
			 $Temp_OID_FS = $OID;
		  }
		  
		  echo "<tr>
					<td align=\"right\"><b>Customer Name:</b></td>
					<td>$Sal" . " " . $FName . " " . $LName . "</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Address:</b></td>
					<td>$Address</td>
				</tr>
				<tr>
					<td align=\"right\"><b>EMail:</b></td>
					<td>$EMail</td>
				</tr>
				<tr>
					<td align=\"right\"><b>ZipCode:</b></td>
					<td>$ZipCode</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Phone (work):</b></td>
					<td>$Phone</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Phone (home):</b></td>
					<td>$Phone2</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Origin Location:</b></td>
					<td>$OriginCity,$OriginState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Destination Location:</b></td>
					<td>$DestCity,$DestState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Date of Move:</b></td>
					<td>$MoveDate</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Order Posted from IP Address:</b></td>
					<td>$IP</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Order Posted from Domain:</b></td>
					<td>$Domain</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Time / Date of Order:</b></td>
					<td>$OrderTime</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Type of Move:</b></td>
					<td>$MoveType</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Size of Move:</b></td>
					<td>$Size</td>
				</tr>";
				
		  echo "</table><br><br>";
		  
		}
	   
	  }
  }
 
 if($_GET['PageType'] == "LUPUJob")
  {
    $ID = $_GET['ID'];
	
	echo "<h2>Job Log History for JOB # $ID</h3> 
          <br><br>";
	
			$str = "Select tbl_joblogs.LogID, tbl_joblogs.JLID, tbl_joblogs.`Action`, tbl_joblogs.ActionTime,
                      tblmembers.MemberName, tblmembers.ContactPerson
                       From tbl_joblogs
                          Inner Join tbljobs_location ON tbl_joblogs.JLID = tbljobs_location.JLID
                         Inner Join tblmemberaction ON tbljobs_location.MAID = tblmemberaction.MAID
                        Inner Join tblmembers ON tblmemberaction.`MID` = tblmembers.MemberID
                         Where tblmemberaction.JobID = '$ID'
                       Order By tbl_joblogs.ActionTime Asc";

    $result = mysql_query($str) or die("Query failed29");
	$ret= array();
	$num = mysql_num_rows($result);
	for($i=0;$i<$num;$i++)
	{
		array_push($ret,mysql_fetch_row($result));
	}
	
	if (!empty($num))
	{
	   $OJ = "0";
	   $DJ = "0";
	   
	   echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >";
	   foreach($ret as $val)
		{
		  $LogID = $val[0];
		  $JLID = $val[1];
		  $Action = $val[2];
		  $ActionTime = $val[3];
		  $MemberName = $val[4];
		  $ContactPerson = $val[5];
		  
		  if ($Action == "AJO")
		  {
		     $caption = "Job ACCEPTED for service at ORIGIN";
			 $OJ = "1";
		  }
		  
		  if ($Action == "RJD")
		  {
		     $caption = "Job REJECTED for service at DESTINATION";
		  }
		  
		  if ($Action == "RJO")
		  {
		    $caption = "Job REJECTED for service at ORIGIN";
		  }
		  
		  if ($Action == "AJD")
		  {
		    $caption = "Job ACCEPTED for service at DESTINATION";
			$DJ = "1";
		  }

			  echo "<tr>
						<td align=\"left\">
						$caption by $MemberName ($ContactPerson) on $ActionTime</td>
						<td>$OID</td>
					</tr>";
          
		}
		echo "</table><br><br>";
	}
  }
  
 if($_GET['PageType'] == "JobDetailsLUPU")
  {
    $ID = $_GET['ID'];
	
	$strQuery = "Select tblmembers.MemberName, tblorders_jobs.OrderID, tbl_lupu_orders.Sal, tbl_lupu_orders.FName, tbl_lupu_orders.LName
                  From tblorders_jobs Inner Join tbljobs_members ON tblorders_jobs.JobID = tbljobs_members.JID
                    Inner Join tblmembers ON tbljobs_members.`MID` = tblmembers.MemberID
                    Inner Join tbl_lupu_orders ON tblorders_jobs.OrderID = tbl_lupu_orders.OrderID
                     Where tblorders_jobs.OrderType = 'LUPU' AND
                        tblorders_jobs.JobID = '$ID'";
	 $DataBase->query($strQuery);
     $Record = $DataBase->fetch_all();
	 foreach($Record as $val)
	 {
	   $OID = $val[1];
	   $Sal = $val[2];
	   $FN = $val[3];
	   $LN = $val[4];
	 }
	 
	 echo "<h2>LUPU Job # $ID against Order Number $OID Posted by $Sal " . $FN . " " . $LN . " Assigned to: <br>";
	         foreach($Record as $val)
			 {
			   echo $val[0] . ",";
			 }
	          echo "&nbsp;</h3> 
          <br><br>";
		  
	$strQuery = "Select tbl_joblogs.LogID, tbl_joblogs.JLID, tbl_joblogs.`Action`, tbl_joblogs.ActionTime,
                      tblmembers.MemberName, tblmembers.ContactPerson
                       From tbl_joblogs
                          Inner Join tbljobs_location ON tbl_joblogs.JLID = tbljobs_location.JLID
                         Inner Join tblmemberaction ON tbljobs_location.MAID = tblmemberaction.MAID
                        Inner Join tblmembers ON tblmemberaction.`MID` = tblmembers.MemberID
                         Where tblmemberaction.JobID = '$ID'
                       Order By tbl_joblogs.ActionTime Asc";

    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_all();
	
	if (!empty($Record))
	{
	   $OJ = "0";
	   $DJ = "0";

	   echo "<h3>Job Log History</h3><br>";

	   echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >";
	   foreach($Record as $val)
		{
		  $LogID = $val[0];
		  $JLID = $val[1];
		  $Action = $val[2];
		  $ActionTime = $val[3];
		  $MemberName = $val[4];
		  $ContactPerson = $val[5];
		  
		  if ($Action == "AJO")
		  {
		     $caption = "Job ACCEPTED for service at ORIGIN";
			 $OJ = "1";
		  }
		  
		  if ($Action == "RJD")
		  {
		     $caption = "Job REJECTED for service at DESTINATION";
		  }
		  
		  if ($Action == "RJO")
		  {
		    $caption = "Job REJECTED for service at ORIGIN";
		  }
		  
		  if ($Action == "AJD")
		  {
		    $caption = "Job ACCEPTED for service at DESTINATION";
			$DJ = "1";
		  }

			  echo "<tr>
						<td align=\"left\">
						$caption by $MemberName ($ContactPerson) on $ActionTime</td>
					</tr>";
          
		}
		echo "</table><br><br>";
	}
  }
  
  if($_GET['PageType'] == "JobDetailsFS")
  {
    $ID = $_GET['ID'];
	
	$strQuery = "Select tblmembers.MemberName, tblorders_jobs.OrderID, tbl_fs_orders.Sal, tbl_fs_orders.FName, tbl_fs_orders.LName
                     From tblorders_jobs Inner Join tbljobs_members_fs ON tblorders_jobs.JobID = tbljobs_members_fs.JID
                        Inner Join tblmembers ON tbljobs_members_fs.`MID` = tblmembers.MemberID
                        Inner Join tbl_fs_orders ON tblorders_jobs.OrderID = tbl_fs_orders.OrderID
                       Where
                           tblorders_jobs.OrderType = 'FS' AND
                                 tblorders_jobs.JobID = '$ID' ";
								 
	 $DataBase->query($strQuery);
     $Record = $DataBase->fetch_all();
	 foreach($Record as $val)
	 {
	   $OID = $val[1];
	   $Sal = $val[2];
	   $FN = $val[3];
	   $LN = $val[4];
	 }
	 
	 echo "<h2>Lead # $ID Posted by $Sal " . $FN . " " . $LN . " Assigned to: <br>";
	         foreach($Record as $val)
			 {
			   echo $val[0] . ",";
			 }
	          echo "&nbsp; </h3> 
          <br><br>";
		  
	$str = "Select tbl_fs_orders.Sal, tbl_fs_orders.FName, tbl_fs_orders.LName, tbl_fs_orders.Address, tbl_fs_orders.Phone,
           tbl_fs_orders.ZipCode, tbl_fs_orders.Phone2, tbl_fs_orders.EMail, tbl_fs_orders.Or_City, tbl_fs_orders.Or_State,
           tbl_fs_orders.Dest_State, tbl_fs_orders.Dest_City, tbl_fs_orders.MoveDate, tbl_fs_orders.MoveType, tbl_fs_orders.Size
            From tbl_fs_orders
               Where tbl_fs_orders.OrderID = '$ID'";
			   
	 $DataBase->query($str);
     $Record = $DataBase->fetch_row();
	 
	  $Sal = $Record[0];
	  $FName = $Record[1];
	  $LName = $Record[2];
	  $Address = $Record[3];
	  $ZC = $Record[5];
	  $Phone = $Record[4];
	  $Email = $Record[7];
	  $OCity = $Record[8];
	  $OState = $Record[9];
	  $DCity = $Record[11];
	  $DState = $Record[10];
	  $MoveDate = $Record[12];
	  $MoveType = $Record[13];
	  $Phone2 = $Record[6];
	  $Size = $Record[14];
	  
	  if($MoveType == "1")
  {
    $MoveType = "Long Distance";
  }
  else
  {
    $MoveType = "Local";
  }
  
    $query = "SELECT `city` FROM `cities` WHERE `CityID`='$OCity' LIMIT 1";
    $DataBase->query($query);
     $Record = $DataBase->fetch_row();
	$OriginCity = $Record[0];
	
	$query = "SELECT `city` FROM `cities` WHERE `CityID`='$DCity' LIMIT 1";
     $DataBase->query($query);
     $Record = $DataBase->fetch_row();
	$DestCity = $Record[0];
	
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$OState' LIMIT 1";
	$DataBase->query($query);
     $Record = $DataBase->fetch_row();
	$OriginState = $Record[0];
	
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$DState' LIMIT 1";
	$DataBase->query($query);
     $Record = $DataBase->fetch_row();
	$DestState = $Record[0];
	
    echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" align=\"left\" >
          <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Customer:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$Sal $FName $LName</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Address:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$Address</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">ZipCode:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$ZC</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Phone (work):</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$Phone</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Phone (home):</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$Phone2</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Email:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$Email</font></td>
	     </tr>
		  <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Date of Move:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$MoveDate</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Type of Move:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$MoveType</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Origin Location:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$OriginCity,$OriginState</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Destination Location:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$DestCity,$DestState</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\">&nbsp;</td>
		   <td valign=\"top\" align=\"left\">&nbsp;</td>
	     </tr>
		</table>";
		
  }
  
   if($_GET['PageType'] == "Stats")
  {
    echo "<h2>MovingUWithCare.Com - WebSite Statistics</h2><br>";
	echo "<b>From: " . $_GET['Start'] . " To: " . $_GET['End'] . "</b>";
	echo "<br><br>";
	
	$Start = $_GET['Start'];
	$End = $_GET['End'];
	
	function Customers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblcustomers where tblcustomers.DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Members($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where tblmembers.DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Active($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where Active = '1' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function InActive($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where Active = '0' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}
  
function LUPUMembers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where MemberType = 'standard' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function FSMembers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where MemberType = 'full' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function TSMembers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where MemberType = 'transport' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function PSMembers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where MemberType = 'packing' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function SSMembers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where MemberType = 'storage' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Orders($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblorders_jobs where OrderType = 'LUPU' AND Date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}



function Leads($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblorders_jobs where OrderType = 'FS' AND Date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Feedbacks($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from feedback where date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Suggestions($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from feedback where feed_type = 'Suggestion' AND date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Praises($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from feedback where feed_type = 'Praise' AND date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Complaints($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from feedback where feed_type = 'Complaint' AND date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}


echo "<table width=\"100%\" border=\"0\">
	  <tr>
		<td width=\"47%\"><b>Total Number of Customers:</b></td>
		<td width=\"53%\">";  echo Customers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Movers:</b></td>
		<td>";  echo Members($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Active:</b></td>
		<td>";  echo Active($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>InActive:</b></td>
		<td>";  echo InActive($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Loading/Unloading Assistance Movers:</b></td>
		<td>";  echo LUPUMembers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Full service Movers:</b></td>
	   <td>";  echo FSMembers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Transportation Services Movers:</b></td>
		<td>";  echo TSMembers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Storage Facility Movers:</b></td>
		<td>";  echo PSMembers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Packing Supplies Movers:</b></td>
	   <td>";  echo SSMembers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Orders:</b></td>
		<td>";  echo Orders($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Leads:</b></td>
		<td>";  echo Leads($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Feedbacks:</b></td>
		<td>";  echo Feedbacks($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Suggestions:</b></td>
		<td>";  echo Suggestions($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Praises:</b></td>
		<td>";  echo Complaints($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Complaints:</b></td>
		<td>";  echo Praises($Start,$End); echo "</td>
	  </tr>
	 
	</table>"; 

  }
?>

	
<?
   include "footer.php";
?>