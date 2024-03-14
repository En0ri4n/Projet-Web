<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="/assets/styles/inscription.css">
    <link rel="stylesheet" href="/assets/styles/components.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Description: This is the inscription page. -->
    <!-- It is used to create an account on the website. -->
    <meta name="description" content="This is the inscription page. It is used to create an account on the website.">
    <meta name="keywords" content="inscription, account, create, website">
</head>
<body>
<?php include('components/header.php');?>
<main class="main">
    <div class="form">
        <h1>Inscription</h1>
        <br>
        <form method="post" id="form_inscription">
            <div class="form__inputs">
                <input type="text" id="nom" name="nom" placeholder="Nom" required>
                <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
                <input type="email" id="email" name="email" placeholder="E-mail" required>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <input type="password" id="password-confirm" name="password-confirm" placeholder="Confirmation" required>
            </div>
            <br>
            <div class="account-type" id="account">
                <div>
                    <input type="radio" id="student-account" name="account-type" value="student" required>
                    <label for="student-account">Élève</label>
                </div>
                <div>
                    <input type="radio" id="pilote-account" name="account-type" value="tuteur" required>
                    <label for="pilote-account">Tuteur</label><br>
                </div>
            </div>
            <div class="center">
                <input type="submit" value="Confirmer l'inscription">
            </div>
        </form>
    </div>
</main>
<?php include('components/footer.php'); ?>
</body>
<script type="module" src="/scripts/inscription.js"></script>
</html>