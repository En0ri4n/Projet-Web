import {addEventTo} from "./main.js";
import {initPagination, setTotalPages, currentPage, reloadPagination} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

async function populateFilters()
{
    let entrepriseResponse = await fetch('/api/entreprises?column=IdEntreprise,NomEntreprise', {
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
    document.getElementById('filter-entreprise').innerHTML += Array.from(new Set(entreprises)).sort().map(entreprise => { return `<option value="${entreprise[0]}">${entreprise[1]}</option>` }).join('');
    document.getElementById('filter-location').innerHTML += Array.from(new Set(lieux)).sort().map(lieu => { return `<option value="${lieu}">${lieu}</option>` }).join('');
}

function onReady()
{
    populateFilters();

    initPagination(0, onWait, filterOffres);

    reloadPagination();
}

function onWait()
{
    document.getElementById('liste-offres').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';
}

let filtered = false;

addEventTo(document.getElementById('reset-filter'), 'click', () =>
{
    document.getElementById('filter-name').value = '';
    document.getElementById('filter-entreprise').value = '';
    document.getElementById('filter-niveau').value = '';
    document.getElementById('filter-date').value = '';
    document.getElementById('filter-duree').value = '';

    filtered = false;

    onWait();
    filterOffres();
});

addEventTo(document.getElementById('search-button'), 'click', (e) =>
{
    e.preventDefault();

    filtered = true;

    onWait();
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

    let baseUrl = '/api/offres?page=' + currentPage[0] + '&per_page=10';

    if(filtered)
    {
        let nom = document.getElementById('filter-name').value;
        let entreprise = document.getElementById('filter-entreprise').value;
        let niveau = document.getElementById('filter-niveau').value;
        let date = document.getElementById('filter-date').value;
        let duree = document.getElementById('filter-duree').value;

        // console.log(nom, entreprise, niveau, date, duree);

        if(nom !== '')
            baseUrl += '&name=' + nom;

        if(entreprise !== '')
            baseUrl += '&company=' + entreprise;

        if(niveau !== '')
            baseUrl += '&level=' + niveau;

        if(date !== '')
            baseUrl += '&date=' + date;

        if(duree !== '')
            baseUrl += '&duration=' + duree;
    }

    let response = await fetch(baseUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await response.json();

    // console.log(data)

    const listeOffreElement = document.getElementById('liste-offres');
    listeOffreElement.innerHTML = '';

    if (account['user_type']==='administrateur' || account['user_type']==='pilote')
    {
        let add = document.createElement('button');
        add.classList.add('add');
        add.innerHTML = 'Ajouter';
        addEventTo(add, 'click', () => window.location.href = '/creer-offre');
        listeOffreElement.appendChild(add);
    }

    if(data['offres'].length === 0)
    {
        const h1 = document.createElement('h1');
        h1.innerHTML = 'Aucune offre trouvée :(';
        listeOffreElement.appendChild(h1);
    }

    setTotalPages(0, data['total_pages'])

    for(let i = 0; i < data['offres'].length; i++)
    {
        const offre = data['offres'][i];

        const contener = document.createElement('div');
        contener.classList.add('contener_row');

        let article = document.createElement('article');
        article.classList.add('offre');

        article.innerHTML = `
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
            `;

        addEventTo(article, 'click', () => window.location.href = '/description-offre?offreId=' + offre["IdOffre"]);

        contener.appendChild(article);

        if (account['user_type'] === 'administrateur' || account['user_type'] === 'pilote')
        {
            let deleteButton = document.createElement('button');
            deleteButton.classList.add('delete');
            deleteButton.innerHTML = 'Supprimer';
            addEventTo(deleteButton, 'click', () => {
                fetch('/api/offres', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({IdOffre: offre["IdOffre"]})
                }).then(() => filterOffres());
            });
            contener.appendChild(deleteButton);

            let updateButton = document.createElement('button');
            updateButton.classList.add('update');
            updateButton.innerHTML = 'Modifier';
            addEventTo(updateButton, 'click', () => window.location.href = '/modifier-offre?IdOffre=' + offre["IdOffre"]);
            contener.appendChild(updateButton);
        }

        listeOffreElement.appendChild(contener);
    }
}