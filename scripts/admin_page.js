import {addEventTo} from "./main.js";
import {currentPage, initPagination, reloadPagination, setTotalPages} from "./pagination.js";

addEventTo(document, 'DOMContentLoaded', onReady);

async function onReady()
{

    initPagination(() => document.getElementById('liste-all').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>', filterAll);

    reloadPagination();
}

addEventTo(document.getElementById('search-button'), 'click', (e) =>
{
    e.preventDefault();

    document.getElementById('liste-all').innerHTML = '<img src="/assets/loading.gif" alt="loading" id="loading"/>';
    
    filterAll();
    
});

async function filterAll()
{

    let self_response = await fetch('/api/users?self', {
        method: 'GET',
        headers: {
            'Content-type': 'application/json'
        }
    });
    let account = await self_response.json();


    let userUrl = '/api/users?page=' + currentPage + '&per_page=10';
    let offreUrl = '/api/offres?page=' + currentPage + '&per_page=10';
    let enterUrl = '/api/entreprises?page=' + currentPage + '&per_page=10';


    let nomUser = document.getElementById('filter-nomUtilisateur').value;
    if(nomUser !== ''){
        userUrl += '&Nom=' + nomUser;
    }

    let nomEnter = document.getElementById('filter-nomUtilisateur').value;
    if(nomEnter !== ''){
        enterUrl += '&Nom=' + nomEnter;
    }
    // console.log(baseUrl);

    let responseUser = await fetch(userUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    let dataUser = await responseUser.json();
    console.log(dataUser);

    let responseOffre = await fetch(offreUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    let dataOffre = await responseOffre.json();
    console.log(dataOffre);

    let responseEnter = await fetch(enterUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    let dataEnter = await responseEnter.json();
    console.log(dataEnter);



    const utilisateurs = document.getElementById('liste-utilisateurs');
    utilisateurs.innerHTML = '';

    const entreprises = document.getElementById('liste-entreprises');
    entreprises.innerHTML = '';

    const offres = document.getElementById('liste-offres');
    offres.innerHTML = '';

    setTotalPages(dataEnter['total_pages']+dataOffre['total_pages']+dataUser['total_pages']);


    //utilisateurs
    if (account['user_type']==='administrateur' || account['user_type']==='pilote'){
        let add = document.createElement('button');
        add.classList.add('add');
        add.innerHTML = 'Ajouter';
        addEventTo(add, 'click', () => window.location.href = '/creer-profil');
        utilisateurs.appendChild(add);
    }

    for(let i = 0; i < dataUser['users'].length; i++)
    {
        const utilisateur = dataUser['users'][i];

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
            let supprimer = document.createElement('button1');
            supprimer.classList.add('supprimer');
            supprimer.innerHTML = 'Supprimer';
            addEventTo(supprimer, 'click', () => window.location.href = '/creer-profil');//TODO : remplacer 'creer-profil' par une requete SQL
            utilisateurs.appendChild(supprimer);

            let modifier = document.createElement('button2');
            modifier.classList.add('modifier');
            modifier.innerHTML = 'Supprimer';
            addEventTo(modifier, 'click', () => window.location.href = '/modifier-profil');
            utilisateurs.appendChild(modifier);
                              }
                              div.innerHTML = html;

                              addEventTo(div, 'click', () =>
                              {
                                  window.location.href = '/profil?userId=' + utilisateur["IdUtilisateur"];
                              });

        utilisateurs.appendChild(div);
    }


    //entreprises
    if (account['user_type']==='administrateur' || account['user_type']==='pilote'){
        let add = document.createElement('button');
        add.classList.add('add');
        add.innerHTML = 'Ajouter';
        addEventTo(add, 'click', () => window.location.href = '/creer-entreprise');
        utilisateurs.appendChild(add);
    }

    for(let i = 0; i < dataEnter['entreprises'].length; i++)
    {
        const entreprise = dataEnter['entreprises'][i];

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
            modifier.innerHTML = 'Supprimer';
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

    //offres
    if (account['user_type']==='administrateur' || account['user_type']==='pilote'){
        let add = document.createElement('button');
        add.classList.add('add');
        add.innerHTML = 'Ajouter';
        addEventTo(add, 'click', () => window.location.href = '/creer-offre');
        utilisateurs.appendChild(add);
    }
    
    dataOffres['offres'].forEach(offre =>
        {
            const div = document.createElement('div');
            div.classList.add('contener_row');
            
let html = `

<article class="offre">
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
         <ul class="competences">Compétences : ` +
         (offre["competences"].length > 0 ?
             offre["competences"].map(competence => `<li>` + competence['NomCompetence'] + `</li>`).join('') :
             'Non défini') + `
         </ul>
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
    modifier.innerHTML = 'Supprimer';
    addEventTo(modifier, 'click', () => window.location.href = '/modifier-offre');
    utilisateurs.appendChild(modifier);
}
div.innerHTML = html;
        offres.appendChild(div);


            addEventTo(div, 'click', () => window.location.href = '/description-offre?offreId=' + offre["IdOffre"]);
        })
}

