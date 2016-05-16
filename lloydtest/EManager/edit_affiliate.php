<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   
   $ID = $_GET['ID'];
   $nSearchCrit = $_GET['nSearchCrit'];
   $SearchString = $_GET['SearchString'];
   $count = $_GET['count'];
   $offset = $_GET['offset'];
   $Mod = $_GET['Mod'];
   $Type_ = $_GET['Type'];
   $LOGO = $_GET['LOGO'];

?>

 <div align="left"><a href="EManager.php">EManager(Home)</a> > 
   <a href="Affiliates.php?nSearchCrit=<?=$nSearchCrit?>&SearchString=<?=$SearchString?>&count=<?=$count?>&offset=<?=$offset?>&MType=<?=$MType?>&Mod=<?=$Mod?>&Type=<?=$Type_?>">Manage Affiliates</a> > Edit Affiliates</div>
	<br><br>
	
<?    
   echo "<h2>Edit Affiliate &nbsp; <a href=\"javascript:spWindowOpen($ID);\" title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></a></h2>
          <br><br>";
     
?>

<script language="JavaScript">
  
  var SpdWindowOpen;
  
  function spWindowOpen(id)
  {  
	SpdWindowOpen=window.open('print_page.php?PageType=Member&ID='+id,'newwSp','status=yes,scrollbars=yes,width=600,height=600,left=10,top=20')
  }

</script>

<? 
    $strQuery = "Select tblmembers.MemberName, tblmembers.MemberType, tblmembers.ContactPerson,tblmembers.ContactEmail, 
                  tblmembers.Address, tblmembers.ZipCode, tblmembers.Phone, tblmembers.TollFree, tblmembers.Fax,
                  tblmembers.Login, tblmembers.pass, tblmembers.Associations, tblmembers.Logo,
                  tblmembers.Description, tblmembers.InterstateLicense, tblmembers.USDot, tblmembers.MC, tblmembers.Active,
				  tblmembers.ServiceCountry, tblmembers.State,tblmembers.MemberState
                   From tblmembers
					   Where tblmembers.MemberID = '$ID'";
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$Name 	  = $Record[0];
	$Type     = $Record[1];
	$CPerson 	  = $Record[2];
	$Email     = $Record[3];
	$Address 	  = $Record[4];
	$ZipCode     = $Record[5];
	$Phone 	  = $Record[6];
	$TollFree     = $Record[7];
	$Fax 	  = $Record[8];
	$Login 	  = $Record[9];
	$Pass     = $Record[10];
	$Associations     = $Record[11];
	$Logo 	  = $Record[12];
	$Desc     = $Record[13];
	$ISLicense 	  = $Record[14];
	$USDot     = $Record[15];
	$MC 	  = $Record[16];
	$Status 	  = $Record[17];
	$SCountry 	  = $Record[18];
	$state	  = $Record[19];
	$m_state	  = $Record[20];
	$Associations_Array = explode(",", $Associations);
	$SCountry_Array = explode(",", $SCountry);
	$sql="Select sh_name from states where StateID = '$m_state'";
        $DataBase->query($sql);
        $Record_state = $DataBase->fetch_row();
$m_state=$Record_state[0];
        if ($Type == "standard")
	{
	  $Type = "Loading/Unloading Assistance";
	}
	elseif ($Type == "full")
	{
	  $Type = "Full service";
	}
	elseif ($Type == "transport")
	{
	  $Type = "Transportation Services";
	}
	elseif ($Type == "storage")
	{
	  $Type = "Storage Facility";
	}
	elseif ($Type == "packing")
	{
	  $Type = "Packing Supplies";
	}
?>

  <table border="0" cellspacing="0" cellpadding="5" >
  
  <form action="update_affiliate.php" name="form1" method="post">
  <input type="hidden" name="ID" SIZE="40" maxlength="32" value="<?=$ID?>">
  <input type="hidden" name="nSearchCrit" SIZE="40" maxlength="32" value="<?=$nSearchCrit?>">
  <input type="hidden" name="SearchString" SIZE="40" maxlength="32" value="<?=$SearchString?>">
  <input type="hidden" name="count" SIZE="40" maxlength="32" value="<?=$count?>">
  <input type="hidden" name="offset" SIZE="40" maxlength="32" value="<?=$offset?>">
  <input type="hidden" name="Mod" SIZE="40" maxlength="32" value="<?=$Mod?>">
  <input type="hidden" name="Type" SIZE="40" maxlength="32" value="<?=$Type_?>">
  <tr>
		<td align="right"><b> Company Name:</b></td>
		<td><input type="text" name="Name" SIZE="40" maxlength="32" value="<?=$Name?>"></td>
	</tr>
  <tr>
		<td align="right"><b> Member Type:</b></td>
		<td><? echo $Type; ?></td>
	</tr>
  <tr>
		<td align="right"><b> Contact Person:</b></td>
		<td><input type="text" name="CP" SIZE="40" maxlength="32" value="<?=$CPerson?>"></td>
	</tr>
  <tr>
		<td align="right"><b> Contact Email:</b></td>
		<td><input type="text" name="CEmail" SIZE="40" maxlength="32" value="<?=$Email?>"></td>
	</tr>
  <tr>
		<td align="right"><b> Phone:</b></td>
		<td><input type="text" name="Phone" SIZE="40" maxlength="32" value="<?=$Phone?>"></td>
	</tr>
	 <tr>
		<td align="right"><b> Login:</b></td>
		<td><? echo $Login; ?></td>
	</tr>
  <tr>
		<td align="right"><b> Password:</b></td>
		<td><? echo $Pass; ?></td>
	</tr>
