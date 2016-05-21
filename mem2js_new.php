<?php
require("config.inc.php");


error_reporting(0);
?>
<script language="JavaScript">

Selcity = new Array()

function fillstate(id, name, comments, s, e){
		this.id = id;
		this.name = name;
		this.comments = comments;		
		this.s = s;
		this.e = e;				
}

function showServiceCountries()
{
	var form = document.forms[0];
	if(form.association.options[4].selected == true)
	{
		form.country.disabled = false;
	}
	else
	{
		var i;
		for (i=0; i<form.country.length; i++)
		{
			form.country.options[i].selected = false;
		}
		form.country.disabled = true;
		
	}	
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

function enableRadio(state)
{
	if (state.options[state.selectedIndex].value == 999)
	{
		form1.radio2.disabled = true;
	}
	else
	{
		form1.radio2.disabled = false;
	}
}

function enableLicense()
{
	form1.license.disabled = false;
	form1.license1.disabled = false;
	form1.license2.disabled = false;
}

function disableLicense()
{	
	form1.license.disabled = true;
	form1.license1.disabled = true;
	form1.license2.disabled = true;
	form1.license.value = "";
	form1.license1.value = "";
	form1.license2.value = "";
	form1.state.options[0].selected = true;

}
function enable_sms()
{
	form1.sms_company.disabled = false;
	form1.sms_phone.disabled = false;
}

function disable_sms()
{	
	form1.sms_company.disabled = true;
	form1.sms_phone.disabled = true;
	form1.sms_company.value = "";
	form1.sms_phone.value = "";
	form1.sms_company.options[0].selected = true;

}
city = new Array()
states = new Array()

<?php

$link = mysqli_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `name`, `StateID` FROM `states` WHERE 1'; 
$result = mysqli_query($link, $sql) or die("Query failed: 1");

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

	// find the maximum CityID value
	$sql = "SELECT MAX(`CityID`) AS maximum FROM `cities` WHERE `StateID` = '$line[StateID]'"; 
	$maxresult = mysqli_query($link, $sql) or die("Query failed: 2");
	$maxline = mysqli_fetch_array($maxresult, MYSQLI_ASSOC);
	$maximum = $maxline[maximum]+1;

	// find the minimum CityID value
	$sql = "SELECT MIN(`CityID`) AS minimum FROM `cities` WHERE `StateID` = '$line[StateID]'"; 
	$maxresult = mysqli_query($link, $sql) or die("Query failed: 3");
	$maxline = mysqli_fetch_array($maxresult, MYSQLI_ASSOC);
	$minimum = $maxline[minimum];

	echo("states[$line[StateID]]= new fillstate('$line[StateID]', '$line[name]', '0', '$minimum', '$maximum');\n"); 

	$sql = "SELECT `CityID`, `city` FROM `cities` WHERE `StateID`='$line[StateID]'";
	$localresult = mysqli_query($link, $sql) or die("Query failed: 4");

	while ($localline = mysqli_fetch_array($localresult, MYSQLI_ASSOC)) {
		$city = addslashes($localline[city]);
		echo("city[$localline[CityID]] = new fillcity('$city', '$localline[CityID]');\n");
	}
}

?>

function show_selected() {

        if(!form1.city.disabled)
		{
			var r = new Array();
			for (var i = 0; i < form1.city.length; i++)
			{
				if (form1.city.options[i].selected)
				{
					Selcity[Selcity.length] = form1.city.options[i].value;
				}
			}
		}
		
		var form = document.forms.form1;
		var id = form.state.options[form.state.selectedIndex].value;
		if (id != '-1'){
			form.city.disabled = false;
			form.city.options.length = 1;
			for (i=states[id].s; i<states[id].e*1; i++){
				form.city.options.length += 1;
				form.city.options[form.city.options.length-1] = newOption(city[i].name, city[i].id);
			} 
		} else {
			form.city.disabled = true;		
			form.city.options.length=1;
		 }
		 
	}
	
	function AddValues()
	{
		if(!form1.city.disabled)
		{
			var r = new Array();
			for (var i = 0; i < form1.city.length; i++)
			{
				if (form1.city.options[i].selected)
				{
					Selcity[Selcity.length] = form1.city.options[i].value;
				}
			}
		}
		form1.selcities.value = Selcity;		
		//alert(form1.selcities.value);
		//__doPostBack('b1','');
	}

