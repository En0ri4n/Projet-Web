<?php
$host = 'cesi-project-web.sitam.me:3306';
$dbname = 'projet-web-eno';
$username = 'enow';
$password = 'enow';
try
{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    die("Database connection failed: " . $e->getMessage());
}
