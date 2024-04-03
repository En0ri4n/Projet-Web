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
    <div class="accueil-boutons">
        <h1>Vous cherchez....</h1>
        <div class="liste-boutons-accueil">
            <button class="go-button" onclick="window.location.href='/entreprises';">Une Entreprise ?</button>
            <button class="go-button" onclick="window.location.href='/offres';">Une Offre de stage ?</button>
            <button class="go-button" onclick="window.location.href='/utilisateurs';">Un Utilisateur ?</button>
        </div>
    </div>
</main>
{include file='components/footer.tpl'}
<script src="/scripts/sw.js"></script>
</body>
</html>
