<? 

   include "Security.php";
   include "header.php";
   
 ?>

<div align="left"><a href="EManager.php">EManager(Home)</a> > Manage Templates</div>
	<br><br>
	
	<?
	echo "<h2>Email & Confirmation Templates</h2><br>";
         
	$strQuery = "SELECT TempID, Temp_Desc, Detail FROM tbl_templates";
	$DataBase->query($strQuery);
	$nResult  = $DataBase->fetch_all();
	
	echo "<table border=\"0\" width=\"95%\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"003366\" align=\"center\">
	<tr>
		<td class=\"style2\" width=\"8%\"><b>Description</b></td>
		<td class=\"style2\" width=\"20%\"><b>Template Details</b></td>
	</tr>";
	
	if (!empty($nResult))
	{
		
		foreach($nResult as $val)
		{
			$T_ID	= $val[0];
			$Desc		= $val[1];
			$Detail		= $val[2];
			
			echo "<tr>
				<td class=\"style1\" vAlign=\"top\"><a href=\"template_details.php?T_ID=$T_ID\" title=\"Cick here to edit this template\"
				                    >" .nl2br($Desc). "template #$T_ID</a></td>
				<td class=\"style1\" align=\"center\"><img src=\"../logos/MUWC_Logo.gif\"><br>" . nl2br($Detail). "</td>
			</tr>";
		}
	}
	else
	{
		echo "<tr>
			<td colspan=5 class=\"style1\">No Template Record Found!</td>
		</tr>";
	}		
?>
</table><br>
<?
   include "footer.php";
?>
  
   
   