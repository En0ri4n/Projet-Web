<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/styles/connexion.css">
    <link rel="stylesheet" href="/assets/styles/components.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Description: This is the connection page. -->
    <!-- It is used to connect to the website. -->
    <meta name="description" content="This is the connection page. It is used to connect to the website.">
    <meta name="keywords" content="connection, connexion, website, site">
</head>
<body id="body">
<?php include 'components/header.php'; ?>
<main class="main">
    <div class="form">
        <h1>Connexion</h1>
        <br>
        <form method="post">
            <div class="form__inputs">
                <input type="text" id="identifiant" name="identifiant" placeholder="Identifiant" required>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <br>
            <div class="center">
                <input type="submit" value="Connexion">
            </div>

        </form>
    </div>
</main>
<?php include 'components/footer.php'; ?>
<script src="/scripts/connexion.js"></script>
</body>
</html>