<?php 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   require_once "mailer.php";
   

   
		 		 




echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a>> <a href=\"orders.php\">Manage Orders</a>> Email Log";

   $OID = $_POST['OID'];
   $MID=$_POST['MID'];
echo"<table>";
$sql="SELECT `From`, `To`, `Subject`, `MailID`, `Message` FROM tblEmails WHERE MailID='$MID'";
$r=mysql_query($sql);
    while($result=mysql_fetch_assoc($r))
    {
        echo"<tr><td>";
        $from = $result[From];
        $to =$result[To];
        $subject=$result[Subject];
        $ID=$result[MailID];
        $message=$result[Message];
        echo"<tr>
    <td>From: $from <br> To: $to <br> Subject: $subject</td></tr>
    <tr><td>$message</td></tr>";
    }

echo"
<tr>
<form action=\"email_log.php\" name=\"form1\" method=\"post\">

							  <input type=\"hidden\" name=\"OID\" value=\"$OID\">
							 <input type=\"hidden\" name=\"MID\" value=\"$MID\">
<td><input type=\"submit\" name=\"Details\" value=\"Back To Log\" class=\"waButton1\"></form></td></tr>


</table>";


?>

	
  
         
	
	
	
   
   