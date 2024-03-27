<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Profil Pilote</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    {include file='components/profile.php'}
    
</main>
<button id="button_back" onclick="scrollToTop()"><img src="../assets/arrow_up.svg" alt="fleche haut"></button>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/tuteur_interne.js"></script>
</html>