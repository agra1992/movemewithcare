<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   
   $ID = $_GET['ID'];
   $SearchString = $_GET['SearchString'];
   $count = $_GET['count'];
   $offset = $_GET['offset'];
   $OrderType = $_GET['OrderType'];   
   $Mod  = $_GET['Mod'];
   $Type = $_GET['Type'];
?>

<script language="JavaScript">
  
  var SpdWindowOpen;
  
  function spWindowOpen(JobID)
  {  
	SpdWindowOpen=window.open('print_page.php?PageType=JobDetailsLUPU&ID='+JobID,'newwSp','status=yes,scrollbars=yes,width=750,height=600,left=10,top=20')
  }
  
   var SpdWindowOpen1;
  
  function spWindowOpen1(JobID)
  {  
	SpdWindowOpen1=window.open('print_page.php?PageType=JobDetailsFS&ID='+JobID,'newwSp','status=yes,scrollbars=yes,width=600,height=800,left=10,top=20')
  }
  

</script>     


   	<div align="left"><a href="EManager.php">EManager(Home)</a> > 
	<a href="jobs.php?ID=<?=$ID?>&SearchString=<?=$SearchString?>&count=<?=$count?>&offset=<?=$offset?>&OrderType=<?=$Type?>">Manage Leads</a> > Lead # <? echo "$ID"; ?></div>
	<br><br>
	
