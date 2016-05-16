<?php
   include "Security.php";
   include "header.php";
  //error_reporting(0);
  

  $OrderID = $_GET['ID'];
  
 
?>

<style type="text/css">
<!--
.button
{
    BORDER-RIGHT: 1px solid;
    PADDING-RIGHT: 2px;
    BORDER-TOP: 1px solid;
    PADDING-LEFT: 4px;
    FONT-WEIGHT: bold;
    FONT-SIZE: 10px;
    PADDING-BOTTOM: 2px;
    BORDER-LEFT: 1px solid;
    COLOR: #ffffff;
    PADDING-TOP: 3px;
    BORDER-BOTTOM: 1px solid;
    FONT-FAMILY: Verdana, Arial, Helvetica;
    HEIGHT: 22px;
    BACKGROUND-COLOR: #0080C0
}
-->
</style>


<font style="FONT: bold 15px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 3px;">Lead Details</font><br><br>

<?   
  $str = "Select tbl_market_orders.Sal, tbl_market_orders.FName, tbl_market_orders.LName, tbl_market_orders.Address, tbl_market_orders.Phone,
           tbl_market_orders.ZipCode, tbl_market_orders.Phone2, tbl_market_orders.EMail, tbl_market_orders.City, tbl_market_orders.State,
          tbl_market_orders.OrderTime, tbl_market_orders.Type
            From tbl_market_orders
               Where tbl_market_orders.OrderID = '$OrderID'";

  $result_newQuery = mysql_query($str) or die("Query failed1 ");
  $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
  
  $Sal = $line[Sal];
  $FName = $line[FName];
  $LName = $line[LName];
  $Address = $line[Address];
  $ZC = $line[ZipCode];
  $Phone = $line[Phone];
  $Email = $line[EMail];
  $City = $line[City];
  $State = $line[State];
  $OrderDate = $line[OrderTime];
  $Type = $line[Type];
  $Phone2 = $line[Phone2];

  
  
    $query = "SELECT `city` FROM `cities` WHERE `CityID`='$City' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 2");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$OriginCity = $line[city];
	

	
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$State' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 4");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$OriginState = $line[name];
	

	
    echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" align=\"center\" >
		   <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Customer:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$Sal $FName $LName</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Address:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$Address</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">ZipCode:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$ZC</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Phone (work):</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$Phone</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Phone (home):</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$Phone2</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Email:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$Email</font></td>
	     </tr>
		  <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Date of Order:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$OrderDate</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Type of Order:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$Type</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Location:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$OriginCity,$OriginState</font></td>
	     </tr>
		 
		 <tr>
		   <td align=\"right\">&nbsp;</td>
		   <td valign=\"top\" align=\"left\">&nbsp;</td>
	     </tr>
         <tr>
		    <td valign=\"top\" align=\"center\" colspan=\"2\">
			     <input type=\"button\" value=\"Go Back\" class=\"button\" 
				   onclick=\"window.location='market_orders.php'\">
		</td></tr>
		</table>";
	
?>

 
</div>
	   	</div>



<div id="copy" align="center" class="style1">&copy; MovingUWithCare Registered, 2006. All Rights Reserved - Relocators you can trust. </div>
</div>

</body>
</html>
