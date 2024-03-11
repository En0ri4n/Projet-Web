<?php
global $pdo;
require_once 'config.php';

// Set the content type to JSON
header('Content-Type: application/json');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

$data = json_decode(file_get_contents('php://input'), true);

switch($method)
{
    case 'GET':
        echo json_encode(['message' => 'GET Request Successful', 'arguments' => $_GET, 'data' => $data]);
        break;
    case 'POST':
        echo json_encode(['message' => 'POST Request Successful', 'data' => $data]);
        break;
    case 'PUT':
        echo json_encode(['message' => 'PUT Request Successful', 'data' => $data]);
        break;
    case 'DELETE':
        echo json_encode(['message' => 'DELETE Request Successful', 'data' => $data]);
        break;
    default:
        // Invalid method
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
