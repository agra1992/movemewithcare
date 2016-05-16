<?php
include "top_panel.php";
$xml = file_get_contents('sitemap.xml');
$parser = xml_parser_create('UTF-8');
xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1); 
xml_parse_into_struct($parser, $xml, $vals, $index); 
xml_parser_free($parser);
echo"<table cellpadding='4'>";
$count = 2;
$cell =1;
foreach($vals as $val)
{
    if($val[value] != ""){
        $count++; 
        if($count %3 == 0)
        {
            if($cell == 2)
            {
                echo "<td><a href='{$val[value]}'>{$val[value]}</a></td></tr>";           
                $cell=0; 
            }else{
            echo "<tr><td><a href='{$val[value]}'>{$val[value]}</a></td>";}
            $count=0; 
            $cell++;
        }
    }


}

echo"</table>";
//var_dump($vals);
?>