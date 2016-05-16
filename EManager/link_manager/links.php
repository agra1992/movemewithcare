<?php

# PHP link manager (Linkman)
# Version: 1.03 from April 21, 2006
# File name: links.php
# File last modified: July 16, 2005
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

require 'settings.php';
require_once('header.txt');

$lines = array ();
$lines=file($settings['linkfile']);

echo '<p class="linkman">';

foreach ($lines as $thisline)
{
	$thisline=trim($thisline);
    if (!empty($thisline)) {
	    list($name,$email,$title,$url,$recurl,$description)=explode($settings['delimiter'],$thisline);
	    if ($settings['clean'] != 1) {$url='go.php?url='.$url;}
	    echo '<a href="'.$url.'" target="_blank" class="linkman">'.$title.'</a> - '.$description.'<br>';
    }
}

/*
*** IMPORTANT ***
CHANGING OR REMOVING THE "POWERED BY" CREDIT LINE WITHOUT PURCHASING A LICENSE
IS A DIRECT VIOLATION OF PHPJUNKYARD COPYRIGHTS AND THEREFOR ILLEGAL. FOR MORE
INFORMATION ON REMOVING THE CREDIT LINE AND PURCHASING A LICENSE PLEASE VISIT
http://www.phpjunkyard.com/copyright-removal.php
*/

echo '
</p>
<hr size=1 noshade>
<p align="center" class="linkman">Powered by <a href="http://www.phpjunkyard.com/php-link-manager.php" target="_blank" class="linkman">Link manager LinkMan</a> '.$settings['verzija'].' from <a href="http://www.phpjunkyard.com/" target="_new" class="linkman">PHPJunkYard - free php scripts</a></p>
';
require_once('footer.txt');
?>