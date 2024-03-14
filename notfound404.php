<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Interdiction</title>
    <link rel="stylesheet" href="/assets/styles/connexion.css">
    <link rel="stylesheet" href="/assets/styles/components.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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