<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   error_reporting(0);
   
   $count    = $_GET['count'];
   $offset   = $_GET['offset'];
   
  
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
		   global $i,$count,$pagesize,$start;
		   
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
			     echo "<a href='feedback.php?count=$count&offset=$previous'> Previous </a>";
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
						echo "<a href='feedback.php?count=$count&offset=$j'> $k </a>&nbsp";
				   }		
			   }
			   if($count>($start+$pagesize))
			   {
				  $m = $start+$pagesize;
				  echo "<a href='feedback.php?count=$count&offset=$m'> Next </a>";
			   }
			   echo "<br></center>";
			
			}   
		   
		}   	
		
       function displayfeedback()
		{
		   global $DataBase,$i,$count,$pagesize,$start,$offset;
    	   $pagesize = 10;
		   $UpperLimit = $pagesize;
		   $LowerLimit = $start;
           //echo "Mod".$Mod;
		   //echo "nSearchCrit".$nSearchCrit;
		   if (!isset($offset))
			{
    			$offset=0;
			}
			
			   if (!isset($count))
				{
					$strQuery = "SELECT tid,name,rate,date,feed_type,service_type FROM feedback";
					$DataBase->query($strQuery);
					$count=$DataBase->get_num_rows();
				 }
    			  else
				 {
					   $strQuery = "SELECT tid,name,rate,date,feed_type,service_type FROM feedback ORDER BY date DESC LIMIT $LowerLimit,$UpperLimit";
				}
				
			
			
			$nCount=0;
            $DataBase->query($strQuery);
			
			 if($DataBase->get_num_rows()>0)
				 {
				     echo "<table border=\"0\" width=\"95%\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"003366\" align=\"center\">
						<tr>
							<td class=\"style2\" width=\"13%\"><b>Name</b></td>
							<td class=\"style2\" width=\"10%\"><b>FeedbackType</b></td>
							<td class=\"style2\" width=\"13%\"><b>ServiceType</b></td>
							<td class=\"style2\" width=\"3%\"><b>Rate</b></td>
							<td class=\"style2\" width=\"10%\"><b>Date</b></td>
						</tr>";
				     $DataBase->move_to_row($start);
				     $i=0;
					 
					 for($i=$start;$i<$count&&$i<$start+$pagesize;$i++)
                     {
						 $val = $DataBase->fetch_row();
		                 $FID	= $val[0];
			             $Name		= $val[1];
		        	     $Rate		= $val[2];
         			     $Date    = $val[3];
						 $FType    = $val[4];
						 $SType    = $val[5];
						 
					     if ($SType == "full")
						 {
						   $SType = "Full Service Mover Provider";
						 }
						 elseif($SType == "lupu")
						 {
						   $SType = "Loading/Unloading provider";
						 }
						 elseif($SType == "transport")
						 {
						   $SType = "Transportation providers";
						 }
						 elseif($SType == "storage")
						 {
						   $SType = "Storage Facilities";
						 }
						 elseif($SType == "packingsupplied")
						 {
						   $SType = "Packing Supplies Provider";
						 }
						 elseif($SType == "Beta")
						 {
						   $SType = "Website issue";
						 }		 	 
						 echo "<tr>
							<td class=\"style1\"><a href=\"view_feedback.php?ID=$FID&count=$count&offset=$offset\" title=\"Click Here to View Details\">$Name</td>
							<td class=\"style1\">$FType</td>
							<td class=\"style1\">$SType</td>
							<td class=\"style1\">$Rate"."/5"."</td>
							<td class=\"style1\">$Date</td>
							 </tr>";
						$nCount++;
					}
					echo "</table><br>";
				 }
				 else
				 {
				   echo "No Feedback Found !!!";
				 }
		}
   
?>

	<div align="left"><a href="EManager.php">EManager(Home)</a> > Feedbacks</div>
	<br>
	
	<?
	echo "<h2>Feedbacks</h2><br>";
    displayfeedback();Navigation();;   
?>
</table><br>

<?
   include "footer.php";
?>
  
   
   