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