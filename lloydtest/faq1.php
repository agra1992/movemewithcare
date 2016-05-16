<?php
error_reporting(0);
require "top_panel.php";
////////////////////////////////////////////////////////////////////////
// Main module of ProAqua CMS engine
// (C) Egor S. "Hashish" Emeliyanov, 2005
// Version 0.5dev
////////////////////////////////////////////////////////////////////////
 require_once ('seo.php');
require ('config.inc.php');


//$topic = $argv[0]; // attempting to get article handle

// sanitation of variables
//$argv[0] = sanitize($argv[0],10,1);
$argv[0]="faq";

//echo $topic;
// switch to 'main' if handle is not specified
  if (trim($argv[0])=='') {
	$hdr = "Location: http://$CN_SERVER_NAME/parth/?main";
	header($hdr);
	die;
		}

// working with database: connecting and getting content
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");
$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 5';
$result = mysql_query($sql) or die("Query failed_BBB");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
echo "<center><p>" . nl2br($line[Detail]) . "</center>";

// 404 implementation
/*
$sql = "SELECT `longtitle` FROM `content` WHERE `handle`='$argv[0]'"; 
$result = mysql_query($sql) or die("Query failed");
if (mysql_affected_rows==0) {
	header("404 Not found");
	die;
	} */

/*$sql = 'SELECT `handle`, `title`, `longtitle` FROM `content` WHERE NOT (`hidden` = 1) LIMIT 0, 30 '; 

$result = mysql_query($sql) or die("Query failed");

$contents = "<br><br>";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
// getting $contents
$contents .= "<a href=\"?$line[handle]\" title=\"$line[longtitle]\">$line[title]</a><br><br>";

}

// getting $template
$template = GetFileContents($CN_TEMPLATE);

// getting $keywords
$keywords = GetFileContents("keywords");

// getting $description
$description = GetFileContents("description");

// setting apropriate bookmarks
$bookmarks = "<a href=\"https://locator.movinguwithcare.com/?fs\"><img src=\"PICS/fs_n.gif\" width=\"157\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?lupu\"><img src=\"PICS/load_n.gif\" width=\"159\" height=\"29\" border=0></a><a href=\"https://locator.movinguwithcare.com/?trans\"><img src=\"PICS/trans_n.gif\" width=\"185\" height=\"29\" border=0>";

// getting $text
$sql = "SELECT `content` FROM `content` WHERE `handle`='$argv[0]'"; 

$result = mysql_query($sql) or die("Query failed");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$text .= $line[content];

// getting page title

$sql = "SELECT `longtitle` FROM `content` WHERE `handle`='$argv[0]'"; 

$result = mysql_query($sql) or die("Query failed");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$title = $line[longtitle];

// getting page bottom text ($bottomtext)
$bottomtext = GetFileContents("bottomtext");


/*$trans = array (
"%title%" => $title . " " . $CN_SUFFIX ,
"%keywords%" => $keywords,
"%description%" => $description,
"%contents%" => $contents,
"%bottomtext%" => $bottomtext,
"%text%" => $text,
"%bookmarks%" => $bookmarks);
*/
//$template = strtr($template, $trans);

//echo $template;
//echo $text; 
?>

			</div>
	   	</div>



<div id="bottom" class="white_links">
<div align="center"><a href="index.php">HOME</a> | <a href="loadingunloading/loadingunloading.php">LOADING/UNLOADING ASSISTANCE</a> | <a href="locator/fullservicemovers.php">FULL SERVICE MOVERS</a> | <a href="transportation/transportation.php">TRANSPORTATION PROVIDERS</a> | <a href="storage/storage.php">STORAGE FACILITIES</a> | <a href="packing/packing.php">PACKING SUPPLIES</a></div>
<br />
<div align="center" class="white_links"><span class="style13"><a href="index.php"><img src="images/icon_flag_usa.gif" border="0" /> </a> | <a href="index.php"><img src="images/icon_flag_canada.gif" border="0" /></a></span></div>
</div>
<div id="copy" align="center" class="style1">&copy; MovingUWithCare Registered, 2006. All Rights Reserved. </div>
</div>
<div id="loaderContainer">
</div>

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