import {addEventTo} from "./main.js";
import {initPagination, setTotalPages, currentPage, reloadPagination} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

async function populateFilters()
{
    let entrepriseResponse = await fetch('/api/entreprises?column=NomEntreprise', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let adresseResponse = await fetch('/api/adresses?column=Ville', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let promotionResponse = await fetch('/api/promos?column=NiveauPromotion', {
        method: 'GET', headers: {
            'Content-Type': 'application/json'
        }
    });

    let entrepriseData = await entrepriseResponse.json();
    let adresseData = await adresseResponse.json();
    let promotionData = await promotionResponse.json();

    let lieux = adresseData['values'];
    let entreprises = entrepriseData['values'];
    let niveaux = promotionData['values'];

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
        let add = document.createElement('button');
        add.classList.add('add');
        add.innerHTML = 'Ajouter';
        addEventTo(add, 'click', () => window.location.href = '/creer-offre');
        utilisateurs.appendChild(add);
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
                
                                            let supprimer = document.createElement('button1');
                                            supprimer.classList.add('supprimer');
                                            supprimer.innerHTML = 'Supprimer';
                                            addEventTo(supprimer, 'click', () => window.location.href = '/creer-profil');//TODO : remplacer 'creer-profil' par une requete SQL
                                            utilisateurs.appendChild(supprimer);

                                            let modifier = document.createElement('button2');
                                            modifier.classList.add('modifier');
                                            modifier.innerHTML = 'Modifier';
                                            addEventTo(modifier, 'click', () => window.location.href = '/modifier-offre');
                                            utilisateurs.appendChild(modifier);
            }
            div.innerHTML = html;
                           offres.appendChild(div);


                               addEventTo(div, 'click', () => window.location.href = '/description-offre?offreId=' + offre["IdOffre"]);
                           })

}