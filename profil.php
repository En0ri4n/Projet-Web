<?php
require_once(__DIR__ . '/api/includes.php');
$utilisateur = Tables::get()::$UTILISATEUR_TABLE->selectUtilisateur(array(UtilisateurTable::$ID_COLUMN => ($_GET["userId"] ?? 'Enorian.Rajoelisoa')));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $utilisateur->getPrenom() . ' ' . $utilisateur->getNom(); ?></title>
    <?php require_once('components/head.php'); ?>
</head>
<body>
<?php include 'components/header.php'; ?>
<main>
    <div class="profil">
        <div>
            <h1>Profil de <?= $utilisateur->getPrenom() . ' ' . $utilisateur->getNom(); ?></h1>
        </div>
        <img src="/assets/profil.png" alt="Image de profil">
    </div>
</main>
<?php include 'components/footer.php'; ?>
</body>
</html>
