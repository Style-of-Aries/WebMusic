<?php
require_once '../models/userModel.php';
class UserController {
    public function __construct() {
        $this->userModel = new UserModel();
    }
    public function index() {
        $songs = $this->userModel->getSongs();
        require_once './../views/user/layout.php';
    }
}