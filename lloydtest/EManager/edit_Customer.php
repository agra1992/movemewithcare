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
   $Mod=$_GET['Mod'];
   $Type=$_GET['Type'];
?>  
 
   <div align="left"><a href="EManager.php">EManager(Home)</a> > 
   <a href="customers.php?nSearchCrit=<?=$nSearchCrit?>&SearchString=<?=$SearchString?>&count=<?=$count?>&offset=<?=$offset?>&Mod=<?=$Mod?>&Type=<?=$Type?>">Manage Customers</a> > Edit Customer</div>
	<br><br>
	
<?   
   echo "<h2>Edit Customer &nbsp; <a href=\"javascript:spWindowOpen($ID);\" title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></a></h2>
          <br><br>";
     
?>
<script language="JavaScript">
  
  var SpdWindowOpen;
  
  function spWindowOpen(id)
  {  
	SpdWindowOpen=window.open('print_page.php?PageType=Customer&ID='+id,'newwSp','status=yes,scrollbars=yes,width=600,height=600,left=10,top=20')
  }

</script>

<? 
    $strQuery = "Select tblcustomers.Sal, tblcustomers.FName, tblcustomers.LName, tblcustomers.Address, tblcustomers.ZipCode, tblcustomers.DestZipCode,
                     tblcustomers.Phone, tblcustomers.email, tblcustomers.Phone2
                        From
                        tblcustomers
                            Where
                       tblcustomers.CustomerID = '$ID'";
					   
    $DataBase->query($strQuery);
    $Record = $DataBase->fetch_row();
	
	$Sal 	  = $Record[0];
	$FName     = $Record[1];
	$LName 	  = $Record[2];
	$Address 	  = $Record[3];
	$ZipCode     = $Record[4];
	$Dest_ZipCode     = $Record[5];
	$Phone 	  = $Record[6];
	$EMail     = $Record[7];
	$Phone2     = $Record[8];
	
	
?>

<table border="0" cellspacing="0" cellpadding="5" >
  
  <form action="update_customer.php" name="form1" method="post">
  <input type="hidden" name="ID" SIZE="40" maxlength="32" value="<?=$ID?>">
  <input type="hidden" name="nSearchCrit" SIZE="40" maxlength="32" value="<?=$nSearchCrit?>">
  <input type="hidden" name="SearchString" SIZE="40" maxlength="32" value="<?=$SearchString?>">
  <input type="hidden" name="count" SIZE="40" maxlength="32" value="<?=$count?>">
  <input type="hidden" name="offset" SIZE="40" maxlength="32" value="<?=$offset?>">
  <input type="hidden" name="Mod" SIZE="40" maxlength="32" value="<?=$Mod?>">
  <input type="hidden" name="Type" SIZE="40" maxlength="32" value="<?=$Type?>">
  <tr>
		<td align="right"><b> Customer Name:</b></td>
		<td><? echo $Sal . " " . $FName . " " . $LName; ?></td>
	</tr>
  <tr>
		<td align="right"><b> Customer Address:</b></td>
		<td><input type="text" name="CA" SIZE="40" maxlength="32" value="<?=$Address?>"></td>
	</tr>
  <tr>
		<td align="right"><b> Customer ZipCode:</b></td>
		<td><input type="text" name="CZC" SIZE="40" maxlength="32" value="<?=$ZipCode?>"></td>
	</tr>
  <tr>
		<td align="right"><b> Customer Destination ZipCode:</b></td>
		<td><input type="text" name="DCZC" SIZE="40" maxlength="32" value="<?=$Dest_ZipCode?>"></td>
	</tr>
  <tr>
		<td align="right"><b> Contact Phone (work):</b></td>
		<td><input type="text" name="CPhone" SIZE="40" maxlength="32" value="<?=$Phone?>"></td>
	</tr>
   <tr>
		<td align="right"><b> Contact Phone (home):</b></td>
		<td><input type="text" name="CPhone2" SIZE="40" maxlength="32" value="<?=$Phone2?>"></td>
	</tr>
	</tr>
  <tr>
		<td align="right"><b> EMail:</b></td>
		<td><? echo $EMail; ?></td>
	</tr>
<tr>
		<td></td>
		<td valign="top">
        <input type="submit" value="Update Record" class="waButton1" onClick="return confirm('Are you sure, you want to Update this Customer Record?');">
        <input type="reset" value="Reset" class="waButton1">
		<? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='customers.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&Mod=$Mod&Type=$Type'\">"; ?>
		</td></tr>
		</form>
</table>
		
<?
   include "footer.php";
?>
