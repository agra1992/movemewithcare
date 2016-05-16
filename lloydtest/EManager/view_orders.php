<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   
   $ID = $_GET['ID'];
   $nSearchCrit = $_GET['nSearchCrit'];
   $SearchString = $_GET['SearchString'];
   $count = $_GET['count'];
   $offset = $_GET['offset'];
   $Mod = $_GET['Mod'];
   $Type = $_GET['Type'];
   
   $strQuery = "Select tblcustomers.Sal, tblcustomers.FName, tblcustomers.LName, tblcustomers.email, tblcustomers.Valid, tblcustomers.IP
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
        $Valid   =$Record[4];
        $IP= $Record[5];
?>

 <div align="left"><a href="EManager.php">EManager(Home)</a> > 
   <a href="customers.php?nSearchCrit=<?=$nSearchCrit?>&SearchString=<?=$SearchString?>&count=<?=$count?>&offset=<?=$offset?>&Mod=<?=$Mod?>&Type=<?=$Type?>">Manage Customers</a> > View Orders by <? echo $Sal . " " . $FName . " " . $LName ?></div>
	<br><br>

<?    
   echo "<h2>Orders Posted By $Sal" . " " . $FName . " " . $LName . "</h2>
          <br><br>";
if($Valid == "no")
{
echo"This Customers is not validated";
					  echo "
					         <form action=\"validate.php\" name=\"form1\" method=\"post\">
							 <input type=\"hidden\" name=\"ID\" value=\"$ID\">
							  <input type=\"hidden\" name=\"OID\" value=\"$OID\">
							 <input type=\"hidden\" name=\"nSearchCrit\" value=\"$nSearchCrit\">
							 <input type=\"hidden\" name=\"SearchString\" value=\"$SearchString\">
							 <input type=\"hidden\" name=\"count\" value=\"$count\">
							 <input type=\"hidden\" name=\"offset\" value=\"$offset\">
							 <input type=\"submit\" name=\"Charge\" value=\"Validate\" class=\"waButton1\">
                                                         <input type='hidden' name='validate' value='yes'>
                                                         <input type='hidden' name='IP' value='$IP'>
							 </form>";
					  echo "
					         <form action=\"validate.php\" name=\"form1\" method=\"post\">
							 <input type=\"hidden\" name=\"ID\" value=\"$ID\">
							  <input type=\"hidden\" name=\"OID\" value=\"$OID\">
							 <input type=\"hidden\" name=\"nSearchCrit\" value=\"$nSearchCrit\">
							 <input type=\"hidden\" name=\"SearchString\" value=\"$SearchString\">
							 <input type=\"hidden\" name=\"count\" value=\"$count\">
							 <input type=\"hidden\" name=\"offset\" value=\"$offset\">
                                                         <input type='hidden' name='validate' value='never'>
                                                         <input type='hidden' name='IP' value='$IP'>
							 <input type=\"submit\" name=\"Charge\" value=\"Mark as Fake\" class=\"waButton1\">
							 </form>";
}
else if ($Valid == "yes")
{
echo"This Customers is validated";
					  echo "
					         <form action=\"validate.php\" name=\"form1\" method=\"post\">
							 <input type=\"hidden\" name=\"ID\" value=\"$ID\">
							  <input type=\"hidden\" name=\"OID\" value=\"$OID\">
							 <input type=\"hidden\" name=\"nSearchCrit\" value=\"$nSearchCrit\">
							 <input type=\"hidden\" name=\"SearchString\" value=\"$SearchString\">
							 <input type=\"hidden\" name=\"count\" value=\"$count\">
							 <input type=\"hidden\" name=\"offset\" value=\"$offset\">
                                                         <input type='hidden' name='IP' value='$IP'>
							 <input type=\"submit\" name=\"Charge\" value=\"Mark as Fake\" class=\"waButton1\">
                                                         <input type='hidden' name='validate' value='never'>
							 </form>";
}
else if ($Valid == "never")
{
echo"This Customers was marked fake";
					  echo "
					         <form action=\"validate.php\" name=\"form1\" method=\"post\">
							 <input type=\"hidden\" name=\"ID\" value=\"$ID\">
							  <input type=\"hidden\" name=\"OID\" value=\"$OID\">
							 <input type=\"hidden\" name=\"nSearchCrit\" value=\"$nSearchCrit\">
							 <input type=\"hidden\" name=\"SearchString\" value=\"$SearchString\">
							 <input type=\"hidden\" name=\"count\" value=\"$count\">
							 <input type=\"hidden\" name=\"offset\" value=\"$offset\">
                                                         <input type='hidden' name='IP' value='$IP'>
							 <input type=\"submit\" name=\"Charge\" value=\"Validate\" class=\"waButton1\">
                                                         <input type='hidden' name='validate' value='yes'>
							 </form>";

}
     
?>

<script language="JavaScript">
  
  var SpdWindowOpen;
  
  function spWindowOpen(id)
  {  
	SpdWindowOpen=window.open('print_page.php?PageType=LUPUOrders&ID='+id,'newwSp','status=yes,scrollbars=yes,width=600,height=600,left=10,top=20')
  }
  
  var SpdWindowOpen1;
  
  function spWindowOpen1(id)
  {  
	SpdWindowOpen1=window.open('print_page.php?PageType=FSOrders&ID='+id,'newwSp','status=yes,scrollbars=yes,width=600,height=600,left=10,top=20')
  }

</script>        

<?
  
   // ************************ LUPU ****************************************
