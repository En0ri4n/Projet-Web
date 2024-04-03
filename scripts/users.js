import {addEventTo} from "./main.js";
import {currentPage, initPagination, reloadPagination, setTotalPages} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady() {

    initPagination(filterUsers);

    reloadPagination();
}

async function filterUsers()
{
    let baseUrl = '/api/users?page=' + currentPage + '&per_page=10';

    let nom = document.getElementById('filter-nom').value;
    let prenom = document.getElementById('filter-prenom').value;
    let email = document.getElementById('filter-email').value;
    let role = document.getElementById('filter-role').value;

    console.log(nom, prenom, email, role);

    let response = await fetch('/api/users?page=' + currentPage + '&per_page=10', { // TODO: Mettre à jour tout ça bien
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await response.json();

    // console.log(data);

    const utilisateurs = document.getElementById('liste-utilisateurs');
    utilisateurs.innerHTML = '';

    setTotalPages(data['total_pages'])

    data['users'].forEach(utilisateur =>
                          {
                              const div = document.createElement('div');
                              div.classList.add("contener_row");
                              div.innerHTML = `
                <article class="` + utilisateur['user_type'] + `">
                    <img src="/assets/profil.png" alt="Etudiant">
                    <div class="c1">
                        <span class="bold">` + utilisateur['Nom'] + `</span>
                        <span>Domaine2</span>
                    </div>
                    <div class="c2">
                        <span class="bold">` + utilisateur['Prenom'] + `</span>
                        <span>AnnéeEtudes2</span>
                    </div>
                </article>
            `;

                              addEventTo(div, 'click', () =>
                              {
                                  window.location.href = '/profil?userId=' + utilisateur["IdUtilisateur"];
                              });

                              utilisateurs.appendChild(div);
                          });
}

