
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MovingUwithCare.com</title>
<link rel="stylesheet" type="text/css" href="movin.css" />

<link rel="stylesheet" type="text/css" href="main.css" />
<link rel="stylesheet" type="text/css" href="main_page.css" />
<link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js">

/***********************************************
* Ajax Tabs Content script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>
<script type="text/javascript" src="locator/mov.js">

</script>
<script language="JavaScript1.2" type="text/javascript">
<!--

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_nbGroup(event, grpName) { //v6.0
var i,img,nbArr,args=MM_nbGroup.arguments;
  if (event == "init" && args.length > 2) {
    if ((img = MM_findObj(args[2])) != null && !img.MM_init) {
      img.MM_init = true; img.MM_up = args[3]; img.MM_dn = img.src;
      if ((nbArr = document[grpName]) == null) nbArr = document[grpName] = new Array();
      nbArr[nbArr.length] = img;
      for (i=4; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
        if (!img.MM_up) img.MM_up = img.src;
        img.src = img.MM_dn = args[i+1];
        nbArr[nbArr.length] = img;
    } }
  } else if (event == "over") {
    document.MM_nbOver = nbArr = new Array();
    for (i=1; i < args.length-1; i+=3) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = (img.MM_dn && args[i+2]) ? args[i+2] : ((args[i+1])?args[i+1] : img.MM_up);
      nbArr[nbArr.length] = img;
    }
  } else if (event == "out" ) {
    for (i=0; i < document.MM_nbOver.length; i++) { img = document.MM_nbOver[i]; img.src = (img.MM_dn) ? img.MM_dn : img.MM_up; }
  } else if (event == "down") {
    nbArr = document[grpName];
    if (nbArr) for (i=0; i < nbArr.length; i++) { img=nbArr[i]; img.src = img.MM_up; img.MM_dn = 0; }
    document[grpName] = nbArr = new Array();
    for (i=2; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = img.MM_dn = (args[i+1])? args[i+1] : img.MM_up;
      nbArr[nbArr.length] = img;
  } }
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<style type="text/css" >
.selhome{display: block;background: #248dcd;background-image: url('buttons/tab_menu_r1_c1_f4.jpg');}
#menu{float:left;padding-top:5px;background: #FFF;color:black;}
ul#nav,ul#nav li{list-style-type:none;margin:0;padding:0;text-align: center;font-size: 9px;font-weight: bold;font-family: Verdana}
ul#nav{width:857px;text-align: center;}
ul#nav li#home a{display: block;float:left;width:60px;height:22px;text-indent:-9999px;background: #E7F1F8;color: #666;background-image: url('buttons/tab_menu_r1_c1.jpg');}
ul#nav li#home a:hover{display: block;background: #248dcd;;color: #E7F1f8;background-image: url('buttons/tab_menu_r1_c1_f2.jpg');}
ul#nav li#home a:active{display: block;background: #248dcd;background-image: url('buttons/tab_menu_r1_c1_f4.jpg');}
ul#nav.me li#home.selected{background-image: url('buttons/tab_menu_r1_c1_f4.jpg';} 

ul#nav li#who a{display: block;float:left;width:152px;height:22px;background: #E7F1F8;color: #666;text-indent:-9999px;background-image: url('buttons/tab_menu_r1_c2.jpg');}
ul#nav li#who a:hover{background: #248dcd;;color: #E7F1f8;background-image: url('buttons/tab_menu_r1_c2_f2.jpg');}
ul#nav li#who a:active{background: #000;background-image: url('buttons/tab_menu_r1_c2_f4.jpg');}


ul#nav li#prod a{display: block;float:left;width:122px;height:22px;background: #E7F1F8;color: #666;background-image: url('buttons/tab_menu_r1_c3.jpg');text-indent: -9999px;}
ul#nav li#prod a:hover{display: block;text-indent: -9999px;background: #248dcd;;color: #E7F1f8;background-image: url('buttons/tab_menu_r1_c3_f2.jpg');}
ul#nav li#prod a:active{display: block;background: #248dcd;text-indent: -9999px;background-image: url('buttons/tab_menu_r1_c3_f4.jpg');}

ul#nav li#serv a{display: block;float:left;width:122px;height:22px;background: #E7F1F8;color: #666;background-image: url('buttons/tab_menu_r1_c4.jpg');text-indent: -9999px;}
ul#nav li#serv a:hover{display: block;text-indent: -9999px;background: #248dcd;;color: #E7F1f8;background-image: url('buttons/tab_menu_r1_c4_f2.jpg');}
ul#nav li#serv a:active{display: block;background: #248dcd;text-indent: -9999px;background-image: url('buttons/tab_menu_r1_c4_f4.jpg');}

ul#nav li#cont a{display: block;float:left;width:114px;height:22px;background: #E7F1F8;color: #666;background-image: url('buttons/tab_menu_r1_c5.jpg');text-indent: -9999px;}
ul#nav li#cont a:hover{display: block;text-indent: -9999px;background: #248dcd;;color: #E7F1f8;background-image: url('buttons/tab_menu_r1_c5_f2.jpg');}
ul#nav li#cont a:active{display: block;background: #248dcd;text-indent: -9999px;background-image: url('buttons/tab_menu_r1_c5_f4.jpg');}

ul#nav li#cont1 a{display: block;float:left;width:107px;height:22px;background: #E7F1F8;color: #666;background-image: url('buttons/tab_menu_r1_c6.jpg');text-indent: -9999px;}
ul#nav li#cont1 a:hover{display: block;text-indent: -9999px;background: #248dcd;;color: #E7F1f8;background-image: url('buttons/tab_menu_r1_c6_f2.jpg');}
ul#nav li#cont1 a:active{display: block;background: #248dcd;text-indent: -9999px;background-image: url('buttons/tab_menu_r1_c6_f4.jpg');}

ul#nav li#feed a{display: block;float:left;width:83px;height:22px;background: #E7F1F8;color: #666;background-image: url('buttons/tab_menu_r1_c7.jpg');text-indent: -9999px;}
ul#nav li#feed a:hover{display: block;text-indent: -9999px;background: #248dcd;;color: #E7F1f8;background-image: url('buttons/tab_menu_r1_c7_f2.jpg');}
ul#nav li#feed a:active{display: block;background: #248dcd;text-indent: -9999px;background-image: url('buttons/tab_menu_r1_c7_f4.jpg');}

}
#ajaxcontentarea{text-align:center;margin:0px;padding-top:100px!important;padding:0px;display:inline;}
</style>
</head>
<body onload="MM_preloadImages('buttons/tab_menu_r1_c1_f2.jpg','buttons/tab_menu_r1_c1_f4.jpg','buttons/tab_menu_r1_c1_f3.jpg','buttons/tab_menu_r1_c2_f2.jpg','buttons/tab_menu_r1_c2_f4.jpg','buttons/tab_menu_r1_c2_f3.jpg','buttons/tab_menu_r1_c3_f2.jpg','buttons/tab_menu_r1_c3_f4.jpg','buttons/tab_menu_r1_c3_f3.jpg','buttons/tab_menu_r1_c4_f2.jpg','buttons/tab_menu_r1_c4_f4.jpg','buttons/tab_menu_r1_c4_f3.jpg','buttons/tab_menu_r1_c5_f2.jpg','buttons/tab_menu_r1_c5_f4.jpg','buttons/tab_menu_r1_c5_f3.jpg','buttons/tab_menu_r1_c6_f2.jpg','buttons/tab_menu_r1_c6_f4.jpg','buttons/tab_menu_r1_c6_f3.jpg','arrows_f02.gif');">
<div id="main">

	<div id="top">
		<div id="logo">
<img src="../movinguwithcare/images/callcard_r4_c2.gif" alt="MovingUwithCare.com" />
	</div>
		<div id="right">
<img src="images/enq.jpg" alt="CALL(877)9637283" />
<!--links-->
			<div id="blue_links">
				<span class="style14">
			<ul id="topamenu" class="shadetabs2">
		
			<li><a href="#default" rel="ajaxcontentarea">HOME</a></li>&nbsp;&nbsp;|
			<li><a href="locator/mem.php" rel="ajaxcontentarea" rev="cont.css">MEMBER LOGIN</a></li>&nbsp;&nbsp;|
			<li><a href="contact.php" rel="ajaxcontentarea" rev="cont.css">CONTACT US</a></li>
			</ul>
		</span>
			</div>
		<br />
		
		
		</div>
		<div id="menu">
				<ul id="nav" class="me">
        	<li id="home" <?if ($home==1) echo "class=\"selected\"";?>><a href="#default" rel="ajaxcontentarea" rev="main_page.css">Home</a></li>
	        <li id="who" <?if ($lupu==1) echo "class=\"selected\"";?>><a href="lupu.php" rel="ajaxcontentarea" rev="locator/mov.js,lupu.js,main_change.css,cont.css">LOADING/UNLOADING ASSISTANCE</a></li>
    	    <li id="prod" <?if ($full==1) echo "class=\"selected\"";?>><a href="locator/mov.php" rel="ajaxcontentarea" rev="locator/mov.js,main_change.css,cont.css">FULL SERVICE MOVERS</a></li>
        	<li id="serv" <?if ($tp==1) echo "class=\"selected\"";?>><a href="persInfo.php?trans=1" rel="ajaxcontentarea" rev="locator/mov.js,cal.js,overlib_mini.js">TRANSPORTATION PROVIDERS</a></li>
	        <li id="cont" <?if ($sf==1) echo "class=\"selected\"";?>><a href="persInfo.php?store=1" rel="ajaxcontentarea" rev="cal.js,overlib_mini.js">STORAGE FACILITIES</a></li>
    	    <li id="cont1" <?if ($psm==1) echo "class=\"selected\"";?>><a href="persInfo.php?packing=1" rel="ajaxcontentarea" rev="cal.js,overlib_mini.js">PACKING SUPPLIES &amp; MATERIALS</a></li>
			<li id="feed" <?if ($feed==1) echo "class=\"selected\"";?>><a href="#" rel="ajaxcontentarea" rev="cal.js,overlib_mini.js">Feedback</a></li>			
   				 </ul>
   	<div id="bbb"></div>
	   		</div>	
	   	
	</div>
<div id="ajaxcontentarea">





</div>
</div>
<div id="bottom" class="whitelinks">
<div align="center" class="white_links"><span class="style13" style="margin:0px"><a href="HOME">HOME</a> | <a href="LOADING/UNLOADING%20ASSISTANCE">LOADING/UNLOADING ASSISTANCE</a> | <a href="FULL%20SERVICE%20MOVERS">FULL SERVICE MOVERS</a> | <a href="TRANSPORTATION%20PROVIDERS">TRANSPORTATION PROVIDERS</a> | <a href="STORAGE%20FACILITIES">STORAGE FACILITIES</a> | <a href="PACKING%20SUPPLIES%20AND%20MATERIALS">PACKING SUPPLIES AND MATERIALS</a></span></div>
<br />
<div align="center" class="white_links"><span class="style13"><a href="ad">USA </a> | <a href="ad">CANADA</a></span></div>
</div>
<div id="copy" align="center" class="style1">&copy; MovingUWithCare Registered, 2006. All Rights Reserved. </div>

<div id="loaderContainer">
</div>
<script type="text/javascript">
//Start Ajax tabs script for UL with id="maintab" Separate multiple ids each with a comma.
//startajaxtabs("nav","top","mem1","faq1","bbb1")
startajaxtabs("nav","topamenu","faq1")
</script>
</body>
</html>