<?php
session_start();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <div id="main">
    <table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><? include"top_panel.php";?></td>
      </tr>
      <tr>
        <td style="padding:5px;">page:<a href="mortgagedirectory.php">1</a></td>
      </tr>
      <tr>
        <td align="left" style="padding:5px;"><? 
/*
if($_GET[page]==2)
{
include "realestatedir2.html";
}else{
include "realestatedir.html";
}*/
include "mortgagedirectory.html";
?></td>
      </tr>
      <tr>
        <td align="left" valign="top"><? include"bottom_panel.php";?></td>
      </tr>
    </table></div></td>
  </tr>
</table>
