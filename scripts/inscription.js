import {addEventTo, setCustomValidator, setCustomConditionValidator} from "./main.js";

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady()
{
    setCustomValidator(document.getElementById('nom'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du poste doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('prenom'), /^[a-zA-Z\s._-]{3,}$/, 'Le prénom doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('email'), /^([\w.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/, 'L\'email du poste doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('password'), /^[a-zA-Z0-9\s._-]{8,}$/, 'Le mot de passe doit au moins contenir 8 caractères');
    setCustomConditionValidator(document.getElementById('password-confirm'), (value) => value === document.getElementById('password').value, 'Les mots de passe ne correspondent pas');
    setCustomValidator(document.getElementById('account'), )
}