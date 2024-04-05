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
                <input type="search" class="search-bar" id="filter-nom" placeholder="Rechercher un utilisateur">
                <button class="submit-small" id="search-button">Rechercher</button>
            </div>
        </form>
        <div class="list_data" id="liste-utilisateurs">
            <img src="/assets/loading.gif" alt="loading" id="loading"/>
        </div>
    </div>
    {include file='components/pagination.tpl' index=0}
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/users.js"></script><!-- TODO Créer le bon script-->
</html>