</script>
<script language="JavaScript">
a="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td> <input type=\"text\" name=\"phone_one\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_two\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_three\" maxlength=\"4\" class=\"formobject\" size=\"4\"> ext. <input type=\"text\" name=\"phone_four\" maxlength=\"5\" class=\"formobject\" size=\"5\"></td></tr><tr><td><p>Login:<br></td><td><input type=\"text\" name=\"login\" class=\"formobject\"></td></tr><tr><td><p>Password:<br></td><td><input type=\"text\" name=\"pass\" class=\"formobject\" onKeyUp=\"MakeBaloon(document.forms[0].pass.value)\">&nbsp;<input type=\"button\" name=\"generate\" class=\"button\" value=\"Generate\" STYLE=\"width: 80; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onClick=\"GeneratePassword()\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:(if not applicable enter contact number, no spaces,Make sure to place prefix 1, i.e. 1866xxxxxxx)</td><td><input type=\"text\" name=\"tollfree\" maxlength=\"11\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>ZipCode/Postal Code:</td><td><input type=\"text\" name=\"zipcode\" maxlength=\"7\" class=\"formobject\"></td></tr><tr><td>Would you like to be notified about new orders through text-messaging?</td><td><input type='radio' name='sms_service' value='yes' checked onclick='return enable_sms()' id='sms_service1' class=\"formobject\">yes  <input type='radio' name='sms_service' value='no' onclick='return disable_sms()' id='sms_service2' class=\"formobject\">no</td></tr><tr><td>Phone number you would like to receive text message on:</td><td><input type=\"text\" name=\"sms_phone\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td valign='top'>Cellphone Providers:</td><td><select name='sms_company' size='9' class=\"formobject\"><option value='' selected>Select A Provider</option><option value='mmode.com'>AT&T</option><option value='mobile.mycingular.com'>Cingular</option><option value='page.metrocall.com'>Metrocall</option><option value='messaging.nextel.com'>Nextel</option><option value='messaging.sprintpcs.com'>Sprint PCS</option><option value='tmomail.net'>T-Mobile</option><option value='vtext.com'>Verizon Wireless</option><option value='vmobl.com'>Virgin Mobile USA</option><option value='txt.bellmobility.ca'>Bell</option><option value='msg.telus.com'>Telus</option><option value='pcs.rogers.com'>Rogers</option><option value='fido.ca'>Fido</option></select></td></tr><!--tr><td><p>Description:</td><td><textarea name=\"description\" cols=\"22\" rows=\"5\" class=\"formobject\"></textarea></td></tr--><tr><td><p>Select area of your service:<br><i>(Ctrl+Click to select multiple cities)</i></td><td>&nbsp;</td></tr><tr><td colspan=\"2\" align=\"center\"><INPUT id=\"selcities\" type=\"hidden\" name=\"selcities\"><select name=\"state\" size=\"10\" onchange=\"show_selected()\" class=\"formobject\" style=\"width: 35%\"><option value=-1 selected>Please, Select State/Province</option><?php
mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `name`, `StateID`, `sh_name` FROM `states` WHERE StateID!=999 AND StateID!=68'; 
$result = mysqli_query($link, $sql) or die("Query failed :5");

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {	
	if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";
	
	if ($line[StateID]!=52)
		echo ("<option value=$line[StateID] $style $sel>$line[name] ($line[sh_name])</option>");
	else
		echo ("<option value=$line[StateID] $style $sel>$line[name]</option>");
}


?></select><select name=\"city[]\" id=\"city\" size=\"10\" multiple=\"multiple\" disabled class=\"formobject\" style=\"width: 35%\"><option value=-1>----- Select city -----</option></select></td></tr><tr><td><p>Select the associations you are registered with:</td><td><select name=\"association[]\" id=\"association\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `assid`, `ass_shname`, `ass_fullname` FROM `associations` WHERE 1'; 
$result = mysqli_query($link, $sql) or die("Query failed :6");

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	
echo("<option value=$line[assid]>$line[ass_shname]"."($line[ass_fullname])");
}

?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"hidden\" class\"formobject\" name = \"description\" value=\"\"><input type=\"submit\" onclick=\"AddValues();return validate_lupu(document.forms[0]);\" class=\"button\" name=\"Submit\" value=\"Submit\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\">&nbsp;<input type=\"reset\" class=\"button\" name=\"Reset\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

