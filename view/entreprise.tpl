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

                    <button type="button" class="add-form-data-button" id="button-add-adress">Ajouter une adresse secondaire</button>
                    <button type="button" class="add-form-data-button" id="button-remove-adress">Retirer une adresse secondaire</button>
                    <input type="hidden" id="nombre-adresse-secondaires" value=0>
                    <div id="secondary-adresses">

                    </div>

                    <input type="hidden" id="nombre-domaines" value=1>
                    <input class="form-input" id="domaine1" placeholder="Domaine*" required>
                    <button type="button" class="add-form-data-button" id="button-add-domain">Ajouter une domaine</button>
                    <button type="button" class="add-form-data-button" id="button-remove-domain">Retirer une domaine</button>
                    <div class="added-domain-input" id="domaines">

                    </div>

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