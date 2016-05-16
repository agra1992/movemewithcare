<html><body><div id='main'>
<?
require ('../config.inc.php');

include "../top_panel.php";
$page=0;
if(isset($_GET[page]))
{
$page= $_GET[page];
}

$start = $page*24;

$count=0;
$sql_total = "SELECT count(*) FROM links where Type='misc' AND Active='1'";
$r = mysql_query($sql_total);
$total = mysql_fetch_array($r);


$sql="SELECT `URL` FROM links WHERE  Type='misc' AND Active='1' Limit $start, 24";
$r=mysql_query($sql);
echo"<table><tr>";
while($result=mysql_fetch_row($r))
{
    if($count%4 ==0){
        echo"</tr><tr>";
    }
    echo"<td>".$result[0]."</td>";
$count++;
}




echo "</tr><tr><td> Page:";

$pages =  $total[0]/24;

for($i =0; $i<$pages; $i++)
{
   $output = $i+1;
   echo"   <a href=/links/misc_links.php?page=$i>$output</a>";
}

echo"</td></tr></table>";

require "bottom_panel.php";
?>
</div></body></html>