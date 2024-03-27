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
                <option value="null">Entreprise...</option>
            </select>
            <select id="filter-niveau">
                <option value="null">Niveau...</option>
            </select>
            <input type="date" id="filter-date" placeholder="Date">
            <input type="number" id="duree" placeholder="Durée (Mois)" min="1">
            <select id="filter-location">
                <option value="null">Lieu...</option>
            </select>
            <button id="reset-filter">Réinitiliaser</button>
            <button id="filter-button">Filtrer</button>
        </div>
    </div>
    <div class="liste-offres">
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
    </div>
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/offres.js"></script>
</html>
