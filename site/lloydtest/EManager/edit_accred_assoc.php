<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   //error_reporting(0);
   

?>

<?
function get_data($links, $assoc_number)
{

$sql="SELECT * from accred_assoc WHERE AssocID='$assoc_number'";

$r=mysql_query($sql);
    while($result=mysql_fetch_row($r))
    {
        $links=$result;
    }
}

function update_data()
{

$assoc_number=$_GET['assoc_number'];  
$URL=$_POST[URL];
$Name=$_POST[Name];
$Active=$_POST[Active];
$sql="Update accred_assoc SET Link='$URL', Name='$Name',Active='$Active' WHERE AssocID='$assoc_number'";
if($r=mysql_query($sql))
{
    echo"The Information has been Updated";
}
}
?>

<?
		
$assoc_number=$_GET['assoc_number'];  
if($_POST[submit_form]==true){
update_data();}
echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a>><a href='accred_assoc.php'> Manage Accred Assoc</a> > Edit Accred Assoc ";
$links=array();
get_data(&$links, $assoc_number);
$active="";
$disabled="";
if($links[3] ==1)
{
    $active="selected";
}
else{
    $disabled="selected";
}
echo"<table border='1'>

    <form action='edit_accred_assoc.php?assoc_number=".$links[0]."' method='post'>
        <tr><td>link Number</td><td>'".$links[0]."'</td></tr>
        <tr><td>URL(If Misc just enter all the code here)</td><td colspan='3'>http://<input type='text' value='".$links[2]."' name='URL'></td></tr>

        <tr><td>Company Name</td><td colspan='3'><input type='text' value='".$links[1]."' name='Name'></td></tr>


            <tr><td>Enabled</td><td>
                <select name='Active' size='2'>
                    <option value='1' $active>Enable</option>
                    <option value='0' $disabled>Disable</option>
                </select></td></tr>

        <tr><td><input type='submit' value='Update'></td></tr>

        <input type='hidden' value='true' name='submit_form'>
    </form>

</table>";
?>
<?
   include "footer.php";
?>
  
   
   