<? 

   include "Security.php";
   include "header.php";
   include_once "FCKeditor/fckeditor.php";

?>
	
<?    
   $TID = $_GET['T_ID'];
   
   $strQuery = "Select tbl_templates.Temp_Desc, tbl_templates.Detail From tbl_templates Where
                  tbl_templates.TempID = $TID";
				  
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	$Desc 	 = $Record[0];
	$Detail     = nl2br($Record[1]);
?>

    <div align="left"><a href="EManager.php">EManager(Home)</a> > 
   <a href="templates.php">Manage Templates</a> > Edit Template <? echo "(" . $Desc . ")"; ?> </div>
	<br><br>
	
<? 
   
   echo "<h2>Edit Template:</h2>
          <br>"; 
   echo "<h3>' $Desc '</h3>
          <b><font color=\"blue\">(MovingUWithCare.Com logo will be appended with every EMAIL TEMPLATE automatically)</font><br>
		  <br><img src=\"../logos/MUWC_Logo.gif\"><br><br>";
	
   $oFCKeditor = new FCKeditor('FCKeditor1') ;
   $oFCKeditor->BasePath = 'FCKeditor/';
   $Toolbar = "Basic";
   $oFCKeditor->ToolbarSet = htmlspecialchars($Toolbar);
   $oFCKeditor->Value = "$Detail";
   
   
?>

<script type="text/javascript">

function FCKeditor_OnComplete( editorInstance )
{
    FCKeditorAPI.GetInstance('FCKeditor1').Commands.GetCommand('About').Execute = function(){return false;};
	FCKeditorAPI.GetInstance('FCKeditor1').Commands.GetCommand('Link').Execute = function(){return false;};
	FCKeditorAPI.GetInstance('FCKeditor1').Commands.GetCommand('Unlink').Execute = function(){return false;};
}

 </script>
 
 <table border="0" cellspacing="0" cellpadding="0" width="75%">
  
  <form action="template_save.php" name="form1" method="post">
    <input type="hidden" name="TempID" value="<?=$TID?>">
	<tr>
  		<td><? $oFCKeditor->Create();?></td>
	</tr>
	<tr>
  		<td>&nbsp;</td>
	</tr>
  <tr>
		<td valign="top" align="center">
        <input type="submit" value="Save Template" class="waButton1">
        <? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='templates.php'\">"; ?>
		</td></tr>
		</form>
</table>

<?
   include "footer.php";
?> 