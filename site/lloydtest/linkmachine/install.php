<?php

// Attempt to set max_execution_time to 60 seconds to avoid timeouts
ini_set("max_execution_time", "60");

EchoPageTop();

if (!SaveTestFile("./"))
{
  echo "
  Before running this installation script, please turn on all of the write permissions for your site's <i>linkmachine</i> directory.<br>
  <br>
  If you do not know how to set the permissions of a file or directory, please consult your FTP software's documentation. One common method used by many FTP programs is to select the directory, choose <i>Change Permissions</i> from a right-click or pop-down menu, and turn on all write permissions. In other FTP programs you would select <i>chmod</i> instead, and set the permissions number to 777.<br>
  <br>
  Another option is to try the automatic <a target=_installer href=\"http://linkmachine.net/install.php\">LinkMachine Online Installer</a>.<br>
  <br>
  ";
  
  EchoPageBottom();

  exit();
}

if ((file_exists("index.htm") || file_exists("index.html")) && (!file_exists("linkmachine.php")))
{
  echo "
  You are attempting to install LinkMachine in a directory that already contains an index file. To avoid conflicts with other pages on your site, please install LinkMachine in a subdirectory rather than in your site's home directory.<br>
  <br>
  For more information about how to use this installer, please refer to the file \"readme.txt\" that came with this installation script.<br>
  <br>
  Another option is to try the automatic <a target=_installer href=\"http://linkmachine.net/install.php\">LinkMachine Online Installer</a>.<br>
  <br>
  ";
  
  EchoPageBottom();

  exit();
}

$use_curl = false;
$install_list_url = "http://www.linkmachine.net/install/install_list.php";

$install_list = LoadPage($install_list_url, true, false);

if (($install_list == "") && function_exists('curl_init'))
{
  // Try again, this time with CURL
  $install_list = LoadPage($install_list_url, true, true);

  if ($install_list != "")
  {
    // Record the fact that CURL is necessary
    $use_curl = true;
  }
}

if ($install_list == "")
{
  if (LoadPage("http://www.google.com/", true, $use_curl) == "")
  {
    echo "Php scripts running on your web site cannot access outside web sites. Because of this, LinkMachine cannot install on your site. Please contact your web hosting company to have them fix this problem.<br>
    <br>
    Should you choose not to pursue a solution to this problem so that you can use LinkMachine, the following site compares and reviews many alternative link exchange programs and services that you may find useful instead:<br>
    <br>
    <a target=_software href=\"http://link-exchange.name/\">Link Exchange Solutions</a><br>
    <br>";

    EchoPageBottom();
  }
  else
  {
    echo "The installer cannot access the site <b>www.linkmachine.net</b>, which is necessary to continue this installation. Please try again in a few minutes.<br><br>";
    EchoPageBottom();
  }

  exit();
}

echo "<b>Installing LinkMachine. Please wait, this may take a few moments.</b><br><br>\n";
flush();

parse_str($install_list);

while(list($key, $val)=each($dirs)) 
{
  $val = str_replace("linkmachine/", "./", $val);
  if (!file_exists($val))
  {
    mkdir($val);
  }
  
  @chmod($val, 0755);
}

$file_count = count($files);
$files_copied = 0;
$perdec = -1;
$error_occurred = false;

while(list($key, $val)=each($files)) 
{
  $src_file = "http://www.linkmachine.net/install/".$val;
  $dst_file = str_replace(".php_", ".php", $val);
  $dst_file = str_replace("linkmachine/", "./", $dst_file);

  $file_contents = LoadPage($src_file, false, $use_curl);

  // Save the file to disk
  $fd = @fopen($dst_file, "w");

  if ($fd == false)
  {
    echo "Error saving file $dst_file<br><br>";
    $error_occurred = true;
    break;
  }
  else
  {
    fwrite($fd, $file_contents);
    fclose($fd);

    if (strpos($dst_file, "linkmachine.php") !== false)
      @chmod($dst_file, 0444);
    else
      @chmod($dst_file, 0666);
  }

  $files_copied++;
  $new_perdec = floor($files_copied * 10 / $file_count);
  if ($new_perdec != $perdec)
  {
    $perdec = $new_perdec;
    echo ($perdec * 10)."%<br>\n";
    flush();
  }
}

// Wait a bit before setting permissions
sleep(1);

SetPermissions(".");

if ($error_occurred)
{
  GenerateErrorData();
  exit();
}

