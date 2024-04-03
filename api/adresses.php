<?php

use model\table\AdresseTable;
use model\object\Adresse;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/UtilisateurTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EtudiantTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

checkConnection();

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data === null) {
            http_response_code(400);
            echo json_encode(['error' => 'Données invalides']);
            exit;
        }

        if(!isset($data['noAddress']) || !isset($data['street']) || !isset($data['city']) || !isset($data['pc']) || !isset($data['country'])){
            http_response_code(400);
            echo json_encode(['error' => 'Paramètres manquants', 'expected' => ['noAddress', 'street', 'city', 'pc', 'country', 'idPromo'], 'received' => array_keys($data ?? [])]);
            exit();
        }

        try {
            $address = new \model\object\Adresse(-1, $data['noAddress'], $data['street'], $data['city'], $data['pc'], $data['country']);
            $tableAddress = new \model\table\AdresseTable();
            $tableAddress->insert($address);
            http_response_code(201);
            echo json_encode(['id' => $tableAddress->getLastInsertId()]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur interne', 'message' => $e->getMessage()]);
        }
        exit;
    default:
        http_response_code(500);
        echo json_encode(['error' => 'Méthode non supportée']);
        exit;
}