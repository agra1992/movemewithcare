<?php
switch ($e) {
	case -1:
		$message = "No such user";
		break;
	
	case 0:
		$message = "Invalid username and/or password";
		break;
	
	case 2:
		$message = "Access denied";
		break;

	default:
		$message = "An unspecified error occurred";
		break;
}
?>

<?php echo $message; ?>