if($Type != 2)
{
   echo "<h3>LUPU&nbsp; <a href=\"javascript:spWindowOpen($ID);\" 
            title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></a></h3> 
          <br><br>";
		  
   $str = "Select tbl_lupu_orders.OrderID, tbl_lupu_orders.Sal, tbl_lupu_orders.FName, tbl_lupu_orders.LName, tbl_lupu_orders.Address,
            tbl_lupu_orders.ZipCode,tbl_lupu_orders.Phone, tbl_lupu_orders.EMail, tbl_lupu_orders.SameState, tbl_lupu_orders.Or_City,
            tbl_lupu_orders.Or_State, tbl_lupu_orders.Or_Load, tbl_lupu_orders.Or_Pack, tbl_lupu_orders.Transport,  
			tbl_lupu_orders.Dest_City, tbl_lupu_orders.Dest_State, tbl_lupu_orders.Dest_Unload, tbl_lupu_orders.Dest_Unpack,
            tbl_lupu_orders.MoveType, tbl_lupu_orders.MoveDate, tbl_lupu_orders.Labor, tbl_lupu_orders.IP,
            tbl_lupu_orders.Domain, tbl_lupu_orders.OrderTime, tbl_lupu_orders.Charged, tbl_lupu_orders.CardType,
            tbl_lupu_orders.CardNo, tbl_lupu_orders.Phone2, tbl_lupu_orders.Dest_ZipCode From
            tbl_lupu_orders
             Where tbl_lupu_orders.IP = '$IP'";

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
		  $Dest_ZipCode = $val[28];
		  
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
				</tr>";
                      if($Dest_ZipCode != ""){

                          echo"	     <tr>
					    <td align=\"right\"><b>Destination ZipCode:</b></td>
					     <td>$Dest_ZipCode</td>
				        </tr>";
                      }else{
                                        echo"<form action='destination_lupu.php' method='POST'>";


                                       echo"<input type='hidden' name='ID' value='$ID'>
                                               <input type='hidden' name='labor' value='$Labor'>
                                               <input type='hidden' name='move_date' value='$MoveDate'>
                                               <input type='hidden' name='IP' value='$IP'>
                                               <input type='hidden' name='services' value='$info_destination'>

                                               <input type='hidden' name='dor_state' value='$DState'>
                                               <input type='hidden' name='OID' value='$OID'>                        <input type='hidden' name='Valid' value='$Valid'>";
                          echo"	     <tr>
					    <td align=\"right\"><b>Destination ZipCode:</b></td>
					     <td><input type='text' name='dest_zipcode'></td>
                                             <td><input type='submit' value='update'></form></td>
				        </tr>";
                      }
                      echo"
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
					         <form action=\"cu_order1.php\" name=\"form1\" method=\"post\">
							 <input type=\"hidden\" name=\"ID\" value=\"$ID\">
							  <input type=\"hidden\" name=\"OID\" value=\"$OID\">
							 <input type=\"hidden\" name=\"nSearchCrit\" value=\"$nSearchCrit\">
							 <input type=\"hidden\" name=\"SearchString\" value=\"$SearchString\">
							 <input type=\"hidden\" name=\"count\" value=\"$count\">
							 <input type=\"hidden\" name=\"offset\" value=\"$offset\">
							 <input type=\"submit\" name=\"Charge\" value=\"Charge\" class=\"waButton1\">
							 </form>";
					}
					else
					{
					  echo "<b><font face=\"Verdana\" size=\"2\" color=\"green\">CHARGED</font></b>
					          <form action=\"cu_order1.php\" name=\"form1\" method=\"post\">
							 <input type=\"hidden\" name=\"ID\" value=\"$ID\">
							  <input type=\"hidden\" name=\"OID\" value=\"$OID\">
							 <input type=\"hidden\" name=\"nSearchCrit\" value=\"$nSearchCrit\">
							 <input type=\"hidden\" name=\"SearchString\" value=\"$SearchString\">
							 <input type=\"hidden\" name=\"count\" value=\"$count\">
							 <input type=\"hidden\" name=\"offset\" value=\"$offset\">
							 <input type=\"submit\" name=\"UnCharge\" value=\"UnCharge\" class=\"waButton1\">
							 </form>";
					}
					
					"</td>
				</tr>";
				
				echo "</table><br><br>";
		
		}
		
	}
	else
	{
	  echo "<h3>No Orders Found Under LUPU Category</h3><br><br>";
	}
	
}
	
	// ************************ FULL SERVICE ****************************************
if($Type != 1)
{
	echo "<h3>FULL SERVICE&nbsp; 
	     <a href=\"javascript:spWindowOpen1($ID);\" title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></a></h3> 
          <br><br>";
		  
	 $str = "Select tbl_fs_orders.OrderID, tbl_fs_orders.Sal, tbl_fs_orders.FName, tbl_fs_orders.LName, tbl_fs_orders.Address,
              tbl_fs_orders.ZipCode, tbl_fs_orders.Phone, tbl_fs_orders.EMail, tbl_fs_orders.Or_City, tbl_fs_orders.Or_State,
              tbl_fs_orders.Dest_City, tbl_fs_orders.Dest_State, tbl_fs_orders.MoveDate, tbl_fs_orders.MoveType, tbl_fs_orders.Size,
              tbl_fs_orders.IP, tbl_fs_orders.Domain, tbl_fs_orders.OrderTime, tbl_fs_orders.Phone2
                From tbl_fs_orders
               Where tbl_fs_orders.IP =  '$IP'";
			   
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
	else
	{
	  echo "<h3>No Orders Found Under Full Service Category</h3><br><br>";
	}
}
?>
<?
   include "footer.php";
?>
  
   
   