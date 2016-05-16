<?php
require("../config.inc.php");
require("sanitize.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Become a network member <?=$CN_SUFFIX ?></title>
<meta name="description" content="<? include("../description"); ?>">
<META NAME="keywords" CONTENT="<? include("../keywords"); ?>">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<link rel="stylesheet" href="../style.css">
<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript">
</script>

</head>
<?php
///////////////////////////////////////////////////////////////////////////////
// THIS PART WILL BE WORKING ONLY IF 'NAME' PARAM IS DEFINED !
///////////////////////////////////////////////////////////////////////////////
// saving variables to the database
/////////////////////////////////////////////////////////////////////
// Processing standart membership here ||||||||||||||||||||||||||||||
/////////////////////////////////////////////////////////////////////

//print_r($HTTP_POST_VARS);

if (($name) and ($type=='standart')) {

$name = sanitize($_POST[name],100,0);
$email = sanitize($_POST[email],100,0);
$login = sanitize($_POST[login],20,0);
$phone = sanitize($_POST[phone],15,0);
$pass = sanitize($_POST[pass],10,0);
$state = sanitize($_POST[state],5,1);


$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

//check if all cities are within one state (fraud check)
/////////////////////////////////////////////////////////////////////////////
mysql_select_db($db_locator_name) or die("Could not select database");

foreach ($city as $currentcity) {
$currentcity = sanitize($currentcity,5,1);
$cities .= ' \'' . $currentcity . '\',';
$numcities++;
}
// trim the last comma
$cities = substr($cities,0,strlen($cities)-1);

$sql = "SELECT COUNT(*) as `numcities` FROM `cities` WHERE `CityID` IN ($cities) AND `StateID`=$state "; 
//echo($sql);

$result = mysql_query($sql) or die("Query failed1");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

if ($line[numcities]!=$numcities) {
$message = "<font color=red>Invalid request. Common service members are allowed to serve cities only within one state.</font>";
} else {

	//////////////////////////////////////////////////////////////////////////////
	// check if login is avaible?
	///////////////////////////////////////////////////////////////////////////
	$sql = "SELECT COUNT(*) as `nummembers` from `cs` WHERE `login`='$login'"; 
	$result = mysql_query($sql) or die("Query failed");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($line[nummembers]!=0) {
	$message = "<font color=red>We are sorry, but login \"$login\" is already taken.<br>Please return to the previous page and select another login</a>";
	} else {

		///////////////////////////////////////////////////////////
		// adding to service
		///////////////////////////////////////////////////////////
		$sql = "INSERT INTO `cs` (`name`, `email`, `login`, `password`, `phone`, `active`) 
		VALUES ('$name', '$email', '$login', MD5('$pass'), '$phone', '0') "; 
		$result = mysql_query($sql) or die("Query failed");
		
		$sql = "SELECT `id` FROM `cs` WHERE `login`='$login'";
		$result = mysql_query($sql) or die("Query failed");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$newid = $line[id];


		foreach ($city as $currentcity) {
		$currentcity = sanitize($currentcity,5,1);		
		$servicecity .= " ($currentcity, $newid),";
		}
		$servicecity = substr($servicecity,0,strlen($servicecity)-1);


		$sql = "INSERT INTO `cs_dependencies` (`CityID`,`CID`) VALUES $servicecity ";
		$result = mysql_query($sql) or die("Query failed");
		$message = "Your application has been accepted and will be considered within few days";
		}
	}
} else if (($name) and ($type=='full')) {
////////////////////////////////////////////////////////////////////////////
// PROCESSING FULL SERVICE MEMBERS HERE ||||||||||||||||||||||||||||||||||||
////////////////////////////////////////////////////////////////////////////

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

if ($longdist=="yes") {$longdist="1";} else {$longdist="0";}

$name = sanitize($_POST[name],100,0);
$phone = sanitize($_POST[phone],20,0);
$fax = sanitize($_POST[fax],20,0);
$tollfree = sanitize($_POST[tollfree],20,0); 
$address = sanitize($_POST[address],150,0); 
$description = sanitize($_POST[description],1024,0); 
$license = sanitize($_POST[license],20,0); 
$email = sanitize($_POST[email],30,0); 

//////////////////////////////////////////////////////////////////////////////

$query = "INSERT INTO `fullservice` (`name`, `phone`, 
`fax`, `tollfree`, `address`, `description`, `longdist`, `license`,
`email`) VALUES (
'$name', '$phone', '$fax', '$tollfree', '$address', '$description',
'$longdist', '$license', '$email')";

//echo $query;
$message = "Your application has been accepted, you will be contacted shortly regarding billing information. ";	
$result = mysql_query($query) or $message = "An internal error occured, please repeat your request. If problem persists, contact <a href=\"mailto:admin@movinguwithcare.com\">webmaster</a>.";

} 
?>

