<?php
session_start();
//error_reporting(0);
require_once('../config.inc.php');
require_once ('../seo.php');
require_once ('../top_panel.php');
	session_register('service'); 


?>
<html>
<head>
<?php
$market_result=$_SESSION['market_result'];
$service=$_SESSION['service'];
$total=count($market_result);

?>
</head>
<body>
<?php
echo"your request has been sent to the following ";
for($i=0; $i<$total; $i++)
{
    if($service[$i] == "on")
    {
        echo"".$market_result[$i][0]."</br>";

    }
}
?>

</body>
</html>