import {setCustomValidator, addEventTo} from './main.js';

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady()
{
    setCustomValidator(document.getElementById('nom-entreprise'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom de l\'entreprise doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('location-numero'), /^[0-9]{1,}$/, 'Le numero de rue doit contenir au moins 1 chiffre');
    setCustomValidator(document.getElementById('location-rue'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom de la rue doit contenir au moins 3 caractères');
    setCustomValidator(document.getElementById('location-ville'),/^[a-zA-Z\s._-]{3,}$/, 'Le nom de la ville doit contenir au moins 3 caractères'); 
    setCustomValidator(document.getElementById('location-cp'), /^[0-9]{5}$/,'Le Code Postal doit contenir 5 chiffres');
    setCustomValidator(document.getElementById('location-pays'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du pays doit contenir au moins 3 caractères');
    setCustomValidator(document.getElementById('domaine'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du domaine doit contenir au moins 3 caractères');/*TODO : plusieurs domaines*/
    setCustomValidator(document.getElementById('mail-entreprise'), /^[a-zA-Z\s._-]{3,}$/&&document.inscription.email.value.indexOf('@')==-1, 'Adresse mail invalide');
    setCustomValidator(document.getElementById('site-entreprise'), /^[a-zA-Z\s._-]{3,}$/, 'Le site doit contenir au moins 3 caractères');
    setCustomValidator(document.getElementById('tel-entreprise'),/^[0-9]{8}$/, 'Letelephone doit contenir 8 caractères');
    setCustomValidator(document.getElementById('entreprise-desc'), /^[a-zA-Z\s._-]{3,}$/, 'La description doit contenir au moins 3 caractères');

    fillFromCP(document.getElementById("location-cp"), document.getElementById("location-ville"));

    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.has('IdEntreprise'))
        fillEntries(urlParams.get('IdEntreprise'));
}

async function fillEntries(id)
{
    let res = await fetch(`/api/entreprises?IdEntreprise=${id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await res.json();

    console.log(data)

    let entreprise = data['entreprises'][0];

    console.log(entreprise)

    document.getElementById('nom-entreprise').value = entreprise['NomEntreprise'];

    let adresses = entreprise['adresses'];

    for(let i = 0; i < adresses.length; i++)
    {
        if(i === 0)
        {
            document.getElementById('location-numero').value = adresses[i]['Numero'];
            document.getElementById('location-rue').value = adresses[i]['Rue'];
            document.getElementById('location-cp').value = adresses[i]['CodePostal'];
            document.getElementById('location-ville').innerHTML = `<option value="${adresses[i]['Ville']}">${adresses[i]['Ville']}</option>`;
            document.getElementById('location-pays').value = adresses[i]['Pays'];
        }
        else
        {
            addSecondaryAdress();
            document.getElementById('location' + i + '-numero').value = adresses[i]['Numero'];
            document.getElementById('location' + i + '-rue').value = adresses[i]['Rue'];
            document.getElementById('location' + i + '-cp').value = adresses[i]['CodePostal'];
            document.getElementById('location' + i + '-ville').innerHTML = `<option value="${adresses[i]['Ville']}">${adresses[i]['Ville']}</option>`;
            document.getElementById('location' + i + '-pays').value = adresses[i]['Pays'];
        }
    }

    for(let i = 0; i < entreprise['secteurs'].length; i++)
    {
        if(i === 0)
            document.getElementById('domaine1').value = entreprise['secteurs'][i];
        else
        {
            addDomain();
            document.getElementById('domaine' + i).value = entreprise['secteurs'][i]['NomSecteur'];
        }
    }

    document.getElementById('mail-entreprise').value = entreprise['MailEntreprise'];
    document.getElementById('tel-entreprise').value = entreprise['TelephoneEntreprise'];
    document.getElementById('site-entreprise').value = entreprise['Site'];

    document.getElementById('entreprise-desc').innerHTML = entreprise['DescriptionEntreprise'];
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
    inputNumero.setAttribute("type", "number");
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