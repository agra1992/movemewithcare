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
   
   $strQuery = "Select tblmembers.MemberName, tblmembers.MemberType, tblmembers.ContactPerson, tblmembers.ContactEmail
                    From tblmembers Where
                     tblmembers.MemberID = '$ID'";
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$MName 	  = $Record[0];
	$MType 		= $Record[1];
	$CPerson     = $Record[2];
	$CEMail 	  = $Record[3];
	
	if ($Type == '')
	{
		if ($MType == "transport")
		{
			$Type = 1;
		}
		else if ($MType == "packing")
		{
			$Type = 2;
		}		
		else if ($MType == "storage")
		{
			$Type = 3;
		}		
	}

?>

 <div align="left"><a href="EManager.php">EManager(Home)</a> > 
   <a href="affiliates.php?nSearchCrit=<?=$nSearchCrit?>&SearchString=<?=$SearchString?>&count=<?=$count?>&offset=<?=$offset?>&Mod=<?=$Mod?>&Type=<?=$Type?>">Manage Affiliates</a> > View Jobs assigned to <? echo "$MName ($CPerson)" ?></div>
	<br><br>


<?       
   echo "<h2>Jobs Assigned to $MName ($CPerson)</h2>
          <br><br>";
     
?>  

<script language="JavaScript">
  
  var SpdWindowOpen;
  
  function spWindowOpen(id)
  {  
	SpdWindowOpen=window.open('print_page.php?PageType=TransportJobs&ID='+id,'newwSp','status=yes,scrollbars=yes,width=600,height=600,left=10,top=20')
  }
  
  var SpdWindowOpen1;
  
  function spWindowOpen1(id)
  {  
	SpdWindowOpen1=window.open('print_page.php?PageType=PackingJobs&ID='+id,'newwSp','status=yes,scrollbars=yes,width=600,height=600,left=10,top=20')
  }
  
  var SpdWindowOpen2;
  
  function spWindowOpen2(id)
  {  
	SpdWindowOpen1=window.open('print_page.php?PageType=StorageJobs&ID='+id,'newwSp','status=yes,scrollbars=yes,width=600,height=600,left=10,top=20')
  }

</script>       

<?

	// ************************ Transport ****************************************
if($Type == 1)
{
	echo "<br><br>";
	echo "<h3>Transportation&nbsp; 
	     <a href=\"javascript:spWindowOpen($ID);\" title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></a></h3> 
          <br><br>";
		  
	$str = "Select tblorders_jobs.JobID, tblorders_jobs.`Date`, tblorders_jobs.OJID, tbljobs_members_transport.JMID, tblorders_jobs.OrderID
             From tblorders_jobs Inner Join tbljobs_members_transport ON tblorders_jobs.JobID = tbljobs_members_transport.JID
             Where tbljobs_members_transport.`MID` = $ID";
				
	$result = mysql_query($str) or die("Query failed22");
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
	else
	{
	  echo "<h3>No Jobs Assigned to this affiliate Under Transport Category</h3><br><br>";
	}
	
}	  
  
   // ************************ Packing ****************************************
if($Type == 2)
{
	echo "<br><br>";
	echo "<h3>Packing&nbsp; 
	     <a href=\"javascript:spWindowOpen1($ID);\" title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></a></h3> 
          <br><br>";
		  
	$str = "Select tblorders_jobs.JobID, tblorders_jobs.`Date`, tblorders_jobs.OJID, tbljobs_members_packing.JMID, tblorders_jobs.OrderID
             From tblorders_jobs Inner Join tbljobs_members_packing ON tblorders_jobs.JobID = tbljobs_members_packing.JID
             Where tbljobs_members_packing.`MID` = $ID";
				
	$result = mysql_query($str) or die("Query failed22");
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
	else
	{
	  echo "<h3>No Jobs Assigned to this affiliate Under Packing Category</h3><br><br>";
	}
	
}
  
   // ************************ Storage ****************************************
if($Type == 3)
{
	echo "<br><br>";
	echo "<h3>Storage&nbsp; 
	     <a href=\"javascript:spWindowOpen2($ID);\" title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></a></h3> 
          <br><br>";
		  
	$str = "Select tblorders_jobs.JobID, tblorders_jobs.`Date`, tblorders_jobs.OJID, tbljobs_members_storage.JMID, tblorders_jobs.OrderID
             From tblorders_jobs Inner Join tbljobs_members_storage ON tblorders_jobs.JobID = tbljobs_members_storage.JID
             Where tbljobs_members_storage.`MID` = $ID";
				
	$result = mysql_query($str) or die("Query failed22");
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
	else
	{
	  echo "<h3>No Jobs Assigned to this affiliate Under Storage Category</h3><br><br>";
	}	
}
	 
?>

<?
   include "footer.php";
?>
  
   
   