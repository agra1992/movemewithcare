<?php
session_start();
include "Security.php"; 
require "top_panel_members.php";

include_once "Calendar.php";

     $day = $_GET['day'];
	 $month = $_GET['month'];
	 $year = $_GET['year'];
	 $state_id=0;
	 $rows_displayed=0;
	
	 
	 $d = getdate(time());
	
	if ($month == "")
	{
		$month = $d["mon"];
	}
	
	if ($year == "")
	{
		$year = $d["year"];
	}
	
	if ($day == "")
	{
		$day = $d["mday"];
	}
	
	
	  class MyCalendar extends Calendar
	 {
		function getCalendarLink($month, $year)
		{
	
			$s = getenv('SCRIPT_NAME');
			return "$s?month=$month&year=$year";
		}
		
		function getDateLink($day, $month, $year)
		{
			$s = getenv('SCRIPT_NAME'); 
			return "$s?day=$day&month=$month&year=$year";
		}
	
	 }
if($_SESSION['Member_Type'] == "market"){
$update_link='update_market_details.php';
}
else{
$update_link='update_details.php';
}
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
<table width="98%" border="1" bordercolor="#003366" cellspacing="0">
  <tr>
    <td width="34%" valign="top">
	        <font style="FONT: bold 15px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 3px;">Welcome  
	         <b><? echo $_SESSION['Member_Name']; ?></b></font> <br>
             <br> <b><font face="Verdana" size="2"><b>Company: </b></font></b> 
		     <font face="Verdana" size="2"> <? echo $_SESSION['Member_Name']; ?></font>
	          <br><b><font face="Verdana" size="2">Contact: </font></b><font face="Verdana" size="2"><? echo $_SESSION['Member_Contact']; 
			       ?> </font>
   		      <br><b><font face="Verdana" size="2">Email: </font></b><font face="Verdana" size="2"><? echo $_SESSION['Member_Email']; ?> 
			      </font>
		       <br><b><font face="Verdana" size="2">Phone: </font></b><font face="Verdana" size="2"><? echo $_SESSION['Member_Phone']; ?> </font>
		         <br><b><font face="Verdana" size="3"><a href="<? echo"$update_link"?>?day=<?=$day?>&month=<?=$month?>&year=<?=$year?>">Update these details</a></font></b>
	</td>
    <td width="42%" valign="top"> 
	       <font style="FONT: bold 15px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 3px;">
		 <?  if ($_SESSION['Member_Type'] == "standard")
				{
				  echo "Available Jobs";
				}
				if ($_SESSION['Member_Type'] == "full")
				{
				  echo "Available Leads";
				}
				if ($_SESSION['Member_Type'] == "market")
				{
				  echo "Available Orders";
				}
		?>
	 </font><br><br>
	 <? 
	         if ($_SESSION['Member_Type'] == "standard")
			 {
				 Jobs($day,$month,$year);
				  
			 } 
			 if ($_SESSION['Member_Type'] == "full")
			 {
			 	 Jobs($day,$month,$year);
				 Leads_Full($day,$month,$year);
			 }
			 if ($_SESSION['Member_Type'] == "market")
			 {
			 	 Orders($day,$month,$year);

			 }
			 
			 if ($_SESSION['Member_Type'] == "standard")
			 {
			 	  if($rows_displayed == 0)
			 	  {
			 	  	  if(empty($day))
					  {
					     echo "<b><font face=\"Verdana\" size=\"2\">No Jobs Available for this month.</font></b>";
					  }
					  else
					  {
					     echo "<b><font face=\"Verdana\" size=\"2\">No Jobs Available for " . $month . "/" . $day . "/" . $year. "</font></b>";
					  }
			 	  }
			 }
			 else if($_SESSION['Member_Type'] == "full")
			 {
			 	if($rows_displayed == 0)
				 {
					   if(empty($day))
					   {
					     echo "<b><font face=\"Verdana\" size=\"2\">No Jobs nor Leads Available for this month.</font></b>";
					   }
					   else
					   {
					     echo "<b><font face=\"Verdana\" size=\"2\">No Jobs nor Leads Available for " . $month . "/" . $day . "/" . $year. "</font></b>";
					   }
				 }
			 }
			 else if($_SESSION['Member_Type'] == "market")
			 {
			 	if($rows_displayed == 0)
				 {
					   if(empty($day))
					   {
					     echo "<b><font face=\"Verdana\" size=\"2\">No Orders Available for this month.</font></b>";
					   }
					   else
					   {
					     echo "<b><font face=\"Verdana\" size=\"2\">No Orders Available for " . $month . "/" . $day . "/" . $year. "</font></b>";
					   }
				 }
			 }
	 ?>
	</td>
    <td width="24%" valign="top">
	<?
				if ($_SESSION['Member_Type'] == "full")
				{
				  echo "<font face=\"Verdana\" size=\"2\" color=\"blue\"><b>BLUE = </b></font>
	            <font face=\"Verdana\" size=\"2\">";
				  echo "Jobs Available</font>";
				  echo "<br>";
				  echo "<font face=\"Verdana\" size=\"2\" color=\"green\"><b>GREEN = </b></font>
	            <font face=\"Verdana\" size=\"2\">";
				  echo "Leads Available</font>";
				  echo "<br>";
	             echo "<font face=\"Verdana\" size=\"2\" color=\"orange\"><b>ORANGE = </b></font>
	            <font face=\"Verdana\" size=\"2\">No Jobs nor Leads Available</font>";
				}
				else if ($_SESSION['Member_Type'] == "standard")
				{
				  echo "<font face=\"Verdana\" size=\"2\" color=\"blue\"><b>BLUE = </b></font>
	            <font face=\"Verdana\" size=\"2\">";
				   echo "Jobs Available</font>";
				  echo "<br>";
	             echo "<font face=\"Verdana\" size=\"2\" color=\"orange\"><b>ORANGE = </b></font>
	            <font face=\"Verdana\" size=\"2\">No Jobs Available</font>";
				}
				else if ($_SESSION['Member_Type'] == "market")
				{
				  echo "<font face=\"Verdana\" size=\"2\" color=\"blue\"><b>BLUE = </b></font>
	            <font face=\"Verdana\" size=\"2\">";
				   echo "Orders Available</font>";
				  echo "<br>";
	          
				}
				
