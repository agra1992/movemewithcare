<?php
session_start();
//error_reporting(0);
require_once('../config.inc.php');
require_once ('../seo.php');
require_once ('../top_panel.php');
	session_register('market_result'); 


?>

<head>
<style type="text/css">
.result_name{
font:Arial;
font-weight: bold;
 font-size: 10pt;
 color:#33592F; 
background-color:#EDFBEB;
height:25px;
padding: 0px 0px 0px 10px}

</style>



<script type="text/javascript">
<!-- //

function handleError() {
	return true;
}

window.onerror = handleError;
//-->


</script>
<script language="JavaScript" src="../result.js"></script>
<script language="JavaScript" src="../mov.js"></script>

<?php
$count=0;
$state= $_GET['state'];
$city="";
$type=$_GET['type'];
$market_result=array(array());
if($state==""){$state="%";}
if($city==""){$city="%";}
if($type==""){$type="%";}
if( $state !="%" || $city !="%" || $type !="%"){
    $link = mysql_connect($db_host, $db_user, $db_password) or die("Could not connect");
    mysql_select_db($db_locator_name) or die("Could not select database");
    $sql="SELECT * FROM tblmarket WHERE MemberType LIKE '$type'";
    $result=mysql_query($sql) or die("query failed:124");
    while(list($MID, $MemberType) = mysql_fetch_array($result, MYSQL_NUM))
    {
        if($state != "%")
        {
            if($state < 52){$country='USA';}else{$country='Canada';}
            $sql="Select `sh_name` from states where StateID='$state'";
            $r = mysql_query($sql) or die("Query failed_WAW"); 
            $line = mysql_fetch_array($r, MYSQL_ASSOC);
            $state_name= $line[sh_name];
        }
        else{
            $country='%';
        }
    $sql="Select `MemberName`, `State`, `Description`, `Phone`, `ServiceCountry`,`MemberID`, `ContactEmail`,`Logo`,`sms_service`, `sms_address` from tblmembers WHERE MemberType='market' AND (State like '$state_name' OR (State='NA' And ServiceCountry like '$country'))  AND MemberID='$MID' AND Active='1'";
    $r = mysql_query($sql) or die("market query failed");
    while(list($MemberName, $State, $Description, $Phone,$ServiceCountry, $MemberID, $ContactEmail, $Logo, $sms_service, $sms_address) = mysql_fetch_array($r, MYSQL_NUM))
    {
        $market_result[$count][0] = $MemberName;
        $market_result[$count][1] = $State;
        $market_result[$count][2] = $Description;
        $market_result[$count][3] = $ServiceCountry;
        $market_result[$count][4] = $MemberType;
        $market_result[$count][5] = $MemberID;
        $market_result[$count][6] = $ContactEmail;
        $market_result[$count][7] = $Logo;
        $market_result[$count][8] = $sms_service;
        $market_result[$count][9] = $sms_address;
        $count++;
    }
    }
}
?>
</head>
<body>
</div>


<table border="1" align="center" width="857px">

<tr>
<td colspan='2'>

    <table width="100%" border="0" align="top" >
    <tr>
        <td align="right"><a href="http://proaceintl.com"><img src="../adds/bannerProAce.gif"></a></td>
        <td align="left"><img src="../adds/BEST1.jpg"></td>
    </tr>
    <tr><td colspan="2"><div align="center"><h2 style=FONT: bold 15px "Verdana, Arial, Helvetica, sans-serif"; COLOR: #F79A30; LETTER-SPACING: 3px;>Welcome to the Marketplace</h2></div></td></tr>
    <tr>
        <td colspan="2" style= font-family:"Verdana,Arial";color:Gray;font-size:12px;padding-bottom:20px;><b>Thank you for visiting our market place where everything else besides moving is offered to you, our customers. Whatever else you are looking for, you can find it here. From real estate brokers to mortgage bankers, from cleaning services to landscaping, from programmers/database developers to anything else available out there, you can find qualified individuals that will provide you with incredible service at affordable price. So go ahead, do a quick search and find what you are looking for. 
From the whole team at Movemewithcare.com, we wish you the best in your search.</b></td></tr>
    </table>




