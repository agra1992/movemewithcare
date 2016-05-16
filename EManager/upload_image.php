<?
  session_start();
   include "Security.php";

    $uploaddir = '../adds/';
    $before = $uploaddir.$_POST[LOGO];
    $add_number=$_POST[Add_Number];
    if (file_exists($before) && $before != 'logos/NoLogo.gif')
    {
    	unlink($before);
    }
    $realname = uniqid(rand()).substr($HTTP_POST_FILES['UL']['name'], -4);
    $uploadfile = $uploaddir . $realname;    

   	if (move_uploaded_file($HTTP_POST_FILES['UL']['tmp_name'], $uploadfile)) 
   	{
	  	$strQuery = "update add_manager set Image = '$realname' where Add_Number= '$add_number'";
	  	$result = mysql_query($strQuery) or die("Query failed90 $strQuery");  
   	}
   	@header("Location: edit_advertise.php?add_number=$add_number");
?>
