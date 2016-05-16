<? 
 session_start();
?>


<? 
 include "prerequisites.php";
 include "seo.php";
 session_register("browser");
 $browser = CheckBrowser();
 //echo $_SESSION['browser'];
?>

<meta name="verify-v1" content="DgZnMTWzdhiG5DvD+2KF83cB48e+P/0ZlJcWweem4KQ=" />

<? 
//connect to database
require ('config.inc.php');
$link = mysql_connect($db_host, $db_user, $db_password)
 or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");
?>



<!--[if IE 7]>
    <style type="text/css">
    #rtext{align:top;width:400px;height: 200px!important;height:20px;margin-left:430px;text-align: left;content: "";margin-top:-150px;}    
    #left_green_image{position: relative; bottom: 8px; }

    </style>
<![endif]-->

<!--[if IE 6]>
    <style type="text/css">
    #left_green_image{position: relative; bottom: 8px; }
    #right_green_image{margin-top:24px;}
    </style>
<![endif]-->

<!--[if IE 5]>
    <style type="text/css">
    #left_green_image{position: relative; bottom: 8px; }
    #right_green_image{margin-top:36px;}
#lmenu{margin-top:22px!important;margin-top:30px;position:absolute;left:0px;top:346px;height:25px;width:400px;background-repeat: no-repeat;visibility: visible;content: "";}
#scrollmar{margin-top:0px;margin-bottom:12px;display: inline;height:40px;padding: 0px;background-color:#036AB5;background-image: url(images/midpanel_a.gif);background-repeat:repeat-x;}

    </style>
<![endif]-->






<script type="text/javascript" src="ajaxtabs/ajaxtabs.js"> 
/***********************************************
* Ajax Tabs Content script- ? Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/
</script>




<script type="text/javascript" src="/scripts/load_bodymenu.js">
//body bar menu
</script>

<script type="text/javascript" src="/scripts/page_slideshow.js">
/***********************************************
* Main slideshow
***********************************************/
</script>


<script src="/scripts/preload_mainmenu.js" type="text/JavaScript">
//preload menus
</script>

<script src="/mm_menu.js" type="text/JavaScript">
//load menus
</script>


<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-3315693-1";
urchinTracker();
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>

</head>

<body onLoad="mmLoadMenus();MM_preloadImages('images/menu_green.gif')">
<script  type="text/javascript">
mmLoadMenus();
</script>

<? include_once "top_panel.php" ?>
	
<div id="ajaxcontentarea"> 
<div id="scrollmar">
<span >
<marquee  height="24px" align="center" vspace="10px" style="vertical-align:middle">
<font face="Verdana"><strong>Welcome to MoveMeWithCare.com.</strong> Nationwide and Accredited Moving Network ... <strong>CALL (877) 963-7283 FOR ALL INQUIRIES</strong></font>
</marquee>
</span><br>
</div>
	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td width="28%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td align="left" valign="top"><div><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Main Menu','','images/menu_green.gif',1)"><img src="images/menu_blue.gif" name="Main Menu" width="362" height="57" border="0" id="Main Menu" onMouseOver="MM_showMenu(window.mm_menu_0901060603_0,0,57,null,'Main Menu')" onMouseOut="MM_startTimeout();" /></a></div>
             <?
	     $sql = "Select tblcontent.Detail From tblcontent WHERE
				   tblcontent.CID IN (1,2)";
				   
	     $result = mysql_query($sql) or die("Query failed_index");
		 $ret= array();
		 $num = mysql_num_rows($result);
		 for($i=0;$i<$num;$i++)
		 {
		 	array_push($ret,mysql_fetch_row($result));
		 }	
		 $website = "MoveMeWithCare";
	       $ret[0][0] = str_replace( "&n&website", $website, $ret[0][0]);
	       $ret[1][0] = str_replace( "&n&website", $website, $ret[1][0]);
	?></td>
           </tr>
           <tr>
             <td align="left" valign="top"><div align="left" style="padding:5px"><span class="style10">Look no further!<br>
               </span>
                   <?
	   $sql = 'Select Detail From tblcontent Where tblcontent.CID = 11';
	      
       $result = mysql_query($sql) or die("Query failed_WAW");
       $line = mysql_fetch_array($result, MYSQL_ASSOC);
	   echo nl2br($line[Detail]);
	 ?>
                   <!--We are a professional and accredited moving and storage nationwide network that offers a full range of services for your commercial or residential move. Whether you require full service or assistance with a specific part of your move, -->
                   <strong><span class="style11"> <br />
                     MoveMeWithCare</span><span class="style12">.com</span></strong> can help you. <br>
  <b>Visit our <a href="/blog/">Moving Blog</a> <a href='http://movemewithcare.com/blog/xml-rss2.php' ><img border='none' hspace='5' align='bottom' src='images/rss_feed.gif' height='12'></a> </b> </div></td>
           </tr>
         </table></td>
         <td width="37%" align="right" valign="top"><div > <img src="images/slides/slide1.gif" name="slide" border=0 style="filter:blendTrans(duration=3)" width=434 height=166 /></a>
               <script type="text/javascript" src="/scripts/page_slideshow_trigger.js">
			/***********************************************
			* moving u with care main slideshow
			* by sandman6665
			* slideshow trigger
			***********************************************/
		     </script>
               <img id="left_green_image" src="images/default_r14_c19.jpg" alt="MoveMewithCare.com" height="11px" width="435px"  /> </div></td>
         <td width="35%"><a href="faq1.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('whoweare_arrow','','images/arrows_f02.gif',1)">
