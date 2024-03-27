<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');

/**
 * TODO: Handle the disconnection of the user. delete the session and redirect to the home page.
 */
if(isset($_COOKIE[Controller::$USER_COOKIE_NAME]))
{
    unset($_COOKIE[Controller::$USER_COOKIE_NAME]);
    setcookie(Controller::$USER_COOKIE_NAME, '', time() - 3600, '/');
}

header("Location: " . Controller::$CONNECTION_PAGE);