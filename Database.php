<?php
class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $config = include __DIR__ . '/../../config/config.php';
        $dsn = "mysql:host={$config['host']};dbname={$config['db_name']};charset={$config['charset']}";
        $this->pdo = new PDO($dsn, $config['username'], $config['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
