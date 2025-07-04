<?php
require "../config/database.php";
class adminModel extends database {
    private $connect;

    public function __construct() {
        $this->connect = $this->connect();
    }

    public function __query($sql){
        return mysqli_query($this->connect,$sql);
    }

    // Your database connection and methods for admin-related data
    
}