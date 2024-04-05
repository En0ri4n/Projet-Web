import {addEventTo} from "./main.js";
import {initPagination, reloadPagination, setTotalPages, currentPage, totalPages} from "./pagination.js";


addEventTo(document, 'DOMContentLoaded', onReady);

async function onReady()
{
    initPagination(0, onWait, filterOffres);
    initPagination(1, () => document.getElementById('liste-evaluations').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>', filterEval);

    reloadPagination();
}

async function filterEval()
{
    const urlParams = new URLSearchParams(window.location.search);
    if(!urlParams.has('IdEntreprise'))
        return;

    let baseUrl = '/api/evaluations?page=' + currentPage[1] + '&per_page=3&IdEntreprise=' + urlParams.get('IdEntreprise');

    let response = await fetch(baseUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await response.json();

    console.log(data)

    setTotalPages(1, data['total_pages']);

    const evaluationListElement = document.getElementById('liste-evaluations');
    evaluationListElement.innerHTML = '';

    for(let i = 0; i < data['evaluations'].length; i++)
    {
        const evaluation = data['evaluations'][i];
        const avis = document.createElement('div');
        avis.classList.add("avis");
        avis.innerHTML = `
                            <span class="note">` + evaluation["Note"] + `</span>
                            <span class="commentaire">` + evaluation["Commentaire"] + `</span>
                        
                                                `;
        evaluationListElement.appendChild(avis);
    }
}

async function filterOffres()
{
    const urlParams = new URLSearchParams(window.location.search);
    if(!urlParams.has('IdEntreprise'))
        return;

    let url = '/api/offres?page=' + currentPage[0] + '&per_page=3&company=' + urlParams.get('IdEntreprise');

    let res = await fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await res.json();

    console.log(data)

    setTotalPages(0, data['total_pages']);

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
}

function onWait()
{
    document.getElementById('liste-offres').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';
}

addEventTo(document.getElementById('btn-ajouter-avis'), 'click', async (e) =>
{
    e.preventDefault();

    const urlParams = new URLSearchParams(window.location.search);
    if(!urlParams.has('IdEntreprise'))
        return;

    let response = await fetch('/api/evaluations', {
        method: 'POST',
        body: new FormData(document.getElementById('form-avis')),
    })

    let data = await response.json();

    if(data['statut'] === 'success')
    {
        alert('Avis ajouté avec succès');
        filterEval();
    }
    else
    {
        alert('Erreur lors de l\'ajout de l\'avis');
    }
});