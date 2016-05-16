<?
	//session_start();     
	//session_unset();
?>

<html>
<head>
        <link rel="stylesheet" href="default.css" type="text/css">
        <meta http-equiv="Pragma" CONTENT="no-cache">
        <title> MovingUWithCare.com : Admin Control Panel</title>
</HEAD>
<BODY>

<script language="JavaScript">
    var WinOpen; 
	function OpenWin()
	{  
		WinOpen=window.open('popup_forgot_password.php','popup_forgot_password','width=350,height=250,scrollbars=no,screenx=0,screeny=0');
	}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="20"><tr><td>

	<table width="300" border="0" cellspacing="1" cellpadding="10" bgcolor="DEDEDE" align="center">
	<tr>
		<td align="center" bgcolor="A3C7ED" background="graphics/bg_header_300.gif"><div class="heading1Light">Administrator Login</div></td>
	</tr>
	<tr>
		<td class="style1" align="center">
		
<?
	if($_GET['nErr'])
    {
		echo "<div class='warning'><b>Username/Password did not Match OR You are not authorized to access this page.</b></div>";
	}
	if($_GET['nAuth_Failed'])
    {
		echo "<div class='warning'><b>AUTHENTICATION FAILED: Login Again</b></div>";
	}
	
?>

			<p><table border="0">
			<form method="post" action="login.php">
			<tr>
				<td><b>Username:</b></td>
				<td><input type="text" name="wa_uid" size="20" maxlength="32"></td>
				<td></td>
			</tr>
			<tr>
				<td><b>Password:</b></td>
				<td><input type="password" name="wa_pwd" size="20" maxlength="32"></td>
			</tr>
			<tr>
				<td></td>
				<td><b><a href="javascript:OpenWin();" title="Click Here to retrieve your password">Forgot Password</a></b></td>
			</tr>
			<tr>
			    <td>&nbsp;</td>
				<td><input type="submit" value="Login" class="waButton1"></td>
			</tr>
			
			</form>
			</table>
		</td>
	</tr>
	</table>
</td></tr></table>
</body>
</html>