import {addEventsTo, addEventTo} from "./main.js";

const allStars = document.querySelectorAll(".fa-star");
console.log("allStars", allStars);

addEventTo(document, "DOMContentLoaded", onReady);

function onReady()
{
    addEventsTo(allStars, {'click': getRating, 'mouseover': addCSS, 'mouseleave': removeCSS});
}

function getRating(e)
{
    /*console.log(e, e.target);*/
    /*console.dir(e.target);*/
    console.log(e.target.dataset, e.target.nodeName, e.target.nodeType);
}

function addCSS(e, css = "checked")
{
    //e.target.classList.add(css);
    const overedStar = e.target;
    overedStar.classList.add(css);
    const previousSiblings = getPreviousSiblings(overedStar);
    console.log("previousSiblings", previousSiblings);
    previousSiblings.forEach(elem => elem.classList.add(css));
}

function removeCSS(e, css = "checked")
{
    const overedStar = e.target;
    overedStar.classList.remove(css);
    const previousSiblings = getPreviousSiblings(overedStar);
    previousSiblings.forEach(elem => elem.classList.remove(css));
}

function getPreviousSiblings(elem)
{
    console.log("elem.previousSibling", elem.previousSibling);
    let siblings = [];
    const spanNodeType = 1;
    while(elem === elem.previousSibling)
    {
        if(elem.nodeType === spanNodeType)
        {
            siblings = [elem, ...siblings];
        }
    }
    return siblings;
}