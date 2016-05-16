<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   error_reporting(0);
   

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
function get_data($adds, $add_number)
{

$sql="SELECT * from add_manager WHERE Add_Number='$add_number'";
$r=mysql_query($sql);
    while($result=mysql_fetch_row($r))
    {
        $adds=$result;
    }
}

function update_data()
{
$add_number=$_GET['add_number'];  
$Link=$_POST[Link];
$Description=$_POST[Description];
$sql="Update add_manager SET Link='$Link', Description='$Description' WHERE Add_Number='$add_number'";
if($r=mysql_query($sql))
{
    echo"The Information has been Updated";
}
}
?>

<?
		
$add_number=$_GET['add_number'];  
if($_POST[submit_form]==true){
update_data();}
echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a>><a href='advertise.php'> Manage Adevertisers</a> > Edit Advertiser ";
$adds=array();
get_data(&$adds, $add_number);

echo"<table border='1'>

    <form action='edit_advertise.php?add_number=".$adds[0]."' method='post'>
        <tr><td>Add Number</td><td>".$adds[0]."</td></tr>
        <tr><td>Description</td><td colspan='3'><textarea name='Description'>".$adds[1]."</textarea></td></tr>
        <tr><td>Link</td><td colspan='3'><input type='text' value='".$adds[2]."' name='Link'></td></tr>
        <tr><td><input type='submit' value='Update'></td></tr>
        <input type='hidden' value='true' name='submit_form'>
    </form>

    <form action='upload_image.php' method='post' enctype='multipart/form-data'>
	<input type='hidden' name='MAX_FILE_SIZE' value='25000000'>
	<input type='hidden' name='Add_Number' value='".$adds[0]."'>
	<input type='hidden' name='LOGO' value='<?=$LOGO?>'>

        <tr><td>Upload Image</td><td><input name='UL' type='file' size ='30'></td><td>	<input type='submit' name='Submit' value='Upload' onclick='return validate();' class='button'></td></tr>
    </form>

    <tr><td>Current Image</td><td><img src='../adds/".$adds[3]."'></td></tr>
    <tr><td><a href='advertise.php'>Go Back</a></td></tr>


</table>";
?>
<?
   include "footer.php";
?>
  
   
   