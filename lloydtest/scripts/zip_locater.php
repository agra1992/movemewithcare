<?

function zip_locater($zipcode, $trainers, $country, $additional ="")
{
$counter=0;
    if($country == "CA")
    {
        $sql = "SELECT `latitude`, `longitude` FROM zip_canada WHERE zipcode='$zipcode'";
        $r = mysql_query($sql, getMysqlConnection()) or die("Failed Query:122 ");
        list($lat, $long) = mysql_fetch_array($r);
        
        $sql = "SELECT CONCAT_WS(' ', first_name, last_name) as name ,`email`, trainers.zipcode, ROUND(DEGREES(ACOS(SIN(RADIANS($lat))*SIN(RADIANS(latitude))+COS(RADIANS($lat))*COS(RADIANS(latitude))*COS(RADIANS($long-longitude)))),2)* 69.09 AS distance FROM trainers LEFT JOIN zip_canada USING (zipcode) WHERE trainers.country='CA' AND (ROUND(DEGREES(ACOS(SIN(RADIANS($lat))*SIN(RADIANS(latitude))+COS(RADIANS($lat))*COS(RADIANS(latitude))*COS(RADIANS($long-longitude)))),2)* 69.09  < trainers.distance) ".$additional;
        $r = mysql_query($sql, getMysqlConnection()) or die("Failed Query:445 $sql");
        while(list($name, $email, $distance) = mysql_fetch_array($r))
        {
             $trainers[$counter][name] = $name;
             $trainers[$counter][email] = $email;
             $trainers[$counter][distance] = $distance;
             $counter++;
        }
    }else{
        $sql = "SELECT `lat`, `lon` FROM zip_usa WHERE zipcode='$zipcode'";
        $r = mysql_query($sql, getMysqlConnection()) or die("Failed Query:123 $sql");
        list($lat, $long) = mysql_fetch_array($r);
        
        $sql = "SELECT CONCAT_WS(' ', first_name, last_name) as name ,`email`, trainers.zipcode, ROUND(DEGREES(ACOS(SIN(RADIANS($lat))*SIN(RADIANS(lat))+COS(RADIANS($lat))*COS(RADIANS(lat))*COS(RADIANS($long-lon)))),2)* 69.09 AS distance FROM trainers LEFT JOIN zip_usa USING (zipcode) WHERE trainers.country='US' AND (ROUND(DEGREES(ACOS(SIN(RADIANS($lat))*SIN(RADIANS(lat))+COS(RADIANS($lat))*COS(RADIANS(lat))*COS(RADIANS($long-lon)))),2)* 69.09  < trainers.distance)". $additional;
        $r = mysql_query($sql, getMysqlConnection()) or die("Failed Query:445 $sql");
        while(list($name, $email, $zipcode, $distance) = mysql_fetch_array($r))
        {
             $trainers[$counter][name] = $name;
             $trainers[$counter][email] = $email;
             $trainers[$counter][distance] = $distance;
             $counter++;
        }
    }

}



?>

