<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter une Entreprise</title>
    <?php require_once('components/head.php'); ?>
</head>
<body>
<?php require_once('components/header.php'); ?>
<main>
    <div class="form" id="premiere_section">
        <h1>Créer une fiche entreprise</h1>
        <form method="post" > 
            <div class="form-fiche-entreprise">
                <div class="form__inputs">
                    <input class="form__input" placeholder="Nom de l'entreprise*" required>
                    <input class="form__input" placeholder="Mail de l'entreprise">
                    <input class="form__input" placeholder="Adresse Principale*" required>
                    <div class="add-div">
                        <input class="form-input"  id="input-skill" placeholder="Ajouter Adresse secondaire">
                        <div class="added-input-list">
                            <ul id="adresses">
                                <li>Adresse 1<a>✕</a></li>
                                <li>Adresse 2<a>✕</a></li>
                                <li>Adresse 3<a>✕</a></li>
                            </ul>
                        </div>
                    </div>
                    <input class="form__input" placeholder="Domaine*" required>
                    <input class="form__input" placeholder="E-mail">
                    <input class="form__input" placeholder="Téléphone">
                    <textarea placeholder="Description de l'entreprise*" id="entreprise-desc" required=""></textarea>
                </div>
            </div>
            <p>*Champs obligatoires</p>
            <button type="submit" class="submit">Poster</button>
        </form>
    </div>
</main>
<?php require_once('components/footer.php'); ?>
</body>
<script type="module" src="/scripts/poster_entreprise.js"></script>
</html>