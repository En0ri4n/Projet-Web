<?php

use model\table\PromotionTable;
use model\object\Promotion;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/PromotionTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Promotion.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

checkConnection();

ob_start('ob_gzhandler');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch ($method) {
    case 'GET':
        checkIfGetColumn(new PromotionTable());

        $parameters = [];

        addIfSetLike($parameters, $_GET, 'nom', PromotionTable::$NAME_COLUMN);
        addIfSetLike($parameters, $_GET, 'type', PromotionTable::$TYPE_COLUMN);

        $table = new PromotionTable();

        $total_promos = $table->selectLike($parameters, 'model\object\Promotion::fromArray');

        $promos = $table->selectLike($parameters, 'model\object\Promotion::fromArray');

        $json = setupPages(count(is_array($total_promos) ? $total_promos : ($total_promos === null ? [] : [$total_promos])));
        $json['promotions'] = $promos === null ? [] : (is_array($promos) ? $promos : [$promos]);

        echo json_encode($json);
        exit();
    case 'POST':
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Méthode non autorisée']);
        exit();
}