<?php
	session_start(); 
	session_register('customer_info'); 
	set_time_limit(60*60*60);
	require ('../config.inc.php');
	require ('../getfile.php');
	require ('../seo.php');
	require("../sanitize.php");
	require_once "../mailer.php";
	include_once "../randchar_function.php";
	require_once "../top_panel.php";
$cryptinstall="../crypt/cryptographp.fct.php";
include $cryptinstall; 


	$link = mysql_connect($db_host, $db_user, $db_password) or die("Could not connect");
	mysql_select_db($db_name) or die("Could not select database");

	$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 10';
	$result = mysql_query($sql) or die("Query failed_LUPU");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);

$add=array(array());
$sql = 'Select Add_Number,Description, Image,Link From add_manager Where Add_Number>41 AND Add_Number<=45';

$r = mysql_query($sql) or die("Query failed_LUPU $sql");
while($result = mysql_fetch_array($r, MYSQL_ASSOC))
{
    $add[$result[Add_Number]][0]=$result[Description];
    $add[$result[Add_Number]][1]=$result[Image];
    $add[$result[Add_Number]][2]=$result[Link];
}




function send_sms($message)
{

    $sms_query= "SELECT Phone from sms_admins Where 1";
    $sms_r=mysql_query($sms_query);
    while($sms_result = mysql_fetch_assoc($sms_r))
    {
        $phone = $sms_result[Phone];
        send_mail ($phone, $phone, $phone, "new order", $message);
        $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$phone', '$phone', 'sms_new order', '$message')";
		 $result = mysql_query($sql) or die("Query failed5");
    }
}



function last_order_date($IP)
{
$date="";
$days_month = array(31,28,31,30,31,30,31,31,30,31,30,31);
    $sql="SELECT LastPacking FROM tblcustomers WHERE IP='$IP'";
    $r=mysql_query($sql);
    while($result=mysql_fetch_row($r))
    {
        $date=$result[0];
    }

if($date!=""){
    $date=explode("-",$date);
    $current_date=date("z-Y");
    $current_date=explode("-",$current_date);
    if($current_date[1] == $date[1]){
        if($current_date[0]-$date[0] >4){
            return true;
        }else{
            return false; 
        }
    }
    else
    {
        if(365-$date[0]+$current_date[0]>4){
            return true;
        }else{
            return false;
        }
    }
}
else{ //if this is their first packing order
    $date=date("z-Y");

    $sql="UPDATE tblcustomers SET LastPacking='$date'";
    $r=mysql_query($sql);
    return true;
}

}


?>
<SCRIPT LANGUAGE="JavaScript">
function new_add_window(add_path)
{
    add_window=window.open(add_path, "Add Images", "width=300, height=150,scrollbars=yes,resizable=yes ,toolbar=yes")
    add_window.focus();
}

</SCRIPT>

<link rel="stylesheet" type="text/css" href="/result.css" />
<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<link href="../full_mov_list.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../add_style.css" />

<div id="main_left_side_add">
<b id='title'>Sponsored Links</b>
<?
for($i=42; $i<=45; $i++)
{

     echo"<div id='add_cell'>
    <div id='add_number'>
     Advertisement $i<br></div>";
        if($add[$i][1] != ""){
             echo"<a href='http://".$add[$i][2]."'><img src='../adds/".$add[$i][1]."' width='150'></a><br>";
        }
    elseif($add[$i][2] != ""){

        echo "<a href='http://".$add[$i][2]."'>http://".$add[$i][2]."</a><br>";
        echo @nl2br($add[$i][0]); 
        echo" </br>";

    }
    else{
        echo"This Add Space is Available";}

echo"</div>";
}
?>
</div>
<br>
<?
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////SANITIZE DATA/////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////

//dor state in this script is accutally where they need the packing 
//supplies sent to.  the or state is just to keep track of the customer
$customer_info=array();
	$packing_comp=array(array());
        $count=0;
	$salut = sanitize($_POST[salut],5,0);
