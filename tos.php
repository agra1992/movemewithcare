<?
 error_reporting(0);
 require ('config.inc.php'); 
 require_once ('seo.php');
?>
<? 
include_once "top_panel.php"; 
$website="MoveMeWithCare";
$website_s="MMWC";
        $sql = 'Select Detail From tblcontent Where tblcontent.CID = 12';
	         
       $result = mysql_query($sql) or die("Query failed_WAW");
       $line = mysql_fetch_array($result, MYSQL_ASSOC);
       $text=$line[Detail];
       $text = str_replace( "&n&website_s",$website_s, $text);
       $text = str_replace( "&n&website", $website, $text);
	   echo $text;

?>

<? include_once "bottom_panel.php"; ?>	
</body>
</html> 