echo"
<br>
<b>Installation complete!</b><br>
<br>
If you are not automatically redirected, <a href=\"linkmachine.php\">click here</a> to start up LinkMachine.<br>
<br>
<script language=\"JavaScript\">
var lm_url = document.location.href;
lm_url = lm_url.substring(0, lm_url.length - 11);
document.location.href = lm_url + 'linkmachine.php?ua=fresh_install&base_url=' + escape(lm_url);
</script>
";

EchoPageBottom();

function LoadPage($_url, $_ping=true, $_use_curl=false)
{
  if ($_use_curl && function_exists('curl_init'))
  {
    // Load the page with the given _url using cURL ////////////////////////

    $curl_handle=curl_init();
    curl_setopt($curl_handle,CURLOPT_URL,$_url);
    curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,10);
    curl_setopt($curl_handle,CURLOPT_TIMEOUT,15);
    curl_setopt($curl_handle,CURLOPT_HEADER,0);
    curl_setopt($curl_handle,CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl_handle,CURLOPT_USERAGENT, "MSIE");
    $page = curl_exec($curl_handle);
    $errnum=curl_errno($curl_handle);
    $errstr=curl_error($curl_handle);
    curl_close($curl_handle);
  }
  else
  {
    // Load the page with the given _url using fopen() ////////////////////////

    $page = "";

    $ping_failed = false;

    if ($_ping)
    {
      $host = str_replace("https://", "", $_url);
      $host = str_replace("http://", "", $host);
      if (is_integer(strpos($host, "/")))
      {
        $host = substr($host, 0, strpos($host, "/"));
      }
      if ($fp = @fsockopen($host, 80, $errno, $errstr, 5))
      {
        fclose($fp);
      }
      else
      {
        $ping_failed = true;
      }
    }

    if (!$ping_failed)
    {
      $fp = @fopen($_url, 'r');

      if ($fp !== false) 
      {
        while (feof($fp) == false) {
          $page .= fread($fp, 10000);
        }

        fclose($fp);
      }
    }
  }

  return $page;
}

function SaveTestFile($_directory)
{
  // Save a test file to disk
  $fd = @fopen($_directory."lm_test.txt", "w");
  
  if ($fd) 
  {
    // Test was successful
    fclose($fd);
    unlink($_directory."lm_test.txt");
    return true;
  }

  return false;
}

function GenerateErrorData()
{
  echo "
<br>
<br>
LinkMachine was not installed successfully on your web server. This could be due to a problem with the server's configuration. We suggest that you try the easy to use <a href=\"http://linkmachine.net/install.php\">LinkMachine Online Installer</a>.<br>
<br>
<a href=\"http://linkmachine.net/install.php\">Go to the LinkMachine Online Installer</a><br>
<br>
  ";

  EchoPageBottom();

  ob_start();

  echo "<html><body bgcolor=#96cde4><span style=\"color:#000000; font-size:10pt; font-weight: normal; text-decoration:none; font-family:Verdana, Arial, Sans-serif\">
        <h3>LinkMachine Installer Error Information</h3><br><br>\n";

  phpinfo(INFO_GENERAL | INFO_CONFIGURATION | INFO_ENVIRONMENT | INFO_VARIABLES);
  
  echo "<br><br>LinkMachine Directory Information<br><br>\n";

  $handle=opendir("./");

  while ($file = readdir($handle)) 
  {
     if(is_dir($file) && $file != ".") {
       echo "<b>$file (dir)</b><br>\n";
     } else if ($file != ".") {
       echo "<b>$file</b> size: ".filesize($file)." perms: ".fileperms($file)." modified: ".date("r", filemtime($file))."<br>\n";
     }
  }

  // Save a test file to disk
  $fd = @fopen("lm_test.txt", "w");

  echo "<br><br>Test file write: ".($fd ? "Success" : "Fail")."<br><br>\n";
  
  // Delete the test file if it was written
  if ($fd) 
  {
    fclose($fd);
    unlink("lm_test.txt");
  }

  // Attempt to load page from LinkMachine site
  $page_fopen = LoadPage("http://linkmachine.net/", true, false);
  $page_curl = LoadPage("http://linkmachine.net/", true, true);

  echo "<br><br>LinkMachine site available via fopen(): ".(($page_fopen == "") ? "No" : "Yes")."<br><br>\n";
  echo "<br><br>LinkMachine site available via CURL(): ".(($page_curl == "") ? "No" : "Yes")."<br><br>\n";

  echo "<br><br></span></body></html>\n";

  $string = ob_get_contents();
  ob_end_clean();

  mail("contact@linkmachine.net", "LinkMachine Installer Error", $string);
}

