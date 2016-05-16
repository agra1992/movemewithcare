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
  $repost = $_GET['repost'];
  $accept = $_GET['accept'];
  $location = $_GET['location'];
  
 
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

<font style="FONT: bold 15px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 3px;">Job Details</font><br><br>

<?   
if($repost != 1 && $accept != 1)
{
    echo"<font style=\"FONT: bold 13px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: RED; LETTER-SPACING: 3px;\">This Job Has Already Been Accepted By Another Member</font><br><br>";
}
  $str = "Select tbl_lupu_orders.Sal, tbl_lupu_orders.FName, tbl_lupu_orders.LName, tbl_lupu_orders.Address, tbl_lupu_orders.ZipCode,
            tbl_lupu_orders.Phone, tbl_lupu_orders.EMail, tbl_lupu_orders.SameState, tbl_lupu_orders.Or_City, tbl_lupu_orders.Or_State,
             tbl_lupu_orders.Or_Load, tbl_lupu_orders.Or_Pack, tbl_lupu_orders.Transport, tbl_lupu_orders.Dest_City,
            tbl_lupu_orders.Dest_State, tbl_lupu_orders.Dest_Unload, tbl_lupu_orders.Dest_Unpack, tbl_lupu_orders.MoveDate,
              tbl_lupu_orders.Labor, tbl_lupu_orders.OrderTime, tbl_lupu_orders.Charged, tbl_lupu_orders.MoveType, 
			  tbl_lupu_orders.Phone2
           From tbl_lupu_orders Where tbl_lupu_orders.OrderID = $OrderID";

  $result_newQuery = mysql_query($str) or die("Query failed1");
  $line = mysql_fetch_array($result_newQuery, MYSQL_ASSOC);
  
//  $Sal = $line[Sal];
//  $FName = $line[FName];
//  $LName = $line[LName];
//  $Address = $line[Address];
  $ZC = $line[ZipCode];
//  $Phone = $line[Phone];
//  $Email = $line[EMail];
  $SameState = $line[SameState];
  $OCity = $line[Or_City];
  $OState = $line[Or_State];
  $OLoad = $line[Or_Load];
  $OPack = $line[Or_Pack];
  $Transport = $line[Transport];
  $DCity = $line[Dest_City];
  $DState = $line[Dest_State];
  $DUnload = $line[Dest_Unload];
  $DUnpack = $line[Dest_Unpack];
  $MoveDate = $line[MoveDate];
  $Labor = $line[Labor];
  $OTime = $line[OrderTime];
  $Charged = $line[Charged];
  $MoveType = $line[MoveType];