b="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone_one\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_two\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_three\" maxlength=\"4\" class=\"formobject\" size=\"4\"> ext. <input type=\"text\" name=\"phone_four\" maxlength=\"5\" class=\"formobject\" size=\"5\"></td></tr><tr><td><p>Login:<br></td><td><input type=\"text\" name=\"login\" class=\"formobject\"></td></tr><tr><td><p>Password:</td><td><input type=\"text\" name=\"pass\" class=\"formobject\" onKeyUp=\"MakeBaloon(document.forms[0].pass.value)\">&nbsp;<input type=\"button\" name=\"generate\" class=\"button\" value=\"Generate\" STYLE=\"width: 80; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onClick=\"GeneratePassword()\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:(if not applicable enter contact number, no spaces,Make sure to place prefix 1, i.e. 1866xxxxxxx)</td><td><input type=\"text\" name=\"tollfree\" maxlength=\"11\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>State/Province:</td><td><select name=\"m_state\" class=\"formobject\" style=\"width: 63%\"><option value=\"0\">Select State/Province</option><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");
$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=999';
$result = mysqli_query($link, $sql) or die("Query failed");
// showing all states
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";
	if ($line[StateID]!=52)
		echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
	else
		echo ("<option value=$line[StateID] $style>$line[name]</option>");
}
		echo ("<option value=997 >NTWS-US</option>");
		echo ("<option value=998 >NTWS-CAN</option>");
?></select></td></tr><tr><td><p>ZipCode/Postal Code:</td><td><input type=\"text\" name=\"zipcode\" maxlength=\"7\" class=\"formobject\"></td></tr><tr><td>Would you like to be notified about new orders through text-messaging?</td><td><input type='radio' name='sms_service' value='yes' checked onclick='return enable_sms()' id='sms_service1' class=\"formobject\">yes  <input type='radio' name='sms_service' value='no' onclick='return disable_sms()' id='sms_service2' class=\"formobject\">no</td></tr><tr><td>Phone number you would like to receive text message on:</td><td><input type=\"text\" name=\"sms_phone\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td valign='top'> Cellphone Providers:</td><td><select name='sms_company' size='9' class=\"formobject\"><option value='' selected>Select A Provider</option><option value='mmode.com'>AT&T</option><option value='mobile.mycingular.com'>Cingular</option><option value='page.metrocall.com'>Metrocall</option><option value='messaging.nextel.com'>Nextel</option><option value='messaging.sprintpcs.com'>Sprint PCS</option><option value='tmomail.net'>T-Mobile</option><option value='vtext.com'>Verizon Wireless</option><option value='vmobl.com'>Virgin Mobile USA</option><option value='txt.bellmobility.ca'>Bell</option><option value='msg.telus.com'>Telus</option><option value='pcs.rogers.com'>Rogers</option><option value='fido.ca'>Fido</option></select></td></tr><tr><td><p>Description: <br><i>Please specify what you specialize in: For example: Car and antics moving, piano move, furniture or computer equipment, office moving, small move( 1 to 10 items: Great for Ebay auctions) pet movers etc...<i></td><td><textarea name=\"description\" cols=\"22\" rows=\"5\" class=\"formobject\"></textarea></td></tr><tr><td>&nbsp</td><td></td></tr><tr><td><p>Do you have interstate license? (leave blank if not applicable)</td><td><input name=\"longdist\" type=\"radio\" id=\"radio1\" value=\"yes\" checked onclick=\"return enableLicense()\"><font face=Arial size=-1 color=#130D57>Yes <input name=\"longdist\" type=\"radio\" value=\"no\" id=\"radio2\" onclick=\"return disableLicense()\">No</td></tr><tr><td><p>If Yes,Please provide USDOT#:<br />&nbsp;&nbsp;&nbsp;&nbsp;MC#:</td><td><input type=\"text\" name=\"license\" class=\"formobject\"><br /><input type=\"text\" name=\"license1\" class=\"formobject\"></td></tr><tr><td><p>Canadian interprovince license:</td><td><input type=\"text\" name=\"license2\"></td></tr><tr><td><p>Select State/Province of your service:</td><td><select name=\"state\" class=\"formobject\" style=\"width: 63%\"><option value=0>Select service state/province</option><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");
$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=999';
$result = mysqli_query($link, $sql) or die("Query failed");
	echo ("<option value=999 $style>Nation Wide</option>");
// showing all states
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";
if ($line[StateID]!=52)
	echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
else
	echo ("<option value=$line[StateID] $style>$line[name]</option>");
    
}

