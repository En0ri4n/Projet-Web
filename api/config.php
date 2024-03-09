<?php
$HOST = 'cesi-project-web.sitam.me:3306';
$DB_NAME = 'projet-web-eno';
$USERNAME = 'enow';
$PASSWORD = 'enow';
try
{
    $pdo = new PDO("mysql:host=$HOST;dbname=$DB_NAME", $USERNAME, $PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    die("Database connection failed: " . $e->getMessage());
}