<? 
if ($_SESSION['browser'] == "Mozilla")
  {
echo "<img src=\"images/arrows_f01.gif\" alt=\"Moving Me with care.com\" border=\"0\" />";
 }
 else
 {
  echo "<img src=\"images/arrows_f01.gif\" alt=\"Moving Me with care.com\" border=\"0\"  />";
 }
?>
 </a></td>
       </tr>
       <tr>
         <td colspan="3" valign="top"><table width="100%" cellpadding="0" cellspacing="0" >
  <td width="50%" align="left"><? echo nl2br($ret[0][0]); ?>
    <td rowspan="2" colspan="2" valign="top"></td>
    <td width="50%" colspan="2" rowspan="2" align="left" valign="top"><? echo nl2br($ret[1][0]); ?> </td>
         </table></td>
       </tr>
     </table>
	 <!--idiv-->
  <!--whorwe-->
	
<div id="rtext" style="font-family:Verdana;font-size:10px;"></div><!--rtext-->
<div id="last">		

<div id="bottom" class="white_links">
<div align="center"><a href="index.php">HOME</a> | <a href="loadingunloading/loadingunloading.php">LOADING/UNLOADING ASSISTANCE</a> | <a href="locator/fullservicemovers.php">FULL SERVICE MOVERS</a> | <a href="transportation/transportation.php?trans=1">TRANSPORTATION PROVIDERS</a> | <a href="storage/storage.php?store=1">STORAGE FACILITIES</a> | <a href="packing/packing.php?packing=1">PACKING SUPPLIES</a></div>
<span style="font-size: 10px;"><br /></span>
<div align="center" class="white_links">
<span class="style13"><a href='../sitemap.php'>site map</a> <a href="/index.php">
<img src="/images/icon_flag_usa.gif" border="0" /> 
</a> | <a href="/index.php"><img src="/images/icon_flag_canada.gif" 
border="0" /></a> <a href='../sitemap.php'>site map</a></span></div>
</div>
<div id="copy" align="center" class="style1" style="font-family: Arial, Helvetica, sans-serif">&copy; MoveMeWithCare Registered, 2009. 
All Rights Reserved &#151; Relocators you can trust. <a href="/contact_details.php">Contact us</a><br>
<a href="realestatelinks.php">Real Estate Links</a>        <span style="margin:30px;">  Link to us <a href='links/misc_links.php'>here </a></span>      
<a href="mortgagedirectory.php">Mortgage Directory</a><br>    
</div><br />

<img src='buttons/tab_menu_r1_c1_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c2_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c3_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c4_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c5_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c6_f2.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c7_f2.jpg' class="hiddenPic" />


<img src='buttons/tab_menu_r1_c1_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c2_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c3_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c4_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c5_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c6_f4.jpg' class="hiddenPic" />
<img src='buttons/tab_menu_r1_c7_f4.jpg' class="hiddenPic" />
</body>
</html>
