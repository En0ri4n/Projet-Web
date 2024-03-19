<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Accueil</title>
    <?php require_once('components/head.php'); ?>
    <link rel="preload" href="assets/stage.jpg" as="image">
</head>
<body>
<?php require_once('components/header.php'); ?>
<main>
    <div class="presentation">
        <article class="description">
            <h1>StageFinder</h1><br>
            <p>Trouvez un stage qui vous correspond.</p>
        </article>
        <img src="/assets/stage.jpg" alt="Presentation">
    </div>
    <div class="accueil-offres">
        <div class="space-between-two">
            <div class="mode-accueil"><a class="selected" href="/accueil.php">Classic</a> | <a href="/accueil.php">Fancy</a></div>
            <button class="go-button" onclick="window.location.href='/offres.php';">Filtrer</button>
        </div>
        <div class="liste-offres">
            <div class="offre">
                <img src="/assets/poste.png" alt="Entreprise">
                <article>
                    <div class="c1">
                        <span class="poste">Poste</span>
                        <span class="entreprise">Entreprise</span>
                        <span class="niveau">Niveau</span>
                    </div>
                    <div class="c2">
                        <span class="domaine">Domaine</span>
                        <span class="dates">Dates</span>
                    </div>
                    <div class="c3">
                    </div>
                    <div class="list-competences">
                        <ul class="competences">Compétences :
                            <li>competence 1</li>
                            <li>competence 2</li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </div>
</main>
<?php require_once('components/footer.php'); ?>
<script type="module" src="scripts/accueil.js"></script>
</body>
</html>