<?php if ($name) { ?>
<body>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="178">
<img src="PICS/logo.jpg" width="150" height="70" alt="All moving companies presented on this site are members of BBB and/or AMSA an not listed on movingscam.org"> 
</td>
    <td width="1" bgcolor="#0066FF"></td>
    <td width="568"><div align="right">
<img src="PICS/movingu.jpg" width="450" height="70" alt="Best nationwide moving company network - movinguwithcare.com">
</div>
</td>
  </tr>
  <tr height="1"> 
    <td height="1"  bgcolor="#0066FF"></td>
    <td height="1"  bgcolor="#0066FF"></td>
    <td height="1"></td>
  </tr>
  <tr> 
    <td rowspan="5" valign="top">
<?php
// In this case we need only table of contents from website database
// cause everything else is generated in this script
// so don't forget to switch databases and starting work

//require("contents.php");

?>
</td>
    <td rowspan="5" bgcolor="#0066FF"></td>
    <td valign="top"><div align="center">
&nbsp;
</div></td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#0066FF" height="1"></td>
  </tr>
  <tr> 
    <td valign="top"><table width="95%" border="0" align="center">
        <tr> 
          <td><br>
  <p align="center"><strong><font size="-1" face="Arial, Helvetica, sans-serif">
<?=$message ?>
</font></strong></p><br>
<center>
<a href="javascript:history.back()">
<font size="-1" face="Arial, Helvetica, sans-serif">Return</font></a></center>
</td>
        </tr>
      </table>
      <div align="center" class="bottomtext"></div></td>
  </tr>
  <tr> 
    <td bgcolor="#0066FF" height="1"></td>
  </tr>
  <tr> 
    <td valign="top"><div align="center" class="bottomtext"><br>
<?php

include("../bottomtext");

?>
</div></td>
  </tr>
</table>
</body>
</html>
<!-- Default template by ProAqua. (C) Egor Emeliyanov, 2005 -->
<?php } ?>

<?php
if ($name) die;
///////////////////////////////////////////////////////////////////////////////
?>

<script language="JavaScript">

function fillstate(id, name, comments, s, e){
		this.id = id;
		this.name = name;
		this.comments = comments;		
		this.s = s;
		this.e = e;				
}

function fillcity(id, name){
		this.id = id;
		this.name = name;
}

function newOption(value, text) {
		var Opt		= new Option();
		Opt.value	= value;
		Opt.text	= text;
		return Opt;
}	

city = new Array()
states = new Array()

<?php

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_locator_name) or die("Could not select database");
$sql = 'SELECT `name`, `StateID` FROM `states` WHERE 1'; 
$result = mysql_query($sql) or die("Query failed: 1");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

// find the maximum CityID value
$sql = "SELECT MAX(`CityID`) AS maximum FROM `cities` WHERE `StateID` = '$line[StateID]'"; 
$maxresult = mysql_query($sql) or die("Query failed: 2");
$maxline = mysql_fetch_array($maxresult, MYSQL_ASSOC);
$maximum = $maxline[maximum]+1;

// find the minimum CityID value
$sql = "SELECT MIN(`CityID`) AS minimum FROM `cities` WHERE `StateID` = '$line[StateID]'"; 
$maxresult = mysql_query($sql) or die("Query failed: 3");
$maxline = mysql_fetch_array($maxresult, MYSQL_ASSOC);
$minimum = $maxline[minimum];

echo("states[$line[StateID]]= new fillstate('$line[StateID]', '$line[name]', '0', '$minimum', '$maximum');\n"); 


	$sql = "SELECT `CityID`, `city` FROM `cities` WHERE `StateID`='$line[StateID]'"; 
