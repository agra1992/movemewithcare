<?php
# PHP link manager (Linkman) - admin panel
# Version: 1.03 from April 21, 2006
# File name: index.php
# File last modified: June 23, 2005
# Written 16th July 2004 by Klemen Stirn (info@phpjunkyard.com)
# http://www.PHPJunkYard.com

##############################################################################
# COPYRIGHT NOTICE                                                           #
# Copyright 2004-2006 PHPJunkYard All Rights Reserved.                       #
#                                                                            #
# The Linkman may be used and modified free of charge by anyone so long as   #
# this copyright notice and the comments above remain intact. By using this  #
# code you agree to indemnify Klemen Stirn from any liability that might     #
# arise from it's use.                                                       #
#                                                                            #
# Selling the code for this program without prior written consent is         #
# expressly forbidden. In other words, please ask first before you try and   #
# make money off this program.                                               #
#                                                                            #
# Obtain permission before redistributing this software over the Internet or #
# in any other medium. In all cases copyright and header must remain intact. #
# This Copyright is in full effect in any country that has International     #
# Trade Agreements with the United States of America or with                 #
# the European Union.                                                        #
##############################################################################

#############################
#     DO NOT EDIT BELOW     #
#############################
include "../Security.php";
error_reporting(E_ALL ^ E_NOTICE);
session_start();

require_once 'settings.php';
$action=pj_input($_REQUEST['action']) or $action='';

if ($action == 'login')
	{
    $pass=pj_input($_REQUEST['pass'],'Please enter your admin password');
    $pass=crypt($pass,$settings['filter_sum']);
	checkpassword($pass);
    $_SESSION['loggedin']=$pass;
    mainpage('welcome');
	}
elseif ($action == 'remove')
	{
	$pass=pj_input($_SESSION['loggedin'],'You are not autorized to view this page');
    checkpassword($pass);
    $id=pj_isNumber($_REQUEST['id'],'Please enter a valid ID number (digits 0-9 only)!');
    removelink($id);
	}
elseif ($action == 'check')
	{
	$pass=pj_input($_SESSION['loggedin'],'You are not autorized to view this page');
    checkpassword($pass);
    check();
	}
elseif ($action == 'add')
	{
	$pass=pj_input($_SESSION['loggedin'],'You are not autorized to view this page');
    checkpassword($pass);
    addlink();
	}
elseif ($action == 'main')
	{
	$pass=pj_input($_SESSION['loggedin'],'You are not autorized to view this page');
    checkpassword($pass);
    mainpage();
	}
else {login();}
exit();

// START addlink()
function addlink() {
global $settings;

$name=pj_input($_POST['name'],'Please enter owner\'s name!');
$email=pj_input($_POST['email'],'Please enter owner\'s e-mail address!');
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
	$email="unkown@unkown.com";
}
$title=pj_input($_POST['title'],'Please enter the title (name) of the website!');
$url=pj_input($_POST['url'],'Please enter the URL of the website!');
if (!(preg_match("/(http:\/\/+[\w\-]+\.[\w\-]+)/i",$url))) {
	problem('Please enter valid URL of the website!');
}
$recurl=pj_input($_POST['recurl'],'Please enter the url where a reciprocal link to your site is placed!');
if ($recurl != 'http://nolink' && !(preg_match("/(http:\/\/+[\w\-]+\.[\w\-]+)/i",$recurl))) {
	problem('Please enter valid URL of the page where the reciprocal link to your site is placed!');
}

if ($recurl != 'http://nolink') {
	$html = @file_get_contents($recurl) or problem('Can\'t open remote URL!');
	$html = strtolower($html);
	$site_url =strtolower($settings['site_url']);
	if (!strstr($html,$site_url)) {
	    problem('Your URL (<a href="'.$settings['site_url'].'">'.$settings['site_url'].
	            '</a>) wasn\'t found on the reciprocal links page (<a href="'.$recurl.
	            '">'.$recurl.'</a>)!<br><br>If you don\'t require a reciprocal link
                from this website please set reciprocal URL to <b>http://nolink</b>'
	            );
	}
}

$url=str_replace('&amp;','&',$url);
$recurl=str_replace('&amp;','&',$recurl);

$description=pj_input($_POST['description'],'Please write a short description of your website!');
if (strlen($description)>200) {
	problem('Description is too long! Description of your website is limited to 200 chars!');
}

$lines=@file($settings['linkfile']);
if (count($lines)>$settings['max_links']) {
	problem('You have reached your maximum links limit!');
}

$replacement = "$name$settings[delimiter]$email$settings[delimiter]$title$settings[delimiter]$url$settings[delimiter]$recurl$settings[delimiter]$description\n";

