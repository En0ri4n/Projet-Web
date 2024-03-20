<?php
require_once(__DIR__ . '/api/includes.php');
$utilisateur = Tables::get()::$UTILISATEUR_TABLE->selectUtilisateur(array(UtilisateurTable::$ID_COLUMN => ($_GET["userId"] ?? 'enorian.rajoelisoa')));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $utilisateur->getPrenom() . ' ' . $utilisateur->getNom(); ?></title>
    <?php require_once('components/head.php'); ?>
</head>
<body>
<?php require_once('components/header.php'); ?>
<main>
    <div class="profil">
        <div>
            <h1>Profil de <?= $utilisateur->getPrenom() . ' ' . $utilisateur->getNom(); ?></h1>
        </div>
        <img src="/assets/profil.png" alt="Image de profil">
    </div>
</main>
<?php require_once('components/footer.php'); ?>
</body>
</html>