function EchoPageTop()
{
  echo"
<HTML>
<HEAD>
<TITLE>LinkMachine Installer</TITLE>
<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=iso-8859-1\">

<style>

.largetext {
   color:#000000;
   font-size:13pt;
   font-weight: bold;
   text-decoration:none;
   font-family:Verdana, Arial, Sans-serif
}

.medlighttext {
   color:#000000;
   font-size:10pt;
   font-weight: normal;
   text-decoration:none;
   font-family:Verdana, Arial, Sans-serif
}

.medtext {
   color:#000000;
   font-size:10pt;
   font-weight: bold;
   text-decoration:none;
   font-family:Verdana, Arial, Sans-serif
}

.smalltext {
   color:#000000;
   font-size:8pt;
   font-weight: normal;
   text-decoration:none;
   font-family:Verdana, Arial, Sans-serif
}

A.sitelink {
   color:#CC4C37;
   font-size:10pt;
   font-weight: bold;
   text-decoration:none;
   font-family:Verdana, Arial, Sans-serif
}

A.controllink {
   color:#993300;
   font-size:9pt;
   font-weight: bold;
   text-decoration:none;
   font-family:Verdana, Arial, Sans-serif
}

A.editlink {
   color:#993300;
   font-size:8pt;
   text-decoration:none;
   font-family:Verdana, Arial, Sans-serif
}

.message {
    text-align: left;
    color: #FFDD00;
    font-size:11pt;
    font-weight: bold;
    font-family:Verdana, Arial, Sans-serif
}
.inputcell {
    text-align: left;
    font-size:10pt;
    font-weight: normal;
    font-family:Verdana, Arial, Sans-serif
    color: #444;
    background: #96cde4;
}
</style>

</HEAD>
<BODY BACKGROUND=\"http://linkmachine.net/images/installer/lm_bg_08.jpg\" BGCOLOR=#FFFFFF link=\"#993300\" vlink=\"#993300\" alink=\"#993300\" LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<!-- ImageReady Slices (layout2.psd) -->
<TABLE WIDTH=780 BORDER=0 CELLPADDING=0 CELLSPACING=0 VALIGN=TOP>
	<TR  VALIGN=TOP>
		<TD ROWSPAN=3>
			<IMG SRC=\"http://linkmachine.net/images/installer/lm_bg_01.jpg\" WIDTH=105 HEIGHT=128 ALT=\"\"></TD>
		<TD ROWSPAN=2>
			<IMG SRC=\"http://linkmachine.net/images/installer/lm_bg_02.jpg\" WIDTH=419 HEIGHT=57 ALT=\"\"></TD>
		<TD>
			<IMG SRC=\"http://linkmachine.net/images/installer/lm_bg_03.jpg\" WIDTH=226 HEIGHT=41 ALT=\"\"></TD>
		<TD ROWSPAN=2>
			<IMG SRC=\"http://linkmachine.net/images/installer/lm_bg_04.jpg\" WIDTH=30 HEIGHT=57 ALT=\"\"></TD>
	</TR>
	<TR VALIGN=TOP>
		<TD>
			<IMG SRC=\"http://linkmachine.net/images/installer/lm_bg_06.jpg\" WIDTH=226 HEIGHT=16 ALT=\"\"></TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3>
      <TABLE WIDTH=675 HEIGHT=100 BORDER=0 CELLPADDING=0 CELLSPACING=0>
        <TR VALIGN=TOP>
          <TD VALIGN=TOP ALIGN=LEFT>
            <span class=\"message\">
            <br>
            <b>Welcome to the LinkMachine Installer</b><br>
            </span><span class=\"medlighttext\">
            <br>
            <table border=\"0\" cellpadding=\"8\" cellspacing=\"0\" width=\"600\">
              <tr>
                <td class=inputcell>
  ";
}

function EchoPageBottom()
{
  echo"
                </td>
              </tr>
            </span>
            </TD>
        </TR>
      </TABLE>
    </TD>
	</TR VALIGN=TOP>
</TABLE>
<!-- End ImageReady Slices -->
</BODY>
</HTML>
  ";
}

function SetPermissions($_dir)
{
  if ($dir = opendir($_dir)) 
  {
    while (($file = readdir($dir)) !== false) 
    {
      if ($file != "." && $file != "..") 
      {
        //echo "Setting premissions for file ".$_dir."/".$file,"<br>\n";

        if (strpos($file, "linkmachine.php") !== false)
          @chmod($dst_file, 0444);
        else if (is_dir($_dir."/".$file))
          @chmod($dst_file, 0777);
        else 
          @chmod($_dir."/".$file, 0666); // Directory

        if (is_dir($_dir."/".$file))
        {
          SetPermissions($_dir."/".$file);
        }
      }
    }  

    closedir($dir);
  }
}

?>