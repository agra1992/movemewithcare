<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   error_reporting(0);   
   
   $nSearchCrit  = $_GET['nSearchCrit']; 	//string_search=0, alpha=1
   $count        = $_GET['count'];			//number of items
   $offset        = $_GET['offset'];		//first_position of number naviagation, 1:0, 2:10
   $SearchString  = $_GET['SearchString'];	//search string
   $Mod  = $_GET['Mod'];					//email=1, firstname=2, lastname=3
   $Type = $_GET['Type'];					//lupu=1, fs=2, rc=3   
  

	if (!isset($Mod))
			{
              $Mod = 0;
			}
   if (!isset($nSearchCrit))
			{
              $nSearchCrit = 0;
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
			     echo "<a href='affiliates.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$previous&Mod=$Mod&Type=$Type'> Previous </a>";
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
						echo "<a href='affiliates.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$j&Mod=$Mod&Type=$Type'> $k </a>&nbsp";
				   }		
			   }
			   if($count>($start+$pagesize))
			   {
				  $m = $start+$pagesize;
				  echo "<a href='affiliates.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$m&Mod=$Mod&Type=$Type'> Next </a>";
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
			    echo "<a href='affiliates.php?SearchString=$strAlpha&nSearchCrit=1&Type=$Type' title='$strAlpha'>
				          <b>$strAlpha</b> &nbsp;&nbsp;
				      </a>";  
			  }
		  }
		}	
		
		function displayMembers($nSearchCrit,$SearchString)
		{
		   global $DataBase,$i,$count,$pagesize,$start,$offset,$SearchString,$Mod,$Type;
    	   $pagesize = 10;
		   $UpperLimit = $pagesize;
		   $LowerLimit = $start;			
		   $date_week_ago=date('Y-m-d h:i:s', strtotime("-1 week"));
		   $baseQuery1="";
		   $baseQuery2="";
		   switch ($Type)
		   {
		   	case 1:
		   		{
		   			$baseQuery1=" and MemberType='transport'";
		   			$baseQuery2=" where MemberType='transport'";
		   			break;
		   		}
		   	case 2:
		   		{
		   			$baseQuery1=" and MemberType='packing'";
		   			$baseQuery2=" where MemberType='packing'";
		   			break;
		   		}
		   	case 3:
		   		{
		   			$baseQuery1=" and MemberType='storage'";
		   			$baseQuery2=" where MemberType='storage'";
		   			break;
		   		}
		   	case 4:
		   		{
		   			$baseQuery1=" and (MemberType='storage' or MemberType='packing' or MemberType='transport' ) and DateAdded > '$date_week_ago' ORDER BY DateAdded DESC";
		   			$baseQuery2=" where (MemberType='storage' or MemberType='packing' or MemberType='transport') and DateAdded > '$date_week_ago' ORDER BY DateAdded DESC";
                                        $table= "tblmembers";
		   			break;
		   		}
		   	default:
		   		{
		   			$baseQuery1=" and (MemberType='transport' or MemberType='packing' or MemberType='storage')";
		   			$baseQuery2=" where MemberType='transport' or MemberType='packing' or MemberType='storage'";
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
							$strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers where ContactEmail LIKE '%$SearchString%'".$baseQuery1;
							$DataBase->query($strQuery);
							$count=$DataBase->get_num_rows();
						  }												
						   $strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers where ContactEmail LIKE '%$SearchString%'".$baseQuery1." LIMIT $LowerLimit,$UpperLimit";
                }
														   
				if (($nSearchCrit == '0') && ($Mod == "2"))
				{	  
					     if (!isset($count))
						  {
							$strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers where MemberName LIKE '%$SearchString%'".$baseQuery1; 
							$DataBase->query($strQuery);							
							$count=$DataBase->get_num_rows();
						  }
						   $strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers where MemberName LIKE '%$SearchString%'".$baseQuery1." LIMIT $LowerLimit,$UpperLimit";
				}
				if (($nSearchCrit == '0') && ($Mod == "3"))
				{
					      if (!isset($count))
						  {
							$strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers where ContactPerson LIKE '%$SearchString%'".$baseQuery1;
							$DataBase->query($strQuery);
							$count=$DataBase->get_num_rows();
						  }
						   $strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers where ContactPerson LIKE '%$SearchString%'".$baseQuery1." LIMIT $LowerLimit,$UpperLimit";
				}
				if (($nSearchCrit == '0') && ($Mod == "4"))
				{
                                    $sql="SELECT  StateID FROM states WHERE sh_name like '%$SearchString%'";
                                    $r_state=mysql_query($sql);
                                    $r_state=mysql_fetch_row($r_state);
                                    $state_name="%".$r_state[0]."%";
					      if (!isset($count))
						  {
							$strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers where MemberState LIKE '$state_name'".$baseQuery1;
							$DataBase->query($strQuery);
							$count=$DataBase->get_num_rows();
						  }
						   $strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers where MemberState LIKE '$state_name'".$baseQuery1." LIMIT $LowerLimit,$UpperLimit";
				}
				
				if ($nSearchCrit == '1')
				{
					  if (!isset($count))
					  {
						$strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers where MemberName LIKE '$SearchString%'".$baseQuery1;
						$DataBase->query($strQuery);						
						$count=$DataBase->get_num_rows();
					  }
					  else
					  {
					   $strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers where MemberName LIKE '$SearchString%'".$baseQuery1." LIMIT $LowerLimit,$UpperLimit";
					  }
				}
				
				if (($nSearchCrit == '0') && ($Mod == 0))
				{
				     if (!isset($count))
					  {
						$strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers".$baseQuery2;
						$DataBase->query($strQuery);
						$count=$DataBase->get_num_rows();
					  }
    			       else
					  {
					   $strQuery = "SELECT MemberID,MemberName,Active,State,ContactPerson,Phone,TollFree,MemberState FROM tblmembers".$baseQuery2." LIMIT $LowerLimit,$UpperLimit";
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
							<td class=\"style2\" width=\"20%\"><b>Name</b></td>
							<td class=\"style2\" width=\"13%\"><b>Status</b></td>
							<td class=\"style2\" width=\"6%\"><b>Service Area</b></td>
							<td class=\"style2\" width=\"6%\"><b>State</b></td>
							<td class=\"style2\" width=\"10%\"><b>Contact Person</b></td>
							<td class=\"style2\" width=\"10%\"><b>Phone</b></td>
							<td class=\"style2\" 
width=\"10%\"><b>Toll Free</b></td>

						</tr>";
				     $DataBase->move_to_row($start);
				     $i=0;
					 
					 for($i=$start;$i<$count&&$i<$start+$pagesize;$i++)
                     {
						 $val = $DataBase->fetch_row();
		                 $MID	= $val[0];
			             $Name		= $val[1];			             
						 $Status		 = $val[2];						 						 $State		 = $val[3];		
	 						 $CPerson      = $val[4];	
	 						 $phone		= $val[5];	
	 						 $phone2	= $val[6];		        	     	 						 $m_state	= $val[7];				
$query = "SELECT `sh_name` FROM `states` WHERE `StateID`='$m_state' LIMIT 1";
$result = mysql_query($query) or die("Query failed: 4");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$m_state = $line[sh_name];

 
						 echo "<tr>
							<td class=\"style1\"><a href=\"edit_affiliate.php?ID=$MID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&Mod=$Mod&Type=$Type\"><img src=\"graphics/edit.gif\" border=0 alt=\"Edit\"></a></td>
							<td class=\"style1\"><a href=\"removeaffiliate_action.php?ID=$MID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&Mod=$Mod&Type=$Type\" onClick=\"return confirm('If you DELETE this affiliate from your netwok, this will result in permanent loss of ALL the JOBS associated with this affiliate. Are you sure, you want to DELETE this Affiliate?');\">
							<img src=\"graphics/delete.gif\" border=0 alt=\"Delete\"></a></td>
							<td class=\"style1\">$Name</td>
							<td class=\"style1\">";
							  if($Status == "1")
							  {
							    $show = "<a href=\"change_affiliate_status.php?ID=$MID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&status=1&Mod=$Mod&Type=$Type\" title=\"Click here to deactivate the status of this member\">DeActivate</a>";
							  }
							  elseif($Status == "0")
							  {
							    $show = "<a href=\"change_affiliate_status.php?ID=$MID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&status=0&Mod=$Mod&Type=$Type\" title=\"Click here to activate the status of this member\">Activate</a>";
							  }							  
							  
							echo "$show</td>
                                                        <td class=\"style1\">$State</td>
                                                        <td class=\"style1\">$m_state</td>
                                                        <td class=\"style1\">$CPerson</td>
                                                        <td class=\"style1\">$phone</td>
                                                        <td class=\"style1\">$phone2</td></tr>";

						$nCount++;						
					}
					echo "</table><br>";
				 }
				 else
				 {
				   echo "No Affiliate Record Found !!!";
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
	
	function Trans_Show()
    {
            window.location.href = 'affiliates.php?Type=1';
    }

	function Packing_Show()
    {
            window.location.href = 'affiliates.php?Type=2';
    }
    
	function Storage_Show()
    {
            window.location.href = 'affiliates.php?Type=3';
    }
    function Recent_Show()
    {
            window.location.href = 'affiliates.php?Type=4';
    }
</script>
<?
global $Type;
switch ($Type)
{
	case 1:
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"affiliates.php\">Manage Affiliates</a> > Manage Transportation Service Providers</div>";
		break;
	case 2:
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"affiliates.php\">Manage Affiliates</a> > Manage Packing Service Providers</div>";
		break;
	case 3:
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"affiliates.php\">Manage Affiliates</a> > Manage Storage Service Providers</div>";
		break;
	case 4:
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > <a href=\"affiliates.php\">Manage Affiliates</a> > Manage Recent Affiliates</div>";
		break;
	default:
		echo "<div align=\"left\"><a href=\"EManager.php\">EManager(Home)</a> > Manage Affiliates</div>";
		break;
}
?>	
   
	<br><br>
	
   <table border="0" cellspacing="0" cellpadding="0" >
	  <form action="affiliate_search_action.php" method="post" onSubmit="return CheckForm(this);">
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
				<INPUT type="radio"  name="Mod" value="2"> Company Name
				<INPUT type="radio"  name="Mod" value="3"> Contact Person &nbsp;
				<INPUT type="radio"  name="Mod" value="4"> Company State &nbsp;
				<input type="submit" value="Search Affiliate" class="waButton1"><br>
              <br>
              <br>
<?
		global $Type;
		if($Type != 1)
		{
			echo "<p><input name=\"submit1\" type=\"button\" class=\"waButton1\" value=\"Show Transportation Service Providers\" onClick=\"Trans_Show();\"></p>";
		}
		if($Type != 2)
		{
			echo "<p><input name=\"submit2\" type=\"button\" class=\"waButton1\" value=\"Show Packing Service Providers\" onClick=\"Packing_Show();\"></p>";
		}
		if($Type != 3)
		{
			echo "<p><input name=\"submit3\" type=\"button\" class=\"waButton1\" value=\"Show Storage Service Providers\" onClick=\"Storage_Show();\"></p>";
		}
		if($Type != 4)
		{
			echo "<p><input name=\"submit4\" type=\"button\" class=\"waButton1\" value=\"Show Recent Affiliates\" onClick=\"Recent_Show();\"></p>";
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
		displayMembers($nSearchCrit,$SearchString);
		Navigation(); 
	}
?>
<?
   include "footer.php";
?>
  
   
   
   