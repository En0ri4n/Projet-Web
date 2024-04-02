import { addEventTo } from "./main.js";

addEventTo(document, 'DOMContentLoaded', onReady);

function populateFilters()
{
    fetch('/api/offres?per_page=1000', { // TODO: mettre à jour tout ça bien
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Erreur lors de la récupération des filtres');
        }
    }).then(data => {
        let niveaux = [];
        data['offres'].forEach(offre => {
            niveaux.push(offre['NiveauOffre']);
        });

        document.getElementById('filter-niveau').innerHTML += Array.from(new Set(niveaux)).sort().map(niveau => { return `<option value="${niveau}">${niveau}</option>` }).join('');
    });
}

function onReady() {

    populateFilters();

    fetch('/api/offres', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Erreur lors de la récupération des offres');
        }
    }).then(data => {
        console.log(data);
        const offres = document.getElementById('liste-offres');
        offres.innerHTML = '';
        data['offres'].forEach(offre => {
            const div = document.createElement('article');
            div.classList.add('offre');
            div.innerHTML = `
                <div class="c1">
                    <span class="poste">` + offre["NomOffre"] + `</span>
                    <span class="entreprise">` + offre["IdEntreprise"] + `</span>
                    <span class="niveau">` + offre["NiveauOffre"] + `</span>
                </div>
                <div class="c2">
                    <span class="domaine">` + offre["IdSecteur"] + `</span>
                    <span class="dates">` + offre["DateOffre"] + `</span>
                </div>
                <div class="c3">
                </div>
                <div class="list-competences">
                    <ul class="competences">Compétences :
                        <li>competence 1</li>
                        <li>competence 2</li>
                    </ul>
                </div>
            `;

            offres.appendChild(div);

            addEventTo(div, 'click', () => window.location.href = '/description-offre?offreId=' + offre["IdOffre"]);
        });
    });
}