$customer_info['salut']=$salut;

	$lname = sanitize($_POST[lname],100,0);
$customer_info['lname']=$lname;

	$fname = sanitize($_POST[fname],100,0);
$customer_info['fname']=$fname;

	$address = sanitize($_POST[address],250,0);
$customer_info['address']=$address;

	$or_state = $_POST[or_state];
$customer_info['or_state']=$or_state;

	$or_city = $_POST[or_city];
$customer_info['or_city']=$or_city;

	$zipcode = sanitize($_POST[zipcode],6,0);
$customer_info['zipcode']=$zipcode;

	$ph1 = sanitize($_POST[ph1],3,0);
$customer_info['ph1']=$ph1;

	$ph2 = sanitize($_POST[ph2],3,0);
$customer_info['ph2']=$ph2;

	$ph3 = sanitize($_POST[ph3],4,0);
$customer_info['ph3']=$ph3;

	$phone1 = $ph1 . $ph2 . $ph3;	
	$ph4 = sanitize($_POST[ph4],3,0);
$customer_info['ph4']=$ph4;

	$ph5 = sanitize($_POST[ph5],3,0);
$customer_info['ph5']=$ph5;

	$ph6 = sanitize($_POST[ph6],4,0);
$customer_info['ph6']=$ph6;
	$phone2 = $ph4 . $ph5 . $ph6;
	$email = sanitize($_POST[email],100,0);
$customer_info['email']=$email;

	$dor_state = $_POST[dor_state]; 
$customer_info['dor_state']=$dor_state;


	$day=$_POST[Day];
$customer_info['Day']=$day;

	$month=$_POST[Month];
$customer_info['Month']=$month;

	$year=$_POST[Year];
$customer_info['Year']=$year;

	
	if(strlen($month) == "1"){
	  $month = "0" . $month;
	}	
	if(strlen($day) == "1"){
	  $day = "0" . $day;
	}	
	$st_date = $year . "-" . $month . "-" . $day;

	$materials = $_POST[materials];
$customer_info['materials']=$materials;

$materials_text=array();
$material_count=0;
foreach($materials as $supply)
{
if($supply =='1'){
$materials_text[$material_count]="Boxes";}
if($supply =='2'){
$materials_text[$material_count]="Tape";}
if($supply =='3'){
$materials_text[$material_count]="Moving Equipment";}
$material_count++;
}
	$materials = implode(",",$materials);	
        $materials_text = implode(",",$materials_text);

$_SESSION['customer_info']=$customer_info;


