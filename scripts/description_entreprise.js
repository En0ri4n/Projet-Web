import {addEventTo} from "./main.js";
import {initPagination, reloadPagination, setTotalPages, currentPage, totalPages} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady()
{
    initPagination(onWait, filterOffres);

    reloadPagination()
}

async function filterOffres()
{
    const urlParams = new URLSearchParams(window.location.search);
    if(!urlParams.has('IdEntreprise'))
        return;

    let url = '/api/offres?page=' + currentPage + '&per_page=3&company=' + urlParams.get('IdEntreprise');

    let res = await fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await res.json();

    console.log(data)

    let offres = data['offres'];
    let offreList = document.getElementById('liste-offres');
    offreList.innerHTML = ''

    for(let i = 0; i < offres.length; i++)
    {
        let offre = offres[i];

        let article = document.createElement('article');
        article.classList.add('offre');
        article.innerHTML = `
            <div class="c1">
                <span class="poste">` + offre['NomOffre'] + `</span>
                <span>` + offre['entreprise']['NomEntreprise'] + `</span>
                <span class="niveau">` + offre['NiveauOffre'] + `</span>
            </div>
            <div class="c2">
                <span class="domaine">` + offre['secteur']['NomSecteur'] + `</span>
                <span class="dates">` + offre['DateOffre'] + `</span>
            </div>
            <div class="c3">
                <ul class="competences">Compétences : ` +
            (offre["competences"].length > 0 ?
                offre["competences"].map(competence => `<li>` + competence['NomCompetence'] + `</li>`).join('') :
                'Non défini') + `
                </ul>
            </div>
            `;

        addEventTo(article, 'click', () => window.location.href = '/description-offre?offreId=' + offre['IdOffre']);

        offreList.appendChild(article)
    }

    setTotalPages(data['total_pages']);
}

function onWait()
{
    document.getElementById('liste-offres').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';
}