<!DOCTYPE html>
<html lang="fr">
<head>
    <title>{if $is_modification}Modifier une Offre{else}Ajouter une Offre{/if}</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <section class="form" id="premiere_section">
        <h1>{if $is_modification}Mettre à jour {$offre->getName()}{else}Ajouter une Offre{/if}</h1>
        <form method="post">
            <div class="form__inputs">
            <label for="poste">Poste</label>
                <input type="text" class="form-input" id="poste" placeholder="Nom du poste" required>
                <label for="description">Description</label>
                <textarea id="description" placeholder="Description du poste" maxlength=512 required></textarea>
                <label for="entreprise">Entreprise</label>
                <select class="form-input" id="entreprise" required>
                <option>Entreprise...</option>
                </select>
                <label for="level">Niveau</label>
                <input type="text" class="form-input" id="level" placeholder="Niveau d'études demandé" required>
                <br>
                <div>
                    <label for="start-date">Date début</label>
                    <input class="form-input" type="date" id="start-date" required>
                </div>
                <label for="nb-duree">Durée (mois)</label>
                <input class="form-input" type="number" id="nb-duree" min="1" max="20" placeholder="Durée (mois)" required>
                <br>
                <div class="adresse-input">
                    <label for="location-numero">Adresse du stage</label>
                    <input type="text" class="form-input" id="location-numero" placeholder="N°" required>
                    <input type="text" class="form-input" id="location-rue" placeholder="Rue" required>
                    <select class="form-input" id="location-ville" required><option value="">Ville</option></select>
                    <input type="text" class="form-input" id="location-cp" placeholder="Code Postal" required>
                    <input type="text" class="form-input" id="location-pays" placeholder="Pays" required>
                </div>
                <label for="nb-place">Nombre de place</label>
                <input type="number" class="form-input" id="nb-places" placeholder="Nombre de places" max="100" required>
                <label for="remuneration">Remuneration (à l'heure)</label>
                <input type="number" class="form-input" id="remuneration" placeholder="Rémunération (à l'heure)" max="50" min="0" required>
                <input type="hidden" id="nombre-skills" value=1>
                <label for="skill1">Compétences</label>
                <input class="form-input" id="skill1" placeholder="Compétence*" required>
                <button type="button" class="add-form-data-button" id="button-add-skill">Ajouter une compétence</button>
                <button type="button" class="add-form-data-button" id="button-remove-skill">Retirer une compétence</button>
                <div class="added-skill-input" id="skills">

                </div>
                <input type="submit" class="submit" placeholder="Publier">
            </div>
        </form>
    </section>
</main>
{include file='components/footer.tpl'}
<script type="module" src="/scripts/poster_offre.js"></script>
</body>
</html>