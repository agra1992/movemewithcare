<? 
 session_start();
?>
<?
require_once('config.inc.php');
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");
$accred_assoc=" ";
$sql = 'Select `Name`,`Link` From accred_assoc Where Active=1';
$result = mysql_query($sql) or die("Query failed_assoc");
while($r=mysql_fetch_row($result))
{
    $accred_assoc.="<a href='http://".$r[1]."'>".$r[0]."</a>, ";
}
$accred_assoc.=" <a href='/departmentoftransportation.php'>USA DOT agencies</a> , <a href='/departmentoftransportation.php'>Canada DOT agencies</a>, and many more";

?>
<?
require_once('config.inc.php');
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");
$accred_assoc=" ";
$sql = 'Select `Name`,`Link` From accred_assoc Where Active=1';
$result = mysql_query($sql) or die("Query failed_assoc");
while($r=mysql_fetch_row($result))
{
    $accred_assoc.="<a href='http://".$r[1]."'>".$r[0]."</a>, ";
}
$accred_assoc.=" <a href='/departmentoftransportation.php'>USA DOT agencies</a> , <a href='/departmentoftransportation.php'>Canada DOT agencies</a>, and many more";

?>
<link rel="stylesheet" type="text/css" href="../main.css" />
<link rel="stylesheet" type="text/css" href="../main_page.css" />


<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-3315693-1";
urchinTracker();
</script>







<script type="text/javascript">
function new_window(image_path)
{
    truck_window=window.open(image_path, "Truck Images", "width=300, height=150")
    truck_window.focus();
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>

<link href="images/css1.css" rel="stylesheet" type="text/css">
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
<body onLoad="MM_preloadImages('images2/MAIN_19_1.jpg','images2/MAIN_23_1.jpg','images2/MAIN_24_1.jpg','images2/MAIN_25_1.jpg','images2/MAIN_26_1.jpg','images2/MAIN_20_1.jpg')">
<?
require_once('config.inc.php');
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");
$accred_assoc=" ";
$sql = 'Select `Name`,`Link` From accred_assoc Where Active=1';
$result = mysql_query($sql) or die("Query failed_assoc");
while($r=mysql_fetch_row($result))
{
    $accred_assoc.="<a href='http://".$r[1]."'>".$r[0]."</a>, ";
}
$accred_assoc.=" <a href='/departmentoftransportation.php'>USA DOT agencies</a> , <a href='/departmentoftransportation.php'>Canada DOT agencies</a>, and many more";

?>
<div id="main">
<table width="1000" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="116" valign="top" class="banbg2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33%" height="74"><img src="../images/logo.png" width="329" height="76" /><br /></td>
            <td width="67%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right" class="num"><table width="89%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="78%" align="right"  class="num">FOR INQUIRIES CALL: TOLL FREE: 877-963-SAVE(7283)</td>
                    <td width="10%" align="right"><a href="movemewithcare.com"><img src="../images/home_icon.png" alt="Home" width="25" height="27" border="0" /></a></td>
                    <td width="7%" align="center"><a href="http://movemewithcare.com/contact_details.php"> <img src="../images/cont_icon.png" alt="Contact Us" width="37" height="28" border="0" longdesc="http://http://movemewithcare.com/contact_details.php" /></a></td>
                    <td width="5%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td align="center" class="stext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center"><a href="http://www.movemewithcare.com/mem2.php" class="stext">Become A Member</a> | <a href="http://www.movemewithcare.com/mem2.php" class="stext">Terms Of Service</a> | <a href="http://www.movemewithcare.com/locator/mem.php" class="stext">Member Login</a></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="33" align="center" class="stext" ><span class="theading1">Accredited Associations : </span><a href="http://mybbb.org" class="stext">BBB</a>, <a href="http://moving.org" class="stext">AMSA</a>, <a href="http://hhgfaa.org" class="stext">HHGFAA</a>, <a href="http://iata.org" class="stext">CAD</a>, <a href="http://moving.org" class="stext">AMA</a>, <a href="http://uschamber.com" class="stext">Chamber of Commerce</a>,<a href="http://movemewithcare.com/departmentoftransportation.php" class="stext">USA &amp; Canada agencies</a>, <a href="http://www.movemewithcare.com/realestatelinks.php" class="stext">Real Estate Directory</a>, <a href="http://www.movemewithcare.com/mortgagedirectory.php" class="stext">Mortgage Directory</a>, <a href="http://movemewithcare.com/links/misc_links.php" class="stext">Link to Us Here</a></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left"><table width="96%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><table id="Table_01" width="995" height="40" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="2"><img src="../images/pr_layout_02_line_01.gif" width="2" height="40" alt="" /></td>
                <td width="65"><a href="http://movemewithcare.com/New/New/index_test.php"><img src="../images/pr_layout_02_line_02.gif" alt="" width="65" height="40" border="0" /></a></td>
                <td width="1"><img src="../images/pr_layout_02_line_01.gif" width="1" height="20" alt="" /></td>
                <td width="172"><a href="http://www.movemewithcare.com/loadingunloading/loadingunloading.php"><img src="../images/pr_layout_02_line_03.gif" alt="" width="172" height="40" border="0" /></a></td>
                <td width="1"><img src="../images/pr_layout_02_line_01.gif" width="1" height="20" alt="" /></td>
                <td width="148"><a href="http://www.movemewithcare.com/locator/fullservicemovers.php"><img src="../images/pr_layout_02_line_04.gif" alt="" width="148" height="40" border="0" /></a></td>
                <td width="1"><img src="../images/pr_layout_02_line_01.gif" width="1" height="20" alt="" /></td>
                <td width="149"><a href="http://www.movemewithcare.com/transportation/transportation.php"><img src="../images/pr_layout_02_line_05.gif" alt="" width="149" height="40" border="0" /></a></td>
                <td width="1"><img src="../images/pr_layout_02_line_01.gif" width="1" height="20" alt="" /></td>
                <td width="131"><a href="http://www.movemewithcare.com/storage/storage.php"><img src="../images/pr_layout_02_line_06.gif" alt="" width="131" height="40" border="0" /></a></td>
                <td width="1"><img src="../images/pr_layout_02_line_01.gif" width="1" height="20" alt="" /></td>
                <td width="125"><a href="http://www.movemewithcare.com/packing/packing.php"><img src="../images/pr_layout_02_line_07.png" alt="" width="125" height="40" border="0" /></a></td>
                <td width="1"><img src="../images/pr_layout_02_line_01.gif" width="1" height="20" alt="" /></td>
                <td width="91"><a href="http://www.movemewithcare.com/feedback1.php"><img src="../images/pr_layout_02_line_08.gif" alt="" width="91" height="40" border="0" /></a></td>
                <td width="1"><img src="../images/pr_layout_02_line_01.gif" width="1" height="20" alt="" /></td>
                <td width="102"><a href="http://www.movemewithcare.com/marketplace/marketplace.php"><img src="../images/pr_layout_02_line_09.gif" alt="" width="102" height="40" border="0" /></a></td>
                <td width="10"><img src="../images/pr_layout_02_line_10.gif" width="3" height="40" alt="" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
