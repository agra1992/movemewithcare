<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   //error_reporting(0);
   


?>

<?


function input_data($links)
{

$sql="Insert INTO accred_assoc (Link, Name) VALUES ('".$links[0]."','".$links[1]."')";
$r=mysql_query($sql);

}

?>


<?
		

if($_POST["action"] == "Add")
{


$link_number="";
$links=array();
$links[0] = $_POST[Link];
$links[1] = $_POST[Name];

input_data($links);

echo"Accredited Association added <a href='http://movemewithcare.com/EManager/accred_assoc.php'>go back</a> to Accredited Associations";








}else{
    echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a>><a href='accred_assoc.php'> Manage Accred Assoc</a> > Add Accred Assoc ";

echo"
<table>

<form method='POST' enctype='multipart/form-data' name='image_upload_form' action='".$_SERVER['PHP_SELF']."'>

            <tr><td>URL</td><td colspan='3'>http://<input type='text' value='' name='Link'></td></tr>
            <tr><td>Company Name</td><td colspan='3'><input type='text' value='' name='Name'></td></tr>
<tr><td>
<input type='submit' value='Add' name='action'></td></tr>
</form>
</table>
";

}


   include "footer.php";
?>
  
   
   