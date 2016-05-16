<?php
  //define("SYSTEM_EMAIL_NAME","MUWC-SYSTEM");
  function send_mail($from_email,$from_name,$to_email,$subject,$body)
	{
		$to_email=str_replace("''","'",$to_email);
		 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$subject="MoveMewithcare.com-  $subject";
// Additional headers
//$headers .= "To: $to_email < $to_email > \r\n";
$headers .= "From: MMWC \r\n";
// Mail it
//echo"the emails is being sent to  $to_email subject is $subject<br>";
//echo"$body";
mail($to_email, $subject, $body, $headers);
return true;
				
	}
?>