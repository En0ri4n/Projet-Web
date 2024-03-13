import {setCustomValidator, addEventTo} from './main.js';

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady()
{
    setCustomValidator(document.getElementById('nom_entreprise'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom de lentreprise doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('siret'), /^[0-9\s.]{9}$/, 'Le numero de Siret doit contenir 9 chiffres'); /*TODO */
    setCustomValidator(document.getElementById('domaine_tuteur'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du domaine doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('nom_entreprise'), /^[a-zA-Z0-9\s._-]{3,}$/, 'Le nom de lentreprise doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('description_entreprise_tuteur'), /^[a-zA-Z\s._-]{50,}$/, 'La description de lentreprise doit au moins contenir 3 caractères');
}
