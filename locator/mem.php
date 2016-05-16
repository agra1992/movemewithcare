<?
 session_start();
 error_reporting(0);
 if (!isset($browser))
 { 
   include_once "../prerequisites.php";
   session_register("browser");
   $browser = CheckBrowser();
 }
 require ('../config.inc.php'); 
 require_once ('../seo.php');
?>
<? 
include_once "../top_panel.php"; 

$add=array(array());
$sql = 'Select Add_Number,Description, Image,Link From add_manager Where Add_Number<29 AND Add_Number<34';

$r = mysql_query($sql) or die("Query failed_LUPU $sql");
while($result = mysql_fetch_array($r, MYSQL_ASSOC))
{
    $add[$result[Add_Number]][0]=$result[Description];
    $add[$result[Add_Number]][1]=$result[Image];
    $add[$result[Add_Number]][2]=$result[Link];
}

?>
<SCRIPT LANGUAGE="JavaScript">
function new_add_window(add_path)
{
    add_window=window.open(add_path, "Add Images", "width=300, height=150,scrollbars=yes,resizable=yes ,toolbar=yes")
    add_window.focus();
}

</SCRIPT>

<style type="text/css">
<!--
.button
{
    BORDER-RIGHT: 1px solid;
    PADDING-RIGHT: 2px;
    BORDER-TOP: 1px solid;
    PADDING-LEFT: 4px;
    FONT-WEIGHT: bold;
    FONT-SIZE: 10px;
    PADDING-BOTTOM: 2px;
    BORDER-LEFT: 1px solid;
    COLOR: #ffffff;
    PADDING-TOP: 3px;
    BORDER-BOTTOM: 1px solid;
    FONT-FAMILY: Verdana, Arial, Helvetica;
    HEIGHT: 22px;
    BACKGROUND-COLOR: #0080C0
}
-->
</style>
<link rel="stylesheet" type="text/css" href="../add_style.css" />
<?
 if($_GET['nErr'])
    {
		echo "<br><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#CC0000\" size=\"2\"><center><b>Username/Password did not Match OR You are not authorized to access this page.</center></b></font>";
	}
if($_GET['nAuth_Failed'])
    {
		echo "<br><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#CC0000\" size=\"2\"><center><b>AUTHENTICATION FAILED: Login Again</center></b></font>";
	}
if($_GET['login'] == "2")
    {
		echo "<br><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#CC0000\" size=\"2\"><center><b>Your Registeration Details have been updated. Please Login Again to use Member Panel.</center></b></font>";
	}
?>

<table width="1000">
<tr><td valign="top">&nbsp;</td>
<td  background="../images/login_background.jpg" width="500" height="200" valign="top">


<div align="center" ><p><b>Welcome to members area</b>	
<br>Please, enter your username and password in fields below. If you have any problems regarding login process,please <a href="mailto:dan@movinguwithcare.com">contact us</a>.</div>
<form action="members/login.php" method="post" name="form1" id="form1"> 
<table width="60%" border="0" align="center" >   
 <tr>       
  <td>
   <div align="right"><font size="-1" face="Arial, Helvetica, sans-serif" color="#130D57">Login:</font></div>
   </td>   
  <td>
         <input type="text" name="LOGIN" id="LOGIN" class="formobject">
 </td>    </tr>   
 <tr> 
   <td><div align="right"><font size="-1" face="Arial, Helvetica, sans-serif" color="#130D57">Password:</font></div></td>
   <td><input type="password" name="PASS" class="formobject"></td>    
  </tr>    
 <tr>       
 <td colspan="2">
  <div align="center">          
        <br><input type="submit" name="Submit" value="Login" class="button"> 
		&nbsp;  
		<input type="reset" name="Submit2" value="Reset" class="button"> </div>
</td></tr>

</table></form> 
</td>
<td valign="top">&nbsp;</td>
</tr></table>
   <br /><br /><br /><br /> <br /><br /><br /><br /><br /><br /><br /><br />  
<? include_once "../bottom_panel.php"; ?>	
</body>
</html> 