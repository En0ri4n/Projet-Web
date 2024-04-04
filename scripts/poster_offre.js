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
	addEventTo(window, 'keyup', (event) => {
		if(event.keyCode === 13) {
			event.preventDefault();
			return false;
		}
	});
	
	addEventTo(document.getElementById('input-skill'), 'keyup', (evt) =>
	{
		if(evt.keyCode === 13)
		{
			console.log('enter', evt);
		}
	});
	
	setCustomValidator(document.getElementById('poste'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du poste doit au moins contenir 3 caractères');
	setCustomValidator(document.getElementById('domain'), /^[a-zA-Z\s._-]{3,}$/, 'Le domaine doit au moins contenir 3 caractères');
	setCustomValidator(document.getElementById('level'), /^[a-zA-Z\s._-]{3,}$/, 'Le niveau d\'études doit au moins contenir 3 caractères');
	
	setCustomValidator(document.getElementById('location'), /^[a-zA-Z\s._-]{3,}$/, 'La localisation doit au moins contenir 3 caractères');
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
	let entrepriseResponse = await fetch('/api/entreprises?column=NomEntreprise', {
		method: 'GET',
		headers: {
			'Content-Type': 'application/json'
		}
	});
	let entrepriseData = await entrepriseResponse.json();
	let entreprises = entrepriseData['values'];
	document.getElementById('entreprise').innerHTML += Array.from(new Set(entreprises)).sort().map(entreprise => { return `<option value="${entreprise}">${entreprise}</option>` }).join('');
}