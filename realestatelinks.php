<?php
session_start();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td ><div id="main">
            
              <? include"top_panel.php";?>
              <br><div align="left" style="padding:5px;">
              page:<a href="realestatelinks.php">1</a> <a href="realestatelinks.php?page=2">2</a> <br>            
            </div>
            <div align="left" style="padding:5px;">
                <? 

if($_GET[page]==2)
{
include "realestatedir2.html";
}else{
include "realestatedir.html";
}
?></div>                 
          </div></td>
      </tr>
      <tr>
        <td align="left" valign="top" ><? include"bottom_panel.php";?></td>
      </tr>
    </table></td>
  </tr>
</table>
