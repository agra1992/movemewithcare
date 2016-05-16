// JavaScript Document
<!--
var whichlink=0
var whichimage=0
var blenddelay=(ie)? document.images.slide.filters[0].duration*1000 : 0
function slideit(){
try{
if (!document.images) return
if (ie) document.images.slide.filters[0].apply()
document.images.slide.src=imageholder[whichimage].src
if (ie) document.images.slide.filters[0].play()
whichlink=whichimage
whichimage=(whichimage<slideimages.length-1)? whichimage+1 : 0
setTimeout("slideit()",slidespeed+blenddelay)
}
catch(e)
{}
}
slideit()

//-->
