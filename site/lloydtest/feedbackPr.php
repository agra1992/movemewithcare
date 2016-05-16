<html><head>
<?
 error_reporting(0);
 require ('config.inc.php'); 
 require_once ('seo.php');
?></head>
<body>
<? 
include_once "top_panel.php"; 
 require("sanitize.php");





$comment_type=sanitize($_POST[comment],20,0);
$directed_to = sanitize($_POST[proacecompany],20,0);
$rating=sanitize($_POST[rater],3,0);
$feedback=sanitize($_POST[feedback],400,0);
$name=sanitize($_POST[name],20,0);
$company=sanitize($_POST[company],30,0);
$email = sanitize($_POST[email],20,0);
$phone=sanitize($_POST[phone],15,0);

echo"Thank you for sharing your thoughts with us";
$sql="INSERT into feedback (feed_type,service_type,rate,comments,name,company,email, phone, date) VALUES ('$comment_type', '$directed_to', '$rating', '$feedback', '$name', '$company', '$email', '$phone', CURRENT_TIMESTAMP)";
$r=mysql_query($sql);

?>

<? include_once "bottom_panel.php"; ?>	
</div>
</body>
</html> 