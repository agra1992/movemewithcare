<? 

   include "Security.php";
   include "header.php";
   
   if ($_POST['Generate'])
   {
     $SDay = $_POST['SDay'];
	 $SMonth = $_POST['SMonth'];
	 $SYear = $_POST['SYear'];
	 
	 $EDay = $_POST['EDay'];
	 $EMonth = $_POST['EMonth'];
	 $EYear = $_POST['EYear'];
   }
   
   $StartDate = $SYear . "-" . $SMonth . "-" . $SDay; 
   $EndDate = $EYear . "-" . $EMonth . "-" . $EDay; 
   
?>
<script language="JavaScript">
  
  var SpdWindowOpen;
  
  function spWindowOpen(linkfollow)
  {  
	SpdWindowOpen=window.open(linkfollow,'newwSp','status=yes,scrollbars=yes,width=600,height=600,left=10,top=20')
  }

</script>   

<div align="left"><a href="EManager.php">EManager(Home)</a> > WebSite Statistics</div>
	<br><br>
	    
	<?
	echo "<h2>MovingUWithCare.Com - WebSite Statistics";
	
	if ($_POST['Generate'])
    { 
	   $linkfollow = "print_page.php?PageType=Stats&Start=$StartDate&End=$EndDate";
	   echo "<a href=\"javascript:spWindowOpen('$linkfollow');\" 
            title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></a></h2><br><br>";
    }
		 

function Customers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblcustomers where tblcustomers.DateAdded BETWEEN '$start%' AND '$end%' ";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Members($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where tblmembers.DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Active($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where Active = '1' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function InActive($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where Active = '0' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}
  
function LUPUMembers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where MemberType = 'standard' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function FSMembers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where MemberType = 'full' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function TSMembers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where MemberType = 'transport' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function PSMembers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where MemberType = 'packing' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function SSMembers($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblmembers where MemberType = 'storage' AND DateAdded BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Orders($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblorders_jobs where OrderType = 'LUPU' AND Date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}



function Leads($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from tblorders_jobs where OrderType = 'FS' AND Date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Feedbacks($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from feedback where date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Suggestions($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from feedback where feed_type = 'Suggestion' AND date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Praises($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from feedback where feed_type = 'Praise' AND date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function Complaints($start,$end)
{
  global $DataBase;
  
  $strQuery = "Select count(*) from feedback where feed_type = 'Complaint' AND date BETWEEN '$start%' AND '$end%'";
  $DataBase->query($strQuery);
  $Row = $DataBase->fetch_row();
  $Count   = $Row[0];
  
  return $Count;

}

function ComboList ($nObj, $nStart, $nStop)
 {
		  $opt = "";
          for ($nI=$nStart; $nI<=$nStop; $nI++)
          {
               if($nObj == $nI)
			   {
                       $opt = $opt . "\n<option value=$nI selected>$nI";
				}		 
                else
                {      
				     $opt = $opt . "\n<option value=$nI>$nI";
				 }
		   }
		  return $opt;			   	  
}
?>

<table width="100%" border="0">
<form method="post">
<tr> 
      <td width="5%"> <b>From:</b> </td>
      <td> <select name="SDay">
          <?  echo ComboList($SDay,1,31)?>
        </select> <select name="SMonth">
          <?  echo ComboList($SMonth,1,12)?>
        </select> <select name="SYear">
          <?  echo ComboList($SYear,2006,date("Y")+50)?>
        </select> &nbsp;&nbsp;&nbsp; 
		<b>To:</b>
		 <select name="EDay">
          <?  echo ComboList($EDay,1,31)?>
        </select> <select name="EMonth">
          <?  echo ComboList($EMonth,1,12)?>
        </select> <select name="EYear">
          <?  echo ComboList($EYear,2006,date("Y")+50)?>
        </select>&nbsp;&nbsp;&nbsp; <input type="submit" name="Generate" value="Generate" class="waButton1">
		</td>
    </tr>
	</form>
</table>
<br><br>
<? 
if (strlen($SMonth) == "1")
{
  $SMonth = "0".$SMonth;
}
if (strlen($SDay) == "1")
{
  $SDay = "0".$SDay;
}
if (strlen($EMonth) == "1")
{
  $EMonth = "0".$EMonth;
}
if (strlen($EDay) == "1")
{
  $EDay = "0".$EDay;
}

$Start = $SYear . "-" . $SMonth . "-" . $SDay; 
$End = $EYear . "-" . $EMonth . "-" . $EDay; 

if ($_POST['Generate'])
{
	echo "<table width=\"100%\" border=\"0\">
	  <tr>
		<td width=\"47%\"><b>Total Number of Customers:</b></td>
		<td width=\"53%\">";  echo Customers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Movers:</b></td>
		<td>";  echo Members($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Active:</b></td>
		<td>";  echo Active($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>InActive:</b></td>
		<td>";  echo InActive($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Loading/Unloading Assistance Movers:</b></td>
		<td>";  echo LUPUMembers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Full service Movers:</b></td>
	   <td>";  echo FSMembers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Transportation Services Movers:</b></td>
		<td>";  echo TSMembers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Storage Facility Movers:</b></td>
		<td>";  echo PSMembers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Packing Supplies Movers:</b></td>
	   <td>";  echo SSMembers($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Orders:</b></td>
		<td>";  echo Orders($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Leads:</b></td>
		<td>";  echo Leads($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td><b>Total Number of Feedbacks:</b></td>
		<td>";  echo Feedbacks($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Suggestions:</b></td>
		<td>";  echo Suggestions($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Praises:</b></td>
		<td>";  echo Complaints($Start,$End); echo "</td>
	  </tr>
	  <tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Complaints:</b></td>
		<td>";  echo Praises($Start,$End); echo "</td>
	  </tr>
	 
	</table>"; 
}

   include "footer.php";
?>
  
   
   