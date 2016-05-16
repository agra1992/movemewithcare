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
?>

 <div align="left"><a href="EManager.php">EManager(Home)</a> > 
   <a href="members.php?nSearchCrit=<?=$nSearchCrit?>&SearchString=<?=$SearchString?>&count=<?=$count?>&offset=<?=$offset?>&MType=<?=$MType?>&Mod=<?=$Mod?>&Type=<?=$Type_?>">Manage Members</a> > Edit Network Member</div>
	<br><br>
	
<?    
   echo "<h2>Edit Network Member &nbsp; <a href=\"javascript:spWindowOpen($ID);\" title=\"Click here to print this page\">
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
				  tblmembers.ServiceCountry,tblmembers.MemberState,tblmembers.State
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
	$state 	  = $Record[19];
	$comp_state 	  = $Record[20];
	

	$Associations_Array = explode(",", $Associations);
	
	
        $strQuery = "Select name From states
                     Where
                      StateID = '$state'"; 
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
    $state = $Record[0];
    
    // Start by Tj
        $sql    = "select *
                        from    states";
                        
        if (!$q = mysql_query($sql)) {
                echo mysql_error() , "at line ", __LINE__;
                die();
        }             
        
        if (!mysql_num_rows($q)) {
                echo "No states found at line ", __LINE__;
                die();
        }
        
        $states = array();
        while ($r = mysql_fetch_assoc($q))
                $states[]       = $r;
           
    // End by Tj
    
 
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
	elseif ($Type == "market")
	{
	  $Type = "Market Member";
	}
	elseif ($Type == "deadhaul")
	{
	  $Type = "Deadhaul Member";
	}
?>

  <table border="0" cellspacing="0" cellpadding="5" >
  
  <form action="update_member.php" name="form1" method="post">
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
		<td><input type="text" name="CEmail" SIZE="50" maxlength="50" value="<?=$Email?>"></td>
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
<? if (($Type == "Full service") || ($Type == "Transportation Services") || ($Type == "Storage Facility") || ($Type == "Packing Supplies") || ($Type == "Market Member") || ($Type == "Deadhaul Member") )
{

			
        ?>
        <!-- Start by tj  2007.10.17 23.55-->
        <tr>
		<td align="right"><b> Address:</b></td>
		<td><input type="text" name="Address" SIZE="40" maxlength="32" value="<?=$Address;?>"></td>
			</tr>
		   <tr>
				<td align="right"><b> Member State:</b></td>
				<td><select name='MemberState'>
				    <?php   foreach($states as $mstate) {?>
				            <option value='<?=$mstate['StateID'];?>'
                                                <?php if ($state == $mstate['name']) echo "selected";?>><?=$mstate['name'];?></option>
                                            <?}
                                    ?>
                                        </select></td>
			</tr>
		   <tr>
				<td align="right"><b>Service State:</b></td>
				<td><select name='ServiceState'>
				    <?php   foreach($states as $mstate) {?>
				            <option value='<?=$mstate['sh_name'];?>'
                                                <?php if ($comp_state == $mstate['sh_name']) echo "selected";?>><?=$mstate['name'];?></option>
                                            <?}
                                    ?>
                                        </select></td>
			</tr>
		   <tr>
				<td align="right"><b> Country:</b></td>
				<td><select name='Country'>
				    
				       <option value='USA' <?php if ($SCountry == "USA") echo "selected";?>>USA    </option>
				       <option value='canada' <?if($SCountry  == "canada")echo"selected";?>>Canada    </option>
                                        </select></td>
			</tr>
                  <tr>
				<td align="right"><b> Zip Code:</b></td>
				<td><input type="text" name="ZC" SIZE="40" maxlength="32" value="<?=$ZipCode;?>"></td>
			</tr>
		  <tr>
				<td align="right"><b> Toll Free:</b></td>
				<td><input type="text" name="TF" SIZE="40" maxlength="32" value="<?=$TollFree;?>"></td>
			</tr>
		  <tr>
				<td align="right"><b> Fax:</b></td>
				<td><input type="text" name="Fax" SIZE="40" maxlength="32" value="<?=$Fax;?>"></td>
			</tr>
		 
			
		   <tr>
				<td align="right" valign="top"><b>Description:</b></td>
				<td><textarea name="Desc" cols="30" rows="10"><?=$Desc;?></textarea></td>
			</tr>
			
        <!-- End by tj -->			
        <?			
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

  if ($Type == "Loading/Unloading Assistance")
  {

     echo " <tr>
				<td align=\"right\" vAlign=\"top\"><b> Service Area:</b></td><td>";

	$ZipCode_Arr = explode(" ", $ZipCode);
        $state_code = $comp_state;
	 $strQuery = "Select name from states where sh_name like '$state_code'"; 
					   
     $DataBase->query($strQuery);
     $Record = $DataBase->fetch_row();
	 $StateName = $Record[0];
	 
	 echo "$StateName($state_code) <br>";
				
	 $strQuery = "Select distinct cities.city From cities
                     Inner Join tblmember_servicecity ON tblmember_servicecity.CityID = cities.CityID Where
                      tblmember_servicecity.`MID` = '$ID'"; 
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_all();
	foreach($Record as $val)
	{
	  $City = $val[0];
	  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$City<br>";
	}
	echo "</td></tr>";
//add in things that are updated but cant be modified, to prevent data loss
echo"<input type='hidden' name='Adress' value='$Address'>";
echo"<input type='hidden' name='ZC' value='$ZipCode'>";
echo"<input type='hidden' name='TF' value='$TollFree'>";
echo"<input type='hidden' name='Fax' value='$Fax'>";
echo"<input type='hidden' name='MemberState' value='$state'>";
  }
  
  elseif  (($Type == "Full service") || ($Type == "Transportation Services") || ($Type == "Storage Facility") || ($Type == "Packing Supplies") || ($Type == "Market Member") || ($Type == "Deadhaul Member"))
  {
     $ZipCode_Arr = explode(" ", $ZipCode);
        $state_code = $comp_state;
	 $strQuery = "Select name from states where sh_name like '$state_code'"; 
					   
     $DataBase->query($strQuery);
     $Record = $DataBase->fetch_row();
	 $StateName = $Record[0];
	 
	 if ($state_code == "NA")
	 {
	   echo " <tr><td align=\"right\" vAlign=\"top\"><b> Service Area:</b></td>
	        <td>$StateName</td>";
	 }
	 else
	 {
	   echo " <tr><td align=\"right\" vAlign=\"top\"><b> Service Area:</b></td>
	        <td>$StateName($state_code)</td>";
	 }	 				
  }
  
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
        <input type="submit" value="Update Record" class="waButton1" onClick="return confirm('Are you sure, you want to Update this Member Record?');">
        <input type="reset" value="Reset" class="waButton1">
		<? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='members.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&Mod=$Mod&Type=$Type_'\">"; ?>
		</td></tr>
		</form>
</table>
		
<?
   include "footer.php";
?>
  
   
   