<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Inscription</title>
    {include file='components/head.tpl'}
    <!-- Description: This is the inscription page. -->
    <!-- It is used to create an account on the website. -->
    <meta name="description" content="This is the inscription page. It is used to create an account on the website.">
    <meta name="keywords" content="inscription, account, create, website">
</head>
<body>
{include file='components/header.tpl'}
<main>
    <div class="form">
        <h1>Inscription</h1>
        <form method="post" id="form_inscription">
            <div class="form__inputs">
                <input type="text" id="nom" name="nom" placeholder="Nom" required>
                <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
                <input type="email" id="email" name="email" placeholder="E-mail" required>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <input type="password" id="password-confirm" name="password-confirm" placeholder="Confirmation" required>
            </div>
            <div class="account-type" id="account">
                <div>
                    <input type="radio" id="student-account" name="account-type" value="student" required>
                    <label for="student-account">Élève</label>
                </div>
                <div>
                    <input type="radio" id="pilote-account" name="account-type" value="tuteur" required>
                    <label for="pilote-account">Tuteur</label>
                </div>
            </div>
            <div class="center">
                <input class="submit" type="submit" value="Confirmer l'inscription">
            </div>
        </form>
    </div>
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/inscription.js"></script>
</html>