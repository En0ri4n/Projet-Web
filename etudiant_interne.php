<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Profil Étudiant</title>
    <?php require_once('components/head.php'); ?>
</head>
<body>
<?php require_once('components/header.php'); ?>
<main>
    <?php require_once('components/profile.php'); ?>
    <div class="informations">
        <div class="listes">
        <div class="competences">
            <h1>Compétences</h1>
            <ul>
            <li>compétence 1</li>
            <li>compétence 2</li>
            <li>compétence 3</li>
            </ul>
            </div>
        <button class="edit">Modifier ✏️</button>
        <div class="langues">
            <h1>Langues</h1>
            <ul>
                <li>langue 1</li>
                <li>langue 2</li>
                <li>langue 3</li>
            </ul>
        </div>
        <button class="edit">Modifier ✏️</button>
        </div>
        <article class="formation">
            <h1>Formations</h1>
            <ul>
                <li><h2>Ecole 1</h2><p>Détails, année, cycle, diplôme etc.</p></li>
                <li><h2>Ecole 2</h2><p>Détails, année, cycle, diplôme etc.</p></li>
                <li><h2>Ecole 3</h2><p>Détails, année, cycle, diplôme etc.</p></li>
            </ul>
            <button class="edit">Modifier ✏️</button>
        </article>
    </div>
</main>
<?php require_once('components/footer.php'); ?>
</body>
</html>