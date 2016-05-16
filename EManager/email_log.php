<?php 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   require_once "mailer.php";
   
		 

   $OID = $_POST['OID'];
echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a>> <a href=\"orders.php\">Manage Orders</a>> Email Log";

echo"
		      
<table border='1'>
<tr>
    <td>From</td><td>To</td><td>Subject</td></tr>";
$sql="SELECT `From`, `To`, `Subject`, `MailID` FROM tblEmails WHERE OrderID='$OID'";
$r=mysql_query($sql);
    while($result=mysql_fetch_assoc($r))
    {
        echo"<tr><td>";
        $from = $result[From];
        $to =$result[To];
        $subject=$result[Subject];
        $MID=$result[MailID];
        echo"<tr>
    <td>$from</td><td>$to</td><td>$subject </td>
    <form action=\"email_details.php\" name=\"form1\" method=\"post\">

							  <input type=\"hidden\" name=\"OID\" value=\"$OID\">
							 <input type=\"hidden\" name=\"MID\" value=\"$MID\">
<td><input type=\"submit\" name=\"Details\" value=\"View Email Details\" class=\"waButton1\"></form></td>
</tr>";
    }
echo"</table>";


echo"<a href='orders.php'> Go Back</a>";
?>

	
  
         
	
	
	
   
   