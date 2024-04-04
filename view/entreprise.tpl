<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter une Entreprise</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <div class="form" id="premiere_section">
        <h1>Créer une fiche entreprise</h1>
        <form method="post" > 
            <div class="form-fiche-entreprise">
                <div class="form__inputs">
                    <input class="form__input" placeholder="Nom de l'entreprise*" required>
                    <input class="form__input" placeholder="Mail de l'entreprise">
                    <div class="adresse-input">
                        <label for="location-numero">Adresse Principale</label>
                        <input type="text" class="form-input" id="location-numero" placeholder="N°" required>
                        <input type="text" class="form-input" id="location-rue" placeholder="Rue" required>
                        <input type="text" class="form-input" id="location-ville" placeholder="Ville" required>
                        <input type="text" class="form-input" id="location-cp" placeholder="Code Postal" required>
                        <input type="text" class="form-input" id="location-pays" placeholder="Pays" required>
                    </div>

                    <!-- TODO : Pouvoir ajouter des entreprises secondaires 
                    <button >Ajouter une adresse secondaire</button>
                    <div class="add-div">
                        <input class="form-input"  id="input-skill" placeholder="Ajouter Adresse secondaire">
                        <div class="added-input-list">
                            <ul id="adresses">
                                <li>Adresse 1<a>✕</a></li>
                                <li>Adresse 2<a>✕</a></li>
                                <li>Adresse 3<a>✕</a></li>
                            </ul>
                        </div>
                    </div>-->
                    <input class="form__input" placeholder="Domaine*" required>
                    <input class="form__input" placeholder="E-mail">
                    <input class="form__input" placeholder="Téléphone">
                    <textarea placeholder="Description de l'entreprise*" id="entreprise-desc" maxlength=512 required=""></textarea>
                </div>
            </div>
            <p>*Champs obligatoires</p>
            <button type="submit" class="submit">Poster</button>
        </form>
    </div>
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/poster_entreprise.js"></script>
</html>