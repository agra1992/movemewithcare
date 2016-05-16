<?
  session_start();
   include "Security.php";

    $uploaddir = '../link_images/';
    $before = $uploaddir.$_POST[LOGO];
    $link_number=$_POST[link_number];
    if (file_exists($before) && $before != 'logos/NoLogo.gif')
    {
    	unlink($before);
    }
    $realname = uniqid(rand()).substr($HTTP_POST_FILES['UL']['name'], -4);
    $uploadfile = $uploaddir . $realname;    

   	if (move_uploaded_file($HTTP_POST_FILES['UL']['tmp_name'], $uploadfile)) 
   	{
	  	$strQuery = "update links set Image = '$realname' where LinkID= '$link_number'";
	  	$result = mysql_query($strQuery) or die("Query failed90 $strQuery");  
   	}
   	@header("Location: edit_links.php?link_number=$link_number");
?>
