<?php
  session_start();

  include "Security.php"; 
  error_reporting(0);
require("sanitize.php");
  
function find_new_leads($distance)
{

     $sql="SELECT ServiceCountry FROM tblmembers WHERE MemberID ='".$_SESSION[Member_Id]."' LIMIT 1";
     $r = mysql_query($sql) or die('failed to retrieve your service country');
     list($country) = mysql_fetch_array($r);

     if($country == "canada")
     {
         $sql="SELECT zip_canada.lat, zip_canada.lon FROM  tblmembers LEFT JOIN zip_canada ON zip_canada.zipcode=tblmembers.ZipCode WHERE tblmembers.MemberID= ".$_SESSION[Member_Id]." LIMIT 1";
        $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your new zip code area");  
        list($lat, $lon) = mysql_fetch_array($r);
        $zip_database="zip_canada";
        $country_sql="AND Or_State > 52 ";
    }else{
         $sql="SELECT zip_usa.lat, zip_usa.lon FROM  tblmembers LEFT JOIN zip_usa ON zip_usa.zipcode=tblmembers.ZipCode WHERE tblmembers.MemberID= ".$_SESSION[Member_Id]."  LIMIT 1";
        $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your new zip code area"); 
        list($lat, $lon) = mysql_fetch_array($r);
        $zip_database="zip_usa";
        $country_sql="AND Or_State < 52 ";
    }


    $sql ="SELECT lead_id FROM leads_sent WHERE member_id = ".$_SESSION[Member_Id]."";
    $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your new lead ids");  
    $count=0;
    $leads = array();
    while($result =mysql_fetch_assoc($r))
    {
         $leads[$count] = $result[lead_id];
        $count++;
    }

    $sql = "SELECT State, ServiceCountry, MemberState, InterstateLicense, distance FROM tblmembers WHERE tblmembers.MemberID = ".$_SESSION[Member_Id]."";
    $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your information");
    list($state, $country, $m_state, $license,$distance_old) = mysql_fetch_array($r);
    $additional="";
    if($m_state != 998 && $m_state !=999)
    {
        if($license != 1 || $state != NA)
        {
            $additional .=" AND Or_State = Dest_State AND Or_State ='$m_state'";
        }


        $sql="Select tbl_fs_orders.OrderID, IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($lat))*SIN(RADIANS(lat))+COS(RADIANS($lat))*COS(RADIANS(lat))*COS(RADIANS($lon-lon)))),2)* 69.09,0) AS distance
		            From tbl_fs_orders LEFT JOIN $zip_database USING (zipcode) Where DATEDIFF(tbl_fs_orders.MoveDate, CURRENT_DATE) >0 AND (IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($lat))*SIN(RADIANS(lat))+COS(RADIANS($lat))*COS(RADIANS(lat))*COS(RADIANS($lon-lon)))),2)* 69.09,0)  < '$distance')   $country_sql  $additional";
    $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your new leads   end ");
    while($result =mysql_fetch_assoc($r))
    {

       if(!in_array($result[OrderID],$leads))
       { 

            $sql_insert="INSERT INTO leads_sent (lead_id, member_id) VALUES (".$result[OrderID].", ".$_SESSION[Member_Id].")";
           $r_insert = mysql_query($sql_insert) or die("sorry, and error has occurred while trying to update your new leads");

        }
        

    }


  }//if they do service entire country, no new orders, and changing distance is useless


}












