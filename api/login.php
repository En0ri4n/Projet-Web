<?php
global $pdo;

use Table\UtilisateurTable;

require_once 'config.php';
include_once 'table/UtilisateurTable.php';

// Set the content type to JSON
header('Content-Type: application/json');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

switch($method)
{
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];
        $password = $data['password'];

        try
        {
            $utilisateur = UtilisateurTable::getUtilisateurTable($pdo)->selectUtilisateur(array(), array(UtilisateurTable::$ID_COLUMN => $username, UtilisateurTable::$PASSWORD_COLUMN => $password));

            if(!$utilisateur->isEmpty())
            {
                setcookie('userId', $utilisateur->getId(), time() + 3600, '/');
                echo json_encode(['authorized' => true, 'message' => 'User authentified', 'user' => $utilisateur->getId(), 'redirect' => '/accueil.php']);
            }
            else
            {
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
