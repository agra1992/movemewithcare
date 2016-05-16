function init() {
//document.getElementById("next").disabled=true;

}
function Move (elem, dlina, id, event, prev) {

var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

if (keyCode == 8) {

if (elem.value.length == 0) {

document.getElementById(prev).focus();

setCaretToEnd(document.getElementById(prev));

//alert (elem.value.length );

}

} 

if (elem.value.length > dlina-1 && id) {

    document.getElementById(id).focus();

}

}


function validateZIP(field) {
	var valid = "~!@#$%^&*()_+=[]{}<>?/.,`";
	var hyphencount = 0;

	
	
	if (field.length < 5 || field.length > 7) {
		return false;		
	}
	for (var i=0; i < field.length; i++) {
		temp = "" + field.substring(i, i+1);
		if (temp == "-") hyphencount++;
		
		if (valid.indexOf(temp) != "-1") {
			return false;
		}
		if (hyphencount > 1) {
			return false;
   		}
	}
	
	return true;
}

function setCaretToEnd (el) {

  if (el.createTextRange) {

    var v = el.value;

    var r = el.createTextRange();

    r.moveStart('character', v.length);

    r.select();

  }

}

String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}

	function echeck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){		   
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){		   
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){		    
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){		    
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){		    
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){		    
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){		    
		    return false
		 }

 		 return true					
	}

function isInteger(s, n)
{   var i;
	if (n != s.length)
		return false;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    return true;
}

function showsize1() {window.open('showsize.php','map','toolbar=no,location=no,directories=no,status=no,scrollbars=no,menubar=no,fullscreen=no,width=600,height=600');
return false;
}

function showpolicy() {window.open('showpolicy.php','map','toolbar=no,location=no,directories=no,status=no,scrollbars=no,menubar=no,fullscreen=no,width=600,height=200');
return false;
}

function callget(obj)
{
get(obj);

}

function disMov()
{
var box=document.getElementById("serv1");
if(box.options[box.selectedIndex].value==0)
document.getElementById("dor_state").disabled=true;
else
document.getElementById("dor_state").disabled=false;

}

function recommend()
{

var selObj=document.getElementById("serv");
  var i;
  var count = 0;
  var selectedArray = new Array();


  for (i=0; i<selObj.options.length; i++) {
    if (selObj.options[i].selected) {
      selectedArray[count] = selObj.options[i].value;
      count++;
    }
  }
//alert(selectedArray);
var box=document.getElementById("serv1");
if(selectedArray.length>=2)
{
if(selectedArray[0]==0)
{alert("If you need any service, deselect 'None' from services");return false;}
else if((selectedArray[0]==3) && (selectedArray[1]==4))
{
if(confirm('Based on your requirements, we RECOMMEND you use our FULL MOVERS SERVICE,would you like to go to our full movers service?'))
alert("Next it will go to full movers service");
}
else if((selectedArray[0]==1) && (selectedArray[1]==2) && (selectedArray[2]==3) && (selectedArray[3]==4))
{
if(confirm('Based on your requirements, we RECOMMEND you use our FULL MOVERS SERVICE,would you like to go to our full movers service?'))
alert("Next it will go to full movers service");
}
else if(((selectedArray[0]==1) || (selectedArray[0]==2)) && ((selectedArray[1]==3) && (selectedArray[2]==4)))
{
if(confirm('Based on your requirements, we RECOMMEND you use our FULL MOVERS SERVICE,would you like to go to our full movers service?'))
alert("Next it will go to full movers service");
}
}
}
function isempty(o) {

if((o.value.length <= 0) && (o.value.charAt(0) == "" ))
return true;
}

