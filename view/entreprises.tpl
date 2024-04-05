<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Entreprises</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <section class="liste-entreprise">
        <form method="post">

                <div class="filtres_box" id="premiere_section">
                    <h1>Filtres</h1>
                    <div class="filtres">
                        <input type="text" id="filter-name" placeholder="Nom">
                        <select id="filter-secteur">
                            <option value="" disabled selected>Secteur</option>
                        </select>
                        <button class="reset-filter" id="reset-filter">Réinitiliaser</button>
                        <button id="search-button">Filtrer</button>
            <h1>Entreprises</h1>
            <div class="search-by-name" id="premiere_section">
                <input type="search" class="search-bar" id="filter-nomEntreprise" placeholder="Rechercher une entreprise">
                <button class="submit-small" id="search-button">Rechercher</button>
            </div>
                </div>
        </form>
        <div class="list_data" id="liste-entreprises">
            <img src="/assets/loading.gif" alt="loading" id="loading"/>
        </div>
    </section>
    {include file='components/pagination.tpl' index=0}
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/entreprises.js"></script><!-- TODO Créer le bon script-->
</html>
