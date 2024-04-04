<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Offres de Stage</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <div class="filtres_box" id="premiere_section">
        <h1>Filtres</h1>
        <div class="filtres">
            <input type="text" id="filter-name" placeholder="Nom">
            <select id="filter-entreprise">
                <option value="" disabled selected>Entreprise</option>
            </select>
            <select id="filter-niveau">
                <option value="" disabled selected>Niveau</option>
            </select>
            <input type="date" id="filter-date" placeholder="Date">
            <input type="number" id="filter-duree" placeholder="Durée (Mois)" min="1">
            <select id="filter-location">
                <option value="" disabled selected>Lieu</option>
            </select>
            <button class="reset-filter" id="reset-filter">Réinitiliaser</button>
            <button id="search-button">Filtrer</button>
        </div>
    </div>
    <div class="liste-offres" id="liste-offres">
        <img src="/assets/loading.gif" alt="loading" id="loading"/>
    </div>
    {include file="components/pagination.tpl"}
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/offres.js"></script>
</html>