function vali(o) {
	var err="";
	//alert(o.length);
	for(i=1;i<o.length;i++)
	{
		//alert(o[i].type);
	switch(o[i].type)
	{
	case 'text': 
			if(isempty(o[i]))
			{
				if((o[i].name == "ph3"))
				break;
			if((o[i].alt != " ") || (o[i].alt != undefined))
			err+="<li>"+o[i].alt+"</li>"; 
			}
			break;
	case 'select-one': if(o[i].selectedIndex<0 && o[i].alt) 
					{if(!(o[i].disabled) || (o[i].alt != " ") || (o[i].alt != undefined))
						err+="<li>"+o[i].alt+"</li>";} ;break;
	case 'select-multiple': if(o[i].selectedIndex<0) 
			err+="<li>"+o[i].alt+"</li>"; 
			break;
	default: ;
	}
	}
	if(err)
	{
	err1="<ul style='color:red;font-family:Verdana;font-size:11px;'>Please check the following fields:";
	err=err1+err;
	document.getElementById("err").innerHTML=err+"</ul>";
	window.location="#top";
	return false;
	}
	else
	{
	document.getElementById("err").innerHTML="";
	return true;
	}	

}
var weekend = [0,6];
var weekendColor = "#dceffe";
var fontface = "Verdana";
var fontsize = 8;			// in "pt" units; used with "font-size" style element

var gNow = new Date();
var ggWinContent;
var ggPosX = -1;
var ggPosY = -1;

Calendar.Months = ["January", "February", "March", "April", "May", "June",
"July", "August", "September", "October", "November", "December"];

// Non-Leap year Month days..
Calendar.DOMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
// Leap year Month days..
Calendar.lDOMonth = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

function Calendar(p_item, p_month, p_year, p_format) {
	if ((p_month == null) && (p_year == null))	return;

	if (p_month == null) {
		this.gMonthName = null;
		this.gMonth = null;
		this.gYearly = true;
	} else {
		this.gMonthName = Calendar.get_month(p_month);
		this.gMonth = new Number(p_month);
		this.gYearly = false;
	}

	this.gYear = p_year;
	this.gFormat = p_format;
	this.gBGColor = "130d57";
	this.gFGColor = "130d57";
	this.gTextColor = "130d57";
	this.gHeaderColor = "130d57";
	this.gReturnItem = p_item;
}

Calendar.get_month = Calendar_get_month;
Calendar.get_daysofmonth = Calendar_get_daysofmonth;
Calendar.calc_month_year = Calendar_calc_month_year;

function Calendar_get_month(monthNo) {
	return Calendar.Months[monthNo];
}

function Calendar_get_daysofmonth(monthNo, p_year) {
	/* 
	Check for leap year ..
	1.Years evenly divisible by four are normally leap years, except for... 
	2.Years also evenly divisible by 100 are not leap years, except for... 
	3.Years also evenly divisible by 400 are leap years. 
	*/
	if ((p_year % 4) == 0) {
		if ((p_year % 100) == 0 && (p_year % 400) != 0)
			return Calendar.DOMonth[monthNo];
	
		return Calendar.lDOMonth[monthNo];
	} else
		return Calendar.DOMonth[monthNo];
}

function Calendar_calc_month_year(p_Month, p_Year, incr) {
	/* 
	Will return an 1-D array with 1st element being the calculated month 
	and second being the calculated year 
	after applying the month increment/decrement as specified by 'incr' parameter.
	'incr' will normally have 1/-1 to navigate thru the months.
	*/
	var ret_arr = new Array();
	
	if (incr == -1) {
		// B A C K W A R D
		if (p_Month == 0) {
			ret_arr[0] = 11;
			ret_arr[1] = parseInt(p_Year) - 1;
		}
		else {
			ret_arr[0] = parseInt(p_Month) - 1;
			ret_arr[1] = parseInt(p_Year);
		}
	} else if (incr == 1) {
		// F O R W A R D
		if (p_Month == 11) {
			ret_arr[0] = 0;
			ret_arr[1] = parseInt(p_Year) + 1;
		}
		else {
			ret_arr[0] = parseInt(p_Month) + 1;
			ret_arr[1] = parseInt(p_Year);
		}
	}
	
	return ret_arr;
}

