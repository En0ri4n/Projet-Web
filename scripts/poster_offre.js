import { addEventTo, setCustomValidator } from "./main.js";

// Add event to the document when it is ready, to ensure that all the elements are loaded before doing anything
addEventTo(document, 'DOMContentLoaded', onReady);

/**
 * Called when the document is ready and all the elements (DOM) are loaded
 * <br>
 * Register events for the form fields
 * It will add custom validation for each fields
 */
function onReady()
{
	// addEventTo(window, 'keyup', (event) => {
	// 	if(event.keyCode === 13) {
	// 		event.preventDefault();
	// 		return false;
	// 	}
	// });
	//
	// addEventTo(document.getElementById('input-skill'), 'keyup', (evt) =>
	// {
	// 	if(evt.keyCode === 13)
	// 	{
	// 		console.log('enter', evt);
	// 	}
	// });
	//
	// setCustomValidator(document.getElementById('poste'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du poste doit au moins contenir 3 caractères');
	// setCustomValidator(document.getElementById('domain'), /^[a-zA-Z\s._-]{3,}$/, 'Le domaine doit au moins contenir 3 caractères');
	// setCustomValidator(document.getElementById('level'), /^[a-zA-Z\s._-]{3,}$/, 'Le niveau d\'études doit au moins contenir 3 caractères');
	//
	// setCustomValidator(document.getElementById('location'), /^[a-zA-Z\s._-]{3,}$/, 'La localisation doit au moins contenir 3 caractères');

	const urlParams = new URLSearchParams(window.location.search);
	if(urlParams.has('IdOffre'))
		fillEntries(urlParams.get('IdOffre'));
}

async function fillEntries(id)
{
	let res = await fetch(`/api/offres?IdOffre=${id}`, {
		method: 'GET',
		headers: {
			'Content-Type': 'application/json'
		}
	});

	let data = await res.json();

	console.log(data);

	let offre = data['offres'][0];

	console.log(offre);

	document.getElementById('poste').value = offre['NomOffre'];
	document.getElementById('description').value = offre['DescriptionOffre']
	document.getElementById('entreprise').innerHTML = `<option value="${offre['entreprise']['IdEntreprise']}">${offre['entreprise']['NomEntreprise']}</option>`;
	document.getElementById('level').value = offre['NiveauOffre'];
	document.getElementById('start-date').value = offre['DateOffre'];

	document.getElementById('nb-duree').value = offre['DureeOffre'];

	let adresse = offre['adresse'];

	document.getElementById('location-numero').value = adresse['Numero'];
	document.getElementById('location-rue').value = adresse['Rue'];
	document.getElementById('location-cp').value = adresse['CodePostal'];
	document.getElementById('location-ville').innerHTML = `<option value="${adresse['Ville']}">${adresse['Ville']}</option>`;
	document.getElementById('location-pays').value = adresse['Pays'];

	document.getElementById('nb-places').value = offre['NbPlace'];
	document.getElementById('remuneration').value = offre['NbPlace'];

	for(let i = 0; i < offre['competences'].length; i++)
	{
		if(i === 0)
			document.getElementById('skill1').value = offre['competences'][i]['NomCompetence'];
		else
		{
			addSkill();
			document.getElementById('skill' + (i + 1)).value = offre['competences'][i]['NomCompetence'];
		}
	}
	document.getElementById('nb-places').value = offre['NbPlace'];


	let skills = offre['competences'];

	for(let i = 0; i < skills.length - 1; i++)
	{
		console.log(skills[i])
		if(i === 0)
			document.getElementById('skill1').value = skills[i]['NomCompetence'];
		else
		{
			addSkill();
			document.getElementById('skill' + (i + 1)).value = skills[i]['NomCompetence'];
		}
	}
}


let nbrSkills= 1;
document.getElementById("button-add-skill").addEventListener("click", addSkill)

function addSkill()
{
    nbrSkills++;

    const input = document.createElement("input");
    input.setAttribute("class", "form-input");
    input.setAttribute("id", "skill" + nbrSkills);
    input.setAttribute("placeholder", "Compétence n°" + nbrSkills);

    document.getElementById("skills").appendChild(input);
    document.getElementById("nombre-skills").value++;
}

document.getElementById("button-remove-skill").addEventListener("click", removeSkill)

function removeSkill()
{
    if(nbrSkills > 1)
    {
        document.getElementById("skill" + nbrSkills).remove();
        nbrSkills--;
    document.getElementById("nombre-skills").value--;
    }
}
getEntrepriseList();

async function getEntrepriseList(){
	let enterUrl = '/api/entreprises';
	const entreprises = document.getElementById('entreprise');

	let responseEnter = await fetch(enterUrl, {
		method: 'GET',
		headers: {
			'Content-Type': 'application/json'
		}
	});
	let dataEnter = await responseEnter.json();

	entreprises.innerHTML = "";

	for(let i = 0; i < dataEnter['entreprises'].length; i++)
    {
        let html = `<option value="entreprise`+i+`">`+ dataEnter['entreprises'][i]["NomEntreprise"] +`</option>`;
		entreprises.innerHTML += html;
    }
}

