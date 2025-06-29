<?php
class Database {
    private $host = 'localhost';
    private $dbName = 'webmusic';
    private $username = 'root';
    private $password = '';

    public function connect() {
        $dsn = "mysql:host=$this->host;dbname=$this->dbName;charset=utf8mb4";
        try {
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }
}