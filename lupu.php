<?php
session_start();
require_once('config.inc.php');
require_once('seo.php');

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");

$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 6';
$result = mysql_query($sql) or die("Query failed_LUPU");
$line = mysql_fetch_array($result, MYSQL_ASSOC);


//print_r($ret);

?>
</head>
<div style="float:left;width:150px;border:2px dotted;text-align:center;font-size:11px;font-family:Verdana;color:gray;margin-top:25px;">
<div style="margin:5px 5px 5px 5px;text-align:left;background-color:#dceffe;line-height:12pt;">
<img src="images/loadingunloading.gif" style="margin:5px auto;margin-left:18px;" alt="loadingunloading services"/>


<? echo nl2br($line[Detail]); ?>

<!--MovingUwithcare.com</span> provides you with several services, depending on each of your needs. Looking for Loading/Unloading services? We can provide you with that as well. Need to know more About Us? Our network of mover will help make your relocation cost effective, efficient, and even pleasant.

You can choose either or all services: Packing, loading, unloading or unpacking services, depends on your need (This services does not include transportation, you will need to provide you own truck, if interested in <a href="index.php?full=1">full service mover</a>, click on the <a href="index.php?full=1">link</a>, or you can also rent your own truck with our <a href="index.php?tp=1">Transportation provider)</a>.All movers have linear pricing so whoever chooses to serve you, will have the same pricing structure than any other moving agent in the network. You are looking for a safe and pleasant move? MovingUwithcare.com is the solution for all your moving needs. Our state of the art system also takes the time to analyze your request and offers you recommendations to effectively assess your request. Pay attention to the Recommendation section of the site, it is useful tool for you, our customer.
<br /> <br />
<span style='font-size:9.0pt;color:#0066FF;font-weight:bold'>MovingUwithcare.com</span> conducts business with industry professionals, who are accredited, licensed and insured, and most of all who can commit to unmatched customer service. 
With just few minutes of your time, we'll help you make your relocation request a successful and enjoyable one! -->
</div>
</div>
<br />
<div align="center" style="width:600px;height:1400px!important;height:2px;padding-left:250px!important;padding-left:0px;font-family:Verdana;font-size:12px;color:gray;font-size:12px;" >
<comment><br /><br /><br /><br /></comment>
<form name="loadin" action="fulllupu.php" method="post">
<comment><br /><br /><br /><br /></comment>
  <table width="90%" border="0" align="left" style="font-family:Verdana;font-size:12px;color:gray">
  
  <tr> 
      <td colspan="2"><div align="center"><h2 style="FONT: bold 15px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #374993; LETTER-SPACING: 3px;">Welcome 
          to Moving help wizard</h2></div>
<br />     <b>
With our moving help wizard, posting a moving job should be as easy as 1-2-3. Yes, that's it - in just three easy steps, you'll locate your accredited moving company to serve you. Actually, it is the moving company that will find YOU. No more stress when it comes to MOVING. Our network will make your moving experience as fun and easy as possible. 
</b>
<br />
          <br />
  <div align="center"><font color="red" size="-1" ><strong>*Important: </strong></font>
          <font color="black" size="-1" ><strong>Prior to submitting any request on this site, you confirm that you have read our TERMS OF SERVICE and accept them.</strong></font></div>
  </td>
    </tr>
<tr><tr><td><br /></td></tr>
<tr><tr><td><br /><b><font color="red" size="2">First Step:</font></b></td></tr>

    <tr> 
      <td colspan="2"><div align="center"><font color="black" size="-1" ><strong>Origin 
          location</strong></font></div></td>
    </tr>
    <tr> 
      <td colspan="2" valign="top"><p align="center" style="font-family:Verdana;color:gray">Select Origin State/Province (We also serve Canadians)</p>
        <div align="center"> 
          
		<input type=hidden name ="ServiceSelector" value = "lupu" >
	<select name="or_state" size="1" id="or_state" onChange="get(this);naNext();" style="width:170px; ">
            <option value="">Select State/Province</option>
<?
mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE 1 LIMIT 0, 100 '; 

$result = mysql_query($sql) or die("Query failed");
if (session_is_registered('o_state')) 
$or_state=$o_state;
// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";


echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
    
}

?>  	
  </select>

<br>
<a href="javascript:showmap('or_state');" class="map">Pick from map</a>
        </div></td>
    </tr>

    <tr> 
      <td width="50%" valign="top"> <div align="center"><font color="gray" size="-1" > 
          select origin city<br>
       <div id="cityrec">
    <i>
