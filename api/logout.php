<?php
global $DEFAULT_PAGE, $USER_COOKIE_NAME;
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php');
/**
 * TODO: Handle the disconnection of the user. delete the session and redirect to the home page.
 */
if(isset($_COOKIE[$USER_COOKIE_NAME]))
{
    unset($_COOKIE[$USER_COOKIE_NAME]);
    setcookie($USER_COOKIE_NAME, '', time() - 3600, '/');
}

header("Location: $DEFAULT_PAGE");