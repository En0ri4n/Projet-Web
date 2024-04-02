<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Nous contacter</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<!--Ajouter un envoi invisible de l'username-->
<main>
    <div class="form">
        <h1>Formulaire de contact</h1>
        <form method="post">
            <div class = "form__inputs">
                <textarea id="commentaire" placeholder="Ecrivez votre demande"></textarea>
                <input class="submit" type="submit" value="Envoyer">
            </div>
        </form>
    </div>
</main>
{include file='components/footer.tpl'}
</body>
</html>