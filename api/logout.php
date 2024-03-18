<?php
/**
 * TODO: Handle the disconnection of the user. delete the session and redirect to the home page.
 */
if(isset($_COOKIE['userId']))
{
    unset($_COOKIE['userId']);
    setcookie('userId', '', time() - 3600, '/');
}

header('Location: /accueil.php');