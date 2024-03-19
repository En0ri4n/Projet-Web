<?php global $USER_COOKIE_NAME;
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php'); ?>
<div class="profil">
    <div class="form">
        <h1>Profil de <?php
            $user = Tables::get()::$UTILISATEUR_TABLE->selectUtilisateur([UtilisateurTable::$ID_COLUMN => $_COOKIE[$USER_COOKIE_NAME]]);
            echo $user->getPrenom() . ' ' . $user->getNom() ?></h1>
    </div>
    <img src="/assets/profil.png" alt="Image de profil">
</div>