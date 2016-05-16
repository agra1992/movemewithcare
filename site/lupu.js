function init() {

if (document.forms[0].or_city.value!='') {
document.forms[0].samecity.disabled = false;
document.forms[0].Submit.disabled = false;

if (document.forms[0].samecity.checked) {
gorod();
}

if (document.forms[0].or_none.checked) {
document.forms[0].or_pack.disabled = true;
document.forms[0].or_load.disabled = true;
}

}

}

//////////////////////////////////////////////////
function gorod() {
	a="<hr color='gray' noshading width='90%'><font color='black' size='-1' face='Verdana,Arial'>Please, specify services required at destination location:</font><br><table border='0' width='100%' align='left'><tr><td valign='top'><input type='checkbox' name='dor_pack1' value='1' id='dor_pack1' onclick='ChangeColors();'></td><td style='padding-top: 2px;'><span id='Pack_2' style='color:gray'  align='left'>UnPacking</span></td></tr><tr><td valign='top'><input type='checkbox' name='dor_load1' value='1' id='dor_load1' onclick='ChangeColors();'></td><td style='padding-top: 2px;'><span id='Load_2' style='color:gray' align='left'>UnLoading</span></td></tr><tr><td valign='top'><input type='checkbox' name='dor_none1' value='1' id='dor_none1' onclick='dest_nosvc();ChangeColors();'></td><td style='padding-top: 2px;'><span id='NSD_1' style='color:gray' align='left'>No services required at destination location</span></td></tr></table>";
	
	b="<input type='hidden' name='dest_none'>";
	
	c="<font color='black'>Moving within same state</font>";
	d="<font color='gray'>Moving within same state</font>";
	

        if (document.forms[0].samecity.checked) {
	
		document.forms[0].dest_city.value = document.forms[0].or_city.value;
		document.forms[0].dest_state.value = document.forms[0].or_state.value;
		document.getElementById('mwss').innerHTML=c;
		document.getElementById('dest_service').innerHTML=a;
		godest('k')
	} else {
		document.forms[0].dest_city.value = "";
		document.forms[0].dest_state.value = "";
		document.getElementById('mwss').innerHTML=d;
		document.getElementById('dest_service').innerHTML=b;
		godest('n')
	}

	
}
////////////////////////////////////////////////////
function godest(typ)
{
if(typ=='k')
{
document.getElementById("dor_state").disabled=true;
document.getElementById("dor_city").disabled=true;
document.getElementById("dor_pack").disabled=true;
document.getElementById("dor_load").disabled=true;
document.getElementById("dor_none").disabled=true;
document.getElementById("dor_city").value=-1;
document.getElementById("next").disabled = false;
}
else
{
document.getElementById("dor_state").disabled=false;
document.getElementById("dor_city").disabled=false;
document.getElementById("dor_pack").disabled=false;
document.getElementById("dor_load").disabled=false;
document.getElementById("dor_none").disabled=false;
document.getElementById("next").disabled = true;
}
}
////////////////////////////////////////////////////
function or_nosvc(typ) {
if(typ=='o'){
if (document.forms[0].or_none.checked) {

document.forms[0].or_pack.checked = false;
document.forms[0].or_load.checked = false;
document.forms[0].or_pack.disabled = true;
document.forms[0].or_load.disabled = true;

} else {
document.forms[0].or_pack.disabled = false;
document.forms[0].or_load.disabled = false;
}
}
else
{
if (document.forms[0].dor_none.checked) {

document.forms[0].dor_pack.checked = false;
document.forms[0].dor_load.checked = false;
document.forms[0].dor_pack.disabled = true;
document.forms[0].dor_load.disabled = true;

} else {
document.forms[0].dor_pack.disabled = false;
document.forms[0].dor_load.disabled = false;
}


}
}

//////////////////////////////////////////////////////
function dest_nosvc() {
	
	if (document.forms[0].dor_none1.checked) {	
		document.forms[0].dor_pack1.checked = false;
		document.forms[0].dor_load1.checked = false;
		document.forms[0].dor_pack1.disabled = true;
		document.forms[0].dor_load1.disabled = true;	
	}
	else {
		document.forms[0].dor_pack1.disabled = false;
		document.forms[0].dor_load1.disabled = false;
	}
}

