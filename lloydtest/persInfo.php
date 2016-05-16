<?php
require("config.inc.php");
require_once("seo.php");
require("sanitize.php");
if(!$trans && !$store && !$packing)
{
$searchMode=1;
}

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_locator_name) or die("Could not select database");

?>

<!--<link rel="stylesheet" href="locator/style.css">
<script language="JavaScript" src="cal.js"></script>
<script type="text/javascript" src="overlib_mini.js"></script>
-->
<body onLoad="init()">
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>  


<div style="float:left;clear:none;display:block;width:150px;border:2px dotted;text-align:center;font-size:11px;font-family:Verdana;color:gray;margin-top:25px;">

<div style="margin:5px 5px 5px 5px;text-align:left;background-color:#dceffe;line-height:12pt;">
<?if($trans==1 || $searchMode){?>
<img src="images/transportation.jpg" style="margin:5px auto;margin-left:18px" alt="transportation_services"/>
<?
  $sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 8';
  $result = mysql_query($sql) or die("Query failed_Trans");
  $line = mysql_fetch_array($result, MYSQL_ASSOC);
  echo nl2br($line[Detail]);
?>
<!--<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> also provides you with Transportation services, either local or Long distance, providing you with trucks rental locations, in case you want to drive cross country for an enjoyable road trip, or you can also leave it to the expert to drive these big 18 wheelers to bring your items safely to destination. This option will require you to provide packing (make sure you get the right <a href="index.php?psm=1">packing supplies</a> from our vendors), Loading and unloading services from and to the new location. If you request the help of professional movers to help you with the move, you can visit our <a href="index.php?lupu=1">Loading/Unloading Tab</a> for more details and get the help of accredited movers in your area. You can also get a <a href="index.php?full=1">Full Service Mover</a> handle the whole aspect of the move either for your local or long distance needs.
<br /> <br />
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span>  conducts business with industry professionals, who are accredited, licensed and insured, and most of all who can commit to unmatched customer service. 
With just few minutes of your time, we'll help you make your relocation request a successful and enjoyable one! -->

<?} if($store==1 || $searchMode){?>
<img src="images/storage_facilities.gif" style="margin:5px auto;margin-left:18px;" alt="storage_facilities"/>
<?
  $sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 9';
  $result = mysql_query($sql) or die("Query failed_Store");
  $line = mysql_fetch_array($result, MYSQL_ASSOC);
  echo nl2br($line[Detail]);
?>
<!--<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>Moving</span> can be one of the most stressful day in our lives, and in some cases, it is. However, by getting organized properly and planning ahead, you can prepare your family for a smooth and efficient move. 
<br /> <br />
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> also provides you with Storage and warehousing services, either for your local or Long distance move. Our storage facilities are equipped with 24 hours surveillance, gated entry with secure pass code, and staff at the property to help you. This option will require you to provide packing, Loading, transporting (you can also rent truck, see our <a href="index.php?tp=1">Transportation TAB</a>) and unloading from and to the storage facility. If you request the help of professional movers to help you with the move, you can visit our <a href="index.php?lupu=1">Loading/Unloading Tab </a>for more details and get the help of accredited movers in your area to give you a helping hand or leave it to our <a href="index.php?full=1">Full service movers </a>that can also provide storage and warehousing.  
<br /> <br />
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> conducts business with industry professionals, who has secure locations to make sure your items are kept in a safe and controlled environment, and most of all who can commit to unmatched customer service. 
With just few minutes of your time, we'll help you make your relocation request a successful and enjoyable one! -->


<?} if($packing==1 || $searchMode){?>
<img src="images/packing_facilities.gif" style="margin:5px auto;margin-left:18px;" alt="packing_facilities"/>
<?
  $sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 10';
  $result = mysql_query($sql) or die("Query failed_Pack");
  $line = mysql_fetch_array($result, MYSQL_ASSOC);
  echo nl2br($line[Detail]);
?>
<!--<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> also provides you with packing supplies provider in case you decide to handle the entire move by yourself. You need to make sure that all your items are properly wrapped to avoid damages in transit. Packing is not as simple as you might think, so you can visit our Packing tips and get a clear idea of the method the professional uses to pack your furniture. This option will require you to provide packing, Loading, transporting (you can also rent truck, see our <a href="index.php?tp=1">Transportation TAB</a>) and unloading from and to your new location. If you request the help of professional movers to help you with the move, you can visit our <a href="index.php?lupu=1">Loading/Unloading Tab </a>for more details and get the help of accredited movers in your area to give you a helping hand or leave it to our <a href="index.php?full=1">Full service movers </a>that can also provide you with packing services. 
Remember, even though your items need to go to your storage (See our <a href="index.php?sf=1">Storage Tab</a> to locate Storage facilities), you will still need to protect your items because of moisture and heat in the facility. Ask for climate control storage when talking to a customer representative of your local storage. 
<br /> <br />
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> conducts business with industry professionals and can provide you with cost effective packing materials to properly wrap your furniture.  
With just few minutes of your time, we'll help you make your relocation request a successful and enjoyable one! -->

<?}
if($searchMode)
die("");

