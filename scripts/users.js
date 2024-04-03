import {addEventTo} from "./main.js";
import {currentPage, initPagination, reloadPagination, setTotalPages} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

async function onReady()
{

    initPagination(filterUsers);

    reloadPagination();
}

addEventTo(document.getElementById('search-button'), 'click', (e) =>
{
    e.preventDefault();
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

    if (account['user_type']==='administrateur' || account['user_type']==='pilote'){
        utilisateurs.innerHTML = `<button class="add">Ajouter</button>`
    }

    setTotalPages(data['total_pages'])

    for(let i = 0; i < data['users'].length; i++)
    {
        const utilisateur = data['users'][i];

        const div = document.createElement('div');
        div.classList.add("contener_row");
        let html = `
                                                    <article class="` + utilisateur['user_type'] + `">
                                                        <img src="/assets/profil.png" alt="Etudiant">
                                                        <div class="c1">
                                                            <span class="bold">` + utilisateur['Nom'] + `</span>
                                                            ` + (utilisateur['user_type'] === 'etudiant' ? `<span>Domaine : `+ utilisateur['promotion']['TypePromotion'] + `</span>` : '') + `
                                                        </div>
                                                        <div class="c2">
                                                            <span class="bold">` + utilisateur['Prenom'] + `</span>
                                                            ` + (utilisateur['user_type'] === 'etudiant' ? `<span>Promotion : `+ utilisateur['promotion']['NomPromotion'] + `</span>` : '') + `
                                                        </div>
                                                    </article>
                                                `;

        if (account['user_type']==='administrateur' || account['user_type']==='pilote'){
                                  html += `<button class="delete">Supprimer</button>
                                            <button class="update">Modifier</button>`
                              }
                              div.innerHTML = html;

                              addEventTo(div, 'click', () =>
                              {
                                  window.location.href = '/profil?userId=' + utilisateur["IdUtilisateur"];
                              });

        utilisateurs.appendChild(div);
    }
}

