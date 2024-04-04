import {addEventTo} from "./main.js";
import {currentPage, initPagination, reloadPagination, setTotalPages} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

async function onReady()
{

    initPagination(() => document.getElementById('liste-utilisateurs').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>', filterUsers);

    reloadPagination();
}

addEventTo(document.getElementById('search-button'), 'click', (e) =>
{
    e.preventDefault();

    document.getElementById('liste-utilisateurs').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';

    filterUsers();
});

async function filterUsers()
{
    let self_response = await fetch('/api/users?self', {
        method: 'GET',
        headers: {
            'Content-type': 'application/json'
        }
    });

    let account = await self_response.json();

    let baseUrl = '/api/users?page=' + currentPage + '&per_page=10';

    let nom = document.getElementById('filter-nom').value;

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

    const utilisateurs = document.getElementById('liste-utilisateurs');
    utilisateurs.innerHTML = '';

    if(account['user_type'] === 'administrateur' || account['user_type'] === 'pilote')
    {
        let add = document.createElement('button');
        add.classList.add('add');
        add.innerHTML = 'Ajouter';
        addEventTo(add, 'click', () => window.location.href = '/creer-profil');
        utilisateurs.appendChild(add);
    }

    setTotalPages(data['total_pages'])

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


        utilisateurs.appendChild(contener);
    }
}