if ($_SESSION['Member_Type'] == "full")
{
    $info_sql = "SELECT `InterstateLicense` , `MemberState`, `ServiceCountry` FROM tblmembers WHERE MemberID = '".$_SESSION['Member_Id']."'"; 
	 $InfoQuery = mysql_query($info_sql) or die("cannot get data from DB");
	 $Info = mysql_fetch_object($InfoQuery);
	 $license=$Info->InterstateLicense;
	 $m_state=$Info->MemberState;
	 $country=$Info->ServiceCountry;
}   
	   echo "<br><br>";
	   $cal = new MyCalendar;
	   echo "<center>";

	   echo $cal->getMonthView($month, $year, $state_id, $m_state, $service_state, $license, $country);

	   echo "</center>";
	   echo "<br><br>";

	?>
	</td>
  </tr>
</table>

<?
  function Orders($day, $month, $year)
{
     global $link,$day,$month,$year,$state_id,$rows_displayed;
	 if ((strlen($day) == "1") && ($day != "0"))
	 {
		$day = "0".$day;
	}  
	if ((strlen($day) != "1") && ($day != "0"))
	{
		$day = $day;
	}   
	 $datevar = $year . "-" . $month . "-" . $day;

	 
	 $str = "SELECT * FROM market_orders_sent_list WHERE MID='".$_SESSION['Member_Id']."'";

    $result = mysql_query($str) or die("Query failed1");
	$rows_displayed = mysql_num_rows($result);
	
	if (!empty($rows_displayed))
	{
            echo"<b><font face=\"Verdana\" size=\"1\"><table>";
	    while( $Info = mysql_fetch_object($result) )
		 {
                      $sql="Select FName, LName, OrderTime from tbl_market_orders Where OrderID='".$Info->OrderID."'";
                      $r=mysql_query($sql) or die("query failed:278");
	                  while( $Data = mysql_fetch_object($r) )
		         {
                  echo"
                 <tr><td align=left>Name:".$Data->FName." ".$Data->LName." </td><tr>
                 <tr><td align=left>Date Submitted:".$Data->OrderTime."</td></tr>
                 <tr><td aling=left><a href='order_details.php?OrderID=".$Info->OrderID."' >view details </a></td></tr>";
                         }
                 }
            echo"</table></font>";
	}	 
}
  function Leads_Full($day,$month,$year)
  {
     global $link,$day,$month,$year,$state_id,$rows_displayed;
	 if ((strlen($day) == "1") && ($day != "0"))
	 {
		$day = "0".$day;
	}  
	if ((strlen($day) != "1") && ($day != "0"))
	{
		$day = $day;
	}   
	 $datevar = $year . "-" . $month . "-" . $day;
	 //get the company's zip code and short state name
	 $sql = "SELECT * FROM tblmembers WHERE MemberID = '".$_SESSION['Member_Id']."'";
	 $MemberQuery = mysql_query($sql) or die("cannot get member data from DB");
	 $MemberInfo = mysql_fetch_object($MemberQuery);

	 $Member_State_ZipCode = $MemberInfo->ZipCode;
	 $Service_State = $MemberInfo->State;
	 $Member_State = $MemberInfo->MemberState;
         $license = $MemberInfo-> InterstateLicense;
         $country = $MemberInfo-> ServiceCountry;
	 //get number of state
	 $sql = "SELECT * FROM states WHERE sh_name = '".$Service_State."'";
	 $StateQuery = mysql_query($sql) or die("cannot get state data from DB");
	 $StateInfo = mysql_fetch_object($StateQuery);
	 $state_id=$StateInfo->StateID;


             if($Member_State == 999)
             {
                 if(  $country == "USA")
                 {   
	             $str = "SELECT * FROM tbl_fs_orders WHERE (tbl_fs_orders.Or_State <52) AND tbl_fs_orders.MoveDate = '".$datevar."%'";
                  }
                  else{
 	              $str = "SELECT * FROM tbl_fs_orders WHERE (tbl_fs_orders.Or_State >52) AND tbl_fs_orders.MoveDate = '".$datevar."%'";
                  }
             }else{
                 if($license == 1)
                 {
                     if(  $country == "USA")
                     {   
	                 $str = "SELECT * FROM tbl_fs_orders WHERE tbl_fs_orders.Or_State <52 AND tbl_fs_orders.Or_State = '$Member_State' AND tbl_fs_orders.MoveDate = '".$datevar."%'";
                     }
                     else{
	                 $str = "SELECT * FROM tbl_fs_orders WHERE tbl_fs_orders.Or_State >52 AND tbl_fs_orders.Or_State = '$Member_State' AND tbl_fs_orders.MoveDate = '".$datevar."%'";
                      }
                 }else{
	             $str = "SELECT * FROM tbl_fs_orders WHERE (tbl_fs_orders.Or_State = '$StateInfo->StateID' and tbl_fs_orders.Dest_State = '$StateInfo->StateID') AND tbl_fs_orders.MoveDate = '".$datevar."%'";
                 }
             }

    $result = mysql_query($str) or die("Query failed1");
	$num = mysql_num_rows($result);
	
	if (!empty($num))
	{
		echo "<center><table>";
	
	while( $JobInfo = mysql_fetch_object($result) )
		 {

		   $MoveDate = explode('-',$JobInfo->MoveDate);
		   $MoveDay = date( "F j, Y", mktime(0, 0, 0, $month, $day, $year) );
		   
		   echo "<tr>";
		   echo "<font face=\"Verdana\" size=\"2\"><b>
							<td><a href=\"job_details1.php?OrderID=".$JobInfo->OrderID."&day=".$MoveDate[2]."&month=".$MoveDate[1]."&year=".$MoveDate[0]."\" 
							 style=\"text-decoration:none\" title=\"Click here to view details of this lead.\">".$MoveDay." - Full Service</a></b></font></td></tr>";

		 }
	echo "</table></center>";
	$rows_displayed += $num;
	}	 
  }
   
  function Jobs($day,$month,$year)
  { 
     global $link,$day,$month,$year,$state_id,$rows_displayed;
	if ((strlen($day) == "1") && ($day != "0"))
	 {
		$day = "0".$day;
	}  
	if ((strlen($day) != "1") && ($day != "0"))
	{
		$day = $day;
	}   
	 $datevar = $year . "-" . $month . "-" . $day;
	 //get companys zip code and short state name
	 $sql = "SELECT * FROM tblmembers WHERE MemberID = '".$_SESSION['Member_Id']."'";
	 $MemberQuery = mysql_query($sql) or die("cannot get member data from DB");
	 $MemberInfo = mysql_fetch_object($MemberQuery);

	 $Member_State_ZipCode = $MemberInfo->ZipCode;
	 $Member_State = $MemberInfo->MemberState;
	 //get number of state
	 $sql = "SELECT * FROM states WHERE sh_name = '".$MemberInfo->State."'";
	 $StateQuery = mysql_query($sql) or die("cannot get state data from DB");
	 $StateInfo = mysql_fetch_object($StateQuery);
	 $state_id=$StateInfo->StateID;
	 
	 $str = "";
	 if($Member_State == "999")
	 {
		$str = "SELECT * FROM tbl_lupu_orders WHERE ( ( (tbl_lupu_orders.Or_Load = '1' or tbl_lupu_orders.Or_Pack = '1') AND tbl_lupu_orders.Status_Origin != 'C') or ( (tbl_lupu_orders.Dest_Unload = '1' or tbl_lupu_orders.Dest_Unpack = '1') AND tbl_lupu_orders.Status_Dest != 'C')) AND tbl_lupu_orders.MoveDate = '$datevar%'";

	 }
	 else 
	 {
	 	$str = "SELECT * FROM tbl_lupu_orders
                        LEFT JOIN tblcustomers on (tbl_lupu_orders.IP = tblcustomers.IP)
                         WHERE tblcustomers.valid='yes' AND                                           ( (tbl_lupu_orders.Or_State = '$Member_State' AND 
                                          (tbl_lupu_orders.Or_Load = '1' or tbl_lupu_orders.Or_Pack = '1') AND 
                                          tbl_lupu_orders.Status_Origin != 'C') or 
                                          (tbl_lupu_orders.Dest_State = '$Member_State' AND 
                                          (tbl_lupu_orders.Dest_Unload = '1' or 
                                          tbl_lupu_orders.Dest_Unpack = '1') AND 
                                          tbl_lupu_orders.Status_Dest != 'C')) AND 
                                          tbl_lupu_orders.MoveDate = '$datevar%'";

	 }

    $result = mysql_query($str) or die("Query failed2");
	$num = mysql_num_rows($result);
	
	if (!empty($num))
	{
		echo "<center><table>";
	while( $JobInfo = mysql_fetch_object($result) )
		 {

		   $MoveDate = explode('-',$JobInfo->MoveDate);
		   $MoveDay = date( "F j, Y", mktime(0, 0, 0, $month, $day, $year) );
		    
		   if(($JobInfo->Or_Load == '1' || $JobInfo->Or_Pack == '1') && 
                       $JobInfo->Status_Origin != "C" && ($state_id == "999" || $JobInfo->Or_State == $state_id) )
		   {
		   	   $status = "";
		   	   $repost = 0;
		   	   $accept = 0;
		   	   
		   	   echo "<tr><td>";
		   	   
			   if($JobInfo->Status_Origin == "U")
			   {
			   	$accept = 1;
			   	$status = " Unaccepted";
			   }
			   else
			   {
			   	$jid = $JobInfo->OrderID."1";
			   	$str1 = "Select * from tbl_lupu_orders where OrderID = '$JobInfo->OrderID' and Origin_MID = '".$_SESSION['Member_Id']."'";
			   	$result1 = mysql_query($str1) or die("Query failed1");
			   	$num_ = mysql_num_rows($result1);
			   	
			   	//echo "Origin[ $str1 ]<hr>";
			   	
			   	if(empty($num_))
			   	{
			   		$accept = 0;
			   		$status = " Accepted by another member";
			   	}
			   	else 
			   	{
			   		$repost = 1;
			   		$status = " Accepted by you";
			   	}
			   }
			   
			   $postfix_jobs="ORIGIN Service";
			   
			   echo "<font face=\"Verdana\" size=\"2\"><b>
								<td><a href=\"job_details.php?OrderID=".$JobInfo->OrderID."&day=".$MoveDate[2]."&month=".$MoveDate[1]."&year=".$MoveDate[0]."&repost=".$repost."&accept=".$accept."&location=Origin\" 
								 title=\"Click here to view details of this job.\"><center>".$MoveDay." - ".$postfix_jobs."</center></a></b></font></td><td><font face=\"Verdana\" size=\"1\">".$status."</font></td></tr>";
		   }
		   
		   if(($JobInfo->Dest_Unload == '1' || $JobInfo->Dest_Unpack == '1') && 
                       $JobInfo->Status_Dest != "C" && ($state_id == "999" || $JobInfo->Dest_State == $state_id) )
		   {
		   	   $status = "";
		   	   $repost = 0;
		   	   $accept = 0;
		   	   
		   	   echo "<tr><td>";
		   	   
			   if($JobInfo->Status_Dest == "U")
			   {
			   	$accept = 1;
			   	$status = " Unaccepted";
			   }
			   else
			   {
			   	$jid = $JobInfo->OrderID."2";
			   	$str1 = "Select * from tbl_lupu_orders where OrderID = '$JobInfo->OrderID' and Dest_MID = '".$_SESSION['Member_Id']."'";
			   	$result1 = mysql_query($str1) or die("Query failed1");
			   	$num_ = mysql_num_rows($result1);
			   	
			   	//echo "Origin[ $str1 ]<hr>";
			   	
			   	if(empty($num_))
			   	{
			   		$accept = 0;
			   		$status = " Accepted by another member";
			   	}
			   	else 
			   	{
			   		$repost = 1;
			   		$status = " Accepted by you";
			   	}
			   }
			   
			   $postfix_jobs="DESTINATION Service";
			   
			   echo "<font face=\"Verdana\" size=\"2\"><b>
								<td><a href=\"job_details.php?OrderID=".$JobInfo->OrderID."&day=".$MoveDate[2]."&month=".$MoveDate[1]."&year=".$MoveDate[0]."&repost=".$repost."&accept=".$accept."&location=Dest\" 
								 title=\"Click here to view details of this job.\"><center>".$MoveDay." - ".$postfix_jobs."</center></a></b></font></td><td><font face=\"Verdana\" size=\"1\">".$status."</font></td></tr>";
		   }
		 }
		 echo "</table></center>";
		$rows_displayed += $num;
	}
  }
?>

<!--</table> -->

			</div>
	   	</div>



<div id="bottom" class="white_links">
<div align="center"></div> 
<br />
<div align="center" class="white_links"><span class="style13"><a href="index.php"><img src="images/icon_flag_usa.gif" border="0" /> </a> | <a href="index.php"><img src="images/icon_flag_canada.gif" border="0" /></a></span></div>
</div>
<div id="copy" align="center" class="style1">&copy; MovingUWithCare Registered, 2006. All Rights Reserved - Relocators you can trust. </div>
</div>

<img src='buttons/tab_menu_r1_c1_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c2_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c3_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c4_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c5_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c6_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c7_f2.jpg' class="hiddenPic" />


<img src='buttons/tab_menu_r1_c1_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c2_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c3_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c4_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c5_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c6_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c7_f4.jpg' class="hiddenPic" />
</body>
</html>
