<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
    include "FCKeditor/fckeditor.php";
   
   $oFCKeditor = new FCKeditor('FCKeditor1') ;
   $oFCKeditor->BasePath = 'FCKeditor/';
   $Toolbar = "Basic";
   $oFCKeditor->ToolbarSet = htmlspecialchars($Toolbar);
   $oFCKeditor->Value = "";
?>

     <div align="left"><a href="EManager.php">EManager(Home)</a> > <a href="emails.php">Manage EMails</a> > Send Email to Customers</div>
	<br><br>
	
<?
   echo "<h2>Send Email to Customers</h2>
         <div class=\"warning\">*Use this page to send email to CUSTOMERS ONLY.</div>
          <br><br>";
?>

<script type="text/javascript">

function FCKeditor_OnComplete( editorInstance )
{
    FCKeditorAPI.GetInstance('FCKeditor1').Commands.GetCommand('About').Execute = function(){return false;};
	FCKeditorAPI.GetInstance('FCKeditor1').Commands.GetCommand('Link').Execute = function(){return false;};
	FCKeditorAPI.GetInstance('FCKeditor1').Commands.GetCommand('Unlink').Execute = function(){return false;};
}

function validateForm(frm)
                {
                        var strError = '';
                        if(frm.to.value=='')
						{
                                strError += "Enter an EMAIL ADDRESS!\n";

                        }           
						
                        if(strError != '')
                        {
                                alert(strError);
                                return false;
                        }

                        return true;
                }
 </script>

  <table border="0" cellspacing="0" cellpadding="5">
  
  <form action="mailsend_customers.php" name="form1" method="post" onsubmit="return validateForm(this);">
  <tr>
		<td align="right"><b> To:</b></td>
		<td><input type="text" name="to" SIZE="100" maxlength="200"></td>
	</tr>
  <tr>
		<td align="right"><b> CC:</b></td>
		<td><input type="text" name="cc" SIZE="100" maxlength="200"></td>
	</tr>
  <tr>
		<td align="right"><b> Subject:</b></td>
		<td><input type="text" name="subject" SIZE="60" maxlength="100"></td>
	</tr>
	<tr>
		<td align="right" valign="top"><b> Message:</b></td>
  		<td><? $oFCKeditor->Create();?></td>
	</tr>
  <tr>
		<td></td>
		<td valign="top">
        <input type="submit" value="Send Email" class="waButton1">
        <? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='emails.php'\">"; ?>
		</td></tr>
		</form>
</table>
		
<?
   include "footer.php";
?>
  
   
   