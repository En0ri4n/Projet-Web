import 'scripts/main.js'

// Add event to the document when it is ready, to ensure that all the elements are loaded before doing anything
addEventTo(document, 'DOMContentLoaded', () => onReady());

/**
 * Called when the document is ready and all the elements (DOM) are loaded
 */
function onReady()
{
	registerEvents();
}

/**
 * Register events for the form fields
 * It will add custom validation for each fields
 */
function registerEvents()
{
	console.log('register events');
	
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