?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><tr><td><p>Select the associations you are registered with:</td><td><select name=\"association[]\" id=\"association\" size=\"5\" multiple=\"multiple\" class=\"formobject\" onchange=\"showServiceCountries()\" style=\"width: 100%\"><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `assid`, `ass_shname`, `ass_fullname` FROM `associations` WHERE 1'; 
$result = mysqli_query($link, $sql) or die("Query failed :6");

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo("<option value=$line[assid]>$line[ass_shname]"."($line[ass_fullname])");
}

?></select></td></tr><tr><td><p>Select your service country if you are registered with HHGFAA <i>(Ctrl+Click to select multiple)</i>:</td><td><select name=\"country[]\" disabled id=\"country\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `id`, `country_name`, `country_code` FROM `operatingcountries` order by country_name'; 
$result = mysqli_query($link, $sql) or die("Query failed :6");

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo("<option value=$line[id]>$line[country_name]"."($line[country_code])");
}

?></select></td></tr><tr><td><p>Upload your Company's Logo (optional) (200 X 100 Only): </td><td><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"25000000\"><input name = \"Logo\" type = \"file\" size = \"30\" class=\"formobject\"></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"submit\" onclick=\"return validate_fullservice(document.forms[0])\" name=\"Submit\" value=\"Submit\" class=\"button\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\">&nbsp;<input type=\"reset\" name=\"Reset\" class=\"button\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

c="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone_one\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_two\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_three\" maxlength=\"4\" class=\"formobject\" size=\"4\"> ext. <input type=\"text\" name=\"phone_four\" maxlength=\"5\" class=\"formobject\" size=\"5\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:(if not applicable enter contact number, Make sure to place prefix 1, i.e. 1866xxxxxxx)</td><td><input type=\"text\" name=\"tollfree\" maxlength=\"11\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>ZipCode/Postal Code:</td><td><input type=\"text\" name=\"zipcode\" maxlength=\"7\" class=\"formobject\"></td></tr><tr><td><p>State/Province:</td><td><select name=\"m_state\" class=\"formobject\" style=\"width: 63%\"><option value=\"0\">Select State/Province</option><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");
$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=999';
$result = mysqli_query($link, $sql) or die("Query failed");

// showing all states
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";
	if ($line[StateID]!=52)
		echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
	else
		echo ("<option value=$line[StateID] $style>$line[name]</option>");
}

?></select></td></tr><tr><td>Would you like to be notified about new orders through text-messaging?</td><td><input type='radio' name='sms_service' value='yes' checked onclick='return enable_sms()' id='sms_service1' class=\"formobject\">yes  <input type='radio' name='sms_service' value='no' onclick='return disable_sms()' id='sms_service2' class=\"formobject\">no</td></tr><tr><td>Phone number you would like to receive text message on:</td><td><input type=\"text\" name=\"sms_phone\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td valign='top'>Cellphone Providers:</td><td><select name='sms_company' size='9' class=\"formobject\"><option value='' selected>Select A Provider</option><option value='mmode.com'>AT&T</option><option value='mobile.mycingular.com'>Cingular</option><option value='page.metrocall.com'>Metrocall</option><option value='messaging.nextel.com'>Nextel</option><option value='messaging.sprintpcs.com'>Sprint PCS</option><option value='tmomail.net'>T-Mobile</option><option value='vtext.com'>Verizon Wireless</option><option value='vmobl.com'>Virgin Mobile USA</option><option value='txt.bellmobility.ca'>Bell</option><option value='msg.telus.com'>Telus</option><option value='pcs.rogers.com'>Rogers</option><option value='fido.ca'>Fido</option></select></td></tr><tr><td><p>Description:<br><i>Please specify what you specialize in: For example: Car and antics moving, piano move, furniture or computer equipment, office moving, small move( 1 to 10 items: Great for Ebay auctions) pet movers etc...<i></td><td><textarea name=\"description\" cols=\"22\" rows=\"5\" class=\"formobject\"></textarea></td></tr><tr><td>&nbsp</td><td></td></tr><tr><tr><td><p>Do you have interstate license?(leave blank if not applicable)</td><td><input name=\"longdist\" type=\"radio\" id=\"radio1\" value=\"yes\" checked onclick=\"return enableLicense()\"><font face=Arial size=-1 color=#130D57>Yes <input name=\"longdist\" type=\"radio\" value=\"no\" id=\"radio2\" onclick=\"return disableLicense()\">No</td></tr><tr><td><p>If Yes,Please provide USDOT#:<br />&nbsp;&nbsp;&nbsp;&nbsp;MC#:</td><td><input type=\"text\" name=\"license\" class=\"formobject\"><br /><input type=\"text\" name=\"license1\" class=\"formobject\"></td></tr><tr><td><p>Canadian interprovince license:</td><td><input type=\"text\" name=\"license2\"></td></tr><tr><td><p>Select State/Province of your service:</td><td><select name=\"state\" class=\"formobject\" style=\"width: 63%\"><option value=0>Select State/Province</option><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=999'; 

