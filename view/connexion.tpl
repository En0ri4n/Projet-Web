<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
    {include file='components/head.tpl'}
    <meta name="description" content="This is the connection page. It is used to connect to the website.">
    <meta name="keywords" content="connection, connexion, website, site">
</head>
<body>
{include file='components/header.tpl'}
<main>
    <div class="form">
        <h1>Connexion</h1>
        <form id="form" method="post" action="api/login" onsubmit="return onSubmit(this);">
            <div class="form__inputs">
                <input type="text" id="identifiant" name="username" placeholder="Identifiant" required>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <input type="hidden" id="token" name="token" value="">
            </div>
            <div>
                <input type="submit" class="submit" id="connect-button" value="Connexion">
            </div>
        </form>
    </div>
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/connection.js"></script>
</html>