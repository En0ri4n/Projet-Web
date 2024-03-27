<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Nous contacter</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
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
                <textarea id="commentaire" placeholder="Ecrivez votre demande"></textarea>
            </div>
            </br>
            <div class="center">
                <input class="submit" type="submit" value="Envoyer">
            </div>
            
        </form>
    </div>
</main>
{include file='components/footer.tpl'}
</body>
</html>