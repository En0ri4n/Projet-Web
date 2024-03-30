<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');

function check_connection(): void
{
    if(!isset($_COOKIE[Controller::$USER_COOKIE_NAME]))
    {
        http_response_code(401);
        echo json_encode(['error' => 'Vous devez être connecté pour effectuer cette action']);
        exit();
    }
}
function url_decode_and_percent(string $s): string
{
    return '%' . urldecode($s) . '%';
}