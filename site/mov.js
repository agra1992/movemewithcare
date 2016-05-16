   var http_request = false;
   function makePOSTRequest(url, parameters)
   {
      http_request = false;
      if (window.XMLHttpRequest) { // Mozilla, Safari,...
         http_request = new XMLHttpRequest();
         if (http_request.overrideMimeType) {
         	// set type accordingly to anticipated content type
            //http_request.overrideMimeType('text/xml');
            http_request.overrideMimeType('text/html');
         }
      } else if (window.ActiveXObject) { // IE
         try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
            try {
               http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
         }
      }
      if (!http_request) {
         alert('Cannot create XMLHTTP instance');
         return false;
      }
      
      
      http_request.onreadystatechange = alertContents;
      http_request.open('POST', url, true);
      http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      http_request.setRequestHeader("Content-length", parameters.length);
      http_request.setRequestHeader("Connection", "close");
      http_request.send(parameters);
   }

function addOption(optionText,optionValue,OptionBool,selectObject) {
	//alert(OptionBool);

	selectObject= document.getElementById(selectObject);
    var optionObject = new Option(optionText,optionValue,false,false)
    var optionRank = selectObject.options.length
    selectObject.options[optionRank]=optionObject
}


   function alertContents() {
      if (http_request.readyState == 4)
      {
         if (http_request.status == 200)
         {
            result = http_request.responseText;
		  	eval(result);
		    document.getElementById('loaderContainer').style.visibility='hidden';
			document.getElementById('cityrec').innerHTML="<i>if your city is not listed, please select nearest location.</i>";
			
			     
         } else {
            alert('There was a problem with the request. ' + http_request.status);
         }
      }
   }
   

   function get(obj)
   {   	
		var poststr = "or_state=" + encodeURI(document.getElementById("or_state").value );
		document.getElementById("or_city").options.length=0;
		
		makePOSTRequest('/New/fs_1.php', poststr);
	  	document.getElementById('loaderContainer').style.visibility='visible';	 
   }
   
   function get2(obj)
   {     
   		var poststr = "dor_state=" + encodeURI(document.getElementById("dor_state").value );		 
	 	document.getElementById("dor_city").options.length=0;
	
		makePOSTRequest('/New/fs_2.php', poststr);
	  	document.getElementById('loaderContainer').style.visibility='visible';	 
   }

function AllowNext(typ)
{
	if(typ=="mov")
	{
		if (((document.getElementById("or_state").value==68) && (document.getElementById("dor_state").value!='') && (document.getElementById("moveSize").value!='')) || ((document.getElementById("or_city").value!='') && (document.getElementById("or_state").value!='') && (document.getElementById("dor_state").value!='') && (document.getElementById("moveSize").value!='')))
		{
			document.getElementById("next").disabled = false;
		}
		else
			document.getElementById("next").disabled = true;
	}
	else if(typ=="lupu")
	{
		if((document.getElementById("or_city").value!='') && (document.getElementById("dor_city").value!='' || document.forms[0].samecity.checked))
		{
			document.getElementById("next").disabled=false;
		}
		else
		{
			document.getElementById("next").disabled = true;
		}
			
	}


//if ((document.getElementById("or_city").readonly==true) && (document.getElementById("to_state").value!='') && (document.getElementById("moveSize").value!='')) {
//document.getElementById("next").disabled = false;
//}
}

function naNext()
{
	document.getElementById("next").disabled = true;
}


function showmap(t) {	
window.open("../map.php?i="+t,"map","toolbar=no,location=no,directories=no,status=no,scrollbars=no,menubar=no,fullscreen=no,width=540,height=360");
}

function showmap2(t) {
window.open("../map2.php?i="+t,"map","toolbar=no,location=no,directories=no,status=no,scrollbars=no,menubar=no,fullscreen=no,width=540,height=360");
}



function submit1(obj){
switch(obj)
{
case '1':alert("You can fill this form and have a look how form works");
case '2':alert("this will go to Loading/Unloading Tab"); break;
case '3':alert("this will go to Transportation Providers Tab"); break;
case '4':alert("this will go to Storage Facilities Tab"); break;
case '5':alert("Packing supplies & Materials"); break;
default:alert("Unknown Option");
}
}
