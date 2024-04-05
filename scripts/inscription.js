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

addEventTo(document, 'DOMContentLoaded', onReady);

function onReady()
{
    setCustomValidator(document.getElementById('nom'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du poste doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('prenom'), /^[a-zA-Z\s._-]{3,}$/, 'Le prénom doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('email'), /^([\w.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/, 'L\'email du poste doit au moins contenir 3 caractères et un @');
    setCustomValidator(document.getElementById('password'), /^[a-zA-Z0-9\s._-]{8,}$/, 'Le mot de passe doit au moins contenir 8 caractères');
    setCustomConditionValidator(document.getElementById('password-confirm'), (value) => value === document.getElementById('password').value, 'Les mots de passe ne correspondent pas');
    // setCustomValidator(document.getElementById('account'), )


    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.has('userId'))
        fillEntries(urlParams.get('userId'));

    fetchPromotions();
}

async function fillEntries(id)
{
    document.getElementById('password').required = false;
    document.getElementById('password-confirm').required = false;

    let res = await fetch(`/api/users?IdUtilisateur=${id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let data = await res.json();

    // console.log(data);

    let user = data['users'][0];

    // console.log(user);

    document.getElementById('id-utilisateur').value = user['IdUtilisateur'];
    document.getElementById('id-utilisateur').setAttribute('readonly', '');
    document.getElementById('nom').value = user['Nom'];
    document.getElementById('prenom').value = user['Prenom'];
    document.getElementById('email').value = user['MailUtilisateur'];
    document.getElementById('telephone').value = user['TelephoneUtilisateur'];

    if(user['user_type'] === 'etudiant')
    {
        document.getElementById('student-account').checked = true;
        document.getElementById("account").dispatchEvent(new Event('change'));

        let promotion = user['promotion'];
        document.getElementById('promotion').innerHTML += `<option value="${promotion['IdPromotion']}" selected>${promotion['NomPromotion']}</option>`;

        let adresse = user['adresse'];
        document.getElementById('adresse-numero').value = adresse['Numero'];
        document.getElementById('adresse-rue').value = adresse['Rue'];
        document.getElementById('code-postal').value = adresse['CodePostal'];
        document.getElementById('ville').innerHTML += `<option value="${adresse['Ville']}" selected>${adresse['Ville']}</option>`;
        document.getElementById('adresse-pays').value = adresse['Pays'];
    }
    else if(user['user_type'] === 'pilote')
    {
        document.getElementById('pilote-account').checked = true;
        document.getElementById("account").dispatchEvent(new Event('change'));
    }
    else if(user['user_type'] === 'administrateur')
    {
        document.getElementById('admin-account').checked = true;
        document.getElementById("account").dispatchEvent(new Event('change'));
    }
}

async function fetchPromotions()
{
    let res = await fetch('/api/promos?column=IdPromotion,NomPromotion', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let promotionData = await res.json();

    // console.log(promotionData);

    // Nom de la promotion
    let html = '';
    for(let i = 0; i < promotionData['count']; i++)
        html += `<option value="${promotionData['values'][i][0]}">${promotionData['values'][i][1]}</option>`;
    document.getElementById('promotion').innerHTML = html;
}

addEventTo(document.getElementById("account"), "change", () =>
{
    let checkedBox = document.querySelector('input[name="account-type"]:checked');

    document.getElementById('type').value = checkedBox.value;

    document.getElementById('etudiant-form').style.display = 'none';

    activeChildren(false, document.getElementById("etudiant-form").children)

    switch(checkedBox.value)
    {
        case 'etudiant':
            document.getElementById("etudiant-form").style.display = 'flex';

            activeChildren(true, document.getElementById("etudiant-form").children)
            break;
    }
});

addEventTo(document.getElementById('code-postal'), 'change', (e) =>
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

addEventTo(document.getElementsByTagName('form')[0], 'submit', async(e) =>
{
    e.preventDefault();

    let form = e.target;
    let formdata = new FormData(form);

    let json = {};

    for(let pair of formdata.entries())
    {
        json[pair[0]] = pair[1];
        console.log(pair[0] + ', ' + pair[1]);
    }

    if(window.location.pathname === '/modifier-profil')
    {
        console.log(json);

        let res = await fetch('/api/users', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(json)
        });

        let data = await res.json();

        console.log(data)

        if(data['status'] === 'success')
        {
            window.location.href = '/profil?userId=' + json['IdUtilisateur'];
        }
    }
    else
    {
        let res = await fetch('/api/users', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(json)
        });

        let data = await res.json();

        if(data['status'] === 'success')
        {
            window.location.href = '/utilisateurs';
        }
    }
});