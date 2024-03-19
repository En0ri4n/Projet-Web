<?php
global $pdo, $USER_COOKIE_NAME, $DEFAULT_PAGE, $CONNECTION_PAGE;

require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

switch($method)
{
    case 'POST':
        $username = $_POST['username'];
        $password = $_POST['password'];

        try
        {
            $utilisateur = Tables::get()::$UTILISATEUR_TABLE->selectUtilisateur(array(UtilisateurTable::$ID_COLUMN => $username, UtilisateurTable::$PASSWORD_COLUMN => $password));

            if(!$utilisateur->isEmpty())
            {
                header("Location: $DEFAULT_PAGE");
                setcookie($USER_COOKIE_NAME, base64_encode(json_encode($utilisateur->toArray())), time() + 3600, '/');
                echo json_encode(['authorized' => true, 'message' => 'User authentified', 'user' => $utilisateur->getId()]);
            }
            else
            {
                header("Location: $CONNECTION_PAGE");
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
