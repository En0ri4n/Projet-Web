<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Profil Pilote</title>
    <?php require_once('components/head.php'); ?>
</head>
<body>
<?php require_once('components/header.php'); ?>
<main>
    <?php require_once('components/profile.php'); ?>
    <div class="liste-etudiant">
        <form method="post">
            <h1>Vos étudiants</h1>
            <div class="search-by-name">
                <input type="search" class="search-bar" placeholder="Rechercher un étudiant">
                <input type="submit" class="submit-small" value="Rechercher">
            </div>
            <div class="list_data">
                <div class="contener_row">
                    <article class="etudiant">
                        <img src="/assets/profil.png" alt="Etudiant">
                        <div class="c1">
                            <span class="bold">NomEtudiant1</span>
                            <span>Domaine1</span>
                        </div>
                        <div class="c2">
                            <span class="bold">PrénomEtudiant1</span>
                            <span>AnnéeEtudes1</span>
                        </div>
                    </article>
                    <button class="delete">Supprimer</button>
                </div>
                <div class="contener_row">
                    <article class="etudiant">
                        <img src="/assets/profil.png" alt="Etudiant">
                        <div class="c1">
                            <span class="bold">NomEtudiant2</span>
                            <span>Domaine2</span>
                        </div>
                        <div class="c2">
                            <span class="bold">PrénomEtudiant2</span>
                            <span>AnnéeEtudes2</span>
                        </div>
                    </article>
                    <button class="delete">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
    
    <div>
        <form method="post">
            <div class="liste-offres">
            <h1>Offres postées</h1>
            <!--TODO Faire en sorte que les liens fonctionnent-->
                <div class="actions-offres">
                    <button class="button-action-offre" onclick="window.location.href='poster_offre.php';">Poster une offre</button>
                    <button class="button-action-offre" onclick="window.location.href='poster_entreprise.php';">Créer une fiche entreprise</button>
                </div>
                <div class="filtres_box">
                    <div class="filtres">
                        <input type="text" id="filter-name" placeholder="Nom">
                        <select id="filter-entreprise"><option value="default">Entreprise...</option></select>
                        <select id="filter-niveau"><option value="default">Niveau...</option></select>
                        <input type="date" id="filter-date" placeholder="Date">
                        <input type="number" id="duree" placeholder="Durée (Mois)" min="1">
                        <select id="filter-location"><option value="default">Lieu...</option></select>
                        <button id="reset-filter">Réinitiliaser</button>
                        <button id="filter-button">Filtrer</button>
                    </div>
                </div>
                <div class="contener_row">
                    <article class="offre">
                        <div class="c1">
                            <span class="poste">Poste1</span>
                            <span class="entreprise">Entreprise1</span>
                            <span class="niveau">Niveau1</span>
                        </div>
                        <div class="c2">
                            <span class="domaine">Domaine1</span>
                            <span class="dates">Dates1</span>
                        </div>
                        <div class="c3">
                            <ul class="competences">Compétences :
                                <li>competence A</li>
                                <li>competence B</li>
                            </ul>
                        </div>
                    </article>
                    <button class="delete">Supprimer</button>
                </div>

                <div class="contener_row">
                    <article class="offre">
                        <div class="c1">
                            <span class="poste">Poste2</span>
                            <span class="entreprise">Entreprise2</span>
                            <span class="niveau">Niveau2</span>
                        </div>
                        <div class="c2">
                            <span class="domaine">Domaine2</span>
                            <span class="dates">Dates2</span>
                        </div>
                        <div class="c3">
                        </div>
                        <div class="list-competences">
                            <ul class="competences">Compétences :
                                <li>competence A</li>
                                <li>competence B</li>
                            </ul>
                        </div>
                    </article>
                    <button class="delete">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
</main>
<button id="button_back" onclick="scrollToTop()"><img src="assets/arrow_up.svg" alt="fleche haut"></button>
<?php require_once('components/footer.php'); ?>
</body>
<script type="module" src="/scripts/tuteur_interne.js"></script>
</html>