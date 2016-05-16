<?php
// Gets file content into  string variable
// Maybe there's an equivalent in built-in PHP fuctions, but i donno it
// Readfile() is not the right thing
function GetFileContents($filename) {
$fd = fopen ($filename, "r");
while (!feof ($fd)) {
	$buffer = fgets($fd, 4096);
	$contents .= $buffer;
	}
fclose ($fd);

return $contents;
}
?>