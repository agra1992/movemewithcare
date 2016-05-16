// JavaScript Document
<!--
//specify interval between slide (in mili seconds)
var slidespeed=2000

//specify images
var slideimages=new Array("images/slides/slide1.gif","images/slides/slide2.gif","images/slides/slide3.gif","images/slides/slide4.gif")
//specify corresponding links
var slidelinks=new Array("http://www.movemewithcare.com","http://www.movemewithcare.com","http://www.movemewithcare.com","http://www.movemewithcare.com")

var newwindow=1 //open links in new window? 1=yes, 0=no

var imageholder=new Array()
var ie=document.all
for (i=0;i<slideimages.length;i++){
imageholder[i]=new Image()
imageholder[i].src=slideimages[i]
}

function gotoshow(){
if (newwindow)
window.open(slidelinks[whichlink])
else
window.location=slidelinks[whichlink]
}

//-->
