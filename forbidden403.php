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
    <h1>Erreur 403 - Interdit</h1>
    <br>
    <img src="https://http.dog/403.jpg" style="width: max(30vw, 400px);" alt="forbidden">
    <br>
    <p>Vous n'avez pas le droit d'accéder à cette page.</p>
    <p><a href="/accueil.php">Retour à l'accueil</a></p>
</main>
<footer class="footer"></footer>
<?php include 'components/footer.php'; ?>
</body>
</html>