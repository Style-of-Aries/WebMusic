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
        $songsEXSH = $this->userModel->getSongsEXSH();
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
        } else
            $songs = null;
        ob_start();
        include BASE_PATH . '/views/user/songs/searchResult.php';
        $mainContent = ob_get_clean();
        include BASE_PATH . '/views/user/layout/layout.php';
    }
    public function favorite()
    {
        if (!isset($_SESSION['user']['id'])) {
            $_SESSION['flash_message'] = "⚠️ Bạn phải đăng nhập để xem danh sách yêu thích.";
            header("Location: ./index.php");
            exit;
        }

        $favories = $this->userModel->getFavoriteSongs($_SESSION['user']['id']);

        ob_start();
        include BASE_PATH . '/views/user/songs/favorite.php';
        $mainContent = ob_get_clean();
        include BASE_PATH . '/views/user/layout/layout.php';
    }
    public function toggleFavorite()
    {
        if (!isset($_SESSION['user']['id']) || !isset($_POST['song_id'])) {
            http_response_code(401);
            echo "unauthorized";
            return;
        }

        require_once "./../models/userModel.php";

        $userId = $_SESSION['user']['id'];
        $songId = intval($_POST['song_id']);

        if ($this->userModel->isFavorite($userId, $songId)) {
            $this->userModel->removeFavorite($userId, $songId);
            echo "removed";
        } else {
            $this->userModel->addFavorite($userId, $songId);
            echo "added";
        }
    }
    public function isFavorite()
    {

        if (!isset($_SESSION['user']['id']) || !isset($_POST['song_id'])) {
            echo "false";
            return;
        }

        $userId = $_SESSION['user']['id'];
        $songId = intval($_POST['song_id']);

        echo $this->userModel->isFavorite($userId, $songId) ? "true" : "false";
    }

}