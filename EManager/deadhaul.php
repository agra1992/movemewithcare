<? 
session_start();
	session_register('data'); 
	session_register('box'); 
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   include_once "Calendar_Jobs.php";
   include "../config.inc.php";
   error_reporting(0);
?>
<script language="JavaScript" src="../mov.js"></script>

<script language="JavaScript" type="text/javascript">
<!--

days_month = new Array(31,28,31,30,31,30,31,31,30,31,30,31)
function populate_days(month_chosen)
{
month_str= month_chosen.options[month_chosen.selectedIndex].value
if(month_str !="")
{
    the_month=parseInt(month_str)
    document.deadhaul_form.day.options.length=0

    for(i=0; i<days_month[the_month]; i++)
    {
    document.deadhaul_form.day.options[i] = new Option(i+1)
    }
}
}

-->
</script>
<style type="text/css">
<!--
.calendarHeader { 
    font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 15px;
    color: #003366;
    background-color: #FFFFFF; 
}

.calendarToday {
    font-weight: bolder; 
    color: #CC0000; 
    background-color: #FFFFFF;
}

.calendar { 
    font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 13px;
    background-color: ##FFFFFF;
}
-->
</style>
<?php
function get_logs($name, $email, $message)
{
$message="<tr><td>compnay</td><td>email</td><td>Lead ID</td></tr>";
$sql="SELECT MemberID, MemberName, ContactEmail from tblmembers Where MemberName='$name' OR ContactEmail='$email'";
$r=mysql_query($sql);
echo"$sql";
    while ($line = mysql_fetch_array($r, MYSQL_ASSOC))
    {   
        $q="SELECT OrderID from dead_haul_log WHERE MID='".$line[MemberID]."'";
        $ri=mysql_query($q);
         while ($log = mysql_fetch_array($ri, MYSQL_ASSOC))
        {   
         $message.="<tr><td>".$line[MemberName]."</td><td>".$line[ContactEmail]. "</td><td>".$log[OrderID]."</td></tr>";  
        }
    }
}
?>

<?php
//get the results
$days_month = array(31,28,31,30,31,30,31,31,30,31,30,31);
$or_state=$_GET[or_state];
$dest_state=$_GET[dest_state];
$city=$_GET[city];
$start_year=$_GET[year];
$start_month=$_GET[month];
$start_day=$_GET[day];
$ahead=$_GET[ahead];
$size = $_GET[size];
$days_ahead = $ahead*7;
$data = array(array());
if($city =="")
{ $city="%"; }
if($dest_state =="")
{ $dest_state="%"; }
if($size =="")
{ $size="%"; }
$count=0;
$end_month= $start_month;
$end_year = $start_year;
$end_day = $start_day + $days_ahead;
$data_or_state="";
$data_dor_state="";
$data_or_city="";
$name=$_GET[name];
$email=$_GET[email];
$message="<tr><td>No logs</td></tr>";
//this is the log search
if(!empty($name) || !empty($email)){
get_logs($name, $email,&$message);
}
//if it flows over
if($start_day +$days_ahead > $days_month[$start_month])
{
$end_day= $start_day+$days_ahead-$days_month[$start_month];
    if($start_month == 11)
    {
        $end_month =0;
        $end_year++;
    }
    else
    {
        $end_month++;
    }
}
//adjust months to start at 1 rather then 0
$end_month++;
$start_month++;

