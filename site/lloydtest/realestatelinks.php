<html>
    <body>
<div id="main">
<? include"top_panel.php";?>

page:<a href="realestatelinks.php">1</a>  <a href="realestatelinks.php?page=2">2</a> 
<br>
<div id'main'><? 

if($_GET[page]==2)
{
include "realestatedir2.html";
}else{
include "realestatedir.html";
}
?>

<? include"bottom_panel.php";?>
 </div>  </body>
</html>