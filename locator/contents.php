<?php

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");

$sql = 'SELECT `handle`, `title` FROM `content` WHERE 1 LIMIT 0, 30 '; 

$result = mysql_query($sql) or die("Query failed");

$contents = "<br><br>";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

$contents .= "<a href=\"http://$CN_SERVER_NAME?$line[handle]\">$line[title]</a><br><br>";

}

echo $contents;


?>

