<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Entreprises</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <div class="liste-utilisateur">
        <form method="post">
            <h1>Entreprise</h1>
            <div class="search-by-name">
                <input type="search" class="search-bar" placeholder="Rechercher une entreprise">
                <input type="submit" class="submit-small" value="Rechercher">
            </div>
        </form>
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
            </div>
        </div>
    </div>
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/offres.js"></script> <!-- TODO Créer le bon script-->
</html>
