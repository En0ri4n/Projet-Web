import {addEventTo} from "./main.js";
import {currentPage, initPagination, reloadPagination, setTotalPages} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

async function onReady()
{

    initPagination(() => document.getElementById('liste-entreprises').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>', filterEntreprises);

    reloadPagination();
}

addEventTo(document.getElementById('search-button'), 'click', (e) =>
{
    e.preventDefault();

    document.getElementById('liste-entreprises').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';

    filterEntreprises();
});

async function filterEntreprises()
{

    let self_response = await fetch('/api/users?self', {
        method: 'GET',
        headers: {
            'Content-type': 'application/json'
        }
    });

    let account = await self_response.json();


    let baseUrl = '/api/entreprises?page=' + currentPage + '&per_page=10';

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

    const entreprises = document.getElementById('liste-entreprises');
    entreprises.innerHTML = '';

    if (account['user_type']==='administrateur' || account['user_type']==='pilote'){
        let add = document.createElement('button');
        add.classList.add('add');
        add.innerHTML = 'Ajouter';
        addEventTo(add, 'click', () => window.location.href = '/creer-profil');
        utilisateurs.appendChild(add);
    }

    setTotalPages(data['total_pages'])

    for(let i = 0; i < data['entreprises'].length; i++)
    {
        const entreprise = data['entreprises'][i];

        const div = document.createElement('div');
        div.classList.add("contener_row");
        let html = `
        <article class="offre">
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
                                            addEventTo(modifier, 'click', () => window.location.href = '/modifier-entreprise');
                                            utilisateurs.appendChild(modifier);
                              }
                              div.innerHTML = html;

                              addEventTo(div, 'click', () =>
                              {
                                  window.location.href = '/profil?userId=' + utilisateur["IdUtilisateur"];
                              });

        entreprises.appendChild(div);
    }
}

