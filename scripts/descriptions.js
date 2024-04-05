import { addEventTo } from './main.js';

const starts = document.querySelectorAll('.start .etoile')
const btn = document.querySelector('button')

starts.forEach((debut, num)=>{
    debut.addEventListener('click', ()=>{
        starts.forEach((debut, num2)=>{
            console.log(debut)
            num >= num2 ? debut.classList.add('active') : debut.classList.remove('active');
        })
    })
})

addEventTo(document.getElementById('wishlist'), 'click', async (e) =>
{
    e.preventDefault();

    const urlParams = new URLSearchParams(window.location.search);
    if(!urlParams.has('offreId'))
        return;

    let res = await fetch('/api/wishlist', {
        method: 'POST',
        body: new URLSearchParams({IdOffre: urlParams.get('offreId')})
    });

    let data = await res.json();

    if(data['success'])
    {
        alert('Entreprise ajoutée à la wishlist');
    }
    else
    {
        alert('Erreur');
    }
});