<? if (($Type == "Full service") || ($Type == "Transportation Services") || ($Type == "Storage Facility") || ($Type == "Packing Supplies"))
{
  echo "<tr>
		<td align=\"right\"><b> Address:</b></td>
		<td><input type=\"text\" name=\"Address\" SIZE=\"40\" maxlength=\"32\" value=\"$Address\"></td>
			</tr>
		   <tr>
				<td align=\"right\"><b> Zip Code:</b></td>
				<td><input type=\"text\" name=\"ZC\" SIZE=\"40\" maxlength=\"32\" value=\"$ZipCode\"></td>
			</tr>
		  <tr>
				<td align=\"right\"><b> Toll Free:</b></td>
				<td><input type=\"text\" name=\"TF\" SIZE=\"40\" maxlength=\"32\" value=\"$TollFree\"></td>
			</tr>
		  <tr>
				<td align=\"right\"><b> Fax:</b></td>
				<td><input type=\"text\" name=\"Fax\" SIZE=\"40\" maxlength=\"32\" value=\"$Fax\"></td>
			</tr>
		 
			
		   <tr>
				<td align=\"right\" valign=\"top\"><b>Description:</b></td>
				<td><textarea name=\"Desc\" cols=\"30\" rows=\"10\">$Desc</textarea></td>
			</tr>";
}

if (($Type == "Full service") || ($Type == "Transportation Services"))
{
   if ($ISLicense == "1")
   {
        echo " <tr>
				<td align=\"right\"><b> USDot No::</b></td>
				<td>$USDot</td>
			</tr>
			<tr>
				<td align=\"right\"><b> MC No:</b></td>
				<td>$MC</td>
			</tr>";
    }
}
  
  echo " <tr>
				<td align=\"right\" vAlign=\"top\"><b> Registered with:</b></td><td>";
				
  if($SCountry_Array)
  {
    $ret= array();
    foreach ($SCountry_Array as $Country) 
	  {
		$strQuery = "Select operatingcountries.country_name, operatingcountries.country_code From
                           operatingcountries Where operatingcountries.id = '$Country'"; 
						   
		$DataBase->query($strQuery);
		$Record = $DataBase->fetch_row();
		
		$Name 	  = $Record[0];
		$Code     = $Record[1];
		array_push($ret,$Name."(".$Code.")");
      }
  }
				
  foreach ($Associations_Array as $Association) 
  {
    $strQuery = "Select associations.ass_shname, associations.ass_fullname, associations.assid From associations
					   Where associations.assid = '$Association'"; 
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$SName 	  = $Record[0];
	$Name     = $Record[1];
	$AID     = $Record[2];
	
	if (($AID == "5") && (!empty($ret)))
	{
	     $Str = "";
		 $i=0;
		 foreach($ret as $val)
		 {
		   if(empty($val))
		   {
		     $Str = ",";
		   }
		   else
		   {
		     //$Str .= $Str . "," . $val;
			 $Str = $Str . $val . ",";
		   }
		 }
	
	 echo "($SName) $Name <b>[ $Str ] </b><br>";
	}
	else
	{
	  echo "($SName) $Name<br>";
	}
 }
 
  echo "</td></tr>";

     echo " <tr>
				<td align=\"right\" vAlign=\"top\"><b> Service Area:</b></td><td>$state</td></tr>
<tr>
				<td align=\"right\" vAlign=\"top\"><b> Member State:</b></td><td>$m_state</td></tr>";
	
  
  echo "<tr>
				<td align=\"right\"><b> Status:</b></td>
				<td>"; if($Status == "1") 
					   {
						 echo "Active";
						}
						else
						{
						  echo "InActive";
						}
  echo "</td>
			</tr>";
?>

   <?        
              echo "<tr>
					<td align=\"right\"><b> Logo:</b></td>
					<td>";
					
              if(($Logo) && ($Type != "Loading/Unloading Assistance"))
		       {

			      $size = getimagesize("../logos/$Logo");
				 if ($size[0] > "200" || $size[1] > "100")
				 {
		           echo "<img src=\"../logos/$Logo\" height=\"100\" width=\"200\">";
				   	echo "</td>
						</tr>";
				 }
				 else
				 {
				   echo "<img src=\"../logos/$Logo\">";
				   echo "</td>
						</tr>";
				 }
				}
				else
				{
				  echo "<img src=\"../logos/NoLogo.gif\">";
				  echo "</td>
						</tr>";


				}

			 ?>


	
   <tr>
		<td></td>
		<td valign="top">
        <input type="submit" value="Update Record" class="waButton1" onClick="return confirm('Are you sure, you want to Update this Affiliate Record?');">
        <input type="reset" value="Reset" class="waButton1">
		<? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='affiliates.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&Mod=$Mod&Type=$Type_'\">"; ?>
		</td></tr>
		</form>
<?
echo"
    <form action='upload_member_image.php' method='post' enctype='multipart/form-data'>
	<input type='hidden' name='MAX_FILE_SIZE' value='25000000'>
	<input type='hidden' name='ID' value='$ID'>
	<input type='hidden' name='LOGO' value='<?=$logo?>'>
        <tr><td>Upload Image</td><td><input name='UL' type='file' size ='30'></td><td>	<input type='submit' name='Submit' value='Upload' class='button'></td></tr>
    </form>
			";	?>
</table>
		
<?
   include "footer.php";
?>
  
   
   