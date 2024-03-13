import {setCustomValidator, addEventTo} from './main.js';

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady()
{
    setCustomValidator(document.getElementById('nom'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('prenom'), /^[a-zA-Z\s._-]{3,}$/, 'Le prénom doit au moins contenir 3 caractères'); /*TODO */
    setCustomValidator(document.getElementById('email'), /^([\w.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/, 'Le nom du domaine doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('domaine'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du domaine doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('telephone'), /^[0-9\s.]{8}$/, 'Le numéro de téléphone doit contenir 8 chiffres');
    setCustomValidator(document.getElementById('adresse'), /^[a-zA-Z0-9\s._-]{3,}$/, 'Ladresse doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('promo'), /^A[0-9]$/, 'La promo doit contenir 2 caractères, une lettre et un chiffre');
    scrollToTop();
}

function scrollToTop()
{
    window.scroll({top: 0, behavior: 'smooth'});
}