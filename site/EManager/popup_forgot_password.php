<?
	include "class.database.php";
	include "header_popup.php";
	include "randchar_function.php";
  
?>
<script language="JavaScript">
function CheckForm(pinForm) {
	

	if (pinForm.ID.value=="")
	{
	    alert("Enter Email Address..");
		return false;
	}
	else
	{
	  return true;
	}
	
}
</script>
<h2>Forgot Password</h2>
<hr size="1"/>
<?
	if($_POST['Sent'])
	{
		$DataBase =  new Database();  
		$ID = $_POST['ID'];

		$strQuery = "select admin_id,login,pass,admin_email,Name from tbladmin where admin_email = '$ID'";
		
      
		$DataBase->query($strQuery);
		$nResult  = $DataBase->fetch_row();
		
		
		if(empty($nResult))
		{
			echo "<ul><div class='warning'><b>Email Address you provided does not exist in our database.</b></div></ul>";
		}
		else
		{
			$fld_admin_id=$nResult[0];
			$fld_login=$nResult[1];
			$fld_pass=$nResult[2];
			$fld_email=$nResult[3];
			$fld_Name=$nResult[4];

			$New_Password            = randchar(5);
			$New_Password_Encrypted  = md5($New_Password);
		
			$strQuery = "Update tbladmin set pass = '$New_Password_Encrypted' where admin_id = '$fld_admin_id'";
			
			if($DataBase->query($strQuery))
			{
				$Message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\">Your Password for MovingUWithCare.Com Admin Panel is $fld_pass. Please use your password to log into the system. Thanks</font>";
				
				if (send_mail("dan@proaceintl.com",SYSTEM_EMAIL_NAME,"$fld_email","MovingUWithCare.Com - Password","$Message"))
				{
				echo "<ul><div class='warning'><b>
					Your password has been sent to your Email Address(".$fld_email.") Please use your Password to 
					log into the system.</b></div></ul>";
			     }
				 else
				 {
				   echo "<ul><div class='warning'><b>
					Error sending PASSWORD.</b></div></ul>";
				 }
			}
		}
  
	}
?>
<? if(!($_POST['Sent'])) { ?>

<p><table border="0" cellspacing="0" cellpadding="5" align="center">
<form method="post" onSubmit="return CheckForm(this);">
	<input type="hidden" name="Sent" value="1">
	<tr>
		<td valign="top"><b>Enter Your Email Address:</b></td>
	</tr>
	<tr>
		<td valign="top"><input type="text" name="ID" size="40" /></td>
	</tr>
	<tr>
		<td valign="top">
			<input type="submit" value="Retrieve Password" class="waButton1" />
			<input type="button" value="Close" onClick="self.close();" class="waButton1" />
		</td>
	</tr>
</form>
</table></p>

<? } 
else {
?>
	<input type="button" value="Close" onClick="self.close();" class="waButton1" />
<? } ?>
<?
	include "footer_popup.php";
?>
