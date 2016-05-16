<?
  require_once('config.inc.php');
  require_once('getfile.php'); // uncomment this when deployed

// getting $keywords
$keywords = GetFileContents($_SERVER['DOCUMENT_ROOT']."/keywords"); // uncomment this when deployed

// getting $description
$description = GetFileContents($_SERVER['DOCUMENT_ROOT']."/description"); // uncomment this when deployed
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?=$description?>

<?=$keywords?>
<meta name="robots" content="FOLLOW,INDEX"/>
<meta name="copyright" content="Move Me With Care"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$CN_TITLE?></title>
