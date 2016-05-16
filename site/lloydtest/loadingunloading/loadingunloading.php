<?php
session_start();
//error_reporting(0);
require_once('../config.inc.php');
require_once ('../seo.php');
require_once ('../top_panel.php');

// include "../prerequisites.php";
 //$browser = CheckBrowser();





$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");

mysql_select_db($db_name) or die("Could not select database");

$sql = 'Select tblcontent.Detail From tblcontent Where tblcontent.CID = 6';
$result = mysql_query($sql) or die("Query failed_LUPU");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$add=array(array());
$sql = 'Select Add_Number,Description, Image,Link From add_manager Where Add_Number<5';

$r = mysql_query($sql) or die("Query failed_LUPU $sql");
while($result = mysql_fetch_array($r, MYSQL_ASSOC))
{
    $add[$result[Add_Number]][0]=$result[Description];
    $add[$result[Add_Number]][1]=$result[Image];
    $add[$result[Add_Number]][2]=$result[Link];

}

?>
<link rel="stylesheet" type="text/css" href="../tabs.css" />
<link rel="stylesheet" type="text/css" href="../add_style.css" />
    <style type="text/css">
    #main_table{width:400px;}    
    </style>

<!--[if IE 5]>
    <style type="text/css">
        #main_table{width:300px;}    
    </style>
<![endif]-->


<script language="JavaScript" src="../mov.js"></script>
<script language="JavaScript" src="../lupu.js"></script>
<script language="JavaScript" src="../cal.js"></script>
<script type="text/javascript" src="../overlib_mini.js"></script>
<script type="text/javascript">
<!-- //

function handleError() {
	return true;
}

window.onerror = handleError;
//-->
</script>


<SCRIPT LANGUAGE="JavaScript">
function new_add_window(add_path)
{
    add_window=window.open(add_path, "Add Images", "width=300, height=150,scrollbars=yes,resizable=yes ,toolbar=yes")
    add_window.focus();
}

</SCRIPT>

</head>



	

<div style="float:left;width:150px;height=90px; border:2px dotted;text-align:center;font-size:11px;font-family:Verdana;color:gray;margin-top:25px;">
<div style="margin:5px 5px 5px 5px;text-align:left;background-color:#EDFBEB;line-height:12pt;">
<img src="../images/loadingunloading.gif" style="margin:5px auto;margin-left:18px" alt="fullservice_movers"/>

<? echo @nl2br($line[Detail]); ?>

</div>
</div>

<div id="main_side_add">
<b id='title'>Sponsored Links</b>
<?
for($i=1; $i<5; $i++)
{
     echo"<div id='add_cell'>
    <div id='add_number'>
     Advertisement $i<br></div>";
        if($add[$i][1] != ""){

             echo"<a href='http://".$add[$i][2]."'><img src='../adds/".$add[$i][1]."' width='150'></a><br>";
        }
    elseif($add[$i][2] != ""){
        echo "<a href='http://".$add[$i][2]."'>http://".$add[$i][2]."</a><br>";
        echo @nl2br($add[$i][0]); 
        echo" </br>";

    }
    else{
        echo"This Add Space is Available";}

echo"</div>";
}
?>
</div>



	<div align="left"  id="main_table" style="height:850px!important;height:2px;padding-left:0px;padding-top:20px!important;padding-left:0px;font-family:Verdana;font-size:12px;color:black;font-size:12px;" >
	
<br>
<form name="loadin" action="fulllupu.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" name="quick_quote" id="tab_gray_text">
<tr> 
	<td colspan="2" style="text-align:center"><div align="center" ><h2>Welcome to Moving help wizard</h2></div><br /><span id="tab_bold_text">With our moving help wizard, posting a moving job should be as easy as 1-2-3. Yes, that's it - in just three easy steps, you'll locate your accredited moving company to serve you. Actually, it is the moving company that will find YOU. No more stress when it comes to MOVING. Our network will make your moving experience as fun and easy as possible. </span>
	<br /><br />
	<div align="center" id="tab_bold_text"><span id="tab_red_text">*Important: </span>Prior to submitting any request on this site, you confirm that you have read our TERMS OF SERVICE and accept them.</div>
	</td>
</tr>
<tr><tr><td><br /></td></tr>
<tr><tr><td><br /><span id="tab_red_text">First Step:</span></td></tr>
<tr> 
    <td colspan="2"><div align="center" id="tab_bold_text">Origin location</strong></div></td>
</tr>
<tr> 
    <td colspan="2" valign="top"><p align="center" id="tab_regular_text">Select Origin State/Province (We also serve Canada) <!--(We also serve Canadians)--></p>
    <div align="center"> 
	<input type=hidden name ="ServiceSelector" value = "lupu" >
	<select name="or_state" size="1" id="or_state" onChange="naNext();get(this);" style="width:170px; ">
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
	</select><br>

		<!--[if IE]>
		<a href="javascript:showmap('or_state');" class="map">Pick from map</a>		
		<![endif]-->

	
    </div></td>
</tr>

