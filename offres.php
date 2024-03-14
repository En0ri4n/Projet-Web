<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Offres de Stage</title>
    <link rel="stylesheet" href="/assets/styles/offres.css">
    <link rel="stylesheet" href="/assets/styles/components.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="/assets/favicon.ico" />
</head>
<body>
<?php include 'components/header.php'; ?>
<main class="main">
    <div class="parametres">
        <h1>Filtres</h1>
        <div class="filtres">
            <input type="text" id="filter-name" placeholder="Nom">
            <select id="filter-entreprise"><option value="default">Entreprise...</option></select>
            <select id="filter-niveau"><option value="default">Niveau...</option></select>
            <input type="date" id="filter-date" placeholder="Date">
            <input type="number" id="duree" placeholder="Durée (Mois)">
            <select id="filter-location"><option value="default">Lieu...</option></select>
            <button id="reset-filter">Réinitiliaser</button>
            <button id="filter-button">Filtrer</button>
        </div>
    </div>
    <div class="list-offres">
        <div class="posts">
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
<?php include 'components/footer.php'; ?>
</body>
</html>
