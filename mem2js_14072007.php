<?php
require("config.inc.php");
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

        if(!form1.city.disabled)
		{
			var r = new Array();
			for (var i = 0; i < form1.city.length; i++)
			{
				if (form1.city.options[i].selected)
				{
					Selcity[Selcity.length] = form1.city.options[i].value;
					//alert(form1.city.options[i].value);
				}
			}
		}
		
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
a="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone\" class=\"formobject\"></td></tr><tr><td><p>Login:<br></td><td><input type=\"text\" name=\"login\" class=\"formobject\"></td></tr><tr><td><p>Password:<br></td><td><input type=\"text\" name=\"pass\" class=\"formobject\" onKeyUp=\"MakeBaloon(document.forms[0].pass.value)\">&nbsp;<input type=\"button\" name=\"generate\" class=\"button\" value=\"Generate\" STYLE=\"width: 80; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onClick=\"GeneratePassword()\"></td></tr><tr><td><p>Select area of your service:<br><i>(Ctrl+Click to select multiple cities)</i></td><td>&nbsp;</td></tr><tr><td colspan=\"2\" align=\"center\"><INPUT id=\"selcities\" type=\"hidden\" name=\"selcities\"><select name=\"state\" size=\"10\" onchange=\"show_selected()\" class=\"formobject\" style=\"width: 35%\"><option value=-1 selected>Please, select state</option><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `name`, `StateID` FROM `states` WHERE 1'; 
$result = mysql_query($sql) or die("Query failed :5");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[StateID]>$line[name]");
}


?></select><select name=\"city[]\" id=\"city\" size=\"10\" multiple=\"multiple\" disabled class=\"formobject\" style=\"width: 35%\"><option value=-1>----- Select city -----</option></select></td></tr><tr><td><p>Select the associations you are registered with:</td><td><select name=\"association[]\" id=\"association\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `assid`, `ass_shname`, `ass_fullname` FROM `associations` WHERE 1'; 
$result = mysql_query($sql) or die("Query failed :6");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[assid]>$line[ass_shname]"."($line[ass_fullname])");
}

?></select></td></tr><?php

mysql_select_db($db_locator_name) or die("Could not select database");

//$sql = 'SELECT `id`, `country_name`, `country_code` FROM `operatingcountries` order by country_name'; 
$result = mysql_query($sql) or die("Query failed :6");

/*
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[id]>$line[country_name]"."($line[country_code])");
}
*/

?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"button\" class=\"button\" name=\"Submit\" value=\"Submit\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onclick=\" AddValues();document.forms[0].submit();\">&nbsp;<input type=\"reset\" class=\"button\" name=\"Reset\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

b="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone\" class=\"formobject\"></td></tr><tr><td><p>Login:<br></td><td><input type=\"text\" name=\"login\" class=\"formobject\"></td></tr><tr><td><p>Password:</td><td><input type=\"text\" name=\"pass\" class=\"formobject\" onKeyUp=\"MakeBaloon(document.forms[0].pass.value)\">&nbsp;<input type=\"button\" name=\"generate\" class=\"button\" value=\"Generate\" STYLE=\"width: 80; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onClick=\"GeneratePassword()\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:</td><td><input type=\"text\" name=\"tollfree\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>Zipcode:</td><td><input type=\"text\" name=\"zipcode\" class=\"formobject\"></td></tr><tr><td><p>Description:</td><td><textarea name=\"description\" cols=\"22\" rows=\"5\" class=\"formobject\"></textarea></td></tr><tr><td><p>Do you have interstate license?</td><td><input name=\"longdist\" type=\"radio\" value=\"yes\" checked><font face=Arial size=-1 color=#130D57>Yes <input name=\"longdist\" type=\"radio\" value=\"no\">No</td></tr><tr><td><p>If Yes,Please provide USDOT#:<br />&nbsp;&nbsp;&nbsp;&nbsp;MC#:</td><td><input type=\"text\" name=\"license\" class=\"formobject\"><br /><input type=\"text\" name=\"license1\" class=\"formobject\"></td></tr><tr><td><p>Select state of your service:</td><td><select name=\"state\" class=\"formobject\" style=\"width: 63%\"><option value=999>NATIONWIDE</option><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE 1 LIMIT 0, 100 '; 

$result = mysql_query($sql) or die("Query failed");

// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

//if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";


echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
    
}



?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><tr><td><p>Select the associations you are registered with:</td><td><select name=\"association[]\" id=\"association\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `assid`, `ass_shname`, `ass_fullname` FROM `associations` WHERE 1'; 
$result = mysql_query($sql) or die("Query failed :6");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[assid]>$line[ass_shname]"."($line[ass_fullname])");
}