<tr> 
	<td width="50%" valign="top"> <div align="center">
    Select origin city<br>
    <div id="cityrec"><i>if your city is not listed, please select <br /> nearest location.</i></div><br>
	<select name="or_city" size="7" id="or_city" style="width: 170px; " onChange="AllowNext('lupu');">    	
	</select>
    <br>
    <input type="hidden" name="samecity" value="yes" id="samecity" onclick="gorod();">
<font  size="-3">Note: If moving within the same state, go to step 2 and choose same state and choose destination city as well.</font> 
    
	<input type="hidden" name="next2">
    <input type="hidden" name="dest_city">
    <input type="hidden" name="dest_state">
    </div></td>
    
	<td width="50%" align="left" valign="center" id="tab_regular_text">Please, specify services required at origin location:<br>

		<table border="0" align="left" valign="top" width="98%" id="tab_gray_text">
		<tr>
			<td valign="top" style="width: 20px;"><input type="checkbox" name="or_pack" value="1" id="or_pack" onclick="ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">Packing</td>
		</tr>
		<tr>
	    	<td valign="top"><input type="checkbox" name="or_load" value="1" id="or_load" onclick="ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">Loading</td>
		</tr>
		<tr>    
			<td valign="top"><input type="checkbox" name="or_none" value="1" id="or_none" onclick="or_nosvc('o');ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">No services required at origin location</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">
			<input type="hidden" name="dest_none">
			</td>
		</tr>
		</table>
	
	</td>
</tr>
<tr>
	<td>
	<span id="dest_info"></span>
	</td>
</tr>
<tr><tr><td><br /></td></tr>
<tr><tr><td><br /></td></tr>
<tr><tr><td><br /></td></tr>
<tr><tr><td><br /><b><span id="tab_red_text">Second Step:</span></b></td></tr>
 
<tr>
	<td colspan="2"><div align="center"><span id="tab_bold_text">Destination location</span></div></td>
</tr>
<tr> 
   <td colspan="2" valign="center"><p align="center" id="tab_regular_text">Select destination state/province</p>
   <div align="center"> 
          
		
	<select name="dor_state" size="1" id="dor_state" onChange="naNext();get2('dor_state');" style="width:170px; ">
		<option value="">Select State/Province</option>
		<?
		mysql_select_db($db_locator_name) or die("Could not select database");

		$sql = 'SELECT `StateID`, `name`, `sh_name` FROM `states` WHERE StateID != 999 AND StateID!=68';
		$result = mysql_query($sql) or die("Query failed");
		
		// showing all states
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		if ($temp++ % 2 == 0) $style="style=\"background : #dceffe\""; else $style="";

		if ($line[StateID]!=52)
			echo ("<option value=\"$line[StateID]\" $style $sel>$line[name] ($line[sh_name])</option>");
		else
			echo ("<option value=\"$line[StateID]\" $style $sel>$line[name]</option>");
		}
		?>  	
		</select><br>
		<!--[if IE]>
		<a href="javascript:showmap2('dor_state');" class="map">Pick from map</a>		
		<![endif]-->

        </div></td>
</tr>
<tr> 
	<td width="50%" valign="top"> <div align="center">Select destination city<br>
    <div id="cityrec"><i>if your city is not listed, please select <br /> nearest location.</i></div><br>
    <select name="dor_city" size="7" id="dor_city" style="width: 170px;" onChange="AllowNext('lupu');">
	</select></div></td>
		
	<td width="50%" align="left" valign="center"><span id="tab_regular_text">Please, specify services required at destination location:</span><br>

		<table border="0" align="left" id="tab_gray_text">
		<tr>
			<td valign="top" style="width: 20px;"><input type="checkbox" name="dor_pack" value="1" id="dor_pack" onclick="ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">UnPacking</td>
		</tr>
		<tr>
	    	<td valign="top"><input type="checkbox" name="dor_load" value="1" id="dor_load" onclick="ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">UnLoading</td>
		</tr>
		<tr>    
			<td valign="top"><input type="checkbox" name="dor_none" value="1" id="dor_none" onclick="or_nosvc('d');ChangeColors();"></td>
			<td valign="top" align="left" style="padding-top: 2px;">No services required at destination location</td>
		</tr>
		</table>	
	
	</td>
</tr> 
<tr> 
	<td colspan="2"> <div align="center"><input type="hidden" name="servty" value="" />
	  <input id="next" class="button" type="button" name="Submit" value="Next ->" onclick="Proceed()" disabled STYLE="width: 120; font-size: x-small; font-family: Arial; color: #130d57; background-color: #dceffe; border: 1 outset #130d57">
	</div></td>
</tr>

</table>

<input type="hidden" value="<?=$trans?>" name="transfer" />

</form> </div><br><br><br><br>
<div style="position:relative; top:50px;">
<!--[if IE 5]>
<div style="position:relative; bottom:50px;">
<![endif]-->
<!--[if IE 6]>
<div style="position:relative; bottom:50px;">
<![endif]-->

<? include_once "../bottom_panel.php"; ?>

</div>
</div>