function Calendar_calc_month_year(p_Month, p_Year, incr) {
	/* 
	Will return an 1-D array with 1st element being the calculated month 
	and second being the calculated year 
	after applying the month increment/decrement as specified by 'incr' parameter.
	'incr' will normally have 1/-1 to navigate thru the months.
	*/
	var ret_arr = new Array();
	
	if (incr == -1) {
		// B A C K W A R D
		if (p_Month == 0) {
			ret_arr[0] = 11;
			ret_arr[1] = parseInt(p_Year) - 1;
		}
		else {
			ret_arr[0] = parseInt(p_Month) - 1;
			ret_arr[1] = parseInt(p_Year);
		}
	} else if (incr == 1) {
		// F O R W A R D
		if (p_Month == 11) {
			ret_arr[0] = 0;
			ret_arr[1] = parseInt(p_Year) + 1;
		}
		else {
			ret_arr[0] = parseInt(p_Month) + 1;
			ret_arr[1] = parseInt(p_Year);
		}
	}
	
	return ret_arr;
}

// This is for compatibility with Navigator 3, we have to create and discard one object before the prototype object exists.
new Calendar();

Calendar.prototype.getMonthlyCalendarCode = function() {
	var vCode = "";
	var vHeader_Code = "";
	var vData_Code = "";
	
	// Begin Table Drawing code here..
	vCode += ("<div align=center><TABLE BORDER=1 BGCOLOR=\"" + this.gBGColor + "\" style='font-size:" + fontsize + "pt;'>");
	
	vHeader_Code = this.cal_header();
	vData_Code = this.cal_data();
	vCode += (vHeader_Code + vData_Code);
	
	vCode += "</TABLE></div>";
	
	return vCode;
}

Calendar.prototype.show = function() {
	var vCode = "";

	// build content into global var ggWinContent
	ggWinContent += ("<FONT FACE='" + fontface + "' ><B>");
	ggWinContent += (this.gMonthName + " " + this.gYear);
	ggWinContent += "</B><BR>";
	
	// Show navigation buttons
	var prevMMYYYY = Calendar.calc_month_year(this.gMonth, this.gYear, -1);
	var prevMM = prevMMYYYY[0];
	var prevYYYY = prevMMYYYY[1];

	var nextMMYYYY = Calendar.calc_month_year(this.gMonth, this.gYear, 1);
	var nextMM = nextMMYYYY[0];
	var nextYYYY = nextMMYYYY[1];
	
	ggWinContent += ("<TABLE WIDTH='100%' BORDER=1 CELLSPACING=0 CELLPADDING=0 BGCOLOR='#e0e0e0' style='font-size:" + fontsize + "pt;'><TR><TD ALIGN=center>");
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go back one year'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', '" + this.gMonth + "', '" + (parseInt(this.gYear)-1) + "', '" + this.gFormat + "'" +
		");" +
		"\"><<Year<\/A>]</TD><TD ALIGN=center>");
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go back one month'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', '" + prevMM + "', '" + prevYYYY + "', '" + this.gFormat + "'" +
		");" +
		"\"><Mon<\/A>]</TD><TD ALIGN=center>");
	ggWinContent += "       </TD><TD ALIGN=center>";
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go forward one month'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', '" + nextMM + "', '" + nextYYYY + "', '" + this.gFormat + "'" +
		");" +
		"\">Mon><\/A>]</TD><TD ALIGN=center>");
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go forward one year'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', '" + this.gMonth + "', '" + (parseInt(this.gYear)+1) + "', '" + this.gFormat + "'" +
		");" +
		"\">Year>><\/A>]</TD></TR></TABLE><BR>");

	// Get the complete calendar code for the month, and add it to the
	//	content var
	vCode = this.getMonthlyCalendarCode();
	ggWinContent += vCode;
}