//check full service leads
$sql="Select * from tbl_fs_orders where Or_State='$or_state' and Or_City like '$city' AND dest_state like '$dest_state' AND Size like '$size'";
$r= mysql_query($sql);
while ($result = mysql_fetch_array($r, MYSQL_ASSOC))
{
$date_string = $result[MoveDate];
$date =explode("-", "$date_string");
//if no overflow just make sure it's beetween the two days
if($start_month == $end_month)
{
    if($date[0] = $start_year && $date[1] == $start_month &&$date[2] >= $start_day && $date[2] <= $end_day)
    { 
$q="Select `name` from `states` Where StateID='$result[Or_State]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_or_state=$rs[0];
}
$q="Select `name` from `states` Where StateID='$result[Dest_State]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_dor_state=$rs[0];
}
$q="Select `city`from `cities` Where CityID='$result[Or_City]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_or_city=$rs[0];
}

        $data[$count][0] = $result[Sal].$result[FName]." ".$result[LName];
        $data[$count][1] = $data_or_state;
        $data[$count][2] = $data_or_city;
        $data[$count][3] = $data_dor_state;
        $data[$count][4] = $result[MoveDate];
        $data[$count][5] = "Full Service";
        $data[$count][6] = $result[Size];
        $data[$count][7] = $result[OrderID];
        $count++;
    }
}
else{
//it's in range if the start day is smaller OR if the end day is bigger
    if(($start_year == $date[0] && $start_month == $date[1] && $start_day<= $date[2]) || ($end_year == $date[0] && $end_month == $date[1] && $end_day>= $date[2]))
    {
$q="Select `name` from `states` Where StateID='$result[Or_State]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_or_state=$rs[0];
}
$q="Select `name` from `states` Where StateID='$result[Dest_State]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_dor_state=$rs[0];
}
$q="Select `city`from `cities` Where CityID='$result[Or_City]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_or_city=$rs[0];
}

        $data[$count][0] = $result[Sal].$result[FName]." ".$result[LName];
        $data[$count][1] = $data_or_state;
        $data[$count][2] = $data_or_city;
        $data[$count][3] = $data_dor_state;
        $data[$count][4] = $result[MoveDate];
        $data[$count][5] = "Full Service";
        $data[$count][6] = $result[Size];
        $data[$count][7] = $result[OrderID];
        $count++;
    }
}


}
if($size == "%")
{
//check transportation leads
$sql="Select * from tbl_transport_orders where Or_State='$or_state' and Or_City like '$city' and dest_state like '$dest_state' ";
$r= mysql_query($sql);
while ($result = mysql_fetch_array($r, MYSQL_ASSOC))
{
$date_string = $result[MoveDate];
$date =explode("-", "$date_string");
//if no overflow just make sure it's beetween the two days
if($start_month == $end_month)
{
    if($date[0] = $start_year && $date[1] == $start_month &&$date[2] >= $start_day && $date[2] <= $end_day)
    {
$q="Select `name` from `states` Where StateID='$result[Or_State]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_or_state=$rs[0];
}
$q="Select `name` from `states` Where StateID='$result[Dest_State]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_dor_state=$rs[0];
}
$q="Select `city`from `cities` Where CityID='$result[Or_City]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_or_city=$rs[0];
}
        $data[$count][0] = $result[Sal].$result[FName]." ".$result[LName];
        $data[$count][1] = $data_or_state;
        $data[$count][2] = $data_or_city;
        $data[$count][3] = $data_dor_state;
        $data[$count][4] = $result[MoveDate];
        $data[$count][5] = "Transport";
        $data[$count][6] = "N/A";
        $data[$count][7] = $result[OrderID];
        $count++;
    }
}
else{
//it's in range if the start day is smaller OR if the end day is bigger
    if(($start_year == $date[0] && $start_month == $date[1] && $start_day<= $date[2]) || ($end_year == $date[0] && $end_month == $date[1] && $end_day>= $date[2]))
    {

$q="Select `name` from `states` Where StateID='$result[Or_State]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_or_state=$rs[0];
}
$q="Select `name` from `states` Where StateID='$result[Dest_State]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_dor_state=$rs[0];
}
$q="Select `city`from `cities` Where CityID='$result[Or_City]' ";
$p=mysql_query($q);
while ($rs = mysql_fetch_array($p, MYSQL_NUM))
{
$data_or_city=$rs[0];
}
        $data[$count][0] = $result[Sal].$result[FName]." ".$result[LName];
        $data[$count][1] = $data_or_state;
        $data[$count][2] = $data_or_city;
        $data[$count][3] = $data_dor_state;
        $data[$count][4] = $result[MoveDate];
        $data[$count][5] = "Transport";
        $data[$count][6] = "N/A";
        $data[$count][7] = $result[OrderID];
        $count++;
    }
}

}
}
?>
	

<?php
echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"deadhaul.php\">Manage Deadhaul</a>  </div>";
?>
<table border="1" align="left" >	
<form action="deadhaul.php" method="get">
<tr>
    <td>LOG SEARCH (This feature is to look for company name that ordered deadhaul leads from us. This feature compiles all DEADHAUL leads for any given Deadhaul members)</td>