$result = mysqli_query($link, $sql) or die("Query failed");
	echo ("<option value=999 $style>Nation Wide</option>");
// showing all states
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";
if ($line[StateID]!=52)
	echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
else
	echo ("<option value=$line[StateID] $style>$line[name]</option>");
    
}


?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><tr><td><p>Select the associations you are registered with:</td><td><select name=\"association[]\" id=\"association\" size=\"5\" multiple=\"multiple\" class=\"formobject\" onchange=\"showServiceCountries()\" style=\"width: 100%\"><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `assid`, `ass_shname`, `ass_fullname` FROM `associations` WHERE 1'; 
$result = mysqli_query($link, $sql) or die("Query failed :6");

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo("<option value=$line[assid]>$line[ass_shname]"."($line[ass_fullname])");
}

?></select></td></tr><tr><td><p>Select your service country if you are registered with HHGFAA <i>(Ctrl+Click to select multiple)</i>:</td><td><select name=\"country[]\" id=\"country\" size=\"5\" multiple=\"multiple\" disabled class=\"formobject\" style=\"width: 100%\"><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `id`, `country_name`, `country_code` FROM `operatingcountries` order by country_name'; 
$result = mysqli_query($link, $sql) or die("Query failed :6");

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo("<option value=$line[id]>$line[country_name]"."($line[country_code])");
}

?></select></td></tr><tr><td><p>Upload your Company's Logo (optional) (200 X 100 Only): </td><td><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"25000000\"><input name = \"Logo\" type = \"file\" size = \"30\" class=\"formobject\"></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"submit\" onclick=\"return validate_transport(document.forms[0]);\" name=\"Submit\" value=\"Submit\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\">&nbsp;<input type=\"reset\" name=\"Reset\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

d="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone_one\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_two\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_three\" maxlength=\"4\" class=\"formobject\" size=\"4\"> ext. <input type=\"text\" name=\"phone_four\" maxlength=\"5\" class=\"formobject\" size=\"5\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:(if not applicable enter contact number, Make sure to place prefix 1, i.e. 1866xxxxxxx)</td><td><input type=\"text\" name=\"tollfree\" maxlength=\"11\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>ZipCode/Postal Code:</td><td><input type=\"text\" name=\"zipcode\" maxlength=\"7\" class=\"formobject\"></td></tr><tr><td><p>State/Province:</td><td><select name=\"m_state\" class=\"formobject\" style=\"width: 63%\"><option value=\"0\">Select State/Province</option><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");
$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=999';
$result = mysqli_query($link, $sql) or die("Query failed");

// showing all states
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";
	if ($line[StateID]!=52)
		echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
	else
		echo ("<option value=$line[StateID] $style>$line[name]</option>");
}

?></select></td></tr><tr><td>Would you like to be notified about new orders through text-messaging?</td><td><input type='radio' name='sms_service' value='yes' checked onclick='return enable_sms()' id='sms_service1' class=\"formobject\">yes  <input type='radio' name='sms_service' value='no' onclick='return disable_sms()' id='sms_service2' class=\"formobject\">no</td></tr><tr><td>Phone number you would like to receive text message on:</td><td><input type=\"text\" name=\"sms_phone\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td valign='top'>Cellphone Providers:</td><td><select name='sms_company' size='9' class=\"formobject\"><option value='' selected>Select A Provider</option><option value='mmode.com'>AT&T</option><option value='mobile.mycingular.com'>Cingular</option><option value='page.metrocall.com'>Metrocall</option><option value='messaging.nextel.com'>Nextel</option><option value='messaging.sprintpcs.com'>Sprint PCS</option><option value='tmomail.net'>T-Mobile</option><option value='vtext.com'>Verizon Wireless</option><option value='vmobl.com'>Virgin Mobile USA</option><option value='txt.bellmobility.ca'>Bell</option><option value='msg.telus.com'>Telus</option><option value='pcs.rogers.com'>Rogers</option><option value='fido.ca'>Fido</option></select></td></tr><tr><td><p>Description:</td><td><textarea name=\"description\" cols=\"22\" rows=\"5\" class=\"formobject\"></textarea></td></tr><tr><td><p>Select State/Province of your storage location:</td><td><select name=\"state\" class=\"formobject\" style=\"width: 63%\"><option value=0>Select State/Province</option><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE   StateID!=68 && StateID!=999'; 