if ($settings['add_to'] == 0) {
	$replacement .= implode('',$lines);
    $fp = fopen($settings['linkfile'],'wb') or problem('Couldn\'t open links file for writing! Please CHMOD all txt files to 666 (rw-rw-rw)!');
	fputs($fp,$replacement);
	fclose($fp);
	}
else {
    $fp = fopen($settings['linkfile'],'ab') or problem('Couldn\'t open links file for appending! Please CHMOD all txt files to 666 (rw-rw-rw)!');
	fputs($fp,$replacement);
	fclose($fp);
    }

done('<font color="#008000"><b>The URL '.$url.' was successfully added to your links page</b></font>');
} // END addlink()

// START check()
function check() {
global $settings;
$lines=array();
$temp =0;
$count = 0;
$sql = "Select URL from links Where 1";
$r = mysql_query($sql) or die('query 111 failed');
    while($result = mysql_fetch_assoc($r))
    {
        $lines[$count] = strtolower($result[URL]);
        $count++;
    }

for ($i =0; $i<$count; $i++)
{
    $pos = strpos("$lines[$i]", "<");
    if($pos === false){
            $pos = strpos("$lines[$i]", "http://");
            if($pos === false)
            {

                 $lines[$i]="http://".$lines[$i];
             }
     }else{
        $temp = explode("\"", $lines[$i]);
        $lines[$i] = $temp[1];

     }

}

$site_url =strtolower($settings['site_url']);


$rewrite=0;
$recurl="http://www.movemewithcare.com";
echo <<<EOC
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<link rel="STYLESHEET" type="text/css" href="style.css">
<title>Checking reciprocal links...</title>
</head>
<body>
EOC;

for($i=1 ;$i<$count; $i++) {
    $thisline = $lines[$i];  
    echo "<p>Checking link N. <b>$i</b>...<br>\n";
    echo "-&gt; Link URL: $thisline<br>\n";
    	if ($recurl == 'http://nolink')
        {
        	echo '<font color="#008000">No reciprocal link required!</font><br><br>';
            echo '- - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>';
            $i++;
 			flush();
            continue;
        }
        else
        {
        	echo "-&gt; Reciprocal URL: $recurl<br>\n";
        }
	echo '-&gt; Opening and reading reciprocal URL ';

    $html = @file_get_contents($thisline) or $html='NO';

    if ($html == 'NO')
    {
        if (empty($_POST['docantopen']))
        {
            echo '<br><font color="#FF6600">CAN\'T OPEN RECIPROCAL URL!</font><br><br>Owner (click on name for e-mail): <a href="mailto:'.$email.'">'.$name.'</a><br>';
        }
        else
        {
            echo '<br><font color="#FF0000">CAN\'T OPEN RECIPROCAL URL!</font><br><br>Removing link ...<br>';
            unset($lines[$i-1]);
            $rewrite=1;
        }
    }
    else
    {
        $html=strtolower($html);
        if (strstr($html,$recurl))
        {
            echo '<br><font color="#008000">A link to $thisline was found!</font><br><br>';
        }
        else
        {
            echo '<br><font color="#FF0000">LINK NOT FOUND! <br>$thisline';
        }

    }
    $i++;
    echo '- - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>';
    flush();
}

if ($rewrite == 1)
	{
	$lines = implode('',$lines);
    $fp = fopen($settings['linkfile'],'wb') or problem('Couldn\'t open links file for writing! Please CHMOD all txt files to 666 (rw-rw-rw)!');
	fputs($fp,$lines);
	fclose($fp);
	}

echo <<<EOC
<p>&nbsp;</p>
<p><b>DONE!</b></p>
<p><a href="index.php?action=main">Back to main page</a></p>
</body>
</html>
EOC;

exit();
}
// END check()

// START removelink()
function removelink($i) {
global $settings;
$lines=array();
$lines=file($settings['linkfile']);
unset($lines[$i]);
$lines = implode('',$lines);

$fp = fopen($settings['linkfile'],'wb') or problem('Can\'t write to link file! Please Change the file permissions (CHMOD to 666 on UNIX machines!)');
fputs($fp,$lines);
fclose($fp);

done('<font color="#008000"><b>The selected link was successfully removed!</b></font>');
}
// END removelink()