<?
	if ($OrderType == "fs")
	{
		echo "<h2>Lead Details for Lead # $ID&nbsp; </h2> 
          <br><br>";	
	
		$strQuery = "Select OrderID, Sal, FName, LName, Address, ZipCode, Phone, Phone2, EMail, Or_City, Or_State, Dest_City, Dest_State, MoveDate, MoveType, Size, IP, Domain, OrderTime from tbl_fs_orders Where OrderID='$ID'";
		
		$DataBase->query($strQuery);
     	$Record = $DataBase->fetch_all();     	
     	
	 	foreach($Record as $val)
	 	{
	   	  $OrderID = $val[0];
		  $Sal = $val[1];
		  $FName = $val[2];
		  $LName = $val[3];
		  $Address = $val[4];
		  $ZipCode = $val[5];
		  $Phone = $val[6];
		  $Phone2 = $val[7];
		  $EMail = $val[8];		  
		  $Or_City = $val[9];
		  $Or_State = $val[10];
		  $Dest_City = $val[11];
		  $Dest_State = $val[12];
		  $MoveDate = $val[13];
		  $MoveType = $val[14];
		  $Size = $val[15];
		  $IP = $val[16];
		  $Domain = $val[17];
		  $OrderTime = $val[18];
		  
		  if($MoveType == "1")
		  {
		    $MoveType = "Long Distance";
		  }
		  else
		  {
		    $MoveType = "Local";
		  }
  
		    $query = "SELECT `city` FROM `cities` WHERE `CityID`='$Or_City' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 2");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$OriginCity = $line[city];
			
			$query = "SELECT `city` FROM `cities` WHERE `CityID`='$Dest_City' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 3");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$DestCity = $line[city];
			
			$query = "SELECT `name` FROM `states` WHERE `StateID`='$Or_State' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 4");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$OriginState = $line[name];
			
			$query = "SELECT `name` FROM `states` WHERE `StateID`='$Dest_State' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 5");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$DestState = $line[name];
		  
	  		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >";

			echo "<tr>
					<td align=\"right\"><b> LeadID:</b></td>
					<td>$OrderID</td>
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
					<td>$OriginCity, $OriginState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Destination Location:</b></td>
					<td>$DestState</td>
				</tr>		
				<tr>
					<td align=\"right\"><b>Date of Move:</b></td>
					<td>$MoveDate</td>
				</tr>		
				<tr>
					<td align=\"right\"><b>Type of Move:</b></td>
					<td>$MoveType</td>
				</tr>	
				<tr>
					<td align=\"right\"><b>Size of Move:</b></td>
					<td>$Size</td>
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
					<td align=\"right\"><b>Time / Date of Lead:</b></td>
					<td>$OrderTime</td>
				</tr>";				  
		 
			}
	}
	
	if ($OrderType == "transport")
	{
		echo "<h2>Lead Details for Lead # $ID&nbsp; </h2> 
          <br><br>";	
	
		$strQuery = "Select OrderID, Sal, FName, LName, Address, ZipCode, Phone, Phone2, EMail, Or_City, Or_State, Dest_State, MoveDate, MoveType, IP, Domain, OrderTime from tbl_transport_orders Where OrderID='$ID'";
		
		$DataBase->query($strQuery);
     	$Record = $DataBase->fetch_all();     	
     	
	 	foreach($Record as $val)
	 	{
	   	  $OrderID = $val[0];
		  $Sal = $val[1];
		  $FName = $val[2];
		  $LName = $val[3];
		  $Address = $val[4];
		  $ZipCode = $val[5];
		  $Phone = $val[6];
		  $Phone2 = $val[7];
		  $EMail = $val[8];		  
		  $Or_City = $val[9];
		  $Or_State = $val[10];		  
		  $Dest_State = $val[11];
		  $MoveDate = $val[12];
		  $MoveType = $val[13];		  
		  $IP = $val[14];
		  $Domain = $val[15];
		  $OrderTime = $val[16];
		  
		  if($MoveType == "1")
		  {
		    $MoveType = "Long Distance";
		  }
		  else
		  {
		    $MoveType = "Local";
		  }
  
		    $query = "SELECT `city` FROM `cities` WHERE `CityID`='$Or_City' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 2");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$OriginCity = $line[city];			
			
			$query = "SELECT `name` FROM `states` WHERE `StateID`='$Or_State' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 4");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$OriginState = $line[name];
			
			$query = "SELECT `name` FROM `states` WHERE `StateID`='$Dest_State' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 5");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$DestState = $line[name];
		  
	  		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >";

			echo "<tr>
					<td align=\"right\"><b> LeadID:</b></td>
					<td>$OrderID</td>
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
					<td>$OriginCity, $OriginState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Destination Location:</b></td>
					<td>$DestState</td>
				</tr>		
				<tr>
					<td align=\"right\"><b>Date of Move:</b></td>
					<td>$MoveDate</td>
				</tr>		
				<tr>
					<td align=\"right\"><b>Type of Move:</b></td>
					<td>$MoveType</td>
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
					<td align=\"right\"><b>Time / Date of Lead:</b></td>
					<td>$OrderTime</td>
				</tr>";		 
		  		  
			}
	}

	
	if ($OrderType == "packing")
	{
		echo "<h2>Lead Details for Lead # $ID&nbsp; </h2> 
          <br><br>";	
	
		$strQuery = "Select OrderID, Sal, FName, LName, Address, ZipCode, Phone, Phone2, EMail, Or_City, Or_State, Dest_State, MoveDate, MoveType, Materials, IP, Domain, OrderTime from tbl_packing_orders Where OrderID='$ID'";
		
		$DataBase->query($strQuery);
     	$Record = $DataBase->fetch_all();     	
     	
	 	foreach($Record as $val)
	 	{
	   	  $OrderID = $val[0];
		  $Sal = $val[1];
		  $FName = $val[2];
		  $LName = $val[3];
		  $Address = $val[4];
		  $ZipCode = $val[5];
		  $Phone = $val[6];
		  $Phone2 = $val[7];
		  $EMail = $val[8];		  
		  $Or_City = $val[9];
		  $Or_State = $val[10];		  
		  $Dest_State = $val[11];
		  $MoveDate = $val[12];
		  $MoveType = $val[13];		  
		  $Materials = $val[14];
		  $IP = $val[15];
		  $Domain = $val[16];
		  $OrderTime = $val[17];
		  
		  if($MoveType == "1")
		  {
		    $MoveType = "Long Distance";
		  }
		  else
		  {
		    $MoveType = "Local";
		  }
  
		    $query = "SELECT `city` FROM `cities` WHERE `CityID`='$Or_City' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 2");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$OriginCity = $line[city];			
		
			$query = "SELECT `name` FROM `states` WHERE `StateID`='$Or_State' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 4");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$OriginState = $line[name];
			
			$query = "SELECT `name` FROM `states` WHERE `StateID`='$Dest_State' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 5");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$DestState = $line[name];
		  
	  		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >";

			echo "<tr>
					<td align=\"right\"><b> LeadID:</b></td>
					<td>$OrderID</td>
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
					<td>$OriginCity, $OriginState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Destination Location:</b></td>
					<td>$DestState</td>
				</tr>		
				<tr>
					<td align=\"right\"><b>Date of Move:</b></td>
					<td>$MoveDate</td>
				</tr>		
				<tr>
					<td align=\"right\"><b>Type of Move:</b></td>
					<td>$MoveType</td>
				</tr>		
				<tr>
					<td align=\"right\"><b>Materials:</b></td>
					<td>$Materials</td>
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
					<td align=\"right\"><b>Time / Date of Lead:</b></td>
					<td>$OrderTime</td>
				</tr>";		 		  
		 
			}
	}

	
	if ($OrderType == "storage")
	{
		echo "<h2>Lead Details for Lead # $ID&nbsp; </h2> 
          <br><br>";	
	
		$strQuery = "Select OrderID, Sal, FName, LName, Address, ZipCode, Phone, Phone2, EMail, Or_City, Or_State, Dest_State, SDate, EDate, MoveType, StorageSize, IP, Domain, OrderTime from tbl_storage_orders Where OrderID='$ID'";
		
		$DataBase->query($strQuery);
     	$Record = $DataBase->fetch_all();     	
     	
	 	foreach($Record as $val)
	 	{
	   	  $OrderID = $val[0];
		  $Sal = $val[1];
		  $FName = $val[2];
		  $LName = $val[3];
		  $Address = $val[4];
		  $ZipCode = $val[5];
		  $Phone = $val[6];
		  $Phone2 = $val[7];
		  $EMail = $val[8];		  
		  $Or_City = $val[9];
		  $Or_State = $val[10];		  
		  $Dest_State = $val[11];
		  $SDate = $val[12];
		  $EDate = $val[13];		  
		  $MoveType = $val[14];
		  $StorageSize = $val[15];
		  $IP = $val[16];
		  $Domain = $val[17];
		  $OrderTime = $val[18];
		  
		  if($MoveType == "1")
		  {
		    $MoveType = "Long Distance";
		  }
		  else
		  {
		    $MoveType = "Local";
		  }
  
		    $query = "SELECT `city` FROM `cities` WHERE `CityID`='$Or_City' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 2");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$OriginCity = $line[city];
					
			$query = "SELECT `name` FROM `states` WHERE `StateID`='$Or_State' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 4");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$OriginState = $line[name];
			
			$query = "SELECT `name` FROM `states` WHERE `StateID`='$Dest_State' LIMIT 1";
			$result = mysql_query($query) or die("Query failed: 5");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$DestState = $line[name];
		  
	  		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >";

			echo "<tr>
					<td align=\"right\"><b> LeadID:</b></td>
					<td>$OrderID</td>
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
					<td>$OriginCity, $OriginState</td>
				</tr>
				<tr>
					<td align=\"right\"><b>Destination Location:</b></td>
					<td>$DestState</td>
				</tr>		
				<tr>
					<td align=\"right\"><b>Start Date of Storage:</b></td>
					<td>$SDate</td>
				</tr>			
				<tr>
					<td align=\"right\"><b>End Date of Move:</b></td>
					<td>$EDate</td>
				</tr>	
				<tr>
					<td align=\"right\"><b>Storage Size:</b></td>";
        $Storage = "";
        if($StorageSize== "1")
        {
            $Storage = "A Studio";
         }
        if($StorageSize== "2")
        {
            $Storage = "1 Bedroom";
         }
        if($StorageSize== "3")
        {
            $Storage = "2 Bedrooms";
         }
         if($StorageSize== "4")
        {
            $Storage = "3 Bedrooms";
         }
         if($StorageSize== "5")
        {
            $Storage = "4 Bedrooms";
         }
         if($StorageSize== "6")
        {
            $Storage = "Larger than 4 Bedrooms";
         }
	echo		"<td>$Storage</td>
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
					<td align=\"right\"><b>Time / Date of Lead:</b></td>
					<td>$OrderTime</td>
				</tr>";		 
		  
		  
			}
	}

	echo "<tr><td align=\"right\">&nbsp;</td><td>";
	echo "<br><input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='jobs.php?ID=$ID&SearchString=$SearchString&count=$count&offset=$offset&OrderType=$Type&Mod=$Mod'\">";
	echo "</td></tr></table><br><br>";
?> 



<?
   include "footer.php";
?>
