<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Accueil</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <div class="presentation" id="premiere_section">
        <article class="description">
            <h1>StageFinder</h1><br>
            <p>Trouvez un stage qui vous correspond.</p>
        </article>
        <img src="/assets/stage.jpg" alt="Presentation">
    </div>
    <div class="accueil-offres">
        <div class="space-between-two">
            <button class="go-button" onclick="window.location.href='/offres';">Filtrer</button>
        </div>
        <div class="liste-offres">
                <article class="offre">
                    <div class="c1">
                        <span class="poste">Poste</span>
                        <span class="entreprise">Entreprise</span>
                        <span class="niveau">Niveau</span>
                    </div>
                    <div class="c2">
                        <span class="domaine">Domaine</span>
                        <span class="dates">Dates</span>
                    </div>
                    <div class="c3">
                        <ul class="competences">Compétences :
                            <li>competence 1</li>
                            <li>competence 2</li>
                        </ul>
                    </div>
                </article>
        </div>
    </div>
</main>
{include file='components/footer.tpl'}
<script type="module" src="/scripts/accueil.js"></script>
</body>
</html>
