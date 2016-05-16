<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   include_once "Calendar_Jobs.php";
   error_reporting(0);
?>

<style type="text/css">
<!--
.calendarHeader { 
    font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 15px;
    color: #003366;
    background-color: #FFFFFF; 
}

.calendarToday {
    font-weight: bolder; 
    color: #CC0000; 
    background-color: #FFFFFF;
}

.calendar { 
    font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 13px;
    background-color: ##FFFFFF;
}
-->
</style>

<?
   $count        = $_GET['count'];
   $offset        = $_GET['offset'];
   $SearchString  = $_GET['SearchString'];
   $Mod  = $_GET['Mod'];
   $OrderType  = $_GET['OrderType'];
   
    if(isset($offset) && $offset>0)
	 {
		$start=$offset;
	 }
	 else
	 {
		 $start = 0;
	 }
		 
   function Navigation()
		{
		   global $i,$count,$pagesize,$start,$SearchString,$OrderType,$Mod,$day,$month,$year,$Cal;
		   
		   if ($count > 0)
		   {
		       
			   $previous=0;
			   if(($start-$pagesize)>0)
			   {
					 $previous=$start-$pagesize;
			   }
			   echo "<br><br><center>";
			   echo "Showing <b>".($start+1)." </b>to<b> ".$i."</b> of <b>".$count. "</b>"; 
			   echo "<br><br>";    
			   if (($start+1) > 1) 
			   {
			     echo "<a href='jobs.php?SearchString=$SearchString&count=$count&offset=$previous&OrderType=$OrderType&Mod=$Mod'> Previous </a>";
		       }		 
			   if($count%$pagesize)
			   {
						$looplimit=($count/$pagesize)+1;
			   }
			   else
			   {
						$looplimit=($count/$pagesize);
			   } 
			   
			   for( $j=0,$k=1 ; $j<$count && $k<=$looplimit;$j+=$pagesize, $k++)
			   {
				  if($start==$j)
				  {
						echo " [$k] ";
				  }		
				  else
				  {
						echo "<a href='jobs.php?SearchString=$SearchString&count=$count&offset=$j&OrderType=$OrderType&Mod=$Mod'> $k </a>&nbsp";
				   }		
			   }
			   if($count>($start+$pagesize))
			   {
				  $m = $start+$pagesize;
				  echo "<a href='jobs.php?SearchString=$SearchString&count=$count&offset=$m&OrderType=$OrderType&Mod=$Mod'> Next </a>";
			   }
			   echo "<br></center>";
			
			}		   
		}   	
   
		
		function displayJobs($SearchString)
		{
		   global $DataBase,$i,$count,$pagesize,$start,$offset,$SearchString,$Mod,$OrderType,$day,$month,$year,$Cal;
    	   $pagesize = 10;
		   $UpperLimit = $pagesize;
		   $LowerLimit = $start;
		   $date_week_ago=date('Y-m-d h:i:s', strtotime("-1 week"));

		   if (!isset($offset))
			{
    			$offset=0;
			}
			
			if ($OrderType == '' && isset($OrderType))
			{
				$query = "(Select OrderID, OrderTime, 'fs' as OrderType from tbl_fs_orders where %S%='$SearchString') union (Select OrderID, OrderTime, 'transport' as OrderType from tbl_transport_orders where %S%='$SearchString') union (Select OrderID, OrderTime, 'packing' as OrderType from tbl_packing_orders where %S%='$SearchString') union (Select OrderID, OrderTime, 'storage' as OrderType from tbl_storage_orders where %S%='$SearchString')" ;
			}
			else if ($OrderType == 'recent')
			{
				if ($SearchString != '')
					$query = "Select Orders.OrderID, Orders.OrderTime, Orders.OrderType from ((Select OrderID, OrderTime, 'fs' as OrderType from tbl_fs_orders where %S%='$SearchString') union (Select OrderID, OrderTime, 'transport' as OrderType from tbl_transport_orders where %S%='$SearchString') union (Select OrderID, OrderTime, 'packing' as OrderType from tbl_packing_orders where %S%='$SearchString') union (Select OrderID, OrderTime, 'storage' as OrderType from tbl_storage_orders where %S%='$SearchString')) as Orders where Orders.OrderTime>'$date_week_ago' order by Orders.OrderTime desc";				
				else
					$query = "Select Orders.OrderID, Orders.OrderTime, Orders.OrderType from ((Select OrderID, OrderTime, 'fs' as OrderType from tbl_fs_orders) union (Select OrderID, OrderTime, 'transport' as OrderType from tbl_transport_orders) union (Select OrderID, OrderTime, 'packing' as OrderType from tbl_packing_orders) union (Select OrderID, OrderTime, 'storage' as OrderType from tbl_storage_orders)) as Orders where Orders.OrderTime>'$date_week_ago' order by Orders.OrderTime desc";
			}
			else if ($OrderType == 'fs' || $OrderType == 'transport' || $OrderType == 'packing' || $OrderType == 'storage')
			{
				$tblName = 'tbl_'.$OrderType.'_orders';
				if ($SearchString != '')				
					$query = "Select OrderID, OrderTime, '$OrderType' as OrderType from $tblName where %S%='$SearchString'";
				else
					$query = "Select OrderID, OrderTime, '$OrderType' as OrderType from $tblName";
			}

				if ($Mod == "1")
				{
					$query = str_replace("%S%='$SearchString'", "OrderID like '%$SearchString%'", $query);					
                }									   
				if ($Mod == "2")
				{
					$query = str_replace("%S%='$SearchString'", "FName like '%$SearchString%' or LName like '%$SearchString'", $query);								
				} 
				
				if ($Mod == "3")
				{
					$query = str_replace("%S%='$SearchString'", "EMail like '%$SearchString%'", $query);
				}
				
			
			$DataBase->query($query);
			$count=$DataBase->get_num_rows();			
			
			$query .= " LIMIT $LowerLimit,$UpperLimit";			
			$nCount=0;
            $DataBase->query($query);
			
			 if($DataBase->get_num_rows()>0)
				 {
				     echo "<table border=\"0\" width=\"95%\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"003366\" align=\"center\">
						<tr>
							<td class=\"style2\" width=\"17%\"><b>Delete</b></td>
							<td class=\"style2\" width=\"44%\"><b>Lead Description</b></td>
							<td class=\"style2\" width=\"21%\"><b>Date</b></td>
							<td class=\"style2\" width=\"18%\"><b>Lead Details</b></td>
						</tr>";
				     
				     $DataBase->move_to_row($start);
				     $i=0;				     
				    
					 for($i=$start; $i<$count&&$i<$start+$pagesize; $i++)
                     {
						 $val = $DataBase->fetch_row();
						 $OrderID = $val[0];
						 $OrderTime = $val[1];
						 $Type = $val[2];						 
						
						 echo "<tr>
							<td class=\"style1\"><a href=\"removejob_action.php?ID=$OrderID&SearchString=$SearchString&count=$count&offset=$offset&OrderType=$Type&Mod=$Mod&Type=$OrderType\" onClick=\"return confirm('If you DELETE this Lead, this will result in permanent loss of it. Are you sure, you want to DELETE this Lead?');\">
							<img src=\"graphics/delete.gif\" border=0 alt=\"Delete\"></a></td>
							<td class=\"style1\">Lead # $OrderID ";
	
							 if($Type == "fs")
							 {
							   echo "(FULL SERVICE)";
							 }
							 else if($Type == "transport")
							 {
							 	echo "(TRANSPORT)";
							 }
							 else if($Type == "storage")
							 {
							 	echo "(STORAGE)";							 	
							 }
							 else if($Type == "packing")
							 {
							 	echo "(PACKING)";
							 }
							 
							 echo "</td>
							<td class=\"style1\">$OrderTime</td>
							<td class=\"style1\"><a href=\"job_details.php?ID=$OrderID&SearchString=$SearchString&count=$count&offset=$offset&OrderType=$Type&Mod=$Mod&Type=$OrderType\" title=\"Click here to view Order Details\">View Lead Details</a></td>
							 </tr>";
						$nCount++;
					}
					echo "</table><br>";
				 }
				 else
				 {
				   echo "No Leads Found !!!";
				 }
		}
		
