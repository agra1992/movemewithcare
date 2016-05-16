<?php
   session_start(); 
   
	session_register('Member_Id'); 
	session_register('Member_Login');        
	session_register('Member_Pass');
	session_register('Member_Email');
	session_register('Member_Name');
	session_register('Member_Contact');
	session_register('Member_Phone');
	session_register('Member_Type');


    error_reporting(0);
	require("../../config.inc.php");

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");


 $strPassword = CheckString($_POST['PASS']);
 $strLogin    = CheckString($_POST['LOGIN']);
 
 $strQuery  = "SELECT MemberID,MemberName,ContactPerson,ContactEmail,Login,pass,Phone,MemberType
				  FROM tblmembers 
	             WHERE Login='$strLogin' AND pass='$strPassword' AND Active = '1'
	             AND (MemberType = 'standard' or MemberType = 'full' or MemberType='market')";
			   
 $result = mysql_query($strQuery) or die ("Error");
 $line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	$Member_Id   = $line[MemberID];
	$Member_Login = $line[Login];
	$Member_Pass  = $line[pass];
	$Member_Email     = $line[ContactEmail];
	$Member_Name      = $line[MemberName];
	$Member_Contact     = $line[ContactPerson];
	$Member_Phone      = $line[Phone];
	$Member_Type      = $line[MemberType];

    if( (strcmp($Member_Login,$strLogin)==0)  && (strcmp($Member_Pass,$strPassword)==0) )
	 {
	  $_SESSION['Member_Id'] = $Member_Id;
	  $_SESSION['Member_Login'] = $Member_Login;
	  $_SESSION['Member_Pass'] = $Member_Pass;
	  $_SESSION['Member_Email'] = $Member_Email;
	  $_SESSION['Member_Name'] = $Member_Name;
	  $_SESSION['Member_Contact'] = $Member_Contact;
	  $_SESSION['Member_Phone'] = $Member_Phone;
	  $_SESSION['Member_Type'] = $Member_Type;	

	    $strHeader = "../../basa.php";
	 
	 }	
    else
	 {  
        
		$strHeader = "../mem.php?nErr=1";
	 }	

    @header("Location: ".$strHeader);
	exit;

function CheckString($strString)
{
	$strString = str_replace("'", "''", $strString);
	$strString = str_replace("\'", "'", $strString);
	$strString = str_replace("\\", "", $strString);

	return $strString;
}

?>