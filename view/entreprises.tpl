<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Entreprises</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <div class="liste-entreprise">
        <form method="post">
            <h1>Entreprises</h1>
            <div class="search-by-name" id="premiere_section">
                <input type="search" class="search-bar" id="filter-nom" placeholder="Rechercher une entreprise">
                <button class="submit-small" id="search-button">Rechercher</button>
            </div>
        </form>
        <div class="list_data" id="liste-entreprises">
            <img src="/assets/loading.gif" alt="loading" id="loading"/>
        </div>
    </div>
    {include file='components/pagination.tpl'}
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/entreprises.js"></script><!-- TODO Créer le bon script-->
</html>
