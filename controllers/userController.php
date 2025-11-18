<?php
require_once '../models/userModel.php';
require_once '../config/config.php';
require_once '../vendor/autoload.php';
class UserController
{
    private $userModel;
    private function requireLogin()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['flash_message'] = "⚠️ Bạn phải đăng nhập để thực hiện thao tác này.";
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $songs = $this->userModel->getSongs();
        
        if (isset($_SESSION['user'])) {
            $playlists = $this->getPlaylist();
        }
        require_once './../views/user/songs/list.php';
    }
    public function uploadMusic()
    {
        if (isset($_POST['btn_upload'])) {
            $name = $_POST['name'] ?? '';
            $cs = $_POST['artist'] ?? '';

            // Mặc định ảnh trống
            $image = '';

            // Nếu người dùng upload ảnh, thì lưu
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = './../public/uploads/img/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
            } else {
                $image = $_SESSION['user']['image'];
            }

            // Upload audio
            $audio = './../public/uploads/audio/' . basename($_FILES['audio']['name']);
            move_uploaded_file($_FILES['audio']['tmp_name'], $audio);

            // Phân tích audio
            $getID3 = new getID3();
            $inforSongs = $getID3->analyze($audio);

            // Lấy tên bài hát và nghệ sĩ từ metadata nếu có
            $name = isset($inforSongs['tags']['id3v2']['title'][0]) ? $inforSongs['tags']['id3v2']['title'][0] : $name;
            $cs = $_SESSION['user']['username'];

            // Lấy thời lượng bài hát
            $duration = isset($inforSongs['playtime_seconds'])
                ? sprintf("%02d:%02d", floor($inforSongs['playtime_seconds'] / 60), $inforSongs['playtime_seconds'] % 60)
                : '00:00';

            // Nếu chưa có ảnh, cố gắng lấy ảnh từ file nhạc (nếu có


            // Thêm vào CSDL
            $this->userModel->insert($name, $cs, $image, $audio, $duration);
            $_SESSION['flash_message'] = "✅ Thêm bài hát thành công.";
        }

        $this->mySongs();
    }
    public function deleteMySong()
    {
        $id = $_GET['id'];
        // echo $id;
        $this->userModel->delete($id);
        $_SESSION['flash_message'] = "✅ Xóa bài hát thành công.";
        $this->mySongs();
    }
    public function updateMySong()
    {
        if (isset($_POST['btn_edit'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $artist = $_POST['artist'];

            // File nhạc
            if (isset($_FILES['audio']) && $_FILES['audio']['name'] != '') {
                $audioFile = 'uploads/' . $_FILES['audio']['name'];
                move_uploaded_file($_FILES['audio']['tmp_name'], $audioFile);
            } else {
                $audioFile = $_POST['old_audio']; // giữ nhạc cũ
            }

            // Ảnh thumbnail
            if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                $imageFile = 'uploads/' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $imageFile);
            } else {
                $imageFile = $_POST['old_image']; // giữ ảnh cũ
            }

            // Cập nhật database
            $sql = "UPDATE songs SET name='$name', artist='$artist', fileSong='$audioFile', image='$imageFile' WHERE id=$id";
            $this->userModel->_query($sql);
        }
        $this->mySongs();

    }


    public function artist()
    {
        $artistName = $_GET['name'] ?? '';
        if ($artistName) {
            $songs = $this->userModel->getSongsByArtist($artistName);
            if (!$songs) {
                $_SESSION['flash_message'] = "⚠️ Không tìm thấy nghệ sĩ.";
                header("Location: ./index.php");
                exit;
            }
            ob_start();
            include BASE_PATH . '/views/user/songs/artist.php';
            $mainContent = ob_get_clean();
            include BASE_PATH . '/views/user/layout/layout.php';
        } else {
            $_SESSION['flash_message'] = "⚠️ Tên nghệ sĩ không hợp lệ.";
            header("Location: ./index.php");
            exit;
        }
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
            header("Location: index.php?controller=auth&action=login");
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

    public function mySongs()
    {
        $this->requireLogin();
        $songs = $this->userModel->getSongsByArtist($_SESSION['user']['username']);
        $playlists = $this->getPlaylist();
        ob_start();
        include BASE_PATH . '/views/user/songs/mySongs.php';
        $mainContent = ob_get_clean();
        include BASE_PATH . '/views/user/layout/layout.php';
    }
    public function editSong()
    {
        $this->requireLogin();
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id <= 0) {
            $_SESSION['flash_message'] = "⚠️ Bài hát không tồn tại.";
            header("Location: index.php?controller=user&action=mySongs");
            exit;
        }
        $song = $this->userModel->getSongById($id);
        if (!$song || $song['artist'] !== $_SESSION['user']['username']) {
            $_SESSION['flash_message'] = "⚠️ Bạn không thể chỉnh sửa bài hát này.";
            header("Location: index.php?controller=user&action=mySongs");
            exit;
        }

        ob_start();
        include BASE_PATH . '/views/user/songs/editSong.php';
        $mainContent = ob_get_clean();
        include BASE_PATH . '/views/user/layout/layout.php';
    }

    public function updateSong()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=user&action=mySongs");
            exit;
        }
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $song = $this->userModel->getSongById($id);
        if (!$song || $song['artist'] !== $_SESSION['user']['username']) {
            $_SESSION['flash_message'] = "⚠️ Bạn không thể chỉnh sửa bài hát này.";
            header("Location: index.php?controller=user&action=mySongs");
            exit;
        }

        $name = trim($_POST['name'] ?? $song['name']);
        if ($name === '') {
            $name = $song['name'];
        }
        $artist = $song['artist'];
        $imagePath = $song['image'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = './../public/uploads/img/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        }

        $audioPath = $song['fileSong'];
        $duration = $song['duration'];
        if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
            $audioPath = './../public/uploads/audio/' . basename($_FILES['audio']['name']);
            move_uploaded_file($_FILES['audio']['tmp_name'], $audioPath);

            $getID3 = new getID3();
            $info = $getID3->analyze($audioPath);
            if (isset($info['playtime_seconds'])) {
                $duration = sprintf(
                    "%02d:%02d",
                    floor($info['playtime_seconds'] / 60),
                    $info['playtime_seconds'] % 60
                );
            }
        }

        $this->userModel->update($id, $name, $artist, $imagePath, $audioPath, $duration);
        $_SESSION['flash_message'] = "✅ Cập nhật bài hát thành công.";
        header("Location: index.php?controller=user&action=mySongs");
        exit;
    }

    public function deleteSong()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=user&action=mySongs");
            exit;
        }
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $song = $this->userModel->getSongById($id);
        if (!$song || $song['artist'] !== $_SESSION['user']['username']) {
            $_SESSION['flash_message'] = "⚠️ Bạn không thể xóa bài hát này.";
            header("Location: index.php?controller=user&action=mySongs");
            exit;
        }

        $this->userModel->delete($id);
        $_SESSION['flash_message'] = "🗑️ Đã xóa bài hát.";
        header("Location: index.php?controller=user&action=mySongs");
        exit;
    }
    public function profile()
    {
        $this->requireLogin();
        $favoriteSongs = $this->userModel->getFavoriteSongs($_SESSION['user']['id']);
        $songs = $this->userModel->getSongsByArtist($_SESSION['user']['username']);
        $playlists = $this->getPlaylist();
        ob_start();
        include BASE_PATH . '/views/user/songs/profile.php';
        $mainContent = ob_get_clean();
        include BASE_PATH . '/views/user/layout/layout.php';
    }

    public function addPlaylist()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_add_playlist'])) {
            $playlistName = trim($_POST['playlistName'] ?? '');
            if ($playlistName !== '') {
                $this->userModel->insertPlaylist($_SESSION['user']['id'], $playlistName);
                $_SESSION['flash_message'] = "✅ Đã thêm playlist mới.";
            } else {
                $_SESSION['flash_message'] = "⚠️ Tên playlist không được để trống.";
            }
        }
        header("Location: index.php?controller=user&action=profile");
        exit;
    }
    public function editPlaylist()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_edit_playlist'])) {
            $playlistId = isset($_POST['playlist_id']) ? (int) $_POST['playlist_id'] : 0;
            $playlistName = trim($_POST['playlistName'] ?? '');
            if ($playlistId <= 0 || $playlistName === '') {
                $_SESSION['flash_message'] = "⚠️ Tên playlist không được để trống.";
            } elseif (!$this->userModel->checkOwner($playlistId, $_SESSION['user']['id'])) {
                $_SESSION['flash_message'] = "❌ Bạn không sở hữu playlist này.";
            } else {
                $updated = $this->userModel->updatePlaylistName($playlistId, $_SESSION['user']['id'], $playlistName);
                $_SESSION['flash_message'] = $updated ? "✏️ Đã cập nhật tên playlist." : "⚠️ Không có thay đổi nào được áp dụng.";
            }
        }
        header("Location: index.php?controller=user&action=profile");
        exit;
    }
    public function getPlaylist()
    {
        $this->requireLogin();
        $playlists = $this->userModel->getPlaylistsByUserId($_SESSION['user']['id']);
        if (!is_array($playlists)) {
            $playlists = []; // Gán mảng rỗng nếu nó là null hoặc không phải mảng
        }
        return $playlists;
    }

    public function addSong()
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // exit;
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $songId = (int) $_POST['song_id'];
            $playlistId = (int) $_POST['playlist_id'];
            $userId = $_SESSION['user']['id'];

            // Kiểm tra playlist có thuộc user không?
            if (!$this->userModel->checkOwner($playlistId, $userId)) {
                $_SESSION['flash_message'] = "❌ Bạn không sở hữu playlist này.";
                header("Location: index.php?controller=user&action=profile");
                exit;
            }

            // Chèn bài hát vào playlist
            $result = $this->userModel->addSongToPlaylist($playlistId, $songId);

            if ($result) {
                $_SESSION['flash_message'] = "🎵 Đã thêm bài hát vào playlist.";
            } else {
                $_SESSION['flash_message'] = "⚠️ Bài hát đã có trong playlist.";
            }
        }

        header("Location: index.php?controller=user&action=profile");
        exit;
    }

    public function deletePlaylist()
    {
        $this->requireLogin();

        if (isset($_GET['id'])) {
            $playlistId = (int) $_GET['id'];
            // Xóa playlist
            $this->userModel->deletePlaylist($playlistId);
            $_SESSION['flash_message'] = "🗑️ Đã xóa playlist.";
        }

        header("Location: index.php?controller=user&action=profile");
        exit;
    }
    public function viewPlaylist()
    {
        $this->requireLogin();

        if (isset($_GET['id'])) {
            $playlistId = (int) $_GET['id'];
            $playlist = $this->userModel->getPlaylistById($playlistId);
            $songs = $this->userModel->getSongsByPlaylistId($playlistId);
            $playlists = $this->getPlaylist();

            ob_start();
            include BASE_PATH . '/views/user/songs/playlistSongs.php';
            $mainContent = ob_get_clean();
            include BASE_PATH . '/views/user/layout/layout.php';
        } else {
            $_SESSION['flash_message'] = "⚠️ Playlist không tồn tại.";
            header("Location: index.php?controller=user&action=profile");
            exit;
        }
    }
}