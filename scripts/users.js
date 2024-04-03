import {addEventTo} from "./main.js";

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady() {
    fetch('/api/users?per_page=100', { // TODO: Mettre à jour tout ça bien
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Erreur lors de la récupération des utilisateurs');
        }
    }).then(data => {
        console.log(data);
        const utilisateurs = document.getElementById('liste-utilisateurs');
        utilisateurs.innerHTML = '';
        data['users'].forEach(utilisateur => {
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

            addEventTo(div, 'click', () => {
                window.location.href = '/profil?userId=' + utilisateur["IdUtilisateur"];
            });

            utilisateurs.appendChild(div);
        });
    });

}