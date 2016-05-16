<?  
  session_start();
  set_time_limit(60*60*60);
  require("config.inc.php");
    
   if(!(isset($_SESSION['Member_Id'])))
   { 
       @header("Location:/locator/mem.php?nAuth_Failed=1");
	   exit;
    } 
	
	$link = mysql_connect($db_host, $db_user, $db_password)
              or die("Could not connect");
     mysql_select_db($db_locator_name) or die("Could not select database");

    $strQuery = "select pass from tblmembers where MemberID = " . $_SESSION['Member_Id'] . " AND Active = '1'
    AND (MemberType = 'standard' or MemberType = 'full' or MemberType='market')";
			 
    $result = mysql_query($strQuery) or die ("Error");
    $line = mysql_fetch_array($result, MYSQL_ASSOC);
	$MemberPass   = $line[pass];

    if($MemberPass != $_SESSION['Member_Pass'])
    {
       @header("Location:/locator/mem.php?nAuth_Failed=1");
	   exit;
    }
	  
?>