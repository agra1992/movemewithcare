<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   error_reporting(0);
   
   $nSearchCrit  = $_GET['nSearchCrit'];
   $count        = $_GET['count'];
   $offset        = $_GET['offset'];
   $SearchString  = $_GET['SearchString'];
   $Mod  = $_GET['Mod'];
   $Type = $_GET['Type'];


   if (!isset($nSearchCrit))
			{
              $nSearchCrit = 0;
			}
	if (!isset($Mod))
			{
              $Mod = 0;
			}
   
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
		   global $i,$count,$pagesize,$start,$nSearchCrit,$SearchString,$Type,$Mod;
		   
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
			   	echo "<a href='customers.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$previous&Mod=$Mod&Type=$Type'> Previous </a>";
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
				  	echo "<a href='customers.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$j&Mod=$Mod&Type=$Type'> $k </a>&nbsp";
				  }		
			   }
			   if($count>($start+$pagesize))
			   {
				  $m = $start+$pagesize;
				  echo "<a href='customers.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$m&Mod=$Mod&=$Type'> Next </a>";
			   }
			   echo "<br></center>";
			
			}   
		   
		}   	
		
   
   function AlphaIndex()
		{
		  global $SearchString,$Type;
		  for($i=65;$i<91;$i++)
		  {
		      $strAlpha = chr($i);
			  if (strcmp($strAlpha,$SearchString) == 0)
			  {
			    echo "<b>$strAlpha</b>&nbsp;&nbsp;";
			  }
			  else
			  {
			    echo "<a href='customers.php?SearchString=$strAlpha&nSearchCrit=1&Type=$Type' title='$strAlpha'>
				          <b>$strAlpha</b> &nbsp;&nbsp;
				      </a>";  
			  }
		  }
		}	
		
		function displayCustomers($nSearchCrit,$SearchString)
		{
		   global $DataBase,$i,$count,$pagesize,$start,$offset,$SearchString,$Mod,$Type;
    	   $pagesize = 10;
		   $UpperLimit = $pagesize;
		   $LowerLimit = $start;
           //echo "Mod".$Mod;
		   //echo "nSearchCrit".$nSearchCrit;
		   $date_week_ago=date('Y-m-d h:i:s', strtotime("-1 week"));
		   $baseQuery1="";
		   $baseQuery2="";
		   switch ($Type)
		   {
		   	case 1:
		   		{
		   			$baseQuery1=" and email in (select email from tbl_lupu_orders)";
		   			$baseQuery2=" where email in (select email from tbl_lupu_orders)";
		   			break;
		   		}
		   	case 2:
		   		{
		   			$baseQuery1=" and email in (select email from tbl_fs_orders)";
		   			$baseQuery2=" where email in (select email from tbl_fs_orders)";
		   			break;
		   		}
		   	case 3:
		   		{
		   			$baseQuery1=" and DateAdded > '$date_week_ago' ORDER BY DateAdded DESC";
		   			$baseQuery2=" where DateAdded > '$date_week_ago' ORDER BY DateAdded DESC";
		   			break;
		   		}
	   	        case 4:
		   		{
		   			$baseQuery1=" and Valid != 'yes' ORDER BY DateAdded DESC";
		   			$baseQuery2=" where Valid != 'yes' ORDER BY DateAdded DESC";
		   			break;
		   		}
		   	default:
		   		{
		   			$baseQuery1="";
		   			$baseQuery2="";
		   			break;
		   		}
		   }
		   if (!isset($offset))
			{
    			$offset=0;
			}
			
			    if (($nSearchCrit == '0') && ($Mod == "1"))
				{
					  if (!isset($count))
						  {
							$strQuery = "SELECT CustomerID,FName,LName FROM tblcustomers where email LIKE '%$SearchString%'".$baseQuery1;
							$DataBase->query($strQuery);
							$count=$DataBase->get_num_rows();
						  }
						   $strQuery = "SELECT CustomerID,FName,LName FROM tblcustomers where email LIKE '%$SearchString%'".$baseQuery1." LIMIT $LowerLimit,$UpperLimit";
                }						   
				if (($nSearchCrit == '0') && ($Mod == "2"))
				{	  
					     if (!isset($count))
						  {
							$strQuery = "SELECT CustomerID,FName,LName FROM tblcustomers where FName LIKE '%$SearchString%'".$baseQuery1;
							$DataBase->query($strQuery);
							$count=$DataBase->get_num_rows();
						  }
						   $strQuery = "SELECT CustomerID,FName,LName FROM tblcustomers where FName LIKE '%$SearchString%'".$baseQuery1." LIMIT $LowerLimit,$UpperLimit";
				}
				if (($nSearchCrit == '0') && ($Mod == "3"))
				{
					      if (!isset($count))
						  {
							$strQuery = "SELECT CustomerID,FName,LName FROM tblcustomers where LName LIKE '%$SearchString%'".$baseQuery1;
							$DataBase->query($strQuery);
							$count=$DataBase->get_num_rows();
						   }
						   $strQuery = "SELECT CustomerID,FName,LName FROM tblcustomers where LName LIKE '%$SearchString%'".$baseQuery1." LIMIT $LowerLimit,$UpperLimit";
				}
				
				if ($nSearchCrit == '1')
				{
					  if (!isset($count))
					  {
						$strQuery = "SELECT CustomerID,FName,LName FROM tblcustomers where LName LIKE '$SearchString%'".$baseQuery1;
						$DataBase->query($strQuery);
						$count=$DataBase->get_num_rows();
					  }
					  else
					  {
					   $strQuery = "SELECT CustomerID,FName,LName FROM tblcustomers where LName LIKE '$SearchString%'".$baseQuery1." LIMIT $LowerLimit,$UpperLimit";
					  }
				}
				
				if (($nSearchCrit == '0') && ($Mod == 0))
				{
				     if (!isset($count))
					  {
						$strQuery = "SELECT CustomerID,FName,LName FROM tblcustomers".$baseQuery2;
						$DataBase->query($strQuery);
						$count=$DataBase->get_num_rows();
					  }
    			       else
					  {
					   $strQuery = "SELECT CustomerID,FName,LName FROM tblcustomers".$baseQuery2." LIMIT $LowerLimit,$UpperLimit";
					  }
				 }
			
			$nCount=0;
            $DataBase->query($strQuery);
			
			 if($DataBase->get_num_rows()>0)
				 {
				     echo "<table border=\"0\" width=\"95%\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"003366\" align=\"center\">
						<tr>
							<td class=\"style2\" width=\"8%\"><b>Edit</b></td>
							<td class=\"style2\" width=\"8%\"><b>Delete</b></td>
							<td class=\"style2\" width=\"35%\"><b>Name</b></td>
							<td class=\"style2\" width=\"10%\"><b>Orders</b></td>
						</tr>";
				     $DataBase->move_to_row($start);
				     $i=0;
					 
					 for($i=$start;$i<$count&&$i<$start+$pagesize;$i++)
                     {
						 $val = $DataBase->fetch_row();
		                 $CID	= $val[0];
			             $FName		= $val[1];
		        	     $LName		= $val[2];
         			     $sal    = $val[3];
						 
						 
						 echo "<tr>
							<td class=\"style1\"><a href=\"edit_Customer.php?ID=$CID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&Mod=$Mod&Type=$Type\"><img src=\"graphics/edit.gif\" border=0 alt=\"Edit\"></a></td>
							<td class=\"style1\"><a href=\"removecustomer_action.php?ID=$CID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&Mod=$Mod&Type=$Type\" onClick=\"return confirm('If you DELETE this customer, this will result in permanent loss of ALL the ORDERS posted by this customer. Are you sure, you want to DELETE this customer?');\">
							<img src=\"graphics/delete.gif\" border=0 alt=\"Delete\"></a></td>
							<td class=\"style1\">$sal $FName $LName</td>
							<td class=\"style1\"><a href=\"view_orders.php?ID=$CID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&Mod=$Mod&Type=$Type\">View Orders</a></td>
							 </tr>";
						$nCount++;
					}
					echo "</table><br>";
				 }
				 else
				 {
				   echo "No Customer Record Found !!!";
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
                        window.location.href = 'customers.php?Type=2';
                }

function LUPU_Show()
                {
                        window.location.href = 'customers.php?Type=1';
                }
function Recent_Show()
                {
                        window.location.href = 'customers.php?Type=3';
                }
function UnValid_Show()
{
                        window.location.href = 'customers.php?Type=4';
}
</script>
	
<?
global $Type;
switch ($Type)
{
	case 1:
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"customers.php\">Manage Customers</a> > Manage LUPU Customers</div>";
		break;
	case 2:
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"customers.php\">Manage Customers</a> > Manage Full Service Customers</div>";
		break;
	case 3:
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"customers.php\">Manage Customers</a> > Manage Recent Customers</div>";
		break;
	case 4:
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"customers.php\">Manage Customers</a> > Manage Unvalidated Customers</div>";
		break;
	default:
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > Manage Customers</div>";
		break;
}
?>	
	
	<br><br>
   <table border="0" cellspacing="0" cellpadding="0" >
	  <form action="customer_search_action.php" method="post" onSubmit="return CheckForm(this);">
	  <input type="hidden" name="nSearchCrit" value="0">
<?
global $Type;
echo "<input type=\"hidden\" name=\"Type\" value=\"$Type\">";
?>
		<tr>
			<td align="right" width="150"><b>Search:</b></td>
			<td>&nbsp;&nbsp;<input type="text" name="SearchString" SIZE="20" maxlength="32" value=""></td>
	    </tr>
		<tr>
			<td >&nbsp;</td>
	    </tr>
        <tr>
		    <td align="right"></td>
		   <td>
			    <INPUT type="radio"  name="Mod" value="1" checked> Email Address
				<INPUT type="radio"  name="Mod" value="2"> First Name
				<INPUT type="radio"  name="Mod" value="3"> Last Name &nbsp;
				<input type="submit" value="Search Customer" class="waButton1">
				<br><br>
<?
global $Type;
if($Type != 1)
{
	echo "<p><input name=\"submit1\" type=\"button\" class=\"waButton1\" value=\"Show LUPU Customers\" onClick=\"LUPU_Show();\"></p>";
}
if($Type != 2)
{
	echo "<p><input name=\"submit2\" type=\"button\" class=\"waButton1\" value=\"Show Full Service Customers\" onClick=\"FS_Show();\"></p>";
}
if($Type != 3)
{
	echo "<p><input name=\"submit3\" type=\"button\" class=\"waButton1\" value=\"Show Recent Customers\" onClick=\"Recent_Show();\"></p>";
}
if($Type != 4)
{
	echo "<p><input name=\"submit4\" type=\"button\" class=\"waButton1\" value=\"Show Unvalidated Customers\" onClick=\"UnValid_Show();\"></p>";
}
?>
			</td>
	    </tr>
	  	</form>
	</table><br>
	
<?

   	echo "<center>"; AlphaIndex(); echo "</center><br>";
	
			
?>

<? 
if($_SERVER['QUERY_STRING'] != "")
{
	displayCustomers($nSearchCrit,$SearchString);
	Navigation();
}
?>


<?
   include "footer.php";
?>
  
   
   