//	echo($sql);
	$localresult = mysql_query($sql) or die("Query failed: 4");

		while ($localline = mysql_fetch_array($localresult, MYSQL_ASSOC)) {
			$city = addslashes($localline[city]);
			echo("city[$localline[CityID]] = new fillcity('$city', '$localline[CityID]');\n");
		}
}

?>

function show_selected() {
		var form = document.forms.form1;
		var id = form.state.options[form.state.selectedIndex].value;
		if (id != '-1'){
			form.city.disabled = false;
			form.city.options.length = 1;
//            comm=eval('document.forms.form1.c' + id)
//			document.getElementById('comments').innerHTML ="<p>"+comm.value+"</p>";
			for (i=states[id].s; i<states[id].e*1; i++){
//				alert (city[i].name);
				form.city.options.length += 1;
				form.city.options[form.city.options.length-1] = newOption(city[i].name, city[i].id);
			} 
		} else {
			form.city.disabled = true;		
			form.city.options.length=1;
		 }
	}

</script>

<body>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr> 
    <td width="178">
<img src="PICS/logo.jpg" width="150" height="70" alt="All moving companies presented on this site are members of BBB and/or AMSA an not listed on movingscam.org"> 
</td>
    <td width="1" bgcolor="#0066FF"></td>
    <td width="568"><div align="right">
<img src="PICS/movingu.jpg" width="450" height="70" alt="Best nationwide moving company network - movinguwithcare.com">
</div>
</td>
  </tr>


 <tr height="1"> 
    <td height="1"  bgcolor="#0066FF"></td>
    <td height="1"  bgcolor="#0066FF"></td>
    <td height="1"></td>
  </tr>
  <tr> 
    <td rowspan="5" valign="top">
<?php
// In this case we need only table of contents from website database
// cause everything else is generated in this script
// so don't forget to switch databases and starting work

require("contents.php");

include("trustlogo.inc.php");

?>
</td>
    <td rowspan="5" bgcolor="#0066FF"></td>
    <td valign="top"><div align="center"><?php
$bookmarks = "<a href=\"https://locator.movinguwithcare.com/?fs\"><img src=\"../PICS/fs_n.gif\" width=\"157\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?lupu\"><img src=\"../PICS/load_n.gif\" width=\"159\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?trans\"><img src=\"../PICS/trans_n.gif\" width=\"185\" height=\"29\" border=0>";
echo ($bookmarks); ?></div></td></tr><tr> 
    <td valign="top" bgcolor="#0066FF" height="1"></td>
  </tr>
  <tr> 
    <td valign="top"><table width="95%" border="0" align="center">
        <tr> 
          <td><br>
<script language="JavaScript">
a="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone\" class=\"formobject\"></td></tr><tr><td><p>Login:<br><a href=\"#\" onclick=\"openlogin()\">Check avaibility</a></td><td><input type=\"text\" name=\"login\" class=\"formobject\"></td></tr><tr><td><p>Password:</td><td><input type=\"text\" name=\"pass\" class=\"formobject\" onKeyUp=\"MakeBaloon(document.forms[0].pass.value)\">&nbsp;<input type=\"button\" name=\"generate\" value=\"Generate\" STYLE=\"width: 80; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onClick=\"GeneratePassword()\"></td></tr><tr><td><p>Select area of your service:<br><i>(Ctrl+Click to select multiple)</i></td><td>&nbsp;</td></tr><tr><td colspan=\"2\" align=\"center\"><select name=\"state\" size=\"10\" onchange=\"show_selected()\" class=\"formobject\" style=\"width: 35%\"><option value=-1 selected>Please, select state</option><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `name`, `StateID` FROM `states` WHERE 1'; 
$result = mysql_query($sql) or die("Query failed :5");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[StateID]>$line[name]");
}


?></select><select name=\"city[]\" id=\"city\" size=\"10\" multiple=\"multiple\" disabled class=\"formobject\" style=\"width: 35%\"><option value=-1>----- Select city -----</option></select></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"button\" name=\"Submit\" value=\"Submit\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onclick=\"finish()\">&nbsp;<input type=\"reset\" name=\"Reset\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

