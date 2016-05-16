<html>
<body>
<form action="fopen_test.php" method=POST>
Enter a URL to load using fopen():<br>
<input type="text" name="url" value="" size="60">
<input type="submit" value="Load Page" class="button">
<br><br>
Examples:<br>
http://google.com/<br>
http://linkmachine.net/<br>
<br><br>
If fopen() is successful, the page should appear below (without images).<br><br>
</form>

<?php

if (is_array($HTTP_POST_VARS))
{
  while(list($key, $val)=each($HTTP_POST_VARS)) {
    $GLOBALS[$key] = $val;
  }
}
else if (is_array($_POST))
{
  while(list($key, $val)=each($_POST)) {
    $GLOBALS[$key] = $val;
  }
}

// To allow access, some sites require that a user agent be set.
ini_set("HTTP_USER_AGENT", "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0 (ax)");

$page = "";

if (isset($url))
{
  $fp = fopen($url, 'r');

  if ($fp != false) 
  {
    while (feof($fp) == false)
    {
      $page .= fread($fp, 10000);
    }

    fclose($fp);

    echo "URL: $url =====================================<br><br>";
    echo $page;
  }
}

?>