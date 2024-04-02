<?php

use model\table\EntrepriseTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EntrepriseTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch ($method) {
    case 'GET':
        $parameters = [];

        addIfSetLike($parameters, $_GET, 'name', EntrepriseTable::$NOM_COLUMN);
        addIfSetLike($parameters, $_GET, 'description', EntrepriseTable::$DESCRIPTION_COLUMN);
        addIfSet($parameters, $_GET, 'status', EntrepriseTable::$STATUS_COLUMN);

        try {
            $table = new EntrepriseTable();
            $entreprises = $table->selectLike($parameters, fn($a) => \model\object\Entreprise::fromArray($a));

            echo json_encode($entreprises ?? []);
            exit();
        }
        catch (Exception $e)
        {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur interne', 'message' => $e->getMessage()]);
        }
}