Calendar.prototype.showY = function() {
	var vCode = "";
	var i;

	ggWinContent += "<FONT FACE='" + fontface + "' ><B>"
	ggWinContent += ("Year : " + this.gYear);
	ggWinContent += "</B><BR>";

	// Show navigation buttons
	var prevYYYY = parseInt(this.gYear) - 1;
	var nextYYYY = parseInt(this.gYear) + 1;
	
	ggWinContent += ("<TABLE WIDTH='100%' BORDER=1 CELLSPACING=0 CELLPADDING=0 BGCOLOR='#e0e0e0' style='font-size:" + fontsize + "pt;'><TR><TD ALIGN=center>");
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go back one year'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', null, '" + prevYYYY + "', '" + this.gFormat + "'" +
		");" +
		"\"><<Year<\/A>]</TD><TD ALIGN=center>");
	ggWinContent += "       </TD><TD ALIGN=center>";
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go forward one year'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', null, '" + nextYYYY + "', '" + this.gFormat + "'" +
		");" +
		"\">Year>><\/A>]</TD></TR></TABLE><BR>");

	// Get the complete calendar code for each month.
	// start a table and first row in the table
	ggWinContent += ("<TABLE WIDTH='100%' BORDER=0 CELLSPACING=0 CELLPADDING=5 style='font-size:" + fontsize + "pt;'><TR>");
	var j;
	for (i=0; i<12; i++) {
		// start the table cell
		ggWinContent += "<TD ALIGN='center' VALIGN='top'>";
		this.gMonth = i;
		this.gMonthName = Calendar.get_month(this.gMonth);
		vCode = this.getMonthlyCalendarCode();
		ggWinContent += (this.gMonthName + "/" + this.gYear + "<BR>");
		ggWinContent += vCode;
		ggWinContent += "</TD>";
		if (i == 3 || i == 7) {
			ggWinContent += "</TR><TR>";
			}

	}

	ggWinContent += "</TR></TABLE></font><BR>";
}

Calendar.prototype.cal_header = function() {
	var vCode = "";
	
	vCode = vCode + "<TR>";
	vCode = vCode + "<TD WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Sun</B></FONT></TD>";
	vCode = vCode + "<TD WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Mon</B></FONT></TD>";
	vCode = vCode + "<TD WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Tue</B></FONT></TD>";
	vCode = vCode + "<TD WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Wed</B></FONT></TD>";
	vCode = vCode + "<TD WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Thu</B></FONT></TD>";
	vCode = vCode + "<TD WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Fri</B></FONT></TD>";
	vCode = vCode + "<TD WIDTH='16%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Sat</B></FONT></TD>";
	vCode = vCode + "</TR>";
	
	return vCode;
}

Calendar.prototype.cal_data = function() {
	var vDate = new Date();
	vDate.setDate(1);
	vDate.setMonth(this.gMonth);
	vDate.setFullYear(this.gYear);

	var vFirstDay=vDate.getDay();
	var vDay=1;
	var vLastDay=Calendar.get_daysofmonth(this.gMonth, this.gYear);
	var vOnLastDay=0;
	var vCode = "";

	/*
	Get day for the 1st of the requested month/year..
	Place as many blank cells before the 1st day of the month as necessary. 
	*/
	vCode = vCode + "<TR>";
	for (i=0; i<vFirstDay; i++) {
		vCode = vCode + "<TD WIDTH='14%'" + this.write_weekend_string(i) + "><FONT FACE='" + fontface + "'> </FONT></TD>";
	}

	// Write rest of the 1st week
	for (j=vFirstDay; j<7; j++) {
		vCode = vCode + "<TD WIDTH='14%'" + this.write_weekend_string(j) + "><FONT FACE='" + fontface + "'>" + 
			"<A HREF='javascript:void(0);' " + 
				"onMouseOver=\"window.status='set date to " + this.format_data(vDay) + "'; return true;\" " +
				"onMouseOut=\"window.status=' '; return true;\" " +
				"onClick=\"document." + this.gReturnItem + ".value='" + 
				this.format_data(vDay) + 
				"';ggPosX=-1;ggPosY=-1;nd();nd();\">" + 
				this.format_day(vDay) + 
			"</A>" + 
			"</FONT></TD>";
		vDay=vDay + 1;
	}
	vCode = vCode + "</TR>";

	// Write the rest of the weeks
	for (k=2; k<7; k++) {
		vCode = vCode + "<TR>";

		for (j=0; j<7; j++) {
			vCode = vCode + "<TD WIDTH='14%'" + this.write_weekend_string(j) + "><FONT FACE='" + fontface + "'>" + 
				"<A HREF='javascript:void(0);' " +
					"onMouseOver=\"window.status='set date to " + this.format_data(vDay) + "'; return true;\" " +
					"onMouseOut=\"window.status=' '; return true;\" " +
					"onClick=\"document." + this.gReturnItem + ".value='" + 
					this.format_data(vDay) + 
					"';window.scroll(0,ggPosY);ggPosX=-1;ggPosY=-1;nd();nd();\">" + 
				this.format_day(vDay) + 
				"</A>" + 
				"</FONT></TD>";
			vDay=vDay + 1;

			if (vDay > vLastDay) {
				vOnLastDay = 1;
				break;
			}
		}

		if (j == 6)
			vCode = vCode + "</TR>";
		if (vOnLastDay == 1)
			break;
	}
	
	// Fill up the rest of last week with proper blanks, so that we get proper square blocks
	for (m=1; m<(7-j); m++) {
		if (this.gYearly)
			vCode = vCode + "<TD WIDTH='14%'" + this.write_weekend_string(j+m) + 
			"><FONT FACE='" + fontface + "' COLOR='gray'> </FONT></TD>";
		else
			vCode = vCode + "<TD WIDTH='14%'" + this.write_weekend_string(j+m) + 
			"><FONT FACE='" + fontface + "' COLOR='gray'>" + m + "</FONT></TD>";
	}
	
	return vCode;
}

