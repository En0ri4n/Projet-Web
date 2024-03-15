<?php
global $pdo;
require_once 'config.php';

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

        $stmt = $pdo->prepare("SELECT * FROM Utilisateur WHERE `IdUtilisateur` = :username AND `MotDePasse` = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch();

        if($result)
        {
            setcookie('userId', $result['IdUtilisateur'], time() + 3600, '/');
            echo json_encode(['authorized' => true, 'message' => 'Authorized', 'user' => $result['IdUtilisateur'], 'redirect' => '/accueil.html']);
        }
        else
        {
            echo json_encode(['authorized' => false, 'message' => 'Invalid username or password']);
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
