<?php
require_once '../config/db.php';
class UserModel {
    private $conn;
    public function __construct() {
        $this->conn = (new Database())->connect();
    }
    public function getSongs() {
        return $this->conn->query("select * from albums")->fetchAll(PDO::FETCH_ASSOC);
    }
}