Calendar.prototype.format_day = function(vday) {
	var vNowDay = gNow.getDate();
	var vNowMonth = gNow.getMonth();
	var vNowYear = gNow.getFullYear();

	if (vday == vNowDay && this.gMonth == vNowMonth && this.gYear == vNowYear)
		return ("<FONT COLOR=\"130d57\"><B>" + vday + "</B></FONT>");
	else
		return (vday);
}

Calendar.prototype.write_weekend_string = function(vday) {
	var i;

	// Return special formatting for the weekend day.
	for (i=0; i<weekend.length; i++) {
		if (vday == weekend[i])
			return (" BGCOLOR=\"" + weekendColor + "\"");
	}
	
	return "";
}

Calendar.prototype.format_data = function(p_day) {
	var vData;
	var vMonth = 1 + this.gMonth;
	vMonth = (vMonth.toString().length < 2) ? "0" + vMonth : vMonth;
	var vMon = Calendar.get_month(this.gMonth).substr(0,3).toUpperCase();
	var vFMon = Calendar.get_month(this.gMonth).toUpperCase();
	var vY4 = new String(this.gYear);
	var vY2 = new String(this.gYear.substr(2,2));
	var vDD = (p_day.toString().length < 2) ? "0" + p_day : p_day;

	switch (this.gFormat) {
		case "MM\/DD\/YYYY" :
			vData = vMonth + "\/" + vDD + "\/" + vY4;
			break;
		case "MM\/DD\/YY" :
			vData = vMonth + "\/" + vDD + "\/" + vY2;
			break;
		case "MM-DD-YYYY" :
			vData = vMonth + "-" + vDD + "-" + vY4;
			break;
		case "YYYY-MM-DD" :
			vData = vY4 + "-" + vMonth + "-" + vDD;
			break;
		case "MM-DD-YY" :
			vData = vMonth + "-" + vDD + "-" + vY2;
			break;
		case "DD\/MON\/YYYY" :
			vData = vDD + "\/" + vMon + "\/" + vY4;
			break;
		case "DD\/MON\/YY" :
			vData = vDD + "\/" + vMon + "\/" + vY2;
			break;
		case "DD-MON-YYYY" :
			vData = vDD + "-" + vMon + "-" + vY4;
			break;
		case "DD-MON-YY" :
			vData = vDD + "-" + vMon + "-" + vY2;
			break;
		case "DD\/MONTH\/YYYY" :
			vData = vDD + "\/" + vFMon + "\/" + vY4;
			break;
		case "DD\/MONTH\/YY" :
			vData = vDD + "\/" + vFMon + "\/" + vY2;
			break;
		case "DD-MONTH-YYYY" :
			vData = vDD + "-" + vFMon + "-" + vY4;
			break;
		case "DD-MONTH-YY" :
			vData = vDD + "-" + vFMon + "-" + vY2;
			break;
		case "DD\/MM\/YYYY" :
			vData = vDD + "\/" + vMonth + "\/" + vY4;
			break;
		case "DD\/MM\/YY" :
			vData = vDD + "\/" + vMonth + "\/" + vY2;
			break;
		case "DD-MM-YYYY" :
			vData = vDD + "-" + vMonth + "-" + vY4;
			break;
		case "DD-MM-YY" :
			vData = vDD + "-" + vMonth + "-" + vY2;
			break;
		default :
			vData = vMonth + "\/" + vDD + "\/" + vY4;
	}

	return vData;
}