?>
</div>
</div>
<comment><br /><br /></comment>
<div align="left" style="padding-top:100px!important;padding-top:0px;width:600px;height:<?if(($trans==1)) echo "1000"; else if($store==1) echo "1200"; else echo "1300"?>px!important;height:2px;font-family:'Verdana,Arial';color:#000">
<br>
<form name="form1" method="post" action="trans.php" onSubmit="return vali(this);">
 <table width="500" border="0" cellspacing="0" cellpadding="0" name="top" style="margin-left:60px;font-family:'Verdana,Arial';color:Gray">
				<tr>
 
					<td width="63" align=left valign=bottom><img src="images/top_qq_left.gif" width="63" height="19"></td>
										<td width="100"><img src="images/spacer.gif" width="50px" height="1px" /></td>
					<td height="19" width="100%" align=center valign=bottom colspan="2">
					<font color="red" size="2" face="Verdana,Arial, Helvetica, sans-serif"><strong>*Important: </strong></font>
          <font color="black" size="2" face="Verdana,Arial, Helvetica, sans-serif"><strong>Prior to submitting any request on this site, you confirm that you have read our TERMS OF SERVICE and accept them.</strong></font><br>
						<h2 style="FONT: bold 17px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 3px;">
	<?if($trans==1)
	echo "<br />Transportation Request Form";
	else if($store==1)
	echo "<br />Storage Facility Request Form";
	else if($packing==1)
	echo "<br />Packing Materials Request Form";
	else 
	die("Unauthorized Attempt");
	?>
</h2>
					</td>
					<td width="100"><img src="images/spacer.gif" width="50px" height="1px" /></td>
					<td width="63" align=right valign=bottom><img src="images/top_qq_left.gif" width="63" height="19"></td>
				</tr>

			<table width="100%" border="0" cellspacing="0" cellpadding="8">
	 <a name="top">		
   <tr>
   <td width="100%"> <div id="err" style="visibility:visible;float:right;" align="left"></div></td>
   <td >&nbsp;
  
   </td>
   </tr>
	
    <tr> 
      <td width="50%"><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Salutation:</font></div></td>
      <td width="50%"><select name="salut" id="salut" class="formobject" >
          <option value="Mr.">Mr.</option>
          <option value="Mrs.">Mrs.</option>
          <option value="Ms.">Ms.</option>
        </select></td>
    </tr>
    <tr> 
      <td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">First 
          name:</font></div></td>
      <td><input name="fname" type="text" alt="First Name" class="formobject" id="fname" maxlength="100"></td>
    </tr>
    <tr> 
      <td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Last 
          name:</font></div></td>
      <td><input name="lname" type="text" alt="Last Name"class="formobject" id="lname" maxlength="100"></td>
    </tr>
    <tr> 
      <td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Current Street Address:</font></div></td>
      <td><input name="address" type="text" alt="Address" class="formobject" id="address" maxlength="250"></td>
    </tr>
	<tr>
   <td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Current State:</td>
 
<td>
 
      <select name="or_state" size="1" id="or_state" onChange="get(this);" style="width: 170px; ">
            <option value="">Select State</option>
<?
mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE 1 LIMIT 0, 100 '; 

$result = mysql_query($sql) or die("Query failed");

// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";


echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
    
}

?>  	
  </select>
