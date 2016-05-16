<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   



function store_orders($dor_ret, $LeadId, $valid)
{


    $values="";
    foreach($dor_ret as $member)
    {
        $values="($LeadId , $member[MemberID] , 'destination', '$valid'),";
    }
    $values = substr($values, 0 , -1);
    $sql="INSERT INTO orders_sent (order_id, member_id, location, valid) VALUES $values";
    $r = mysql_query($sql);

}


function find_new_orders()
{
    $sql="SELECT Dest_State, Dest_ZipCode, OrderID FROM tbl_lupu_orders WHERE CustomerID='$ID' AND (Dest_Unload = '1' || Dest_Unpack= '1') && Status_Dest ='U'";
    $r = mysql_query($sql) or die('failed to retrieve additional customer information');
    while(list($dor_state, $dest_zip, $OrderID) = mysql_fetch_array($r))
    {
        $sql_zip = "SELECT lat, long FROM zip_usa WHERE zipcode='$dest_zip'";
        $r_zip = mysql_query($sql_zip) or die('failed to retrieve additional customer information ,zip ');
        list($dor_lat, $dor_long) = mysql_fetch_array($r_zip);
       

        $sql_state = "SELECT sh_name FROM states WHERE StateID='$dor_state'";
        $r_state = mysql_query($sql_state) or die('failed to retrieve additional customer information ,state');
        list($dor_shname) = mysql_fetch_array($r_state);
        if($dor_state >52)
        {$dor_country="canada";}else{
          $dor_country="USA";
         }
$dor_sql = "

Select 
	tblmembers.MemberID, 
	tblmembers.MemberName, 
	tblmembers.ContactEmail, 
	tblmembers.MemberType, 
	tblmembers.TollFree, 
	tblmembers.sms_service, 
	tblmembers.sms_address 
From 
	tblmembers LEFT JOIN zip_usa ON zip_usa.zipcode =tblmembers.ZipCode
				     
Where 
	(
		(
			tblmembers.MemberType = 'standard' OR 
			tblmembers.MemberType = 'full'
		) AND 
		tblmembers.Active = '1' AND
		(
			(
				tblmembers.State like '$dor_shname%' AND 
				(IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($dor_lat))*SIN(RADIANS(lat))+COS(RADIANS($dor_lat))*COS(RADIANS(lat))*COS(RADIANS($dor_long-lon)))),2)* 69.09,0) < tblmembers.distance)
			) OR 
			(
				tblmembers.State like 'NA%'AND 
				tblmembers.MemberState = '999' AND 
				tblmembers.ServiceCountry = '$dor_country'
			) OR (
				tblmembers.State like 'NA%' AND
				tblmembers.MemberState = '$dor_state' AND 
				(IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($dor_lat))*SIN(RADIANS(lat))+COS(RADIANS($dor_lat))*COS(RADIANS(lat))*COS(RADIANS($dor_long-lon)))),2)* 69.09,0) < tblmembers.distance)
			)
		)
	) ";
        	$result = mysql_query($dor_sql) or die("Query failed2332 $dor_sql");
			$dor_ret= array();
			$num = mysql_num_rows($result);

			for($i=0;$i<$num;$i++)
			{
				array_push($dor_ret,mysql_fetch_row($result));
			}
        		
 
         
	store_orders($dor_ret, $OrderID, "yes");
    }
}




   $ID = $_POST['ID'];
   $nSearchCrit = $_POST['nSearchCrit'];
   $SearchString = $_POST['SearchString'];
   $offset = $_POST['offset'];
   $count = $_POST['count'];
   $Mod = $_POST['Mod'];
   $Type = $_POST['Type'];
   $CA = CheckString($_POST['CA']);
   $CZC = CheckString($_POST['CZC']);
   $DCZC = CheckString($_POST['DCZC']);
   $CPhone = CheckString($_POST['CPhone']);
   $CPhone2 = CheckString($_POST['CPhone2']);
   
  $strQuery = "update tblcustomers set 
		          Address = '$CA',
            	  ZipCode = '$CZC',
           	  Dest_ZipCode = '$DCZC',
				  Phone = '$CPhone',
				  Phone2 = '$CPhone2'
			  where CustomerID ='$ID'";
			  
   if ($DataBase->query($strQuery))
   {
     @header("Location: edit_Customer.php?nSearchCrit=$nSearchCrit&SearchString=$SearchString&count=$count&offset=$offset&ID=$ID&Mod=$Mod&Type=$Type");
	 exit;
   }
?>

	
  
         
	
	
	
   
   