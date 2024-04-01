import { addEventTo } from "./main.js";

addEventTo(document.getElementById("button-menu-burger"), "click", () =>
{
    document.getElementById("header-bottom").style.display = document.getElementById("header-bottom").style.display === "flex" ? "none" : "flex";
})