<?
$size=30;
    if($count==0)
{
echo'
    <table  align="left" width="30%">
    <tr>
        <td><a href="http://fitnesstrainersnetwork.com/fitness/index.html"><img src="../adds/Final1.jpg" width="160" height="70"></a></td>
    </tr>
    <tr>
        <td><a href="http://allfitnessgurus.com/"><img src="../adds/ALLGURUII.jpg" width="160" height="68"></a></td>
    </tr>

    </table>

';
}else{ 
$size=100;}
echo"
    <table width='$size %' border='0' align='left' >
";
    if($count ==0){
        echo"
        <tr>
           <td align='center'>No Results</td>
        </tr>";
    }
    else{
        echo"
            <form action='market_request.php' method='post' name='market_result'>
        ";
        for($i=0;$i<$count;$i++)
        {


        echo"
            <tr >
                <td colspan='3' class=result_name> ".$market_result[$i][0]."</td>    
            </tr>
            <tr id='$i' onmouseover='change_dark($i)' onmouseout='change_light($i)'>     
                <td valign='top'><input type='checkbox' name='service[$i]'></td>
                <td ><img src='../logos/".$market_result[$i][7]."' width='220' ></td>
                <td>•Type of Service: ".$market_result[$i][4]."<br>
      • State: ".$market_result[$i][1]."<br>
      Description: ".$market_result[$i][2]."
               </td>
            </tr>

        ";    
        }

    //prepare the array to pass it
    $_SESSION['market_result']= $market_result;

    echo"<tr><td colspan='2'>

        <input type='submit' value='Request service'></td></tr>
        </form>";
    }?>
    </table>
<?
if($count!=0)
{echo"
</tr></td>
<tr><td>";
}?>


<table width="30%" border="0" align="right" style="font-family:Verdana;font-size:12px;color:gray">		

<form name="market" action="marketplace.php" method="get">				

<tr>
    <td align='right'>State: </td>

    <td align='left'>
<select name="state" size="1" id="or_state" onChange="get(this);" style="width:170px; ">
		<option value="">Select State/Province</option>
		<?
			mysql_select_db($db_locator_name) or die("Could not select database");
			$sql = "SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999 AND StateID!=68"; 
			$result = mysql_query($sql) or die("Query failed");
			
			// showing all states
			while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";
				if ($line[StateID]!=52)
					echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
				else
					echo ("<option value=\"$line[StateID]\" $style $sel>$line[name]</option>");
			}
		?>  	
	</select>

    </td>
</tr>

<tr>
    <td align='right'>Type of Service: </td>
    <td>        
        <select name="type" size="1" id="type">
            <option value="" selected>Select a Service</option>
            <option value="business_consulting" >Business Consulting</option> 
            <option value="cleaning_services" >Cleaning Services</option>
            <option value="database_developers">Database Developers</option>
            <option value="editors" >Editors</option>
            <option value="home_renovation_help" >Home Renovation Help</option>
            <option value="landscaping" >Landscaping</option> 
            <option value="legal" >legal/paralegal</option> 
            <option value="marketing" >Marketing</option> 
            <option value="mortgage_brokers" >Mortgage Brokers</option>
            <option value="moving_insurance_customers" >Moving Insurance for Customers</option>
            <option value="moving_insurance_movers" >Moving Insurance for Movers</option>
            <option value="programmers" >Programmers</option>
            <option value="real_estate_brokerage" >Real Estate Brokerage</option>
<option value=\"trailer_supplies_equipment\" >Trailer Equipment and Supplies provider</option>
            <option value="web design" >Web Design</option>
            <option value="writing" >Writing</option>
        </select>
    </td>
</tr>
<tr>
    <td align='right'><input type="submit" value="search"></td>
</tr>
</form>

</table>

<?
    if($count!=0)
{
echo'</td>
<td>
    <table  align="left" width="30%">
    <tr>
        <td><a href="http://fitnesstrainersnetwork.com/fitness/index.html"><img src="../adds/Final1.jpg" width="160" height="70"></a></td>
        <td><a href="http://allfitnessgurus.com/"><img src="../adds/ALLGURUII.jpg" width="160" height="68"></a></td>
    </tr>

    </table>

';
}?>
</td></tr>
<tr>
    <td align="right"><img src='../adds/FINAL2.jpg' ></td>
    <td align="left"><a href='http://www.ibem.biz'><img src='../adds/IBEM-banner.gif' width="300"></a></td>
</tr>

</table>



</body>


</form> <br><br><br><br>






