<? 
   session_start();



    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
  // include "FCKeditor/fckeditor.php";
   /*
   $oFCKeditor = new FCKeditor('FCKeditor1') ;
   $oFCKeditor->BasePath = 'FCKeditor/';
   $Toolbar = "Basic";
   $oFCKeditor->ToolbarSet = htmlspecialchars($Toolbar);
   $oFCKeditor->Value = "";
*/
    $lead_stats_message = $_POST[lead_stats_message];

?>

<?php
function prepare_message($text, $i)
{

$data=$_SESSION['data'];
$data[$i][8]="on";
$_SESSION['data']=$data;
$Size="";

if($data[$i][5]=="Transport")
{

		 $sql = "SELECT EMail,Or_City,Or_State,Dest_State,MoveDate,
		         Sal, FName, LName, Phone, Phone2, MoveType from 
		            tbl_transport_orders WHERE OrderID='".$data[$i][7]."'"; 
		$result = mysql_query($sql) or die("Query failed23 $sql");
		$Record = mysql_fetch_array($result, MYSQL_ASSOC);
		 $Mail = $Record[EMail];
		 $OCity = $Record[Or_City];
		 $OState = $Record[Or_State];
		 $DState = $Record[Dest_State];
		 $MoveDate = $Record[MoveDate];
		 $Sal = $Record[Sal];
		 $FName = $Record[FName];
		 $LName = $Record[LName];
                 $Phone= $Record[Phone];
                 $Phone2= $Record[Phone2];
                 $Type= $Record[MoveType];
}
else{
		 $sql = "SELECT EMail,Or_City,Or_State,Dest_State,MoveDate,
		         Sal, FName, LName, Phone, Phone2, MoveType, Size from 
		               tbl_fs_orders WHERE OrderID='".$data[$i][7]."'"; 
		$result = mysql_query($sql) or die("Query failed23 $sql");
		$Record = mysql_fetch_array($result, MYSQL_ASSOC);
		 $Mail = $Record[EMail];
		 $OCity = $Record[Or_City];
		 $OState = $Record[Or_State];
		 $DState = $Record[Dest_State];
		 $MoveDate = $Record[MoveDate];
		 $Sal = $Record[Sal];
		 $FName = $Record[FName];
		 $LName = $Record[LName];
                 $Phone= $Record[Phone];
                 $Phone2= $Record[Phone2];
                 $Type= $Record[MoveType];
                 $Size= $Record[Size];
}
                $sql = "SELECT Detail from tbl_templates WHERE TempID='9'";
		$Subject = "Deadhaul Leads";
                
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail];


		 $CName = $Sal . " " . $FName . " " . $LName;
                 if($Type==1){
                     $Type="Long Distance";
                 }else{
                     $Type="Local";
                 }

    $query = "SELECT `city` FROM `cities` WHERE `CityID`='$OCity' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 2");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$OriginCity = $line[city];
	

	
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$OState' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 4");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$OriginState = $line[name];
	
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$DState' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 5");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$DestState = $line[name];
	
	$JobInfo = "Origin Location: $OriginCity,$OriginState <br> Destination Location: $DestCity,$DestState <br> MoveDate: $MoveDate ";

		 $message1  = "<br>";

		 $message1  = str_replace ("%CustName%","$CustName", $temp_message);
		 $message1  = str_replace ("%TelW%","$Phone", $message1);
		 $message1  = str_replace ("%TelH%","$Phone2", $message1);
		 $message1  = str_replace ("%mdate%","$MoveDate", $message1);
		 $message1  = str_replace ("%TM%","$Type", $message1);
		 $message1  = str_replace ("%from%","$OriginCity,$OriginState", $message1);
		 $message1  = str_replace ("%to%","$DestState", $message1);
		 $message1  = str_replace ("%size%","$Size", $message1);
		 $message1 = nl2br($message1);
		 $message1 = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../logos/MUWC_Logo.gif\"><br>" . $message1 . "</center></font>";
     
                     $text.="$message1 \n ";
}

?>






     <div align="left"><a href="EManager.php">EManager(Home)</a> > <a href="emails.php">Manage EMails</a> > Send Email to Members</div>
	<br><br>
	
<? 
   echo "<h2>Send Email to Members</h2>
         <div class=\"warning\">*Use this page to send email to NETWORK MEMBERS ONLY.</div>
          <br><br>";


$data_text=$_SESSION['data'];
$box= $_POST[box];

$_SESSION['box'] = $box;

$total=count($data_text);
$work="false"; //will be used to determine whther anything is sent for deahual
$text="";
    for($i=0; $i<$total; $i++)
    {
            if($box[$i] == "on")
            {
             //if one of the boxes are checked then it is for deadhaul
                $work="true";
prepare_message(&$text, $i);

           }
    }


?>
  <table border="0" cellspacing="0" cellpadding="5">
  
  <form action="mailsend_members.php" name="form1" method="post">
  <tr>
      <td>Select a service: 
          <select name="service[]" size="7" multiple="mutiple" onChange="AllowNext('lupu');">
              <option value="%">all</option>
              <option value="standard">lupu</option>
              <option value="full">Full Service</option>
              <option value="transport">transport</option>
              <option value="storage">storage</option>
              <option value="packing">packing</option>
              <option value="market">market</option>
              <option value="deadhaul">dead haul</option>
          </select>
       </td>
       <td>Select a state:
    	    <select name="state[]" size="7"  multiple="mutiple">  
                <option value="%">all</option> 
		<?php
			$sql = "SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999 AND StateID!=68"; 
			$result = mysql_query($sql) or die("Query failed");
			
			// showing all states
			while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				if ($line[StateID]!=52)
					echo "<option value=\"$line[sh_name]\" >$line[name] ($line[sh_name])</option>";
				else
					echo "<option value=\"$line[sh_name]\" >$line[name]</option>";
			}
		?>  	
	    </select>
       </td>
  </tr>
  <tr>
		<td align="right"><b> To:</b></td>
		<td><input type="text" name="to" SIZE="100" maxlength="200"></td>
	</tr>
  <tr>
		<td align="right"><b> CC:</b></td>
		<td><input type="text" name="cc" SIZE="100" maxlength="200"></td>
	</tr>
  <tr>
		<td align="right"><b> Subject:</b></td>
		<td><input type="text" name="subject" SIZE="60" maxlength="100"></td>
	</tr>
	<tr>
		<td align="right" valign="top"><b> Message:</b></td>
  		<td><textarea rows="10" cols="60" name="message"><?php echo"$text"; echo"$lead_stats_message ";?></textarea></td>
	</tr>
  <tr>
		<td></td>
		<td valign="top">
        <input type="submit" value="Send Email" class="waButton1">
        <? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='emails.php'\">";
echo "<input type='hidden' name='work' value='$work'>"; ?>
		</td></tr>
<?php
//if they areusing for deadhaul attach it
    if($work=="true")
    {
        $data_text_two=urlencode(serialize($data_text));
        echo"<input type='hidden' name='data_text' value='$data_text_two'>";
    }
	?>	
</form>
</table>
		
<?
   include "footer.php";
?>
  
   
   