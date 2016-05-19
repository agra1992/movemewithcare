<?php

// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['emaild']) 		||
   empty($_POST['subject']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['emaild'],FILTER_VALIDATE_EMAIL))
   {
   	echo "No arguments Provided!";
   	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['emaild'];
$subject = $_POST['subject'];
$message = $_POST['message'];
	
// Create the email and send the message
$to = 'admin@movemewithcare.com';
$email_subject = "MoveMeWithCare.com Contact Form:  $name";
$email_body = "You have received a new message from your MoveMeWithCare.com contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nSubject: $subject\n\nMessage:\n$message";
$headers = "From: noreply@movemewithcare.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;
?>