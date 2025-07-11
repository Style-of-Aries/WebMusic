<?php
require_once '../models/userModel.php';
class UserController {
    private $userModel;
    public function __construct() {
        $this->userModel = new UserModel();
    }
    public function index() {
        $songs = $this->userModel->getSongs();
        require_once './../views/user/list.php';
    }
    public function bxh() {
        $songs = $this->userModel->getSongs();
        require_once './../views/user/bxh.php';
    }
}