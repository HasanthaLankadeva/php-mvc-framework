<?php

class Database
{
    private static ?PDO $pdo = null;

    public static function connect(): PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        $host = Env::get('DB_HOST');
        $db   = Env::get('DB_NAME');
        $user = Env::get('DB_USER');
        $pass = Env::get('DB_PASS');
        $char = Env::get('DB_CHARSET', 'utf8mb4');

        if (!$host || !$db || !$user) {
            die('Database environment variables missing');
        }

        $dsn = "mysql:host=$host;dbname=$db;charset=$char";

        self::$pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        return self::$pdo;
    }
}

?>