//  $Phone2 = $line[Phone2];
  
  $strBill = "You will be paid a total of %x% as per the agreement <br>for this job (up to 3 hours) by the 
              customer. You are guaranteed <br>this amount. If your job extends beyond 3 hours, the <br>customer will pay you %y%/hour for any 
			  additional hours after the three <br>required. You are obligated only to your minimum hours, because this is <br>what the customer 
			  requested from the network. Make sure to<br> collect the amount mentioned above with whatever payment <br>method you accept.";
  
  switch($Labor)
        {
                              
		case 1:
               $strBill  = str_replace ("%x%", "$170", $strBill);
			   $strBill  = str_replace ("%y%", "$55", $strBill);
			   break;
		case 2:
               $strBill  = str_replace ("%x%", "$260", $strBill);
			   $strBill  = str_replace ("%y%", "$80", $strBill);
			   break;
	    case 3:
               $strBill  = str_replace ("%x%", "$310", $strBill);
			   $strBill  = str_replace ("%y%", "90", $strBill);
			   break;
		case 4:
               $strBill  = str_replace ("%x%", "$375", $strBill);
			   $strBill  = str_replace ("%y%", "$105", $strBill);
			   break;
		case 5:
               $strBill  = str_replace ("%x%", "$520", $strBill);
			   $strBill  = str_replace ("%y%", "$120", $strBill);
			   break;
	    }
  
          if ($OLoad == "1")
		   {
		     $OLoad = "Loading";
		   }
		   if ($OPack == "1")
		   {
		     $OPack = "Packing";
		   }
		   if ($DUnload == "1")
		   {
		     $DUnload = "UnLoading";
		   }
		   if ($DUnpack == "1")
		   {
		     $DUnpack = "UnPacking";
		   }
		   
		   $servicearray1= array();
		   $servicearray2= array();
		   array_push($servicearray1,"Loading");
		   array_push($servicearray1,"Packing");
		   array_push($servicearray2,"UnLoading");
		   array_push($servicearray2,"UnPacking");
		   
		   $info_origin = "";
		   $info_destination = "";
		   if (in_array($OLoad, $servicearray1)) 
		   {
             $info_origin = "Loading";
		   }
		   if (in_array($OPack, $servicearray1)) 
		   {
		     if(empty($info_origin))
			 {
			   $info_origin = "Packing";
			 }
			 else
			 {
              $info_origin = $info_origin . ",Packing";
			 }
		   }
		   if (in_array($DUnload, $servicearray2)) 
		   {
             if(empty($info_destination))
			 {
			   $info_destination = "UnLoading";
			 }
			 else
			 {
              $info_destination = $info_destination . ",UnLoading";
			 }
		   }
		   if (in_array($DUnpack, $servicearray2)) 
		   {
		     if(empty($info_destination))
			 {
			   $info_destination = "UnPacking";
			 }
			 else
			 {
              $info_destination = $info_destination . ",UnPacking";
			 }
           }
  
  if($Transport == "yes")
  {
    $Transport = "Required";
  }
  else
  {
    $Transport = "Not Required";
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
	
	if($Charged == "0")
	{
		$Charged = "Uncharged";
	}
	else 
	{
		$Charged = "Charged";
	}
	
  echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" align=\"center\">
			<b><font face=\"Verdana\" size=\"2\"><font face=\"Verdana\" size=\"2\">
				<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">ZipCode:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$ZC</td>
				</tr>";
  	if($location == "Origin")
  	{
		echo	"<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Origin Location:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$OriginCity,$OriginState</td>
				</tr>";
  	}
	if($location == "Dest")
  	{
		echo	"<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Destination Location:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$DestCity,$DestState</td>
				</tr>";
  	}
  	
		echo 	"<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Labor Required:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$Labor</td>
				</tr>
				<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Transportation:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$Transport</td>
				</tr>
				<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Type of Move:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$MoveType</td>
				</tr>";
	if($location == "Origin")
  	{
		echo	"<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Service at Origin:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$info_origin</td>
				</tr>";
  	}
  	if($location == "Dest")
  	{
		echo	"<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Service at Destination:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$info_destination</td>
				</tr>";
  	}
		echo 	"<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Date of Move:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$MoveDate</td>
				</tr>
				<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Time / Date of Order:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$OTime</td>
				</tr>
				<tr>
					<td align=\"right\"><b><font face=\"Verdana\" size=\"2\">Charged:</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$Charged</td>
				</tr>
				<tr>
					<td align=\"right\" valign=\"top\"><b><font face=\"Verdana\" size=\"2\">Billing Information</font></b></td>
					<td align=\"left\"><font face=\"Verdana\" size=\"2\">$strBill</td>
				</tr>
		<tr>
		   <td align=\"right\">&nbsp;</td>
		   <td valign=\"top\" align=\"left\">&nbsp;</td>
	    </tr>
		</font></font></b>
		</table>";
  
   echo "<input type=\"button\" value=\"Go Back\" class=\"button\" 
		 onclick=\"window.location='basa.php?day=$day&month=$month&year=$year'\">";
	if ($repost == 1)	
	{
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"Repost\" class=\"button\" 
	    	 onclick='window.location=\"Revoke_order.php?Type=LUPU&location=".$location."&OrderID=".$OrderID."&day=".$day."&month=".$month."&year=".$year."\"'>";
	}
	else if($accept == 1)
	{
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' name='Accept' class='button' value='Accept'
		onclick='window.location=\"Accept_order.php?Type=LUPU&location=".$location."&OrderID=".$OrderID."&day=".$day."&month=".$$month."&year=".$year."\"' />";
	}
	else 
	{
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' name='Accept' class='button' value='Accept' disabled
		onclick='window.location=\"Accept_order.php?Type=LUPU&location=".$location."&OrderID=".$OrderID."&day=".$day."&month=".$$month."&year=".$year."\"' />";
	}
	echo "<br/><br/><br/>";
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
