/*etoiles*/
const starts = document.querySelectorAll('.start .etoile')
const btn = document.querySelector('button')

starts.forEach((debut, num) => {
    debut.addEventListener('click', () => {
        starts.forEach((debut, num2) => {
            console.log(debut)
            num >= num2 ? debut.classList.add('active') : debut.classList.remove('active');
        })
    })
})


/*verification inscription*/
function check_data() {
    setCustomValidator(document.getElementById('nom'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du poste doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('prenom'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du poste doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('email'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du poste doit au moins contenir 3 caractères');
    if (document.form_inscription.email.value.indexOf('@') == -1) {
        alert("Adresse mail invalide")
    }
    setCustomValidator(document.getElementById('password'), /^[a-zA-Z\s._-]{8,}$/, 'Le nom du poste doit au moins contenir 3 caractères');
    if (document.form_inscription.password - confirm.value != document.form_inscription.password.value) {
        alert("Les deux entrées du mot de passe ne correspondent pas")
    }
    if (document.form_inscription.getElementById('student-account').checked == False && document.inscription.getElementById('pilote-account').checked == False){
        alert("Veuillez sélectionner un type de compte")
    }
}