// START mainpage()
function mainpage($notice='') {
global $settings;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<link rel="STYLESHEET" type="text/css" href="style.css">
<title>PHP Link manager admin panel</title>
<script language="Javascript" type="text/javascript"><!--
function doconfirm(message) {
	if (confirm(message)) {return true;}
    else {return false;}
}
//-->
</script>
</head>
<body>
<div align="center"><center>
<table border="0" width="700" cellpadding="5">
<tr>
<td align="center" class="glava"><font class="header">PHP Link manager <?php echo($settings['verzija']); ?><br>-- Admin panel --</font></td>
</tr>
<tr>
<td class="vmes">
<?php
if ($notice)
{
    echo '<p align="center"><font color="#008000"><b>Welcome to admin panel!</b></font></p>';
}

echo '<hr>';

$lines=array();
$lines=file($settings['linkfile']);

if (count($lines)==0)
{
	echo '<p>You don\'t have any links yet.</p>';
}
else
{
	echo '<table border="0">';
    $i=0;
	foreach ($lines as $thisline)
	{
	    $thisline=trim($thisline);
	    if (!empty($thisline)) {
	        list($name,$email,$title,$url,$recurl,$description)=explode($settings['delimiter'],$thisline);
	        echo '<tr>
	        <td valign="top"><a href="index.php?action=remove&id='.$i.'" onclick="return doconfirm(\'Are you sure you want to remove this link? This cannot be undone!\');"><img src="delete.gif" height="14" width="16" border="0" alt="Remove this link"></a></td>
	        <td valign="top"><a href="'.$url.'" target="_blank">'.$title.'</a> - '.$description.'</td>
	        </tr>';
	        $i++;
	    }
	}
    echo '</table>
	<p>You can remove links  by clicking the <img src="delete.gif" height="14" width="16" border="0"> button.</p>
	';
}
?>
<hr>
<form action="index.php" method="POST">
<p><b>Check reciprocal links</b></p>
<p>Click the below button and the script will check all submitted links to
see if your reciprocal link is still there. If the reciprocal link is not on the
reciprocal links page, submitted link will be removed!</p>
<p><b>-&gt; What to do if the reciprocal link is NOT found:</b></p>
<ul>
<input type="radio" name="dowhat" value="1"> Delete the link<br>
<input type="radio" name="dowhat" value="0" checked> Don't delete link and show contact information
</ul>
<p><b>-&gt; What to do if the reciprocal URL can't be opened (is not available):</b></p>
<ul>
<input type="radio" name="docantopen" value="1"> Delete the link<br>
<input type="radio" name="docantopen" value="0" checked> Don't delete link and show contact information
</ul>
<p><b>-&gt; This can take a while, please be patient!</b>
<input type="hidden" name="action" value="check"></p>
<p><input type="submit" value=" Check links "></p>
</form>
<hr>
<form action="index.php" method="POST">
<p><b>Add a link</b></p>
<p>Here you can manually add links to your links.php. LinkMan <b>will NOT</b>
check for reciprocal links if you submit using this form!</p>
<p>If you don't require a reciprocal link from this website please type
&quot;<b>http://nolink</b>&quot; (without the quotes) into the Reciprocal URL field!
<input type="hidden" name="action" value="add"></p>
<table border="0">
<tr>
<td><b>Owner name:</b></td>
<td><input type="text" name="name" maxlength="50"></td>
</tr>
<tr>
<td><b>Owner e-mail:</b></td>
<td><input type="text" name="email" maxlength="50"></td>
</tr>
<tr>
<td><b>Website title:</b></td>
<td><input type="text" name="title" maxlength="50"></td>
</tr>
<tr>
<td><b>Website URL:<b></td>
<td><input type="text" name="url" maxlength="100" value="http://" size="40"></td>
</tr>
<tr>
<td><b>URL with reciprocal link:</b></td>
<td><input type="text" name="recurl" maxlength="100" value="http://" size="40"></td>
</tr>
</table>

<p><b>Website description:</b><br>
<input type="text" name="description" maxlength="200" size="50"></p>

<p><input type="submit" value=" Add this link "></p>
</form>
<hr>
<p><b>Rate this script</b></p>
<p>If you like this script please rate it or even write a review at:</p>

<p><a href="http://www.hotscripts.com/Detailed/36875.html" target="_blank">Rate
this Script @ Hot Scripts</a></p>

<p><a href="http://php.resourceindex.com/detail/05361.html" target="_blank">Rate
this Script @ PHP Resource index</a></p>

<hr>
<p><b>Stay updated</b></p>
<p>Join my FREE newsletter and you will be notified about new scripts, new versions of the existing scripts
and other important news from PHPJunkYard.<br>
<a href="http://www.phpjunkyard.com/newsletter.php"
target="_blank">Click here for more info</a></p>
<hr>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<!--
Changing the "Powered by" credit sentence without purchasing a licence is illegal!
Please visit http://www.phpjunkyard.com/copyright-removal.php for more information.
-->
<td align="center" class="copyright">Powered by <a href="http://www.phpjunkyard.com/php-link-manager.php" target="_blank">PHP Link manager</a> <?php echo($settings['verzija']); ?><br>
(c) Copyright 2004-2006 <a href="http://www.phpjunkyard.com/" target="_blank">PHPjunkyard - Free PHP scripts</a></td>
</tr>
</table>
</div></center>
</body>
</html>
<?php
exit();
}
// END mainpage()