b="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone\" class=\"formobject\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:</td><td><input type=\"text\" name=\"tollfree\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>Description:</td><td><textarea name=\"description\" cols=\"22\" rows=\"5\" class=\"formobject\"></textarea></td></tr><tr><td><p>Do you have interstate license?</td><td><input name=\"longdist\" type=\"radio\" value=\"yes\" checked><font face=Arial size=-1 color=#130D57>Yes <input name=\"longdist\" type=\"radio\" value=\"no\">No</td></tr><tr><td><p>Please, provide number of you license:</td><td><input type=\"text\" name=\"license\" class=\"formobject\"></td></tr><tr><td><p>Select state of your service:</td><td><select name=\"state\" class=\"formobject\" style=\"width: 63%\"><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE 1 LIMIT 0, 100 '; 

$result = mysql_query($sql) or die("Query failed");

// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

//if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";


echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
    
}



?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"button\" name=\"Submit\" value=\"Submit\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onclick=\"finish()\">&nbsp;<input type=\"reset\" name=\"Reset\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

function setdata() {
if (document.forms[0].type[0].checked) {
	document.getElementById('newmember').innerHTML=a;
	} else {
	document.getElementById('newmember').innerHTML=b;
	}
}

function openlogin() {
login = document.forms[0].login.value;

if (navigator.appName=="Microsoft Internet Explorer") {
window.open("checklogin.php?"+login,"login","toolbar=no,location=no,directories=no,status=no,scrollbars=no,menubar=no,fullscreen=no,width=300,height=100");
}
else {
location.href="checklogin.php?"+login;
}

}


function finish()
{
document.forms[0].submit();
}

function GeneratePassword() {

    var length=8;
    var sPassword = "";

	for (i=0; i < length; i++) 
	{
		numI = getRandomNum();
		while (checkPunc(numI)) { numI = getRandomNum(); } 
	        sPassword = sPassword + String.fromCharCode(numI);
	}

document.forms[0].pass.value = sPassword;

MakeBaloon(sPassword);

return true;

}

function MakeBaloon(sPassword) {

    var alpha = new Array('alpha', 'bravo', 'charlie', 'delta', 'echo', 'foxtrot', 'golf', 'hotel', 'india', 'juliet', 'kilo', 'lima', 'mike', 'november', 'oscar', 'papa', 'quebec', 'romeo', 'sierra', 'tango', 'uniform', 'victor', 'whiskey', 'x-ray', 'yankee', 'zulu');

title = '';

	for (i=0; i < sPassword.length; i++) 
		{
		current = sPassword.substr(i,1);
		if (current.search(/[0-9]/)==0) title = title + ' digit ' + current;
		if (current.search(/[A-Z]/)==0) title = title + ' UPPERCASE ' + alpha[current.charCodeAt()-65].toUpperCase();
		if (current.search(/[a-z]/)==0) title = title + ' lowercase ' + alpha[current.charCodeAt()-97];
                }

document.forms[0].pass.title = title;

return true;

}


function getRandomNum() {

    var rndNum = Math.random()
    rndNum = parseInt(rndNum * 1000);
    rndNum = (rndNum % 94) + 33;

    return rndNum;
}

function checkPunc(num) {

    if ((num >=33) && (num <=47)) { return true; }
    if ((num >=58) && (num <=64)) { return true; }
    if ((num >=91) && (num <=96)) { return true; }
    if ((num >=123) && (num <=126)) { return true; }

    return false;
}

</script>

  <p align="center"><strong><font size="-1" face="Arial, Helvetica, sans-serif">Become a 
    MovingUWithCare.com member</font></strong></p>
<form name="form1" method="post" action="<?=$SCRIPT_NAME?>">
  <table width="90%" border="0" align="center">
    <tr>
      <td><p>What kind of membership you are interested in:</td>
      <td><p><input name="type" type="radio" onClick="setdata()" value="standart">
        Standard membership (<strong>free</strong>)<br>
        <input type="radio" name="type" value="full" onClick="setdata()">        
	Full service membership (<strong><?=$CN_FULL_PRICE ?></strong>)</td>
    </tr>
  </table>

<span id="newmember">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</span>

</form>
</td>
        </tr>
      </table>
      <div align="center" class="bottomtext"></div></td>
  </tr>
  <tr> 
    <td bgcolor="#0066FF" height="1"></td>
  </tr>
  <tr> 
    <td valign="top"><div align="center" class="bottomtext"><br>
<?php

include("../bottomtext");

?>
</div></td>
  </tr>
</table>
</body>
</html>
<!-- Default template by ProAqua. (C) Egor Emeliyanov, 2005 -->