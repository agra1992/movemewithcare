<?php
// SETUP YOUR LINK MANAGER
// Detailed information found in the readme.htm file
// File last modified: April 21 2006 (LinkMan v. 1.03)

// Password for admin area
$settings['apass']='proaceinternational';

// Your website URL
$settings['site_url']='http://www.movemewithcare.com';

/* Prevent automated submissions (recommended YES)? 1 = YES, 0 = NO */
$settings['autosubmit']=1;

/* Checksum - just type some digits and chars. Used to help prevent SPAM */
$settings['filter_sum']='545g4qwg7';

// Send you an e-mail everytime someone adds a link? 1=YES, 0=NO
$settings['notify']=0;

// Admin e-mail
$settings['admin_email']='admin@movemewithcare.com';

// Maximum number of links
$settings['max_links']=500;

// Use "clean" URLs or redirects? 1=clean, 0=redirects
$settings['clean']=1;

// Where to add new links? 0 = top of list, 1 = end of list
$settings['add_to']=1;

// Name of the file where link URLs and other info is stored
$settings['linkfile']='linkinfo.txt';



/*******************
* DO NOT EDIT BELOW
*******************/

$settings['verzija']='1.03';
$settings['delimiter']="\t";

function pj_input($in,$error=0) {
	$in = trim($in);
    if (strlen($in))
    {
        $in = htmlspecialchars($in);
    }
    elseif ($error)
    {
    	$in = "";
    }
    return stripslashes($in);
}

function pj_isNumber($in,$error=0) {
	$in = trim($in);
	if (preg_match("/\D/",$in) || $in=='')
    {
    	if ($error)
        {
        	problem($error);
        }
        else
        {
        	return '0';
        }
    }
    return $in;
}
?>