<?php

use model\table\PromotionTable;
use model\object\Promotion;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/PromotionTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Promotion.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

check_connection();

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method)
{
    case 'GET':
        $parameters = [];

        addIfSetLike($parameters, $_GET, 'nom', PromotionTable::$NAME_COLUMN);
        addIfSetLike($parameters, $_GET, 'type', PromotionTable::$TYPE_COLUMN);

        $table = new PromotionTable();
        $promos = $table->selectLike($parameters, 'model\object\Promotion::fromArray');

        echo json_encode($promos ?? []);
        exit();
    case 'POST':
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Méthode non autorisée']);
        exit();
}