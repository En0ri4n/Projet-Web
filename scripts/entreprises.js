import {addEventTo} from "./main.js";
import {currentPage, initPagination, reloadPagination, setTotalPages} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

async function populateFilters()
{
    let entrepriseResponse = await fetch('/api/entreprises?column=IdEntreprise,NomEntreprise', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let secteurRes = await fetch('/api/entreprises?column=IdSecteur,NomSecteur', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let entrepriseData = await entrepriseResponse.json();

    let secteurData = await secteurRes.json();


    let entreprises = entrepriseData['values'];

    let secteurs = secteurData['values'];

    console.log(secteurs )


    document.getElementById('filter-secteur').innerHTML += Array.from(new Set(secteurs)).sort().map(secteur => { return `<option value="${secteur[0]}">${secteur[1]}</option>` }).join('');
}

async function onReady()
{
    populateFilters()

    initPagination(0, onWait, filterEntreprises);

    reloadPagination();
}

function onWait()
{
    document.getElementById('liste-entreprises').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>'
}
addEventTo(document.getElementById('search-button'), 'click', (e) =>
{
    e.preventDefault();

    document.getElementById('liste-entreprises').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';

    filtered = true;

    filterEntreprises();
});

let filtered = false;
addEventTo(document.getElementById('reset-filter'), 'click', () =>
{
    document.getElementById('filter-name').value = '';
    document.getElementById('filter-secteur').value = '';

    filtered = false;

    onWait();
    filterEntreprises();
});

export async function filterEntreprises()
{
    let self_response = await fetch('/api/users?self', {
        method: 'GET',
        headers: {
            'Content-type': 'application/json'
        }
    });

    let account = await self_response.json();

    let baseUrl = '/api/entreprises?page=' + currentPage[0] + '&per_page=10';

    if(filtered) {
        let nom = document.getElementById('filter-nomEntreprise').value;
        let secteur = document.getElementById('filter-secteur').value;

        // console.log(nom, entreprise, niveau, date, duree);

        if (nom !== '')
            baseUrl += '&name=' + nom;

        if (secteur !== '')
            baseUrl += '&IdSecteur=' + secteur;
    }

    // console.log(baseUrl);

    let response = await fetch(baseUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await response.json();

    console.log(data);

    const listeEntrepriseElement = document.getElementById('liste-entreprises');
    listeEntrepriseElement.innerHTML = '';

    if(account['user_type'] === 'administrateur' || account['user_type'] === 'pilote')
    {
        let add = document.createElement('button');
        add.setAttribute('class', 'add');
        add.innerHTML = 'Ajouter une entreprise';
        addEventTo(add, 'click', () => window.location.href = '/poster_entreprise');
    }

    console.log(data)

    if(data['entreprises'].length === 0)
    {
        const h1 = document.createElement('h1');
        h1.innerHTML = 'Aucune entreprise trouvée :(';
        listeEntrepriseElement.appendChild(h1);
    }

    setTotalPages(0, data['total_pages'])

    for(let i = 0; i < data['entreprises'].length; i++)
    {
        const entreprise = data['entreprises'][i];

        const contener = document.createElement('div');
        contener.classList.add("contener_row");

        let article = document.createElement('article');
        article.classList.add('offre');

        article.innerHTML = `
                        <div class="c1">
                            <span class="poste">` + entreprise["NomEntreprise"] + `</span>
                            <span class="niveau">` + entreprise["Statut"] + `</span>
                        </div>
                        <div class="c2">
                            <span class="domaine">` + entreprise["MailEntreprise"] + `</span>
                            <span class="dates">` + entreprise["TelephoneEntreprise"] + `</span>
                        </div>
                        <div class="c3">
                            <span class="dates">` + entreprise["TelephoneEntreprise"] + `</span>
                        </div>
                                                `;


        addEventTo(article, 'click', () => window.location.href = '/description-entreprise?IdEntreprise=' + entreprise["IdEntreprise"]);

        contener.appendChild(article);

        if(account['user_type'] === 'administrateur' || account['user_type'] === 'pilote')
        {
            let deleteButton = document.createElement('button');
            deleteButton.classList.add('delete');
            deleteButton.innerHTML = 'Supprimer';
            addEventTo(deleteButton, 'click', () =>
            {
                fetch('/api/entreprises', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        IdEntreprise: entreprise["IdEntreprise"]
                    })
                }).then(() => filterEntreprises());
            });

            contener.appendChild(deleteButton);

            let updateButton = document.createElement('button');
            updateButton.classList.add('update');
            updateButton.innerHTML = 'Modifier';
            addEventTo(updateButton, 'click', () => window.location.href = '/modifier-entreprise?IdEntreprise=' + entreprise["IdEntreprise"]);
            contener.appendChild(updateButton);
        }

        listeEntrepriseElement.appendChild(contener);
    }
}

