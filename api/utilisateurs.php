<?php

use model\table\UtilisateurTable;
use model\object\Utilisateur;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/UtilisateurTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

check_connection();

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method)
{
    case 'GET': //TODO: date supérieure ou égale//
        $parameters = [];

        addIfSetLike($parameters, $_GET, 'firstname', UtilisateurTable::$PRENOM_COLUMN);
        addIfSetLike($parameters, $_GET, 'lastname', UtilisateurTable::$NOM_COLUMN);

        $table = new UtilisateurTable();
        $utilisateurs = $table->selectLike($parameters);

        echo json_encode($utilisateurs ?? []);
        exit();
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Méthode non autorisée']);
        exit();
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);



        if(!isset($data['id']) || !isset($data['firstname']) || !isset($data['lastname']) || !isset($data['email']) || !isset($data['password']) || !isset($data['phone']))
        {
            http_response_code(400);
            echo json_encode(['error' => 'Paramètres manquants', 'expected' => ['id', 'firstname', 'lastname', 'email', 'password', 'phone'], 'received' => array_keys($data ?? [])]);
            exit();
        }

        $utilisateur = new Utilisateur($data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['password'], $data['phone']);
        $table = new UtilisateurTable();
        try
        {
            $table->insert($utilisateur);
            echo json_encode(['success' => 'Utilisateur ajouté', 'utilisateur' => $utilisateur]);
        }
        catch(Exception $e)
        {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur interne', 'message' => $e->getMessage()]);
        }
        exit();
}