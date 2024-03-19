<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page non trouvée</title>
    <?php require_once('components/head.php'); ?>
</head>
<body>
<?php include 'components/header.php'; ?>
<main style="display: flex; flex-direction: column">
    <h1>Erreur 404 - Page non trouvée</h1>
    <br>
    <img src="https://http.cat/images/404.jpg" style="width: max(30vw, 400px);" alt="notfound">
    <br>
    <p>Je crois que vous vous êtes perdu.</p>
    <p><a href="/accueil.php">Retour à l'accueil</a></p>
</main>
<footer class="footer"></footer>
<?php include 'components/footer.php'; ?>
</body>
</html>