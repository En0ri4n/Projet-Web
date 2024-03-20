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
    <div class="etudiants">
        <h1>Chercher un étudiant</h1>
        <form method="post">
            <div class="recherche">
                <input type="search" placeholder="Rechercher un profil étudiant">
                <input type="submit" value="Ajouter">
            </div>
            <h1>Vos étudiants</h1>
            <div class="list_data">
                <div class="contener_row">
                    <div class="row_data">
                        <img src="/assets/logo.png" alt="Etudiant">
                        <article>
                            <div class="c1">
                                <span class="bold">NomEtudiant1</span>
                                <span>Domaine1</span>
                            </div>
                            <div class="c2">
                                <span class="bold">PrénomEtudiant1</span>
                                <span>AnnéeEtudes1</span>
                            </div>
                        </article>
                    </div>
                    <button class="delete">Supprimer</button>
                </div>
                <div class="contener_row">
                    <div class="row_data">
                        <img src="/assets/logo.png" alt="Etudiant">
                        <article>
                            <div class="c1">
                                <span class="bold">NomEtudiant2</span>
                                <span>Domaine2</span>
                            </div>
                            <div class="c2">
                                <span class="bold">PrénomEtudiant2</span>
                                <span>AnnéeEtudes2</span>
                            </div>
                        </article>
                    </div>
                    <button class="delete">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
    <div class="offres">
        <form method="post">
            <h1>Poster des offres</h1>
            <div class="add">
                <button class="new" onclick="window.location.href='poster_offre.php';">Poster une offre</button>
                <button class="new" onclick="window.location.href='poster_entreprise.php';">Créer une fiche entreprise</button>
            </div>
            <h1>Offres postées</h1>
            <div class="list_data">
                <div class="parametres">
                    <div class="mode"><a class="selected">Offres postées</a> | <a href="">Fiches entreprises</a></div>
                    <button class="filtres">Filtrer ▼</button>
                </div>
                <div class="contener_row">
                    <div class="row_data">
                        <img src="/assets/logo.png" alt="Entreprise">
                        <article>
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
                            </div>
                            <div class="list-competences">
                                <ul class="competences">Compétences :
                                    <li>competence A</li>
                                    <li>competence B</li>
                                </ul>
                            </div>
                        </article>
                    </div>
                    <button class="delete">Supprimer</button>
                </div>

                <div class="contener_row">
                    <div class="row_data">
                        <img src="/assets/logo.png" alt="Entreprise">
                        <article>
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
                    </div>
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