import { addEventTo } from "./main.js";

addEventTo(document.getElementById("button-menu-burger"), "click", () =>
{
    if (document.getElementById("header-bottom").style.display === "flex"){
        document.getElementById("header-bottom").style.display = "none";
        document.getElementById("menu-burger-icon").src = "/assets/bars_menu.svg";
    }
    else{
        document.getElementById("header-bottom").style.display = "flex";
        document.getElementById("menu-burger-icon").src = "/assets/xmark.svg";
    }
   
})