/////////////////////////////////////////////////////////
function Proceed() {


if (document.forms[0].or_none.checked && document.forms[0].dor_none.checked)
{
	var is_confirmed = confirm('You\'ve rejected both origin and destination labor services. In case you need just transportation click \'OK\' button to go to the list of avaible transportation companies.\n\nOr if you\'ve made mistake during filling this form, click \'Cancel\' and correct it.');
	
	if (is_confirmed) {
	        self.location = '../transportation/transportation.php';
		return false;
	    }
	
	return false;

}

if (document.forms[0].samecity.checked)
{
	if ((document.forms[0].or_pack.checked || document.forms[0].or_load.checked) || document.forms[0].or_none.checked) {
		if ((document.forms[0].dor_pack1.checked || document.forms[0].dor_load1.checked) || document.forms[0].dor_none1.checked) {
			document.forms[0].next2.value = 1;
			document.forms[0].submit();
		} else {
			alert("Please, specify type of service at destination location");
		}
	} else {
	alert("Please, specify type of service at origin location");
	}

} else
{
	if ((document.forms[0].or_pack.checked || document.forms[0].or_load.checked || document.forms[0].or_none.checked) && (document.forms[0].dor_pack.checked || document.forms[0].dor_load.checked || document.forms[0].dor_none.checked))
	{
		document.forms[0].next2.value = 1;
		document.forms[0].submit();
	} else
	{
		if (document.forms[0].or_pack.checked || document.forms[0].or_load.checked || document.forms[0].or_none.checked)
			alert("Please, specify type of service at destination location");
		else
			alert("Please, specify type of service at origin location");
		return false;
	}

}

}

function ChangeColors()
{
  c="<font color='black'>Packing</font>";
  c_1="<font color='gray'>Packing</font>";
  d="<font color='black'>Loading</font>";
  d_1="<font color='gray'>Loading</font>";
  e="<font color='black'>No services required at origin location </font>";
  e_1="<font color='gray'>No services required at origin location </font>";
 /* 
  f="<font color='black' style='padding-right:143px'>Unpacking</font>";
  f_1="<font color='gray' style='padding-right:143px'>Unpacking</font>";
  g="<font color='black' style='padding-right:144px'>Unloading</font>";
  g_1="<font color='gray' style='padding-right:144px'>Unloading</font>";
  h="<font color='black' style='padding-right:143px'>No services required at destination location </font>";
  h_1="<font color='gray' style='padding-right:143px'>No services required at destination location </font>";
  */
  j="<font color='black'>UnPacking</font>";
  j_1="<font color='gray'>UnPacking</font>";
  k="<font color='black'>UnLoading</font>";
  k_1="<font color='gray'>UnLoading</font>";
  p="<font color='black'>No services required at destination location </font>";
  p_1="<font color='gray'>No services required at destination location </font>";



if (document.forms[0].or_pack.checked) {
document.getElementById('Pack_1').innerHTML=c;
} else {
document.getElementById('Pack_1').innerHTML=c_1;
}

if (document.forms[0].or_load.checked) {
document.getElementById('Load_1').innerHTML=d;
} else {
document.getElementById('Load_1').innerHTML=d_1;
}

if (document.forms[0].or_none.checked) {
document.getElementById('NSO_1').innerHTML=e;
} else {
document.getElementById('NSO_1').innerHTML=e_1;
}


if (document.forms[0].dor_pack.checked) {
document.getElementById('Pack_3').innerHTML=j;
} else {
document.getElementById('Pack_3').innerHTML=j_1;
}

if (document.forms[0].dor_load.checked) {
document.getElementById('Load_3').innerHTML=k;
} else {
document.getElementById('Load_3').innerHTML=k_1;
}

if (document.forms[0].dor_none.checked) {
document.getElementById('NSD_2').innerHTML=p;
} else {
document.getElementById('NSD_2').innerHTML=p_1;
}


if (document.forms[0].dor_pack1.checked) {
document.getElementById('Pack_2').innerHTML=j;
} else {
document.getElementById('Pack_2').innerHTML=j_1;
}

if (document.forms[0].dor_load1.checked) {
document.getElementById('Load_2').innerHTML=k;
} else {
document.getElementById('Load_2').innerHTML=k_1;
}

if (document.forms[0].dor_none1.checked) {
document.getElementById('NSD_1').innerHTML=p;
} else {
document.getElementById('NSD_1').innerHTML=p_1;
}








}