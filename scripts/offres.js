import { addEventTo } from "./main.js";

addEventTo(document, 'DOMContentLoaded', () => onReady);

function onReady() {
    console.log('offres.js is ready');
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
        const offres = document.getElementById('offres');
        data.forEach(offre => {
            const div = document.createElement('article');
            div.classList.add('offre');
            div.innerHTML = `
                <div class="c1">
                    <span class="poste">` + offre["NomOffre"] + `</span>
                    <span class="entreprise">` + offre["NomOffre"] + `</span>
                    <span class="niveau">` + offre["NomOffre"] + `</span>
                </div>
                <div class="c2">
                    <span class="domaine">` + offre["NomOffre"] + `</span>
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
        });
    });
}