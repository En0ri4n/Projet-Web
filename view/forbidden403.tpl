<?php global $FORBIDDEN_PAGE, $CONNECTION_PAGE; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Interdit 403</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <h1>Erreur 403 - Interdit</h1>
    <img class="image-error-page" src="https://http.dog/403.jpg" alt="forbidden">
    <p>Vous n'avez pas le droit d'accéder à cette page.</p>
    <p><a href="{$connection_page}">Connectez vous pour continuer</a></p>
</main>
<footer class="footer"></footer>
{include file='components/footer.tpl'}
</body>
</html>