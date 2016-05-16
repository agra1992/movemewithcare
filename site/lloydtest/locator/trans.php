<?
session_start(); 
session_register("salute");
session_register("fname");
session_register("lname");
session_register("address");
session_register("city");
session_register("o_state");
session_register("d_state");
session_register("zip");
session_register("ph1");
session_register("ph2");
session_register("ph3");
session_register("email");
session_register("load");
session_register("pack");
$salute=$_POST[salut];
$fname=$_POST[fname];
$lname=$_POST[lname];
$serv[5]=$_POST["serv[]"];
$serv1=$_POST[serv1];
$serv1_state="";
$ph1=$_POST[ph1];
$ph2=$_POST[ph2];
$ph3=$_POST[ph3];
$email=$_POST[email];
$zipcode=$_POST[zipcode];
$address=$_POST[address];
$city=$_POST[city];
$o_state=$_POST[or_state];
$d_state=$_POST[dor_state];
$city=$_POST[city];


if(((in_array("3",$serv)) && (in_array("4",$serv)))
{$load=1;
if($serv1=="0")
$serv1_state="Local";
else
$serv1_state="Long";
}

if(in_array("1",$serv)
$pack=1;





?> 
<script>
setTimeout("window.location.href='top.php'",10000);

</script>
<link rel="stylesheet" href="locator/style.css" />
<div style="margin:200px auto;border:5px #999999 outset">
<ul><h1><font face="Verdana, Arial, Helvetica, sans-serif">Recommendation:</font></h1>
<?
if($salute && $fname)
{echo $salute;
echo $fname;
echo ",";
}

 ?>
<li><p>We see that you chose Loading services, we recommend you to go to <a href="top.php?lupu=1">Loading/unloading tab </a>to request for a loading service provider.Please <a href="top.php?lupu=1">go here</a></p></li>
<li><p>Are you interested in unloading services also? Then please visit our full <a href="top.php?full=1"> <?=$serv1_state?> service movers </a>than can provide you with loading, transport and unloading. Please <a href="top.php?full=1">go here </a></p></li>
</ul>
<font size="-1"><center>You will be automatically redirected in 10 seconds, if your browser does not redirect you ,<a href="#">click here</a></center></font>
</div>
