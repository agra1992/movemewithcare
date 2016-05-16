<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   
   $JobID = $_GET['JobID'];
   $type = $_GET['type'];

   if($type == "LUPU")
	{
      echo "<h2>Job Log History for JOB # $JobID&nbsp; <a href=\"javascript:spWindowOpen($JobID);\" 
            title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></a></h3> 
          <br><br>";
	}

     
?>  

<script language="JavaScript">
  
  var SpdWindowOpen;
  
  function spWindowOpen(JobID)
  {  
	SpdWindowOpen=window.open('print_page.php?PageType=LUPUJob&ID='+JobID,'newwSp','status=yes,scrollbars=yes,width=750,height=600,left=10,top=20')
  }
  

</script>       

<?
    if($type == "LUPU")
	{
    		$str = "Select tbl_joblogs.LogID, tbl_joblogs.JLID, tbl_joblogs.`Action`, tbl_joblogs.ActionTime,
                      tblmembers.MemberName, tblmembers.ContactPerson
                       From tbl_joblogs
                          Inner Join tbljobs_location ON tbl_joblogs.JLID = tbljobs_location.JLID
                         Inner Join tblmemberaction ON tbljobs_location.MAID = tblmemberaction.MAID
                        Inner Join tblmembers ON tblmemberaction.`MID` = tblmembers.MemberID
                         Where tblmemberaction.JobID = '$JobID'
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
  
  } // LUPU
   
?>

<?
   include "footer.php";
?>
  
   
   