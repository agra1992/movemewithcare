<? 

   include "Security.php";
   include "header.php";

?>
 
   <div align="left"><a href="EManager.php">EManager(Home)</a> > Manage Content</div>
	<br>

<?
   
   echo "<h2>WebSite Content<h2><br>";
         
	$strQuery = "Select tblcontent.CID, tblcontent.`Desc`From tblcontent";
	$DataBase->query($strQuery);
	$nResult  = $DataBase->fetch_all();
	
	echo "<table border=\"0\" width=\"95%\" cellspacing=\"1\" cellpadding=\"5\" align=\"center\">";
	
	if (!empty($nResult))
	{
		foreach($nResult as $val)
		{
			$CID	= $val[0];
			$Desc		= $val[1];
			
			echo "<tr>
				<td class=\"style1\">
				    <a href=\"content_edit.php?ID=$CID\" title=\"Click here to edit content on $Desc\">
				    $Desc</a></td>
			</tr>";
		}
	}	
	
?>
</table><br>


<?
   include "footer.php";
?>