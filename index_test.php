<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>
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

<script type="text/javascript" src="../ajaxtabs/ajaxtabs.js"> 
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

<link href="../main_page.css" rel="stylesheet" type="text/css">
<link href="../main_change.css" rel="stylesheet" type="text/css">
<link href="../main_without_logos.css" rel="stylesheet" type="text/css">
<link href="../main.css" rel="stylesheet" type="text/css">
<link href="../ie6specifc.css" rel="stylesheet" type="text/css">
<link href="../iespecific.css" rel="stylesheet" type="text/css">
<link href="../full_mov_list.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="MM_preloadImages();mmLoadMenus();">
<script  type="text/javascript">
mmLoadMenus();
</script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="../images/css1.css" rel="stylesheet" type="text/css" />
</head>

<body>

<table width="100%" height="405" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="328" align="center"><table width="1000" height="484" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="484" valign="top" class="banbg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="40%" height="74"><img src="../images/logo.png" width="329" height="76" /><br /></td>
                <td width="60%">&nbsp;</td>
              </tr>
            </table></td>
            </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table id="Table_01" width="1000" height="40" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><img src="../images/pr_layout_02_line_01.gif" width="2" height="40" alt="" /></td>
                    <td><a href="http://movemewithcare.com/New/New/index_test.php"><img src="../images/pr_layout_02_line_02.gif" alt="" width="65" height="40" border="0" /></a></td>
                    <td><a href="http://www.movemewithcare.com/loadingunloading/loadingunloading.php"><img src="../images/pr_layout_02_line_03.gif" alt="" width="177" height="40" border="0" /></a></td>
                    <td><a href="http://www.movemewithcare.com/locator/fullservicemovers.php"><img src="../images/pr_layout_02_line_04.gif" alt="" width="148" height="40" border="0" /></a></td>
                    <td><a href="http://www.movemewithcare.com/transportation/transportation.php"><img src="../images/pr_layout_02_line_05.gif" alt="" width="149" height="40" border="0" /></a></td>
                    <td><a href="http://www.movemewithcare.com/storage/storage.php"><img src="../images/pr_layout_02_line_06.gif" alt="" width="131" height="40" border="0" /></a></td>
                    <td><a href="http://www.movemewithcare.com/packing/packing.php"><img src="../images/pr_layout_02_line_07.png" alt="" width="132" height="40" border="0" /></a></td>
                    <td><a href="http://www.movemewithcare.com/feedback1.php"><img src="../images/pr_layout_02_line_08.gif" alt="" width="91" height="40" border="0" /></a></td>
                    <td><a href="http://www.movemewithcare.com/marketplace/marketplace.php"><img src="../images/pr_layout_02_line_09.gif" alt="" width="102" height="40" border="0" /></a></td>
                    <td><img src="../images/pr_layout_02_line_10.gif" width="3" height="40" alt="" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="1" align="left" valign="bottom"><img src="../images/w_line.png" width="2" height="98" /></td>
                <td width="25%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
	<a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Main Menu','','../images/menu.png',1)"><img src="../images/menu.png" name="Main Menu" width="265" height="36" border="0" id="Main Menu" onMouseOver="MM_showMenu(window.mm_menu_0901060603_0,0,57,null,'Main Menu')" onMouseOut="MM_startTimeout();" /></a></td>
                  </tr>
                  <tr>
                    <td><img src="../images/welcome.png" width="265" height="217" /></td>
                  </tr>
                </table></td>
                <td width="1%">&nbsp;</td>
                <td width="74%" align="left" valign="top"><img src="../images/flash banner.png" width="692" height="250" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="botbg">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="1" align="left" valign="bottom"><img src="../images/b_bg.png" width="3" height="483" /></td>
                    <td colspan="3" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%">&nbsp;</td>
                        <td width="73%">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td valign="middle" class="bar_bg">Members Area</td>
                              </tr>
                              <tr>
                                <td height="132" valign="top" class="mem_a_bg" ><table width="100%" border="0" cellpadding="0" cellspacing="0" background="../images/memarea_bg.png" >
                                    <tr>
                                      <td colspan="3"><img src="../images/memarea_top.png" width="265" height="10" /></td>
                                    </tr>
                                    <tr>
                                      <td width="6%">&nbsp;</td>
                                      <td width="89%" align="center" class="mem_txt","mem_a_bg"><table width="94%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td>Become A Member</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>Terms Of Service</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>Member Login</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>USA &amp; Canada agencies</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td class="mem_sub_head">Accredited Associations :</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td><a href="http://mybbb.org" class="mem_txt">BBB</a>, <a href="http://moving.org" class="mem_txt">AMSA</a>, <a href="http://hhgfaa.org" class="mem_txt">HHGFAA</a>, <a href="http://iata.org" class="mem_txt">CAD</a>, <a href="http://moving.org" class="mem_txt">AMA</a>, <a href="http://uschamber.com" class="mem_txt">Chamber of Commerce</a></td>
                                          </tr>
                                      </table></td>
                                      <td width="5%">&nbsp;</td>
                                    </tr>
                                    
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><img src="../images/memarea_bot copy.gif" width="265" height="21" /></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td valign="middle" class="bar_bg">Additional Links</td>
                              </tr>
                              <tr>
                                <td height="132" valign="top" class="mem_a_bg" ><table width="100%" border="0" cellpadding="0" cellspacing="0" background="../images/memarea_bg.png" >
                                    <tr>
                                      <td colspan="3"><img src="../images/memarea_top.png" width="265" height="10" /></td>
                                    </tr>
                                    <tr>
                                      <td width="6%">&nbsp;</td>
                                      <td width="89%" align="center" class="mem_txt","mem_a_bg"><table width="94%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td>Real Estate Directory</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>Mortgage Directory</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>Link to Us Here</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>Site Map</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>Contact Us</td>
                                          </tr>

                                      </table></td>
                                      <td width="5%">&nbsp;</td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><img src="../images/memarea_bot copy.gif" width="265" height="21" /></td>
                          </tr>
                        </table></td>
                        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="49%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              
                              <tr>
                                <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><table width="99%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="3%" rowspan="4" align="left" valign="top" class="bor_l_bg"><img src="../images/border_l.png" width="7" height="401" /></td>
                                        <td class="txtbody"><img src="../images/heading1.png" width="328" height="21" /></td>
                                        <td width="3%" rowspan="4" align="right" valign="top" class="bor_r_bg"><img src="../images/border_r.png" width="8" height="401" /></td>
                                      </tr>
                                      <tr>
                                        <td width="94%" class="txtbody">Courtesy of MoveMeWithCare.com<br />
