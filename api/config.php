<?php
$HOST = 'cesi-project-web.sitam.me:3306';
$DB_NAME = 'projet-web-eno';
$USERNAME = 'enow';
$PASSWORD = 'enow';

$USER_COOKIE_NAME = 'user';
$DEFAULT_PAGE = '/accueil.php';
$CONNECTION_PAGE = '/connexion.php';

try
{
    $pdo = new PDO("mysql:host=$HOST;dbname=$DB_NAME", $USERNAME, $PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    die("Database connection failed: " . $e->getMessage());
}
