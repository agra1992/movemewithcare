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
function get_data($links, $link_number)
{

$sql="SELECT * from links WHERE LinkID='$link_number'";

$r=mysql_query($sql);
    while($result=mysql_fetch_row($r))
    {
        $links=$result;
    }
}

function update_data()
{

$link_number=$_GET['link_number'];  
$URL=$_POST[URL];
$Type=$_POST[Type];
$Country=$_POST[Country];
$Name=$_POST[Name];
$Active=$_POST[Active];
$sql="Update links SET URL='$URL', Country='$Country', Type='$Type', CompanyName='$Name',Active='$Active' WHERE LinkID='$link_number'";
if($r=mysql_query($sql))
{
    echo"The Information has been Updated";
}
}
?>

<?
		
$link_number=$_GET['link_number'];  
if($_POST[submit_form]==true){
update_data();}
echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a>><a href='links.php'> Manage Links</a> > Edit Link ";
$links=array();
get_data(&$links, $link_number);
$active="";
$disabled="";
if($links[6] ==1)
{
    $active="selected";
}
else{
    $disabled="selected";
}
echo"<table border='1'>

    <form action='edit_links.php?link_number=".$links[0]."' method='post'>
        <tr><td>link Number</td><td>'".$links[0]."'</td></tr>
        <tr><td>URL(If Misc just enter all the code here)</td><td colspan='3'>http://<input type='text' value='".$links[1]."' name='URL'></td></tr>

        <tr><td>Company Name</td><td colspan='3'><input type='text' value='".$links[5]."' name='Name'></td></tr>

            <tr><td>Type</td><td colspan='3'>
                <select name='Type' size='3'>
                    <option value='".$links[4]."'  selected>".$links[4]."</option>
                    <option value='transport'>Transport</option>
                    <option value='packing'>Packing</option>
                    <option value='storage'>Storage</option>
                    <option value='misc'>Miscellaneous</option>
                </select></td></tr>
            <tr><td>Country</td><td>
                <select name='Country' size='2'>
                    <option value='".$links[3]."'  selected>".$links[3]." </option>
                    <option value='usa'>USA</option>
                    <option value='canada'>Canada</option>
                </select></td></tr>
            <tr><td>Enabled</td><td>
                <select name='Active' size='2'>
                    <option value='1' $active>Enable</option>
                    <option value='0' $disabled>Disable</option>
                </select></td></tr>

        <tr><td><input type='submit' value='Update'></td></tr>

        <input type='hidden' value='true' name='submit_form'>
    </form>

    <form action='upload_link_image.php' method='post' enctype='multipart/form-data'>
	<input type='hidden' name='MAX_FILE_SIZE' value='25000000'>
	<input type='hidden' name='link_number' value='".$links[0]."'>
	<input type='hidden' name='LOGO' value='<?=$LOGO?>'>

        <tr><td>Upload Image</td><td><input name='UL' type='file' size ='30'></td><td>	<input type='submit' name='Submit' value='Upload' onclick='return validate();' class='button'></td></tr>
    </form>

    <tr><td>Current Image</td><td><img src='../link_images/".$links[2]."'></td></tr>
    <tr><td><a href='links.php'>Go Back</a></td></tr>


</table>";
?>
<?
   include "footer.php";
?>
  
   
   