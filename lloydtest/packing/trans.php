<?
session_start(); 

require ('config.inc.php');
require_once("seo.php");
require_once "mailer.php";
include_once "randchar_function.php";
$link = mysql_connect($db_host, $db_user, $db_password)
 or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");


$salute=$_POST[salut];
$fname=$_POST[fname];
$lname=$_POST[lname];
$serv[5]=$_POST["serv[]"];
$serv1=$_POST[serv1];
$serv1_state="";
$ph1=$_POST[ph1];
$ph2=$_POST[ph2];
$ph3=$_POST[ph3];
$ph4=$_POST[ph4];
$ph5=$_POST[ph5];
$ph6=$_POST[ph6];
$email=$_POST[email];
$zip=$_POST[zipcode];
$address=$_POST[address];
$st_size=$_POST[st_size];
$city=$_POST[or_city];
$o_state=$_POST[or_state1];
$d_state = $_POST[dor_state]=='' ? '0' : $_POST[dor_state];
$loc="";
$loc_un="";
$from=$_POST[from];
$showrec="";

// ************************* Register Sessions *********************************

if(!(session_is_registered("or_state")))
{
  session_register("or_state");
  $or_state = $o_state;
}
if(!(session_is_registered("o_state")))
{
  session_register("o_state");
  $o_state = $o_state;
}
if(!(session_is_registered("or_city")))
{
  session_register("or_city");
  $or_city = $city;
}
if(!(session_is_registered("city")))
{
  session_register("city");
  $city = $city;
}
if(!(session_is_registered("dor_state")))
{
  session_register("dor_state");
  $dor_state = $dor_state;
}
if(!(session_is_registered("d_state")))
{
  session_register("d_state");
  $d_state = $dor_state;
}
if(!(session_is_registered("dor_city")))
{
  session_register("dor_city");
  $dor_city = $dor_city;
}
if(!(session_is_registered("salut")))
{
  session_register("salut");
  $salut = $salut;
}
if(!(session_is_registered("fname")))
{
  session_register("fname");
  $fname = $fname;
}
if(!(session_is_registered("lname")))
{
  session_register("lname");
  $lname = $lname;
}
if(!(session_is_registered("address")))
{
  session_register("address");
  $address = $address;
}
if(!(session_is_registered("zipcode")))
{
  session_register("zipcode");
  $zipcode = $zipcode;
}
if(!(session_is_registered("email")))
{
  session_register("email");
  $email = $email;
}
if(!(session_is_registered("ph1")))
{
  session_register("ph1");
  $ph1 = $ph1;
}
if(!(session_is_registered("ph2")))
{
  session_register("ph2");
  $ph2 = $ph2;
}
if(!(session_is_registered("ph3")))
{
  session_register("ph3");
  $ph3 = $ph3;
}
if(!(session_is_registered("ph4")))
{
  session_register("ph4");
  $ph4 = $ph4;
}
if(!(session_is_registered("ph5")))
{
  session_register("ph5");
  $ph5 = $ph5;
}
if(!(session_is_registered("ph6")))
{
  session_register("ph6");
  $ph6 = $ph6;
}


// ****************************************************************************

if($from=="transportation")
$trans1="yes";
else if($from=="store")
$store1="yes";
else if($from=="packing")
$packing1="yes";
else
die("Invalid Access Attempted");

