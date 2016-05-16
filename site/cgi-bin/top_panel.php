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

<body onload="MM_preloadImages('images2/MAIN_19_1.jpg')"><div id="main">

<table id="Table_01" width="858" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td rowspan="6">&nbsp;
	  </td>
		<td colspan="3" rowspan="5">
			<a href="/index.php"><img src="/images2/movinguwithcare.jpg" width="303" height="68" alt="MovingUwithCare.com - Best nationwide moving companies - packing unloading services" border="0"/></a>
	  </td>
		<td colspan="3" rowspan="4"><font color='#F79A30' face='Arial' size='1'>Proudly donating to:</font><br/><a href='http://www.thebreastcancersite.com/clickToGive/home.faces?siteId=2'><img src="/images/breast_cancer.gif" width="120" height="53" alt="" align="top" border="0"/></a>
      </td>
		<td rowspan="4">&nbsp;
	  </td>
		<td rowspan="4"  colspan="1">
			<img src="/images2/MAIN_05.jpg" width="16" height="47" alt="" align="top"/></td>
		<td colspan="10" align="left" >
			<img src="/images2/MAIN_06.jpg" width="334" height="29" alt=""/></td>
		<td rowspan="6">&nbsp;
	  </td>
		<td>
			<img src="/images2/spacer.gif" width="1" height="29" alt=""/></td>
	</tr>
	<tr>
		<td colspan="10" style="position:relative;bottom:12px;">
			<img src="/images2/MAIN_08.jpg" width="334" height="2" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="1" height="2" alt=""/></td>
	</tr>

	<?
	  if (@$_SESSION['browser'] != "Mozilla")
	  { 
	?>
	<tr>
		<td colspan="10" rowspan="2" valign="top">
			<div align="center"> <!-- <font face="Tahoma" color="#29A4DE" style="font-size: 7pt"> -->
           <a href="/mem2.php"><img src="/images/becomeamember.gif" width="80" height="8" alt="Become a member" border="0" /></a>
		    <img src="/images/divblue1.gif" width="8" height="8" border="0" alt=""/>
			<a href="/tos.php"><img src="/images/TERMS.jpg" border="0" alt=""/></a>
			&nbsp;<img src="/images/divblue1.gif" width="8" height="8" border="0" alt=""/>
			<a href="/locator/mem.php"><img src="/images/memberlog.gif" border="0" alt=""/></a>
			<!--<img src="/images/divblue1.gif" width="8" height="8" border="0" />
			<a href="contact_details.php"><img src="/images/customrlog.gif" border="0"/></a>-->
			</div>
	</td>
		<td>
			<img src="/images2/spacer.gif" width="1" height="3" alt=""/></td>
	</tr>
	<?
	 }
	 else
	 {
	 ?>
	 <tr>
		<td colspan="10" rowspan="2" valign="top">
			<div align="center"><br />
<a href="/mem2.php"><img src="/images/becomeamember.gif" width="80" height="8" alt="Become a member" border="0" align="top"/></a>
			 <img src="/images/divblue1.gif" width="8" height="8" border="0" align="top"/> 
			<a href="/tos.php"><img src="/images/TERMS.jpg" border="0" align="top"/></a>
			&nbsp;<img src="/images/divblue1.gif" width="8" height="8" border="0" align="top"/> 
			<a href="/locator/mem.php"><img src="/images/memberlog.gif" border="0" align="top"/></a>
			<!--<img src="/images/divblue1.gif" width="8" height="8" border="0" align="top"/>-->
			</div>			
		</td>
		<td>
			<img src="/images2/spacer.gif" width="1" height="3" alt="" align="top"/></td>
	</tr>
	<?
	 }
	?>

	<tr>

		<td>
			<img src="/images2/spacer.gif" width="1" height="13" alt=""/></td><td></td>
	</tr>

	<tr>

		<td colspan="15" rowspan="1" style='font-size:11px;'>
			<span style='color:red; text-decoration:underline;'>Accredited Associations:</span><? echo"$accred_assoc";?></td>




	</tr>
	<tr>
		<td colspan="3">&nbsp;
	  </td>
		<td>
			<img src="/images2/spacer.gif" width="1" height="22" alt=""/></td><td colspan='14' align='right' style='font-weight:bold;text-decoration: underline;font-size:11px;'>All of our movers are members of one of these associations above</td>
	</tr>
	<tr>
		<td colspan="2" valign='top'><a href="/index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image50','','images2/MAIN_19_1.jpg',1)"><img src="images2/MAIN_19.jpg" name="Image50" width="60" height="22" border="0" id="Image50" /></a></td>
		<td valign='top'>
			<a href="/loadingunloading/loadingunloading.php"><img src="/images2/MAIN_20.jpg" width="152" height="22" alt="" border="0"/></a></td>
		<td colspan="2" valign='top'>
			<a href="/locator/fullservicemovers.php"><img src="/images2/MAIN_21.jpg" width="122" height="22" alt="" border="0"/></a></td>
		<td valign='top'>
			<a href="/transportation/transportation.php"><img src="/images2/MAIN_22.jpg" width="122" height="22" alt="" border="0"/></a></td>
		<td colspan="6" valign='top'>
			<a href="/storage/storage.php"><img src="/images2/MAIN_23.jpg" width="114" height="22" alt="" border="0"/></a></td>
		<td colspan="3"valign='top'>
			<a href="/packing/packing.php"><img src="/images2/MAIN_24.jpg" width="107" height="22" alt="" border="0"/></a></td>
		<td colspan="2" valign='top'>
			<a href="/feedback1.php"><img src="/images2/MAIN_25.jpg" width="83" height="22" alt="" border="0"/></a></td>
		<td colspan="2" valign='top'>
                        <a href="/marketplace/marketplace.php"><img src="/images2/MAIN_26.jpg"  width="97" height="22" alt="" border="0"/></a>
	  </td>
		<td>
			<img src="/images2/spacer.gif" width="1" height="22" alt=""/></td>
	</tr>
	<tr>
		<td>
			<img src="/images2/spacer.gif" width="28" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="32" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="152" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="119" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="3" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="122" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="3" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="39" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="16" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="37" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="9" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="10" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="78" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="14" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="15" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="76" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="7" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="9" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="79" height="1" alt=""/></td>
		<td>
			<img src="/images2/spacer.gif" width="9" height="1" alt=""/></td>
		<td></td>
	</tr>
</table>