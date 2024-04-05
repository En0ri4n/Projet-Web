import {addEventTo} from "./main.js";
import {currentPage, initPagination, reloadPagination, setTotalPages} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

async function onReady()
{
    initPagination(0, () => document.getElementById('liste-utilisateur').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>', filterUsers);
    initPagination(1, () => document.getElementById('liste-entreprise').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>', filterEntreprises);
    initPagination(2, () => document.getElementById('liste-offre').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>', filterOffres);

    reloadPagination();
}

addEventTo(document.getElementById('users-search-button'), 'click', (e) =>
{
    e.preventDefault();

    document.getElementById('liste-utilisateurs').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';
    
    filterUsers();
});

addEventTo(document.getElementById('entreprise-search-button'), 'click', (e) =>
{
    e.preventDefault();

    document.getElementById('liste-entreprises').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';

    filterEntreprises();
});

addEventTo(document.getElementById('offre-search-button'), 'click', (e) =>
{
    e.preventDefault();

    document.getElementById('liste-offres').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';

    filterOffres();
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

    let nom = document.getElementById('filter-nomEntreprise').value;

    if(nom !== '')
        baseUrl += '&Nom=' + nom;

    // console.log(baseUrl);

    let response = await fetch(baseUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await response.json();

    // console.log(data);

    const listeEntrepriseElement = document.getElementById('liste-entreprises');
    listeEntrepriseElement.innerHTML = '';

    if(account['user_type'] === 'administrateur' || account['user_type'] === 'pilote')
    {
        let add = document.createElement('button');
        add.setAttribute('class', 'add');
        add.innerHTML = 'Ajouter une entreprise';
        addEventTo(add, 'click', () => window.location.href = '/poster_entreprise');
    }

    if(data['entreprises'].length === 0)
    {
        const h1 = document.createElement('h1');
        h1.innerHTML = 'Aucune entreprise trouvée :(';
        listeEntrepriseElement.appendChild(h1);
    }

    setTotalPages(1, data['total_pages'])

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


export async function filterUsers()
{
    let self_response = await fetch('/api/users?self', {
        method: 'GET',
        headers: {
            'Content-type': 'application/json'
        }
    });

    let account = await self_response.json();

    let baseUrl = '/api/users?page=' + currentPage[0] + '&per_page=10';

    let nom = document.getElementById('filter-nomUtilisateur').value;

    if(nom !== '')
        baseUrl += '&Nom=' + nom;

    // console.log(baseUrl);

    let response = await fetch(baseUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await response.json();

    console.log(data);

    const listeUtilisateurElement = document.getElementById('liste-utilisateur');
    listeUtilisateurElement.innerHTML = '';

    if(account['user_type'] === 'administrateur' || account['user_type'] === 'pilote')
    {
        let add = document.createElement('button');
        add.classList.add('add');
        add.innerHTML = 'Ajouter';
        addEventTo(add, 'click', () => window.location.href = '/creer-profil');
        listeUtilisateurElement.appendChild(add);
    }

    if(data['users'].length === 0)
    {
        const h1 = document.createElement('h1');
        h1.innerHTML = 'Aucun utilisateur trouvé :(';
        listeUtilisateurElement.appendChild(h1);
    }

    setTotalPages(0, data['total_pages'])

    for(let i = 0; i < data['users'].length; i++)
    {
        const utilisateur = data['users'][i];

        const contener = document.createElement('div');
        contener.classList.add("contener_row");

        let article = document.createElement('article');
        article.classList.add(utilisateur['user_type']);
        article.innerHTML = `
                                                        <img src="/assets/profil.png" alt="Etudiant">
                                                        <div class="c1">
                                                            <span class="bold">` + utilisateur['Nom'] + `</span>
                                                            ` + (utilisateur['user_type'] === 'etudiant' ? `<span>Domaine : ` + utilisateur['promotion']['TypePromotion'] + `</span>` : '') + `
                                                        </div>
                                                        <div class="c2">
                                                            <span class="bold">` + utilisateur['Prenom'] + `</span>
                                                            ` + (utilisateur['user_type'] === 'etudiant' ? `<span>Promotion : ` + utilisateur['promotion']['NomPromotion'] + `</span>` : '') + `
                                                        </div>
                                                `;

        addEventTo(article, 'click', () => window.location.href = '/profil?userId=' + utilisateur["IdUtilisateur"]);

        contener.appendChild(article);

        if(account['user_type'] === 'administrateur' || account['user_type'] === 'pilote')
        {
            let supprimer = document.createElement('button');
            supprimer.classList.add('delete');
            supprimer.innerHTML = 'Supprimer';
            addEventTo(supprimer, 'click', () =>
            {
                fetch('/api/users', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({IdUtilisateur: utilisateur["IdUtilisateur"]})
                });

                document.getElementById('liste-utilisateurs').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';

                filterUsers();
            });
            contener.appendChild(supprimer);

            let modifier = document.createElement('button');
            modifier.classList.add('update');
            modifier.innerHTML = 'Modifier';
            addEventTo(modifier, 'click', () => window.location.href = '/modifier-profil?userId=' + utilisateur["IdUtilisateur"]);
            contener.appendChild(modifier);
        }


        listeUtilisateurElement.appendChild(contener);
    }
}


export async function filterOffres()
{
    let self_response = await fetch('/api/users?self', {
        method: 'GET',
        headers: {
            'Content-type': 'application/json'
        }
    });
    let account = await self_response.json();

    let baseUrl = '/api/offres?page=' + currentPage[0] + '&per_page=10';

    let nom = document.getElementById('filter-nomOffre').value;

    if(nom !== '')
        baseUrl += '&name=' + nom;

    let response = await fetch(baseUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await response.json();

    // console.log(data)

    const listeOffreElement = document.getElementById('liste-offre');
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

    setTotalPages(2, data['total_pages'])

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