////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////END SANITIZE DATA////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////

  if (chk_crypt($_POST['code'])) {
// ------------------ storing order credentials in database
	$LeadId = randchar(7,"numeric");
	$user_domain = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$IP = $_SERVER['REMOTE_ADDR'];


$work=false;
$work=last_order_date($IP);
if($work==true){

	
	$query = "INSERT INTO `tbl_packing_orders` (OrderID, Sal, FName, LName, Address, ZipCode, Phone, Phone2, EMail, Or_City, Or_State, Dest_State, IP, Domain, MoveType, Materials, MoveDate, OrderTime)
		VALUES('$LeadId', '$salut', '$fname', '$lname', '$address', '$zipcode', '$phone1', '$phone2', '$email', '$or_city','$or_state', '$dor_state', '$IP', '$user_domain', '0', '$materials', '$st_date', CURRENT_TIMESTAMP)";	
	$result = mysql_query($query) or die("Query failed: 1");
	
	$CName = $salut . " " . $fname . " " . $lname;
	
	$sql = "SELECT COUNT(*) as numcustomers from tblcustomers WHERE IP='$IP'";
	$result = mysql_query($sql) or die("Query failed2330");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	if (empty($line[numcustomers]))
	{
	   $sql = "INSERT INTO `tblcustomers` (Sal, FName, LName, Address, ZipCode, Phone, Phone2, email, DateAdded, IP)
			     VALUES ('$salut', '$fname', '$lname', '$address', '$zipcode', $phone1, $phone2, '$email',CURRENT_TIMESTAMP, '$IP')"; 
	   $result = mysql_query($sql) or die("Query failed309");
	   
	   $sql="Select max(CustomerID) as CustID from tblcustomers;";
	   $result = mysql_query($sql) or die("Query failed: 2xx");
	   $row = mysql_fetch_assoc($result);
	   $newid=$row[CustID];	
	} 

	// find out name of origin city
	$query = "SELECT `city` FROM `cities` WHERE `CityID`='$or_city' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 2");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$or_cityd = $line[city];
	
	// find out the full names of states
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$or_state' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 4");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$or_stated = $line[name];
	
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$dor_state' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 5");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$dest_stated = $line[name];

	$sql = "SELECT admin_email from tbladmin";
	     $result1 = mysql_query($sql) or die("Query failed233");
	     $line = mysql_fetch_array($result1, MYSQL_ASSOC);
         $AdminMail = $line[admin_email];         
				send_sms("New Packing lead"); 
		 $origin = $or_cityd . "," . $or_stated; 
		 $dest = $dest_stated; 
         

		$query = "SELECT `sh_name` FROM `states` WHERE `StateID`='$dor_state' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 4");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$dor_shname = $line[sh_name];
$country="USA"
if($dor_state>52){
$country="canada"
}
		$query = "SELECT `sh_name` FROM `states` WHERE `StateID`='$or_state' LIMIT 1";
		$result = mysql_query($query) or die("Query failed: 4");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$or_shname = $line[sh_name];
