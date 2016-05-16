<?
  function DateUtil($DATE_VAR)
  {
    global $link,$var;
	
	$str = "Select tblorders_jobs.OrderID From tblorders_jobs Inner Join tbljobs ON tblorders_jobs.JobID = tbljobs.JobID
  				Where tblorders_jobs.`Date` Like '$DATE_VAR%' AND tbljobs.`MID` =" . $_SESSION['Member_Id'];
							  //echo $str;
	$result_str = mysql_query($str) or die("Query failed_Cal");
	$num_str = mysql_num_rows($result_str);
	if (!(empty($num_str)))
	 {
		$flag = "F";
	 }
	else
	{
		$flag = "NF";
	}
	
	return $flag;
	
  }
?>