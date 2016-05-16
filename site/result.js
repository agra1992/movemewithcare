
var original_color;
function change_dark(tab)
{
    original_color = document.getElementById(tab).style.backgroundColor;
    document.getElementById(tab).style.backgroundColor = "#FCE8BD";
}
function change_light(tab)
{
    document.getElementById(tab).style.backgroundColor = original_color;
}
