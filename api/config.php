<?php

class Database
{
    private static string $HOST = 'cesi-project-web.sitam.me:3306';
    private static string $DB_NAME = 'projet-web-eno';
    private static string $USERNAME = 'enow';
    private static string $PASSWORD = 'enow';

    private static PDO $pdo;

    public static function getDatabase(): PDO
    {
        if(!isset(self::$pdo))
            try
            {
                self::$pdo = new PDO("mysql:host=" . self::$HOST . ";dbname=" . self::$DB_NAME, self::$USERNAME, self::$PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                die("Database connection failed: " . $e->getMessage());
            }

        return self::$pdo;
    }
}
