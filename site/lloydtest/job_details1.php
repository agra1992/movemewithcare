<?php
  session_start();
  error_reporting(0);
  include "Security.php"; 
  require "top_panel_members.php";
  //error_reporting(0);
  
  $day = $_GET['day'];
  $month = $_GET['month'];
  $year = $_GET['year'];
  $OrderID = $_GET['OrderID'];
  
 
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

$sql = "SELECT ServiceCountry, ZipCode FROM tblmembers WHERE MemberID='".$_SESSION[Member_Id]."' LIMIT 1";
$r = mysql_query($sql) or die('failed to retrieve your zipcode');
list($country, $zipcode) = mysql_fetch_array($r);    
    if($country == "canada"){
         $sql="SELECT zip_canada.lat, zip_canada.lon FROM  tblmembers LEFT JOIN zip_canada ON zip_canada.zipcode=tblmembers.ZipCode WHERE tblmembers.MemberID= ".$_SESSION[Member_Id]." LIMIT 1";
        $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your new zip code area");  
        list($lat, $lon) = mysql_fetch_array($r);
        $zip_database="zip_canada";
    }else{
         $sql="SELECT zip_usa.lat, zip_usa.lon FROM  tblmembers LEFT JOIN zip_usa ON zip_usa.zipcode=tblmembers.ZipCode WHERE tblmembers.MemberID= ".$_SESSION[Member_Id]."  LIMIT 1";
        $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your new zip code area");  
        list($lat, $lon) = mysql_fetch_array($r);
        $zip_database="zip_usa";
    }



  $str = "Select tbl_fs_orders.Sal, tbl_fs_orders.FName, tbl_fs_orders.LName, tbl_fs_orders.Address, tbl_fs_orders.Phone,
           tbl_fs_orders.ZipCode, tbl_fs_orders.Phone2, tbl_fs_orders.EMail, tbl_fs_orders.Or_City, tbl_fs_orders.Or_State,
           tbl_fs_orders.Dest_State, tbl_fs_orders.Dest_City, tbl_fs_orders.MoveDate, tbl_fs_orders.MoveType, tbl_fs_orders.Size,
            IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($lat))*SIN(RADIANS(lat))+COS(RADIANS($lat))*COS(RADIANS(lat))*COS(RADIANS($lon-lon)))),2)* 69.09,0) AS distance
           From tbl_fs_orders LEFT JOIN $zip_database USING (zipcode)
               Where tbl_fs_orders.OrderID = '$OrderID'";

  $result_newQuery = mysql_query($str) or die("Query failed1 ");
  $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
  
  $Sal = $line[Sal];
  $FName = $line[FName];
  $LName = $line[LName];
  $Address = $line[Address];
  $ZC = $line[ZipCode];
  $Phone = $line[Phone];
  $Email = $line[EMail];
  $OCity = $line[Or_City];
  $OState = $line[Or_State];
  $DCity = $line[Dest_City];
  $DState = $line[Dest_State];
  $MoveDate = $line[MoveDate];
  $MoveType = $line[MoveType];
  $Phone2 = $line[Phone2];
  $Size = $line[Size];
  $Distance = $line[distance];
$size_text="";

switch($Size)
		{		                  
			case "0_Partial Home 500-1000 lbs":
                            $size_text="Partial Home 500-1000 lbs";
			   break;
			case "0_Studio 1500 lbs":
                            $size_text="Studio 1500 lbs";
			   break;
			case "1_1 BR Small 3000 lbs":
                            $size_text="1 Small Bedroom 3000lbs";
			   break;
			case "1_1 BR Large 4000 lbs":
                            $size_text="1 Large Bedroom  4000 lbs";
			   break;
			case "1_2 BR Small 4500 lbs":
                            $size_text="2 Small Bedrooms 4500 lbs";
			   break;
			case "1_2 BR Large 6500 lbs":
                            $size_text="2 Large Bedrooms 6500 lbs";
			   break;
			case "1_3 BR Small 8000 lbs":
                            $size_text="3 Small Bedrooms 8000 lbs";
			   break;
			case "1_3 BR Large 9000 lbs":
                            $size_text="3 Large Bedrooms 9000 lbs";
			   break;
			case "1_4 BR Small 10000 lbs":
                            $size_text="4 Small Bedrooms 10000 lbs";
			   break;
			case "1_4 BR Large 12000 lbs":
                            $size_text="4 Large Bedrooms 12000 lbs";
			   break;
			case "1_Over 12000 lbs":
                            $size_text="Over 12000 lbs";
			   break;
		}

  if($MoveType == "1")
  {
    $MoveType = "Long Distance";
  }
  else
  {
    $MoveType = "Local";
  }
  
    $query = "SELECT `city` FROM `cities` WHERE `CityID`='$OCity' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 2");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$OriginCity = $line[city];
	
	$query = "SELECT `city` FROM `cities` WHERE `CityID`='$DCity' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 3");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$DestCity = $line[city];
	
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$OState' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 4");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$OriginState = $line[name];
	
	$query = "SELECT `name` FROM `states` WHERE `StateID`='$DState' LIMIT 1";
	$result = mysql_query($query) or die("Query failed: 5");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$DestState = $line[name];
	
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
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Date of Move:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$MoveDate</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Type of Move:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$MoveType</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Origin Location:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$OriginCity,$OriginState</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Destination Location:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$DestState</font></td>
	     </tr>
		 <tr>
		   <td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Size of Move:</font></b></td>
		   <td valign=\"top\" align=\"left\"><font face=\"Verdana\" size=\"2\">$size_text</font></td>
	     </tr>
<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Distance From You:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$Distance mi</td>
				</tr>
		 <tr>
		   <td align=\"right\">&nbsp;</td>
		   <td valign=\"top\" align=\"left\">&nbsp;</td>
	     </tr>
         <tr>
		    <td valign=\"top\" align=\"center\" colspan=\"2\">
			     <input type=\"button\" value=\"Go Back\" class=\"button\" 
				   onclick=\"window.location='basa.php?day=$day&month=$month&year=$year'\">
		</td></tr>
		</table>";
	
?>

 
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
