<title>View profile</title>
<?php

require("../config.inc.php");
require("sanitize.php");

$id = sanitize($_GET[id],10,1);

$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

echo ("<table width=\"80%\" border=\"1\" align=\"center\" bordercolordark=\"#FFFFFF\" bordercolorlight=\"#0066FF\">");

$query = "SELECT * FROM `fullservice` WHERE `id`=$id";

$result = mysql_query($query) or die("Query failed");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

echo("<tr>
<td colspan=2 align=center><b>$line[name]</b></td>
</tr>
<tr>
<td colspan=2>$line[description]</td>
</tr>
<tr>
<td>Phone:</td>
<td>$line[phone]</td>
</tr>
<tr>
<td>Phone:</td>
<td>$line[fax]</td>
</tr>
<tr>
<td>Toll free phone</td>
<td>$line[tollfree]</td>
</tr>
<tr>
<td>Address:</td>
<td>$line[address]</td>
</tr>
<tr>
<td>License</td>
<td>$line[license]</td>
</tr>
</table>");

?>