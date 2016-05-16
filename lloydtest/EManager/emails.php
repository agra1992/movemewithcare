<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";

?>

   <div align="left"><a href="EManager.php">EManager(Home)</a> > Manage EMails</div>
	<br><br>
	
<?    
   echo "<h2>Email Management</h2>
          <br><br>";  
?>


	
  	<table border="0"  cellspacing="0" cellpading="0" width="100%">
        
			<tr>
                <td>
                    <li class='arrow'><a href='customers_mails_send.php'>Send email to Customers</a></li>
                </td>
            </tr>
			<tr>
                <td>
                    <li class='arrow'><a href='members_mails_send.php'>Send email to Members</a></li>
                </td>
            </tr>
            </tr>
			<tr>
                <td>
                    <li class='arrow'><a href='view_emails.php'>View All Emails</a></li>
                </td>
            </tr>
  </table>
		
<?
   include "footer.php";
?>
  
   
   