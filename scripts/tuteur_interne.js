function check_data(){
    setCustomValidator(document.getElementById('nom'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('prenom'), /^[a-zA-Z\s._-]{3,}$/, 'Le prénom doit au moins contenir 3 caractères'); /*TODO */
    setCustomValidator(document.getElementById('email'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du domaine doit au moins contenir 3 caractères');
    if (document.form_inputs.email.value.indexOf('@') == -1) {
        alert("Adresse mail invalide")
    }
    setCustomValidator(document.getElementById('domaine'), /^[a-zA-Z\s._-]{3,}$/, 'Le nom du domaine doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('telephone'), /^[0-9\s.]{8}$/, 'Le numéro de téléphone doit contenir 8 chiffres');
    setCustomValidator(document.getElementById('adresse'), /^[a-zA-Z0-9\s._-]{3,}$/, 'Ladresse doit au moins contenir 3 caractères');
    setCustomValidator(document.getElementById('promo'), /^[a-zA-Z0-9\s._-]{2,}$/, 'La promo doit contenir 2 caractères, une lettre et un chiffre');
    var v =1;
        var len_promo=document.form_inputs.promo.value.lenght;
        if(len_cin==2)
        {
                var char =document.inscription.promo.value.charAt(0);
                if(char != "A")
                {
                    alert("La promo doit être écrite telle que : A[numéro de l'année]");
                    return false;
                }
                else{
                    char = document.inscription.cin.value.charAt(1);
                    if(char < "0" || char > "9")
                    {
                        ("La promo doit être écrite telle que : A[numéro de l'année]");
                        return false;
                    }
                };
        }
        else{
            ("La promo doit être écrite telle que : A[numéro de l'année]");
            return false;
        };
}
