import {addEventTo} from "./main.js";
import {initPagination, setTotalPages, currentPage, reloadPagination} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

function populateFilters()
{
    fetch('/api/offres?per_page=1000', { // TODO: mettre à jour tout ça bien
        method: 'GET', headers: {
            'Content-Type': 'application/json'
        }
    }).then(response =>
            {
                if(response.ok)
                {
                    return response.json();
                }
                else
                {
                    throw new Error('Erreur lors de la récupération des filtres');
                }
            }).then(data =>
                    {
                        let niveaux = [];
                        data['offres'].forEach(offre =>
                                               {
                                                   niveaux.push(offre['NiveauOffre']);
                                               });

                        document.getElementById('filter-niveau').innerHTML += Array.from(new Set(niveaux)).sort().map(niveau => { return `<option value="${niveau}">${niveau}</option>` }).join('');
                    });
}

function onReady()
{
    populateFilters();

    initPagination(async () => {
        let response = await fetch('/api/offres?page=' + currentPage + '&per_page=10', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        let data = await response.json();

        console.log(data)

        const offres = document.getElementById('liste-offres');

        offres.innerHTML = '';

        setTotalPages(data['total_pages'])

        data['offres'].forEach(offre => {
            const div = document.createElement('article');
            div.classList.add('offre');
            div.innerHTML = `
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
                </div>
                <div class="list-competences">
                    <ul class="competences">Compétences : ` +
                (offre["competences"].length > 0 ?
            offre["competences"].map(competence => `<li>` + competence['NomCompetence'] + `</li>`).join('') :
                'Non défini') +`
                    </ul>
                </div>
            `;
            offres.appendChild(div);

            addEventTo(div, 'click', () => window.location.href = '/description-offre?offreId=' + offre["IdOffre"]);
        })
    });

    reloadPagination();
}