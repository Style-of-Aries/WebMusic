<?php
    require_once "./../config/database.php";
class userModel extends database
{

    private $connect;

    public function __construct()
    {
        $this->connect= $this->connect();
    }
    public function getSongs(){
        
    }

}