<br>
<a href="javascript:showmap('or_state');">Pick from map</a>
        </td>

    </tr>
	<tr> 
      <td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Current City:<br /> <i>If your city is not listed, select nearest location</i></font></div></td>
      <td>
          <select name="or_city" size="7" id="or_city" style="width: 170px; ">
           </select>
	</td>
    </tr>
    <tr> 
      <td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Zipcode:</font></div></td>
      <td><input name="zipcode" type="text" alt="Zip" id="zipcode" size="4" maxlength="5" class="formobject"></td>
    </tr>
    <tr> 
      <td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Phone number (work):</font></div></td>
      <td><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">( 
        <input name="ph1" type="text" alt="Area Code"id="ph1" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph2")'>
        ) 
        <input name="ph2" type="text" alt="Phone" id="ph2" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph3")'>
        - 
        <input name="ph3" type="text" id="ph3" size="4" maxlength="4" class="formobject"></td>
    </tr>
	 <tr> 
      <td><div align="right"><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">Phone number (home):</font></div></td>
      <td><font  size="-1" face="Verdana,Arial, Helvetica, sans-serif">( 
        <input name="ph4" type="text" alt="Area Code"id="ph1" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph5")'>
        ) 
        <input name="ph5" type="text" alt="Phone" id="ph2" size="3" maxlength="3" class="formobject" onKeyUp='Move(this,3,"ph6")'>
        - 
        <input name="ph6" type="text" id="ph3" size="4" maxlength="4" class="formobject"></td>
    </tr>
    <tr> 
      <td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Email address:</font></div></td>
      <td><input name="email" type="text" alt="E-Mail Address" id="email" class="formobject"></td>
    </tr>
	<tr><td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Select  services required::<br>
	    <i>(Ctrl+Click to select multiple)</i></font></div></td>
	<td><select name="serv[]" alt="Services Required" id="serv" size=6 multiple style="width:154px">
		<option value="0">None</option>
            <option value="1" style="background : #dceffe" >Packing</option><option value="2"  >UnPacking</option><option value="3" style="background : #dceffe" >Loading</option><option value="4"  >Unloading</option>
<?
if(!$trans)
{
?>
<option value="5" style="background : #dceffe" > Transportation </option>
<?}?>
</select></td></tr>
	
	<tr><td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Type of Move:<br>
	    </font></div></td>
	<td><select name="serv1" alt="Type Of Move" id="serv1" size=2 onChange="disMov();" style="width:154px">
		<option value="0">Local</option>
            <option value="1" style="background : #dceffe" >Long Distance</option></select></td></tr>			
	<? if($trans==1)
	{
	?>
			<tr><td>
<div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">
Estimated Departure Date: <br>
<i>yyyy-mm-dd</i>
</font></div>
</td><td>
<input name="or_date" type="text" alt="Estimated Departure Date" id="email" class="formobject" size="10" maxlength="10" style="margin-left:30px;" readonly onMouseOver="overlib('Please click on the calendar link to the right and choose a date from pop-up calendar.');return true;" onMouseOut="window.status=''; nd(); return true;">
<a href="javascript:show_calendar('form1.or_date');" onMouseOver="window.status='Date Picker'; overlib('Click here to choose a date from pop-up calendar.'); return true;" onMouseOut="window.status=''; nd(); return true;">Pick from calendar</a>
</td></tr> <? } ?>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
   <td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Moving to:</td><td>
        
          <select name="dor_state" alt="Destination State" size="1" id="dor_state" style="width:170px; ">
            <option value="">Select State</option>
<?
mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE 1 LIMIT 0, 100 '; 

$result = mysql_query($sql) or die("Query failed");

// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";


echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
    
}

?>  	
  </select>