Universal Moving Guide 2009: Everything you need to know about moving but was afraid to ask...(<a href="http://www.movemewithcare.com/blog/createaccount.php">register to our moving blog for a free copy</a>)<br />
<br />
&quot;The Minute Moving Pocket Book 2009&quot; available <a href="http://www.movemewithcare.com/quick_launch.pdf">here</a></td>
                                        </tr>
                                      <tr>
                                        <td class="heading1"><br />
                                          Gain Peace of Mind<br /><br /></td>
                                        </tr>
                                      <tr>
                                        <td class="txtbody">Are you tired of trying to find reliable and professional help for your next move? <br />
MoveMeWithCare.com is a network of accredited moving professionals for  both USA and Canada. We verify that our members are all in good  standing with either the Better Business Bureau (USA and Canada),  and/or The American Moving and Storage Association, The Household Good  Forwarders Association of America and these are just a few recognized  organizations mentioned among many more in both countries. Also, all  members have never been blacklisted from Movingscam.com. Additionally,  most of our members have the authority to serve you nationwide or  across borders.<br />
<br />
Haven't registered as a accredited mover yet? Please click <a href="http://www.MoveMeWithCare.com/mem2.php">here</a>.<br />
<br />
As you browse the site, notice the <a href="http://www.MoveMeWithCare.com/feedback1.php">Feedback</a> area. Here you will be able to provide us with feedback from network  members who’ve served you recently. This step will enhance customer’s  participation to the site and increase awareness to network members to  always provide expert service to you, our customers. Throughout the  site, you will find recommendations to help you find the most  economical and practical solutions for your upcoming relocation.  However, if you need any help throughout the process of posting a  moving request, you can always call our toll-free number at  1-877-963-SAVE (7283) and talk it over with our relocation specialist.</td>
                                        </tr>
                                      <tr>
                                        <td colspan="3" align="left" valign="top"><img src="../images/bottum.png" width="353" height="30" /></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  
                                </table></td>
                              </tr>
                            </table></td>
                            <td width="2%">&nbsp;</td>
                            <td width="44%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="3%" rowspan="2" align="left" valign="top" class="bor_l_bg"><img src="../images/border_l.png" width="7" height="401" /></td>
                                <td align="center"><img src="../images/heading2.png" width="100" height="18" /></td>
                                <td width="3%" rowspan="2" align="right" valign="top" class="bor_r_bg"><img src="../images/border_r.png" width="8" height="401" /></td>
                              </tr>
                              <tr>
                                <td width="94%" valign="top" class="txtbody">You don’t have to impose on your family and friends to help you pack  your grandmother’s china and haul your dad’s grand piano. In this site,  you will find reliable help at competitive prices. Choose what you need:<br />
                                    <br />
                                  ·Intrastate (local) transportation<br />
                                  ·Interstate (out-of-state) transportation, we also move cars.<br />
                                  ·Packing and unpacking<br />
                                  ·Loading and unloading<br />
                                  ·Boxes and other packing supplies <br />
                                  ·Storage facilities and PODS<br />
                                  ·Or all of the above (full-service movers)<br />
  <br />
                                  We work with all the rental companies you have come to know and several you’ll be glad you discovered:<br />
  <br />
                                  ·<a href="http://www.movemewithcare.com/" onclick="new_window('/images/truck/budget.jpg')">Budget<br />
  </a>·<a href="http://www.movemewithcare.com/" onclick="new_window('/images/truck/penske.jpg')">Penske<br />
  </a>·<a href="http://www.movemewithcare.com/" onclick="new_window('/images/truck/ryder.gif')">Ryder<br />
  </a>·<a href="http://www.movemewithcare.com/" onclick="new_window('/images/truck/uhaul.jpg')">UHaul<br />
  </a>·<a href="http://www.movemewithcare.com/" onclick="new_window('/images/truck/abf.jpg')">ABF U-Pack trailer<br />
  </a>·<a href="http://www.movemewithcare.com/" onclick="new_window('/images/truck/	movex.jpg')">Movex Trailer</a><br />
                                  ·<a href="http://www.movemewithcare.com/" onclick="new_window('/images/truck/pods.jpg')">Pods Container</a><br />
                                  ·<a href="http://www.movemewithcare.com/" onclick="new_window('/images/truck/door.jpg')">Door-to-Door/City-to-City Container</a> <br />
                                  ·<a href="http://www.movemewithcare.com/" onclick="new_window('/images/truck/attic.jpg')">Mobil Attic Container</a> <br />
  <br />
                                  With advice from MoveMeWithCare.com, you can make a professional and  informed decision. You also decide how much help you need. And in the  end, you save yourself the headaches and stress of not knowing how and  when your belongings will arrive where they need to be.<br />
                                  Moving 2009 season has officially started, but always make sure to take  your time to select the right mover, and this is one reason why you  need to choose MoveMeWithCare.com: The network of accredited and  certified moving companies in North America.<br /></p>                                  </td>
                              </tr>
                              
                              <tr>
                                <td colspan="3" align="left" valign="top"><img src="../images/bottum.png" width="353" height="30" /></td>
                              </tr>
                            </table></td>
                            <td width="5%">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                    </tr>
                  
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td background="../images/bot_but_bg.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="1%" background="../images/bot_but_bg.png">&nbsp;</td>
                    <td width="98%" background="../images/bot_but_bg.png"><div align="center" class="wlink"><a href="http://movemewithcare.com/New/New/index_test.php" class="wlink">HOME</a> | <a href="http://www.movemewithcare.com/loadingunloading/loadingunloading.php"  class="wlink">LOADING/UNLOADING ASSISTANCE</a> | <a href="http://www.movemewithcare.com/locator/fullservicemovers.php"  class="wlink">FULL SERVICE MOVERS</a> | <a href="http://www.movemewithcare.com/transportation/transportation.php?trans=1"  class="wlink">TRANSPORTATION PROVIDERS</a> | <a href="http://www.movemewithcare.com/storage/storage.php?store=1"  class="wlink">STORAGE FACILITIES</a> | <a href="http://www.movemewithcare.com/packing/packing.php?packing=1"  class="wlink">PACKING SUPPLIES</a></div></td>
                    <td width="1%" background="../images/bot_but_bg.png">&nbsp;</td>
                  </tr>
                </table></td>
                <td background="../images/bot_but_bg.png">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
