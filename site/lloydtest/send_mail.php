<?/*
	require ('config.inc.php');
  	//define("SYSTEM_EMAIL_NAME","MUWC-SYSTEM");
  	error_reporting(0);
  	
  	$link = mysql_connect($db_host, $db_user, $db_password) or die("Could not connect");
	mysql_select_db($db_name) or die("Could not select database");
	
	$LowerLimit = 0;
	$UpperLimit = 12;	
	
	$sql = "Select tblEmails.MailID, tblEmails.From, tblEmails.To, tblEmails.Subject, tblEmails.Message from tblEmails Limit $LowerLimit, $UpperLimit";
	$result = mysql_query($sql) or die("Query failed_EMAIL");	
	$num = mysql_num_rows($result);	
	$ret = array();
	
	for($i=0;$i<$num;$i++)
	{
		array_push($ret,mysql_fetch_row($result));
	}
		
	foreach ($ret as $val)
	{
		$MailID = $val[0];
		$from = $val[1];
		$to = $val[2];
		$subject = $val[3];
		$message = $val[4];
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: ' . "MMWC-SYSTEM" . '<' . $from . '>' . "\r\n";
				
		mail($to, $subject, $message, $headers);		
		$sql = "Delete from tblEmails where MailID=$MailID";
		$result = mysql_query($sql) or die("Query failed_1EMAIL");
		
	}	
	*/
?>