<? $movinginstate="disabled";
if (session_is_registered('city'))
{echo "if this is not your city, please re-select appropriate state from above.";
$movinginstate="enabled";
}
else
echo "if your city is not listed, please select <br /> nearest location.";
?>
</i></div></font><font size="-1" ><br>
<?         if (session_is_registered('city')) {
			$sql = "SELECT `city`, `CityID` FROM `cities` WHERE `CityID`='$city' "; 
	$result = mysql_query($sql) or die("Query failed");	

	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$city_name=$line[city];
	}?>

          <select name="or_city" size="7" id="or_city" style="width: 170px; " onChange="AllowNext('lupu')">
<option value="<?=$city?>" selected><?=$city_name?></option>
<?} else {?>
 <select name="or_city" size="7" id="or_city" style="width: 170px;" onChange="AllowNext('lupu');">
<?}?>  
		</select>
          <br>
          <input type="checkbox" name="samecity" value="yes" id="samecity" onclick="gorod();" <?=$movinginstate?>>
          <font size="-1"> 
          <label for="samecity"> Moving within same state</label>
          </font></font> <font size="-1" > 
          <input type="hidden" name="next2">
          <input type="hidden" name="dest_city">
          <input type="hidden" name="dest_state">
          </font></div></td>
      <td width="50%" valign="left"><font color="black" size="-1" >Please, 
        specify services required at origin location:</font><font size="-1" ><br>
        <font size="-1">
        <span style="text-align:left">
		<input type="checkbox" name="or_pack" value="1" id="or_pack" >
        <label for="or_pack" style="padding-right:143px">Packing</label><br>
        <input type="checkbox" name="or_load" value="1" id="or_load">
        <label for="or_load" style="padding-right:143px">Loading</label><br>
        <input type="checkbox" name="or_none" value="1" id="or_none" onclick="or_nosvc('o');">
        <label for="or_none" >No services required at origin location</label></font></font>
		</span>
<span id="dest_service">
<input type="hidden" name="dest_none">
</span></td>
    </tr>
	<tr>
 <span id="dest_info">
 </span>
 </tr>
<tr><tr><td><br /></td></tr>
<tr><tr><td><br /></td></tr>
<tr><tr><td><br /></td></tr>
<tr><tr><td><br /></td></tr>
<tr><tr><td><br /></td></tr>
<tr><tr><td><br /><b><font color="red" size="2">Second Step:</font></b></td></tr>
 
<tr>
      <td colspan="2"><div align="center"><font color="black" size="-1" ><strong>Destination
          location</strong></font></div></td>
    </tr>
    <tr> 
      <td colspan="2" valign="top"><p align="center" style="font-family:Verdana;color:gray">Select destination state/province</p>
        <div align="center"> 
          
		
	<select name="dor_state" size="1" id="dor_state" onChange="get('dor_state');naNext();" style="width:170px; ">
            <option value="">Select State/Province</option>
<?
mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE 1 LIMIT 0, 100 '; 

$result = mysql_query($sql) or die("Query failed");
if (session_is_registered('d_state')) 
$or_state=$d_state;
// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";


echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
    
}


?>  	
  </select>

<br>
<a href="javascript:showmap('dor_state');" class="map">Pick from map</a>
        </div></td>
    </tr>
    <tr> 
      <td width="50%" valign="top"> <div align="center"><font color="black" size="-1" >Select destination city<br>
       <div id="cityrec">
    <i>
if your city is not listed, please select <br /> nearest location.
</i></div></font><font size="-1" ><br>
       <select name="dor_city" size="7" id="dor_city" style="width: 170px;" onChange="AllowNext('lupu');">
		</select>
          </div></td>
		
      <td width="50%" valign="left"><font color="black" size="-1" >Please, 
        specify services required at destination location:</font><font size="-1" ><br>
        <font size="-1">
        <input type="checkbox" name="dor_pack" value="1" id="dor_pack" >
        <label for="dor_pack" style="padding-right:163px">UnPacking</label><br>
        <input type="checkbox" name="dor_load" value="1" id="dor_load">
        <label for="dor_load" style="padding-right:163px">UnLoading</label><br>
        <input type="checkbox" name="dor_none" value="1" id="dor_none" onclick="or_nosvc('d');">
        <label for="dor_none" >No services required at destination location</label></font></font>

</td>
    </tr> 




  <tr> 
      <td colspan="2"> <div align="center"><input type="hidden" name="servty" value="" />
          <input id="next" class="button" type="button" name="Submit" value="Next ->" onclick="Proceed()" disabled STYLE="width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57">
        </div></td>
    </tr>
  </table>

<input type="hidden" value="<?=$trans?>" name="transfer" />

</form> </div>
