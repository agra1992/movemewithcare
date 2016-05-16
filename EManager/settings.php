<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
 
?>
 
  <div align="left"><a href="EManager.php">EManager(Home)</a> > Edit Admin Panel Settings</div>
	<br><br>

<?   
   echo "<h2>Edit Admin Panel Settings</h2>
          <br><br>";
     
?>
<script language="JavaScript">

function validateForm(pinForm) {
	
	var errorMsg = "";

	if (pinForm.Pass2.value==""){
		errorMsg += "\n\tPassword \t- Enter Password";
	}
	if (pinForm.Pass3.value==""){
		errorMsg += "\n\tPassword \t- Reconfirm Password";
	}
	if (pinForm.Pass2.value!=pinForm.Pass3.value){
		errorMsg += "\n\tPassword \t- Both Passwords must Match";
	}
		
	if (errorMsg != ""){
		msg = "____________________________________________________________________\n\n";
		msg += "There are problem(s) with the form.\n";
		msg += "Please correct the problem(s) and re-submit the form.\n";
		msg += "____________________________________________________________________\n\n";
		msg += "The following field(s) need to be corrected: -\n";
		
		errorMsg += alert(msg + errorMsg + "\n\n");
		return false;
	}
	
	alert("You MUST log in again with the new password (if changed)!")
	return true;
}
</script>
<? 
   
    $strQuery = "SELECT admin_email,pass FROM  tbladmin WHERE login = ". "'" . $_COOKIE['Admin_Login'] . "'" . " and admin_id =" . $_COOKIE['Admin_Id'];
    $DataBase->query($strQuery);
    $Record   = $DataBase->fetch_row();
	$email 	  = $Record[0];
	$pass     = $Record[1];
?>

  <table border="0" cellspacing="0" cellpadding="5">
  
  <form action="confirm_settings.php" name="form1" method="post" onsubmit="return validateForm(this);">
  <tr>
		<td align="right"><b>Current Password:</b></td>
		<td><input type="text" name="Pass1" SIZE="40" maxlength="32" value="<?=$pass?>"></td>
	</tr>
   <tr>
		<td align="right"><b>Type New Password:</b></td>
		<td><input type="password" name="Pass2" SIZE="40" maxlength="32"></td>
	</tr>
    <tr>
		<td align="right"><b>ReType New Password:</b></td>
		<td><input type="password" name="Pass3" SIZE="40" maxlength="32"></td>
	</tr>
	
   <tr>
		<td align="right" valign="top"><b>Current Email Address:</b></td>
		<td><input type="text" name="Email" SIZE="40" maxlength="32" value="<?=$email?>"></td>
	</tr>
    <tr>
		<td align="right" valign="top"><b>Type New Email Address:</b></td>
		<td><input type="text" name="Email1" SIZE="40" maxlength="32"></td>
	</tr>
   <tr>
		<td></td>
		<td valign="top">
        <input type="submit" value="Update Settings" class="waButton1">
        <input type="reset" value="Reset" class="waButton1">
		</td></tr>
		</form>
</table>
		
<?
   include "footer.php";
?>
  
   
   