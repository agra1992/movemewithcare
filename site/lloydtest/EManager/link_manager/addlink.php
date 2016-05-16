<?php
# PHP link manager (Linkman)
# Version: 1.03 from April 21, 2006
# File name: addlink.php
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

require_once('settings.php');
/* Check user input */
$name=pj_input($_POST['name'],'Please enter your name!');
$email=pj_input($_POST['email'],'Please enter your e-mail address!');

$title=pj_input($_POST['title'],'Please enter the title (name) of your website!');
$url=pj_input($_POST['url'],'Please enter the URL of your website!');
if (!(preg_match("/(http:\/\/+[\w\-]+\.[\w\-]+)/i",$url))) {
	problem('Please enter valid URL of your website!');
}
$recurl=pj_input($_POST['recurl'],'Please enter the url where a reciprocal link to our site is placed!');
if (!(preg_match("/(http:\/\/+[\w\-]+\.[\w\-]+)/i",$recurl))) {
	problem('Please enter valid URL of the page where the reciprocal link to our site is placed!');
}

/* Compare URL and Reciprocal page URL */
$parsed_url=parse_url($url);
$parsed_rec=parse_url($recurl);
if ($parsed_url['host'] != $parsed_rec['host']) {
	problem('The reciprocal link must be placed under the same (sub)domain as your link is!');
}

$url=str_replace('&amp;','&',$url);
$recurl=str_replace('&amp;','&',$recurl);

$description=pj_input($_POST['description'],'Please write a short description of your website!');
if (strlen($description)>200) {
	problem('Description is too long! Description of your website is limited to 200 chars!');
}

if ($settings['autosubmit']) {
	session_start();

    if (empty($_SESSION['checked'])) {
	    $_SESSION['checked']='N';
	    $_SESSION['secnum']=rand(10000,99999);
	    $_SESSION['checksum']=$_SESSION['secnum'].$settings['filter_sum'].date('dmy');
    }
    if ($_SESSION['checked'] == 'N')
    {
        print_secimg();
    }
    elseif ($_SESSION['checked'] == $settings['filter_sum'])
    {
        $_SESSION['checked'] = 'N';
        $secnumber=pj_isNumber($_POST['secnumber']);
        if(empty($secnumber))
        {
        	print_secimg(1);
        }
        if (!check_secnum($secnumber,$_SESSION['checksum']))
        {
        	print_secimg(2);
        }
    }
    else
    {
    	problem('Internal script error. Wrong session parameters!');
    }
}

$html = @file_get_contents($recurl) or problem('Can\'t open remote URL!');
$html = strtolower($html);
$site_url =strtolower($settings['site_url']);

if (!strstr($html,$site_url)) {
	problem('Our URL (<a href="'.$settings['site_url'].'">'.$settings['site_url'].
    		'</a>) wasn\'t found on your reciprocal links page (<a href="'.$recurl.
            '">'.$recurl.'</a>)!<br><br>Please make sure you place this exact URL
            on your page before adding your link!'
            );
}

$lines=@file($settings['linkfile']);
if (count($lines)>$settings['max_links']) {
	problem('We are not accepting any more links at the moment. We appologize for the inconvenience!');
}

$replacement = "$name$settings[delimiter]$email$settings[delimiter]$title$settings[delimiter]$url$settings[delimiter]$recurl$settings[delimiter]$description\n";

if ($settings['add_to'] == 0) {
    $fp = fopen($settings['linkfile'],'rb');
	$links = @fread($fp,filesize($settings['linkfile']));
	fclose($fp);

	$replacement .= $links;

    $fp = fopen($settings['linkfile'],'wb') or problem('Couldn\'t open links file for writing! Please CHMOD all txt files to 666 (rw-rw-rw)!');
	fputs($fp,$replacement);
	fclose($fp);
	}
else {
    $fp = fopen($settings['linkfile'],'ab') or problem('Couldn\'t open links file for appending! Please CHMOD all txt files to 666 (rw-rw-rw)!');
	fputs($fp,$replacement);
	fclose($fp);
    }

if($settings['notify'] == 1) {
$message="Hello,

Someone just added a new link to your links page on $settings[site_url]

Link details:

Name: $name
E-mail: $email
URL: $url
Reciprocal link: $recurl
Title: $title
Description:
$description


End of message

";
$headers = "From: $name <$email>\n";
$headers .= "Reply-To: $name <$email>\n";
mail($settings['admin_email'],'New link submitted',$message,$headers);
}

require_once('header.txt');
?>
<p align="center"><b>Your link has been added!</b></p>
<p>&nbsp;</p>
<p align="center">Thank you, your link has been successfully added to our link exchange (try reloading our links page if you don't see your link there yet)!</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center"><a href="<?php echo $settings['site_url']; ?>">Back to the main page</a></p>
<?
require_once('footer.txt');
exit();

function problem($problem) {
require_once('header.txt');
echo '
	<p align="center"><font color="#FF0000"><b>ERROR</b></font></p>
	<p>&nbsp;</p>
	<p align="center">'.$problem.'</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p align="center"><a href="javascript:history.go(-1)">Back to the previous page</a></p>
';
require_once('footer.txt');
exit();
}

function print_secimg($message=0) {
global $settings;
$_SESSION['checked']=$settings['filter_sum'];
require_once('header.txt');
?>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p align="center"><b>Anti-SPAM check</b></p>
<div align="center"><center>
<table border="0"><tr>
<td>
<hr>
<form method=post action="addlink.php?<?php echo strip_tags(SID); ?>" method="POST" name="form">
<?php
if ($message == 1) {echo '<p align="center"><font color="#FF0000"><b>Please type in the security number</b></font></p>';}
elseif ($message == 2) {echo '<p align="center"><font color="#FF0000"><b>Wrong security number. Please try again</b></font></p>';}
?>
<p>&nbsp;</p>
<p>This is a security check that prevents automated signups of this forum (SPAM).
Please enter the security number displayed below into the input field and click
the continue button.</p>
<p>&nbsp;</p>
<p>Security number: <b><?php echo $_SESSION['secnum']; ?></b><br>
Please type in the security number displayed above:
<input type="text" size="7" name="secnumber" maxlength="5"></p>
<p>&nbsp;
<?php
foreach ($_POST as $k=>$v) {
	if ($k == 'secnumber') {continue;}
	echo '<input type="hidden" name="'.htmlspecialchars($k).'" value="'.htmlspecialchars(stripslashes($v)).'">';
}
?>
</p>
<p align="center"><input type="submit" value=" Continue "></p>
<hr>
<p align="center">
<!--
Changing the "Powered by" credit sentence without purchasing a licence is illegal!
Please visit http://www.phpjunkyard.com/copyright-removal.php for more information.
-->
Powered by <a href="http://www.phpjunkyard.com/php-link-manager.php" target="_blank">PHP Link manager</a> <?php echo($settings['verzija']); ?>
 from <a href="http://www.phpjunkyard.com/" target="_blank">PHPjunkyard - Free PHP scripts</a>
</p>
</form>
</td>
</tr>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
require_once('footer.txt');
exit();
}

function check_secnum($secnumber,$checksum) {
global $settings;
$secnumber.=$settings['filter_sum'].date('dmy');
    if ($secnumber == $checksum)
    {
        unset($_SESSION['checked']);
        return true;
    }
    else
    {
        return false;
    }
}

?>