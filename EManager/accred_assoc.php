<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   error_reporting(0);
   
   $nSearchCrit  = $_GET['nSearchCrit'];
   $count        = $_GET['count'];
   $offset        = $_GET['offset'];
   $SearchString  = $_GET['SearchString'];
   $Mod  = $_GET['Mod'];
   $Type = $_GET['Type'];
   $Message=$_GET['message'];
  function get_data($links)
{
$count=0;
$sql="SELECT * from accred_assoc";
$r=mysql_query($sql);

    while($result=mysql_fetch_row($r))
    {
        $links[$count]=$result;
        $count++;
    }

}
?>

<?
		
   
echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a>> Manage Accredited Associations ";
echo"$Message";
$links=array(array());
get_data(&$links);
//check how many adds there are
$total= count($links);

    echo"<table border='1'>";

echo"<tr><td><a href=\"add_accred_assoc.php\">add Accred Assoc</a></td></tr>";
        echo"<tr><td>Accred Assoc Number</td><td>Name</td><td>Link</td><td>Status</td></tr>";
//display each add
$status="";
for($i=0; $i<$total; $i++)
{
    if($links[$i][3] == 1)
    {
        $status="Active";
    }else{
        $status="Disabled";
    }
    echo"<tr>
                  <td>(".$links[$i][0].") </td>
                  <td> (".$links[$i][1].") </td>
                  <td> (".$links[$i][2].") </td>
                  <td> ($status) </td>
                  <td><a href='edit_accred_assoc.php?assoc_number=".$links[$i][0]."'>Edit Accred Assoc</a></td></tr>";

}
echo"</table>";
?>
<?
   include "footer.php";
?>
  
   
   