import { addEventTo } from "./main.js";
import {currentPage, initPagination, reloadPagination, setTotalPages} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady()
{
    initPagination(0, onWait, filterWishlist);

    reloadPagination()
}

function onWait()
{
    document.getElementById('liste-offres-wishlist').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';
}

var display = false;

async function filterWishlist()
{
    const urlParams = new URLSearchParams(window.location.search);
    if(!urlParams.has('userId'))
        return;

    let url = '/api/wishlist?page=' + currentPage[0] + '&per_page=3&IdEtudiant=' + urlParams.get('userId');

    let res = await fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await res.json();

    console.log(data)

    setTotalPages(0, data['total_pages']);

    let wishlist = data['wishlist'];
    let wishlistList = document.getElementById('liste-offres-wishlist');

    display = true;

    for(let i = 0; i < wishlist.length; i++)
    {
        let resOffre = await fetch('/api/offres?IdOffre' + wishlist[i]['IdOffre'], {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        let offreRes = await resOffre.json();

        let offre = offreRes['offres'][0];

        if(display)
        {
            wishlistList.innerHTML = '';
            display = false;
        }

        let article = document.createElement('article');
        article.classList.add('offre');
        article.innerHTML = `
            <div class="c1">
                <span class="poste">` + offre['NomOffre'] + `</span>
                <span>` + offre['entreprise']['NomEntreprise'] + `</span>
                <span class="niveau">` + offre['NiveauOffre'] + `</span>
            </div>
            <div class="c2">
                <span class="domaine">` + offre['secteur']['NomSecteur'] + `</span>
                <span class="dates">` + offre['DateOffre'] + `</span>
            </div>
            <div class="c3">
                <ul class="competences">Compétences : ` +
            (offre["competences"].length > 0 ?
                offre["competences"].map(competence => `<li>` + competence['NomCompetence'] + `</li>`).join('') :
                'Non défini') + `
                </ul>
            </div>
            `;

        addEventTo(article, 'click', () => window.location.href = '/description-offre?offreId=' + offre['IdOffre']);

        wishlistList.appendChild(article)
    }
}
