<? 
session_start(); 
set_time_limit(60*60*60);
require ('../config.inc.php');
require ('../getfile.php');
require ('../seo.php');
require_once "../mailer.php";
require_once "../top_panel.php"; 
include_once "../randchar_function.php";

$link = mysql_connect($db_host, $db_user, $db_password)
 or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");


$dor_pack1=$_POST[dor_pack1];
$dor_load1=$_POST[dor_load1];
$or_state=$_POST[or_state];
$or_city=$_POST[or_city];
$samecity=$_POST[samecity];
$or_pack=$_POST[or_pack];
$or_load=$_POST[or_load];
$or_none=$_POST[or_none];

$dor_state=$_POST[dor_state];
$dor_city=$_POST[dor_city];
$dor_pack=$_POST[dor_pack];
$dor_load=$_POST[dor_load];
$dor_none=$_POST[dor_none];
$ServiceSelector=$_POST[ServiceSelector];
$serv1 = $_POST[serv1];
$labors = $_POST[labors];

$add=array(array());
$sql = 'Select Add_Number,Description, Image,Link From add_manager Where Add_Number>4 AND Add_Number<7';

$r = mysql_query($sql) or die("Query failed_LUPU $sql");
while($result = mysql_fetch_array($r, MYSQL_ASSOC))
{
    $add[$result[Add_Number]][0]=$result[Description];
    $add[$result[Add_Number]][1]=$result[Image];
    $add[$result[Add_Number]][2]=$result[Link];
}

?>

<html>
<SCRIPT LANGUAGE="JavaScript">
function new_add_window(add_path)
{
    add_window=window.open(add_path, "Add Widnow")
    add_window.focus();
}

</SCRIPT>

<link rel="stylesheet" type="text/css" href="../add_style.css" />
<body>

<div id="main_side_add">
<b id='title'>Sponsored Links</b>
<?
for($i=5; $i<7; $i++)
{
     echo"<div id='add_cell'>
    <div id='add_number'>
     Advertisement $i<br></div>";
        if($add[$i][1] != ""){
             echo"<a href='http://".$add[$i][2]."'><img src='../adds/".$add[$i][1]."' width='150'></a><br>";
        }
    elseif($add[$i][2] != ""){
        echo"<a href='http://".$add[$i][2]."'>http://".$add[$i][2]."</a><br>";
        echo @nl2br($add[$i][0]); 
        echo" </br>";

    }
    else{
        echo"This Add Space is Available";}

echo"</div>";
}
?>
</div>




<form name="form1" action="fulllupu1.php" method="post">

    
	<table width="70%" border="0"  style="text-align:center;">
<tr><td><br><b><font color="red" size="2">Third & Final Step:</font></b></td></tr>
      <tr><td>
<p><br>DO YOU NEED TRANSPORTATION? (Rentle Truck, trailers for long distance moves)<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          <input name="transport" type="radio" value="yes" id="yes" checked>
          <label for="yes">Yes</label><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="transport" type="radio" value="no" id="no">
          <label for="no">No</label> </p><br>

</td> 
           </tr><tr>
<td>
<div align="center">

<input type="hidden" name="or_state" value=<?=$or_state ?>>
<input type="hidden" name="or_city" value=<?=$or_city ?>>
<input type="hidden" name="or_pack" value=<?=$or_pack ?>>
<input type="hidden" name="or_load" value=<?=$or_load ?>>
<input type="hidden" name="ServiceSelector" value=<?=$ServiceSelector ?>>
<input type="hidden" name="samecity" value=<?=$samecity?>>
<input type="hidden" name="or_none" value=<?=$or_none ?>>
<input type="hidden" name="dor_none" value=<?=$dor_none ?>>
<input type="hidden" name="dor_state" value=<?=$dor_state ?>>
<input type="hidden" name="dor_city" value=<?=$dor_city ?>>
<input type="hidden" name="dor_pack" value=<?=$dor_pack ?>>
<input type="hidden" name="dor_load" value=<?=$dor_load ?>>

<input type="button" name="Back" value="<- Back" onClick="javascript:history.back();" STYLE="width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57">
<input type="submit" name="Submit" value="Proceed ->" STYLE="width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57"></div>
<br><br><br><br><br><br><br><br><br>
</td>
</tr>

</table>
</form> 

<? 
  require_once "../bottom_panel.php";   
?>



</body>
</html> 