//send to origin	
	       
		$query10 = "Select tblmembers.MemberID, tblmembers.MemberName, tblmembers.ContactEmail ,CONCAT(SUBSTR(tblmembers.Description,1,300),'...') as Description,
           	tblmembers.Logo, tblmembers.TollFree, tblmembers.State,tblmembers.Associations, tblmembers.sms_service, tblmembers.sms_address From
				 tblmembers Where tblmembers.MemberType = 'packing' AND tblmembers.Active = '1' AND
			   (tblmembers.State like '$dor_shname%' OR (tblmembers.State like 'NA' AND tblmembers.ServiceCountry='$country')) Order by RAND()";
	

		 $result = mysql_query($query10) or die("Query failed233");
		 $ret= array();
		 $num = mysql_num_rows($result);
		 for($i=0;$i<$num;$i++)
		 {
		 	array_push($ret,mysql_fetch_row($result));
		 }

		 $Subject = "Packing Leads";
		 $sql = "SELECT Detail from tbl_templates WHERE TempID='30'"; 
	     $result = mysql_query($sql) or die("Query failed23");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail];
         		 
         $message  = str_replace ("%JobInfo%", "Packing Supply\n Send Packaging Supplies to:$dest_stated\n Packing Supplies to be Sent:$materials_text", $temp_message);
         $message  = str_replace ("%oid%", $LeadId, $message);
		 $message  = str_replace ("%Cust%", $CName, $message);		 	 
		 $message  = str_replace ("%CustNoW%", $phone1, $message);
		 $message  = str_replace ("%CustNoH%", $phone2, $message);
		 $message  = str_replace ("%ZC%", $zipcode, $message);		 	 
		 $message  = str_replace ("%Mdate%", $st_date, $message);
		 $message  = str_replace (" %CustEmail%", $email, $message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message ."</center></font><br><br>";
		 $message = nl2br($message);
		 
		 foreach($ret as $val)
		 {
			  $MID = $val[0]; 
			  $MName = $val[1]; 
			  $memberEmail = $val[2];	
			  $sms_service = $val[8]; 
			  $sms_address = $val[9];	
$packing_comp[$count][0]=$MName;	  
$packing_comp[$count][1]=$val[5];	
$packing_comp[$count][2]=$memberEmail;	
$count++;
			  $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`,`OrderID`) VALUES ('7', '$AdminMail', '$memberEmail', '$Subject', '$message','$LeadId')";
			  $result = mysql_query($sql) or die("Query failed5");
                          send_mail($AdminMail, $AdminMail, $memberEmail, $Subject, $message);

                 if($sms_service=="yes" && $sms_address!="")
                 {
                 send_mail($AdminMail, $AdminMail, $sms_address, "New Lead", "A new lead been posted to your member panel. 
Please log in to your panel for more details.
 Thank you");
                 }
		 } 

//send list to custmoer
                          send_mail($AdminMail, $AdminMail, $AdminMail, $Subject, $message);
$list="";
if($count>0)
{


    for($i=0; $i<$count; $i++)
    { 
        $list.="Name: ".$packing_comp[$i][0]."\n"; 
        $list.="TollFree: ".$packing_comp[$i][1]."\n";
        $list.="Email: ".$packing_comp[$i][2]."\n";
    }

			$list = nl2br($list);

}	
	
 		 //sending mail to customer
 		 $Subject = "Your request has been accepted";
         $sql = "SELECT Detail from tbl_templates WHERE TempID='13'";
	     $result = mysql_query($sql) or die("Query failed23");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail];         
		 
         $message  = str_replace ("%CN%", $CName, $temp_message);		 
		 $message = "<font face=\"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . " \n $list</center></font>";
		 $message = nl2br($message);
		 		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`, `OrderID`) VALUES ('4', '$AdminMail', '$email', '$Subject', '$message','$LeadId')";
		 $result = mysql_query($sql) or die("Query failed5");
                 send_mail($AdminMail, $AdminMail, $email, $Subject, $message);
	
 
?>	 
		 

	<br />  
	<div align="right">
    <font style="FONT: bold 17px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 2px;"> 
    <center>Dear
<? echo $CName ?>, Your Request has been accepted.
    <br />
</font>
<font style="text-align:left;FONT: bold 14px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 1px;">
        Your request has been successfully placed and you shall be contacted shortly.<br>For more companies in USA <a href="/links/packing_links_usa.php">click here</a> in Canada <a href="/links/packing_links_canada.php">click here</a><br />
    <br />
</font>
<span class="style1">
	Your Request # is : <?=$LeadId?></span> <br />
  </center>
 <br />
 
 <? 
 $result10 = mysql_query($query10) or die("Query failed: 6");
 if (mysql_num_rows($result10) != 0)
 {
    ?>The following are few among the vast number of accredited movers with whom your request has been placed.
    <?
 }
 else
 {
 	echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
 }


echo "<table>";
$which_color=1;
while ($line = mysql_fetch_array($result10, MYSQL_ASSOC))
{


if($which_color%2==0){
$color='#FBF7EB';}
else{
$color='#EDFBEB';}
$which_color++;

echo"
<table bgcolor='$color'>
<tr >
      <td colspan='3' class=result_name > ".$line[MemberName]."</td>    
</tr>
<tr >     
      <td ><img src='../logos/".$line['Logo']."' height='60' width='120'></td>

      <td width='400'>•Toll Free: ". $line[TollFree] ."<br>
       • Description: ".$line[Description]."</td>
</tr>
</table>
For further companies<br> 
	<a href='packing_links_usa.php'>packing companies</a> in usa
	<a href='packing_links_canada.php'>packing companies</a> in canada

";    

}
echo "</table><br/><br/>";


}else{ //end date test
    echo"Sorry, You have already put in an order in the past five days";}


}//end if captcha was right
else {
echo"<script language='Javascript'>
window.location='http://movemewithcare.com/packing/packing.php?error=true';
</script>";}
?>
    </span>
  
<? include_once "../bottom_panel.php"; ?>