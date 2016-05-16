<?
  session_start();
  include "Security.php"; 
  include "config.inc.php";	
    
    $uploaddir = 'logos/';
    $before = $uploaddir.$_POST[LOGO];
  
    if (file_exists($before) && $before != 'logos/NoLogo.gif')
    {
    	unlink($before);
    }
    $realname = uniqid(rand()).substr($HTTP_POST_FILES['UL']['name'], -4);
    $uploadfile = $uploaddir . $realname;    

   	if (move_uploaded_file($HTTP_POST_FILES['UL']['tmp_name'], $uploadfile)) 
   	{
	  	$strQuery = "update tblmembers set Logo = '$realname' where MemberID =" . $_SESSION['Member_Id'];
	  	$result = mysql_query($strQuery) or die("Query failed90");  
   	}
   	@header("Location: update_details.php");
?>