if($packing1=="yes")
{
	$user_domain = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$IP = $_SERVER['REMOTE_ADDR'];
	$LeadId = randchar(7,"numeric");
	$st_size = @implode(",",$st_size);
	
	$services = "";
	foreach($serv as $val)
	{
	  $services .= $val . ",";
	}
	$services = substr($services,0,strlen($services)-2);
	
	$Day=$_POST[Day];
	$Month=$_POST[Month];
	$Year=$_POST[Year];
	
	if(strlen($Month) == "1")
	{
	  $Month = "0" . $Month;
	}
	
	if(strlen($Day) == "1")
	{
	  $Day = "0" . $Day;
	}
	
	$st_date = $Year . "-" . $Month . "-" . $Day;
	
	$d = getdate(time());
	$month = $d["mon"];
	$year = $d["year"];
	$day = $d["mday"];
	
	if (strlen($month) == "1")
	{
	  $month = "0". $month;
	}
	if (strlen($day) == "1")
	{
	  $day = "0". $day;
	}
	
	$datevar = $year . "-" . $month . "-" . $day;
	
	$sql = "SELECT COUNT(*) as numorders from tbl_packing_orders WHERE IP = '$IP' AND OrderTime LIKE '$datevar%'";
		
		$result = mysql_query($sql) or die("Query failed2_IP");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
		if ($line[numorders]>2) 
		{
		 $show = 2;
		} 
		else
		{
		  $query = "INSERT INTO `tbl_packing_orders` (OrderID, Sal, FName, LName, Address, ZipCode, Phone, Phone2, EMail, Services, 
		         Or_State, Or_City, Dest_State, IP, Domain , MoveType, MoveDate, OrderTime, Materials)
           VALUES ('$LeadId', '$salute', '$fname', '$lname', '$address', '$zip', CONCAT('$ph1','$ph2','$ph3'), 
					CONCAT('$ph4','$ph5','$ph6'), '$email', '$services', '$o_state', '$city', '$d_state',
					'$IP', '$user_domain', '$serv1','$st_date', CURRENT_TIMESTAMP, '$st_size')";
	
          $result = mysql_query($query) or die("Query failed: Main");
		  if(!(empty($result)))
		  {
		    $sql = "SELECT COUNT(*) as numcustomers from tblcustomers WHERE email='$email'";
			$result = mysql_query($sql) or die("Query failed2330");
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			
			if (empty($line[numcustomers]))
			{
			   $sql = "INSERT INTO `tblcustomers` (Sal, FName, LName, Address, ZipCode, Phone, Phone2, email, DateAdded)
						 VALUES ('$salute', '$fname', '$lname', '$address', '$zip', CONCAT('$ph1','$ph2','$ph3'), CONCAT('$ph4',
						 '$ph5','$ph6'),'$email', CURRENT_TIMESTAMP)"; 
			   $result = mysql_query($sql) or die("Query failed309");
			   
			   $q="Select max(CustomerID) as CustID from tblcustomers;";
			   $result = mysql_query($q) or die("Query failed: 2xx");
			   $row = mysql_fetch_assoc($result);
			   $newid=$row[CustID];	
			}
		    $show = "1";
		  }
		}
}

if($packing1=="yes")
{
  
  if((in_array("3",$serv)) || (in_array("1",$serv)) || (in_array("4",$serv)))
	{
	$showrec="lupu";
	}
	
  if((in_array("3",$serv)) && (in_array("4",$serv)))
  {
    if($serv1=="0")
	{
	$serv1_state="Local";
	$typemove="Local";
	}
	else
	{
	$serv1_state="Long Distance";
	$typemove="Long";
	}
	$showrec="full";
   }
   
   if((in_array("3",$serv)) || (in_array("4",$serv)) || (in_array("2",$serv)))
  {
    if($serv1=="0")
	{
	$serv1_state="Local";
	$typemove="Local";
	}
	else
	{
	$serv1_state="Long Distance";
	$typemove="Long";
	}
	$showrec="full";
   }
  
}


?> 
<link rel="stylesheet" href="../locator/style.css" />
<div style="margin:200px auto;border:5px #999999 outset">

<ul><h1><font face="Verdana, Arial, Helvetica, sans-serif">Recommendations & Suggestions:</font></h1>

<?
if($salute && $lname)
{ echo "<p>$salute $lname,</p>"; }

if($showrec=="lupu") {?>

<li><p>We see that you chose Loading/Unloading services, we recommend you to go to <a href="../loadingunloading/loadingunloading.php">Loading/unloading tab </a>to request for a loading service provider.Please <a href="../loadingunloading/loadingunloading.php">go here</a></p></li>
<?} else if($showrec=="full") {?>
<li><p>Are you interested in more than Loading/Unloading services also? Then please visit our <a href="../locator/fullservicemovers.php"> Full  <?=$serv1_state?> Service Movers </a>than can provide you with loading, transport and unloading. Please <a href="../locator/fullservicemovers.php">go here </a></p></li>
<?} else {?>
<li><p>If you do prefer to Do-It-Yourself option, we recommend you using our <a href="../loadingunloading/loadingunloading.php">Loading/Unloading services </a> and also contact our transporation providers to rent a local truck. For transportation services, please visit Transportation Help tab.</p></li>
<?}?>
<?if(($showrec=="lupu") || ($showrec=="full")) {?>

<li><p>However, if you do prefer to Do-It-Yourself option, we recommend you using our <a href="../loadingunloading/loadingunloading.php">Loading/Unloading services </a> and contact our transporation providers to rent a truck for your <?=$typemove?> drive or have someone drive the truck for you. For transportation services, please visit Transportation Help tab.</p></li>

<?}	if($trans1=="yes"){?>
<li><p>You can also request for your warehousing(storage) needs. Please visit Storage Services tab.</p></li>

<?} if($store1=="yes") {?>
<li><p>Packing supplies can also be needed for efficient protection. Please visit Packing Supplies tab.</p></li>
<? } if($packing1=="yes") {?>
<li><p>You can also request for your warehousing(storage) needs. Please visit Storage Services tab.</p></li>.

<? }?>
</p></li>
</ul>

