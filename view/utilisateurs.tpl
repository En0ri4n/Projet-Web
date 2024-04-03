<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Utilisateurs</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <div class="liste-utilisateur">
        <form method="post">
            <h1>Utilisateurs</h1>
            <div class="search-by-name" id="premiere_section">
                <input type="search" class="search-bar" placeholder="Rechercher un étudiant">
                <input type="submit" class="submit-small" value="Rechercher">
            </div>
        </form>
        <div class="list_data" id="liste-utilisateurs">
            <div class="contener_row">
                <article class="etudiant">
                    <img src="/assets/profil.png" alt="Etudiant">
                    <div class="c1">
                        <span class="bold">NomEtudiant1</span>
                        <span>Promotion1</span>
                    </div>
                    <div class="c2">
                        <span class="bold">PrénomEtudiant1</span>
                        <span>AnnéeEtudes1</span>
                    </div>
                </article>
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
            </div>
            <div class="contener_row">
                <article class="pilote">
                    <img src="/assets/profil.png" alt="Pilote">
                    <div class="c1">
                        <span class="bold">NomPilote</span>
                        <span>Pilote</span>
                    </div>
                    <div class="c2">
                        <span class="bold">PrénomPilote</span>
                    </div>
                </article>
            </div>
        </div>
    </div>
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/users.js"></script>  <!-- TODO Créer le bon script-->
</html>