<br>
<a href="javascript:showmap('dor_state');">Pick from map</a>
        </td>
    </tr>
	<? if($trans==1)
	{
	?>
<tr align="center">

  <td colspan="2" align="left"><div align="center" ><font color="gray" size="-1" face="Verdana,Arial, Helvetica, sans-serif"><i>If you chose unloading services, it will enable to us to provide you with a moving agent at your destination location to help you with your unload</i></td></tr>
	
<tr height="10px"></tr><input type="hidden" name="from" value="transportation" id="from" />
  <tr align="center"><td>&nbsp;</td><td align="left"><input type="submit" name="Submit" value="Request a transportation provider" id="next" STYLE="width:340px; font-size: small; font-family: Arial; color: #; background-color: #dceffe; border: 1 outset #;margin-right:50px;"></td></tr>
<?}
?>
<? if($store==1)
	{
	?>
<tr ><td>
<div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">
Start Date at Storage: <br>
<i>yyyy-mm-dd</i>
</font></div>
</td><td>
<input name="st_date" type="text" style="margin-left:30px;" alt="Start Date at Storage" id="email" class="formobject" size="10" maxlength="10" readonly onMouseOver="overlib('Please click on the calendar link to the right  and choose a date from pop-up calendar.');return true;" onMouseOut="window.status=''; nd(); return true;">
<a href="javascript:show_calendar('form1.st_date');" onMouseOver="window.status='Date Picker'; overlib('Click here to choose a date from pop-up calendar.'); return true;" onMouseOut="window.status=''; nd(); return true;">Pick from calendar</a>
</td></tr>
<tr><td>
<div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">
Finish Date at Storage: <br>
<i>yyyy-mm-dd</i>
</font></div>
</td><td>
<input name="en_date" type="text" style="margin-left:30px;" alt="Finish Date at Storage" id="email" class="formobject" size="10" maxlength="10" readonly onMouseOver="overlib('Please click on the calendar link to the right and choose a date from pop-up calendar.');return true;" onMouseOut="window.status=''; nd(); return true;">
<a href="javascript:show_calendar('form1.en_date');" onMouseOver="window.status='Date Picker'; overlib('Click here to choose a date from pop-up calendar.'); return true;" onMouseOut="window.status=''; nd(); return true;">Pick from calendar</a>
</td></tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
   <td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Storage Size:</td><td>
        
          <select name="st_size" alt="Storage Size" size="1" id="or_state" style="width:170px; ">
			<option value="">Select size</option>
            <option value="1">A Studio</option>
			<option value="2">1 Bedroom</option>
            <option value="3">2 Bedroom</option>
            <option value="4">3 Bedroom</option>
			<option value="5">4 Bedroom</option>
			<option value="6">Larger than 4 Bedroom</option>
 	
  </select>
<br>
<a href="#" onclick="javascript:showsize1();return false;">Confused? We might help you understand your requirement , Click here.</a>
        </td>
    </tr>
<tr height="10px"></tr><input type="hidden" name="from" value="store" id="from" />
  <tr align="center"><td>&nbsp;</td><td align="left"><input type="submit" name="Submit" value="Request a storage provider" id="next" STYLE="width:340px; font-size: small; font-family: Arial; color: #; background-color: #dceffe; border: 1 outset #;margin-right:50px;"></td></tr>

<?}?>
<? if($packing==1)
	{
	?>
<tr><td>
<div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">
Estimate Date of Moving: <br>
<i>yyyy-mm-dd</i>
</font></div>
</td><td>
<input name="st_date" type="text" style="margin-left:30px;" alt="Estimate Date of Moving" id="email" class="formobject" size="10" maxlength="10" readonly onMouseOver="overlib('Please click on the calendar link to the right and choose a date from pop-up calendar.');return true;" onMouseOut="window.status=''; nd(); return true;">
<a href="javascript:show_calendar('form1.st_date');" onMouseOver="window.status='Date Picker'; overlib('Click here to choose a date from pop-up calendar.'); return true;" onMouseOut="window.status=''; nd(); return true;">Pick from calendar</a>
</td></tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
   <td><div align="right"><font color="" size="-1" face="Verdana,Arial, Helvetica, sans-serif">Materials Required:<br>
	    <i>(Ctrl+Click to select multiple)</i></td><td>
        
          <select name="st_size" alt="Materials" size="4" id="st_size" style="width:170px; " multiple>
			<option value="1">Boxes</option>
			<option value="2">Tape</option>
            <option value="3">Moving Equipment</option>
            	
  </select>
<br>
        </td>
    </tr>
<tr height="10px"></tr><input type="hidden" name="from" value="packing" id="from" />
  <tr align="center"><td>&nbsp;</td><td align="left"><input type="submit" name="Submit" value="Request a packing supplies and materials provider" id="next" STYLE="width:320px; font-size:small; font-family: Arial; color: #; background-color: #dceffe; border: 1 outset #;margin-right:50px;"></td>
<?}?>
 <table width="393" border="0" cellspacing="0" cellpadding="0" name="top" style="margin-left:200px!important;margin-left:60px">
<tr>
<td width="10" background="/images/right_dot_line.gif"></td>
		</tr>
		<tr> 
		  <td colspan="3"><img src="/images/bottom_qq.gif" width="500" height="9"></td>
		</tr>
</table>
</form>		

</div>