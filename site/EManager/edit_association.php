<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";

?>

 <div align="left"><a href="EManager.php">EManager(Home)</a> > <a href="associations.php">Business Associations</a> > Edit Association</div>
	<br><br>

<?   
   echo "<h2>Edit Association</h2>
          <br><br>";
     
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
<? 
    $ID = $_GET['ID'];
    $strQuery = "SELECT   ass_shname,ass_fullname  FROM  associations
                                                                WHERE (assid = $ID)";
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	$Name 	 = $Record[0];
	$Desc     = $Record[1];
?>

  <table border="0" cellspacing="0" cellpadding="5">
  
  <form action="update_association.php" name="form1" method="post" onsubmit="return validateForm(this);">
  <input type="hidden" name="ID" SIZE="40" maxlength="32" value="<?=$ID?>">
  <tr>
		<td align="right"><b> Name:</b></td>
		<td><input type="text" name="Name" SIZE="40" maxlength="32" value="<?=$Name?>"></td>
	</tr>
	
   <tr>
		<td align="right" valign="top"><b>Description:</b></td>
		<td><textarea name="Desc" cols="30" rows="10"><? echo $Desc; ?></textarea></td>
	</tr>
   <tr>
		<td></td>
		<td valign="top">
        <input type="submit" value="Update Record" class="waButton1">
        <input type="reset" value="Reset" class="waButton1">
		<? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='associations.php'\">"; ?>
		</td></tr>
		</form>
</table>
		
<?
   include "footer.php";
?>
  
   
   