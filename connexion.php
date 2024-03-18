<!DOCTYPE html>
<html lang="en">
<head>
    <title>Connexion</title>
    <?php include('components/head.php'); ?>
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
        <form method="post">
            <div class="form__inputs">
                <input type="text" id="identifiant" name="identifiant" placeholder="Identifiant" required>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div>
                <button class="submit" id="connect-button">Connexion</button>
            </div>
        </form>
    </div>
</main>
<?php include 'components/footer.php'; ?>
<script type="module" src="scripts/connection.js"></script>
</body>
</html>