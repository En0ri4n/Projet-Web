<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');

function addIfSet(array &$array, array $get_array, string $key, string $column): void
{
    if(isset($get_array[$key]))
        $array[$column] = $get_array[$key];
}

function addIfSetSpecial(array &$array, array $get_array, string $key, callable $condition): void
{
    if(isset($get_array[$key]))
        $array[] = $condition($get_array[$key]);
}

function like(string $column): callable
{
    return fn($value) => $column . " LIKE '%" . $value . "%'";
}

function dateSup(string $column): callable
{
    return fn($value) => $column . " BETWEEN '" . $value . "' AND '2100-01-01'";
}

function sup(string $column): callable
{
    return fn($value) => $column . " >= " . $value;
}

function inf(string $column): callable
{
    return fn($value) => $column . " <= " . $value;
}

function eq(string $column): callable
{
    return fn($value) => $column . " = " . $value;
}

function addIfSetLike(array &$array, array $get_array, string $key, string $column): void
{
    if(isset($get_array[$key]))
        $array[$column] = url_decode_and_percent($get_array[$key]);
}

function checkConnection(): void
{
    if(!isset($_COOKIE[Controller::$USER_COOKIE_NAME]))
    {
        http_response_code(401);
        echo json_encode(['error' => 'Vous devez être connecté pour effectuer cette action']);
        exit();
    }
}

function checkAdminConnection()
{
    checkConnection();

    if(!AdministrateurTable::isAdministrateur(Controller::getCurrentUser()->getId()))
    {
        http_response_code(403);
        echo json_encode(['error' => 'Vous devez être administrateur pour effectuer cette action']);
        exit();
    }
}

function url_decode_and_percent(string $s): string
{
    return '%' . urldecode($s) . '%';
}