<!DOCTYPE html>
<html lang="fr">
<head>
    <title>{if $is_modification}Modifier une Entreprise{else}Ajouter une Entreprise{/if}</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <section class="form" id="premiere_section">
        <h1>{if $is_modification}Mettre à jour {$entreprise->getNom()}{else}Ajouter un utilisateur{/if}</h1>
        <form method="post" > 
            <div class="form-fiche-entreprise">
                <div class="form__inputs">
                    <label for="nom-entreprise">Entreprise</label>
                    <input class="form__input" id="nom-entreprise" placeholder="Nom de l'entreprise*" required>
                    <div class="adresse-input">
                        <label for="location-numero">Adresse Principale</label>
                        <input type="number" class="form-input" id="location-numero" placeholder="N°" required>
                        <input type="text" class="form-input" id="location-rue" placeholder="Rue" required>
                        <select class="form-input" id="location-ville" required>
                            <option value="" disabled selected>Ville</option>
                        </select>
                        <input type="text" class="form-input" id="location-cp" placeholder="Code Postal" required>
                        <input type="text" class="form-input" id="location-pays" placeholder="Pays" required>
                    </div>

                    <button type="button" class="add-form-data-button" id="button-add-adress">Ajouter une adresse secondaire</button>
                    <button type="button" class="add-form-data-button" id="button-remove-adress">Retirer une adresse secondaire</button>
                    <input type="hidden" id="nombre-adresse-secondaires" value=0>
                    <div id="secondary-adresses">

                    </div>

                    <input type="hidden" id="nombre-domaines" value=1>
                    <label for="domaine1">Domaines</label>
                    <input class="form-input" id="domaine1" placeholder="Domaine*" required>
                    <button type="button" class="add-form-data-button" id="button-add-domain">Ajouter une domaine</button>
                    <button type="button" class="add-form-data-button" id="button-remove-domain">Retirer une domaine</button>
                    <div class="added-domain-input" id="domaines">

                    </div>
                    <label for="mail-entreprise">Mail</label>
                    <input class="form__input" placeholder="E-mail" id="mail-entreprise">
                    <label for="site-entreprise">Site</label>
                    <input class="form__input" placeholder="Site" id="site-entreprise">
                    <label for="tel-entreprise">Telephone</label>
                    <input class="form__input" placeholder="Téléphone" id="tel-entreprise">
                    <label for="entreprise-desc">Description</label>
                    <textarea placeholder="Description de l'entreprise*" id="entreprise-desc" maxlength=512 required=""></textarea>
                </div>
            </div>
            <p>*Champs obligatoires</p>
            <input type="submit" class="submit" value="Poster">
        </form>
    </section>
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/poster_entreprise.js"></script>
</html>