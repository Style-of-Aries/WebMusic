<?php
require_once "./../models/adminModel.php";
require_once "./../vendor/autoload.php";
class adminController
{


    private $model;
    public function __construct()
    {
        $this->model = new adminModel();
    }
    public function index()
    {
        $songs = $this->model->getAll();
        require_once './../views/admin/products/list.php';
    }



    public function add()
    {
        $genres = $this->model->getGenres();
        require_once './../views/admin/products/add.php';
    }

    //Thêm mới bài hát
    public function store()
    {
        if (isset($_POST['btn_add'])) {
            $name = $_POST['name'] ?? '';
            $cs = $_POST['artist'] ?? '';

            // Mặc định ảnh trống
            $image = '';

            // Nếu người dùng upload ảnh, thì lưu
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = './../public/uploads/img/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
            }

            // Upload audio
            $audio = './../public/uploads/audio/' . basename($_FILES['audio']['name']);
            move_uploaded_file($_FILES['audio']['tmp_name'], $audio);

            // Phân tích audio
            $getID3 = new getID3();
            $inforSongs = $getID3->analyze($audio);

            // Lấy tên bài hát và nghệ sĩ từ metadata nếu có
            $name = isset($inforSongs['tags']['id3v2']['title'][0]) ? $inforSongs['tags']['id3v2']['title'][0] : $name;
            $cs = isset($inforSongs['tags']['id3v2']['artist'][0]) ? $inforSongs['tags']['id3v2']['artist'][0] : $cs;

            // Lấy thời lượng bài hát
            $duration = isset($inforSongs['playtime_seconds'])
                ? sprintf("%02d:%02d", floor($inforSongs['playtime_seconds'] / 60), $inforSongs['playtime_seconds'] % 60)
                : '00:00';

            // Nếu chưa có ảnh, cố gắng lấy ảnh từ file nhạc (nếu có)
            if (empty($image) && isset($inforSongs['comments']['picture'][0]['data'])) {
                $pictureData = $inforSongs['comments']['picture'][0]['data'];

                // Tạo tên file ảnh ngẫu nhiên
                $imageName = uniqid('cover_', true) . '.jpg';
                $imagePath = './../public/uploads/img/' . $imageName;

                // Lưu ảnh ra file
                file_put_contents($imagePath, $pictureData);

                // Gán đường dẫn đã lưu vào biến $image
                $image = $imagePath;
            }


            $genre = $_POST['genre'] ?? 'Khác';
            // Thêm vào CSDL
            $this->model->insert($name, $cs, $image, $audio, $duration, $genre);
        }

        $this->index();
    }
    
    //sửa bài hát
    public function edit()
    {
        $id = $_GET['id'];
        $song = $this->model->getSongId($id);
        require_once './../views/admin/products/edit.php';
    }
    public function update()
    {
        // $id=$_GET['id'];
        if (isset($_POST['btn_edit'])) {
            $id = $_POST['id'];
            // echo $id;
            $name = $_POST['name'];
            $cs = $_POST['artist'] ?? '';
            // Xử lý upload ảnh
            $image = './../public/uploads/img/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
            // Xử lý upload audio
            $audio = './../public/uploads/audio/' . basename($_FILES['audio']['name']);
            move_uploaded_file($_FILES['audio']['tmp_name'], $audio);
            $this->model->updateSong($id, $name, $cs, $image, $audio);
        }
        $this->index();
    }
    public function delete()
    {
        $id = $_GET['id'];
        // echo $id;
        $this->model->deleteSong($id);
        $this->index();
    }


    //userss
    public function indexUser()
    {
        $users = $this->model->getAllUser();
        require_once './../views/admin/users/list.php';
    }
    public function deleteUser()
    {
        $id = $_GET['id'];
        // echo $id;
        $this->model->deleteUser($id);
        $this->indexUser();
    }
    public function yeuThich()
    {
        $id = $_GET['id'];
        $songyts = $this->model->getAllYt($id);
        require_once './../views/admin/users/listYt.php';


    }

    public function genres()
    {
        $genres = $this->model->getGenres();
        require_once './../views/admin/genres/list.php';
    }

    public function storeGenre()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            if ($name === '') {
                $_SESSION['flash_message'] = "⚠️ Tên thể loại không được để trống.";
            } else {
                $result = $this->model->createGenre($name);
                $_SESSION['flash_message'] = $result ? "✅ Đã thêm thể loại." : "❌ Không thể thêm thể loại.";
            }
        }
        header("Location: index.php?controller=admin&action=genres");
        exit;
    }

    public function updateGenre()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
            $name = trim($_POST['name'] ?? '');
            if ($id <= 0 || $name === '') {
                $_SESSION['flash_message'] = "⚠️ Dữ liệu không hợp lệ.";
            } else {
                $result = $this->model->updateGenre($id, $name);
                $_SESSION['flash_message'] = $result ? "✏️ Đã cập nhật thể loại." : "❌ Không thể cập nhật thể loại.";
            }
        }
        header("Location: index.php?controller=admin&action=genres");
        exit;
    }

    public function deleteGenre()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($id > 0) {
            $result = $this->model->deleteGenre($id);
            $_SESSION['flash_message'] = $result ? "🗑️ Đã xóa thể loại." : "❌ Không thể xóa thể loại.";
        } else {
            $_SESSION['flash_message'] = "⚠️ Thể loại không tồn tại.";
        }
        header("Location: index.php?controller=admin&action=genres");
        exit;
    }
}
