<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   
   $count    = $_GET['count'];
   $offset   = $_GET['offset'];
   
   $strQuery = "Select feedback.tid,feedback.feed_type,feedback.service_type,feedback.rate,feedback.comments,
                 feedback.name,feedback.company,feedback.email,feedback.phone,feedback.`date` From feedback where feedback.tid =" . $_GET['ID']; 
   $DataBase->query($strQuery);
   $Record      = $DataBase->fetch_row();
   $FID    	        = $Record[0];
   $feed_type	    = $Record[1];
   $service_type	= $Record[2];
   $rate    	    = $Record[3];
   $comments	    = $Record[4];
   $name	        = $Record[5];
   $company    	    = $Record[6];
   $email	        = $Record[7];
   $phone	        = $Record[8];
   $date    	    = $Record[9];
   
                        if ($service_type == "full")
						 {
						   $service_type = "Full Service Mover Provider";
						 }
						 elseif($service_type == "lupu")
						 {
						   $service_type = "Loading/Unloading provider";
						 }
						 elseif($service_type == "transport")
						 {
						   $service_type = "Transportation providers";
						 }
						 elseif($service_type == "storage")
						 {
						   $service_type = "Storage Facilities";
						 }
						 elseif($service_type == "packingsupplied")
						 {
						   $service_type = "Packing Supplies Provider";
						 }
?>

  <div align="left"><a href="EManager.php">EManager(Home)</a> > <a href="feedback.php?count=<?=$count?>&offset=<?=$offset?>">Feedbacks</a> > Feedback by <? echo $name; ?></div>
	<br>
	
<? 						 
   echo "<h2>Feedback by $name &nbsp; <a href=\"javascript:spWindowOpen($FID);\" title=\"Click here to print this page\">
		 <img src=\"graphics/print.gif\" border=\"0\"></h2>
         <br>";
   
?>

<script language="JavaScript">
  
  var SpdWindowOpen;
  
  function spWindowOpen(id)
  {  
	SpdWindowOpen=window.open('print_page.php?PageType=feedback&ID='+id,'newwSp','status=yes,scrollbars=yes,width=600,height=600,left=10,top=20')
  }

</script>
<table border="0" cellspacing="0" cellpadding="5">
  
  <tr>
		<td align="right"><b>Name:</b></td>
		<td><? echo $name ?></td>
	</tr>
 <tr>
		<td align="right"><b>Company:</b></td>
		<td><? echo $company ?></td>
	</tr>
 <tr>
		<td align="right"><b>Email:</b></td>
		<td><? echo $email ?></td>
	</tr>
 <tr>
		<td align="right"><b>Phone:</b></td>
		<td><? echo $phone ?></td>
	</tr>
 <tr>
		<td align="right"><b>Feedback Type:</b></td>
		<td><? echo $feed_type ?></td>
	</tr>
	<tr>
		<td align="right"><b>Feedback for service:</b></td>
		<td><? echo $service_type ?></td>
	</tr>
 <tr>
		<td align="right"><b>Rate:</b></td>
		<td><? echo $rate. "/5"; ?></td>
	</tr>
 <tr>
		<td align="right" valign="top"><b>Comments:</b></td>
		<td><? echo nl2br($comments) ?></td>
	</tr>
<tr>
		<td align="right"><b>Date:</b></td>
		<td><? echo $date ?></td>
	</tr>

	 <tr>
		<td></td>
		<td valign="top">
		<? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='feedback.php?count=$count&offset=$offset'\">"; ?>
		</td></tr>

</table>
		
<?
   include "footer.php";
?>
  
   
   