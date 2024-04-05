import { addEventTo } from "./main.js";

addEventTo(document.getElementById('form_inscription'), 'submit', async(e) =>
{
    e.preventDefault()

    console.log('submit')

    let res = await fetch('/api/candidatures', {
        method: 'POST',
        headers: {
        },
        body: new FormData(document.getElementById('form_inscription'))
    })

    let data = await res.json();

    console.log(data)

    if (data['statut'] === 'success')
    {
        alert('Votre candidature a bien été envoyée')

        window.location.href = '/description-offre?offreId=' + document.getElementById('IdOffre').value;
    }
    else
    {
        alert('Erreur: ' + data['error'])
    }
})