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
    
  
?>

<script language="JavaScript">

function LUPU_Show()
                {
                        window.location.href = 'members_lupu.php';
                }

function Recent_Show()
                {
                        window.location.href = 'members_recent.php';
                }


</script>

<? 
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
		   global $i,$count,$pagesize,$start,$nSearchCrit,$SearchString;
		   
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
			     echo "<a href='members_fs.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$previous'> Previous </a>";
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
						echo "<a href='members_fs.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$j'> $k </a>&nbsp";
				   }		
			   }
			   if($count>($start+$pagesize))
			   {
				  $m = $start+$pagesize;
				  echo "<a href='members_fs.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$m'> Next </a>";
			   }
			   echo "<br></center>";
			
			}   
		   
		}   	
		
   
   function AlphaIndex()
		{
		  global $SearchString;
		  for($i=65;$i<91;$i++)
		  {
		      $strAlpha = chr($i);
			  if (strcmp($strAlpha,$SearchString) == 0)
			  {
			    echo "<b>$strAlpha</b>&nbsp;&nbsp;";
			  }
			  else
			  {
			    echo "<a href='members_fs.php?SearchString=$strAlpha&nSearchCrit=1' title='$strAlpha'>
				          <b>$strAlpha</b> &nbsp;&nbsp;
				      </a>";  
			  }
		  }
		}	
		
		function displayMembers($nSearchCrit,$SearchString)
		{
		   global $DataBase,$i,$count,$pagesize,$start,$offset,$SearchString,$Mod;
    	   $pagesize = 10;
		   $UpperLimit = $pagesize;
		   $LowerLimit = $start;

		   if (!isset($offset))
			{
    			$offset=0;
			}
			
			    if (($nSearchCrit == '0') && ($Mod == "1"))
				{
					  if (!isset($count))
						  {
							$strQuery = "SELECT MemberID,MemberName,Active FROM tblmembers where ContactEmail LIKE '%$SearchString%' and MemberType='full'";
							$DataBase->query($strQuery);
							$count=$DataBase->get_num_rows();
						  }
						   $strQuery = "SELECT MemberID,MemberName,Active FROM tblmembers where ContactEmail LIKE '%$SearchString%' and MemberType='full' LIMIT $LowerLimit,$UpperLimit";
                }
														   
				if (($nSearchCrit == '0') && ($Mod == "2"))
				{	  
					     if (!isset($count))
						  {
							$strQuery = "SELECT MemberID,MemberName,Active FROM tblmembers where MemberName LIKE '%$SearchString%' and MemberType='full'"; 
							$DataBase->query($strQuery);
							$count=$DataBase->get_num_rows();
						  }
						   $strQuery = "SELECT MemberID,MemberName,Active FROM tblmembers where MemberName LIKE '%$SearchString%' and MemberType='full' LIMIT $LowerLimit,$UpperLimit";
				}
				if (($nSearchCrit == '0') && ($Mod == "3"))
				{
					      if (!isset($count))
						  {
							$strQuery = "SELECT MemberID,MemberName,Active FROM tblmembers where ContactPerson LIKE '%$SearchString%' and MemberType='full'";
							$DataBase->query($strQuery);
							$count=$DataBase->get_num_rows();
						   }
						   $strQuery = "SELECT MemberID,MemberName,Active FROM tblmembers where ContactPerson LIKE '%$SearchString%' and MemberType='full' LIMIT $LowerLimit,$UpperLimit";
				}
				
				if ($nSearchCrit == '1')
				{
					  if (!isset($count))
					  {
						$strQuery = "SELECT MemberID,MemberName,Active FROM tblmembers where MemberName LIKE '$SearchString%' and MemberType='full'";
						$DataBase->query($strQuery);
						$count=$DataBase->get_num_rows();
					  }
					  else
					  {
					   $strQuery = "SELECT MemberID,MemberName,Active FROM tblmembers where MemberName LIKE '$SearchString%' and MemberType='full'";
					  }
				}
				
				if (($nSearchCrit == '0') && (!(isset($Mod))))
				{
				     if (!isset($count))
					  {
						$strQuery = "SELECT MemberID,MemberName,Active FROM tblmembers where MemberType='full'";
						$DataBase->query($strQuery);
						$count=$DataBase->get_num_rows();
					  }
    			       else
					  {
					   $strQuery = "SELECT MemberID,MemberName,Active FROM tblmembers where MemberType='full' LIMIT $LowerLimit,$UpperLimit";
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
							<td class=\"style2\" width=\"15%\"><b>Status</b></td>
							<td class=\"style2\" width=\"10%\"><b>Jobs</b></td>
						</tr>";
				     $DataBase->move_to_row($start);
				     $i=0;
					 
					 for($i=$start;$i<$count&&$i<$start+$pagesize;$i++)
                     {
						 $val = $DataBase->fetch_row();
		                 $MID	= $val[0];
			             $Name		= $val[1];
						 $Status		= $val[2];
		        	     						 
						 echo "<tr>
							<td class=\"style1\"><a href=\"edit_Member.php?ID=$MID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset\"><img src=\"graphics/edit.gif\" border=0 alt=\"Edit\"></a></td>
							<td class=\"style1\"><a href=\"removemember_action.php?ID=$MID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset\" onClick=\"return confirm('If you DELETE this member from your netwok, this will result in permanent loss of ALL the JOBS associated with this member. Are you sure, you want to DELETE this Member?');\">
							<img src=\"graphics/delete.gif\" border=0 alt=\"Delete\"></a></td>
							<td class=\"style1\">$Name</td>
							<td class=\"style1\">";
							  if($Status == "1")
							  {
							    $show = "<a href=\"change_member_status.php?ID=$MID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&status=1\" title=\"Click here to deactivate the status of this member\">DeActivate</a>";
							  }
							  elseif($Status == "0")
							  {
							    $show = "<a href=\"change_member_status.php?ID=$MID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&status=0\" title=\"Click here to activate the status of this member\">Activate</a>";
							  }
							echo "$show</td><td class=\"style1\"><a href=\"view_jobs.php?ID=$MID&nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset\">View Jobs</a></td>
							 </tr>";
						$nCount++;
					}
					echo "</table><br>";
				 }
				 else
				 {
				   echo "No Member Record Found !!!";
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
</script>

   <div align="left"><a href="EManager.php">EManager(Home)</a> > <a href="members.php">Manage Members</a> > Manage Full Service Members</div>
	<br><br>
	
   <table border="0" cellspacing="0" cellpadding="0" >
	  <form action="member_search_action_fs.php" method="post" onSubmit="return CheckForm(this);">
	  <input type="hidden" name="nSearchCrit" value="0">
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
				<INPUT type="radio"  name="Mod" value="2"> Member(Mover) Name
				<INPUT type="radio"  name="Mod" value="3"> Contact Person &nbsp;
				<input type="submit" value="Search Member" class="waButton1"><br>
              <br>
           <p>
              <input name="submit2" type="button" class="waButton1" value="Show LUPU Members Only" onClick="LUPU_Show();">
            </p>
			<p>
              <input name="submit3" type="button" class="waButton1" value="Show Recent Members" onClick="Recent_Show();">
            </p>
</td>
	    </tr>
	  	</form>
	</table><br>
	
<?

   	echo "<center>"; AlphaIndex(); echo "</center><br>";
	
			
?>

<? displayMembers($nSearchCrit,$SearchString);Navigation(); ?>
<!--<form action="create_member.php" method="post">
	<input type="submit" value="Add New Member" class="waButton1" />
</form>
<form action="restore_customers.php" method="post">
	<input type="submit" value="View Removed/Deleted Customers" class="waButton1" />
</form>-->
<?
   include "footer.php";
?>
  
   
   