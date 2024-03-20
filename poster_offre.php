<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter une Offre de Stage</title>
    <?php require_once('components/head.php'); ?>
</head>
<body>
<?php require_once('components/header.php'); ?>
<main>
    <div class="form" id="premiere_section">
        <h1> Poster une offre</h1>
        <form method="post">
            <div class="form__inputs">
                <input type="text" class="form-input" id="poste" placeholder="Nom du poste" required>
                <textarea id="description" placeholder="Description du poste" required></textarea>
                <select class="form-input" id="entreprise" required>
                    <option value="entreprise 1">Entreprise 1</option>
                    <option value="entreprise 2">Entreprise 2</option>
                </select>
                <input type="text" class="form-input" id="level" placeholder="Niveau d'études demandé" required>
                <br>
                    <div>
                        <label for="start-date">Date début</label>
                        <input class="form-input" type="date" id="start-date" required>
                    </div>
                    <div id="duree">
                        <input class="form-input" type="number" id="nb-duree" min="1" max="20" placeholder="Durée" required>
                        <select class="form-input" id="type-duree" required>
                            <option value="semaines">Semaines</option>
                            <option value="mois">Mois</option>
                        </select>
                    </div>
                <input type="text" class="form-input" id="location" placeholder="Lieu" required>
                <input type="number" class="form-input" id="nb-places" placeholder="Nombre de places" max="100" required>
                <input type="number" class="form-input" id="remuneration" placeholder="Rémunération (à l'heure)" max="50" required>
                <input type="number" class="form-input" id="niveau" placeholder="Années post-BAC (optionnel)" max="10">
                <div class="skills-div">
                    <input class="form-input"  id="input-skill" placeholder="Ajouter une compétence" required>
                    <div class="skills-list">
                        <ul id="skills">
                            <li>Compétence 1<a>✕</a></li>
                            <li>Compétence 2<a>✕</a></li>
                            <li>Compétence 3<a>✕</a></li>
                        </ul>
                    </div>
                </div>
                <input type="submit" class="submit" placeholder="Publier">
            </div>
        </form>
    </div>
</main>
<?php require_once('components/footer.php'); ?>
<script type="module" src="/scripts/poster_offre.js"></script>
</body>
</html>