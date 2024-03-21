<?php global $FORBIDDEN_PAGE, $CONNECTION_PAGE; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Interdit 403</title>
    <?php require_once('components/head.php'); ?>
</head>
<body>
<?php require_once('components/header.php'); ?>
<main style="display: flex; flex-direction: column">
    <h1>Erreur 403 - Interdit</h1>
    <br>
    <img src="https://http.dog/403.jpg" style="width: max(30vw, 400px);" alt="forbidden">
    <br>
    <p>Vous n'avez pas le droit d'accéder à cette page.</p>
    <p><a href="<?= $CONNECTION_PAGE . '?' . $_SERVER['QUERY_STRING'] ?>">Connectez vous pour continuer</a></p>
</main>
<footer class="footer"></footer>
<?php require_once('components/footer.php'); ?>
</body>
</html>