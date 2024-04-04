import {setCustomValidator, addEventTo} from './main.js';

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady()
{
    setCustomValidator(document.getElementById('nom_entreprise'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom de lentreprise doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('siret'), /^[0-9\s.]{9}$/, 'Le numero de Siret doit contenir 9 chiffres'); 
    setCustomValidator(document.getElementById('domaine_tuteur'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du domaine doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('nom_entreprise'), /^[a-zA-Z0-9\s._-]{3,}$/, 'Le nom de lentreprise doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('description_entreprise_tuteur'), /^[a-zA-Z\s._-]{50,}$/, 'La description de lentreprise doit au moins contenir 3 caractères');
}


let nbrAdressesSecondaire = 0;
document.getElementById("button-add-adress").addEventListener("click",addSecondaryAdress)
function addSecondaryAdress(){
    nbrAdressesSecondaire++;
    document.getElementById("secondary-adresses").innerHTML +=`<div class="adresse-input" id="adresse-secondaire`+nbrAdressesSecondaire+`">
                        <label for="location-numero`+nbrAdressesSecondaire+`">Adresse Secondaire n° `+nbrAdressesSecondaire+`</label>
                        <input type="text" class="form-input" id="location`+nbrAdressesSecondaire+`-numero" placeholder="N°" required>
                        <input type="text" class="form-input" id="location`+nbrAdressesSecondaire+`-rue" placeholder="Rue" required>
                        <input type="text" class="form-input" id="location`+nbrAdressesSecondaire+`-ville" placeholder="Ville" required>
                        <input type="text" class="form-input" id="location`+nbrAdressesSecondaire+`-cp" placeholder="Code Postal" required>
                        <input type="text" class="form-input" id="location`+nbrAdressesSecondaire+`-pays" placeholder="Pays" required>
                    </div>`;
}

document.getElementById("button-remove-adress").addEventListener("click",removeSecondaryAdress)
function removeSecondaryAdress(){
    if (nbrAdressesSecondaire > 0){
    document.getElementById("adresse-secondaire"+nbrAdressesSecondaire).remove();
    nbrAdressesSecondaire--;
    }
}

let nbrDomaines = 1;
document.getElementById("button-add-domain").addEventListener("click",addDomain)
function addDomain(){
    nbrDomaines++;
    document.getElementById("domaines").innerHTML +=`<input class="form-input" id="domaine`+nbrDomaines+`" placeholder="Domaine n°`+nbrDomaines+`">`;
}

document.getElementById("button-remove-domain").addEventListener("click",removeDomain)
function removeDomain(){
    if (nbrDomaines > 1){
    document.getElementById("domaine"+nbrDomaines).remove();
    nbrDomaines--;
    }
}