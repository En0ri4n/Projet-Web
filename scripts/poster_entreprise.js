import {setCustomValidator, addEventTo} from './main.js';

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady()
{
    setCustomValidator(document.getElementById('nom-entreprise'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom de lentreprise doit au moins contenir 3 caractères');
    // setCustomValidator(document.getElementById('siret'), /^[0-9\s.]{9}$/, 'Le numero de Siret doit contenir 9 chiffres');
    // setCustomValidator(document.getElementById('domaine_tuteur'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du domaine doit au moins contenir 3 caractères');
    // setCustomValidator(document.getElementById('nom_entreprise'), /^[a-zA-Z0-9\s._-]{3,}$/, 'Le nom de lentreprise doit au moins contenir 3 caractères');
    // setCustomValidator(document.getElementById('description_entreprise_tuteur'), /^[a-zA-Z\s._-]{50,}$/, 'La description de lentreprise doit au moins contenir 3 caractères');

    fillFromCP(document.getElementById("location-cp"), document.getElementById("location-ville"));
}

async function fillFromCP(cpElement, villeElement)
{
    addEventTo(cpElement, 'change', async () => await fetchVilles(cpElement, villeElement));
}

async function fetchVilles(cpElement, villeElement)
{
    let codePostal = cpElement.value;

    if(codePostal.length === 5)
    {
        let res = await fetch(`https://geo.api.gouv.fr/communes?codePostal=${codePostal}`);

        let data = await res.json();

        if(data.length > 0)
        {
            let html = '';
            for(let i = 0; i < data.length; i++)
                html += `<option value="${data[i]['nom']}">${data[i]['nom']}</option>`;
            villeElement.innerHTML = html;
        }
    }
}


let nbrAdressesSecondaire = 0;
document.getElementById("button-add-adress").addEventListener("click", addSecondaryAdress)

function addSecondaryAdress()
{
    nbrAdressesSecondaire++;

    let div = document.createElement("div");
    div.setAttribute("class", "adresse-input");
    div.setAttribute("id", "adresse-secondaire" + nbrAdressesSecondaire);

    let label = document.createElement("label");
    label.setAttribute("for", "location-numero" + nbrAdressesSecondaire);
    label.innerHTML = "Adresse Secondaire n° " + nbrAdressesSecondaire;

    let inputNumero = document.createElement("input");
    inputNumero.setAttribute("type", "text");
    inputNumero.setAttribute("class", "form-input");
    inputNumero.setAttribute("id", "location" + nbrAdressesSecondaire + "-numero");
    inputNumero.setAttribute("placeholder", "N°");
    inputNumero.setAttribute("required", "");

    let inputRue = document.createElement("input");
    inputRue.setAttribute("type", "text");
    inputRue.setAttribute("class", "form-input");
    inputRue.setAttribute("id", "location" + nbrAdressesSecondaire + "-rue");
    inputRue.setAttribute("placeholder", "Rue");
    inputRue.setAttribute("required", "");

    let inputCP = document.createElement("input");
    inputCP.setAttribute("type", "number");
    inputCP.setAttribute("class", "form-input");
    inputCP.setAttribute("id", "location" + nbrAdressesSecondaire + "-cp");
    inputCP.setAttribute("placeholder", "Code Postal");
    inputCP.setAttribute("required", "");

    let inputVille = document.createElement("select");
    inputVille.setAttribute("class", "form-input");
    inputVille.setAttribute("id", "location" + nbrAdressesSecondaire + "-ville");
    inputVille.setAttribute("required", "");

    let option = document.createElement("option");
    option.setAttribute("selected", "");
    option.setAttribute("disabled", "");
    option.setAttribute("value", "");
    option.innerHTML = "Ville";
    inputVille.appendChild(option);

    let inputPays = document.createElement("input");
    inputPays.setAttribute("type", "text");
    inputPays.setAttribute("class", "form-input");
    inputPays.setAttribute("id", "location" + nbrAdressesSecondaire + "-pays");
    inputPays.setAttribute("placeholder", "Pays");
    inputPays.setAttribute("required", "");

    fillFromCP(inputCP, inputVille)

    div.appendChild(label);
    div.appendChild(inputNumero);
    div.appendChild(inputRue);
    div.appendChild(inputCP);
    div.appendChild(inputVille);
    div.appendChild(inputPays);

    document.getElementById("secondary-adresses").appendChild(div);
    document.getElementById("nombre-adresse-secondaires").value++;
}


document.getElementById("button-remove-adress").addEventListener("click", removeSecondaryAdress)

function removeSecondaryAdress()
{
    if(nbrAdressesSecondaire > 0)
    {
        document.getElementById("adresse-secondaire" + nbrAdressesSecondaire).remove();
        nbrAdressesSecondaire--;
    document.getElementById("nombre-adresse-secondaires").value--;
    }
}

let nbrDomaines = 1;
document.getElementById("button-add-domain").addEventListener("click", addDomain)

function addDomain()
{
    nbrDomaines++;

    const input = document.createElement("input");
    input.setAttribute("class", "form-input");
    input.setAttribute("id", "domaine" + nbrDomaines);
    input.setAttribute("placeholder", "Domaine n°" + nbrDomaines);

    document.getElementById("domaines").appendChild(input);
    document.getElementById("nombre-domaines").value++;
}

document.getElementById("button-remove-domain").addEventListener("click", removeDomain)

function removeDomain()
{
    if(nbrDomaines > 1)
    {
        document.getElementById("domaine" + nbrDomaines).remove();
        nbrDomaines--;
    document.getElementById("nombre-domaines").value--;
    }
}