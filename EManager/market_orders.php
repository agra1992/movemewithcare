<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   include_once "Calendar_Orders.php";
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
        $day = $_GET['day'];
        $month = $_GET['month'];
        $year = $_GET['year'];
        	
        
        $d = getdate(time());
        
        if ($month == "") {
                $month = $d["mon"];
        }
        
        if ($year == "") {
                $year = $d["year"];
        }
        
        if ($day == "") {
                $day = $d["day"];
        }
	

        $count          = $_GET['count'];
        $offset         = $_GET['offset'];
        $SearchString   = $_GET['SearchString'];
        $Mod            = $_GET['Mod'];
        $OrderType      = $_GET['OrderType'];
        $Cal            = $_GET['Cal'];

        class MyCalendar extends Calendar { 
                function getCalendarLink($month, $year,$mod_fs) {
                	$s = getenv('SCRIPT_NAME');
                	return "$s?month=$month&year=$year&SearchString=$SearchString&count=$count&offset=$previous&OrderType=$OrderType&Cal=1&mod_fs=$mod_fs";
                }
        
                function getDateLink($day, $month, $year,$mod_fs) {
                	$s = getenv('SCRIPT_NAME'); 
                	return "$s?day=$day&month=$month&year=$year&SearchString=$SearchString&count=$count&offset=$previous&OrderType=$OrderType&Cal=1&mod_fs=$mod_fs";
                }
        }

   
        if(isset($offset) && $offset>0) {
                $start=$offset;
        } else {
                $start = 0;
        }
		 
        function Navigation() {
		global $i,$count,$pagesize,$start,$SearchString,$OrderType,$day,$month,$year,$Cal;
		   
		if ($count > 0) {
                        $previous=0;
                        
                        if(($start-$pagesize)>0) {
                        	 $previous=$start-$pagesize;
                        }
                        
                        echo "<br><br><center>";
                        echo "Showing <b>".($start+1)." </b>to<b> ".$i."</b> of <b>".$count. "</b>"; 
                        echo "<br><br>";
                            
                        if (($start+1) > 1)  {
                                echo "<a href='market_orders.php?SearchString=$SearchString&count=$count&offset=$previous&OrderType=$OrderType&day=$day&month=$month&year=$year&Cal=$Cal'> Previous </a>";
                        }
                              		 
                        if($count%$pagesize) {
                        	$looplimit=($count/$pagesize)+1;
                        } else {
                        	$looplimit=($count/$pagesize);
                        } 
			   
                        for( $j=0,$k=1 ; $j<$count && $k<=$looplimit;$j+=$pagesize, $k++) {
                                if($start==$j) {
                        	       echo " [$k] ";
                                } else {
                        	       echo "<a href='market_orders.php?SearchString=$SearchString&count=$count&offset=$j&OrderType=$OrderType&&day=$day&month=$month&year=$year&Cal=$Cal'> $k </a>&nbsp";
                                }		
                        }
                        
                        if($count>($start+$pagesize)) {
                                $m = $start+$pagesize;
                                echo "<a href='market_orders.php?SearchString=$SearchString&count=$count&offset=$m&OrderType=$OrderType&&day=$day&month=$month&year=$year&Cal=$Cal'> Next </a>";
                        }
                        
                        echo "<br></center>";
                        
                }   
	}   	
		
        function displayOrders($SearchString) {
                global  $DataBase,$i,$count,$pagesize,$start,$offset,
                        $SearchString,$Mod,$OrderType,$day,$month,$year,$Cal;
                
                $pagesize = 10;
                $UpperLimit = $pagesize;
                $LowerLimit = $start;

                if (!isset($offset)) {
                        $offset=0;
                }
			
                if (!isset($OrderType) || empty($OrderType))
                {
                        $OrderType="Market";
                }
			
	                if ($Mod == "1")   { // Order No
                        if (!isset($count)) {
                                if($OrderType == "Market") {

                                        // this query by tj 2007.10.18 13.30
                                        $strQuery = "Select     tbl_market_orders.OrderID, 
                                                                tbl_market_orders.Sal, 
                                                                tbl_market_orders.FName,
                                                                tbl_market_orders.LName, 
                                                                tbl_market_orders.OrderTime ,     
                                                                tbl_market_orders.Type        
                                                        From    tbl_market_orders
                                                         where tbl_market_orders.OrderID like '$SearchString%'";
                                        
                                        $DataBase->query($strQuery);
                                        $count=$DataBase->get_num_rows();
				}
			}
						  
                        if($OrderType == "market") {

                                // this query by tj 2007.10.18 13.30
                                $strQuery = "Select     tbl_market_orders.OrderID, 
                                                        tbl_market_orders.Sal, 
                                                        tbl_market_orders.FName,
                                                        tbl_market_orders.LName, 
                                                        tbl_market_orders.OrderTime ,    
                                                                tbl_market_orders.Type          
                                          
                                                From    tbl_market_orders 
                                               
                                                where   tbl_market_orders.OrderID like '$SearchString%' 
                                                LIMIT   $LowerLimit, $UpperLimit";
                        }
							
                } // End Order No	
									   
                if ($Mod == "2")   { //First Name of Customer 
                        if (!isset($count)) {
                                if($OrderType == "market") {
                                        $strQuery = "Select     tbl_market_orders.OrderID, 
                                                                tbl_market_orders.Sal, 
                                                                tbl_market_orders.FName,
                                                                tbl_market_orders.LName, 
                                                                tbl_market_orders.OrderTime,  
                                                                tbl_market_orders.Type                                                                 
                                                        From    tbl_market_orders 
                                                       
                                                        where   tbl_market_orders.FName LIKE '%$SearchString%'";
                                        
                                        $DataBase->query($strQuery);
                                        $count=$DataBase->get_num_rows();
                                }
                        }
                
                        if($OrderType == "market") {
                                $strQuery = "Select     tbl_market_orders.OrderID, 
                                                        tbl_market_orders.Sal, 
                                                        tbl_market_orders.FName,
                                                        tbl_market_orders.LName, 
                                                        tbl_market_orders.OrderTime,        
                                                                tbl_market_orders.Type                                  
                                                From    tbl_market_orders 
                                           
                                                where  tbl_market_orders.FName LIKE '%$SearchString%' 
                                                LIMIT   $LowerLimit,$UpperLimit";
                        }
                
                } // End //First Name of Customer 
				
                if ($Mod == "3") { // Last Name of Customer 
                        if (!isset($count)) {
                                if($OrderType == "market") {
                                        $strQuery = "Select     tbl_market_orders.OrderID, 
                                                                tbl_market_orders.Sal, 
                                                                tbl_market_orders.FName,
                                                                tbl_market_orders.LName, 
                                                                tbl_market_orders.OrderTime,
                                                                tbl_market_orders.Type      
                                                              
                                                        From    tbl_market_orders 
                    
                                                        where  tbl_market_orders.LName LIKE '%$SearchString%'";
                                        
                                        $DataBase->query($strQuery);
                                        $count=$DataBase->get_num_rows();
                                }
                        
                        }
                        
                        if($OrderType == "market") {
                                $strQuery = "Select     tbl_market_orders.OrderID, 
                                                        tbl_market_orders.Sal, 
                                                        tbl_market_orders.FName,
                                                        tbl_market_orders.LName, 
                                                        tbl_market_orders.OrderTime ,
                                                                tbl_market_orders.Type                                                   
                                                From    tbl_market_orders 
                                        
                                                where tbl_market_orders.LName LIKE '%$SearchString%' 
                                                LIMIT   $LowerLimit,$UpperLimit";
                        }
                } // END Last Name of Customer 
				
                if ($Mod == "4")  { // Email Address of Customer 
                        if (!isset($count)) {
                                if($OrderType == "market") {
                                        $strQuery = "Select     tbl_market_orders.OrderID, 
                                                                tbl_market_orders.Sal, 
                                                                tbl_market_orders.FName,
                                                                tbl_market_orders.LName, 
                                                                tbl_market_orders.OrderTime ,
                                                                tbl_market_orders.Type                                                                    
                                                        From    tbl_market_orders 
                                                        where 
                                                                tbl_market_orders.EMail LIKE '%$SearchString%'";
                                                                
                                        $DataBase->query($strQuery);
                                        $count=$DataBase->get_num_rows();
                                }
                        
                        }
                
                        if($OrderType == "market") {
                                $strQuery = "Select     tbl_market_orders.OrderID, 
                                                        tbl_market_orders.Sal, 
                                                        tbl_market_orders.FName,
                                                        tbl_market_orders.LName, 
                                                        tbl_market_orders.OrderTime,
                                                                tbl_market_orders.Type                               
                                                From    tbl_market_orders 
                                              
                                                where tbl_market_orders.EMail LIKE '%$SearchString%' 
                                                LIMIT   $LowerLimit,$UpperLimit";
                        }
                } // END // Email Address of Customer 
	        
                if ($Mod == "")  { //Default
                        if (!isset($count)) {
                                $strQuery = "Select     tbl_market_orders.OrderID, 
                                                        tbl_market_orders.Sal, 
                                                        tbl_market_orders.FName,
                                                        tbl_market_orders.LName, 
                                                        tbl_market_orders.OrderTime,
                                                                tbl_market_orders.Type      
                                                From    tbl_market_orders 
                                                
                                                Order   By 
                                                        tbl_market_orders.OrderTime Desc";
                                $DataBase->query($strQuery);
                                $count=$DataBase->get_num_rows();
                                
                        } else {
                        
                                $strQuery = "Select     tbl_market_orders.OrderID, 
                                                        tbl_market_orders.Sal, 
                                                        tbl_market_orders.FName,
                                                        tbl_market_orders.LName, 
                                                        tbl_market_orders.OrderTime,
                                                                tbl_market_orders.Type             
                                                From    tbl_market_orders 
                                               
                                                Order By 
                                                        tbl_market_orders.OrderTime Desc 
                                                LIMIT   $LowerLimit,$UpperLimit";
                        }
                }  // End Default			

			

			
			
                // by Tj 2007.10.18 13.32			
                //echo "<br> [ $strQuery ]<br>";
                			
		$nCount=0;
			
                $DataBase->query($strQuery);
			
                if($DataBase->get_num_rows()>0) {
                        echo "<table border=\"0\" width=\"95%\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"003366\" align=\"center\">
                                <tr>
                                <td class=\"style2\" width=\"17%\"><b>Delete</b></td>
                                <td class=\"style2\" width=\"44%\"><b>Order Description</b></td>
                                <td class=\"style2\" width=\"21%\"><b>Time of order</b></td>
                                <td class=\"style2\" width=\"18%\"><b>Order Details</b></td>
                                </tr>";
                                
                        $DataBase->move_to_row($start);
                        $i=0;
                
                        for($i=$start;$i<$count&&$i<$start+$pagesize;$i++) {
                                $val = $DataBase->fetch_row();
                                
                                if (($Mod == "1") || ($Mod == "2") || ($Mod == "3") || ($Mod == "4") || ($Mod == "")) { 
                                        if (!isset($Mod)) {
                                                $OrderType = "market";
                                        }
                                
                                        if($OrderType == "market") {
                                                $OID	= $val[0];
                                                $Sal	= $val[1];
                                                $FName	= $val[2];
                                                $LName	= $val[3];      		       	           
                                                $OTime = $val[4];
                                                $OType = $val[5];
                                                
                                               
                                        }
        	                  }						 
        						 
                                echo "<tr>
                                        <td class=\"style1\"><a href=\"removeorder_action.php?ID=$OID&SearchString=$SearchString&count=$count&offset=$offset&OrderType=$OrderType&day=$day&month=$month&year=$year&Cal=$Cal&mod_fs=$mod_fs\" onClick=\"return confirm('If you DELETE this order, this will result in permanent loss of ALL the Jobs processed or being processed against this order. Are you sure, you want to DELETE this order?');\">
                                        <img src=\"graphics/delete.gif\" border=0 alt=\"Delete\"></a></td>
                                        <td class=\"style1\">$Sal $FName  $LName";
                                        
                                if($OrderType == "market") {
                                        echo "(".$OType.")";
                                }
                                
                                echo "</td>
                                        <td class=\"style1\">$OTime</td>
                                      
                                        <td class=\"style1\"><a href=\"market_details.php?ID=$OID&SearchString=$SearchString&count=$count&offset=$offset&OrderType=$OrderType&day=$day&month=$month&year=$year&Cal=$Cal&mod_fs=$mod_fs\" title=\"Click here to view Order Details\">View Order Details</a></td>
                                        
					
                                        </tr>";
                                $nCount++;
        		}
        		
        		echo "</table><br>";
        		
        	} else {
        	
                        echo "No Orders Found !!!";
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

  <div align="left"><a href="EManager.php">EManager(Home)</a> > Manage Market Orders</div>
	<br><br>
	
   <table border="0" cellspacing="0" cellpadding="0" >
	  <form action="order_search_action.php" method="post" xonSubmit="return CheckForm(this);">
		<tr>
			<td align="right" width="62" valign="top"><b>Search:</b></td>
			<td width="520" valign="top">&nbsp;&nbsp;<input type="text" name="SearchString" SIZE="20" maxlength="32" value="">
			<input type="hidden" name="OrderType" value="market">
			<p>
              <INPUT type="radio"  name="Mod" value="1" checked>
              Order Number <br>
              <INPUT type="radio"  name="Mod" value="2">
              First Name of Customer <br>
              <INPUT type="radio"  name="Mod" value="3">
              Last Name of Customer <br>
              <INPUT type="radio"  name="Mod" value="4">
              Email Address of Customer <br>
              <br>
              <input name="submit" type="submit" class="waButton1" value="Search Order">
            </p>
			<br>
			</td>
			<td valign="top">
			<table width="100%" border="0">
			  <tr>
				<td>
				<? 
				/*   echo "<br>";
				   $cal = new MyCalendar;
				   echo "<center>";
				   echo $cal->getMonthView($month, $year);
				   echo "</center>";
				   echo "<br><br>"; */
				?>
				</td>
			  </tr>
			</table>
           </td>
	    </tr>
	  	</form>
	</table>
	

<? displayOrders($SearchString);Navigation(); ?>

<?
   include "footer.php";
?>
  
   
   