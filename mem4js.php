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