$result = mysqli_query($link, $sql) or die("Query failed");
	echo ("<option value=999 $style>Nation Wide</option>");
// showing all states
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";

if ($line[StateID]!=52)
	echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
else
	echo ("<option value=$line[StateID] $style>$line[name]</option>");   
}



?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><tr><td><p>Select the associations you are registered with:</td><td><select name=\"association[]\" id=\"association\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `assid`, `ass_shname`, `ass_fullname` FROM `associations` WHERE 1'; 
$result = mysqli_query($link, $sql) or die("Query failed :6");

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo("<option value=$line[assid]>$line[ass_shname]"."($line[ass_fullname])");
}

?></select></td></tr><tr><td><p>Upload your Company's Logo (optional) (200 X 100 Only): </td><td><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"25000000\"><input name = \"Logo\" type = \"file\" size = \"30\" class=\"formobject\"></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"submit\" onclick=\"return validate_packingstorage(document.forms[0])\" name=\"Submit\" class=\"button\" value=\"Submit\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\">&nbsp;<input type=\"reset\" class=\"button\" name=\"Reset\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

e="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone_one\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_two\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_three\" maxlength=\"4\" class=\"formobject\" size=\"4\"> ext. <input type=\"text\" name=\"phone_four\" maxlength=\"5\" class=\"formobject\" size=\"5\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:(if not applicable enter contact number, Make sure to place prefix 1, i.e. 1866xxxxxxx)</td><td><input type=\"text\" name=\"tollfree\" maxlength=\"11\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>ZipCode/Postal Code:</td><td><input type=\"text\" name=\"zipcode\" maxlength=\"7\" class=\"formobject\"></td></tr><tr><td><p>State/Province:</td><td><select name=\"m_state\" class=\"formobject\" style=\"width: 63%\"><option value=\"0\">Select State/Province</option><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");
$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=999';
$result = mysqli_query($link, $sql) or die("Query failed");

// showing all states
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";
	if ($line[StateID]!=52)
		echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
	else
		echo ("<option value=$line[StateID] $style>$line[name]</option>");
}

?></select></td></tr><tr><td>Would you like to be notified about new orders through text-messaging?</td><td><input type='radio' name='sms_service' value='yes' checked onclick='return enable_sms()' id='sms_service1' class=\"formobject\">yes  <input type='radio' name='sms_service' value='no' onclick='return disable_sms()' id='sms_service2' class=\"formobject\">no</td></tr><tr><td>Phone number you would like to receive text message on:</td><td><input type=\"text\" name=\"sms_phone\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td valign='top'>Cellphone Providers:</td><td><select name='sms_company' size='9' class=\"formobject\"><option value='' selected>Select A Provider</option><option value='mmode.com'>AT&T</option><option value='mobile.mycingular.com'>Cingular</option><option value='page.metrocall.com'>Metrocall</option><option value='messaging.nextel.com'>Nextel</option><option value='messaging.sprintpcs.com'>Sprint PCS</option><option value='tmomail.net'>T-Mobile</option><option value='vtext.com'>Verizon Wireless</option><option value='vmobl.com'>Virgin Mobile USA</option><option value='txt.bellmobility.ca'>Bell</option><option value='msg.telus.com'>Telus</option><option value='pcs.rogers.com'>Rogers</option><option value='fido.ca'>Fido</option></select></td></tr><tr><td><p>Description:</td><td><textarea name=\"description\" cols=\"22\" rows=\"5\" class=\"formobject\"></textarea></td></tr><tr><td><p>Where can you ship your packing supplies ?:</td><td><select name=\"state\" class=\"formobject\" style=\"width: 63%\"><option value=0>Select State/Province</option><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=68 &&  StateID!=999'; 

$result = mysqli_query($link, $sql) or die("Query failed");
	echo ("<option value=999 $style>Nation Wide</option>");
// showing all states
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";

if ($line[StateID]!=52)
	echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
else
	echo ("<option value=$line[StateID] $style>$line[name]</option>");       
}



