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
}
