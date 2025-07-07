<?php
    require_once "./../config/db.php";
class userModel
{

    private $connect;

    public function __construct()
    {
        $this->connect = $this->connect();
    }
    public function getSongs() {
        return $this->connect->query("select * from albums")->fetchAll(PDO::FETCH_ASSOC);
    }
}