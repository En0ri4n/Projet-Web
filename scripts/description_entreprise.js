import { addEventTo } from "./main.js";
import {currentPage, initPagination, reloadPagination, setTotalPages} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

async function onReady() {
    initPagination(() => document.getElementById('liste-evaluations').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>', filterEval);

    reloadPagination();
}

async function filterEval() {

    let current_response = await fetch(window.location.href, {
        method: 'GET',
        headers: {
            'Content-type': 'application/json'
        }
    });

    let entreprise = await current_response.json();
    console.log(entreprise)

    let baseUrl = '/api/evaluations?page=' + currentPage + '&per_page=3&IdEntreprise=' + entreprise['IdEntreprise'] ;
    console.log(baseUrl)
    let response = await fetch(baseUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await response.json();

    const entreprises = document.getElementById('liste-evaluations');
    entreprises.innerHTML = '';
    for (let i = 0; i < data['evaluation'].length; i++) {
        const evaluation = data['evaluation'][i];

        const avis = document.createElement('div');
        avis.classList.add("avis");
        avis.innerHTML = `
                            <span class="note">` + evaluation["Note"] + `</span>
                            <span class="commentaire">` + evaluation["commentaire"] + `</span>
                        
                                                `;
    }
}