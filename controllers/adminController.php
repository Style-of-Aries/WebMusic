<?php
require_once "./../models/adminModel.php";
class adminController {


    private $adminModel;
    public function __construct()
    {
        
        $adminModel = new adminModel();
    }


    public function index() {
        // Code for the admin dashboard
        require_once './../views/admin/layout.php';
    }

}