<?php
global $USER_COOKIE_NAME, $DEFAULT_PAGE, $CONNECTION_PAGE, $FORBIDDEN_PAGE;
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php');
?>
<header id="header">
    <img src="/assets/logo.svg" alt="Logo" onclick="window.location.href='<?= $DEFAULT_PAGE ?>'">
    <!--<div class="search-wrapper">
        <input type="text" id="search-input" placeholder="Type to search"/> TODO: See what we do
    </div>-->
    <div class="login">
        <?php

        if(isset($_COOKIE[$USER_COOKIE_NAME]))
        {
            $user = Utilisateur::fromArray(json_decode(base64_decode($_COOKIE[$USER_COOKIE_NAME]), true));

            echo '<a href="/users/' . $user->getId() . '">' . $user->getPrenom() . ' ' . $user->getNom() . '</a> ';

            echo '<a href="/api/logout">Déconnexion</a>';
        }
        else
        {
            $requested_uri = $_SERVER['REQUEST_URI'];
            $current_uri = trim(strtok($requested_uri, '?'));

            if($current_uri !== $CONNECTION_PAGE && $current_uri !== $FORBIDDEN_PAGE)
            {
                header('Location: ' . $FORBIDDEN_PAGE . '?from=' . urlencode($current_uri));
            }
        }
        ?>
    </div>
</header>


