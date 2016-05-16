<?php
  session_start();
  include "Security.php"; 
 error_reporting(0);
require("sanitize.php");
  
  $CP = $_POST['CP'];
  $CE = $_POST['CE'];
  $CPhone = $_POST[Cphone_one].$_POST[Cphone_two].$_POST[Cphone_three]." ext.".$_POST[Cphone_four];
  $CPass = $_POST['CPass'];
  $or_state = $_POST['or_state'];
  $selcities = $_POST['or_city'];
  $type=$_POST['type'];

  $sms_address="";
  $sms_service=$_POST[sms_service];
  if($sms_service =="yes")
  {
      $sms_address=sanitize($_POST[sms_phone],10,0);
      $sms_address.="@".$_POST[sms_company];
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
		sms_service = '$sms_service',
		sms_address = '$sms_address'
		where MemberID =" . $_SESSION['Member_Id'];
		
   $result_newQuery = mysql_query($strQuery) or die("Query failed24*3 $strQuery");
  $strQuery = "update tblmarket set 
		MemberType= '$type'
		where MID =" . $_SESSION['Member_Id'];

   $result_newQuery = mysql_query($strQuery) or die("Query failed25*3");
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