function find_new_orders($distance)
{

     $sql="SELECT ServiceCountry FROM tblmembers WHERE MemberID ='".$_SESSION[Member_Id]."' LIMIT 1";
     $r = mysql_query($sql) or die('failed to retrieve your service country');
     list($country) = mysql_fetch_array($r);
     if($country == "canada")
     {
         $sql="SELECT zip_canada.lat, zip_canada.lon FROM  tblmembers LEFT JOIN zip_canada ON zip_canada.zipcode=tblmembers.ZipCode WHERE tblmembers.MemberID= ".$_SESSION[Member_Id]." LIMIT 1";
        $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your new zip code area");  
        list($lat, $lon) = mysql_fetch_array($r);
        $zip_database="zip_canada";
        $country_sql = "AND Or_State >52";
    }else{
         $sql="SELECT zip_usa.lat, zip_usa.lon FROM  tblmembers LEFT JOIN zip_usa ON zip_usa.zipcode=tblmembers.ZipCode WHERE tblmembers.MemberID= ".$_SESSION[Member_Id]." LIMIT 1";
        $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your new zip code area");  
        list($lat, $lon) = mysql_fetch_array($r);
        $zip_database="zip_usa";
        $country_sql = "AND Or_State <52";
    }


    
    $sql ="SELECT order_id,location FROM orders_sent WHERE member_id = ".$_SESSION[Member_Id]."";
    $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your new lead ids");  
    $count=0;
    $leads = array();
    while($result =mysql_fetch_assoc($r))
    {
         $orders[$count][0]= $result[order_id];
         $orders[$count][1]= $result[location];
        $count++;
    }

    $sql = "SELECT State, ServiceCountry, MemberState, InterstateLicense, distance FROM tblmembers WHERE tblmembers.MemberID = ".$_SESSION[Member_Id]."";
    $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your information");
    list($state, $country, $m_state, $license,$distance_old) = mysql_fetch_array($r);
   


    if($m_state != 998 && $m_state !=999)
    {

        if($license != 1 || $state != NA)
        {
            $additional .=" AND Or_State ='$m_state'";
        }
        $sql="Select tbl_lupu_orders.OrderID, IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($lat))*SIN(RADIANS(lat))+COS(RADIANS($lat))*COS(RADIANS(lat))*COS(RADIANS($lon-lon)))),2)* 69.09,0) AS distance, tbl_lupu_orders.CustomerID
		            From tbl_lupu_orders JOIN ($zip_database) ON ($zip_database.zipcode=tbl_lupu_orders.ZipCode) Where DATEDIFF(tbl_lupu_orders.MoveDate, CURRENT_DATE) >0 AND (IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($lat))*SIN(RADIANS(lat))+COS(RADIANS($lat))*COS(RADIANS(lat))*COS(RADIANS($lon-lon)))),2)* 69.09,0)  < '$distance')  AND(Or_Load ='1' OR Or_Pack ='1') AND Status_Origin='U' $country_sql $additional";
    $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your new leads   end2"); 
    while($result =mysql_fetch_assoc($r))
    {
        $new=true;
        foreach($orders as $order)
        {

            if($order[0] == $result[OrderID] && $order[1] =="origin")
            {
                 $new=false;
            }
        }
        if($new==true)
        {
            $sql_valid = "SELECT Valid FROM tblcustomers WHERE CustomerID ='".$result[CustomerID]."' LIMIT 1";
            $r_valid = mysql_query($sql_valid) or die('could not retrieve your new customers information');
            list($valid) = mysql_fetch_array($r_valid);

            $sql_insert="INSERT INTO orders_sent (order_id, member_id, location, valid) VALUES (".$result[OrderID].", ".$_SESSION[Member_Id].",'origin','$valid')";
           $r_insert = mysql_query($sql_insert) or die("sorry, and error has occurred while trying to update your new orders at origin");
         }
        
        

    }//end of while statement




        if($country=="canada")
        {
            $country_sql = "AND Dest_State >52";
        }else{
            $country_sql = "AND Dest_State <52";
        }
        if($license != 1 || $state != NA)
        {
            $additional .=" AND Dest_State ='$m_state'";
        }
        $sql="Select tbl_lupu_orders.OrderID, IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($lat))*SIN(RADIANS(lat))+COS(RADIANS($lat))*COS(RADIANS(lat))*COS(RADIANS($lon-lon)))),2)* 69.09,0) AS distance, tbl_lupu_orders.CustomerID
		            From tbl_lupu_orders JOIN ($zip_database) ON ($zip_database.zipcode=tbl_lupu_orders.Dest_ZipCode) Where DATEDIFF(tbl_lupu_orders.MoveDate, CURRENT_DATE) >0 AND (IFNULL(ROUND(DEGREES(ACOS(SIN(RADIANS($lat))*SIN(RADIANS(lat))+COS(RADIANS($lat))*COS(RADIANS(lat))*COS(RADIANS($lon-lon)))),2)* 69.09,0)  < '$distance')  AND(Dest_Unload ='1' OR Dest_Unpack ='1') AND Status_Dest='U' $country_sql $additional";
    $r = mysql_query($sql) or die("sorry, and error has occurred while trying to retrieve your new leads   end3");

    while($result =mysql_fetch_assoc($r))
    {
        $new=true;
        foreach($orders as $order)
        {
            if($order[0] == $result[OrderID] && $order[1] =="destination")
            {
                 $new=false;
            }
        }
        if($new==true)
        {
            $sql_valid = "SELECT Valid FROM tblcustomers WHERE CustomerID ='".$result[CustomerID]."' LIMIT 1";
            $r_valid = mysql_query($sql_valid) or die('could not retrieve your new customers information');
            list($valid) = mysql_fetch_array($r_valid);
     
            $sql_insert="INSERT INTO orders_sent (order_id, member_id, location, valid) VALUES (".$result[OrderID].", ".$_SESSION[Member_Id].",'destination','$valid')";
           $r_insert = mysql_query($sql_insert) or die("sorry, and error has occurred while trying to update your new orders at destination");

         }
        
        

    }//end of while statement

  }//if they do service entire country, no new orders, and changing distance is useless


}



  $CP = $_POST['CP'];
  $CE = $_POST['CE'];
  $CPhone = $_POST[Cphone_one].$_POST[Cphone_two].$_POST[Cphone_three]." ext.".$_POST[Cphone_four];
  $CPass = $_POST['CPass'];
  $List_Ass = $_POST['Associations'];
    $associations = "";
    foreach($List_Ass as $assoc)
    {

        $associations.="$assoc,";
    }
    $associations = substr($associations, 0 , -1);

  $distance = $_POST['distance'];

  $sms_address="";
  $sms_service=$_POST[sms_service];
  if($sms_service =="yes")
  {
      $sms_address=sanitize($_POST[sms_phone],10,0);
      $sms_address.="@".$_POST[sms_company];
  }





  



       if($_SESSION['Member_Type'] == "full"){

            find_new_leads($distance);  
            find_new_orders($distance);  
        }else{

            find_new_orders($distance);  
        }
  $strQuery = "update tblmembers set 
		ContactPerson = '$CP',
		Phone = '$CPhone',
		ContactEmail = '$CE ',
		pass = '$CPass',
		Associations = '$associations',
		sms_service = '$sms_service',
		sms_address = '$sms_address',
                distance = '$distance'
		where MemberID =" . $_SESSION['Member_Id'];
		
   $result_newQuery = mysql_query($strQuery) or die("Query failed23*3   ");
   
      

        session_unset("Member_Id");
        unset($Member_Id);
        	
        session_unset("Member_Login");
        unset($Member_Login);
		
		session_unset("Member_Pass");
        unset($Member_Pass);
		
		session_unset("Member_Email");
        unset($Member_Email);
		
		session_unset("Member_Name");
        unset($Member_Name);
		
		session_unset("Member_Contact");
        unset($Member_Contact);
		
		session_unset("Member_Phone");
        unset($Member_Phone);
        
		$Member_Id = "";
        $Member_Login = "";
		$Member_Pass = "";
        $Member_Email = "";
		$Member_Name = "";
        $Member_Contact = "";
		$Member_Phone = "";

        session_destroy();
  
   @header("Location: locator/mem.php?login=2");
   exit;

?>