?>
<script language="JavaScript">
function CheckForm(pinForm) {
	
	 if (pinForm.SearchString.value == "") 
	{
		alert("Please Specify some Search String");
		  return false;
     }
	else
	{
      return true;
	}
}
	function FS_Show()
    {
            window.location.href = 'jobs.php?OrderType=fs';
    }
	function Trans_Show()
    {
            window.location.href = 'jobs.php?OrderType=transport';
    }
	function Packing_Show()
    {
            window.location.href = 'jobs.php?OrderType=packing';
    }    
	function Storage_Show()
    {
            window.location.href = 'jobs.php?OrderType=storage';
    }
	function Recent_Show()
    {
            window.location.href = 'jobs.php?OrderType=recent';
    }




</script>

<?
	if ($OrderType == 'transport')
	{
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"jobs.php\">Manage Leads</a> > Manage Transportation Leads</div>";
	}	
	else if ($OrderType == 'storage')
	{
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"jobs.php\">Manage Leads</a> > Manage Storage Facility Leads</div>";
	}	
	else if ($OrderType == 'packing')
	{
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"jobs.php\">Manage Leads</a> > Manage Packing Supply Leads</div>";
	}	
	else if ($OrderType == 'fs')
	{
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"jobs.php\">Manage Leads</a> > Manage Full Service Leads</div>";
	}	
	else if ($OrderType == 'recent')
	{
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"jobs.php\">Manage Leads</a> > Manage Recent Leads</div>";
	}
	else
	{
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > Manage Leads</div>";
	}
	echo "<br><br>"
	
