<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
 
?>

 
 <div align="left"><a href="EManager.php">EManager(Home)</a> > <a href="associations.php">Business Associations</a> > Add New Association</div>
	<br><br>
	
<?   
   echo "<h2>Add New Association</h2>
          <b><font color=\"blue\">(All Fields are Mandatory unless stated otherwise)</font><br><br>";
     
?>
<script language="JavaScript">

function validateForm(frm)
                {
                        var strError = '';
						
						if(frm.Name.value=='')
						{
                                alert("Enter a Name for association!\n");
                                return false;
                        }                      

                        return true;
                }
</script>

  <table border="0" cellspacing="0" cellpadding="5">
  
  <form action="insert_association.php" name="form1" method="post" onsubmit="return validateForm(this);">
  
  <tr>
		<td align="right"><b> Name:</b></td>
		<td><input type="text" name="Name" SIZE="40" maxlength="32"></td>
	</tr>
	
   <tr>
		<td align="right" valign="top"><b>Description:</b></td>
		<td><textarea name="Desc" cols="30" rows="10"></textarea></td>
	</tr>
   <tr>
		<td></td>
		<td valign="top">
        <input type="submit" value="Add Association" class="waButton1">
        <input type="reset" value="Reset" class="waButton1">
		<? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='associations.php'\">"; ?>
		</td></tr>
		</form>
</table>
		
<?
   include "footer.php";
?>
  
   
   