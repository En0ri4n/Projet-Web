<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page non trouvée</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <h1>Erreur 404 - Page non trouvée</h1>
    <img src="https://http.cat/images/404.jpg" class="image-error-page" alt="notfound">
    <p>Je crois que vous vous êtes perdu.</p>
    <p><a href="{$default_page}">Retour à l'accueil</a></p>
</main>
<footer class="footer"></footer>
{include file='components/footer.tpl'}
</body>
</html>