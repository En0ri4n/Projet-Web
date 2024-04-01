import {addEventTo, setCustomValidator, setCustomConditionValidator} from "./main.js";

function activeChildren(active, children)
{
    for(let child of children)
    {
        if(!active)
        {
            child.setAttribute('required', '');
            child.setAttribute('disabled', '')
        }
        else
        {
            child.removeAttribute('required');
            child.removeAttribute('disabled')
        }
        if(child.hasChildNodes())
            activeChildren(active, child.children)
    }
}

function convertFormToJson(form, dict)
{
    const formData = new FormData(form);

    function addToObject(obj, keys, value)
    {
        const key = keys.shift();
        if(keys.length === 0)
        {
            if(!obj.hasOwnProperty(key))
            {
                obj[key] = value;
            }
            else
            {
                if(!Array.isArray(obj[key]))
                {
                    obj[key] = [obj[key]];
                }
                obj[key].push(value);
            }
        }
        else
        {
            if(!obj.hasOwnProperty(key))
            {
                obj[key] = {};
            }
            addToObject(obj[key], keys, value);
        }
    }

    const jsonObject = {};
    formData.forEach(function(value, key)
                     {
                         if(dict[key] === undefined)
                             return;
                         const mappedKey = dict[key];
                         if(mappedKey.includes('.'))
                         {
                             const keys = mappedKey.split('.');
                             addToObject(jsonObject, keys, value);
                         }
                         else
                         {
                             if(!jsonObject.hasOwnProperty(mappedKey))
                             {
                                 jsonObject[mappedKey] = value;
                             }
                             else
                             {
                                 if(!Array.isArray(jsonObject[mappedKey]))
                                 {
                                     jsonObject[mappedKey] = [jsonObject[mappedKey]];
                                 }
                                 jsonObject[mappedKey].push(value);
                             }
                         }
                     });
    return JSON.stringify(jsonObject);
}

const dict = {
    'id-utilisateur': 'id',
    'nom': 'lastname',
    'prenom': 'firstname',
    'email': 'email',
    'password': 'password',
    'account-type': 'type',

    'promotion': 'data.id_promo',
    'numero-rue': 'data.adresse.numero',
    'nom-rue': 'data.adresse.rue',
    'code-postal': 'data.adresse.code_postal',
    'ville': 'data.adresse.ville',
    'pays': 'data.adresse.pays',

    'name-promotion': 'data.promotion.nom',
    'type-promotion': 'data.promotion.type',
    'date-promotion': 'data.promotion.date',
    'niveau-promotion': 'data.promotion.niveau',
    'duree-promotion': 'data.promotion.duree',
    'centre-promotion': 'data.promotion.centre',
};

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady()
{
    setCustomValidator(document.getElementById('nom'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du poste doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('prenom'), /^[a-zA-Z\s._-]{3,}$/, 'Le prénom doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('email'), /^([\w.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/, 'L\'email du poste doit au moins contenir 3 caractères et un @');
    setCustomValidator(document.getElementById('password'), /^[a-zA-Z0-9\s._-]{8,}$/, 'Le mot de passe doit au moins contenir 8 caractères');
    setCustomConditionValidator(document.getElementById('password-confirm'), (value) => value === document.getElementById('password').value, 'Les mots de passe ne correspondent pas');
    // setCustomValidator(document.getElementById('account'), )

    fetch('/api/promos', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data =>
              {
                  // Nom de la promotion
                  let html = '';
                  for(let i = 0; i < data.length; i++)
                      html += `<option value="${data[i]['IdPromotion']}">${data[i]['NomPromotion']}</option>`;
                  document.getElementById('promotion').innerHTML = html;
              });
}

addEventTo(document.getElementById("account"), "change", () =>
{
    let checkedBox = document.querySelector('input[name="account-type"]:checked');

    document.getElementById("pilote-form").style.display = 'none';
    document.getElementById('etudiant-form').style.display = 'none';

    activeChildren(false, document.getElementById("pilote-form").children)
    activeChildren(false, document.getElementById("etudiant-form").children)

    switch(checkedBox.value)
    {
        case 'pilote':
            document.getElementById("pilote-form").style.display = 'flex';
            activeChildren(true, document.getElementById("pilote-form").children)
            break;
        case 'etudiant':
            document.getElementById("etudiant-form").style.display = 'flex';

            activeChildren(true, document.getElementById("etudiant-form").children)
            break;
    }
});

addEventTo(document.getElementsByName('code-postal')[0], 'change', (e) =>
{
    let codePostal = e.target.value;
    if(codePostal.length === 5)
    {
        fetch(`https://geo.api.gouv.fr/communes?codePostal=${codePostal}`)
            .then(response => response.json())
            .then(data =>
                  {
                      if(data.length > 0)
                      {
                          let html = '';
                          for(let i = 0; i < data.length; i++)
                              html += `<option value="${data[i]['nom']}">${data[i]['nom']}</option>`;
                          document.getElementById('ville').innerHTML = html;
                      }
                  });
    }
})

addEventTo(document.getElementsByTagName('form')[0], 'submit', (e) =>
{
    e.preventDefault();

    let form = e.target;

    console.log(convertFormToJson(form, dict));

    // TODO: send data
    fetch('/api/users', {
        method: 'POST',
        headers: {
            'Content-Type': "application/json"
        }
    }).then(res => res.json())
        .then(data => {

        })
});