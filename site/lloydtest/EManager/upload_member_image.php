<?
  session_start();
   include "Security.php";

    $uploaddir = '../logos/';
    $before = $uploaddir.$_POST[LOGO];
    $ID=$_POST[ID];
    if (file_exists($before) && $before != 'logos/NoLogo.gif')
    {
    	unlink($before);
    }
    $realname = uniqid(rand()).substr($HTTP_POST_FILES['UL']['name'], -4);
    $uploadfile = $uploaddir . $realname;    

   	if (move_uploaded_file($HTTP_POST_FILES['UL']['tmp_name'], $uploadfile)) 
   	{
	  	$strQuery = "update tblmembers set Logo = '$realname' where MemberID= '$ID'";
	  	$result = mysql_query($strQuery) or die("Query failed90 $strQuery");  

   	}
   	@header("Location: http://movemewithcare.com/EManager/affiliates.php");
?>
