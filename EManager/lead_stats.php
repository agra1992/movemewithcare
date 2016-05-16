<? 
session_start();
	session_register('data'); 
	session_register('box'); 
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   include_once "Calendar_Jobs.php";
   include "../config.inc.php";
  // error_reporting(0);
?>
<script language="JavaScript" src="../mov.js"></script>



<?php
//get the results 
if(isset($_POST[submit])){

echo"<form action='members_mails_send.php' method='post'>";


$or_state=$_POST[or_state];
$year=$_POST[year];
$month=$_POST[month];
$time=$_POST[time];
$temp = "$month / 01 / $year to $month / 15 / $year  ";
if($time =="late")
{
$temp = "$month / 15 / $year to end of month ";
}
$lead_stats_message ="Bill from $temp \n";
$date = array(); 
$data = array(array());
$count =0;
$lupu= array();
$lupu_total=0;
$sql="SELECT `OrderID`, `MoveDate` FROM tbl_lupu_orders WHERE (Or_State like '$or_state' && (Or_Load = 1 || Or_Pack = 1)) || (Dest_State like '$or_state' && (Dest_Unload = 1 || Dest_Unpack = 1))";
$r = mysql_query($sql) or die($sql);
while($result = mysql_fetch_assoc($r))
{
    $date = explode("-", $result[MoveDate]);
    $data[$count][0] = $result[OrderID];
    $data[$count][1] = $date[0]; 
    $data[$count][2] = $date[1]; 
    $data[$count][3] = $date[2]; 
    $count++;
}

for($i=0; $i<$count; $i++)
{ 

    if($data[$i][1] == $year && $data[$i][2] == $month)
    { 
        if(($data[$i][3]<=15 && $time=="early") || ($data[$i][3]>15 && $time=="late")){
            $lupu[$lupu_total] = $data[$i][0];
            $lupu_total++;
        }
    }
}

$lead_stats_message  .="Total Loading/Unloading, Packing/Unpacking Orders  $lupu_total \n";
for($i=0; $i<$lupu_total; $i++){
    $lead_stats_message  .="Order ID is ".$lupu[$i]." \n";
}




///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////FULL SERVICE LOCAL//////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$local_fs_date = array(); 
$local_fs_data = array(array());
$local_fs_count =0;
$local_fs= array();
$local_fs_total=0;
$sql="SELECT `OrderID`, `MoveDate` FROM tbl_fs_orders WHERE Or_State ='$or_state' && Dest_State =' $or_state'";
$r = mysql_query($sql) or die($sql);

while($result = mysql_fetch_assoc($r))
{
    $local_fs_date = explode("-", $result[MoveDate]);
    $local_fs_data[$local_fs_count][0] = $result[OrderID];
    $local_fs_data[$local_fs_count][1] = $local_fs_date[0]; 
    $local_fs_data[$local_fs_count][2] = $local_fs_date[1]; 
    $local_fs_data[$local_fs_count][3] = $local_fs_date[2]; 
    $local_fs_count++;
}

for($i=0; $i<$local_fs_count; $i++)
{ 

    if($local_fs_data[$i][1] == $year && $local_fs_data[$i][2] == $month)
    { 
        if(($local_fs_data[$i][3]<=15 && $time=="early") || ($local_fs_data[$i][3]>15 && $time=="late")){ 
            $local_fs[$local_fs_total] = $local_fs_data[$i][0];
            $local_fs_total++;
        }
    }
}

$lead_stats_message .="Total Local Full Service Orders  $local_fs_total \n";
for($i=0; $i<$local_fs_total; $i++){
    $lead_stats_message .="Order ID is ".$local_fs[$i]." \n";
}





///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////FULL SERVICE//////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$fs_date = array(); 
$fs_data = array(array());
$fs_count =0;
$fs= array();
$fs_total=0;
$sql="SELECT `OrderID`, `MoveDate` FROM tbl_fs_orders WHERE Or_State = '$or_state' && Dest_State !=' $or_state'";
$r = mysql_query($sql) or die($sql);

while($result = mysql_fetch_assoc($r))
{
    $fs_date = explode("-", $result[MoveDate]);
    $fs_data[$fs_count][0] = $result[OrderID];
    $fs_data[$fs_count][1] = $fs_date[0]; 
    $fs_data[$fs_count][2] = $fs_date[1]; 
    $fs_data[$fs_count][3] = $fs_date[2]; 
    $fs_count++;
}

for($i=0; $i<$fs_count; $i++)
{ 

    if($fs_data[$i][1] == $year && $fs_data[$i][2] == $month)
    { 
        if(($fs_data[$i][3]<=15 && $time=="early") || ($fs_data[$i][3]>15 && $time=="late")){ 
            $fs[$fs_total] = $fs_data[$i][0];
            $fs_total++;
        }
    }
}

$total_fs_orders = $fs_total+$local_fs_total;
$lead_stats_message .="Total local and long distance full service Orders  $fs_total+$local_fs_total = $total_fs_orders \n";
for($i=0; $i<$fs_total; $i++){
    $lead_stats_message .="Order ID is ".$fs[$i]." \n";
}

$lead_stats_message .="\nImportant notice: For Long Distance Providers, your total count of leads provided for the half of the month corresponds to the total of loading unloading leads, total of local leads and total of long distance leads
\n for the Local providers, you total count includes only Loading/unloading leads AND local Full service leads";
echo"$lead_stats_message ";
echo"<input type='hidden' name='lead_stats_message' value='$lead_stats_message '><input type='submit' value='send email'></form>";
}

?>
	


<?php
echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"deadhaul.php\">Manage Deadhaul</a>  </div>";
?>
<table border="1" align="left" >	

<form action="lead_stats.php" method="post" name="lead_stats_form">

<tr>
    <td>Select A state/province</td>
    <td>Year</td>
    <td>Month</td>
    <td>Early/Late</td>
</tr>
<tr>
    <td valign="top"><select name="or_state" size="1" id="or_state" onChange="get(this);" style="width:170px; ">
		<option value="">Select State/Province</option>
		<?
			mysql_select_db($db_locator_name) or die("Could not select database");
			$sql = "SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999 AND StateID!=68"; 
			$result = mysql_query($sql) or die("Query failed");
			
			// showing all states
			while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";
				if ($line[StateID]!=52)
					echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
				else
					echo ("<option value=\"$line[StateID]\" $style $sel>$line[name]</option>");
			}
		?>  	
	</select>

    </td>
    <td valign="top">
        <?php 
        $year=date(Y) -1;
        echo"
            <select name='year'>
                <option value=$year>$year</option>";
                $year++;
                echo"
                <option value=$year selected>$year</option>";
                $year++;
                echo"
                <option value=$year>$year</option>
            </select>";
            ?>
    </td>

    <td valign="top">

            <select name='month' >
                <option value="">Month</option>
                <option value=01>January</option>
                <option value=02>February</option>
                <option value=03>March</option>
                <option value=04>April</option>
                <option value=05>May</option>
                <option value=06>June</option>
                <option value=07>July</option>
                <option value=08>August</option>
                <option value=09>September</option>
                <option value=10>October</option>
                <option value=11>November</option>
                <option value=12>December</option>
            </select>

    </td>
    <td valign="top">

            <select name='time'>
                <option value="early">Early</option>
                <option value="late">Late</option>
            </select>
    </td>
</tr>

<tr>
    <td><input type="submit" value="search" name="submit"></form></td>
</tr>


</table>


<?
   include "footer.php";
?>
  
   
   