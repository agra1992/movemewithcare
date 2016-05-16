<?php
require("../config.inc.php");
require("sanitize.php");
//print_r($HTTP_POST_VARS);
?>
<?php
// In this case we need only table of contents from website database
// cause everything else is generated in this script
// so don't forget to switch databases and starting work

require("contents.php");

?>
<?php

//print_r ($HTTP_POST_VARS);
$or_city = sanitize($_POST[or_city],20,0);
$dest_city = sanitize($_POST[dest_city],20,0);
$dest_state = sanitize($_POST[dest_state],20,0);
$fname = sanitize($_POST[fname],20,0);
$next = sanitize($_POST[next],5,1);
$next2 = sanitize($_POST[next2],5,1);
$next3 = sanitize($_POST[next3],5,1);
$transport = sanitize($_POST[transport],5,1);
$samecity = sanitize($_POST[samecity],5,1);
if (!($or_city) and !($dest_state) and !($fname) and !($next)) require ("inc/fs_1.php");
if (($or_city) and !($dest_state) and !($fname) and !($next)) require ("inc/fs_1.php");
if (($or_city) and !($dest_state) and !($fname) and ($next)) require ("inc/fs_2.php");
if (($or_city) and ($dest_state) and !($fname) and !($next)) require ("inc/fs_2.php");
if (($or_city) and ($dest_state) and !($fname) and ($next)) require ("inc/fs_3.php");
if (($or_city) and ($dest_state) and ($fname)) require ("inc/fs_4.php");
?>