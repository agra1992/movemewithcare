<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   //error_reporting(0);
   

   $LOGO = $_GET['LOGO'];
?>
<script language='Javascript' type='text/javascript'>
function validate()
{
	if (document.form1.UL.value == "")
	{
		alert("Please specify your logo file.")
		return false;
	}
	return true;
}   
</script>
<?


function input_data($links)
{

$sql="Insert INTO links (URL, Type, Country, Image, CompanyName) VALUES ('".$links[0]."','".$links[1]."','".$links[2]."','".$links[3]."','".$links[4]."')";
$r=mysql_query($sql);

}

?>


<?
		

if($_POST["action"] == "Add")
{


unset($imagename);

if(!isset($_FILES) && isset($HTTP_POST_FILES))
$_FILES = $HTTP_POST_FILES;

    $imagename = uniqid(rand()).substr($HTTP_POST_FILES['UL']['name'], -4);

$newimage = "../link_images/" . $imagename;
//echo $newimage;
$result = @move_uploaded_file($_FILES['UL']['tmp_name'], $newimage);
if(empty($result))
$error["result"] = "There was an error moving the uploaded file.";



$link_number="";
$links=array();
$links[0] = $_POST[Link];
$links[1] = $_POST[Type];
if($links[1]=="misc" || $_POST[text_only] == "yes")
{
$links[3] = "";
}else{
$links[3] = $imagename;
}
$links[2] = $_POST[Country];
$links[4] = $_POST[Name];

input_data($links);

echo"link added <a href='http://movemewithcare.com/EManager/links.php'>go back</a> to links";








}else{
    echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a>><a href='links.php'> Manage Links</a> > Add link ";

echo"
<table>

<form method='POST' enctype='multipart/form-data' name='image_upload_form' action='".$_SERVER['PHP_SELF']."'>

            <tr><td>URL (If Misc just enter all the code here)</td><td colspan='3'>http://<input type='text' value='' name='Link'></td></tr>
            <tr><td>Company Name</td><td colspan='3'><input type='text' value='' name='Name'></td></tr>
            <tr><td>Type</td><td colspan='3'>
                <select name='Type' size='4'>
                    <option value='transport'>Transport</option>
                    <option value='packing'>Packing</option>
                    <option value='storage'>Storage</option>
                    <option value='misc'>Miscellaneous</option>
                </select></td></tr>
            <tr><td>Country</td><td>
                <select name='Country' size='2'>
                    <option value='usa'>USA</option>
                    <option value='canada'>Canada</option>
                </select></td></tr>
            <tr><td>Is this a text only link? <input type='radio' name='text_only' value='yes'>Yes  <input type='radio' name='text_only' value='no' checked>No</td></tr>
	    <tr><td><input type='hidden' name='MAX_FILE_SIZE' value='25000000'>
<input type='file' name='UL' size='20'>
<input type='submit' value='Add' name='action'></td></tr>
</form>
</table>
";

}


   include "footer.php";
?>
  
   
   