// START checkpassword()
function checkpassword($thepass) {
global $settings;
	if ($thepass != crypt($settings['apass'],$settings['filter_sum']))
    {
    	problem('Wrong password!');
    }

}
// END checkpassword()

// START login()
function login() {
global $settings;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<link rel="STYLESHEET" type="text/css" href="style.css">
<title>PHP Link manager admin panel</title>
</head>
<body>
<div align="center"><center>
<table border="0" width="700">
<tr>
<td align="center" class="glava"><font class="header">PHP Link manager <?php echo($settings['verzija']); ?><br>-- Admin panel --</font></td>
</tr>
<tr>
<td class="vmes"><p>&nbsp;</p>
<div align="center"><center>
<table width="400"> <tr>
<td align="center" class="head">Enter admin panel</td>
</tr>
<tr>
<td align="center" class="dol"><form method="POST" action="index.php"><p>&nbsp;<br><b>Please type in your admin password</b><br><br>
<input type="password" name="pass" size="20"><input type="hidden" name="action" value="login"></p>
<p><input type="submit" name="enter" value="Enter admin panel"></p>
</form>
</td>
</tr> </table>
</div></center>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<!--
Changing the "Powered by" credit sentence without purchasing a licence is illegal!
Please visit http://www.phpjunkyard.com/copyright-removal.php for more information.
-->
<td align="center" class="copyright">Powered by <a href="http://www.phpjunkyard.com/php-link-manager.php" target="_blank">PHP Link manager</a> <?php echo($settings['verzija']); ?><br>
(c) Copyright 2004-2006 <a href="http://www.phpjunkyard.com/" target="_blank">PHPjunkyard - Free PHP scripts</a></td>
</tr>
</table>
</div></center>
</body>
</html>
<?php
exit();
}
// END login()

// START problem()
function problem($myproblem) {
global $settings;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<link rel="STYLESHEET" type="text/css" href="style.css">
<title>PHP Link manager admin panel</title>
</head>
<body>
<div align="center"><center>
<table border="0" width="700">
<tr>
<td align="center" class="glava"><font class="header">PHP Link manager <?php echo($settings['verzija']); ?><br>-- Admin panel --</font></td>
</tr>
<tr>
<td class="vmes"><p>&nbsp;</p>
<div align="center"><center>
<table width="400"> <tr>
<td align="center" class="head">ERROR</td>
</tr>
<tr>
<td align="center" class="dol">
<form>
<p>&nbsp;</p>
<p><b>An error occured:</b></p>
<p><?php echo($myproblem); ?></p>
<p>&nbsp;</p>
<p><a href="javascript:history.go(-1)">Back to the previous page</a></p>
<p>&nbsp;</p>
</form>
</td>
</tr> </table>
</div></center>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<!--
Changing the "Powered by" credit sentence without purchasing a licence is illegal!
Please visit http://www.phpjunkyard.com/copyright-removal.php for more information.
-->
<td align="center" class="copyright">Powered by <a href="http://www.phpjunkyard.com/php-link-manager.php" target="_blank">PHP Link manager</a> <?php echo($settings['verzija']); ?><br>
(c) Copyright 2004-2006 <a href="http://www.phpjunkyard.com/" target="_blank">PHPjunkyard - Free PHP scripts</a></td>
</tr>
</table>
</div></center>
</body>
</html>
<?php
exit();
}
// END problem()

// START done()
function done($message) {
global $settings;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<link rel="STYLESHEET" type="text/css" href="style.css">
<title>PHP Link manager admin panel</title>
</head>
<body>
<div align="center"><center>
<table border="0" width="700">
<tr>
<td align="center" class="glava"><font class="header">PHP Link manager <?php echo($settings['verzija']); ?><br>-- Admin panel --</font></td>
</tr>
<tr>
<td class="vmes"><p>&nbsp;</p>
<div align="center"><center>
<table width="400"> <tr>
<td align="center" class="head">&nbsp;</td>
</tr>
<tr>
<td align="center" class="dol">
<form>
<p>&nbsp;</p>
<p><?php echo($message); ?></p>
<p>&nbsp;</p>
<p><a href="index.php?action=main">Click to continue</a></p>
<p>&nbsp;</p>
</form>
</td>
</tr> </table>
</div></center>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<!--
Changing the "Powered by" credit sentence without purchasing a licence is illegal!
Please visit http://www.phpjunkyard.com/copyright-removal.php for more information.
-->
<td align="center" class="copyright">Powered by <a href="http://www.phpjunkyard.com/php-link-manager.php" target="_blank">PHP Link manager</a> <?php echo($settings['verzija']); ?><br>
(c) Copyright 2004-2006 <a href="http://www.phpjunkyard.com/" target="_blank">PHPjunkyard - Free PHP scripts</a></td>
</tr>
</table>
</div></center>
</body>
</html>
<?php
exit();
}
// END done()

?>