import {addEventTo} from "./main.js";
import {initPagination, setTotalPages, currentPage, reloadPagination} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

async function populateFilters()
{
    let entrepriseResponse = await fetch('/api/entreprises?per_page=1000', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let promotionResponse = await fetch('/api/promos?per_page=1000', { // TODO: mettre à jour tout ça bien
        method: 'GET', headers: {
            'Content-Type': 'application/json'
        }
    });

    let entrepriseData = await entrepriseResponse.json();
    let promotionData = await promotionResponse.json();

    console.log(entrepriseData)
    console.log(promotionData)

    let niveaux = [];
    let entreprises = [];
    let lieux = [];

    for(let i = 0; i < entrepriseData['entreprises'].length; i++)
    {
        const entreprise = entrepriseData['entreprises'][i];
        entreprises.push(entreprise['NomEntreprise']);
        entreprise['adresses'].forEach(adresse => lieux.push(adresse['Ville']));
    }

    for(let i = 0; i < promotionData['promotions'].length; i++)
    {
        const promotion = promotionData['promotions'][i];
        niveaux.push(promotion['NiveauPromotion']);
    }

    document.getElementById('filter-niveau').innerHTML += Array.from(new Set(niveaux)).sort().map(niveau => { return `<option value="${niveau}">${niveau}</option>` }).join('');
    document.getElementById('filter-entreprise').innerHTML += Array.from(new Set(entreprises)).sort().map(entreprise => { return `<option value="${entreprise}">${entreprise}</option>` }).join('');
    document.getElementById('filter-location').innerHTML += Array.from(new Set(lieux)).sort().map(lieu => { return `<option value="${lieu}">${lieu}</option>` }).join('');
}

function onReady()
{
    populateFilters();

    initPagination(() => document.getElementById('liste-offres').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>', filterOffres);

    reloadPagination();
}

addEventTo(document.getElementById('search-button'), 'click', (e) =>
{
    e.preventDefault();

    document.getElementById('liste-offres').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';

    filterOffres();
});

async function filterOffres()
{
    let self_response = await fetch('/api/users?self', {
        method: 'GET',
        headers: {
            'Content-type': 'application/json'
        }
    });
    let account = await self_response.json();

    let baseUrl = '/api/offres?page=' + currentPage + '&per_page=10';

    let nom = document.getElementById('filter-name').value;
    let entreprise = document.getElementById('filter-entreprise').value;
    let niveau = document.getElementById('filter-niveau').value;
    let date = document.getElementById('filter-date').value;
    let duree = document.getElementById('filter-duree').value;


    console.log(nom, entreprise, niveau, date, duree);

    let response = await fetch(baseUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await response.json();

    console.log(data)

    const offres = document.getElementById('liste-offres');
    offres.innerHTML = '';

    if (account['user_type']==='administrateur' || account['user_type']==='pilote'){
        offres.innerHTML = `<button class="add">Ajouter</button>`
    }

    setTotalPages(data['total_pages'])

    data['offres'].forEach(offre =>
                           {
                               const div = document.createElement('div');
                               div.classList.add('contener_row');
                               
                let html = `
                
                <article class="offre">
                        <div class="c1">
                            <span class="poste">` + offre["NomOffre"] + `</span>
                            <span class="entreprise"><h2>` + offre["entreprise"]["NomEntreprise"] + `</h2></span>
                            <span class="niveau">A` + offre["NiveauOffre"] + `</span>
                        </div>
                        <div class="c2">
                            <span class="domaine">` + offre["secteur"]["NomSecteur"] + `</span>
                            <span class="dates">` + offre["DateOffre"] + `</span>
                        </div>
                        <div class="c3">
                            <ul class="competences">Compétences : ` +
                            (offre["competences"].length > 0 ?
                                offre["competences"].map(competence => `<li>` + competence['NomCompetence'] + `</li>`).join('') :
                                'Non défini') + `
                            </ul>
                        </div>
                </article>
               
            `;
            if (account['user_type']==='administrateur' || account['user_type']==='pilote'){
                html += `<button class="delete">Supprimer</button>
                          <button class="update">Modifier</button>`
            }
            div.innerHTML = html;
                           offres.appendChild(div);


                               addEventTo(div, 'click', () => window.location.href = '/description-offre?offreId=' + offre["IdOffre"]);
                           })

}