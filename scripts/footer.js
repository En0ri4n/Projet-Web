import { addEventTo, setCustomValidator } from "./main.js";
function checkVisible(elm)
{
    var rect = elm.getBoundingClientRect();
    var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
    return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
}

var button_back_visible = false;
var IdTimeout;
/*Show the 'Scroll back to Top' button if the top of the page isn't visible*/
window.addEventListener('scroll', function(event)
{
    if(document.getElementById("premiere_section") == null)
    {
        return;
    }    

    let button_back = document.getElementById('button_back');
    if(checkVisible(document.getElementById("premiere_section")) && button_back_visible)
    {
        IdTimeout = window.setTimeout(function()
            {
                button_back.style.display = 'none';
            }, 500);
        button_back.animate(disappear, length_animation)
        button_back_visible = false;
    }
    if(!checkVisible(document.getElementById("premiere_section")) && !button_back_visible)
    {
        clearTimeout(IdTimeout);
        button_back.style.display = 'flex';
        button_back.animate(appear, length_animation)
        button_back_visible = true;
    }
});
addEventTo(document.getElementById("button_back"),"click",()=> {
    window.scroll({top: 0, behavior: 'smooth'});
})

const appear = [
    {opacity: 0,},
    {opacity: 1,},
];
const disappear = [
    {opacity: 1,},
    {opacity: 0,},
];
const length_animation = {
    duration: 500,
    iterations: 1,
};