?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><tr><td><p>Select the associations you are registered with:</td><td><select name=\"association[]\" id=\"association\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php
mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `assid`, `ass_shname`, `ass_fullname` FROM `associations` WHERE 1'; 
$result = mysqli_query($link, $sql) or die("Query failed :6");

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo("<option value=$line[assid]>$line[ass_shname]"."($line[ass_fullname])");
}
?></select></td></tr><tr><td><p>Upload your Company's Logo (optional) (200 X 100 Only): </td><td><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"25000000\"><input name = \"Logo\" type = \"file\" size = \"30\" class=\"formobject\"></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"submit\" onclick=\"return validate_packingstorage(document.forms[0])\" name=\"Submit\" class=\"button\" value=\"Submit\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\">&nbsp;<input type=\"reset\" class=\"button\" name=\"Reset\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

f="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td align=\"left\">Type of Service</td><td><select name=\"market_type\" size=\"1\" id=\"type\"><option value=\"\" selected>Select a Service</option><option value=\"business_consulting\" >Business Consulting</option> <option value=\"cleaning_services\" >Cleaning Services</option><option value=\"database_developers\">Database Developers</option><option value=\"editors\" >Editors</option><option value=\"home_renovation_help\" >Home Renovation Help</option><option value=\"landscaping\" >Landscaping</option><option value=\"legal\" >legal/paralegal</option> <option value=\"marketing\" >Marketing</option> <option value=\"mortgage_brokers\" >Mortgage Brokers</option><option value=\"moving_insurance_customers\" >Moving Insurance for Customers</option><option value=\"moving_insurance_movers\" >Moving Insurance for Movers</option><option value=\"programmers\" >Programmers</option><option value=\"real_estate_brokerage\" >Real Estate Brokerage</option><option value=\"trailer_supplies_equipment\" >Trailer Equipment and Supplies provider</option><option value=\"web design\" >Web Design</option><option value=\"writing\" >Writing</option></select></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone_one\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_two\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_three\" maxlength=\"4\" class=\"formobject\" size=\"4\"> ext. <input type=\"text\" name=\"phone_four\" maxlength=\"5\" class=\"formobject\" size=\"5\"></td></tr><tr><td><p>Login:<br></td><td><input type=\"text\" name=\"login\" class=\"formobject\"></td></tr><tr><td><p>Password:</td><td><input type=\"text\" name=\"pass\" class=\"formobject\" onKeyUp=\"MakeBaloon(document.forms[0].pass.value)\">&nbsp;<input type=\"button\" name=\"generate\" class=\"button\" value=\"Generate\" STYLE=\"width: 80; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onClick=\"GeneratePassword()\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:(if not applicable enter contact number,Make sure to place prefix 1, i.e. 1866xxxxxxx)</td><td><input type=\"text\" name=\"tollfree\" maxlength=\"11\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>Country:</td><td><select name=\"country\" class=\"formobject\" style=\"width: 63%\"><option value=\"USA\">United States<option value=\"Canada\">Canada</option></select></td></tr><tr><td><p>State/Province:</td><td><select name=\"state\" class=\"formobject\" style=\"width: 63%\"><option value=\"0\">Select State/Province</option><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");
$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=999';
$result = mysqli_query($link, $sql) or die("Query failed");
	echo ("<option value=999 $style>Nation Wide</option>");
// showing all states
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";
	if ($line[StateID]!=52)
		echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
	else
		echo ("<option value=$line[StateID] $style>$line[name]</option>");
}

?></select></td></tr><tr><td><p>ZipCode/Postal Code:</td><td><input type=\"text\" name=\"zipcode\" maxlength=\"7\" class=\"formobject\"></td></tr><tr><td>Would you like to be notified about new orders through text-messaging?</td><td><input type='radio' name='sms_service' value='yes' checked onclick='return enable_sms()' id='sms_service1' class=\"formobject\">yes  <input type='radio' name='sms_service' value='no' onclick='return disable_sms()' id='sms_service2' class=\"formobject\">no</td></tr><tr><td>Phone number you would like to receive text message on:</td><td><input type=\"text\" name=\"sms_phone\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td valign='top'>Cellphone Providers:</td><td><select name='sms_company' size='9' class=\"formobject\"><option value='' selected>Select A Provider</option><option value='mmode.com'>AT&T</option><option value='mobile.mycingular.com'>Cingular</option><option value='page.metrocall.com'>Metrocall</option><option value='messaging.nextel.com'>Nextel</option><option value='messaging.sprintpcs.com'>Sprint PCS</option><option value='tmomail.net'>T-Mobile</option><option value='vtext.com'>Verizon Wireless</option><option value='vmobl.com'>Virgin Mobile USA</option><option value='txt.bellmobility.ca'>Bell</option><option value='msg.telus.com'>Telus</option><option value='pcs.rogers.com'>Rogers</option><option value='fido.ca'>Fido</option></select></td></tr><tr><td><p>Description:</td><td><textarea name=\"description\" cols=\"22\" rows=\"5\" class=\"formobject\"></textarea></td></tr><tr><td><p>Upload your Company's Logo (optional) (200 X 100 Only): </td><td><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"25000000\"><input name = \"Logo\" type = \"file\" size = \"30\" class=\"formobject\"></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"submit\" onclick=\"return validate_market(document.forms[0])\" name=\"Submit\" value=\"Submit\" class=\"button\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\">&nbsp;<input type=\"reset\" name=\"Reset\" class=\"button\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

