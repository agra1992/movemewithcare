<?

require("mail.php");

if($email)

{

//$services=implode(",",$services);

$msg="Name:".$name;

$msg.="Issue:".$services;

$msg.="DESC:".$Description;

sndmsg('Mr.Dan s notification system', 'no-reply@movinguwithcare.com', "kmughal80@hotmail.com", "kmughal80@hotmail.com", 'New Tech Lead from MUWC', $msg);

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Untitled Document</title>

</head>



<body>

<form method="post">

Name:<input name="Name" value="Dan Amzallag" /> <br />

Glitch/Change/Issue on :<select multiple="multiple" name="services"><br />

<option value="HomePage">HomePage</option>

<option value="LUPU">LUPU</option>

<option value="FullMovers">FULL MOVERS</option>

<option value="Transport,SF & PS">Transport, SF & PS</option>

</select><br />

Description(if any)    

<textarea name="Description" cols="20" rows="10"></textarea>

<br />

<input type="hidden" name="email" value="yes" />

<input type="submit" value="submit" />

</form>

</body>

</html>

