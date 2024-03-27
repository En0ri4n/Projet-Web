<!DOCTYPE html>
<html lang="fr">
<head>
    <title></title>
    {include file="components/head.tpl"}
</head>
<body>
{include file="components/header.tpl"}
<main>
    <div class="profil">
        <div>
            <h1>Profil de {$user->getPrenom()} {$user->getNom()}</h1>
            <div>
                <ul>
                    <li>Identifiant : {$user->getId()}</li>
                    <li>Prénom : {$user->getPrenom()}</li>
                    <li>Nom : {$user->getNom()}</li>
                    <li>Email : {$user->getEmail()}</li>
                    <li>Téléphone : {$user->getTelephone()}</li>
                    {if isset($user->getPromotion())}
                        <li>Promotion : {$user->getIdPromotion()}</li>
                        <li>Adresse : {$user->getIdAdresse()}</li>
                    {/if}
                </ul>
            </div>
            <div>
                <img src="/assets/profil.png" alt="Image de profil">
            </div>
        </div>
    </div>
</main>
{include file="components/footer.tpl"}
</body>
</html>
