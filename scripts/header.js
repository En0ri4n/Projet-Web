import { addEventTo, setCustomValidator } from "./main.js";


var menu_burger_visible = false;
addEventTo(document.getElementById("button-menu-burger"),"click",()=> {
    if (menu_burger_visible)
    {
    document.getElementById("header-bottom").style.display = "none";
    menu_burger_visible = false;
    }
    else
    {
    document.getElementById("header-bottom").style.display = "flex";
    menu_burger_visible = true;
    }
})