<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');

if(isset($_COOKIE[Controller::$USER_COOKIE_NAME]))
{
    unset($_COOKIE[Controller::$USER_COOKIE_NAME]);
    setcookie(Controller::$USER_COOKIE_NAME, '', time() - 3600, '/');
}

header("Location: " . Controller::$CONNECTION_PAGE);