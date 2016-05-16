<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   
   
?>

	
    <div align="left"><a href="EManager.php">EManager(Home)</a> > Business Associations</div>
	<br><br>
	
	<?
	echo "<h2>Business Associations</h2><br>";
         
	$strQuery = "SELECT assid,ass_shname,ass_fullname FROM associations";
	$DataBase->query($strQuery);
	$nResult  = $DataBase->fetch_all();
	
	echo "<table border=\"0\" width=\"95%\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"003366\" align=\"center\">
	<tr>
		<td class=\"style2\" width=\"5%\"><b>Edit</b></td>
		<td class=\"style2\" width=\"5%\"><b>Delete</b></td>
		<td class=\"style2\" width=\"8%\"><b>Name</b></td>
		<td class=\"style2\" width=\"20%\"><b>Description</b></td>
	</tr>";
	
	if (!empty($nResult))
	{
		
		foreach($nResult as $val)
		{
			$A_ID	= $val[0];
			$Name		= $val[1];
			$Desc		= $val[2];
			
			echo "<tr>
				<td class=\"style1\"><a href=\"edit_association.php?ID=$A_ID\"><img src=\"graphics/edit.gif\" border=0 alt=\"Edit\"></a></td>
				<td class=\"style1\"><a href=\"delete_association.php?ID=$A_ID\" 
				     onClick=\"return confirm('Are you sure, you want to DELETE this Association?');\">
											<img src=\"graphics/delete.gif\" border=0 alt=\"Delete\"></a></td>
				<td class=\"style1\">" .nl2br($Name). "</td>
				<td class=\"style1\">" . nl2br($Desc). "</td>
			</tr>";
		}
	}
	else
	{
		echo "<tr>
			<td colspan=5 class=\"style1\">No Association Record Found!</td>
		</tr>";
	}		
?>
</table><br>
<form action="create_association.php" method="post">
	<input type="submit" value="Add New Association" class="waButton1" />
</form>
<?
   include "footer.php";
?>
  
   
   