<?
require_once('config.inc.php');  
echo"hello";
$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");
  $fcontents = file ('bbb_usa_moverstesting.csv'); 
echo"good so far";
  for($i=0; $i<sizeof($fcontents); $i++) { 
      $line = trim($fcontents[$i]); 
      $arr = explode(",", $line); 

      $sql = "insert into `tblmembers` (`MemberID`, `MemberName`, 
`MemberType`, `ContactPerson`,`ContactEmail`,`Address`, `state`, `ZipCode`, `Phone`,`TollFree`,  `Fax`, `login`,`pass`,`Associations`,`ServiceCountry`,`logo`, `Description`, `InterstateLicense`, `USDot`, `MC` ,`Active`, `DateAdded`, `MemberState`, `CanadianLicense`)
values ('". implode("','", $arr). "')"; 
      mysql_query($sql);
      echo $sql ."<br>\n";
      if(mysql_error()) {
         echo mysql_error() ."<br>\n";
      }      

}
echo"done";
?>