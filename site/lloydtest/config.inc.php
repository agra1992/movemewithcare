<?php

$CN_TEMPLATE = 'templ1.htm';
$CN_SUFFIX = ' -- Move Me With Care.com';
$CN_DEBUG = FALSE;
$CN_SERVER_NAME = 'www.movemewithcare.com';
$CN_TITLE= 'A network of top accredited moving companies for USA/CANADA';

$db_host = "localhost";
$db_user = "movemewi_movemew";
$db_password = "withcare";
$db_name = "movemewi_lloydtestmmwc";
$db_locator_name = "movemewi_lloydtestmmwc";

$cs_laborer_cost = 250;
$CN_FULL_PRICE = "<s>$250</s> <font color=\"#FF0000\">$100</font>/month special price";
$cs_labor[1]=195;
$cs_labor[2]=260;
$cs_labor[3]=310;
$cs_labor[4]=375;
$cs_labor[5]=520;
$cs_additional[1]=50;
$cs_additional[2]=80;
$cs_additional[3]=95;
$cs_additional[4]=105;
$cs_additional[5]=120;

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");

?>