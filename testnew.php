<?php
set_time_limit (0);
$person;
$m=0;
error_reporting(0) ;
$lines = file('http://yellowpages.superpages.com/listings.jsp?CS=L&MCBP=true&C=Solar+Energy+%2C'.$stat.'&STYPE=S&search.x=74&search.y=28&PS=45&PI=0'.$page);

// Loop through our array, show HTML source as HTML source; and line numbers too.
foreach ($lines as $line_num => $line) 
{
//echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br>\n"; 

$mystring1 = "setLSBCookie(";
$mystring2 = "list_address"; 
$mystring3 = "phoneVal";
$mystring4 = "Listing URL";
$mystring5 = "zipVal";
$mystring6 = "listingdiv";
$mystring8 = "-- div white-space:nowrap --";
$findme = htmlspecialchars($line) ;
//$pos = strpos($mystring, $findme);
if (str_contains($findme,$mystring2)) {
$Namearray=($line_num)+1;

$Phonearray = ($line_num)+2;

//$person[$m][0] = htmlspecialchars(substr($line,14,strpos($line,",")-15)). "<br>\n";
//$m +=1;
} 
if (str_contains($findme,$mystring6)) {
$webadd = ($line_num)+2;
}
if (str_contains($findme,$mystring1)) {
//echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br>\n"; 
$person[$m][0] = htmlspecialchars(str_replace("&amp;","&",str_replace("'"," ",substr($line,14,strpos($line,",")-15))));
} 
if (str_contains($findme,$mystring8)) {
//echo "Line #<b>{$line_num}</b> : ". htmlspecialchars(str_replace("'"," ",substr($line,0,strpos($line,"</a")))) . "<br>\n"; 
$person[$m][6] = htmlspecialchars(str_replace("'"," ",substr($line,0,strpos($line,"</a"))));
}
if($line_num==$webadd && $line_num!=0) {

//echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br>\n"; 
//echo strpos($line,".htm");
if(htmlspecialchars(substr(substr($line,strpos($line,"href")+6,strpos($line,"onClick")-25),0,4))=="http")
{
//echo "Line #<b>{$line_num}</b> : " . htmlspecialchars(substr($line,strpos($line,"href")+6,strpos($line,"onClick=")-11)). "<br>\n"; 
$str = htmlspecialchars(substr($line,strpos($line,"href")+6,strpos($line,"onClick=")-11));

ini_set('user_agent','MSIE 4\.0b2;'); 
$lines1 = file("$str");
foreach ($lines1 as $line_num1 => $line1) 
{
//echo "Line #<b>{$line_num1}</b> : " . htmlspecialchars($line1) . "<br>\n"; 
$mystring9 = "og:region";
$mystring7 = "og:street-address";
$mystring8 = "og:locality";
$mystring10 = "og:postal-code";


$findme1 = htmlspecialchars($line1) ;
if (str_contains($findme1,$mystring7))
{
$person[$m][1] = htmlspecialchars(str_replace("'"," ",substr($line1,strpos($line1,"street-address")+25,strpos($line1,"/")-1)));

}
if (str_contains($findme1,$mystring8))
{

$person[$m][2] = htmlspecialchars(substr($line1,strpos($line1,"locality")+19,strpos($line1,"/")-1));
}
if (str_contains($findme1,$mystring9))
{


$person[$m][3] = htmlspecialchars(substr($line1,strpos($line1,"region")+17,2));

}
if (str_contains($findme1,$mystring10))
{

$person[$m][4] = htmlspecialchars(substr($line1,strpos($line1,"postal-code")+22,5));
}

/* if (str_contains($findme1,$mystring7)) {
echo htmlspecialchars(substr($line1,strpos($line1,"street-address")+16,strpos($line1,"</span")-54)) . "<br>\n"; 

$person[$m][1] = htmlspecialchars(substr($line1,strpos($line1,"street-address")+16,strpos($line1,"</span")-54)) ;
//echo $person[$m][7]; 
} 

if (str_contains($findme1,$mystring8)) {
//echo htmlspecialchars(substr($line1,strpos($line1,"locality")+10,strpos($line1,"</span>, <span class")-49)) . "<br>\n"; 
//echo htmlspecialchars(substr($line1,strpos($line1,"postal-code")+13,5)) . "<br>\n"; 
//echo htmlspecialchars(substr($line1,strpos($line1,"region")+8,2)) . "<br>\n"; 
//echo "Line #<b>{$line_num1}</b> : " . htmlspecialchars($line1) . "<br>\n"; 

$person[$m][2] = htmlspecialchars(substr($line1,strpos($line1,"locality")+10,strpos($line1,"</span>, <span class")-49)) ; 
$person[$m][3] = htmlspecialchars(substr($line1,strpos($line1,"region")+8,2)); 
$person[$m][4] = htmlspecialchars(substr($line1,strpos($line1,"postal-code")+13,5)) ;

}  */
}

}
}
if (str_contains($findme,$mystring3)) {
//echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br>\n"; 
$person[$m][5] = htmlspecialchars(substr($line,strpos($line,"phonetxt")+10,14));
$m +=1;
}
}

//print_r($person);
updatedatabase($person);
function str_contains($haystack, $needle, $ignoreCase = false) {
if ($ignoreCase) {
$haystack = strtolower($haystack);
$needle = strtolower($needle);
}
$needlePos = strpos($haystack, $needle);
return ($needlePos === false ? false : ($needlePos+1));
}
function right($value, $count){
return substr($value, ($count-1));
}
function left($string, $count){
    return substr($string, 0, $count);
}

function updatedatabase($per)
{
$con = mysql_connect("localhost","movemewi_balaji","balaji");

if (!$con)
{
die('Could not connect: ' . mysql_error());
}
mysql_select_db("movemewi_muwc", $con) or die(mysql_error()); 

for($k=0;$k<=count($per)-1;$k+=1)
{
$insert = mysql_query("INSERT INTO super(Name,Address1,Address2,State,Zip,Phone,Webaddress,Typ) 
VALUES ('" . trim($per[$k][0]) . "','" . trim($per[$k][1]) . "','" . Trim($per[$k][2]) . "','" . $per[$k][3] . "','" . $per[$k][4] . "','" . $per[$k][5] . "','" . trim($per[$k][6]) . "','Solar Energy Designers and Consultants')" , $con)
or die("Could not insert data because ".mysql_error());
}
echo "Updated Alabama";
mysql_close($con);


}

?> 