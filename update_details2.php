<?php
  session_start();
  include "Security.php"; 
  error_reporting(0);
require("sanitize.php");
  
  $CP = $_POST['CP'];
  $CE = $_POST['CE'];
  $CPhone = $_POST[Cphone_one].$_POST[Cphone_two].$_POST[Cphone_three]." ext.".$_POST[Cphone_four];
  $CPass = $_POST['CPass'];
  $List_Ass = $_POST['List_Ass'];
  $List_SC = $_POST['List_SC'];
  $or_state = $_POST['or_state'];
  $selcities = $_POST['or_city'];
  

  $sms_address="";
  $sms_service=$_POST[sms_service];
  if($sms_service =="yes")
  {
      $sms_address=sanitize($_POST[sms_phone],10,0);
      $sms_address.="@".$_POST[sms_company];
  }


  if ($_SESSION['Member_Type'] == 'standard')
  {
	  if (!empty($selcities))
	  {    
		$str = "Delete from tblmember_servicecity where MID =" . $_SESSION['Member_Id'];
	    $result= mysql_query($str) or die("Query failed23*");
	    
		foreach($selcities as $city)
		  {
			$str = "Select StateID from cities where CityID = '$city'";
			$result= mysql_query($str) or die("Query failed233*");
		    $line0 = mysql_fetch_array($result, MYSQL_ASSOC);
			$SID = $line0[StateID];		
			if($SID > 0)
			{
				 $str = "INSERT INTO `tblmember_servicecity` (`StateID`, `CityID`, `MID`, `DateAdded`)
	   		                VALUES ('$SID','$city','$_SESSION[Member_Id]', CURRENT_TIMESTAMP)";						
				  $result= mysql_query($str) or die("Query failed23");
			}
		 }
	  }
  }
  else if ($_SESSION['Member_Type'] == 'full')
  {
  	$str = "Delete from tblmember_servicecity where MID =" . $_SESSION['Member_Id'];
	$result= mysql_query($str) or die("Query failed23*");	
	if ($or_state == 999)
	{
		$sql = "SELECT StateID from states WHERE StateID!=999 AND StateID!=68";
		$result = mysql_query($sql) or die("Query failed8");
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$sid = $line[StateID];
			$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`, `DateAdded`) VALUES ('$_SESSION[Member_Id]','$sid',CURRENT_TIMESTAMP)";
			$result = mysql_query($sql) or die("Query failed8");
		}
	}
	else
	{
		$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`, `DateAdded`) VALUES ('$_SESSION[Member_Id]','$or_state',CURRENT_TIMESTAMP)";
		$result = mysql_query($sql) or die("Query failed8");
	}	    
  }
  $List_States = explode(",",$List_States);
  $List_Cities = explode(",",$List_Cities);

  $str = "Select sh_name from states where StateID = '$or_state'";
  $result= mysql_query($str) or die("Query failed233ddd*");
  $line = mysql_fetch_array($result, MYSQL_ASSOC);
  $sh_name = $line['sh_name']; 
  
  $str = "Select ZipCode from tblmembers where MemberID = '" . $_SESSION['Member_Id'] ."'";
  $result= mysql_query($str) or die("Query failed*");
  $line = mysql_fetch_array($result, MYSQL_ASSOC);
  $zipcode = $line['ZipCode'];
  $temp = explode(" ", $zipcode);
  $temp[0] = $sh_name;
  $zipcode = $temp[0] . " " . $temp[1];
  
  
  $strQuery = "update tblmembers set 
		ContactPerson = '$CP',
		Phone = '$CPhone',
		ContactEmail = '$CE ',
		pass = '$CPass',
		ZipCode = '$zipcode',
		Associations = '$List_Ass',
		sms_service = '$sms_service',
		sms_address = '$sms_address'
		where MemberID =" . $_SESSION['Member_Id'];
		
   $result_newQuery = mysql_query($strQuery) or die("Query failed23*3");
   
        session_unset("Member_Id");
        unset($Member_Id);
        	
        session_unset("Member_Login");
        unset($Member_Login);
		
		session_unset("Member_Pass");
        unset($Member_Pass);
		
		session_unset("Member_Email");
        unset($Member_Email);
		
		session_unset("Member_Name");
        unset($Member_Name);
		
		session_unset("Member_Contact");
        unset($Member_Contact);
		
		session_unset("Member_Phone");
        unset($Member_Phone);
        
		$Member_Id = "";
        $Member_Login = "";
		$Member_Pass = "";
        $Member_Email = "";
		$Member_Name = "";
        $Member_Contact = "";
		$Member_Phone = "";

        session_destroy();
  
   @header("Location: locator/mem.php?login=2");
   exit;

?>