?></select></td></tr><tr><td><p>Select your service country if you are registered with HHGFAA <i>(Ctrl+Click to select multiple)</i>:</td><td><select name=\"country[]\" id=\"country\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `id`, `country_name`, `country_code` FROM `operatingcountries` order by country_name'; 
$result = mysql_query($sql) or die("Query failed :6");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[id]>$line[country_name]"."($line[country_code])");
}

?></select></td></tr><tr><td><p>Upload your Company's Logo (optional) (200 X 100 Only): </td><td><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"25000000\"><input name = \"Logo\" type = \"file\" size = \"30\" class=\"formobject\"></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"button\" name=\"Submit\" value=\"Submit\" class=\"button\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onclick=\"document.forms[0].submit();\">&nbsp;<input type=\"reset\" name=\"Reset\" class=\"button\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

c="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone\" class=\"formobject\"></td></tr><tr><td><p>Login:<br></td><td><input type=\"text\" name=\"login\" class=\"formobject\"></td></tr><tr><td><p>Password:</td><td><input type=\"text\" name=\"pass\" class=\"formobject\" onKeyUp=\"MakeBaloon(document.forms[0].pass.value)\">&nbsp;<input type=\"button\" name=\"generate\" class=\"button\" value=\"Generate\" STYLE=\"width: 80; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onClick=\"GeneratePassword()\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:</td><td><input type=\"text\" name=\"tollfree\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>Zipcode:</td><td><input type=\"text\" name=\"zipcode\" class=\"formobject\"></td></tr><tr><td><p>Description:</td><td><textarea name=\"description\" cols=\"22\" rows=\"5\" class=\"formobject\"></textarea></td></tr><tr><td><p>Do you have interstate license?</td><td><input name=\"longdist\" type=\"radio\" value=\"yes\" checked><font face=Arial size=-1 color=#130D57>Yes <input name=\"longdist\" type=\"radio\" value=\"no\">No</td></tr><tr><td><p>If Yes,Please provide USDOT#:<br />&nbsp;&nbsp;&nbsp;&nbsp;MC#:</td><td><input type=\"text\" name=\"license\" class=\"formobject\"><br /><input type=\"text\" name=\"license1\" class=\"formobject\"></td></tr><tr><td><p>Select state of your service:</td><td><select name=\"state\" class=\"formobject\" style=\"width: 63%\"><option value=999>NATIONWIDE</option><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE 1 LIMIT 0, 100 '; 

$result = mysql_query($sql) or die("Query failed");

// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

//if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";


echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
    
}



?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><tr><td><p>Select the associations you are registered with:</td><td><select name=\"association[]\" id=\"association\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `assid`, `ass_shname`, `ass_fullname` FROM `associations` WHERE 1'; 
$result = mysql_query($sql) or die("Query failed :6");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[assid]>$line[ass_shname]"."($line[ass_fullname])");
}

?></select></td></tr><tr><td><p>Select your service country if you are registered with HHGFAA <i>(Ctrl+Click to select multiple)</i>:</td><td><select name=\"country[]\" id=\"country\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `id`, `country_name`, `country_code` FROM `operatingcountries` order by country_name'; 
$result = mysql_query($sql) or die("Query failed :6");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[id]>$line[country_name]"."($line[country_code])");
}

?></select></td></tr><tr><td><p>Upload your Company's Logo (optional) (200 X 100 Only): </td><td><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"25000000\"><input name = \"Logo\" type = \"file\" size = \"30\" class=\"formobject\"></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"button\" name=\"Submit\" value=\"Submit\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onclick=\"document.forms[0].submit();\">&nbsp;<input type=\"reset\" name=\"Reset\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

d="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone\" class=\"formobject\"></td></tr><tr><td><p>Login:<br></td><td><input type=\"text\" name=\"login\" class=\"formobject\"></td></tr><tr><td><p>Password:</td><td><input type=\"text\" name=\"pass\" class=\"formobject\" onKeyUp=\"MakeBaloon(document.forms[0].pass.value)\">&nbsp;<input type=\"button\" name=\"generate\" class=\"button\" value=\"Generate\" STYLE=\"width: 80; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onClick=\"GeneratePassword()\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:</td><td><input type=\"text\" name=\"tollfree\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>Zipcode:</td><td><input type=\"text\" name=\"zipcode\" class=\"formobject\"></td></tr><tr><td><p>Description:</td><td><textarea name=\"description\" cols=\"22\" rows=\"5\" class=\"formobject\"></textarea></td></tr><tr><td><p>Select state of your storage location:</td><td><select name=\"state\" class=\"formobject\" style=\"width: 63%\"><option value=999>NATIONWIDE</option><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE 1 LIMIT 0, 100 '; 

$result = mysql_query($sql) or die("Query failed");

// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

//if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";


echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
    
}



?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><tr><td><p>Select the associations you are registered with:</td><td><select name=\"association[]\" id=\"association\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `assid`, `ass_shname`, `ass_fullname` FROM `associations` WHERE 1'; 
$result = mysql_query($sql) or die("Query failed :6");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[assid]>$line[ass_shname]"."($line[ass_fullname])");
}