g="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone_one\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_two\" maxlength=\"3\" class=\"formobject\"  size=\"3\">-<input type=\"text\" name=\"phone_three\" maxlength=\"4\" class=\"formobject\" size=\"4\"> ext. <input type=\"text\" name=\"phone_four\" maxlength=\"5\" class=\"formobject\" size=\"5\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" maxlength=\"10\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:(if not applicable enter contact number,Make sure to place prefix 1, i.e. 1866xxxxxxx)</td><td><input type=\"text\" name=\"tollfree\" maxlength=\"11\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>State/Province:</td><td><select name=\"state\" class=\"formobject\" style=\"width: 63%\"><option value=\"0\">Select State/Province</option><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");
$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID!=999';
$result = mysqli_query($link, $sql) or die("Query failed");

// showing all states
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";
	if ($line[StateID]!=52)
		echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
	else
		echo ("<option value=$line[StateID] $style>$line[name]</option>");
}

?></select></td></tr><tr><td><p>ZipCode/Postal Code:</td><td><input type=\"text\" name=\"zipcode\" maxlength=\"7\" class=\"formobject\"></td></tr><tr><td><p>Do you have interstate license?(leave blank if not applicable)</td><td><input name=\"longdist\" type=\"radio\" id=\"radio1\" value=\"yes\" checked onclick=\"return enableLicense()\"><font face=Arial size=-1 color=#130D57>Yes <input name=\"longdist\" type=\"radio\" value=\"no\" id=\"radio2\" onclick=\"return disableLicense()\">No</td></tr><tr><td><p>If Yes,Please provide USDOT#:<br />&nbsp;&nbsp;&nbsp;&nbsp;MC#:</td><td><input type=\"text\" name=\"license\" class=\"formobject\"><br /><input type=\"text\" name=\"license1\" class=\"formobject\"></td></tr><tr><td><p>Canadian interprovince license:</td><td><input type=\"text\" name=\"license2\"></td></tr><tr><td colspan=\"2\" align=\"center\"><tr><td><p>Select the associations you are registered with:</td><td><select name=\"association[]\" id=\"association\" size=\"4\" multiple=\"multiple\" class=\"formobject\" onchange=\"showServiceCountries()\" style=\"width: 100%\"><?php

mysqli_select_db($link, $db_locator_name) or die("Could not select database");

$sql = 'SELECT `assid`, `ass_shname`, `ass_fullname` FROM `associations` WHERE assid!=5'; 
$result = mysqli_query($link, $sql) or die("Query failed :6");

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo("<option value=$line[assid]>$line[ass_shname]"."($line[ass_fullname])");
}

?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"submit\" onclick=\"return validate_deadhaul(document.forms[0])\" name=\"Submit\" value=\"Submit\" class=\"button\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\">&nbsp;<input type=\"reset\" name=\"Reset\" class=\"button\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";



function setdata() {
if (document.forms[0].type[0].checked) {
	document.getElementById('newmember').innerHTML=a;
	} else if(document.forms[0].type[1].checked){
	document.getElementById('newmember').innerHTML=b;
	} else if(document.forms[0].type[2].checked) {
  	document.getElementById('newmember').innerHTML=c;
	} else if(document.forms[0].type[3].checked) {
  	document.getElementById('newmember').innerHTML=d;
	} else if(document.forms[0].type[4].checked) {
  	document.getElementById('newmember').innerHTML=e;
	}else if(document.forms[0].type[5].checked) {
  	document.getElementById('newmember').innerHTML=f;
	} else if(document.forms[0].type[6].checked) {
  	document.getElementById('newmember').innerHTML=g;
	}  else{}
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
