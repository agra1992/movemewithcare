<HTML>
<HEAD>
<TITLE>Php Slideshow</TITLE>
<?php
//cylink software ? 2002
//please keep this ? notice
//this script may be used in non commercial environments only
//if you wish to employ this script in a commercial site
//please contact me at kvdk@hotmail.com (we will not over-charge you:-)

print "<script language=javascript>\n";
print "//? cylink 2002 kvdk@hotmail.com\n";
print "var speed=4000 //time picture is displayed\n";
print "var delay=3 //time it takes to blend to the next picture\n";
print "x=new Array;\n";
print "var y=0\n";
$tel=0;
$tst='.jpg';
$p= ".";
$d = dir($p);

while (false !== ($entry = $d->read())) {
    if (stristr ($entry , $tst)) {
        print ("x[$tel]='$entry' \n");
        if ($tel==0) {$first=$entry;}
        $tel++;
    }
}
$d->close();
?>
function show() {
   document.all.pic.filters.blendTrans.Apply()
   document.all.pic.src=x[y++]
   document.all.pic.filters.blendTrans.Play(delay)
   if (y>x.length-1) y=0;
}
function timeF() {
   setTimeout("show()",speed)
}
</script>
</HEAD>
<BODY >

<!-- add html code here -->
<?php
print ("<IMG src=$first id=pic onload=timeF() style=\"filter:blendTrans()\">");
?>
<!-- add html code here -->
</BODY>
</HTML>