<?
  if ($show == "1")
  {
	 $sql = "SELECT admin_email from tbladmin";
	 $result1 = mysql_query($sql) or die("Query failed23");
	 $line = mysql_fetch_array($result1, MYSQL_ASSOC);
     $AdminMail = $line[admin_email]; 
	 
	 $query10 = "Select tblmembers.MemberID,tblmembers.MemberName,CONCAT(SUBSTR(tblmembers.Description,1,300),'...') as Description,
           tblmembers.Logo, tblmembers.TollFree, tblmembers.ContactEmail
             From tblmembers
                 Inner Join tblmember_servicecity ON tblmembers.MemberID = tblmember_servicecity.MSID
               Where tblmembers.Active = '1' AND tblmembers.MemberType = 'packing' AND
                     tblmember_servicecity.StateID IN (999,$o_state,$d_state)"; 
	 
	 $result10 = mysql_query($query10) or die("Query failed: 10");
	 
	 if (!(empty($result10)))
	 {
	
	 $sql = "INSERT INTO `tblorders_jobs` (`OrderID`, `JobID`, `OrderType`, `Date`) VALUES ('$LeadId', '$LeadId', 'Transport', 
	          CURRENT_TIMESTAMP)";
     $result = mysql_query($sql) or die("Query failed5**");
	 
	 while ($line = mysql_fetch_array($result10, MYSQL_ASSOC)) 
	{
		$sql = "INSERT INTO `tbljobs_members_packing` (`JID`, `MID`) VALUES ('$LeadId', '$line[MemberID]')";
		$result = mysql_query($sql) or die("Query failed5***");
	}
	 
	 }
	 
	    $sql = "SELECT Detail from tbl_templates WHERE TempID='12'"; 
		$result = mysql_query($sql) or die("Query failed23");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$temp_message = $line[Detail]; 
				 
		//process
		$message  = "<br>";
		$message  = str_replace ("%CN%", $_POST[fname] . ' ' . $_POST[lname], $temp_message);
		$message = nl2br($message);
		
		if (!(empty($result10)))
	    {
		  $message .= "<br>";
		  $temp1 = "";
		  $temp1 .= "<p><table>";
		  while ($line = mysql_fetch_array($result10, MYSQL_ASSOC)) 
			 {
				$temp1 .= "<tr><td>";
				$temp1 .= "<span>".$line[MemberName]. " (Toll Free:" . $line[TollFree] . ")" . "</span><br />";
				$temp1 .= "<font size=2>".$line[Description]."</font>";
				$temp1 .= "</td><td>";
				$temp1 .= "<img src='../logos/$line[Logo]' height='100' width='200'/>";
				$temp1 .= "</td></tr>";
			 }
		  $temp1 .= "</table></p>";
		  $message = $message . $temp1;
		}
		
		
		$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"../logos/MUWC_Logo.gif\"><br>" . $message . "</center></font>";
				 
		$from = "$AdminMail";
		$Subject = "MUWC - Your request has been accepted";
		
		send_mail("$from",SYSTEM_EMAIL_NAME,"$email","$Subject","$message");
		
		if(empty($newid))
		{
		  $newid = $email;
		}
		
		$sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('13', '$from', '$newid', '$Subject', '$message')";
		$result = mysql_query($sql) or die("Query failed5");
                send_mail($from, $from, $newid, $Subject, $message);
  }
?>
<p align="center">PLEASE NOTE: TO FACILITATE BROWSING THROUGH OUR SITE, AFTER FILLING YOUR REQUEST FORM PROCEEDING THE RECOMMENDATIONS AND SUGGESTIONS, OUR SYSTEM WILL TRANSFER ALL YOUR DATA TO ALL OTHER REQUEST FORMS ON THE SITE, TO AVOID REENTERING DATA FOR EVERY NEEDED MOVING SERVICES. COURTESY OF MOVINGUWITHCARE.COM</p>
<font size="-1" face= "Arial, Helvetica, sans-serif" color="#130D57"><center>You will be automatically redirected in <span id="counter" style="font-face:Verdana;font-size:22px;font-weight:bolder;font-stretch:expanded"></span>  seconds, if your browser does not redirect you ,<a href="trans1.php?sm=<?=$show?>">click here</a></center></font>
</div>
<script>
var c=50;
function fs(){
document.getElementById("counter").innerHTML=" "+c.toFixed(1)+" ";
c -= 0.1;
if(c<=0)
window.location.href='trans1.php?sm=<?=$show?>';
else
setTimeout('fs()',100);

}
fs();
//	setTimeout("window.location.href='top.php'",20000);

</script>
