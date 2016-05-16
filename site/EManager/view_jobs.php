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
	$MType   = $Record[1];
	$CPerson     = $Record[2];
	$CEMail 	  = $Record[3];

?>

 <div align="left"><a href="EManager.php">EManager(Home)</a> > 
   <a href="members.php?nSearchCrit=<?=$nSearchCrit?>&SearchString=<?=$SearchString?>&count=<?=$count?>&offset=<?=$offset?>&Mod=<?=$Mod?>&Type=<?=$Type?>">Manage Members</a> > View Jobs assigned to <? echo "$MName ($CPerson)" ?></div>
	<br><br>


<?       
   echo "<h2>Jobs Assigned to $MName ($CPerson)</h2>
          <br><br>";
     
?>  

<script language="JavaScript">
  
  var SpdWindowOpen;
  
  function spWindowOpen(id)
  {  
	SpdWindowOpen=window.open('print_page.php?PageType=LUPUJobs&ID='+id,'newwSp','status=yes,scrollbars=yes,width=600,height=600,left=10,top=20')
  }
  
  var SpdWindowOpen1;
  
  function spWindowOpen1(id)
  {  
	SpdWindowOpen1=window.open('print_page.php?PageType=FSJobs&ID='+id,'newwSp','status=yes,scrollbars=yes,width=600,height=600,left=10,top=20')
  }

</script>       

<?
   // ************************ LUPU ****************************************
if($MType == "standard")
{
   echo "<h3>LUPU&nbsp; <a href=\"javascript:spWindowOpen($ID);\" 
            title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></a></h3> 
          <br><br>";
		  
    $str = "Select `OrderID`, `MoveDate`
            From tbl_lupu_orders
             Where Origin_MID = '$ID' OR
                Dest_MID='$ID'";
				
	$result = mysql_query($str) or die("Query failed2 $str");
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
 		  $Date = $val[1]; 
		  
		  echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" >
		        <tr>
					<td>
					 Order # <a href=\"order_details.php?OrderID=$OrderID&type=LUPU\" 
					 title=\"Click here to view Order Details\" target=\"_blank\">$OrderID</a> on $Date</td>
				</tr>
				</table>";
		  
		}
	}
	else
	{
	  echo "<h3>No Jobs Assigned to this member Under LUPU Category</h3><br><br>";
	}
}
	// ************************ FULL SERVICE ****************************************
if($MType == "full")
{
	echo "<h3>FULL SERVICE&nbsp; 
	     <a href=\"javascript:spWindowOpen1($ID);\" title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></a></h3> 
          <br><br>";
		  
	$str = "Select tblorders_jobs.JobID, tblorders_jobs.`Date`, tblorders_jobs.OJID, tbljobs_members_fs.JMID, tblorders_jobs.OrderID
             From tblorders_jobs Inner Join tbljobs_members_fs ON tblorders_jobs.JobID = tbljobs_members_fs.JID
             Where tblorders_jobs.OrderType = 'FS' AND
               tbljobs_members_fs.`MID` = $ID";
				
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
					 Order # <a href=\"order_details.php?OrderID=$OrderID&type=FS\" 
					 title=\"Click here to view Order Details\" target=\"_blank\">$OrderID</a> on $JobDate</td>
				</tr>
				</table>";
		  
		}
	}
	else
	{
	  echo "<h3>No Jobs Assigned to this member Under Full Service Category</h3><br><br>";
	}
	
}	  
	 
?>

<?
   include "footer.php";
?>
  
   
   