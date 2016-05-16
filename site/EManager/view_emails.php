<?php 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   
		 

echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a>> <a href=\"emails.php\">Manage Emails</a>> Email Log";

echo"
		      
<table border='1'>
<tr>
    <td>OrderID</td><td>From</td><td>To</td><td>Company Name</td><td>Subject</td></tr>";
$sql="SELECT tblEmails.From, tblEmails.To, tblEmails.Subject, tblEmails.MailID, tblmembers.MemberName, tblEmails.OrderID FROM tblEmails, tblmembers WHERE tblEmails.To = tblmembers.ContactEmail Order By tblEmails.MailID ASC";
$r=mysql_query($sql) or die("error $sql");
    while($result=mysql_fetch_assoc($r))
    {
        echo"<tr><td>";
        $from = $result[From];
        $to =$result[To];
        $subject=$result[Subject];
        $MID=$result[MailID];
        $OrderID = $result[OrderID];
        $name = $result[MemberName];
        echo"<tr>
    <td>$OrderID</td><td>$from</td><td>$to</td><td>$name</td><td>$subject </td>
    <form action=\"email_details2.php\" name=\"form1\" method=\"post\">

							  <input type=\"hidden\" name=\"OID\" value=\"$OID\">
							 <input type=\"hidden\" name=\"MID\" value=\"$MID\">
<td><input type=\"submit\" name=\"Details\" value=\"View Email Details\" class=\"waButton1\"></form></td>
</tr>";
    }
echo"</table>";


echo"<a href='emails.php'> Go Back</a>";
?>

	
  
         
	
	
	
   
   