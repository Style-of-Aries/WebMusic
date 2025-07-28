<?php
require_once "./../models/adminModel.php";
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
        require_once './../views/admin/products/add.php';
    }

    //Thêm mới bài hát
    public function store()
    {
        if (isset($_POST['btn_add'])) {
            $name = $_POST['name'] ?? '';
            $cs = $_POST['artist'] ?? '';
            // Xử lý upload ảnh
            $image = './../public/uploads/img/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);


            // Xử lý upload audio
            $audio = './../public/uploads/audio/' . basename($_FILES['audio']['name']);
            move_uploaded_file($_FILES['audio']['tmp_name'], $audio);

            $this->model->insert($name, $cs, $image, $audio);
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
    public function yeuThich(){
        $id = $_GET['id'];
        $songyts=$this->model->getAllYt($id);
        require_once './../views/admin/users/listYt.php';
    }

    public function addUser()
    {
        $vlName = $vlEmail = $vlPass = $vlCfPass = $vlSdt = "";
        $error = $errorPass = $errorName = $errorEmail = $errorCfPass = $errorsdt = "";
        include "./../views/admin/users/add.php";
    }
    public function admin_register()
    {
        // Giá trị giữ lại nếu có lỗi
        $vlName = $vlEmail = $vlPass = $vlCfPass = $vlSdt = "";
        // Biến lỗi cho từng trường
        $errorName = $errorEmail = $errorPass = $errorCfPass = $errorsdt = "";

        if (isset($_POST['btn_register'])) {
            $userNameRegister = $_POST['username'];
            $emailRegister = $_POST['email'];
            $passRegister = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $sdtRegister = $_POST['phone'];
            // Validate từng trường
            if (empty($userNameRegister)) {
                $errorName = "Vui lòng không để trống";
            } elseif ($this->model->authUserName($userNameRegister)) {
                $errorName = "Tài khoản đã tồn tại";
            } else {
                $vlName = $userNameRegister;
            }
            if (empty($emailRegister)) {
                $errorEmail = "Vui lòng không để trống";
            } elseif ($this->model->authEmail($emailRegister)) {
                $errorEmail = "Email đã tồn tại";
            } else {
                $vlEmail = $emailRegister;
            }
            if (empty($passRegister)) {
                $errorPass = "Vui lòng không để trống";
            } else {
                $vlPass = $passRegister;
            }
            if ($confirm_password !== $passRegister) {
                $errorCfPass = "Mật khẩu không chính xác";
            } else {
                $vlCfPass = $confirm_password;
            }
            if (empty($sdtRegister)) {
                $errorsdt = "Vui lòng không để trống";
            } else {
                $vlSdt = $sdtRegister;
            }
            // Nếu không có lỗi thì đăng ký và chuyển trang
            if (
                empty($errorName) && empty($errorEmail) && empty($errorPass)
                && empty($errorCfPass) && empty($errorsdt)
            ) {
                $this->model->authUsers($userNameRegister, $emailRegister, $passRegister, $sdtRegister);
                // ✅ Chuyển hướng đến trang login và dừng lại
                $this->indexUser();
                exit;
            }
        }
        // ✅ Chỉ include form nếu chưa đăng ký hoặc có lỗi
        include_once "./../views/admin/users/add.php";
    }
    public function edit_User(){
        $vlName="";
        $errorName = $errorEmail = "";
        $id = $_GET['id'];
        $user = $this->model->getUserId($id);
        require_once './../views/admin/users/edit.php';
    }
    public function editUser(){
        
        if(isset($_POST['btn_editUser'])){
            $id=$_POST['id'];
            $userNameRegister = $_POST['username'];
            $emailRegister = $_POST['email'];
            $passRegister = $_POST['password'];
            // $sdtRegister = $_POST['phone'];

            if ($this->model->authUserName($userNameRegister)) {
                $errorName = "Tài khoản đã tồn tại";
            }
            if ($this->model->authEmail($emailRegister)) {
                $errorEmail = "Email đã tồn tại";
            }
            if (empty($errorName) && empty($errorEmail)) {
                $this->model->updateUser($id,$userNameRegister, $emailRegister, $passRegister);
                $this->indexUser();
                exit;
            }else {
            // Gán lại dữ liệu vừa nhập để hiển thị lại form
            $user = [
                'id' => $id,
                'username' => $userNameRegister,
                'email' => $emailRegister,
                'password' => $passRegister
            ];}
        }
        include_once "./../views/admin/users/edit.php";
    }
}
