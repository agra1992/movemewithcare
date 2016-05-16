function valFeedback()
{
f=document.getElementById("name");
h=document.getElementById("phone");
i=document.getElementById("email");
var err="";
if(f.value=="" || f.value.charAt(0)==" ")
err="<li>Enter Valid Name</li>";
if(h.value=="" || h.value.charAt(0)==" ")
err+="<li>Enter Valid Phone</li>";
if(i.value=="" || i.value.charAt(0)==" ")
err+="<li>Enter Valid Email</li>";

if(err!="")
{
err1="<ul style='color:red;font-family:Verdana;font-size:11px;'>Please check the following fields:";
err=err1+err;
document.getElementById("err").innerHTML=err+"</ul>";
window.location="#top";
return false;
}
else
return true;

}