</tr>
<tr>
    <td>Name: <input type='text' name='name'></td>

    <td>Email: <input type='text' name='email'></td>

    <td><input type='submit' value='search the logs'></td>
</tr>
<tr>
<?php
//if they did a log search
echo"$message";?>
</tr>
<tr>
    <td>&nbsp</td>
</tr>
<tr>
    <td>DEAD HAUL SEARCH</td>
</tr>
</form>
<form action="deadhaul.php" method="get" name="deadhaul_form">

<tr>
    <td>Select A state/province</td>
    <td>city (if irrelevant leave blank)</td>
    <td>Destination state/province</td>
    <td>Year</td>
    <td>Month</td>
    <td>Day</td>
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
    <td>
	<select name="city" size="4" id="or_city" style="width: 170px; " onChange="AllowNext('lupu');">    	
	</select></td>
    <td valign="top"><select name="dest_state" size="1" id="or_state" onChange="get(this);" style="width:170px; ">
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

            <select name='month' onchange="populate_days(this)">
                <option value="">Month</option>
                <option value=0>January</option>
                <option value=1>February</option>
                <option value=2>March</option>
                <option value=3>April</option>
                <option value=4>May</option>
                <option value=5>June</option>
                <option value=6>July</option>
                <option value=7>August</option>
                <option value=8>September</option>
                <option value=9>October</option>
                <option value=10>November</option>
                <option value=11>December</option>
            </select>

    </td>
    <td valign="top">

            <select name='day'>
                <option value="">Day</option>
            </select>
    </td>
</tr>
<tr>
    <td>Select how far ahead you would like to see</td>
    <td>Size of move</td>
</tr>
<tr>
    <td valign="top">
        <select name="ahead">
           <option value="1">One week ahead</option>
           <option value="2">Two weeks ahead</option>
           <option value="3">Three weeks ahead</option>
           <option value="4">Four weeks ahead</option>
        </select>
    </td>
    <td>
        <select name="size" >
 					<option value=""  selected >Select weight</option>
					<option value="0_Partial Home 500-1000 lbs">Partial Home 500-1000 lbs</option>
					<option value="0_Studio 1500 lbs">Studio 1500 lbs</option>
					<option value="1_1 BR Small 3000 lbs">1 Small Bedroom</option>
					<option value="1_1 BR Large 4000 lbs">1 Large Bedroom  4000 lbs</option>
					<option value="1_2 BR Small 4500 lbs">2 Small Bedrooms 4500 lbs</option>
					<option value="1_2 BR Large 6500 lbs">2 Large Bedrooms 6500 lbs</option>
					<option value="1_3 BR Small 8000 lbs">3 Small Bedrooms 8000 lbs</option>
					<option value="1_3 BR Large 9000 lbs">3 Large Bedrooms 9000 lbs</option>
					<option value="1_4 BR Small 10000 lbs">4 Small Bedrooms 10000 lbs</option>
					<option value="1_4 BR Large 12000 lbs">4 Large Bedrooms 12000 lbs</option>
					<option value="1_Over 12000 lbs">Over 12000 lbs</option>
				  </select>
    </td>
</tr>
<tr>
    <td><input type="submit" value="search"></form></td>
</tr>
<?php
$total = count($data);
$text_result="";
//if there is a result
if(!empty($data[0][0]))
{
echo"<form action='members_mails_send.php' method='post'><tr><td>Send</td><td>Name</td><td>Origin State</td><td>Origin City</td><td>Destination State</td><td>move date</td><td>type</td><td>size</td></tr>";
    for($i=0; $i<$total; $i++)
    {
        echo"<tr><td><input type='checkbox' name='box[$i]'></td>";
            for($j=0; $j<7; $j++)
           {
               echo"<td>".$data[$i][$j] ."</td>";
           }
           echo"</tr>";
    }
//put in a send button
}
else
{
    echo"<tr><td>No Dead Haul Results</tr></td>";
}
$_SESSION['data']= $data;
echo"<tr><td>

<input type='submit' value='Send Mail'>
</form></td></tr>";?>

</table>

<?
   include "footer.php";
?>
  
   
   