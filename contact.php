<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Nous contacter</title>
    <?php require_once('components/head.php'); ?>
</head>
<body>
<?php include 'components/header.php'; ?>
<main>
    <p>Nous contacter</p>
    <div class="form">
        <h1>Formulaire de contact</h1>
        <br>
        <form method="post">
            <div class="form__inputs">
                <input type="text" id="identifiant" name="identifiant" placeholder="Identifiant" required>
            </div>
            <br>
            <div class = "form__inputs">
                <textarea type="text" id="commentaire" placeholder="Ecrivez votre demande"></textarea>
            </div>
            </br>
            <div class="center">
                <input class="submit" type="submit" value="Envoyer">
            </div>
            
        </form>
    </div>
</main>
<?php include 'components/footer.php'; ?>
</body>
</html>