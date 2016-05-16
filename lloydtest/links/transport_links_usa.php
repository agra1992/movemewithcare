<html><body>
<link rel="stylesheet" type="text/css" href="link_styles.css" />
<div id='main'>
<?
require ('../config.inc.php');
require "../top_panel.php";
$page=0;
if(isset($_GET[page]))
{
$page= $_GET[page];
}

$start = $page*24;

$count=0;
$sql_total = "SELECT count(*)  FROM links WHERE Country='usa' AND Type='transport' AND Active='1'";
$r = mysql_query($sql_total);
$total = mysql_fetch_array($r);

$sql="SELECT `URL`, `Image` FROM links WHERE Country='usa' AND Type='transport' AND Active='1'";
$r=mysql_query($sql);

$count=0;
echo"<table border='0' width='840'><tr>";
while($result=mysql_fetch_row($r))
{

    if($count%4 ==0){
        echo"</tr><tr>";
    }
    if($result[1] !="")
    {
        echo"<td valign='top'><a href='http://".$result[0]."'><img src='../link_images/".$result[1]."' alt='".$result[0]."' width='200' ></a></td>";
    }else{
        echo"<td valign='top' id='text_links'>".$result[0]."</td>";
    }
    $count++;

}



echo "</tr><tr><td> Page:";

$pages =  $total[0]/24;

for($i =0; $i<$pages; $i++)
{
   $output = $i+1;
   echo"   <a href=/links/transport_links_usa.php?page=$i>$output</a>";
}

echo"</td></tr></table>";
require "bottom_panel.php";
?></div></body></html>