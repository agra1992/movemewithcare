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
    
  function get_data($adds)
{
$count=0;
$sql="SELECT * from add_manager";
$r=mysql_query($sql);

    while($result=mysql_fetch_row($r))
    {
        $adds[$count]=$result;
        $count++;
    }

}
?>

<?
		
   
echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a>> Manage Adevertisers ";
$adds=array(array());
get_data(&$adds);
//check how many adds there are
$total= count($adds);

echo"<table>";
//legend start
echo"<tr><td >Legend</td></tr>
         <tr><td>Loading Unloading</td><td> (1-4)</td></tr>
         <tr><td >Loading Unloading (need transport?)</td><td>(5-6)</td></tr>
         <tr><td >Loading Unloading (customer form)</td><td> (7-10)</td></tr>
         <tr><td >Full Service Movers </td><td>(11-13)</td></tr>
         <tr><td >Full Service Movers (customer form/ result page) </td><td>(14-17)</td></tr>
         <tr><td >Storage </td><td>(18-21)</td></tr>
         <tr><td >Transportation </td><td>(22-25)</td></tr>
         <tr><td >Packing </td><td>(26-29)</td></tr>
         <tr><td >Member Login </td><td>(30-33)</td></tr>
         <tr><td >Loading Unloading (result page) </td><td>(34-37)</td></tr>
         <tr><td >Transportation (result page) </td><td>(38-41)</td></tr>
         <tr><td >Packing (result page) </td><td>(42-45)</td></tr>
         <tr><td >Storage (result page) </td><td>(46-49)</td></tr>

";
//legend end
echo"</table>";

    echo"<table border='1'>";

        echo"<tr><td>Add Number</td><td>Description</td><td>Link</td><td>Image</td><td>Edit</td></tr>";
//display each add
for($i=0; $i<$total; $i++)
{

    echo"<tr><td>(".$adds[$i][0].") </td>
                  <td> (".$adds[$i][1].") </td>
                  <td> (".$adds[$i][2].") </td>
                  <td> (".$adds[$i][3].") </td>
                  <td><a href='edit_advertise.php?add_number=".$adds[$i][0]."'>Edit Add</a></tr>";

}
echo"</table>";
?>
<?
   include "footer.php";
?>
  
   
   