?>
	
   <table border="0" cellspacing="0" cellpadding="0" >
	  <form action="job_search_action.php" method="get" onSubmit="return CheckForm(this);">
		<tr>
			<td align="right" width="62" valign="top"><b>Search:</b></td>
			<td width="520" valign="top">&nbsp;&nbsp;<input type="text" name="SearchString" SIZE="20" maxlength="32" value="">
			<input type="hidden" name="OrderType" value='<?=$OrderType?>'>
			<p>
			  <INPUT type="radio"  name="Mod" value="1" checked>Lead Number
              <INPUT type="radio"  name="Mod" value="2">Customer Name
			  <INPUT type="radio"  name="Mod" value="3">Email Address of Customer
              &nbsp;<input name="submit" type="submit" class="waButton1" value="Search Lead"></p>
              <br>
              
  	          <?				
				
				if($OrderType != 'transport')
				{
					echo "<p><input name=\"submit2\" type=\"button\" class=\"waButton1\" value=\"Show Transportation Leads\" onClick=\"Trans_Show();\"></p>";
				}
				if($OrderType != 'storage')
				{
					echo "<p><input name=\"submit3\" type=\"button\" class=\"waButton1\" value=\"Show Storage Facility Leads\" onClick=\"Storage_Show();\"></p>";
				}
				if($OrderType != 'packing')
				{
					echo "<p><input name=\"submit3\" type=\"button\" class=\"waButton1\" value=\"Show Packing Supply Leads\" onClick=\"Packing_Show();\"></p>";
				}				
				if($OrderType != 'fs')
				{
					echo "<p><input name=\"submit1\" type=\"button\" class=\"waButton1\" value=\"Show Full Service Leads\" onClick=\"FS_Show();\"></p>";
				}
				if($OrderType != 'recent')
				{
					echo "<p><input name=\"submit3\" type=\"button\" class=\"waButton1\" value=\"Show Recent Leads\" onClick=\"Recent_Show();\"></p>";
				}

			?>
              
              
           <br>
			</td>          
	    </tr>
	  	</form>
	</table>
	

<? 
if($_SERVER['QUERY_STRING'] != "")
{
	displayJobs($SearchString);Navigation();
} ?>

<?
   include "footer.php";
?>
  
   
   