function Build(p_item, p_month, p_year, p_format) {
	gCal = new Calendar(p_item, p_month, p_year, p_format);

	// Customize your Calendar here..
	gCal.gBGColor="white";
	gCal.gLinkColor="0066ff";
	gCal.gTextColor="130d57";
	gCal.gHeaderColor="130d57";

	// initialize the content string
	ggWinContent = "";

	// Choose appropriate show function
	if (gCal.gYearly) {
		// and, since the yearly calendar is so large, override the positioning and fontsize
		// warning: in IE6, it appears that "select" fields on the form will still show
		//	through the "over" div; Note: you can set these variables as part of the onClick
		//	javascript code before you call the show_yearly_calendar function
		if (ggPosX == -1) ggPosX = 10;
		if (ggPosY == -1) ggPosY = 10;
		if (fontsize == 8) fontsize = 6;
		// generate the calendar
		gCal.showY();
		}
	else {
		gCal.show();
		}

	// if this is the first calendar popup, use autopositioning with an offset
	if (ggPosX == -1 && ggPosY == -1) {
		overlib(ggWinContent, AUTOSTATUSCAP, STICKY, CLOSECLICK, CSSSTYLE,
			TEXTSIZEUNIT, "pt", TEXTSIZE, 8, CAPTIONSIZEUNIT, "pt", CAPTIONSIZE, 8, CLOSESIZEUNIT, "pt", CLOSESIZE, 8,
			CAPTION, "Select a date", OFFSETX, 20, OFFSETY, -20);
		// save where the 'over' div ended up; we want to stay in the same place if the user
		//	clicks on one of the year or month navigation links
		if ( (ns4) || (ie4) ) {
		        ggPosX = parseInt(over.left);
		        ggPosY = parseInt(over.top);
			} else if (ns6) {
			ggPosX = parseInt(over.style.left);
			ggPosY = parseInt(over.style.top);
			}
		}
	else {
		// we have a saved X & Y position, so use those with the FIXX and FIXY options
		overlib(ggWinContent, AUTOSTATUSCAP, STICKY, CLOSECLICK, CSSSTYLE,
			TEXTSIZEUNIT, "pt", TEXTSIZE, 8, CAPTIONSIZEUNIT, "pt", CAPTIONSIZE, 8, CLOSESIZEUNIT, "pt", CLOSESIZE, 8,
			CAPTION, "Select a date", FIXX, ggPosX, FIXY, ggPosY);
		}
	window.scroll(ggPosX, ggPosY);
}

function show_calendar() {
	/* 
		p_month : 0-11 for Jan-Dec; 12 for All Months.
		p_year	: 4-digit year
		p_format: Date format (mm/dd/yyyy, dd/mm/yy, ...)
		p_item	: Return Item.
	*/

	p_item = arguments[0];
	if (arguments[1] == null)
		p_month = new String(gNow.getMonth());
	else
		p_month = arguments[1];
	if (arguments[2] == "" || arguments[2] == null)
		p_year = new String(gNow.getFullYear().toString());
	else
		p_year = arguments[2];
	if (arguments[3] == null)
		p_format = "YYYY-MM-DD";
	else
		p_format = arguments[3];

	Build(p_item, p_month, p_year, p_format);
}
/*
Yearly Calendar Code Starts here
*/
function show_yearly_calendar() {
	// Load the defaults..
	//if (p_year == null || p_year == "")
	//	p_year = new String(gNow.getFullYear().toString());
	//if (p_format == null || p_format == "")
	//	p_format = "YYYY-MM-DD";

	p_item = arguments[0];
	if (arguments[1] == "" || arguments[1] == null)
		p_year = new String(gNow.getFullYear().toString());
	else
		p_year = arguments[1];
	if (arguments[2] == null)
		p_format = "YYYY-MM-DD";
	else
		p_format = arguments[2];

	Build(p_item, null, p_year, p_format);
}