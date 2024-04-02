const allStars = document.querySelectorAll(".fa-star");
const rating = document.querySelector('.rating'); //variable qui recupère la note en int entre 1 et 5

init();

function init(){
    allStars.forEach(star => {
        star.addEventListener("click", saveRating);
        star.addEventListener("mouseover", addCSS);
        star.addEventListener("mouseleave", removeCSS);
    })
}

function saveRating(e) {
    removeEventListenerToAllStars();
    rating.innerText = e.target.dataset.star;
}

function removeEventListenerToAllStars(){
    allStars.forEach(star=>{
        star.removeEventListener("click", saveRating);
        star.removeEventListener("mouseover", addCSS);
        star.removeEventListener("mouseleave", removeCSS);
    })
}

function addCSS(e, css = "checked"){
    const overedStar = e.target;
    overedStar.classList.add(css);
    const previousSiblings = getPreviousSiblings(overedStar);
    console.log("previousSiblings", previousSiblings);
    previousSiblings.forEach(elem => elem.classList.add(css));
}

function removeCSS(e, css="checked"){
    const overedStar = e.target;
    e.target.classList.remove(css);
    const previousSiblings = getPreviousSiblings(overedStar);
    previousSiblings.forEach(elem => elem.classList.remove(css));


}

function getPreviousSiblings(elem){
    console.log("elem.previousSibling", elem.previousSibling);
    let siblings = [];
    const spanNodeType = 1;
    while((elem = elem.previousSibling)){
        if(elem.nodeType === spanNodeType){
            siblings = [elem, ...siblings];
        }
    }
    return siblings;
}