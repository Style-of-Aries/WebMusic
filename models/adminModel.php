<?php
require_once "./../config/database.php";
class AdminModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Your database connection and methods for admin-related data
    public function getAllSongs() {
        $query = "SELECT * FROM songs";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}