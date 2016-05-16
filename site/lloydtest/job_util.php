<?

  /*************** Same States ****************************************/
  
  function SameStateAvail_Accept($MAID) //if job accepted or not by current member
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction 
	         Where
             tblmemberaction.`MAID` = $MAID AND
             tblmemberaction.Accept = '0' 
			 AND tblmemberaction.`MID` =" . $_SESSION['Member_Id'];
		
	 $result_newQuery = mysql_query($str) or die("Query failed1");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 
	 if (count($result) > 0)
	 {
	    return 1;
	 }
	 else
	 {
	   return 0;
	 }
  }

  function SameStateJob_MemberPosted($MAID)  //if job reposted by current member
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction 
	         Where
             tblmemberaction.`MAID` = $MAID AND
             tblmemberaction.Repost = '1' 
			 AND tblmemberaction.`MID` =" . $_SESSION['Member_Id'];
		 
	 $result_newQuery = mysql_query($str) or die("Query failed2");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 
	 if (count($result) > 0)
	 {
	    return 1;
	 }
	 else
	 {
	   return 0;
	 }
  }
  
  function SameStateJob_Avail($JID) // if any member has not accepted the job
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction Where
              tblmemberaction.JobID = $JID AND tblmemberaction.Accept = '1'";
		 
	 $result_newQuery = mysql_query($str) or die("Query failed3");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 //echo $result;
     if ($result == NULL)
	 {
	    return 1;
	 }
	 else
	 {
	   return 0;
	 }
  }
  
  function SameStateJob_Accept($JID) // if current member has accepted the job
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction Where
              tblmemberaction.JobID = $JID AND tblmemberaction.Accept = '1' AND tblmemberaction.MID =" . $_SESSION['Member_Id'];
		 
	 $result_newQuery = mysql_query($str) or die("Query failed4");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 //echo $result;
     if ($result == NULL)
	 {
	    return 0;
	 }
	 else
	 {
	   return 1;
	 }
  }
  
  /*************** End Same States ****************************************/
  
  /*************** Different States ****************************************/
  
  function DiffStateAvail_AcceptOrigin($JobID) //if job accepted or not by any member at Origin
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction
             Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
                Where tbljobs_location.Origin = '1' AND
                  tblmemberaction.JobID = $JobID AND tblmemberaction.MID !=" . $_SESSION['Member_Id'];
		
	 $result_newQuery = mysql_query($str) or die("Query failed5");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 
	 if (count($result) > 0)
	 {
	    return 1;
	 }
	 else
	 {
	   return 0;
	 }
  }
  
  function DiffStateAvail_AcceptMemberOrigin($JobID) //if job accepted or not by current member at Origin
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction
             Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
                Where tbljobs_location.Origin = '1' AND
                  tblmemberaction.JobID = $JobID AND tblmemberaction.MID =" . $_SESSION['Member_Id'];
		
	 $result_newQuery = mysql_query($str) or die("Query failed6");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 
	 if (count($result) > 0)
	 {
	    return 1;
	 }
	 else
	 {
	   return 0;
	 }
  }
  
  function DiffStateAvail_AcceptDest($JobID) //if job accepted or not by any member at Dest
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction
             Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
                Where tbljobs_location.Destination = '1' AND
                  tblmemberaction.JobID = $JobID AND tblmemberaction.MID !=" . $_SESSION['Member_Id'];
		
	 $result_newQuery = mysql_query($str) or die("Query failed7");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 
	 if (count($result) > 0)
	 {
	    return 1;
	 }
	 else
	 {
	   return 0;
	 }
  }
  
  function DiffStateAvail_AcceptMemberDest($JobID) //if job accepted or not by current member at Dest
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction
             Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
                Where tbljobs_location.Destination = '1' AND
                  tblmemberaction.JobID = $JobID AND tblmemberaction.MID =" . $_SESSION['Member_Id'];
		
	 $result_newQuery = mysql_query($str) or die("Query failed8");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 
	 if (count($result) > 0)
	 {
	    return 1;
	 }
	 else
	 {
	   return 0;
	 }
  }
  
  function DiffStateJob_Avail_Origin($JID) // if any member has not accepted the job at origin
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction
                  Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
              Where tblmemberaction.JobID = $JID AND tbljobs_location.Origin = '1'";
		 
	 $result_newQuery = mysql_query($str) or die("Query failed9");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 //echo $result;
     if ($result == NULL)
	 {
	    return 1;
	 }
	 else
	 {
	   return 0;
	 }
  }
  
  function DiffStateJob_Avail_Dest($JID) // if any member has not accepted the job at Dest
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction
                  Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
              Where tblmemberaction.JobID = $JID AND tbljobs_location.Destination = '1'";
		 
	 $result_newQuery = mysql_query($str) or die("Query failed10");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 //echo $result;
     if ($result == NULL)
	 {
	    return 1;
	 }
	 else
	 {
	   return 0;
	 }
  }
  
  function DiffStateJob_Accept_Gen1($JID) // if current member has accepted the job at Origin
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction
              Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
               Where
                  tblmemberaction.JobID = '$JID'  AND tbljobs_location.Origin = '1' AND 
				      tblmemberaction.`MID` =" . $_SESSION['Member_Id'];
		 
	 $result_newQuery = mysql_query($str) or die("Query failed11");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 //echo $result;
     if ($result == NULL)
	 {
	    return 0;
	 }
	 else
	 {
	   return 1;
	 }
  }
  
   function DiffStateJob_Accept_Gen2($JID) // if current member has accepted the job at Dest
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction
              Inner Join tbljobs_location ON tblmemberaction.MAID = tbljobs_location.MAID
               Where
                  tblmemberaction.JobID = '$JID'  AND tbljobs_location.Destination = '1' AND 
				      tblmemberaction.`MID` =" . $_SESSION['Member_Id'];
		 
	 $result_newQuery = mysql_query($str) or die("Query failed12");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];
 //echo $result;
     if ($result == NULL)
	 {
	    return 0;
	 }
	 else
	 {
	   return 1;
	 }
  }
  /*************** End Different States ****************************************/
  
  /*************** Repost Determination ***********************************/
  
  function RepostCount($JID) // if current member has accepted the job at Dest
  {
     global $link;

	 $str = "Select tblmemberaction.MAID From tblmemberaction Where
                   tblmemberaction.Repost = '1' AND tblmemberaction.JobID = '$JID'
                   AND tblmemberaction.`MID` =" . $_SESSION['Member_Id'];
		 
	 $result_newQuery = mysql_query($str) or die("Query failed12_Repost");
     $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
     $result = $line[MAID];

     if ($result == NULL)
	 {
	    return 0;
	 }
	 else
	 {
	   return 1;
	 }
  }
  
  /*************** End Repost Determination ****************************************/
?>