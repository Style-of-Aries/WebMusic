<?php
require_once '../models/userModel.php';
require_once '../config/config.php';
class UserController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $songs = $this->userModel->getSongs();
        $songsDomic = $this->userModel->getSongsDomic();
        require_once './../views/user/songs/list.php';
    }
    public function bxh()
    {
        $songs = $this->userModel->getSongs();
        require_once './../views/user/songs/bxh.php';
    }
    public function search()
{
    $keyword = $_GET['keyword'] ?? '';

    // Nếu có từ khóa tìm kiếm, gọi hàm tìm kiếm
    if ($keyword !== '') {
        $songs = $this->userModel->searchSongs($keyword);
    } else $songs = null;
    ob_start();
    include BASE_PATH . '/views/user/songs/searchResult.php';
    $mainContent = ob_get_clean();
    include BASE_PATH . '/views/user/layout/layout.php';
}

}