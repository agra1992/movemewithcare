<?
session_start(); 
session_register("salute");
session_register("fname");
session_register("lname");
session_register("address");
session_register("o_state");
session_register("d_state");
session_register("city");
session_register("zip");
session_register("ph1");
session_register("ph2");
session_register("ph3");
session_register("ph4");
session_register("ph5");
session_register("ph6");
session_register("email");
session_register("typemove");

$salute=$_POST[salut];
$fname=$_POST[fname];
$lname=$_POST[lname];
$serv[5]=$_POST["serv[]"];
$serv1=$_POST[serv1];
$serv1_state="";
$ph1=$_POST[ph1];
$ph2=$_POST[ph2];
$ph3=$_POST[ph3];
$ph4=$_POST[ph4];
$ph5=$_POST[ph5];
$ph6=$_POST[ph6];
$email=$_POST[email];
$zip=$_POST[zipcode];
$address=$_POST[address];
$city=$_POST[or_city];
$o_state=$_POST[or_state];
$d_state=$_POST[dor_state];
$loc="";
$loc_un="";
$from=$_POST[from];
$showrec="";


if($from=="transportation")
$trans1="yes";
else if($from=="store")
$store1="yes";
else if($from=="packing")
$packing1="yes";
else
die("Invalid Access Attempted");

if((in_array("3",$serv)) || (in_array("4",$serv)))
{
$showrec="lupu";
}

if((in_array("3",$serv)) && (in_array("4",$serv)))
{
if($serv1=="0")
{
$serv1_state="Local";
$typemove="Local";
}
else
{
$serv1_state="Long Distance";
$typemove="Long";
}
$showrec="full";
}

if((in_array("3",$serv)) && (in_array("4",$serv)))
$showrec="full";

if((in_array("3",$serv)) && (in_array("4",$serv)) && (in_array("5",$serv)))
$showrec="full";



?> 
<link rel="stylesheet" href="locator/style.css" />
<div style="margin:200px auto;border:5px #999999 outset">

<ul><h1><font face="Verdana, Arial, Helvetica, sans-serif">Recommendations & Suggestions:</font></h1>

<?
if($salute && $fname)
{ echo "<font face=\"Arial, Helvetica, sans-serif\" color: \"#130D57\" font-size=\"x-small\">$salute $fname,</font><br><br>"; }

if($showrec=="lupu") {?>

<li><p>We see that you chose Loading/Unloading services, we recommend you to go to <a href="index.php?lupu=1">Loading/unloading tab </a>to request for a loading service provider.Please <a href="index.php?lupu=1">go here</a></p></li>
<?} else if($showrec=="full") {?>
<li><p>Are you interested in more than Loading/Unloading services also? Then please visit our <a href="index.php?full=1"> Full  <?=$serv1_state?> Service Movers </a>than can provide you with loading, transport and unloading. Please <a href="index.php?full=1">go here </a></p></li>
<?} else {?>
<li><p>If you do prefer to Do-It-Yourself option, we recommend you using our <a href="index.php?lupu=1">Loading/Unloading services </a> and contact our <a href="index.php?tp=1">transporation providers </a>to rent a local truck</p></li>
<?}?>
<?if(($showrec=="lupu") || ($showrec=="full")) {?>

<li><p>However, if you do prefer to Do-It-Yourself option, we recommend you using our <a href="index.php?lupu=1">Loading/Unloading services </a> and contact our <a href="index.php?tp=1">transporation providers </a>to rent a truck for your <?=$typemove?> drive or have someone drive the truck for you.</p></li>

<?}	if($trans1=="yes"){?>
<li><p>You can also request for your <a href="index.php?store=1">warehousing(storage) needs</a>.</p></li>

<?} if($store1=="yes") {?>
<li><p><a href="index.php?psm=1">Packing supplies</a> can also be needed for efficient protection.</p></li>
<? } if($packing1=="yes") {?>
<li><p>You can also request for your <a href="index.php?store=1">warehousing(storage) needs</a></p></li>.

<? }?>
</p></li>
</ul>
<font size="-1" face= "Arial, Helvetica, sans-serif" color="#130D57"><center>You will be automatically redirected in <span id="counter" style="font-face:Verdana;font-size:22px;font-weight:bolder;font-stretch:expanded"></span>  seconds, if your browser does not redirect you ,<a href="index.php">click here</a></center></font>
</div>
<script>
var c=50;
function fs(){
document.getElementById("counter").innerHTML=" "+c.toFixed(1)+" ";
c -= 0.1;
if(c<=0)
window.location.href='index.php';
else
setTimeout('fs()',100);

}
fs();
//	setTimeout("window.location.href='top.php'",20000);

</script>
