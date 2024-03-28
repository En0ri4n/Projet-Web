<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Profil Pilote</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    {include file='components/profile.tpl'}

    <!-- TODO: lien sur boutons modifier vers inscription etudiant --> 
    <div class="liste-etudiant">
        <form method="post">
            <h1>Etudiants</h1>
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
                    <button class="delete">Modifier</button>

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
                    <button class="delete">Modifier</button>

                </div>
            </div>
        </form>
    </div>
    
    <!-- TODO: lien sur boutons modifier vers poster offre --> 
    <div>
        <form method="post">
            <div class="liste-offres">
            
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
                    <button class="delete">Modifier</button>

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
                    <button class="delete">Modifier</button>

                </div>
            </div>
        </form>
    </div>

    <!-- TODO: lien sur boutons modifier vers creer fiche entreprise --> 
    <div class="liste-entreprise">
        <form method="post">
            <h1>Entreprise</h1>
            <div class="search-by-name">
                <input type="search" class="search-bar" placeholder="Rechercher une entreprise">
                <input type="submit" class="submit-small" value="Rechercher">
            </div>
            <div class="list_data">
                <div class="contener_row">
                    <article class="etudiant">
                        <div class="c1">
                            <span class="bold">NomEntreprise1</span>
                            <span>Statut1</span>
                        </div>
                        <div class="c2">
                            <span class="bold">Mail1</span>
                            <span>Telephone1</span>
                        </div>
                        <div class="c3">
                            <span class="bold">SiteDEntreprise1</span>
                            
                        </div>
                    </article>
                    <button class="delete">Supprimer</button>
                    <button class="delete">Modifier</button>
                </div>
                <div class="contener_row">
                    <article class="etudiant">
                        <div class="c1">
                            <span class="bold">NomEntreprise2</span>
                            <span>Statut2</span>
                        </div>
                        <div class="c2">
                            <span class="bold">Mail2</span>
                            <span>Telephone2</span>
                        </div>
                        <div class="c3">
                            <span class="bold">SiteDEntreprise2</span>
                            
                        </div>
                    </article>
                    <button class="delete">Supprimer</button>
                    <button class="delete">Modifier</button>
            </div>
            <h1>Ajouter</h1>
            <!--TODO Faire en sorte que les liens fonctionnent-->
                <div class="actions-offres">
                    <button class="button-action-offre" onclick="window.location.href='poster_offre.php';">Poster une offre</button>
                    <button class="button-action-offre" onclick="window.location.href='poster_entreprise.php';">Créer une fiche entreprise</button>
                    <button class="button-action-offre" onclick="window.location.href='inscription.php';">Ajouter un étudiant</button>

                </div>
        </form>
    </div>

</main>
<button id="button_back" onclick="scrollToTop()"><img src="../assets/arrow_up.svg" alt="fleche haut"></button>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/tuteur_interne.js"></script>
</html>