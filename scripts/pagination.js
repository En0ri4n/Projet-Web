/*Fonction a appeler pour générer une div de pagination*/
function getPagination(nom_page,current_page,max_page) {
    div =`<div class="pagination">`;
    if (current_page == 1){
        div += `<a id="pageDebut"><<</a>
        <a id="pagePrecedent"><</a> 
        <a id="pageActuelle">x</a>`;
    }
    else{
        div += `<a id="pageDebut" href="/`+nom_page+`?page=1"><<</a>
        <a id="pagePrecedent" href="/`+nom_page+`?page=`+(current_page-1)+`><</a> 
        <a id="pageActuelle">x</a>`;
    }

    if (current_page == max_page){
        div +=`<a id="pageSuivant">></a>
        <a id="pageFin">>></a></div>`;
    }
    else{
        div +=`<a id="pageSuivant" href="/entreprises?page=`+(current_page+1)+`>></a>
        <a id="pageFin" href="/entreprises?page=`+(max_page)+`>>></a></div>`;
    }
    return div;
}