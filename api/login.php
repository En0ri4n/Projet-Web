<?php

use model\table\UtilisateurTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/UtilisateurTable.php');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method)
{
    case 'POST':
        $username = $_POST['username'];
        $password = $_POST['token'];

        try
        {
            $utilisateur_table = new UtilisateurTable();
            $utilisateur = $utilisateur_table->select(array(UtilisateurTable::$ID_COLUMN => $username, UtilisateurTable::$PASSWORD_COLUMN => $password));

            if($utilisateur !== null)
            {
                header('Location: ' . Controller::$DEFAULT_PAGE);
                setcookie(Controller::$USER_COOKIE_NAME, base64_encode(json_encode($utilisateur->toArray())), time() + 3600, '/');
                echo json_encode(['authorized' => true, 'message' => 'User authentified', 'user' => $utilisateur->getId()]);
            }
            else
            {
                header('Location: ' . Controller::$CONNECTION_PAGE);
                echo json_encode(['authorized' => false, 'message' => 'Invalid username or password']);
            }
            return;
        }
        catch(Exception $e)
        {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;
    case 'PUT':
    case 'DELETE':
    case 'GET':
    default:
        // Invalid method
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