?></select></td></tr><tr><td><p>Select your service country if you are registered with HHGFAA <i>(Ctrl+Click to select multiple)</i>:</td><td><select name=\"country[]\" id=\"country\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `id`, `country_name`, `country_code` FROM `operatingcountries` order by country_name'; 
$result = mysql_query($sql) or die("Query failed :6");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[id]>$line[country_name]"."($line[country_code])");
}

?></select></td></tr><tr><td><p>Upload your Company's Logo (optional) (200 X 100 Only): </td><td><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"25000000\"><input name = \"Logo\" type = \"file\" size = \"30\" class=\"formobject\"></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"button\" name=\"Submit\" class=\"button\" value=\"Submit\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onclick=\"document.forms[0].submit();\">&nbsp;<input type=\"reset\" class=\"button\" name=\"Reset\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

e="<table width=\"90%\" border=\"0\" align=\"center\"><tr><td width=\"50%\"><p>Full name of company:</td><td width=\"50%\"><input type=\"text\" name=\"name\" class=\"formobject\"></td></tr><tr><td><p>Contact Person:</td><td><input type=\"text\" name=\"person\" class=\"formobject\"></td></tr><tr><td><p>Contact email:</td><td><input type=\"text\" name=\"email\" class=\"formobject\"></td></tr><tr><td><p>Phone:</td><td><input type=\"text\" name=\"phone\" class=\"formobject\"></td></tr><tr><td><p>Login:<br></td><td><input type=\"text\" name=\"login\" class=\"formobject\"></td></tr><tr><td><p>Password:</td><td><input type=\"text\" name=\"pass\" class=\"formobject\" onKeyUp=\"MakeBaloon(document.forms[0].pass.value)\">&nbsp;<input type=\"button\" name=\"generate\" class=\"button\" value=\"Generate\" STYLE=\"width: 80; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onClick=\"GeneratePassword()\"></td></tr><tr><td><p>Fax:</td><td><input type=\"text\" name=\"fax\" class=\"formobject\"></td></tr><tr><td><p>Toll-free number:</td><td><input type=\"text\" name=\"tollfree\" class=\"formobject\"></td></tr><tr><td><p>Address:</td><td><input type=\"text\" name=\"address\" class=\"formobject\"></td></tr><tr><td><p>Zipcode:</td><td><input type=\"text\" name=\"zipcode\" class=\"formobject\"></td></tr><tr><td><p>Description:</td><td><textarea name=\"description\" cols=\"22\" rows=\"5\" class=\"formobject\"></textarea></td></tr><tr><td><p>Where do you ship:</td><td><select name=\"state\" class=\"formobject\" style=\"width: 63%\"><option value=999>NATIONWIDE</option><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE 1 LIMIT 0, 100 '; 

$result = mysql_query($sql) or die("Query failed");

// showing all states
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

//if ($or_state==$line[StateID]) $sel = "SELECTED"; else $sel=""; 

if ($temp++ % 2 == 0) $style="style=\\\"background : #dceffe\\\""; else $style="";


echo ("<option value=$line[StateID] $style>$line[name] ($line[sh_name])</option>");
    
}



?></select></td></tr><tr><td colspan=\"2\" align=\"center\"><tr><td><p>Select the associations you are registered with:</td><td><select name=\"association[]\" id=\"association\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php
mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `assid`, `ass_shname`, `ass_fullname` FROM `associations` WHERE 1'; 
$result = mysql_query($sql) or die("Query failed :6");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[assid]>$line[ass_shname]"."($line[ass_fullname])");
}
?></select></td></tr><tr><td><p>Select your service country if you are registered with HHGFAA <i>(Ctrl+Click to select multiple)</i>:</td><td><select name=\"country[]\" id=\"country\" size=\"5\" multiple=\"multiple\" class=\"formobject\" style=\"width: 100%\"><?php

mysql_select_db($db_locator_name) or die("Could not select database");

$sql = 'SELECT `id`, `country_name`, `country_code` FROM `operatingcountries` order by country_name'; 
$result = mysql_query($sql) or die("Query failed :6");

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo("<option value=$line[id]>$line[country_name]"."($line[country_code])");
}

?></select></td></tr><tr><td><p>Upload your Company's Logo (optional) (200 X 100 Only): </td><td><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"25000000\"><input name = \"Logo\" type = \"file\" size = \"30\" class=\"formobject\"></td></tr><tr><td colspan=\"2\" align=\"center\"><br><input type=\"button\" name=\"Submit\" class=\"button\" value=\"Submit\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\" onclick=\"document.forms[0].submit();\">&nbsp;<input type=\"reset\" class=\"button\" name=\"Reset\" value=\"Reset form\" STYLE=\"width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57\"></td></tr></table>";

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
	} else {}
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
