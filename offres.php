<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Offres de Stage</title>
    <?php include('components/head.php'); ?>
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
            <input type="number" id="duree" placeholder="Durée (Mois)" min="1">
            <select id="filter-location"><option value="default">Lieu...</option></select>
            <button id="reset-filter" class="small-button">Réinitiliaser</button>
            <button id="filter-button" class="small-button">Filtrer</button>
        </div>
    </div>
    <div class="offres">
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
<?php include 'components/footer.php'; ?>
</body>
</html>
