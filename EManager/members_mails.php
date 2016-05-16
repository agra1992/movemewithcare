<style type="text/css">
<!--
.calendarHeader { 
    font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 14px;
    color: #003366;
    background-color: #FFFFFF; 
}

.calendarToday {
    font-weight: bolder; 
    color: #CC0000; 
    background-color: #FFFFFF;
}

.calendar { 
    font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 13px;
    background-color: ##FFFFFF;
}
-->
</style>

<? 
   include "Security.php";
   include "header.php";
   include "Calendar.php";
   error_reporting(0);
   
     $day = $_GET['day'];
	 $month = $_GET['month'];
	 $year = $_GET['year'];
	
	 
	 $d = getdate(time());
	
	if ($month == "")
	{
		$month = $d["mon"];
	}
	
	if ($year == "")
	{
		$year = $d["year"];
	}
	
	if ($day == "")
	{
		$day = $d["day"];
	}
	
	switch($month)
     {
                              
		case 1:
               $VarMon = "January";
			   break;
		case 2:
               $VarMon = "February";
			   break;
	    case 3:
               $VarMon = "March";
			   break;
		case 4:
               $VarMon = "April";
			   break;
		case 5:
               $VarMon = "May";
			   break;
	    case 6:
               $VarMon = "June";
			   break;
		case 7:
               $VarMon = "July";
			   break;
	    case 8:
               $VarMon = "August";
			   break;
	    case 9:
               $VarMon = "September";
			   break;
		case 10:
               $VarMon = "October";
			   break;
		case 11:
               $VarMon = "November";
			   break;
		case 12:
               $VarMon = "December";
			   break;
	 }
 
      echo "<h2>Emails Sent to Network Members ($day $VarMon $year)</h2>
          <br>"; 
		  
	 class MyCalendar extends Calendar
	 {
		function getCalendarLink($month, $year)
		{
	
			$s = getenv('SCRIPT_NAME');
			return "$s?month=$month&year=$year";
		}
		
		function getDateLink($day, $month, $year)
		{
			$s = getenv('SCRIPT_NAME'); 
			return "$s?day=$day&month=$month&year=$year";
		}
	
	 }
		  
	 $cal = new MyCalendar;
	 echo "<center>";
	 echo $cal->getMonthView($month, $year);
	 echo "</center>"; 
	 
	 
?>

   <br><br>
<br><br>
<? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='emails.php'\">"; ?>	
<?
   include "footer.php";
?>
  
   
   