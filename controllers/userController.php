<?php
require_once "./../models/userModel.php";

class userController{
    private $userModel;
    public function __construct()
    {
        $this->userModel= new userModel();
    }

    public function index(){
        require_once './../views/user/layout.php';

    }
}