<?php

use model\table\AbstractTable;

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
    return fn($value) => $column . " = '" . $value . "'";
}

function checkIfGetColumn(AbstractTable $table): void
{
    if(isset($_GET['column']))
    {
        if(str_contains($_GET['column'], ','))
        {
            $columns = explode(',', $_GET['column']);
            $columns = array_map(fn($col) => trim($col), $columns);

            foreach($columns as $column)
            {
                if(!in_array($column, $table->selectColumnNames()))
                {
                    http_response_code(400);
                    echo json_encode(['column' => $column, 'error' => 'La colonne demandée n\'existe pas', 'count' => 0, 'values' => []]);
                    exit();
                }
            }

            $values = $table->selectColumnsValues($columns);

            echo json_encode(['columns' => $columns, 'count' => count($values), 'values' => $values]);
            exit();
        }

        if(!in_array($_GET['column'], $table->selectColumnNames()))
        {
            http_response_code(400);
            echo json_encode(['column' => $_GET['column'], 'error' => 'La colonne demandée n\'existe pas', 'count' => 0, 'values' => []]);
            exit();
        }

        $values = $table->selectColumnValues($_GET['column']);

        echo json_encode(['column' => $_GET['column'], 'count' => count($values), 'values' => $values]);
        exit();
    }
}

function addIfSetLike(array &$array, array $get_array, string $key, string $column): void
{
    if(isset($get_array[$key]))
        $array[$column] = url_decode_and_percent($get_array[$key]);
}

function checkUserConnection(): void
{
    if(!isset($_COOKIE[Controller::$USER_COOKIE_NAME]))
    {
        http_response_code(401);
        echo json_encode(['error' => 'Vous devez être connecté pour effectuer cette action']);
        exit();
    }
}

function checkConnection(): void
{
    checkUserConnection();

    if(in_array($_SERVER['REQUEST_METHOD'], ['POST', 'PUT', 'DELETE']))
    {
        if(!AdministrateurTable::isAdministrateur(Controller::getCurrentUser()->getId()))
        {
            http_response_code(403);
            echo json_encode(['status' => 'error', 'error' => 'Vous devez être administrateur pour effectuer cette action']);
            exit();
        }
    }
}

function setupPages($size): array
{
    $json = [];
    $json['per_page'] = getPerPage();
    $json['page'] = getPage();
    $json['total_pages'] = ceil($size / getPerPage());
    return $json;
}

function getPerPage(): int
{
    if(isset($_GET['per_page']) && is_numeric($_GET['per_page']))
    {
        return intval($_GET['per_page']);
    }

    return 10;
}

function getPage(): int
{
    if(isset($_GET['page']) && is_numeric($_GET['page']))
    {
        return intval($_GET['page']);
    }

    return 1;
}

function url_decode_and_percent(string $s): string
{
    return '%' . urldecode($s) . '%';
}

function fromColumn(string $col)
{
    return explode('.', $col)[1];
}