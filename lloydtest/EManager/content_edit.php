<? 

   include "Security.php";
   include "header.php";
   include_once "FCKeditor/fckeditor.php";
   
     $ID = $_GET['ID'];
   
    $strQuery = "Select tblcontent.`Desc`, tblcontent.Detail From tblcontent Where
                  tblcontent.CID = $ID";
				  
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	$Desc 	 = $Record[0];
	$Detail     = nl2br($Record[1]);
 ?>
  
    <div align="left"><a href="EManager.php">EManager(Home)</a> > 
   <a href="content.php">Manage Content</a> > Edit Content for  <? echo "(" . $Desc . ")"; ?> </div>
	<br><br>
 
<?   
   echo "<h2>Edit Content for $Desc:</h2>
          <br>";
		  
   $oFCKeditor = new FCKeditor('FCKeditor1') ;
   $oFCKeditor->BasePath = 'FCKeditor/';
   $Toolbar = "Default";
   $oFCKeditor->ToolbarSet = htmlspecialchars($Toolbar);
   $oFCKeditor->Value = "$Detail";
   
?>

<script type="text/javascript">

function FCKeditor_OnComplete( editorInstance )
{
    FCKeditorAPI.GetInstance('FCKeditor1').Commands.GetCommand('About').Execute = function(){return false;};
	//FCKeditorAPI.GetInstance('FCKeditor1').Commands.GetCommand('Link').Execute = function(){return false;};
	//FCKeditorAPI.GetInstance('FCKeditor1').Commands.GetCommand('Unlink').Execute = function(){return false;};
}

 </script>
 
 <table border="0" cellspacing="0" cellpadding="0" width="95%">
  
  <form action="content_save.php" name="form1" method="post">
    <input type="hidden" name="CID" value="<?=$ID?>">
	<tr>
  		<td><? $oFCKeditor->Create();?></td>
	</tr>
	<tr>
  		<td>&nbsp;</td>
	</tr>
  <tr>
		<td valign="top" align="center">
        <input type="submit" value="Save Content" class="waButton1">
        <? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='content.php'\">"; ?>
		</td></tr>
		</form>
</table>


<?
   include "footer.php";
?> 