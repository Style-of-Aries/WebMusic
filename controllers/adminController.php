<?php
require_once "./../models/adminModel.php";
class AdminController {
    public function index() {
        // Code for the admin dashboard
        $adminModel = new AdminModel();
        $songs = $adminModel->getAllSongs(); // Fetch all songs from the model
        require_once './../views/admin/layout.php';
    }

}