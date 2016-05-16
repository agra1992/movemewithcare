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

<style type="text/css">
#left_green_image{margin-top:0px;}
#right_green_image{margin-top:16px;}
</style>


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
</script>

</head>

<body onLoad="MM_preloadImages();mmLoadMenus();">
<script  type="text/javascript">
mmLoadMenus();
</script>

<? include_once "top_panel.php" ?>
	
<div id="ajaxcontentarea"> 
<div id="scrollmar">
<marquee  bgcolor="#7CBC34" height="24px" align="center" vspace="10px">
<span style="white-space: nowrap"><font face="Verdana" color="#ffffff"><strong>Welcome to MoveMeWithCare.com.</strong> Nationwide and Accredited Moving Network ... <strong>CALL (877) 963-7283 FOR ALL INQUIRIES</strong></font></span>
</marquee>
</div>
	 <div id="idiv">
<img src="images/slides/slide1.gif" name="slide" border=0 style="filter:blendTrans(duration=3)" width=434 height=166 /></a>
       	<script type="text/javascript" src="/scripts/page_slideshow_trigger.js">
			/***********************************************
			* moving u with care main slideshow
			* by sandman6665
			* slideshow trigger
			***********************************************/
		</script>

<img id="left_green_image" src="images/default_r14_c19.jpg" alt="MoveMewithCare.com" height="11px" width="435px"  />

	 </div> <!--idiv-->
	 
	 <div id="whoarewe" class="style9">
	 <div id="wawtext"><span class="style10">Look no further!<br></span>
	 <?
	   $sql = 'Select Detail From tblcontent Where tblcontent.CID = 11';
	      
       $result = mysql_query($sql) or die("Query failed_WAW");
       $line = mysql_fetch_array($result, MYSQL_ASSOC);
	   echo nl2br($line[Detail]);
	 ?>
<!--We are a professional and accredited moving and storage nationwide network that offers a full range of services for your commercial or residential move. Whether you require full service or assistance with a specific part of your move, -->
      
<strong><span class="style11"> <br />
         MoveMeWithCare</span><span class="style12">.com</span></strong> can help you. <br>
<b>Visit our <a href="/blog/">Moving Blog</a>   <a href='http://movemewithcare.com/blog/xml-rss2.php' ><img border='none' hspace='5' align='bottom' src='images/	rss_feed.gif' height='12'></a> </b>
         </div><!--wawtext-->
<a href="faq1.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('whoweare_arrow','','images/arrows_f02.gif',1)">
<? 
if ($_SESSION['browser'] == "Mozilla")
  {
echo "<img src=\"images/arrows_f01.gif\" alt=\"Moving Me with care.com\" style=\"left:750px;top:295px;position:absolute;\" border=\"0\" id=\"whoweare_arrow\" />";
 }
 else
 {
  echo "<img src=\"images/arrows_f01.gif\" alt=\"Moving Me with care.com\" style=\"left:750px;top:314px;position:absolute;\" border=\"0\" id=\"whoweare_arrow\" />";
 }
?>
 </a>
  <img id="right_green_image" src="images/default_r14_c19.jpg" alt="Move Me with Care.com" height="11px" width="422px"  />
</div><!--whorwe-->
	

<div id="rtext" style="font-family:Verdana;font-size:10px;">
				
			</div><!--rtext-->
	<div id="lmenu">
	<a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Main Menu','','images/menu_green.gif',1)"><img src="images/menu_blue.gif" name="Main Menu" style="margin-top:24px!important;margin-top:8px;" width="362" height="57" border="0" id="Main Menu" onMouseOver="MM_showMenu(window.mm_menu_0901060603_0,0,57,null,'Main Menu')" onMouseOut="MM_startTimeout();" /></a> 
			</div>
			
	<div id="last">		

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
	?>
		<table ><td width="420px" align="left">
		<? echo nl2br($ret[0][0]); ?>
      <td rowspan="2" colspan="2" valign="top"><p style="margin:0px"></p></td>
    <td rowspan="2" colspan="2" valign="top" align="left">
	<? echo nl2br($ret[1][0]); ?> </td>		
	</table>			
			</div>
	   	</div>

<div id="bottom" class="white_links">
<div align="center"><a href="index.php">HOME</a> | <a href="loadingunloading/loadingunloading.php">LOADING/UNLOADING ASSISTANCE</a> | <a href="locator/fullservicemovers.php">FULL SERVICE MOVERS</a> | <a href="transportation/transportation.php?trans=1">TRANSPORTATION PROVIDERS</a> | <a href="storage/storage.php?store=1">STORAGE FACILITIES</a> | <a href="packing/packing.php?packing=1">PACKING SUPPLIES</a></div>
<span style="font-size: 10px;"><br /></span>
<div align="center" class="white_links">
<span class="style13"><a href='../sitemap.php'>site map</a> <a href="/index.php">
<img src="/images/icon_flag_usa.gif" border="0" /> 
</a> | <a href="/index.php"><img src="/images/icon_flag_canada.gif" 
border="0" /></a> <a href='../sitemap.php'>site map</a></span></div>

</div>
<div id="copy" align="center" class="style1" style="font-family: Arial, Helvetica, sans-serif">&copy; MoveMeWithCare Registered, 2006. 
All Rights Reserved &#151; Relocators you can trust. <a href="/contact_details.php">Contact us</a><br>
<a href="realestatelinks.php">Real Estate Links</a>        <span style="margin:30px;">  Link to us <a href='links/misc_links.php'>here </a></span>      
<a href="mortgagedirectory.php">Mortgage Directory</a><br>
<span style="position:relative; right:00px;"><a href=
"http://www.ibem.biz"><img src="../images/IBEM-banner.gif" height="45px"; border="0"> <span style="margin:300px;"></a> <a href="http://www.coverall.com"><img src="../images/coverall_logo.jpg" height="60px"; border="0"></a></span></span>

</div>      
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
