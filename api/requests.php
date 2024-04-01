<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');

function addIfSet(array &$array, array $get_array, string $key, string $column): void
{
    if(isset($get_array[$key]))
        $array[$column] = $get_array[$key];
}

function addIfSetLike(array &$array, array $get_array, string $key, string $column): void
{
    if(isset($get_array[$key]))
        $array[$column] = url_decode_and_percent($get_array[$key]);
}

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