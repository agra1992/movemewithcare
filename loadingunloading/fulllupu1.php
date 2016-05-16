<?
session_start(); 
session_destroy();
require_once ('../top_panel.php');

$or_state=$_POST[or_state];
$or_city=$_POST[or_city];
$samecity=$_POST[samecity];
$or_pack=$_POST[or_pack];
$or_load=$_POST[or_load];
$or_none=$_POST[or_none];
$ServiceSelector=$_POST[ServiceSelector];
$dor_state=$_POST[dor_state];
$dor_city=$_POST[dor_city];
$dor_pack=$_POST[dor_pack];
$dor_load=$_POST[dor_load];
$dor_none=$_POST[dor_none];

$dor_pack1=$_POST[dor_pack1];
$dor_load1=$_POST[dor_load1];

$full=$_POST[full];
$transport=$_POST[transport];


?>



<? 
$serv[0]="0";

if($or_pack)
$serv[1]="1";
if($dor_pack || $dor_pack1)
$serv[2]="2";
if($or_load)
$serv[3]="3";
if($dor_load || $dor_load1)
$serv[4]="4";

if($samecity)
$serv1="0";
$same_country=0;
if(($or_state>52 &&$dor_state<52) || ($or_state<52 &&$dor_state>52)){
$same_country=0;}
else{
$same_country=1;}



?> 
<link rel="stylesheet" href="../locator/style.css" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="970" align="center" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="middle"><table width="955" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><form name="form1" id="form1" action="fulllupu2.php" method="post">
                      <input type="hidden" name="or_state" value="<?=$or_state ?>" />
                      <input type="hidden" name="or_city" value="<?=$or_city ?>" />
                      <input type="hidden" name="or_pack" value="<?=$or_pack ?>" />
                      <input type="hidden" name="or_load" value="<?=$or_load ?>" />
                      <input type="hidden" name="or_none" value="<?=$or_none ?>" />
                      <input type="hidden" name="dor_none" value="<?=$dor_none ?>" />
                      <input type="hidden" name="ServiceSelector" value="<?=$ServiceSelector ?>" />
                      <input type="hidden" name="samecity" value="<?=$samecity?>" />
                      <input type="hidden" name="dor_state" value="<?=$dor_state ?>" />
                      <input type="hidden" name="dor_city" value="<?=$dor_city ?>" />
                      <input type="hidden" name="dor_pack" value="<?=$dor_pack ?>" />
                      <input type="hidden" name="dor_load" value="<?=$dor_load ?>" />
                      <input type="hidden" name="transport" value="<?=$transport ?>" />
                      <input type="hidden" name="full" value="<?=$full ?>" />
                  </form></td>
                </tr>
              </table>
                <table width="100%" border="3" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center"><h1>Recommendations &amp; Suggestions: </h1>
                      <h1 align="left">
                        <?
$message="";
if($same_country==1){
    if($serv1==1){
            if($transport=="yes"){
                $message="&bull;  Are you interested in more than Loading and Unloading services? Then please visit our Full Service Local Distance movers . They can provide you with loading,packing,transport,unloading, unpacking and warehousing. Please go <a href='http://movemewithcare.com/locator/fullservicemovers.php'>here</a><br>
&bull;  Since you do need transportation, our state of the art system sent an email to all the accredited transportation providers on our network that can provide you with dependable transportation. Either looking for ULoad/They drive or rent and drive, we can help you.<br>
&bull;  We also recommend you to visit our Packing supplies TAB to get discounted prices on our packing supplies to adequately protect your furniture in transit and also if you do decide to store your furniture in a safe place, our Storage Facilities have state of the art security system at your convenience. <br>
";
            }
            else{
                $message="&bull;  Looking to drive the truck yourself? Not looking to deal with full service mover? If you happen to own your truck or rent a truck on your own, we can still provide you with the loading/unloading moving service you need. If you are looking to rent your truck, please visit our Transportation providers after filling this form.<br> 
&bull;  We also recommend you to visit our Packing supplies TAB to get discounted prices on our packing supplies to adequately protect your furniture in transit and also if you do decide to store your furniture in a safe place, our Storage Facilities have state of the art security system at your convenience. <br>
";
            }
    }
    else{
            if($transport=="yes"){

                $message="&bull;  Are you interested in more than Loading and Unloading moving services? Then please visit our Full Service Long distance movers . They can provide you with loading,packing,transport,unloading, unpacking and warehousing. Please go <a href='http://movemewithcare.com/locator/fullservicemovers.php'>here </a><br>
&bull;  Since you do need transportation, our state of the art system sent an email to all the transportation providers that can provide you with dependable transportation. Either looking for ULoad/They drive or rent and drive, we can help you.<br>
&bull;	We also recommend you to visit our Packing supplies TAB to get discounted prices on our packing supplies to adequately protect your furniture in transit and also if you do decide to store your furniture in a safe place, our Storage Facilities have state of the art security system at your convenience<br>
";
            }
            else{
                $message="&bull;  Looking to drive the truck yourself? Not looking to deal with full service mover? If you happen to own your truck, we can still provide you with the loading/unloading service you need. If you are looking to rent your truck, please visit our Transportation providers after filling this form.<br> 
&bull;  We also recommend you to visit our Packing supplies TAB to get discounted prices on our packing supplies to adequately protect your furniture in transit and also if you do decide to store your furniture in a safe place, our Storage Facilities have state of the art security system at your convenience. <br>
";

            }
    }
}
else{
    if($transport=="yes"){
        $message="&bull;  Are you interested in more than Loading and Unloading moving services? Then please visit our Full Service International Long Distance movers . They can provide you with loading,packing,transport(across borders),unloading, unpacking and warehousing. Please go <a href='http://movemewithcare.com/locator/fullservicemovers.php'>here</a> <br>
&bull;  Since you do need transportation, our state of the art system sent an email to all the transportation providers that can provide you with dependable transportation. Either looking for ULoad/They drive, or rent and drive, we can help you. <br>
&bull;  We also recommend you to visit our Packing supplies TAB to get discounted prices on our packing supplies to adequately protect your furniture in transit and also if you do decide to store your furniture in a safe place, our Storage Facilities have state of the art security system at your convenience. <br>
";
    }
    else{
        $message="&bull;  Looking to drive the truck yourself? Not looking to deal with full service mover? If you happen to own your truck, we can still provide you with the loading/unloading service you need. If you are looking to rent your truck, please visit our Transportation providers after filling this form. <br>
&bull;  We also recommend you to visit our Packing supplies TAB to get discounted prices on our packing supplies to adequately protect your furniture in transit and also if you do decide to store your furniture in a safe place, our Storage Facilities have state of the art security system at your convenience. <br>
";
    }

}
echo"<p>$message</p>";
?>
                        <font size="-1"> </font></h1>
                      <div align="center"><font size="-1"><a href="javascript:document.getElementById('form1').submit();">Click here to continue</a> </font> </div>
                      </div></td>
                  </tr>
                </table>
                </td>
          </tr>
          <tr>
            <td height="205" align="center" valign="middle">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><? include_once "../bottom_panel.php"; ?></td>
      </tr>
    </table></td>
  </tr>
  
</table>
