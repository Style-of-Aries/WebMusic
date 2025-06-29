<?php
require_once "./../models/authModel.php";
class authController {
    public function login() {
        require_once "./../views/auth/login.php";
    }

    public function register() {
        require_once "./../views/auth/register.php";
    }
}